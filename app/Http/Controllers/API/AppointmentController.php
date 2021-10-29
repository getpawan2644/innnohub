<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Appointment;
use App\Models\AppointmentSlot;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Mail\AppointmentAlert;
use App\Mail\AppointmentCancel;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public $successStatus = 200;
    public function index(Request $request){
        $userId = Auth::guard("api")->id();
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $records = AppointmentSlot::with(['Appointment'])->where('booked_by', $userId)->get();
        if(!empty($records->toArray())){
            $data=[];
            foreach($records as $key => $record){
                $data[$key]['slot_id'] = $record['id'];
                $data[$key]['date'] = date('d-m-Y', strtotime($record['appointment']['date']));
                $data[$key]['from_time'] = date('H:i', strtotime($record['from_time']));
                $data[$key]['to_time'] = date('H:i', strtotime($record['to_time']));
                $data[$key]['appointment_status'] = $record['appointment_status'];
            }
            $response["status"]=1;
            $response["data"]=$data;
        }else{
//            $this->successStatus = 200;
            $response["status"]=0;
            $response["message"]=__("messages.records_not_available");
        }
        return response()->json($response, $this->successStatus);
    }

    public function appointmentDates(){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $records = Appointment::select(\DB::raw('DATE_FORMAT(date,"%d-%m-%Y") as appointment_date'))->whereDate('date','>=',date('Y-m-d'))
                    ->whereHas('AppointmentSlot', function (Builder $query) {
                        $query->whereNull('booked_by');
                    })->get();
        if(!empty($records)){
            $response["status"]=1;
            $response["data"]=$records;
        }else{
//            $this->successStatus = 200;
            $response["status"]=0;
            $response["message"]=__("messages.records_not_available");
        }
        return response()->json($response, $this->successStatus);
    }
    public function appointmentSlots(Request $request){
        $records=[];
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $requestDate = @$request->date;
        if(isset($request->date) && !empty($request->date)){
            $date = date('Y-m-d',strtotime($request->date));
            $records = AppointmentSlot::with(['Appointment'])->whereHas('Appointment', function(Builder $query) use($date) {
                $query->where('date',$date);
            })->whereNull('booked_by')->get();
            if(!empty($records)){
                $data=[];
                foreach($records as $key => $record){
                    $data[$key]['slot_id'] = $record['id'];
                    $data[$key]['date'] = date('d-m-Y', strtotime($record['appointment']['date']));
                    $data[$key]['from_time'] = date('H:i', strtotime($record['from_time']));
                    $data[$key]['to_time'] = date('H:i', strtotime($record['to_time']));
                }
                $response["status"]=1;
                $response["data"]=$data;
            }else{
//                $this->successStatus = 200;
                $response["status"]=0;
                $response["message"]=__("messages.records_not_available");
            }
        } else{
            $this->successStatus = 200;
            $response["status"]=0;
            $response["message"]=__("messages.check_your_input");
        }
        return response()->json($response, $this->successStatus);
    }
    /**
     * url: http://127.0.0.1:8000/api/appointments/book
     * required paramaters: date,slot_id
     * otional parameters:
     */
    public function book(Request $request){
        $userId = Auth::guard("api")->id();
        $user = Auth::guard("api")->user();
        $date = date('Y-m-d', strtotime($request->date));

        $exist = AppointmentSlot::whereHas('Appointment', function(Builder $query) use($date){
            $query->whereDate('date', $date);
        })->where('booked_by', $userId)->first();
		if(empty($exist)){
			$record = AppointmentSlot::with(['Appointment'])->whereHas('Appointment', function(Builder $query) use($date){
				$query->whereDate('date', $date);
			})->findOrFail($request->slot_id);
			$record->booked_by = $userId;
			if($record->save()){
				Mail::to(env('ADMIN_NOTIFY_EMAIL'))->send(new AppointmentAlert($record,$user));
				$response["status"] = 1;
				$response["message"] = trans('content.appointment_book_success');
			} else {
				$this->successStatus = 200;
				$response["status"] = 0;
				$response["message"] = trans('content.something_went_wrong');
			}
		}else{
			$this->successStatus = 200;
            $response["status"] = 0;
			$response["message"] = "You already booked an appointment of this date.";
		}
        return response()->json($response, $this->successStatus);
    }

    /**
     * url: http://127.0.0.1:8000/api/appointments/cancel
     * required paramaters: slot_id
     * otional parameters:
     */
    public function cancel(Request $request){
        $record = AppointmentSlot::with(['Appointment'])->findOrFail($request->slot_id);
        $user = Auth::guard("api")->user();
        $record->booked_by = null;
        if($record->save()){
            Mail::to(env('ADMIN_NOTIFY_EMAIL'))->send(new AppointmentCancel($record,$user));
            $response["status"] = 1;
            $response["message"] = trans('content.appointment_cancel_success');
        } else {
            $this->successStatus = 200;
            $response["status"] = 0;
            $response["message"] = trans('content.something_went_wrong');
        }
        return response()->json($response, $this->successStatus);
    }

}

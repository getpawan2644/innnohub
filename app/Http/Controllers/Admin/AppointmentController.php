<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\AppointmentRequest;
use App\Models\Appointment;
use App\Models\AppointmentSlot;
use App\Models\EmailTemplate;
use Illuminate\Database\Eloquent\Builder;
use App\Mail\CustomerAppointmentAlert;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Appointment $appointment)
    {
        $records = $appointment->sortable(['id' => 'desc']);
        if($request->query('search')){
            $records = $records->where('date', date('Y-m-d', strtotime($request->query('search'))));
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
        return view('admin.appointment.index', compact(['records']));
    }

    public function bookingDetails(Request $request, AppointmentSlot $appointment){
        $appointmentDate = (!empty($request->query('search')))?date('Y-m-d', strtotime($request->query('search'))):date('Y-m-d');
        $records = $appointment->with(['Appointment', 'user'])->whereHas('Appointment', function(Builder $query) use($appointmentDate){
                                    $query->whereDate('date', $appointmentDate);
                                })->whereNotNull('booked_by')->sortable(['id' => 'desc']);

        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
        return view('admin.appointment.booking-detail', compact(['records']));
    }

    public function allAppointments(Request $request, AppointmentSlot $appointment){

        $records = $appointment->with(['Appointment', 'user'])->whereNotNull('booked_by')->sortable(['Appointment.date' => 'DESC']);
        if($request->query('search')){
            $appointmentDate = date('Y-m-d', strtotime($request->query('search')));
            $records = $records->whereHas('Appointment', function(Builder $query) use($appointmentDate){
                $query->whereDate('date', $appointmentDate);
            });
        }
        if($request->sort && $request->direction){

            if($request->sort == "user_name"){
                $records->join("users","users.id",'=','appointment_slots.booked_by')
                    ->select("appointment_slots.*")
                    ->orderBy("users.first_name",$request->direction)
                    ->orderBy("users.last_name",$request->direction);
            } elseif($request->sort == "email"){
                $records->join("users","users.id",'=','appointment_slots.booked_by')
                    ->select("appointment_slots.*")
                    ->orderBy("users.email",$request->direction);
            } elseif($request->sort == "appointment_date"){
                $records->join("appointments","appointments.id",'=','appointment_slots.appointment_id')
                    ->select("appointment_slots.*")
                    ->orderBy("appointments.date",$request->direction);
            } else {
                $records->orderBy("from_time","ASC");
            }
        }else{
            $records->orderBy("from_time","ASC");
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
        return view('admin.appointment.all_appointments', compact(['records']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.appointment.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppointmentRequest $request)
    {
        $requestData = $request->validated();
        $appointment = Appointment::create($requestData);
        $appointmentSlot = [];
        foreach($requestData['from_time'] as $key=>$value){
            $appointmentSlot[$key] = new AppointmentSlot(['from_time' => $value, 'to_time' => $requestData['to_time'][$key]]);
        }
        $appointment->AppointmentSlot()->saveMany($appointmentSlot);
        return redirect()->route('admin.appointment.index')->with(['success'=>'Appointment created successfully.']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Appointment::with(['AppointmentSlot'])->findOrFail($id);
        //dd($record->toArray());
        return view('admin.appointment.edit', compact(['record']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AppointmentRequest $request, $id)
    {
        $requestData = $request->validated();
        //dd($requestData);
        $record = Appointment::findOrFail($id);
        $record->fill($requestData);
        if($record->save()){
            AppointmentSlot::where('appointment_id', $id)->delete();
            foreach($requestData['from_time'] as $key=>$value){
                $appointmentSlot[$key] = new AppointmentSlot(['from_time' => $value, 'to_time' => $requestData['to_time'][$key]]);
            }
            $record->AppointmentSlot()->saveMany($appointmentSlot);
        }
        return redirect()->route('admin.appointment.index')->with(['success'=>'Appointment created successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $record = Appointment::with(['AppointmentSlot.user'])->findOrFail($id);
        //dd($record->toArray());
        $html = view('admin.appointment.show')->with(compact('record'))->render();
        return response()->json(['success' => true, 'date'=>date("d-m-Y",strtotime($record["date"])),'html' => $html]);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Appointment::findOrFail($id);
        if($record->delete()){
            AppointmentSlot::where('appointment_id', $id)->delete();
            return back()->with(['success'=>'Record deleted successfully']);
        } else {
            return back()->with(['error'=>'Unable to delete this record']);
        }
    }

    /**
     * Change Status the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function changeStatus(Request $request)
    {
        //dd($request->all());
        $record = Appointment::findOrFail($request->id);
        $record->status = $request->status;
        if($record->save()){
            $error = 0;
            $message ='Status changed to <strong>'.$record->status.'</strong>';
        } else {
            $error = 1;
            $message ='Unable to change status';
        }
        return response()->json(['error' => $error,'message' => $message]);
    }
    public function cancelAppointment(Request $request,$id){
        //echo $id; die;
        $record = AppointmentSlot::with(['Appointment','user'])->findOrFail($id);
        $user =$record->user;
        $record->booked_by = null;
        $this->sendEmailAlertUser('appointment-cancel',$user,$record);
//        $this->sendEmailAlertUser('appointment-cancel','ar',$user,$record);
        if($record->save()){
            $subject = "Hi ".$record->user->first_name.' '.$record->user->last_name." your appointment is cancelled by the admin";
            //Mail::to($record->user->email)->send(new CustomerAppointmentAlert($record,$user,$subject ));
            return back()->with(['success'=>'Appointment cancelled successfully']);
        } else {
            return back()->with(['error'=>'Something went wrong']);
        }
    }
    public function rescheduleAppointment(Request $request,$id){
        //echo $id; die;

        $record = AppointmentSlot::with(['Appointment',])->findOrFail($id);
        $user = $record->user;
        $record->booked_by = null;
        $this->sendEmailAlertUser('appointment-reschedule',$user,$record);
        //$this->sendEmailAlertUser('appointment-reschedule','ar',$user,$record);
        if($record->save()){
            $subject = "Hi ".$record->user->first_name.' '.$record->user->last_name." your appointment is cancelled please reschedule";
//            Mail::to($record->user->email)->send(new CustomerAppointmentAlert($record,$user,$subject ));
            return back()->with(['success'=>'Successfully send request for rescheduling']);
        } else {
            return back()->with(['error'=>trans('content.something_went_wrong')]);
        }
    }
    public function sendEmailAlertUser($pageName,$user,$record){
        //dd($user);
        $allEmailTemp = EmailTemplate::allEmailTemplate($pageName);
        $englishSubject = $allEmailTemp->translateOrDefault("en")->title;
        $englishContent = $allEmailTemp->translateOrDefault("en")->content;
        $arabicSubject = $allEmailTemp->translateOrDefault("ar")->title;
        $arabicContent = $allEmailTemp->translateOrDefault("ar")->content;
        $appintment_date = date('d-m-Y', strtotime($record['appointment']['date']));
        $from_date = date("h:i A", strtotime($record['from_time']));
        $to_date = date("h:i A", strtotime($record['to_time']));
        $subject = str_replace(["{user}"], [$user->first_name.' '.$user->last_name], $englishSubject);

        $en_message = str_replace(["{appointment_date}","{from_time}","{to_time}"],[$appintment_date,$from_date, $to_date],$englishContent);
        $ar_message = str_replace(["{appointment_date}","{from_time}","{to_time}"],[$appintment_date,$from_date, $to_date],$arabicContent);
        $ar_message="<div style='width:100%;border-top:1px solid black;' dir='rtl'>".$ar_message.'</div>';
        $message=$en_message.$ar_message;
        Mail::to($record->user->email)->send(new CustomerAppointmentAlert($subject,$message));
    }
    public function csv(Request $request, AppointmentSlot $appointment)
    {
        $table = $appointment->with(['Appointment', 'user'])->whereNotNull('booked_by')->sortable(['id' => 'desc'])->get();
        $filename = "appointment.csv";
        $handle = fopen($filename, 'w+');
        //dd($table->toArray());
        fputcsv($handle, array('S.No','User Name','Email','Phone',' Appointment Date','From Time','To Time'));
        $i=1;
        foreach($table as $row) {
            $appintment_date = date('d-m-Y', strtotime($row->Appointment->date));
            $from_time = date('h:i A', strtotime($row->from_time));
            $to_time = date('h:i A', strtotime($row->to_time));
            fputcsv($handle, array($i,@$row->user->full_name, @$row->user->email, '+'.@$row->user->dial_code.'-'.@$row->user->mobile,$appintment_date,$from_time, $to_time));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return \Response::download($filename, 'appointment.csv', $headers);
    }

}

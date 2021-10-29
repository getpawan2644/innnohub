<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\AppointmentSlot;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use App\Mail\AppointmentAlert;
use App\Mail\AppointmentCancel;
use Illuminate\Support\Facades\Mail;

class AppointmentController extends Controller
{
    public function index(Request $request){
        $records = AppointmentSlot::with(['Appointment'])
            ->sortable(['Appointment.date' => 'asc'])
            ->orderBy('from_time','asc')
            ->where('booked_by', Auth::id())->get();
        return view('appointment.index', compact(['records']));
    }

    public function create(Request $request){
        $allAppointment=[];
        //dd($request->date);
        $requestData = @$request->date;
        if(isset($request->date) && !empty($request->date)){
            $date = date('Y-m-d',strtotime($request->date));
            //echo $date;
            $allAppointment = AppointmentSlot::with(['Appointment'])->whereHas('Appointment', function(Builder $query) use($date) {
                $query->where('date',$date);
            })->whereNull('booked_by')->get();
        }
        return view('appointment.create', compact(['allAppointment', 'requestData']));
    }
    public function fetchAppointment(Request $request){
        $date = date('Y-m-d',strtotime($request->date));
        //echo $date;
        $allAppointment = AppointmentSlot::with(['Appointment'])->whereHas('Appointment', function(Builder $query) use($date) {
            $query->where('date',$date);
        })->whereNull('booked_by')->get();
        $html = view('appointment.ajax.date-list')->with(compact('allAppointment'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
    public function book(Request $request, $id, $date){
        $userId = Auth::id();
        $user = Auth::user();
        $exist = AppointmentSlot::whereHas('Appointment', function(Builder $query) use($date){
            $query->whereDate('date', $date);
        })->where('booked_by', $userId)->first();
        $record = AppointmentSlot::with(['Appointment'])->whereHas('Appointment', function(Builder $query) use($date){
            $query->whereDate('date', $date);
        })->findOrFail($id);
        $record->booked_by = $userId;
        if(empty($exist) && $record->save()){
            Mail::to(env('ADMIN_NOTIFY_EMAIL'))->send(new AppointmentAlert($record,$user));
            return back()->with(['success'=>trans('content.appointment_book_success')]);
        } else {
            return back()->with(['error'=>trans('content.something_went_wrong')]);
        }
    }
    public function cancel(Request $request, $id){
        $record = AppointmentSlot::with(['Appointment'])->findOrFail($id);
        $user = Auth::user();
        $record->booked_by = null;
        if($record->save()){
            Mail::to(env('ADMIN_NOTIFY_EMAIL'))->send(new AppointmentCancel($record,$user));
            return back()->with(['success'=>trans('content.appointment_cancel_success')]);
        } else {
            return back()->with(['error'=>trans('content.something_went_wrong')]);
        }
    }
}

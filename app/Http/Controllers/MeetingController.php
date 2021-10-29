<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use App\Models\Service;
use App\Models\User;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Auth;
use Mail;
use Carbon\Carbon;

class MeetingController extends Controller
{

  public function index(Request $request){
        try{
          
            $searchString=$request->input('search');
            $meeting = Meeting::where('buyer_id',Auth::user()->id)->with(['userData','serviceData']);
            if($searchString){ 
            $records =  $meeting->whereHas('sellerData', function ($query) use ($searchString){
                               $query->whereRaw("concat(first_name, ' ', last_name) like '%$searchString%'");
                        })->orwhereHas('serviceData', function ($query) use ($searchString){
                               $query->where('service_name','Like','%'.$searchString.'%');
                        })->orWhere('message','Like','%'.$searchString.'%')->where('buyer_id',Auth::user()->id)->sortable()->paginate(env('PAGINATION_LIMIT'));
            }else{
               $records =  $meeting->orderBy('id','Desc')->sortable()->paginate(env('PAGINATION_LIMIT'));
            }
            //print_R($meeting); die;
            return view('meetings.index',compact('records'));
          }catch(ModelNotFoundException $exception){
            return response()->json(['msg'=>$exception->getMessage(),'status'=>0]);
         }
    }
    public function bookmeeting(Request $request){
        try{
           //$service = Service::find($request->service_id);
               $userData= User::find($request->id);   
              Meeting::create([
                'buyer_id'=>Auth::user()->id,'seller_id'=>$request->id,'message'=>$request->message,'service_id'=>0
            ]);
              $vendorname=$userData->first_name.' '.$userData->last_name;
              $username = Auth::user()->first_name.' '.Auth::user()->last_name;
              // return response()->json(['msg'=>Auth::user()->company_size,'status'=>1]); die;
              $useremail = Auth::user()->email;
              $companyname = Auth::user()->company_name;
              $jobtitle = Auth::user()->job_title;
              $companysize = Auth::user()->company_size;
              $location = Auth::user()->address;
             // $servicename = $service->service_name;
               \Mail::to($userData->email)->send(new \App\Mail\BookMeeting($username,$useremail,$companyname,$jobtitle,$companysize,$location,$vendorname));
            return response()->json(['msg'=>'You have booked the meeting successfully!','status'=>1]);
          }catch(ModelNotFoundException $exception){
            return response()->json(['msg'=>$exception->getMessage(),'status'=>0]);
         }
    }


     public function meetingRequest(Request $request){
        try{
            
            $searchString=$request->input('search');
            $meeting = Meeting::where('seller_id',Auth::user()->id)->with(['userData','serviceData']);
            if($searchString){ 
            $records =  $meeting->whereHas('userData', function ($query) use ($searchString){
                               $query->whereRaw("concat(first_name, ' ', last_name) like '%$searchString%'");
                        })->orwhereHas('serviceData', function ($query) use ($searchString){
                               $query->where('service_name','Like','%'.$searchString.'%');
                        })->orWhere('message','Like','%'.$searchString.'%')->where('seller_id',Auth::user()->id)->sortable()->paginate(env('PAGINATION_LIMIT'));
            }else{
               $records =  $meeting->orderBy('id','Desc')->sortable()->paginate(env('PAGINATION_LIMIT'));
            }
            //print_R($meeting); die;
            return view('meetings.meetingRequest',compact('records'));
          }catch(ModelNotFoundException $exception){
            return response()->json(['msg'=>$exception->getMessage(),'status'=>0]);
         }
    }

     public function destroy(Request $request,$id)
    {
             $meeting = Meeting::find($request->id);
                
                if(!empty($meeting)){
                    Meeting::destroy($request->id);
                    return redirect()->back()->with(['title'=>__('messages.success'),'success'=>'Meeting deleted successfully!']);
                    }else{
                     return back()->with(['title'=>__('messages.error'),'error'=>__('messages.action_failed')]);
                  }
           
    }

      public function statusAccept (Request $request){
        $validated = $request->validate([
            'message' => 'required',
            'meeting_link' => 'required',
            'start_date' => 'required',
            'start_time' => 'required',
            'end_date' => 'required',
            'end_time' => 'required',
           
        ]);
       $sDate = date("Y-m-d", strtotime($request->start_date));
       $eDate = date("Y-m-d", strtotime($request->end_date));
       $stime = date("H:i", strtotime($request->start_time));
       $etime = date("H:i", strtotime($request->end_time));
        $update = Meeting::where('id',$request->posted_id)->update(['seller_message'=>$request->message,'status'=>'Accept','meeting_link'=>$request->meeting_link,'start_date'=>$sDate,'start_time'=>$stime,'end_date'=>$eDate,'end_time'=>$etime]);
       $data = Meeting::find($request->posted_id);
        $userdata=User::find($data->buyer_id);
             $vendorname=Auth::user()->first_name.' '.Auth::user()->last_name;
              $username = $userdata->first_name.' '.$userdata->last_name;
             $msg = $request->message;
             $link = $request->meeting_link;
             $time = $sDate.' '.$stime.' - '.$eDate.' '.$etime;
             $end = $request->meeting_link;
         \Mail::to($userdata->email)->send(new \App\Mail\AcceptMeeting($username,$msg,$vendorname,$link,$time));
       return response()->json(['status'=>1,'msg'=>'Meeting Accept']);
       // return response::json();
     }

     public function statusReject(Request $request){
        $validated = $request->validate([
            'message_reject' => 'required',
           
        ]);
        
        $updateReject = Meeting::find($request->rejectpost_id)->update(['seller_message'=>$request->message_reject,'status'=>$request->reject]);
        $data = Meeting::find($request->rejectpost_id);
        $userdata=User::find($data->buyer_id);
             $vendorname=Auth::user()->first_name.' '.Auth::user()->last_name;
              $username = $userdata->first_name.' '.$userdata->last_name;
             $msg = $request->message_reject;
             
         \Mail::to($userdata->email)->send(new \App\Mail\RejectMeeting($username,$msg,$vendorname));
        return response()->json(['status'=>1,'msg'=>'Meeting Reject']);
     }
   
}

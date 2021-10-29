<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerMessageRequest;
use App\Mail\AdminMessageAlert;
use App\Models\EmailTemplate;
use App\Models\Messages;
use App\Models\ParentMessage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Validator;
use DB;
class MessagesController extends Controller
{
    public $successStatus = 200;
    public function index(Request $request, ParentMessage $paretnMessage){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $userId = Auth::guard('api')->user()->id;
        $records = $paretnMessage->with(['last_message'])->sortable(['id' => 'desc']);
        $records = $records->whereHas('customer', function($query) use($userId){
            $query->Where('customer_id','=',$userId);
        });
        $records = $records->withCount(['Messages as customer_count'=>function (Builder $query) {
            $query->where('customer_status', 'Pending');
        }
        ]);
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
        if($records->count()>0){
            $i=0;
            foreach($records as $record){
                //dd($record->latestImage->thumbnail_url);
                $temp_data["messages"][$i]["id"]=@$record->id;
                $temp_data["messages"][$i]["subject"]=@$record->subject;
                $temp_data["messages"][$i]["last_message_date"]=date('d-m-Y', strtotime($record->last_message->created_at));
                $temp_data["messages"][$i]["message_count"]=@$record->customer_count;
                $temp_data["messages"][$i]["from_to"]=__('content.admin');
                $i++;
            }
            $response["status"]=1;
            $response["data"]=$temp_data;
        }else{
//            $this->successStatus=200;
            $response["message"]=__("messages.records_not_available");
            $response["data"]["messages"]=array();
        }
        return response()->json($response, $this->successStatus);
    }

    public function initiateConversation(Request $request){
        $user_id=Auth::guard('api')->user()->id;
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $validator = Validator::make($request->all(), [
            'subject' => 'required',
            'message' => 'required',
            'customer_id' => 'nullable',
            'parent_id' => 'nullable',
            'sender_id' => 'nullable',
            'status' => 'nullable',
            'customer_status' => 'nullable',
            'admin_status' => 'nullable',
        ],[
            'subject.required'  =>  trans("validation.subject_required"),
            'message.required'  =>  trans("validation.message_required"),
        ]);
        if ($validator->fails()) {
            $response["message"]=getFirstError($validator->errors("errors")->toArray());
            return response()->json($response, 200);
        }
        $pMsgData['admin_id'] = 0;
        $pMsgData['customer_id'] = $user_id;
        $pMsgData['subject'] = $request->subject;
        $user = Auth::guard('api')->user();
        $parent_message = ParentMessage::create($pMsgData);
        $msgData  = new Messages([
            'sender_id'=>$user_id,
            'message' => $request->message,
            'customer_status' => 'Viewed',
            'admin_status' => 'Pending'
        ]);
        if($parent_message->messages()->save($msgData)){
            $this->sendAdminAlert('admin-message-alert',$user,$request->message);
//            Mail::to(env('ADMIN_NOTIFY_EMAIL'))->cc(['abhishek@braintechnosys.com','anas@sab-q.com'])->send(new AdminMessageAlert($user,$request->message));
        }
        $response['status']=1;
        $response['message']=trans('messages.message_send_success');
        $response["data"]=$parent_message->toArray();
        return response()->json($response, 200);
    }

    public function getConversation(Request $request, Messages $messages){
        $id=$request->parent_id;
        $authId=Auth::guard('api')->user()->id;
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $records = ParentMessage::with(['messages'])->where('id','=',$id)->first();
        $updateStatus = $messages->where('parent_id', $id)->update(['customer_status'=>'Viewed']);
        $response["data"]=$records->toArray();
        $response["status"]=1;
        return response()->json($response, 200);
    }

    public function sendMessage(Request $request, Messages $messages){
        //dd($request->validated());
        $user = Auth::guard('api')->user();
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $validator = Validator::make($request->all(), [
            'message' => 'required',
            'parent_id' => 'required',
            'sender_id' => 'nullable',
            'status' => 'nullable',
            'customer_status' => 'nullable',
            'admin_status' => 'nullable',
        ],[
            'message.required'  =>  trans("validation.message_required"),
            'parent_id.required'  =>  trans("validation.parent_id_required"),
        ]);
        $req_data['message']=$request->message;
        $req_data['parent_id']=$request->parent_id;
        $req_data['sender_id']=$user->id;
        $req_data['status']="Pending";
        $req_data['customer_status']="Viewed";
        $req_data['admin_status']="Pending";

        if ($validator->fails()) {
            $response["message"]=getFirstError($validator->errors("errors")->toArray());
            return response()->json($response, 200);
        }
        try{
            DB::beginTransaction();
            $message = \App\Models\Messages::create($req_data);
            DB::commit();
            $this->sendAdminAlert('admin-message-alert',$user,$request->message);
//            Mail::to(env('ADMIN_NOTIFY_EMAIL'))->cc(['abhishek@braintechnosys.com','anas@sab-q.com'])->send(new AdminMessageAlert($user,$request->message));
            $response["status"]=1;
            $response["data"]=trans('messages.message_send_success');
            return response()->json($response, 200);
        } catch (\PDOException $e) {
            // Woops
            DB::rollBack();
            $response["message"]="Please check your input and try again.";
            return response()->json($response, 200);
        }
    }
    public function sendAdminAlert($pageName,$user,$message){
        $allEmailTemp = EmailTemplate::allEmailTemplate($pageName);
        $englishSubject = $allEmailTemp->translateOrDefault("en")->title;
        $englishContent = $allEmailTemp->translateOrDefault("en")->content;
        $arabicContent = $allEmailTemp->translateOrDefault("ar")->content;
        $englishContent = str_replace(["{customer_name}"], [$user->first_name.' '.$user->last_name], $englishContent);
        $englishContent = str_replace(["{customer_mobile}"], ['+'.$user->dial_code.'-'.$user->mobile], $englishContent);
        $englishContent = str_replace(["{customer_email}"], [$user->email], $englishContent);
        $englishContent = str_replace(["{message}"], [nl2br($message)], $englishContent);
        $saperotor="<br/>-------------------------------------------------------------------<br/>";
        $arabicContent = str_replace(["{customer_name}"], [$user->first_name.' '.$user->last_name], $arabicContent);
        $arabicContent = str_replace(["{customer_mobile}"], ['+'.$user->dial_code.'-'.$user->mobile], $arabicContent);
        $arabicContent = str_replace(["{customer_email}"], [$user->email], $arabicContent);
        $arabicContent = str_replace(["{message}"], [nl2br($message)], $arabicContent);
        $message=$englishContent.$saperotor.$arabicContent;
        Mail::to(env('ADMIN_NOTIFY_EMAIL'))->cc(['anas@sab-q.com'])->send(new AdminMessageAlert($englishSubject,$message));
    }
}

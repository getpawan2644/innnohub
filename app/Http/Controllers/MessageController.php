<?php

namespace App\Http\Controllers;
use App\Mail\CustomerAppointmentAlert;
use App\Models\EmailTemplate;
use App\Models\Messages;
use App\Models\ParentMessage;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\MessageRequest;
use App\Http\Requests\CustomerMessageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\AdminMessageAlert;
use Illuminate\Support\Facades\Mail;
use DB;

class MessageController extends Controller
{
    public function index(Request $request, ParentMessage $paretnMessage){
        $userId = Auth::user()->id;
        $records = $paretnMessage->with(['last_message'])->sortable(['id' => 'desc']);
        $records = $records->whereHas('customer', function($query) use($userId){
                        $query->Where('customer_id','=',$userId);
                    });
        $records = $records->withCount(['Messages as customer_count'=>function (Builder $query) {
                                        $query->where('customer_status', 'Pending');
                                    },
                                        'Messages as admin_count'=>function (Builder $query) {
                                                    $query->where('admin_status', 'Pending');
                                                }
                                        ]);
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
        //dd($records->toArray());
        return view('message.index',compact(['records']));
    }
    public function message(Request $request, Messages $messages, $id=null){
        $authId = Auth::user()->id;
        $records = ParentMessage::with(['messages'])->where('id','=',$id)->first();
        //dd($records->toArray());
        $updateStatus = $messages->where('parent_id', $id)->update(['customer_status'=>'Viewed']);
        return view('message.message', compact(['records','authId','id']));
    }
    public function saveMessage(MessageRequest $request, Messages $messages, $id=null){
//        dd($request->all());
        $user = Auth::user();
        try {
            DB::beginTransaction();
                $message = \App\Models\Messages::create($request->all());
            DB::commit();
            $this->sendAdminAlert('admin-message-alert',$user,$request->message);
//            Mail::to(env('ADMIN_NOTIFY_EMAIL'))->cc(['abhishek@braintechnosys.com','anas@sab-q.com'])->send(new AdminMessageAlert($user,$request->message));
            return redirect()->route('message.index')->with(['success'=>'Thanks for contact with us. Our representative will contact you soon.']);
        } catch (\PDOException $e) {
            // Woopsy
            DB::rollBack();
            return redirect()->back()->with(['error'=>'Please check your input and try again.']);
            echo $e->messages();
        }
    }
    public function create(Request $request){
        return view('message.create');
    }
    public function store(Request $request, CustomerMessageRequest $messageRequest){
        $pMsgData['admin_id'] = 0;
        $pMsgData['customer_id'] = $request->customer_id;
        $pMsgData['subject'] = $request->subject;
        $user = Auth::user();
        $paranetMessage = ParentMessage::create($pMsgData);
        $msgData  = new Messages([
                                    'sender_id'=>$request->customer_id,
                                    'message' => $request->message,
                                    'customer_status' => 'Viewed',
                                    'admin_status' => 'Pending'
                                ]);
        if($paranetMessage->messages()->save($msgData)){
            $this->sendAdminAlert('admin-message-alert',$user,$request->message);
//            Mail::to(env('ADMIN_NOTIFY_EMAIL'))->cc(['abhishek@braintechnosys.com','anas@sab-q.com'])->send(new AdminMessageAlert($user,$request->message));
        }
        return redirect(route('message.index'))->with(['success'=>trans('messages.message_send_success')]);
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
        Mail::to(env('ADMIN_NOTIFY_EMAIL'))->cc(env('CC_EMAIL'))->send(new AdminMessageAlert($englishSubject,$message));
    }
}

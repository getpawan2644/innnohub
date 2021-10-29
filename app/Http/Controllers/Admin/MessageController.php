<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\CustomerMessageAlert;
use App\Models\EmailTemplate;
use App\Models\Messages;
use App\Models\ParentMessage;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Requests\MessageRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Mail;

class MessageController extends Controller
{
    public function index(Request $request, ParentMessage $paretnMessage){
        $userId = Auth::user()->id;
        $records = $paretnMessage->with(['customer','last_message'])->sortable(['id' => 'desc']);
        if($request->query('search')){
            $name = explode(" ",$request->query('search'));
            //dd($name);
            $records->whereHas('customer', function(Builder $query) use($name){
                $query->where('first_name',$name[0]);
                $query->orWhere('email',$name[0]);
                if(isset($name[1]) && !empty(@$name[1])){
                    $query->where('last_name',$name[1]);
                }
            });
        }
        $records = $records->withCount(['Messages as admin_count'=>function (Builder $query) {
                                                $query->where('admin_status', 'Pending');
                                            }
                                        ]);
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
        //dd($records->toArray());
        return view('admin.message.index',compact(['records']));
    }
    public function message(Request $request, Messages $messages, $id=null){
        $authId = Auth::user()->id;
        $records = ParentMessage::with(['messages','customer'])->where('id','=',$id)->first();
        //dd($records->toArray());
        $customer_name = $records->customer->first_name.' '.$records->customer->last_name;
        $updateStatus = $messages->where('parent_id', $id)->update(['admin_status'=>'Viewed']);
        return view('admin.message.message', compact(['records','authId','id','customer_name']));
    }
    public function saveMessage(MessageRequest $request, Messages $messages, $id=null){
        //dd($request->validated());
        $parent_message=ParentMessage::where("id",$request->parent_id)->first();
//        dd($parent_message->subject);die;
        $user=User::findOrFail($parent_message->customer_id);
        if($user){
        try {
            DB::beginTransaction();
                $message = \App\Models\Messages::create($request->all());
            DB::commit();
            $this->sendAdminAlert('customer-message-alert',$parent_message->subject,$user,$request->message);
            return redirect()->route('admin.message.index')->with(['success'=>'Send Successfully.']);
        } catch (\PDOException $e) {
            // Woopsy
            DB::rollBack();
            return redirect()->back()->with(['error'=>'Please check your input and try again.']);
            echo $e->messages();
        }
        }else{
            return redirect()->back()->with(['error'=>'Please check your input and try again.']);
        }
    }
    public function sendAdminAlert($pageName,$subject,$user,$message){
        $allEmailTemp = EmailTemplate::allEmailTemplate($pageName);
        $englishSubject = $allEmailTemp->translateOrDefault("en")->title;
        $englishContent = $allEmailTemp->translateOrDefault("en")->content;
        $arabicSubject = $allEmailTemp->translateOrDefault("ar")->title;
        $arabicContent = $allEmailTemp->translateOrDefault("ar")->content;
        $englishSubject = str_replace(["{user_name}"], [$user->first_name.' '.$user->last_name], $englishSubject);
        $englishContent = str_replace(["{user_name}"], [$user->first_name.' '.$user->last_name], $englishContent);
        $englishContent = str_replace(["{subject}"], [$subject], $englishContent);
        $englishContent = str_replace(["{admin_message}"], [nl2br($message)], $englishContent);
        $separator="<br/>-------------------------------------------------------------------<br/>";
        $arabicSubject = str_replace(["{user_name}"], [$user->first_name.' '.$user->last_name], $arabicSubject);
        $arabicContent = str_replace(["{user_name}"], [$user->first_name.' '.$user->last_name], $arabicContent);
        $arabicContent = str_replace(["{subject}"], [$subject], $arabicContent);
        $arabicContent = str_replace(["{admin_message}"], [nl2br($message)], $arabicContent);
        $message=$englishContent.$separator.$arabicContent;
//        dd($user->email);
        Mail::to($user->email)->cc([env("CC_EMAIL")])->send(new CustomerMessageAlert($englishSubject,$message));
    }
}

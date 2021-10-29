<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use App\Models\Messages;
use App\Models\ParentMessage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $records = User::query();
        //dd($records);
        $search=$request->query('search');
        if($search){
            $records = $records->where(function($q) use ($request) {
                $q->orWhere('first_name','like', '%'.$request->query('search').'%');
                $q->orWhere('last_name','like', '%'.$request->query('search').'%');
                $q->orWhere('email','like', '%'.$request->query('search').'%');
                $q->orWhere('mobile','like', '%'.$request->query('search').'%');
                 $q->orWhere('user_type','like', '%'.$request->query('search').'%');
            });
        }
        // if($request->query('sort') && $request->query('direction')){ 
        //     $records->orderBy($request->query('sort'),$request->query('direction') );
        // }else{
        //     $records->orderBy("id","DESC");
        // }
        $records = $records->sortable()->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
        
        if($request->search){
            $search = $request->search;
        }else{
            $search = 1;
        }

        return view('admin.users.index',['records'=>$records,'search'=>$search]);
    }
    public function create(){ 
        $record = new User;
        return view('admin.users.create', compact('record'));
    }

    public function store(UserRequest $request) {
        $validated = $request->validated();
        //$validated["password"]=Hash::make($validated['password']);
        $user = User::create($validated);
        return redirect()->route('admin.users.index')->with(['success'=>'User added successfully.']);
    }
    public function edit($id)
    {
        $record = User::findOrFail($id);
        return view('admin.users.edit')->with(compact('record'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validated();
        if($validated['password']){
            $password = Hash::make($validated['password']);
            $validated["password"] = $password;
        }else{
            $validated["password"] = $user->password;
        }
        $user->fill($validated);
        $user->save();
        return redirect()->route('admin.users.index')->with(['success'=>'User updated successfully.']);

    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $record = User::findOrFail($id);
        if($record->delete()){
            return back()->with(['success'=>'User deleted successfully']);
        }else {
            return back()->with(['error'=>'Unable to delete this record']);
        }
    }

    public function changeStatus(Request $request)
    {
        $record = User::findOrFail($request->id);
        $record->status = $request->status;
        if($record->save()){
            $error = 0;
            $message ='Status changed to <strong>'.$record->status.'</strong>';
        } else {
            $error = 1;
            $message ='Unable to change status';
        }
        return response()->json([
            'error' => $error,
            'message' => $message
        ]);
    }

    public function getStates(Request $request){
        return response()->json(State::allActive($request->country_id));
    }

    public function sendResetLinkEmail($id)
    {
        $user = User::findOrFail($id);
        if($user){
            $token = Password::getRepository()->create($user);
            $user->sendPasswordResetNotification($token,"Admin");
            return redirect()->route('admin.users.index')->with(['success'=>'We have successfully sent a password reset email to user.']);
        }else{
            return redirect()->route('admin.users.index')->with(['error'=>'Sorry! something went wrong. Please try again.']);
            $message="";
        }
    }

    public function message(Request $request){
        //dd($request->all());
        $request = $request->all();
        $record =  User::findOrFail($request['id']);
        if(!empty($record)) {
            $html = view('admin.users.popup.msg-popup')->with(compact(['record']))->render();
            return json_encode(array("success"=>true,'html' => $html));
        } else {
            return json_encode(array("success"=>false,'message' => "User don't have account."));
        }
        
    }
    public function sentMessage(Request $request){
        $messages = [
            'subject.required'  => 'Subject field is required',
            'message.required'  => 'Message field is required',
        ];
        $errors = Validator::make($request->all(), [
            'subject' => 'required',
            'message' => 'required'
        ], $messages);
        
        if ($errors->fails())
        {
            $input = $request->all();
            $record =  User::findOrFail($request->request_id);
            $html = view('admin.users.popup.msg-popup')->with(compact(['input','record']))->withErrors($errors)->render();
            return response()->json(['success' => false, 'html' => $html]); 
        }



        $pMsgData['admin_id'] = 0;
        $pMsgData['customer_id'] = $request->customer_id;
        $pMsgData['subject'] = $request->subject;
        $pMsgData['customer_id'] = $request->customer_id;
        $paranetMessage = ParentMessage::create($pMsgData);
        $msgData  = new Messages([
                                    'sender_id'=>$request->sender_id,
                                    'message' => $request->message,
                                    'customer_status' => 'Pending',
                                    'admin_status' => 'Viewed'
                                ]);
        if($paranetMessage->messages()->save($msgData)){
            return json_encode(array("success"=>true,'message' => "Message Send Successfully."));
        }
        //return redirect(route('message.index'))->with(['success'=>trans('messages.message_send_success')]);
    }

    public function csv(Request $request, User $user)
    {
        $table = $user->with(['country'])->get();
        $filename = "user.csv";
        $handle = fopen($filename, 'w+');
        //dd($table->toArray());
        fputcsv($handle, array('S.No','Name','Email','Phone','Country'));
        $i=1;
        foreach($table as $row) {
            fputcsv($handle, array($i,@$row->full_name, @$row->email, '+'.@$row->dial_code.'-'.@$row->mobile, @$row->country->name));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return \Response::download($filename, 'user.csv', $headers);
    }
}

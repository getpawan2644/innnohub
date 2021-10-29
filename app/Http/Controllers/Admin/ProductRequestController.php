<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductRequest;
use Illuminate\Http\Request;
use App\Models\Messages;
use App\Models\ParentMessage;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;

class ProductRequestController extends Controller
{
    public function index(Request $request){
        $date = (!empty($request->query('search')))?date('Y-m-d', strtotime($request->query('search'))):date('Y-m-d');
        $records = ProductRequest::with(['user','product'])
                    ->select(\DB::raw('DISTINCT prod_req_number,email,name, DATE(created_at) as created_at, dial_code, 	phone_number'))
                    ->whereDate('created_at',$date);
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT')));
        //dd($records->toArray());
        return view('admin.product-request.index', compact(['records']));
    }
    public function allRequest(Request $request, $email, $createDate){
        $date = (!empty($request->query('search')))?date('Y-m-d', strtotime($request->query('search'))):date('Y-m-d', strtotime($createDate));
        $records = ProductRequest::with(['user','product'])
                    ->where('email', $email)
                    ->whereDate('created_at',$date);
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
        return view('admin.product-request.all-request', compact(['records']));
    }

    public function allRequests(Request $request){
        $records = ProductRequest::with(['user','product'])->sortable(['id' => 'desc']);
        if(!empty($request->query('search'))){
            $records = $records->whereDate('created_at',date('Y-m-d', strtotime($request->query('search'))));
        }
        if($request->sort && $request->direction){
                $records->orderBy($request->sort,$request->direction );
        }else{
            $records->orderBy("id","DESC");
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
        //dd($records);
        return view('admin.product-request.requests', compact(['records']));
    }

    public function changeStatus(Request $request){
        //dd($request->all());
        $record = ProductRequest::findOrFail($request->id);
        $record->status = $request->status;
        if($record->save()){
           return json_encode(array("success"=>true,'message' => 'Status updated successfully'));
        }
    }
    public function message(Request $request){
        //dd($request->all());
        $request = $request->all();
        $record = ProductRequest::with(['user','product'])->findOrFail($request['id']);
        if(!empty($record->user)) {
            $html = view('admin.product-request.popup.msg-popup')->with(compact(['record']))->render();
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
            $record = ProductRequest::with(['user','product'])->findOrFail($request->request_id);
            $html = view('admin.product-request.popup.msg-popup')->with(compact(['input','record']))->withErrors($errors)->render();
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

    public function csv(Request $request)
    {
        $table = ProductRequest::with(['user','product'])->get();
        $filename = "product_request.csv";
        $handle = fopen($filename, 'w+');
        //dd($table->toArray());
        fputcsv($handle, array('S.No','User Name','Email','Phone',' Item Requested','Quantity'));
        $i=1;
        foreach($table as $row) {
            fputcsv($handle, array($i,@$row->user->full_name, @$row->user->email, '+'.@$row->user->dial_code.'-'.@$row->user->mobile,@$row->product->product_title,@$row->quantity));
            $i++;
        }

        fclose($handle);

        $headers = array(
            'Content-Type' => 'text/csv',
        );
        return \Response::download($filename, 'product_request.csv', $headers);
    }
}

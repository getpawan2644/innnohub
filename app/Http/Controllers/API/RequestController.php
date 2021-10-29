<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Mail\OrderRequestAdminAlert;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\ProductRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class RequestController extends Controller
{
    public $successStatus = 200;
    public function index(Request $request){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $user =Auth::guard("api")->user();
        $email = $user->email;
        $user_id = $user->id;
        $records = ProductRequest::with(['user','product'])->where('user_id',$user_id)->orWhere('email',$email);
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('API_PAGINATION_LIMIT')));
        if($records){
            $response["status"]=1;
            $response["data"]=$records;
        }else{
//            $this->successStatus = 401;
            $response["status"]=0;
            $response["message"]=__("messages.records_not_available");
        }
        return response()->json($response, $this->successStatus);
    }

    public function productRequest(Request $request){
        //dd($request->all());
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $product_slug = $request->product_slug;
        $messages = [
            'product_slug.required' => trans('validation.product_slug_required'),
            'name.required'  => trans('validation.name_required'),
            'dial_code.required'=>trans('validation.dial_code_required'),
            'phone_number.required'  => trans('validation.mobile_required'),
            'email.required'  => trans('validation.email_required'),
            'email.email'  => trans('validation.email_required'),
            'comments.required'  => trans('validation.comment_required'),
            'quantity.required' => trans('validation.quantity_required'),
        ];
        $errors = Validator::make($request->all(), [
            'product_slug' => 'required',
            'name' => 'required',
            'dial_code' => 'required',
            'phone_number' => 'required',
            'email' => array_filter(['required', 'string', 'email', 'max:100']),
            'comments' => 'required',
            'quantity' => 'required'
        ], $messages);

        if ($errors->fails())
        {
            $errors = $errors->errors();
            $this->successStatus = 406;
            $response['message'] = $errors->first();
            return response()->json($response, $this->successStatus);
        }
        //dd(Auth::id());
        $input = $request->all();
        $user =Auth::guard("api")->user();
        $input['user_id']=$request->user_id = @$user->id;
        $input['prod_req_number'] = date('y-m-d').'-'.substr(time(),-4);
        $productRequest = ProductRequest::Create($input);

        if($productRequest){
            $product = Product::where('slug', $input['product_slug'])->first();
            if(!empty(@$request->user_id)){
                $user = \App\Models\User::findOrFail(@$request->user_id);
                $this->sendEmailAlertAdmin("admin-order-request-alert",$input,$product,$user);
//                Mail::to(env('ADMIN_NOTIFY_EMAIL'))->cc('abhishek@braintechnosys.com')->send(new OrderRequestAdminAlert($input,$product,$user));
            }
            $response["status"]=1;
            $response["message"]=trans('messages.product_request_saved');

        } else {
            $response["status"]=0;
            $response["message"]=trans('messages.check_your_input');
            $this->successStatus = 200;
        }

        return response()->json($response, $this->successStatus);
    }

    public function cancelRequest(Request $request){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $record = ProductRequest::findOrFail($request->id);
        if($record){
        $record->status = 'Canceled';
        if($record->save()){
            $response["status"]=1;
            $response["message"]=__("messages.request_cancelled_success");
        } else {
//            $this->successStatus = 401;
            $response["message"]=__("messages.records_not_available");
        }
        }else{
//            $this->successStatus = 401;
            $response["message"]=__("messages.records_not_available");
        }
        return response()->json($response, $this->successStatus);
    }

    public function saveAllProdReq(Request $request){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $product_ref_number=date('d-m-y').'-'.substr(time(),-4);
        if(!empty($request->data)){
            $i=0;
            $prod_req=array();
            foreach ($request->data as $req_data){
                $prod_req[$i]["user_id"]=Auth::guard("api")->user()->id;
                $prod_req[$i]["comments"]=$req_data['comment'];
                $prod_req[$i]["product_slug"]=$req_data['product_slug'];
                $prod_req[$i]["name"]=Auth::guard("api")->user()->first_name.' '.Auth::guard("api")->user()->last_name;
                $prod_req[$i]["dial_code"]=Auth::guard("api")->user()->dial_code;
                $prod_req[$i]["country_code"]=Auth::guard("api")->user()->country_id;
                $prod_req[$i]["phone_number"]=Auth::guard("api")->user()->mobile;
                $prod_req[$i]["email"]=Auth::guard("api")->user()->email;
                $prod_req[$i]["prod_req_number"]=$product_ref_number;
                $prod_req[$i]["quantity"]=$req_data['quantity'];
                $i++;
            }
            ProductRequest::insert($prod_req);
            $response["status"]=1;
            $response["message"]=trans('messages.request_saved_success');
        }else{
            $this->successStatus = 200;
            $response["message"]=__("messages.something_went_wrong");
        }
//        dd($request->prod_req);
//        if(ProductRequest::insert($request->prod_req)){
//            return redirect(route('favorites.index'))->with(['success'=>trans('messages.request_saved_success')]);
//        }else{
//            return back()->with(['error'=>trans('messages.something_went_wrong')]);
//        }
        return response()->json($response, $this->successStatus);
    }

    public function sendEmailAlertAdmin($pageName,$input,$product,$user){
        $allEmailTemp = EmailTemplate::allEmailTemplate($pageName);
        $englishSubject = $allEmailTemp->translateOrDefault("en")->title;
        $englishContent = $allEmailTemp->translateOrDefault("en")->content;
        $arabicSubject = $allEmailTemp->translateOrDefault("ar")->title;
        $arabicContent = $allEmailTemp->translateOrDefault("ar")->content;
        $englishContent = str_replace(["{user_name}"], [$user->first_name.' '.$user->last_name], $englishContent);
        $englishContent = str_replace(["{customer_mobile}"], ['+'.$user->dial_code.'-'.$user->mobile], $englishContent);
        $englishContent = str_replace(["{customer_email}"], [$user->email], $englishContent);
        $englishContent = str_replace(["{product_quantity}"], [$input['quantity']], $englishContent);
        $separator="<br/>-----------------------------------------------------------------------------<br/>";
        $arabicContent = str_replace(["{customer_name}"], [$user->first_name.' '.$user->last_name], $arabicContent);
        $arabicContent = str_replace(["{customer_mobile}"], ['+'.$user->dial_code.'-'.$user->mobile], $arabicContent);
        $arabicContent = str_replace(["{customer_email}"], [$user->email], $arabicContent);
        $arabicContent = str_replace(["{product_quantity}"], [$input['quantity']], $arabicContent);
        $message=$englishContent.$separator.$arabicContent;
        Mail::to(env('ADMIN_NOTIFY_EMAIL'))->send(new OrderRequestAdminAlert($englishSubject,$message,$product,$input));
    }
}

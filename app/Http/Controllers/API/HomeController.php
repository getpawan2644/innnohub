<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Models\Cms;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\Models\Contacts;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use DB;

class HomeController extends Controller
{
    public $successStatus = 200;
    public function index(){
        $response["status"] = 0;
        $response["message"] = "";
        $response["data"] = array();
        $temp['trending_category_list'] = $this->getTrendingCategoryListName();
        $temp['best_offer_category_list'] = $this->getBestOfferCategoryListName();
        $temp['bestOffer'] = \App\Models\Product::fetchProductsByCategory(@$temp['best_offer_category_list'][0]['slug'],"trending_sale");
        $temp['trendingProd'] = \App\Models\Product::fetchProductsByCategory(@$temp['trending_category_list'][0]['slug'],"best_offer");
        $temp['topBanner'] = \App\Models\Banner::getTopBanners();
        $temp['middleBanner'] = \App\Models\Banner::getMiddleBanner();
        $temp['bottomBanner'] = \App\Models\Banner::getBottomBanner();
        $temp['advertisements']=\App\Models\Advertisement::getAdvertisements();
        $cms = \App\Models\Cms::allServiceCms();
        $i=1;
        $a=null;
        foreach($cms as $page){
            $temp1["title"]=$page->title;
            $temp1["page_name"]=$page->page_name;
            $a[]=$temp1;
        }
        $temp['services']=$a;
        //pr($response); die;
        $response["status"] = 1;
        $response["data"]=$temp;
        return response()->json($response, $this->successStatus);
    }

    public function getTrendingCategoryListName(){
        $category=\App\Models\Category::getTrendingCategoryList();
        $record=null;
        $i=0;
        if($category->count()>0){
            foreach ($category as $data){
                $record[$i]["id"]=$data->id;
                $record[$i]["name"]=$data->name;
                $record[$i]["slug"]=$data->slug;
                $i++;
            }
        }
        return $record;
    }

    public function getBestOfferCategoryListName(){
        $category=\App\Models\Category::getOffersCategoryList();
        $record=null;
        $i=0;
        if($category->count()>0){
            foreach ($category as $data){
                $record[$i]["id"]=$data->id;
                $record[$i]["name"]=$data->name;
                $record[$i]["slug"]=$data->slug;
                $i++;
            }
        }
        return $record;
    }

    public function services(Request $request) {
        $response["status"] = 0;
       $response["message"] = "";
        $response["data"] = null;
//        dd($request->page_name);
        $page = Cms::where('page_name', $request->page_name)->first();
       //dd($page);
        if(!empty($page)){
           $response["status"]=1;
            $response['data'] = html_entity_decode($page->content);
            $status = 200;
        } else {
            $status = 200;
            $response["status"]=0;
            $response["message"]=__("messages.records_not_available");
        }
       //echo json_encode($response);die;
        return response()->json($response, 200);
    }
    public function trendingProd() {

        $response["status"] = 0;
        $response["message"] = "";
        $response["data"] = array();
        $records = \App\Models\Product::fetchTrendingProducts();
        if(!empty($records)){
            $response["status"]=1;
            $response["data"] = $records;
            $status = 200;
        } else {
            $status = 200;
            $response["status"]=0;
            $response["message"]=__("messages.records_not_available");
        }
        return response()->json($response, 200);
    }
    public function settings() {

        $response["status"] = 1;
        $response["message"] = "";
        $response["data"]["site_settings"] = \App\Models\Settings::site_settings();
        $response["data"]["social_links"] = \App\Models\Settings::social_links();
        return response()->json($response, 200);
    }

    public function contactUs(Request $request, Contacts $contacts){
        //dd($request->all());
        $requestData = $request->all();
        $messages = [
            'name.required'  => trans('validation.name_required'),
            'dial_code.required'=>trans('validation.dial_code_required'),
            'phone_number.required'  => trans('validation.mobile_required'),
            'email.required'  => trans('validation.email_required'),
            'email.email'  => trans('validation.email_required'),
            'message.required' => trans('validation.message_required'),
        ];
        $errors = Validator::make($request->all(), [
            'name' => 'required',
            'dial_code' => 'required',
            'phone_number' => 'required',
            'email' => array_filter(['required', 'string', 'email', 'max:100']),
            'message' => 'required',
        ], $messages);

        if ($errors->fails())
        {
            $errors = $errors->errors();
            $status = 200;
            $response['error'] = $errors->first();
            return response()->json($response, $status);
        }else{
            $requestData['user_id'] = Auth::guard("api")->id();
            $contacts->fill($requestData);
            try{
                DB::beginTransaction();
                $contacts->save();
                DB::commit();
                //Mail::to($user->email)->send(new UserRegister());
                $status = 200;
                $response["status"]=1;
                $response["message"]=__('messages.message_send_success');
            } catch(\Exception $e){
                echo $e->getMessage(); die;
                DB::rollBack();
                $status = 200;
                $response["status"]=0;
                $response["message"]=__('messages.check_your_input');
            }
            return response()->json($response, $status);
        }
    }
}

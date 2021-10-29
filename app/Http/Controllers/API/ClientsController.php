<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\ClientAnalytics;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\ClientImage;
use App\Models\ClientCategory;
use Auth;
class ClientsController extends Controller
{
    public $successStatus = 200;
    public function getCategories(){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $categories=\App\Models\ClientCategory::getClientCategoryList();
        $i=0;
        $temp_data=array();
        foreach($categories as $category){
            $temp_data["categories"][$i]["category_id"]=$category->id;
            $temp_data["categories"][$i]["name"]=$category->name;
            $i++;
        }
        if($temp_data){
            $response["status"]=1;
            $response["data"]=$temp_data;
        }else{
            $response["message"]=__("messages.records_not_available");
//            $this->successStatus=200;
        }
        //dd($categories->toArray());
        return response()->json($response, $this->successStatus);
    }

    public function listing(Request $request)
    {
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();

        $filter = $request->all();
        $records = Client::with(['ClientCategory'])->where('status', 'Active')->sortable(['id' => 'desc']);
        if(isset($filter['category']) && !empty($filter['category']) && $filter['category']!='all'){
            $records = $records->where('client_category_id', $filter['category']);
        }

        if(isset($filter['search']) && !empty($filter['search'])){
            $search=$filter['search'];
            $records = $records->where(function($q) use ($search) {
                $q->orWhereTranslationLike('name', '%'.ucfirst(trim($search)).'%');
                $q->orWhereTranslationLike('name', '%'.strtolower(trim($search)).'%');
                $q->orWhereTranslationLike('name', '%'.strtoupper(trim($search)).'%');
                $q->orWhereTranslationLike('name', '%'.trim($search).'%');
                $q->orWhereTranslationLike('description', '%'.trim($search).'%');
                $q->orWhereTranslationLike('description', '%'.ucfirst(trim($search)).'%');
                $q->orWhereTranslationLike('description', '%'.strtolower(trim($search)).'%');
                $q->orWhereTranslationLike('description', '%'.strtoupper(trim($search)).'%');
            });
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit') : env('PAGINATION_LIMIT')));
        if($records->count()>0){
            $i=0;
            foreach($records as $record){
                //dd($record->ClientCategory->name);
                $temp_data["clients"][$i]["name"]=@$record->name;
                $temp_data["clients"][$i]["id"]=@$record->id;
                $temp_data["clients"][$i]["category_name"]=@$record->ClientCategory->name;
                $temp_data["clients"][$i]["client_category_id"]=@$record->ClientCategory->id;
                $temp_data["clients"][$i]["status"]=@$record->status;
//                $temp_data["clients"][$i]["description"]=@$record->description;
                $temp_data["clients"][$i]["logo_thumbnail_url"]=@$record->logo_thumbnail_url;
                $temp_data["clients"][$i]["logo_image_url"]=@$record->logo_image_url;
                $i++;
            }
            $response["status"]=1;
            $response["data"]["clients"]=$temp_data;
        }else{
            $response["message"]=__("messages.records_not_available");
            $response["data"]["clients"]=array();
//            $this->successStatus=200;
        }
        return response()->json($response,  $this->successStatus);
    }

    public function details(Request $request){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $filter = $request->all();
        if(isset($filter['client_id']) && !empty($filter['client_id'])){
            $record = Client::with(['ClientCategory','ClientImage'])->where(['status'=> 'Active',"id"=>$filter['client_id']])->first();
            if($record){
                if(Auth::guard('api')->check()) {
                    $client_english = Client::with(['ClientCategory'])->where(['status' => 'Active', "id" => $filter['client_id']])->first();
                    $client_analytics = ClientAnalytics::where(["client_id" => $client_english->id, "user_id" => Auth::guard('api')->user()->id])->first();
                    if ($client_analytics) {
                        $client_analytics->number_of_visits = $client_analytics->number_of_visits + 1;
                        $client_analytics->user_name = Auth::guard('api')->user()->full_name;
                        $client_analytics->user_email = Auth::guard('api')->user()->email;
                        $client_analytics->user_number = "+" . Auth::guard('api')->user()->dial_code . ' ' . Auth::guard('api')->user()->mobile;
                        $client_analytics->client_title = $client_english->translate("en")->name;
                        $client_analytics->client_category = $client_english->ClientCategory->translate("en")->name;
                        $client_analytics->client_email = $client_english->email;
                        $client_analytics->save();
                    } else {
                        $data["user_id"] = Auth::guard('api')->user()->id;
                        $data["user_name"] = Auth::guard('api')->user()->full_name;
                        $data["user_email"] = Auth::guard('api')->user()->email;
                        $data["user_number"] = "+" . Auth::guard('api')->user()->dial_code . ' ' . Auth::guard('api')->user()->mobile;
                        $data["client_id"] = $client_english->id;
                        $data["client_title"] = $client_english->translate("en")->name;
                        $data["client_category"] = $client_english->ClientCategory->translate("en")->name;
                        $data["client_email"] = $client_english->email;
                        $data["number_of_visits"] = 1;
                        ClientAnalytics::create($data);
                    }
                }
                $temp_data["clients"]["id"]=@$record->id;
                $temp_data["clients"]["name"]=@$record->name;
                $temp_data["clients"]["category_name"]=@$record->ClientCategory->name;
                $temp_data["clients"]["client_category_id"]=@$record->ClientCategory->id;
                $temp_data["clients"]["phone"]=@$record->phone;
                $temp_data["clients"]["email"]=@$record->email;
                $temp_data["clients"]["country_code"]=@$record->country_code;
                $temp_data["clients"]["dial_code"]=@$record->dial_code;
                $temp_data["clients"]["website"]=@$record->website;
                $temp_data["clients"]["address"]=@$record->address;
                $temp_data["clients"]["country"]=@$record->country;
                $temp_data["clients"]["latitude"]=@$record->latitude;
                $temp_data["clients"]["longitude"]=@$record->longitude;
                $temp_data["clients"]["description"]=@$record->description;
                $temp_data["clients"]["logo_thumbnail_url"]=@$record->logo_thumbnail_url;
                $temp_data["clients"]["logo_image_url"]=@$record->logo_image_url;
                $i=0;
                $temp_data["clients"]["project_image"]=array();
                if($record->ClientImage->count()){
                    foreach ($record->ClientImage as $client_image) {
                        $temp_data["clients"]["project_image"][$i]["image_url"]=$client_image['image_url'];
                        $temp_data["clients"]["project_image"][$i]["thumbnail_url"]=$client_image['thumbnail_url'];
                        $i++;
                    }
                }
                $response["status"]=1;
            $response["data"]= $temp_data;
            }else{
                $response["message"]=__("messages.records_not_available");
//                $this->successStatus=200;
            }
        }else{
            $response["message"]=__("messages.client_id_null");
            $this->successStatus=200;
        }
        return response()->json($response,  $this->successStatus);
    }
}

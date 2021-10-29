<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAnalytics;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\SaveFavorite;
use App\Models\ProductRequest;
use App\Models\InviteReview;
use App\Models\User;
use App\Mail\OrderRequestAdminAlert;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class ProductsController extends Controller
{
    //Api for
    public $successStatus = 200;
    public function index(Request $request)
    {
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $filter = $request->all();
        $records = Product::select([
            'products.*',
            'rating' => InviteReview::selectRaw('IFNULL(CEIL(AVG(rating)),0)')
                    ->whereColumn('product_slug', 'products.slug')->whereNotNull('rating')
        ])->with(['category','subcategory','latestImage'])->where('status', 'Active')->sortable(['id' => 'desc']);
        if(isset($filter['category']) && !empty($filter['category']) && $filter['category']!='all'){
            $records = $records->where('category_slug', $filter['category']);
        }
        if(isset($filter['subcategory']) && !empty($filter['subcategory']) && $filter['subcategory']!='all'){
            $records = $records->where('subcategory_id', $filter['subcategory']);
        }
        if(isset($filter['search']) && !empty($filter['search'])){
            $search = $filter['search'];
            $records = $records->whereHas('ProductTranslation', function (Builder $query) use($search) {
                $query->WhereRaw('MATCH(product_title,product_details,product_description) AGAINST("'.$search.'")');
                $query->orWhere('product_title','like','%'.$search.'%');
                $query->orWhere('product_details','like','%'.$search.'%');
                $query->orWhere('product_description','like','%'.$search.'%');
            });
            $records = $records->orWhereHas('client', function(Builder $query) use($search) {
                $query->whereTranslationLike('name', '%'.$search.'%');
            });
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit') : env('API_PAGINATION_LIMIT')));
        if($records){
            $response["status"]=1;
            $response["data"]=$records;
            $status = 200;
        }else{
            $status = 200;
            $response["message"]=__("messages.records_not_available");
        }
        return response()->json($response, $status);
    }

    public function productDetails(Request $request){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        if(Auth::guard('api')->check()){
            $product_english= Product::with(['category','subcategory'])
                ->where(['status'=>'Active',"slug"=>$request->product_slug])
                ->whereHas('category', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })
                ->whereHas('subcategory', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })
                ->whereHas('vendor', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })
                ->whereHas('vendor.country', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })
                ->first();
            $product_analytics=ProductAnalytics::where(["product_id"=>$product_english->id,"user_id"=> Auth::guard('api')->user()->id])->first();
            if($product_analytics){
                $product_analytics->number_of_visits = $product_analytics->number_of_visits+1;
                $product_analytics->user_name = Auth::guard('api')->user()->full_name;
                $product_analytics->user_email = Auth::guard('api')->user()->email;
                $product_analytics->user_number = "+".Auth::guard('api')->user()->dial_code.' '.Auth::guard('api')->user()->mobile;
                $product_analytics->product_title =$product_english->translate("en")->product_title;
                $product_analytics->product_category =$product_english->category->translate("en")->name;
                $product_analytics->product_sub_category =$product_english->subcategory->translate("en")->name;
                $product_analytics->save();
            }else{
                $data["user_id"]=  Auth::guard('api')->user()->id;
                $data["user_name"]=  Auth::guard('api')->user()->full_name;
                $data["user_email"]=  Auth::guard('api')->user()->email;
                $data["user_number"]=  "+".Auth::guard('api')->user()->dial_code.' '.Auth::guard('api')->user()->mobile;
                $data["product_id"]=  $product_english->id;
                $data["product_title"]=  $product_english->translate("en")->product_title;
                $data["product_category"]=  $product_english->category->translate("en")->name;
                $data["product_sub_category"]= $product_english->subcategory->translate("en")->name;
                $data["number_of_visits"]=  1;
                ProductAnalytics::create($data);
            }
        }

        Product::where('slug', $request->product_slug)->update([
            'view_count'=> \DB::raw('view_count+1'),
        ]);
        $record = Product::select([
            'products.*',
            'rating' => InviteReview::selectRaw('IFNULL(CEIL(AVG(rating)),0)')
                    ->whereColumn('product_slug', 'products.slug')->whereNotNull('rating')
        ])->with(['category', 'ProductImage', 'favorite'])
            ->where(['status'=>'Active',"slug"=>$request->product_slug])
            ->whereHas('category', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })->whereHas('subcategory', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })
            ->whereHas('vendor', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })->whereHas('vendor.country', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })
            ->first();
        if($record){
            $response["status"]=1;
            $response["data"]=$record;
        }else{
//            $this->successStatus = 200;
            $response["message"]=__("messages.records_not_available");
        }
        return response()->json($response, $this->successStatus);
    }



    public function getCategories(){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $categories=\App\Models\Category::getCategoryList();
        $i=0;
        $temp_data=array();
        foreach($categories as $category){
            $temp_data["categories"][$i]["category_id"]=$category->id;
            $temp_data["categories"][$i]["name"]=$category->name;
            $temp_data["categories"][$i]["slug"]=$category->slug;
            $temp_data["categories"][$i]["category_icon"]=$category->category_icon;
            $temp_data["categories"][$i]["category_icon_thumbnail"]=$category->category_icon_thumbnail;
            $temp_data["categories"][$i]["thumbnail_url"]=$category->thumbnail_url;
            $temp_data["categories"][$i]["image_url"]=$category->image_url;
            $j=0;
            $temp_data["categories"][$i]["sub_categories"]=array();
            if($category->sub_categories){
               foreach ($category->sub_categories as $sub_category){
                   $temp_data["categories"][$i]["sub_categories"][$j]["sub_category_id"]=$sub_category->id;
                   $temp_data["categories"][$i]["sub_categories"][$j]["name"]=$sub_category->name;
                  // $temp_data["categories"][$i]["sub_categories"][$j]["slug"]=$sub_category->slug;
                   $j++;
               }
            }
            $i++;
        }
        if($temp_data){
            $response["status"]=1;
            $response["data"]=$temp_data;
        }else{
            $response["message"]=__("messages.records_not_available");
//            $this->successStatus = 200;
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
        $response["data"]["sub_categories"]=array();
        $records = Product::select([
            'products.*',
            'rating' => InviteReview::selectRaw('IFNULL(CEIL(AVG(rating)),0)')
                    ->whereColumn('product_slug', 'products.slug')->whereNotNull('rating')
        ])->with(['category','subcategory','latestImage'])
            ->whereHas('category', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })->whereHas('subcategory', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })
            ->whereHas('vendor', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })->whereHas('vendor.country', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })->where('status', 'Active')->sortable(['id' => 'desc']);
        if(isset($filter['category']) && !empty($filter['category']) && $filter['category']!='all'){
            $records = $records->where('category_slug', $filter['category']);

            $sub_categories=\App\Models\SubCategory::whereHas('category', function ($query) use($filter) {
                $query->Where('slug', 'like', '%'.$filter['category'].'%');
            })->get()->toArray();
            if(!empty($sub_categories)){
                $i=0;
                foreach($sub_categories as $sub_category){
                    //dd($sub_category);
                    $response["data"]["sub_categories"][$i]["sub_categoory_id"]=$sub_category["id"];
                    $response["data"]["sub_categories"][$i]["name"]=$sub_category['name'];
                }
            }else{
                $response["data"]["sub_categories"]=array();
            }

        }
        if(isset($filter['subcategory']) && !empty($filter['subcategory']) && $filter['subcategory']!='all'){
            $records = $records->where('subcategory_id', $filter['subcategory']);
        }
        if(isset($filter['search']) && !empty($filter['search'])){
            $search = $filter['search'];
            $records = $records->whereHas('ProductTranslation', function (Builder $query) use($search) {
                $query->WhereRaw('MATCH(product_title,product_details,product_description) AGAINST("'.$search.'")');
            });
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit') : env('PAGINATION_LIMIT')));
        if($records->count()>0){
            $i=0;
            foreach($records as $record){
                //dd($record->latestImage->thumbnail_url);
                $temp_data["products"][$i]["id"]=@$record->id;
                $temp_data["products"][$i]["show_price"]=@$record->show_price;
                $temp_data["products"][$i]["price"]=@$record->price;
                $temp_data["products"][$i]["discount_percent"]=@$record->discount_percent;
                $temp_data["products"][$i]["slug"]=@$record->slug;
                $temp_data["products"][$i]["category_slug"]=@$record->category_slug;
                $temp_data["products"][$i]["category_name"]=@$record->category->name;
                $temp_data["products"][$i]["subcategory_id"]=@$record->subcategory_id;
                $temp_data["products"][$i]["subcategory_name"]=@$record->subcategory->name;
                $temp_data["products"][$i]["status"]=@$record->status;
                $temp_data["products"][$i]["youtube_url"]=@$record->youtube_url;
                $temp_data["products"][$i]["product_title"]=@$record->product_title;
                $temp_data["products"][$i]["product_details"]=@$record->product_details;
                $temp_data["products"][$i]["product_description"]=@$record->product_description;
                $temp_data["products"][$i]["thumbnail_url"]=@$record->latestImage->thumbnail_url;
                $temp_data["products"][$i]["image_url"]=@$record->latestImage->image_url;
                $i++;
            }
            $response["status"]=1;
            $response["data"]["products"]=$temp_data;
        }else{
            $response["data"]["products"]=array();
            $response["data"]["message"]=__("messages.records_not_available");
//            $this->successStatus=200;
        }
        return response()->json($response, $this->successStatus);
    }

    public function furniture(Request $request){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
//        $records = Category::with(['sub_categories.products', 'sub_categories.products.category','sub_categories.products.latestImage'])
//            ->whereHas('sub_categories', function (Builder $query) {
//                $query->where('status','Active');
//            })->where('status','Active')->orderByTranslation("name","ASC")->get();
        //return view('furniture.index',compact(['records']));
        $category=$request->category;
        $records = Category::with([ 'sub_categories.products.category','sub_categories.products.latestImage',
            'sub_categories' => function($query){
                $query->where('status','Active');
                $query->whereHas('products', function (Builder $query) {
                    $query->where('status','Active');
                    $query->whereHas('vendor', function (Builder $query) {
                        $query->where('status', '=', 'Active');
                        $query->whereHas('country', function (Builder $query) {
                            $query->where('status', '=', 'Active');
                        });
                    });
                    $query->where(function($query){
                        $query->orWhereHas('client', function (Builder $query) {
                            $query->where('clients.status', '=', 'Active');
                        });
                        $query->orWhereNull('products.client_id');
                    });
                });
            },
            'sub_categories.products' => function($q) {
                // Query the name field in status table
                $q->where('status', '=', "Active"); // '=' is optional
                $q->where(function($query){
                    $query->orWhereHas('client', function (Builder $query) {
                        $query->where('clients.status', '=', 'Active');
                    });
                    $query->orWhereNull('products.client_id');
                });
                $q->whereHas('vendor', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                    $query->whereHas('country', function (Builder $query) {
                        $query->where('status', '=', 'Active');
                    });
                });
            }
        ])
            ->whereHas('sub_categories', function (Builder $query) {
                $query->where('status','Active');
            })
            ->whereHas('sub_categories.products.vendor', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })->whereHas('sub_categories.products.vendor.country', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })->WhereHas('sub_categories.products', function (Builder $query) {
                $query->where(function($query){
                    $query->orWhereHas('client', function (Builder $query) {
                        $query->where('clients.status', '=', 'Active');
                    });
                    $query->orWhereNull('products.client_id');
                });

            })
            ->where('status','Active');
        if(!empty($category)){
            $records->where("categories.slug",$category);
        }
        $records = $records->orderByTranslation("name","ASC")->get();
        if(!empty($records)){
            $response["status"]=1;
            $response["data"]=$records;
        }else{
            $response["data"]["message"]=__("messages.records_not_available");
        }
        return response()->json($response, $this->successStatus);
    }
    public function getBestofferByCategory(Request $request){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $category_slug=@$request->category_slug;
        if($category_slug){
            $categories=\App\Models\Product::fetchProductsByCategory($category_slug,"best_offer");
            if($categories->count()>0){
                $response["status"]=1;
                $response["data"]=$categories->toArray();
            }else{
                $response["message"]=_("messages.records_not_available");
            }
        }else{
            $response["message"]="Please provide category slug.";
        }
        return response()->json($response, $this->successStatus);
    }

    public function getTrendingSalesByCategory(Request $request){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $category_slug=@$request->category_slug;
        if($category_slug){
            $categories=\App\Models\Product::fetchProductsByCategory($category_slug,"trending_sale");
            if($categories->count()>0){
                $response["status"]=1;
                $response["data"]=$categories->toArray();
            }else{
                $response["message"]=_("messages.records_not_available");
            }
        }else{
            $response["message"]="Please provide category slug.";
        }
        return response()->json($response, $this->successStatus);
    }


    public function getTrendingCategoryWithProduct(Request $request){
        $response["status"]=0;
        $response["message"]="";
        $response["data"]=array();
        $temp['trending_category_list'] = $this->getTrendingCategoryListName();
        $temp['trendingProd'] = \App\Models\Product::fetchProductsByCategory(@$temp['trending_category_list'][0]['slug'],"best_offer");
        $response["data"]=$temp;
        $response["status"]=1;
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
}

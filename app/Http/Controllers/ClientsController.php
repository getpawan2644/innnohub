<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ClientCategory;
use App\Models\InviteReview;
use App\Models\Product;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\ClientAnalytics;
use App\Models\ClientImage;
use Auth;

class ClientsController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function clientDetails(Request $request,$clientId=null)
    {
        if(Auth::check()){
            $client_english= Client::with(['ClientCategory'])->where(['status'=>'Active',"url_name"=>$clientId])->first();
            $client_analytics=ClientAnalytics::where(["client_id"=>$client_english->id,"user_id"=>Auth::user()->id])->first();
            //dd($client_analytics);
            if($client_analytics){
                $client_analytics->number_of_visits = $client_analytics->number_of_visits+1;
                $client_analytics->user_name = Auth::user()->full_name;
                $client_analytics->user_email = Auth::user()->email;
                $client_analytics->user_number = "+".Auth::user()->dial_code.' '.Auth::user()->mobile;
                $client_analytics->client_title =$client_english->translate("en")->name;
                $client_analytics->client_category =$client_english->ClientCategory->translate("en")->name;
                $client_analytics->client_email =$client_english->email;
                $client_analytics->save();
            }else{
                $data["user_id"]=  Auth::user()->id;
                $data["user_name"]=  Auth::user()->full_name;
                $data["user_email"]=  Auth::user()->email;
                $data["user_number"]=  "+".Auth::user()->dial_code.' '.Auth::user()->mobile;
                $data["client_id"]=  $client_english->id;
                $data["client_title"]=  $client_english->translate("en")->name;
                $data["client_category"]=  $client_english->ClientCategory->translate("en")->name;
                $data["client_email"]=  $client_english->email;
                $data["number_of_visits"]=  1;
                ClientAnalytics::create($data);
            }
        }
        if($clientId){
        $client = Client::with(['ClientImage','category'])->where(['status'=>'Active',"url_name"=>$clientId])->first();
            $client_id=$client->id;
            $records = Category::with([ 'sub_categories.products.category','sub_categories.products.latestImage',
                'sub_categories' => function($query)use($client_id){
                    $query->where('status','Active');
                    $query->whereHas('products', function (Builder $query) use($client_id){
                        $query->where('status','Active');
                        $query->where('client_id',$client_id);
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
                'sub_categories.products' => function($q) use($client_id) {
                    // Query the name field in status table
                    $q->where('status', '=', "Active"); // '=' is optional
                    $q->where('client_id', '=', $client_id); // '=' is optional
                    $q->whereHas('vendor', function (Builder $query) use($client_id) {
                        $query->where('status', '=', 'Active');
                        $query->whereHas('country', function (Builder $query){
                            $query->where('status', '=', 'Active');
                        });
                    });
                }
            ])
                ->whereHas('sub_categories', function (Builder $query) {
                    $query->where('status','Active');
                })
                ->whereHas('sub_categories.products.vendor', function (Builder $query) use($client_id){
                    $query->where('status', '=', 'Active');
                })->whereHas('sub_categories.products.vendor.country', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })->WhereHas('sub_categories.products', function (Builder $query) use($client_id){
                    $query->where('client_id', '=', $client_id);
                    $query->where(function($query){
                        $query->orWhereHas('client', function (Builder $query) {
                            $query->where('clients.status', '=', 'Active');
                        });
                        $query->orWhereNull('products.client_id');
                    });
                })
                ->where('status','Active');
            $records = $records->orderByTranslation("name","ASC")->get();
            if($client){
                return view('clients.details', compact(['client','records']));
            }else{
                return redirect(route('home'))->with(['error'=>trans('messages.something_went_wrong')]);
            }




//        $products = Product::select([
//                'products.*',
//                'rating' => InviteReview::selectRaw('IFNULL(CEIL(AVG(rating)),0)')
//                    ->whereColumn('product_slug', 'products.slug')->whereNotNull('rating')
//            ])->with(['category','subcategory','vendor','latestImage'])->where('status', 'Active')
//                ->whereHas('category', function (Builder $query) {
//                    $query->where('status', '=', 'Active');
//                })->whereHas('subcategory', function (Builder $query) {
//                    $query->where('status', '=', 'Active');
//                })
//                ->whereHas('vendor', function (Builder $query) {
//                    $query->where('status', '=', 'Active');
//                })->whereHas('vendor.country', function (Builder $query) {
//                    $query->where('status', '=', 'Active');
//                })->where("client_id",$clientId)->sortable(["id"=>"DESC"])->get();
//
//        //dd($client);
//            if($client){
//                return view('clients.details', compact(['client','products']));
//            }else{
//               // dd("sdljk");
//                return redirect(route('home'))->with(['error'=>trans('messages.something_went_wrong')]);
//            }
        }else{
            return redirect(route('home'))->with(['error'=>trans('messages.something_went_wrong')]);
        }
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function vendorDetails(Request $request,$vendor_url_name=null)
    {
//        if(Auth::check()){
//            $client_english= Client::with(['ClientCategory'])->where(['status'=>'Active',"id"=>$clientId])->first();
//            $client_analytics=ClientAnalytics::where(["client_id"=>$client_english->id,"user_id"=>Auth::user()->id])->first();
//            //dd($client_analytics);
//            if($client_analytics){
//                $client_analytics->number_of_visits = $client_analytics->number_of_visits+1;
//                $client_analytics->user_name = Auth::user()->full_name;
//                $client_analytics->user_email = Auth::user()->email;
//                $client_analytics->user_number = "+".Auth::user()->dial_code.' '.Auth::user()->mobile;
//                $client_analytics->client_title =$client_english->translate("en")->name;
//                $client_analytics->client_category =$client_english->ClientCategory->translate("en")->name;
//                $client_analytics->client_email =$client_english->email;
//                $client_analytics->save();
//            }else{
//                $data["user_id"]=  Auth::user()->id;
//                $data["user_name"]=  Auth::user()->full_name;
//                $data["user_email"]=  Auth::user()->email;
//                $data["user_number"]=  "+".Auth::user()->dial_code.' '.Auth::user()->mobile;
//                $data["client_id"]=  $client_english->id;
//                $data["client_title"]=  $client_english->translate("en")->name;
//                $data["client_category"]=  $client_english->ClientCategory->translate("en")->name;
//                $data["client_email"]=  $client_english->email;
//                $data["number_of_visits"]=  1;
//
//                ClientAnalytics::create($data);
//            }
//        }
        if($vendor_url_name){
            $vendor = Vendor::where(['status'=>'Active',"url_name"=>$vendor_url_name])->first();
            $vendor_id=$vendor->id;
            $records = Category::with([ 'sub_categories.products.category','sub_categories.products.latestImage',
                'sub_categories' => function($query)use($vendor_id){
                    $query->where('status','Active');
                    $query->whereHas('products', function (Builder $query) use($vendor_id){
                        $query->where('status','Active');
                        $query->where('vendor_id',$vendor_id);
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
                'sub_categories.products' => function($q) use($vendor_id) {
                    // Query the name field in status table
                    $q->where('status', '=', "Active"); // '=' is optional
                    $q->where('vendor_id', '=', $vendor_id); // '=' is optional
                    $q->whereHas('vendor', function (Builder $query) use($vendor_id) {
                        $query->where('status', '=', 'Active');
                        $query->whereHas('country', function (Builder $query){
                            $query->where('status', '=', 'Active');
                        });
                    });
                }
            ])
                ->whereHas('sub_categories', function (Builder $query) {
                    $query->where('status','Active');
                })
                ->whereHas('sub_categories.products.vendor', function (Builder $query) use($vendor_id){
                    $query->where('status', '=', 'Active');
                })->whereHas('sub_categories.products.vendor.country', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })->WhereHas('sub_categories.products', function (Builder $query) use($vendor_id){
                    $query->where('vendor_id', '=', $vendor_id);
                    $query->where(function($query){
                        $query->orWhereHas('client', function (Builder $query) {
                            $query->where('clients.status', '=', 'Active');
                        });
                        $query->orWhereNull('products.client_id');
                    });
                })
                ->where('status','Active');
            $records = $records->orderByTranslation("name","ASC")->get();
            if($vendor){
                return view('clients.vendor_details', compact(['vendor','records']));
            }else{
                return redirect(route('home'))->with(['error'=>trans('messages.something_went_wrong')]);
            }
        }else{
            return redirect(route('home'))->with(['error'=>trans('messages.something_went_wrong')]);
        }
    }

    public function clientList(Request $request)
    {
        $filter = $request->all();
        $breadcrumb=$search=@$filter['search'];
        $records = Client::with(['ClientImage','category'])->where(['status'=>'Active'])->sortable(['id' => 'desc']);
        if(isset($filter['client_category']) && !empty($filter['client_category'])){
            $client_category = ClientCategory::where(['status'=>'Active',"id"=>$filter['client_category']])->first();
            $breadcrumb=$client_category->name;
            $records->where("client_category_id",$filter['client_category']);
        }
        if(isset($filter['search']) && !empty($filter['search'])){
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
        $records = $records->paginate(($request->query('limit') ? $request->query('limit') : env('FRONT_PAGINATION_LIMIT')));
        return view('clients.index', compact(['records',"breadcrumb",'search']));
        //return redirect(route('home'))->with(['error'=>trans('messages.something_went_wrong')]);
    }


}

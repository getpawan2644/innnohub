<?php

namespace App\Http\Controllers;

use App\Mail\CustomerAppointmentAlert;
use App\Models\Client;
use App\Models\ProductAnalytics;
use App\Models\EmailTemplate;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductTranslation;
use App\Models\ProductRequest;
use App\Models\InviteReview;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Models\SaveFavorite;
use App\Mail\OrderRequestAdminAlert;
use App\Http\Requests\RatingRequest;
use Illuminate\Support\Facades\Mail;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request){
        $filter = $request->all();
        if(isset($filter["sort"])){
            $sort=explode("-",$filter["sort"]);
        }
        $records = Product::select([
                'products.*',
                'rating' => InviteReview::selectRaw('IFNULL(CEIL(AVG(rating)),0)')
                        ->whereColumn('product_slug', 'products.slug')->whereNotNull('rating')
            ])->with(['category','subcategory','vendor','latestImage'])->where('status', 'Active')
            ->whereHas('category', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })
            ->where(function($query){
                $query->orWhereHas('client', function (Builder $query) {
                    $query->where('clients.status', '=', 'Active');
                });
                $query->orWhereNull('products.client_id');
            })
            ->whereHas('subcategory', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })
            ->whereHas('vendor', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })->whereHas('vendor.country', function (Builder $query) {
                $query->where('status', '=', 'Active');
            });
//            ->sortable(['id' => 'desc']);
        if(isset($filter['category']) && !empty($filter['category']) && $filter['category']!='all'){
            $records = $records->where('category_slug', $filter['category']);
        }
        if(isset($filter['subcategory']) && !empty($filter['subcategory']) && $filter['subcategory']!='all'){
            $records = $records->where('subcategory_id', $filter['subcategory']);
        }
        if(isset($filter['search']) && !empty($filter['search'])){
            $search = $filter['search'];
            $records = $records->whereHas('ProductTranslation', function (Builder $query) use($search) {
                $query->WhereRaw('MATCH(product_title) AGAINST("'.$search.'")');
                $query->orWhere('product_title','like','%'.$search.'%');
//                $query->orWhere('product_details','like','%'.$search.'%');
//                $query->orWhere('product_description','like','%'.$search.'%');
            });
            $records = $records->orWhereHas('client', function(Builder $query) use($search) {
                $query->whereTranslationLike('name', '%'.$search.'%');
            });
        }
        if(isset($sort)){
            if($sort[0]=="product_title"){
              $records->orderByTranslation(strtolower($sort[0]),$sort[1]);
            }else{
                $records->orderBy(strtolower($sort[0]),$sort[1]);
            }
        }else{
            $records->orderBy("id","DESC");
        }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit') : env('FRONT_PAGINATION_LIMIT')));
        return view('products.index', compact(['records', 'filter']));
    }

    public function category(Request $request, $slug){
        return view('products.category');
    }
    public function requstProduct(Request $request){
        $product_slug = $request->product_slug;
        $html = view('products.popup.request_pro')->with(compact('product_slug'))->render();
        return response()->json(['success' => true, 'html' => $html]);
    }
    public function saveRequestProduct(Request $request){
        //dd($request->all());
        $product_slug = $request->product_slug;
        $user = Auth::user();
        $messages = [
            'name.required'  => trans('validation.name_required'),
            'phone_number.required'  => trans('validation.mobile_required'),
            'email.required'  => trans('validation.email_required'),
            'email.email'  => trans('validation.email_required'),
            'comments.required'  => trans('validation.comment_required'),
        ];
        $errors = Validator::make($request->all(), [
            'name' => 'required',
            'phone_number' => 'required',
            'email' => array_filter(['required', 'string', 'email', 'max:100']),
            'comments' => 'required'
        ], $messages);

        if ($errors->fails())
        {
            $input = $request->all();
            $html = view('products.popup.request_pro')->with(compact(['input', 'product_slug']))->withErrors($errors)->render();
            return response()->json(['success' => false, 'html' => $html]);
        }
        //dd(Auth::id());
        $input = $request->all();
        $product = Product::where('slug', $input['product_slug'])->first();
        $input['product_id']=$product->id;
        $input['user_id'] = Auth::id();
        $input['prod_req_number'] = date('d-m-y').'-'.substr(time(),-4);
//        dd($input);
        $productRequest = ProductRequest::Create($input);

        if($productRequest){
            $product = Product::where('slug', $input['product_slug'])->first();
            if(Auth::check()){
                $this->sendEmailAlertAdmin("admin-order-request-alert",$input,$product,$user);
//                Mail::to(env('ADMIN_NOTIFY_EMAIL'))->cc('abhishek@braintechnosys.com')->send(new OrderRequestAdminAlert($input,$product,$user));
            }else{

                $this->sendEmailAlertAdmin2("admin-order-request-alert",$input,$product,$user);
            }
            return json_encode(array("success"=>true,'message' => trans('content.product_request_saved')));
        }
    }
    public function saveFavorites(Request $request){
        if (Auth::check()) {
            if (SaveFavorite::where('product_id', $request->product_id)->first()) {
                $message = trans('messages.fav_pro_list_update');
            } else {
                $message = trans('messages.successfuly_marked_fav');
            }
            $flight = SaveFavorite::updateOrCreate(
                ['user_id' => Auth::user()->id, 'product_id' => $request->product_id],
                ['product_id' => $request->product_id]
            );
            return response()->json(['status' => true, 'message' => $message]);
        } else {
            return response()->json(['status' => false, 'message' => trans('messages.fav_login_error')]);
        }
    }

    public function singleProduct(Request $request){
        if(Auth::check()){
            $product_english= Product::with(['category','subcategory'])->where(['status'=>'Active',"slug"=>$request->product])
                ->whereHas('category', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })->whereHas('subcategory', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })->where(function($query){
                    $query->orWhereHas('client', function (Builder $query) {
                        $query->where('clients.status', '=', 'Active');
                    });
                    $query->orWhereNull('products.client_id');
                })
                ->whereHas('vendor', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })->whereHas('vendor.country', function (Builder $query) {
                    $query->where('status', '=', 'Active');
                })
                ->first();
            //dd($product_english->id);
            $product_analytics=ProductAnalytics::where(["product_id"=>$product_english->id,"user_id"=>Auth::user()->id])->first();
//            dd($product_english->translate("en")->product_title);
            if($product_analytics){
                $product_analytics->number_of_visits = $product_analytics->number_of_visits+1;
                $product_analytics->user_name = Auth::user()->full_name;
                $product_analytics->user_email = Auth::user()->email;
                $product_analytics->user_number = "+".Auth::user()->dial_code.' '.Auth::user()->mobile;
                $product_analytics->product_title =$product_english->translate("en")->product_title;
                $product_analytics->product_category =$product_english->category->translate("en")->name;
                $product_analytics->product_sub_category =$product_english->subcategory->translate("en")->name;
                $product_analytics->save();
            }else{
                $data["user_id"]=  Auth::user()->id;
                $data["user_name"]=  Auth::user()->full_name;
                $data["user_email"]=  Auth::user()->email;
                $data["user_number"]=  "+".Auth::user()->dial_code.' '.Auth::user()->mobile;
                $data["product_id"]=  $product_english->id;
                $data["product_title"]=  $product_english->translate("en")->product_title;
                $data["product_category"]=  $product_english->category->translate("en")->name;
                $data["product_sub_category"]= $product_english->subcategory->translate("en")->name;
                $data["number_of_visits"]=  1;
                ProductAnalytics::create($data);
            }
        }
        Product::where('slug', $request->product)->update([
            'view_count'=> \DB::raw('view_count+1'),
        ]);
        $record = Product::select([
            'products.*',
            'rating' => InviteReview::selectRaw('IFNULL(CEIL(AVG(rating)),0)')
                    ->whereColumn('product_slug', 'products.slug')->whereNotNull('rating')
        ])->with(['category', 'ProductImage', 'favorite'])->where('slug', $request->product)->where('status',"Active")
            ->whereHas('category', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })->whereHas('subcategory', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })
            ->whereHas('vendor', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })->whereHas('vendor.country', function (Builder $query) {
                $query->where('status', '=', 'Active');
            })->first();
        //dd($record->toArray());
        return view('products.single-product', compact(['record']));
    }

    public function allProdRequest(Request $request){
        $userId = Auth::id();
        $prod_req_number = date('d-m-y').'-'.substr(time(),-4);
        $records = SaveFavorite::with(['product.latestImage'])->where('user_id', $userId)->where('status',1)->get();
        return view('products.request-all-prod', compact(['records', 'prod_req_number']));
    }
    public function saveAllProdReq(Request $request){
//        dd($request->prod_req);
        if(ProductRequest::insert($request->prod_req)){
            return redirect(route('favorites.index'))->with(['success'=>trans('messages.request_saved_success')]);
        }else{
            return back()->with(['error'=>trans('messages.something_went_wrong')]);
        }
    }
    public function rateProduct(Request $request) {
        $token = $request->token;
        $record = InviteReview::with(['product'])->where('token',$token)->first();
        if(!empty($record) && !empty($record->product)) {
            return view('products.rate-product', compact(['record', 'token']));
        } else {
            return redirect(route('home'))->with(['error'=>trans('messages.something_went_wrong')]);
        }
    }

    public function saveRating(RatingRequest $request) {
        $token = $request->token;
        $record = InviteReview::with(['product'])->where('token',$token)->first();
        $record->rating = $request->rating;
        $record->comment = $request->comment;
        $record->token = null;
        if($record->save()) {
            return redirect(route('home'))->with(['success'=>trans('messages.rating_saved_success')]);
        } else {
            return back()->with(['error'=>trans('messages.something_went_wrong')]);
        }
    }
    public function sendEmailAlertAdmin($pageName,$input,$product,$user){
        $allEmailTemp = EmailTemplate::allEmailTemplate($pageName);
        $englishSubject = $allEmailTemp->translateOrDefault("en")->title;
        $englishContent = $allEmailTemp->translateOrDefault("en")->content;
        $arabicSubject = $allEmailTemp->translateOrDefault("ar")->title;
        $arabicContent = $allEmailTemp->translateOrDefault("ar")->content;
        $englishContent = str_replace(["{user_name}"], [$user->first_name.' '.$user->last_name], $englishContent);
        $englishContent = str_replace(["{user_mobile}"], ['+'.$user->dial_code.'-'.$user->mobile], $englishContent);
        $englishContent = str_replace(["{user_email}"], [$user->email], $englishContent);
        $englishContent = str_replace(["{product_code}"], [$product->product_code], $englishContent);
        $englishContent = str_replace(["{product_quantity}"], [$input['quantity']], $englishContent);
        $separator="<br/>-----------------------------------------------------------------------------<br/>";
        $arabicContent = str_replace(["{user_name}"], [$user->first_name.' '.$user->last_name], $arabicContent);
        $arabicContent = str_replace(["{user_mobile}"], [' '.$user->dial_code.'-'.$user->mobile], $arabicContent);
        $arabicContent = str_replace(["{user_email}"], [$user->email], $arabicContent);
        $arabicContent = str_replace(["{product_code}"], [$product->product_code], $arabicContent);
        $arabicContent = str_replace(["{product_quantity}"], [strval($input['quantity'])], $arabicContent);
        $arabicContent="<div dir='rtl'>".$arabicContent."</div>";
        $message=$englishContent.$separator.$arabicContent;
        Mail::to(env('ADMIN_NOTIFY_EMAIL'))->cc(env('CC_EMAIL'))->send(new OrderRequestAdminAlert($englishSubject,$message,$product,$input));
    }
    public function sendEmailAlertAdmin2($pageName,$input,$product,$user){
        $allEmailTemp = EmailTemplate::allEmailTemplate($pageName);
        $englishSubject = $allEmailTemp->translateOrDefault("en")->title;
        $englishContent = $allEmailTemp->translateOrDefault("en")->content;
        $arabicSubject = $allEmailTemp->translateOrDefault("ar")->title;
        $arabicContent = $allEmailTemp->translateOrDefault("ar")->content;
        $englishContent = str_replace(["{user_name}"], [$input['name']], $englishContent);
        $englishContent = str_replace(["{user_mobile}"], ['+'.$input['dial_code'].'-'.$input['phone_number']], $englishContent);
        $englishContent = str_replace(["{user_email}"], [$input['email']], $englishContent);
        $englishContent = str_replace(["{product_code}"], [$product->product_code], $englishContent);
        $englishContent = str_replace(["{product_quantity}"], [$input['quantity']], $englishContent);
        $separator="<br/>-----------------------------------------------------------------------------<br/>";
        $arabicContent = str_replace(["{user_name}"], [$input['name']], $arabicContent);
        $arabicContent = str_replace(["{user_mobile}"], ['+'.$input['dial_code'].'-'.$input['phone_number']], $arabicContent);
        $arabicContent = str_replace(["{user_email}"], [$input['email']], $arabicContent);
        $arabicContent = str_replace(["{product_code}"], [$product->product_code], $arabicContent);
        $arabicContent = str_replace(["{product_quantity}"], [strval($input['quantity'])], $arabicContent);
        $arabicContent="<div dir='rtl'>".$arabicContent."</div>";
        $message=$englishContent.$separator.$arabicContent;
//        dd($message);
        Mail::to(env('ADMIN_NOTIFY_EMAIL'))->cc(env('CC_EMAIL'))->send(new OrderRequestAdminAlert($englishSubject,$message,$product,$input));
    }
}

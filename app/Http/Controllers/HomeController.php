<?php

namespace App\Http\Controllers;

use App\Mail\ContactUsAdminAlert;
use App\Models\Cms;
use App\Models\EmailTemplate;
use App\Models\Faq;
use App\Models\Service;
use App\Models\User;
use App\Models\ServiceCategory;
use App\Models\Testimonial;
use App\Models\SubCategory;
use App\Models\PrivacyPolicy;
use App\Models\TermCondition;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Contacts;
use App\Models\Category;
use App\Models\Multimedia;
use App\Models\CaseStudy;
use App\Models\Feature;
use App\Models\Award;
use App\Models\ProductTranslation;
use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Mail;
use Log;

class HomeController extends Controller
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
    

       public function index()
    {
    	try{
	        $service = User::where('user_type','vendor')->orderBy('id','Desc')->get()->toArray();
	        return view('home.index',compact('service'));
        }catch(\Exception $e){
    		Log::error($e->getMessage());
    		return redirect()->back()->with('Error','Someting Went wrong');
    	}
    }

    public function servicedetails($id)
    { 
    	try{
    		$service=Service::with('serviceCat')->find($id);
            return view('home.serviceDetails',compact('service'));
    	}catch(\Exception $e){
    		Log::error($e->getMessage);
    		return redirect()->back()->with('Error','Someting wrong wrong');
    	}
         
    }

     public function vendorProfile($id)
    {
    	try{
	         $user=User::find($id);
	         $testimonial=Testimonial::where('user_id',$user->id)->orderBy('id','Desc')->get()->toArray();
	         $service = Service::where('user_id',$user->id)->orderBy('id','Desc')->get()->toArray();
	         $multimedia=Multimedia::where('user_id',$user->id)->orderBy('id','desc')->get()->toArray();
	         $casestudy=CaseStudy::where('user_id',$user->id)->orderBy('id','desc')->get()->toArray();
             $award=Award::where('user_id',$user->id)->orderBy('id','desc')->get()->toArray();
             $feature=Feature::where('user_id',$user->id)->first();
	        return view('home.vendorProfile',compact('user','service','multimedia','casestudy','testimonial','award','feature'));
        }catch(\Exception $e){
           Log::error($e->getMessage());
           return redirect()->back()->with('Error','Someting Went wrong');
    	}
    }

    public function categorylist(Request $request)
    {
    	try{
    		$cat=$request->name;
	        $service = User::where('user_type','vendor')->orderBy('id','Desc')->get()->toArray();
	        $category=Category::with('sub_categories')->get()->toArray();
        return view('home.categories-list',compact('category','cat'));
    	}catch(\Exception $e){
    		Log::error($e->getMessage);
    		return redirect()->back()->with('Error','Someting wrong wrong');
    	}
        
    }


         public function viewservices(Request $request)
    {
       $searchString = $request->input('search');
         $service = User::query();
            if($request->query('search')){
                    
                  $sub= SubCategory::where('name',$request->input('search'))->first();
                   $cat= Category::where('slug',$request->input('search'))->first();
                   $service->where('user_type','vendor');
                    $service->whereRaw("concat(first_name, ' ', last_name) like '%$searchString%'");
                   if(!empty($cat)){
                      $service->orWhere('category_id','like','%'.$request->input('search').'%');
                   }
                   if(!empty($sub)){
                   $category=Category::where('id',$sub->category_id)->first();
                   }else{
                    $category='';
                   }
                       if(!empty($sub)){
                         $service->orwhereRaw('FIND_IN_SET("'.$sub->id.'",subcategory_id)');
                          }
                
             }
            $service = $service->where('user_type','vendor')->orderBy('id','Desc')->sortable()->paginate(env('PAGINATION_LIMIT'));
    
        return view('home.services',compact('service','category'));
    }

    

     



    public function page($page_name)
    {   if(in_array($page_name,\App\Models\Cms::NOT_EDITABLE_PAGE)){
            if($page_name==\App\Models\Cms::PAGE_NAME_FAQ) {
                $records = Faq::where(['status' => 'Active'])->get();
                $page_details = Cms::where('page_name', $page_name)->firstOrFail();
                return view('home.faq', compact(['records','page_details']));
            }else if($page_name==\App\Models\Cms::PAGE_TERMS_CONDITIONS){
                $records = TermCondition::where(['status' => 'Active'])->get();
                $page_details = Cms::where('page_name', $page_name)->firstOrFail();
                return view('home.dropdown_cms', compact(['records','page_details']));
            }elseif($page_name==\App\Models\Cms::PAGE_PRIVACY_POLICY){
                $records = PrivacyPolicy::where(['status' => 'Active'])->get();
                $page_details = Cms::where('page_name', $page_name)->firstOrFail();
                return view('home.dropdown_cms', compact(['records','page_details']));
            }
        }else{
            $page = Cms::where('page_name', $page_name)->firstOrFail();
            return view('home.page', compact('page'));
        }
    }
//    public function contact(){
//
//        return view('home.contact');
//    }
    public function saveContact(ContactRequest $request, Contacts $contacts){
        //dd($request->validated());
        $requestData = $request->validated();
        if(Auth::check()){
            $requestData['user_id'] = Auth::id();
        }
        $contacts->fill($requestData);
        try{
            DB::beginTransaction();
            $contacts->save();
            DB::commit();
            $this->sendAdminEmailAlert("contact-us-admin",$request->all());
            //Mail::to($user->email)->send(new UserRegister());
            return back()->with(['title'=>__('messages.success'),'success'=>__('messages.message_send_success')]);
        } catch(\Exception $e){
            echo $e->getMessage(); die;
            DB::rollBack();
            return back()->with(['title'=>__('messages.error'),'error'=>__('messages.check_your_input')]);
        }
    }
    public function sendAdminEmailAlert($pageName,$input){
        $allEmailTemp = EmailTemplate::allEmailTemplate($pageName);
        $englishSubject = $allEmailTemp->translateOrDefault("en")->title;
        $englishContent = $allEmailTemp->translateOrDefault("en")->content;
        $arabicContent = $allEmailTemp->translateOrDefault("ar")->content;
        $englishContent = str_replace(["{user_name}"], [$input["name"]], $englishContent);
        $englishContent = str_replace(["{user_mobile}"], ['+'.$input["dial_code"].'-'.$input["phone_number"]], $englishContent);
        $englishContent = str_replace(["{user_email}"], [$input["email"]], $englishContent);
        $englishContent = str_replace(["{query}"], [nl2br($input["message"])], $englishContent);
        $saperotor="<br/>-------------------------------------------------------------------<br/>";
        $arabicContent = str_replace(["{user_name}"], [$input["name"]], $arabicContent);
        $arabicContent = str_replace(["{user_mobile}"], ['+'.$input["dial_code"].'-'.$input["phone_number"]], $arabicContent);
        $arabicContent = str_replace(["{user_email}"], [$input["email"]], $arabicContent);
        $arabicContent = str_replace(["{query}"], [nl2br($input["message"])], $arabicContent);
        $message=$englishContent.$saperotor.$arabicContent;
        Mail::to(env('ADMIN_NOTIFY_EMAIL'))->cc(env('CC_EMAIL'))->send(new ContactUsAdminAlert($englishSubject,$message));
    }
}

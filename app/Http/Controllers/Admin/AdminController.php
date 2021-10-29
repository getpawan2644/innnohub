<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Mail\SubadminCredentialsMail;
use App\Models\Admin;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Admin\SubadminRequest;
 use App\Models\Service;
use App\Http\Requests\ServicesRequest;
use File;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Admin $admin)
    {
        $records = $admin->where('role','Sub-Admin')->sortable(['id' => 'desc']);

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->Where('name', 'like', '%'.$request->query('search').'%');
                $q->orWhere('email', 'like', '%'.$request->query('search').'%');
                $q->orWhere('phone', 'like', '%'.$request->query('search').'%');
            });
        }

        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
        return view ('admin.admins.index',['records'=>$records]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $record = new Admin;
         
        return view('admin.admins.create', compact(['record']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SubadminRequest $request)
    {
        $validated = $request->validated();
        $modules=array();
       // dd($validated["modules"]);
        /* Implode the inner functionality like view/add / edit / delete or full admin access via '@' keyword */
//        foreach($validated["modules"] as $key=>$value){
//            $modules[$key]=implode("@",$value);
//        }
//        /* Implode the main modules routes like Country,Category,Users,product etc. via '$' keyword */
//        $validated["modules"]=lode("@",$value);;
        $allow_routes=implode("$",$validated["modules"] );
        $admin = \App\Models\Admin::create(
            array(
                'name'         =>   $validated['name'],
                'email'        =>   $validated['email'],
                'password'     =>   Hash::make($validated['password']),
                'phone'        =>   $request['phone'],
                'role'         =>   Admin::SUBADMIN,
                'modules'      =>   $allow_routes
            )

        );
        return redirect()->route('admin.admins.index')->with(['success'=>'Sub Admin added successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $record = Admin::findOrFail($id);
        $user_modules=Admin::where('id', $id)->get('modules');
        $module=explode('$',$user_modules[0]['modules']);
        return view('admin.admins.edit')->with(compact('record'))->with('subadmin_module',$module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SubadminRequest $request, $id)
    {
        $admin = \App\Models\Admin::findOrFail($id);
        $old_email=$admin->email;
        $old_password=$admin->password;

        $validated = $request->validated();

        $modules=implode('$',$validated['modules']);

        if(isset($validated['password'])){
            $password = Hash::make($validated['password']);
            $admin->password = $password;
        }

        $admin->name       =  $validated['name'];
        $admin->email      =  $validated['email'];
        $admin->phone      =  $request['phone'];
        $admin->role       =  Admin::SUBADMIN;
        $admin->modules    =  $modules;
        $admin->save();
        return redirect()->route('admin.admins.index')->with(['success'=>'Sub Admin updated successfully.']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $record = Admin::findOrFail($id);
        if($record->delete()){
            return back()->with(['success'=>'Record deleted successfully']);
        } else {
            return back()->with(['error'=>'Unable to delete this record']);
        }
    }
    /**
     * Change Status
     */
    public function changeStatus(Request $request, $id) {

    }

    public function service_list(Request $request, $user_id)
    {
        $records = Service::where('user_id',$user_id)->with('userData')->sortable(['id' => 'desc']);

        if($request->query('search')){
            $records = $records->where(function($q) use ($request) {
                $q->whereHas('userData', function ($query) use($request) {
                    $q->where('first_name', 'like', '%'.$request->query('search').'%');
                    $q->orWhere('last_name', 'like', '%'.$request->query('search').'%');
                    $q->orWhere('email', 'like', '%'.$request->query('search').'%');
                })->orWhere('service_name','like', '%'.$request->query('search').'%');
            });
        }

        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
        $service ='main';
        return view ('admin.services.index',compact(['records','service','user_id']));
    }

    public function service_view(Request $request, $id)
    {
        $searchString=$request->search;
        $records = Service::where('user_id',$id)->with('userData')->where('service_name','like', '%'.$searchString.'%')
        ->sortable()->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));

        //->paginate(env('PAGINATION_LIMIT'));
        return view ('admin.services.index',['records'=>$records,'service'=>$id]);
    }

    public function service_destroy($id)
    {
        $record = Service::findOrFail($id);
        if($record->delete()){
            return back()->with(['success'=>'Service deleted successfully']);
        }else {
            return back()->with(['error'=>'Unable to delete this record']);
        }
    }

    public function service_edit($user_id, $id, $service)
    {
        $categories = Category::get();
        $data=Service::where('id',$id)->with('serviceCat')->first();
        $subcat = SubCategory::get()->toArray();
        $record = Service::where('id',$id)->with('userData')->findOrFail($id);
        $user = \App\Models\User::findOrFail($user_id);
        $url = request()->segments();
        $currenturl= $url[4];
      
        return view('admin.services.edit', compact(['user','record','currenturl','categories','data','subcat']));
    }

     public function service_update(ServicesRequest $ServicesRequest, $id){
         
        $validated = $ServicesRequest->validated();
        /*  if($ServicesRequest->hasFile('images'))
                {
                   
                    $img1=[];
                    foreach($ServicesRequest->images as $key=>$val){
                        $image = $val;
                        $ext = $image->getClientOriginalExtension();

                        if (!File::exists(public_path(Service::IMAGE_PATH))){
                           File::makeDirectory(public_path(Service::IMAGE_PATH));
                        }

                        $destinationPath = public_path(Service::IMAGE_PATH); // upload path
                        $fn = $key.time() . "." . $ext;
                        $image->move($destinationPath, $fn);
                        array_push($img1,$fn);
                    }

                     $img=implode(",",$img1);
                }else{
                    $img=implode(",",$ServicesRequest->images);
                }
        
             $tag=implode(",",$ServicesRequest->tag);
               if(!empty($ServicesRequest['sub_category'] ) && !empty($ServicesRequest['sub_category'][0])){ 
             ServiceCategory::where('service',$id)->delete();
             $datainsert=[];
            foreach($ServicesRequest['sub_category'] as $value){
            $data = ['sub_category'=>$value,'service'=>$id,'category'=>$ServicesRequest['category_id'] ];
            array_push($datainsert,$data);
            }
            //print_R($datainsert); die;
            $done=ServiceCategory::insert($datainsert);

            if($done){ 
           $data=Service::where('id',$id)->update(['service_name'=>$ServicesRequest->service_name,'description'=>$ServicesRequest->description,'tag'=>$tag,'images'=>$img,'logo'=>$ServicesRequest->logo,'category'=>$ServicesRequest['category_id']]);
          }
       }else{
           return back()->with(['title'=>__('messages.error'),'error'=> "Sub Category data is empty."]);
       }*/
     
        if($ServicesRequest->currenturl == 'main'){
            return redirect()->route('admin.service-list')->with(['success'=>'Service updated successfully.']);
       
          }else{
            return redirect()->route('admin.service-view',$request->user_id)->with(['success'=>'Service updated successfully.']);
       
            }
        
      
        
    }

    public function service_add($user_id, $service){
         $categories = Category::get();
         $user = \App\Models\User::findOrFail($user_id);
      return view('admin.services.add',compact('user','service','categories'));
    }

     public function uploadCropImage(Request $request)
    {

        $folderPath = public_path('service/');
        
        $image_parts = explode(";base64,", $request->image);
        $image_type_aux = explode("image/", $image_parts[0]);
        $image_type = $image_type_aux[1];
        $image_base64 = base64_decode($image_parts[1]);
 
        $imageName = uniqid() . '.png';
 
        $imageFullPath = $folderPath.$imageName;
        
        file_put_contents($imageFullPath, $image_base64);
       /* print_r($imageName); die;
         $saveFile = new Picture;
         $saveFile->name = $imageName;
         $saveFile->save();*/
       
        return response()->json(['success'=>'Crop Image Uploaded Successfully','image'=>asset('service/'.$imageName),'logo'=>$imageName]);
    }

     public function service_store(ServicesRequest $request)
    {
      //dd($request);
        $validated = $request->validated();
        /*if($request->hasFile('images'))
                {
                   
                    $img1=[];
                    foreach($request->images as $key=>$val){
                        $image = $val;
                        $ext = $image->getClientOriginalExtension();

                        if (!File::exists(public_path(Service::IMAGE_PATH))){
                           File::makeDirectory(public_path(Service::IMAGE_PATH));
                        }

                        $destinationPath = public_path(Service::IMAGE_PATH); // upload path
                        $fn = $key.time() . "." . $ext;
                        $image->move($destinationPath, $fn);
                        array_push($img1,$fn);
                    }

                     $img=implode(",",$img1);
                }
        
         $tag=implode(",",$validated['tag']);*/
        
        $admin = Service::create(
            array(
                'service_name'         =>   $validated['service_name'],
                'user_id'        =>   $validated['user_id'],
                'description'     =>   $validated['description'],
               // 'images'         =>  $img,
                'logo'         =>   $validated['logo'],
                //'tag'         =>   $tag,
               // 'category'     =>   $validated['category_id'],
                
            )
            );

           /* if(!empty($request->sub_category) && !empty($request->sub_category[0])){

            $datainsert=[];
            foreach($request->sub_category as $value){
            $data = ['sub_category'=>$value,'service'=>$admin->id,'category'=>$validated['category_id'] ];
            array_push($datainsert,$data);
            }
            //print_R($datainsert); die;
            ServiceCategory::insert($datainsert);
        }*/


        
        if($request->serivce == 'main'){
             return redirect()->route('admin.service-list',$request->user_id)->with(['success'=>'Service added successfully.']);
     
          }else{
             return redirect()->route('admin.service-view',$request->user_id)->with(['success'=>'Service added successfully.']);
      
             }
       // return redirect()->route('admin.service-list')->with(['success'=>'Service added successfully.']);
    }
}

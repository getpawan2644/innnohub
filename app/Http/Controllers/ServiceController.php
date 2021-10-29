<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ServiceCategory;

use Illuminate\Http\Request;
use App\Http\Requests\ServicesRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use File;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request ,Service $service ,$id)
    {
//         $id=Auth()->User()->id;
        
        
           $records = Service::query();
            if($request->query('search')){
                $records->where('service_name','like',$request->input('search'));
               
            }
            $records = $records->where('user_id',$id)->orderBy('id','Desc')->sortable()->paginate(env('PAGINATION_LIMIT'));
          
        return view('services.index',compact('records'));
    }

    public function home(Request $request)
    {
          $id=Auth()->User()->id;
        
        
           $records = Category::get()->toArray();
          return view('services.choosecategory',compact('records'));
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
         $cat=$request->cat;
          $categories = Category::get();
        $records = SubCategory::where('category_id',$cat)->get()->toArray();
        return view('services.create',compact('records','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ServicesRequest $ServicesRequest,Service $Service)
    {
      // print_r($ServicesRequest->all()); die;
        $Service->fill($ServicesRequest->validated());
         
        try{
            DB::beginTransaction();
           Service::create($ServicesRequest->all());
            /* if($ServicesRequest->hasFile('images'))
                {
                   
                    $img1=[];

                    foreach($ServicesRequest->images as $key=>$val){
                        $image = $val;
                        $ext = $image->getClientOriginalExtension();
                       if (!File::exists(public_path(Service::IMAGE_PATH))){
                           File::makeDirectory(public_path(Service::IMAGE_PATH));
                        }
                        $destinationPath = public_path(Service::IMAGE_PATH); // upload path
                        $fn = $key."service".time() . "." . $ext;
                         array_push($img1,$fn);
                        $image->move($destinationPath, $fn);
                        
                    }

                     $img=implode(",",$img1);
                }
               
               

             $tag=implode(",",$ServicesRequest['tag']);
            $Service->category = $ServicesRequest['category_id'];
             $Service->images = $img;
             $Service->tag = $tag;*/
			//$Service->save();
           /* if(!empty($ServicesRequest['sub_category'] ) && !empty($ServicesRequest['sub_category'][0])){ 
            $datainsert=[];
            foreach($ServicesRequest['sub_category'] as $value){
            $data = ['sub_category'=>$value,'service'=>$Service->id,'category'=>$ServicesRequest['category_id'] ];
            array_push($datainsert,$data);
            }
          
            ServiceCategory::insert($datainsert);
        }*/
			DB::commit();
            return redirect('services')->with(['title'=>__('messages.success'),'success'=>__('messages.service_success')]);
		} catch(\Exception $e){
            echo $e->getMessage(); die;
			DB::rollBack();
			return back()->with(['title'=>__('messages.error'),'error'=>__('messages.check_your_input')]);
		}
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function show(Service $service)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function edit(Service $service,$id)
    {
        $categories = Category::get();  
       $data=Service::where('id',$id)->with('serviceCat')->first();
      /* $cat = Category::where('slug',$data->category)->first();

       $records = SubCategory::where('category_id',$cat->id)->get()->toArray();*/
       return view('services.edit',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */

   
    public function update(ServicesRequest $ServicesRequest, $id)
    {
       //print_R($ServicesRequest->all()); die;
       
        $validated = $ServicesRequest->validated();
        if(!empty($id)){
            /*$tag=implode(",",$ServicesRequest->tag);
               if($ServicesRequest->hasFile('images'))
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

               if(!empty($ServicesRequest['sub_category'] ) && !empty($ServicesRequest['sub_category'][0])){ 
             ServiceCategory::where('service',$id)->delete();
             $datainsert=[];
            foreach($ServicesRequest['sub_category'] as $value){
            $data = ['sub_category'=>$value,'service'=>$id,'category'=>$ServicesRequest['category_id'] ];
            array_push($datainsert,$data);
            }
            $done=ServiceCategory::insert($datainsert);*/

           // if($done){ 
           $data=Service::where('id',$id)->update(['service_name'=>$ServicesRequest->service_name,'description'=>$ServicesRequest->description,'logo'=>$ServicesRequest->logo]);
         // }
     /*  }else{
           return back()->with(['title'=>__('messages.error'),'error'=> "Sub Category data is empty."]);
       }*/
        
         return redirect('services')->with(['title'=>__('messages.success'),'success'=>__('messages.service_update')]);
        
        }else{ 
            
            return back()->with(['title'=>__('messages.error'),'error'=>__('messages.check_your_input')]);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
             $Service = Service::find($request->id);
                
            if(!empty($Service)){
                Service::destroy($request->id);
                return redirect()->back()->with(['title'=>__('messages.success'),'success'=>__('messages.service_delete')]);
                }else{
                 return back()->with(['title'=>__('messages.error'),'error'=>__('messages.action_failed')]);
              } 
           
    }


}

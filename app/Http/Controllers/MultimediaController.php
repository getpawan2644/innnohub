<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Multimedia;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\MultimediaRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use File;

class MultimediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $id= Auth::user()->id;
         $records = Multimedia::query();
            if($request->query('search')){
                $records->where('name','like',$request->input('search'));
               
            }
            $records = $records->where('user_id',$id)->orderBy('id','Desc')->sortable()->paginate(env('PAGINATION_LIMIT'));
          
        return view('multimedia.index',compact('records'));
    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        // $categories = Multimedia::get();
        return view('multimedia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MultimediaRequest $MultimediaRequest,Multimedia $Multimedia)
    {
      // print_r($ServicesRequest->all()); die;
        $Multimedia->fill($MultimediaRequest->validated());
         
        try{
            DB::beginTransaction();
            if($MultimediaRequest->hasFile('image'))
                {
                   
                   // $img1=[];

                   // foreach($ServicesRequest->images as $key=>$val){
                        $image = $MultimediaRequest->image;
                        $ext = $image->getClientOriginalExtension();
                       if (!File::exists(public_path(Multimedia::PHOTOS_DIR))){
                           File::makeDirectory(public_path(Multimedia::PHOTOS_DIR));
                        }
                        $destinationPath = public_path(Multimedia::PHOTOS_DIR); // upload path
                        $fn = "multimedia".time() . "." . $ext;
                        // array_push($img1,$fn);
                        $image->move($destinationPath, $fn);
                        
                   // }

                    // $img=implode(",",$img1);
                }
               
               
             $Multimedia->image = $fn;
             
			$Multimedia->save();
         
			DB::commit();
            return redirect('gallery')->with(['title'=>__('messages.success'),'success'=>'Multimedia Added Successfully']);
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
    public function edit(Multimedia $Multimedia,$id)
    {
        $data=Multimedia::where('id',$id)->first();
       return view('multimedia.edit',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */

   
    public function update(MultimediaRequest $MultimediaRequest, $id)
    {
       //print_R($ServicesRequest->all()); die;
       
        $validated = $MultimediaRequest->validated();
        if(!empty($id)){
             if($MultimediaRequest->hasFile('logo'))
                {
                   
                   // $img1=[];
                    //foreach($ServicesRequest->images as $key=>$val){
                        $image = $MultimediaRequest->logo;;
                        $ext = $image->getClientOriginalExtension();

                        if (!File::exists(public_path(Multimedia::PHOTOS_DIR))){
                           File::makeDirectory(public_path(Multimedia::PHOTOS_DIR));
                        }

                        $destinationPath = public_path(Multimedia::PHOTOS_DIR); // upload path
                        $fn = time() . "." . $ext;
                        $image->move($destinationPath, $fn);
                        //array_push($img1,$fn);
                    

                    
                }else{
                    $fn=$MultimediaRequest->image;
                }

           // if($done){ 
           $data=Multimedia::where('id',$id)->update(['name'=>$MultimediaRequest->name,'image'=>$fn]);
         // }
     /*  }else{
           return back()->with(['title'=>__('messages.error'),'error'=> "Sub Category data is empty."]);
       }*/
        
         return redirect('gallery')->with(['title'=>__('messages.success'),'success'=>'Multimedia Updated Successfully']);
        
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
             $Service = Multimedia::find($request->id);
                
            if(!empty($Service)){
                Multimedia::destroy($request->id);
                return redirect()->back()->with(['title'=>__('messages.success'),'success'=>'Multimedia Deleted Successfully.']);
                }else{
                 return back()->with(['title'=>__('messages.error'),'error'=>__('messages.action_failed')]);
              } 
           
    }


}

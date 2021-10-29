<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Testimonial;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\TestimonialRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use File;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
             $id= Auth::user()->id;
             $records = Testimonial::query();
                if($request->query('search')){
                    $records->where('name','like',$request->input('search'));
                   
                }
              $records = $records->where('user_id',$id)->orderBy('id','Desc')->sortable()->paginate(env('PAGINATION_LIMIT'));
          
           return view('testimonials.index',compact('records'));
        }catch(\Exception $e){
            Log::error($e->getMessage);
            return redirect()->back()->with('Error','Someting wrong wrong');
        }
       
    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Request $request)
    {
        // $categories = Multimedia::get();
        return view('testimonials.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestimonialRequest $TestimonialRequest,Testimonial $Testimonial)
    {
      // print_r($ServicesRequest->all()); die;
        $Testimonial->fill($TestimonialRequest->validated());
         
        try{
            DB::beginTransaction();
             $Testimonial->save();
         
			DB::commit();
            return redirect('testimonials')->with(['title'=>__('messages.success'),'success'=>'Testimonial Added Successfully']);
		} catch(\Exception $e){
            echo $e->getMessage(); die;
			DB::rollBack();
			return back()->with(['title'=>__('messages.error'),'error'=>__('messages.check_your_input')]);
		}
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
    public function edit(Testimonial $Testimonial,$id)
    {
        try{
             $data=Testimonial::where('id',$id)->first();
       return view('testimonials.edit',compact('data'));
        }catch(\Exception $e){
            Log::error($e->getMessage);
            return redirect()->back()->with('Error','Someting wrong wrong');
        }
       

    }

     public function view(Testimonial $Testimonial,$id)
    {
        $data=Testimonial::where('id',$id)->first();
       //return view('casestudies.edit',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */

   
    public function update(TestimonialRequest $TestimonialRequest, $id)
    {
       //print_R($ServicesRequest->all()); die;
       
        $validated = $TestimonialRequest->validated();
        if(!empty($id)){
            
           $data=Testimonial::where('id',$id)->update(['name'=>$TestimonialRequest->name,'comment'=>$TestimonialRequest->comment]);
            return redirect('testimonials')->with(['title'=>__('messages.success'),'success'=>'Testimonial Updated Successfully']);
        
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
             $Service = Testimonial::find($request->id);
                
            if(!empty($Service)){
                Testimonial::destroy($request->id);
                return redirect()->back()->with(['title'=>__('messages.success'),'success'=>'Testimonial Deleted Successfully.']);
                }else{
                 return back()->with(['title'=>__('messages.error'),'error'=>__('messages.action_failed')]);
              } 
           
    }


}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
    public function index(Request $request ,$user_id)
    {
//        $id= Auth::user()->id;
         $records = Testimonial::where('user_id',$user_id)->with('userData')->sortable(['id' => 'desc']);
            if($request->query('search')){
                $records->where('name','like',$request->input('search'));
               
            }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
          
        return view('admin.testimonials.index',compact(['records','user_id']));
    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($user_id, Testimonial $Testimonial)
    {
        $user = \App\Models\User::findOrFail($user_id);
        return view('admin.testimonials.create',compact('user','Testimonial'));
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
            return redirect('admin/testimonials')->with(['title'=>__('messages.success'),'success'=>'Testimonial Added Successfully']);
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
    public function edit($user_id, $id)
    {
        $data=Testimonial::where('id',$id)->first();
        $record = Testimonial::where('id',$id)->with('userData')->findOrFail($id);
        $user = \App\Models\User::findOrFail($user_id);
       return view('admin.testimonials.edit',compact('record','user','data'));

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
            return redirect('admin/testimonials')->with(['title'=>__('messages.success'),'success'=>'Testimonial Updated Successfully']);
        
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

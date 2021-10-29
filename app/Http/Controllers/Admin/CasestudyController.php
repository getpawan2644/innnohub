<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use App\Models\Service;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\CaseStudy;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\CasestudyRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use File;

class CasestudyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user_id)
    {
         $records = CaseStudy::where('user_id',$user_id)->with('userData')->sortable(['id' => 'desc']);
            if($request->query('search')){
                $records->where('name','like',$request->input('search'));
               
            }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
          
        return view('admin.casestudies.index',compact('records','user_id'));

    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($user_id, CaseStudy $CaseStudy)
    {
        $user = \App\Models\User::findOrFail($user_id);
        return view('admin.casestudies.create',compact('user','CaseStudy'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CasestudyRequest $CasestudyRequest,CaseStudy $CaseStudy)
    {
      // print_r($ServicesRequest->all()); die;
        $CaseStudy->fill($CasestudyRequest->validated());
         
        try{
            DB::beginTransaction();
             $CaseStudy->save();
         
			DB::commit();
            return redirect('admin/case-study')->with(['title'=>__('messages.success'),'success'=>'Case Study Added Successfully']);
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
        $data=CaseStudy::where('id',$id)->first();
        $record = CaseStudy::where('id',$id)->with('userData')->findOrFail($id);
        $user = \App\Models\User::findOrFail($user_id);
       return view('admin.casestudies.edit',compact('record','user','data'));

    }

     public function view(CaseStudy $CaseStudy,$id)
    {
        $data=CaseStudy::where('id',$id)->first();
       //return view('casestudies.edit',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */

   
    public function update(CasestudyRequest $CasestudyRequest, $id)
    {
       //print_R($ServicesRequest->all()); die;
       
        $validated = $CasestudyRequest->validated();
        if(!empty($id)){
            
           $data=CaseStudy::where('id',$id)->update(['name'=>$CasestudyRequest->name,'description'=>$CasestudyRequest->description]);
            return redirect('admin/case-study')->with(['title'=>__('messages.success'),'success'=>'Case Study Updated Successfully']);
        
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
             $Service = CaseStudy::find($request->id);
                
            if(!empty($Service)){
                CaseStudy::destroy($request->id);
                return redirect()->back()->with(['title'=>__('messages.success'),'success'=>'Case Study Deleted Successfully.']);
                }else{
                 return back()->with(['title'=>__('messages.error'),'error'=>__('messages.action_failed')]);
              } 
           
    }


}

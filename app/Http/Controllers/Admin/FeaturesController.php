<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use App\Models\Feature;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\FeatureRequest;


class FeaturesController extends Controller
{

   public function index(Request $request ,$user_id)
    {
         $records = Feature::where('user_id',$user_id)->with('userData')->sortable(['id' => 'desc']);
            if($request->query('search')){
                $records->where('title','like',$request->input('search'));
               
            }
       $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
          
        return view('admin.features.index',compact(['records','user_id']));
    }

     public function add($user_id, Feature $Feature)
    {
        $user = \App\Models\User::findOrFail($user_id);
        return view('admin.features.create',compact('user','Feature'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FeatureRequest $FeatureRequest,Feature $Feature)
    {
      // print_r($ServicesRequest->all()); die;
        $Feature->fill($FeatureRequest->validated());
         
        try{
            DB::beginTransaction();
          
            $Feature->save();
           DB::commit();
            return redirect('admin/features')->with(['title'=>__('messages.success'),'success'=>'Feature Added Successfully']);
        } catch(\Exception $e){
            echo $e->getMessage(); die;
            DB::rollBack();
            return back()->with(['title'=>__('messages.error'),'error'=>__('messages.check_your_input')]);
        }
    }
   
  
    public function edit($user_id, $id)
    {

        $data=Feature::where('id',$id)->first();
        $record = Feature::where('id',$id)->with('userData')->findOrFail($id);
        $user = \App\Models\User::findOrFail($user_id);
       return view('admin.features.edit',compact('record','user','data'));

    }

   
    public function update(FeatureRequest $FeatureRequest, $id)
    {
       //print_R($ServicesRequest->all()); die;
       
        $validated = $FeatureRequest->validated();
        if(!empty($id)){
            
           $data=Feature::where('id',$id)->update(['title'=>$FeatureRequest->title,'description'=>$FeatureRequest->description,'user_id'=>$FeatureRequest->user_id]);
         return redirect('admin/features/')->with(['title'=>__('messages.success'),'success'=>'Feature Updated Successfully']);
       
        
        }else{ 
            
            return back()->with(['title'=>__('messages.error'),'error'=>__('messages.check_your_input')]);
        }
        
    }

     public function destroy(Request $request,$id)
    {
             $Service = Feature::find($request->id);
                
            if(!empty($Service)){
                Feature::destroy($request->id);
                return redirect()->back()->with(['title'=>__('messages.success'),'success'=>'Feature Deleted Successfully.']);
                }else{
                 return back()->with(['title'=>__('messages.error'),'error'=>__('messages.action_failed')]);
              } 
           
    }

    


}

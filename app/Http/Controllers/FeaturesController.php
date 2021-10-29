<?php

namespace App\Http\Controllers;
use DB;
use App\Models\Feature;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\FeatureRequest;


class FeaturesController extends Controller
{
   
  
    public function edit(Feature $Feature)
    {
        $data=Feature::where('user_id',Auth::user()->id)->first();
       return view('features.edit',compact('data'));

    }

   
    public function update(FeatureRequest $FeatureRequest, $id)
    {
       //print_R($ServicesRequest->all()); die;
       
        $validated = $FeatureRequest->validated();
        if(!empty($id)){
            $uid=Feature::where('user_id',$id)->first();
            if(!empty($uid)){
           $data=Feature::where('user_id',$id)->update(['title'=>$FeatureRequest->title,'description'=>$FeatureRequest->description,'user_id'=>$id]);
       }else{
         $data=Feature::create(['title'=>$FeatureRequest->title,'description'=>$FeatureRequest->description,'user_id'=>$id]);
       }
            return redirect('features/edit')->with(['title'=>__('messages.success'),'success'=>'Feature Updated Successfully']);
       
        
        }else{ 
            
            return back()->with(['title'=>__('messages.error'),'error'=>__('messages.check_your_input')]);
        }
        
    }

    


}

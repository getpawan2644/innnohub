<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use DB;
use App\Models\Award;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\AwardRequest;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Validator;
use File;

class AwardsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request ,$user_id)
    {
//        $id= Auth::user()->id;
         $records = Award::where('user_id',$user_id)->with('userData')->sortable(['id' => 'desc']);
            if($request->query('search')){
                $records->where('name','like',$request->input('search'));
               
            }
        $records = $records->paginate(($request->query('limit') ? $request->query('limit'):env('PAGINATION_LIMIT') ));
          
        return view('admin.awards.index',compact(['records','user_id']));
    }

   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add($user_id, Award $Award)
    {
        $user = \App\Models\User::findOrFail($user_id);
        return view('admin.awards.create',compact('user','Award'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AwardRequest $AwardRequest,Award $Award)
    {
      // print_r($ServicesRequest->all()); die;
        $Award->fill($AwardRequest->validated());
         
        try{
            DB::beginTransaction();
            if($AwardRequest->hasFile('image'))
                {
                   $image = $AwardRequest->image;
                        $ext = $image->getClientOriginalExtension();
                       if (!File::exists(public_path(Award::PHOTOS_DIR))){
                           File::makeDirectory(public_path(Award::PHOTOS_DIR));
                        }
                        $destinationPath = public_path(Award::PHOTOS_DIR); // upload path
                        $fn = "multimedia".time() . "." . $ext;
                        $image->move($destinationPath, $fn);
                   }
               
               
             $Award->image = $fn;
            $Award->save();
           DB::commit();
            return redirect('admin/awards')->with(['title'=>__('messages.success'),'success'=>'Award Added Successfully']);
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
        $data=Award::where('id',$id)->first();
        $record = Award::where('id',$id)->with('userData')->findOrFail($id);
        $user = \App\Models\User::findOrFail($user_id);
       return view('admin.awards.edit',compact('record','user','data'));

    }

     public function view(Award $Award,$id)
    {
        $data=Award::where('id',$id)->first();
       //return view('casestudies.edit',compact('data'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Service  $service
     * @return \Illuminate\Http\Response
     */

   
     public function update(AwardRequest $AwardRequest, $id)
    {
       //print_R($ServicesRequest->all()); die;
       
        $validated = $AwardRequest->validated();
        if(!empty($id)){
             if($AwardRequest->hasFile('logo'))
                {
                        $image = $AwardRequest->logo;;
                        $ext = $image->getClientOriginalExtension();

                        if (!File::exists(public_path(Award::PHOTOS_DIR))){
                           File::makeDirectory(public_path(Award::PHOTOS_DIR));
                        }

                        $destinationPath = public_path(Award::PHOTOS_DIR); // upload path
                        $fn = time() . "." . $ext;
                        $image->move($destinationPath, $fn);
                       
                }else{
                    $fn=$AwardRequest->image;
                }

           $data=Award::where('id',$id)->update(['name'=>$AwardRequest->name,'image'=>$fn,'description'=>$AwardRequest->description]);
        return redirect('admin/awards')->with(['title'=>__('messages.success'),'success'=>'Awards Updated Successfully']);
        
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
             $Service = Award::find($request->id);
                
            if(!empty($Service)){
                Award::destroy($request->id);
                return redirect()->back()->with(['title'=>__('messages.success'),'success'=>'Award Deleted Successfully.']);
                }else{
                 return back()->with(['title'=>__('messages.error'),'error'=>__('messages.action_failed')]);
              } 
           
    }


}

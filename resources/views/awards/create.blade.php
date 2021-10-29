@php
use App\Model\User;
use App\Models\Country;
$countries = Country::getCountryList();
@endphp
@php

@endphp
@extends('layouts.default')
@section('title',__("header.profile_title"))
@section('content')


<!-- inner-header -->
  <section class="p-0">
    <div class="banner inner-banner">
      <div class="banner-wrap">
        <div class="container sml-container">
          <div class="row">
            <div class="col-lg-12">
              <!-- banner text -->
              <div class="banner-text">
                <h2>Add Award</h2>
              </div>
              <!-- banner text end -->
            </div>
          </div>
        </div>
      </div>
      <img class="banner-bg" src="{{ asset('image/inner-bg.png') }}" alt="banner">
    </div>
  </section>
  <!-- inner-header end -->
    <section class="sidebar_with_container">
        <div class="container sml-container">
            <div class="row">
                @include("elements.layout.sidebar")
                <div class="col-lg-10 col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <section class="page-content container-fluid">

                                      <div class="card-body">
                                                <form class="forms-sample" method="POST" action="{{url("awards/store")}}" enctype="multipart/form-data">
                                                    @csrf

                                                     
                                                    <input type="hidden" class="form-control" name="user_id" placeholder="{{__("form.service_name")}}" value='{{ Auth::user()->id }}'>
                                                         <div class="row">      
                                                        

                                                       
                                                           <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                             
                                                                <label class="control-label float-left">Name</label>
                                                                <input type="text" class="form-control" name="name" placeholder="Name" value='{{ old('name') }}'>
                                                                @if ($errors->has('name'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('name') }}</strong>
                                                                    </span>
                                                                @endif
                                                           
                                                        </div>
                                                           <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                       
                                                                <label class="control-label">Upload Image</label>
                                                                 <input type="file" class="form-control" name="image" placeholder="" value='{{ old('image') }}'>
                                                                @if ($errors->has('image'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('image') }}</strong>
                                                                    </span>
                                                                @endif
                                                           </div>
                                                   
                                                     
                                                      

                                                    </div>
          
                                                    <div class="row">

                                         <!--div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    
                                        <label class="control-label">Other Images</label>
                                        
                                        
                                            <div><input type="file" name="images[]" class="form-control" required></div>
                                            <div class="input_fields_wrap">
                                            </div>
                                            <button class="add_field_button" id="add">Add More Fields</button>
                                            
                                        
                                        @if ($errors->has('image'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                     <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    
                                        <label class="control-label">Tags</label>
                                        
                                        
                                            <div><input type="text" name="tag[]" class="form-control" required></div>
                                            <div class="input_fields_wrap1">
                                            </div>
                                            <button class="add_field_button1" id="add1">Add More Fields</button>
                                            
                                        
                                        @if ($errors->has('tag'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('tag') }}</strong>
                                            </span>
                                        @endif
                                    </div-->

                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                           
                                                                <label class="control-label float-left">{{__("form.service_description")}}</label>
                                                                <textarea class="form-control"  rows="5" name="description"></textarea>
                                                                    @if ($errors->has('description'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('description') }}</strong>
                                                                    </span>
                                                                @endif
                                                         
                                                        </div>
                                                              
                                                        </div>


                                                    <div class="row language-left">
                                                        <button type="submit" class="inno_btn px-4 mt-4">{{__("content.service_btn")}}</button>
{{--                                                        <a href="http://localhost/sabq/admin/categories" class="btn sabq-btn sabq-frm-btn">Cancel</a>--}}
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>





@endsection

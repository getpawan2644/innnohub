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
                <h2>Update Feature</h2>
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
                                                <form class="forms-sample" method="POST" action="{{route('features.update', Auth::user()->id)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">Title</label>
                                                                <input type="hidden" class="form-control" name="user_id" value='{{ old('user_id',Auth::user()->id) }}'>
                                                               
                                                                <input type="text" class="form-control" name="title" placeholder="Title" value='{{ old('title', ($data) ? $data->title : '') }}'>
                                                               
                                                               @if ($errors->has('title'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('title') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                        <div class="form-group">
                                                          <label class="control-label">Description</label>
                                                          <textarea id="editor2" name="description" class="form-control">{!! old('description', ($data) ? $data->description : '') !!}</textarea>

                                                          @if ($errors->has('description'))
                                                            <span class="error-message">
                                                              <strong>{{ $errors->first('description') }}</strong>
                                                            </span>
                                                          @endif
                                
                                                        </div>
                                                    </div>

                                                    </div>

                                                  
                                             <div class="row language-left">
                                                        <button type="submit" class="inno_btn px-4 mt-4">Update</button>
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

                   
    </section>

   <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>

    <script>
        
        CKEDITOR.replace('description');
    </script>


@endsection

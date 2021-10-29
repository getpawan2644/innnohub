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
                <h2>Add Services</h2>
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
                                                
                                                    <div class="row">
                                                       <input type="hidden" class="form-control" name="user_id" placeholder="{{__("form.service_name")}}" value='{{ Auth::user()->id }}'>
                                                               
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                          
                                                                <label class="control-label float-left">Choose Category</label>
                                                              <select name="cars" class="form-control" id="cars" onchange="javascript:handleSelect(this)">
                                                           @foreach($records as $key=>$value)
                                                              <option value="{{$value['id']}}">{{$value['name']}}</option>
                                                            @endforeach 
                                                              </select>
                                                         </div>
                                                </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

<script type="text/javascript">
  function handleSelect(elm)
  {
     window.location = "{{url('services/create?cat=')}}"+elm.value;
  }
</script>
    </section>

@endsection

@php
    use App\Model\User;
    use App\Models\Country;
    $countries = Country::getCountryList();
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
                <h2>{{__("header.change_password")}}</h2>
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
                            <section class="page-content p-0">
                                 <div class="card-body">
                                    <form class="forms-sample" method="POST" action="{{route('user.update-password')}}" enctype="multipart/form-data">
                                        @csrf
										<div class="row">
                                         
										 <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12  mb-3">
                                                <div class="form-group">
                                                    <label class="control-label float-left">{{__("content.old_password")}}</label>
                                                    <input type="password" class="form-control" placeholder="{{__("content.old_password")}}" name="old_password" value="{{ old('old_password') }}">
                                                    @if ($errors->has('old_password'))
                                                        <span class="error-message float-left"><strong>{{ $errors->first('old_password') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12 mb-3">
                                                <div class="form-group">
                                                    <label class="control-label float-left">{{__("content.new_password")}}</label>
                                                    <input type="password" class="form-control" placeholder="{{__("content.new_password")}}" name="newpassword">
                                                    @if ($errors->has('newpassword'))
                                                        <span class="error-message float-left"><strong>{{ $errors->first('newpassword') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12 mb-3">
                                                <div class="form-group">
                                                    <label class="control-label float-left">{{__("content.confirm_password")}}</label>
                                                    <input type="password" class="form-control" id="" placeholder="{{__("content.confirm_password")}}" name="newpassword_confirmation">
                                                    @if ($errors->has('newpassword_confirmation'))
                                                        <span class="error-message float-left"><strong>{{ $errors->first('newpassword_confirmation') }}</strong></span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
										<div class="row language-left">
                                           <div class="col-lg-12">
										   <button type="submit" class="inno_btn px-4 mt-4">{{__("content.update")}}</button>
    {{--                                                        <a href="http://localhost/sabq/admin/categories" class="btn sabq-btn sabq-frm-btn">Cancel</a>--}}
                                        </div>
                                        </div>
                                    </form>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

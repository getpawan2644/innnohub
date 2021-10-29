@php
    $countries = \App\Models\Country::getCountryList();
    $countries_with_code = \App\Models\Country::getCountryWithCode();
@endphp
@extends('layouts.admin.default')

@section('title',"Add Vendors")

@section('header',"Add Vendors")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.vendors.index') }}">Manage Vendors </a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Vendors</li>
@endsection

@section('content')
<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
<link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
{{--    @if ($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}

    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.vendors.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Select Country</label>
                                        <select type="text" class="form-control" name="country_id" id="country_select" placeholder="Please choose a Country" value="{{ old('country_id',$record->country_id) }}">
                                            <option value="">
                                                Select Country
                                            </option>
                                            @foreach($countries as $country)
                                                <option {{ old("country_id",$record->country_id) == $country->id ? 'selected' : '' }} country_code="{{$country->code}}"value="{{ $country->id }}">{{$country->name." (".$country->code.")"}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('country_id'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('country_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter vendor name" value='{{ old('name', $record->name) }}'>
                                        @if ($errors->has('name'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="Enter email address" value='{{ old('email', $record->email) }}'>
                                        @if ($errors->has('email'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Website</label>
                                        <input type="text" class="form-control" name="website" placeholder="Enter web address" value='{{ old('website', $record->website) }}'>
                                        @if ($errors->has('website'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('website') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Phone Number</label>
                                        <input type="hidden" id="country_code" name="country_code" value="{{ (old('country_code', $record->country_code))?old('country_code', $record->country_code):'qa' }}">
                                        <input type="hidden" id="dial_code" name="dial_code" value="{{(old('dial_code', $record->dial_code))?old('dial_code', $record->dial_code):'974'}}">
                                        <input type="tel" onclick="this.setSelectionRange(0, this.value.length)" class="form-control" name="phone" id="mobile" value="{{ old('phone', $record->phone) }}" placeholder="Please enter phone number">
                                        @if ($errors->has('phone'))
                                            <span class="error-message">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Vendor Code</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="factory_code_prefix">{{@$countries_with_code[old('country_id',$record->country_id)]}}</span>
                                            </div>
                                            <input type="text" class="form-control" id="price_input"name="code" placeholder="Enter vendor code" value='{{ old("code", $record->code) }}'>
                                        </div>
                                        @if ($errors->has('code'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Comment</label>
                                        <textarea name="comment"  class="form-control" rows="8">{{old("comment",$record->comment)}}</textarea>
                                        @if ($errors->has('comment'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('comment') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">URL</label>
                                        <div class="input-group md-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white">{{ env('APP_URL')."/vendor" }}</span>
                                            </div>
                                            <input type="text" class="form-control" onkeyup="rtl(this);" name="url_name"  placeholder="Enter the url" value='{{ old('url_name', $record->url_name) }}'>
                                        </div>

                                        @if ($errors->has("url_name"))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('url_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card card-border-primary">
                                <div class="card-header text-left">Client Logo</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="form-group select-photo">
                                                <ul class="client-logo-image-list">
                                                    @if(!empty(old('logo',$record->logo)))
                                                        @php $oldImagesURL = old('logo_thumbnail_url',$record->logo_thumbnail_url);
                                                             $oldlogoImages = old('logo',$record->logo);
                                                             $oldtumbImages = old('logo_thumbnail',$record->logo_thumbnail);
															//dd($record->logo_thumbnail_url);
                                                        @endphp
                                                        <li class="mr-5 paidImage">
                                                            <div class="coustom-input">
                                                                <a href="javascript:void(0);" class="remove-logo-pic">X</a>
                                                                <img src="{{$oldImagesURL}}"/>
                                                                <input type="hidden" class="logo_images_input" name="logo" value="{{$oldlogoImages}}"/>
                                                                <input type="hidden" class="logo_images_url" name="logo_images_url" value="{{$oldImagesURL}}"/>
                                                                <input type="hidden" class="logo_thumbnail_images_input" name="logo_thumbnail" value="{{$oldtumbImages}}"/>
                                                                <input type="hidden" class="logo_thumbnail_url" name="logo_thumbnail_url" value="{{$oldImagesURL}}"/>
                                                            </div>
                                                            <div class="image-title upload">&nbsp;</div>
                                                        </li>
                                                    @endif
                                                    <li class="green-photo mr-3 null_class {{!empty(old('logo',$record->logo))?"hide":''}}">
                                                        <div class="coustom-input">
                                                            <input type="file" class="logo-image custom-file-input">
                                                        </div>
                                                        <div class="progress-bar img-progress-bar" role="progressbar"></div>
                                                        <div class="image-title">Add Photo</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        @if ($errors->has('logo'))
                                            <span class="error-message">
                                                        <strong>{{ $errors->first('logo') }}</strong>
                                                    </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Add</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('admin.vendors.jscript')
<script>
    jQuery(document).ready(function(){

        $("#country_select").change(function(){
            $("#factory_code_prefix").text($('option:selected', this).attr('country_code'));
        });

        var input = document.querySelector("#mobile");
        var iti = window.intlTelInput(input, {
            initialCountry: "{{ !empty(old('country_code', $record->country_code))?old('country_code', $record->country_code):'qa' }}",
            //separateDialCode: true,
            //utilsScript:"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
            // any initialisation options go here
        });
        window.intlTelInputGlobals.loadUtils("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js");
        input.addEventListener("countrychange", function() {
            console.log(iti.getSelectedCountryData());
            let countryData = iti.getSelectedCountryData();
            document.getElementById('country_code').value =countryData.iso2;
            document.getElementById('dial_code').value =countryData.dialCode;
        });
    });


</script>
@endsection

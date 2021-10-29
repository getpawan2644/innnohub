@php
    use App\Models\Country;
    $countries = Country::getCountryList();
@endphp
@extends('layouts.admin.default')

@section('title',"Edit User")

@section('header',"Edit User")

@section('breadcrumb')
    @parent
        <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Manage Users </a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit User</li>
    @endsection

@section('content')
	<section class="page-content container-fluid">
	    <div class="row">
	        <div class="col-12 grid-margin stretch-card">
	            <div class="card">
	                <div class="card-body">
	                    <form class="forms-sample" method="POST" action="{{ route('admin.users.update',$record->id) }}" enctype="multipart/form-data">
                        @csrf
						@method('PUT')

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">First Name</label>
                                        <input type="text" class="form-control" name="first_name" placeholder="Enter user first name" value='{{ old('first_name', $record->first_name) }}'>
                                        @if ($errors->has('first_name'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" placeholder="Enter user last name" value='{{ old('last_name', $record->last_name) }}'>
                                        @if ($errors->has('last_name'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('last_name') }}</strong>
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
                                        <label class="control-label">Select Country</label>
                                        <select type="text" class="form-control country" name="country_id" placeholder="Please choose a category" value="{{ old('country_id',$record->country_id) }}">
                                            <option value="">
                                                Select Country Name
                                            </option>
                                            @foreach($countries as $country)
                                                <option {{ old("country_id",$record->country_id) == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{$country->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('country_id'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('country_id') }}</strong>
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
                                        <input type="tel" onclick="this.setSelectionRange(0, this.value.length)" class="form-control" name="mobile" id="mobile" value="{{ old('mobile', $record->mobile) }}" placeholder="Please enter your number">
                                        @if ($errors->has('mobile'))
                                            <span class="error-message">
                                                    <strong>{{ $errors->first('mobile') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter user password" value='{{ old('password') }}'>
                                        @if ($errors->has('password'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Company name</label>
                                        <input type="text" class="form-control" name="company_name" value="{{ old('company_name', $record->company_name) }}" placeholder="{{__('content.company_name')}}" required>
                                        @if ($errors->has('company_name'))
                                                <span class="error-message">
                                                    <strong>{{ $errors->first('company_name') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Company size</label>
                                        <select name="company_size"  id="company_size" class="form-control">
                                            <option disabled required selected>Company size</option>
                                            <option value="1-50" {{ old("company_size",$record->company_size) == "1-50" ? 'selected' : '' }}>1-50</option>
                                            <option value="50-200" {{ old("company_size",$record->company_size) == "50-200" ? 'selected' : '' }}>50-200</option>
                                            <option value="200-500" {{ old("company_size",$record->company_size) == "200-500" ? 'selected' : '' }}>200-500</option>
                                            <option value="500-1000" {{ old("company_size",$record->company_size) == "500-1000" ? 'selected' : '' }}>500-1000</option>
                                            <option value="1000-5000" {{ old("company_size",$record->company_size) == "1000-5000" ? 'selected' : '' }}>1000-5000</option>
                                            <option value="5000+" {{ old("company_size",$record->company_size) == "5000+" ? 'selected' : '' }}>5000+</option>
                                          </select>
                                        @if ($errors->has('company_size'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('company_size') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Industry</label>
                                        <input type="text" class="form-control" name="industry" value="{{ old('industry', $record->industry) }}" placeholder="{{__('content.industry')}}" required>
                                        @if ($errors->has('industry'))
                                                <span class="error-message">
                                                    <strong>{{ $errors->first('industry') }}</strong>
                                                </span>
                                            @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Job Title</label>
                                        <input type="text" class="form-control" name="job_title" value="{{ old('job_title', $record->job_title) }}" placeholder="{{__('content.job_title')}}" required>

                                        @if ($errors->has('company_size'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('company_size') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
	                    <button type="submit" class="btn btn-primary mr-2 mt-4">Update</button>
                        	<a href="{{ route('admin.users.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>
	</section>
<script>
    jQuery(document).ready(function(){
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



        populateStates("{{ old('country_id',$record->country_id) }}");
        jQuery(".country").change(function(){
            populateStates($(this).val(), null);
        });
    });
</script>

@endsection

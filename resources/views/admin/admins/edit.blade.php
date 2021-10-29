@extends('layouts.admin.default')

@section('title',"Edit Sub Admin")

@section('header',"Edit Sub Admin")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.admins.index') }}">Manage Sub Admins </a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Sub Admin</li>
@endsection

@section('content')
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.admins.update',$record->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Name" value="{{ old('name',$record->name) }}">
                                        @if ($errors->has('name'))
                                            <span class="error-message">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Phone</label>

                                        <input type="tel" id="phone" name="phone" class="form-control" value="{{ old('phone', $record->phone) }}" placeholder="Please enter phone number">
                                        <input type="hidden" id="country_code" name="country_code" value="{{ (old('country_code', $record->country_code))?old('country_code', $record->country_code):'qa' }}">
                                        <input type="hidden" id="dial_code" name="dial_code" value="{{(old('dial_code', $record->dial_code))?old('dial_code', $record->dial_code):'974'}}">

                                        {{--                                        <script src="{{ asset('js/admin/intlTelInput.js') }}"></script>--}}
                                        {{--                                        <script src="{{ asset('js/admin/utils.js') }}"></script>--}}

                                        <script>
                                            $(document).ready(function(){
                                                var input = document.querySelector("#phone");
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

                                        @if ($errors->has('phone'))
                                            <span class="error-message">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>


                            </div>
                            <div class="row">

                                <div class="col-lg-12 col-md12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="email" class="form-control" name="email" placeholder="Enter User Email" value="{{ old('email',$record->email) }}">
                                        @if ($errors->has('email'))
                                            <span class="error-message">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Password</label>
                                        <input type="password" class="form-control" name="password" placeholder="Enter Password" value="">
                                        @if ($errors->has('password'))
                                            <span class="error-message">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Confirm Password</label>
                                        <input type="password" class="form-control" name="password_confirmation" placeholder="Enter Password" value="">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="error-message">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <div class="checkbox">
                                            <label>
                                                <input class="all_admin_check" type="checkbox" name="modules[]" id="all"
                                                       value="all" @php if(in_array('all',old('modules',array()))){ echo "checked";}@endphp>
                                                <span class="checkmark"></span> <span style="font-size: 14px;font-weight: 600;">All Modules Access </span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                @php
                                    $all_routes=\App\Helpers\CommonHelper::getAdminModules();
                                @endphp
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        @foreach($all_routes as $module_key=>$values)
                                            <fieldset class="modular_fieldset">
                                                <legend class="modular_legend">{{$module_key}} Module:</legend>
                                                <div class="checkbox_container">
                                                    @foreach($values as $checkbox_key=>$value)
                                                        <label>
                                                            <input class="{{($checkbox_key=="Full Admin Access")?"admin_check":"view_check"}}" type="checkbox"
                                                                   name="modules[]"
                                                                   value="{{$value}}"@php if(in_array($value,old("modules",$subadmin_module)) || (empty(old('modules')) && $checkbox_key=="View Only")){ echo "checked";}@endphp {{($value=="disabled")?"disabled":""}}>
                                                            <span class="checkmark"></span>{{$checkbox_key}}
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </fieldset>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
{{--                            <div class="row">--}}

{{--                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label class="control-label">Modules</label>--}}
{{--                                        <br/>--}}

{{--                                        <div class="checkbox">--}}
{{--                                            <label>--}}
{{--                                                <input class="all_check" type="checkbox" name="modules[]" id="all" value="all" @php if(in_array('all',old('modules',array()))){ echo "checked";}@endphp>--}}
{{--                                                <span class="checkmark"></span>All--}}
{{--                                            </label>--}}
{{--                                        </div>--}}
{{--                                        @foreach(\App\Helpers\CommonHelper::getAdminModules() as $key=>$values)--}}
{{--                                            <div class="checkbox">--}}
{{--                                                <label>--}}
{{--                                                    <input class="simple_check" type="checkbox" name="modules[]" value="{{$key}}" @php if(in_array($key,old('modules',$subadmin_module))){ echo "checked";}@endphp>--}}
{{--                                                    <span class="checkmark"></span>{{$key}}--}}
{{--                                                </label>--}}
{{--                                            </div>--}}
{{--                                        @endforeach--}}
{{--                                        @if ($errors->has('modules'))--}}
{{--                                            <span class="error-message">--}}
{{--                                            <strong>{{ $errors->first('modules') }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Update</button>
                            <a href="{{ route('admin.admins.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--phone with country code -->
    <script>
        $(document).ready(function () {
            let all_selected=true;
            $(".admin_check").each(function(){
                if(!$(this).prop("checked")){
                   all_selected=false;
                   return false;
                }
            });
            if(all_selected){
                $(".all_admin_check").prop("checked",true);
                $(".all_admin_check").attr("checked",'checked');
            }
            $(".all_admin_check").click(function () {
                if ($(this).prop("checked")) {
                    /*checked all the checkbox of full admin access*/
                    $(".admin_check").prop("checked", true);
                    $(".admin_check").attr("checked", "checked");
                    /*Unchecked all the checkbox except full admin access*/
                    $(".view_check").prop("checked", false);
                    $(".view_check").removeAttr("checked");
                }
                // else {
                //     $(".view_check").prop("checked", true);
                //     $(".view_check").attr("checked", "checked");
                // }
            });
            $(".admin_check").click(function () {
                if (!$(this).prop("checked")) {
                    $(".all_admin_check").removeAttr("checked", "checked");
                }
                $(this).closest(".checkbox_container").find( ".view_check" ).removeAttr("checked", "checked");
                let new_all_selected=true;
                $(".admin_check").each(function(){
                    if(!$(this).prop("checked")){
                        new_all_selected=false;
                        return false;
                    }
                });
                if(new_all_selected){
                    $(".all_admin_check").prop("checked",true);
                    $(".all_admin_check").attr("checked",'checked');
                }
            }) ;
            $(".view_check").click(function () {
                if ($(this).prop("checked")) {
                    $(".all_admin_check").removeAttr("checked", "checked");
                }
                $(this).closest(".checkbox_container").find( ".admin_check" ).removeAttr("checked", "checked");
            })
        });
    </script>
@endsection


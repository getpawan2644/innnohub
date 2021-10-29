@php
    use App\Models\Country;
    $countries = Country::getCountryList();
@endphp
@extends('layouts.admin.default')

@section('title',"Edit States")

@section('header',"Edit States")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.states.index') }}">Manage States </a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit States</li>
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.states.update',$record->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Select Country</label>
                                        <select type="text" class="form-control" name="country_id" placeholder="Please choose a category" value="{{ old('country_id',$record->country_id) }}">
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
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <select type="text" class="form-control" name="status" placeholder="Please choose a category" value="{{ old('status',$record->status) }}">
                                            <option {{ old("status",$record->status) == \App\Models\State::ACTIVE ? 'selected' : '' }} value="{{ $record->status }}">{{\App\Models\State::ACTIVE}}</option>
                                            <option {{ old("status",$record->status) == \App\Models\State::INACTIVE ? 'selected' : '' }} value="{{ $record->status }}">{{\App\Models\State::INACTIVE}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            @foreach(config('translatable.locales_name') as $language=>$locale)
                                <div class="card card-border-primary language_card">
                                    <div class="card-header text-{{CommonHelper::getTextAlign($locale)}}">{{$language}}</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">{{$language}} State Name</label>
                                                    <input type="text" class="form-control" onkeyup="rtl(this);" name="{{ $locale }}[name]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter state name" value='{{ old($locale.'.name', $record->name) }}'>
                                                    @if ($errors->has($locale.'.name'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Update</button>
                            <a href="{{ route('admin.states.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- <script>
        function template(data) {
            return $("<span class="+data.id+"> "+data.text+" </span>");
        }
        $(document).ready(function() {
            $('.iconSelect').select2({
                allowClear: true,
                templateResult: template,
                templateSelection: template
            });
        });

    </script> -->
@endsection

@extends('layouts.admin.default')

@section('title',"Edit Category")

@section('header',"Edit Country")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.countries.index') }}">Manage Countries </a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Country</li>
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.countries.update',$record->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Code</label>
                                        <input type="text" class="form-control" name="code" placeholder="Enter Country Code" value="{{ old('code',$record->code) }}">
                                        @if ($errors->has('code'))
                                            <span class="error-message">
	                                            <strong>{{ $errors->first('code') }}</strong>
	                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Dial Code</label>
                                        <input type="text" class="form-control" name="dial_code" value="{{ old('dial_code',$record->dial_code) }}" placeholder="Enter Dial Code">
                                        @if ($errors->has('dial_code'))
                                            <span class="error-message">
	                                            <strong>{{ $errors->first('dial_code') }}</strong>
	                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Currency Name</label>
                                        <input type="text" class="form-control" name="currency_name" value="{{ old('currency_name',$record->currency_name) }}" placeholder="Enter Currency Name">
                                        @if ($errors->has('currency_name'))
                                            <span class="error-message">
	                                            <strong>{{ $errors->first('currency_name') }}</strong>
	                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Currency Symbol</label>
                                        <input type="text" class="form-control" name="currency_symbol" value="{{ old('currency_symbol',$record->currency_symbol) }}" placeholder="Enter Currency Symbol">
                                        @if ($errors->has('currency_symbol'))
                                            <span class="error-message">
	                                            <strong>{{ $errors->first('currency_symbol') }}</strong>
	                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Currency Code</label>
                                        <input type="text" class="form-control" name="currency_code" value="{{ old('currency_code',$record->currency_code) }}" placeholder="Enter Currency Code">
                                        @if ($errors->has('currency_code'))
                                            <span class="error-message">
	                                            <strong>{{ $errors->first('currency_code') }}</strong>
	                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <select name="status" class="form-control" value="{{ old('status',$record->status) }}">
                                            @php $options = CommonHelper::getStatusOption(); @endphp
                                            @foreach($options as $key=>$value)
                                                <option {{ $record->status == $key ? 'selected' : '' }} value="{{ $key }}"  > {{ $value }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('status'))
                                            <span class="error-message">
	                                            <strong>{{ $errors->first('status') }}</strong>
	                                        </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- @foreach(config('translatable.locales_name') as $language=>$locale) --}}
                                <div class="">
                                    {{-- <div class="card-header text-left">{{$language}}</div> --}}
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label float-left"> Country Name</label>
                                                    <input type="text" class="form-control" name="name" placeholder="Enter Country Name" value='{{ old('name', $record->name) }}'>
                                                    @if ($errors->has('name'))
                                                        <span class="error-message text-left">
                                                        <strong>{{ $errors->first('name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- @endforeach --}}
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Update</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

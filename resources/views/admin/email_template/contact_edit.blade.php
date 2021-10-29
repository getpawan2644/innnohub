@php
    use App\Models\Banner as Banner;
@endphp
@extends('layouts.admin.default')

@section('title',"Edit CMS")

@section('header',"Edit CMS")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Manage CMS </a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit CMS</li>
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.cms.contact-detail-update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Phone Number</label>
                                        <input type="text" class="form-control" name="phone_number" placeholder="Enter Phone Number" value="{{ old('phone_number',$record->phone_number) }}">
                                        <span class="info_span"> NOTE: Please use comma(,) to enter multiple values<span>
                                        @if ($errors->has('phone_number'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Email Address</label>
                                        <input type="text" class="form-control" name="email" placeholder="Enter Email" value="{{ old('email',$record->email) }}">
                                        <span class="info_span"> NOTE: Please use comma(,) to enter multiple values<span>
                                        @if ($errors->has('email'))
                                            <span class="error-message">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Address</label>
                                        <input type="text" class="form-control" name="address" placeholder="Enter Adddress" value="{{ old('address',$record->address) }}">
                                        @if ($errors->has('address'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('address') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Fax</label>
                                        <input type="text" class="form-control" name="fax" placeholder="Enter Fax" value="{{ old('fax',$record->fax) }}">
                                        <span class="info_span"> NOTE: Please use comma(,) to enter multiple values<span>
                                        @if ($errors->has('fax'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('fax') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Update</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){
        });
    </script>
@endsection

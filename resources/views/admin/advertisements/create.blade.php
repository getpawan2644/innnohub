@php
    $categories = \App\Models\ClientCategory::getClientCategoryList();
@endphp
@extends('layouts.admin.default')

@section('title',"Add Advertisements")

@section('header',"Add Advertisements")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.advertisements.index') }}">Manage Advertisements </a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Advertisements</li>
@endsection

@section('content')

<script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.advertisements.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Advertisement Link</label>
                                        <input type="text" class="form-control" name="url" placeholder="Enter advertisement link" value='{{ old('url', $record->url) }}'>
                                        @if ($errors->has('url'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('url') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card card-border-primary">
                                <div class="card-header text-left">Advertisement Image</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="form-group select-photo">
                                                <ul class="client-logo-image-list">
                                                    @if(!empty(old('image',$record->image)))
                                                        @php $oldImagesURL = old('image_thumbnail_url',$record->image_thumbnail_url);
                                                             $oldlogoImages = old('image',$record->image);
                                                             $oldtumbImages = old('image_thumbnail',$record->image_thumbnail);
															//dd($record->logo_thumbnail_url);
                                                        @endphp
                                                        <li class="mr-5 paidImage">
                                                            <div class="coustom-input">
                                                                <a href="javascript:void(0);" class="remove-logo-pic">X</a>
                                                                <img src="{{$oldImagesURL}}"/>
                                                                <input type="hidden" class="image_input" name="image" value="{{$oldlogoImages}}"/>
                                                                <input type="hidden" class="image_url" name="images_url" value="{{$oldImagesURL}}"/>
                                                                <input type="hidden" class="image_thumbnail_input" name="image_thumbnail" value="{{$oldtumbImages}}"/>
                                                                <input type="hidden" class="image_thumbnail_url" name="image_thumbnail_url" value="{{$oldImagesURL}}"/>
                                                            </div>
                                                            <div class="image-title upload">&nbsp;</div>
                                                        </li>
                                                    @endif
                                                    <li class="green-photo mr-3 null_class {{!empty(old('image',$record->image))?"hide":''}}">
                                                        <div class="coustom-input">
                                                            <input type="file" class="logo-image custom-file-input">
                                                        </div>
                                                        <div class="progress-bar img-progress-bar" role="progressbar"></div>
                                                        <div class="image-title">Add Photo</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
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
                                                    <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Advertisement Title</label>
                                                    <input type="text" class="form-control" name="{{ $locale }}[title]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter advertisement title" value="{{ old($locale.'.title', $record->translateOrNew($locale)->title) }}">
                                                    @if ($errors->has($locale.'.title'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.title') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Add</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('admin.advertisements.jscript')
@endsection

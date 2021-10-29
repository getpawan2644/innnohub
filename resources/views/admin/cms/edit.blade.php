@php
    use App\Models\Banner as Banner;
@endphp
@extends('layouts.admin.default')

@section('title',"Edit CMS")

@section('header',"Edit CMS")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.cms.index') }}">Manage CMS </a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit CMS</li>
@endsection

@section('content')
    <script src="//cdn.ckeditor.com/4.6.2/full-all/ckeditor.js"></script>
    <script>
        {{--var options = {--}}
        {{--    filebrowserImageBrowseUrl: '{{env("APP_URL")}}'+'admin/laravel-filemanager?type=Images&_token={{csrf_token()}}',--}}
        {{--    filebrowserImageUploadUrl: '{{env("APP_URL")}}'+'admin/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',--}}
        {{--    filebrowserBrowseUrl: '{{env("APP_URL")}}'+'admin/laravel-filemanager?type=Files&_token={{csrf_token()}}',--}}
        {{--    filebrowserUploadUrl: '{{env("APP_URL")}}'+'admin/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',--}}
        {{--    autoParagraph :false,--}}
        {{--    language: 'en'--}}
        {{--};--}}
    </script>
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.cms.update',$record->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Page Name</label>
                                        <input type="text" class="form-control" {{(CommonHelper::isEditable($record->page_name))?"":"readonly"}} name="page_name" placeholder="Enter Page Name" value="{{ old('page_name',$record->page_name) }}">
                                        @if ($errors->has('page_name'))
                                            <span class="error-message">
										<strong>{{ $errors->first('page_name') }}</strong>
									</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Page Type</label>
                                        <select type="text" class="form-control" name="page_type" placeholder="Please choose a category">
                                            <option {{ old("page_type",$record->page_type) == \App\Models\Cms::PAGE_SERVICE ? 'selected' : '' }} value="{{\App\Models\Cms::PAGE_SERVICE}}">{{\App\Models\Cms::PAGE_SERVICE}}</option>
                                            <option {{ old("page_type",$record->page_type) == \App\Models\Cms::PAGE_GENERAL ? 'selected' : '' }} value="{{\App\Models\Cms::PAGE_GENERAL}}">{{\App\Models\Cms::PAGE_GENERAL}}</option>
                                        </select>
                                        @if ($errors->has('page_type'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('page_type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @foreach(config('translatable.locales_name') as $language=>$locale)
                                <div class="card card-border-primary language_card">
                                    <div class="card-header text-{{CommonHelper::getTextAlign($locale)}}">{{$language}}</div>
                                    <div class="card-body">
                                        <div class="row button_checked">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">Title</label>
                                                    <input type="text" class="form-control" onkeyup="rtl(this);" name="{{ $locale }}[title]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter Page Title" value='{{ old($locale.'.title', $record->translateOrNew($locale)->title) }}'>
                                                    @if ($errors->has($locale.'.title'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.title') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">{{$language}} URL</label>
                                                    <div class="input-group md-3">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-primary text-white">{{ env('APP_URL') }}</span>
                                                        </div>
                                                        <input type="text" class="form-control" {{(CommonHelper::isEditable($record->page_name))?"":"readonly"}} onkeyup="rtl(this);" name="{{ $locale }}[url]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter the title" value='{{ old($locale.'.url', $record->translateOrNew($locale)->url) }}'>
                                                    </div>

                                                    @if ($errors->has($locale.'.url'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.url') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row {{(CommonHelper::isEditable($record->page_name))?"":"hide"}}">
                                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Meta Keyword</label>
                                                    <input type="text" class="form-control" onkeyup="rtl(this);" name="{{ $locale }}[meta_keyword]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter meta keyword" value='{{ old($locale.'.meta_keyword', $record->translateOrNew($locale)->meta_keyword) }}'>
                                                    @if ($errors->has($locale.'.meta_keyword'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.meta_keyword') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Meta Description</label>
                                                    <input type="text" class="form-control" onkeyup="rtl(this);" name="{{ $locale }}[meta_desc]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter meta description" value='{{ old($locale.'.meta_desc', $record->translateOrNew($locale)->meta_desc) }}'>
                                                    @if ($errors->has($locale.'.meta_desc'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.meta_desc') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row {{(CommonHelper::isEditable($record->page_name))?"":"hide"}}">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label style="width:100%" class="control-label text-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Content</label>
                                                    <textarea id="cms-description-{{$locale}}" name="{{ $locale }}[content]" class="form-control" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter Banner Description">{{trim(old($locale.'.content', $record->translateOrNew($locale)->content))}}</textarea>
                                                    {{--                                                    <input type="text" class="form-control" onkeyup="rtl(this);" name="{{ $locale }}[heading]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter heading of banner" value='{{ old($locale.'.heading', $record->heading) }}'>--}}
                                                    @if ($errors->has($locale.'.content'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.content') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    var route_prefix = "{{env('APP_URL')}}/admin/laravel-filemanager";
                                    var options = {
                                        filebrowserImageBrowseUrl: route_prefix + '?type=Images',
                                        filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
                                        filebrowserBrowseUrl: route_prefix + '?type=Files',
                                        filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}',
                                        language:"{{$locale}}"
                                    };
                                    CKEDITOR.replace( 'cms-description-{{$locale}}',	options );
                                </script>
                            @endforeach
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Update</button>
                            <a href="{{ route('admin.cms.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
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

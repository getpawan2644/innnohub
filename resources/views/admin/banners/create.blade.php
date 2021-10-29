@php
    use App\Models\Banner as Banner;
@endphp
@extends('layouts.admin.default')

@section('title',"Add Banner")

@section('header',"Add Banner")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Manage Categories </a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Banner</li>
@endsection

@section('content')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: APP_URL+'admin/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: APP_URL+'admin/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: APP_URL+'admin/laravel-filemanager?type=Files',
            filebrowserUploadUrl: APP_URL+'admin/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
            autoParagraph :false,
            language: 'en'
        };
    </script>
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.banners.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Banner Position</label>
                                        <select class="form-control banner_position" name="banner_position" value="{{ old('status',$record->banner_position) }}">
                                            <option {{ (old("banner_position",$record->banner_position) == Banner::TOP_BANNER)? 'selected' : '' }} value="{{Banner::TOP_BANNER}}">{{Banner::TOP_BANNER}}</option>
                                            <option {{ old("banner_position",$record->banner_position) == Banner::MIDDLE_BANNER ? 'selected' : '' }} value="{{Banner::MIDDLE_BANNER}}">{{Banner::MIDDLE_BANNER}}</option>
                                            <option {{ old("banner_position",$record->banner_position) == Banner::BOTTOM_BANNER ? 'selected' : '' }} value="{{Banner::BOTTOM_BANNER}}">{{Banner::BOTTOM_BANNER}}</option>
                                        </select>
                                    </div>
                                    <div class="form-check top_banner">
                                        <input type="hidden" name="have_button" value="0">
                                        <input class="form-check-input have_button" name="have_button" type="checkbox" {{(old("have_button",$record->have_button))?'checked':''}} value="1">
                                        <label class="form-check-label" for="defaultCheck1">
                                            Do You want a button on banner?
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="row button_checked {{(old("have_button",$record->have_button))?'':'hide'}} top_banner">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label"> Button URL</label>
                                        <input type="text" class="form-control" onkeyup="rtl(this);" name="button_url" placeholder="Enter full URL" value='{{ old('button_url', $record->button_url) }}'>
                                        @if ($errors->has('button_url'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('button_url') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @foreach(config('translatable.locales_name') as $language=>$locale)
                                <div class="card card-border-primary language_card">
                                    <div class="card-header text-{{CommonHelper::getTextAlign($locale)}}">{{$language}}</div>
                                    <div class="card-body">
                                        <div class="row button_checked {{(old("have_button",$record->have_button))?'':'hide'}} top_banner">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">Button label</label>
                                                    <input type="text" class="form-control" onkeyup="rtl(this);" name="{{ $locale }}[button_label]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter the button label" value='{{ old($locale.'.button_label', $record->button_label) }}'>
                                                    @if ($errors->has($locale.'.button_label'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.button_label') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row top_banner">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Banner Title</label>
                                                    <input type="text" class="form-control" onkeyup="rtl(this);" name="{{ $locale }}[title]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter the title" value='{{ old($locale.'.title', $record->title) }}'>
                                                    @if ($errors->has($locale.'.title'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.title') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row top_banner {{(old("banner_position",$record->banner_position)==Banner::TOP_BANNER)?'':'hide'}}">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label style="width:100%" class="control-label text-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Banner Heading</label>
                                                    <textarea id="banner-heading-{{$locale}}" name="{{ $locale }}[heading]" class="form-control" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter Banner heading">{{trim(old($locale.'.heading', $record->translateOrNew($locale)->heading))}}</textarea>
                                                    {{--                                                    <input type="text" class="form-control" onkeyup="rtl(this);" name="{{ $locale }}[heading]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter heading of banner" value='{{ old($locale.'.heading', $record->heading) }}'>--}}
                                                    @if ($errors->has($locale.'.heading'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.heading') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row top_banner">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label style="width:100%" class="control-label text-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Banner Description</label>
                                                    <textarea id="banner-description-{{$locale}}" name="{{ $locale }}[description]" class="form-control" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter Banner Description">{{trim(old($locale.'.description', $record->translateOrNew($locale)->description))}}</textarea>
{{--                                                    <input type="text" class="form-control" onkeyup="rtl(this);" name="{{ $locale }}[heading]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter heading of banner" value='{{ old($locale.'.heading', $record->heading) }}'>--}}
                                                    @if ($errors->has($locale.'.description'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.description') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label text-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Banner Link</label>
                                                    <input type="text" class="form-control" onkeyup="rtl(this);" name="{{ $locale }}[banner_link]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter full URL" value='{{old($locale.'.banner_link', $record->translateOrNew($locale)->banner_link)}}'>
                                                    @if ($errors->has($locale.'.banner_link'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.banner_link') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{$language}} Banner Image</label>
                                                    <input type="file" class="form-control" name="{{ $locale }}[image]" value=''>
                                                    @if ($errors->has($locale.'.image'))
                                                        <span class="error-message">
                                                             <strong>{{ $errors->first($locale.'.image') }}</strong>
                                                         </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    options.language = "{{$locale}}";
                                    CKEDITOR.replace( 'banner-description-{{$locale}}',	options );
                                    CKEDITOR.replace( 'banner-heading-{{$locale}}',	options );
                                </script>
                            @endforeach
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Add</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){
            @php
            if(!empty(old("banner_position")) && old("banner_position")!= \App\Models\Banner::TOP_BANNER){
            @endphp
                $(".top_banner").hide();
            @php
              }
            @endphp
            $(".banner_position").change(function () {
               if($(this).val()!="{{Banner::TOP_BANNER}}"){
                   $(".top_banner").hide();
               }else{
                   $(".top_banner").show();
               };
            });
            $(".have_button").change(function () {
                if($(this).is(":checked")){
                    $(".button_checked").show();
                    $(".button_checked").removeClass("hide");
                }else{
                    $(".button_checked").hide();
                    $(".button_checked").addClass("hide");
                };
            });
        });
    </script>
@endsection

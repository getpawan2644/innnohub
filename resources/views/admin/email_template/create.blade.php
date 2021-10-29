@php
    use App\Models\Banner as Banner;
@endphp
@extends('layouts.admin.default')

@section('title',"Edit Email Template")

@section('header',"Edit Email Template")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.email-template.index') }}">Manage Email Template </a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Email Template</li>
@endsection

@section('content')
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>

        var route_prefix = "{{env('APP_URL')}}/admin/laravel-filemanager";
        var options = {
            filebrowserImageBrowseUrl: route_prefix + '?type=Images',
            filebrowserImageUploadUrl: route_prefix + '/upload?type=Images&_token={{csrf_token()}}',
            // filebrowserBrowseUrl: route_prefix + '?type=Files',
            // filebrowserUploadUrl: route_prefix + '/upload?type=Files&_token={{csrf_token()}}',
        };
    </script>
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.email-template.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Page Name</label>
                                        <input type="text" class="form-control" name="page_name" placeholder="Enter Page Name" value="{{ old('page_name',$record->page_name) }}" >
                                        @if ($errors->has('page_name'))
                                            <span class="error-message">
										<strong>{{ $errors->first('page_name') }}</strong>
									</span>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            {{-- @foreach(config('translatable.locales_name') as $language=>$locale) --}}
                                <div class="">
                                    {{-- <div class="card-header text-left">{{$language}}</div> --}}
                                    <div class="card-body">
                                        <div class="row button_checked">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label float-left">Title</label>
                                                    <input type="text" class="form-control" name="title" placeholder="Enter Page Title" value='{{ old('title', $record->title) }}'>
                                                    @if ($errors->has('title'))
                                                        <span class="error-message text-left">
                                                            <strong>{{ $errors->first('title') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label style="width:100%" class="control-label text-left">Content</label>
                                                    <textarea id="email-template-description" name="content" class="form-control" placeholder="Enter Banner Description">{{trim(old('content', $record->content))}}</textarea>
                                                    @if ($errors->has('content'))
                                                        <span class="error-message text-left">
                                                            <strong>{{ $errors->first('content') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    CKEDITOR.replace( 'email-template-description',	options );
                                </script>
                            {{-- @endforeach --}}
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Update</button>
                            <a href="{{ route('admin.email-template.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
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

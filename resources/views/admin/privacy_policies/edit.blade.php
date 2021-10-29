@extends('layouts.admin.default')

@section('title',"Edit Policies")

@section('header',"Edit Policies")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.privacy_policies.index') }}">Manage Policies </a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Policy</li>
@endsection

@section('content')
    <script src="//cdn.ckeditor.com/4.6.2/full-all/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: APP_URL+'admin/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: APP_URL+'admin/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
            filebrowserBrowseUrl: APP_URL+'admin/laravel-filemanager?type=Files',
            filebrowserUploadUrl: APP_URL+'admin/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
            language: 'en'
        };
    </script>

    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.privacy_policies.update',$record->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            @foreach(config('translatable.locales_name') as $language=>$locale)
{{--                                {{pr($record->translateOrNew($locale)->answer)}}--}}
                                <div class="card card-border-primary language_card">
                                    <div class="card-header text-{{CommonHelper::getTextAlign($locale)}}">{{$language}}</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Title</label>
                                                    <input type="text" class="form-control" name="{{ $locale }}[title]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter Privacy Policy title" value="{{old($locale.'.title', $record->translateOrNew($locale)->title)}}">
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
                                                    <label class="control-label">{{$language}} Description</label>
                                                    <textarea id="description-{{$locale}}" rows="20" placeholder="Enter Details" class="form-control" name="{{$locale}}[description]">{{ old($locale.'.description', $record->translateOrNew($locale)->description) }}</textarea>
                                                    @if ($errors->has($locale.'.description'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.description') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    options.language = "{{$locale}}";
                                    CKEDITOR.replace( 'description-{{$locale}}',	options );
                                </script>
                            @endforeach
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Update</button>
                            <a href="{{ route('admin.privacy_policies.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
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

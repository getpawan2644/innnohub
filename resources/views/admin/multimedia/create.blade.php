@php
    use App\Models\Banner as Banner;
@endphp
@extends('layouts.admin.default')

@section('title',"Add Banner")

@section('header',"Add Banner")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.gallery.index',$user->id) }}">Manage galaries </a></li>
    <li class="breadcrumb-item active" aria-current="page">Add gallary</li>
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
                        <form class="forms-sample" method="POST" action="{{ route('admin.gallery.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            <div class="form-group">
                                                                @php $alluser = CommonHelper::getAllUser(); @endphp
                                                               
                                                                <label class="control-label">User</label>
                                                                <input type="hidden" name="user_id" value="{{$user->id}}" />
                                                                <input type="text" class="form-control" name="user_name" value="{{$user->fullname}}" readonly />
                                                                {{--                                        <select name="user_id"  id="company_size" class="form-control">--}}
                                                                @if ($errors->has('user_id'))
                                                                    <span class="error-message">
                                                                        <strong>{{ $errors->first('user_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                          
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                             
                                                                <label class="control-label float-left">Name</label>
                                                                <input type="text" class="form-control" name="name" placeholder="Name" value='{{ old('service_name') }}'>
                                                                @if ($errors->has('name'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('name') }}</strong>
                                                                    </span>
                                                                @endif
                                                           
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                             
                                                                <label class="control-label float-left">Image</label>
                                                                <input type="file" class="form-control" name="image" placeholder="" value='{{ old('image') }}'>
                                                                @if ($errors->has('image'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('image') }}</strong>
                                                                    </span>
                                                                @endif
                                                           
                                                        </div></br>

                            <button type="submit" class="btn btn-primary mr-2 mt-4">Add</button>
                            <a href="{{ route('admin.gallery.index',$user->id) }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
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

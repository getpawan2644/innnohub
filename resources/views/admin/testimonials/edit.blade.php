@php
    use App\Models\Banner as Banner;
@endphp
@extends('layouts.admin.default')

@section('title',"Edit Testimonial")

@section('header',"Edit Testimonials")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.testimonials.index',$user->id) }}">Manage Testimonials </a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Testimonial</li>
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
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.testimonials.update',$record->id) }}" enctype="multipart/form-data">
                            @csrf
                            

                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        @php $alluser = CommonHelper::getAllUser(); @endphp
                                       
                                        <label class="control-label">User</label>
                                        <input type="hidden" name="user_id" value="{{$user->id}}" />
                                        <input type="text" class="form-control" name="user_name" value="{{$user->fullname}}"  />
                                        @if ($errors->has('user_id'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('user_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                           
                               <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                      {{-- <div class="form-group"> --}}
                                          <label class="control-label float-left">Name</label>
                                          <input type="hidden" class="form-control" name="user_id" value='{{ old('user_id',$data->user_id) }}'>
                                         
                                          <input type="text" class="form-control" name="name" placeholder="Name" value='{{ old('service_name',$data->name) }}'>
                                         
                                         @if ($errors->has('name'))
                                              <span class="error-message float-left">
                                                  <strong>{{ $errors->first('name') }}</strong>
                                              </span>
                                          @endif
                                      {{-- </div> --}}
                                  </div>
                                  <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                     
                                          <label class="control-label float-left">Comment</label>
                                          <textarea class="form-control"  rows="5" name="comment">{{ old('description',$data->comment) }}</textarea>
                                              @if ($errors->has('comment'))
                                              <span class="error-message float-left">
                                                  <strong>{{ $errors->first('comment') }}</strong>
                                              </span>
                                          @endif
                                   
                                  </div>

                                                  
                          
                       
                               
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Update</button>
                            <a href="{{ route('admin.testimonials.index',$user->id) }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){
            $('.banner_position').attr("style", "pointer-events: none;");
            $(".banner_position").change(function () {
                if($(this).val()!="{{Banner::TOP_BANNER}}"){
                    $(".top_banner").hide();
                    $(".top_banner").addClass("hide");
                }else{
                    $(".top_banner").show();
                    $(".top_banner").removeClass("hide");
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

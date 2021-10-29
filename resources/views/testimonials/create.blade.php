@php
use App\Model\User;
use App\Models\Country;
$countries = Country::getCountryList();
@endphp
@php

@endphp
@extends('layouts.default')
@section('title',__("header.profile_title"))
@section('content')

<!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>

  <style type="text/css">
img {
display: block;
max-width: 100%;
}
.preview {
overflow: hidden;
width: 160px; 
height: 160px;
margin: 10px;
border: 1px solid red;
}
.modal-lg{
max-width: 1000px !important;
}
</style>
<!-- inner-header -->
  <section class="p-0">
    <div class="banner inner-banner">
      <div class="banner-wrap">
        <div class="container sml-container">
          <div class="row">
            <div class="col-lg-12">
              <!-- banner text -->
              <div class="banner-text">
                <h2>Add Case Studies</h2>
              </div>
              <!-- banner text end -->
            </div>
          </div>
        </div>
      </div>
      <img class="banner-bg" src="{{ asset('image/inner-bg.png') }}" alt="banner">
    </div>
  </section>
  <!-- inner-header end -->
    <section class="sidebar_with_container">
        <div class="container sml-container">
            <div class="row">
                @include("elements.layout.sidebar")
                <div class="col-lg-10 col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <section class="page-content container-fluid">

                                      <div class="card-body">
                                                <form class="forms-sample" method="POST" action="{{url("testimonials/store")}}" enctype="multipart/form-data">
                                                    @csrf
                                       
                                                    <input type="hidden" class="form-control" name="user_id" placeholder="" value='{{ Auth::user()->id }}'>
                                                              
                                                      
                                                           <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                             
                                                                <label class="control-label float-left">Name</label>
                                                                <input type="text" class="form-control" name="name" placeholder="Name" value='{{ old('service_name') }}'>
                                                                @if ($errors->has('name'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('name') }}</strong>
                                                                    </span>
                                                                @endif
                                                           
                                                        </div></br>
                                                       <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                           
                                                                <label class="control-label float-left">Comment</label>
                                                                <textarea class="form-control"  rows="5" name="comment"></textarea>
                                                                    @if ($errors->has('comment'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('comment') }}</strong>
                                                                    </span>
                                                                @endif
                                                         
                                                        </div>
                                                   
                                                    <div class="row language-left">
                                                        <button type="submit" class="inno_btn px-4 mt-4">{{__("content.service_btn")}}</button>
{{--                                                        <a href="http://localhost/sabq/admin/categories" class="btn sabq-btn sabq-frm-btn">Cancel</a>--}}
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>



<script type="text/javascript">
  $(document).ready(function() {
    $('#demo').multiselect({
      includeSelectAllOption: true
    });
  });
</script>
<script>$("#blah").click(function () {
    $("#fileImage").trigger('click');
});</script>

    </section>

   


@endsection

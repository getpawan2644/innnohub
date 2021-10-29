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
                <h2>Update Testimonial</h2>
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
                                                <form class="forms-sample" method="POST" action="{{route('testimonials.update', $data->id)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    
                                                    <div class="row">
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

                                                    </div>

                                                  
                                             <div class="row language-left">
                                                        <button type="submit" class="inno_btn px-4 mt-4">Update</button>
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

                    <!--------------------------------------------------------Model--------------------------------------->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="modalLabel">Crop Image Before Upload</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">×</span>
</button>
</div>
<div class="modal-body">
<div class="img-container">
<div class="row">
<div class="col-md-8">
<img id="image" src="https://avatars0.githubusercontent.com/u/3456749">
</div>
<div class="col-md-4">
<div class="preview"></div>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
<button type="button" class="btn btn-primary" id="crop">Crop</button>
</div>
</div>
</div>
</div>

    </section>

    <script>
      $('#multiselect').hide();
       $(".cat_change").change(function(){
        $('#multiselect1').hide();
         $('#multiselect').show();

        });
    </script>

    <script type="text/javascript">
  $(document).ready(function() {
    $('#demo').multiselect({
      includeSelectAllOption: true
    });
  });
</script>


<script type="text/javascript">
  $(document).ready(function() {


    $('#demo').multiselect({
      includeSelectAllOption: true
    });
  });
</script>
<script>
 $('#blah').attr('src',data.image);
  document.getElementById("logo").value = data.logo;

  $("#blah").click(function () {
    $("#fileImage").trigger('click');
});</script>


@endsection

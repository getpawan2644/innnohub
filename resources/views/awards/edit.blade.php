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


  <!-- inner-header -->
  <section class="p-0">
    <div class="banner inner-banner">
      <div class="banner-wrap">
        <div class="container sml-container">
          <div class="row">
            <div class="col-lg-12">
              <!-- banner text -->
              <div class="banner-text">
                <h2>Update Award</h2>
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
                                                <form class="forms-sample" method="POST" action="{{route('awards.update', $data->id)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">Name</label>
                                                                <input type="hidden" class="form-control" name="user_id" value='{{ old('user_id',$data->user_id) }}'>
                                                               
                                                                <input type="text" class="form-control" name="name" placeholder="Name" value='{{ old('name',$data->name) }}'>
                                                               
                                                               @if ($errors->has('name'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                        <input type="hidden"  id="logo" name="image" value="{{$data->image}}">
                                                                <label class="control-label float-left">Upload Image</label></br>
                                                                <img id="blah" src="{{ asset('awards/'.$data->image) }}" alt="your image"style="cursor:pointer;width: 112px;"/></br>
                                                                 <input type="file" class="image custom-file-input" name="logo" class="form-control" id="fileImage" accept="image/*" capture>
                                                                   
                                                                @if ($errors->has('image'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('image') }}</strong>
                                                                    </span>
                                                                @endif
                                                        </div>

                                                    </div>

                                                    <div class="row">
                                                   
                                             
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">{{__("form.service_description")}}</label>
                                                                <textarea class="form-control"  rows="5" name="description">{{$data->description}}</textarea>
                                                                   
                                                                    @if ($errors->has('description'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('description') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
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

                   

    </section>

   
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

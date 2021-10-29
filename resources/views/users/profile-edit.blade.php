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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.css"/>
<script src="https://cdnjs.cloudflare.com/ajax/libs/cropperjs/1.5.6/cropper.js"></script>
 <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCoypRMHA20RreQyPb9VSNqC33Rjs9u1Gc&libraries&libraries=places"></script>

  
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
  <section class="p-0">
    <div class="banner inner-banner">
      <div class="banner-wrap">
        <div class="container sml-container">
          <div class="row">
            <div class="col-lg-12">
              <!-- banner text -->
              <div class="banner-text">
                <h2>{{__("content.edit_profile")}}</h2>
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
                            <section class="page-content p-0">

                                      <div class="card-body">
                                        @if($user->user_type == 'vendor')
                                                <form class="forms-sample" method="POST" action="{{route("user.update-profile")}}" enctype="multipart/form-data">
                                                    @csrf

                                                     <div class="col-lg-12">
                                                              <h5 class="text-start mb-0">Select Criteria</h5>
                                                          </div>
                                                      <div class="col-lg-12">
                                                        <div class="reg-checkboxes">
                                                            @if($categories->count()>0)
                                                            @php $slNo =  0; @endphp
                                                            @foreach($categories as $category)
                                                            <!-- category checkbox -->
                                                            <div class="form-check">
                                                                <input {{ $slNo==0?"checked required":'' }}  class="form-check-input cat_change" type="radio" name="category_id" value="{{@$category->slug}}" id="{{@$category->name}}_id">
                                                                <label class="form-check-label" for="{{@$category->name}}_id">
                                                                    {{@$category->name}}
                                                                </label>
                                                            </div>
                                                            <!-- category checkbox end -->
                                                            @php $slNo++; @endphp
                                                            @endforeach
                                                            @endif
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="row">
                                                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                    <!-- multiselect -->
                                                     <label class="control-label float-left">Select Sub Category</label>
                                                    <div class="inno-multiselect" id="multiselect">
                                                        <span class="down-arrow"><i class="icofont-simple-down"></i></span>
                                                        <select id="example-getting-started" name="sub_category[]" multiple="multiple">
                                                        </select>

                                                     </div>
                                                     <div class="inno-multiselect"  id="multiselect1">
                                                        <span class="down-arrow"><i class="icofont-simple-down"></i></span>
                                                         
                                                          @php $data= App\Models\SubCategory::get()->toArray(); 
                                                               $subdata= explode(",",$user->subcategory_id);
                                                          @endphp
                                                       
                                                     <select  name="sub_category[]" multiple="multiple" required id="demo">
                                                          @foreach($records as $key=>$value)
                                                              <option value="{{$value['id']}}" @if(in_array($value['id'],$subdata)) selected="selected" @endif>{{$value['name']}}</option>
                                                            @endforeach
                                                        </select>
                                                         </div>

                                                    <!-- multiselect end -->

                                                    </div>
                                                        <input type="hidden"  id="logo" name="image" value="{{$user->image}}">
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                       
                                                                <label class="control-label float-left"></label>
                                                                <img id="blah" src="{{ asset('user/'.$user->image) }}" alt="your image"style="cursor:pointer;width: 112px;"/>
                                                                 <input type="file" class="image custom-file-input" class="form-control" id="fileImage" accept="image/*" capture style="display:none">
                                                                   
                                                                @if ($errors->has('image'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('image') }}</strong>
                                                                    </span>
                                                                @endif
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">{{__("form.email")}}</label>
                                                                <input type="text" class="form-control" name="email" placeholder="{{__("form.email")}}" readonly value="{{$user->email}}">
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">{{__("form.first_name")}}</label>
                                                                <input type="text" class="form-control" name="first_name" placeholder="{{__("form.first_name")}}" value='{{ old('first_name', $user->first_name) }}'>
                                                                @if ($errors->has('first_name'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('first_name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">{{__("form.last_name")}}</label>
                                                                <input type="text" class="form-control" name="last_name" placeholder="{{__("form.enter_l_name")}}" value='{{ old('last_name', $user->last_name) }}'>
                                                                @if ($errors->has('last_name'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('last_name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">Description</label>
                                                               <textarea id="w3review" name="description" rows="4" cols="50">{{ old('description', $user->description) }}</textarea>
                                                                @if ($errors->has('description'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('description') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">{{__("form.select_country")}}</label>
                                                                <select type="text" class="form-control country" name="country_id"  value="{{ old('country_id',$user->country_id) }}">
                                                                    <option value="">
                                                                        {{__("form.select_country_name")}}
                                                                    </option>
                                                                    @foreach($countries as $country)
                                                                        <option {{ old("country_id",$user->country_id) == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{$country->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('country_id'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('country_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">{{__("form.phone_number")}}</label>
                                                                <input type="hidden" id="country_code" name="country_code" value="{{ (old('country_code', $user->country_code))?old('country_code', $user->country_code):'qa' }}">
                                                                <input type="hidden" id="dial_code" name="dial_code" value="{{(old('dial_code', $user->dial_code))?old('dial_code', $user->dial_code):'974'}}">
                                                                <input type="tel" onclick="this.setSelectionRange(0, this.value.length)" class="form-control" name="mobile" id="mobile" value="{{ old('mobile', $user->mobile) }}" placeholder="{{__("form.enter_phone_number")}}">
                                                                @if ($errors->has('phone'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">Address</label>
                                                                <input type="text" class="form-control" value="{{ old('address', $user->address) }}" name="address" id="searchTextField" placeholder="Address" value=''>
                                                                @if ($errors->has('address'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('address') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">Link</label>
                                                                <input type="text" class="form-control" name="link"  placeholder="Link" value='{{ old('link', $user->link) }}'>
                                                                @if ($errors->has('link'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('link') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                    </div>
                                                    <div class="row col mt-3">

                                                        <label class="fs-5">HIGHLIGHTS</label>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-2">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">Funding Type</label>
                                                                <input type="text" class="form-control" name="fundind_type"  placeholder="Funding Type" value='{{ old('fundind_type', $user->fundind_type) }}'>
                                                                @if ($errors->has('fundind_type'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('fundind_type') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">Number Of Acquisitions</label>
                                                                <input type="number" class="form-control" name="number_of_acquisitions"  placeholder="Number Of Acquisitions" value='{{ old('number_of_acquisitions', $user->number_of_acquisitions) }}'>
                                                                @if ($errors->has('number_of_acquisitions'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('number_of_acquisitions') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">Number Of Investments</label>
                                                                <input type="number" class="form-control" name="number_of_investments"  placeholder="Number Of Investments" value='{{ old('number_of_investments', $user->number_of_investments) }}'>
                                                                @if ($errors->has('number_of_investments'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('number_of_investments') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">Number Of Exits</label>
                                                                <input type="number" class="form-control" name="number_of_exits"  placeholder="Number Of Exits" value='{{ old('number_of_exits', $user->number_of_exits) }}'>
                                                                @if ($errors->has('number_of_exits'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('number_of_exits') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">Total Funding Amount</label>
                                                                <input type="text" class="form-control" name="funding_amount"  placeholder="Funding Amount" value='{{ old('funding_amount', $user->funding_amount) }}'>
                                                                @if ($errors->has('funding_amount'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('funding_amount') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">Number Of Current Team Members</label>
                                                                <input type="number" class="form-control" name="number_of_team_members"  placeholder="Number Of Current Team Members" value='{{ old('number_of_team_members', $user->number_of_team_members) }}'>
                                                                @if ($errors->has('number_of_team_members'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('number_of_team_members') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">Number Of Investors</label>
                                                                <input type="number" class="form-control" name="number_of_investors"  placeholder="Number Of Investors" value='{{ old('number_of_investors', $user->number_of_investors) }}'>
                                                                @if ($errors->has('number_of_investors'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('number_of_investors') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                    </div>


                                                    <div class="row language-left">
                                                        <button type="submit" class="inno_btn px-4 mt-4">Next</button>
                                                      
{{--                                                        <a href="http://localhost/sabq/admin/categories" class="btn sabq-btn sabq-frm-btn">Cancel</a>--}}
                                                    </div>
                                                </form>
                                                @else
                                                         <form class="forms-sample" method="POST" action="{{route("user.update-profile-user")}}" enctype="multipart/form-data">
                                                    @csrf
                                                
                                                   
                                                    <div class="row">
                                                     
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mb-3">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">{{__("form.email")}}</label>
                                                                <input type="text" class="form-control" name="email" placeholder="{{__("form.email")}}" readonly value="{{$user->email}}">
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mb-3">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">{{__("form.first_name")}}</label>
                                                                <input type="text" class="form-control" name="first_name" placeholder="{{__("form.first_name")}}" value='{{ old('first_name', $user->first_name) }}'>
                                                                @if ($errors->has('first_name'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('first_name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mb-3">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">{{__("form.last_name")}}</label>
                                                                <input type="text" class="form-control" name="last_name" placeholder="{{__("form.enter_l_name")}}" value='{{ old('last_name', $user->last_name) }}'>
                                                                @if ($errors->has('last_name'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('last_name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mb-3">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">{{__("form.select_country")}}</label>
                                                                <select type="text" class="form-control country" name="country_id"  value="{{ old('country_id',$user->country_id) }}">
                                                                    <option value="">
                                                                        {{__("form.select_country_name")}}
                                                                    </option>
                                                                    @foreach($countries as $country)
                                                                        <option {{ old("country_id",$user->country_id) == $country->id ? 'selected' : '' }} value="{{ $country->id }}">{{$country->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                                @if ($errors->has('country_id'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('country_id') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mb-3">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">{{__("form.phone_number")}}</label>
                                                                <input type="hidden" id="country_code" name="country_code" value="{{ (old('country_code', $user->country_code))?old('country_code', $user->country_code):'qa' }}">
                                                                <input type="hidden" id="dial_code" name="dial_code" value="{{(old('dial_code', $user->dial_code))?old('dial_code', $user->dial_code):'974'}}">
                                                                <input type="tel" onclick="this.setSelectionRange(0, this.value.length)" class="form-control" name="mobile" id="mobile" value="{{ old('mobile', $user->mobile) }}" placeholder="{{__("form.enter_phone_number")}}">
                                                                @if ($errors->has('phone'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('phone') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                      
                                                        
                                                    </div>
                                                    
                                                    <div class="row language-left">
														<div class="col-sm-12">
                                                        <button type="submit" class="inno_btn px-4 mt-4">Update</button>
                                                      
{{--                                                        <a href="http://localhost/sabq/admin/categories" class="btn sabq-btn sabq-frm-btn">Cancel</a>--}}
														</div>
                                                    </div>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

    </section>

    <!--------------------------------------------------------Model--------------------------------------->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="modalLabel"> Image Before Upload</h5>
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

<script>$("#blah").click(function () {
    $("#fileImage").trigger('click');
});</script>
<script>
var $modal = $('#modal');
var image = document.getElementById('image');
var cropper;
$("body").on("change", ".image", function(e){
var files = e.target.files;
var done = function (url) {
image.src = url;
$modal.modal('show');
};
var reader;
var file;
var url;
if (files && files.length > 0) {
file = files[0];
if (URL) {
done(URL.createObjectURL(file));
} else if (FileReader) {
reader = new FileReader();
reader.onload = function (e) {
done(reader.result);
};
reader.readAsDataURL(file);
}
}
});
$modal.on('shown.bs.modal', function () {
cropper = new Cropper(image, {
aspectRatio: 1,
viewMode: 3,
preview: '.preview'
});
}).on('hidden.bs.modal', function () {
cropper.destroy();
cropper = null;
});
$("#crop").click(function(){
canvas = cropper.getCroppedCanvas({
width: 160,
height: 160,
});
canvas.toBlob(function(blob) {
url = URL.createObjectURL(blob);
var reader = new FileReader();
reader.readAsDataURL(blob); 
reader.onloadend = function() {
var base64data = reader.result; 
$.ajax({
type: "POST",
dataType: "json",
url: "crop-profileimage-upload",
data: {'_token': "{{ csrf_token() }}", 'image': base64data},
success: function(data){
  //document.getElementById('avatar').getAttribute('src') == data.image;
   $('#blah').attr('src',data.image);
  document.getElementById("logo").value = data.logo;

console.log(data.image);
$modal.modal('hide');
alert("Crop image successfully uploaded");
}
});
}
});
})


</script>
    <script>
        jQuery(document).ready(function(){
            var input = document.querySelector("#mobile");
            var iti = window.intlTelInput(input, {
                initialCountry: "{{ !empty(old('country_code', $user->country_code))?old('country_code', $user->country_code):'in' }}",
                //separateDialCode: true,
                //utilsScript:"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
                // any initialisation options go here
            });
            window.intlTelInputGlobals.loadUtils("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js");
            input.addEventListener("countrychange", function() {
                console.log(iti.getSelectedCountryData());
                let countryData = iti.getSelectedCountryData();
                document.getElementById('country_code').value =countryData.iso2;
                document.getElementById('dial_code').value =countryData.dialCode;
            });
        });
    </script>

    <script>
        function initialize() {
          var input = document.getElementById('searchTextField');
          new google.maps.places.Autocomplete(input);
        }

        google.maps.event.addDomListener(window, 'load', initialize);
    </script>

    <script>
$('document').ready(function(){
    @if(!empty(old("category_slug",$categories[0]->slug)))
    populateSubcategory("{{old("category_slug",$categories[0]->slug)}}");
    @endif


    $('body').on('change', '.cat_change', function(){
        // alert($(this).val())
        $category_id = $(this).val();
      
        // $subcategory = $('#subcategory_id')
        populateSubcategory($category_id);
    });

});

function populateSubcategory($categoryId=null, $subCategoryId=null){
    console.log($categoryId);
    console.log($subCategoryId);
        $category_id = $categoryId;
        $subcategory = $('#example-getting-started');
        $.ajax({
            url : "{{ route('ajax.subcategory') }}",
            data : {'category_slug':$category_id,'_token':"{{ csrf_token() }}"},
            type : 'POST',
            dataType: "json",
      cache: false,
      async: true,
      // contentType: false,
      // processData: false,
            success : function (response){
                 
                $subcategory.find('option').remove();
               // console.log(response.length);
                if(response.length < 0){
                 $subcategory.find('option').remove();
           

                    $subcategory.append($("<option/>", {
                        value: '',
                        text: "No Records Found"
                    }));
                } else {
          
           console.log(response.length);
           console.log('hii');
                    $subcategory.multiselect('dataprovider', response);


                    // $subcategory.append($("<option/>", {
                    //     value: "",
                    //     text: "Select Subcategory"
                    // }));
                    // $.each(response, function(key, value) {
                    //     if(value.id=="{{old("subcategory_id",$categories[0]->id)}}"){
                    //         $subcategory.append($("<option/>", {
                    //             value: value.id,
                    //             text: value.name,
                    //             selected:true
                    //         }));
                    //     }else{
                    //         $subcategory.append($("<option/>", {
                    //             value: value.id,
                    //             text: value.name
                    //         }));
                    //     }
                    // });
                    // $('#example-getting-started').multiselect('destroy');
                    // $subcategory.multiselect('refresh');
                    // $subcategory.trigger('change');

                    // setTimeout(function(){
                        // $subcategory.multipleSelect('refresh');
                    // }, 3000);
                    // console.log($subcategory);
          
          
                   
                }

            },
            beforeSend : function (){
                // $subcategory.html("<option>Loading </option>");
            },
            error : function () {
                $subcategory.find('option').remove();
                $subcategory.append($("<option/>", {
                    value: '',
                    text: "No Records Found"
                }));
                $subcategory.trigger('change');
            }
        });


        // $subcategory.multiselect('reload');
}

</script>
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
@endsection

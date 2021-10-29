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
                                                <form class="forms-sample" method="POST" action="{{route("user.update-profile-step-two")}}" enctype="multipart/form-data">
                                                    @csrf
                                                  
                                                    <div class="row">
                                                        
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">HEADQUARTERS REGIONS</label>
                                                                <input type="text" class="form-control" name="headquarter"  placeholder="Headquarters Regions" value='{{ old('headquarter', $user->headquarter) }}'>
                                                                @if ($errors->has('headquarter'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('headquarter') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">FOUNDED DATE</label>
                                                                <input type="text" class="form-control" name="founded_date"  placeholder="Funded Date" value='{{ old('founded_date', $user->founded_date) }}'>
                                                                @if ($errors->has('founded_date'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('founded_date') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">FOUNDERS</label>
                                                                <input type="text" class="form-control" name="founders"  placeholder="founders" value='{{ old('founders', $user->founders) }}'>
                                                                @if ($errors->has('founders'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('founders') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">LEGAL NAME</label>
                                                                <input type="text" class="form-control" name="legal_name"  placeholder="LEGAL NAME" value='{{ old('legal_name', $user->legal_name) }}'>
                                                                @if ($errors->has('legal_name'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('legal_name') }}</strong>
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
                                                                <label class="control-label float-left">RELATED HUBS</label>
                                                                <input type="text" class="form-control" name="hub"  placeholder="RELATED HUBS" value='{{ old('hub', $user->hub) }}'>
                                                                @if ($errors->has('hub'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('hub') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">STOCK SYMBOL</label>
                                                                <input type="text" class="form-control" name="stock_symbol"  placeholder="STOCK SYMBOL" value='{{ old('stock_symbol', $user->stock_symbol) }}'>
                                                                @if ($errors->has('stock_symbol'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('stock_symbol') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                          <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">COMPANY TYPE</label>
                                                                <input type="text" class="form-control" name="company_type"  placeholder="COMPANY TYPE" value='{{ old('company_type', $user->company_type) }}'>
                                                                @if ($errors->has('company_type'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('company_type') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                          <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">CONTACT EMAIL
</label>
                                                                <input type="email" class="form-control" name="contact_email"  placeholder="CONTACT EMAIL
" value='{{ old('contact_email', $user->contact_email) }}'>
                                                                @if ($errors->has('contact_email'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('contact_email') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                    </div>


                                                    <div class="row language-left">
                                                        <button type="submit" class="inno_btn px-4 mt-4">{{__("content.update_profile")}}</button>
                                                      
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
@endsection

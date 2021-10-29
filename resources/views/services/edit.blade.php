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
                <h2>Update Service</h2>
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
                                                <form class="forms-sample" method="POST" action="{{route('service.update', $data->id)}}" enctype="multipart/form-data">
                                                    @csrf
                                                    
                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                            {{-- <div class="form-group"> --}}
                                                                <label class="control-label float-left">{{__("form.service_name")}}</label>
                                                                <input type="hidden" class="form-control" name="user_id" value='{{ old('user_id',$data->user_id) }}'>
                                                               
                                                                <input type="text" class="form-control" name="service_name" placeholder="{{__("form.service_name")}}" value='{{ old('service_name',$data->service_name) }}'>
                                                               
                                                               @if ($errors->has('service_name'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('service_name') }}</strong>
                                                                    </span>
                                                                @endif
                                                            {{-- </div> --}}
                                                        </div>
                                                        <input type="hidden"  id="logo" name="logo" value="{{$data->logo}}">
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                       
                                                                <label class="control-label float-left">Upload Logo</label>
                                                                <img id="blah" src="{{ asset('service/'.$data->logo) }}" alt="your image"style="cursor:pointer;width: 112px;"/>
                                                                 <input type="file" class="image custom-file-input" class="form-control" id="fileImage" accept="image/*" capture style="display:none">
                                                                   
                                                                @if ($errors->has('logo'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('logo') }}</strong>
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
url: "crop-image-upload",
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


@endsection

@php
    use App\Models\Country;
    $countries = Country::getCountryList();
@endphp
@extends('layouts.admin.default')

@section('title',"Add Sevice")

@section('header',"Add Sevice")
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

@section('breadcrumb')
    @parent
        <li class="breadcrumb-item"><a href="{{ route('admin.service-list',$user->id) }}">Manage Services </a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Sevice</li>
    @endsection

@section('content')
	<section class="page-content container-fluid">
	    <div class="row">
	        <div class="col-12 grid-margin stretch-card">
	            <div class="card">
	                <div class="card-body">
	                    <form class="forms-sample" method="POST" action="{{ route('admin.service-store') }}" enctype="multipart/form-data">
                        @csrf
						
                               
                            <div class="row">
                                       <input type="hidden" class="form-control" name="serivce" placeholder="Enter service name" value='{{ $service }}'>


                                         <!--div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-12">
                                       
                                         <label class="control-label float-left">Select Category</label>
                                        <div class="inno-multiselect">
                                            
                                              <div class="reg-checkboxes">

                                                <select name="category_id" class="form-control cat_change">
                                                     @if($categories->count()>0)
                                                @php $slNo =  0; @endphp
                                                @foreach($categories as $category)
                                               
                                                  <option  value="{{@$category->slug}}" {{ $slNo==0?"selected required":'' }} id="{{@$category->name}}_id">{{@$category->name}}</option>
                                               
                                                @php $slNo++; @endphp
                                                @endforeach
                                                @endif
                                                </select>
                                               
                                               </div>
                                             @if ($errors->has('category'))
                                                        <span class="error-message float-left">
                                                            <strong>{{ $errors->first('category') }}</strong>
                                                        </span>
                                                    @endif
                                        </div>
                                         </div>

                                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-12">
                                                 
                                                     <label class="control-label float-left">Select Sub Category</label>
                                                    <div class="inno-multiselect">
                                                       
                                                        <select id="example-getting-started" class="form-control" name="sub_category[]" multiple="multiple" required>
                                                        </select>
                                                         @if ($errors->has('sub_category'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('sub_category') }}</strong>
                                                                    </span>
                                                                @endif
                                                    </div>
                                                  

                                             </div-->
                                      
                                 <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        @php $alluser = CommonHelper::getAllUser(); @endphp
                                       
                                        <label class="control-label">User</label>
                                        <input type="hidden" name="user_id" value="{{$user->id}}" />
                                        <input type="text" class="form-control" name="user_name" value="{{$user->fullname}}" readonly />
{{--                                        <select name="user_id"  id="company_size" class="form-control">--}}
{{--                                            <option disabled required selected>---Select User---</option>--}}
{{--                                            @foreach($alluser as $key=>$value)--}}
{{--                                            <!--option value="{{$value['id']}}" {{ old("user_id",$value['id']) }}>{{$value['first_name']}} {{$value['last_name']}}</option-->--}}
{{--                                            <option value="{{$value['id']}}" {{ old("user_id",$service) == $value['id'] ? 'selected' : '' }}>{{$value['first_name']}}</option>--}}
{{--                                           --}}
{{--                                            @endforeach--}}
{{--                                            </select>--}}
                                        @if ($errors->has('user_id'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('user_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Service Name</label>
                                        <input type="text" class="form-control" name="service_name" placeholder="Enter service name" value='{{ old('service_name') }}'>
                                        @if ($errors->has('service_name'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('service_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                               
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label float-left">{{__("form.service_description")}}</label>
                                        <textarea class="form-control"  rows="5" name="description"></textarea>
                                           
                                            @if ($errors->has('description'))
                                            <span class="error-message float-left">
                                                <strong>{{ $errors->first('description') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>

                                 <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                       
                                                                <label class="control-label float-left">Upload Logo</label></br>
                                                                <img id="blah" src="{{asset('img/iphone-camera-icon-150x150.jpg')}}" alt="your image"style="cursor:pointer;width: 112px;" />
                                                                 <input type="file" class="image custom-file-input" class="form-control" id="fileImage" accept="image/*" capture style="display:none">
                                                                   <input type="hidden"  id="logo-service" name="logo">
                                                                @if ($errors->has('logo'))
                                                                    <span class="error-message float-left">
                                                                        <strong>{{ $errors->first('logo') }}</strong>
                                                                    </span>
                                                                @endif
                                         </div>

                                 <!--div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    
                                        <label class="control-label">Images</label>
                                        
                                        
                                            <div><input type="file" name="images[]" class="form-control"></div>
                                            <div class="input_fields_wrap">
                                            </div>
                                            <button class="add_field_button" id="add">Add More Fields</button>
                                            
                                        
                                        @if ($errors->has('image'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('image') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                     <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    
                                        <label class="control-label">Tags</label>
                                        
                                        
                                            <div><input type="text" name="tag[]" class="form-control" required></div>
                                            <div class="input_fields_wrap1">
                                            </div>
                                            <button class="add_field_button1" id="add1">Add More Fields</button>
                                            
                                        
                                        @if ($errors->has('tag'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('tag') }}</strong>
                                            </span>
                                        @endif
                                    </div-->
                                </div>
                               
                            </div>

                                
                            </div>
                            
                         
	                    <button type="submit" class="btn btn-primary mr-2 mt-4">Add</button>
                        	<a href="{{ route('admin.service-list',$user->id) }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
	                    </form>
	                </div>
	            </div>
	        </div>
	    </div>

        <!--------------------------------------------------------Model--------------------------------------->
<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
<div class="modal-dialog modal-lg" role="document">
<div class="modal-content">
<div class="modal-header">
<h5 class="modal-title" id="modalLabel">Logo</h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">??</span>
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
url: "{{url('admin/services/add/crop-logo-upload')}}",
data: {'_token': "{{ csrf_token() }}", 'image': base64data},
success: function(data){
  //document.getElementById('avatar').getAttribute('src') == data.image;
   $('#blah').attr('src',data.image);
  document.getElementById("logo-service").value = data.logo;

console.log(data.logo);
$modal.modal('hide');
alert("Crop image successfully uploaded");
}
});
}
});
})


</script>
<script>$("#blah").click(function () {
    $("#fileImage").trigger('click');
});</script>
	</section>

<script>
    $(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $("#add"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="file" name="images[]"/><a href="#" class="remove_field" required>Remove'+x+'</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
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
    $(document).ready(function() {
    var max_fields1      = 10; //maximum input boxes allowed
    var wrapper1        = $(".input_fields_wrap1"); //Fields wrapper
    var add_button1      = $("#add1"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button1).click(function(e){ //on add input button click

        e.preventDefault();
        if(x < max_fields1){ //max input box allowed
            x++; //text box increment
            $(wrapper1).append('<div><input type="text" name="tag[]" class="form-control"required/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper1).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>

@endsection

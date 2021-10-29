<?php
    use App\Models\Country;
    $countries = Country::getCountryList();
?>


<?php $__env->startSection('title',"Edit Sevice"); ?>

<?php $__env->startSection('header',"Edit Sevice"); ?>
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
<?php $__env->startSection('breadcrumb'); ?>
    ##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
        <li class="breadcrumb-item"><a href="<?php echo e(route('admin.service-list',$user->id)); ?>">Manage Users </a></li>
        <li class="breadcrumb-item active" aria-current="page">Edit Sevice</li>
    <?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
	<section class="page-content container-fluid">
	    <div class="row">
	        <div class="col-12 grid-margin stretch-card">
	            <div class="card">
	                <div class="card-body">
	                    <form class="forms-sample" method="POST" action="<?php echo e(route('admin.service-update',$record->id)); ?>" enctype="multipart/form-data">
                        <?php echo csrf_field(); ?>
						

                            <div class="row">
                           <input type="hidden" class="form-control" name="currenturl" placeholder="Enter service name" value='<?php echo e($currenturl); ?>'>
                                    <!--div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-12">
                                       
                                         <label class="control-label float-left">Select Category</label>
                                        <div class="inno-multiselect">
                                            
                                              <div class="reg-checkboxes">

                                                <select class="form-control cat_change" name="category_id">
                                                     <?php if($categories->count()>0): ?>
                                                <?php $slNo =  0; ?>
                                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                 <option  value="<?php echo e(@$category->slug); ?>" <?php echo e($slNo==0?"selected required":''); ?> id="<?php echo e(@$category->name); ?>_id"><?php echo e(@$category->name); ?></option>
                                               
                                                <?php $slNo++; ?>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                <?php endif; ?>
                                                </select>
                                               
                                               </div>
                                             <?php if($errors->has('category')): ?>
                                                        <span class="error-message float-left">
                                                            <strong><?php echo e($errors->first('category')); ?></strong>
                                                        </span>
                                                    <?php endif; ?>
                                        </div>
                                         </div> 
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                  
                                                     <label class="control-label float-left">Select Sub Category</label>
                                                    <div class="inno-multiselect" id="multiselect">
                                                        <span class="down-arrow"><i class="icofont-simple-down"></i></span>
                                                        <select id="example-getting-started" name="sub_category[]" multiple="multiple">
                                                        </select>

                                                     </div>
                                                     <div class="inno-multiselect"  id="multiselect1">
                                                        <span class="down-arrow"><i class="icofont-simple-down"></i></span>
                                                        <?php $d=[];?>
                                                        <?php $__currentLoopData = $data->serviceCat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <?php $idd=$value->sub_category;
                                                            array_push($d,$idd); ?>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                       
                                                     <select  name="sub_category[]" multiple="multiple" required id="demo">
                                                          <?php $__currentLoopData = $subcat; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                              <option value="<?php echo e($value['id']); ?>" <?php if(in_array($value['id'],$d)): ?> selected="selected" <?php endif; ?>><?php echo e($value['name']); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                         </div>


                                                    </div-->  
                                 <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <?php $alluser = CommonHelper::getAllUser(); ?>

                                        <label class="control-label">User</label>
                                        <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>" />
                                        <input type="text" class="form-control" name="user_name" value="<?php echo e($user->fullname); ?>" readonly />






                                        <?php if($errors->has('user_id')): ?>
                                            <span class="error-message">
                                                <strong><?php echo e($errors->first('user_id')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Service Name</label>
                                        <input type="text" class="form-control" name="service_name" placeholder="Enter service name" value='<?php echo e(old('service_name', $record->service_name)); ?>'>
                                        <?php if($errors->has('service_name')): ?>
                                            <span class="error-message">
                                                <strong><?php echo e($errors->first('service_name')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                 <input type="hidden"  id="logo" name="logo" value="<?php echo e($data->logo); ?>">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                               
                                        <label class="control-label float-left">Upload Logo</label>
                                        <img id="blah" src="<?php echo e(asset('service/'.$data->logo)); ?>" alt="your image"style="cursor:pointer;width: 112px;"/>
                                         <input type="file" class="image custom-file-input" class="form-control" id="fileImage" accept="image/*" capture style="display:none">
                                           
                                        <?php if($errors->has('logo')): ?>
                                            <span class="error-message float-left">
                                                <strong><?php echo e($errors->first('logo')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                </div>
                               
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label float-left"><?php echo e(__("form.service_description")); ?></label>
                                        <textarea class="form-control"  rows="5" name="description"><?php echo e($record->description); ?></textarea>
                                           
                                            <?php if($errors->has('description')): ?>
                                            <span class="error-message float-left">
                                                <strong><?php echo e($errors->first('description')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                 <!--div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <?php
                                   $t=explode(",",$data->tag);

                                   ?>

                                     <label class="control-label">Tags</label>
                                     <?php $__currentLoopData = $t; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <div id="edit<?php echo e($key); ?>"><input type="text" name="tag[]"  class="form-control" value="<?php echo e($value); ?>" required><a herf="#" data-id="<?php echo e($key); ?>" class="remove" id="remove<?php echo e($key); ?>" >Remove</a></div>
                                     <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                     
                                     
                                      <div class="input_fields_wrap1">
                                      </div>
                                      <button class="add_field_button1" id="add1">Add More Tag</button>
                                        <?php if($errors->has('tag')): ?>
                                        <span class="error-message">
                                            <strong><?php echo e($errors->first('tag')); ?></strong>
                                        </span>
                                         <?php endif; ?>
                                 </div>

                                      <div class="col-lg-16 col-md-6 col-xs-12 col-sm-12 mt-2">
                                                        <label class="control-label">Other Images</label>
                                                           <div class="input_fields_wrap"></div>
                                                            <button class="add_field_button" id="add">Add More Images</button>
                                                            <?php if($errors->has('image')): ?>
                                                            <span class="error-message">
                                                              <strong><?php echo e($errors->first('image')); ?></strong>
                                                            </span>
                                                            <?php endif; ?>
                                                        </div>
                                                     <?php
                                              $img=explode(",",$data->images);
                                              ?>
                                              <?php $__currentLoopData = $img; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                              <div class="col-lg-2 col-md-6 col-xs-12 col-sm-12 mt-2">

                                               <div id="imageedit<?php echo e($key); ?>"><input type="hidden" name="images[]" value="<?php echo e($value); ?>"> <img src="<?php echo e(asset('service/'.$value)); ?>"><a herf="#" data-id="<?php echo e($key); ?>" class="imageremove" id="imageremove<?php echo e($key); ?>" >Remove</a></div>
                                             </div>
                                             <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> -->
                                
                            </div>
                            
                         
	                    <button type="submit" class="btn btn-primary mr-2 mt-4">Update</button>
                        	<a href="<?php echo e(route('admin.service-list', $user->id)); ?>" class="btn btn-accent btn-outline mt-4">Cancel</a>
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
data: {'_token': "<?php echo e(csrf_token()); ?>", 'image': base64data},
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
<script>
$('document').ready(function(){
    <?php if(!empty(old("category_slug",$categories[0]->slug))): ?>
    populateSubcategory("<?php echo e(old("category_slug",$categories[0]->slug)); ?>");
    <?php endif; ?>


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
            url : "<?php echo e(route('ajax.subcategory')); ?>",
            data : {'category_slug':$category_id,'_token':"<?php echo e(csrf_token()); ?>"},
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
                    //     if(value.id=="<?php echo e(old("subcategory_id",$categories[0]->id)); ?>"){
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
var buttons = document.querySelectorAll('.remove');
for (var i=0; i<buttons.length; ++i) {
  buttons[i].addEventListener('click', clickFunc);
}

function clickFunc() {
  var id=$(this).data('id'); 
  //alert($id);
   var myobj = document.getElementById("edit"+id);
 myobj.remove();

}

var buttons1 = document.querySelectorAll('.imageremove');
for (var i=0; i<buttons1.length; ++i) {
  buttons1[i].addEventListener('click', clickFunc1);
}

function clickFunc1() {
  var id=$(this).data('id'); 
  //alert($id);
   var myobj = document.getElementById("imageedit"+id);
 myobj.remove();

}




</script>

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
            $(wrapper).append('<div><input type="file" name="images[]" class="form-control" required/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
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
            $(wrapper1).append('<div><input type="text" name="tag[]" class="form-control" required/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper1).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })
});
</script>
<script>
    jQuery(document).ready(function(){
        var input = document.querySelector("#mobile");
        var iti = window.intlTelInput(input, {
            initialCountry: "<?php echo e(!empty(old('country_code', $record->country_code))?old('country_code', $record->country_code):'qa'); ?>",
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



        populateStates("<?php echo e(old('country_id',$record->country_id)); ?>");
        jQuery(".country").change(function(){
            populateStates($(this).val(), null);
        });
    });
</script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/services/edit.blade.php ENDPATH**/ ?>
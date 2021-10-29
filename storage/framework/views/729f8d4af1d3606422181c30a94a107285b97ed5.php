<?php
use App\Model\User;
use App\Models\Country;
$countries = Country::getCountryList();
?>
<?php

?>

<?php $__env->startSection('title',__("header.profile_title")); ?>
<?php $__env->startSection('content'); ?>
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
                <h2><?php echo e(__("content.edit_profile")); ?></h2>
              </div>
              <!-- banner text end -->
            </div>
          </div>
        </div>
      </div>
      <img class="banner-bg" src="<?php echo e(asset('image/inner-bg.png')); ?>" alt="banner">
    </div>
  </section>
  <!-- inner-header end -->
    <section class="sidebar_with_container">
        <div class="container sml-container">
            <div class="row">
                <?php echo $__env->make("elements.layout.sidebar", \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                <div class="col-lg-10 col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <section class="page-content p-0">

                                      <div class="card-body">
                                        <?php if($user->user_type == 'vendor'): ?>
                                                <form class="forms-sample" method="POST" action="<?php echo e(route("user.update-profile")); ?>" enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>

                                                     <div class="col-lg-12">
                                                              <h5 class="text-start mb-0">Select Criteria</h5>
                                                          </div>
                                                      <div class="col-lg-12">
                                                        <div class="reg-checkboxes">
                                                            <?php if($categories->count()>0): ?>
                                                            <?php $slNo =  0; ?>
                                                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <!-- category checkbox -->
                                                            <div class="form-check">
                                                                <input <?php echo e($slNo==0?"checked required":''); ?>  class="form-check-input cat_change" type="radio" name="category_id" value="<?php echo e(@$category->slug); ?>" id="<?php echo e(@$category->name); ?>_id">
                                                                <label class="form-check-label" for="<?php echo e(@$category->name); ?>_id">
                                                                    <?php echo e(@$category->name); ?>

                                                                </label>
                                                            </div>
                                                            <!-- category checkbox end -->
                                                            <?php $slNo++; ?>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                            <?php endif; ?>
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
                                                         
                                                          <?php $data= App\Models\SubCategory::get()->toArray(); 
                                                               $subdata= explode(",",$user->subcategory_id);
                                                          ?>
                                                       
                                                     <select  name="sub_category[]" multiple="multiple" required id="demo">
                                                          <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                              <option value="<?php echo e($value['id']); ?>" <?php if(in_array($value['id'],$subdata)): ?> selected="selected" <?php endif; ?>><?php echo e($value['name']); ?></option>
                                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                        </select>
                                                         </div>

                                                    <!-- multiselect end -->

                                                    </div>
                                                        <input type="hidden"  id="logo" name="image" value="<?php echo e($user->image); ?>">
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                       
                                                                <label class="control-label float-left"></label>
                                                                <img id="blah" src="<?php echo e(asset('user/'.$user->image)); ?>" alt="your image"style="cursor:pointer;width: 112px;"/>
                                                                 <input type="file" class="image custom-file-input" class="form-control" id="fileImage" accept="image/*" capture style="display:none">
                                                                   
                                                                <?php if($errors->has('image')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('image')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            
                                                                <label class="control-label float-left"><?php echo e(__("form.email")); ?></label>
                                                                <input type="text" class="form-control" name="email" placeholder="<?php echo e(__("form.email")); ?>" readonly value="<?php echo e($user->email); ?>">
                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            
                                                                <label class="control-label float-left"><?php echo e(__("form.first_name")); ?></label>
                                                                <input type="text" class="form-control" name="first_name" placeholder="<?php echo e(__("form.first_name")); ?>" value='<?php echo e(old('first_name', $user->first_name)); ?>'>
                                                                <?php if($errors->has('first_name')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('first_name')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            
                                                                <label class="control-label float-left"><?php echo e(__("form.last_name")); ?></label>
                                                                <input type="text" class="form-control" name="last_name" placeholder="<?php echo e(__("form.enter_l_name")); ?>" value='<?php echo e(old('last_name', $user->last_name)); ?>'>
                                                                <?php if($errors->has('last_name')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('last_name')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            
                                                                <label class="control-label float-left">Description</label>
                                                               <textarea id="w3review" name="description" rows="4" cols="50"><?php echo e(old('description', $user->description)); ?></textarea>
                                                                <?php if($errors->has('description')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('description')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                        
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            
                                                                <label class="control-label float-left"><?php echo e(__("form.select_country")); ?></label>
                                                                <select type="text" class="form-control country" name="country_id"  value="<?php echo e(old('country_id',$user->country_id)); ?>">
                                                                    <option value="">
                                                                        <?php echo e(__("form.select_country_name")); ?>

                                                                    </option>
                                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option <?php echo e(old("country_id",$user->country_id) == $country->id ? 'selected' : ''); ?> value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                                <?php if($errors->has('country_id')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('country_id')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            
                                                                <label class="control-label float-left"><?php echo e(__("form.phone_number")); ?></label>
                                                                <input type="hidden" id="country_code" name="country_code" value="<?php echo e((old('country_code', $user->country_code))?old('country_code', $user->country_code):'qa'); ?>">
                                                                <input type="hidden" id="dial_code" name="dial_code" value="<?php echo e((old('dial_code', $user->dial_code))?old('dial_code', $user->dial_code):'974'); ?>">
                                                                <input type="tel" onclick="this.setSelectionRange(0, this.value.length)" class="form-control" name="mobile" id="mobile" value="<?php echo e(old('mobile', $user->mobile)); ?>" placeholder="<?php echo e(__("form.enter_phone_number")); ?>">
                                                                <?php if($errors->has('phone')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            
                                                                <label class="control-label float-left">Address</label>
                                                                <input type="text" class="form-control" value="<?php echo e(old('address', $user->address)); ?>" name="address" id="searchTextField" placeholder="Address" value=''>
                                                                <?php if($errors->has('address')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('address')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            
                                                                <label class="control-label float-left">Link</label>
                                                                <input type="text" class="form-control" name="link"  placeholder="Link" value='<?php echo e(old('link', $user->link)); ?>'>
                                                                <?php if($errors->has('link')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('link')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                    </div>
                                                    <div class="row col mt-3">

                                                        <label class="fs-5">HIGHLIGHTS</label>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-2">
                                                            
                                                                <label class="control-label float-left">Funding Type</label>
                                                                <input type="text" class="form-control" name="fundind_type"  placeholder="Funding Type" value='<?php echo e(old('fundind_type', $user->fundind_type)); ?>'>
                                                                <?php if($errors->has('fundind_type')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('fundind_type')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            
                                                                <label class="control-label float-left">Number Of Acquisitions</label>
                                                                <input type="number" class="form-control" name="number_of_acquisitions"  placeholder="Number Of Acquisitions" value='<?php echo e(old('number_of_acquisitions', $user->number_of_acquisitions)); ?>'>
                                                                <?php if($errors->has('number_of_acquisitions')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('number_of_acquisitions')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            
                                                                <label class="control-label float-left">Number Of Investments</label>
                                                                <input type="number" class="form-control" name="number_of_investments"  placeholder="Number Of Investments" value='<?php echo e(old('number_of_investments', $user->number_of_investments)); ?>'>
                                                                <?php if($errors->has('number_of_investments')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('number_of_investments')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            
                                                                <label class="control-label float-left">Number Of Exits</label>
                                                                <input type="number" class="form-control" name="number_of_exits"  placeholder="Number Of Exits" value='<?php echo e(old('number_of_exits', $user->number_of_exits)); ?>'>
                                                                <?php if($errors->has('number_of_exits')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('number_of_exits')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            
                                                                <label class="control-label float-left">Total Funding Amount</label>
                                                                <input type="text" class="form-control" name="funding_amount"  placeholder="Funding Amount" value='<?php echo e(old('funding_amount', $user->funding_amount)); ?>'>
                                                                <?php if($errors->has('funding_amount')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('funding_amount')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            
                                                                <label class="control-label float-left">Number Of Current Team Members</label>
                                                                <input type="number" class="form-control" name="number_of_team_members"  placeholder="Number Of Current Team Members" value='<?php echo e(old('number_of_team_members', $user->number_of_team_members)); ?>'>
                                                                <?php if($errors->has('number_of_team_members')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('number_of_team_members')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                                            
                                                                <label class="control-label float-left">Number Of Investors</label>
                                                                <input type="number" class="form-control" name="number_of_investors"  placeholder="Number Of Investors" value='<?php echo e(old('number_of_investors', $user->number_of_investors)); ?>'>
                                                                <?php if($errors->has('number_of_investors')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('number_of_investors')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                    </div>


                                                    <div class="row language-left">
                                                        <button type="submit" class="inno_btn px-4 mt-4">Next</button>
                                                      

                                                    </div>
                                                </form>
                                                <?php else: ?>
                                                         <form class="forms-sample" method="POST" action="<?php echo e(route("user.update-profile-user")); ?>" enctype="multipart/form-data">
                                                    <?php echo csrf_field(); ?>
                                                
                                                   
                                                    <div class="row">
                                                     
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mb-3">
                                                            
                                                                <label class="control-label float-left"><?php echo e(__("form.email")); ?></label>
                                                                <input type="text" class="form-control" name="email" placeholder="<?php echo e(__("form.email")); ?>" readonly value="<?php echo e($user->email); ?>">
                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mb-3">
                                                            
                                                                <label class="control-label float-left"><?php echo e(__("form.first_name")); ?></label>
                                                                <input type="text" class="form-control" name="first_name" placeholder="<?php echo e(__("form.first_name")); ?>" value='<?php echo e(old('first_name', $user->first_name)); ?>'>
                                                                <?php if($errors->has('first_name')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('first_name')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mb-3">
                                                            
                                                                <label class="control-label float-left"><?php echo e(__("form.last_name")); ?></label>
                                                                <input type="text" class="form-control" name="last_name" placeholder="<?php echo e(__("form.enter_l_name")); ?>" value='<?php echo e(old('last_name', $user->last_name)); ?>'>
                                                                <?php if($errors->has('last_name')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('last_name')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                    </div>

                                                    <div class="row">
                                                        
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mb-3">
                                                            
                                                                <label class="control-label float-left"><?php echo e(__("form.select_country")); ?></label>
                                                                <select type="text" class="form-control country" name="country_id"  value="<?php echo e(old('country_id',$user->country_id)); ?>">
                                                                    <option value="">
                                                                        <?php echo e(__("form.select_country_name")); ?>

                                                                    </option>
                                                                    <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                                        <option <?php echo e(old("country_id",$user->country_id) == $country->id ? 'selected' : ''); ?> value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                                                </select>
                                                                <?php if($errors->has('country_id')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('country_id')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                         <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mb-3">
                                                            
                                                                <label class="control-label float-left"><?php echo e(__("form.phone_number")); ?></label>
                                                                <input type="hidden" id="country_code" name="country_code" value="<?php echo e((old('country_code', $user->country_code))?old('country_code', $user->country_code):'qa'); ?>">
                                                                <input type="hidden" id="dial_code" name="dial_code" value="<?php echo e((old('dial_code', $user->dial_code))?old('dial_code', $user->dial_code):'974'); ?>">
                                                                <input type="tel" onclick="this.setSelectionRange(0, this.value.length)" class="form-control" name="mobile" id="mobile" value="<?php echo e(old('mobile', $user->mobile)); ?>" placeholder="<?php echo e(__("form.enter_phone_number")); ?>">
                                                                <?php if($errors->has('phone')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('phone')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                      
                                                        
                                                    </div>
                                                    
                                                    <div class="row language-left">
														<div class="col-sm-12">
                                                        <button type="submit" class="inno_btn px-4 mt-4">Update</button>
                                                      

														</div>
                                                    </div>
                                                </form>
                                                <?php endif; ?>
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
    <script>
        jQuery(document).ready(function(){
            var input = document.querySelector("#mobile");
            var iti = window.intlTelInput(input, {
                initialCountry: "<?php echo e(!empty(old('country_code', $user->country_code))?old('country_code', $user->country_code):'in'); ?>",
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/users/profile-edit.blade.php ENDPATH**/ ?>
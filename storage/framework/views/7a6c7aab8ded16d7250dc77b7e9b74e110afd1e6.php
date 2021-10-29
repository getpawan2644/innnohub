<?php
    $categories = \App\Models\Category::getCategoryList();
    // dd($categories[0]->id);
    // $locale = \App::getLocale();
    $routeName = Route::currentRouteName();
//      if(Auth::check()){
//     $unread_message=App\Models\Messages::getUnreadMessage();
//      }else{
//    $unread_message=false;
//      }
  // dd($top_banners);
?>

<?php $__env->startSection('title', __("content.register")); ?>
<?php $__env->startSection('content'); ?>
     <!-- inner-header -->
    <?php echo $__env->make('elements.banner.inner_banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     <!-- inner-header end -->

<!-- sign up -->

  <!--  Vendor signup step-2-->
  <section>
    <div class="signup">
      <div class="container sml-container">
        <div class="row">
          <div class="col-lg-5">
            <div class="sgn-wrap">
              <img src="<?php echo e(asset('image/registration.jpg')); ?>" alt="image" class="img-fluid">
            </div>

          </div>
          <div class="col-lg-7">
            <!-- signup -->
            <div class="signup-form">
                <form  method="POST" action="<?php echo e(route('user.post-register')); ?>" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                    <?php echo csrf_field(); ?>
                    <input type="hidden" name="user_type" value="<?php echo e($user_type); ?>">
                    <div class="col-lg-12">
                      <h3>Register as Vendor</h3>
                    </div>
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
                                <input <?php echo e($slNo==0?"checked required":''); ?> class="form-check-input cat_change" type="radio" name="category_id" value="<?php echo e(@$category->slug); ?>" id="<?php echo e(@$category->name); ?>_id">
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


                    <div class="col-lg-12 mt-4">
                    <h5 class="text-start mb-0 mt-3">Select categories</h5>
                    </div>
                    <div class="col-lg-6">
                    <!-- multiselect -->
                    <div class="inno-multiselect">
                        <span class="down-arrow"><i class="icofont-simple-down"></i></span>
                        <select id="example-getting-started" name="subcategory_id[]" multiple="multiple" required>
                        </select>
                    </div>
                    <!-- multiselect end -->

                    </div>

                    <div class="col-md-6">
                      <input type="text" class="form-control" name="first_name" value="<?php echo e(old('first_name', $record->first_name)); ?>" placeholder="<?php echo e(__('content.first_name')); ?>" required>
                      <?php $__errorArgs = ['first_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <span class="error-message">
                              <strong><?php echo e($message); ?></strong>
                          </span>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                        Enter your First name.
                      </div>
                    </div>

                    <div class="col-md-6">
                      <input type="text" class="form-control" name="last_name" value="<?php echo e(old('last_name', $record->last_name)); ?>" placeholder="<?php echo e(__('content.last_name')); ?>" required>
                      <?php $__errorArgs = ['last_name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <span class="error-message">
                              <strong><?php echo e($message); ?></strong>
                          </span>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                        Enter your Last name.
                      </div>
                    </div>

                    <div class="col-md-6">
                      <input type="email" class="form-control" name="email" value="<?php echo e(old('email', $record->email)); ?>" placeholder="<?php echo e(__('content.email_id')); ?>" required>
                      <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <span class="error-message">
                              <strong><?php echo e($message); ?></strong>
                          </span>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                        Enter corporate email.
                      </div>
                    </div>

                    <div class="col-md-6">
                      
                      <input type="hidden" id="country_code" name="country_code" value="<?php echo e(old('country_code', $record->country_code)); ?>">
                      <input type="hidden" id="dial_code" name="dial_code" value="<?php echo e(old('dial_code', $record->dial_code)); ?>">
                      <input type="tel" onclick="this.setSelectionRange(0, this.value.length)" class="form-control" name="mobile" id="mobile" value="<?php echo e(old('mobile', $record->mobile)); ?>" placeholder="<?php echo e(__('content.phone_number')); ?>" required>
                      <?php $__errorArgs = ['mobile'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <span class="error-message">
                              <strong><?php echo e($message); ?></strong>
                          </span>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                        Enter your Phone number.
                      </div>
                    </div>

                    <div class="col-md-6">
                      <input type="text" class="form-control" name="password" value="<?php echo e(old('password', $record->password)); ?>" placeholder="<?php echo e(__('content.password')); ?>" required>
                      <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <span class="error-message">
                              <strong><?php echo e($message); ?></strong>
                          </span>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                        Enter new password.
                      </div>
                    </div>
                    <div class="col-md-6">
                      <input type="text" class="form-control" name="password_confirmation" value="<?php echo e(old('password_confirmation', $record->password_confirmation)); ?>" placeholder="<?php echo e(__('content.confirm_password')); ?>" required>
                      <?php $__errorArgs = ['password_confirmation'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                          <span class="error-message">
                              <strong><?php echo e($message); ?></strong>
                          </span>
                      <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                      <div class="valid-feedback">
                        Looks good!
                      </div>
                      <div class="invalid-feedback">
                        Enter Confirm password.
                      </div>
                    </div>


                    <div class="col-12">
                      <button class="inno_btn px-4 mt-4" type="submit"><?php echo e(__('content.register')); ?></button>
                      <p class="pt-3"><?php echo e(__('content.already_have_account')); ?><a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#login_model"><?php echo e(__('content.log_in')); ?></a> </p>
                    </div>
                  </form>
            </div>
            <!-- signup end -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Vendor signup end -->
<!-- sign up end -->
<script>
    //Code for intell input
    var input = document.querySelector("#mobile");
    var iti = window.intlTelInput(input, {
        initialCountry: "<?php echo e(!empty(old('country_code', $record->country_code))?old('country_code', $record->country_code):'in'); ?>",
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

</script>
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/auth/register_vendor.blade.php ENDPATH**/ ?>
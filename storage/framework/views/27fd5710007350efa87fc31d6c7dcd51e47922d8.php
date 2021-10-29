<?php $__env->startSection('title', __("content.register")); ?>
<?php $__env->startSection('content'); ?>
     <!-- inner-header -->
    <?php echo $__env->make('elements.banner.inner_banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
     <!-- inner-header end -->

<!-- sign up -->
  <!-- Register type step-1-->
  <section class="pt-0">
    <div class="register_as">
      <div class="container sml-container">
        <div class="row">
          <div class="col-lg-12">
            <!-- register as -->
            <form id="register-type-form" action="<?php echo e(route('user.register')); ?>">
                <div class="register-as">
                <h3>Select registration option</h3>

                <div class="inno-reg">
                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="usertype" id="usertype1" value="buyer" checked>
                    <label class="form-check-label" for="usertype1">
                        Register as Buyer
                    </label>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="radio" name="usertype" id="usertype2" value="vendor">
                    <label class="form-check-label" for="usertype2">
                        Register as Vendor
                    </label>
                    </div>
                </div>
                <button  class="inno_btn px-4" type="submit">Continue</button>
                

                </div>
            </form>
            <!-- register as end -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Register type end -->
<!-- sign up end -->
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/auth/register.blade.php ENDPATH**/ ?>
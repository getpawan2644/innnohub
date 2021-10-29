<?php
    use App\Models\Country;
    $countries = Country::getCountryList();
    // use App\Models\State;
    // $states = State::getStateList();
?>


<?php $__env->startSection('title',"Add User"); ?>

<?php $__env->startSection('header',"Add User"); ?>

<?php $__env->startSection('breadcrumb'); ?>
    ##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.categories.index')); ?>">Manage Users </a></li>
    <li class="breadcrumb-item active" aria-current="page">Add User</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/themify-icons.css')); ?>">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="<?php echo e(route('admin.users.store')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="form-label">First Name</label>
                                        <input type="text" class="form-control" name="first_name" placeholder="Enter user first name" value='<?php echo e(old('first_name', $record->first_name)); ?>'>
                                        <?php if($errors->has('first_name')): ?>
                                            <span class="error-message">
                                                <strong><?php echo e($errors->first('first_name')); ?></strong>
                                            </span>
                                        <?php endif; ?>




                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Last Name</label>
                                        <input type="text" class="form-control" name="last_name" placeholder="Enter user last name" value='<?php echo e(old('last_name', $record->last_name)); ?>'>
                                        <?php if($errors->has('last_name')): ?>
                                            <span class="error-message">
                                                <strong><?php echo e($errors->first('last_name')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="Enter email address" value='<?php echo e(old('email', $record->email)); ?>'>
                                        <?php if($errors->has('email')): ?>
                                            <span class="error-message">
                                                <strong><?php echo e($errors->first('email')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Select Country</label>
                                        <select type="text" class="form-control country" name="country_id" placeholder="Please choose a category" value="<?php echo e(old('country_id',$record->country_id)); ?>">
                                            <option value="">
                                                Select Country Name
                                            </option>
                                            <?php $__currentLoopData = $countries; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $country): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <option <?php echo e(old("country_id",$record->country_id) == $country->id ? 'selected' : ''); ?> value="<?php echo e($country->id); ?>"><?php echo e($country->name); ?></option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>
                                        <?php if($errors->has('country_id')): ?>
                                            <span class="error-message">
                                                <strong><?php echo e($errors->first('country_id')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Phone Number</label>
                                            <input type="hidden" id="country_code" name="country_code" value="<?php echo e((old('country_code', $record->country_code))?old('country_code', $record->country_code):'in'); ?>">
                                            <input type="hidden" id="dial_code" name="dial_code" value="<?php echo e((old('dial_code', $record->dial_code))?old('dial_code', $record->dial_code):'91'); ?>">
                                            <input type="tel" onclick="this.setSelectionRange(0, this.value.length)" class="form-control" name="mobile" id="mobile" value="<?php echo e(old('mobile', $record->mobile)); ?>" placeholder="Please enter your number">
                                            <?php if($errors->has('phone')): ?>
                                                <span class="error-message">
                                                    <strong><?php echo e($errors->first('phone')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Company size</label>
                                        <select name="company_size"  id="company_size" class="form-control">
                                            <option disabled required selected>Company size</option>
                                            <option value="1-50" <?php echo e(old("company_size",$record->company_size) == "1-50" ? 'selected' : ''); ?>>1-50</option>
                                            <option value="50-200" <?php echo e(old("company_size",$record->company_size) == "50-200" ? 'selected' : ''); ?>>50-200</option>
                                            <option value="200-500" <?php echo e(old("company_size",$record->company_size) == "200-500" ? 'selected' : ''); ?>>200-500</option>
                                            <option value="500-1000" <?php echo e(old("company_size",$record->company_size) == "500-1000" ? 'selected' : ''); ?>>500-1000</option>
                                            <option value="1000-5000" <?php echo e(old("company_size",$record->company_size) == "1000-5000" ? 'selected' : ''); ?>>1000-5000</option>
                                            <option value="5000+" <?php echo e(old("company_size",$record->company_size) == "5000+" ? 'selected' : ''); ?>>5000+</option>
                                          </select>
                                        <?php if($errors->has('company_size')): ?>
                                            <span class="error-message">
                                                <strong><?php echo e($errors->first('company_size')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Industry</label>
                                        <input type="text" class="form-control" name="industry" value="<?php echo e(old('industry', $record->industry)); ?>" placeholder="<?php echo e(__('content.industry')); ?>" required>
                                        <?php if($errors->has('industry')): ?>
                                                <span class="error-message">
                                                    <strong><?php echo e($errors->first('industry')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Job Title</label>
                                        <input type="text" class="form-control" name="job_title" value="<?php echo e(old('job_title', $record->job_title)); ?>" placeholder="<?php echo e(__('content.job_title')); ?>" required>

                                        <?php if($errors->has('company_size')): ?>
                                            <span class="error-message">
                                                <strong><?php echo e($errors->first('company_size')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Company name</label>
                                        <input type="text" class="form-control" name="company_name" value="<?php echo e(old('company_name', $record->company_name)); ?>" placeholder="<?php echo e(__('content.company_name')); ?>" required>
                                        <?php if($errors->has('company_name')): ?>
                                                <span class="error-message">
                                                    <strong><?php echo e($errors->first('company_name')); ?></strong>
                                                </span>
                                            <?php endif; ?>
                                    </div>
                                </div>

                            </div>
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Add</button>
                            <a href="<?php echo e(route('admin.categories.index')); ?>" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        jQuery(document).ready(function(){
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
        });
    </script>
<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/users/create.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title', 'Contact Us'); ?>
<?php $__env->startSection('content'); ?>
    <!-- header end -->

    <!-- inner-header -->
    <section class="p-0">
        <div class="banner inner-banner">
            <div class="banner-wrap">
                <div class="container sml-container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- banner text -->
                            <div class="banner-text">
                                <h2>Connect with us</h2>
                            </div>
                            <!-- banner text end -->
                        </div>
                    </div>
                </div>
            </div>
            <img class="banner-bg" src="<?php echo e(asset('public/image/inner-bg.png')); ?>" alt="banner">
        </div>
    </section>
    <!-- inner-header end -->











    <!-- contact us -->
    <section  >
        <div class="contact-us">
            <div class="container sml-container">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- contact us -->
                        <div class="contact-us-txt">
                            <h3>Get in <span>touch</span></h3>

                            <ul class="contact-info">
                                <li><a href="#"><i class="icofont-location-pin"></i> 525 Milltown Rd Suite 304, North
                                        <br> Brunswick, NJ 08902</a></li>
                                <li><a href="mailto:info@Innohub.com"><i class="icofont-mail"></i> info@Innohub.com</a>
                                </li>
                                <li><a href="tel:+1 987 654 3210"><i class="icofont-ui-call"></i> +1 987 654 3210 (Fax:
                                        +1 555 666 9874)</a></li>
                            </ul>

                            <ul class="social-footer">
                                <li><a href="https://www.facebook.com" target="_blank"><i class="icofont-facebook"></i></a>
                                </li>
                                <li><a href="https://www.youtube.com" target="_blank"><i
                                                class="icofont-youtube"></i></a></li>
                                <li><a href="https://www.instagram.com" target="_blank"><i
                                                class="icofont-instagram"></i></a></li>
                                <li><a href="https://www.twitter.com" target="_blank"><i
                                                class="icofont-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com" target="_blank"><i class="icofont-linkedin"></i></a>
                                </li>
                            </ul>

                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius sit, accusamus atque
                                voluptas illum eveniet reiciendis voluptatem rem, dignissimos, nobis ipsam! Odit dolor
                                commodi explicabo omnis quam laborum fugit.</p>
                        </div>
                        <!-- contact us end -->
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-form">
                            <form class="row g-3 needs-validation" action="<?php echo e(route('cms.contactUs')); ?>" method="POST"
                                  novalidate>
                                <?php echo csrf_field(); ?>
                                <div class="col-lg-12">
                                    <h3>Contact us</h3>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Your name" name="name" value="<?php echo e(Auth::check() ? Auth::user()->fullname:''); ?>"
                                           required>
                                    <?php $__errorArgs = ['name'];
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
                                        Enter your name.
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="Your Email" name="email" value="<?php echo e(Auth::check()?Auth::user()->email:''); ?>"
                                           required>
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
                                        Enter your email id.
                                    </div>

                                </div>

                                


                                <div class="col-md-6">
                                    
                                    <input type="hidden" id="country_code" name="country_code" value="<?php echo e(old('country_code', $record->country_code)); ?>">
                                    <input type="hidden" id="dial_code" name="dial_code" value="<?php echo e(old('dial_code', $record->dial_code)); ?>">

                                    <input type="tel" onclick="this.setSelectionRange(0, this.value.length)"
                                           class="form-control" name="mobile" id="mobile"
                                           value="<?php echo e(Auth::check()?Auth::user()->mobile:''); ?>"
                                           placeholder="<?php echo e(__('content.phone_number')); ?>" required>
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

                                <div class="col-md-12">
                                    <textarea rows="5" class="form-control" placeholder="Enter message here"
                                              name="message"  required><?php echo e(old('message')); ?></textarea>
                                    <?php $__errorArgs = ['message'];
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
                                        Enter your message.
                                    </div>
                                </div>




                                <div class="col-12">
                                    <button class="inno_btn" type="submit" >Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact us end -->
    <script>
        //Code for intell input
        var input = document.querySelector("#mobile");
        var iti = window.intlTelInput(input, {
            initialCountry: "<?php echo e(!empty(old('country_code', $record->country_code))?old('country_code', $record->country_code):'in'); ?>",
        });
        // console.log('iti :'+JSON.stringify(iti));
        var initial_iti = JSON.parse(JSON.stringify(iti));
        console.log(initial_iti);
        var selected_country_code = initial_iti.selectedCountryData.iso2;
        var selected_dial_code = initial_iti.selectedCountryData.dialCode;

        $('#country_code').val(selected_country_code);
        $('#dial_code').val(selected_dial_code);
        window.intlTelInputGlobals.loadUtils("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js");
        input.addEventListener("countrychange", function () {
            console.log(iti.getSelectedCountryData());
            let countryData = iti.getSelectedCountryData();
            console.log(countryData);
            document.getElementById('country_code').value = countryData.iso2;
            document.getElementById('dial_code').value = countryData.dialCode;
        });
    </script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/cms/contact.blade.php ENDPATH**/ ?>
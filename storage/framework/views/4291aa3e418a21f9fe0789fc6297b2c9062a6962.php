<?php
// $middle_banner=App\Models\Banner::getMiddleBanner();
// $bottom_banner=App\Models\Banner::getBottomBanner();
// $advertisements=App\Models\Advertisement::getAdvertisements();
// $trending_categories = \App\Models\Category::getTrendingCategoryList();
// $offer_categories = \App\Models\Category::getOffersCategoryList();
// $clientCategory = App\Models\ClientCategory::getActiveFeaturedClientCategoryList();
?>

<?php $__env->startSection('title', __("content.home")); ?>
<?php $__env->startSection('title', 'Page Title'); ?>
<?php $__env->startSection('content'); ?>
    <!-- home banner -->
    <?php echo $__env->make('elements.banner.home_banner', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- home banner end -->

  <!-- innovators of the week -->
  <section class="innov-sec">
    <div class="innovators">
      <div class="container sml-container">
        <div class="row">
          <div class="col-lg-12">
            <!-- heading -->
            <div class="heading">
              <h3>Innovators of the week</h3>
              <p>this week's selection of innovative SaaS solutions.</p>
            </div>
            <!-- heading end -->
          </div>
          
         <?php $__currentLoopData = $service; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
          <div class="col-lg-4 col-md-6">
            <!-- inno card -->
            <div class="inno-card">
              <img src="<?php echo e(asset('user/'.$value['image'])); ?>" alt="inno logo">
              <h4><?php echo e(ucfirst($value['first_name'])); ?> <?php echo e(ucfirst($value['last_name'])); ?></h4>
              <p><?php echo e(substr($value['description'],0,50)); ?></p>
              <ul class="card-pills">
               
                <?php if(!empty($value['subcategory_id'])): ?>
                          <?php $data= App\Models\SubCategory::get()->toArray(); 
                               $subdata= explode(",",$value['subcategory_id']);

                          ?>
                         <?php $__currentLoopData = $data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value1): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                           <?php if(in_array($value1['id'],$subdata)): ?>
                               
                               <li><a href="#"><?php echo e($value1['name']); ?></a></li>
                           <?php endif; ?>
                         <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                         <?php endif; ?>
                <!--li><a href="#">Big Data</a></li>
                <li><a href="#">Business Intelligence</a></li>
                <li><a href="#">CyberSecurity</a></li>
                <li><a href="#">Business Automation</a></li-->
              </ul>
              <div class="card-btns">
              	<?php if(Auth::check()): ?>
              	<a href="#" class="border-btn open-AddBookDialog" data-id="<?php echo e($value['id']); ?>"  data-toggle="modal" data-target="#make_offer_model">Book a Meeting</a>
					<?php else: ?>
					<a href="#" class="border-btn" data-toggle="modal" data-target="#login_model">Book a Meeting</a>
					<?php endif; ?>
                
                <a href="<?php echo e(route('vendorprofile',$value['id'])); ?>" class="blue-btn">Learn more</a>
              </div>
            </div>
            <!-- inno card end -->
          </div>
          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <!--div class="col-lg-4 col-md-6">
                        <div class="inno-card">
              <img src="<?php echo e(asset('image/logo2.png')); ?>" alt="inno logo">
              <h4>Creative Venus</h4>
              <p>Our theme architecture is designed for maximize security and prevent malware, Dos Attack other.</p>
              <ul class="card-pills">
                <li><a href="#">Blockchain</a></li>
                <li><a href="#">Big Data</a></li>
                <li><a href="#">Business Intelligence</a></li>
                <li><a href="#">CyberSecurity</a></li>
                <li><a href="#">Business Automation</a></li>
              </ul>
              <div class="card-btns">
                <a href="#" class="border-btn">Book a Meeting</a>
                <a href="categories-details.html" class="blue-btn">Learn more</a>
              </div>
            </div>

          </div>

          <div class="col-lg-4 col-md-6">

            <div class="inno-card">
              <img src="<?php echo e(asset('image/logo3.png')); ?>" alt="inno logo">
              <h4>Smart Homes</h4>
              <p>Our theme architecture is designed for maximize security and prevent malware, Dos Attack other.</p>
              <ul class="card-pills">
                <li><a href="#">Blockchain</a></li>
                <li><a href="#">Big Data</a></li>
                <li><a href="#">Business Intelligence</a></li>
                <li><a href="#">CyberSecurity</a></li>
                <li><a href="#">Business Automation</a></li>
              </ul>
              <div class="card-btns">
                <a href="#" class="border-btn">Book a Meeting</a>
                <a href="categories-details.html" class="blue-btn">Learn more</a>
              </div>
            </div>

          </div>

          <div class="col-lg-4 col-md-6">

            <div class="inno-card">
              <img src="<?php echo e(asset('image/logo1.png')); ?>" alt="inno logo">
              <h4>Thomson Returns</h4>
              <p>Our theme architecture is designed for maximize security and prevent malware, Dos Attack other.</p>
              <ul class="card-pills">
                <li><a href="#">Blockchain</a></li>
                <li><a href="#">Big Data</a></li>
                <li><a href="#">Business Intelligence</a></li>
                <li><a href="#">CyberSecurity</a></li>
                <li><a href="#">Business Automation</a></li>
              </ul>
              <div class="card-btns">
                <a href="#" class="border-btn">Book a Meeting</a>
                <a href="categories-details.html" class="blue-btn">Learn more</a>
              </div>
            </div>

          </div>

          <div class="col-lg-4 col-md-6">

            <div class="inno-card">
              <img src="<?php echo e(asset('image/logo2.png')); ?>" alt="inno logo">
              <h4>Creative Venus</h4>
              <p>Our theme architecture is designed for maximize security and prevent malware, Dos Attack other.</p>
              <ul class="card-pills">
                <li><a href="#">Blockchain</a></li>
                <li><a href="#">Big Data</a></li>
                <li><a href="#">Business Intelligence</a></li>
                <li><a href="#">CyberSecurity</a></li>
                <li><a href="#">Business Automation</a></li>
              </ul>
              <div class="card-btns">
                <a href="#" class="border-btn">Book a Meeting</a>
                <a href="categories-details.html" class="blue-btn">Learn more</a>
              </div>
            </div>

          </div>

          <div class="col-lg-4 col-md-6">

            <div class="inno-card">
              <img src="<?php echo e(asset('image/logo3.png')); ?>" alt="inno logo">
              <h4>Smart Homes</h4>
              <p>Our theme architecture is designed for maximize security and prevent malware, Dos Attack other.</p>
              <ul class="card-pills">
                <li><a href="#">Blockchain</a></li>
                <li><a href="#">Big Data</a></li>
                <li><a href="#">Business Intelligence</a></li>
                <li><a href="#">CyberSecurity</a></li>
                <li><a href="#">Business Automation</a></li>
              </ul>
              <div class="card-btns">
                <a href="#" class="border-btn">Book a Meeting</a>
                <a href="categories-details.html" class="blue-btn">Learn more</a>
              </div>
            </div>

          </div-->
          <div class="col-lg-12">
            <div class="middle-btn card-btns mt-0">
              <a href="<?php echo e(route('viewservices')); ?>">View all</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- innovators of the week end -->

  <!-- blue ribbon -->
  <section class="p-0">
    <div class="blue-ribbon">
      <div class="container sml-container">
        <div class="row">
          <div class="col-lg-12">
            <!-- heading -->
            <div class="heading">
              <h3 class="text-white">Why our marketplace?</h3>
            </div>
            <!-- heading end -->
          </div>
          <div class="col-lg-3 col-md-6">
            <!-- ribbon item -->
            <div class="ribbon-item">
              <img src="<?php echo e(asset('image/ribbon (1).png')); ?>" alt="icon">
              <div class="ribbon-content">
                <h5>Quality Guarantee</h5>
                <p>Quality checked by our team</p>
              </div>
            </div>
            <!-- ribbon item end -->
          </div>

          <div class="col-lg-3 col-md-6">
            <!-- ribbon item -->
            <div class="ribbon-item">
              <img src="<?php echo e(asset('image/ribbon (2).png')); ?>" alt="icon">
              <div class="ribbon-content">
                <h5>Customer Support</h5>
                <p>Friendly 24/7 customer support</p>
              </div>
            </div>
            <!-- ribbon item end -->
          </div>

          <div class="col-lg-3 col-md-6">
            <!-- ribbon item -->
            <div class="ribbon-item">
              <img src="<?php echo e(asset('image/ribbon (3).png')); ?>" alt="icon">
              <div class="ribbon-content">
                <h5>Lifetime Free Updates</h5>
                <p>Never pay for an update</p>
              </div>
            </div>
            <!-- ribbon item end -->
          </div>

          <div class="col-lg-3 col-md-6">
            <!-- ribbon item -->
            <div class="ribbon-item">
              <img src="<?php echo e(asset('image/ribbon (4).png')); ?>" alt="icon">
              <div class="ribbon-content">
                <h5>Secure Payments</h5>
                <p>we posess SSL / Secure сertificate</p>
              </div>
            </div>
            <!-- ribbon item end -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- blue ribbon end -->

  <!-- about -->
  <section>
    <div class="about">
      <div class="container sml-container">
        <div class="row">
          <div class="col-lg-12">
            <!-- heading -->
            <div class="heading">
              <h3>We have to focus on your identity</h3>
            </div>
            <!-- heading end -->

            <!-- about content -->
            <div class="about-content">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>
              <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p>
            </div>
            <!-- about content end -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- about end -->


    <!-- Modal -->
<div class="modal fade" id="make_offer_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Book a meeting</h5>
      
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
     
    </div>
    <div class="modal-body">
      <div class="price-input">
      
       
      
       <input type ="hidden" value="" id="serviceid" name="service_id">
       <label>Message</label>
     <textarea class="form-control mb-4" name="message" id="message" placeholder="Please enter your message here"></textarea>
        <!--div id="sname" ></div> <div id="sdec"></div>

        <div id="bookId"></div-->
        <button class="main_btn btn submit_btn bookmeeting" id="bookmeeting"  name="submit">Send</button>
    
      </div>
    </div>
   </div>
  </div>
  </div>
  <!-- Modal -->
<script type="text/javascript">
	$(document).on("click", ".open-AddBookDialog", function () {
   /*   var myBookId = $(this).data('id');
     var servicedescription = $(this).data('servicedescription');
     var servicename = $(this).data('servicename');
     document.getElementById("bookId").innerHTML = myBookId;
     document.getElementById("sname").innerHTML = servicename;
     document.getElementById("sdec").innerHTML = servicedescription;*/
     var myBookId = $(this).data('id');
    $(".modal-body #serviceid").val( myBookId );
     
});

	$(document).on("click", ".bookmeeting", function () {
       //var userid= "<?php echo e(Auth::check() ? Auth::user()->id : ''); ?>";
        var id = $('#serviceid').val();
        var message = $('#message').val();
       
        var url = "<?php echo e(URL('book-meeting')); ?>";
        $.ajax({
            url: url,
            type: "POST",
            data:{ 
                _token:'<?php echo e(csrf_token()); ?>','id':id,'message':message,
            },
            cache: false,
            dataType: 'json',
            success: function(dataResult){

               if(dataResult.status == 1){
               swal({ position: 'center',icon: 'success',title: dataResult.msg,showConfirmButton: false,timer: 1500});
              // swal("Hello World");
			location.reload();
               }else{
               	swal("Something went wrong");
               }
               
            }
            });
});
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/home/index.blade.php ENDPATH**/ ?>
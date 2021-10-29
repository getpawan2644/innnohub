  <!-- banner -->
  <section class="p-0">
    <div class="banner">
      <div class="banner-wrap">
        <div class="container sml-container">
          <div class="row">
            <div class="col-lg-12">
              <!-- banner text -->
              <div class="banner-text">
                <h2>Home to the world's most  <br> relevant SaaS platforms</h2>
                <p>the digital solution you need is just one click away</p>

                <form class="banner-search" method="GET" action="<?php echo e(route('viewservices')); ?>">
                  <input type="text" class="form-control" name="search" placeholder="Start your search" required>
                  <button class="inno-orange-btn" type="submit"><i class="icofont-search-1"></i></button>
                </form>

                <div class="banner-pills">
                   <!--<?php $__currentLoopData = CommonHelper::getAllSubCategory(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="categories-details.html" class="badge shadow bg-white"><?php echo e($value['name']); ?></a>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>-->
                    <a href="<?php echo e(url('viewservices?search=iot')); ?>" class="badge shadow bg-white">IOT</a>
                  <a href="<?php echo e(url('viewservices?search=Blockchain')); ?>" class="badge shadow bg-white">Blockchain</a>
                
                  <a href="<?php echo e(url('viewservices?search=Business Automation')); ?>" class="badge shadow bg-white">Business Automation</a>
                  <a href="<?php echo e(url('viewservices?search=Big Data')); ?>" class="badge shadow bg-white">Big Data</a>
                  <a href="<?php echo e(url('viewservices?search=CyberSecurity')); ?>" class="badge shadow bg-white">CyberSecurity</a>
                  <a href="<?php echo e(url('viewservices?search=CRM')); ?>" class="badge shadow bg-white">CRM</a>
                </div>

                <img class="banner-img" src="<?php echo e(asset('image/banner-img.png')); ?>" alt="computer image">
              </div>
              <!-- banner text end -->

            </div>
          </div>
        </div>
      </div>
      <img class="banner-bg" src="<?php echo e(asset('image/banner-bg.png')); ?>" alt="banner">
    </div>
  </section>
  <!-- banner end -->
<?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/elements/banner/home_banner.blade.php ENDPATH**/ ?>
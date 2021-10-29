<?php $__env->startSection('title', __("content.home")); ?>
<?php $__env->startSection('title', 'Page Title'); ?>
<?php $__env->startSection('content'); ?>
    <!-- home banner -->

  <!-- banner -->
  <section class="p-0 bg-gray">
    <div class="banner inner-banner">
      <div class="banner-wrap">
        <div class="container sml-container">
          <div class="row">
            <div class="col-lg-12">
              <!-- banner text -->
              <div class="banner-text">
                <h2>All Categories</h2>
              </div>
              <!-- banner text end -->
			</div>
          </div>
        </div>
      </div>
      <img class="banner-bg" src="image/inner-bg.png" alt="banner">
    </div>
  </section>
  <!-- banner end -->
  
  <!-- categories -->
  <section class="tab-list bg-gray">
    <div class="all-categories">
      <div class="container sml-container">
        <div class="row">
          <div class="col-lg-12">
            <!-- all categories -->
             <div class="category-wrap">
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="nav-item" role="presentation">
                  <?php $arr = explode(' ',trim($value['name'])); ?>
                  <a class="nav-link <?php echo e((ucfirst($cat) == $arr[0]) ? 'active' : ''); ?>" id="<?php echo e(lcfirst($arr[0])); ?>-tab" data-bs-toggle="tab" href="#<?php echo e(lcfirst($arr[0])); ?>" role="tab" aria-controls="<?php echo e(lcfirst($arr[0])); ?>" aria-selected="true"><i class="icofont-ui-v-card"></i> <span><?php echo e($value['name']); ?></span></a>
                </li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <!--li class="nav-item" role="presentation">
                  <a class="nav-link" id="industry-tab" data-bs-toggle="tab" href="#industry" role="tab" aria-controls="industry" aria-selected="false"><i class="icofont-building-alt"></i> <span>Industry</span></a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="department-tab" data-bs-toggle="tab" href="#department" role="tab" aria-controls="department" aria-selected="false"><i class="icofont-building"></i><span>Department</span></a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="employs-tab" data-bs-toggle="tab" href="#employs" role="tab" aria-controls="employs" aria-selected="false"><i class="icofont-users-alt-5"></i><span>Suitable for employees</span></a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="deployment_options-tab" data-bs-toggle="tab" href="#deployment_options" role="tab" aria-controls="deployment_options" aria-selected="false"><i class="icofont-readernaut"></i> <span> Deployment options</span></a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="partnerships-tab" data-bs-toggle="tab" href="#partnerships" role="tab" aria-controls="partnerships" aria-selected="false"><i class="icofont-user-suited"></i> <span>Open to Partnerships</span></a>
                </li>
                <li class="nav-item" role="presentation">
                  <a class="nav-link" id="Headquar-tab" data-bs-toggle="tab" href="#Headquar" role="tab" aria-controls="Headquar" aria-selected="false"><i class="icofont-bank-alt"></i><span>Headquartered in</span></a>
                </li-->
              </ul>
              
            </div>
            <!-- all categories end -->

            
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- categories end -->

  <section>
    <div class="container sml-container">
      
      <div class="tab-content" id="myTabContent">
       
        <?php $__currentLoopData = $category; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value2): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php $arr = explode(' ',trim($value2['name']));   ?>
        <div class="tab-pane fade  <?php echo e((ucfirst($cat) == $arr[0]) ? 'show active' : ''); ?>" id="<?php echo e(lcfirst($arr[0])); ?>" role="tabpanel" aria-labelledby="<?php echo e($arr[0]); ?>-tab">
          <div class="tab-wrap">
            <div class="row">
              <?php if(!empty($value2['sub_categories'])): ?>
             <?php $__currentLoopData = $value2['sub_categories']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$val): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
              <div class="col-lg-3 col-md-6 inner-cat">
                <!-- inno card -->
                <a href="<?php echo e(url('viewservices?search='.$val['name'])); ?>" class="inno-card">
                  <i class="icofont-computer"></i>
                  <h4><?php echo e($val['name']); ?></h4>
                  <!--p>Our theme architecture is designed for maximize security.</p-->
                </a>
                <!-- inno card end -->
              </div>
              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              <?php endif; ?>
            

              <!--div class="col-lg-3 col-md-6 inner-cat">
              
                <a href="#" class="inno-card">
                  <i class="icofont-link-alt"></i>
                  <h4>Blockchain</h4>
                  <p>Our theme architecture is designed for maximize security.</p>
                </a>
               
              </div>

              <div class="col-lg-3 col-md-6 inner-cat">
                
                <a href="#" class="inno-card">
                  <i class="icofont-interface"></i>
                  <h4>IoT</h4>
                  <p>Our theme architecture is designed for maximize security.</p>
                </a>
                
              </div>

              <div class="col-lg-3 col-md-6 inner-cat">
                
                <a href="#" class="inno-card">
                  <i class="icofont-automation"></i>
                  <h4>Business Automation</h4>
                  <p>Our theme architecture is designed for maximize security.</p>
                </a>
                
              </div>

              <div class="col-lg-3 col-md-6 inner-cat">
                
                <a href="#" class="inno-card">
                  <i class="icofont-database"></i>
                  <h4>Big Data</h4>
                  <p>Our theme architecture is designed for maximize security.</p>
                </a>
                
              </div>

              <div class="col-lg-3 col-md-6 inner-cat">
                
                <a href="#" class="inno-card">
                  <i class="icofont-lock"></i>
                  <h4>CyberSecurity</h4>
                  <p>Our theme architecture is designed for maximize security.</p>
                </a>
                
              </div>

              <div class="col-lg-3 col-md-6 inner-cat">
                
                <a href="#" class="inno-card">
                  <i class="icofont-briefcase"></i>
                  <h4>Business Intelligence</h4>
                  <p>Our theme architecture is designed for maximize security.</p>
                </a>
                
              </div>

              <div class="col-lg-3 col-md-6 inner-cat">
              
                <a href="#" class="inno-card">
                  <i class="icofont-ui-user-group"></i>
                  <h4>CRM</h4>
                  <p>Our theme architecture is designed for maximize security.</p>
                </a>
                
              </div>

              <div class="col-lg-3 col-md-6 inner-cat">
              
                <a href="#" class="inno-card">
                  <i class="icofont-dashboard-web"></i>
                  <h4>ERP</h4>
                  <p>Our theme architecture is designed for maximize security.</p>
                </a>
                
              </div>

              <div class="col-lg-3 col-md-6 inner-cat">
               
                <a href="#" class="inno-card">
                  <i class="icofont-connection"></i>
                  <h4>Collaboration Software</h4>
                  <p>Our theme architecture is designed for maximize security.</p>
                </a>
               
              </div-->


            </div>
          </div>
        </div>
 <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
      </div>
    </div>
   
  </section>

  <?php $__env->stopSection(); ?>


 
<?php echo $__env->make('layouts.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/home/categories-list.blade.php ENDPATH**/ ?>
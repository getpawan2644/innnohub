  <!-- header -->
  <header class="home_header">
    <nav class="navbar navbar-expand-lg navbar-dark">
      <div class="container-fluid">
        <!-- logo -->
        <a class="navbar-brand" href="<?php echo e(route('home')); ?>">
          <img src="<?php echo e(asset('image/logo.png')); ?>" alt="logo">
        </a>
        <!-- logo end -->

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">

            <li class="nav-item dropdown">
              <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                All Categories <i class="icofont-rounded-down"></i>
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <?php $__currentLoopData = CommonHelper::getAllCategory(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                 <?php $arr = explode(' ',trim($value['name']));   ?>
                  <li><a class="dropdown-item" href="<?php echo e(url('category-list?name='.lcfirst($arr[0]))); ?>"> <i class="icofont-ui-v-card"></i> <?php echo e($value['name']); ?></a></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                <!--li><a class="dropdown-item" href="categories-list.html"> <i class="icofont-building-alt"></i>Industry</a></li>
                <li><a class="dropdown-item" href="categories-list.html"><i class="icofont-building"></i> Department</a></li>
                <li><a class="dropdown-item" href="categories-list.html"><i class="icofont-users-alt-5"></i> Suitable for number of employees</a></li>
                <li><a class="dropdown-item" href="categories-list.html"><i class="icofont-readernaut"></i> Deployment options</a></li>
                <li><a class="dropdown-item" href="categories-list.html"><i class="icofont-user-suited"></i> Open to Partnerships</a></li>
                <li><a class="dropdown-item" href="categories-list.html"><i class="icofont-bank-alt"></i> Headquartered in</a></li-->
              </ul>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?php echo e(route('cms.about')); ?>">About us</a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="<?php echo e(route('cms.contact')); ?> ">Contact us</a>
            </li>
          </ul>

          <div class="nav-right">
            <!-- search -->
            <form class="top_search" >
              <div class="form-group">
                <input class="form-control" type="search" placeholder="Search" aria-label="Search" required>
              </div>
              <button onclick="openSearch()" class="search-btn" type="button"><i class="icofont-search-1"></i></button>
            </form>
            <!-- search -->

            <!-- login register -->

            <div class="dropdown">
                <!-- right menu -->
                <?php if(Auth::check()): ?>
                <div class="menu">
                    <ul>
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                              <li class="nav-item dropdown after-login">
                                <a class="nav-link" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="icofont-ui-user"></i>
                                    <span><?php echo e(Auth::user()->full_name); ?></span>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <li><a class="dropdown-item" href="<?php echo e(route("user.edit-profile")); ?>"><i class="icofont-ui-user"></i> <?php echo e(__("header.edit_profile")); ?></a></li>
                                        <li><a class="dropdown-item" href="<?php echo e(route("user.change-password")); ?>"><i class="icofont-gear"></i> <?php echo e(__("header.change_password")); ?></a></li>
                                        <li><div class="dropdown-divider"></div>
                                        <a class="dropdown-item" href="<?php echo e(route('user.logout')); ?>"><i class="fas fa-sign-out-alt"></i><?php echo e(__('header.logout')); ?></a></li>
                                </ul>
                            </li>
                            </ul>
                        </div>
                    </ul>
                </div>
                <?php else: ?>
                <button class="inno-orange-btn" type="button" data-bs-toggle="modal" data-bs-target="#login_model">
                    Login/Register
                  </button>
                <?php endif; ?>
                <!-- right menu end -->
            </div>

            </div>
            <!-- login register end -->
          </div>


        </div>
      </div>
    </nav>
  </header>
  <!-- header end -->
<?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/elements/layout/header.blade.php ENDPATH**/ ?>
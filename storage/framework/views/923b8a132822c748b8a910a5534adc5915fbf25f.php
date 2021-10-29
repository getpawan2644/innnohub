<?php
	use App\Models\Admin;
	use Illuminate\Support\Facades\Route;
	$subadmin=Admin::SUBADMIN;
	$admin=Admin::ADMIN;
	$allowed_routes=\App\Helpers\CommonHelper::getallowRoutes();
	$routeName = Route::currentRouteName();
	
?>

<!-- START MENU SIDEBAR WRAPPER -->
<aside class="sidebar sidebar-left">
	<div class="sidebar-content">
		<div class="aside-toolbar">
			<ul class="site-logo">
				<li>
					<!-- START LOGO -->
					<a href="<?php echo e(route('admin.dashboard.index')); ?>">
						<div class="logo">
							<img id="logo" src="<?php echo e(asset('img/admin/logo2x.png')); ?>" />
						</div>
						<span class="brand-text"><?php echo e(env("APP_NAME")); ?></span>
					</a>
					<!-- END LOGO -->
				</li>
			</ul>
			<ul class="header-controls">
				<li class="nav-item">
					<button type="button" class="btn btn-link btn-menu" data-toggle-state="mini-sidebar">
						<i class="la la-dot-circle-o"></i>
					</button>
				</li>
			</ul>
		</div>
		<nav class="main-menu">
			<ul class="nav metismenu">
				<li class="sidebar-header"><span>NAVIGATION</span></li>
				<li class="<?php echo e(in_array($routeName,['admin.dashboard.index']) ? 'active':''); ?>">
					<a href="<?php echo e(route('admin.dashboard.index')); ?>">
						<i class="icon dripicons-meter"></i><span>Dashboard</span>
					</a>
				</li>

                <?php if(Auth::user()['role'] == $admin || in_array('admin.cms.index', $allowed_routes)): ?>
                    <li class="<?php echo e(in_array($routeName,['admin.cms.index','admin.cms..create', 'admin.cms..edit']) ? 'active_l':''); ?> nav-dropdown">
                        <a class="" href="<?php echo e(route('admin.cms.index')); ?>"><i class="icon dripicons-web"></i><span>CMS</span></a>
                    </li>
                <?php endif; ?>

                <?php if(Auth::user()['role'] == $admin || in_array('admin.contacts.index', $allowed_routes)): ?>
                    <li class="<?php echo e(in_array($routeName,['admin.contacts.index']) ? 'active_l':''); ?> nav-dropdown">
                        <a class="" href="<?php echo e(route('admin.contacts.index')); ?>"><i class="icon dripicons-web"></i><span>Contacts </span></a>
                    </li>
                <?php endif; ?>


                <?php if(Auth::user()['role'] == $admin || in_array('admin.countries.index', $allowed_routes)): ?>
                    <li class="<?php echo e(in_array($routeName,['admin.countries.index','admin.countries.create', 'admin.countries.edit']) ? 'active_l':''); ?> nav-dropdown">
                        <a class="" href="<?php echo e(route('admin.countries.index')); ?>"><i class="icon dripicons-web"></i><span>Countries </span></a>
                    </li>
                <?php endif; ?>
                
                 <?php if(Auth::user()['role'] == $admin || in_array('admin.categories.index', $allowed_routes)): ?>
                <li class="<?php echo e(in_array($routeName,['admin.categories.index','admin.categories.create', 'admin.categories.edit']) ? 'active_l':''); ?> nav-dropdown">
                    <a class="" href="<?php echo e(route('admin.categories.index')); ?>"><i class="icon dripicons-align-justify"></i><span> Categories </span></a>

                </li>
                <?php endif; ?>
                <?php if(Auth::user()['role'] == $admin || in_array('admin.sub_categories.index', $allowed_routes)): ?>
                <li class="<?php echo e(in_array($routeName,['admin.sub_categories.index','admin.sub_categories.create', 'admin.sub_categories.edit']) ? 'active_l':''); ?> nav-dropdown">
                    <a class="" href="<?php echo e(route('admin.sub_categories.index')); ?>"><i class="icon zmdi zmdi-device-hub zmdi-hc-fw"></i><span>Sub-Categories </span></a>
                </li>
                <?php endif; ?>
               
                <?php if(Auth::user()['role'] == $admin || in_array('admin.users.index', $allowed_routes)): ?>
                <li class="<?php echo e(in_array($routeName,['admin.users.index','admin.users.create','admin.service-view', 'admin.users.edit']) ? 'active_l':''); ?> nav-dropdown">
                    <a class="" href="<?php echo e(route('admin.users.index')); ?>"><i class="icon dripicons-user-group"></i><span>Users </span></a>
                </li>
                <?php endif; ?>
                
              <!-- <?php if(Auth::user()['role'] == $admin || in_array('admin.email-template.index', $allowed_routes)): ?>
                <li class="<?php echo e(in_array($routeName,['admin.email-template.index','admin.email-template.edit', 'admin.email-template.update']) ? 'active_l':''); ?> nav-dropdown">
                    <a class="" href="<?php echo e(route('admin.email-template.index')); ?>"><i class="zmdi zmdi-email-open"></i><span>Email Template </span></a>
                </li>
                <?php endif; ?> -->






































			</ul>
		</nav>
	</div>
</aside>
<!-- END MENU SIDEBAR WRAPPER -->
<?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/elements/layouts/sidebar.blade.php ENDPATH**/ ?>
<!-- START LOGO WRAPPER -->
<nav class="top-toolbar navbar navbar-mobile navbar-tablet">
	<ul class="navbar-nav nav-left">
		<li class="nav-item">
			<a href="javascript:void(0)" data-toggle-state="aside-left-open">
				<i class="icon dripicons-align-left"></i>
			</a>
		</li>
	</ul>
	<ul class="navbar-nav nav-center site-logo">
		<li>
			<a href="<?php echo e(route('admin.dashboard.index')); ?>">
				<div class="logo_mobile">
					<!-- <img id="logo_mobile"  width="30" height="30" src="<?php echo e(asset('img/admin/logo2x.png')); ?>" /> -->Topvestor
				</div>
				<span class="brand-text"><?php echo e(env("APP_NAME")); ?></span>
			</a>
		</li>
	</ul>
	<ul class="navbar-nav nav-right">
		<li class="nav-item">
			<a href="javascript:void(0)" data-toggle-state="mobile-topbar-toggle">
				<i class="icon dripicons-dots-3 rotate-90"></i>
			</a>
		</li>
	</ul>
</nav>
<!-- END LOGO WRAPPER -->
<!-- START TOP TOOLBAR WRAPPER -->
<nav class="top-toolbar navbar navbar-desktop flex-nowrap">
	<!--
	<ul class="navbar-nav nav-left">
		<li class="nav-item nav-text dropdown dropdown-menu-md">
			<a href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<span>
					Dropdown
				</span>
				<i class="la la-angle-down menu-arrow-down"></i>
			</a>
			<div class="dropdown-menu menu-icons dropdown-menu-left">
				<div class="form-group form-filter">
					<input type="text" placeholder="Filter location..." class="form-control filter-input" data-search-trigger="open">
					<i data-q-action="clear-filter" class="icon dripicons-cross clear-filter"></i>
					<ul class="list-reset filter-list" data-scroll="minimal-dark">
						<li><a class="dropdown-item" href="#">New York, N.Y.</a></li>
						<li><a class="dropdown-item" href="#">Los Angeles, Calif.</a></li>
						<li> <a class="dropdown-item" href="#">Chicago, Ill.</a></li>
						<li> <a class="dropdown-item" href="#">Houston, Tex.</a></li>
						<li> <a class="dropdown-item" href="#"> Philadelphia, Pa.</a></li>
						<li> <a class="dropdown-item" href="#">	Phoenix, Ariz. </a></li>
						<li> <a class="dropdown-item" href="#"> San Antonio, Tex.</a></li>
						<li> <a class="dropdown-item" href="#">San Diego, Calif. </a></li>
						<li> <a class="dropdown-item" href="#"> Dallas, Tex.</a></li>
						<li> <a class="dropdown-item" href="#">San Jose, Calif. </a></li>
						<li> <a class="dropdown-item" href="#"> Austin, Tex.</a></li>
						<li> <a class="dropdown-item" href="#"> Jacksonville, Fla.</a></li>
						<li> <a class="dropdown-item" href="#">San Francisco, Calif. </a></li>
						<li> <a class="dropdown-item" href="#">Indianapolis, Ind. </a></li>
						<li> <a class="dropdown-item" href="#"> Columbus, Ohio</a></li>
						<li> <a class="dropdown-item" href="#">Fort Worth, Tex. </a></li>
						<li> <a class="dropdown-item" href="#"> Charlotte, N.C.</a></li>
						<li> <a class="dropdown-item" href="#"> Detroit, Mich.</a></li>
						<li> <a class="dropdown-item" href="#">El Paso, Tex. </a></li>
						<li> <a class="dropdown-item" href="#">Seattle, Wash.</a></li>
					</ul>
				</div>
			</div>
		</li>
		
		<li class="nav-item nav-text dropdown dropdown-menu-xl">
			<a href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<span>
					Mega Menu
				</span>
				<i class="la la-angle-down menu-arrow-down"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-left">
				<div class="row">
					<div class="col">
						<h3 class="menu-header">Shop Top Categories</h3>
						<ul class="list-items">
							<li>
								<a href="javascript:void(0);">T-Shirts</a>
							</li>
							<li>
								<a href="javascript:void(0);">Tank Tops &amp; Fitted Tees</a>
							</li>
							<li>
								<a href="javascript:void(0);">Polos &amp; Button-Ups</a>
							</li>
							<li>
								<a href="javascript:void(0);">Women's Tops</a>
							</li>
							<li>
								<a href="javascript:void(0);">Dresses &amp; Skirts</a>
							</li>
							<li>
								<a href="javascript:void(0);">Sweaters &amp; Cardigans</a>
							</li>
							<li>
								<a href="javascript:void(0);">Hoodies</a>
							</li>
							<li>
								<a href="javascript:void(0);">Jackets &amp; Outerwear</a>
							</li>
							<li>
								<a href="javascript:void(0);">Activewear &amp; Swimwear</a>
							</li>
							<li>
								<a href="javascript:void(0);">Men's Jeans</a>
							</li>
						</ul>
					</div>
					<div class="col">
						<h3 class="menu-header">Accessories</h3>
						<ul class="list-items">
							<li>
								<a href="javascript:void(0);">Footwear</a>
							</li>
							<li>
								<a href="javascript:void(0);">Keychains &amp; Bag Accessories</a>
							</li>
							<li>
								<a href="javascript:void(0);">Wallets</a>
							</li>
							<li>
								<a href="javascript:void(0);">Hats &amp; Hair</a>
							</li>
							<li>
								<a href="javascript:void(0);">Ties &amp; Cufflinks</a>
							</li>
							<li>
								<a href="javascript:void(0);">Belts &amp; Suspenders</a>
							</li>
							<li>
								<a href="javascript:void(0);">Scarves</a>
							</li>
							<li>
								<a href="javascript:void(0);">Pouches &amp; Coin Purses</a>
							</li>
							<li>
								<a href="javascript:void(0);">Sunglasses</a>
							</li>
							<li>
								<a href="javascript:void(0);">Other Accessories</a>
							</li>
						</ul>
					</div>
					<div class="col">
						<figure class="tint">
							<div class="promo">
								<h3>Grand Opening Sale!</h3>
								<h4>Save up to 30% off.</h4>
								<button class="btn btn-primary btn-rounded">Shop Now</button>
							</div>
							<img src="../assets/img/demos/ecom-header.jpg" alt="">
						</figure>
					</div>
				</div>
			</div>
		</li>
	</ul>-->
	<!-- END LEFT DROPDOWN MENUS -->
	<!-- START RIGHT TOOLBAR ICON MENUS -->
	<ul class="navbar-nav nav-right">
		<!--<li class="nav-item">
			<a href="javascript:void(0)" class="open-search-button" data-q-action="open-site-search">
				<i class="icon dripicons-search"></i>
			</a>
		</li>
		<li class="nav-item dropdown dropdown-menu-lg">
			<a href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<i class="icon dripicons-view-apps"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right p-0">
				<div class="dropdown-menu-grid">
					<div class="menu-grid-row">
						<div><a class="dropdown-item  border-bottom border-right" href="apps.mail.html"><i class="icon dripicons-mail"></i><span>Mail</span></a></div>
						<div><a class="dropdown-item  border-bottom" href="apps.messages.html"><i class="icon dripicons-message"></i><span>Messages</span></a></div>
					</div>
					<div class="menu-grid-row">
						<div><a class="dropdown-item  border-right" href="apps.contacts.html"><i class="icon dripicons-archive"></i><span>Contacts</span></a></div>
						<div> <a class="dropdown-item" href="apps.calendar.html"><i class="icon dripicons-calendar"></i><span>Calendar</span></a></div>
					</div>
				</div>
			</div>
		</li>
		<li class="nav-item dropdown dropdown-notifications dropdown-menu-lg">
			<a href="javascript:void(0)" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				<i class="icon dripicons-bell"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right">
				<div class="card card-notification">
					<div class="card-header">
						<h5 class="card-title">Notifications</h5>
						<ul class="actions top-right">
							<li>
								<a href="javascript:void(0);" data-q-action="open-notifi-config">
									<i class="icon dripicons-gear"></i>
								</a>
							</li>
						</ul>
					</div>
					<div class="card-body">
						<div class="card-container-wrapper">
							<div class="card-container">
								<div class="timeline timeline-border">
									<div class="timeline-list">
										<div class="timeline-info">
											<div>Prep for bi-weekly meeting with <a href="javascript:void(0)"><strong>Steven Weinberg</strong></a> </div>
											<small class="text-muted">07/05/18, 2:00 PM</small>
										</div>
									</div>
									<div class="timeline-list timeline-border timeline-primary">
										<div class="timeline-info">
											<div>Skype call with development team</div>
											<small class="text-muted">07/07/18, 1:00 PM</small>
										</div>
									</div>
									<div class="timeline-list  timeline-border timeline-accent">
										<div class="timeline-info">
											<div>Programming control system</div>
											<small class="text-muted">07/09/18, 10:00 AM - 6:00 PM</small>
										</div>
									</div>
									<div class="timeline-list  timeline-border timeline-success">
										<div class="timeline-info">
											<div>Lunch with Peter Higgs</div>
											<small class="text-muted">07/10/18, 12:00 PM</small>
										</div>
									</div>
									<div class="timeline-list  timeline-border timeline-warning">
										<div class="timeline-info">
											<div><a href="#"><strong>Approve Request</strong></a> for new training material by</div>
											<small class="text-muted">07/11/18, 9:00 AM</small>
										</div>
									</div>
									<div class="timeline-list  timeline-border timeline-info">
										<div class="timeline-info">
											<div><a href="#"><strong>RSVP</strong></a> for this year's hackathon.</div>
											<small class="text-muted">07/11/18, 1:30 PM</small>
										</div>
									</div>
								</div>
							</div>
							<div class="card-container">
								<h6 class="p-0 m-0">
									Show notifications from:
								</h6>
								<div class="row m-b-20 m-t-30">
									<div class="col-10"><span class="title"><i class="icon dripicons-calendar"></i>Calendar</span></div>
									<div class="col-2"><input type="checkbox" class="js-switch" checked /></div>
								</div>
								<div class="row m-b-20">
									<div class="col-10"><span class="title"><i class="icon dripicons-mail"></i>Email</span></div>
									<div class="col-2"><input type="checkbox" class="js-switch" checked/></div>
								</div>
								<div class="row m-b-20">
									<div class="col-10"><span class="title"><i class="icon dripicons-message"></i>Messages</span></div>
									<div class="col-2"><input type="checkbox" class="js-switch" /></div>
								</div>
								<div class="row m-b-20">
									<div class="col-10"><span class="title"><i class="icon dripicons-stack"></i>Projects</span></div>
									<div class="col-2"><input type="checkbox" class="js-switch" checked/></div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</li>-->
		<li class="nav-item dropdown">
			<a class="nav-link nav-pill user-avatar" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">
				<img src="<?php echo e(Auth::guard('admin')->user()->profile_pic_url); ?>" class="w-35 rounded-circle" alt="Albert Einstein">
			</a>
			<div class="dropdown-menu dropdown-menu-right dropdown-menu-accout">
				<div class="dropdown-header pb-3">
					<div class="media d-user">
						<img class="align-self-center mr-3 w-40 rounded-circle" src="<?php echo e(Auth::guard('admin')->user()->profile_pic_url); ?>" alt="Albert Einstein">
						<div class="media-body">
							<h5 class="mt-0 mb-0"><?php echo e(Auth::guard('admin')->user()->name); ?></h5>
							<span><?php echo e(Auth::guard('admin')->user()->email); ?></span>
						</div>
					</div>
				</div>
				<a class="dropdown-item" href="<?php echo e(route('admin.showProfileForm')); ?>">
					<i class="icon dripicons-user"></i> Profile
				</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="<?php echo e(route('admin.showPasswordForm')); ?>">
					<i class="icon dripicons-gear"></i> Change Password
				</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="<?php echo e(route('admin.logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					<i class="icon dripicons-lock-open"></i> Sign Out
				</a>
				<form id="logout-form" action="<?php echo e(route('admin.logout')); ?>" method="POST" style="display: none;">
					<?php echo csrf_field(); ?>
				</form>
			</div>
		</li>
		<!--li class="nav-item">
			<a href="javascript:void(0)" data-toggle-state="aside-right-open">
				<i class="icon dripicons-align-right"></i>
			</a>
		</li-->
	</ul>
	<!-- END RIGHT TOOLBAR ICON MENUS -->
	<!--START TOP TOOLBAR SEARCH
	<form role="search" action="http://www.authenticgoods.co/themes/quantum-pro/demos/demo1/pages.search.html" class="navbar-form">
		<div class="form-group">
			<input type="text" placeholder="Search and press enter..." class="form-control navbar-search" autocomplete="off">
			<i data-q-action="close-site-search" class="icon dripicons-cross close-search"></i>
		</div>
		<button type="submit" class="d-none">Submit</button>
	</form>
	END TOP TOOLBAR SEARCH -->
</nav>
<!-- END TOP TOOLBAR WRAPPER --><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/elements/layouts/nav.blade.php ENDPATH**/ ?>
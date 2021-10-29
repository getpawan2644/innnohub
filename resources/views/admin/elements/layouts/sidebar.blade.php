@php
	use App\Models\Admin;
	use Illuminate\Support\Facades\Route;
	$subadmin=Admin::SUBADMIN;
	$admin=Admin::ADMIN;
	$allowed_routes=\App\Helpers\CommonHelper::getallowRoutes();
	$routeName = Route::currentRouteName();
	
@endphp

<!-- START MENU SIDEBAR WRAPPER -->
<aside class="sidebar sidebar-left">
	<div class="sidebar-content">
		<div class="aside-toolbar">
			<ul class="site-logo">
				<li>
					<!-- START LOGO -->
					<a href="{{ route('admin.dashboard.index') }}">
						<div class="logo">
							<img id="logo" src="{{ asset('img/admin/logo2x.png') }}" />
						</div>
						<span class="brand-text">{{ env("APP_NAME") }}</span>
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
				<li class="{{ in_array($routeName,['admin.dashboard.index']) ? 'active':'' }}">
					<a href="{{ route('admin.dashboard.index') }}">
						<i class="icon dripicons-meter"></i><span>Dashboard</span>
					</a>
				</li>

                @if(Auth::user()['role'] == $admin || in_array('admin.cms.index', $allowed_routes))
                    <li class="{{ in_array($routeName,['admin.cms.index','admin.cms..create', 'admin.cms..edit']) ? 'active_l':'' }} nav-dropdown">
                        <a class="" href="{{ route('admin.cms.index') }}"><i class="icon dripicons-web"></i><span>CMS</span></a>
                    </li>
                @endif

                @if(Auth::user()['role'] == $admin || in_array('admin.contacts.index', $allowed_routes))
                    <li class="{{ in_array($routeName,['admin.contacts.index']) ? 'active_l':'' }} nav-dropdown">
                        <a class="" href="{{ route('admin.contacts.index') }}"><i class="icon dripicons-web"></i><span>Contacts </span></a>
                    </li>
                @endif


                @if(Auth::user()['role'] == $admin || in_array('admin.countries.index', $allowed_routes))
                    <li class="{{ in_array($routeName,['admin.countries.index','admin.countries.create', 'admin.countries.edit']) ? 'active_l':'' }} nav-dropdown">
                        <a class="" href="{{ route('admin.countries.index') }}"><i class="icon dripicons-web"></i><span>Countries </span></a>
                    </li>
                @endif
                
                 @if(Auth::user()['role'] == $admin || in_array('admin.categories.index', $allowed_routes))
                <li class="{{ in_array($routeName,['admin.categories.index','admin.categories.create', 'admin.categories.edit']) ? 'active_l':'' }} nav-dropdown">
                    <a class="" href="{{ route('admin.categories.index') }}"><i class="icon dripicons-align-justify"></i><span> Categories </span></a>

                </li>
                @endif
                @if(Auth::user()['role'] == $admin || in_array('admin.sub_categories.index', $allowed_routes))
                <li class="{{ in_array($routeName,['admin.sub_categories.index','admin.sub_categories.create', 'admin.sub_categories.edit']) ? 'active_l':'' }} nav-dropdown">
                    <a class="" href="{{ route('admin.sub_categories.index') }}"><i class="icon zmdi zmdi-device-hub zmdi-hc-fw"></i><span>Sub-Categories </span></a>
                </li>
                @endif
               
                @if(Auth::user()['role'] == $admin || in_array('admin.users.index', $allowed_routes))
                <li class="{{ in_array($routeName,['admin.users.index','admin.users.create','admin.service-view', 'admin.users.edit']) ? 'active_l':'' }} nav-dropdown">
                    <a class="" href="{{ route('admin.users.index') }}"><i class="icon dripicons-user-group"></i><span>Users </span></a>
                </li>
                @endif
                
              <!-- @if(Auth::user()['role'] == $admin || in_array('admin.email-template.index', $allowed_routes))
                <li class="{{ in_array($routeName,['admin.email-template.index','admin.email-template.edit', 'admin.email-template.update']) ? 'active_l':'' }} nav-dropdown">
                    <a class="" href="{{ route('admin.email-template.index') }}"><i class="zmdi zmdi-email-open"></i><span>Email Template </span></a>
                </li>
                @endif -->

{{--                @if(Auth::user()['role'] == $admin || in_array('admin.service-list', $allowed_routes))--}}

{{--                <li class="{{ in_array($routeName,['admin.service-list','admin.service-add','admin.service-edit']) ? 'active_l':'' }} nav-dropdown"-->--}}
{{--                    <a class="" href="{{ route('admin.service-list') }}"><i class="zmdi zmdi-store"></i><span>Service List </span></a>--}}
{{--                </li>--}}
{{--                @endif--}}
{{--                @if(Auth::user()['role'] == $admin || in_array('admin.service-list', $allowed_routes))--}}

{{--                <li class="{{ in_array($routeName,['admin.gallery.index','admin.gallery.add','admin.gallery.edit']) ? 'active_l':'' }} nav-dropdown"-->--}}
{{--                    <a class="" href="{{ route('admin.gallery.index') }}"><i class="zmdi zmdi-store"></i><span>Gallery List </span></a>--}}
{{--                </li>--}}
{{--                @endif--}}
{{--                @if(Auth::user()['role'] == $admin || in_array('admin.service-list', $allowed_routes))--}}

{{--                <li class="{{ in_array($routeName,['admin.casestudy.index','admin.casestudy.add','admin.casestudy.edit']) ? 'active_l':'' }} nav-dropdown"-->--}}
{{--                    <a class="" href="{{ route('admin.casestudy.index') }}"><i class="zmdi zmdi-store"></i><span>Case Studies List </span></a>--}}
{{--                </li>--}}
{{--                @endif--}}
{{--                @if(Auth::user()['role'] == $admin || in_array('admin.testimonials.index', $allowed_routes))--}}
{{--               --}}
{{--                <li class="{{ in_array($routeName,['admin.testimonials.index','admin.testimonials.add','admin.testimonials.edit']) ? 'active_l':'' }} nav-dropdown"-->--}}
{{--                    <a class="" href="{{ route('admin.testimonials.index') }}"><i class="zmdi zmdi-store"></i><span>Testimonials</span></a>--}}
{{--                </li>--}}
{{--                @endif--}}
{{--                 @if(Auth::user()['role'] == $admin || in_array('admin.awards.index', $allowed_routes))--}}

{{--                <li class="{{ in_array($routeName,['admin.awards.index','admin.awards.add','admin.awards.edit']) ? 'active_l':'' }} nav-dropdown"-->--}}
{{--                    <a class="" href="{{ route('admin.awards.index') }}"><i class="zmdi zmdi-store"></i><span>Awards</span></a>--}}
{{--                </li>--}}
{{--				@endif--}}

{{--				@if(Auth::user()['role'] == $admin || in_array('admin.feature.index', $allowed_routes))--}}

{{--                <li class="{{ in_array($routeName,['admin.feature.index','admin.feature.add','admin.feature.edit']) ? 'active_l':'' }} nav-dropdown"-->--}}
{{--                    <a class="" href="{{ route('admin.features.index') }}"><i class="zmdi zmdi-store"></i><span>Features</span></a>--}}
{{--                </li>--}}
{{--                @endif--}}
			</ul>
		</nav>
	</div>
</aside>
<!-- END MENU SIDEBAR WRAPPER -->

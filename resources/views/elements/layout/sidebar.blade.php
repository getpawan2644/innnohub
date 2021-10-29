@php
    $routeName = Route::currentRouteName();
    //echo $routeName; die;
@endphp
<style>
	.s_active_link{
		background-color: #d1e3f5 !important;
	}
	.sidenav .navbar .container-fluid .navbar-nav .nav-item .nav-link{
		padding: 4px;
	}
</style>
<div class="col-lg-2 col-md-12 side_nav_bg">
    <div class="sidenav">
        <nav class="navbar navbar-expand-lg navbar-light">
		  <div class="container-fluid">
			<a class="user_menu">User Menu</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent1" aria-controls="navbarSupportedContent1" aria-expanded="false" aria-label="Toggle navigation">
			  <span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent1">
			  <ul class="navbar-nav">
				<li class="nav-item">
					<span>Dashboard</span>
				</li>
				<!--li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					User Profile
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#">Edit Profile</a></li>
					<li><a class="dropdown-item" href="#">Change Password</a></li>
					<li><a class="dropdown-item" href="#">Calender</a></li>
					<li><a class="dropdown-item" href="#">Meeting Request</a></li>
				  </ul>
				</li-->
				<li class="nav-item">
				  <a class="nav-link {{((Route::currentRouteName()=="user.edit-profile"))?'s_active_link':''}}" href="{{route('user.edit-profile')}}"  role="button" >
					Edit Profile
				  </a>
               </li>
               <li class="nav-item">
				  <a class="nav-link {{((Route::currentRouteName()=="user.change-password"))?'s_active_link':''}}" href="{{route('user.change-password')}}"  role="button" >
					Change Password
				  </a>
               </li>
                <li class="nav-item">
				  <a class="nav-link {{((Route::currentRouteName()=="user.calendar"))?'s_active_link':''}}" href="{{ URL('user/calendar')}}">Calendar</a>
				</li>
               @if(Auth::check())
              @if(Auth::user()->user_type == 'vendor')
            

				 <li class="nav-item">
				  <a class="nav-link {{((Route::currentRouteName()=="meeting.request"))?'s_active_link':''}}" href="{{URL('meeting/request')}}">Meeting Request</a>
				</li>
				
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle {{((Route::currentRouteName()=="service.create") || (Route::currentRouteName()=="service.index") || (Route::currentRouteName()=="service.edit"))?' s_active_link':''}}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Services
				  </a>
				  <ul class="dropdown-menu {{((Route::currentRouteName()=="service.create") || (Route::currentRouteName()=="service.index") || (Route::currentRouteName()=="service.edit"))?' ':''}}" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item {{((Route::currentRouteName()=="service.create"))?'s_active_link':''}}" href="{{ URL('services/create')}}">Add Services</a></li>
					<li><a class="dropdown-item {{((Route::currentRouteName()=="service.index") || (Route::currentRouteName()=="service.edit"))?'s_active_link':''}}" href="{{URL('services')}}">Services Details</a></li>
				 </ul>
				</li>
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle {{((Route::currentRouteName()=="gallery.index") || (Route::currentRouteName()=="gallery.edit") || (Route::currentRouteName()=="gallery.add"))?'s_active_link':''}}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Gallery
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item {{((Route::currentRouteName()=="gallery.add"))?'s_active_link':''}}" href="{{ URL('gallery/add')}}">Add Gallery</a></li>
					<li><a class="dropdown-item{{((Route::currentRouteName()=="gallery.index") || (Route::currentRouteName()=="gallery.edit"))?'s_active_link':''}} " href="{{URL('gallery')}}">View Gallery</a></li>
				 </ul>
				</li>
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle {{((Route::currentRouteName()=="casestudy.add") || (Route::currentRouteName()=="casestudy.index") || (Route::currentRouteName()=="casestudy.edit"))?'s_active_link':''}}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Mange Case Study
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item {{((Route::currentRouteName()=="casestudy.add"))?'s_active_link':''}}" href="{{ URL('case-study/add')}}">Add Case study</a></li>
					<li><a class="dropdown-item {{((Route::currentRouteName()=="casestudy.index") || (Route::currentRouteName()=="casestudy.edit"))?'s_active_link':''}}" href="{{URL('case-study')}}">Case Study</a></li>
				 </ul>
				</li>
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle {{((Route::currentRouteName()=="testimonials.add") || (Route::currentRouteName()=="testimonials.index") || (Route::currentRouteName()=="testimonials.edit"))?'s_active_link':''}}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Testimonial
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item {{((Route::currentRouteName()=="testimonials.add"))?'s_active_link':''}}" href="{{ URL('testimonials/add')}}">Add Testimonail</a></li>
					<li><a class="dropdown-item {{((Route::currentRouteName()=="testimonials.index") || (Route::currentRouteName()=="testimonials.edit"))?'s_active_link':''}}" href="{{URL('testimonials')}}">View Testimonail</a></li>
				 </ul>
				</li>
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle {{((Route::currentRouteName()=="awards.index") || (Route::currentRouteName()=="awards.edit") || (Route::currentRouteName()=="awards.add"))?'s_active_link':''}}" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Awards
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item {{((Route::currentRouteName()=="awards.add"))?'s_active_link':''}}" href="{{ URL('awards/add')}}">Add Award</a></li>
					<li><a class="dropdown-item {{((Route::currentRouteName()=="awards.index") || (Route::currentRouteName()=="awards.edit"))?'s_active_link':''}}" href="{{URL('awards')}}">View Awards</a></li>
				 </ul>
				</li>
				<li class="nav-item">
				  <a class="nav-link {{((Route::currentRouteName()=="features.edit"))?'s_active_link':''}}" href="{{ URL('features/edit')}}">Features</a>
				</li>
				 @else
				 <li class="nav-item">
				  <a class="nav-link {{((Route::currentRouteName()=="meeting.index"))?'s_active_link':''}}" href="{{URL('meeting')}}">Meeting Request</a>
				</li>
				 @endif
				 @endif
				</ul>
			</div>
		  </div>
		</nav>
    </div>
</div>
<script>
    /* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
    var dropdown = document.getElementsByClassName("dropdown-btn");
    var i;

    for (i = 0; i < dropdown.length; i++) {
        dropdown[i].addEventListener("click", function() {
            this.classList.toggle("active_sidebar");
            var dropdownContent = this.nextElementSibling;
            if (dropdownContent.style.display === "block") {
                dropdownContent.style.display = "none";
            } else {
                dropdownContent.style.display = "block";
            }
        });
    }
</script>

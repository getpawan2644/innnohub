@php
    $routeName = Route::currentRouteName();
    //echo $routeName; die;
@endphp
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
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					User Profile
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#">Edit Profile</a></li>
					<li><a class="dropdown-item" href="#">Change Password</a></li>
					<li><a class="dropdown-item" href="#">Calender</a></li>
					<li><a class="dropdown-item" href="#">Meeting Request</a></li>
				  </ul>
				</li>
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Services
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#">Add Services</a></li>
					<li><a class="dropdown-item" href="#">Services Details</a></li>
				 </ul>
				</li>
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Gallery
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#">Add Gallery</a></li>
					<li><a class="dropdown-item" href="#">View Gallery</a></li>
				 </ul>
				</li>
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Mange Case Study
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#">Add Case study</a></li>
					<li><a class="dropdown-item" href="#">Case Study</a></li>
				 </ul>
				</li>
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Testimonial
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#">Add Testimonail</a></li>
					<li><a class="dropdown-item" href="#">View Testimonail</a></li>
				 </ul>
				</li>
				<li class="nav-item dropdown">
				  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
					Awards
				  </a>
				  <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
					<li><a class="dropdown-item" href="#">Add Award</a></li>
					<li><a class="dropdown-item" href="#">View Awards</a></li>
				 </ul>
				</li>
				<li class="nav-item">
				  <a class="nav-link" href="#">Features</a>
				</li>
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

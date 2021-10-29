$(window).scroll(function() {    
    var scroll = $(window).scrollTop();

    if (scroll >= 100) {
        $("header").addClass("w-header");
    } else {
        $("header").removeClass("w-header");
    }
});

jQuery(function ($) {

    $(".sidebar-dropdown > label").click(function() {
	  $(".sidebar-submenu").slideUp(200);
	  if ($(this).parent().hasClass("active") ) {
				$(".sidebar-dropdown").removeClass("active");
				$(this).parent().removeClass("active");
			} 
	  else {
		$(".sidebar-dropdown").removeClass("active");
		$(this).next(".sidebar-submenu").slideDown(200);
		$(this).parent().addClass("active");
	  }
	});
	
	  $(".multi-dropdown > a").click(function() {
	  $(".multi-inner").slideUp(200);
	  if (
		$(this)
		  .parent()
		  .hasClass("active")
	  ) {
		$(".multi-dropdown").removeClass("active");
		$(this)
		  .parent()
		  .removeClass("active");
	  } else {
		$(".multi-dropdown").removeClass("active");
		$(this)
		  .next(".multi-inner")
		  .slideDown(200);
		$(this)
		  .parent()
		  .addClass("active");
	  }
	});
	
	

	$(".show-sidebar, .category").click(function() {
	  $(".sidenav-wrapper").toggleClass("toggled");
	  $("#sidebar").css("display","block");
	  
	  $(document).mouseup(function (e)                    {
		  var container = $("#sidebar"); // YOUR CONTAINER SELECTOR
		  if (!container.is(e.target) // if the target of the click isn't the container...
			  && container.has(e.target).length === 0) // ... nor a descendant of the container
		  {
			//container.hide();
			$(".sidenav-wrapper").removeClass("toggled");
		  }
		});
	});
});


	
	

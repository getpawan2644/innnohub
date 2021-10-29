$(document).ready(function(){
	$(".drp_ser").click(function() {
		$(".list-unstyled").toggle();
	});
});
$(document).mouseup(function(e) {
    var container = $(".list-unstyled");
    // if the target of the click isn't the container nor a descendant of the container
    if (!container.is(e.target) && container.has(e.target).length === 0) 
    {
        container.hide();
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

	$(".show-sidebar, .hamburger").click(function() {
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



$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

$(document).ready(function(){
	$(".filter-mobile").click(function(){
	$(".filter-menu").toggle();
	});
});

$(document).ready(function(){
	$(".inner-filter").click(function(){
		$(".filters").toggle();
	});
	
	/* $(document).on("submit","form" , function(){
		$(this).find(':input[type=submit]').prop('disabled', true);
	}); */
	
	$('.password_eye i.ti-eye').click(function(){
		var input = $(this).prev('input');
		if(input.attr('type') == 'password'){
			input.attr('type','text');
			$(this).removeClass('eye-close');
		} else {
			input.attr('type','password');
			$(this).addClass('eye-close');
		}
	});
	
});

toastr.options = {
  "closeButton": true,
  "debug": false,
  "newestOnTop": true,
  "progressBar": true,
  "positionClass": "toast-top-full-width",
  "preventDuplicates": true,
  "onclick": null,
  "showDuration": "800",
  "hideDuration": "4000",
  "timeOut": "4000",
  "extendedTimeOut": "4000",
  "showEasing": "swing",
  "hideEasing": "swing",
  "showMethod": "slideDown",
  "hideMethod": "slideUp",
 // "preventDuplicates":true,
}


function alertMessage(message,type, title=''){
	if(type=='success'){
		//toastr.clear();
		toastr.success(message, title);
	}else if(type=='error'){
		//toastr.clear();
		toastr.error(message, title);
	}else if(type=='info'){
		toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "newestOnTop": true,
		  "progressBar": true,
		  "positionClass": "toast-bottom-right",
		  "preventDuplicates": true,
		  "onclick": null,
		  "showDuration": "800",
		  "hideDuration": "2000",
		  "timeOut": "2000",
		  "extendedTimeOut": "2000",
		  "showEasing": "swing",
		  "hideEasing": "swing",
		  "showMethod": "slideDown",
		  "hideMethod": "slideUp",
		 // "preventDuplicates":true,
		}
		//toastr.clear();
		toastr.info(message);
	}
}

var RightOptions = {
	"closeButton": true,
	"debug": false,
	"newestOnTop": true,
	"progressBar": true,
	"positionClass": "toast-top-right",
	"preventDuplicates": true,
	"onclick": null,
	"showDuration": "800",
	"hideDuration": "3000",
	"timeOut": "3000",
	"extendedTimeOut": "3000",
	"showEasing": "swing",
	"hideEasing": "swing",
	"showMethod": "slideDown",
	"hideMethod": "slideUp",
	// "preventDuplicates":true,
};

var TopOptions = {
	"closeButton": true,
	"debug": false,
	"newestOnTop": true,
	"progressBar": true,
	"positionClass": "toast-top-center",
	"preventDuplicates": true,
	"onclick": null,
	"showDuration": "800",
	"hideDuration": "3000",
	"timeOut": "3000",
	"extendedTimeOut": "3000",
	"showEasing": "swing",
	"hideEasing": "swing",
	"showMethod": "slideDown",
	"hideMethod": "slideUp",
	// "preventDuplicates":true,
};

var BottomOptions = toastr.options = {
	"closeButton": true,
	"debug": false,
	"newestOnTop": true,
	"progressBar": true,
	"positionClass": "toast-bottom-right",
	"preventDuplicates": true,
	"onclick": null,
	"showDuration": "800",
	"hideDuration": "2000",
	"timeOut": "2000",
	"extendedTimeOut": "2000",
	"showEasing": "swing",
	"hideEasing": "swing",
	"showMethod": "slideDown",
	"hideMethod": "slideUp",
   // "preventDuplicates":true,
  }

function alertMessageRight(message,type, title=''){
	toastr.options = RightOptions;
	if(type=='success'){
		toastr.success(message, title);
	}else if(type=='error'){
		toastr.error(message, title);
	}else if(type=='info'){
		toastr.info(message, title);
	}
}

function alertMessageTop(message,type, title=''){
	toastr.options = TopOptions;
	if(type=='success'){
		toastr.success(message, title);
	}else if(type=='error'){
		toastr.error(message, title);
	}else if(type=='info'){
		toastr.info(message, title);
	}
}

function alertMessageBottm(message,type, title=''){
	toastr.options = BottomOptions;
	if(type=='success'){
		toastr.success(message, title);
	}else if(type=='error'){
		toastr.options = {
		  "closeButton": true,
		  "debug": false,
		  "newestOnTop": true,
		  "progressBar": true,
		  "positionClass": "toast-bottom-right",
		  "preventDuplicates": true,
		  "onclick": null,
		  "showDuration": "800",
		  "hideDuration": "2000",
		  "timeOut": "2000",
		  "extendedTimeOut": "2000",
		  "showEasing": "swing",
		  "hideEasing": "swing",
		  "showMethod": "slideDown",
		  "hideMethod": "slideUp",
		 // "preventDuplicates":true,
		}
		toastr.error(message, title);
	}else if(type=='info'){
		toastr.info(message, title);
	}
}


function showModalPopup(options={}){
	if(options.content){
		let id = generateUUID();
		let closeImg = (options.closeImg)?options.closeImg:'X';
		let closeHtml = (options.showClose)?`<button type="button" class="close" data-dismiss="modal" aria-label="Close">${closeImg}</button>`:'';
		let html = `
			<div class="modal fade dynamicModal" id="${id}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog ${options.modalClass}" role="document">
					<div class="modal-content">
						${closeHtml}
						<div class="row">
							${options.content}
						</div>
					</div>
				</div>
			</div>
		`;		
		$('.dynamicModal').remove();
		$('body').append(html);
		$('#'+id).modal(options.modalOptions);
	}else{
		console.log('provide modal content');
	}
	
}

function generateUUID() { // Public Domain/MIT
    var d = new Date().getTime();
    if (typeof performance !== 'undefined' && typeof performance.now === 'function'){
        d += performance.now(); //use high-precision timer if available
    }
    return 'xxxxxxxx-xxxx-4xxx-yxxx-xxxxxxxxxxxx'.replace(/[xy]/g, function (c) {
        var r = (d + Math.random() * 16) % 16 | 0;
        d = Math.floor(d / 16);
        return (c === 'x' ? r : (r & 0x3 | 0x8)).toString(16);
    });
}


$(".dropdown").hover(
	function () {
		$('>.dropdown-menu', this).stop(true, true).fadeIn("fast");
		$(this).addClass('open');
	},
	function () {
		$('>.dropdown-menu', this).stop(true, true).fadeOut("fast");
		$(this).removeClass('open');
	});



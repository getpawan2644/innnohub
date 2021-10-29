if (typeof NProgress != 'undefined') {
	$(document).ready(function () {
        NProgress.start();
    });

    $(window).load(function () {
        NProgress.done();
    });
}

const ACTIVE = "Active";
const INACTIVE = "Inactive";

$(document).ready( function() {

	$(document).on('click','.confirmDelete',function(e){
		e.preventDefault();
		var href = $(this).attr('data-action');
		var text = $(this).attr('data-message');
		if(text==undefined){
			var text = "You want to delete this record.";
		}
		$.confirm({
			title: "Are you sure?",
			content: text,
			type: 'red',
			icon : 'fa fa-exclamation-circle',
			buttons: {
				ok: {
					text: "Yes, delete it!",
					btnClass: 'btn-primary',
					//keys: ['enter'],
					action: function(){
						window.location.href = href;
						//console.log('the user clicked confirm');
					}
				},
				cancel: function(){
					//console.log('the user clicked cancel');
				}
			}
		});
	});

	// Ajax Pagination and Ajax Sorting
	$(document).on('click', '.pagination a , table thead th a', function (e) {
		e.preventDefault();
		var thisHref = $(this).attr('href');
		if (!thisHref || thisHref=='#') {
			return false;
		}
		if ($('#container').length == '0') {
			window.location.href=thisHref;
			return false;
		}

		$.ajax({
			url : thisHref,
			type : 'GET',
			cache: false,
			success : function (response){
				$('#container').html(response);
				window.history.pushState({urlPath:"/"},"",thisHref);
				hideSpinner();
				ToolTipInit();
				scrollToContent();
				NProgress.done();
			},
			beforeSend : function (){
				NProgress.start();
				showSpinner();
			},
			error : function () {
				//location.reload();
			}
		});
	});

	// Ajax Search and Ajax Page Limit
	$(document).on("submit","#AjaxSearch",function(e){
		e.preventDefault();
		var thisHref = $(this).attr('action');
		if (!thisHref) {
			return false;
		}
		thisHref = thisHref+"?"+$(this).serialize();

		$.ajax({
			url : thisHref,
			type : 'GET',
			cache: false,
			success : function (response){
				$('#container').html(response);
				window.history.pushState({urlPath:"/"},$(this).serialize(),thisHref);
				hideSpinner();
				ToolTipInit();
				scrollToContent();
				NProgress.done();
			},
			beforeSend : function (){
				showSpinner();
				NProgress.start();
			},
			error : function () {
				//location.reload();
			}
		});

	});

	// Trigger Form Submit on change of page limit
	$(document).on("change","#LimitOptions",function(){
		$("#AjaxSearch").submit();
	});
	// Trigger Form Submit on change of page limit
	$(document).on("change",".ajax_change",function(){
		$("#AjaxSearch").submit();
	});

	$(document).on("submit","form" , function(){
		$(this).find(':input[type=submit]').prop('disabled', true);
	});



	// Ajax Status change
	$(document).on("click",'.change_status',function(e){
		e.preventDefault();
		$_this = $(this);
		var thisHref = $_this.attr('data-action');
		if (!thisHref || thisHref=='#') {
			return false;
		}
		var status = $_this.attr('data-status');
		var id = $_this.attr('data-id');
		$.ajax({
			url : thisHref,
			type : "json",
			data : {'status':status,'id':id},
			type : 'GET',
			cache: false,
			beforeSend : function(){
				$_this.addClass('disabled');
				$_this.addClass("qt-loader qt-loader-mini qt-loader-left");
			},
			success : function (response){
				if(!response.error){
					if(status == ACTIVE){
						$_this.attr('data-status',INACTIVE)
								.html(ACTIVE)
								.removeClass('badge-danger').addClass('badge-success');
					} else {
						$_this.attr('data-status',ACTIVE)
								.html(INACTIVE)
								.removeClass('badge-success').addClass('badge-danger');
					}
					alertMessageRight(response.message,'success');

				} else {
					alertMessageRight(response.message,'error');
				}
				$_this.removeClass('disabled');
				$_this.removeClass("qt-loader qt-loader-mini qt-loader-left");
			},
			error : function () {
				// location.reload();
			}
		});
	});

	// Ajax click view
	$(document).on("click",'.view-data',function(e){
		e.preventDefault();
		$_this = $(this);
		var thisHref = $_this.attr('data-url');
		if (!thisHref || thisHref=='#') {
			return false;
		}
		var id = $_this.attr('data-id');
		//alert(id);
		$.ajax({
			url : thisHref,
			data : {'id':id},
			type : 'GET',
			cache: false,
			success : function (response){
				$('#viewModal .modal-content').html(response);
				$('#viewModal').modal('show');
			},
			beforeSend : function (){
				$('#viewModal .modal-content').html("");
			},
			error : function () {
				// location.reload();
			}
		});
	});

	var getCleanUrl = function(url) {
	  return url.replace(/#.*$/, '').replace(/\?.*$/, '');
	};

	var getQueryString = function (url) {
		var queryString = "?";
		var match = url.match(/\?(.*)$/);
		if (match && match[1]) {
			queryString = queryString+match[1];
		}

		return queryString;
	};

	var getParams = function (url) {
		var params = {};
		var match = url.match(/\?(.*)$/);
		if (match && match[1]) {
			match[1].split('&').forEach(function (pair) {
				pair = pair.split('=');
				params[pair[0]] = pair[1];
			});
		}

		return params;
	};

	// Open Left child menu on edit page
	$("ul.nav.side-menu li.active").children('ul').slideDown();

	// Init ToolTip
	ToolTipInit();

	/* $('body').tooltip({
		selector: '[title]'
	}); */
	// calendar date Picker

});

function showSpinner(){
	var $blockTarget = $('#container');
	$blockTarget.append('<div class="qt-block-ui"></div>');

}

function hideSpinner(){
	var $blockTarget = $('#container');
	var $block = $blockTarget.find(".qt-block-ui");
	$block.remove();
	/* $block.fadeOut("3000", function() {
	  $block.remove();
	}); */
}

function getParams(url) {
	var params = {};
	var match = url.match(/\?(.*)$/);
	if (match && match[1]) {
		match[1].split('&').forEach(function (pair) {
			pair = pair.split('=');
			params[pair[0]] = pair[1];
		});
	}

	return params;
};

function getCleanUrl (url) {
  return url.replace(/#.*$/, '').replace(/\?.*$/, '');
};

function scrollToContent(){
	if($("#container").length){
		 $('html, body').animate({
			scrollTop: $("#container").offset().top - 70
		}, 500);
	}
}


function ckeditorBasic(id,local){
	CKEDITOR.replace(id, {
		language: local,
		height : 150,
		toolbarGroups :[
			{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
			{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
			{ name: 'links' },
			{ name: 'insert' },
			{ name: 'forms' },
			{ name: 'tools' },
			{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
			{ name: 'others' },
			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
			{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
			{ name: 'styles' },
			{ name: 'colors' }
		],
		removeButtons : 'Underline,Subscript,Superscript,Image,Table,Strike,SpecialChar,HorizontalRule'
	});
}

function ckeditorBasicWithImage(id,local){
	CKEDITOR.replace(id, {
		language: local,
		height : 150,
		toolbarGroups :[
			{ name: 'clipboard',   groups: [ 'clipboard', 'undo' ] },
			{ name: 'editing',     groups: [ 'find', 'selection', 'spellchecker' ] },
			{ name: 'links' },
			{ name: 'insert' },
			{ name: 'forms' },
			{ name: 'tools' },
			{ name: 'document',	   groups: [ 'mode', 'document', 'doctools' ] },
			{ name: 'others' },
			{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
			{ name: 'paragraph',   groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
			{ name: 'styles' },
			{ name: 'colors' }
		],
		removeButtons : 'Underline,Subscript,Superscript,Table,Strike,SpecialChar,HorizontalRule',
		filebrowserUploadMethod : 'form',
		filebrowserBrowseUrl : BASE_URL+'js/kcfinder/browse.php?opener=ckeditor&type=files',
		filebrowserImageBrowseUrl : BASE_URL+'js/kcfinder/browse.php?opener=ckeditor&type=images',
		filebrowserFlashBrowseUrl : BASE_URL+'js/kcfinder/browse.php?opener=ckeditor&type=flash',
		filebrowserUploadUrl : BASE_URL+'js/kcfinder/upload.php?opener=ckeditor&type=files',
		filebrowserImageUploadUrl : BASE_URL+'js/kcfinder/upload.php?opener=ckeditor&type=images',
		filebrowserFlashUploadUrl : BASE_URL+'js/kcfinder/upload.php?opener=ckeditor&type=flash',
	});
}

function ToolTipInit(){
	$('.category_popover').popover({
		html : true,
		trigger:"focus",
		content: function() {
			return $(this).children('.category_popover_html').html();
		},
		title: function() {
			return $(this).children('.category_popover_title').html();
		}
	});

	$('.tooltip').tooltip('dispose');
	$('.tooltip').remove();
	$( "[title]" ).tooltip();
}

toastr.options = {
  "closeButton": true,
  "debug": true,
  "newestOnTop": true,
  "progressBar": false,
  "positionClass": "toast-top-full-width",
  "preventDuplicates": false,
  "onclick": null,
  "showDuration": "800",
  "hideDuration": "8000",
  "timeOut": "8000",
  "extendedTimeOut": "8000",
  "showEasing": "swing",
  "hideEasing": "swing",
  "showMethod": "slideDown",
  "hideMethod": "slideUp",
 // "preventDuplicates":true,
}
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

function alertMessage(message,type){
	if(type=='success'){
		toastr.clear();
		toastr.success(message, 'Success!');
	}else if(type=='error'){
		toastr.clear();
		toastr.error(message, 'Action failed!');
	}
}
function alertMessageRight(message,type){
	toastr.options.positionClass = "toast-top-right";
	if(type=='success'){
		toastr.clear();
		toastr.success(message, 'Success!');
	}else if(type=='error'){
		toastr.clear();
		toastr.error(message, 'Action failed!');
	}else if(type=='info'){
		toastr.options = {
		  "closeButton": true,
		  "debug": true,
		  "newestOnTop": true,
		  "progressBar": false,
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

function alertMessageBottm(message, type, title = '') {
	toastr.options = BottomOptions;
	if (type == 'success') {
		toastr.success(message, title);
	} else if (type == 'error') {
		toastr.options = {
			"closeButton": true,
			"debug": false,
			"newestOnTop": true,
			"progressBar": true,
			"positionClass": "toast-bottom-right",
			"preventDuplicates": true,
			"onclick": null,
			"showDuration": "6000",
			"hideDuration": "6000",
			"timeOut": "6000",
			"extendedTimeOut": "6000",
			"showEasing": "swing",
			"hideEasing": "swing",
			"showMethod": "slideDown",
			"hideMethod": "slideUp",
			// "preventDuplicates":true,
		}
		toastr.error(message, title);
	} else if (type == 'info') {
		toastr.info(message, title);
	}
}


$(document).ready(function() {
	$('.customSelect').select2({
		allowClear: true
	});
});

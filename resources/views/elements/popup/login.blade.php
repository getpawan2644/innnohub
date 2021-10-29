<!-- login Modal -->
<div class="modal fade" id="login_model" tabindex="-1" role="dialog">
	<div class="modal-dialog modal-dialog-centered" role="document">
	  <div class="modal-content">
		<div class="modal-body p-0">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
		    <div class="row g-0">
			    <div class="col-lg-6 pr-lg-0">
				    <div class="login-form">
					    <form id="user-login-form" method="POST">
                            <div class="form-input">
                                <h3>{{__('content.login_details')}}</h3>
                                <div class="form-group mb-2">
                                    <label for="exampleInputEmail1">{{__('content.email_address')}}</label>
                                    <input type="email" id="email" name="email" class="form-control">
                                    <span class="error" id="email-error"></span>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">{{__('content.password')}}</label>
                                    <input type="password" id="password" name="password" class="form-control">
                                    <span class="error" id="password-error"></span>
                                </div>
                                <div class="form-group form-check">
                                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                    <label class="form-check-label" for="exampleCheck1">{{__('content.check_me_out')}}</label>
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#forgot_pass_model" data-bs-dismiss="modal" class="forget">{{__('content.forget_password')}}</a>
                                </div>
                                <button id="submit" class="inno-orange-btn" name="submit">{{__('content.sign_in')}}</button>
                            </div>
                            <div class="input-button">
                            <a href="{{route('user.register-type')}}" class="btn yellow_btn">{{__('content.dont_have_act')}} <span>{{__('content.signUp')}}</span></a>
                            </div>
					    </form>
				    </div>
			    </div>
			    <div class="col-lg-6 pl-0">
				  <div class="right-img">
					  <img src="{{asset('image/login-popup.jpg')}}" class="img-fluid"/>
				  </div>
			    </div>
		    </div>
		</div>
	  </div>
	</div>
</div>
<script>
	$(document).ready(function() {

	// process the form
	$('form#user-login-form').submit(function(event) {
		let email = $('#email').val();
		let password = $('#password').val();
		var formData = new FormData();
		console.log(email)
		if(email.length==0 || !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))){
			$('#email-error').text('Enter Valid Email')
			return false;
		}
		$('#email-error').text('')
		if(password.length==0){
			$('#password-error').text('Password field is required')
			return false;
		}
		$('#password-error').text('')
		formData.append("email", $('#email').val());
		formData.append("password", $('#password').val());
		formData.append('_token', "{{ csrf_token() }}");
		$.ajax({
			url: "{{route('user.post-login')}}",
			dataType: "json",
			type: "POST",
			cache: false,
			async: true,
			contentType: false,
			processData: false,
			data: formData,
			beforeSend: function () {

			},
			success: function (response) {
				if (response.success==true) {
                    alertMessage(response.message,'success', response.title);
                    //location.reload(true);
                    window.location.href = "{{route('user.edit-profile')}}";
                    setTimeout(function(){
                        $('#login_model').modal('hide');
                    }, 3000);
					// console.log(response);
					// alertMessage(response.message,'success', response.title)
					// //$('#login_model').modal('hide');
					// setTimeout(function(){ location.reload(true) }, 2000);
				} else {
					console.log(response);
				}

			},
			complete: function () {

			},
			error: function (error) {
				console.log(error)
				alertMessage(error.responseJSON.message,'error', error.responseJSON.title)
			}
		});
		event.preventDefault();
	});

});
</script>

<script>
/*	$(".btn-close").click(function(){
$('body').removeClass('modal-open');
  $('.modal-backdrop').remove();
  $('#login_model').css({
        'display': 'none',
        'padding-right': '0px'
        
    });
   $('.alignment-ltr').css({
        'padding-right': '0px'
        
    });
  
 
  
});*/
</script>
<!-- login Modal end -->

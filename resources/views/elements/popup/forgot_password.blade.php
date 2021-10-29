<!-- login Modal -->
<div class="modal custom_model fade" id="forgot_pass_model" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="row g-0">
                    <div class="col-lg-6 pr-lg-0">
                        <div class="login-form">
                            <form id="user-forgot-form" method="POST">
                                <div class="form-input">
                                    <h3>{{__('content.registered_email_address')}}</h3>
                                    <div class="form-group mb-2">
                                        <label for="exampleInputEmail1" style="width:100%;text-align: left">{{__('content.registered_email_address')}}</label>
                                        <input type="email" id="forgot_email" name="email" class="form-control">
                                        <span class="error float-left" id="forgot_email-error"style="width:100%;text-align: left"></span>
                                    </div>
                                    <div class="form-group"style="width:100%;text-align: left">
                                        <a href="javascript:void(0);" data-toggle="modal" data-target="#login_model" data-dismiss="modal">{{__('content.already_have_account')}}</a>
                                    </div>
                                    <div class="form-group  form-check" style="width:100%;text-align: left">
                                        <button id="forgot_pass_submit" class="inno-orange-btn" name="submit">{{__('content.submit')}}</button>
                                    </div>
                                </div>
                                <div class="input-button">
                                    <a href="{{route('user.register')}}" class="btn yellow_btn">{{__('content.dont_have_act')}} <span>{{__('content.signUp')}}</span></a>
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
        $('form#user-forgot-form').submit(function(event) {
            $("#forgot_email-error").text("");
            let email = $('#forgot_email').val();
            //console.log(email);
            var formData = new FormData();
            if(email.length==0 || !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(email))){
                $('#forgot_email-error').text('Enter Valid Email')
                return false;
            }
            $('#email-error').text('')
            formData.append("email", $('#forgot_email').val());
            formData.append('_token', "{{ csrf_token() }}");
            $.ajax({
                url: "{{route('password.email')}}",
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
                    if (response.status==1) {
                        location.reload(true);
                        alertMessage(response.success,'success', '{{__('messages.reset_password_heading')}}');
                        setTimeout(function(){
                            $('#user-forgot-form').modal('hide');
                        }, 3000);

                    } else {
                        $("#forgot_email-error").text(response.error);
                        console.log(response);
                    }

                },
                complete: function () {

                },
                error: function (error) {
                    console.log(error)
                    alertMessage(error.error,'error');
                }
            });
            event.preventDefault();
        });

    });
</script>
<!-- login Modal end -->

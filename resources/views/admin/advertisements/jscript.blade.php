<script>
    var _URL = window.URL || window.webkitURL;
    $('document').ready(function(){

        $("body").on("change",".logo-image",function(){

            var $propertyImage = $(this);
            $propertyImage.parents('.coustom-input').children('.img-progress-bar').show();
            var file = $propertyImage[0].files[0];
            //var $checkFileSize = checkFileSize(file);
            var img = new Image();
            img.src = _URL.createObjectURL(file);
            $('.img-progress-bar').text('0%');
            $('.img-progress-bar').width('0%');
            img.onload = function() {
                imgwidth = this.width;
                imgheight = this.height;

                console.log(file);
                var formData = new FormData();
                formData.append("file", file, file.name);

                $.ajax({
                    xhr: ()=> {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = parseInt((evt.loaded / evt.total) * 100);
                                console.log(percentComplete)
                                $('.img-progress-bar').show();
                                $('.img-progress-bar').text(percentComplete + '%');
                                $('.img-progress-bar').width(percentComplete + '%');
                                if (percentComplete == 100) {
                                    $('.img-progress-bar').text("Completed");
                                }
                            }
                        }, false);
                        return xhr;
                    },
                    url : "{{route('admin.advertisements.clientAjaxLogoImageUpload')}}",
                    dataType:"json",
                    type: "POST",
                    cache: false,
                    async: true,
                    contentType: false,
                    processData: false,
                    data: formData,
                    beforeSend: function() {
                    },
                    success:  function(response){
                        if(response.status){
                            console.log(response);
                            $imageLi =
                                `<li class="mr-5 paidImage">
									<div class="coustom-input">
										<a href="javascript:void(0);" class="remove-logo-pic">X</a>
										<img src="${response.thumbnail_url}"/>
										<input type="hidden" class="image_input" name="image" value="${response.filename}"/>
										<input type="hidden" class="image_url" name="images_url" value="${response.file_url}"/>
										<input type="hidden" class="image_thumbnail_input" name="image_thumbnail" value="${response.thumbnail}"/>
										<input type="hidden" class="image_thumbnail_url" name="image_thumbnail_url" value="${response.thumbnail_url}"/>
									</div>
									<div class="image-title upload">&nbsp;</div>
								</li>`
                            $('.client-logo-image-list').find(' > li:nth-last-child(1)').before($imageLi);
                            $('.img-progress-bar').hide();
                            //$('.progress-bar').width('0%');
                            $(".null_class").addClass("hide");
                        } else {
                            alertMessageBottm(response.message,'error');
                            $('.img-progress-bar').hide();
                        }

                    },
                    complete: function(){

                    },
                    error : function(){
                        $(".null_class").removeClass("hide");
                    }
                });
                //}
            }
        });
        //For Edit Image
        $('body').on('click', '.remove-logo-edit-pic', function () {
            var formData = new FormData();
            $this = $(this);
            formData.append("image_id", $(this).attr('image_id'));
            $.ajax({
                url: "{{route('admin.advertisements.clientRemoveImage')}}",
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

                    if (response.status == true) {
                        console.log(response)
                        $this.closest('li.mr-5').remove();
                    } else {
                        alertMessageBottm('Something went wrong while deleting the image', 'error');
                    }
                },
                complete: function () {

                },
                error: function () {

                }
            })
        });
        $('body').on('click', '.remove-logo-pic', function() {
            $(this).closest('li.mr-5').remove();
            $(".null_class").removeClass("hide");
        });
		});

</script>

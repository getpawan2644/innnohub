<script>
    var _URL = window.URL || window.webkitURL;
    $('document').ready(function(){
        $('#youtube_url').focusout(function(){
            var url = $(this).val();
            if (url != undefined || url != '') {
                var video_id = url.split('v=')[1];
                var ampersandPosition = video_id.indexOf('&');
                if(ampersandPosition != -1) {
                    video_id = video_id.substring(0, ampersandPosition);
                }
                $("#video_id").val(video_id);
                var regExp = /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
                var match = url.match(regExp);
                if (match && match[2].length == 11) {
                    // Do anything for being valid
                    // if need to change the url to embed url then use below line
                    $(this).val('https://www.youtube.com/embed/' + match[2] + '?autoplay=1&enablejsapi=1')
                    $('#videoObject').attr('src', 'https://www.youtube.com/embed/' + match[2] + '?autoplay=1&enablejsapi=1');
                    $('.youtube-viewer').show();
                } else {
                    $(this).val('');
                }
            }
        });
    });

    $(window).keydown(function(event){
        if(event.keyCode == 13) {
            event.preventDefault();
            return false;
        }
    });

    $('document').ready(function(){
			//For Create Product
            $('body').on('click', '.remove-pic', function() {
				$(this).closest('li.mr-5').remove();
			});

			$("body").on("change",".property-image",function(){

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
					url : "{{route('admin.products.productAjaxImageUpload')}}",
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
										<a href="javascript:void(0);" class="remove-pic">X</a>
										<img src="${response.thumbnail_url}"/>
										<input type="hidden" class="images_input" name="product_img[images][]" value="${response.filename}"/>
										<input type="hidden" class="images_url" name="product_img[images_url][]" value="${response.file_url}"/>
										<input type="hidden" class="thumbnail_images_input" name="product_img[thumbnail][]" value="${response.thumbnail}"/>
										<input type="hidden" class="thumbnail_url" name="product_img[thumbnail_url][]" value="${response.thumbnail_url}"/>
									</div>
									<div class="image-title upload">&nbsp;</div>
								</li>`
							$('.property-image-list').find(' > li:nth-last-child(1)').before($imageLi);
							$('.img-progress-bar').hide();
							//$('.progress-bar').width('0%');
						} else {
							alertMessageBottm(response.message,'error');
							$('.img-progress-bar').hide();
						}

					},
					complete: function(){

					},
					error : function(){

					}
				});
				//}
				}
			});
			//For Edit Image
			$('body').on('click', '.remove-edit-pic', function () {
                var formData = new FormData();
                $this = $(this);
                formData.append("image_id", $(this).attr('image_id'));
                $.ajax({
                    url: "{{route('admin.products.productRemoveImage')}}",
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
			//Ajax for uploading the image
		$("body").on("change",".property-edit-image",function(){
			$productId ="{{!empty($record->id)?$record->id:''}}"
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
			formData.append("product_id", $productId);
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
				url : "{{route('admin.products.productAjaxImageUpload')}}",
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
							`<li class="mr-5 paidImage" id="${response.image_id}">
								<div class="coustom-input">
									<a href="javascript:void(0);" class="remove-edit-pic" image_id="${response.image_id}">X</a>
									<img src="${response.thumbnail_url}"/>
									<input type="hidden" class="images_input" name="product_img[image_id][]" value="${response.image_id}"/>
									<input type="hidden" class="images_input" name="product_img[images][]" value="${response.filename}"/>
									<input type="hidden" class="images_url" name="product_img[images_url][]" value="${response.file_url}"/>
									<input type="hidden" class="thumbnail_images_input" name="product_img[thumbnail][]" value="${response.thumbnail}"/>
									<input type="hidden" class="thumbnail_url" name="product_img[thumbnail_url][]" value="${response.thumbnail_url}"/>
								</div>
								<div class="image-title upload">&nbsp;</div>
							</li>`
						$('.property-image-list').find(' > li:nth-last-child(1)').before($imageLi);
						$('.img-progress-bar').hide();
						//$('.progress-bar').width('0%');
					} else {
						alertMessageBottm(response.message,'error');
						$('.img-progress-bar').hide();
					}

				},
				complete: function(){

				},
				error : function(){

				}
			});
			//}
			}
		});

		});

</script>

@extends('layouts.admin.default')

@section('title',"Edit Category")

@section('header',"Edit Category")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Manage Categories </a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Category</li>
@endsection

@section('content')
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.categories.update',$record->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label float-left">Category Name</label>
                                        <input type="text" class="form-control" name="name" placeholder="Enter Category Name" value="{{ old('name', $record->name)}}">
                                        @if ($errors->has('name'))
                                            <span class="error-message text-left">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                {{-- <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Category Code</label>
                                        <input type="text" class="form-control" name="code" placeholder="Enter 2 digit category Code" value='{{ old('code', $record->code) }}'>
                                        @if ($errors->has('code'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('code') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div> --}}
                                <div class="col-lg-6 col-md-6 col-xs-6 col-sm-6">
                                    <div class="form-group">
                                        <label class="control-label">Category Order</label>
                                        <input type="number" class="form-control" name="category_order" placeholder="Enter category order number" value='{{ old('category_order', $record->category_order) }}'>
                                        @if ($errors->has('category_order'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('category_order') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            {{-- @foreach(config('translatable.locales_name') as $language=>$locale)
                                <div class="card card-border-primary language_card">
                                    <div class="card-header text-{{CommonHelper::getTextAlign($locale)}}">{{$language}}</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Category Name</label>
                                                    <input type="text" class="form-control" name="{{ $locale }}[name]" placeholder="Enter Category Name" dir="{{CommonHelper::getAlignment($locale)}}" value="{{ old($locale.'.name', $record->translateOrNew($locale)->name)}}">
                                                    @if ($errors->has($locale.'.name'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                        <strong>{{ $errors->first($locale.'.name') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach --}}
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Category Icon</label>
                                        <input type="file" class="category-image form-control" name="icon">
                                        @if ($errors->has('category_icon'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('category_icon') }}</strong>
                                            </span>
                                        @endif
                                        <div class="image-thumbnail">
                                            <picture>
                                                <img src="{{!empty(old('category_icon_thumbnail_url', $record->category_icon_thumbnail_url))?old('category_icon_thumbnail_url', $record->category_icon_thumbnail_url):asset(App\Models\Category::PHOTOS_DIR.$record->id.'/'.$record->category_icon_thumbnail)}}" class="img-fluid img-thumbnail" alt="...">
                                                <input type="hidden" class="category_image_input" name="category_icon" value="{{ old('category_icon', $record->category_icon) }}" />
                                                <input type="hidden" class="category_image_url" name="category_icon_url" value="{{ old('category_icon_url', $record->category_icon_url) }}" />
                                                <input type="hidden" class="category_thumbnail_image_input" name="category_icon_thumbnail" value="{{ old('category_icon_thumbnail', $record->category_icon_thumbnail) }}" />
                                                <input type="hidden" class="category_thumbnail_image_url" name="category_icon_thumbnail_url" value="{{ old('category_icon_thumbnail_url', $record->category_icon_thumbnail_url) }}" />
                                                <div class="progress-bar" role="progressbar"></div>
                                            </picture>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Update</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
		var _URL = window.URL || window.webkitURL;
		function template(data) {
			return $("<span class="+data.id+"> "+data.text+" </span>");
		}
		$(document).ready(function() {
			$("body").on("change",".category-image",function(){
				var $categoryImage = $(this);
				$categoryImage.parents('.coustom-input').children('.progress-bar').show();
				var file = $categoryImage[0].files[0];
				//var $checkFileSize = checkFileSize(file);
				var img = new Image();
				img.src = _URL.createObjectURL(file);
				$('.progress-bar').text('0%');
				$('.progress-bar').width('0%');
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
								$('.progress-bar').show();
								$('.progress-bar').text(percentComplete + '%');
								$('.progress-bar').width(percentComplete + '%');
								if (percentComplete == 100) {
									$('.progress-bar').text("{{__('content.Completed')}}");
								}
							}
					}, false);
					return xhr;
					},
					url : "{{route('admin.category.postAjaxImg')}}",
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
							$('.category_image_input').val(response.filename);
							$('.category_image_url').val(response.file_url);
							$('.category_thumbnail_image_input').val(response.thumbnail);
							$('.category_thumbnail_image_url').val(response.thumbnail_url);
							$('.img-thumbnail').attr('src',response.file_url).show();
							$('.progress-bar').hide();
							//$('.progress-bar').width('0%');
						} else {
							alertMessageBottm(response.message,'error');
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
@endsection

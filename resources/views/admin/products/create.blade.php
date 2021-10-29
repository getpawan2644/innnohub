@php
    $categories = \App\Models\Category::getCategoryList();
    $clients = \App\Models\Client::clients();
    $vendors = \App\Models\Vendor::getVendorList();

@endphp
@extends('layouts.admin.default')

@section('title',"Add Products")

@section('header',"Add Products")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Manage Products </a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Products</li>
@endsection

@section('content')
<script src="//cdn.ckeditor.com/4.6.2/full-all/ckeditor.js"></script>
<script>
	var options = {
		filebrowserImageBrowseUrl: APP_URL+'admin/laravel-filemanager?type=Images',
		filebrowserImageUploadUrl: APP_URL+'admin/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
		filebrowserBrowseUrl: APP_URL+'admin/laravel-filemanager?type=Files',
		filebrowserUploadUrl: APP_URL+'admin/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
		language: 'en'
	};
</script>
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    {{--@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif--}}

    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-3 col-md-3col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Vendor / Factory</label>
                                        <select type="text" class="form-control coding" name="vendor_id" hidden_id="vendor_code" id="vendor_id" placeholder="Please choose a vendor">
                                            <option value="">
                                                Select Vendor
                                            </option>
                                            @foreach($vendors as $vendor)
                                                <option {{ (old('vendor_id',$record->vendor_id)==$vendor->id)?'selected':'' }} country_code="{{$vendor->country_code}}" code="{{$vendor->code}}" value="{{ $vendor->id }}">{{$vendor->name." (".$vendor->vendor_code.")"}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Select Category</label>
                                        <select type="text" class="form-control coding" name="category_slug" hidden_id="category_code" id="category_id" placeholder="Please choose a category">
                                            <option value="">
                                                Select Category
                                            </option>
                                            @foreach($categories as $category)
                                                <option {{ old("category_slug",$record->category_slug) == $category->slug ? 'selected' : '' }} code="{{$category->code}}"value="{{ $category->slug }}">{{$category->name." (".$category->code.")"}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('category_slug'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('category_slug') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Select Subcategory</label>
                                        <select type="text" class="form-control coding" name="subcategory_id" hidden_id="sub_category_code"  id="subcategory_id" placeholder="Please choose a category" value="{{ old('country_id',$record->country_id) }}">
                                            <option value="">
                                                Select Subcategory
                                            </option>
                                            <!-- @foreach($categories as $category)
                                                <option {{ old("category_id",$record->category_id) == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{$category->name}}</option>
                                            @endforeach -->
                                        </select>
                                    </div>
                                </div>
                                <input type="hidden" name="sub_category_code" id="sub_category_code" value="{{old("sub_category_code",$record->sub_category_code)}}">
                                <input type="hidden" name="country_code" id="country_code" value="{{old("country_code",$record->country_code)}}">
                                <input type="hidden" name="category_code" id="category_code" value="{{old("category_code",$record->category_code)}}">
                                <input type="hidden" name="vendor_code" id="vendor_code" value="{{old("vendor_code",$record->vendor_code)}}">
                                <input type="hidden" name="code" id="code" value="{{old("code",$record->code)}}">
                                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Product Code</label>
                                        <input type="text" class="form-control" id="product_code" name="display_code" placeholder="Code" value='{{ old("display_code", $record->display_code) }}' readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Clients</label>
                                        <select type="text" class="form-control" name="client_id" id="client_id" placeholder="Please choose a client">
                                            <option value="">
                                                Select Clients
                                            </option>
                                            @foreach($clients as $client)
                                                <option {{ (old('client_id',$record->client_id)==$client->id)?'selected':'' }} value="{{ $client->id }}">{{$client->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <select type="text" class="form-control" name="status" placeholder="Please choose a category">
                                            <option {{ old("status",$record->status) == \App\Models\Product::ACTIVE ? 'selected' : '' }} value="{{\App\Models\State::ACTIVE}}">{{\App\Models\State::ACTIVE}}</option>
                                            <option {{ old("status",$record->status) == \App\Models\Product::INACTIVE ? 'selected' : '' }} value="{{\App\Models\State::INACTIVE}}">{{\App\Models\State::INACTIVE}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Price</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">QAR</span>
                                            </div>
                                            <input type="text" class="form-control" id="price_input"name="price" placeholder="Enter Product Price" value='{{ old("price", $record->price) }}'>
                                        </div>
                                        @if ($errors->has('price'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('price') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-12" id="discount_container">
                                    <div class="form-group">
                                        <label class="control-label">Discount</label>
                                        <div class="input-group">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text" id="basic-addon1">%</span>
                                            </div>
                                            <input type="text" class="form-control" id="discount" name="discount_percent" placeholder="Enter discount percentage" value='{{ old("discount_percent", $record->discount_percent) }}'>
                                        </div>
                                        @if ($errors->has('discount_percent'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('discount_percent') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @foreach(config('translatable.locales_name') as $language=>$locale)
                                <div class="card card-border-primary language_card">
                                    <div class="card-header text-{{CommonHelper::getTextAlign($locale)}}">{{$language}}</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Product Title</label>
                                                    <input type="text" class="form-control" onkeyup="rtl(this);" name="{{ $locale }}[product_title]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter Product Title" value="{{ old($locale.'.product_title', $record->product_title) }}">
                                                    @if ($errors->has($locale.'.product_title'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.product_title') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{$language}} Product Details</label>
                                                    <textarea id="product-details-{{$locale}}" rows="20" placeholder="Enter Details" class="form-control" name="{{$locale}}[product_details]">{{ old($locale.'.product_details', $record->product_details) }}</textarea>
                                                    @if ($errors->has($locale.'.product_details'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.product_details') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{$language}} Product Description</label>
                                                    <textarea id="product-description-{{$locale}}" rows="20" placeholder="Enter Details" class="form-control" name="{{$locale}}[product_description]">{{ old($locale.'.product_description', $record->product_description) }}</textarea>
                                                    @if ($errors->has($locale.'.product_description'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.product_description') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
									options.language = "{{$locale}}";
									CKEDITOR.replace( 'product-details-{{$locale}}',	options );
                                    CKEDITOR.replace( 'product-description-{{$locale}}',	options );
								</script>
                            @endforeach
                            <div class="card card-border-primary">
                                <div class="card-header text-left">Image and Video</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="form-group select-photo">
                                                <ul class="property-image-list">
                                                @if(!empty(old('product_img',$record->product_img)))
														@php $oldImages = old('product_img',$record->product_img);
															//dd($oldImages);
														@endphp
														@foreach($oldImages['images'] as $imgKey => $imgValue)
															<li class="mr-5 paidImage">
																<div class="coustom-input">
																	<a href="javascript:void(0);" class="remove-pic">X</a>
																	<img src="{{$oldImages['thumbnail_url'][$imgKey]}}"/>
																	<input type="hidden" class="images_input" name="product_img[images][]" value="{{$imgValue}}"/>
																	<input type="hidden" class="images_url" name="product_img[images_url][]" value="{{$oldImages['images_url'][$imgKey]}}"/>
																	<input type="hidden" class="thumbnail_images_input" name="product_img[thumbnail][]" value="{{$oldImages['thumbnail'][$imgKey]}}"/>
																	<input type="hidden" class="thumbnail_url" name="product_img[thumbnail_url][]" value="{{$oldImages['thumbnail_url'][$imgKey]}}"/>
																</div>
																<div class="image-title upload">&nbsp;</div>
															</li>
														@endforeach
													@endif
                                                    <li class="green-photo mr-3">
                                                        <div class="coustom-input">
                                                            <input type="file" class="property-image custom-file-input">
                                                        </div>
                                                        <div class="progress-bar img-progress-bar" role="progressbar"></div>
                                                        <div class="image-title">Add Photo</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 youtube-url">
                                            <div class="form-group">
                                                <label for="formGroupExampleInput">Youtube Video URL</label>
                                                <input type="text" id="youtube_url" class="form-control" name="youtube_url" value="{{ old('youtube_url', $record->youtube_url) }}">
                                                <input type="hidden" id="video_id" class="form-control" name="video_id" value="{{ old('video_id', $record->video_id) }}">
                                                <iframe id="videoObject" type="text/html" width="500" height="265" class="youtube-viewer" style="display:{{!empty(old('youtube_url', $record->youtube_url))?:'none'}};" frameborder="0" allowfullscreen></iframe>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Add</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('admin.products.jscript')
    <script>
        $('document').ready(function(){
            @if(!empty(old("category_slug",$record->category_slug)))
            populateSubcategory("{{old("category_slug",$record->category_slug)}}");
            @endif
            @if(!empty($record->code))
                let product_code=$("#country_code").val()+$("#vendor_code").val()+$("#category_code").val()+$("#sub_category_code").val()+"{{old("code",$record->code)}}";
                $("#product_code").val(product_code)
            @endif
            $(".coding").change(function(){
                let hidden_id=$(this).attr('hidden_id');
                if(hidden_id=="vendor_code"){
                    $("#country_code").val($('option:selected', this).attr('country_code'));
                }
                $("#"+hidden_id).val($('option:selected', this).attr('code'));
                populateProductCode();
            });

            @if(!empty(old("price",$record->price)))
                $("#discount_container").show();
            @endif
            $('body').on('change', '#category_id', function(){
                // alert($(this).val())
                $category_id = $(this).val()
                // $subcategory = $('#subcategory_id')
                populateSubcategory($category_id);
            });
            $('#price_input').keyup(function(){
                let price=$(this).val();
                if($.isNumeric(price)){
                    $("#discount_container").show();
                }else{
                    $("#discount_container").hide();
                    $("#discount").val('');
                }
            });
        });
        function populateProductCode(){
            if($("#category_id").val() && $("#subcategory_id").val() && $("#vendor_id").val()){
                $.ajax({
                    url : "{{ route('admin.ajax.get_product_code') }}",
                    data : {'category_code':$("#category_code").val(),'sub_category_code':$("#sub_category_code").val(),'vendor_code':$("#vendor_code").val(),'country_code':$("#country_code").val()},
                    type : 'POST',
                    cache: false,
                    success : function (response){
                        $("#code").val(response);
                        let product_code=$("#country_code").val()+$("#vendor_code").val()+$("#category_code").val()+$("#sub_category_code").val()+response;
                        $("#product_code").val(product_code);
                    },
                    beforeSend : function (){
                        $("#product_code").val("Loading...");
                    },
                    error : function () {
                        // $subcategory.find('option').remove();
                        // $subcategory.append($("<option/>", {
                        //     value: '',
                        //     text: "No Records Found"
                        // }));
                        // $subcategory.trigger('change');
                    }
                });
            }
        }

        function populateSubcategory($categoryId=null, $subCategoryId=null){
                $category_id = $categoryId
                $subcategory = $('#subcategory_id')
                $.ajax({
                    url : "{{ route('admin.ajax.subcategory') }}",
                    data : {'category_slug':$category_id},
                    type : 'POST',
                    cache: false,
                    success : function (response){
                        $subcategory.find('option').remove();
                        if(response.length){
                            $subcategory.append($("<option/>", {
                                value: "",
                                text: "Select Subcategory"
                            }));
                            $.each(response, function(key, value) {
                                if(value.id=="{{old("subcategory_id",$record->subcategory_id)}}"){
                                    $subcategory.append($("<option/>", {
                                        value: value.id,
                                        code: value.code,
                                        text: value.name,
                                        selected:true
                                    }));
                                }else{
                                    $subcategory.append($("<option/>", {
                                        value: value.id,
                                        code: value.code,
                                        text: value.name
                                    }));
                                }
                            });
                            // if($stateId){
                            //     $state.val($stateId);
                            // }
                        } else {
                            $subcategory.append($("<option/>", {
                                value: '',
                                text: "No Records Found"
                            }));
                        }

                    },
                    beforeSend : function (){
                        $subcategory.html("<option>Loading </option>");
                    },
                    error : function () {
                        $subcategory.find('option').remove();
                        $subcategory.append($("<option/>", {
                            value: '',
                            text: "No Records Found"
                        }));
                        $subcategory.trigger('change');
                    }
                });
        }

    </script>
@endsection

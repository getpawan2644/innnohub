@php
    $categories = \App\Models\ClientCategory::getClientCategoryList();
@endphp
@extends('layouts.admin.default')

@section('title',"Add Clients")

@section('header',"Add Clients")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.clients.index') }}">Manage Clients </a></li>
    <li class="breadcrumb-item active" aria-current="page">Add Clients</li>
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
{{--    @if ($errors->any())--}}
{{--    <div class="alert alert-danger">--}}
{{--        <ul>--}}
{{--            @foreach ($errors->all() as $error)--}}
{{--                <li>{{ $error }}</li>--}}
{{--            @endforeach--}}
{{--        </ul>--}}
{{--    </div>--}}
{{--@endif--}}
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.clients.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Select Client Category</label>
                                        <select type="text" class="form-control" name="client_category_id" id="client_category_id" placeholder="Please choose a category" value="{{ old('client_category_id',$record->client_category_id) }}">
                                            <option value="">
                                                Select Client Category
                                            </option>
                                            @foreach($categories as $category)
                                                <option {{ old("client_category_id",$record->client_category_id) == $category->id ? 'selected' : '' }} value="{{ $category->id }}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('client_category_id'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('client_category_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Status</label>
                                        <select type="text" class="form-control" name="status" placeholder="Please choose a category">
                                            <option {{ old("status",$record->status) == \App\Models\Client::ACTIVE ? 'selected' : '' }} value="{{\App\Models\Client::ACTIVE}}">{{\App\Models\Client::ACTIVE}}</option>
                                            <option {{ old("status",$record->status) == \App\Models\Client::INACTIVE ? 'selected' : '' }} value="{{\App\Models\Client::INACTIVE}}">{{\App\Models\Client::INACTIVE}}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="text" class="form-control" name="email" placeholder="Enter email address" value='{{ old('email', $record->email) }}'>
                                        @if ($errors->has('email'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Website</label>
                                        <input type="text" class="form-control" name="website" placeholder="Enter web address" value='{{ old('website', $record->website) }}'>
                                        @if ($errors->has('website'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('website') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Phone Number</label>
                                        <input type="hidden" id="country_code" name="country_code" value="{{ (old('country_code', $record->country_code))?old('country_code', $record->country_code):'qa' }}">
                                        <input type="hidden" id="dial_code" name="dial_code" value="{{(old('dial_code', $record->dial_code))?old('dial_code', $record->dial_code):'974'}}">
                                        <input type="tel" onclick="this.setSelectionRange(0, this.value.length)" class="form-control" name="phone" id="mobile" value="{{ old('phone', $record->phone) }}" placeholder="Please enter phone number">
                                        @if ($errors->has('phone'))
                                            <span class="error-message">
                                                    <strong>{{ $errors->first('phone') }}</strong>
                                                </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">URL</label>
                                        <div class="input-group md-3">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text bg-primary text-white">{{ env('APP_URL')."client/" }}</span>
                                            </div>
                                            <input type="text" class="form-control" onkeyup="rtl(this);" name="url_name"  placeholder="Enter the url" value='{{ old('url_name', $record->url_name) }}'>
                                        </div>

                                        @if ($errors->has("url_name"))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('url_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card card-border-primary">
                                <div class="card-header text-left">Client Logo</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="form-group select-photo">
                                                <ul class="client-logo-image-list">
                                                    @if(!empty(old('logo',$record->logo)))
                                                        @php $oldImagesURL = old('logo_thumbnail_url',$record->logo_thumbnail_url);
                                                             $oldlogoImages = old('logo_img',$record->logo);
                                                             $oldtumbImages = old('logo_thumbnail',$record->logo_thumbnail);
															//dd($record->logo_thumbnail_url);
                                                        @endphp
                                                        <li class="mr-5 paidImage">
                                                            <div class="coustom-input">
                                                                <a href="javascript:void(0);" class="remove-logo-pic">X</a>
                                                                <img src="{{$oldImagesURL}}"/>
                                                                <input type="hidden" class="logo_images_input" name="logo" value="{{$oldlogoImages}}"/>
                                                                <input type="hidden" class="logo_images_url" name="logo_images_url" value="{{$oldImagesURL}}"/>
                                                                <input type="hidden" class="logo_thumbnail_images_input" name="logo_thumbnail" value="{{$oldtumbImages}}"/>
                                                                <input type="hidden" class="logo_thumbnail_url" name="logo_thumbnail_url" value="{{$oldImagesURL}}"/>
                                                            </div>
                                                            <div class="image-title upload">&nbsp;</div>
                                                        </li>
                                                    @endif
                                                    <li class="green-photo mr-3 null_class {{!empty(old('logo',$record->logo))?"hide":''}}">
                                                        <div class="coustom-input">
                                                            <input type="file" class="logo-image custom-file-input">
                                                        </div>
                                                        <div class="progress-bar img-progress-bar" role="progressbar"></div>
                                                        <div class="image-title">Add Photo</div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card card-border-primary">
                                <div class="card-header text-left">Address Location</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label"> Client Address</label>
                                                <input type="text" class="form-control" id="sublocality_level_2" name="address"  placeholder="Enter Client Address" value="{{ old('address', $record->address) }}">
                                                <input type="hidden" class="form-control" id="latitude" name="latitude"  value="{{ old('latitude', $record->latitude) }}">
                                                <input type="hidden" class="form-control" id="longitude" name="longitude"  value="{{ old('longitude', $record->longitude) }}">
                                                @if ($errors->has('address'))
                                                    <span class="error-message">
                                                        <strong>{{ $errors->first('address') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label"> Country </label>
                                                <input type="text" class="form-control" id="country" name="country"  placeholder="Country" value="{{ old('country', $record->country) }}">
                                                @if ($errors->has('country'))
                                                    <span class="error-message">
                                                        <strong>{{ $errors->first('country') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div id="map" style="width:100%;height:300px;">
                                            </div>
                                            <div id="infowindow-content">
                                                <img src="" width="16" height="16" id="place-icon">
                                                <span id="place-name"  class="title"></span><br>
                                                <span id="place-address"></span>
                                            </div>
                                        </div>
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
                                                    <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Client Name</label>
                                                    <input type="text" class="form-control" name="{{ $locale }}[name]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter Client Name" value="{{ old($locale.'.name', $record->translateOrNew($locale)->name) }}">
                                                    @if ($errors->has($locale.'.name'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.name') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label">{{$language}} Client Description</label>
                                                    <textarea id="client-description-{{$locale}}" rows="20" placeholder="Enter Details" class="form-control" name="{{$locale}}[description]">{{ old($locale.'.description', $record->translateOrNew($locale)->description) }}</textarea>
                                                    @if ($errors->has($locale.'.description'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.description') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <script>
									options.language = "{{$locale}}";
                                    CKEDITOR.replace( 'client-description-{{$locale}}',	options );
								</script>
                            @endforeach
                            <div class="card card-border-primary">
                                <div class="card-header text-left">Image</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="form-group select-photo">
                                                <ul class="property-image-list">
                                                @if(!empty(old('client_img',$record->client_img)))
														@php $oldImages = old('client_img',$record->client_img);
															//dd($oldImages);
														@endphp
														@foreach($oldImages['images'] as $imgKey => $imgValue)
															<li class="mr-5 paidImage">
																<div class="coustom-input">
																	<a href="javascript:void(0);" class="remove-pic">X</a>
																	<img src="{{$oldImages['thumbnail_url'][$imgKey]}}"/>
																	<input type="hidden" class="images_input" name="client_img[images][]" value="{{$imgValue}}"/>
																	<input type="hidden" class="images_url" name="client_img[images_url][]" value="{{$oldImages['images_url'][$imgKey]}}"/>
																	<input type="hidden" class="thumbnail_images_input" name="client_img[thumbnail][]" value="{{$oldImages['thumbnail'][$imgKey]}}"/>
																	<input type="hidden" class="thumbnail_url" name="client_img[thumbnail_url][]" value="{{$oldImages['thumbnail_url'][$imgKey]}}"/>
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
{{--                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12 youtube-url">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label for="formGroupExampleInput">Youtube Video URL</label>--}}
{{--                                                <input type="text" id="youtube_url" class="form-control" name="video_url" value="{{ old('video_url', $record->video_url) }}">--}}
{{--                                                <input type="hidden" id="video_id" class="form-control" name="video_id" value="{{ old('video_id', $record->video_id) }}">--}}
{{--                                                <iframe id="videoObject" type="text/html" width="500" height="265" class="youtube-viewer" style="display:{{!empty(old('youtube_url', $record->youtube_url))?:'none'}};" frameborder="0" allowfullscreen></iframe>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
                                    </div>
                                </div>
                            </div>
                            <div class="card card-border-primary language_card">
                                <div class="card-header text-left">Vsideos</div>
                                <div class="card-body">
                                    <div class="row" style="margin: 5px -15px 10px -15px;">
                                        <div class="col-lg-8 col-md-8 col-xs-8 col-sm-8"></div>
                                        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                                            <a href="javascript:void(0);"
                                               class="btn btn-primary add-appointment"
                                               role="button" style="float: right;">Add video</a>
                                        </div>
                                    </div>
                                    <div class="appointment-div">
                                        @if(!empty(old('video_url')))
                                            @php
                                                $i=0;
                                                $video_id = old('video_id');
                                            @endphp
                                            @foreach(old('video_url') as $key => $value)
                                                <div class="row appointment">
                                                    <div class="col-lg-10 col-md-10 col-xs-10 col-sm-10">
                                                        <div class="form-group from-time-dev">
                                                            <label for="formGroupExampleInput">Youtube Video URL</label>
                                                            <input type="text" id="youtube_url" class="form-control" name="video_url[]" value="{{$value}}">
                                                            <input type="hidden" id="video_id" class="form-control" name="video_id[]" value="{{$video_id[$key]}}">
                                                        </div>
                                                        @if ($errors->has('from_time.'.$key))
                                                            <span class="error-message">
                                                                <strong>{{ $errors->first('from_time.'.$key) }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    @if($key!==0)
                                                        <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                                                            <div class="form-group">
                                                                <a href="javascript:void(0);" class="remove-appointment btn btn-danger" role="button"><i class="la la-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                        <span class="error-message"></span>
                                                    </div>
                                                </div>
                                            @endforeach

                                        @else
                                            <div class="row appointment">
                                                <div class="col-lg-10 col-md-10 col-xs-10 col-sm-10">
                                                    <div class="form-group from-time-dev">
                                                        <label for="formGroupExampleInput">YouTube Video URL</label>
                                                        <input type="text" id="" class="form-control youtube_url" name="video_url[]" placeholder="Enter YouTube video Url "value="">
                                                        <input type="hidden" id="" class="form-control video_id" name="video_id[]" value="">
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                    <span class="error-message"></span>
                                                </div>
                                            </div>
                                        @endif
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
    <script>

    </script>
    @include('admin.clients.jscript')
<script src="https://maps.googleapis.com/maps/api/js?key={{env("GOOGLE_KEY")}}&libraries=places&callback=initAutocomplete" async defer></script>
<script>
    // This example requires the Places library. Include the libraries=places
    // parameter when you first load the API. For example:
    // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">

    var placeSearch, autocomplete;
    var componentForm = {

        //sublocality_level_2: 'long_name',
        //sublocality_level_1: 'long_name',
        //locality : 'long_name',
        //administrative_area_level_2: 'short_name',
        //administrative_area_level_1: 'long_name',
        country: 'long_name',
        //postal_code: 'short_name',
    };
    var map;

    function initAutocomplete() {
        var geocoder = new google.maps.Geocoder();
           @if($record->latitude && $record->longitude)
        var myLatlng = new google.maps.LatLng({{$record->latitude}},{{$record->longitude}});
            @else
        var myLatlng = new google.maps.LatLng(25.3548,51.1839);
            @endif
        var marker;
        var map = new google.maps.Map(document.getElementById('map'), {
            center: myLatlng,
            zoom: 4,
            mapTypeId: 'roadmap'
        });


        var marker = new google.maps.Marker({
            map: map,
            position: myLatlng,
            anchorPoint: new google.maps.Point(25.3548, 51.1839),
            draggable: true
        });
        map.setCenter(myLatlng);
        map.setZoom(8);  // Why 17? Because it looks good.

        //infowindow.setContent(iwContent);
        // opening the infowindow in the current map and at the current marker location
        //infowindow.open(map, marker);

        // Create the autocomplete object, restricting the search to geographical
        // location types.
        autocomplete = new google.maps.places.Autocomplete(
            /** @type {!HTMLInputElement} */(document.getElementById('sublocality_level_2')),
            {types: []});


        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo('bounds', map);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);

        // When the user selects an address from the dropdown, populate the address
        // fields in the form.
        autocomplete.addListener('place_changed', function(){
            infowindow.close();
            marker.setVisible(false);
            var place = autocomplete.getPlace();
            //console.log(place);
            if (!place.geometry) {
                // User entered the name of a Place that was not suggested and
                // pressed the Enter key, or the Place Details request failed.
                window.alert("No details available for input: '" + place.name + "'");
                return;
            }

            // If the place has a geometry, then present it on a map.
            if (place.geometry.viewport) {
                map.fitBounds(place.geometry.viewport);
            } else {
                map.setCenter(place.geometry.location);
                map.setZoom(15);  // Why 15? Because it looks good.
            }
            marker.setPosition(place.geometry.location);
            marker.setVisible(true);
           // alert(place);
            document.getElementById('sublocality_level_2').value = place.formatted_address;
            document.getElementById('latitude').value = place.geometry.location.lat();
            document.getElementById('longitude').value = place.geometry.location.lng();
            //console.log(componentForm);
            for (var component in componentForm) {
                document.getElementById(component).value = '';
               document.getElementById(component).disabled = false;
            }

            // Get each component of the address from the place details
            // and fill the corresponding field on the form.
            for (var i = 0; i < place.address_components.length; i++) {
                var addressType = place.address_components[i].types[0];
                if (componentForm[addressType]) {
                    var val = place.address_components[i][componentForm[addressType]];
                    document.getElementById(addressType).value = val;
                }
            }

            var address = '';
            if (place.address_components) {
                address = [
                    (place.address_components[0] && place.address_components[0].short_name || ''),
                    (place.address_components[1] && place.address_components[1].short_name || ''),
                    (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
            }
            infowindowContent.children['place-icon'].src = place.icon;
            infowindowContent.children['place-name'].textContent = place.name;
            infowindowContent.children['place-address'].textContent = address;
            infowindow.open(map, marker);
        });

        google.maps.event.addListener(marker, 'dragend', function(event) {
            document.getElementById('latitude').value = event.latLng.lat();
            document.getElementById('longitude').value = event.latLng.lng();
            //console.log(marker.getPosition());
            geocoder.geocode({'latLng': marker.getPosition()}, function(results, status) {
                document.getElementById('sublocality_level_2').value = results[0].formatted_address;
                //console.log(results[0]);
                if (status == google.maps.GeocoderStatus.OK) {
                    for (var component in componentForm) {
                        //document.getElementById(component).value = '';
                        //document.getElementById(component).disabled = false;
                    }

                    for (var i = 0; i < results[0].address_components.length; i++) {

                        for (var j = 0; j < results[0].address_components[i].types.length; j++) {
                            var addressType = results[0].address_components[i].types[j];
                            if (componentForm[addressType]) {
                                var val = results[0].address_components[i][componentForm[addressType]];
                                document.getElementById(addressType).value = val;
                            }
                        }
                    }
                }
                infowindow.setContent(results[0].formatted_address);
                infowindow.open(map, marker);
            });
        });
    }



    function setMarkers(map){

    }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }

    function fillInAddress(map) {

    }

</script>

<script>
    jQuery(document).ready(function(){
        var input = document.querySelector("#mobile");
        var iti = window.intlTelInput(input, {
            initialCountry: "{{ !empty(old('country_code', $record->country_code))?old('country_code', $record->country_code):'qa' }}",
            //separateDialCode: true,
            //utilsScript:"https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js"
            // any initialisation options go here
        });
        window.intlTelInputGlobals.loadUtils("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js");
        input.addEventListener("countrychange", function() {
            console.log(iti.getSelectedCountryData());
            let countryData = iti.getSelectedCountryData();
            document.getElementById('country_code').value =countryData.iso2;
            document.getElementById('dial_code').value =countryData.dialCode;
        });



        populateStates("{{ old('country_id',$record->country_id) }}");
        jQuery(".country").change(function(){
            populateStates($(this).val(), null);
        });
    });
    function populateStates(country_id){
        if(!country_id){
            return false;
        }
        $.ajax({
            url : "{{ route('admin.users.getStates') }}",
            data : {'country_id':country_id},
            type : 'GET',
            cache: false,
            success : function (response){
                var options = response;
                $("#state").html("<option>Select State Name</option>")
                if(options.length){
                    $.each(options, function(key, value) {
                        $('#state').append($("<option/>", {
                            value: value.id,
                            text: value.name
                        }));
                    });
                    if(state_id){
                        $('#state').val(state_id);
                    }
                    //$('#state').data("placeholder","Select State").select2({allowClear: true});
                } else {
                    //$('#state').data("placeholder","No State Found!").select2({allowClear: true});
                }
            },
            beforeSend : function (){

            },
            error : function () {
                // location.reload();
            }
        });
    }


</script>


{{--<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBF9IefzpMfBCatBibHbrYR9l23GWawfEI&libraries=places&callback=initAutocomplete" async defer></script>--}}
@endsection

@php
    $categories = \App\Models\ClientCategory::getClientCategoryList();
@endphp
@extends('layouts.admin.default')

@section('title',"Edit Advertisements")

@section('header',"Edit Advertisements")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.advertisements.index') }}">Manage Advertisements </a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Advertisements</li>
@endsection

@section('content')

    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.advertisements.update',$record->id) }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Advertisement Link</label>
                                        <input type="text" class="form-control" name="url" placeholder="Enter advertisement link" value='{{ old('url', $record->url) }}'>
                                        @if ($errors->has('url'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('url') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card card-border-primary">
                                <div class="card-header text-left">Advertisement Image</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="form-group select-photo">
                                                <ul class="client-logo-image-list">
                                                    @if(!empty(old('image',$record->image)))
                                                        @php $oldImagesURL = old('image_thumbnail_url',$record->image_thumbnail_url);
                                                             $oldlogoImages = old('image',$record->image);
                                                             $oldtumbImages = old('image_thumbnail',$record->image_thumbnail);
															//dd($record->logo_thumbnail_url);
                                                        @endphp
                                                        <li class="mr-5 paidImage">
                                                            <div class="coustom-input">
                                                                <a href="javascript:void(0);" class="remove-logo-pic">X</a>
                                                                <img src="{{$oldImagesURL}}"/>
                                                                <input type="hidden" class="image_input" name="image" value="{{$oldlogoImages}}"/>
                                                                <input type="hidden" class="image_url" name="images_url" value="{{$oldImagesURL}}"/>
                                                                <input type="hidden" class="image_thumbnail_input" name="image_thumbnail" value="{{$oldtumbImages}}"/>
                                                                <input type="hidden" class="image_thumbnail_url" name="image_thumbnail_url" value="{{$oldImagesURL}}"/>
                                                            </div>
                                                            <div class="image-title upload">&nbsp;</div>
                                                        </li>
                                                    @endif
                                                    <li class="green-photo mr-3 null_class {{!empty(old('image',$record->image))?"hide":''}}">
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
                            @foreach(config('translatable.locales_name') as $language=>$locale)
                                <div class="card card-border-primary language_card">
                                    <div class="card-header text-{{CommonHelper::getTextAlign($locale)}}">{{$language}}</div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                <div class="form-group">
                                                    <label class="control-label float-{{CommonHelper::getTextAlign($locale)}}">{{$language}} Advertisement Title</label>
                                                    <input type="text" class="form-control" name="{{ $locale }}[title]" dir="{{CommonHelper::getAlignment($locale)}}" placeholder="Enter advertisement title" value="{{ old($locale.'.title', $record->translateOrNew($locale)->title) }}">
                                                    @if ($errors->has($locale.'.title'))
                                                        <span class="error-message text-{{CommonHelper::getTextAlign($locale)}}">
                                                            <strong>{{ $errors->first($locale.'.title') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Update</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @include('admin.advertisements.jscript')
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
@endsection

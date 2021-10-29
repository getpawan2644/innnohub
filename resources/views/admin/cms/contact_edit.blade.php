@php
    use App\Models\Banner as Banner;
@endphp
@extends('layouts.admin.default')

@section('title',"Edit CMS")

@section('header',"Edit CMS")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Manage CMS </a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit CMS</li>
@endsection
@section('content')
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.cms.contact-detail-update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Phone Number</label>
                                        <input type="text" class="form-control" name="phone_number" placeholder="Enter Phone Number" value="{{ old('phone_number',$record->phone_number) }}">
                                        <span class="info_span"> NOTE: Please use comma(,) to enter multiple values<span>
                                        @if ($errors->has('phone_number'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('phone_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Email Address</label>
                                        <input type="text" class="form-control" name="email" placeholder="Enter Email" value="{{ old('email',$record->email) }}">
                                        <span class="info_span"> NOTE: Please use comma(,) to enter multiple values<span>
                                        @if ($errors->has('email'))
                                            <span class="error-message">
										<strong>{{ $errors->first('email') }}</strong>
									</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
{{--                            <div class="row">--}}
{{--                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">--}}
{{--                                    <div class="form-group">--}}
{{--                                        <label class="control-label">Address</label>--}}
{{--                                        <input type="text" class="form-control" name="address" placeholder="Enter Adddress" value="{{ old('address',$record->address) }}">--}}
{{--                                        @if ($errors->has('address'))--}}
{{--                                            <span class="error-message">--}}
{{--                                                <strong>{{ $errors->first('address') }}</strong>--}}
{{--                                            </span>--}}
{{--                                        @endif--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">Fax</label>
                                        <input type="text" class="form-control" name="fax" placeholder="Enter Fax" value="{{ old('fax',$record->fax) }}">
                                        <span class="info_span"> NOTE: Please use comma(,) to enter multiple values<span>
                                        @if ($errors->has('fax'))
                                            <span class="error-message">
                                                <strong>{{ $errors->first('fax') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card card-border-primary">
                                <div class="card-header text-left">Address Location</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label">Address </label>
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
{{--                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">--}}
{{--                                            <div class="form-group">--}}
{{--                                                <label class="control-label"> Country </label>--}}
{{--                                                <input type="text" class="form-control" id="country" name="country"  placeholder="Country" value="{{ old('country', $record->country) }}">--}}
{{--                                                @if ($errors->has('country'))--}}
{{--                                                    <span class="error-message">--}}
{{--                                                        <strong>{{ $errors->first('country') }}</strong>--}}
{{--                                                    </span>--}}
{{--                                                @endif--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
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
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Update</button>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
            //country: 'long_name',
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
        $(document).ready(function(){
        });
    </script>
@endsection

@extends('layouts.default')
@section('title',__("header.contact_title"))
{{--@php $contact_details = \App\Models\ContactDetail::getContactDetail();@endphp--}}
@php $contact_details = [] ;@endphp

@section('content')
    <!-- inner nav -->
    <section class="inner-nav">
        <div class="container sml-container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="nav-content">
                        <h6>{{__('content.contact_us')}}</h6>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="sbq-crump">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">{{__('content.home')}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{__('content.contact_us')}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- inner nav end -->
    <script src="https://maps.googleapis.com/maps/api/js?key={{env("GOOGLE_KEY")}}&libraries=places&callback=initMap" async defer></script>
    <section class="contact-page">
        <div class="container sml-container">
            <div class="row">
                <div class="col-md-7">
                    <div class="map" id="map" style="width:800px;height: 500px;">
{{--                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d48268.42814447844!2d-74.33242129241454!3d40.876773104347066!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c300d85ec5c1fd%3A0x18faa489c8175fa!2sFairfield%2C+NJ%2C+USA!5e0!3m2!1sen!2sin!4v1543296980565" frameborder="0" style="border:0" allowfullscreen="" width="100%" height="500"></iframe>--}}
                    </div>
                </div>
                <script>
                    function initMap() {
                        // The location of Uluru
                        @if(!empty($contact_details->latitude) && !empty($contact_details->longitude))
                             var uluru = {lat:{{$contact_details->latitude}}, lng:{{$contact_details->longitude}}};
                        @else
                            var uluru = {lat: -25.354826, lng: 51.183884};
                        @endif
                        // The map, centered at Uluru
                        var map = new google.maps.Map(
                            document.getElementById('map'), {zoom: 8, center: uluru});
                        // The marker, positioned at Uluru
                        var marker = new google.maps.Marker({position: uluru, map: map});
                    }
                </script>

                <div class="col-md-5">
                    <div class="contact-right">
                    <ul class="contact-right">
                        <li>
                        <div class="contact-icon">
                            <h6 class="lang_trans">{{__('content.contact_us')}}</h6>
                        </div>
                        <div>
{{--                            @php $phones=explode(",",$contact_details->phone_number)@endphp--}}
{{--                            @foreach($phones as $phone)--}}
{{--                                <p>{{$phone}}</p>--}}
{{--                            @endforeach--}}
                        </div>
                        </li>
                        <li>
                        <div class="contact-icon">
                            <h6 class="lang_trans">{{__('content.address')}}</h6>
                        </div>
                        <div>
                            <p>{{@$contact_details->address}}</p>
                        </div>
                        </li>
                        <li>
                        <div class="contact-icon">
                            <h6 class="lang_trans">{{__('content.email')}}</h6>
                        </div>
                        <div>
{{--                            @php $emails=explode(",",$contact_details->email)@endphp--}}
{{--                            @foreach($emails as $email)--}}
{{--                                <p>{{$email}}</p>--}}
{{--                            @endforeach--}}
                        </div>
                        </li>
                        <li>
                        <div class="contact-icon">
                            <h6 class="lang_trans">{{__('content.fax')}}</h6>
                        </div>
                        <div>
{{--                            @php $faxs=explode(",",$contact_details->fax)@endphp--}}
{{--                            @foreach($faxs as $fax)--}}
{{--                                <p>{{$fax}}</p>--}}
{{--                            @endforeach--}}
                        </div>
                        </li>

                    </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="container sml-container">
            <form method="POST" action="{{route('contact')}}">
                @csrf
                <div class="form-row contact-form">
                    <div class="col-md-6">
                        <label>{{__('content.name')}}</label>
                        <input type="text" class="form-control" name="name" placeholder="{{__('content.name')}}" value="{{old('name')}}" dir="<?= (\App::getLocale()=='ar')?'rtl':'' ?>">
                        @error('name')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-6">
                        <label>{{__('content.email')}}</label>
                        <input type="email" class="form-control" name="email" placeholder="{{__('content.email')}}" value="{{old('email')}}">
                        @error('email')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label>{{__('content.phone_number')}}</label>
                        <input type="hidden" id="country_code" name="country_code" value="{{ old('country_code','qa') }}">
						<input type="hidden" id="dial_code" name="dial_code" value="{{ old('dial_code','974') }}">
                        <input type="tel" name="phone_number" class="form-control" id="mobile" placeholder="{{__('content.phone_number')}}" value="{{ old('phone_number') }}">
                        @error('phone_number')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <label>{{__('content.message')}}</label>
                        <textarea class="form-control" name="message" placeholder="{{__('content.message')}}" rows="6" dir="<?= (\App::getLocale()=='ar')?'rtl':'' ?>">{{ old('message') }}</textarea>
                        @error('message')
                            <span class="error-message">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <button id="submit" class="btn btn-solid" name="submit">{{__('content.send')}}</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <script>
		//Code for intell input
		var input = document.querySelector("#mobile");
		var iti = window.intlTelInput(input, {
			initialCountry: "{{ !empty(old('country_code'))?old('country_code'):'qa' }}",
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
    </script>
@endsection

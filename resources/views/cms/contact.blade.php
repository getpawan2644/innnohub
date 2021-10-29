@extends('layouts.default')
{{--@section('title', __("content.home"))--}}
@section('title', 'Contact Us')
@section('content')
    <!-- header end -->

    <!-- inner-header -->
    <section class="p-0">
        <div class="banner inner-banner">
            <div class="banner-wrap">
                <div class="container sml-container">
                    <div class="row">
                        <div class="col-lg-12">
                            <!-- banner text -->
                            <div class="banner-text">
                                <h2>Connect with us</h2>
                            </div>
                            <!-- banner text end -->
                        </div>
                    </div>
                </div>
            </div>
            <img class="banner-bg" src="{{ asset('public/image/inner-bg.png') }}" alt="banner">
        </div>
    </section>
    <!-- inner-header end -->

{{--    @if ($errors->any())--}}
{{--        <div class="alert alert-danger">--}}
{{--            <ul>--}}
{{--                @foreach ($errors->all() as $error)--}}
{{--                    <li>{{ $error }}</li>--}}
{{--                @endforeach--}}
{{--            </ul>--}}
{{--        </div>--}}
{{--    @endif--}}

    <!-- contact us -->
    <section  >
        <div class="contact-us">
            <div class="container sml-container">
                <div class="row">
                    <div class="col-lg-6">
                        <!-- contact us -->
                        <div class="contact-us-txt">
                            <h3>Get in <span>touch</span></h3>

                            <ul class="contact-info">
                                <li><a href="#"><i class="icofont-location-pin"></i> 525 Milltown Rd Suite 304, North
                                        <br> Brunswick, NJ 08902</a></li>
                                <li><a href="mailto:info@Innohub.com"><i class="icofont-mail"></i> info@Innohub.com</a>
                                </li>
                                <li><a href="tel:+1 987 654 3210"><i class="icofont-ui-call"></i> +1 987 654 3210 (Fax:
                                        +1 555 666 9874)</a></li>
                            </ul>

                            <ul class="social-footer">
                                <li><a href="https://www.facebook.com" target="_blank"><i class="icofont-facebook"></i></a>
                                </li>
                                <li><a href="https://www.youtube.com" target="_blank"><i
                                                class="icofont-youtube"></i></a></li>
                                <li><a href="https://www.instagram.com" target="_blank"><i
                                                class="icofont-instagram"></i></a></li>
                                <li><a href="https://www.twitter.com" target="_blank"><i
                                                class="icofont-twitter"></i></a></li>
                                <li><a href="https://www.linkedin.com" target="_blank"><i class="icofont-linkedin"></i></a>
                                </li>
                            </ul>

                            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Eius sit, accusamus atque
                                voluptas illum eveniet reiciendis voluptatem rem, dignissimos, nobis ipsam! Odit dolor
                                commodi explicabo omnis quam laborum fugit.</p>
                        </div>
                        <!-- contact us end -->
                    </div>
                    <div class="col-lg-6">
                        <div class="contact-form">
                            <form class="row g-3 needs-validation" action="{{route('cms.contactUs')}}" method="POST"
                                  novalidate>
                                @csrf
                                <div class="col-lg-12">
                                    <h3>Contact us</h3>
                                </div>

                                <div class="col-md-12">
                                    <input type="text" class="form-control" placeholder="Your name" name="name" value="{{Auth::check() ? Auth::user()->fullname:''}}"
                                           required>
                                    @error('name')
                                    <span class="error-message">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Enter your name.
                                    </div>

                                </div>

                                <div class="col-md-6">
                                    <input type="email" class="form-control" placeholder="Your Email" name="email" value="{{Auth::check()?Auth::user()->email:''}}"
                                           required>
                                    @error('email')
                                    <span class="error-message">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Enter your email id.
                                    </div>

                                </div>

                                {{-- dd(Auth::user()) --}}


                                <div class="col-md-6">
                                    {{-- <input type="number" class="form-control" placeholder="Phone number" required> --}}
                                    <input type="hidden" id="country_code" name="country_code" value="{{ old('country_code', $record->country_code) }}">
                                    <input type="hidden" id="dial_code" name="dial_code" value="{{ old('dial_code', $record->dial_code) }}">

                                    <input type="tel" onclick="this.setSelectionRange(0, this.value.length)"
                                           class="form-control" name="mobile" id="mobile"
                                           value="{{Auth::check()?Auth::user()->mobile:''}}"
                                           placeholder="{{__('content.phone_number')}}" required>
                                    @error('mobile')
                                    <span class="error-message">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Enter your Phone number.
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <textarea rows="5" class="form-control" placeholder="Enter message here"
                                              name="message"  required>{{old('message')}}</textarea>
                                    @error('message')
                                    <span class="error-message">
                                      <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                    <div class="valid-feedback">
                                        Looks good!
                                    </div>
                                    <div class="invalid-feedback">
                                        Enter your message.
                                    </div>
                                </div>

{{--                                <input  id="text1" type="text" name="text1" placeholder="text1">--}}
{{--                                <input  id="text2" type="text" name="text2" placeholder="text2">--}}

                                <div class="col-12">
                                    <button class="inno_btn" type="submit" >Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- contact us end -->
    <script>
        //Code for intell input
        var input = document.querySelector("#mobile");
        var iti = window.intlTelInput(input, {
            initialCountry: "{{ !empty(old('country_code', $record->country_code))?old('country_code', $record->country_code):'in' }}",
        });
        // console.log('iti :'+JSON.stringify(iti));
        var initial_iti = JSON.parse(JSON.stringify(iti));
        console.log(initial_iti);
        var selected_country_code = initial_iti.selectedCountryData.iso2;
        var selected_dial_code = initial_iti.selectedCountryData.dialCode;

        $('#country_code').val(selected_country_code);
        $('#dial_code').val(selected_dial_code);
        window.intlTelInputGlobals.loadUtils("https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.4/js/utils.js");
        input.addEventListener("countrychange", function () {
            console.log(iti.getSelectedCountryData());
            let countryData = iti.getSelectedCountryData();
            console.log(countryData);
            document.getElementById('country_code').value = countryData.iso2;
            document.getElementById('dial_code').value = countryData.dialCode;
        });
    </script>

@endsection


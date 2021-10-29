@extends('layouts.default')
@section('title', __("content.register"))
@section('content')
     <!-- inner-header -->
    @include('elements.banner.inner_banner')
     <!-- inner-header end -->

<!-- sign up -->

  <!--  Buyer signup step-2-->
  <section>
    <div class="signup">
      <div class="container sml-container">
        <div class="row">
          <div class="col-lg-5">
            <div class="sgn-wrap">
              <img src="{{ asset('image/registration.jpg') }}" alt="image" class="img-fluid">
            </div>

          </div>
          <div class="col-lg-7">
            <!-- signup -->
            <div class="signup-form">
              <form  method="POST" action="{{ route('user.post-register') }}" enctype="multipart/form-data" class="row g-3 needs-validation" novalidate>
                @csrf
                <input type="hidden" name="user_type" value="{{ $user_type }}">
                <div class="col-lg-12">
                  <h3>Register as Buyer</h3>
                </div>
                <div class="col-md-6">
                  <input type="text" class="form-control" name="first_name" value="{{ old('first_name', $record->first_name) }}" placeholder="{{__('content.first_name')}}" required>
                  @error('first_name')
                      <span class="error-message">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    Enter your First name.
                  </div>
                </div>

                <div class="col-md-6">
                  <input type="text" class="form-control" name="last_name" value="{{ old('last_name', $record->last_name) }}" placeholder="{{__('content.last_name')}}" required>
                  @error('last_name')
                      <span class="error-message">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    Enter your Last name.
                  </div>
                </div>

                <div class="col-md-6">
                  <input type="text" class="form-control" name="company_name" value="{{ old('company_name', $record->company_name) }}" placeholder="{{__('content.company_name')}}" required>
                  @error('company_name')
                      <span class="error-message">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    Enter Company name.
                  </div>
                </div>

                <div class="col-md-6">
                  <input type="text" class="form-control" name="job_title" value="{{ old('job_title', $record->job_title) }}" placeholder="{{__('content.job_title')}}" required>
                  @error('job_title')
                      <span class="error-message">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    Enter Job title.
                  </div>
                </div>

                <div class="col-md-6">
                  <select name="company_size" id="company_size" class="form-select">
                    <option disabled required selected>Company size</option>
                    <option value="1-50">1-50</option>
                    <option value="50-200">50-200</option>
                    <option value="200-500">200-500</option>
                    <option value="500-1000">500-1000</option>
                    <option value="1000-5000">1000-5000</option>
                    <option value="5000+">5000+</option>
                  </select>
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    select company size
                  </div>
                </div>

                <div class="col-md-6">
                  <input type="text" class="form-control" name="industry" value="{{ old('industry', $record->industry) }}" placeholder="{{__('content.industry')}}" required>
                  @error('industry')
                      <span class="error-message">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    Enter Industry.
                  </div>
                </div>

                <div class="col-md-6">
                    <select name="country_id" id="country" class="form-select">
                        <option disabled required selected>{{__('content.Country')}}</option>
                        @foreach(App\Models\Country::allActive() as $country)
                            @if(old('country_id',$record->country_id) == $country['id'])
                                <option selected value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                            @else
                                <option value="{{ $country['id'] }}">{{ $country['name'] }}</option>
                            @endif
                        @endforeach
                    </select>

                    @error('country_id')
                        <span class="error-message">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    select Country size.
                  </div>
                </div>

                <div class="col-md-6">
                  {{-- <input type="email" class="form-control" placeholder="Corporate Email" required> --}}
                  <input type="email" class="form-control" name="email" value="{{ old('email', $record->email) }}" placeholder="{{__('content.email_id')}}" required>
                  @error('email')
                      <span class="error-message">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    Enter corporate email.
                  </div>
                </div>

                <div class="col-md-6">
                  {{-- <input type="number" class="form-control" placeholder="Phone number" required> --}}
                  <input type="hidden" id="country_code" name="country_code" value="{{ old('country_code', $record->country_code) }}">
                  <input type="hidden" id="dial_code" name="dial_code" value="{{ old('dial_code', $record->dial_code) }}">
                  <input type="tel" onclick="this.setSelectionRange(0, this.value.length)" class="form-control" name="mobile" id="mobile" value="{{ old('mobile', $record->mobile) }}" placeholder="{{__('content.phone_number')}}" required>
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

                <div class="col-md-6">
                  {{-- <input type="password" class="form-control" placeholder="Password" required> --}}
                  <input type="password" class="form-control" name="password" value="{{ old('password', $record->password) }}" placeholder="{{__('content.password')}}" required>
                  @error('password')
                      <span class="error-message">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    Enter new password.
                  </div>
                </div>
                <div class="col-md-6">
                  <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation', $record->password_confirmation) }}" placeholder="{{__('content.confirm_password')}}" required>
                  @error('password_confirmation')
                      <span class="error-message">
                          <strong>{{ $message }}</strong>
                      </span>
                  @enderror
                  <div class="valid-feedback">
                    Looks good!
                  </div>
                  <div class="invalid-feedback">
                    Enter Confirm password.
                  </div>
                </div>


                <div class="col-12">
                  <button class="inno_btn px-4 mt-4" type="submit">{{__('content.register')}}</button>
                  <p class="pt-3">{{__('content.already_have_account')}}<a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#login_model">{{__('content.log_in')}}</a> </p>
                </div>
              </form>
            </div>
            <!-- signup end -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!--  Buyer signup end -->

<!-- sign up end -->
<script>
    //Code for intell input
    var input = document.querySelector("#mobile");
    var iti = window.intlTelInput(input, {
        initialCountry: "{{ !empty(old('country_code', $record->country_code))?old('country_code', $record->country_code):'in' }}",
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
<script>
    // Example starter JavaScript for disabling form submissions if there are invalid fields
    (function () {
      'use strict'

      // Fetch all the forms we want to apply custom Bootstrap validation styles to
      var forms = document.querySelectorAll('.needs-validation')

      // Loop over them and prevent submission
      Array.prototype.slice.call(forms)
        .forEach(function (form) {
          form.addEventListener('submit', function (event) {
            if (!form.checkValidity()) {
              event.preventDefault()
              event.stopPropagation()
            }

            form.classList.add('was-validated')
          }, false)
        })
    })()
  </script>
@endsection

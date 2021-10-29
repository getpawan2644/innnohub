@extends('layouts.default')

@section('content')
@section('content')
  <!-- inner-header -->
  <section class="p-0">
    <div class="banner inner-banner">
      <div class="banner-wrap">
        <div class="container sml-container">
          <div class="row">
            <div class="col-lg-12">
              <!-- banner text -->
              <div class="banner-text">
                <h2>{{__('content.reset_password')}}</h2>
              </div>
              <!-- banner text end -->
            </div>
          </div>
        </div>
      </div>
      <img class="banner-bg" src="{{ asset('image/inner-bg.png') }}" alt="banner">
    </div>
  </section>
  <!-- inner-header end -->
    <!--  Vendor signup step-2-->
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
                <div class="reg-form">
                    <h3 class="mb-4 text-left">{{__('content.reset_password')}}</h3>
                    <form class="row g-3"  method="POST" action="{{ route('password.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group signup-with" style="display:block;">
                            <div class="row g-3">
                                <div class="col-lg-12">
                                    {{-- <div class="form-group"> --}}
                                        <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" value="{{ old('email') }}">
                                        @if ($errors->has('email'))
                                            <span class="error-message float-left">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                        @endif
                                    {{-- </div> --}}
                                </div>
                                <div class="col-lg-12">
                                    {{-- <div class="form-group"> --}}
                                        <input id="password" placeholder="{{ __('Password') }}" type="password" class="form-control" name="password" >
                                        @if ($errors->has('password'))
                                            <span class="error-message float-left">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    {{-- </div> --}}
                                </div>
                                <div class="col-lg-12">
                                    {{-- <div class="form-group"> --}}
                                        <input id="password-confirm"  placeholder="{{ __('Confirm Password') }}"  type="password" class="form-control" name="password_confirmation">
                                        @if ($errors->has('password_confirmation'))
                                            <span class="error-message float-left">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                        @endif
                                    {{-- </div> --}}
                                </div>
                            </div>
                        </div>
                        <!-- button -->
                        <div class="text-center">

                            <button type="submit" class="inno_btn px-4 mt-4">{{__('content.reset_password')}}</button>
                        </div>
                    </form>
                    <p class="pt-3 text-center">{{__('content.already_have_account')}}
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#login_model">{{__('content.log_in')}}</a></p>
                </div>
                <!-- signup end -->
              </div>
            </div>
          </div>
        </div>
      </section>
      <!-- Vendor signup end -->
    <!-- sign up -->

@endsection

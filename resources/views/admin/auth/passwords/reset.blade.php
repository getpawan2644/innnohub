@extends('layouts.admin.app')
@section('title',"Admin Reset Password")
@section('content')
<form method="POST" class="sign-in-form" action="{{ route('admin.password.update') }}">
	@csrf
	<input type="hidden" name="token" value="{{ $token }}">
	<div class="card">
		<div class="card-body">
			<a href="javascript:void(0);" class="brand text-center d-block m-b-20">
				<img src="{{ asset('img/admin/logo2x.png') }}" />
			</a>
			<h5 class="sign-in-heading text-center">Reset Password</h5>
			<p class="text-center text-muted">&nbsp;</p>
			<div class="form-group">
				<label for="inputEmail" class="sr-only">Email address</label>
				<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" value="{{ $email ?? old('email') }}"  autofocus>
				 @if ($errors->has('email'))
					<span class="error-message">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
			</div>
			<div class="form-group">
				<label for="password" class="sr-only">Password</label>
				<input id="password" placeholder="{{ __('Password') }}" type="password" class="form-control" name="password" >
				@if ($errors->has('password'))
					<span class="error-message">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
			</div>
			<div class="form-group">
				<label for="password-confirm" class="sr-only">Password</label>
				<input id="password-confirm"  placeholder="{{ __('Confirm Password') }}"  type="password" class="form-control" name="password_confirmation">
			</div>
			<button class="btn btn-primary btn-rounded btn-floating btn-lg btn-block" type="submit">Reset Password</button>
			<p class="text-muted m-t-25 m-b-0 p-0"><a href="{{ route('admin.login') }}"> Login Here</a></p>
		</div>
	</div>
</form>
@endsection

@extends('layouts.admin.app') 
@section('title',"Admin Reset Password")
@section('content')
<form method="POST" class="sign-in-form" action="{{ route('admin.password.email') }}">
	@csrf
	<div class="card">
		<div class="card-body">
			<a href="javascript:void(0);" class="brand text-center d-block m-b-20">
				<img src="{{ asset('img/admin/logo2x.png') }}" />
			</a>
			<h5 class="sign-in-heading text-center">Forgotten Password?</h5>
			<p class="text-center text-muted">Enter your email to reset your password</p>
			<div class="form-group">
				<label for="inputEmail" class="sr-only">Email address</label>
				<input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" value="{{ old('email') }}">
				 @if ($errors->has('email'))
					<span class="error-message">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
				@endif
			</div>
			<button class="btn btn-primary btn-rounded btn-floating btn-lg btn-block" type="submit">Send Password Reset Link</button>
			<p class="text-muted m-t-25 m-b-0 p-0"><a href="{{ route('admin.login') }}"> Login Here</a></p>
		</div>
	</div>
</form>
@endsection

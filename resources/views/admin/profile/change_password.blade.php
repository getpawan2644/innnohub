@extends('layouts.admin.default')

@section('title',"Change Password")

@section('header', "Change Password")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page">Change Password</li>
@endsection

@section('content')
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <form method="POST" action="{{ route('admin.updatePassword') }}">
                            @csrf
                            <div class="form-group">
                                <label for="exampleInputName1">Current Password</label>
                                <input type="password" class="form-control" name="current_password" id="exampleInputName1" placeholder="Current Password" value="{{ old('current_password') }}">
                                @if ($errors->has('current_password'))
                                    <span class="error-message">
									<strong>{{ $errors->first('current_password') }}</strong>
								</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">New Password</label>
                                <input type="password" class="form-control" name="password" id="exampleInputName1" placeholder="New Password" value="{{ old('password') }}">
                                @if ($errors->has('password'))
                                    <span class="error-message">
									<strong>{{ $errors->first('password') }}</strong>
								</span>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputName1">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" id="exampleInputName1" placeholder="Confirm Password" value="{{ old('password_confirmation') }}">
                                @if ($errors->has('password_confirmation'))
                                    <span class="error-message">
									<strong>{{ $errors->first('password_confirmation') }}</strong>
								</span>
                                @endif
                            </div>
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Submit</button>
                            <a href="{{ route('admin.dashboard.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

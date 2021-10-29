@extends('layouts.admin.default') 

@section('title',"Settings")

@section('header',"Site Settings")

@section('breadcrumb')
    @parent
        <li class="breadcrumb-item"><a href="{{ route('admin.settings.index') }}">Manage Settings </a></li>
        <li class="breadcrumb-item active" aria-current="page">Site Settings</li>
    @endsection

@section('content')
<section class="page-content container-fluid"> 
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{ route('admin.settings.updateSiteSettings') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                            
                            <div class="row">
                            @foreach($records as $key=>$value)
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <label class="control-label">
                                            {{ \CommonHelper::displaySettingLabel($value['key'])  }}
                                        </label>
                                        <input type="text" class="form-control" name="{{$value['key']}}" placeholder="" value="{{old($value['key'],$value['value'])}}">
                                        @if ($errors->has($value['key']))
                                            <span class="error-message">
                                                <strong>{{ $errors->first($value['key']) }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                               @endforeach
                        </div>
                        <button type="submit" class="btn btn-primary mr-2 mt-4">Update</button>
                            <a href="{{ route('admin.settings.index') }}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
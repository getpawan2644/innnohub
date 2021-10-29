@php
    use App\Models\Banner as Banner;
@endphp
@extends('layouts.admin.default')

@section('title',"Message Board")

@section('header',"Message Board")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.message.index') }}">Messages </a></li>
    <li class="breadcrumb-item active" aria-current="page">Welcome Message Board</li>
@endsection
    
@section('content')

    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST"  action="{{route('admin.message-reply', ['id'=>$id])}}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="mid_steps">
                                        <div class="form-heading">
                                            <h4>View<strong> / </strong>Reply <span></span></h4>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label><b>{{__('content.subject')}}: </b></label>
                                                    {{$records['subject']}}
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="msg-box">
                                                    @if(isset($records['messages']) && !empty($records['messages']))
                                                        @foreach($records['messages'] as $key => $value)
                                                            @if($value['sender_id']==0)
                                                                <div class="float-right msg-1 text-right">
                                                                    <h5>You</h5>
                                                                    <p>{!! nl2br(e($value['message'])) !!}</p>
                                                                    <pre>{{date('d M Y h:i:s A', strtotime($value['created_at']))}}</pre>
                                                                </div>
                                                                
                                                            @else
                                                                <div class="float-left msg-1">
                                                                    <h5>{{ $customer_name }} </h5>
                                                                    <p>{!! nl2br(e($value['message'])) !!}</p>
                                                                    <pre>{{date('d M Y h:i:s A', strtotime($value['created_at']))}}</pre>
                                                                </div>
                                                            @endif
                                                            <br>
                                                        @endforeach
                                                    @else
                                                        <div class="float-right msg-1 text-right">
                                                            <h5> </h5>
                                                            <p>No Records Found</p>
                                                            <pre></pre>
                                                        </div>
                                                        <br>
                                                    @endif
                                                    
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group"> 
                                                    <label>Message <span class="required">*</span></label>
                                                    <textarea rows="5" name="message" class="form-control" id="message" placeholder="Message"></textarea>
                                                    @error('message')
                                                        <span class="error-message">
                                                        <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                    <input type="hidden" name="parent_id" value="{{$records['id']}}">
                                                    <input type="hidden" name="sender_id" value="0">
                                                    <input type="hidden" name="status" value="Pending">
                                                    <input type="hidden" name="customer_status" value="Pending">
                                                    <input type="hidden" name="admin_status" value="Viewed">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <button type="submit" class="btn green-btn">Send</button>
                                    <a href="{{route('admin.message.index')}}" class="btn green-btn">Back</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@extends('layouts.default')
@section('title', trans('content.message_board'))
@section('content')
    <!-- inner nav -->
    <section class="inner-nav">
        <div class="container sml-container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="nav-content">
                        <h6>{{__("content.message_board")}}</h6>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="sbq-crump">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">{{__("content.home")}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__("content.message_board")}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- inner nav end -->

    <section class="sidebar_with_container">
        <div class="container sml-container">
            <div class="row">
                @include("elements.layout.sidebar")
                <div class="col-lg-10 col-md-12">
                    <div class="row">
                        <div class="table-responsive col-md-12"  style="margin:10px;">
                            <form method="POST"  action="{{route('message-reply', ['id'=>$id])}}" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mid_steps">
                                            <div class="form-heading"> 
                                                <h4>{{__('content.view')}}<strong> / </strong>{{__('content.reply')}} <span></span></h4>
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
                                                                @if($value['sender_id']==$authId)
                                                                    <div class="float-right msg-1 text-right">
                                                                        <h5>You </h5>
                                                                        <p>{!! nl2br(e($value['message'])) !!}</p>
                                                                        <pre>{{date('d M Y h:i:s A', strtotime($value['created_at']))}}</pre>
                                                                    </div>
                                                                @else
                                                                    <div class="float-left msg-1">
                                                                        <h5>{{__('content.admin')}}</h5>
                                                                        <p>{!! nl2br(e($value['message'])) !!}</p>
                                                                        <pre>{{date('d M Y h:i:s A', strtotime($value['created_at']))}}</pre>
                                                                    </div>
                                                                @endif
                                                                <br>
                                                            @endforeach
                                                        @else
                                                            <div class="float-right msg-1 text-right">
                                                                <h5> </h5>
                                                                <p>{{__('content.no_record_found')}}</p>
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
                                                        <label>{{__('content.message')}} <span class="required">*</span></label>
                                                        <textarea rows="5" name="message"  dir="<?= (\App::getLocale()=='ar')?'rtl':'' ?>" class="form-control" id="message" placeholder="{{__('content.message')}}"></textarea>
                                                        @error('message')
                                                            <span class="error-message">
                                                            <strong>{{ $message }}</strong> 
                                                            </span>
                                                        @enderror
                                                        <input type="hidden" name="parent_id" value="{{$records['id']}}">
                                                        <input type="hidden" name="sender_id" value="{{$authId}}">
                                                        <input type="hidden" name="status" value="Pending">
                                                        <input type="hidden" name="customer_status" value="Viewed">
                                                        <input type="hidden" name="admin_status" value="Pending">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn green-btn">{{__('content.send')}}</button>
                                        <a href="{{route('message.index')}}" class="btn green-btn">{{__('content.back')}}</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
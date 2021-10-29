@extends('layouts.default')
@section('title', trans('content.message'))
@section('content')
    <!-- inner nav -->
    <section class="inner-nav">
        <div class="container sml-container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="nav-content">
                        <h6>{{__('content.message_to_admin')}}</h6>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="sbq-crump">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">{{__("content.home")}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('content.message_to_admin')}}</li>
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
                <div class="col-md-12 col-lg-10">
                    <div class="row">
                        <div class="col-lg-8 col-md-12 mobile-margin-30">
                            <form  method="POST" action="{{ route('message.store') }}" id="message-form">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__("content.subject")}}</label>
                                    <input type="text" class="form-control" name="subject" value="{{old('subject')}}" placeholder="{{__("content.subject")}}">
                                    @error('subject')
                                        <span class="error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">{{__('content.message_to_admin')}}</label>
                                    <textarea class="form-control" name="message" rows="10"  dir="<?= (\App::getLocale()=='ar')?'rtl':'' ?>"></textarea>
                                    @error('message')
                                        <span class="error">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                                <input type="hidden" name="customer_id" value="{{\Auth::id()}}" />
                                <button type="submit" class="btn btn-primary mb-2">{{__("content.submit")}}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        // $('document').ready(function(){
        //     $('body').on('submit', 'form#message-form', function(event){
        //         event.preventDefault();

        //     });
        // });
    </script>
@endsection

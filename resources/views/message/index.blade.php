@extends('layouts.default')
@section('title', trans('content.message'))
@section('content')
    <!-- inner nav -->
    <section class="inner-nav">
        <div class="container sml-container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="nav-content">
                        <h6>{{__('content.messages')}}</h6>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="sbq-crump">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('home')}}">{{__("content.home")}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{__('content.messages')}}</li>
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
                        <div class="col-lg-12">
                            <div class="table-responsive"  style="margin:10px;"  id="appointment-list">
                            <a href="{{route('message.create')}}" class="float-right m-1 new_msg_btn"  role="button">{{__('content.new_message')}}</a>
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{__('content.from_to')}}</th>
                                        <th class="tableSubject" scope="col">{{__('content.subject')}}</th>
                                        <th class="tblDate">{{__('content.date')}}</th>
                                        <th scope="col">{{__('content.new_message')}}</th>
                                        <th scope="col">{{__('content.action')}}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(!empty($records))
                                        @php $i=1 @endphp
                                        @foreach($records as $key=>$value)
                                        <tr>
                                            <th scope="row">{{$i++}}</th>
                                            <td>{{__('content.admin')}}</td>
                                            <td class="tblSbj">
                                                {{$value->subject}}
                                            </td>
                                            <td>{{ date('d-m-Y', strtotime($value->last_message->created_at)) }}</td>
                                            <td>
                                                @if($value->customer_count>0)
                                                    <a href="{{route('message.message',['id'=>$value->id])}}"  class="btn btn-primary"  role="button">
                                                        {!! trans_choice('content.new_message_alert',$value->customer_count,['new_msg'=>$value->customer_count]) !!}
                                                    </a>
                                                @else
                                                    <a href="{{route('message.message',['id'=>$value->id])}}"  class="btn btn-info"  role="button">
                                                        {!! trans_choice('content.new_message_alert',$value->customer_count,['new_msg'=>$value->customer_count]) !!}
                                                    </a>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{route('message.message',['id'=>$value->id])}}" class="btn btn-primary action_btn" role="button">
                                                    {{__('content.view')}}
                                                </a>
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="6">
                                                @include('elements.pagination.common')
                                            </td>
                                        </tr>
                                    @else
                                        <tr>
                                            <td colspan="6">No new messages</td>
                                        </tr>
                                    @endif
                                    

                                </tbody>
                            </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
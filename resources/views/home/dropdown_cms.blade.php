@php
    use App\Model\User;
    use App\Models\Country;
    $countries = Country::getCountryList();
@endphp
@extends('layouts.default')
@section('title',__("header.profile_title"))
@section('content')
    <!-- inner nav -->
    <section class="inner-nav">
        <div class="container sml-container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="nav-content">
                        <h6>{{$page_details->title}}</h6>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="sbq-crump">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route("home")}}">{{__("content.home")}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$page_details->title}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- inner nav end -->
    <section>
        <div class="container sml-container">
            <div class="policy-page">
                @if($records->count()>0)
                <div id="accordion" class="accordion">
                    <div class="accord_block">
                        @foreach($records as $record)

                        <div class="card-header collapsed" data-toggle="collapse" href="#collapse{{$record->id}}">
                            <a class="card-title">
                               {{$record->title}}
                            </a>
                        </div>
                        <div id="collapse{{$record->id}}" class="card-body collapse" data-parent="#accordion">
{{--                            <p>--}}
                            {!!  $record->description!!}
{{--                            </p>--}}
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </section>
@endsection

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
                        <h6>{{$page->title}}</h6>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="sbq-crump">
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route("home")}}">{{__("content.home")}}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{$page->title}}</li>
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
                @php print($page->content) @endphp
            </div>
        </div>
    </section>
@endsection

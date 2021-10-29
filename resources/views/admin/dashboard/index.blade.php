@extends('layouts.admin.default')

@section('title',"Dashboard")

@section('header',"Dashboard")

@section('content')

    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card coustom-padding">
{{--                    <div class="row m-0 col-border-xl">--}}
{{--                        <div class="col-md-12 col-lg-6 col-xl-3">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="icon-rounded icon-rounded-primary float-left m-r-20">--}}
{{--                                    <i class="icon dripicons-graph-bar"></i>--}}
{{--                                </div>--}}
{{--                                <h5 class="card-title m-b-5 counter" data-count="5627">5,627</h5>--}}
{{--                                <h6 class="text-muted m-t-10">--}}
{{--                                    Active Sessions--}}
{{--                                </h6>--}}
{{--                                <div class="progress progress-active-sessions mt-4" style="height:7px;">--}}
{{--                                    <div class="progress-bar bg-primary" role="progressbar" style="width: 72%;" aria-valuenow="72" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                                <small class="text-muted float-left m-t-5 mb-3">--}}
{{--                                    Change--}}
{{--                                </small>--}}
{{--                                <small class="text-muted float-right m-t-5 mb-3 counter append-percent" data-count="72">72</small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-12 col-lg-6 col-xl-3">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="icon-rounded icon-rounded-accent float-left m-r-20">--}}
{{--                                    <i class="icon dripicons-cart"></i>--}}
{{--                                </div>--}}
{{--                                <h5 class="card-title m-b-5 append-percent counter" data-count="67">67</h5>--}}
{{--                                <h6 class="text-muted m-t-10">--}}
{{--                                    Add to Cart--}}
{{--                                </h6>--}}
{{--                                <div class="progress progress-add-to-cart mt-4" style="height:7px;">--}}
{{--                                    <div class="progress-bar bg-accent" role="progressbar" style="width: 67%;" aria-valuenow="67" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                                <small class="text-muted float-left m-t-5 mb-3">--}}
{{--                                    Change--}}
{{--                                </small>--}}
{{--                                <small class="text-muted float-right m-t-5 mb-3 counter append-percent" data-count="67">67</small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-12 col-lg-6 col-xl-3">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="icon-rounded icon-rounded-info float-left m-r-20">--}}
{{--                                    <i class="icon dripicons-mail"></i>--}}
{{--                                </div>--}}
{{--                                <h5 class="card-title m-b-5 counter" data-count="337">337</h5>--}}
{{--                                <h6 class="text-muted m-t-10">--}}
{{--                                    Newsletter Sign Ups--}}
{{--                                </h6>--}}
{{--                                <div class="progress progress-new-account mt-4" style="height:7px;">--}}
{{--                                    <div class="progress-bar bg-info" role="progressbar" style="width: 83%;" aria-valuenow="83" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                                <small class="text-muted float-left m-t-5 mb-3">--}}
{{--                                    Change--}}
{{--                                </small>--}}
{{--                                <small class="text-muted float-right m-t-5 mb-3 counter append-percent" data-count="83">83</small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                        <div class="col-md-12 col-lg-6 col-xl-3">--}}
{{--                            <div class="card-body">--}}
{{--                                <div class="icon-rounded icon-rounded-success float-left m-r-20">--}}
{{--                                    <i class="la la-dollar f-w-600"></i>--}}
{{--                                </div>--}}
{{--                                <h5 class="card-title m-b-5 prepend-currency counter" data-count="37873">37,873</h5>--}}
{{--                                <h6 class="text-muted m-t-10">--}}
{{--                                    Total Revenue--}}
{{--                                </h6>--}}
{{--                                <div class="progress progress-total-revenue mt-4" style="height:7px;">--}}
{{--                                    <div class="progress-bar bg-success" role="progressbar" style="width: 77%;" aria-valuenow="77" aria-valuemin="0" aria-valuemax="100"></div>--}}
{{--                                </div>--}}
{{--                                <small class="text-muted float-left m-t-5 mb-3">--}}
{{--                                    Change--}}
{{--                                </small>--}}
{{--                                <small class="text-muted float-right m-t-5 mb-3 counter append-percent" data-count="77">77</small>--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
                    <div class="row">
                        <div class="col-md-4 col-lg-6 col-xl-4">
                            <div class="card custom_card" style="width:100%;">
                                <div class="card-header custom_header color-1">
                                    test
                                </div>
                                <ul class="list-group list-group-flush">
                                    {{-- <li class="list-group-item">Products Active<span class="float-right">{{$product["active"]}}</span></li>
                                    <li class="list-group-item">Products Inactive<span class="float-right">{{$product["inactive"]}}</span></li>
                                    <li class="list-group-item">Products Total<span class="float-right">{{$product["total"]}}</span></li> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-6 col-xl-4">
                            <div class="card custom_card" style="width:100%;">
                                <div class="card-header custom_header color-2">
                                   test
                                </div>
                                <ul class="list-group list-group-flush">
                                    {{-- <li class="list-group-item">Vendors Active<span class="float-right">{{$vendors["active"]}}</span></li>
                                    <li class="list-group-item">Vendors Inactive<span class="float-right">{{$vendors["inactive"]}}</span></li>
                                    <li class="list-group-item">Vendors Total<span class="float-right">{{$vendors["total"]}}</span></li> --}}
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-6 col-xl-4">
                            <div class="card custom_card" style="width:100%;">
                                <div class="card-header custom_header color-3">
                                    test
                                </div>
                                <ul class="list-group list-group-flush">
                                    {{-- <li class="list-group-item">Clients Active<span class="float-right">{{$clients["active"]}}</span></li>
                                    <li class="list-group-item">Clients Inactive<span class="float-right">{{$clients["inactive"]}}</span></li>
                                    <li class="list-group-item">Clients Total<span class="float-right">{{$clients["total"]}}</span></li> --}}
                                </ul>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-md-4 col-lg-6 col-xl-4">
                            <div class="card custom_card" style="width:100%;">
                                <div class="card-header custom_header color-4">
                                    Appointment This Month ({{date("M-Y")}})
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Booked Slots <span class="float-right">{{$appointment["booked"]}}</span></li>
                                    <li class="list-group-item">Available Slots<span class="float-right">{{$appointment["not_booked"]}}</span></li>
                                    <li class="list-group-item">Total Slots <span class="float-right">{{$appointment["total"]}}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-6 col-xl-4">
                            <div class="card custom_card" style="width:100%;">
                                <div class="card-header custom_header color-5">
                                    Product Request Received ({{date("M-Y")}})
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Request Canceled <span class="float-right">{{$order["canceled"]}}</span></li>
                                    <li class="list-group-item">Request Completed <span class="float-right">{{$order["completed"]}}</span></li>
                                    <li class="list-group-item">Total Request Received <span class="float-right">{{$order["total"]}}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-6 col-xl-4">
                            <div class="card custom_card" style="width:100%;">
                                <div class="card-header custom_header color-6">
                                    Total Product Request Received
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Request Canceled <span class="float-right">{{$totalorder["canceled"]}}</span></li>
                                    <li class="list-group-item">Request Completed <span class="float-right">{{$totalorder["completed"]}}</span></li>
                                    <li class="list-group-item">Total Request Received <span class="float-right">{{$totalorder["total"]}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-lg-6 col-xl-4">
                            <div class="card custom_card" style="width:100%;">
                                <div class="card-header custom_header color-7">
                                    Users
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">User Active <span class="float-right">{{$user["active"]}}</span></li>
                                    <li class="list-group-item">User Inactive <span class="float-right">{{$user["inactive"]}}</span></li>
                                    <li class="list-group-item">Total User <span class="float-right">{{$user["total"]}}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-6 col-xl-4">
                            <div class="card custom_card" style="width:100%;">
                                <div class="card-header custom_header color-8">
                                    Categories
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Category Active <span class="float-right">{{$category["active"]}}</span></li>
                                    <li class="list-group-item">Category Inactive <span class="float-right">{{$category["inactive"]}}</span></li>
                                    <li class="list-group-item">Total Category <span class="float-right">{{$category["total"]}}</span></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-md-4 col-lg-6 col-xl-4">
                            <div class="card custom_card" style="width:100%;">
                                <div class="card-header custom_header color-9">
                                    Countries
                                </div>
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item">Country Active <span class="float-right">{{$country["active"]}}</span></li>
                                    <li class="list-group-item">Country Inactive <span class="float-right">{{$country["inactive"]}}</span></li>
                                    <li class="list-group-item">Total Country <span class="float-right">{{$country["total"]}}</span></li>
                                </ul>
                            </div>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </section>

@endsection

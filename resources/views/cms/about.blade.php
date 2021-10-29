@extends('layouts.default')
@section('title', __("content.home"))
@section('title', 'Page Title')
@section('content')
<!-- header end -->

<!-- inner-header -->
<section class="p-0">
    <div class="banner inner-banner">
        <div class="banner-wrap">
            <div class="container sml-container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- banner text -->
                        <div class="banner-text">
                            <h2>About us</h2>



                        </div>
                        <!-- banner text end -->

                    </div>
                </div>
            </div>
        </div>
        <img class="banner-bg" src="{{asset('image/inner-bg.png')}}" alt="banner">
    </div>
</section>
<!-- inner-header end -->

<!-- about us -->
<section class="pt-0">
    <div class="about-us">
        <div class="container sml-container">
            <div class="row">
                <div class="col-lg-6">
                    <!-- about us image -->
                    <div class="about-img">
                        <img src="{{asset('image/about.png')}}" alt="about image" class="img-fluid">
                    </div>
                    <!-- about us image end -->
                </div>
                <div class="col-lg-6">
                    <!-- about us content -->
                    <div class="about-us-wrap">
                        <h6>WELCOME TO OUR MARKET!</h6>
                        <h2>We are in that Business, which is Concern with you</h2>
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur facilis placeat quisquam voluptatem atque natus facere obcaecati. Suscipit alias reiciendis tenetur recusandae voluptatum corporis tempora tempore sed, officiis enim eius qui aspernatur ipsam esse fugit? Commodi eius laborum placeat.</p>
                        <h5>It showed a lady fitted out with a fur hat and fur boa who sat upright, raising a heavy fur muff that</h5>
                        <a class="inno_btn" href="#">Get In Touch</a>
                    </div>
                    <!-- about us content end -->
                </div>
                <div class="col-lg-6">
                    <!-- vision -->
                    <div class="vision">
                        <img src="{{asset('image/v-1.png')}}" alt="icon">
                        <div class="vison-cont">
                            <h6>Vision</h6>
                            <p>To be a company that provides “Transformation through<br> Trust”</p>
                        </div>
                    </div>
                    <!-- vision end -->
                </div>
                <div class="col-lg-6">
                    <!-- vision -->
                    <div class="vision">
                        <img src="{{asset('image/v-2.png')}}" alt="icon">
                        <div class="vison-cont">
                            <h6>Mission</h6>
                            <p>To help our global customers achieve digital transformation by leveraging new technologies and IT platform.</p>
                        </div>
                    </div>
                    <!-- vision end -->
                </div>
            </div>
        </div>
    </div>
</section>
<!-- about us end -->
@endsection

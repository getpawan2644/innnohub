@php
// $middle_banner=App\Models\Banner::getMiddleBanner();
// $bottom_banner=App\Models\Banner::getBottomBanner();
// $advertisements=App\Models\Advertisement::getAdvertisements();
// $trending_categories = \App\Models\Category::getTrendingCategoryList();
// $offer_categories = \App\Models\Category::getOffersCategoryList();
// $clientCategory = App\Models\ClientCategory::getActiveFeaturedClientCategoryList();
@endphp
@extends('layouts.default')
@section('title', __("content.home"))
@section('title', 'Page Title')
@section('content')
    <!-- home banner -->
    @include('elements.banner.home_banner')
    <!-- home banner end -->

  <!-- innovators of the week -->
 <div class="container sml-container">

	<div class="row">
		<div class="col-md-5">
			<div class="product-img">
				<div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
					  <div class="carousel-inner">
					  	@php $img=explode(",",$service->images);  @endphp
					  	@foreach($img as $key=>$value)
					    <div class="carousel-item {{($key == 0) ? 'active' : ''}}">
					      <img src="{{asset('service/'.$value)}}" class="d-block w-100" alt="...">
					    </div>
					    @endforeach
					    <!--div class="carousel-item">
					      <img src="..." class="d-block w-100" alt="...">
					    </div>
					    <div class="carousel-item">
					      <img src="..." class="d-block w-100" alt="...">
					    </div-->
					  </div>
					  <a class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
					    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
					    <span class="visually-hidden">Previous</span>
					 </a>
					  <a class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
					    <span class="carousel-control-next-icon" aria-hidden="true"></span>
					    <span class="visually-hidden">Next</span>
					  </a>
				</div>
			</div>
		</div>
		<div class="col-md-6 ms-5">
			<div class="product-description">
				<div class="product-level">
					<img src="{{asset('service/'.$service->logo)}}" style=" width: 86px;">
					<!--label>{{$service->service_name}}</label-->
				</div>
				<h2 class="product_name mt-2">{{ucfirst($service->service_name)}}</h2>
				<p class="product-shrt-desc">{{substr($service->description,0,50)}}</p>
				<div class="features_sec">
					<h5></h5>
					 @foreach($service->serviceCat as $key=>$value1)
                 @php
                   $id=explode(",",$value1['sub_category']);
                   $data=App\Models\SubCategory::where('id',$id)->first();
                  
                 @endphp
                <li><a href="#">{{$data->name}}</a></li>
                @endforeach
				</div>
				 <div>
				 	
				 	
				 </div>
				<div class="card-btns">

                <a href="#" class="border-btn" style="text-align: center; padding-top: 10px;">Book a Meeting</a>
                 <a href="{{route('vendorprofile',$service->user_id)}}" class="blue-btn" style="text-align: center; padding-top: 10px;">Vendor Profile</a>
                <!--a href="" class="blue-btn">Learn more</a-->
              </div>
				
			</div>
		</div>
		<div class="col prd_description mt-5 mb-3">
			<h5 class="sml_heading mb-4"><span>Discription</span></h5>
			<p class="product-shrt-desc">{{$service->description}}</p>
		</div>
	</div>
</div>
  <!-- innovators of the week end -->


 





@endsection

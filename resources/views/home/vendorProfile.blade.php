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
    <style>


#myImg {
  border-radius: 5px;
  cursor: pointer;
  transition: 0.3s;
}

#myImg:hover {opacity: 0.7;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.9); /* Black w/ opacity */
}

/* Modal Content (image) */
.modal-content {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
}

/* Caption of Modal Image */
#caption {
  margin: auto;
  display: block;
  width: 80%;
  max-width: 700px;
  text-align: center;
  color: #ccc;
  padding: 10px 0;
  height: 150px;
}

/* Add Animation */
.modal-content, #caption {  
  -webkit-animation-name: zoom;
  -webkit-animation-duration: 0.6s;
  animation-name: zoom;
  animation-duration: 0.6s;
}

@-webkit-keyframes zoom {
  from {-webkit-transform:scale(0)} 
  to {-webkit-transform:scale(1)}
}

@keyframes zoom {
  from {transform:scale(0)} 
  to {transform:scale(1)}
}

/* The Close Button */
.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #f1f1f1;
  font-size: 40px;
  font-weight: bold;
  transition: 0.3s;
}

.close:hover,
.close:focus {
  color: #bbb;
  text-decoration: none;
  cursor: pointer;
}

/* 100% Image Width on Smaller Screens */
@media only screen and (max-width: 700px){
  .modal-content {
    width: 100%;
  }
}
</style>

<style type="text/css">


	.tabbing-part .nav-tabs .nav-item .nav-link {padding:10px 18px;}
</style>>
  <!-- innovators of the week -->
  <section class="innov-sec pt-3">
    <div class="container sml-container">
    <div class="mystore">
      <div class="row">
        <div class="left_side">
          <div class="col-lg-12 d-flex align-items-center">
            
            <div class="img_wrap"><img src="{{asset('user/'.$user->image)}}" alt=""></div>
            <div class="right_cont">
              <!--p class="city_detail"><i class="icofont-building-alt"></i> ORGANIZATION</p-->
              <h1>{{ucfirst($user->first_name)}} {{ucfirst($user->last_name)}}</h1>
            </div>
          </div>
        </div>
        <div class="right_side">
        	   @if(Auth::check())
                <a href="#" class="btn mt-5 open-AddBookDialog" data-id="{{$user->id}}"  data-toggle="modal" data-target="#make_offer_model">Book a Meeting</a>
              @else
              <a href="#" class="btn mt-5" data-toggle="modal" data-target="#login_model">Book a Meeting</a>
              @endif
         
        </div>
      </div>
    </div>
    <div class="tabbing-part">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
        <a class="nav-link active" id="home-tab" data-bs-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Overview</a>
        </li>
        <li class="nav-item" role="presentation">
        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#service" role="tab" aria-controls="profile" aria-selected="false">Services</a>
        </li>
        <li class="nav-item" role="presentation">
        <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Multimedia</a>
        </li>
        <li class="nav-item" role="presentation">
        <a class="nav-link" id="contact-tab" data-bs-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Case Studies</a>
        </li>
        <li class="nav-item" role="presentation">
        <a class="nav-link" id="contact1-tab" data-bs-toggle="tab" href="#contact1" role="tab" aria-controls="contact1" aria-selected="false">Customers and Testimonials</a>
        </li>
        <li class="nav-item" role="presentation">
        <a class="nav-link" id="contact2-tab" data-bs-toggle="tab" href="#contact2" role="tab" aria-controls="contact2" aria-selected="false">Awards</a>
        </li>
        <li class="nav-item" role="presentation">
        <a class="nav-link" id="contact3-tab" data-bs-toggle="tab" href="#contact3" role="tab" aria-controls="contact3" aria-selected="false">Features</a>
        </li>
      </ul>
      <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <div class="overview">
          <div class="row">
            <div class="col-md-12">
              <div class="overview-content">
                <div class="heading-overview">
                  <h2><i class="icofont-building-alt"></i> About</h2>
                  <p>test test test</p>
                </div>
                <ul class="overview-details">
                  <li><i class="icofont-location-pin"></i>{{$user->address}}</li>
                  <li><i class="icofont-ui-user-group"></i> {{$user->number_of_team_members}}+</li>
                  <li><i class="icofont-dollar"></i> {{$user->fundind_type}}</li>
                  <li><i class="icofont-flag"></i> Public</li>
                  <li><i class="icofont-web"></i> {{$user->link}}</li>
                  <li><i class="icofont-chart-bar-graph"></i> 1</li>
                </ul>
              </div>
            </div>
            <div class="col-md-12 mt-5">
              <div class="overview-content">
                <div class="heading-overview">
                  <h2><i class="icofont-building-alt"></i> Highlights</h2>
                </div>
                <div class="highlights">
                  <a href="#">
                    <span>Number Of Acquisitions</span>
                    <label>1{{$user->number_of_acquisitions}}</label>
                  </a>
                  <a href="#">
                    <span>Number Of Investments</span>
                    <label>{{$user->number_of_investments}}</label>
                  </a>
                  <a href="#">
                    <span>Number Of Exits</span>
                    <label>{{$user->number_of_exits}}</label>
                  </a>
                  <a href="#">
                    <span>Total Funding Amount</span>
                    <label>${{$user->funding_amount}}</label>
                  </a>
                  <a href="#">
                    <span>Number Of Current Team Members</span>
                    <label>{{$user->number_of_team_members}}</label>
                  </a>
                  <a href="#">
                    <span>Number Of Investors</span>
                    <label>{{$user->number_of_investors}}</label>
                  </a>
                </div>
              </div>
            </div>
            <div class="col-md-12 mt-5">
              <div class="overview-content">
                <div class="heading-overview">
                  <h2><i class="icofont-building-alt"></i> Recent News & Activity</h2>
                </div>
                <div class="news">
                  <div class="news-section">
                    <h6><i class="icofont-newspaper"></i> News - Jan 23, 2021</h6>
                    <p>Nikkei Asian Review — <a href="#">Tencent uses game business to expand global empire</a></p>
                  </div>
                  <div class="news-section">
                    <h6><i class="icofont-newspaper"></i> News - Jan 23, 2021</h6>
                    <p>Nikkei Asian Review — <a href="#">Tencent uses game business to expand global empire</a></p>
                  </div>
                  <div class="news-section">
                    <h6><i class="icofont-newspaper"></i> News - Jan 23, 2021</h6>
                    <p>Nikkei Asian Review — <a href="#">Tencent uses game business to expand global empire</a></p>
                  </div>
                  <a href="#" class="view-btn">View More</a>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="details shadow-sm">
                <div class="heading-overview">
                  <h2><i class="icofont-building-alt"></i> Details</h2>
                </div>
                <div class="details-list">
                  <ul class="indus indus-list">
                    <li>
                      <div class="list-overview">
                        <h5>Industries</h5>
                        <ul class="card-pills">
                          @if(!empty($user->subcategory_id))
                          @php $data= App\Models\SubCategory::get()->toArray(); 
                               $subdata= explode(",",$user->subcategory_id);
                          @endphp
                         @foreach($data as $key=>$value)
                           @if(in_array($value['id'],$subdata))
                               
                               <li><a href="#">{{$value['name']}}</a></li>
                           @endif
                         @endforeach
                         @endif
                          
                          <!--li><a href="#">Blockchain</a></li>
                          <li><a href="#">Big Data</a></li>
                          <li><a href="#">Business Intelligence</a></li>
                          <li><a href="#">CyberSecurity</a></li>
                          <li><a href="#">Business Automation</a></li>
                          <li><a href="#">Blockchain</a></li>
                          <li><a href="#">Big Data</a></li>
                          <li><a href="#">Business Intelligence</a></li-->
                          </ul>
                      </div>
                    </li>
                    <li>
                      <div class="list-overview">
                        <h5>Headquarters Regions</h5>
                        <p>{{$user->headquarter}}</p>
                      </div>
                    </li>
                    <li>
                      <div class="list-overview">
                        <h5>Founded Date</h5>
                        <p>{{$user->founded_date}}</p>
                      </div>
                    </li>
                    <li>
                      <div class="list-overview">
                        <h5>Founders</h5>
                        <p>{{$user->founders}}</p>
                      </div>
                    </li>
                    <li>
                      <div class="list-overview">
                        <h5>Operating Status</h5>
                        <p>Active</p>
                      </div>
                    </li>
                    <li>
                      <div class="list-overview">
                        <h5>Last Funding Type</h5>
                        <p>{{$user->fundind_type}}</p>
                      </div>
                    </li>
                    <li>
                      <div class="list-overview">
                        <h5>Also Known As</h5>
                        <p>Tencent, 腾讯, Tengxun</p>
                      </div>
                    </li>
                    <li>
                      <div class="list-overview">
                        <h5>Legal Name</h5>
                        <p>{{$user->legal_name}}</p>
                      </div>
                    </li>
                    <li>
                      <div class="list-overview">
                        <h5>Related Hubs </h5>
                        <p>{{$user->hub}}</p>
                      </div>
                    </li>
                  </ul>
                  <ul class="indus secound-list">
                    <li class="mt-0">
                      <div class="list-overview">
                        <h5>Stock Symbol</h5>
                        <p>{{$user->stock_symbol}}</p>
                      </div>
                    </li>
                    <li class="mt-0">
                      <div class="list-overview">
                        <h5>Company Type </h5>
                        <p>{{$user->company_type}}</p>
                      </div>
                    </li>
                    <li>
                      <div class="list-overview">
                        <h5>Number of Exits</h5>
                        <p>{{$user->number_of_exits}}</p>
                      </div>
                    </li>
                    <li>
                      <div class="list-overview">
                        <h5>Contact Email</h5>
                        <p>{{$user->contact_email}}</p>
                      </div>
                    </li>
                    <li>
                      <div class="list-overview">
                        <h5>Phone Number</h5>
                        <p>{{$user->dial_code}}{{$user->mobile}}</p>
                      </div>
                    </li>
                  </ul>
                  <p>Tencent is an internet service portal offering value-added internet, mobile, telecom, and online advertising services. Its communications and social platforms Weixin and QQ connect users with each other, with digital content and daily life services in just a few clicks.</p>
                  <p>Tencent has maintained steady growth under its user-oriented operating</p>
                </div>
              </div>
            </div>
          </div>
        </div>
        </div>
         <div class="tab-pane fade" id="service" role="tabpanel" aria-labelledby="service-tab">
         	
             <div class="row">
             	<div class="overview">
             	@foreach($service as $key=>$value)
					<div class="col-md-12">
						<div class="product-description">
							<div class="product-level">
								<img src="{{asset('service/'.$value['logo'])}}" style=" width: 86px;">
							</div>
							<h2 class="product_name mt-2">{{ucfirst($value['service_name'])}}</h2>
              <p class=" mt-2">{{ date('d-M-Y', strtotime($value['created_at'])) }}</p>
							<p class="product-shrt-desc">{{substr($value['description'],0,50)}} <br><span class="view_btn view_mr">View More</span></p>
							<p class="long_desc">{{$value['description']}} <br><span class="view_btn view_ls">View Less</span></p>
						</div>
					</div>
					@endforeach
				</div>
			</div>


         </div>
         <!--------Multimedia----->
        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
           <section class="padding-80">
  
            <div class="container">
            
              <div class="row">
              
              @if(!empty($multimedia))

              @foreach($multimedia as $key => $value)
                <div class="col-lg-3">
                  {{ucfirst($value['name'])}}
                  <div class="gallery-item">

                  <?php $ext = explode(".",$value['image']);  $ex=$ext['1'] ?>
                  
                  @if($ex == 'mp4' || $ex == 'mkv')
                    
                  <video controls="" class="img-thumbnail">
                
                    <source src="{{ url($value['image_url']) }}" type="video/<?php echo $ex; ?>"></source></video>
                              
                  @else  
                    <a href="{{ url($value['image_url']) }}" data-fancybox="images" data-caption="My caption" class="fancybox">
                      
                      <img src="{{ url($value['image_url']) }}" alt="" class="img-fluid" style=" width: 272px; height: 252px;"/>
                    </a>
                    @endif
                    
                  </div>
                </div>
                @endforeach
                @else
                  <h3>Record Not Found.</h3>
                  @endif
              </div>
            </div>
</section>
        </div>
        <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
           <div class="row">
              <div class="overview">
                @if(!empty($casestudy))
              @foreach($casestudy as $key=>$value1)
          <div class="col-md-12">
            <div class="product-description">
              <h2 class="product_name mt-2">{{ucfirst($value1['name'])}}</h2>
              <p class=" mt-2">{{ date('d-M-Y', strtotime($value1['created_at'])) }}</p>
              <p class="product-shrt-desc">{{substr($value1['description'],0,50)}} <br><span class="view_btn view_mr">View More</span></p>
              <p class="long_desc">{{$value1['description']}} <br><span class="view_btn view_ls">View Less</span></p>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>
        </div>
          <div class="tab-pane fade" id="contact1" role="tabpanel" aria-labelledby="contact1-tab">
             <div class="row">
              
              <div class="overview">
                @if(!empty($testimonial))
              @foreach($testimonial as $key=>$value1)
          <div class="col-md-12">
            <div class="product-description">
              <h2 class="product_name mt-2">{{ucfirst($value1['name'])}}</h2>
              <p class=" mt-2">{{ date('d-M-Y', strtotime($value1['created_at'])) }}</p>
              <p class="product-shrt-desc">{{substr($value1['comment'],0,50)}} <br><span class="view_btn view_mr">View More</span></p>
              <p class="long_desc">{{$value1['comment']}} <br><span class="view_btn view_ls">View Less</span></p>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>
          </div>
          <div class="tab-pane fade" id="contact2" role="tabpanel" aria-labelledby="contact2-tab">
                <div class="row">
              <div class="overview">
                @if(!empty($award))
              @foreach($award as $key=>$val)
          <div class="col-md-12">
            <div class="product-description">
             
             
              <div class="row g-0">
                <div class="col-lg-3 pr-lg-0 zoom">
                  <img src="{{asset('awards/'.$val['image'])}}" id="myImg" style="width: 240px;  height: 157px;">
                </div>
                
                <div class="col-lg-6 pr-lg-0">
                  <h2 class="product_name mt-2">{{ucfirst($val['name'])}}</h2>
              <p class=" mt-2">{{ date('d-M-Y', strtotime($val['created_at'])) }}</p>
              <p class="product-shrt-desc">{{substr($val['description'],0,50)}} <br><span class="view_btn view_mr">View More</span></p>
              <p class="long_desc">{{$val['description']}} <br><span class="view_btn view_ls">View Less</span></p>
          

                </div>
                </div>
            </div>
          </div>
          @endforeach
          @endif
        </div>
      </div>
          </div>
          <div class="tab-pane fade" id="contact3" role="tabpanel" aria-labelledby="contact3-tab">
            
             <div class="row">
              
              <div class="overview">
               @if(!empty($feature))  
              <div class="col-md-12">
            <div class="product-description">
              <h2 class="product_name mt-2 text-center">{{(!empty($feature)) ? ucfirst($feature->title) : ''}}</h2>
              <div class="ms-3">{!! (!empty($feature)) ? $feature->description : '' !!}</div>
            </div>
          </div>
         @endif
        </div>
      </div>
          </div>
      </div>
    </div>
  </div>
  </section>
  <!-- innovators of the week end -->

  <!-- blue ribbon -->
  <section class="p-0">
    <div class="blue-ribbon">
      <div class="container sml-container">
        <div class="row">
          <div class="col-lg-12">
            <!-- heading -->
            <div class="heading">
              <h3 class="text-white">Why our marketplace?</h3>
            </div>
            <!-- heading end -->
          </div>
          <div class="col-lg-3 col-md-6">
            <!-- ribbon item -->
            <div class="ribbon-item">
              <img src="{{ asset('image/ribbon (1).png') }}" alt="icon">
              <div class="ribbon-content">
                <h5>Quality Guarantee</h5>
                <p>Quality checked by our team</p>
              </div>
            </div>
            <!-- ribbon item end -->
          </div>

          <div class="col-lg-3 col-md-6">
            <!-- ribbon item -->
            <div class="ribbon-item">
              <img src="{{ asset('image/ribbon (2).png') }}" alt="icon">
              <div class="ribbon-content">
                <h5>Customer Support</h5>
                <p>Friendly 24/7 customer support</p>
              </div>
            </div>
            <!-- ribbon item end -->
          </div>

          <div class="col-lg-3 col-md-6">
            <!-- ribbon item -->
            <div class="ribbon-item">
              <img src="{{ asset('image/ribbon (3).png') }}" alt="icon">
              <div class="ribbon-content">
                <h5>Lifetime Free Updates</h5>
                <p>Never pay for an update</p>
              </div>
            </div>
            <!-- ribbon item end -->
          </div>

          <div class="col-lg-3 col-md-6">
            <!-- ribbon item -->
            <div class="ribbon-item">
              <img src="{{ asset('image/ribbon (4).png') }}" alt="icon">
              <div class="ribbon-content">
                <h5>Secure Payments</h5>
                <p>we posess SSL / Secure сertificate</p>
              </div>
            </div>
            <!-- ribbon item end -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- blue ribbon end -->

  <!-- about -->
  <section>
    <div class="about">
      <div class="container sml-container">
        <div class="row">
          <div class="col-lg-12">
            <!-- heading -->
            <div class="heading">
              <h3>We have to focus on your identity</h3>
            </div>
            <!-- heading end -->

            <!-- about content -->
            <div class="about-content">
              <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas accumsan lacus vel facilisis.</p>
              <p>Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequatur? Quis autem vel eum iure reprehenderit qui in ea voluptate velit esse quam nihil molestiae consequatur, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur?"</p>
            </div>
            <!-- about content end -->
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- about end -->
    <!-- Modal -->
<div class="modal fade" id="make_offer_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Book a meeting</h5>
      
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
     
    </div>
    <div class="modal-body">
      <div class="price-input">
      
       
      
       <input type ="hidden" value="" id="serviceid" name="service_id">
       <label>Message</label>
	   <textarea class="form-control mb-4" name="message" id="message" placeholder="Please enter your message here"></textarea>
        <!--div id="sname" ></div> <div id="sdec"></div>

        <div id="bookId"></div-->
        <button class="main_btn btn submit_btn bookmeeting" id="bookmeeting"  name="submit">Send</button>
		
      </div>
    </div>
   </div>
  </div>
  </div>
  <!-- Modal -->

  <!-- The Modal Image -->

<div id="myModal" class="modal">
  <span class="close">&times;</span>
  <img class="modal-content" id="img01">
  <div id="caption"></div>
</div>



<script>
  $('.close').click(function() {
    $('.modal').css({
        'display': 'none'
       
    });
});
// Get the modal
var modal = document.getElementById("myModal");

// Get the image and insert it inside the modal - use its "alt" text as a caption
var img = document.getElementById("myImg");
var modalImg = document.getElementById("img01");
var captionText = document.getElementById("caption");
img.onclick = function(){
  modal.style.display = "block";
  modalImg.src = this.src;
  captionText.innerHTML = this.alt;
}

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on <span> (x), close the modal
span.onclick = function() { 
  modal.style.display = "none";
}
</script>

<script type="text/javascript">
  $(document).on("click", ".open-AddBookDialog", function () {
   /*   var myBookId = $(this).data('id');
     var servicedescription = $(this).data('servicedescription');
     var servicename = $(this).data('servicename');
     document.getElementById("bookId").innerHTML = myBookId;
     document.getElementById("sname").innerHTML = servicename;
     document.getElementById("sdec").innerHTML = servicedescription;*/
     var myBookId = $(this).data('id');
    $(".modal-body #serviceid").val( myBookId );
     
});

  $(document).on("click", ".bookmeeting", function () {
       //var userid= "{{Auth::check() ? Auth::user()->id : ''}}";
        var id = $('#serviceid').val();
        var message = $('#message').val();
       
        var url = "{{URL('book-meeting')}}";
        $.ajax({
            url: url,
            type: "POST",
            data:{ 
                _token:'{{ csrf_token() }}','id':id,'message':message,
            },
            cache: false,
            dataType: 'json',
            success: function(dataResult){

               if(dataResult.status == 1){
               swal({ position: 'center',icon: 'success',title: dataResult.msg,showConfirmButton: false,timer: 1500});
              // swal("Hello World");
      location.reload();
               }else{
                swal("Something went wrong");
               }
               
            }
            });
});

$(document).ready(function(){
	$(".view_mr").click(function(){
		$(this).parents(".product-description").addClass("long");
	});
	$(".view_ls").click(function(){
		$(this).parents(".product-description").removeClass("long");
	});
});
</script>




@endsection

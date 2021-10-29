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
   
    <!-- home banner end -->

  <!-- innovators of the week -->
  
        <!-- banner -->
  <section class="p-0">
    <div class="banner inner-banner">
      <div class="banner-wrap">
        <div class="container sml-container">
          <div class="row">
            <div class="col-lg-12">
              <!-- banner text -->
              <div class="banner-text">
                <h2>@if(!empty($category)) {{$category->name}} @endif</h2>
              </div>
              <!-- banner text end -->
      </div>
          </div>
        </div>
      </div>
      <img class="banner-bg" src="image/inner-bg.png" alt="banner">
    </div>
  </section>
  <!-- banner end -->
  
  <!-- innovators of the week -->
  <section class="innov-sec">
    <div class="innovators inner-cat">
      <div class="container sml-container">
        <div class="row">
            @if(!$service->isEmpty())
         @foreach($service as $key=>$value)
          <div class="col-lg-3 col-md-6">
            <!-- inno card -->
            <div class="inno-card">
              <img src="{{ asset('user/'.$value['image']) }}" alt="inno logo">
              <h4>{{ucfirst($value['first_name'])}} {{ucfirst($value['last_name'])}}</h4>
              <p>{{substr($value['description'],0,50)}}</p>
              <ul class="card-pills">
              
                 
                 @if(!empty($value['subcategory_id']))
                  @php $data= App\Models\SubCategory::get()->toArray(); 
                       $subdata= explode(",",$value['subcategory_id']);
                  @endphp
                 @foreach($data as $key=>$value1)
                   @if(in_array($value1['id'],$subdata))
                       
                       <li><a href="#">{{$value1['name']}}</a></li>
                   @endif
                 @endforeach
                 @endif
                <!--li><a href="#">Blockchain</a></li>
                <li><a href="#">Big Data</a></li>
                <li><a href="#">Business Intelligence</a></li>
                <li><a href="#">CyberSecurity</a></li>
                <li><a href="#">Business Automation</a></li-->
              </ul>
              <div class="card-btns">
                  @if(Auth::check())
                <a href="#" class="border-btn open-AddBookDialog" data-id="{{$value['id']}}"  data-toggle="modal" data-target="#make_offer_model">Book a Meeting</a>
              @else
              <a href="#" class="border-btn" data-toggle="modal" data-target="#login_model">Book a Meeting</a>
              @endif
                <a href="{{route('vendorprofile',$value['id'])}}" class="blue-btn">Learn more</a>
              </div>
            </div>
            <!-- inno card end -->
          </div>
           @endforeach
          @else
          <h3 style="text-align: center;">Data Not Found</h3>
          @endif

         
        </div>
      </div>
    </div>
  </section>

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
 
  <!-- innovators of the week end -->

  <!-- blue ribbon -->
 
  <!-- about end -->

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
</script>



@endsection

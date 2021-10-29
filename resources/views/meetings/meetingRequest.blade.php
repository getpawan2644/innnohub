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
  <section class="p-0">
    <div class="banner inner-banner">
      <div class="banner-wrap">
        <div class="container sml-container">
          <div class="row">
            <div class="col-lg-12">
              <!-- banner text -->
              <div class="banner-text">
                <h2>Meeting</h2>
              </div>
              <!-- banner text end -->
            </div>
          </div>
        </div>
      </div>
      <img class="banner-bg" src="{{ asset('image/inner-bg.png') }}" alt="banner">
    </div>
  </section>
    <!-- home banner end -->

<!--a href="{{ url('services/create') }}">Add serviuces </a-->

 <section class="sidebar_with_container">
        <div class="container sml-container">
            <div class="row">
                @include("elements.layout.sidebar")
                <div class="col-lg-10 col-md-12">
                    <div class="row">
						<div class="col-lg-12">
							<div class="card">
								<div class="card-body card_table_body">
									<div class="card-header">
										<div class="col-lg-6">	
											<form action="{{URL('meeting/request')}}" method="GET">
												<div class="form-group">
													<div class="input-group mb-3">
															<input type="text" class="form-control" placeholder="Search by name" name="search" value="{{ Request::get('search') }}">
															<div class="input-group-append">
																<input type="submit" class="form-control" value="Search">
															</div>
													</div>
												</div>
											</form>
										</div>
									</div>
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th class="align_center">#</th>
													<th>User Name</th>
													<!--th>Meeting Link</th-->
													<th>Message</th>
													<th>Created Date</th>
													<th>Statsus</th>
													<th class="align_center">Action</th>
												</tr>
											</thead>
											<tbody>
												<?php //print_r($records); die;?>
												@if($records->count())
													@php $slNo =  1; @endphp
													@foreach($records as $record)
														<tr>
															<td align="center">{{ $slNo++ }}</td>
															<td>{{ $record['userData']->first_name }} {{ $record['userData']->last_name }}</td>
															<!--td>{{ $record->meeting_link }}</td-->
															<td>{{ $record->message }}</td>
															<td>@php $date=strtotime($record->created_at); @endphp {{ date('d-M-Y',$date)}}</td>
															 @if(($record->status)=='Accept')
																<td class="text-success"> <i class="fas fa-check"></i>{{$record->status}}ed</td>
																@elseif(($record->status)=='Reject')
															   <td  class="text-danger"> <i class="fas fa-times-circle"></i> {{$record->status}}ed</td>
															   @else
															   <td class="text-warning"> <i class="fas fa-spinner fa-pulse"></i> {{$record->status}}</td>
																@endif
															<td align="center">
																@if($record->status == 'Pending')
																<a class="action_btn" data-toggle="modal"  onclick="viewServiceProviderModal('{{$record->id}}');" href="#myModal" class="trigger-btn" ><i class="icofont-check" aria-hidden="true"  data-toggle="tooltip" data-placement="top" title="Accept" style="font-size: 20px;"></i></a>
										 <a class="action_btn" href="#myreject" data-toggle="modal"  onclick="viewRejectOfferModal('{{$record->id}}');" class="trigger-btn"><i class="icofont-delete" data-toggle="tooltip" data-placement="top" title="Reject" style="font-size: 20px;"></i></a>
																
																 @endif
																<a href="#" class="border-btn open-meetingview" id="viewmeet" class="action_btn" data-meetinglink="{{$record->meeting_link}}"  data-message="{{$record->message}}" data-username="{{$record['userData']->first_name.' '.$record['userData']->last_name}}"  data-toggle="modal" data-target="#make_offer_model2"><i class="icofont-eye" data-toggle="tooltip" data-placement="top" title="View" style="font-size: 20px;"></i></a>
																<a href="javascript:void(0);" class="action_btn confirmDelete" data-action="{{ route('meeting.delete',$record->id) }}"><i class="icofont-bin" style="font-size: 17px;"   data-toggle="tooltip" data-placement="top" title="Delete"></i></a>
														
														</td>
															
														</tr>
													@endforeach
												@else
												<tr>
													<td class="text-center" colspan="5">No Record Found!</td>
												</tr>
												@endif
											</tbody>
										</table>
									</div>
									 @if(!empty($records->links()))
						<div class="align-bottom" style="margin-left: 482px;">

								<div class="dataTables_paginate paging_simple_numbers" id="bs4-table_paginate">
									<ul class="pagination">
										<li class="paginate_button page-item">{{ $records->links() }}</li>
									</ul>
								</div>
						</div>
						@endif
								</div>
							</div>
						</div>
              </div>
          </div>
      </section>
  </div>
</div>

                      <!-- Modal -->
<div class="modal fade" id="make_offer_model2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Details</h5>
      
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
     
    </div>
    <div class="modal-body">
      <div class="price-input">
       <label><b>User Name</b></label>
        <p id="viewusername"></p>
    
      </div>
      <div class="price-input mt-2">
       <label><b>Message</b></label>
        <p id="viewmessage"></p>
    
      </div>

      <div class="price-input mt-2">
       <label><b>Meeting Link</b></label>
        <p id="viewmeetinglink"></p>
    
      </div>
    </div>
   </div>
  </div>
  </div>
  <!-- Modal -->


 <!-- Modal HTML -->
<div id="myModal" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title">Meeting Accept</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
		
				<form  id="offer_accept">
					<div class="form-group">
						<input type="hidden" class="form-control post_id" name="id" id="posted_id">
					</div>
           <div class="card-body calendar-model ">
           
            <div class="form-group mb-0">
                <label class="control-label">Start</label>
                <div class="">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group">
                          
                          
                          <input type="text" class="form-control" id="add_event_start_date" placeholder="Start Date" name="start" value="{{ old('start') }}" required/>
                          
                          
                        </div>
                       
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <span class="input-group-addon"><i class="icon dripicons-clock"></i></span>
                          </div>
                          <input type="text" class="form-control timepicker1" id="add_event_start_time" placeholder="Start Time" value="{{ old('start_time') }}" name="start_time" required/>
                           </div>
                       
                      </div>
                      
                    </div>
                  </div>
                </div>
              </div>
              <div class="form-group mb-0">
                <label  class="control-label">End</label>
                <div class="">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group">
                          
                          <input type="text" class="form-control" id="add_event_end_date" placeholder="end Date" name="end" value="{{ old('end') }}" required/>
                          
                        </div>
                       
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="input-group">
                          
                          <input type="text" class="form-control timepicker2" id="add_event_end_time" placeholder="End Time" value="{{ old('end_time') }}" name="end_time" required/>
                        </div>
                       
                      </div>
                    </div>
                  </div>
                </div>
              </div>
          <div class="form-group">
            <input class="form-control mt-2" id="meeting_link" name="meeting_link" type="text" placeholder="Please enter meeting link" required/> 
            </div>
			<div class="form-group mt-2">
			
				<textarea   class="form-control mb-6"  required="required" name="message" id="message" placeholder="Please enter your message here"></textarea>		
			
			</div>
			<div class="form-group">

						<input type="submit"class="main_btn btn submit_btn bookmeeting" value="Accepted">
					</div>
        </div>
					
				</form>				
				
			</div>
		
		</div>
	</div>
</div>     
<!-- Modal HTML -->
<div id="myreject" class="modal fade">
	<div class="modal-dialog modal-login">
		<div class="modal-content">
			<div class="modal-header">				
				<h4 class="modal-title">Meeting Reject</h4>
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			</div>
			<div class="p-3">
				<form  id="offer_reject">
					<div class="form-group">
						<input type="hidden" class="form-control rejectpost_id" name="rejectpost_id" id="rejectpost_id">
					</div>
					<div class="form-group">
						<textarea  class="form-control mb-6"  required="required" name="message_reject" id="message_reject" placeholder="Please enter your message here" style=" height: 100px;"></textarea>	
					</div>
					<div class="form-group mt-3">
						<button class="main_btn btn submit_btn bookmeeting" type="submit">Rejected</button>
					</div>
				</form>	
			</div>
			</div>
		
		</div>
	</div>

    </section>

     <script>

      $(document).on("click", "#viewmeet", function () {
      var meetinglink = $(this).data('meetinglink');
     var myBookId = $(this).data('username');
     document.getElementById("viewusername").innerHTML= myBookId;
     var myBookId1 = $(this).data('message');
      if(myBookId1 == ''){
       document.getElementById("viewmessage").innerHTML= 'The message is not available';
     }else{
     document.getElementById("viewmessage").innerHTML= myBookId1;
    }

    if(meetinglink == ''){
       document.getElementById("viewmeetinglink").innerHTML= 'Meeting link is not available';
     }else{
     document.getElementById("viewmeetinglink").innerHTML= meetinglink;
    }
    // document.getElementById("viewmessage").innerHTML= myBookId1;
    });
    </script>

    <script>

    $(document).on('click','.confirmDelete',function(e){
    	var checkstr =  confirm('are you sure you want to delete this?');
        e.preventDefault();
		var href = $(this).attr('data-action');
        if(checkstr==true){
			window.location.href = href;
		}
		
	});

	
    </script>
    <script>


  function viewServiceProviderModal(id){
      //$("#loader").show();
       //alert('id : '+id);
       $('.post_id').val(id);
      var form_data = new FormData();
       form_data.append("id",id);
      
      form_data.append("_token", "{{csrf_token()}}");
      $(".modal-body").empty();
      $('#accept_submit').on('submit',function(){
        
      })
     
  };
  </script>

     <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#offer_accept').on('submit', function(event){
        event.preventDefault();
        $('#email-error').text('');
        $('#password-error').text('');
       
       
        var posted_id = $('#posted_id').val();
        var message = $('#message').val();
        var start_date = $('#add_event_start_date').val();
        var start_time = $('#add_event_start_time').val();
        var end_date = $('#add_event_end_date').val();
        var end_time = $('#add_event_end_time').val();
        var meeting_link = $('#meeting_link').val();
         

        $.ajax({
          url: "{{route('meeting.statusAccept')}}",
          type: "POST",
          data:{
            message:message,
            start_date:start_date,
            start_time:start_time,
            end_date:end_date,
            meeting_link:meeting_link,
            end_time:end_time,
            posted_id:posted_id,
            accept:'Accept',
               "_token": "{{ csrf_token() }}",
          },
          success:function(response){
          	console.log(response.status);
            $("#myModal").modal('hide');
		       $('#offer_accept').trigger('reset');
           swal({ position: 'center',icon: 'success',title: "Meeting Successfully Accepted!",timer: 1500});
            location.reload();
          },
          error: function(response) {
            swal({ position: 'center',icon: 'error',title: "Something Want Wrong!",showConfirmButton: false,timer: 1500})
             
          }
         });
        });
      </script>
<script>
  function viewRejectOfferModal(id){
      //$("#loader").show();
       //alert('id : '+id);
       $('.rejectpost_id').val(id);
      var form_data = new FormData();
       form_data.append("id",id);
      
      form_data.append("_token", "{{csrf_token()}}");
      $(".modal-body").empty();
      $('#accept_submit').on('submit',function(){
        
      })
     
  };
  </script>
  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#offer_reject').on('submit', function(event){
        event.preventDefault();
        $('#email-error').text('');
        $('#password-error').text('');
       
       
        var rejectpost_id = $('#rejectpost_id').val();
        var message_reject = $('#message_reject').val();
         

        $.ajax({
          url: "{{route('meeting.statusReject')}}",
          type: "POST",
          data:{
            message_reject:message_reject,
            rejectpost_id:rejectpost_id,
            reject:'Reject',
               "_token": "{{ csrf_token() }}",
          },
          success:function(response){
            $("#myreject").modal('hide');
		       $('#offer_reject').trigger('reset');
           swal({ position: 'center',icon: 'success',title: "Meeting Successfully Rejected!",showConfirmButton: false,timer: 1500})
          location.reload();
          },
          error: function(response) {
            swal({ position: 'center',icon: 'error',title: "Something Want Wrong!",showConfirmButton: false,timer: 1500})
             
          }
         });
        });
      </script>

     
<script>
  var options1 = {
    //now: "03:02:02",
    title: '',
  };
  
  $('.timepicker1').wickedpicker(options1);
  var options2 = {
    //now: "02:02:02",
    title: 'End Time',
  };
  $('.timepicker2').wickedpicker(options2);
  
 
  
</script>

  
<script>
$(function() {
  $('input[name="start"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    
  });
});
</script>

<script>
$(function() {
  $('input[name="end"]').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    
  });
});
</script>


@endsection

@php
    use App\Model\User;
    use App\Models\Country;
    $countries = Country::getCountryList();
@endphp
@extends('layouts.default')
@section('title',__("header.profile_title"))
@section('content')
  <!-- inner-header -->
  <section class="p-0">
    <div class="banner inner-banner">
      <div class="banner-wrap">
        <div class="container sml-container">
          <div class="row">
            <div class="col-lg-12">
              <!-- banner text -->
              <div class="banner-text">
                <h2>{{__("header.change_password")}}</h2>
              </div>
              <!-- banner text end -->
            </div>
          </div>
        </div>
      </div>
      <img class="banner-bg" src="{{ asset('image/inner-bg.png') }}" alt="banner">
    </div>
  </section>
  <!-- inner-header end -->

    <section class="sidebar_with_container">
        <div class="container sml-container">
            <div class="row">
                @include("elements.layout.sidebar")
                <div class="col-lg-10 col-md-12">
                    <div class="row">
                        <div class="col-md-12">
                            <section class="page-content p-0">
                                
                               <!-- END TOP TOOLBAR WRAPPER -->
                              <div class="content">
                                <div class="page-content container-fluid">
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div class="card">
                                        <div class="card-body">
                                          @if(Auth()->user()->user_type == 'vendor')
                                          <div id="calendar_event"></div>
                                          @else
                                           <div id="calendar_event1"></div>
                                           @endif
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                              <!-- SIDEBAR QUICK PANNEL WRAPPER -->
                                
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Edit event modal-->
  <div class="modal fade" id="modal_edit_event">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel2">View Detail</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body calendar-model">
          <form class="edit-event__form">
		  
			<div class="form-group">
              <label for="editTitle" class="control-label">Name</label>
              <div class="">
                <input type="text" class="form-control edit_event_title" id="editTitle" placeholder="Event Title" name="name" readonly/>
                <span class="text-danger font-size-12" role="alert" id="name_error"></span>
              </div>
            </div>
            
            <div class="form-group row">
              <label class="col-md-12 control-label">Start</label>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group m-0">
                      <div class="input-group date dp-years">
                        <div class="input-group-prepend">
                          <span class="input-group-addon"><i class="icon dripicons-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control datepicker" id="event_start_date" placeholder="Start Date">
                        <span class="input-group-addon action">
                          <i class="icon dripicons-calendar"></i>
                        </span>
                        
                      </div>
                      <span class="text-danger font-size-12" role="alert" id="start_error"></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group m-0">
                      <div class="input-group ">
                        <div class="input-group-prepend">
                          <span class="input-group-addon"><i class="icon dripicons-clock"></i></span>
                        </div>
                        <input type="text" class="form-control timepicker1" id="event_start_time" placeholder="Start Time" value="">
                      </div>
                      <span class="text-danger font-size-12" role="alert" id="starttime_error"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label class="control-label">End</label>
              <div class="col-md-12">
                <div class="row">
                  <div class="col-md-6">
                    <div class="form-group m-0">
                      <div class="input-group date dp-years">
                        <div class="input-group-prepend">
                          <span class="input-group-addon"><i class="icon dripicons-calendar"></i></span>
                        </div>
                        <input type="text" class="form-control datepicker" id="event_end_date" placeholder="End Date">
                        <span class="input-group-addon action">
                          <i class="icon dripicons-calendar"></i>
                        </span>
                      </div>
                      <span class="text-danger font-size-12" role="alert" id="end_error" ></span>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group m-0">
                      <div class="input-group">
                        <div class="input-group-prepend">
                          <span class="input-group-addon"><i class="icon dripicons-clock"></i></span>
                        </div>
                        <input type="text" class="form-control timepicker2" id="event_end_time" placeholder="End Time" value="">
                      </div>
                      <span class="text-danger font-size-12" role="alert" id="endtime_error"></span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="form-group">
              <label for="textArea" class="col-md-4 control-label">Meeting Link</label>
              <div class="">
                <input type="text" name="meeting_link" class="form-control edit-event-external_link" placeholder="Meeting Link" value="" id="external" required="required">
                <span class="text-danger font-size-12" role="alert" id="external_error"></span>
              </div>
              
            </div>
            
            <div class="form-group">
              <label for="textArea" class="control-label">Message</label>
              <div class="">
                <textarea class="form-control edit-event-description" rows="3" id="textArea" placeholder="Message" required="required"></textarea>
                <span class="text-danger font-size-12" role="alert" id="des_error"></span>
              </div>
            </div>
            
            
            <input type="hidden" class="edit_event_id" id="id">
             <button type="button" id="updateid" class="btn btn-primary update" data-calendar="update">Update</button>
          </div>
        </form>
      </div>
      <!-- modal-content -->
    </div>
  </div>
    </section>
    <script>
     $(document).ready(function() {
     // $(function() {
        $('#calendar_event1').fullCalendar({
          header: {
          left: 'prev,next,today',
          center: 'title',
        },
        theme: false,
        selectable: true,
        selectHelper: true,
        editable: true,
        navLinks: true,
        eventLimit: true,

        events: <?php if(!empty($data)){echo $data; }else{ echo '[{}]';}?>,
        eventClick: function(event) {
          if (event.meeting_link) {
              window.open(event.meeting_link, "_blank");
              return false;
          }
      }
        });
     
          
       // });
    });
</script>
 <script>
     $(document).ready(function() {
     // $(function() {
      var date = new Date();
      var m = date.getMonth();
      var y = date.getFullYear();
        $('#calendar_event').fullCalendar({
          header: {
          left: 'prev,next,today',
          center: 'title',
        },
        theme: false,
        selectable: true,
        selectHelper: true,
        editable: true,
        navLinks: true,
        eventLimit: true,
        events: <?php if(!empty($data)){echo $data; }else{ echo '[{}]';}?>,
        eventClick: function(event, element) {
          console.log(moment(event.end_time).format("HH:mm:ss "));
            $('.edit_event_id').val(event.id);
          $('.edit_event_title').val(event.title);
          $('#modal_edit_event #event_start_date').val(moment(event.start_date).format("MM/DD/YYYY"));
          $('#modal_edit_event #event_end_date').val(moment(event.end_date).format("MM/DD/YYYY"));
          $('#modal_edit_event #event_start_time').val(moment(event.start).format("HH:mm "));
          $('#modal_edit_event #event_end_time').val(moment(event.end).format("HH:mm "));
          //$('#modal_edit_event .edit_event_description').val(event.description);
          $('#modal_edit_event #textArea').val(event.seller_message);
         // $('#modal_edit_event #caption').val(event.caption);
          $('#modal_edit_event #external').val(event.meeting_link);
          $('#modal_edit_event').modal('show');
          if (event.allDay === true) {
            $('#toggle-allDay').prop('checked', true);
            $('#modal_edit_event #event_start_time,#modal_edit_event #event_end_time').val('').attr('disabled', false);
            } else {
            $('#toggle-allDay').prop('checked', false);
            $('#modal_edit_event #event_start_time,#modal_edit_event #event_end_time').attr('disabled', false);
          }
        
        }
        
        });
     
          
       // });
    });
</script>

<script>
    $(document).ready(function() {
      
      $('#updateid').on('click', function (e) {
        e.preventDefault();
        var id = $('#id').val();
        var name = $('#editTitle').val();
        
        var start_date = $('#event_start_date').val();
        var start_time = $('#event_start_time').val();
        var end_time = $('#event_end_time').val();
        var end_date = $('#event_end_date').val();
        var meeting_link = $('#external').val();
        var seller_message = $('#textArea').val();
        var urlw = '{{route("user.calendarupdate")}}';
        
        
        $.ajax({
          
          type: "POST",
          url: urlw,
          data: {id:id,title: name, start_date: start_date, start_time: start_time, end_date:end_date, end_time:end_time, meeting_link:meeting_link, seller_message:seller_message},
          success:function(success){
            if(success.status=="0"){
              
              if(success.errors.meeting_link != ''){
                
                 var error_caption_url= 'Please enter meeting link';
                  $("#external_error").html(error_caption_url);
              }
              if(success.errors.seller_message != ''){
               
                var error_description='Please enter message.';
                   $("#des_error").html(error_description);
              }
              var error_name=success.errors.title;
              //var error_caption_url=success.errors.meeting_link;
              var error_start=success.errors.start_date;
              var error_start_time=success.errors.start_time;
              var error_end=success.errors.end_date;
              var error_end_time=success.errors.end_time;
             // var error_description=success.errors.seller_message;
              $("#name_error").html(error_name);
              $("#start_error").html(error_start);
              $("#starttime_error").html(error_start_time);
              $("#endtime_error").html(error_end_time);
              $("#end_error").html(error_end);
             }else{
              success.status?(toastr.success(success.msg,"Success"),setTimeout((function(){location.reload()}),3e3)):toastr.error(success.msg,"Success")
            }
          }
          
        });
        
        
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
  $('#event_start_date').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    
  });
});
</script>

<script>
$(function() {
  $('#event_end_date').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    
  });
});

 
</script>
  
  

@endsection

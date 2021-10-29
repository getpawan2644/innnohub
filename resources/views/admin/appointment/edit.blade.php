@extends('layouts.admin.default')

@section('title',"Edit Appointment")

@section('header',"Edit Appointment")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item"><a href="{{ route('admin.appointment.index') }}">Manage Categories </a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Appointment</li>
@endsection

@section('content')
<?php
    if ($errors->any()){
        // echo "<pre>";
        // // print_r($errors->all());
        // // print_r(old('from_time'));
        // print_r($errors->get('from_time.*'));
        // echo  $errors->first('from_time.0');
        // foreach($errors->getMessages() as $key => $message){
        //     print_r($key);
        //     print_r($message);
        //     echo "============";
        // }


        // <div class="alert alert-danger">
        //     <ul>
        //         @foreach ($errors->all() as $error)
        //             <li>{{ $error }}</li>
        //         @endforeach
        //     </ul>
        // </div>
    }
 ?>
    <link rel="stylesheet" href="{{ asset('css/themify-icons.css') }}">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="{{route('admin.appointment.update',$record->id)}}" enctype="multipart/form-data" autocomplete="off">
                            @csrf
                            @method('PUT')
                            <div class="card card-border-primary language_card">
                                <div class="card-header text-left">Edit Appointment Date And Time</div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                            <div class="form-group">
                                                <label class="control-label float-left">Select Date</label>
                                                <input type="text" class="form-control" name="date" id="appointment-date" placeholder="Select Date From Dropdown" value="{{old('date',$record->date)}}">
                                            </div>
                                            @if ($errors->has('date'))
                                                <span class="error-message">
                                                    <strong>{{ $errors->first('date') }}</strong>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="row" style="margin: 5px -15px 10px -15px;">
                                        <div class="col-lg-8 col-md-8 col-xs-8 col-sm-8"></div>
                                        <div class="col-lg-4 col-md-4 col-xs-4 col-sm-4">
                                            <a href="javascript:void(0);"
                                                class="btn btn-primary add-appointment"
                                                role="button" style="float: right;">Add Appointment</a>
                                        </div>
                                    </div>
                                    <div class="appointment-div">
                                        @if(!empty(old('from_time')))
                                            @php
                                                $to_time = old('to_time')
                                            @endphp
                                            @foreach(old('from_time') as $key => $value)
                                                <div class="row appointment">
                                                    <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
                                                        <div class="form-group from-time-dev">
                                                            <select class="form-control from-time" name="from_time[]">
                                                                {!! \CommonHelper::gitTimeOtions($value) !!}
                                                            </select>
                                                        </div>
                                                        @if ($errors->has('from_time.'.$key))
                                                            <span class="error-message">
                                                                <strong>{{ $errors->first('from_time.'.$key) }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
                                                        <div class="form-group">
                                                            <select class="form-control to-time" name="to_time[]">
                                                                {!! \CommonHelper::gitTimeOtions($to_time[$key]) !!}
                                                            </select>
                                                        </div>
                                                        @if ($errors->has('to_time.'.$key))
                                                            <span class="error-message">
                                                                <strong>{{ $errors->first('to_time.'.$key) }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                    @if($key!==0)
                                                        <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                                                            <div class="form-group">
                                                                <a href="javascript:void(0);" class="remove-appointment btn btn-danger" role="button"><i class="la la-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                        <span class="error-message"></span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @elseif(!empty($record['AppointmentSlot']))
                                            @foreach($record['AppointmentSlot'] as $key => $value)
                                                <div class="row appointment">
                                                    <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
                                                        <div class="form-group from-time-dev">
                                                            <select class="form-control from-time" name="from_time[]">
                                                                {!! \CommonHelper::gitTimeOtions($value->from_time) !!}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
                                                        <div class="form-group">
                                                            <select class="form-control to-time" name="to_time[]">
                                                                {!! \CommonHelper::gitTimeOtions($value->to_time) !!}
                                                            </select>
                                                        </div>
                                                    </div>
                                                    @if($key!==0)
                                                        <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                                                            <div class="form-group">
                                                                <a href="javascript:void(0);" class="remove-appointment btn btn-danger" role="button"><i class="la la-trash"></i></a>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                        <span class="error-message"></span>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @else
                                            <div class="row appointment">
                                                <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
                                                    <div class="form-group from-time-dev">
                                                        <select class="form-control from-time" name="from_time[]">
                                                            {!! \CommonHelper::gitTimeOtions() !!}
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
                                                    <div class="form-group">
                                                        <select class="form-control to-time" name="to_time[]">
                                                            {!! \CommonHelper::gitTimeOtions('00:15') !!}
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                                                    <div class="form-group">
                                                        <a href="javascript:void(0);" class="remove-appointment btn btn-danger" role="button"><i class="la la-trash"></i></a>
                                                    </div>
                                                </div> -->
                                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                    <span class="error-message"></span>
                                                </div>
                                            </div>
                                        @endif


                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary mr-2 mt-4 form-sbmt-btn">Update</button>
                            <a href="{{route('admin.appointment.index')}}" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
    $(function() {
        $("#appointment-date").datepicker({
            dateFormat: "yy-mm-dd"
        });
        $('body').on('click', '.add-appointment', function(){

            $newApp =   `
                            <div class="row appointment">
                                <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
                                    <div class="form-group">
                                        <select class="form-control from-time" name="from_time[]">
                                            {!! \CommonHelper::gitTimeOtions() !!}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-5 col-md-5 col-xs-5 col-sm-5">
                                    <div class="form-group">
                                        <select class="form-control to-time" name="to_time[]">
                                            {!! \CommonHelper::gitTimeOtions('00:15') !!}
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-xs-2 col-sm-2">
                                    <div class="form-group">
                                        <a href="javascript:void(0);" class="remove-appointment btn btn-danger"><i class="la la-trash"></i></a>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                    <span class="error-message"></span>
                                </div>
                            </div>
                        `
            $('.appointment-div').append($newApp);
            //alert('Hiii')
        });
        $('body').on('click', '.remove-appointment', function(){
            $(this).parent().parent().parent().remove();
        })
        $('body').on('change', '.to-time', function(){
            console.log($(this).val(), 'from-time', $(this).closest('.row').find('.from-time').val())
            $fromRef = $(this).closest('.row').find('.from-time')
            $toRef = $(this)
            $errorRef = $(this).closest('.row').find('.error-message')
            compartTime($fromRef, $toRef, $errorRef)
        })
        $("form").submit(function(event) {
            $this = $(this);
            let submit = false
            $( ".appointment" ).each(function( index ) {
                $fromRef = $(this).find('.from-time')
                $toRef = $(this).find('.to-time')
                $errorRef = $(this).find('.error-message')
                let sbmt = compartTime($fromRef, $toRef, $errorRef)
                if(!window.submit){
                    window.submit = sbmt
                }
            });
            if(!window.submit){
                $("form").submit();
                return true
            }
            $('input[type="submit"]').removeAttr('disabled')
            window.submit = false;
            return false;
            //event.preventDefault();
        });
    });
    function compartTime($fromRef, $toRef, $errorRef){
        var str1 = $fromRef.val();
        var str2 = $toRef.val();
        str1 =  str1.split(':');
        str2 =  str2.split(':');
        totalSeconds1 = parseInt(str1[0] * 3600 + str1[1] * 60 + 0);
        totalSeconds2 = parseInt(str2[0] * 3600 + str2[1] * 60 + 0);
        // compare them
        if (totalSeconds1 > totalSeconds2 ) {
            $fromRef.prop('selectedIndex',0);
            $toRef.prop('selectedIndex',0);
            $errorRef.html('To time should be grater then from time')
            return true;
        }
        return false
    }
  </script>
@endsection

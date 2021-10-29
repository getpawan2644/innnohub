@extends('layouts.admin.default')

@section('title',"Manage Appointment")

@section('header',"Manage Appointment")

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active" aria-current="page">Manage Appointment</li>
@endsection

@section('content')
<section class="page-content container-fluid">
    <div class="row">
		<div class="col-lg-12 text-right" style="line-height:0;">
			<a href="{{ route('admin.appointment.create') }}" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add Appointment </a>
		</div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body card_table_body">
					<div class="card-header">
						@include('admin.elements.search.app_search')
					</div>
					<div style="float:right;margin: -25px 18px 15px 0px;">
						<label style="display: block;margin-bottom: 0;">&nbsp;</label>
						<a href="{{route('admin.appointment.csv')}}" class="btn btn-primary mt-2"><i class="la la-file-excel-o" style="font-size:26px;"></i> Export</a>
					</div>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
                                    <th class="align_center">#</th>
                                    <th>@sortablelink('user_name', 'Customer Name')</th>
                                    <th>@sortablelink('email', 'Email')</th>
                                    <th>Mobile</th>
									<th>@sortablelink('appointment_date', 'Appointment Date')</th>
                                    <th>From Time</th>
									<th>To Time</th>
									<th  class="align_center" colspan="2">Action</td>
								</tr>
							</thead>
							<tbody>
								@if($records->count())
									@php $slNo =  $records->firstItem() @endphp
									@foreach($records as $record)
										<tr>
                                            <td align="center">{{ $slNo++ }}</td>
                                            <td>{{@$record->user->first_name.' '.@$record->user->last_name}}</td>
                                            <td>{{@$record->user->email}}</td>
                                            <td>{{@$record->user->dial_code.'-'.@$record->user->mobile}}</td>
											<td>{{ date('d-m-Y', strtotime(@$record->Appointment->date)) }}</td>
                                            <td>{{ date('h:i A', strtotime(@$record->from_time))}}</td>
                                            <td>{{ date('h:i A', strtotime(@$record->to_time))}}</td>
											<td><a href="{{route('admin.appointment.reschedule-appointment',['id'=>$record->id])}}" class="btn btn-primary" role="button">Reschedule</a></td>
											<td><a href="{{route('admin.appointment.cancel-appointment',['id'=>$record->id])}}" class="btn btn-primary" role="button">Cancel</a></td>
										</tr>
									@endforeach
								@else
								<tr>
									<td class="text-center" colspan="9">No Record Found!</td>
								</tr>
								@endif
							</tbody>
						</table>
					</div>
					@include('admin.elements.pagination.common')
				</div>
            </div>
        </div>
    </div>
</section>
@endsection

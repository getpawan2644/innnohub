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
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
                                    <th class="align_center">#</th>
                                    <th>Customer Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
									<th>Appointment Date</th>
                                    <th>From Time</th>
									<th>To Time</th>
								</tr>
							</thead>
							<tbody>
								@if($records->count())
									@php $slNo =  $records->firstItem() @endphp
									@foreach($records as $record)
										<tr>
                                            <td align="center">{{ $slNo++ }}</td>
                                            <td>{{$record->user->first_name.' '.$record->user->last_name}}</td>
                                            <td>{{$record->user->email}}</td>
                                            <td>{{$record->user->dial_code.'-'.$record->user->mobile}}</td>
											<td>{{ date('d-m-Y', strtotime($record->Appointment->date)) }}</td>
                                            <td>{{ date('h:i A', strtotime($record->from_time))}}</td>
                                            <td>{{ date('h:i A', strtotime($record->to_time))}}</td>
										</tr>
									@endforeach
								@else
								<tr>
									<td class="text-center" colspan="7">No Record Found!</td>
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

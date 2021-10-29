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
									<th>@sortablelink('date', 'Appointment Date')</th>
									<!-- <th class="align_center"> -->
									<th class="align_center">@sortablelink('status', 'Status')</th>
									<th class="align_center">Action</th>
								</tr>
							</thead>
							<tbody>
								@if($records->count())
									@php $slNo =  $records->firstItem() @endphp
									@foreach($records as $record)
										<tr>
											<td align="center">{{ $slNo++ }}</td>
											<td>{{ date('d-m-Y', strtotime($record->date)) }}</td>
											<td align="center" class="align_center">{!! CommonHelper::getStatusUrl('admin.appointment.changeStatus',$record->status,$record->id) !!}</td>
											<td align="center">
												<a href="javascript:void(0);" class="action_btn view_appo" href_attr="{{ route('admin.appointment.show',$record->id) }}"><i class="la la-eye"></i> <span>View</span></a>
												<a href="{{ route('admin.appointment.edit',$record->id) }}" class="action_btn"><i class="la la-pencil"></i> <span>Edit</span></a>
												<a href="javascript:void(0);" class="action_btn confirmDelete" data-action="{{ route('admin.appointment.destroy',$record->id) }}"><i class="la la-trash"></i> <span>Delete</span></a>
											</td>
										</tr>
									@endforeach
								@else
								<tr>
									<td class="text-center" colspan="6">No Record Found!</td>
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
<div class="modal fade" id="list-appointment" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Appointment Schedule <span style="margin-left: 50px;"id="ap_date"></span></h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body appoint-list">

			</div>

		</div>
	</div>
</div>
<script>
	$('document').ready(function(){
		$('body').on('click', '.view_appo', function(){
			//alert($(this).attr('href_attr'))
			$url = $(this).attr('href_attr');
			$.ajax({
				url :$url,
				type : 'GET',
				cache: false,
				success : function (response){
					$('.appoint-list').html(response.html);
					$('#ap_date').text(response.date);
					$('#list-appointment').modal('show');
				},
				beforeSend : function (){

				},
				error : function () {

				}
			});
		})
	})
</script>
@endsection

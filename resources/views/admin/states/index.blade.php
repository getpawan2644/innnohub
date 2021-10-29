@extends('layouts.admin.default')

@section('title',"States")

@section('header',"Manage States")

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active" aria-current="page">Manage States</li>
@endsection

@section('content')
<section class="page-content container-fluid">
    <div class="row">
		<div class="col-lg-12 text-right" style="line-height:0;">
			<a href="{{ route('admin.states.create') }}" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add State </a>
		</div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body card_table_body">
					<div class="card-header">
						@include('admin.elements.search.common')
					</div>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="align_center">#</th>
									<th>Country Name</th>
									<th>@sortablelink('name', 'State Name')</th>
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
											<td>{{@$record->country->name}}</td>
											<td>{{ $record->name }}</td>
											<td align="center" class="align_center">{!! CommonHelper::getStatusUrl('admin.states.changeStatus',$record->status,$record->id) !!}</td>
											<td align="center">
												<a href="{{ route('admin.states.edit',$record->id) }}" class="action_btn"><i class="la la-pencil"></i> <span>Edit</span></a>
												<a href="javascript:void(0);" class="action_btn confirmDelete" data-action="{{ route('admin.states.destroy',$record->id) }}"><i class="la la-trash"></i> <span>Delete</span></a>
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
@endsection

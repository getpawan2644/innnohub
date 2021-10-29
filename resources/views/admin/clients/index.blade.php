@extends('layouts.admin.default')

@section('title',"Clients")

@section('header',"Manage Clients")

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active" aria-current="page">Manage Clients</li>
@endsection

@section('content')
<section class="page-content container-fluid">
    <div class="row">
		<div class="col-lg-12 text-right" style="line-height:0;">
			<a href="{{ route('admin.clients.create') }}" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add Client </a>
		</div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body card_table_body">
					<div class="card-header">
						@include('admin.elements.search.common')
					</div>
					<div style="float:right;margin: -25px 18px 15px 0px;">
                        <label style="display: block;margin-bottom: 0;">&nbsp;</label>
                        <a href="{{route('admin.client.csv')}}" class="btn btn-primary mt-2"><i class="la la-file-excel-o" style="font-size:26px;"></i>Client Export</a>
                    </div>
                    <div style="float:right;margin: -25px 18px 15px 0px;">
                        <label style="display: block;margin-bottom: 0;">&nbsp;</label>
                        <a href="{{route("admin.client.analytics.csv")}}" class="btn btn-primary mt-2"><i class="la la-file-excel-o" style="font-size:26px;"></i>Clients Analytics Export</a>
                    </div>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="align_center">#</th>
									<th>@sortablelink('name', 'Title')</th>
									<th class="align_center">Phone Number</th>
                                    <th class="align_center">Logo</th>
                                    <th class="align_center">@sortablelink('status', 'Status')</th>
                                    <th class="align_center">@sortablelink('is_featured', 'Featured')</th>
									<th class="align_center">Action</th>
								</tr>
							</thead>
							<tbody>
								@if($records->count())
									@php $slNo =  $records->firstItem() @endphp
									@foreach($records as $record)
										<tr>
											<td align="center">{{ $slNo++ }}</td>
											<td>{{ $record->name }}</td>
											<td align="center">{{ '+'.$record->dial_code.'-'.$record->phone }}</td>
                                            <td width="90" height="90" align="center" class="align_center"><img src="{{$record->logo_thumbnail_url}}"></td>
                                            <td align="center" class="align_center">{!! CommonHelper::getStatusUrl('admin.clients.changeStatus',$record->status,$record->id) !!}</td>
                                            <td align="center" class="align_center">{!! CommonHelper::getStatusUrl('admin.clients.changeFeatured',$record->is_featured,$record->id) !!}</td>
											<td align="center">
												<a href="{{ route('admin.clients.edit',$record->id) }}" class="action_btn"><i class="la la-pencil"></i> <span>Edit</span></a>
												<a href="javascript:void(0);" class="action_btn confirmDelete" data-action="{{ route('admin.clients.destroy',$record->id) }}"><i class="la la-trash"></i> <span>Delete</span></a>
                                                <a href="{{ route('admin.clients.export_one',$record->id) }}" class="action_btn"><i class="la la-file-excel-o"></i> <span>Analysis Data</span></a>
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

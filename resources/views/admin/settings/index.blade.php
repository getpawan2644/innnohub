@extends('layouts.admin.default') 

@section('title',"Settings")

@section('header',"Manage Settings")

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active" aria-current="page">Manage Settings</li>
@endsection

@section('content')
<section class="page-content container-fluid">
    <div class="row">
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
									<th>#</th>
									<th>@sortablelink('key', 'Key')</th>
									<th>@sortablelink('value', 'Value')</th>
									<th>@sortablelink('group', 'Group')</th>
								</tr>
							</thead>
							<tbody>
								@if($records->count())
									@php $slNo =  $records->firstItem() @endphp
									@foreach($records as $record)
										<tr>
											<td align="center">{{ $slNo++ }}</td>
											<td>{{ $record->key }}</td>
											<td>{{ $record->value }}</td>
											<td>{{ $record->group }}</td>
										</tr>
									@endforeach
								@else
								<tr>
									<td class="text-center" colspan="4">No Record Found!</td>
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
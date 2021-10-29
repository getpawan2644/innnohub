@extends('layouts.admin.default')

@section('title',"Category")

@section('header',"Manage Category")

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active" aria-current="page">Manage Category</li>
@endsection

@section('content')
<section class="page-content container-fluid">
    <div class="row">
		<div class="col-lg-12 text-right" style="line-height:0;">
			<a href="{{ route('admin.sub_categories.create') }}" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add Sub-Category </a>
		</div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body card_table_body">
					<div class="card-header">
						@include('admin.elements.search.common')
					</div>
                    <div style="float:right;margin: -25px 18px 15px 0px;">
                        <label style="display: block;margin-bottom: 0;">&nbsp;</label>
                        {{-- <a href="{{route("admin.sub_categories.csv")}}" class="btn btn-primary mt-2"><i class="la la-file-excel-o" style="font-size:26px;"></i>Export</a> --}}
                    </div>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="align_center">#</th>
									<th>@sortablelink('category_name', 'Category Name')</th>
									<th>@sortablelink('name', 'Sub Category Name')</th>
									{{-- <th>Sub Category Code</th> --}}
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
											<td>{{ $record->category->name}}</td>
											<td>{{ $record->name }}</td>
											{{-- <td>{{ $record->category->code.'-'.$record->code }}</td> --}}
											<td align="center" class="align_center">{!! CommonHelper::getStatusUrl('admin.sub_categories.changeStatus',$record->status,$record->id) !!}</td>
											<td align="center">
												<a href="{{ route('admin.sub_categories.edit',$record->id) }}" class="action_btn"><i class="la la-pencil"></i> <span>Edit</span></a>
												<a href="javascript:void(0);" class="action_btn confirmDelete" data-action="{{ route('admin.sub_categories.destroy',$record->id) }}"><i class="la la-trash"></i> <span>Delete</span></a>
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

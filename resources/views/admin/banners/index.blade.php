@extends('layouts.admin.default')

@section('title',"Banners")

@section('header',"Manage Banners")

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active" aria-current="page">Manage Banners</li>
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha256-P8k8w/LewmGk29Zwz89HahX3Wda5Bm8wu2XkCC0DL9s=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js" integrity="sha256-yDarFEUo87Z0i7SaC6b70xGAKCghhWYAZ/3p+89o4lE=" crossorigin="anonymous"></script>
<section class="page-content container-fluid">
    <div class="row">
		<div class="col-lg-12 text-right" style="line-height:0;">
			<a href="{{ route('admin.banners.create') }}" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add Banner </a>
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
									<th>@sortablelink('banner_position', 'Banner Position')</th>
									<th>Banner Image</th>
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
											<td>{{ $record->banner_position }}</td>
                                            <td style="width:20%"><a class="fancybox" rel="group" href="{{$record->full_image_url}}"><img style="width:300px;height: 100px;" src="{{$record->full_image_url}}" alt="" /></a></td>
											<td align="center" class="align_center">{!! CommonHelper::getStatusUrl('admin.banners.changeStatus',$record->status,$record->id) !!}</td>
											<td align="center">
												<a href="{{ route('admin.banners.edit',$record->id) }}" class="action_btn"><i class="la la-pencil"></i> <span>Edit</span></a>
												<a href="javascript:void(0);" class="action_btn confirmDelete" data-action="{{ route('admin.banners.destroy',$record->id) }}"><i class="la la-trash"></i> <span>Delete</span></a>
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
    <script type="text/javascript">
        $(document).ready(function() {
            $(".fancybox").fancybox();
        });
    </script>
@endsection

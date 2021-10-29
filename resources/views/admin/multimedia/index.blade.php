@extends('layouts.admin.default')

@section('title',"Galler")

@section('header',"Manage Galler")

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active" aria-current="page">Manage Gallery</li>
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha256-P8k8w/LewmGk29Zwz89HahX3Wda5Bm8wu2XkCC0DL9s=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js" integrity="sha256-yDarFEUo87Z0i7SaC6b70xGAKCghhWYAZ/3p+89o4lE=" crossorigin="anonymous"></script>
<section class="page-content container-fluid">
    <div class="row">
		<div class="col-lg-12 text-right" style="line-height:0;">
			<a href="{{ route('admin.gallery.add',['user_id'=>$user_id]) }}" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add Gallery </a>
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
				                  <th>@sortablelink('name', 'Name')</th>
				                  <th>Image</th>
				                  <th>Created Date</th>
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
								              <td><img src="{{asset($record->imageurl) }}" style="width: 95px;"></td>
								              
								              <td>@php $date=strtotime($record->created_at); @endphp {{ date('d-M-Y',$date)}}</td>
								        
								              <td align="center">
								                <a href="{{route('admin.gallery.edit',['user_id'=>$user_id, 'id'=>$record->id])}}" class="action_btn"><i class="icofont-edit" style="font-size: 17px;"></i></a>
								                <!--a href="{{URL('services/delete/'.$record->id)}}" class="action_btn"><i class="la la-pencil"></i> Delete</a-->
								                <a href="javascript:void(0);" class="action_btn confirmDelete" data-action="{{ route('admin.gallery.delete',$record->id) }}"><i class="icofont-delete" style="font-size: 17px;"></i></a>
								            
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

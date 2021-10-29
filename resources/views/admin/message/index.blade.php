@extends('layouts.admin.default')

@section('title',"Manage Messages")

@section('header',"Manage Messages")

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active" aria-current="page">Manage Messages</li>
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
									<th class="align_center">#</th>
									<th>@sortablelink('customer.first_name', __('content.from_to'))</th>
									<th>@sortablelink('customer.created_at', 'Email')</th>
									<th>Mobile</th>
									<th>@sortablelink('last_message.created_at', 'Date')</th>
									<th class="align_center">{{__('content.new_message')}}</th>
									<th class="align_center" colspan="2">{{__('content.action')}}</th>
								</tr>
							</thead>
							<tbody>s
								@if($records->count())
									@php $slNo = $records->firstItem() @endphp
									@foreach($records as $record)
										<tr>
											<td align="center">{{ $slNo++ }}</td>
											<td>{{ trim($record->customer->first_name.' '.$record->customer->last_name) }}</td>
											<td>{{ trim($record->customer->email) }}</td>
											<td>{{ trim($record->customer->dial_code.'-'.$record->customer->mobile) }}</td>
											<td>{{ date('d-m-Y', strtotime($record->last_message->created_at)) }}</td>
                                            <td align="center">
												@if($record->admin_count > 0)
                                                    <a href="{{route('admin.message.message',['id'=>$record->id])}}"  class="btn btn-primary"  role="button">
                                                        You have <span class="badge badge-light">{{$record->admin_count}}</span> new messages
                                                    </a>
												 @else
													<a href="{{route('admin.message.message',['id'=>$record->id])}}"  class="btn btn-info"  role="button">
														You have  <span class="badge badge-light">{{$record->admin_count}}</span> new message
													</a>
                                                @endif
											</td>
											<td align="center">
                                                <a href="{{route('admin.message.message',['id'=>$record->id])}}" class="btn btn-primary action_btn" role="button">
                                                    {{__('content.view')}}
                                                </a>
											</td>
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

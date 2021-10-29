@extends('layouts.admin.default')

@section('title',"Product Request")

@section('header',"Product Request")

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active" aria-current="page">Product Request</li>
@endsection

@section('content')
    <section class="page-content container-fluid">
        <div class="row">
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
                                        <th>@sortablelink('prod_req_number', 'Req. Ref. Number')</th> 
                                        <th>Customer Name</th>
                                        <th class="align_center">Email</th>
                                        <th class="align_center">Phone</th>
                                        <th class="align_center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($records->count())
                                        @php $slNo =  $records->firstItem() @endphp
                                        @foreach($records as $record)
                                            <tr>
                                                <td align="center">{{ $slNo++ }}</td>
                                                <td>{{ $record->prod_req_number }}</td>
                                                <td>{{ $record->name }}</td>
                                                <td>{{ $record->email }}</td>
                                                <td>{{ '+'.$record->dial_code.'-'.$record->phone_number }}</td>
                                                <td align="center">
                                                    <a href="{{route('admin.all-request',['email'=>$record->email,'created'=>$record->created_at])}}" class="action_btn"><i class="la la-eye"></i> <span>View all request</span></a>
                                                    <!-- <a href="javascript:void(0);" class="action_btn confirmDelete" data-action="#"><i class="la la-trash"></i> <span>Delete</span></a> -->
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
                    <h5 class="modal-title" id="exampleModalLongTitle">Appointment Schedule</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body appoint-list">
                    
                </div>
                
            </div>
        </div>
    </div>
@endsection

@extends('layouts.admin.default')

@section('title',"Product Rating by User")

@section('header',"Product Rating by User")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.product-request')}}">Product Request</a></li>
	<li class="breadcrumb-item active" aria-current="page">Product Rating by User</li>
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
                        <!-- <div style="float:right;margin: -25px 18px 15px 0px;">
                            <label style="display: block;margin-bottom: 0;">&nbsp;</label>
                            <a href="{{route('admin.all-requests.csv')}}" class="btn btn-primary mt-2"><i class="la la-file-excel-o" style="font-size:26px;"></i> Export</a>
                        </div> -->
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="align_center">#</th>
                                        <th class="align_center">@sortablelink('product_slug', 'Product Title')</th>
                                        <th class="align_center">@sortablelink('name', 'Customer Name')</th>
                                        <th class="align_center">Email</th>
                                        <th class="align_center">Rate</th>
                                        <th class="align_center">Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($records->count())
                                        @php $slNo =  $records->firstItem() @endphp
                                        @foreach($records as $record)
                                            @if(!empty($record->product))
                                                <tr>
                                                    <td align="center">{{ $slNo++ }}</td>
                                                    <td>{{ $record->product->product_title }}</td>
                                                    <td>{{ $record->name }}</td>
                                                    <td>{{ $record->email }}</td>
                                                    <td>{{ $record->rating?$record->rating:'NA' }}</td>
                                                    <td><?php echo nl2br($record->comment) ?></td>
                                                </tr>
                                            @endif
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
    <div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Message To Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body msg-form">

                </div>
            </div>
        </div>
    </div>
@endsection

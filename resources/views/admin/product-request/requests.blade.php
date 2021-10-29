@extends('layouts.admin.default')

@section('title',"Product Request by User")

@section('header',"Product Request by User")

@section('breadcrumb')
    @parent
    <li class="breadcrumb-item active" aria-current="page"><a href="{{route('admin.product-request')}}">Product Request</a></li>
	<li class="breadcrumb-item active" aria-current="page">Product Request by User</li>
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
                        <div style="float:right;margin: -25px 18px 15px 0px;">
                            <label style="display: block;margin-bottom: 0;">&nbsp;</label>
                            <a href="{{route('admin.all-requests.csv')}}" class="btn btn-primary mt-2"><i class="la la-file-excel-o" style="font-size:26px;"></i> Export</a>
                        </div>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="align_center">#</th>
                                        <th>@sortablelink('prod_req_number', 'Req. Ref. Number')</th>
                                        <th class="align_center">@sortablelink('name', 'Customer Name')</th>
                                        <th class="align_center">Email</th>
                                        <th class="align_center">Phone</th>
                                        <th class="align_center">Comment</th>
                                        <th class="align_center">@sortablelink('created_at', 'Date')</th>
                                        <th class="align_center">@sortablelink('product_slug', 'Product Title')</th>
                                        <th>Status</th>

                                        <th>Action</th>
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
                                                <td><?php echo nl2br($record->comments) ?></td>
                                                <td><?php echo date('d-m-Y',strtotime($record->created_at)); ?></td>
                                                <td><a href="{{route('single-product',['product'=>$record->product_slug])}}" class="a-underline" target="_blank">{{ @$record->product->product_title }}</a></td>
                                                <td>
                                                    <select class="form-control request-status" id="{{$record->id}}">
                                                        <option value="Sent" {{($record->status=='Sent')?'selected':''}}>Sent</option>
                                                        <option value="Awaiting_Response" {{($record->status=='Awaiting_Response')?'selected':''}}>Awaiting Response</option>
                                                        <option value="Pending" {{($record->status=='Pending')?'selected':''}}>Pending</option>
                                                        <option value="Completed" {{($record->status=='Completed')?'selected':''}}>Completed</option>
                                                        <option value="Canceled" {{($record->status=='Canceled')?'selected':''}}>Canceled</option>
                                                        <option value="Closed" {{($record->status=='Closed')?'selected':''}}>Closed</option>
                                                    </select>
                                                </td>
                                                <td>
                                                    <a href="javascript:void(0);" req_id="{{$record->id}}" class="btn btn-primary msg" role="button">Message</a>
                                                    <hr />
                                                    <a href="{{route('admin.invite-for-review',['id' => $record->id])}}" class="btn btn-primary link_btn" role="button">Invite For Review</a>
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
    <script>
        $('document').ready(function(){
            $(".link_btn").click(function(){
                var url= $(this).attr("href")
                $(this).attr("href","javascript:void(0);");
               $(this).css("cursor",'default');
               if(url!="javascript:void(0);"){
                window.location=url;
               }
            });
            $('body').on('change','.request-status',function(){
                var r = confirm("Are you sure?");
                if (r == true) {
                    var formData = new FormData();
                    formData.append('status', $(this).val());
                    formData.append('id', $(this).attr('id'));
                    $.ajax({
                        url : "{{route('admin.product-request.change-status')}}",
                        data : formData,
                        type : 'POST',
                        dataType:'json',
                        cache: false,
                        processData: false,
                        contentType: false,
                        success : function (response){
                            console.log(response)
                            if(response.success==false){

                            }else{
                                alertMessage(response.message, 'success');
                            }
                        },
                        beforeSend : function (response){

                        },
                        error : function (error) {
                            console.log('error',error)
                        }
                    });
                } else {
                    $(this).val($(this).find('option[selected="selected"]').val());
                }
            });
            $('body').on('click', '.msg', function(){
                $id = $(this).attr('req_id');
                var formData = new FormData();
                formData.append('id', $id);
                $.ajax({
                    url : "{{route('admin.product-request.message')}}",
                    data : formData,
                    type : 'POST',
                    dataType:'json',
                    cache: false,
                    processData: false,
                    contentType: false,
                    success : function (response){
                        console.log(response)
                        if(response.success==true){
                            $('.msg-form').html(response.html)
                            $('#message-modal').modal('show')
                        }else{
                            alertMessageBottm(response.message, 'error');
                        }
                    },
                    beforeSend : function (response){

                    },
                    error : function (error) {
                        console.log('error',error)
                    }
                });
                //$("#message-modal").modal('show')
            });
            $('body').on('submit','form#send-msg-customer',function(event){
                let formData = $(this).serialize()
                $.ajax({
                    url : "{{route('admin.product-request.sent-message')}}",
                    data : formData,
                    type : 'POST',
                    dataType:'json',
                    cache: false,
                    // processData: false,
                    // contentType: false,
                    success : function (response){
                        console.log(response)
                        if(response.success==false){
                            $('.msg-form').html(response.html)
                            $('#message-modal').modal('show')
                        }else{
                            alertMessageBottm(response.message, 'success');
                            $('#message-modal').modal('hide')
                        }
                    },
                    beforeSend : function (response){

                    },
                    error : function (error) {
                        console.log('error',error)
                    }
                });
                event.preventDefault();
            });
        });
    </script>
@endsection

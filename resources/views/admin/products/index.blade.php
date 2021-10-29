@extends('layouts.admin.default')

@section('title',"Products")

@section('header',"Manage Products")

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active" aria-current="page">Manage Products</li>
@endsection

@section('content')
<section class="page-content container-fluid">
    <div class="row">
		<div class="col-lg-12 text-right" style="line-height:0;">
			<a href="{{ route('admin.products.create') }}" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add Product </a>
		</div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body card_table_body">
					<div class="card-header">
						@include('admin.elements.search.common')
					</div>
					<div style="float:right;margin: -25px 18px 15px 0px;">
                        <label style="display: block;margin-bottom: 0;">&nbsp;</label>
                        <a href="{{route("admin.products.normal-csv")}}" class="btn btn-primary mt-2"><i class="la la-file-excel-o" style="font-size:26px;"></i>Normal Export</a>
					</div>
					<div style="float:right;margin: -25px 18px 15px 0px;">
                        <label style="display: block;margin-bottom: 0;">&nbsp;</label>
                        <a href="{{route("admin.products.image-csv")}}" class="btn btn-primary mt-2"><i class="la la-file-excel-o" style="font-size:26px;"></i>Image Export</a>
                    </div>
                    <div style="float:right;margin: -25px 18px 15px 0px;">
                        <label style="display: block;margin-bottom: 0;">&nbsp;</label>
                        <a href="{{route("admin.products.analytics.csv")}}" class="btn btn-primary mt-2"><i class="la la-file-excel-o" style="font-size:26px;"></i>Product Analytics Export</a>
                    </div>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="align_center">#</th>
									<th>@sortablelink('product_title', 'Title')</th>
									<th>@sortablelink('vendor_name', 'Vendor')</th>
									<th>@sortablelink('category_name', 'Category')</th>
									<th>@sortablelink('sub_category', 'Sub Category')</th>
                                    <th>@sortablelink('product_code', 'Product Code')</th>
                                    <th class="align_center">@sortablelink('status', 'Status')</th>
{{--                                    <th class="align_center">@sortablelink('display_product_code', 'Display Code')</th>--}}
{{--                                    <th class="align_center">@sortablelink('display_vendor', 'Display Factory')</th>--}}
{{--									<th class="align_center">@sortablelink('best_offer', 'Best Offer')</th>--}}
{{--									<th class="align_center">@sortablelink('trending_sale', 'Trending Sale')</th>--}}
                                    <th>@sortablelink('price', 'Price')</th>
                                    <th>@sortablelink('final_discount_price', 'Price After Discount')</th>
                                    <th>@sortablelink('show_price', 'Display Price')</th>
{{--									<th class="align_center">Display Price</th>--}}
									<th class="align_center">Action</th>
								</tr>
							</thead>
							<tbody>
								@if($records->count())
									@php $slNo = $records->firstItem() @endphp
									@foreach($records as $record)
										<tr>
											<td align="center">{{ $slNo++ }}</td>
											<td>{{ $record->product_title }}</td>
											<td>{{ $record->vendor->name }}</td>
											<td>{{ $record->category->name }}</td>
											<td>{{ @$record->subcategory->name }}</td>
                                            <td>{{ @$record->product_code }}</td>
                                            <td align="center" class="align_center">{!! CommonHelper::getStatusUrl('admin.products.changeStatus',$record->status,$record->id) !!}</td>
{{--											<td align="center" class="align_center">{!! CommonHelper::changeDisplayCodeStatus('admin.products.changeProductDisplayStatus',$record->display_product_code,$record->id) !!}</td>--}}
{{--											<td align="center" class="align_center">{!! CommonHelper::changeDisplayCodeStatus('admin.products.changeVendorDisplayStatus',$record->display_vendor,$record->id) !!}</td>--}}
{{--											<td align="center" class="align_center">{!! CommonHelper::changeOfferStatus('admin.products.changeOfferStatus',$record->best_offer,$record->id) !!}</td>--}}
{{--											<td align="center" class="align_center">{!! CommonHelper::changeTrendingSale('admin.products.trendingSale',$record->trending_sale,$record->id) !!}</td>--}}
											<td class="align_center">{{ number_format(@$record->price,0) }}</td>
											<td class="align_center">{{ @$record->discount_price }}</td>
                                            <td align="center" class="align_center">{!! CommonHelper::changeDisplayPrice('admin.products.displayPrice',$record->show_price,$record->id) !!}</td>
{{--											<td align="center" class="align_center">{!! CommonHelper::changeDisplayPrice('admin.products.displayPrice',$record->show_price,$record->id) !!}</td>--}}
											<td align="center">
												<a href="{{ route('admin.products.edit',$record->id) }}" class="action_btn"><i class="la la-pencil"></i> <span>Edit</span></a>
												<a href="javascript:void(0);" class="action_btn confirmDelete" data-action="{{ route('admin.products.destroy',$record->id) }}"><i class="la la-trash"></i> <span>Delete</span></a>
                                                <a href="{{ route('admin.products.export_one',$record->id) }}" class="action_btn"><i class="la la-file-excel-o"></i> <span>Analysis Data</span></a>
                                                <a href="javascript:void(0);"id="{{$record->id}}" class="action_btn image_order_btn"><i class="la la-sort-numeric-asc"></i> <span>Image Order</span></a>
                                            </td>
										</tr>
									@endforeach
								@else
								<tr>
									<td class="text-center" colspan="10">No Record Found!</td>
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
<div class="modal fade bd-example-modal-lg" id="image_modal"tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" >
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">Image Reorder and Make featured</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" id="modal_content" style="min-height: 200px;">
            </div>
        </div>
    </div>
</div>
    <script>
        $(document).ready(function(){
            $(".image_order_btn").click(function(){
                $("#image_modal").modal("show");
                $("#modal_content").html(' <div id="loader"></div>');
                var id=$(this).attr("id");
                $.ajax({
                    {{--url: "{{route('admin.products.image.reorder')}}",--}}
                    url: "{{ route('admin.products.get_images') }}",
                    data: {'id':id},
                    method:"get"
                }).done(function(response) {
                    console.log(response);
                    $("#modal_content").html(response.modal_content);
                    $("#loader").hide();
                    $("#image_modal").modal("show");
                    $( this ).addClass("done");
                });
            });

        });
    </script>
@endsection

@php
// $middle_banner=App\Models\Banner::getMiddleBanner();
// $bottom_banner=App\Models\Banner::getBottomBanner();
// $advertisements=App\Models\Advertisement::getAdvertisements();
// $trending_categories = \App\Models\Category::getTrendingCategoryList();
// $offer_categories = \App\Models\Category::getOffersCategoryList();
// $clientCategory = App\Models\ClientCategory::getActiveFeaturedClientCategoryList();
@endphp
@extends('layouts.default')
@section('title', __("content.home"))
@section('title', 'Page Title')
@section('content')
    <!-- home banner -->
  <section class="p-0">
    <div class="banner inner-banner">
      <div class="banner-wrap">
        <div class="container sml-container">
          <div class="row">
            <div class="col-lg-12">
              <!-- banner text -->
              <div class="banner-text">
                <h2>Awards</h2>
              </div>
              <!-- banner text end -->
            </div>
          </div>
        </div>
      </div>
      <img class="banner-bg" src="{{ asset('image/inner-bg.png') }}" alt="banner">
    </div>
  </section>
    <!-- home banner end -->

<!--a href="{{ url('services/create') }}">Add serviuces </a-->

 <section class="sidebar_with_container">
        <div class="container sml-container">
            <div class="row">
                @include("elements.layout.sidebar")
                <div class="col-lg-10 col-md-12">
                    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body card_table_body">
					<div class="card-header">
						<div class="col-lg-6">	
											<form action="{{URL('awards')}}" method="GET">
												<div class="form-group">
													<div class="input-group mb-3">
															<input type="text" class="form-control" placeholder="Search by name" name="search" value="{{ Request::get('search') }}">
															<div class="input-group-append">
																<input type="submit" class="form-control" value="Search">
															</div>
													</div>
												</div>
											</form>
									</div>
					</div>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="align_center">#</th>
									<th>@sortablelink('name', 'Title')</th>
									<th>Image</th>
									<th>Description</th>
									<th>Created Date</th>
									<th class="align_center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php //print_r($records); die;?>
								@if($records->count())
									@php $slNo =  1; @endphp
									@foreach($records as $record)
										<tr>
											<td align="center">{{ $slNo++ }}</td>
											<td>{{ $record->name }}</td>
											<td><img src="{{asset('awards/'.$record->image) }}" style="width: 95px;"></td>
											<td>{{substr($record->description,0,50) }}</td>
											<td>@php $date=strtotime($record->created_at); @endphp {{ date('d-M-Y',$date)}}</td>
								
											<td align="center">
												<a href="#" class="border-btn open-Addview" class="action_btn"  data-name="{{$record->name}}"  data-description="{{$record->description}}" data-image="{{$record->image}}"  data-toggle="modal" data-target="#make_offer_model1"><i class="icofont-eye" data-toggle="tooltip" data-placement="top" title="View" style="font-size: 20px;"></i></a>
												<a href="{{URL('awards/edit/'.$record->id)}}" class="action_btn"><i class="icofont-edit" data-toggle="tooltip" data-placement="top" title="Edit" style="font-size: 17px;"></i></a>
												<a href="javascript:void(0);" class="action_btn confirmDelete" data-action="{{ route('awards.delete',$record->id) }}"><i class="icofont-delete" data-toggle="tooltip" data-placement="top" title="Delete" style="font-size: 17px;"></i></a>
										
										</td>
										</tr>
									@endforeach
								@else
								<tr>
									<td class="text-center" colspan="5">No Record Found!</td>
								</tr>
								@endif
							</tbody>
						</table>
					</div>
					 @if(!empty($records->links()))
		<div class="align-bottom" style="margin-left: 482px;">

				<div class="dataTables_paginate paging_simple_numbers" id="bs4-table_paginate">
					<ul class="pagination">
						<li class="paginate_button page-item">{{ $records->links() }}</li>
					</ul>
				</div>
		</div>
		@endif
				</div>
            </div>
        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>

    </section>
     <!-- Modal -->
<div class="modal fade" id="make_offer_model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Details</h5>
      
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
     
    </div>
    <div class="modal-body">
    	<div class="price-input mt-2">
       <label><b>Image</b></label>
        <p>
            <img src="" id="viewimage" style="width: 179px;">
        </p>
    
      </div>
      <div class="price-input">
       <label><b>Title</b></label>
        <p id="viewname"></p>
    
      </div>
      
      <div class="price-input mt-2">
       <label><b>Description</b></label>
        <p id="viewdescription"></p>
    
      </div>
    </div>
   </div>
  </div>
  </div>
  <!-- Modal -->

  <script>

    	$(document).on("click", ".open-Addview", function () {

     var myBookId = $(this).data('name');
     document.getElementById("viewname").innerHTML= myBookId;
      var Image = $(this).data('image');
      
      $('#viewimage').attr('src','awards/'+Image);
     var myBookId1 = $(this).data('description');
     document.getElementById("viewdescription").innerHTML= myBookId1;
    });
    </script>

    <script>

    $(document).on('click','.confirmDelete',function(e){
    	var checkstr =  confirm('are you sure you want to delete this?');

		e.preventDefault();
		var href = $(this).attr('data-action');
		
		if(checkstr==true){
			window.location.href = href;
		}
		
	});
    </script>

  



@endsection

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
                <h2>Gallery</h2>
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
											<form action="{{URL('gallery')}}" method="GET">
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
									<th>@sortablelink('name', 'Name')</th>
									<th>Image</th>
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
											<td><img src="{{asset($record->imageurl) }}" style="width: 95px;"></td>
											
											<td>@php $date=strtotime($record->created_at); @endphp {{ date('d-M-Y',$date)}}</td>
								
											<td align="center">
												<a href="{{URL('gallery/edit/'.$record->id)}}" class="action_btn"><i class="icofont-edit" style="font-size: 17px;"></i></a>
												<!--a href="{{URL('services/delete/'.$record->id)}}" class="action_btn"><i class="la la-pencil"></i> Delete</a-->
												<a href="javascript:void(0);" class="action_btn confirmDelete" data-action="{{ route('gallery.delete',$record->id) }}"><i class="icofont-delete" style="font-size: 17px;"></i></a>
										
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

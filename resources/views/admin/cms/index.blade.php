@extends('layouts.admin.default')

@section('title',"CMS")

@section('header',"Manage CMS")

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active" aria-current="page">Manage CMS</li>
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha256-P8k8w/LewmGk29Zwz89HahX3Wda5Bm8wu2XkCC0DL9s=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js" integrity="sha256-yDarFEUo87Z0i7SaC6b70xGAKCghhWYAZ/3p+89o4lE=" crossorigin="anonymous"></script>
<section class="page-content container-fluid">
    <div class="row">
        <div class="col-lg-12 text-right" style="line-height:0;">
            <a href="{{ route('admin.cms.create') }}" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add CMS Page </a>
        </div>
{{--		<div class="col-lg-12 text-right" style="line-height:0;">--}}
{{--			<a href="{{ route('admin.banners.create') }}" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add CMS </a>--}}
{{--		</div>--}}
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
                                <th>#</th>
                                <th>@sortablelink('page_name', 'Page Name')</th>
                                <th>@sortablelink('url', 'URL')</th>
                                <th>@sortablelink('title', 'Title')</th>
                                <th class="align_center">@sortablelink('status', 'Status')</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if($records->count())
                                @php $slNo =  $records->firstItem() @endphp
                                @foreach($records as $record)
                                    <tr>
                                        <td align="center">{{ $slNo++ }}</td>
                                        <td>{{ $record->page_name }}</td>
                                        <td><a href="{{ url("/".$record->url) }}" target="_blank">{{  url("/".$record->url) }} </a></td>
                                        <td>{{ $record->title }}</td>
                                        <td align="center" class="align_center">{!! CommonHelper::getStatusUrl('admin.cms.changeStatus',$record->status,$record->id) !!}</td>
                                        <td>
                                            <a href="{{ route('admin.cms.edit',$record->id) }}" class="action_btn"><i class="la la-pencil"></i> <span>Edit</span></a>
                                            @if(CommonHelper::isEditable($record->page_name))
                                                <a href="javascript:void(0);" class="action_btn confirmDelete" data-action="{{ route('admin.cms.destroy',$record->id) }}"><i class="la la-trash"></i> <span>Delete</span></a>
                                            @endif
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

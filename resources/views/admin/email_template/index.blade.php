@extends('layouts.admin.default')

@section('title',"Email Template")

@section('header',"Manage Email Template")

@section('breadcrumb')
	@parent
	<li class="breadcrumb-item active" aria-current="page">Manage Email Template</li>
@endsection

@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha256-P8k8w/LewmGk29Zwz89HahX3Wda5Bm8wu2XkCC0DL9s=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js" integrity="sha256-yDarFEUo87Z0i7SaC6b70xGAKCghhWYAZ/3p+89o4lE=" crossorigin="anonymous"></script>
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
                                <th>#</th>
                                <th>@sortablelink('page_name', 'Page Name')</th>
                                <th>@sortablelink('title', 'Title')</th>
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
                                        <td>{{ $record->title }}</td>
                                        <td>
                                            <a href="{{ route('admin.email-template.edit',$record->id) }}" class="action_btn"><i class="la la-pencil"></i> <span>Edit</span></a>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td class="text-center" colspan="4">No Record Found!</td>
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

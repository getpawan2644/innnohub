<div class="row mt-3">
	<div class="col-sm-12 col-md-6 pl-4 text-left">
		<div class="dataTables_info" id="bs4-table_info" role="status" aria-live="polite">
			{{ $records->onEachSide(1)->appends($_GET)->links('vendor.pagination.bootstrap-4') }}
		</div>
	</div>
	<div class="col-sm-12 col-md-6 text-right">
		<div class="dataTables_paginate paging_simple_numbers" id="bs4-table_paginate">
            {{__("content.pagination_text",["current_page"=>$records->currentPage(),"total_page"=>$records->lastPage(),"records"=>$records->count(),"total_records"=>$records->total()])}}
        </div>
    </div>
</div>

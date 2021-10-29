<div class="row">
	<div class="col-sm-12 col-md-5 pl-4">
		<div class="dataTables_info" id="bs4-table_info" role="status" aria-live="polite">
			Page {{ $records->currentPage() }} of {{ $records->lastPage() }}, showing {{ $records->count() }} record(s) out of {{ $records->total() }} total 
		</div>
	</div>
	<div class="col-sm-12 col-md-7">
		<div class="dataTables_paginate paging_simple_numbers float-right" id="bs4-table_paginate">
			{!! $records->appends(Request::except('page'))->links() !!}
		</div>
	</div>
</div>
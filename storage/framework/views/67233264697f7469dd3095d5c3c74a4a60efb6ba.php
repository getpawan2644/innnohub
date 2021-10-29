<div class="row">
	<div class="col-sm-12 col-md-5 pl-4">
		<div class="dataTables_info" id="bs4-table_info" role="status" aria-live="polite">
			Page <?php echo e($records->currentPage()); ?> of <?php echo e($records->lastPage()); ?>, showing <?php echo e($records->count()); ?> record(s) out of <?php echo e($records->total()); ?> total 
		</div>
	</div>
	<div class="col-sm-12 col-md-7">
		<div class="dataTables_paginate paging_simple_numbers float-right" id="bs4-table_paginate">
			<?php echo $records->appends(Request::except('page'))->links(); ?>

		</div>
	</div>
</div><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/elements/pagination/common.blade.php ENDPATH**/ ?>
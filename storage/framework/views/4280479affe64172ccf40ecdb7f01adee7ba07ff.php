<form method="get" action="<?php echo e(url()->current()); ?>" id="AjaxSearch">
	<?php $__env->startSection('search'); ?>
	<div class="row">
		<div class="col-md-12">
			<div class="row search_box align-items-center">
				<div class="col-sm-12 col-md-3 limit_box">
					<label>
						Show
							<select id="LimitOptions" name="limit" class="form-control form-control-sm">
								<?php $options = CommonHelper::getLimitOption(); ?>
								<?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
									<option <?php echo e(request('limit',env('PAGINATION_LIMIT')) == $value ? 'selected' : ''); ?> value="<?php echo e($value); ?>"  ><?php echo e($value); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
						Entries
					</label>
				</div>
				<div class="col-sm-12 col-md-6 offset-md-3 float-right">
					<div class="input-group">
						<input class="form-control" name="search" value="<?php echo e(request('search')); ?>" type="text" placeholder="Search...">
						<div class="input-group-append">
							<button type="submit" class="btn btn-primary" type="button">Search</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php echo $__env->yieldSection(); ?>
</form><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/elements/search/common.blade.php ENDPATH**/ ?>
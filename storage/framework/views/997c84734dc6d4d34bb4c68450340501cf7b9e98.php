<?php $__env->startSection('title',"Countries"); ?>

<?php $__env->startSection('header',"Manage Countries"); ?>

<?php $__env->startSection('breadcrumb'); ?>
	##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
	<li class="breadcrumb-item active" aria-current="page">Manage Country</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<section class="page-content container-fluid">
    <div class="row">
		<div class="col-lg-12 text-right" style="line-height:0;">
			<a href="<?php echo e(route('admin.countries.create')); ?>" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add Country </a>
		</div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body card_table_body">
					<div class="card-header">
						<?php echo $__env->make('admin.elements.search.common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
                    <div style="float:right;margin: -25px 18px 15px 0px;">
                        <label style="display: block;margin-bottom: 0;">&nbsp;</label>
                        <a href="<?php echo e(route("admin.countries.csv")); ?>" class="btn btn-primary mt-2"><i class="la la-file-excel-o" style="font-size:26px;"></i>Export</a>
                    </div>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th class="align_center">#</th>
									<th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', 'Country Name'));?></th>
									<!-- <th class="align_center"> -->
									<th class="align_center"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('code', 'Country Code'));?></th>
									<th class="align_center"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('status', 'Status'));?></th>
									<th class="align_center">Action</th>
								</tr>
							</thead>
							<tbody>
								<?php if($records->count()): ?>
									<?php $slNo =  $records->firstItem() ?>
									<?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<tr>
											<td align="center"><?php echo e($slNo++); ?></td>
											<td><?php echo e($record->name); ?></td>
											<td><?php echo e($record->code); ?></td>
											<td align="center" class="align_center"><?php echo CommonHelper::getStatusUrl('admin.countries.changeStatus',$record->status,$record->id); ?></td>
											<td align="center">
												<a href="<?php echo e(route('admin.countries.edit',$record->id)); ?>" class="action_btn"><i class="la la-pencil"></i> <span>Edit</span></a>
												<a href="javascript:void(0);" class="action_btn confirmDelete" data-action="<?php echo e(route('admin.countries.destroy',$record->id)); ?>"><i class="la la-trash"></i> <span>Delete</span></a>
											</td>
										</tr>
									<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
								<?php else: ?>
								<tr>
									<td class="text-center" colspan="6">No Record Found!</td>
								</tr>
								<?php endif; ?>
							</tbody>
						</table>
					</div>
					<?php echo $__env->make('admin.elements.pagination.common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
				</div>
            </div>
        </div>
    </div>
</section>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/countries/index.blade.php ENDPATH**/ ?>
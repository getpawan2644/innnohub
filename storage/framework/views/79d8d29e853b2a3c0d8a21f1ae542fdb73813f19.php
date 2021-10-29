<?php $__env->startSection('title',"Galler"); ?>

<?php $__env->startSection('header',"Manage Galler"); ?>

<?php $__env->startSection('breadcrumb'); ?>
	##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
	<li class="breadcrumb-item active" aria-current="page">Manage Gallery</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha256-P8k8w/LewmGk29Zwz89HahX3Wda5Bm8wu2XkCC0DL9s=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js" integrity="sha256-yDarFEUo87Z0i7SaC6b70xGAKCghhWYAZ/3p+89o4lE=" crossorigin="anonymous"></script>
<section class="page-content container-fluid">
    <div class="row">
		<div class="col-lg-12 text-right" style="line-height:0;">
			<a href="<?php echo e(route('admin.gallery.add',['user_id'=>$user_id])); ?>" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add Gallery </a>
		</div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body card_table_body">
					<div class="card-header">
						<?php echo $__env->make('admin.elements.search.common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
					</div>
					<div class="table-responsive">
						<table class="table">
							  <thead>
				                <tr>
				                  <th class="align_center">#</th>
				                  <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('name', 'Name'));?></th>
				                  <th>Image</th>
				                  <th>Created Date</th>
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
								              <td><img src="<?php echo e(asset($record->imageurl)); ?>" style="width: 95px;"></td>
								              
								              <td><?php $date=strtotime($record->created_at); ?> <?php echo e(date('d-M-Y',$date)); ?></td>
								        
								              <td align="center">
								                <a href="<?php echo e(route('admin.gallery.edit',['user_id'=>$user_id, 'id'=>$record->id])); ?>" class="action_btn"><i class="icofont-edit" style="font-size: 17px;"></i></a>
								                <!--a href="<?php echo e(URL('services/delete/'.$record->id)); ?>" class="action_btn"><i class="la la-pencil"></i> Delete</a-->
								                <a href="javascript:void(0);" class="action_btn confirmDelete" data-action="<?php echo e(route('admin.gallery.delete',$record->id)); ?>"><i class="icofont-delete" style="font-size: 17px;"></i></a>
								            
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
    <script type="text/javascript">
        $(document).ready(function() {
            $(".fancybox").fancybox();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/multimedia/index.blade.php ENDPATH**/ ?>
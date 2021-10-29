<?php $__env->startSection('title',"CMS"); ?>

<?php $__env->startSection('header',"Manage CMS"); ?>

<?php $__env->startSection('breadcrumb'); ?>
	##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
	<li class="breadcrumb-item active" aria-current="page">Manage CMS</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha256-P8k8w/LewmGk29Zwz89HahX3Wda5Bm8wu2XkCC0DL9s=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js" integrity="sha256-yDarFEUo87Z0i7SaC6b70xGAKCghhWYAZ/3p+89o4lE=" crossorigin="anonymous"></script>
<section class="page-content container-fluid">
    <div class="row">
        <div class="col-lg-12 text-right" style="line-height:0;">
            <a href="<?php echo e(route('admin.cms.create')); ?>" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add CMS Page </a>
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
                                <th>#</th>
                                <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('page_name', 'Page Name'));?></th>
                                <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('url', 'URL'));?></th>
                                <th><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('title', 'Title'));?></th>
                                <th class="align_center"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('status', 'Status'));?></th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php if($records->count()): ?>
                                <?php $slNo =  $records->firstItem() ?>
                                <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td align="center"><?php echo e($slNo++); ?></td>
                                        <td><?php echo e($record->page_name); ?></td>
                                        <td><a href="<?php echo e(url("/".$record->url)); ?>" target="_blank"><?php echo e(url("/".$record->url)); ?> </a></td>
                                        <td><?php echo e($record->title); ?></td>
                                        <td align="center" class="align_center"><?php echo CommonHelper::getStatusUrl('admin.cms.changeStatus',$record->status,$record->id); ?></td>
                                        <td>
                                            <a href="<?php echo e(route('admin.cms.edit',$record->id)); ?>" class="action_btn"><i class="la la-pencil"></i> <span>Edit</span></a>
                                            <?php if(CommonHelper::isEditable($record->page_name)): ?>
                                                <a href="javascript:void(0);" class="action_btn confirmDelete" data-action="<?php echo e(route('admin.cms.destroy',$record->id)); ?>"><i class="la la-trash"></i> <span>Delete</span></a>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php else: ?>
                                <tr>
                                    <td class="text-center" colspan="5">No Record Found!</td>
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

<?php echo $__env->make('layouts.admin.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/cms/index.blade.php ENDPATH**/ ?>
<?php
    use App\Models\ContactUs;
?>


<?php $__env->startSection('title',"User"); ?>
<?php $__env->startSection('header',"Manage Contact"); ?>

<?php $__env->startSection('breadcrumb'); ?>
    ##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
    <li class="breadcrumb-item active" aria-current="page">Manage User</li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-lg-12 text-right" style="line-height:0;">

            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body card_table_body">
                        <div class="card-header">
                            <?php echo $__env->make('admin.elements.search.common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        </div>

                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th style="width:300px;">Name</th>
                                    <th style="width:200px;">Email</th>
                                    <th style="width:200px;">phone</th>
                                    <th style="width:200px;">message</th>
                                    <th style="width:200px;">status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php if($records->count()): ?>
                                    <?php $slNo =  $records->firstItem() ?>
                                    <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <td align="center"><?php echo e($slNo++); ?></td>
                                        <td><?php echo e($record->name); ?></td>
                                        <td> <?php echo e($record->email); ?>  </td>
                                        <td> <?php echo e($record->mobile); ?></td>
                                        <td> <?php echo e($record->message); ?></td>
                                        <td align="center" class="align_center"><?php echo CommonHelper::getStatusUrl('admin.contacts.changeStatus',$record->status,$record->id); ?></td>
                                        <td align="center">
                                            <a href="javascript:void(0);" class="action_btn confirmDelete" data-action="<?php echo e(route('admin.contacts.destroy',$record->id)); ?>"><i class="la la-trash"></i> <span>Delete</span></a>
                                        </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <td class="text-center" colspan="7">No Record Found!</td>
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

<?php echo $__env->make('layouts.admin.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/contacts/index.blade.php ENDPATH**/ ?>
<?php $__env->startSection('title',"Manage Case Study"); ?>

<?php $__env->startSection('header',"Manage Case Study"); ?>

<?php $__env->startSection('breadcrumb'); ?>
	##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
	<li class="breadcrumb-item active" aria-current="page">Manage Manage Case Study</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.css" integrity="sha256-P8k8w/LewmGk29Zwz89HahX3Wda5Bm8wu2XkCC0DL9s=" crossorigin="anonymous" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/fancybox/3.5.7/jquery.fancybox.js" integrity="sha256-yDarFEUo87Z0i7SaC6b70xGAKCghhWYAZ/3p+89o4lE=" crossorigin="anonymous"></script>
<section class="page-content container-fluid">
    <div class="row">
		<div class="col-lg-12 text-right" style="line-height:0;">
			<a href="<?php echo e(route('admin.casestudy.add',['user_id'=>$user_id])); ?>" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add Case Study </a>
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
				                  <th>Description</th>
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
                      <td><?php echo e(substr($record->description,0,20)); ?></td>
                      
                      <td><?php $date=strtotime($record->created_at); ?> <?php echo e(date('d-M-Y',$date)); ?></td>
                
                      <td align="center">
                        <a href="#" class="border-btn open-Addview" class="action_btn"  data-name="<?php echo e($record->name); ?>"  data-description="<?php echo e($record->description); ?>"  data-toggle="modal" data-target="#make_offer_model1"><i class="icofont-eye" data-toggle="tooltip" data-placement="top" title="View" style="font-size: 20px;"></i></a>
                        <a href="<?php echo e(route('admin.casestudy.edit',['user_id'=>$user_id, 'id'=>$record->id])); ?>" class="action_btn"><i class="icofont-edit" data-toggle="tooltip" data-placement="top" title="Edit" style="font-size: 17px;"></i></a>
                        <!--a href="<?php echo e(URL('services/delete/'.$record->id)); ?>" class="action_btn"><i class="la la-pencil"></i> Delete</a-->
                        <a href="javascript:void(0);" class="action_btn confirmDelete" data-action="<?php echo e(route('admin.casestudy.delete',$record->id)); ?>"><i class="icofont-delete" data-toggle="tooltip" data-placement="top" title="Delete" style="font-size: 17px;"></i></a>
                    
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
      <!-- Modal -->
<div class="modal fade" id="make_offer_model1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-md" role="document">
    <div class="modal-content">
    <div class="modal-header">
      <h5 class="modal-title" id="exampleModalLabel">Details</h5>
      
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
     
    </div>
    <div class="modal-body">
      <div class="price-input">
       <label><b>Name</b></label>
        <p id="viewname"></p>
    
      </div>
      <div class="price-input mt-2">
       <label><b>Description</b></label>
        <p id="viewdescription"></p>
    
      </div>
    </div>
   </div>
  </div>
  </div>
  <!-- Modal -->
</section>
    <script type="text/javascript">
        $(document).ready(function() {
            $(".fancybox").fancybox();
        });
    </script>
        <script>

    	$(document).on("click", ".open-Addview", function () {

     var myBookId = $(this).data('name');
     document.getElementById("viewname").innerHTML= myBookId;
     var myBookId1 = $(this).data('description');
     document.getElementById("viewdescription").innerHTML= myBookId1;
    });
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/casestudies/index.blade.php ENDPATH**/ ?>
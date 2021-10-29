<?php
use App\Models\User;
?>



<?php $__env->startSection('title',"User"); ?>

<?php $__env->startSection('header',"Manage User"); ?>

<?php $__env->startSection('breadcrumb'); ?>
	##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
	<li class="breadcrumb-item active" aria-current="page">Manage User</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<section class="page-content container-fluid">
    <div class="row">
		<div class="col-lg-12 text-right" style="line-height:0;">
			<a href="<?php echo e(route('admin.users.create')); ?>" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add User</a>
		</div>
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body card_table_body">
                	
					<div class="card-header">
						<?php echo $__env->make('admin.elements.search.common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
						<div class="col-sm-12 col-md-3 limit_box">
						<select id="usersearch" class="form-control form-control-sm">
								<option value="all">All User</option>
								<option value="vendor" <?php echo e($search == 'vendor' ? 'selected' : ''); ?>>Vendor</option>
								<option value="buyer" <?php echo e($search == 'buyer' ? 'selected' : ''); ?>>Buyer</option>
						</select>
					</div>
					</div>
					<div style="float:right;margin: -25px 18px 15px 0px;">
                        <label style="display: block;margin-bottom: 0;">&nbsp;</label>
                        <a href="<?php echo e(route('admin.users.csv')); ?>" class="btn btn-primary mt-2"><i class="la la-file-excel-o" style="font-size:26px;"></i> Export</a>
					</div>
					<br/>
					<div class="table-responsive">
						<table class="table">
							<thead>
								<tr>
									<th>#</th>

									<th style="width:300px;"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('first_name', 'Name'));?></th>
									<th style="width:200px;"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('email', 'Email'));?></th>
									<th>Mobile</th>
									<th>User Type</th>

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
                                            <td><?php echo e($record->full_name); ?></td>
                                            <td><?php echo e($record->email); ?></td>
                                             <td><?php echo e($record->mobile); ?></td>
                                             <td><?php echo e(ucfirst($record->user_type)); ?></td>
                                           
                                            <td align="center" class="align_center"><?php echo CommonHelper::getStatusUrl('admin.users.changeStatus',$record->status,$record->id); ?></td>
                                            <td align="center">


                                                <a href="<?php echo e(route('admin.users.edit',$record->id)); ?>" class="action_btn"><i class="la la-pencil"></i> <span>Edit</span></a>
                                                <a href="javascript:void(0);" class="action_btn confirmDelete" data-action="<?php echo e(route('admin.users.destroy',$record->id)); ?>"><i class="la la-trash"></i> <span>Delete</span></a>
                                                <a href="<?php echo e(route('admin.users.reset_link',$record->id)); ?>" class="action_btn"><i class="la la-mail-forward"></i> <span>Reset Password</span></a>
                                               <?php if($record->user_type == 'vendor'): ?>
                                                 <a  href="<?php echo e(route('admin.service-list',$record->id)); ?>"class="action_btn"><i class="la la-list"></i><span>Service List </span></a>
                                                 <a  href="<?php echo e(route('admin.gallery.index',$record->id)); ?>"class="action_btn"><i class="la la-list"></i><span>Gallery List </span></a>
                                                 <a  href="<?php echo e(route('admin.casestudy.index',$record->id)); ?>"class="action_btn"><i class="la la-list"></i><span>Case Studies List  </span></a>
                                                 <a  href="<?php echo e(route('admin.testimonials.index',$record->id)); ?>"class="action_btn"><i class="la la-list"></i><span>CTestimonials </span></a>
                                                 <a  href="<?php echo e(route('admin.awards.index',$record->id)); ?>"class="action_btn"><i class="la la-list"></i><span>Awards </span></a>
                                                 <a  href="<?php echo e(route('admin.features.index',$record->id)); ?>"class="action_btn"><i class="la la-list"></i><span>Features </span></a>
                                                 <?php endif; ?>
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

<!-- <div class="loader-bg" id="loader">
				<div class="loader"></div>
			</div>
 -->

<div class="modal fade" id="yourModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      	<div class="loader-bg" id="loader">
			<div class="loader"></div>
		</div>

		<div class="modal-header"><h4 class="modal-title" id="title"></h4>
		<button type="button" class="close" data-dismiss="modal">&times;</button>
		</div>

		<div class="modal-body">


		</div>

	    <div class="modal-footer">
	        <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
	    </div>
    </div>
  </div>
</div>
<div class="modal fade" id="message-modal" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLongTitle">Message To Customer</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body msg-form">

			</div>
		</div>
	</div>
</div>
<script>



      $('body').on('click', '.msg', function(){
		$id = $(this).attr('req_id');
		var formData = new FormData();
		formData.append('id', $id);
		$.ajax({
			url : "<?php echo e(route('admin.user.message')); ?>",
			data : formData,
			type : 'POST',
			dataType:'json',
			cache: false,
			processData: false,
			contentType: false,
			success : function (response){
				console.log(response)
				if(response.success==true){
					$('.msg-form').html(response.html)
					$('#message-modal').modal('show')
				}else{
					alertMessageBottm(response.message, 'error');
				}
			},
			beforeSend : function (response){

			},
			error : function (error) {
				console.log('error',error)
			}
		});
		//$("#message-modal").modal('show')
	});
	$('body').on('submit','form#send-msg-customer',function(event){
		let formData = $(this).serialize()
		$.ajax({
			url : "<?php echo e(route('admin.user.sent-message')); ?>",
			data : formData,
			type : 'POST',
			dataType:'json',
			cache: false,
			// processData: false,
			// contentType: false,
			success : function (response){
				console.log(response)
				if(response.success==false){
					$('.msg-form').html(response.html)
					$('#message-modal').modal('show')
				}else{
					alertMessageBottm(response.message, 'success');
					$('#message-modal').modal('hide')
				}
			},
			beforeSend : function (response){

			},
			error : function (error) {
				console.log('error',error)
			}
		});
		event.preventDefault();
	});
</script>
<script>
	$('.modal-body').empty();
	$('#loader').hide();
	function viewUserModal(id){
		$('#loader').show();

    	var form_data = new FormData();
		form_data.append('id',id);
		form_data.append('_token', '<?php echo e(csrf_token()); ?>');

		$('#title').empty();
		$('.modal-body').empty();

		$.ajax({
            url: "<?php echo e(route('admin.users.show')); ?>",
            data: form_data,
			type: 'POST',
            dataType: "json",
            contentType: false,
			processData: false,
            success:function(data) {
            	console.log(data);
            	$('#loader').hide();
            	$('#title').html(data.type+' Details');
            	$('.modal-body').html(data.modal_content);

       		}

        });
	};

</script>


<script>
	$('.modal-body').empty();
	$('#loader').hide();
	function viewCompanyModal(id){
		$('#loader').show();

    	var form_data = new FormData();
		form_data.append('id',id);
		form_data.append('_token', '<?php echo e(csrf_token()); ?>');

		$('#title').empty();
		$('.modal-body').empty();


	};

	$('#usersearch').on('change', function() {
		 var user =this.value;
		 var limit = $('#LimitOptions').val();
		if(user == 'vendor' || user == 'buyer'){ 
	     window.location.href = '?limit='+limit+'&search='+user
	    }else{
	    	window.location.href = "<?php echo e(route('admin.users.index')); ?>";
	    }
       });



</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/users/index.blade.php ENDPATH**/ ?>
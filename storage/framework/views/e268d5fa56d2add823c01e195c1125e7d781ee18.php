<?php
use App\Models\User;
?>



<?php $__env->startSection('title',"User"); ?>

<?php $__env->startSection('header',"Manage Services"); ?>

<?php $__env->startSection('breadcrumb'); ?>
	##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
	<li class="breadcrumb-item active" aria-current="page">Manage Services</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>


<section class="page-content container-fluid">
    <div class="row">
		<div class="col-lg-12 text-right" style="line-height:0;">
			<a href="<?php echo e(route('admin.service-add',['user_id'=>$user_id,'service'=>$service])); ?>" class="btn btn-primary add_btn_top" style="margin-top:-85px">Add Service</a>
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
									<th style="width:200px;"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('service_name', 'Service Name'));?></th>
									<th style="width:200px;"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('description', 'Description'));?></th>
									<th style="width:200px;"><?php echo \Kyslik\ColumnSortable\SortableLink::render(array ('created_at', 'Create Date'));?></th>

									<th>Action</th>
									
								</tr>
							</thead>
                            <tbody>
                             
                                <?php if($records->count()): ?>
                                    <?php $slNo =  $records->firstItem() ?>
                                    <?php $__currentLoopData = $records; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $record): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td align="center"><?php echo e($slNo++); ?></td>
                                            <td><?php echo e($record->userData['first_name']); ?></td>
                                            <td><?php echo e($record->userData['email']); ?></td>
                                            <td><?php echo e($record->service_name); ?></td>
                                            <td><?php echo e(substr($record->description,0,50)); ?></td>
											<td><?php $date=strtotime($record->created_at); ?> <?php echo e(date('d-M-Y',$date)); ?></td>
								
                                            <td align="center">

                                               
                                                <a href="<?php echo e(route('admin.service-edit',['user_id'=>$user_id, 'id'=>$record->id, 'service'=>$service])); ?>" class="action_btn"><i class="la la-pencil"></i> <span>Edit</span></a>


                                                <a href="javascript:void(0);" class="action_btn confirmDelete" data-action="<?php echo e(route('admin.service-destroy',$record->id)); ?>"><i class="la la-trash"></i> <span>Delete</span></a>
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


</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/services/index.blade.php ENDPATH**/ ?>
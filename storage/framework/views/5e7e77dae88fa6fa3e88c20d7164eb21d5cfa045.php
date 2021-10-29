<?php
    use App\Models\Banner as Banner;
?>


<?php $__env->startSection('title',"Edit Awards"); ?>

<?php $__env->startSection('header',"Edit Awards"); ?>

<?php $__env->startSection('breadcrumb'); ?>
    ##parent-placeholder-6e5ce570b4af9c70279294e1a958333ab1037c86##
    <li class="breadcrumb-item"><a href="<?php echo e(route('admin.awards.index',$user->id)); ?>">Manage Awards</a></li>
    <li class="breadcrumb-item active" aria-current="page">Edit Awards</li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script>
        var options = {
            filebrowserImageBrowseUrl: APP_URL+'admin/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: APP_URL+'admin/laravel-filemanager/upload?type=Images&_token=<?php echo e(csrf_token()); ?>',
            filebrowserBrowseUrl: APP_URL+'admin/laravel-filemanager?type=Files',
            filebrowserUploadUrl: APP_URL+'admin/laravel-filemanager/upload?type=Files&_token=<?php echo e(csrf_token()); ?>',
            autoParagraph :false,
            language: 'en'
        };
    </script>
    <link rel="stylesheet" href="<?php echo e(asset('css/themify-icons.css')); ?>">
    <section class="page-content container-fluid">
        <div class="row">
            <div class="col-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <form class="forms-sample" method="POST" action="<?php echo e(route('admin.awards.update',$record->id)); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            

                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="form-group">
                                        <?php $alluser = CommonHelper::getAllUser(); ?>
                                       
                                        <label class="control-label">User</label>
                                        <input type="hidden" name="user_id" value="<?php echo e($user->id); ?>" />
                                        <input type="text" class="form-control" name="user_name" value="<?php echo e($user->fullname); ?>" />
                                        <?php if($errors->has('user_id')): ?>
                                            <span class="error-message">
                                                <strong><?php echo e($errors->first('user_id')); ?></strong>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                            
                                                                <label class="control-label float-left">Name</label>
                                                                <input type="hidden" class="form-control" name="user_id" value='<?php echo e(old('user_id',$data->user_id)); ?>'>
                                                               
                                                                <input type="text" class="form-control" name="name" placeholder="Name" value='<?php echo e(old('service_name',$data->name)); ?>'>
                                                               
                                                               <?php if($errors->has('name')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('name')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                            
                                                        </div>
                                                       
                                    <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                        <input type="hidden"  id="logo" name="image" value="<?php echo e($data->image); ?>">
                                                                <label class="control-label float-left">Upload Image</label></br>
                                                                
                                                                 <input type="file" class="form-control" name="logo" class="form-control" id="fileImage" accept="image/*" capture>
                                                                   
                                                                <?php if($errors->has('image')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('image')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                        </div>
                                   <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                           
                                                                <label class="control-label float-left"><?php echo e(__("form.service_description")); ?></label>
                                                                <textarea class="form-control"  rows="5" name="description"><?php echo e(old('description',$data->description)); ?></textarea>
                                                                    <?php if($errors->has('description')): ?>
                                                                    <span class="error-message float-left">
                                                                        <strong><?php echo e($errors->first('description')); ?></strong>
                                                                    </span>
                                                                <?php endif; ?>
                                                         
                                                        </div>
                                                        <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12 mt-3">
                                                            <img id="blah" src="<?php echo e(asset('awards/'.$data->image)); ?>" alt="your image"style="width: 112px;"/>
                                                                
                                                         
                                                        </div>
                                                       
         
                            <button type="submit" class="btn btn-primary mr-2 mt-4">Update</button>
                            <a href="<?php echo e(route('admin.awards.index',$user->id)); ?>" class="btn btn-accent btn-outline mt-4">Cancel</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        $(document).ready(function(){
            $('.banner_position').attr("style", "pointer-events: none;");
            $(".banner_position").change(function () {
                if($(this).val()!="<?php echo e(Banner::TOP_BANNER); ?>"){
                    $(".top_banner").hide();
                    $(".top_banner").addClass("hide");
                }else{
                    $(".top_banner").show();
                    $(".top_banner").removeClass("hide");
                };
            });
            $(".have_button").change(function () {
                if($(this).is(":checked")){
                    $(".button_checked").show();
                    $(".button_checked").removeClass("hide");
                }else{
                    $(".button_checked").hide();
                    $(".button_checked").addClass("hide");
                };
            });
        });
    </script>



<

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.default', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/awards/edit.blade.php ENDPATH**/ ?>
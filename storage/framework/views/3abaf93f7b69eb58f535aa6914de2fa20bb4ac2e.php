<?php $__env->startSection('title',"Admin Login"); ?>
<?php $__env->startSection('content'); ?>

<form method="POST" class="sign-in-form" class="sign-in-form" action="<?php echo e(route('admin.login')); ?>">
	 <?php echo csrf_field(); ?>
	<div class="card">
		<div class="card-body">
			<a href="javascript:void(0);" class="brand text-center d-block m-b-20">
				<img src="<?php echo e(asset('img/admin/logo2x.png')); ?>" />
			</a>
			<h5 class="sign-in-heading text-center m-b-20">Sign in to your account</h5>
			<div class="form-group">
				<label for="inputEmail" class="sr-only">Email address</label>
				<input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Email address">
				<?php if($errors->has('email')): ?>
					 <span class="error-message">
						<strong><?php echo e($errors->first('email')); ?></strong>
					</span>
				<?php endif; ?>
			</div>

			<div class="form-group">
				<label for="inputPassword" class="sr-only">Password</label>
				<input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
				<?php if($errors->has('password')): ?>
					<span class="error-message">
						<strong><?php echo e($errors->first('password')); ?></strong>
					</span>
				<?php endif; ?>
			</div>

			<div class="checkbox m-b-10 m-t-20">
				<div class="custom-control custom-checkbox checkbox-primary form-check">
					<input type="checkbox" name="remember" id="remember" <?php echo e(old('remember') ? 'checked' : ''); ?> class="custom-control-input">
					<label class="custom-control-label" for="remember">	Remember me</label>
				</div>
				<?php if(Route::has('admin.password.request')): ?>
					<a href="<?php echo e(route('admin.password.request')); ?>" class="float-right">Forgot Password?</a>
				<?php endif; ?>
			</div>
			<button class="btn btn-primary btn-rounded btn-floating btn-lg btn-block" type="submit">Sign In</button>
		</div>
	</div>
</form>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin.app', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\xampp 2\htdocs\innohub\resources\views/admin/auth/login.blade.php ENDPATH**/ ?>
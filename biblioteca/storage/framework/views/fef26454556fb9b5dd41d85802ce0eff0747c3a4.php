<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<ol class="breadcrumb panel-heading">
					<li><a href="<?php echo e(route('lending.index')); ?>">Empréstimos</a></li>
					<li class="active">Adicionar</li>
				</ol>
				<div class="panel-body">
					<form action="<?php echo e(route('lending.save')); ?>" method="POST" enctype="multipart/form-data">
						<?php echo e(csrf_field()); ?>

                        <?php if(auth()->guard()->guest()): ?>
                        <?php else: ?>
                        	<?php if(Auth::user()->role==1000): ?>
								<div class="form-group">
									<label for="user">Usuário</label>
									<select name="user" class="form-control selectpicker" data-live-search="true" title="Usuarios">
										<?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
										<option value="<?php echo e($user->id); ?>"><?php echo e($user->name); ?></option>
										<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
									</select>
									<p class="help-block">Use Ctrl para selecionar.</p>	
								</div>
							<?php endif; ?>
						<?php endif; ?>

						<div class="form-group">
							<label for="books">Livros</label>
							<select name="book[]" class="form-control selectpicker" multiple="" data-live-search="true" title="Escolha os livros">
								<?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<option value="<?php echo e($book->id); ?>"><?php echo e($book->title); ?></option>
								<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
							</select>
							<p class="help-block">Use Ctrl para selecionar.</p>	
						</div>						
						<br />
						<button type="submit" class="btn btn-primary">Salvar</button>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
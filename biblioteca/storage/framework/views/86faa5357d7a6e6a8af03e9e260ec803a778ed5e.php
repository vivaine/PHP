<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<ol class="breadcrumb panel-heading">
					<li class="active">Empréstimos</li>
				</ol>
				<div class="panel-body">
					<form class="form-inline" action="<?php echo e(route('lending.search')); ?>" method="POST">
						<?php echo e(csrf_field()); ?>

						<input type="hidden" name="_method" value="put">
						<div class="form-group" style="float: right;">
							<p>
								<a href="<?php echo e(route('lending.add')); ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-plus"></i>Adicionar</a>
							</p>
						</div>

					</form>
					<br>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Usuário</th>
								<th>Data início</th>
								<th>Data Fim</th>
								<th>Data devolução</th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $lendings; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $lending): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
							<?php
							    $dstart = date("d/m/Y", strtotime($lending->date_start));
							    $dend = date("d/m/Y", strtotime($lending->date_end));
							    if(!empty($lending->date_finish)) {
                                    $dfinish = date("d/m/Y", strtotime($lending->date_finish));
							    }
							    else {
							    	$dfinish = "";
							    }

							?>
								<tr>
									<th scope="row" class="text-center"><?php echo e($lending->user->name); ?></th>
									<td><?php echo e($dstart); ?></td>
									<td><?php echo e($dend); ?></td>
									<td><?php echo e($dfinish); ?></td>
									
									<td width="155" class="text-center">
										<?php
										  if(empty($lending->date_finish)){ 
										?>
											<a href="<?php echo e(route('lending.giveBack', $lending->id)); ?>" class="btn btn-warning">Devolver</a>
										<?php }
                                        ?>
									</td>
								</tr>
							<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
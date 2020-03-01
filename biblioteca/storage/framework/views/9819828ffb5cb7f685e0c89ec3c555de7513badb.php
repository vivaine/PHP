<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<ol class="breadcrumb panel-heading">
					<li class="active">Livros</li>
				</ol>
				<div class="panel-body">
					<form class="form-inline" action="<?php echo e(route('book.search')); ?>" method="POST">
						<?php echo e(csrf_field()); ?>

						<input type="hidden" name="_method" value="put">
						<div class="form-group" style="float: right;">
							<p>
								<a href="<?php echo e(route('book.add')); ?>" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-plus"></i> Adicionar</a>
							</p>
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="title" name="title" placeholder="Livro">
						</div>
						<div class="form-group" style="width: 200px; max-width: 200px;">
							<select name="author[]" class="form-control selectpicker" multiple="" data-live-search="true" title="Autores">
								<?php
								if(!empty($authors)){
									foreach($authors as $author){ ?>
									<option value="<?= $author->id ?>" <?= in_array($author->id, $selected_aut) ? "selected" : NULL ; ?>><?= $author->name . ' ' . $author->surname ?></option>
									<?php }
								} ?>
							</select>
						</div>
						<button type="submit" clas="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
					</form>
					<br>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>Código</th>
								<th>Título</th>
								<th>Descrição</th>
								<th width="20">Imagem</th>
								<th>Ação</th>
							</tr>
						</thead>
						<tbody>
							<?php $__currentLoopData = $books; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $book): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
								<tr>
									<th scope="row" class="text-center"><?php echo e($book->id); ?></th>
									<td><?php echo e($book->title); ?></td>
									<td class="text-justify"><?php echo e($book->description); ?></td>
                                    <td class="center">
                                        <img src="/images/book/<?php echo e($book->image); ?>"  width="100%" />
                                    </td>									
									<td width="155" class="text-center">
										<a href="<?php echo e(route('book.edit', $book->id)); ?>" class="btn btn-default">
											<i class="glyphicon glyphicon-pencil"></i>
										</a>
										<a href="<?php echo e(route('book.delete', $book->id)); ?>" class="btn btn-danger">
											<i class="glyphicon glyphicon-trash"></i>
										</a>
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
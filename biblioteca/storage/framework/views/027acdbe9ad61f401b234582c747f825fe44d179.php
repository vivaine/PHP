<?php $__env->startSection('content'); ?>
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<ol class="breadcrumb panel-heading">
					<li><a href="<?php echo e(route('book.index')); ?>">Livros</a></li>
					<li class="active">Editar</li>
				</ol>
				<div class="panel-body">
					<form action="<?php echo e(route('book.update', $book->id)); ?>" method="POST" enctype="multpart/form-data">
						<?php echo e(csrf_field()); ?>

						<div class="form-group">
							<label for="title">Título</label>
							<input type="text" class="form-control" name="title" id="title" placeholder="Título" value="<?php echo e($book->title); ?>">
						</div>
						<div class="form-group">
							<label for="title">Autores</label>
							<select name="author[]" class="form-control selectpicker" multiple="" data-live-search="true" title="Autores">
								<?php foreach ($authors as $author){ ?> 
									<option value="<?= $author->id ?>" <?= in_array($author->id, $selected_aut) ? "selected" : NULL ; ?>><?= $author->name . ' ' . $author->surname ?>
								    </option>
								<?php } ?>
							</select>
							<p class="help-block">Use Ctrl para selecionar.</p>
						</div>
						<div class="form-group">
							<label for="description">Descrição</label>
							<textarea class="form-control" rows="3" name="description" id="description">
								<?php echo e($book->description); ?>

							</textarea>
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
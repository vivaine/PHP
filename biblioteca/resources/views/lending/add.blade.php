@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<ol class="breadcrumb panel-heading">
					<li><a href="{{route('lending.index') }}">Empréstimos</a></li>
					<li class="active">Adicionar</li>
				</ol>
				<div class="panel-body">
					<form action="{{route('lending.save') }}" method="POST" enctype="multipart/form-data">
						{{csrf_field() }}
                        @guest
                        @else
                        	@if(Auth::user()->role==1000)
								<div class="form-group">
									<label for="user">Usuário</label>
									<select name="user" class="form-control selectpicker" data-live-search="true" title="Usuarios">
										@foreach($users as $user)
										<option value="{{ $user->id }}">{{$user->name }}</option>
										@endforeach()
									</select>
									<p class="help-block">Use Ctrl para selecionar.</p>	
								</div>
							@endif
						@endguest

						<div class="form-group">
							<label for="books">Livros</label>
							<select name="book[]" class="form-control selectpicker" multiple="" data-live-search="true" title="Escolha os livros">
								@foreach($books as $book)
								<option value="{{ $book->id }}">{{$book->title}}</option>
								@endforeach()
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
@endsection
@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="panel panel-default">
				<ol class="breadcrumb panel-heading">
					<li class="active">Empréstimos</li>
				</ol>
				<div class="panel-body">
					<form class="form-inline" action="{{ route('lending.search') }}" method="POST">
						{{ csrf_field() }}
						<input type="hidden" name="_method" value="put">
						<div class="form-group" style="float: right;">
							<p>
								<a href="{{route('lending.add')}}" class="btn btn-info btn-sm"><i class="glyphicon glyphicon-plus"></i>Adicionar</a>
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
							@foreach($lendings as $lending)
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
									<th scope="row" class="text-center">{{ $lending->user->name }}</th>
									<td>{{ $dstart }}</td>
									<td>{{ $dend }}</td>
									<td>{{ $dfinish }}</td>
									
									<td width="155" class="text-center">
										<?php
										  if(empty($lending->date_finish)){ 
										?>
											<a href="{{route('lending.giveBack', $lending->id)}}" class="btn btn-warning">Devolver</a>
										<?php }
                                        ?>
									</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

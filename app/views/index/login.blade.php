@extends('template')

@section('title')
	Register!
@stop

@section('sidebar-left')
	<ul class="nav nav-pills nav-stacked">
		<li class="active"><a href="#">Item 1</a></li>
		<li><a href="#">Item 2</a></li>
		<li><a href="#">Item 3</a></li>
		<li><a href="#">Item 4</a></li>
	</ul>

	<div class="brands">
		<h5>Popular brands</h5>
		<img src="http://placehold.it/120x80" class="thumbnail">
		<img src="http://placehold.it/120x80" class="thumbnail">
		<img src="http://placehold.it/120x80" class="thumbnail">
	</div>
@stop

@section('content')
	@if(isset($flash_error) && $flash_error !== null) 
		<div class="alert alert-danger" role="alert">{{$flash_error}}</div>
	@endif

	<h5>Please log in:</h5>
	<hr>
	<form action="login" method="POST">
		<div class="form-body">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label class="control-label">E-mail</label>
						<input type="text" class="form-control" name="email" placeholder="E-mail" required>
					</div>					

					<div class="form-group">
						<label class="control-label">Password</label>
						<input type="password" class="form-control" name="password" required>
					</div>			
					
					<button type="submit" class="btn btn-primary btn-block">Submit</button>				

				</div>

				<div class="col-md-6"></div>				
			</div>
		</div>
	</form>
@stop

@section('scripts')
@stop
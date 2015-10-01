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
	@if(isset($flash_error) && $flash_error !== null)) 
		<div class="alert alert-danger" role="alert">{{$flash_error}}</div>
	@endif

	<h5>Thank you for shopping at Supershop!</h5>
	
	<hr>

	<h6>Purchase confirmation:</h6>
	<ul>
		<li>Total amount charged: {{$postParams->total_price}}$</li>
	</ul>

	<a href="{{APP_URL}}">Click here to go back to the front page.</a>

@stop

@section('scripts')
@stop
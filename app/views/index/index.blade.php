@extends('template')

@section('title')
	Title!
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
	<div class="row">
		@foreach($products as $index => $product)
			<div class="col-md-4">
				<div class="thumbnail">
					<img src="http://lorempixel.com/300/300/cats/{{$product['id']}}">
					<div class="caption text-center">
						<h5>{{$product['name']}}</h5>

							<h4>{{$product['price']}}$</h4>

						<p>
							<a href="{{APP_URL}}/cart/add/{{$product['id']}}" class="btn btn-primary" role="button">Add to cart</a> 
						</p>
					</div>
				</div>
			</div>	
		@endforeach
	</div>
@stop

@section('scripts')
@stop
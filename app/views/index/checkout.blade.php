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

	<h5>Checkout: ({{count($_SESSION['cart'])}} items total: {{$_SESSION['price']}}$)</h5>

	<hr>
	@if($_SESSION['logged_in'])
		<form action="{{APP_URL}}/checkout" method="POST">
			<input type="hidden" name="total_price" value="{{$_SESSION['price']}}">

			<div class="form-body">
				<div class="well">	
					<label>Freight</label>
					<div class="radio">
						<label>
							<input name="freight[]" class="freight" type="radio" value="1"> Use cheap slow freight (+ 0.0$)
						</label>
					</div>

					<div class="radio">
						<label>
							<input name="freight[]" class="freight" type="radio" value="2"> Use quick freight (+ 9.99$)
						</label>
					</div>	
				</div>


					<div class="row">
						<div class="col-md-6">
							<label>Card type</label>
							<div class="radio">
								<label>
									<input name="card[]" type="radio" value="1"> Visa/Mastercard
								</label>
							</div>

							<div class="radio">
								<label>
									<input name="card[]" type="radio" value="2"> American Express
								</label>
							</div>	

							<hr>

							<div class="form-group">
								<label>Card number</label>
								<input type="text" name="card" class="form-control" required>
							</div>

							<div class="form-group">
								<label>Card owner</label>
								<input type="text" name="name" class="form-control" required>
							</div>		

							<div class="form-group">
								<label>Expiration date</label>
								<input type="text" name="expiration" class="form-control" required>
							</div>						

							<div class="form-group">
								<label>CVV2</label>
								<input type="text" name="cvv2" class="form-control" required>
							</div>													
						</div>

						<div class="col-md-6">
							<h4>Total amount: <span class="price" data-original="{{$_SESSION['price']}}">{{$_SESSION['price']}}$</span></h4>
							<button type="submit" class="btn btn-primary btn-block">Pay</button>	
						</div>							
					</div>
								
				</div>
			</div>
		</div>
	@else
		<form action="login/checkout" method="POST">
			<div class="form-body">
				<div class="row">
					<div class="col-md-6">
						Please register an account <a href="{{APP_URL}}/register">here</a> or log in with the form to the right.
					</div>		

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
				</div>
			</div>
		</form>
	@endif
@stop

@section('scripts')
	<script>
		$(document).ready(function() {
			$("input.freight").on('change', function() {
				original = $(".price").data('original'); 

				if($(this).val() == 2) {
					var extra = Math.round((original + 9.99) * 100 ) / 100; 
					$(".price").html(extra + "$"); 

					$("input[name=total_price]").val(extra); 
				} else {
					$(".price").html(original + "$") 

					$("input[name=total_price]").val(original); 
				}
			}); 
		}); 
	</script>
@stop
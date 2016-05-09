@extends('Runningshoes/layouts.default')
@section('Runningshoes/content')

<div class="align cart-center">
	<div id="fly-header">
		<h3>
			<bold>Shopping cart</bold>
		</h3>

		<p>{{ session('cartMax') }}</p>
		
		<div id="productsName">
			<p>
				<bold>Produktnamn</bold>
			</p>
		</div>
		
		<div id="products-info">
			<p>| Enhetspris |</p>
			<p>| Antal |</p>
			<p>| Remove |</p>
		</div> <hr>
	</div>
	
	<div class="getProducts-display"> 
		
		@foreach ($getAllCarts as $getAllCart)
			
			<div class="getProd">
				<div class="inner-prod-cart">
					<img src="{{ $getAllCart->shoppingcart_prod_img }}">
					<h3>{{ $getAllCart->shoppingcart_prod_name }}</h3>
				</div>

				<div class="prod-cart-info">
					<p>{{ $getAllCart->shoppingcart_prod_price }} $</p>
					<p>{{ $getAllCart->cart_pro_qty }}</p>
					<a href="Shoppingcart/removeCartspro?prod_idremove={{ $getAllCart->prod_id }}">Remove</a>
				</div>
			</div>

		@endforeach

		<div id="noProducts-diplay">
			<p class="space">{{ $noPro }}</p>
		</div> <hr>

		<div id="continer-shopping-btn">
			<a href="Products&products_id">Continue Shopping</a>
		</div>	
		
		<div id="totalCart">
			<h4>{{ Session::get('partC') }} $ Cost without moms</h4>
			<h4>{{ Session::get('onlyM') }} $ Only moms</h4>
			<h2>{{ $totalCart }} $ Total cost </h2>
		</div>
	</div>

	<div id="paypal-right">
		<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="POST">

			<!-- Identify your business so that you can collect the payments. -->
			<input type="hidden" name="business" value="pontusp66skolan2@hotmail.com">

			<!-- Specify a Buy Now button. -->
			<input type="hidden" name="cmd" value="_xclick">

			<!-- Specify details about the item that buyers will purchase. -->
			
			@foreach ($getAllCarts as $getAllCart)
				<input type="hidden" name="item_name" value="{{ $getAllCart->shoppingcart_prod_name }}">
				<input type="hidden" name="quantity" value="{{ $getAllCart->cart_pro_qty }}">
				<input type="hidden" name="item_number" value="{{ $getAllCart->prod_id }}">
				<input type="hidden" name="amount" value="{{ $totalCart }}">
				<input type="hidden" name="currency_code" value="USD">
			@endforeach

			<!-- When payment is done it will redirect to page you write in value -->
			<input type="hidden" name="return" value="http://{{$sHostname}}/paypal_success"/>
			<input type="hidden" name="cancel_return" value="http://{{$sHostname}}/paypal_cancel"/>

			<!-- Display the payment button. -->
			<input id="paypal-img" type="image" name="submit" border="0"
			src="http://iontrades.com/media/wysiwyg/pay_with_paypal.png"
			alt="PayPal - The safer, easier way to pay online">
			<img alt="" border="0" width="1" height="1"
			src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >

		</form>
	</div>
</div>

@stop
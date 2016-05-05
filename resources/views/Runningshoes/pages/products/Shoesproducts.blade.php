@extends('Runningshoes.layouts.default')
@section('Runningshoes/content')
<div id="product_page">
	
	<div class="header-banner">
		@foreach($Banners as $banner)
			<img src="{{$banner->banner_link}}">
		@endforeach
	</div>

	<div id="page-header">
		<p>Shoes for you</p>
		<br>
		<hr>
		<br>
	</div>

	<div id="productpage">
		<div class="center">		
			<br>
			<table>
				<tr><label class="sort-first" for="sort-by">Sort By:</label></tr>
				<tr><label for="price"><a class="sort-by" href="http://{{$sHostname}}/Shoes&Products_price">Price</a></label></tr>
				<tr><label for="name"><a class="sort-by" href="http://{{$sHostname}}/Shoes&products_name">Name</a></label></tr>
			</table>

			@foreach ($oProducts_order as $getProduct)
				<div class="getProduct-info-p">			
					<a href="http://{{$sHostname}}/Products/{{ $getProduct->products_id }}"><img src="{{ $getProduct->product_image }}" /></a><br>		
					
					<center>
						<p>{{ $getProduct->products_name }}	</p>
						<p>{{ $getProduct->Products_price }} $	</p>
						@if ($getProduct->products_antal > 0)
							
							{!! Form::open(array('method' => 'POST', 'url' => 'http://'.$sHostname.'/Shoppingcart/addCart')) !!}
								{!! Form::hidden('prodId', $getProduct->products_id,['class' => 'btn-hidden','name' => 'btn_hidden_id']) !!}
								{!! Form::submit('Add To Cart', ['class' => 'btn-login','name' => 'btn-login']) !!}
							{!! Form::close() !!}
							<br />
							
						@else 
							<p>This product isn't available</p>
						@endif
					</center>
				
				</div>
			
			@endforeach
			
			<br>
			<br>
			<hr>
			<br>
			<br>
		</div>
	</div>
</div>
@stop

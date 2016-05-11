@extends('Runningshoes.layouts.default')
@section('Runningshoes/content')
<div id="product_page">
	<div class="header-banner">
		<img src="http://img.runningwarehouse.com/ban/MRSADIDAS.jpg">
	</div>
	
	<div id="page-header">
		<p>Product page</p> <hr>
	</div>

	<div class="info-prodcutpage">
		<p>{{ $getipsumText }}</p>
	</div>
	
	<div id="productpage">
		<div class="center">
			@if(\Request::url('Products&products_id') === 'http://'.$sHostname.'/Products&products_id' || \Request::url('Products&Products_price') === 'http://'.$sHostname.'/Products&Products_price' || \Request::url('Products&products_name') === 'http://'.$sHostname.'/Products&products_name') 
				<table>
					<tr>
						<label class="sort-first" for="sort-by">Sort By:</label>
					</tr>
					
					<tr>
						<label for="price">
							<a class="sort-by" href="http://{{ $sHostname }}/Products&Products_price">Price</a>
						</label>
					</tr>

					<tr>
						<label for="name">
							<a class="sort-by" href="http://{{$sHostname}}/Products&products_name">Name</a>
						</label>
					</tr>
				</table>
			@endif
			
			@foreach ($getProducts as $getProduct)
				<div class="getProduct-info-p">			
					<a href="http://{{$sHostname}}/Products/{{ $getProduct->products_id }}">
						<img src="{{ $getProduct->product_image }}" />
					</a>

					<center>
						<p>{{ $getProduct->products_name }}	</p>
						<p>{{ $getProduct->Products_price }} $	</p>
						
						@if ($getProduct->products_antal > 0)
						
							{!! Form::open(array('method' => 'POST', 'url' => 'http://'.$sHostname.'/Shoppingcart/addCart')) !!}
								{!! Form::hidden('prodId', $getProduct->products_id,['class' => 'btn-hidden','name' => 'btn_hidden_id']) !!}
								{!! Form::submit('Add To Cart', ['class' => 'btn-login','name' => 'btn-login']) !!}
							{!! Form::close() !!}
						
						@else 
							<p>This product isn't available</p>
						@endif
					</center>
				</div>
			@endforeach <hr>
		</div>
	</div>
</div>

@stop
@extends('Runningshoes.layouts.default')
@section('Runningshoes/content')

<div id="product_page">
	<div class="header-banner">
		@foreach($Banners as $banner)
			<img src="{{ $banner }}">
		@endforeach
	</div>
	
	<div id="page-header">
		<p>Product page</p><hr>
	</div>
	
	<div id="productpage">
		<div class="center">
			@foreach ($brands as $brand)
				<div class="getProduct-info-p">			
					<a href="http://{{$sHostname}}/Products/{{ $brand->products_id }}">
						<img src="{{ $brand->product_image }}" />
					</a>

					<center>
						<p>{{ $brand->products_name }}	</p>
						<p>{{ $brand->Products_price }} $	</p>
						@if ($brand->products_antal > 0)
							{!! Form::open(array('method' => 'POST', 'url' => 'http://'.$sHostname.'/Shoppingcart/addCart')) !!}
								{!! Form::hidden('prodId', $brand->products_id,['class' => 'btn-hidden','name' => 'btn_hidden_id']) !!}
								{!! Form::submit('Add To Cart', ['class' => 'btn-login','name' => 'btn-login']) !!}
							{!! Form::close() !!}
						@else 
							<p>This product isn't available</p>
						@endif
					</center>
				</div>
			@endforeach<hr>
		</div>
	</div>
</div>

@stop
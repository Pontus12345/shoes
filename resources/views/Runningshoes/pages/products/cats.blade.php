@extends('Runningshoes.layouts.default')
@section('Runningshoes/content')
<div id="product_page">
	<div class="header-banner">
		
		@foreach($Banners as $banner)
			<img src="{{$banner}}">
		@endforeach
	
	</div>
	
	<div id="page-header">
		<p>Product page</p>
		<br><hr><br>
	</div>
	
	<div id="productpage">
		<div class="center">		
			<br>
			
			@foreach ($cats as $cat)
			<div class="getProduct-info-p">				
				<a href="http://{{$sHostname}}/Products/{{ $cat->products_id }}"><img src="{{ $cat->product_image }}" /></a><br>		
				
				<center>
					<p>{{ $cat->products_name }}	</p>
					<p>{{ $cat->Products_price }} $	</p>
					@if ($cat->products_antal > 0)	
						{!! Form::open(array('method' => 'POST', 'url' => 'http://'.$sHostname.'/Shoppingcart/addCart')) !!}
							{!! Form::hidden('prodId', $cat->products_id,['class' => 'btn-hidden','name' => 'btn_hidden_id']) !!}
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
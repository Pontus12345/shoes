@extends('Runningshoes.layouts.default')
@section('Runningshoes/content')

<div id="product_page">
	<div class="header-banner">	
		@foreach($Banners as $banner)
			<img src="{{$banner->banner_link}}">
		@endforeach
	</div>

	<div id="page-header">
		<p>Shoes for you</p><hr>
	</div>
	
	<div id="productpage">
		<div class="center">			
			<table>
				<tr>
					<label class="sort-first" for="sort-by">Sort By:</label>
				</tr>

				<tr>
					<label for="price">
						<a class="sort-by" href="http://{{$sHostname}}/Accessories&Products_price">Price</a>
					</label>
				</tr>
				
				<tr>
					<label for="name">
						<a class="sort-by" href="http://{{$sHostname}}/Accessories&products_name">Name</a>
					</label>
				</tr>
			</table>

			@foreach ($oProducts_order as $getProduct)
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
			@endforeach<hr>
		</div>
	</div>
</div>

@stop

@extends('Runningshoes/layouts.default')
@section('Runningshoes/content')

<div class="display-inline">
	<div id="slideshow">
		@foreach ($Slides as $Slide)
			<div class="slides">
				<img class="Slide" src="{{ $Slide->image }}" />
			</div>
		@endforeach
	</div>

	<div id="clipp">
		<iframe src="https://www.youtube.com/embed/C0DPdy98e4c"></iframe>
		<iframe src="https://www.youtube.com/embed/C0DPdy98e4c"></iframe>
	</div>

	<div id="info">	
		<h2>Info About the site</h2>
		<p>There are many variations of passages of Lorem Ipsum available, 
		but the majority have suffered alteration in some form, by injected 
		humour, or randomised words which don't look even slightly believable. 
		If you are going to use a passage of Lorem Ipsum, you need to be sure 
		there isn't anything embarrassing hidden in the middle of text. All 
		the Lorem Ipsum generators on the Internet tend to repeat predefined 
		chunks as necessary, making this the first true generator on the Internet. 
		It uses a dictionary of over 200 Latin words, combined with a handful of 
		model sentence structures, to generate Lorem Ipsum which looks reasonable. 
		The generated Lorem Ipsum is therefore always free from repetition, injected humour, 
		or non-characteristic words etc.</p>
	</div>
	
	<center>
		
		<div id="Random-product">	
			<div class="make-left">
			
				@foreach ($getRandomProducts as $getRProduct)
			
					<div class="align-products">
					    <img src="{{ $getRProduct->product_image }}" height="100px" width="100px" name="{{ $getRProduct->products_name }}" />
					    
					    <h3>
					    	<a href="#"> {{ $getRProduct->product_title }}</a>
				    	</h3>

					    <p>{{ $getRProduct->Products_price }} $</p>
						
						@if ($getRProduct->products_antal > 0)
						
							{!! Form::open(array('method' => 'POST', 'url' => 'Shoppingcart/addCart')) !!}
							    {!! Form::hidden('prodId', $getRProduct->products_id,['class' => 'btn-hidden','name' => 'btn_hidden_id']) !!}
							    {!! Form::submit('Add To Cart', ['class' => 'btn-login','name' => 'btn-login']) !!}
							{!! Form::close() !!}
					    
					    @else 
							<p>This product isn't available</p>
						@endif
					</div>  
				
				@endforeach
			
			</div>
		</div>

	</center>
</div>

@stop


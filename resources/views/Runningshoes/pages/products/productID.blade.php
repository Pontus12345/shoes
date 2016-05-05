@extends('Runningshoes.layouts.default')
@section('Runningshoes/content')
<div class="align-page">
	<div class="center">
		
		@foreach ($getProducts as $getProduct)
		
		<div class="getProduct-info">			
			
			<div id="align-img">
				<img src="{{ $getProduct->product_image }}" />
			</div>		
			
			<div class="prod-info">
				<p><div class="rating"></div></p>
				<p>{{ $getProduct->products_name }}	</p>
				<p>{{ $getProduct->Products_price }} $	</p>
				<hr>
				<p>{{ $getProduct->product_title }}</p>
				<hr>
				
				<center>

					@if ($getProduct->products_antal > 0)

					<p>Tillgängligt I Lager: {{$getProduct->products_antal}}</p>
					
					{!! Form::open(array('method' => 'POST', 'url' => 'http://'.$sHostname.'/Shoppingcart/addCart')) !!}
						{!! Form::hidden('prodId', $getProduct->products_id,['class' => 'btn-hidden','name' => 'btn_hidden_id']) !!}
						{!! Form::submit('Add To Cart', ['class' => 'btn-login','name' => 'btn-login']) !!}
					{!! Form::close() !!}

					@else 
						<p>This product isn't available</p>
					@endif
				
				</center>

			</div>

			<div class="desc-info">
				<p>Product description</p>
				<hr />
				<p>{{ $getProduct->product_desc }}</p>
			</div>

			<br />
			<div class="customers-review">
				<p class="align-text-left">Customer Reviews</p>
			</div> 
			<hr />
			<br />
			
			@if ($errors)

				@foreach ($errors->all() as $error)
					<h4>{{ $error }}</h4>
				@endforeach

			@endif

			<div class="comment-page">
			
				{!! Form::open(array('method' => 'POST', 'url' => 'http://'.$sHostname.'/comment')) !!}
					{!! Form::text('username', null,['class' => 'comments-username','name' => 'comments_username', 'placeholder' => 'Username goes here']) !!}<br />
					{!! Form::hidden('prodId', "products$id",['name' => 'comments_id']) !!}
					{!! Form::hidden('prodId', $id,['name' => 'comments_products_id']) !!}
					{!! Form::hidden('starid', null,['name' => 'You_need_to_check_a_star', 'id' => 'rate-star']) !!}
					{!! Form::textarea('text', null,['class' => 'comments-content','name' => 'comments_content', 'placeholder' => 'Content goes here']) !!}<br />
					{!! Form::submit('Add a comment', ['class' => 'add-comment','name' => 'add-comment']) !!}
				{!! Form::close() !!}
			
			</div>
		</div> 
		<br />
		
		@endforeach
		
		<div id="wrapper-comments">
			
			@foreach($t_oComments as $comments)
			
				<div id="place-comments">
						<div class="rating-star">
							<span class='rate-stars rate-stars-{{$comments->rate}}' id='star-1'>☆</span>
							<span class='rate-stars rate-stars-{{$comments->rate}}' id='star-2'>☆</span>
							<span class='rate-stars rate-stars-{{$comments->rate}}' id='star-3'>☆</span>
							<span class='rate-stars rate-stars-{{$comments->rate}}' id='star-4'>☆</span>
							<span class='rate-stars rate-stars-{{$comments->rate}}' id='star-5'>☆</span>
						</div>
					
					<h2>{{ $comments->name }}</h2> <br />
					<p>{{ $comments->date }}</p>
					<p>{{ $comments->comments }}</p>
				
				</div>
			@endforeach
		</div>
		<br />
		<br />	
	</div>
</div>
@stop

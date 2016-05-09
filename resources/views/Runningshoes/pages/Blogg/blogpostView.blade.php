@extends('Runningshoes.layouts.default')
@section('Runningshoes/content')

<meta name="csrf-token" content="{{ csrf_token() }}">

<div id='fixed' class="center">
	<div class="inner-wrapper">
		<div id="wrap-content-blog">
			
			@foreach ($postOrders as $postOrder)
				<div class="order-blog">	
					<h2>{{ $postOrder->blog_title }}</h2> <hr />
					<p class="info">{{ $postOrder->blog_content }}</p>
					<img class='imgLarge' src="../{{ $postOrder->blog_image }}">
					<p class="date">{{$postOrder->Date}}</p>
					<p>Thank you {{$postOrder->By}}</p>
				</div>
			@endforeach
			
			<!-- Comments -->
			<div class='ShowValid'></div>
			<div id='displaypostAbove'></div>
			<div id="displayPostComments" class="postComments"></div>
			
			<div class="comment-page">
				@if ($errors)

				@foreach ($errors->all() as $error)
			
					<h4>{{ $error }}</h4>
			
				@endforeach

				@endif
					{!! Form::open(array('method' => 'POST', 'url' => 'http://'.$sHostname.'/comment')) !!}
						{!! Form::text('username', null,['class' => 'comments-username','name' => 'comments_username', 'placeholder' => 'Username goes here']) !!}<br />
						{!! Form::hidden('bloggId', "blogg$id",['name' => 'comments_id']) !!}
						{!! Form::hidden('bloggId', $id,['name' => 'comments_blogg_id']) !!}
						{!! Form::hidden('starid', 0,['name' => 'You_need_to_check_a_star', 'id' => 'rate-star']) !!}
						{!! Form::textarea('text', null,['class' => 'comments-content','name' => 'comments_content', 'placeholder' => 'Content goes here']) !!}<br />
						{!! Form::submit('Add a comment', ['class' => 'add-comment','name' => 'add-comment']) !!}
					{!! Form::close() !!}
			</div>
			
			<div id="wrapper-comments">
				@foreach($t_oComments as $comments)
					
					<div id="place-comments">
						<p>{{ $comments->name }}</p>
						<p>{{ $comments->date }}</p>
						<p>{{ $comments->comments }}</p>
					</div>
					
				@endforeach
			</div>
		</div>
	</div>
</div>	
@stop
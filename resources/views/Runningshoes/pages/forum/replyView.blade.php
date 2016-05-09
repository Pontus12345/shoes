@extends('Runningshoes/layouts.default')
@section ('Runningshoes/content')

<div class="align" style="margin: 100px 0 0 100px">

	@if ($errors)

		@foreach ($errors->all() as $error)
			<h4>{{ $error }}</h4>
		@endforeach

	@endif

		@if(session('reply'))
			<p>{{ session('reply') }}</p>
			{{ Session::forget('reply') }}
		@endif

	@foreach ($postsubjects as $postsubject)
		
		<div id="reply-id">		
			<form action="http://{{$sHostname}}/Forum/sub/reply/createReply" method="POST">
				<label for="name">Name:</label><br />
				{!! Form::text('name', null, ['class' => 'reply-name', 'name' => 'reply_name','placeholder' => 'Name Goes Here']) !!}
				<br /><label for="text">Text:</label><br />
				{!! Form::textarea('content', null, ['class' => 'form-control', 'name' => 'reply_content']) !!}
				{!! Form::hidden('hidden', $postsubject->subjects_name,['class' => 'hidden-reply','name' => 'hidden_reply']) !!}
				{!! Form::hidden('hidden',  $postsubject->subjects_name, ['class' => 'form-control_hidden', 'name' => 'reply_content_hidden']) !!}<br />
				{!! Form::submit('Reply', ['class' => 'btn-reply','name' => 'btn_reply']) !!}
			</form>
		</div>

	@endforeach	

</div><!-- End of align class -->

@stop
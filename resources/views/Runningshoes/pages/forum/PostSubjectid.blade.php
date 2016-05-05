@extends('Runningshoes/layouts.default')
@section ('Runningshoes/content')
<div id="inner-wrapper-forum">
	<div id="forum-id">	
		<p>{{ session('reply') }}</p>
		<p>{{ Session::forget('reply') }}</p>

		@foreach ($postsubjectsid as $postsubjectid)
		
		<div id="sub-id" class="align">
			<p>Name of subject: {{ $postsubjectid->subjects_name }}</p><br /> <hr />	
			<p>{{ $postsubjectid->subjects_username }}</p>	
			<p>{{ $postsubjectid->subjects_date }}</p>
			<p> {{ $postsubjectid->subject_post_content }}</p>
			<form action="http://{{$sHostname}}/Forum/reply/{{ $postsubjectid->subjects_id }}" method="POST">
				{!! Form::hidden('hidden', $postsubjectid->subjects_id,['class' => 'hidden-reply','name' => 'hidden_reply']) !!}
				{!! Form::submit('Reply', ['class' => 'btn-reply','name' => 'btn_reply']) !!}
			</form>
			<hr />
		</div>

		@endforeach

		@foreach ($replys as $reply)
			
			@if(session('username') === $reply->reply_by)
			
				<div class="right">
					<p><a href="http://{{$sHostname}}/Forum/sub/remove/reply&reply_id&reply_by&{{$reply->reply_id}}">Remove</a></p>
				</div>
			
			@endif
			
			<div id="reply-view">	
				<p>{{$reply->reply_name}}</p>
				<p>{{$reply->reply_text}}</p>
				<p>{{$reply->reply_date}}</p>
				<p>{{$reply->reply_by}}</p>
				<br />
				<hr />
			</div>	
		
		@endforeach
	
	</div>
</div>	
@stop
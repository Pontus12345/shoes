@extends('Runningshoes/layouts.default')
@section ('Runningshoes/content')
	<div id="inner-wrapper-forum">
		<div id="forum-id">
		<br />
		<p class="fly-cat">{{ $categori }}</p>
		<br />
		<hr />
		
		@if(count($postsubjects) === 0)
			<br /><br /><h2>No topics</h2>
		@endif
		
		@foreach ($postsubjects as $postsubject)
			@if(session('username') === $postsubject->subjects_username)
				
				<div class="right">
					<p>
						<a href="http://{{$sHostname}}/Forum/sub/remove/subjects&subjects_id&subjects_username&{{$postsubject->subjects_id}}">Remove</a>
					</p>
				</div>

			@endif
				
				<br />
				<a href="http://{{$sHostname}}/Forum/sub/{{ $postsubject->subjects_name }}">Subject: {{ $postsubject->subjects_name }}</a>
				<br />
				From: <a href="http://{{ $sHostname }}/Forum/user/Info-{{$postsubject->subjects_username}}"> {{ $postsubject->subjects_username }}</a><p>Date: {{ $postsubject->subjects_date }}</p>
				<hr />

		@endforeach
		
	</div>
</div>
@stop
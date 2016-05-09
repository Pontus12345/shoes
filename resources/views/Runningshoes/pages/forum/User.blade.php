@extends('Runningshoes.layouts.default')
@section('Runningshoes/content')

<div class="align">
	<div id="forum-user"> 
		@foreach($getUsers as $getUser)
			<p>{{$getUser->subjects_username}}</p>
			<p>Member</p>
			<p>
				<img src="{{$getUser->image}}">
			</p> 
			<p>Reg: {{$getUser->created_at}}</p>
			<p>{{$getUser->username}}</p>
			<p>Total: {{$getuserForum}}</p> 
		@endforeach
	</div>
</div>

@stop
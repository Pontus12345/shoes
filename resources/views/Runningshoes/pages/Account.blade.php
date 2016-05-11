@extends('Runningshoes.layouts.default')
@section('Runningshoes/content')
<div class="page-account align">

	<center>

		<div class="showErrors"> 
			@if ($errors)
				@foreach ($errors->all() as $error)
					<h4>{{ $error }}</h4>
				@endforeach
			@endif

			@if(Session::get('Error'))
				<h4>{{ Session::get('Error') }}</h4>
				{{ Session::forget('Error') }}
			@endif

			@if (session('Updated'))
				{{ session('Updated') }}
				{{ Session::forget('Updated') }}
			@endif
		</div>

	</center>

	<div class="center">
		<div id="updateUser"> 
			<legend>Update Your Username</legend>	
			
			{!! Form::open(array('method' => 'POST', 'url' => 'Account/UpdateAcc')) !!}
				{!! Form::text('username', null, ['class' => 'username-log-in', 'name' => 'update_username', 'placeholder' =>'Username goes here']) !!}<br />
				{!! Form::password('password', ['class' => 'password-log-in', 'name' => 'update_password', 'placeholder' => 'Password goes here']) !!}<br />
				
				{!! Form::password('password', ['class' => 'password-log-in', 'name' => 'update_password_confirmation', 'placeholder' => 'Password goes here again']) !!}<br />
				{!! Form::email('email', null, ['class' => 'username-log-in', 'name' => 'update_email', 'placeholder' =>'email goes here']) !!}<br />
				{!! Form::submit('Update Your Account', ['class' => 'btn-login','name' => 'btn-login']) !!}
			{!! Form::close() !!}
		
		</div>	
	</div>
</div>
@stop
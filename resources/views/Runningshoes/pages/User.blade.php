<!DOCTYPE html>
@extends('Runningshoes/layouts.default')
@section('Runningshoes/content')

<div class="display-inline">
	<div class="center"> 
		<div class="align">
			<div class="use-group-in log-group-in" id="log-in">
				
				@if ($errors)
					@foreach ($errors->all() as $error)
						<h4>{{ $error }}</h4>
					@endforeach				
				@endif

				@if(Session::get('Error'))
					<h4>{{ Session::get('Error') }}</h4>
					{{ Session::forget('Error') }}
				@endif

				@if (session('RegUser'))
					{{ session('RegUser') }}
					{{ Session::forget('RegUser') }}
				@endif

				@if (session('rString'))
					{{ session('rString') }}
					{{ Session::forget('rString') }}
				@endif

				@if (session('unique'))
					{{ session('unique') }}
					{{ Session::forget('unique') }}
				@endif
				
				{!! Form::open(array('method' => 'POST', 'url' => 'makelogin')) !!}
					<label for="username">Username:</label><br />
					{!! Form::text('username', null, ['class' => 'username-log-in', 'name' => 'login_username', 'placeholder' =>'Username goes here']) !!} <br />
					
					<label for="password">Password:</label><br />
					{!! Form::password('password', ['class' => 'password-log-in', 'name' => 'login_password', 'placeholder' => 'Password goes here']) !!}
					{!! Form::submit('Log in', ['class' => 'btn-login','name' => 'btn-login', 'value' => 'hej']) !!}
				{!! Form::close() !!}
			
			</div> <!-- END OF use-group-in log-group-in -->

			<div class="align use-group-in users-group-in" id="reg-in">
				
				{!! Form::open(array('method' => 'POST', 'url' => 'reguser')) !!}
					
					<label for="username">Username:</label><br />
					{!! Form::text('Regusername', null, ['class' => 'username-Reg-in', 'name' => 'Reg_username', 'placeholder' =>'Register your username']) !!} <br />
					
					<label for="email">Email:</label><br />
					{!! Form::email('Regemail', null, ['class' => 'email-Reg-in', 'name' => 'Reg_email', 'placeholder' =>'Register your email']) !!} <br />

					<label for="password">Password:</label><br />
					{!! Form::password('Regpassword', ['class' => 'password-Reg-in', 'name' => 'Reg_password', 'placeholder' => 'Register your password']) !!} <br />

					<label for="password-confirmation">Password Confirmation:</label><br />
					{!! Form::password('Regpassword_again', ['class' => 'password-Reg-in', 'name' => 'Reg_password_confirmation', 'placeholder' => 'Register your password again']) !!} <br />

					<label for="image">Image:</label><br />
					{!! Form::radio('Regimage', '/images/demo-icon.jpg', ['class' => 'username-Reg-in', 'name' => 'avatar']) !!} <br /> 

					<label for="stringRandom">
						<p id="sRandom">{{ session('sRandomAuth') }}</p>
					</label><br />
					
					{!! Form::text('Regstring', null, ['class' => 'username-Reg-in', 'name' => 'String', 'placeholder' =>'Letters here']) !!}
					{!! Form::submit('Register', ['class' => 'btn-login','name' => 'btn-login']) !!}
				
				{!! Form::close() !!}

			</div>

			<button class="show-reg" id="showreg-btn" onclick="toggleClock()">Register</button>
		</div>
	</div>
</div>
@stop

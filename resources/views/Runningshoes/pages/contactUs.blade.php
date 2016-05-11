@extends('Runningshoes.layouts.default')
@section ('Runningshoes/content')

<div class="wrap-contact-us">
	<div id="fly-header">
		<div id="fly-inner">

			@if ($errors)
				@foreach ($errors->all() as $error)
					<h4>{{ $error }}</h4>
				@endforeach
			@endif

			@if(Session::get('Error'))
				<h4>{{ Session::get('Error') }}</h4>
				{{ Session::forget('Error') }}
			@endif

			@if(Session::get('resived'))
				<h4>{{ Session::get('resived') }}</h4>
				{{ Session::forget('resived') }}
			@endif

			@if (session('rString'))
				{{ session('rString') }}
				{{ Session::forget('rString') }}
			@endif
			
			<ul>
				<li><p>Contact us</p></li> <hr />

				{!! Form::open(array('method' => 'POST', 'url' => "http://$sHostname/contact-us/email")) !!}
					
					<li>
						<label for="Name">Name:</label>
					</li>

					<li> 
						{!! Form::text('name', '', ['class' => 'name-contact','name' => 'name_contact', 'placeholder' => 'Your Name']) !!}
					</li>
					
					<li>
						<label for="email">Email:</label>
					</li>
					
					<li>
						{!! Form::email('email', '', ['class' => 'email-contact','name' => 'email_contact', 'placeholder' => 'Your email']) !!}
					</li>

					<li>
						<label for="Message">Message:</label>
					</li>

					<li>
						{!! Form::textarea('text', '', ['class' => 'text-contact','name' => 'text_contact', 'Your text']) !!}
					</li>

					<li>
						{!! Form::submit('Send', ['class' => 'btn-sub','name' => 'btn_sub']) !!}
					</li>

				{!! Form::close() !!}
			</ul>
		</div>	
	</div>
</div>
@stop

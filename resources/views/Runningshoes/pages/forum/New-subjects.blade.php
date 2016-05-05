@extends('Runningshoes/layouts.default')
@section ('Runningshoes/content')
<div class="forum align">
	<div id="horizont-center">
		<div class="vert-align"> 
			
			@if ($errors)
				@foreach ($errors->all() as $error)
					<h4>{{ $error }}</h4>
				@endforeach
			@endif

			@if (session('Subject'))
				{{ session('Subject') }}
				{{ Session::forget('Subject') }}
			@endif
			
			@if(session('reply'))
				{{ session('reply') }}
				{{ Session::forget('reply') }}
			@endif	
			
			{!! Form::open(array('method' => 'POST', 'url' => '/create/subject')) !!}
				<label id="name" for="name">Name:</label><label for="select-cat">Select Category: </label>
				<hr />
				
				<div id="align-name-cat">    
					<div class="linked">
						{!! Form::text('name', null, ['class' => 'create_sub_name name-cat', 'name' => 'name', 'placeholder' =>'Name goes here']) !!}
					</div>
					<div class="linked"> 
						{!! Form::select('cat', ['Category' => $getforumCats]); !!}
						<br />
					</div>
				</div>  

				<label id="desc" for="Desc">Description</label>
				{!! Form::textarea('content', null, ['class' => 'form-control', 'name' => 'form_control_content']) !!}<br />
				{!! Form::submit('Create Subject', ['class' => 'btn-sub stylcol','name' => 'btn_sub']) !!}
			{!! Form::close() !!}
		
		</div>
	</div>
</div>
@stop
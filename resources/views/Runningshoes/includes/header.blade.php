<div id="inner-wrapper" class="container">
	<br /> 
	<br />
	
	<div class="logo">
		<img id="logo" src="/images/logo.png" />
	</div>	
	
	<div class="top-sertch">
		<center>
	
			@if(session('empty'))
			
				<span style="color: #fff">{{ session('empty') }}</span>
				{{ Session::forget('empty') }}
			
			@endif
	
		</center>
	
		{!! Form::open(array('method' => 'POST', 'url' => 'Search')) !!}
		    <div class="search-group">
		        {!! Form::text('search', null, ['class' => 'search-control', 'name' => 'search', 'placeholder' =>'Search your store']) !!}
		        {!! Form::submit('&#xf002;', ['class' => 'fa form-submit btn-search','name' => 'btn-search',]) !!}
		    </div>
		{!! Form::close() !!}
	
		@include('Runningshoes.includes.toplinks.toplinks')
	
	</div>
	<br /> 
	<br />
</div>

<nav>
	<ul class="container">
		
		@foreach ($links as $link)  
			
			<li><a href="http://{{$sHostname}}/{{ $link->menu_href }}">{{ $link->menu_name }}</a>
			
			@if(count($sublinks) > 0)
			
				<ul>
					@foreach ($sublinks as $sublink)
				
						@if ($sublink->submenu_menu_id == $link->menu_id)
				
							<li><a href="http://{{$sHostname}}/{{ $sublink->submenu_link }}">{{ $sublink->submenu_name }}</a></li>
				
						@endif
				
					@endforeach
				
				</ul>
			
			@endif
			
			</li>
		
		@endforeach
	
	</ul>		
</nav>
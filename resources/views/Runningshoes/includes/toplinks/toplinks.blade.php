<div id="top-links-right">
	<ul>
		@foreach ($topLinks as $toplink)
			
			@if (!Session::get('token'))	
			
				@if ($toplink->name == 'Logout')
			
					<?php continue; ?>
			
			@endif
			
			@else
			
				@if ($toplink->name == 'Login')
			
					<?php continue; ?>
			
				@endif 
			
			@endif		
			
			<li><a href="http://{{$sHostname}}/{{ $toplink->link }}">{{ $toplink->name }}</a></li>
		
		@endforeach
		
		<li><div id="google_translate_element"></div></li>

		@if ($true === true)
			
			<li>
				<select id="log-user" onchange="window.location = this.value;">
					<option><a> {{ session('username') }} </a></option>
					<option value="http://{{$sHostname}}/Logout" id="logout">Logout</option>
				</select>
			</li>
		
		@endif
	
	</ul>
</div>
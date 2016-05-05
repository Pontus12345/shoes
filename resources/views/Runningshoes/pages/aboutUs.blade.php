@extends ('Runningshoes.layouts.default')
@section('Runningshoes/content')
<div id="info-aboutus">
	<br /> 
	<br />
	
	<div class="inner-element">
		<h2>Get In Run</h2>
		<br />
		<hr />
		<br />
		<br />

		<img src="{{ URL::to('/') }}/images/about-us-banner.jpg" id="bild-aboutUs">
		<br />
		<br />
		<h5>Shoes for you</h5>
		<br />
		@foreach ($infoPages as $infoPage)
			
			<center>
				<p>{{ $infoPage->info }}</p>
			</center>
		
		@endforeach
			
			<br />
			
			<h3>Welcome to us on Runningshoes</h3>
			<br /> 

			<a href="https://www.facebook.com/RunningshoesTestFacebockpage/"><img alt="Facebook logo" class="facebook-logo" src='http://www.britishskinfoundation.org.uk/Portals/0/find-us-on-facebook.jpg'></a>
			<br />
			<br />
			<br />
			<br />
	</div>		
</div>
@stop
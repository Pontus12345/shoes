@extends ('Runningshoes.layouts.default')
@section('Runningshoes/content')
<div id="info-aboutus">
	<div class="inner-element">
		<h2>Get In Run</h2> <hr />
		<img src="{{ URL::to('/') }}/images/about-us-banner.jpg" id="bild-aboutUs">
		<h5>Shoes for you</h5>	
		
		@foreach ($infoPages as $infoPage)	
			<center>
				<p>{{ $infoPage->info }}</p>
			</center>
		@endforeach
			
		<h3>Welcome to us on Runningshoes</h3> 
		<a href="https://www.facebook.com/RunningshoesTestFacebockpage/">
			<img alt="Facebook logo" class="facebook-logo" src='http://www.britishskinfoundation.org.uk/Portals/0/find-us-on-facebook.jpg'>
		</a>
	</div>		
</div>
@stop
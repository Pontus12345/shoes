@extends('Runningshoes.layouts.default')
@section('Runningshoes/content')

<div id="blogView" class="center">	
	<br /> 
	<br />
	
	<div id="fixed" class="inner-wrapper">
		<div class="Artic-inner-wrapper">
			<ul>
				<li><p>Articles: {{count($orders)}}</p></li>
				<li>Sort After 
					<select class="selectBlogg">
						<option class="selectTagBlogg">ID</option>
						<option class="selectTagBlogg">Date</option>
					</select>
				</li>
			</ul>
			
			@foreach ($orders as $order)
			
			<div>
				<br />
				<h2>{{$order->blog_title}}</h2>
				<h5>{{$order->Date}}</h5>
				<br /><hr /><br />
				<h2>{{$order->blog_label}}</h2><br />
				<img class="imgLarge" src='{{$order->blog_image}}'>
				<p>Read More</p><br />
				<hr> <br />
				<p class="infoContent">Info:</p> <br />
				<content><p>{{$order->blog_content}}</p></content>
			</div>
			
			@endforeach
			
			</div>
		</div>

		<div class="Artic-inner-wrapper">
			<br />
			<ul>
				<li><p>Articles: {{count($orders)}}</p></li>
				<li>Sort After : 
					<select class='selectBlogg'>
						<option class="selectTagBlogg">ID</option>
						<option class="selectTagBlogg">Date</option>
					</select>
				</li>
			</ul>

			<br />
			<br />
	
		</div>

	</div> <!-- End of blogview div -->

<div class="right right-aside">
	<aside id="aside-right" class="blogg-right" for="right">
		<h2>Blog</h2>
		<p>Recent post</p>
		<ul>
			@foreach($orders as $ord)
			@foreach($closetsdate as $closDate)
			@if ($closDate == $ord->Blog_date)
			<li><p><a href="Blogg/{{$ord->ID}}">{{$ord->blog_label}}</a></p></li>
			@endif
			@endforeach
			@endforeach
		</ul>
	</aside>
</div>

@stop
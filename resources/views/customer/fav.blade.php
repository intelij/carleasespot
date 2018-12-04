@extends('frontend.layouts.app')
@section('styles')
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/assets/favicon.ico') }}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/style.css') }}" media="screen">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/responsive.css') }}" media="screen">
<style>
.favorites{padding:50px 0;}
</style>

@endsection
@section('content')
<div id="wrapper">
			<div class="favorites">
				<div class="favorites_container container">
					<h2 class="center">Favorites</h2>
					<div class="clearfix">
@if(!empty($favorites))
@foreach($favorites as $favorite)
						<div class="fav_cell">
							<figure>
						 <img src="{{$favorite->image}}" alt="2010 BMW M3 for sale in black" class="img-responsive">
							</figure>
							<p>
								{{count($favorite->listing->make) ? $favorite->listing->make->name : ''}} {{count($favorite->listing->model) ? $favorite->listing->model->name : ''}}
							</p>
							<div class="clearfix">
								<div class="left_box">
									<strong>Rs{{ $favorite->price }}</strong>

                                                                <a href="{{route('buy',$favorite->uuid)}}" class="btn btn-danger" data-toggle="ajax-modal" style="min-width:100px">Buy</a>
                                                            
									<small>Free Shiping</small>
								</div>
								<span class="right-text"></span>
							</div>
						</div>
@endforeach
@endif
					</div>
				</div>
			</div>
		</div>
		@endsection
		@section('scripts')
		<script  src="{{ asset('assets/assets/js/jquery-1.10.2.min.js') }}"></script>
		@endsection
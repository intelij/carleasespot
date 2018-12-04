@extends('frontend.layouts.app')
@section('content')
 <div class="vc_column-inner ">
        <div class="wpb_wrapper">
			<section class="simple-search" style="background: rgba(0, 0, 0, 0) url(assets/images/2017/06/banner-5.jpg) center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
                         
			</section>
			<div class="container">
			 <div class="row">
                 <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
					<h2 style="padding-top:30px;">Privacy And Policy</h2>
<ul class="list">
@foreach($policies as $policy)
<li  class="list-item">{!! $term->terms !!}</li>
@endforeach
</ul>
				</div>
			</div>	
			</div>
		</div>	
@endsection
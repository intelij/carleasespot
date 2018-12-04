@extends('frontend.layouts.app')
@section('styles')
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/assets/favicon.ico') }}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/style.css') }}" media="screen">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/css/responsive.css') }}" media="screen">
@endsection
@section('content')
<center>
	<div id="wrapper">
			<div id="content">
				<section class="verification_msg">
					<div class="container">
						<div class="message_text">
							<figure class="smile_img">
								<img src="{{ asset('assets/assets/images/PIC.png') }}" alt="abc"/>
							</figure> <br />
							<h2>Check  Your Email</h2> <br />
							<h4>
								We sent an email to <a href="mailto:{{ $email }}">{{ $email }}</a> so we can confirm you're you! <br /> 
								Click the button in the email
								to continue on your way.
							</h4>
							<span>Can't find it? <a href="{{route('resend.mail')}}" >Click here to resend the email</a> <br />
						</div>
					</div>
				</section>
			</div>
			</center>
			
			
	@endsection
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title></title>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
	<body>

		<style>
			body {
				background: rgb(204,204,204);
			}
			.deatails {
				padding: 20px;
				background: #fff;
				box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
				-moz-box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
				-webkit-box-shadow: 0 0 0.5cm rgba(0,0,0,0.5);
				margin: 20px 0 0;
			}
			.deatails figure {
				margin: 0 auto 30px;
				width: 150px;
			}
			.deatails figure img {
				max-width: 100%;
				width: auto;
				max-height: 100%;
				height: auto;
			}
			.detail_info {
				margin: 0;
				padding: 0;
			}
			.detail_info li {
				list-style-type: none;
				font-size: 14px;
				margin: 0 0 10px;
				color: #000;
			}
			.detail_info li strong {
				display: inline-block;
				vertical-align: top;
				font-weight: 700;
				width: 49%;
				text-align: right;
				padding: 0 15px;
			}
			.detail_info li span {
				display: inline-block;
				vertical-align: top;
				font-weight: 400;
				padding: 0 15px;
				width:49%;
			}
		</style>

		</head>
	<body>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-6 col-sm-offset-3">
					<div class="deatails">
						<figure>
							<img src="{{asset($inquiry->dealer->photo != "" ? "assets/user_files/".$inquiry->dealer->uuid."/".$inquiry->dealer->photo : "assets/user_files/no-image.jpg" )}}" >
						</figure>
						<ul class="detail_info">
<li class="clearfix">
								<strong>Customer:</strong><span>{{ ($inquiry->first_name) }}  {{ ($inquiry->last_name) }}</span>
							</li>
<li class="clearfix">
								<strong>Email:</strong><span>{{($inquiry->email)}} </span>
							</li>
<li class="clearfix">
								<strong>Phone:</strong><span>{{($inquiry->phone)}} </span>
							</li>
</li>
<li class="clearfix">
								<strong>Message:</strong><span>{{($inquiry->message)}} </span>
							</li>
							<li class="clearfix">
								<strong>Dealer:</strong><span>{{($inquiry->dealer->name)}}</span>
							</li>
							<li class="clearfix">
								<strong>type:</strong><span>{{$inquiry->type == 0 ? 'Lease' : 'Sell'}}</span>
							</li>
							<li class="clearfix">
								<strong>Created At:</strong><span>{{$inquiry->created_at}}</span>
							</li>
							<li class="clearfix">
								<strong> car: </strong><span>{{($inquiry->car)}}</span>
							</li>
							<li class="clearfix">
								<strong>Price:</strong><span>{{$inquiry->price}}</span>
							</li>
							<li class="clearfix">
								<strong>Dealer IP:</strong><span>{{$inquiry->ip_address }}</span>
							</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</body>
</html>
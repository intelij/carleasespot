<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Welcome to the demo company</title>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/assets/css/font-awesome.css')}}" media="screen">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/assets/css/global.css')}}" media="screen">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/assets/css/style.css')}}" media="screen">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/assets/css/responsive.css')}}" media="screen">
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">
		<link href="{{asset('css/star-rating.css')}}" media="all" rel="stylesheet" type="text/css" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="{{asset('js/star-rating.js')}}" type="text/javascript"></script>

	</head>
	<body>
		<!--Page Wrapper Start-->
		<div class="modal fade in" tabindex="-1" role="dialog" aria-hidden="true" style="display: block; padding-right: 17px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
					<h4>Review</h4>
					<form  action="{{route('post_review')}}" method="post">
					<input type="hidden" value="{{csrf_token()}}" name="_token">
					<input id="input-21e" value="0" type="text" class="rating" data-min=0 data-max=5 data-step=0.5 data-size="xs"
               title="" name="rating">
					<textarea class="textField" name="review"></textarea>
					<div class="btn_wrapper">
					    <input type="hidden" name="user" value="{{$id}}">
					 <input type="hidden" name="listing" value="{{$listing->dealer->uuid}}">
						<button type="button" class="btn" data-dismiss="modal">may be later</button>
						<button type="submit" class="btn">Submit</button>
					</div>
					</form>
				</div>
			</div>

		</div>
		</div>
		<!--Page Wrapper End-->
		<script type="text/javascript" src="{{asset('assets/assets/js/jquery-1.10.2.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/assets/js/site.js')}}"></script>
	</body>
</html>
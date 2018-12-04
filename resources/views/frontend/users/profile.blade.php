@extends('frontend.layouts.app')
@section('styles')
<link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/assets/favicon.ico') }}">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/style.css') }}" media="screen">
		<link rel="stylesheet" type="text/css" href="{{ asset('assets/assets/css/responsive.css') }}" media="screen">
@endsection
@section('content')
    <div class="page-header-area-2 gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="small-breadcrumb">
                        <div class="breadcrumb-link">
                            <ul>
                                <li>
                                    <a href="../index.html">
                                        Home
                                    </a>
                                </li>
                                <li class="active">
                                    <a href="javascript:void(0);" class="active">
                                        Profile
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="vc_row wpb_row vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                    <section class="section-padding no-top gray">
                        <div class="container">
                            <div class="row">
                                <!-- Middle Content Area -->
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    @if(Session('success') || Session('error'))
                                        {!! message() !!}
                                    @endif
                                    <section class="search-result-item">
                                        <a class="image-link" href="javascript:void(0);">
                                            <img class="image" alt="Profile Picture" src="{{$user->photo != '' ? asset('assets/user_files/'.$user->uuid.'/'.$user->photo) : asset('assets/user_files/no-image.jpg')}}" id="user_dp" />
                                        </a>
                                        <div class="search-result-item-body">
                                            <div class="row">
                                                <div class="col-md-5 col-sm-12 col-xs-12">
                                                    <h4 class="search-result-item-heading sb_put_user_name"></h4>
                                                    <p class="info">
                                                    <h2>{{$user->name}}</h2>
													@if(!empty(auth()->guard('web')->user()))
                                                    <span class="profile_tabs link" id="view_profile" data-action="{{route('users.show',$user)}}"><i class="fa fa-user"></i>&nbsp;Profile</span>
                                                    <span class="profile_tabs link" id="update_profile" data-action="{{route('update_profile')}}"><i class="fa fa-edit"></i>&nbsp; Edit Profile</span>
                                                    @endif
													</p>
                                                    <p class="info sb_put_user_address"></p>
                                                    <a href="#">
                                                        @for($i=1;$i<=$avg_rating;$i++)
                                                    <i class="fa fa-star"></i>
												@endfor
												@for($j=$avg_rating+1;$j<6;$j++)
													<i class="fa fa-star-o"></i>
												@endfor
                                                    <span class="rating-count">
													{{ $avg_rating }}
                                                   </span>
                                                    </a>
                                                </div>
												@if(!empty(auth()->guard('web')->user()))
                                                <div class="col-md-7 col-sm-12 col-xs-12">
                                                    <div class="row ad-history">
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="user-stats">
                                                                <h2>{{count($user->inquiries)}}</h2>
                                                                <small>Leads</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="user-stats">
                                                                <h2>{{count($user->listings)}}</h2>
                                                                <small>Total Listings</small>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4 col-sm-4 col-xs-12">
                                                            <div class="user-stats">
                                                                <h2>0</h2>
                                                                <small>Inactve Listings</small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
												@endif
                                            </div>
                                        </div>
                                    </section>
                                    <div class="dashboard-menu-container">
									@if(!empty(auth()->guard('web')->user()))
                                           <ul>
                                            <li>
                                                  <a href="javascript:void(0);" >
                                                    <div class="menu-name link" data-action="{{route('listings.index')}}">My Car Listings</div>
                                                </a>
                                            </li>
                                            <li>
                                              <a href="javascript:void(0);">
                                                    <div class="menu-name link" data-action="{{route('listings.dealer_inactive_listings')}}">Inactive Listings</div>
                                                </a>
                                            </li>
                                            <li>
                                             <a href="javascript:void(0);">
                                                    <div class="menu-name link" data-action="{{route('listings.dealer_featured_listings')}}">Featured Listings</div>
                                                </a>
                                            </li>
                                            <li>
                                                   <a href="javascript:void(0);"> <div class="menu-name link" data-action="{{route('dealer_inquiries')}}">Leads</div></a>
                                            </li>
                                            <!--<li>
                                                <a href="../my-account/index.html" target="_blank">
                                                    <div class="menu-names">Leads History</div>
                                                </a>
                                            </li>-->
                                        </ul>
										@endif
                                    </div>
                                </div>
                                <!-- Middle Content Area  End -->
                            </div>
                            <br />
                            <div class="form-group">
							@if(!empty(auth()->guard('web')->user()))
                                <a href="{{route('listings.create')}}" class="btn btn-primary pull-right"><i class="fa fa-plus"></i> Create Listing</a>
							@endif
                                <div class="clearfix"></div>
                            </div>
                            <div id="carspot_res">
                                <div class="profile-section margin-bottom-20">
                                    <div class="profile-tabs">
                                        <div class="tab-content">
                                            <div class="profile-edit tab-pane fade in active" id="profile">
					<h2 class="review_heading">Review</h2>
					@if(!empty($ratings))
					<ul class="review_list">
					    
					    @foreach($ratings as $rating)
						<li class="clearfix">
							<i class="user_icon"> <img src="assets/assets/images/user.png" alt=""/> </i>
							<div class="user_review">
								<h5>{{$users[$rating->customers_id]->name}}</h5>
								@for($i=1;$i<=$rating->ratings;$i++)
                                                    <i class="fa fa-star"></i>
												@endfor
												@for($j=$rating->ratings+1;$j<6;$j++)
													<i class="fa fa-star-o"></i>
												@endfor
                                                    <span class="rating-count">
													{{ $rating->ratings }}
                                                   </span>
								<p>
									{{$rating->reviews}}
								</p>
							</div>
						</li>
						@endforeach
					</ul>
					@else
					<p>No Reviews</p>
					@endif
					
					</div>
					</div>
                        </div>
						 </div>
            </div>
                    </section>
               
        </div>
    </div>
	</div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        (function($){
            $(document).on('click','.link', function(){

                $('#carspot_res').addClass('spinner');
                var action = $(this).attr('data-action');
                $.get(action, function(data){
                    $('#carspot_res').html(data);
                }).done(function() {
                    $('#carspot_res').removeClass('spinner');
                });
            });
            $(document).on('submit', '.ajax-profile-submit', function(e){
                $('#carspot_res').addClass('spinner');
                e.preventDefault();
                var $form = $(this);
                var formData = new FormData(this);
                $.ajax({
                    type: "POST",
                    url: $form.attr('action'),
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    async:false,
                    success : function(data){
                        window.location.reload('true');
                    },
                    error : function(jqXhr, json, errorThrown){
                        var errors = jqXhr.responseJSON;
                        var errorStr = '';
                        $.each( errors, function( key, value ) {
                            $('input[name="'+key+'"]').parents('.form-group').addClass("has-error");
                            errorStr += '- ' + value[0] + '<br/>';
                        });
                        var errorsHtml= '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + errorStr + '</div>';
                        $form.prepend(errorsHtml);
                    },
                    complete : function(){
                        $('#carspot_res').removeClass('spinner');
                    }
                });
            });
        })(jQuery);
    </script>
@endsection
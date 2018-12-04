@extends('frontend.layouts.app')
@section('styles')
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/assets/css/font-awesome.css')}}" media="screen">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/assets/css/global.css')}}" media="screen">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/assets/css/style.css')}}" media="screen">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/assets/css/responsive.css')}}" media="screen">
@endsection
@section('content')
    <div class="main-content-area clearfix">
        <section class="section-padding no-top gray">
            <!-- Main Container -->
            <div class="container">
                <!-- Row -->
                <div class="row">
                        <div class="col-md-8 col-xs-12 col-sm-8">

                        </div>

                    <!-- Middle Content Area -->
                    <div class="col-md-8 col-xs-12 col-sm-12">
                        <div>
                            <h1>&nbsp;</h1>
                            <h1 style="display:inline-block;margin-bottom:5px">{{count($listing->make) ? $listing->make->name : ''}} {{count($listing->model) ? $listing->model->name : ''}}</h1>
                            <div class="singleprice-tag">
                                @php($whole = floor($lowest_listing->price))
                                @if($lowest_listing->price-$whole > 0)
                                    @php($lowest_price = number_format($lowest_listing->price,2))
                                @else
                                    @php($lowest_price = number_format($lowest_listing->price))
                                @endif
                                Lease&nbsp;for&nbsp;as&nbsp;low&nbsp;as&nbsp;<bold>${{$lowest_price}}/mo.</bold>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!-- Single Ad -->
                        <div class="singlepage-detail">
                            <div class="featured-ribbon"><span>Featured</span></div>
                            @if(count($listing->images)>0)
                                <div id="single-slider" class="flexslider" style="overflow: hidden;">
                                    <ul class="slides">
                                        @foreach($listing->images->sortBy('image_order') as $image)
                                            <li>
                                                <a href="{{asset('assets/car_images/'.$image->make_id.$image->model_id.'/'.$image->file_name)}}" data-fancybox="group">
                                                    <img alt="{{count($listing->make) ? $listing->make->name : ''}} {{count($listing->model) ? $listing->model->name : ''}}" src="{{asset('assets/car_images/'.$image->make_id.$image->model_id.'/'.$image->file_name)}}">
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                                <!-- Listing Slider Thumb -->
                                <div id="carousel" class="flexslider">
                                    <ul class="slides">
                                        @foreach($listing->images->sortBy('image_order') as $image)
                                            <li><img alt="{{count($listing->make) ? $listing->make->name : ''}} {{count($listing->model) ? $listing->model->name : ''}}" draggable="false" src="{{asset('assets/car_images/'.$image->make_id.$image->model_id.'/'.$image->file_name)}}"></li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <!-- Heading Area -->
                            <div class="key-features">
                                <div class="boxicon">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Engine Type" href="javascript:void(0)">
                                        <i class="flaticon-gas-station-1 petrol"></i>
                                        <p>Petrol</p>
                                    </a>
                                </div>
                                <div class="boxicon">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Mileage" href="javascript:void(0)">
                                        <i class="flaticon-dashboard-1 kilo-meter"></i>
                                        <p> 17,000 Km</p>
                                    </a>
                                </div>
                                <div class="boxicon">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Engine Capacity" href="javascript:void(0)">
                                        <i class="flaticon-tool engile-capacity"></i>
                                        <p>2500</p>
                                    </a>
                                </div>
                                <div class="boxicon">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Year" href="javascript:void(0)">
                                        <i class="flaticon-calendar reg-year"></i>
                                        <p>2010</p>
                                    </a>
                                </div>
                                <div class="boxicon">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Transmission Type" href="javascript:void(0)">
                                        <i class="flaticon-gearshift transmission"></i>
                                        <p>Manual</p>
                                    </a>
                                </div>
                                <div class="boxicon">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Body Type" href="javascript:void(0)">
                                        <i class="flaticon-transport-1 body-type"></i>
                                        <p>Sedan</p>
                                    </a>
                                </div>
                                <div class="boxicon">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Color Family" href="javascript:void(0)">
                                        <i class="flaticon-cogwheel-outline car-color"></i>
                                        <p>Black</p>
                                    </a>
                                </div>

                            </div>
                            <div class="content-box-grid margin-top-20">

                                <div class="short-features">
                                    <ul class="accordion">
                                        <li id="first_accor" class="open">
                                            <h3 class="accordion-title">
                                                <a href="#">
                                                    <div class="heading-panel">
                                                        <h3 class="main-title text-left">
                                                            Description
                                                        </h3>
                                                    </div>
                                                </a>
                                            </h3>
                                            <div class="accordion-content" style="display: block;">
                                                <div class="row">
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Price</strong> :</span> $ 45,200 </div>
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Date</strong> :</span> July 21, 2017</div>
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Mileage</strong> :</span> 17000</div>
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Condition</strong> :</span> Used</div>
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Type</strong> :</span> Sell</div>
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Warranty</strong> :</span> No</div>
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Year</strong> :</span> 2010</div>
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Body Type</strong> :</span> Sedan</div>
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Transmission</strong> :</span> Manual</div>
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Engine Size</strong> :</span> 2500</div>
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Engine Type</strong> :</span> Petrol</div>
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Assembly</strong> :</span> Local</div>
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Color</strong> :</span> Black</div>
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Insurance</strong> :</span> Yes</div>
                                                    <div class="col-sm-12 col-md-12 col-xs-12 location-exit">

                                                        <span><strong>Location</strong> :</span>
                                                        <a href="../../search-cars/indexb97d.html?country_id=380">Kingman</a>, <a href="../../search-cars/index088e.html?country_id=292">Arizona</a>, <a href="../../search-cars/index617c.html?country_id=230">United States</a>
                                                    </div>
                                                    <div class="col-sm-12 col-md-12 col-xs-12 location-exit">
                                                        <p> My Bmw M3 HPI Clear. Just been serviced along with new Auxiliary and AC belts, Brake Pads+ Discs and a brake fluid change</p>
                                                        <p> Full service History, Lots of paperwork, Good Condition In+ Out, Sat Nav + Aux, IPhone connectivity, Harmon Kardon Speakers, MOT March 2018. Hardtop included. The more desirable Manual! covered 94,000 miles with all MOT&#8217;s to back it up with. Lovely to drive and listen too.</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                    <!-- Heading Area -->
                                </div>
                                <div class="desc-points">
                                    <!-- Heading Area -->
                                    <div class="heading-panel margin-top-20">
                                        <h3 class="main-title text-left">
                                            Car Features									 </h3>
                                    </div>
                                    <ul class="car-feature-list ">
                                        <li> <i class="flaticon-air-conditioner-1"></i>Air Conditioning</li>
                                        <li> <i class="flaticon-rim"></i>Alloy Rims</li>
                                        <li> <i class="flaticon-antenna"></i>AM/FM Radio</li>
                                        <li> <i class="flaticon-car-4"></i>Immobilizer Key</li>
                                        <li> <i class="flaticon-location"></i>Navigation System</li>
                                        <li> <i class="flaticon-power-button"></i>Power Locks</li>
                                        <li> <i class="flaticon-car-door"></i>Power Mirrors</li>
                                        <li> <i class="flaticon-car-steering-wheel"></i>Power Steering</li>
                                        <li> <i class="flaticon-car-door"></i>Power Windows</li>
                                        <li> <i class="flaticon-photo-camera-1"></i>Reversing Camera</li>
                                    </ul>
                                </div>
                                <div class="tags-share clearfix">
                                    <div class="tags pull-left ">
                                        <i class="fa fa-tags"></i>
                                        <ul>
                                            <li>
                                                <a href="../../ad_tag/bmw/index.html" title="Bmw">
                                                    #Bmw                                </a>
                                            </li>
                                            <li>
                                                <a href="../../ad_tag/m3/index.html" title="M3">
                                                    #M3                                </a>
                                            </li>
                                            <li>
                                                <a href="../../ad_tag/m3-black/index.html" title="M3 Black">
                                                    #M3 Black                                </a>
                                            </li>
                                            <li>
                                                <a href="../../ad_tag/sports-car/index.html" title="Sports Car">
                                                    #Sports Car                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="clearfix"></div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="margin-top-30 margin-bottom-30">
                            </div>

                            <div class="modal fade report-quote" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&#10005;</span><span class="sr-only">Close</span></button>
                                            <h3 class="modal-title">Why are you reporting this ad?</h3>
                                        </div>
                                        <div class="modal-body">
                                            <!-- content goes here -->
                                            <form>
                                                <div class="skin-minimal">
                                                    <div class="form-group col-md-12 col-sm-12">
                                                        <ul class="list">
                                                            <li>
                                                                <select class="alerts" id="report_option">
                                                                    <option value="Spam">Spam</option>
                                                                    <option value="Offensive">Offensive</option>
                                                                    <option value="Duplicated">Duplicated</option>
                                                                    <option value="Fake">Fake</option>
                                                                </select>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <div class="form-group  col-md-12 col-sm-12">
                                                    <label></label>
                                                    <textarea placeholder="Write your comments." rows="3" class="form-control" id="report_comments"></textarea>
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-12 col-sm-12 margin-bottom-20 margin-top-20">
                                                    <input type="hidden" id="ad_id" value="39" />
                                                    <button type="button" class="btn btn-theme btn-block" id="sb_mark_it">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="clearfix"></div>
                            <!-- ********************************************** -->
                            <div class="content-box-grid margin-top-20">
                                <div class="desc-points">
                                    <div class="heading-panel margin-top-20">
                                        <h3 class="main-title text-left">Dealers</h3>
                                    </div>
                                </div>
                                <div class="content-box-grid margin-top-20 table-responsive">
                                    <div class="row" >
                                        <table class="table table-striped event">
                                            <thead>
                                            <tr>
                                                <th width="17%" style="vertical-align: middle;">Dealers</th>
                                                <th width="13%" style="vertical-align: middle;">Lease Term</th>
                                                <th width="13%" style="vertical-align: middle;">Down Payment</th>
                                                <th width="13%" style="vertical-align: middle;">Annual Mileage</th>
                                                 <th width="13%" style="vertical-align: middle;">State</th>
                                                <th width="13%" style="vertical-align: middle;">Lease Price</th>
                                                <th width="13%" style="vertical-align: middle;">Sell Price</th>
                                                <th width="18%" style="vertical-align: middle;">Buy/Sell</th>
                                            </tr>
                                            </thead>
                                            <tbody>
											@if(!empty($listing))
                                                <tr>
                                                    <td class="text-center">
                                                        <div class="author">
                                                            <div class="profile-image">
                                                                <a href="{{route('get_profile',$listing->dealer->uuid)}}">
                                                                    <img alt="" src="{{asset($listing->dealer->photo != "" ? "assets/user_files/".$listing->dealer->uuid."/".$listing->dealer->photo : "assets/user_files/no-image.jpg" )}}">
                                                                </a>
                                                            </div>
                                                            <h5>{{$listing->dealer->name}}</h5>
                                                        </div>
                                                    </td>
                                                    <td style="vertical-align: middle;">{{$listing->terms}} Months</td>
                                                    <td style="vertical-align: middle;">
                                                        @php($whole = floor($listing->down_payment))
                                                        @if($listing->down_payment-$whole > 0)
                                                            ${{number_format($listing->down_payment,2)}}
                                                        @else
                                                            ${{number_format($listing->down_payment)}}
                                                        @endif
                                                    </td>
                                                    <td style="vertical-align: middle;">{{$listing->mileage}}</td>
                                                    <td style="vertical-align: middle;">{{$listing->dealer->state}}</td>
                                                    <td style="vertical-align: middle;">
                                                        @if($listing->type == 1)
                                                            SELL ONLY
                                                        @else
                                                            @php($whole = floor($listing->price))
                                                            @if($listing->price-$whole > 0)
                                                                ${{number_format($listing->price,2)}} / month
                                                            @else
                                                                ${{number_format($listing->price)}} / month
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        @if($listing->type == 0)
                                                           LEASE ONLY
                                                        @elseif($listing->type == 1)
                                                            @php($whole = floor($listing->price))
                                                            @if($listing->price-$whole > 0)
                                                                ${{number_format($listing->price,2)}}
                                                            @else
                                                                ${{number_format($listing->price)}}
                                                            @endif
                                                        @else
                                                            @php($whole = floor($listing->sell_price))
                                                            @if($listing->sell_price-$whole > 0)
                                                                ${{number_format($listing->sell_price,2)}}
                                                            @else
                                                                ${{number_format($listing->sell_price)}}
                                                            @endif
                                                        @endif
                                                    </td>
                                                    <td style="vertical-align: middle;">
                                                        <div class="form-group">
                                                            @if($listing->type == 0 || $listing->type == 2)
                                                                <a href="{{route('lease',$listing->uuid)}}" class="btn btn-danger" data-toggle="ajax-modal" style="min-width:100px">Lease</a>
                                                            @else
                                                                <a href="javascript:void(0)" class="btn btn-danger" style="min-width:100px" disabled>Lease</a>
                                                            @endif
                                                        </div>
                                                        <div class="form-group">
                                                            @if($listing->type == 1 || $listing->type == 2)
                                                                <a href="{{route('buy',$listing->uuid)}}" class="btn btn-danger" data-toggle="ajax-modal" style="min-width:100px">Buy</a>
                                                            @else
                                                                <a href="javascript:void(0)" class="btn btn-danger" style="min-width:100px" disabled>Buy</a>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
											@endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-12">
                        <h1>&nbsp;</h1>
						<div class="sidebar">
                         <div class="bid-info">
                                <div data-toggle="modal" data-target=".share-ad" class="small-box col-md-6 col-sm-4 col-xs-12">
                                    <i class="fa fa-share-alt"></i>
                                    <span class="share">Share</span>
                                </div>
                                <a class="small-box col-md-6 col-sm-4 col-xs-12" href="#" id="ad_to_fav" data-adid="39">
								@if(empty($favorites))
									<input type="hidden" value="{{$listing->uuid}}" id="uuid">
							   <i class="fa fa-heart-o active" id="heart"></i>
 
										<span class="showtext">Add to favorite
                                        </span>
									@else
										<input type="hidden" value="{{$listing->uuid}}" id="uuid">
										  <i class="fa fa-heart active" id="heart"><span class="showtext">Added to favorites
                                        </span></i>
									  @endif
										
                                </a>
                            </div>
                            <div class="bid-info">
                                <div class="small-box  col-md-4 col-sm-4 col-xs-12">
                                    <h4>All Dealers</h4>
                                    <a href="#tab1default">{{count($dealer_listings)}}</a>
                                </div>
                                <div class="small-box col-md-4 col-sm-4 col-xs-12">
                                    <h4>Highest</h4>
                                    <a href="#tab1default">
                                        @php($whole = floor($highest_listing->price))
                                        @if($highest_listing->price-$whole > 0)
                                            ${{number_format($highest_listing->price,2)}}/month
                                        @else
                                            ${{number_format($highest_listing->price)}}/month
                                        @endif
                                    </a>
                                </div>
                                <div class="small-box  col-md-4 col-sm-4 col-xs-12">
                                    <h4>Lowest</h4>
                                    <a href="#tab1default">
                                        @php($whole = floor($lowest_listing->price))
                                        @if($lowest_listing->price-$whole > 0)
                                            ${{number_format($lowest_listing->price,2)}}/month
                                        @else
                                            ${{number_format($lowest_listing->price)}}/month
                                        @endif
                                    </a>
                                </div>
                            </div>
                            <div class="white-bg user-contact-info">
                                <div class="user-info-card">
                                    <div class="user-photo col-md-4 col-sm-3  col-xs-4">
                                        <a href="{{route('get_profile',$listing->dealer->uuid)}}">
                                            <img class="img-circle" alt="Profile Pic" src="{{asset($lowest_listing->dealer->photo != "" ? "assets/user_files/".$lowest_listing->dealer->uuid."/".$lowest_listing->dealer->photo : "assets/user_files/no-image.jpg" )}}">
                                        </a>
                                    </div>
                                    <div class="user-information  col-md-8 col-sm-9 col-xs-8">

                                        <span class="user-name">
                                            <a class="hover-color" href="profile">
                                                {{$lowest_listing->dealer->name}}
                                            </a>
                                        </span>
                                        <div class="item-date">
                                            <a href="../../author/emily_user/index10b0.html?type=1">
                                                <div class="rating">
												@for($i=1;$i<=$avg_rating;$i++)
                                                    <i class="fa fa-star"></i>
												@endfor
												@for($j=$avg_rating+1;$j<6;$j++)
													<i class="fa fa-star-o"></i>
												@endfor
                                                    <span class="rating-count">
													{{ $avg_rating }}
                                                   </span>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="posts-masonry">
                                @if(count($featured_listings) > 0)
                                    @foreach($featured_listings as $featured_listing)
                                        @if($featured_listing->uuid != $listing->uuid)
                                        <div class="col-md-12 col-xs-12 col-sm-6">
                                            <div class="category-grid-box">
                                        <!-- Ad Img -->
                                        <div class="category-grid-img">
                                            <a href="https://www.youtube.com/watch?v=lr7mPzjTgC0" class="play-video"><img src="{{asset('assets/images/2017/08/playbutton-u693-r.png')}}" alt="Icon"></a>
                                            <img src="{{$featured_listing->image}}" alt="2010 BMW M3 for sale in black" class="img-responsive">
                                            <!-- Ad Status -->
                                            <span class="ad-status">Featured</span>
                                            <!-- User Review -->
                                            <div class="user-preview">
                                                <a href="profile">
                                                    <img src="{{asset('assets/images/2018/01/ags6-80x80.jpg')}}" class="avatar avatar-small" >
                                                </a>
                                            </div>
                                            <!-- View Details -->
                                            <a href="detail" class="view-details">View Details</a>
                                            <!-- Additional Info -->
                                            <div class="additional-information">
                                                <p>Transmission: Manual</p>
                                                <p>Body Type: Sedan</p>
                                                <p>Condition: Used</p>
                                                <p>Posted on: July 21, 2017</p>
                                            </div>
                                            <!-- Additional Info End-->
                                        </div>
                                        <!-- Ad Img End -->
                                        <div class="short-description">
                                            <!-- Category Title -->
                                            <div class="category-title"> <span class="padding_cats"><a href="indexe47b.html?cat_id=71">BMW</a></span><span class="padding_cats"><a href="indexc248.html?cat_id=141">M series</a></span> </div>
                                            <h3><a title="" href="{{route('listings.show',$listing->uuid)}}">{{count($featured_listing->make) ? $featured_listing->make->name : ''}} {{count($featured_listing->model) ? $featured_listing->model->name  : ''}}</a></h3>
                                            <div class="price">${{$featured_listing->price}}</div>
                                        </div>
                                        <!-- Addition Info -->
                                        <div class="ad-info">
                                            <ul class="list-unstyled">
                                                <li><i class="flaticon-gas-station-1"></i>Petrol</li>
                                                <li><i class="flaticon-dashboard"></i>17,000 Km</li>
                                                <li><i class="flaticon-engine-2"></i>2,500 cc</li>
                                            </ul>
                                        </div>
                                    </div>
                                        </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>
								<button type="button" class="btn">Submit</button>
					</div>
				</div>
			</div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('assets/assets/js/jquery-1.10.2.min.js')}}"></script>
		<script type="text/javascript" src="{{asset('assets/assets/js/site.js')}}"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/
libs/jquery/1.3.0/jquery.min.js"></script>
<script type="text/javascript">
	$(function() {
        $("#ad_to_fav").click(function() 
		{
            var key = $('#uuid').val();
            $.post('{{url('list_favorite')}}',{"key":key,"_token": "{{ csrf_token() }}"},function(result){
			 if(result==1)
			 {
				 $('#heart').removeClass('fa-heart-o').addClass('fa-heart');
				 $(".showtext").text("Added To Favorites");
			 }
			 else if(result==2)
			  {
				   $('#heart').removeClass('fa-heart').addClass('fa-heart-o');
					$(".showtext").text("Add To Favorite");
			  }
			  else
			 {
				 window.location.href="/login";
			 }
			});
        });
	})
		   </script>

		   @endsection
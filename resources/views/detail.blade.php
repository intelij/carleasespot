@extends('frontend.layouts.app')
@section('styles')
	<link rel="shortcut icon" type="image/x-icon" href="favicon.ico">
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/assets/css/font-awesome.css')}}" media="screen">
		<!--link rel="stylesheet" type="text/css" href="{{asset('assets/assets/css/global.css')}}" media="screen"-->
		<link rel="stylesheet" type="text/css" href="{{asset('assets/assets/css/style.css')}}" media="screen">
		<link rel="stylesheet" type="text/css" href="{{asset('assets/assets/css/responsive.css')}}" media="screen">
@endsection
@section('content')
    <!-- Navigation Menu End -->
    <!-- =-=-=-=-=-=-= Light Header End  =-=-=-=-=-=-= -->
    <div class="main-content-area clearfix">
        <section class="section-padding no-top gray">
            <!-- Main Container -->
            <div class="container">
                <!-- Row -->
                <div class="row">
                    <div class="pricing-area">
                        <div class="col-md-9 col-xs-12 col-sm-8">
                            <div class="heading-zone">
                                <h1>&nbsp;</h1>
                              
                                <h1>{{$car->year.' '.$car->make_name.' '.$car->model_name.' '.$car->name}}</h1>
                                
                            </div>
                        </div>

                        <div class="col-md-3 col-sm-4 detail_price col-xs-12">
                            <h1>&nbsp;</h1>

                            <div class="singleprice-tag">
                                Lease&nbsp;for&nbsp;as&nbsp;low&nbsp;as&nbsp;${{$min_price}}/mo.
                            </div>
                        </div>

                    </div>
                    <!-- Middle Content Area -->
                    <div class="col-md-8 col-xs-12 col-sm-12">
                        <!-- Single Ad -->
                        <div class="singlepage-detail">
                            @if($featured == 1)

                            <div class="featured-ribbon"><span>Featured</span></div>
                            @endif
                            <div id="single-slider" class="flexslider">
                                <ul class="slides">
                                    @if($car->images)
                                        <?php
                                            $images = explode(',', $car->images);
                                        ?>
                                        @if(count($images))
                                            @foreach($images as $image)
                                           
                                             @if($image == $car->youtube_link)
                                             <li>
                                        <iframe width="560" height="560" src="https://www.youtube.com/embed/{{$car->youtube_link}}" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                      
                                    </li> @else
                                     <li>
                                                <div class="single_slide_img" style="background-image:url({{ asset('assets/car_images/model_images/'. $image) }});">
                                                </div>
                                            </li>
                                            @endif
                                            @endforeach
                                        @else
                                            <li>
                                                <div class="single_slide_img" style="background-image:url({{asset(' assets/images/2017/06/2016HYS020002_640_01.png ')}});">
                                                </div>
                                            </li>
                                        @endif
                                    @else
                                        <li>
                                            <div class="single_slide_img" style="background-image:url({{asset('assets/images/2017/06/2016HYS020002_640_01.png ')}});">
                                            </div>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <!-- Listing Slider Thumb -->
                            <div id="carousel" class="flexslider">
                                <ul class="slides">
                                    @if(isset($images))
                                    @foreach($images as $image)
                                    
                                  @if($image == $car->youtube_link)
                                                 <li class="slider-youtube-img">
                                          <div class="flex_slider_img" style="background-image:url(https://img.youtube.com/vi/{{$car->youtube_link}}/0.jpg);">
                                      </div>
                                      <a class="img-ab" href="#"></a>
                                    </li> @else
                                    <li>
                                      <div class="flex_slider_img" style="background-image:url({{asset('assets/car_images/model_images/'.$image)}});">
                                      </div>
                                  </li>
                                            @endif
                                    @endforeach
                                    @endif
                                </ul>
                            </div>
                            <!-- Heading Area -->
                            <div class="key-features">
                                <div class="boxicon">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Engine Type" href="javascript:void(0)">
                                        <i class="flaticon-gas-station-1 petrol"></i>
                                        <p>{{$car->car_engine}}</p>
                                    </a>
                                </div>
                                <div class="boxicon">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Mileage" href="javascript:void(0)">
                                        <i class="flaticon-dashboard-1 kilo-meter"></i>
                                        <p>{{$car->mileage}}</p>
                                    </a>
                                </div>
                                <div class="boxicon">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Engine Capacity" href="javascript:void(0)">
                                        <i class="flaticon-tool engile-capacity"></i>
                                        <p>{{$car->car_engine_size}}</p>
                                    </a>
                                </div>
                                <div class="boxicon">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Year" href="javascript:void(0)">
                                        <i class="flaticon-calendar reg-year"></i>
                                        <p>{{$car->year}}</p>
                                    </a>
                                </div>
                                <div class="boxicon">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Transmission Type" href="javascript:void(0)">
                                        <i class="flaticon-gearshift transmission"></i>
                                        <p >{{$car->transmission_name}}</p>
                                    </a>
                                </div>
                                <div class="boxicon">
                                    <a data-toggle="tooltip" data-placement="bottom" title="Body Type" href="javascript:void(0)">
                                        <i class="flaticon-transport-1 body-type"></i>
                                        <p>{{$car->car_type}}</p>
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

                                                        <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Year</strong> :</span> {{$car->year}}</div>

                                                        <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Body Style</strong> :</span> {{ ucfirst($car->car_type) }}</div>

                                                        <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Passenger Capacity</strong> :</span> {{ ucfirst($car->passenger_capacity) }}</div>

                                                        <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Fuel Type</strong> :</span> {{ ucfirst($car->car_engine) }}</div>
                                                        <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Engine</strong> :</span> {{ ucfirst($car->car_engine_size) }}</div>
                                                        <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Transmission</strong> :</span> {{ ucfirst($car->transmission_name) }}</div>

                                                        <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Basic Waarranty</strong> :</span> {{ ucfirst($car->basic_warranty) }}</div>

                                                        <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Drivetrain Warranty</strong> :</span> {{ ucfirst($car->drivetrain_warranty) }}</div>
                                                        <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Free Maintenance</strong> :</span> {{ ucfirst($car->free_maintenance) }}</div>
                                                        
                                                        <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Horse Power</strong> :</span> {{ ucfirst($car->horsepower) }}</div>
                                                        
                                                        
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
                                        <?php $comfort_convenience_options = explode(',', $car->comfort_convenience_options); ?>
                                        @foreach( $comfort_convenience_options as $comfort_convenience_option)
                                            <li><i class="fa fa-fw fa-check" style="vertical-align: middle; font-size:16px; margin-right: 0;color:#6bc242;"></i><span style="font-size: 14px;">{{ ucfirst(trim($comfort_convenience_option)) }}</span></li>
                                        @endforeach
                                    </ul>
                                </div>
                                <div class="clearfix" style="text-align: center; margin-top: 20px; margin-bottom: 10px;">
                                    <a href="#show_more_specs" id="learn_more_btn" class="btn btn-danger">Learn More <i class="fa fa-angle-down"></i></a>
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

                            <!--/div -->
                        </div>
                    </div>
                    <div class="col-md-4 col-xs-12 col-sm-12">
                        <div class="sidebar">
                            <div class="bid-info">
                                    <div data-toggle="modal" data-target=".share-ad" class="small-box col-md-6 col-sm-4 col-xs-12">
                                        <i class="fa fa-share-alt"></i> 
                                        <span class="hidetext">Share</span>
                                    </div>
                                    <a class="small-box col-md-6 col-sm-4 col-xs-12" href="javascript:void(0);" id="ad_to_fav" data-adid="39">
                                        <i class="fa fa-heart-o active"></i>
                                        <span class="hidetext">
                                            Add to favorite           
                                        </span>
                                    </a>
                            </div>
                            <div class="bid-info">
                                <div class="small-box  col-md-4 col-sm-4 col-xs-12">
                                    <h4>All Dealers</h4>
                                    <a href="#tab1default">{{ $count_dealer }}</a>
                                </div>
                                <div class="small-box  col-md-4 col-sm-4 col-xs-12">
                                    <h4>Higest</h4>
                                    <a href="#tab1default"><small>$ </small>{{ number_format($max_price) }} /mo.</a></div>
                                <div class="small-box  col-md-4 col-sm-4 col-xs-12">
                                    <h4>Lowest</h4>
                                    <a href="#tab1default"><small>$ </small>{{ number_format($min_price) }} /mo.</a>
                                </div>
                            </div>
                            <div class="white-bg user-contact-info">
                                <div class="user-info-card">
                                    <div class="user-photo col-md-4 col-sm-3  col-xs-4">
                                        <a href="profile" class="link">
                                            <img alt="" src="{{asset($lowest_dealer->photo != '' ? 'assets/user_files/'.$lowest_dealer->uuid.'/'.$lowest_dealer->photo : 'assets/user_files/no-image.jpg' )}}">
                                        </a>
                                    </div>
                                    <div class="user-information  col-md-8 col-sm-9 col-xs-8">

                                        <span class="user-name">
                                            <a class="hover-color" href="profile">
                                                @if($lowest_dealer)
                                                    {{ $lowest_dealer->name }}
                                                @endif
                                            </a>
                                        </span>
                                        <div class="item-date">
                                            <a href="../../author/emily_user/index10b0.html?type=1">
                                                <div class="rating">
                                                   @for($i=1;$i<=$avg_rating;$i++)
                                                    <i class="fa fa-star"></i>
												@endfor
												@for($j=$avg_rating+1;$j< 6;$j++)
													<i class="fa fa-star-o"></i>
												@endfor
                                                    <span class="rating-count">
													{{ $avg_rating }}
                                                   </span>
                                                </div>
                                            </a>
                                            <span class="label label-success">
                                                Cheapest Dealer						
                                            </span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                            <div class="posts-masonry">
                                <?php
                                    $count = 0;
                                ?>
                                @if(count($featured_listings) > 0)
                                    @foreach($featured_listings as $featured_listing)
                                        @if($count < 3)
                                        <div class="col-md-12 col-xs-12 col-sm-6">
                                            <div class="category-grid-box">
                                                <!-- Ad Img -->
                                                <div class="category-grid-img">
                                                    <a href="https://www.youtube.com/watch?v=lr7mPzjTgC0" class="play-video"><img src="{{asset('assets/images/2017/08/playbutton-u693-r.png')}}" alt="Icon"></a>
                                                    @if($featured_listing->images)
                                                        <?php
                                                            $images = explode(',', $featured_listing->images);
                                                        ?>
                                                        @if(count($images))
                                                            <img src="{{asset('assets/car_images/model_images/'.$images[0])}}" alt="2010 BMW M3 for sale in black" class="img-responsive">
                                                        @else
                                                            <img src="asset('assets/images/2017/06/2016HYS020002_640_01.png')}}" alt="2010 BMW M3 for sale in black" class="img-responsive">
                                                        @endif
                                                    @else
                                                        <img src="asset('assets/images/2017/06/2016HYS020002_640_01.png')}}" alt="2010 BMW M3 for sale in black" class="img-responsive">
                                                    @endif
                                                    <!-- Ad Status -->
                                                    <span class="ad-status">Featured</span>
                                                    <!-- User Review -->
                                                    <div class="user-preview">
                                                        <a href="profile">
                                                            <img src="{{asset($lowest_dealer->photo != '' ? 'assets/user_files/'.$lowest_dealer->uuid.'/'.$lowest_dealer->photo : 'assets/user_files/no-image.jpg' )}}" class="avatar avatar-small" >
                                                        </a>
                                                    </div>
                                                    <!-- View Details -->
                                                    <a href="{{url('detail?trim='.$featured_listing->id_car_trim.'&featured=1')}}" class="view-details">View Details</a>
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
                                                    <h3><a title="" href="{{url('detail?trim='.$featured_listing->id_car_trim.'&featured=1')}}">{{$featured_listing->make_name }} {{$featured_listing->model_name}}</a></h3>
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
                                        <?php
                                            $count++;
                                        ?>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="dealer_container">
                <div class="content-box-grid margin-top-20">
                    <div class="desc-points">
                        <div class="heading-panel margin-top-20">
                            <h3 class="main-title text-left">Dealers</h3>
                        </div>
                    </div>
                    <div class="content-box-grid margin-top-20 table-responsive table-striped table-my-responsive">
                            <table class="table event">
                                <thead>
                                    <tr>
                                        <th width="17%" style="vertical-align: middle;">Dealers</th>
                                        <th width="17%" style="vertical-align: middle;">Lease Term</th>     
                                        <th width="17%" style="vertical-align: middle;">Down Payment</th>
                                        <th width="17%" style="vertical-align: middle;">Annual Mileage</th>
                                        <th width="17%" style="vertical-align: middle;">States</th>
                                        <th width="17%" style="vertical-align: middle;">Lease Price</th>        
                                        <th width="17%" style="vertical-align: middle;">Sell Price</th>
                                        <th width="18%" style="vertical-align: middle;">Buy/Sell</th>
                                    </tr>
                                </thead>
                                <tbody >
                                    @if(!empty($top_listings))
                                    @foreach($top_listings as $listing)
                                    <tr>
                                            
                                        <td class="text-center" style="display: block; position: relative;">
                                            
                                            <div class="author">
                                                <div class="featured-ribbon2"><span>Featured</span></div>
                                                <div class="profile-image" style="margin-left: auto; margin-right: auto;">
                                                
                                                    <a href="{{route('profile')}}">
                                                    
                                                        <img alt="" src="{{asset($listing->photo != '' ? 'assets/user_files/'.$listing->dealer_id.'/'.$listing->photo : 'assets/user_files/no-image.jpg' )}}">
                                                     
                                                    </a>
                                                </div>
                                                <div>  <h5>{{$listing->name}}</h5></div>
                                            </div>
                                        </td>
                                        <td style="vertical-align: middle; font-size: 16px; font-weight: bold;">{{$listing->terms}} Months</td>
                                        <td style="vertical-align: middle; font-size: 16px; font-weight: bold;">
                                            @php($whole = floor($listing->down_payment))
                                            @if($listing->down_payment-$whole > 0)
                                                ${{number_format($listing->down_payment,2)}}
                                            @else
                                                ${{number_format($listing->down_payment)}}
                                            @endif
                                        </td>
                                        <td style="vertical-align: middle; font-size: 16px; font-weight: bold;">{{ number_format($listing->mileage) }}</td>
                                       <td style="vertical-align: middle; font-size: 16px; font-weight: bold;">{{$listing->states}}</td>
                                        <td style="vertical-align: middle; font-size: 18px; font-weight: bold; color:red">
                                            @if($listing->type == 1)
                                                SELL ONLY
                                            @else
                                                @php($whole = floor($listing->price))
                                                @if($listing->price-$whole > 0)
                                                    ${{number_format($listing->price,2)}} /mo.
                                                @else
                                                    ${{number_format($listing->price)}} /mo.
                                                @endif
                                            @endif
                                        </td>

                                         <td style="vertical-align: middle; font-size: 16px; font-weight: bold;">
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
                                                    <a href="{{route('lease',$listing->id)}}" class="btn btn-danger" data-toggle="ajax-modal" style="min-width:100px">Lease</a>
                                                @else
                                                    <a href="javascript:void(0)" class="btn btn-danger" style="min-width:100px" disabled>Lease</a>
                                                @endif
                                            </div>
                                            <div class="form-group">
                                                @if($listing->type == 1 || $listing->type == 2)
                                                    <a href="{{route('buy',$listing->id)}}" class="btn btn-danger" data-toggle="ajax-modal" style="min-width:100px">Buy</a>
                                                @else
                                                    <a href="javascript:void(0)" class="btn btn-danger" style="min-width:100px" disabled>Buy</a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif
                                    @if(!empty($similar_listings))
                                    @foreach($similar_listings as $listing)
                                        <tr>
                                            <td class="text-center">
                                            
                                                <div class="author">
                                                    <div class="profile-image" style="margin-left: auto; margin-right: auto;">
                                                    
                                                        <a href="{{route('profile')}}">
                                                        
                                                            <img alt="" src="{{asset($listing->photo != '' ? 'assets/user_files/'.$listing->dealer_id.'/'.$listing->photo : 'assets/user_files/no-image.jpg' )}}">
                                                         
                                                        </a>
                                                    </div>
                                                  <div>  <h5>{{$listing->name}}</h5></div>
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
                                            <td style="vertical-align: middle;">{{number_format($listing->mileage)}}</td>
                                           <td style="vertical-align: middle;">{{$listing->states}}</td>
                                            <td style="vertical-align: middle; font-size: 18px; font-weight: bold; color:red">
                                                @if($listing->type == 1)
                                                    SELL ONLY
                                                @else
                                                    @php($whole = floor($listing->price))
                                                    @if($listing->price-$whole > 0)
                                                        ${{number_format($listing->price,2)}} /mo.
                                                    @else
                                                        ${{number_format($listing->price)}} /mo.
                                                    @endif
                                                @endif
                                            </td>

                                            <td style="vertical-align: middle; font-size: 18px;">
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
                                                        <a href="{{route('lease',$listing->id)}}" class="btn btn-danger" data-toggle="ajax-modal" style="min-width:100px">Lease</a>
                                                    @else
                                                        <a href="javascript:void(0)" class="btn btn-danger" style="min-width:100px" disabled>Lease</a>
                                                    @endif
                                                </div>
                                                <div class="form-group">
                                                    @if($listing->type == 1 || $listing->type == 2)
                                                        <a href="{{route('buy',$listing->id)}}" class="btn btn-danger" data-toggle="ajax-modal" style="min-width:100px">Buy</a>
                                                    @else
                                                        <a href="javascript:void(0)" class="btn btn-danger" style="min-width:100px" disabled>Buy</a>
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @endif
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>
            <div class="dealer_container">
                <div class="row">
                    <div class="col-md-12 col-xs-12 col-sm-12">
                        <div class="content-box-grid margin-top-20">
                            <div id="show_more_specs" class="content-box-grid margin-top-50">
                                <ul class="accordion">
                                    <li id="first_accor" class="open">
                                        <h3 class="accordion-title">
                                            <a href="#">
                                                <div class="heading-panel">
                                                    <h3 class="main-title text-left" style="display: block;">
                                                        {{$car->year.' '.$car->make_name.' '.$car->model_name.' '.$car->name}} Full Specification
                                                    </h3>
                                                </div>
                                            </a>
                                        </h3>
                                        <div class="accordion-content" style="display: block; font-size: 15px; line-height: 2;">
                                            <div class="row">

                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Year</strong> :</span> {{$car->year}}</div>

                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Body Style</strong> :</span> {{ ucfirst($car->car_type) }}</div>

                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Passenger Capacity</strong> :</span> {{ ucfirst($car->passenger_capacity) }}</div>
                                            </div>
                                            
                                            @if($car->basic_warranty || $car->drivetrain_warranty || $car->roadside_warranty || $car->free_maintenance)
                                            <div class="row">
                                                @if($car->basic_warranty)
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Basic Waarranty</strong> :</span> {{ ucfirst($car->basic_warranty) }}</div>
                                                @endif
                                                @if($car->drivetrain_warranty)
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Drivetrain Warranty</strong> :</span> {{ ucfirst($car->drivetrain_warranty) }}</div>
                                                @endif
                                                @if($car->roadside_warranty)
                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Roadside Warranty</strong> :</span> {{ ucfirst($car->roadside_warranty) }}</div>
                                                @endif
                                                @if($car->free_maintenance)
                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Free Maintenance</strong> :</span> {{ ucfirst($car->free_maintenance) }}</div>
                                                @endif
                                            </div>
                                            @endif
                                            <div class="row">
                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Drivetrain</strong> :</span> {{ ucfirst($car->drivetrain_name) }}</div>
                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Transmission</strong> :</span> {{ ucfirst($car->transmission_name) }}</div>
                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Mileage</strong> :</span> {{ ucfirst($car->mileage) }} MPG</div>
                                            </div>
                                            @if($car->fuel_options)
                                            <div class="row">
                                                <?php
                                                $fuel_options = json_decode($car->fuel_options,true);
                                                ?>
                                                @foreach($fuel_options as $key => $value)
                                                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>{{$key}}</strong> :</span>{{ ucfirst($value) }}</div>
                                                @endforeach
                                            </div>
                                            @endif
                                            <div class="row">
                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Base Engine Type</strong> :</span> {{ ucfirst($car->car_engine) }}</div>
                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Base Engine Size</strong> :</span> {{ ucfirst($car->car_engine_size) }}</div>
                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Horse Power</strong> :</span> {{ ucfirst($car->horsepower) }}</div>
                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Cam Type</strong> :</span> {{ ucfirst($car->engine_cam_type) }}</div>
                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Cylinders</strong> :</span> {{ ucfirst($car->cylinders) }}</div>
                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Torque</strong> :</span> {{ ucfirst($car->engine_torque) }}</div>
                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Turning Circle</strong> :</span> {{ ucfirst($car->engine_turning_circle) }}</div>
                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Valves</strong> :</span> {{ ucfirst($car->engine_valves) }}</div>
                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Direct Injection</strong> :</span> 
                                                    @if($car->engine_direct_injection == '1')
                                                        <i class="fa fa-fw fa-check" style="color:#6bc242"></i>
                                                    @else
                                                        <i class="fa fa-fw fa-times" style="color:#c9302c"></i>
                                                    @endif
                                                </div>
                                                <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Valve Timing</strong>:</span> {{ ucfirst($car->engine_valve_timing) }}</div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2"><span><strong>Safety:</strong></span></div>
                                                <div class="col-sm-10">
                                                    <?php 
                                                    $safetys = 'N/A';
                                                    if($car->safety){
                                                        $safetys = explode(',', $car->safety);    
                                                    } ?>
                                                    @if($safetys != 'N/A')
                                                        <div class="row">
                                                        @foreach($safetys as $safety)
                                                            <div class="col-md-4 col-sm-12">{{ ucfirst($safety) }}</div>
                                                        @endforeach
                                                        </div>
                                                    @else
                                                        {{ $safetys }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3"><span><strong>In-Car Entertainment:</strong></span></div>
                                                <div class="col-sm-9">
                                                    <?php 
                                                    $ices = 'N/A';
                                                    if($car->in_car_entertainment){
                                                        $ices = explode(',', $car->in_car_entertainment);    
                                                    } ?>
                                                    @if($ices != 'N/A')
                                                        <div class="row">
                                                        @foreach($ices as $ice)
                                                            <div class="col-md-6 col-sm-12">{{ ucfirst($ice) }}</div>
                                                        @endforeach
                                                        </div>
                                                    @else
                                                        {{ $ices }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3"><span><strong>Comfort & Convenience:</strong></span></div>
                                                <div class="col-sm-9">
                                                    <?php 
                                                    $cc_options = 'N/A';
                                                    if($car->comfort_convenience_options){
                                                        $cc_options = explode(',', $car->comfort_convenience_options);    
                                                    } ?>
                                                    @if($cc_options != 'N/A')
                                                        <div class="row">
                                                        @foreach($cc_options as $cc)
                                                            <div class="col-md-6 col-sm-12">{{ ucfirst($cc) }}</div>
                                                        @endforeach
                                                        </div>
                                                    @else
                                                        {{ $cc_options }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2"><span><strong>Power Feature: </strong></span></div>
                                                <div class="col-sm-10">
                                                    <?php 
                                                    $pfs = 'N/A';
                                                    if($car->power_feature){
                                                        $pfs = explode(',', $car->power_feature);    
                                                    } ?>
                                                    @if($pfs != 'N/A')
                                                        <div class="row">
                                                        @foreach($pfs as $pf)
                                                            <div class="col-md-4 col-sm-12">{{ ucfirst($pf) }}</div>
                                                        @endforeach
                                                        </div>
                                                    @else
                                                        {{ $pfs }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3"><span><strong>Instrumentation: </strong></span></div>
                                                <div class="col-sm-9">
                                                    <?php 
                                                    $insts = 'N/A';
                                                    if($car->instrumentation){
                                                        $insts = explode(',', $car->instrumentation);    
                                                    } ?>
                                                    @if($insts != 'N/A')
                                                        <div class="row">
                                                        @foreach($insts as $inst)
                                                            <div class="col-md-6 col-sm-12">{{ ucfirst($inst) }}</div>
                                                        @endforeach
                                                        </div>
                                                    @else
                                                        {{ $insts }}
                                                    @endif
                                                </div>
                                            </div>

                                            @if($car->frontseats)
                                            <div class="row">
                                                <div class="col-sm-2"><span><strong>Front Seats: </strong></span></div>
                                                <?php
                                                $frontseats = json_decode($car->frontseats,true);
                                                ?>
                                                <div class="col-sm-10">
                                                    <div class="row"> 
                                                        @foreach($frontseats as $key => $value)
                                                            <div class="col-md-6 col-sm-12"><span><strong>{{$key}}</strong>:</span>
                                                                @if(is_bool($value))
                                                                    @if($value == true)
                                                                        <i class="fa fa-fw fa-check" style="color:#6bc242"></i>
                                                                    @else
                                                                        <i class="fa fa-fw fa-times" style="color:#c9302c"></i>
                                                                    @endif
                                                                @else
                                                                    {{$value}}
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            @if($car->rearseats)
                                            <div class="row">
                                                <div class="col-sm-2"><span><strong>Rear Seats:</strong></span></div>
                                                <?php
                                                $rearseats = json_decode($car->rearseats,true);
                                                ?>
                                                <div class="col-sm-10">
                                                    <div class="row"> 
                                                        @foreach($rearseats as $key => $value)
                                                            <div class="col-md-6 col-sm-12"><span><strong>{{$key}}</strong>:</span>
                                                                @if(is_bool($value))
                                                                    @if($value == true)
                                                                        <i class="fa fa-fw fa-check" style="color:#6bc242"></i>
                                                                    @else
                                                                        <i class="fa fa-fw fa-times" style="color:#c9302c"></i>
                                                                    @endif
                                                                @else
                                                                    {{$value}}
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endif
                                            @if($car->measurements)
                                            <div class="row">
                                                <div class="col-sm-2"><span><strong>Measurements:</strong></span></div>
                                                <?php
                                                $measurements = json_decode($car->measurements,true);
                                                ?>
                                                <div class="col-sm-10">
                                                    <div class="row"> 
                                                        @foreach($measurements as $key => $value)
                                                            <div class="col-md-6 col-sm-12"><span><strong>{{$key}}</strong>:</span>
                                                                @if(is_bool($value))
                                                                    @if($value == true)
                                                                        <i class="fa fa-fw fa-check" style="color:#6bc242"></i>
                                                                    @else
                                                                        <i class="fa fa-fw fa-times" style="color:#c9302c"></i>
                                                                    @endif
                                                                @else
                                                                    {{$value}}
                                                                @endif
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                            @endif

                                            <div class="row">
                                                <div class="col-sm-2"><span><strong>Exterior Colors: </strong></span></div>
                                                <div class="col-sm-10">
                                                    @if($car->ext_colors != 'N/A')
                                                        @foreach($car->ext_colors as $ext_color)
                                                            <div class="color_section" style="background-color: #{{$ext_color->hex}};"></div>
                                                        @endforeach
                                                    @else
                                                        {{$car->ext_colors}}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2"><span><strong>Interior Colors: </strong></span></div>
                                                <div class="col-sm-10">
                                                    @if($car->int_colors != 'N/A')
                                                        @foreach($car->int_colors as $int_color)
                                                            <div class="color_section" style="background-color: #{{$int_color->hex}};"></div>
                                                        @endforeach
                                                    @else
                                                        {{$car->int_colors}}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-2"><span><strong>Tire & Wheel: </strong></span></div>
                                                <div class="col-sm-10">
                                                    <?php 
                                                    $tire_wheels = 'N/A';
                                                    if($car->tire_wheel){
                                                        $tire_wheels = explode(',', $car->tire_wheel);    
                                                    } ?>
                                                    @if($tire_wheels != 'N/A')
                                                        <div class="row">
                                                        @foreach($tire_wheels as $tire_wheel)
                                                            <div class="col-md-4 col-sm-12">{{ ucfirst($tire_wheel) }}</div>
                                                        @endforeach
                                                        </div>
                                                    @else
                                                        {{ $tire_wheels }}
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-sm-2"><span><strong>Suspension:</strong></span></div>
                                                <div class="col-sm-10">
                                                    <?php 
                                                    $suspension = 'N/A';
                                                    if($car->suspension){
                                                        $suspension = explode(',', $car->suspension);    
                                                    } ?>
                                                    @if($suspension != 'N/A')
                                                        <div class="row">
                                                        @foreach($suspension as $sus)
                                                            <div class="col-md-4 col-sm-12">{{ ucfirst($sus) }}</div>
                                                        @endforeach
                                                        </div>
                                                    @else
                                                        {{ $suspension }}
                                                    @endif
                                                </div>
                                            </div>

                                            @if($car->telematics)
                                            <div class="row">
                                                <div class="col-sm-2"><span><strong>Telematics:</strong></span></div>
                                                <div class="col-sm-10">
                                                    <?php 
                                                        $telematics = 'N/A';
                                                        $telematics = explode(',', $car->telematics);    
                                                     ?>
                                                    @if($telematics != 'N/A')
                                                        <div class="row">
                                                        @foreach($telematics as $telematic)
                                                            <div class="col-md-4 col-sm-12">{{ ucfirst($telematic) }}</div>
                                                        @endforeach
                                                        </div>
                                                    @else
                                                        {{ $telematics }}
                                                    @endif
                                                </div>
                                            </div>
                                            @endif
                                            
                                            <div class="row">
                                                <div class="col-sm-3"><span><strong>Exterior Options:</strong></span></div>
                                                <div class="col-sm-9">
                                                    <?php 
                                                    $ext_options = 'N/A';
                                                    if($car->exterior_options){
                                                        $ext_options = explode(',', $car->exterior_options);    
                                                    } ?>
                                                    @if($ext_options != 'N/A')
                                                        <div class="row">
                                                        @foreach($ext_options as $eo)
                                                            <div class="col-md-6 col-sm-12">{{ ucfirst($eo) }}</div>
                                                        @endforeach
                                                        </div>
                                                    @else
                                                        {{ $ext_options }}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-3"><span><strong>Interior Options:</strong></span></div>
                                                <div class="col-sm-9">
                                                    <?php 
                                                    $int_options = 'N/A';
                                                    if($car->interior_options){
                                                        $int_options = explode(',', $car->interior_options);    
                                                    } ?>
                                                    @if($int_options != 'N/A')
                                                        <div class="row">
                                                        @foreach($int_options as $io)
                                                            <div class="col-md-6 col-sm-12">{{ ucfirst($io) }}</div>
                                                        @endforeach
                                                        </div>
                                                    @else
                                                        {{ $int_options }}
                                                    @endif
                                                </div>
                                            </div>
                                        </div>    
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
<script type="text/javascript" src="{{asset('assets/assets/js/site.js')}}"></script>
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
        $('#learn_more_btn').click(function(){
            $( "#show_more_specs .accordion-content" ).css('display','block');
            $( "#show_more_specs #first_accor" ).addClass('open');
        });
	});

    (function( $ ) {      
        "use strict";   
        $(function() {
            $('a[href*="#"]:not([href="#"])').click(function(e) {
                if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                  var target = $(this.hash);
                  target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
                  if (target.length) {
                    $('html, body').animate({
                      scrollTop: target.offset().top
                    }, 1000);
                    return false;
                  }
                }
            });
        });   
    }(jQuery));
   </script>

@endsection
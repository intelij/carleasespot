@extends('frontend.layouts.app')
@section('content')
    <!-- Car Type Collapse -->
    <div class="collapse" id="cartype_content">
        <div class="container">
            <div class="search-form-inner-type">
                @foreach($car_types as $car_type)
                    <div class="col-md-custom1 col-sm-4 col-xs-6">
                        <div class="box">
                            <a href="{{ route('frontend.carType', $car_type->id_car_type) }} ">
                                @if($car_type->name == 'Hatchback')
                                    <img alt="Convertible" src="assets/images/CarTypes/Wagon.png" />
                                @elseif($car_type->name == 'Van/Minivan')
                                    <img alt="Convertible" src="assets/images/CarTypes/Van.png" />
                                @else
                                    <img alt="Convertible" src="assets/images/CarTypes/{{ $car_type->name }}.png" />
                                @endif
                                <h4>{{ $car_type->name }}</h4>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Car Type Collapse -->
    <div class="vc_row wpb_row vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                    <section class="simple-search" style="background: rgba(0, 0, 0, 0) url(assets/images/2017/06/banner-5.jpg) center center no-repeat; -webkit-background-size: cover; -moz-background-size: cover; -o-background-size: cover; background-size: cover;">
                        <div class="container">
                            <h1>The first ever car leasing marketplace</h1>
                            <p>Find and compare the best lease deals from thousands of dealers around the country - all on one site!</p>
                            <div class="search-holder">
                                <div id="custom-search-input">
                                    <!--form method="get" action="search"-->
                                        <div class="col-md-12 col-sm-12 col-xs-12 no-padding">
                                            <input type="text" autocomplete="off" name="search_key" id="search_key" class="form-control " placeholder="Search makes, models or trims" />
                                        </div>
                                        <!--div class="col-md-1 col-sm-1 col-xs-1 no-padding">
                                            <button class="btn btn-theme" type="submit"> <span class=" glyphicon glyphicon-search"></span> </button>
                                        </div-->
                                    <!--/form-->
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <div class="vc_row wpb_row vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                    <div class="advance-search">
                        <div class="section-search search-style-2">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                        <!-- Nav tabs -->
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item active">
                                                <a class="nav-link" data-toggle="tab" href="#tab1">Search Car In Details </a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link" data-toggle="tab" href="#tab2" id="search_ByType_btn">Search Car By Type</a>
                                            </li>
                                        </ul>
                                        <!-- Tab panes -->
                                        <div class="tab-content clearfix">
                                            <div class="tab-pane fade in active" id="tab1">
                                                <form method="get" action="search">
                                                    <div class="search-form pull-left ">
                                                        <div class="search-form-inner pull-left ">
                                                            <div class="col-md-3 no-padding">
                                                                <div class="form-group">
                                                                    {!! Form::label('make', 'Select Make') !!}
                                                                    {!! Form::select('make',$makes, null, ['class' => 'form-control input-sm chosen', 'required']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 no-padding">
                                                                <div class="form-group">
                                                                    {!! Form::label('model', 'Model',['class'=>'control-label']) !!}
                                                                    {!! Form::select('model', [''=>'Select Option'], null, ['class' => 'form-control input-sm', 'id'=>'models']) !!}
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3 no-padding">
                                                                <div class="form-group">
                                                                    {!! Form::label('trim', 'Trim',['class'=>'control-label']) !!}
                                                                    {!! Form::select('trim', [''=>'Select Option'], null, ['class' => 'form-control input-sm', 'id'=>'trims']) !!}
                                                                </div>
                                                            </div>

                                                            <div class="col-md-3 no-padding">
                                                                <div class="form-group">
                                                                    {!! Form::label('year', 'Year',['class'=>'control-label']) !!}
                                                                    {!! Form::select('year', [''=>'Select Option', '2018' => '2018', '2019' => 2019], null, ['class' => 'form-control input-sm', 'id'=>'years']) !!}
                                                                </div>
                                                            </div>

                                                           <!--  <div class="col-md-4 no-padding">
                                                                <div class="form-group">
                                                                    <label>Select Year</label>
                                                                    <select class=" orm-control" name="year_from">
                                                                        <option label="Select Year" value="">Select Year</option>
                                                                        <option value="2010">2010</option>
                                                                        <option value="2011">2011</option>
                                                                        <option value="2012">2012</option>
                                                                        <option value="2013">2013</option>
                                                                        <option value="2014">2014</option>
                                                                        <option value="2015">2015</option>
                                                                        <option value="2016">2016</option>
                                                                        <option value="2017">2017</option>
                                                                    </select>

                                                                </div>
                                                            </div> -->
                                                        </div>
                                                        <div class="form-group pull-right ">
                                                            <button type="submit" id="submit_loader" value="submit" class="btn btn-lg btn-theme">Search Now</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                            <div class="tab-pane fade" id="tab2">
                                                <form>
                                                    <div class="search-form">
                                                        <div class="search-form-inner-type">
                                                            @foreach($car_types as $car_type)
                                                                <div class="col-md-custom1 col-sm-4 col-xs-6">
                                                                    <div class="box">
                                                                        <a href="{{ route('frontend.carType', $car_type->id_car_type) }}">
                                                                            @if($car_type->name == 'Hatchback')
                                                                                <img alt="Convertible" src="assets/images/CarTypes/Wagon.png" />
                                                                            @elseif($car_type->name == 'Van/Minivan')
                                                                                <img alt="Convertible" src="assets/images/CarTypes/Van.png" />
                                                                            @else
                                                                                <img alt="Convertible" src="assets/images/CarTypes/{{ $car_type->name }}.png" />
                                                                            @endif
                                                                            <h4>{{ $car_type->name }}</h4>
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                    <section class="custom-padding  gray ">
                        <div class="container">
                            <div class="heading-panel">
                                <div class="col-xs-12 col-md-12 col-sm-12 text-center"> <h1><span class="heading-color"> Shop </span> by make</h1></div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="row">
                                        <div class="comparison-box" >
                                            @foreach($vehicle_makes as $make)
                                            <a href="{{ route('frontend.make', $make->id_car_make ) }}">
                                                <div class="col-md-1 col-sm-12 col-xs-12" style="height: 130px;">
                                                    {!! Html::image(asset('assets/images/carlogos/'.$make->niceName.'.png'), 'image', array('class' => 'img-responsive', 'style'=>'height:60px;')) !!}
                                                    <h2><p align="center" style="font-size: 14px;">{{$make->name}}</p></h2>
                                                </div>
                                            </a>
                                            @endforeach
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
    <div class="vc_row wpb_row vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                    <section class="custom-padding gray">
                        <!-- Main Container -->
                        <div class="container">
                            <!-- Row -->
                            <div class="row">
                                <div class="heading-panel">
                                    <div class="col-xs-12 col-md-12 col-sm-12 left-side">
                                        <!-- Main Title -->
                                        <h1>Latest <span class="heading-color"> Featured </span> Ads</h1>
                                        <!-- Short Description -->

                                    </div>
                                </div>

                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="row">
                                        <div class="grid-style-2">
                                            <div class="posts-masonry ads-for-home">
                                                @if(count($listings) > 0)
                                                    @foreach($listings as $listing)
                                                        <div class="col-md-4  col-lg-4 col-sm-6 col-xs-12" id=".holder-89">
                                                            <div class="category-grid-box-1">
                                                                <div class="featured-ribbon"><span>Featured</span></div>
                                                                <div class="image">
                                                                    <a href="{{url('detail?trim='.$listing->id_car_trim.'&featured=1')}}">
                                                                        @if($listing->images)
                                                                            <?php
$search=\DB::table('car_model')->where('id_car_model', $listing->id_car_model)->first();    
                             $images = explode(',', $listing->images);
                                                                            ?>
                                                                            @if(count($images))
                                        @if($search->search_image !='') 
                                        
                                        <div class="car_home_img_section" style="background-image: url({{asset('assets/car_images/model_images/'.$search->search_image)}})"></div>
                                        @else 
                                        <div class="car_home_img_section" style="background-image: url({{asset('assets/car_images/model_images/'.$images[0])}})"></div>
                                        @endif
                                                                            @endif
                                                                        @endif
                                                                    </a>
                                                                    <div class="price-tag">
                                                                        <div class="price"><span>${{$listing->price}} /mo.</span></div>
                                                                    </div>
                                                                </div>
                                                                <div class="short-description-1 clearfix" style="min-height: 510px;">
                                                                    <div class="category-title"> <span class="padding_cats"><a href="indexe47b.html?cat_id=71">{{$listing->make_name}}</a></span><span class="padding_cats"><a href="indexc248.html?cat_id=141">{{$listing->model_name}} series</a></span> </div>
                                                                    <h3> <a href="{{url('detail?trim='.$listing->id_car_trim.'&featured=1')}}">{{$listing->make_name}} {{$listing->model_name}} {{$listing->style_name}}</a></h3>
                                                                     <div class="row search_spec"> <br>
                            <div class="col-sm-4">
                                <p class="bold">{{ $listing->trim_mileage }}</p>
                                <p>MPG</p>
                            </div>
                            <div class="col-sm-4">
                                <p class="bold">{{ substr($listing->horsepower, 0, strpos($listing->horsepower,'hp')-1) }}</p>
                                <p>HP</p>
                            </div>
                            <div class="col-sm-4">
                                <p class="bold">{{ $listing->passenger_capacity }}</p>
                                <p>Seats</p>
                            </div>
                        </div>
                        <div class="row search_commone_feature" style="margin-top: 20px;">
                            <div class="col-sm-12">
                                <p class="sub_title">Highlights</p>
                                <hr/>
                                <?php 
                                    $features = explode(',', $listing->comfort_convenience_options);
                                    $i = 0;
                                    foreach($features as $feature){
                                        if($i > 2){
                                            break;   
                                        }else{
                                            echo '<p class="search_feaures">'.$feature.'</p>';
                                            if($i != 2){
                                                echo '<hr/>';
                                            }
                                            $i++;
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                                                                <!-- Addition Info -->
                    <!--div class="ad-info">
                        <ul class="list-unstyled">
                            <li><i class="flaticon-gas-station-1"></i>{{$listing->car_engine ? $listing->car_engine : 'NA'}}</li>
                            <li><i class="flaticon-dashboard"></i>{{$listing->mileage}} MPG</li>
                            <li><i class="flaticon-engine-2"></i>{{$listing->year}}</li>
                        </ul>
                    </div-->
                    <div class="row" style="margin-bottom: 5px; margin-top:20px">
                        <div class="col-sm-12" style="text-align: center;">
                            <a class="btn btn-search-red" href="{{url('/detail?trim='.$listing->id_car_trim.'&featured=1')}}">Select</a>
                        </div>
                    </div>
                </div>
                                                            <!-- Listing Ad Grid -->
                                                        </div>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
   <section>
    <div class="row m0 embeb-video">
      <div class="col-md-8 col-md-offset-2 text-center" style="margin-top:75px;">
        <img src="http://carleasespot.com/assets/images/2017/06/ipaadforvideo.png">
        <iframe src="https://www.youtube.com/embed/Qe4MsCNDJVQ" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen="" style="position:  absolute; z-index:  20; top: 27px; left: 66px; width:  670px; height:  500px;">
        </iframe>
        
      </div>
    </div>
  </section>
         <div class="page-header-area-2 gray">
<div class="vc_row wpb_row vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                    <section class="custom-padding about-us   ">
                        <div class="container">
                            <div class="row">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                    <div class="title text-center">
	                                <h3 style="width:auto;display: inline-block; text-align:left;">How Our<span class="heading-color"> Process </span> Works</h3>  <br>
	                            </div>
	                        </div>
	                         

    <section class="process-steps">
        <div class="row m0">
            <div class="col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-xs-12">
                <p class="service-summary"><span class="m-f-f-regular m-f-s-16">
	                Carleasespot gathers leasing rates from thousands of dealers around the country - all on to one site!
                </span></p>
                <img src="https://dl.dropboxusercontent.com/s/vfm0r27tydumiyf/progress-steps.png?dl=0" class="m-w-110-p m-p-t-50">        
            </div>
        </div>
      <br><br>
        <div class="row m-p-t-60 m0">
            <div class="col-xs-12 text-center">
                <span class="m-f-f-regular m-f-s-20">With carleasespot.com we go out and get all the dealers so you don't have to!</span>
            </div>
        </div>
			<br><br>
        <div class="row m-p-t-30 m0">
            <div class="col-md-2 col-md-offset-2">
                <p><span class="m-f-f-light m-f-s-24 m-col-wp">The Search</span></p>
                <p><span class="m-f-f-regular">
                        Search our database for nearly any car on the market
                </span></p>
            </div>

            <div class="col-md-2 col-md-offset-1">
                <p><span class="m-f-f-light m-f-s-24">The Selection</span></p>
                <p><span class="m-f-f-regular">
Read through the descriptions, specs and check out the photos we provide you for each car. You can even compare and contrast cars with our compare tool.                </span></p>
            </div>

            <div class="col-md-3 col-md-offset-1">
                <p><span class="m-f-f-light m-f-s-24 m-col-rd">Choose a Dealer</span></p>
                <p><span class="m-f-f-regular">
                        Once you decide on which car is right for you check out the list of dealers with their rates for that car. Compare prices & Dealers. Then you can ubmit a non-committal form to the dealer/s of choice. That dealer/s will contact you promptly to finalize the details. 

                </span></p>
            </div>

            <div class="col-md-2"></div>

        </div>

    </section>

</div>


                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>                       
    <div class="vc_row wpb_row vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                    <section class="sell-box padding-top-70">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="sell-box-grid">
                                        <div class="short-info">
                                            <h1><strong><span class="m-f-f-light m-f-s-30 m-col-rd">The Car Lease Spot Guarantee</span></strong></h1>
                                            <p><span class="m-f-f-regular">Car Lease Spot carefully vets every dealer before they are accepted to the marketplace.<br> Not only that...</span> </p>
                                        </div>
                                        <div class="text-center"><img class="img-responsive wow slideInLeft center-block" data-wow-delay="0ms" data-wow-duration="2000ms" src="assets/images/2017/06/Stamp1.png" alt="Image Not Found" /></div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-xs-12 col-sm-12">
                                    <div class="sell-box-grid">
                                        <div class="short-info">
                                            <h1><strong><span class="m-f-f-light m-f-s-30 m-col-rd">Every Dealer Price Guaranteed</span></strong></h1>
                                            <p> <span class="m-f-f-regular">Every dealer price is personally guaranteed by Carleasespot.com or we will deliver the car at the posted price ourselves!</span> </p>
                                        </div>
                                        <div class="text-center">
                                            <img class="img-responsive wow slideInRight center-block" data-wow-delay="0ms" data-wow-duration="2000ms" src="assets/images/2017/06/stamp2.png" alt="Image Not Found" />
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
    <div class="vc_row wpb_row vc_row-fluid">
        <div class="wpb_column vc_column_container vc_col-sm-12">
            <div class="vc_column-inner ">
                <div class="wpb_wrapper">
                    <section class="custom-padding  gray ">
                        <div class="container">
                            <div class="heading-panel">
                                <div class="col-xs-12 col-md-12 col-sm-12 text-center">
                                    <!-- Main Title -->
                                    <h1>Top <span class="heading-color"> Car's </span> Comparison</h1>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <div class="row">
                                        <!-- Car Comparison Archive -->
                                        <ul class="compare-masonry text-center">
                                            <li class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="comparison-box">
                                                    <a href="comparison">
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="compare-grid">
                                                                <img src="assets/images/2017/07/2-1-310x190.png" alt="" class="img-responsive" />
                                                                <h2>2016 Ford Escape Cape</h2>
                                                                <div class="rating">
                                                                    <i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-o"></i> <span class="star-score"> (<strong>4</strong>)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vsbox">vs</div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="compare-grid">
                                                                <img src="assets/images/2017/07/1-310x190.png" alt="" class="img-responsive" />
                                                                <h2>2017 Chevrolet Camaro</h2>
                                                                <div class="rating">
                                                                    <i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> <span class="star-score"> (<strong>3</strong>)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                            <li> </li>
                                            <li class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="comparison-box">
                                                    <a href="comparison">
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="compare-grid">
                                                                <img src="assets/images/2017/07/5-310x190.png" alt="" class="img-responsive" />
                                                                <h2>Mercedes-Benz C-Class</h2>
                                                                <div class="rating">
                                                                    <i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i> <span class="star-score"> (<strong>5</strong>)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vsbox">vs</div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="compare-grid">
                                                                <img src="assets/images/2017/07/6-310x190.png" alt="" class="img-responsive" />
                                                                <h2>2017 Honda CR-V</h2>
                                                                <div class="rating">
                                                                    <i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-o"></i> <span class="star-score"> (<strong>4</strong>)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                            <li> </li>
                                            <li class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="comparison-box">
                                                    <a href="comparison">
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="compare-grid">
                                                                <img src="assets/images/2017/07/7-310x190.png" alt="" class="img-responsive" />
                                                                <h2>renault suv 2016</h2>
                                                                <div class="rating">
                                                                    <i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> <span class="star-score"> (<strong>3</strong>)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vsbox">vs</div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="compare-grid">
                                                                <img src="assets/images/2017/07/8-1-310x190.png" alt="" class="img-responsive" />
                                                                <h2>2017 Toyota RAV4</h2>
                                                                <div class="rating">
                                                                    <i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-o"></i> <span class="star-score"> (<strong>4</strong>)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                            <li> </li>
                                            <li class="col-md-6 col-sm-6 col-xs-12">
                                                <div class="comparison-box">
                                                    <a href="comparison">
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="compare-grid">
                                                                <img src="assets/images/2017/07/5-310x190.png" alt="" class="img-responsive" />
                                                                <h2>Mercedes-Benz C-Class</h2>
                                                                <div class="rating">
                                                                    <i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i> <span class="star-score"> (<strong>5</strong>)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="vsbox">vs</div>
                                                        <div class="col-md-6 col-sm-12 col-xs-12">
                                                            <div class="compare-grid">
                                                                <img src="assets/images/2017/07/10-310x190.png" alt="" class="img-responsive" />
                                                                <h2>Audi A5 Sport</h2>
                                                                <div class="rating">
                                                                    <i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i><i class="fa fa-star-ofa fa-star"></i> <span class="star-score"> (<strong>5</strong>)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </div>
                                            </li>
                                            <li>
                                            </li>
                                        </ul>
                                        <div class="clearfix"></div>
                                        <div class="text-center">
                                            <div class="load-more-btn">
                                                <a href="comparison" target=" _blank" class="btn btn-lg  btn-theme"> Compare More Cars </a>
                                            </div>
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
          @section('homepage_footer')
            <div class="container">
                <div class="row">
                    <!--
                    <div class="col-md-3  col-sm-6 col-xs-12">
                        <div class="widget">
                            <div class="logo">
                                <a href="index">
                                    <img src="assets/images/2017/06/logo-2.png" class="img-responsive" alt="Site Logo">

                                </a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur et dolor eget erat fringilla port.</p>
                            <ul class="apps-donwloads">
                                <li>
                                    <a href="#"><img src="assets/images/googleplay.png" alt="Android App"></a>
                                </li>
                                <li>
                                    <a href="#"><img src="assets/images/appstore.png" alt="IOS App"></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2  col-sm-6 col-xs-12">
                        <div class="widget socail-icons">

                            <h5>Follow Us</h5>
                            <ul>
                                <li>
                                    <a class="Facebook" href="#">
                                        <i class="fa fa-facebook"></i>
                                    </a><span><a  href="#">Facebook</a></span>
                                </li>
                                <li>
                                    <a class="Twitter" href="#">
                                        <i class="fa fa-twitter "></i>
                                    </a><span><a  href="#">Twitter</a></span>
                                </li>
                                <li>
                                    <a class="YouTube" href="#">
                                        <i class="fa fa-youtube-play"></i>
                                    </a><span><a  href="#">YouTube</a></span>
                                </li>
                                <li>
                                    <a class="Pinterest" href="#">
                                        <i class="fa fa-pinterest "></i>
                                    </a><span><a  href="#">Pinterest</a></span>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-md-2  col-sm-6 col-xs-12">

                        <div class="widget my-quicklinks">
                            <h5>Quick Links</h5>
                            <ul>
                                <li><a href="search-cars/index.html">Search</a></li>
                                <li><a href="http://synergyautohub.com/register">Sell Your Car</a></li>
                                <li><a href="shop/index.html">Shop</a></li>
                                <li><a href="register/index.html">Register</a></li>
                            </ul>
                        </div>

                    </div>

                    <div class="col-md-5  col-sm-6 col-xs-12">
                        <div class="widget widget-newsletter">
                            <h5>Singup for the Carleasespot.com Newsletter </h5>
                            <div class="fieldset">
                                <p>Get notified about the latest lease specials and feature updates</p>
                                <form onSubmit="return checkVals();">
                                    <input name="sb_email" id="sb_email" placeholder="Enter your email address" type="text" autocomplete="off" required>
                                    <input class="submit-btn" id="save_email" value="Submit" type="button">
                                    <input class="submit-btn no-display" id="processing_req" value="Processing..." type="button">
                                    <input type="hidden" id="sb_action" value="footer_action" />
                                </form>
                            </div>
                        </div>
                        <div class="copyright">
                            <p>Copyright 2018 © Carleasespot.com, inc.</a></p>
                        </div>
                    </div>
                    -->
                    <div class="upper-col-add">
                        <div class="upper-col-big">
                            <div class="upper-title">
                                Cars For Sale
                            </div>
                            <div class="upper-body">
                                <div class="upper-wrapper">
                                    <div class="upper-body-item">
                                        <div>
                                            <div class="footer-side-item">
                                                <div class="footer-list">
                                                    <div class="footer-list-header">
                                                        <div class="footer-list-title">By Body Style</div>
                                                    </div>

                                                    <ul class="footer-list-body">
                                                        @foreach($car_types as $car_type)
                                                            <li class="footer-list-item"><a class="footer-list-link" href="{{ route('frontend.carType', $car_type->id_car_type) }}">{{ $car_type->name }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                        </div>
                                    </div>
                                    <div class="upper-body-item">
                                        <div>
                                            <div class="footer-side-item">
                                                <div class="footer-list">
                                                    <div class="footer-list-header">
                                                        <div class="footer-list-title">Popular Sedans</div>
                                                    </div>

                                                    <ul class="footer-list-body">
                                                        <li class="footer-list-item"><a class="footer-list-link" href="http://synergyautohub.com/model/52">BMW 3-Series</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?name=Chevrolet Cruze">Chevrolet Cruze</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?name=Chevrolet Impala">Chevrolet Impala</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?name=Chevrolet Malibu">Chevrolet Malibu</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?name=Chrysler 200">Chrysler 200</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?name=Ford Focus">Ford Focus</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?name=Ford Fusion">Ford Fusion</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?name=Honda Accord">Honda Accord</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?name=Honda Civic">Honda Civic</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?name=Hyundai Elantra">Hyundai Elantra</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?name=Hyundai Sonata">Hyundai Sonata</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?name=Nissan Altima">Nissan Altima</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?name=Nissan Sentra">Nissan Sentra</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?name=Toyota Camry">Toyota Camry</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?name=Toyota Corolla">Toyota Corolla</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="footer-side-item">
                                                <div class="footer-list">
                                                    <div class="footer-list-header">
                                                        <div class="footer-list-title">Popular Coupes</div>
                                                    </div>
                                                    <ul class="footer-list-body">
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=Coupe&name=Chevrolet Camaro">Chevrolet Camaro</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=Coupe&name=Dodge Challenger">Dodge Challenger</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=Coupe&name=Ford Mustang">Ford Mustang</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=Coupe&name=Honda Civic">Honda Civic</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=Coupe&name=Hyundai Veloster">Hyundai Veloster</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="upper-body-item">
                                        <div>
                                            <div class="footer-side-item">
                                                <div class="footer-list">
                                                    <div class="footer-list-header">
                                                        <div class="footer-list-title">Popular SUVs</div>
                                                    </div>

                                                    <ul class="footer-list-body">
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=suv&name=Chevrolet Suburban">Chevrolet Suburban</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=suv&name=Chevrolet Tahoe">Chevrolet Tahoe</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=suv&name=GMC Yukon">GMC Yukon</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=suv&name=Honda Pilot">Honda Pilot</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=suv&name=Jeep Grand Cherokee">Jeep Grand Cherokee</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=suv&name=Jeep Wrangler Unlimited">Jeep Wrangler Unlimited</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=suv&name=Toyota 4Runner">Toyota 4Runner</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="footer-side-item">
                                                <div class="footer-list">
                                                    <div class="footer-list-header">
                                                        <div class="footer-list-title">Popular Trucks</div>
                                                    </div>
                                                    <ul class="footer-list-body">
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=truck&name=Chevrolet Silverado 1500">Chevrolet Silverado 1500</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=truck&name=Chevrolet Silverado 2500">Chevrolet Silverado 2500</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=truck&name=Ford F-150">Ford F-150</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=truck&name=Ford F-250">Ford F-250</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=truck&name=GMC Sierra C/K 1500">GMC Sierra C/K 1500</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=truck&name=RAM 1500">RAM 1500</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=truck&name=Toyota Tacoma">Toyota Tacoma</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=truck&name=Toyota Tundra">Toyota Tundra</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="footer-side-item">
                                                <div class="footer-list">
                                                    <div class="footer-list-header">
                                                        <div class="footer-list-title">Popular Vans</div>
                                                    </div>
                                                    <ul class="footer-list-body">
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=van&name=Chevrolet Express">Chevrolet Express</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=van&name=Ford Econoline">Ford Econoline</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=van&name=Ford Transit">Ford Transit</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=van&name=GMC Savana">GMC Savana</a></li>
                                                        <li class="footer-list-item"><a class="footer-list-link" href="search?body_type=van&name=RAM ProMaster Cargo">RAM ProMaster Cargo</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="upper-col-small">
                            <div class="upper-title">
                                Popular Makes
                            </div>
                            <div class="upper-body">
                                <div class="upper-wrapper">
                                    <div class="footer-side-item">
                                        <div class="footer-list">
                                            <ul class="footer-list-body">
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Acura">Acura</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Audi">Audi</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=BMW">BMW</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Buick">Buick</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Cadillac">Cadillac</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Chevrolet">Chevrolet</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Chrysler">Chrysler</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Dodge">Dodge</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Ford">Ford</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=GMC">GMC</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Honda">Honda</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Hyundai">Hyundai</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Infiniti">Infiniti</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Jeep">Jeep</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=KIA">KIA</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Lexus">Lexus</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Lincoln">Lincoln</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Mazda">Mazda</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Mercedes-Benz">Mercedes-Benz</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Mitsubishi">Mitsubishi</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Nissan">Nissan</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=RAM">RAM</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Subaru">Subaru</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Toyota">Toyota</a></li>
                                                <li class="footer-list-item"><a class="footer-list-link" href="search?make_name=Volkswagen">Volkswagen</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
          @endsection
            <div class="addtoany_share_save_container addtoany_content addtoany_content_bottom">
        <div class="a2a_kit a2a_kit_size_32 addtoany_list" data-a2a-url="http://localhost:8888/wordpress/" data-a2a-title="Home">
            <a class="a2a_button_facebook" href="https://www.addtoany.com/add_to/facebook?linkurl=http%3A%2F%2Flocalhost%3A8888%2Fwordpress%2F&amp;linkname=Home" title="Facebook" rel="nofollow noopener" target="_blank"></a>
            <a class="a2a_button_twitter" href="https://www.addtoany.com/add_to/twitter?linkurl=http%3A%2F%2Flocalhost%3A8888%2Fwordpress%2F&amp;linkname=Home" title="Twitter" rel="nofollow noopener" target="_blank"></a>
            <a class="a2a_button_google_plus" href="https://www.addtoany.com/add_to/google_plus?linkurl=http%3A%2F%2Flocalhost%3A8888%2Fwordpress%2F&amp;linkname=Home" title="Google+" rel="nofollow noopener" target="_blank"></a>
            <a class="a2a_dd addtoany_share_save addtoany_share" href="https://www.addtoany.com/share"></a>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        (function($){
            $(document).on('change','[name=make]', function(){
                var make = $(this).val();
                var dropdown = $('#models');
                dropdown.prop('disabled',true).html('');
                dropdown.append('<option value="">Select Option</option>');
                $.post('{{route('make_models')}}',{make:make,"_token": "{{ csrf_token() }}"}, function(data) {
                    if(data != ''){
                        // Loop through each of the results and append the option to the dropdown
                        $.each(data, function(k, v){
                            dropdown.append('<option value="' + v.id_car_model + '">' + v.name + '</option>');
                        });
                    }
                }).always(function() {
                    dropdown.prop('disabled',false);
                });
            });

            $(document).on('change','[name=model]', function(){
                var model = $(this).val();
                var dropdown = $('#trims');
                dropdown.prop('disabled',true).html('');
                dropdown.append('<option value="">Select Option</option>');
                $.post('{{route('model_trims')}}',{model:model,"_token": "{{ csrf_token() }}"}, function(data) {
                    if(data != ''){
                        // Loop through each of the results and append the option to the dropdown
                        $.each(data, function(k, v){
                            dropdown.append('<option value="' + v.id_car_trim + '">' + v.style_name + '</option>');
                        });
                    }
                }).always(function() {
                    dropdown.prop('disabled',false);
                });
            });
            var search_content = <?= json_encode($search_content) ?>;
            
            $('#search_key').autocomplete({
                minLength: 1,
                source: search_content,
                focus: function( event, ui ) {
                    $( "#search_key" ).val( ui.item.label );
                    return false;
                },
                select: function( event, ui ) {
                    location.href = ui.item.value;
                    return false;
                }
            })
            .autocomplete( "instance" )._renderItem = function( ul, item ) {
                return $( "<li>" )
                    .append( "<div>" + item.label + "</div>" )
                    .appendTo( ul );
            };
        })(jQuery)
    </script>
@endsection
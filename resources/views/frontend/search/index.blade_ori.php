@extends('frontend.layouts.app')
@section('styles')
<style type="text/css">
        img.wp-smiley,
        img.emoji {
        	display: inline !important;
        	border: none !important;
        	box-shadow: none !important;
        	height: 1em !important;
        	width: 1em !important;
            margin: 0 .07em !important;
            vertical-align: -0.1em !important;
            background: none !important;
            padding: 0 !important;
        }
    </style>
    <style id='woocommerce-layout-inline-css' type='text/css'>

    	.infinite-scroll .woocommerce-pagination {
	    	display: none;
	    }
    </style>
@endsection
@section('content')

    <div class="main-content-area clearfix">
        <div class="vc_row wpb_row vc_row-fluid">
            <div class="wpb_column vc_column_container vc_col-sm-12">
                <div class="vc_column-inner ">
                    <div class ="container">
					@if(!empty($makedetails))
                        <div class="row" >
                            <div class="col-md-7 col-xs-7 col-sm-7" >
                                <img class="img-responsive wow slideInLeft center-block" data-wow-delay="0ms" data-wow-duration="2000ms" style="width: 65%;height:100%; opacity:.8;" src="{{asset('assets/car_images/logos/'.$makedetails->uuid.'/'.$makedetails->logo)}}" alt="Image Not Found" />        
                            </div> 
                            
                            <div class="col-md-4 col-xs-4 col-sm-4 " style="margin-left:-35%;">
                                <img src="assets/images/SearchBanner_right.png" style="height:100%;"></img>       
                            </div>    
                            <div class="col-md-6 col-xs-6 col-sm-6" style="margin-left:-15%; vertical-align: bottom; padding-top: 10%">
                                <img class="img-responsive wow slideInRight center-block" data-wow-delay="0ms" data-wow-duration="2000ms" src="assets/images/alfaromeo.png" alt="Image Not Found" />
                                <h1 class="img-responsive wow slideInRight center-block" data-wow-delay="0ms" data-wow-duration="2000ms" style="font-size:60px;font-weight:bolder;color:#555;font-family:'Algerian';">Make&nbsp;Your&nbsp;Next&nbsp;Car&nbsp;{{(isset($makedetails))?$makedetails->name:''}}</h1>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <section class="section-padding no-top gray page-search">
                <div class="container">
                <!-- Row -->
                <div class="row">
                        <!-- Row -->
                        <div class="row">
                            <div class="col-md-12 col-xs-12 col-sm-12 col-lg-12">
                                <div class="clearfix"></div>
                                <div class="vc_row wpb_row vc_row-fluid">
                                        <div class="wpb_column vc_column_container vc_col-sm-12">
                                            <div class="vc_column-inner ">
                                                <div class="wpb_wrapper">
                                                    <div class="search-bar">
                                                        <div class="section-search search-style-2">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                                                                        <div class="clearfix">
                                                                            <form method="get" action="search">
                                                                                <div class="search-form pull-left ">
                                                                                    <div class="search-form-inner pull-left ">
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12 no-padding">
                                                                                            <div class="form-group">
                                                                                                <label>Keyword</label>
                                                                                                <input autocomplete="off" name="ad_title" id="autocomplete-dynamic" class="form-control banner-icon-search" placeholder="Eg Honda Civic , Audi , Ford." type="text" />
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12 no-padding">
                                                                                            <div class="form-group">
                                                                                                <label>Select Make</label>
                                                                                                {!! Form::label('make', 'Select Make') !!}
                                                                                                {!! Form::select('make',$makes, (isset($makedetails) && is_array($makedetails))?$makedetails->uuid:'', ['class' => 'form-control input-sm chosen', 'required']) !!}
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-3 col-sm-6 col-xs-12 no-padding">
                                                                                            <div class="form-group">
                                                                                                <div class="form-group pull-left ">

                                                                                                        <button type="submit" id="submit_loader" value="submit" class="btn btn-lg btn-theme">Search Now</button>
                                                                                                     <!-- <a href="search">
                                                                                                        <li  class="btn btn-lg btn-theme">Search Now</li>
                                                                                                        </a>             -->
                                                                                                    </div>
                                                                                            </div>
                                                                                        </div>

                                
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
                            <div class="clearfix"></div>
                            <div class="clearfix"></div>
                            <!-- Ads Archive -->
                            <!-- Ads Archive End -->
							@if(!empty($cars))
                            <div class="posts-masonry">
                                @foreach($cars as $car)
                                <div class="col-md-3 col-xs-12 col-sm-6">
                                    <!-- Ad Box -->
                                    <div class="category-grid-box">
                                        <!-- Ad Img -->
                                        <div class="category-grid-img">
                                            <a href="https://www.youtube.com/watch?v=lr7mPzjTgC0" class="play-video"><img src="assets/images/2017/08/playbutton-u693-r.png" alt="Icon"></a>
                                            <img src="assets/images/2017/06/1-2-268x166.jpg" alt="2010 BMW M3 for sale in black" class="img-responsive">
                                            <!-- Ad Status -->
                                            @if($car->featured)
                                            <span class="ad-status">Featured</span>
                                            @endif
                                            <!-- User Review -->
                                            <div class="user-preview">
                                                <a href="../author/emily_user/indexdb00.html?type=ads">
                                                    <img src="assets/images/2018/01/ags6-80x80.jpg" class="avatar avatar-small" >
                                                </a>
                                            </div>
                                            <!-- View Details -->
                                            <a href="{{url('/detail?trim='.$car->dstring)}}" class="view-details">View Details
						                    </a>
                                            <!-- Additional Info -->
                                            <div class="additional-information">
                                                <p>Year: {{$car->year}}</p>
                                                <p>Body {{$car->body_type}}</p>
                                                <p>Condition: Used</p>
                                                <p>Lowest Lease Rate: NA</p>
                                            </div>
                                            <!-- Additional Info End-->
                                        </div>
                                        <!-- Ad Img End -->
                                        <div class="short-description">
                                            <!-- Category Title -->
                                            <div class="category-title"> <span class="padding_cats"><a href="indexe47b.html?cat_id=71">{{$car->make}}</a></span><span class="padding_cats"><a href="indexc248.html?cat_id=141">{{$car->model}} series</a></span> </div>
                                            <h3><a title="" href="{{url('/detail?trim='.$car->dstring)}}">{{$car->year.' '.$car->make.' '.$car->model.' '.$car->trim}}</a></h3>
                                            <div class="price">$ {{$car->price ? $car->price :'NA'}}</div>
                                        </div>
                                        <!-- Addition Info -->
                                        <div class="ad-info">
                                            <ul class="list-unstyled">
                                                <li><i class="flaticon-gas-station-1"></i>{{$car->fuel ? $car->fuel : 'NA'}}</li>
                                                <li><i class="flaticon-dashboard"></i>{{$car->mileage}} MPG</li>
                                                <li><i class="flaticon-engine-2"></i>{{$car->year}}</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <!-- Ad Box End -->
                                </div>
                                @endforeach
                                <div class="clearfix"></div>
                                <!-- <div class="text-center margin-top-30 margin-bottom-20">
                                    <ul class="pagination pagination-lg">
                                        <li class="active"><a href="index01ab.html?carspot_layout_type=5">1</a></li>
                                        <li><a href="search2">2</a></li>
                                        <li><a href="search2">Next Page &raquo;</a></li>
                                    </ul>
                                </div> -->
                            </div>
							@endif
                </div>
            </div>
        </section>
    </div>
@endsection
@section('scripts')
 <script type="text/javascript">
        (function($) {

            "use strict";

            $('.sb_variation').on('change', function()

                {

                    var get_var = '';

                    $(".sb_variation").each(function() {

                        var val = $(this).val();

                        get_var = get_var + val.replace(/\s+/g, '') + '_';

                    });

                    if ($('#' + get_var).length > 0)

                    {

                        var res = $('#' + get_var).val();

                        var arr = res.split("-");

                        var sale_price = arr[0];

                        var old_price = arr[1];

                        var vid = arr[2];

                        if (sale_price == "0")

                        {

                            $('#v_msg').html('This product is currently out of stock and unavailable.');

                            $('#sale_price').html('');

                            $('#old_price').html('');

                            $('#sb_add_to_cart').hide();

                            $('.quantity').hide();

                            $('#product_qty').hide();

                        } else

                        {

                            $('#sale_price').html('&pound;' + sale_price);

                            $('#old_price').html('&pound;' + old_price);

                            $('#v_msg').html('');

                            $('#sb_add_to_cart').show();

                            $('.quantity').show();

                            $('#product_qty').show();

                        }

                        $('#variation_id').val(vid);

                    }

                });

            $(".sb_variation").trigger("change");

            $('#sb_add_to_cart').on('click', function()

                {

                    if ($('#cart_msg').html() != 'Adding...')

                    {

                        $('#cart_msg').html("Adding...");

                        //Getting values

                        var variation_id = $('#variation_id').val();

                        var pid = $('#product_id').val();

                        var qty = $('#product_qty').val();

                        $.post('../wp-admin/admin-ajax.html',

                            {
                                action: 'sb_cart',
                                product_id: pid,
                                qty: qty,
                                variation_id: variation_id
                            }).done(function(response)

                            {

                                $('#cart_msg').html("add to cart");

                                if (response != 0)

                                {

                                    var cart_url = '';

                                    var cart_url = '<br /><a href="../cart/index.html">View Cart</a>';

                                    toastr.success('Product Added successfully.' + cart_url, 'Success!', {
                                        timeOut: 10000,
                                        "closeButton": true,
                                        "positionClass": "toast-bottom-right"
                                    })

                                } else

                                {

                                    toastr.error('Something went wrong, please try it again.', 'Error!', {
                                        timeOut: 15000,
                                        "closeButton": true,
                                        "positionClass": "toast-bottom-right"
                                    })

                                }

                            });

                    }

                });

        })(jQuery);
    </script>
@endsection
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
        .ui-tooltip, .arrow:after {
    background: gray;
    border: 2px solid white;
  }
  .ui-tooltip {
    padding: 10px 20px;
    color: white;
    border-radius: 20px;
    font: bold 14px "Helvetica Neue", Sans-Serif;
    text-transform: uppercase;
    box-shadow: 0 0 7px black;
  }
  .arrow {
    width: 70px;
    height: 16px;
    overflow: hidden;
    position: absolute;
    left: 50%;
    margin-left: -35px;
    bottom: -16px;
  }
  .arrow.top {
    top: -16px;
    bottom: auto;
  }
  .arrow.left {
    left: 20%;
  }
  .arrow:after {
    content: "";
    position: absolute;
    left: 20px;
    top: -20px;
    width: 25px;
    height: 25px;
    box-shadow: 6px 5px 9px -9px black;
    -webkit-transform: rotate(45deg);
    -ms-transform: rotate(45deg);
    transform: rotate(45deg);
  }
  .arrow.top:after {
    bottom: -20px;
    top: auto;
  }
    </style>
@endsection
@section('content')
 <section class="section-padding no-top gray page-search">
<div class="container" style="padding-top: 50px; padding-bottom: 10px;">
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
                                                                   
                                                                    </div>
                                                                    <div class="col-md-3 col-sm-6 col-xs-12 no-padding">
                                                                        <div class="form-group">
                                                                            <label></label>
                                                                            {!! Form::label('make', 'Search For a Different Make') !!}
                                                                            {!! Form::select('make',$makes, isset($makedetails)?$makedetails->id_car_make:'', ['class' => 'form-control input-sm chosen', 'id' => 'search_make', 'required']) !!}
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
        </div>
    </div>
    <div class="make_info_field clearfix">
        <div class="vc_row wpb_row vc_row-fluid">
            <div class="wpb_column vc_column_container vc_col-sm-12">
                <div class="vc_column-inner ">
                    <div class ="container">
                    @if(!empty($makedetails))
                        <div class="row make_logo">
                            <div class="col-md-7 col-xs-12 col-sm-7" style="height: 100%;">
                                <img class="img-responsive wow slideInLeft center-block" data-wow-delay="0ms" data-wow-duration="2000ms" style="width:65%;height:50%; opacity:.8; margin-top: 40px;" src="{{asset('assets/images/carlogos/'.$makedetails->niceName.'.png')}}" alt="Image Not Found" />
                            </div> 
                            
                            <div class="col-md-4 col-xs-12 col-sm-4 middle_pattern " style="margin-left:-35%;">
                                <img src="{{ asset('assets/images/SearchBanner_right.png') }}" style="height:100%;" /> 
                            </div>    
                            <div class="col-md-6 col-xs-12 col-sm-6 make_logo_car">
                                @if(!empty($modeldetail) && $modeldetail->model_image)
                                    <?php
                                        $image_model = explode(',', $modeldetail->model_image);
                                    ?>
                                    @if(count($image_model))
                                     <?php
                                        
                                        $img = '';
                                        $search=\DB::table('car_model')->where('id_car_model', $id_car_model)->first(); 
                                        if($search->search_image !='')
                                        $img = $search->search_image;
                                        else
                                        $img=$image_model[0];
                                        ?>
                                        <a href="#" class="img_tooltip" title="{{$modeldetail->year.' '.$makedetails->name.' '.$modeldetail->name}}">
                                            <img class="img-responsive wow slideInRight center-block" data-wow-delay="100ms" data-wow-duration="2000ms" src="{{asset('assets/car_images/model_images/'.$img)}}" alt="{{$modeldetail->year.' '.$makedetails->name.' '.$modeldetail->name}}">
                                        </a>
                                    @else
                                        <img class="img-responsive wow slideInRight center-block" data-wow-delay="0ms" data-wow-duration="2000ms" src="{{ asset('assets/images/2017/06/2016HYS020002_640_01.png') }}" alt="Image Not Found" />
                                    @endif
                                @else
                                    <img class="img-responsive wow slideInRight center-block" data-wow-delay="0ms" data-wow-duration="2000ms" src="{{ asset('assets/images/2017/06/2016HYS020002_640_01.png') }}" alt="Image Not Found" />
                                @endif
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="main-content-area container">
       
        <div class="search-bar" style="margin-top: 60px;text-align: center;">
            <p class="main_content_title">Avaliable {{isset($modeldetail)?$modeldetail->year:''}} {{isset($modeldetail)?$modeldetail->name:''}} {{isset($car_type)?$car_type:''}} Trims</p>
        </div>
        
        @if(!empty($cars))
        <div class="posts-masonry" style="margin-top: 40px;">
            @foreach($cars as $car)

            <div class="col-md-3 col-xs-12 col-sm-6">
                <!-- Ad Box -->
                <div class="category-grid-box">
                    <!-- Ad Img -->
                    <div class="category-grid-img" style="height: 200px;overflow: hidden;">
                        
                        @if(!empty($modeldetail) && $modeldetail->model_image)
                            <?php
                                $image_model = explode(',', $modeldetail->model_image);
                            ?>
                            @if(count($image_model))
                             <?php
                                        
                                        $img = '';
                                        $search=\DB::table('car_model')->where('id_car_model', $car->id_car_model)->first(); 
                                        // print_r($search);
                                        // exit;
                                        if($search->search_image !='')
                                        $img = $search->search_image;
                                        else
                                        $img=$image_model[0];
                                        ?>
                                <div class="car_search_img_section" style="background-image: url({{asset('assets/car_images/model_images/'.$img)}})"></div>
                            @else
                                <div class="car_search_img_section" style="background-image: url({{ asset('assets/images/2017/06/2016HYS020002_640_01.png') }})"></div>
                            @endif
                        @else
                            <div class="car_search_img_section" style="background-image: url({{ asset('assets/images/2017/06/2016HYS020002_640_01.png') }})"></div>
                        @endif
                        <!-- Ad Status -->
                        
                        <!-- User Review -->
                        <div class="user-preview">
                            <a href="../author/emily_user/indexdb00.html?type=ads">
                                <img src="{{ asset('assets/images/2018/01/ags6-80x80.jpg') }}" class="avatar avatar-small" >
                            </a>
                        </div>
                        <!-- View Details -->
                        <a href="{{url('/detail?trim='.$car->id_car_trim)}}" class="view-details">Select
                        </a>
                        <!-- Additional Info -->
                        <div class="additional-information">
                            <p>Year: {{$car->year}}</p>
                            <p>Body: {{$car->car_type}}</p>
                            <p>Condition: New</p>
                        </div>
                        <!-- Additional Info End-->
                    </div>
                    <!-- Ad Img End -->
                    <div class="short-description" style="height: 480px;">
                        <div class="row" style="margin-bottom: 10px;">
                            @if($car->min_price)
                                <div class="lease_price">
                                    <div class="price_title">Lease for as low:</div>
                                    <div class="price_value">
                                        <span class=""> {{$car->min_price ? '$ '. number_format($car->min_price) :'NA'}}/mo</span>
                                    </div>
                                </div>    
                            @endif
                            @if($car->min_sell_price)
                                <div class="sell_price">
                                    <div class="price_title">Buy for as low:</div>
                                    <div class="price_value">
                                        <span class=""> {{$car->min_sell_price ? '$ '. number_format($car->min_sell_price) :'NA'}}</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                        <!-- Category Title -->
                        <!--div class="category-title"> <span class="padding_cats"><a href="indexe47b.html?cat_id=71">{{$car->make_name}}</a></span><span class="padding_cats"><a href="indexc248.html?cat_id=141">{{$car->model_name}} series</a></span> </div-->
                        <h5>{{$car->make_name}}</h5>
                        <h3><strong>{{$car->year.' '.$car->model_name.' '.substr($car->style_name, 0, strpos($car->style_name, '(')-1)}}</strong></h3>
                        <h6> Starting MSRP: ${{ number_format($car->base_price) }} </h6>
                        <hr/>
                        <div class="row search_spec">
                            <div class="col-sm-4">
                                <p class="bold">{{ $car->trim_mileage }}</p>
                                <p>MPG</p>
                            </div>
                            <div class="col-sm-4">
                                <p class="bold">{{ substr($car->horsepower, 0, strpos($car->horsepower,'hp')-1) }}</p>
                                <p>HP</p>
                            </div>
                            <div class="col-sm-4">
                                <p class="bold">{{ $car->passenger_capacity }}</p>
                                <p>Seats</p>
                            </div>
                        </div>
                        <div class="row search_commone_feature" style="margin-top: 20px;">
                            <div class="col-sm-12">
                                <p class="sub_title">Highlights</p>
                                <hr/>
                                <?php 
                                    $features = explode(',', $car->comfort_convenience_options);
                                    $i = 0;
                                    foreach($features as $feature){
                                        if($i > 4){
                                            break;   
                                        }else{
                                            echo '<p class="search_feaures">'.$feature.'</p>';
                                            if($i != 4){
                                                echo '<hr/>';    
                                            }
                                            $i++;
                                        }
                                    }
                                ?>
                            </div>
                        </div>
                    </div>
                    <!-- Addition Info -->
                    <!--div class="ad-info">
                        <ul class="list-unstyled">
                            <li><i class="flaticon-gas-station-1"></i>{{$car->car_engine ? $car->car_engine : 'NA'}}</li>
                            <li><i class="flaticon-dashboard"></i>{{$car->mileage}} MPG</li>
                            <li><i class="flaticon-engine-2"></i>{{$car->year}}</li>
                        </ul>
                    </div-->
                    <div class="row search_spec" style="margin-bottom: 10px;">
                        <div class="">
                            <p class="bold">Start MSRP : {{ '$'.number_format($car->base_price) }}</p>
                            
                        </div>
                    </div>
                    <div class="row" style="margin-bottom: 20px">
                        <div class="col-sm-12" style="text-align: center;">
                            <a class="btn btn-search-red" href="{{url('/detail?trim='.$car->id_car_trim)}}">Select</a>
                        </div>
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
</section>
</div>
@endsection
@section('scripts')
 <script type="text/javascript">
        (function($) {

            "use strict";

            $('#submit_loader').click(function(e){
              e.preventDefault();
              var make_id = $('#search_make').val();
              location.href= "{{ url('make') }}" +'/'+make_id;
            });
            //for image adjustment

            $(".img_tooltip").tooltip({
                show: { effect: "slide", direction: 'right', delay: 2000 },
                position: {
                    my: "center bottom",
                    at: "center top+40",
                    collision: "none",
                    using: function( position, feedback ) {
                      $( this ).css( position );
                      $( "<div>" )
                        .addClass( "arrow" )
                        .addClass( feedback.vertical )
                        .addClass( feedback.horizontal )
                        .appendTo( this );
                    }
                }
            });
            $(".img_tooltip")
            .bind( "mouseleave", function( event ) {
                event.stopImmediatePropagation();
            })
            .tooltip();
            $(".img_tooltip").tooltip('open');


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
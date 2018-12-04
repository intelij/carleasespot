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
    box-shadow: 0 0 7px gray;
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
  .sort_year{
    box-shadow: 0 3px 5px rgba(0, 0, 0, 0.07);
    margin: 20px 0;
    font-size: 25px;
    color: #E52D27;
    padding: 15px;
  }
  .row.make_logo {
    position: relative;
}
.row.make_logo .col-md-4.col-xs-12.col-sm-4.middle_pattern {
    position: absolute;
    height: 100%;
    left: 36%;
    margin-left: 0 !important;
}
.row.make_logo .header_back_img.wow.slideInRight.center-block.animated {
    background-size: 100%;
}
.row.make_logo img.img-responsive.wow.slideInLeft.center-block.animated {
    margin-right: 0;
}
  @media (min-width: 768px){
.header_back_img {
    width: 100%;
   height: 300px;
}
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
                                <img class="img-responsive wow slideInLeft center-block" data-wow-delay="0ms" data-wow-duration="2000ms" style="width:60%;height:45%; opacity:.8; margin-top: 40px;" src="{{asset('assets/images/carlogos/'.$makedetails->niceName.'.png')}}" alt="Image Not Found" />
                            </div> 
                            
                            <div class="col-md-4 col-xs-12 col-sm-4 middle_pattern " style="margin-left:-35%;">
                                <img src="{{ asset('assets/images/SearchBanner_right.png') }}" style="height:100%;" /> 
                            </div>    
                            <div class="col-md-6 col-xs-12 col-sm-6 make_logo_car">
                                @if(!empty($models))
                                    <?php
                                        $image_models = array();
                                        $id = '';
                                        
                                        //  print_r($models[4]);
                                        //  exit;
                                         
                                        foreach($models as $model){
                                            if($model->model_image){
                                                $image_models[] = $model;
                                                $id=$model->id_car_model;
                                            }
                                        }
                                        $total_num = count($image_models);
                                        $rand_num = rand(0, $total_num-1);
                                        $count = count($models);
                                        $rand_num1 = rand(0, $count-1);
                                        $model2 = $models[$rand_num1];
                                    ?>
                                    @if($total_num > 0)
                                        <?php
                                            $model = $image_models[$rand_num];
                                            $image_model = explode(',', $model->model_image);
                                        ?>
                                        @if(count($image_model))
                                        <?php
                                        
                                        $img = '';
                                        $search=\DB::table('car_model')->where('id_car_model', $model2->id_car_model)->first(); 
                                        // print_r($search);
                                        // exit;
                                        if($search->search_image !='')
                                        $img = $search->search_image;
                                        else
                                        $img=$image_model[0];
                                        ?>
                                            <a href="#" class="img_tooltip" title="{{ $model2->year.' '.$makedetails->name.' '.$model2->name }}">
                                                <div class="header_back_img wow slideInRight center-block" data-wow-delay="0ms" data-wow-duration="2000ms" style="background-image:url({{asset('assets/car_images/model_images/'.$img)}})"></div>
                                            </a>
                                        @else
                                            <img class="img-responsive wow slideInRight center-block" data-wow-delay="0ms" data-wow-duration="2000ms" src="{{ asset('assets/images/2017/06/2016HYS020002_640_01.png') }}" alt="Image Not Found" />
                                        @endif
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
        <div class="search-bar" style="margin-top: 30px;text-align: center;">
            @if(!empty($makedetails))
            <img class="img-responsive wow slideInLeft center-block" data-wow-delay="0ms" data-wow-duration="2000ms" style="width:5%;height:3%; opacity:.8; margin-top: 40px;" src="{{asset('assets/images/carlogos/'.$makedetails->niceName.'.png')}}" alt="Image Not Found" />
            <p class="main_content_title">Available {{isset($year) && $year != ''? $year.' ':''}}{{$makedetails->name}} Models</p>
            @elseif(count($models) && isset($models[0]->car_type))
            <p class="main_content_title">Available {{isset($year) && $year != ''? $year.' ':''}}{{$models[0]->car_type}} Models</p>
            @endif
        </div>
        @if(!empty($models))
        <div class="posts-masonry" style="margin-top: 40px;">
            <div class="row">
                <div class="col-sm-12">
                    <div class="sort_year">
                        <span>2018 available models</span>
                    </div>
                </div>
            </div>
            <div class="row">
                
            @foreach($models as $model)
                @if($model->year == '2018')
                    <div class="col-md-3 col-xs-12 col-sm-6">
                        <!-- Ad Box -->
                        <div class="category-grid-box">
                            <!-- Ad Img -->
                            <div class="category-grid-img" style="height: 200px;overflow: hidden;">
                                @if($model->model_image)
                                    <?php
                                        $image_model = explode(',', $model->model_image);
                                    ?>
                                    @if(count($image_model))
                                     <?php
                                        
                                        $img = '';
                                        $search=\DB::table('car_model')->where('id_car_model', $model->id_car_model)->first(); 
                                        if($search->search_image !='')
                                        $img = $search->search_image;
                                        else
                                        $img=$image_model[0];
                                        ?>
                                        <div class="car_search_img_section" style="background-image: url({{ asset('assets/car_images/model_images/'.$img) }})"></div>
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
                                <!--a href="{{ route('frontend.model', $model->id_car_model) }}" class="view-details">Select
                                </a-->
                            </div>
                            <!-- Ad Img End -->
                            <div class="short-description" style="height: 450px;">
                                <!-- Category Title -->
                                @if(isset($model->make_name))
                                    <h5>{{$model->make_name}}</h5>
                                @endif
                                @if(!empty($makedetails))
                                    <h3><strong>{{$model->year.' '.$model->name }}</strong></h3>
                                @elseif(isset($model->model_name))
                                    <h3><strong>{{$model->year.' '.$model->model_name }}</strong></h3>
                                @endif
                                <hr/>
                                <div class="row search_spec">
                                    <div class="col-sm-4">
                                        <p class="bold">{{ $model->min_mpg == $model->max_mpg? $model->min_mpg: $model->min_mpg.' - '.$model->max_mpg }}</p>
                                        <p>MPG</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="bold">{{ $model->min_hp == $model->max_hp? $model->min_hp: $model->min_hp.' - '.$model->max_hp }}</p>
                                        <p>HP</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="bold">{{ $model->min_seats == $model->max_seats? $model->min_seats: $model->min_seats.' - '.$model->max_seats }}</p>
                                        <p>Seats</p>
                                    </div>
                                    
                                </div>
                                <div class="row search_commone_feature" style="margin-top: 5px;">
                                    <div class="col-sm-12">
                                        <p class="sub_title">Highlights</p>
                                        <hr/>
                                        <?php 
                                            $i = 0;
                                            foreach($model->highlights as $highlight){
                                                if($highlight){
                                                    echo '<p class="search_feaures">'.$highlight.'</p>';
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
                            <div class="row search_spec" style="margin-bottom: 10px;">
                                <div class="">
                                    <p class="bold">Start MSRP :
                                        @if($model->min_msrp == $model->max_msrp)
                                            {{ $model->min_msrp != 'N/A'? '$'.number_format($model->min_msrp): $model->min_msrp }}
                                        @else
                                            {{ $model->min_msrp != 'N/A'? '$'.number_format($model->min_msrp): $model->min_msrp }} - {{ $model->max_msrp != 'N/A'? '$'.number_format($model->max_msrp): $model->max_msrp}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 20px">
                                <div class="col-sm-12" style="text-align: center;">
                                    @if(!isset($model->id_car_type))
                                        <a class="btn btn-search-red" href="{{ route('frontend.model', $model->id_car_model) }}">Select</a>
                                    @else
                                        <a class="btn btn-search-red" href="{{ route('frontend.model', array($model->id_car_model, $model->id_car_type)) }}">Select</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Ad Box End -->
                    </div>
                @endif
            @endforeach
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="sort_year">
                        <span>2019 available models</span>
                    </div>
                </div>
            </div>
            <div class="row"> 
            @foreach($models as $model)
                @if($model->year == '2019')
                    <div class="col-md-3 col-xs-12 col-sm-6">
                        <!-- Ad Box -->
                        <div class="category-grid-box">
                            <!-- Ad Img -->
                            <div class="category-grid-img" style="height: 200px;overflow: hidden;">
                                @if($model->model_image)
                                    <?php
                                        $image_model = explode(',', $model->model_image);
                                    ?>
                                    @if(count($image_model))
                                        <div class="car_search_img_section" style="background-image: url({{ asset('assets/car_images/model_images/'.$image_model[0]) }})"></div>
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
                                <!--a href="{{ route('frontend.model', $model->id_car_model) }}" class="view-details">Select
                                </a-->
                            </div>
                            <!-- Ad Img End -->
                            <div class="short-description" style="height: 450px;">
                                <!-- Category Title -->
                                @if(isset($model->make_name))
                                    <h5>{{$model->make_name}}</h5>
                                @endif
                                @if(!empty($makedetails))
                                    <h3><strong>{{$model->year.' '.$model->name }}</strong></h3>
                                @elseif(isset($model->model_name))
                                    <h3><strong>{{$model->year.' '.$model->model_name }}</strong></h3>
                                @endif
                                <hr/>
                                <div class="row search_spec">
                                    <div class="col-sm-4">
                                        <p class="bold">{{ $model->min_mpg == $model->max_mpg? $model->min_mpg: $model->min_mpg.' - '.$model->max_mpg }}</p>
                                        <p>MPG</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="bold">{{ $model->min_hp == $model->max_hp? $model->min_hp: $model->min_hp.' - '.$model->max_hp }}</p>
                                        <p>HP</p>
                                    </div>
                                    <div class="col-sm-4">
                                        <p class="bold">{{ $model->min_seats == $model->max_seats? $model->min_seats: $model->min_seats.' - '.$model->max_seats }}</p>
                                        <p>Seats</p>
                                    </div>
                                    
                                </div>
                                <div class="row search_commone_feature" style="margin-top: 5px;">
                                    <div class="col-sm-12">
                                        <p class="sub_title">Highlights</p>
                                        <hr/>
                                        <?php 
                                            $i = 0;
                                            foreach($model->highlights as $highlight){
                                                if($highlight){
                                                    echo '<p class="search_feaures">'.$highlight.'</p>';
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
                            <div class="row search_spec" style="margin-bottom: 10px;">
                                <div class="">
                                    <p class="bold">Start MSRP :
                                        @if($model->min_msrp == $model->max_msrp)
                                            {{ $model->min_msrp != 'N/A'? '$'.number_format($model->min_msrp): $model->min_msrp }}
                                        @else
                                            {{ $model->min_msrp != 'N/A'? '$'.number_format($model->min_msrp): $model->min_msrp }} - {{ $model->max_msrp != 'N/A'? '$'.number_format($model->max_msrp): $model->max_msrp}}
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="row" style="margin-bottom: 20px">
                                <div class="col-sm-12" style="text-align: center;">
                                    @if(!isset($model->id_car_type))
                                        <a class="btn btn-search-red" href="{{ route('frontend.model', $model->id_car_model) }}">Select</a>
                                    @else
                                        <a class="btn btn-search-red" href="{{ route('frontend.model', array($model->id_car_model, $model->id_car_type)) }}">Select</a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- Ad Box End -->
                    </div>
                @endif
            @endforeach
            </div>
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
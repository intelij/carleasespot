@extends('frontend.layouts.app')
@section('styles')
   <style type="text/css">
        #sb_loading{
            display: block;
        }
        .ng-cloak{
            display: none;
        }
    </style>
@endsection
@section('content')
<div ng-controller="compareCtrl" ng-init="initialize()">
        <!--<div class="loading" id="sb_loading" ng-style="sb_loading">&#8230;</div>-->
        <div class="page-header-area-2 gray">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="small-breadcrumb">
                            <div class="header-page">
                                <h1>Car Comparison</h1>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-content-area clearfix">
            <section class="section-padding no-top compare-detial gray ">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <div class="table-responsives">
                                <div class="row">
                                    <div class="col-md-4 col-xs-4 col-sm-4">
                                        Select Car&#039;s You Want To Compare
                                    </div>
                                    <div class="col-md-4 col-xs-4 col-sm-4">

                                        <div class="form-group">
                                            <select id="keyword1" ng-model="formData.car1" class=" form-control make">
                                                <!--<option ng-repeat="car in data" ng-value="car.id_car_make">d</option>-->
                                                @foreach( $makemode as $car)
                                                    <option value='{{$car['id_car_trim']}}'>{{$car['vehiclemakes.name']}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 col-xs-4 col-sm-4">
                                        <div class="form-group">
                                            <select id="keyword2" ng-model="formData.car2" name="keyword2" class="form-control make">
                                                <!--<option ng-repeat="car in makemodel" ng-value="car.car_id">@{{car.car_name}}</option>-->
                                                @foreach( $makemode as $car)
                                                    <option value='{{$car['id_car_trim']}}'>{{$car['vehiclemakes.name']+$car['car_models.name']}}</option>
                                                     @endforeach
                                            </select>
                                            </select>
                                            <input type="hidden" ng-model="formData._token" value="{{csrf_token()}}">
                                        </div>

                                    </div>
                                    <div class="col-md-8 col-md-offset-4 col-xs-offset-4 col-sm-offset-4  col-xs-8  col-sm-8" >
                                        <button type="button" class="btn btn-block btn-theme" ng-click="compare()" ng-disabled="formData.car1 == '' || !formData.car1 || formData.car2 == '' || !formData.car2"> Comapre</button>
                                    </div>
                                </div>


                                <div id="populate_data">
                                    <table id="review-data" class="ng-cloak" ng-show="showData">
                                        <tbody>
                                            <tr>
                                                <td>Images</td>
                                                <td>
                                                    <img class="img-responsive" src="assets/images/2017/07/5.png" alt="">
                                                    <h4>@{{car1.year+' '+car1.make+' '+car1.model+' '+car1.trim}}</h4>


                                                </td>
                                                <td>
                                                    <img class="img-responsive" src="assets/images/2017/07/6.png" alt="">
                                                    <h4>@{{car2.year+' '+car2.make+' '+car2.model+' '+car1.trim}}</h4>

                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <ul class="accordion ng-cloak" ng-show="showData">
                                        <li id="first_accor" class="open">
                                            <h3 class="accordion-title"><a href="#">General</a></h3>
                                            <div class="accordion-content" style="display: block;">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td> Engine Type </td>
                                                            <td>@{{car1.engine_type}}</td>
                                                            <td>@{{car2.engine_type}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Fuel Type </td>
                                                            <td> </td>
                                                            <td> </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Price </td>
                                                            <td>$ @{{car1.price}}</td>
                                                            <td>$ @{{car2.price}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Transmission </td>
                                                            <td> </td>
                                                            <td> </td>
                                                        </tr>
                                                        <tr>
                                                            <td> Vehicle Type </td>
                                                            <td>@{{car1.body_type}}</td>
                                                            <td>@{{car2.body_type}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                        <li id="first_accor" class="open">
                                            <h3 class="accordion-title"><a href="#">Engine</a></h3>
                                            <div class="accordion-content" style="display: block;">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td> Displacement </td>
                                                            <td>@{{car1.displacement}}</td>
                                                            <td>@{{car2.displacement}}</td>
                                                        </tr>
                                                       <!--  <tr>
                                                            <td> Engine size </td>
                                                            <td> 1.0 L</td>
                                                            <td> 14.0 L</td>
                                                        </tr> -->
                                                        <tr>
                                                            <td> No Of Cylinders </td>
                                                            <td>@{{car1.cylinder}}</td>
                                                            <td>@{{car2.cylinder}}</td>
                                                        </tr>
                                                        <!-- <tr>
                                                            <td> Super Charger </td>
                                                            <td> <i class="fa fa-times"></i></td>
                                                            <td> <i class="fa fa-times"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Turbo Charger </td>
                                                            <td> <i class="fa fa-times"></i></td>
                                                            <td> <i class="fa fa-check"></i></td>
                                                        </tr> -->
                                                        <tr>
                                                            <td> Valves Per Cylinder </td>
                                                            <td>@{{car1.valves_per_cylinder}}</td>
                                                            <td>@{{car2.valves_per_cylinder}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                        <li id="first_accor" class="open">
                                            <h3 class="accordion-title"><a href="#">Performance</a></h3>
                                            <div class="accordion-content" style="display: block;">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td> Acceleration </td>
                                                            <td>@{{car1.acceleration}}</td>
                                                            <td>@{{car2.acceleration}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Max Output (HP) </td>
                                                            <td>@{{car1.output}}</td>
                                                            <td>@{{car2.output}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Max Torque (Nm) </td>
                                                            <td>@{{car1.torque}}</td>
                                                            <td>@{{car2.torque}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Mileage City </td>
                                                            <td>@{{car1.mileage_city}}</td>
                                                            <td>@{{car2.mileage_city}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Mileage Highway </td>
                                                            <td>@{{car1.mileage_highway}}</td>
                                                            <td>@{{car2.mileage_highway}}</td>
                                                        </tr>
                                                        <!-- <tr>
                                                            <td> Power Train </td>
                                                            <td> Front-Wheel Drive sonu</td>
                                                            <td> Front-Wheel Drive</td>
                                                        </tr> -->
                                                        <tr>
                                                            <td> Top Speed </td>
                                                            <td>@{{car1.top_speed}}</td>
                                                            <td>@{{car2.top_speed}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                        <li id="first_accor" class="open">
                                            <h3 class="accordion-title"><a href="#">Features</a></h3>
                                            <div class="accordion-content" style="display: block;">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td> Air Conditioning System </td>
                                                            <td>@{{car1.ac}}</td>
                                                            <td>@{{car2.ac}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Connectivity </td>
                                                            <td>@{{car1.connectivity}}</td>
                                                            <td>@{{car2.connectivity}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Cruise Control </td>
                                                            <td> <i class="fa @{{car1.cruise_control == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.cruise_control == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Entertainment System </td>
                                                            <td>@{{car1.entertainment}}</td>
                                                            <td>@{{car2.entertainment}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Front Parking Sensors </td>
                                                            <td> <i class="fa @{{car1.front_parking == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.front_parking == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Power Steering </td>
                                                            <td> <i class="fa @{{car1.power_steering == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.power_steering == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Power Windows </td>
                                                            <td> <i class="fa @{{car1.power_window == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.power_window == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Push Start Button </td>
                                                            <td> <i class="fa @{{car1.push_start == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.push_start == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Rear Parking Sensors </td>
                                                            <td> <i class="fa @{{car1.rear_parking == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.rear_parking == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Roof Rack </td>
                                                            <td> <i class="fa @{{car1.roof_rack == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.roof_rack == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Sunroof </td>
                                                            <td> <i class="fa @{{car1.sunroof == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.sunroof == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Warranty </td>
                                                            <td>@{{car1.warranty}}</td>
                                                            <td>@{{car2.warranty}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Wheel Metal Type </td>
                                                            <td>@{{car1.wheel_metal}}</td>
                                                            <td>@{{car2.wheel_metal}}</td>
                                                        </tr>
                                                        <tr>
                                                            <td> Wheel Size </td>
                                                            <td>@{{car1.wheel_size}}</td>
                                                            <td>@{{car2.wheel_size}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </li>
                                        <li id="first_accor" class="open">
                                            <h3 class="accordion-title"><a href="#">Safety & Security</a></h3>
                                            <div class="accordion-content" style="display: block;">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td> ABS </td>
                                                            <td> <i class="fa @{{car1.abs == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.abs == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Driver's Airbag </td>
                                                            <td> <i class="fa @{{car1.driver_airbag == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.driver_airbag == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Electronic Brake Distribution </td>
                                                            <td> <i class="fa @{{car1.electronic_brake_system == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.electronic_brake_system == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Electronic Door Locks </td>
                                                            <td> <i class="fa @{{car1.electronic_door_lock == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.electronic_door_lock == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Front Passenger's Airbag </td>
                                                            <td> <i class="fa @{{car1.fron_passenger_airbag == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.fron_passenger_airbag == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Immobilizer </td>
                                                            <td> <i class="fa @{{car1.immobilizer == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.immobilizer == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Security Alarm </td>
                                                            <td> <i class="fa @{{car1.security_alarm == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.security_alarm == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Side Airbag </td>
                                                            <td> <i class="fa @{{car1.side_airbag == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.side_airbag == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                        <tr>
                                                            <td> Stability Control </td>
                                                            <td> <i class="fa @{{car1.stability_control == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                            <td> <i class="fa @{{car2.stability_control == 1 ? 'fa-check':'fa-times'}}"></i></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
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
    </div>
@endsection
@section('scripts')
<script type='text/javascript' src="{{asset('assets/js/custom/controller.js')}}"></script>
<script type="text/javascript">
(function($) {
"use strict";
    $('.sb_variation').on('change', function()
    {
        var get_var	=	'';
        $( ".sb_variation" ).each(function() {
            var val	=	$( this ).val();

            get_var	= get_var + val.replace(/\s+/g, '') + '_';
        });
        if( $('#' + get_var ).length > 0 )
        {
            var res	=	$('#' + get_var ).val();
            var arr = res.split("-");
            var sale_price	=	arr[0];
            var old_price	=	arr[1];
            var vid	=	arr[2];
            if( sale_price == "0" )
            {
                $('#v_msg').html( 'This product is currently out of stock and unavailable.' );
                $('#sale_price').html('');
                $('#old_price').html('');
                $('#sb_add_to_cart').hide();
                $('.quantity').hide();
                $('#product_qty').hide();
            }
            else
            {
                $('#sale_price').html( '&#36;' + sale_price );
                $('#old_price').html('&#36;' + old_price );
                $('#v_msg').html('');
                $('#sb_add_to_cart').show();
                $('.quantity').show();
                $('#product_qty').show();
            }
            $('#variation_id').val( vid );
        }
    });
    $( ".sb_variation" ).trigger( "change" );

    $('#sb_add_to_cart').on('click', function()
    {
        if( $('#cart_msg').html() != 'Adding...' )
        {
            $('#cart_msg').html( "Adding..." );
            //Getting values
            var variation_id	=	$('#variation_id').val();
            var pid	=	$('#product_id').val();
            var qty	=	$('#product_qty').val();
            $.post('http://carspot.scriptsbundle.com/wp-admin/admin-ajax.php',
            {action : 'sb_cart' , product_id:pid, qty:qty,variation_id:variation_id}).done(function(response)
            {

                $('#cart_msg').html( "add to cart" );

                if( response != 0 ) {
                    var cart_url	=	'';
                    var cart_url	=	'<br /><a href="http://carspot.scriptsbundle.com/cart/">View Cart</a>';
                    toastr.success('Product Added successfully.'+cart_url, 'Success!', {timeOut: 10000,"closeButton": true, "positionClass": "toast-bottom-right"})
                }
                else {
                    toastr.error('Something went wrong, please try it again.', 'Error!', {timeOut: 15000,"closeButton": true, "positionClass": "toast-bottom-right"})
                }
            });
        }

    });

})( jQuery );
</script>
@endsection
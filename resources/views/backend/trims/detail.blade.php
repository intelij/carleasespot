@extends('backend.layouts.modal')
@section('content')
    <div class="modal-dialog" style="width: 720px !important;margin: 30px auto">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                View Trim detail
            </div>
            <div class="modal-body" id="trim_detail_modal">
                <div class="row"> 
                    <div class="col-sm-12" style="text-align: center;"> 
                        @if(isset($trim) && $trim->images != '' && $trim->images != null)
                            <?php
                                $images = explode(',', $trim->images);
                            ?>
                            @if(count($images))
                                {!! Html::image(asset('assets/car_images/model_images/'.$images[0]), 'image', array('class' => 'thumbnail', 'style' => 'display:inline-block;')) !!}
                            @endif
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Year</strong> :</span> {{$trim->year}}</div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Make</strong> :</span> {{$trim->make_name}}</div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Model</strong> :</span> {{$trim->model_name}}</div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Trim</strong> :</span> {{$trim->style_name}}</div>
                </div>
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Body Style</strong> :</span> {{ ucfirst($trim->car_type) }}</div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>MSRP</strong> :</span> ${{ ucfirst($trim->base_price) }}</div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Passenger Capacity</strong> :</span> {{ ucfirst($trim->passenger_capacity) }}</div>
                </div>
    <!--        
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Exterior Colors</strong> :</span> {{'NA'}}</div>

                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Interior Colors</strong> :</span> {{'NA'}}</div> -->

                    <!--div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Wheel</strong> :</span> {{'NA'}}</div>

                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Tire</strong> :</span> {{'NA'}}</div-->
                
                @if($trim->basic_warranty || $trim->drivetrain_warranty || $trim->roadside_warranty || $trim->free_maintenance)
                <div class="row">
                    @if($trim->basic_warranty)
                        <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Basic Waarranty</strong> :</span> {{ ucfirst($trim->basic_warranty) }}</div>
                    @endif
                    @if($trim->drivetrain_warranty)
                        <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Drivetrain Warranty</strong> :</span> {{ ucfirst($trim->drivetrain_warranty) }}</div>
                    @endif
                    @if($trim->roadside_warranty)
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Roadside Warranty</strong> :</span> {{ ucfirst($trim->roadside_warranty) }}</div>
                    @endif
                    @if($trim->free_maintenance)
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Free Maintenance</strong> :</span> {{ ucfirst($trim->free_maintenance) }}</div>
                    @endif
                </div>
                @endif
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Drivetrain</strong> :</span> {{ ucfirst($trim->drivetrain_name) }}</div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Transmission</strong> :</span> {{ ucfirst($trim->transmission_name) }}</div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Mileage</strong> :</span> {{ ucfirst($trim->mileage) }} MPG</div>
                </div>
                @if($trim->fuel_options)
                <div class="row">
                    <?php
                    $fuel_options = json_decode($trim->fuel_options,true);
                    ?>
                    @foreach($fuel_options as $key => $value)
                        <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>{{$key}}</strong> :</span>{{ ucfirst($value) }}</div>
                    @endforeach
                </div>
                @endif
                <div class="row">
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Base Engine Type</strong> :</span> {{ ucfirst($trim->car_engine) }}</div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Base Engine Size</strong> :</span> {{ ucfirst($trim->car_engine_size) }}</div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Horse Power</strong> :</span> {{ ucfirst($trim->horsepower) }}</div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Cam Type</strong> :</span> {{ ucfirst($trim->engine_cam_type) }}</div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Cylinders</strong> :</span> {{ ucfirst($trim->cylinders) }}</div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Torque</strong> :</span> {{ ucfirst($trim->engine_torque) }}</div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Turning Circle</strong> :</span> {{ ucfirst($trim->engine_turning_circle) }}</div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Valves</strong> :</span> {{ ucfirst($trim->engine_valves) }}</div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Direct Injection</strong> :</span> 
                        @if($trim->engine_direct_injection == '1')
                            <i class="fa fa-fw fa-check" style="color:#6bc242"></i>
                        @else
                            <i class="fa fa-fw fa-times" style="color:#c9302c"></i>
                        @endif
                    </div>
                    <div class="col-sm-4 col-md-4 col-xs-12"><span><strong>Valve Timing</strong> :</span> {{ ucfirst($trim->engine_valve_timing) }}</div>
                </div>
                <div class="row">
                    <div class="col-sm-2"><span><strong></strong>Safety :</span></div>
                    <div class="col-sm-10">
                        <?php 
                        $safetys = 'N/A';
                        if($trim->safety){
                            $safetys = explode(',', $trim->safety);    
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
                    <div class="col-sm-3"><span><strong></strong>In-Car Entertainment :</span></div>
                    <div class="col-sm-9">
                        <?php 
                        $ices = 'N/A';
                        if($trim->in_car_entertainment){
                            $ices = explode(',', $trim->in_car_entertainment);    
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
                    <div class="col-sm-3"><span><strong></strong>Comfort & Convenience :</span></div>
                    <div class="col-sm-9">
                        <?php 
                        $cc_options = 'N/A';
                        if($trim->comfort_convenience_options){
                            $cc_options = explode(',', $trim->comfort_convenience_options);    
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
                    <div class="col-sm-2"><span><strong></strong>Power Feature :</span></div>
                    <div class="col-sm-10">
                        <?php 
                        $pfs = 'N/A';
                        if($trim->power_feature){
                            $pfs = explode(',', $trim->power_feature);    
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
                    <div class="col-sm-3"><span><strong></strong>Instrumentation :</span></div>
                    <div class="col-sm-9">
                        <?php 
                        $insts = 'N/A';
                        if($trim->instrumentation){
                            $insts = explode(',', $trim->instrumentation);    
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

                @if($trim->frontseats)
                <div class="row">
                    <div class="col-sm-2"><span><strong></strong>Front Seats :</span></div>
                    <?php
                    $frontseats = json_decode($trim->frontseats,true);
                    ?>
                    <div class="col-sm-10">
                        <div class="row"> 
                            @foreach($frontseats as $key => $value)
                                <div class="col-md-6 col-sm-12"><span><strong>{{$key}}</strong> :</span>
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

                @if($trim->rearseats)
                <div class="row">
                    <div class="col-sm-2"><span><strong></strong>Rear Seats :</span></div>
                    <?php
                    $rearseats = json_decode($trim->rearseats,true);
                    ?>
                    <div class="col-sm-10">
                        <div class="row"> 
                            @foreach($rearseats as $key => $value)
                                <div class="col-md-6 col-sm-12"><span><strong>{{$key}}</strong> :</span>
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
                @if($trim->measurements)
                <div class="row">
                    <div class="col-sm-2"><span><strong></strong>Measurements :</span></div>
                    <?php
                    $measurements = json_decode($trim->measurements,true);
                    ?>
                    <div class="col-sm-10">
                        <div class="row"> 
                            @foreach($measurements as $key => $value)
                                <div class="col-md-6 col-sm-12"><span><strong>{{$key}}</strong> :</span>
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
                    <div class="col-sm-2"><span><strong></strong>Exterior Colors :</span></div>
                    <div class="col-sm-10">
                        @if($trim->ext_colors != 'N/A')
                            @foreach($trim->ext_colors as $ext_color)
                                <div class="color_section" style="background-color: #{{$ext_color->hex}};"></div>
                            @endforeach
                        @else
                            {{$trim->ext_colors}}
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"><span><strong></strong>Interior Colors :</span></div>
                    <div class="col-sm-10">
                        @if($trim->int_colors != 'N/A')
                            @foreach($trim->int_colors as $int_color)
                                <div class="color_section" style="background-color: #{{$int_color->hex}};"></div>
                            @endforeach
                        @else
                            {{$trim->int_colors}}
                        @endif
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-2"><span><strong></strong>Tire & Wheel :</span></div>
                    <div class="col-sm-10">
                        <?php 
                        $tire_wheels = 'N/A';
                        if($trim->tire_wheel){
                            $tire_wheels = explode(',', $trim->tire_wheel);    
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
                    <div class="col-sm-2"><span><strong></strong>Suspension :</span></div>
                    <div class="col-sm-10">
                        <?php 
                        $suspension = 'N/A';
                        if($trim->suspension){
                            $suspension = explode(',', $trim->suspension);    
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

                @if($trim->telematics)
                <div class="row">
                    <div class="col-sm-2"><span><strong></strong>Telematics :</span></div>
                    <div class="col-sm-10">
                        <?php 
                            $telematics = 'N/A';
                            $telematics = explode(',', $trim->telematics);    
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
                    <div class="col-sm-3"><span><strong></strong>Exterior Options :</span></div>
                    <div class="col-sm-9">
                        <?php 
                        $ext_options = 'N/A';
                        if($trim->exterior_options){
                            $ext_options = explode(',', $trim->exterior_options);    
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
                    <div class="col-sm-3"><span><strong></strong>Interior Options :</span></div>
                    <div class="col-sm-9">
                        <?php 
                        $int_options = 'N/A';
                        if($trim->interior_options){
                            $int_options = explode(',', $trim->interior_options);    
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
            
            <div class="modal-footer">
                <button type="button" data-rel="tooltip" data-placement="top" title="close" data-dismiss="modal" class="btn active btn-danger pull-right"> <i class="fa fa-times"></i> Close</button>
            </div>
        </div>
    </div>
@endsection
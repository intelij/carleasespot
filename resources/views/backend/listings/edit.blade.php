@extends('backend.layouts.app')
@section('content')
    < <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                                @if(Session('success') || Session('error'))
                                    {!! message() !!}
                                @endif
                                @if (count($errors) > 0)
                                    {!! form_errors($errors) !!}
                                @endif
                                <!-- end post-padding -->
                                    <div class="post-ad-form postdetails">
                                        {!! Form::model($listing, ['route' => ['admin.listings.update', $listing->id], 'method'=>'PATCH']) !!}
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                {!! Form::label('year', 'Select Year') !!}
                                                {!! Form::select('year',[''=>'Select Option', '2018' => '2018', '2019' => 2019],$listing->year, ['class' => 'form-control input-sm chosen', 'required']) !!}
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                {!! Form::label('make', 'Select Make') !!}
                                                {!! Form::select('make',$makes,$listing->id_car_make, ['class' => 'form-control input-sm chosen', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="row" id="ad_cat_sub_div">
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                {!! Form::label('model', 'Model',['class'=>'control-label']) !!}
                                                {!! Form::select('model',$models, $listing->id_car_model, ['class' => 'form-control input-sm', 'required','id'=>'models']) !!}
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                {!! Form::label('trim', 'Trim',['class'=>'control-label']) !!}
                                                {!! Form::select('trim',$trims, $listing->id_car_trim, ['class' => 'form-control input-sm', 'required','id'=>'trims']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-6">
                                                {!! Form::label('type', 'Type',['class'=>'control-label']) !!}
                                                {!! Form::select('type', ['0'=>'Lease','1'=>'Sell','2'=>'Both'], $listing->type, ['class' => 'form-control input-sm', 'required']) !!}
                                            </div>
                                            
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-6" id="lease_price_div">
                                                {!! Form::label('price', 'Lease Price($)',['class'=>'control-label']) !!}
                                                {!! Form::number('price', $listing->price, ['class'=>'form-control']) !!}
                                            </div>
                                            
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-6" id="sell_price_div">
                                                {!! Form::label('sell_price', 'Sell Price($)',['class'=>'control-label']) !!}
                                                {!! Form::number('sell_price', $listing->sell_price, ['class'=>'form-control']) !!}
                                            </div>
                                            
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                {!! Form::label('terms', 'Term of Lease (months)',['class'=>'control-label']) !!}
                                                {!! Form::number('terms', $listing->terms, ['class'=>'form-control','required']) !!}
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                {!! Form::label('down_payment', 'Down Payment ($$)',['class'=>'control-label']) !!}
                                                {!! Form::text('down_payment', number_format($listing->down_payment), ['class'=>'form-control','required']) !!}
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                {!! Form::label('mileage', 'Mileage (Per Year)',['class'=>'control-label']) !!}
                                                {!! Form::text('mileage', number_format($listing->mileage), ['class'=>'form-control','required']) !!}
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-6 margin-bottom-20">
                                                {!! Form::label('state', 'State(ex: New Jersey)',['class'=>'control-label']) !!}
                                                {!! Form::select('state[]',$states, explode(',', $listing->state), ['class' => 'form-control input-sm', 'required', 'multiple', 'id' => 'state']) !!}
                                            </div>
                                        </div>
                                          <input type="hidden" value="{{ $listing->dealer_id }}" name="uuid">
                                        <!-- end row -->
                                        <div class="row" style="margin-top: 20px;">
                                            <button class="btn btn-theme pull-right" id="ad_submit">Save</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- end post-ad-form-->
                                </div>
                            </div>
                        </div>
                </div>
            </div>
@endsection
@section('scripts')
    <script>
        (function($){
            if($('[name=type]').val() == '2'){
                $('#sell_price_div').show();
                $('#lease_price_div').show();
            }else if($('[name=type]').val() == '1'){
                $('#sell_price_div').show();
                $('#lease_price_div').hide();
            }else{
                $('#sell_price_div').hide();
                $('#lease_price_div').show();
            }
            $(document).on('change','[name=make]', function(){
                var year = $('[name=year]').val();
                if(year == ''){
                    return false;
                }
                var make = $(this).val();
                if(make == ''){
                    return false;
                }
                var dropdown = $('#models');
                dropdown.prop('disabled',true).html('');
                dropdown.append('<option value="">Select Option</option>');
                var trim_dropdown = $('#trims');
                trim_dropdown.prop('disabled',true).html('');
                trim_dropdown.append('<option value="">Select Option</option>');
                $.post('{{route('make_models')}}',{make:make, year:year, "_token": "{{ csrf_token() }}"}, function(data) {
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

            $(document).on('change','[name=year]', function(){
                var year = $(this).val();
                if(year == ''){
                    return false;
                }
                var make = $('[name=make]').val();
                if(make == ''){
                    return false;
                }
                var dropdown = $('#models');
                dropdown.prop('disabled',true).html('');
                dropdown.append('<option value="">Select Option</option>');
                var trim_dropdown = $('#trims');
                trim_dropdown.prop('disabled',true).html('');
                trim_dropdown.append('<option value="">Select Option</option>');
                $.post('{{route('make_models')}}',{make:make, year:year, "_token": "{{ csrf_token() }}"}, function(data) {
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
            $(document).on('change','[name=type]', function(){
                if($(this).val() == '2'){
                    $('#sell_price_div').show();
                    $('#lease_price_div').show();
                }else if($(this).val() == '1'){
                    $('#sell_price_div').show();
                    $('#lease_price_div').hide();
                }else{
                    $('#sell_price_div').hide();
                    $('#lease_price_div').show();
                }
            });
            $('#state').select2({
                placeholder: "Select a State",
                allowClear: true,
                maximumSelectionLength: 6,
            });
            $('#state').on('select2:select', function (e) {
                var data = e.params.data;
                if(data.id == "1"){
                    $('#state').val(['1']);
                    $('#state').trigger('change');
                    $('#state option[value != "1"]').prop('disabled', true);
                    $('#state').select2({
                        placeholder: "Select a State",
                        allowClear: true,
                        maximumSelectionLength: 6,
                    });
                }
            });
            $('#state').on('select2:unselect', function (e) {
                var data = e.params.data;
                if(data.id == "1"){
                    $('#state option[value != "1"]').prop('disabled', false);
                    $('#state').select2({
                        placeholder: "Select a State",
                        allowClear: true,
                        maximumSelectionLength: 6,
                    });
                }
            });
            $('[name="down_payment"]').maskNumber({integer: true});
            $('[name="mileage"]').maskNumber({integer: true});
        })(jQuery)
    </script>
@endsection
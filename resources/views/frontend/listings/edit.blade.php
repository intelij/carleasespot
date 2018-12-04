@extends('frontend.layouts.app')
@section('content')
    <div class="page-header-area-2 gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="small-breadcrumb">
                        <div class="header-page">
                            <h1>Sell Your Car</h1>
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
                            <!-- Row -->
                            <div class="row">
                                <div class="col-md-8 col-lg-8 col-xs-12 col-sm-12">
                                @if(Session('success') || Session('error'))
                                    {!! message() !!}
                                @endif
                                @if (count($errors) > 0)
                                    {!! form_errors($errors) !!}
                                @endif
                                <!-- end post-padding -->
                                    <div class="post-ad-form postdetails">
                                        {!! Form::model($listing, ['route' => ['listings.update', $listing->uuid], 'method'=>'PATCH']) !!}
                                        <div class="row">
                                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                                {!! Form::label('make', 'Select Make') !!}
                                                {!! Form::select('make',$makes,$listing->id_car_make, ['class' => 'form-control input-sm chosen', 'required']) !!}
                                            </div>
                                        </div>
                                        <div class="row" id="ad_cat_sub_div">
                                            <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12">
                                                {!! Form::label('model', 'Model',['class'=>'control-label']) !!}
                                                {!! Form::select('model',$models, $listing->id_car_model,[''=>'Select Option'], ['class' => 'form-control input-sm', 'required','id'=>'models']) !!}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-6">
                                                {!! Form::label('type', 'Type',['class'=>'control-label']) !!}
                                                {!! Form::select('type', ['0'=>'Lease','1'=>'Sell','2'=>'Both'], null, ['class' => 'form-control input-sm', 'required']) !!}
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-6" id="price_div">
                                                {!! Form::label('price', 'Price($)',['class'=>'control-label']) !!}
                                                {!! Form::number('price', null, ['class'=>'form-control','required']) !!}
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-6" id="sell_price_div" style="display:none">
                                                {!! Form::label('sell_price', 'Sell Price($)',['class'=>'control-label']) !!}
                                                {!! Form::number('sell_price', null, ['class'=>'form-control']) !!}
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                {!! Form::label('terms', 'Term of Lease (months)',['class'=>'control-label']) !!}
                                                {!! Form::number('terms', null, ['class'=>'form-control','required']) !!}
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                {!! Form::label('down_payment', 'Down Payment ($$)',['class'=>'control-label']) !!}
                                                {!! Form::number('down_payment', null, ['class'=>'form-control','required']) !!}
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                {!! Form::label('mileage', 'Mileage (Per Year)',['class'=>'control-label']) !!}
                                                {!! Form::number('mileage', null, ['class'=>'form-control','required']) !!}
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-6 margin-bottom-20">
                                                {!! Form::label('year', 'Year',['class'=>'control-label']) !!}
                                                @php($years=[''=>'Select Option'])
                                                @for($year = 2010;$year < 2018;$year++)
                                                    @php($years[$year] = $year)
                                                @endfor
                                                {!! Form::select('year',$years, null, ['class' => 'form-control input-sm chosen', 'required']) !!}
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-6 margin-bottom-20">
                                                @php($colors = [''=>'Select Option','Black'=>'Black','Blue'=>'Blue','Bronze'=>'Bronze','Gold'=>'Gold','Green'=>'Green','Grey'=>'Blue','Red'=>'Red','Silver'=>'Silver','White'=>'White'])
                                                {!! Form::label('color', 'Color',['class'=>'control-label']) !!}
                                                {!! Form::select('color', $colors, null, ['class' => 'form-control input-sm', 'required']) !!}
                                            </div>
                                            <div class="col-md-6 col-lg-6 col-xs-12 col-sm-6 margin-bottom-20">
                                                {!! Form::label('state', 'State(ex: New Jersey)',['class'=>'control-label']) !!}
                                                {!! Form::text('state', null, ['class'=>'form-control','required']) !!}
                                            </div>
                                        </div>
                                        <!-- end row -->
                                        <button class="btn btn-theme pull-right" id="ad_submit">Post My Ad</button>
                                        {!! Form::close() !!}
                                    </div>
                                    <!-- end post-ad-form-->
                                </div>
                                <div class="col-md-4 col-xs-12 col-sm-12">
                                    <div class="blog-sidebar">
                                        <div class="widget">
                                            <div class="widget-heading">
                                                <h4 class="panel-title"><a>Safety Tips for Buyers</a></h4>
                                            </div>
                                            <div class="widget-content">
                                                <p class="lead"></p>
                                                <ol>
                                                    <li>Use a safe location to meet seller</li>
                                                    <li>Avoid cash transactions</li>
                                                    <li>Beware of unrealistic offers</li>
                                                    <li>Check the item before you buy</li>
                                                    <li>Pay only after collecting item</li>
                                                </ol>
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
@endsection
@section('scripts')
    <script>
        (function($){
            if($('[name=type]').val() == 2){
                $('#sell_price_div').show();
            }
            $(document).on('change','[name=make]', function(){
                var make = $(this).val();
                var dropdown = $('#models');
                dropdown.prop('disabled',true).html('');
                dropdown.append('<option value="">Select Option</option>');
                $.post('{{route('make_models')}}',{make:make,"_token": "{{ csrf_token() }}"}, function(data) {
                    if(data != ''){
                        // Loop through each of the results and append the option to the dropdown
                        $.each(data, function(k, v){
                            dropdown.append('<option value="' + v.uuid + '">' + v.name + '</option>');
                        });
                    }
                }).always(function() {
                    dropdown.prop('disabled',false);
                });
            });
            $(document).on('change','[name=type]', function(){
                if($(this).val() == 2){
                    $('#sell_price_div').show();
                }else{
                    $('#sell_price_div').hide();
                }
            });
        })(jQuery)
    </script>
@endsection
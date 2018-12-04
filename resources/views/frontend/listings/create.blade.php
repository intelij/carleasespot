@extends('frontend.layouts.app')
@section('content')
    <div class="page-header-area-2 gray">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="small-breadcrumb">
                        <div class="header-page pull-left">
                            <h1>Sell Your Car</h1>
                        </div>
                        <form action="" method="post"
                                name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
                            <div class="pull-right">
                                <a href="{{ asset('excel_files/Template.xlsx') }}" download class="btn btn-success">Download Template</a><br/>
                                <button type="button" id="import_xls" name="import" class="btn btn-theme btn-submit pull-left" style="margin-top: 5px;">Import from Excel</button>
                            </div>
                            <div class="pull-right" style="margin-left: 20px;">
                                
                                <div><p>
                                    <label>Choose Excel
                                        File</label></p> <input type="file" name="file"
                                        id="file" accept=".xls,.xlsx" class="pull-left">
                                    
                                </div>
                                
                            </div>

                        </form>
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
                                        {!! Form::open(['route' => ['listings.store']]) !!}
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                    {!! Form::label('year', 'Select Year') !!}
                                                    {!! Form::select('year',[''=>'Select Option', '2018' => 2018, '2019' => 2019], null, ['class' => 'form-control input-sm chosen', 'required']) !!}
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                    {!! Form::label('make', 'Select Make') !!}
                                                    {!! Form::select('make',$makes, null, ['class' => 'form-control input-sm chosen', 'required']) !!}
                                                </div>
                                            </div>
                                            <div class="row" id="ad_cat_sub_div">
                                                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                    {!! Form::label('model', 'Model',['class'=>'control-label']) !!}
                                                    {!! Form::select('model', [''=>'Select Option'], null, ['class' => 'form-control input-sm', 'required','id'=>'models']) !!}
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xs-6 col-sm-6">
                                                    {!! Form::label('trim', 'Trim',['class'=>'control-label']) !!}
                                                    {!! Form::select('trim', [''=>'Select Option'], null, ['class' => 'form-control input-sm', 'required','id'=>'trims']) !!}
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-6">
                                                    {!! Form::label('type', 'Type',['class'=>'control-label']) !!}
                                                    {!! Form::select('type', ['0'=>'Lease','1'=>'Sell','2'=>'Both'], null, ['class' => 'form-control input-sm', 'required']) !!}
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-6" id="lease_price_div">
                                                    {!! Form::label('price', 'Monthly Lease Price($)',['class'=>'control-label']) !!}
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
                                                    {!! Form::text('down_payment', null, ['class'=>'form-control','required']) !!}
                                                </div>
                                                <div class="col-md-6 col-lg-6 col-xs-12 col-sm-12">
                                                    {!! Form::label('mileage', 'Mileage (Per Year)',['class'=>'control-label']) !!}
                                                    {!! Form::text('mileage', null, ['class'=>'form-control','required']) !!}
                                                </div>
                                                <div class="col-md-12 col-lg-12 col-xs-12 col-sm-12 margin-bottom-20">
                                                    {!! Form::label('state', 'State(ex: New Jersey)',['class'=>'control-label']) !!}
                                                    {!! Form::select('state[]',$states, null, ['class' => 'form-control input-sm', 'required', 'multiple', 'id' => 'state']) !!}
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

            $('#import_xls').click(function(){
                if($('#file')[0].files.length){
                    $('#loading_modal').modal('show');
                    var formData = new FormData();
                    formData.append('file', $('#file')[0].files[0]);
                    $.ajax({
                           url : "{{url('excel_upload')}}",
                           type : 'POST',
                           data : formData,
                           dataType: 'json',
                           processData: false,  // tell jQuery not to process the data
                           contentType: false,  // tell jQuery not to set contentType
                           success : function(data) {
                                $('#loading_modal').modal('hide');
                                var str = '<div class="modal-content"><div class="modal-header"><h3>Register Result</h3></div><div class="modal-body scrollable">';
                                str += '<div class="row"><div class="col-xs-12><span class="total_count">Total registered count: '+data.total+'</span></div></div>';
                                if(data.msg){
                                    if(data.msg.success){
                                        str += '<div class="row"><div class="col-xs-12"><p>Registered List</p><ul class="detail_list">';
                                        $.each(data.msg.success, function(index, value){
                                            str += '<li class="detail_list_li">registered row: '+value+'</li>';
                                        });
                                        str += '</ul></div></div>';
                                    }
                                    if(data.msg.err){
                                        str += '<div class="row" style="margin-top: 20px;"><p>Error List</p><div class="col-xs-12"><ul class="detail_list">';
                                        $.each(data.msg.err, function(index, value){
                                            $.each(value, function(index1, value1){
                                                str += '<li class="detail_list_li error">'+value1+'</li>';
                                            });
                                        });
                                        str += '</ul></div></div>';
                                    }
                                }
                                str += '</div>';
                                str += '<div class="modal-footer"><button type="button" data-rel="tooltip" data-placement="top" title="close" data-dismiss="modal" class="btn active btn-danger pull-right"> <i class="fa fa-times"></i> Close</button></div>';
                                str += '</div>';
                                $('#ajax-modal .modal-dialog').html(str);
                                $('#ajax-modal').modal('show');
                           }
                    });    
                }else{
                    alert('You must choose excel file to upload.');
                }
            });
        })(jQuery)
    </script>
@endsection
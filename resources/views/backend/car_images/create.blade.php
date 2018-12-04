@extends('backend.layouts.app')
@section('styles')
    <link href="{{asset('assets/backend/vendor/fileinput/fileinput.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        {!! Form::open(['route' => ['admin.car_images.store'], 'class' => 'ajax-submit needs-validation','id'=>'car_images_frm']) !!}
                        <div class="x_title">
                            <h2>Car Images</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    {!! Form::label('make', 'Make',['class'=>'control-label']) !!}
                                    {!! Form::select('make', $makes,null, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    {!! Form::label('model', 'Model',['class'=>'control-label']) !!}
                                    {!! Form::select('model', [''=>'Select Option'],null, ['class' => 'form-control','id'=>'models', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    {!! Form::label('trim', 'Trim',['class'=>'control-label']) !!}
                                    {!! Form::select('trim', ['altitude'=>'Altitude','latitude'=>'Latitude','limited'=>'Limited','sport'=>'Sport','trailhawk'=>'Trailhawk'],null, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Images</label>
                                    <div class="file-loading">
                                        <input id="car_images" name="car_images[]" type="file" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/backend/vendor/fileinput/fileinput.min.js')}}"></script>
    <script>
        $(function(){
            $("#car_images").fileinput({
                //hideThumbnailContent: true, // hide image, pdf, text or other content in the thumbnail preview
                theme: "explorer",
                uploadUrl: '{{route('admin.car_images.store')}}',
                uploadAsync: false,
                minFileCount: 1,
                validateInitialCount: true,
                overwriteInitial: false,
                showUpload:true,
                showRemove:false,
                maxFileSize:2000,
                uploadExtraData: function(previewId, index){
                    var formValue = $('#car_images_frm').serializeArray();
                    var tempData = {};
                    formValue.forEach(function(v, i){
                        var name = v.name;
                        tempData[name] = v.value;
                    });
                    return tempData;
                }
            });
            $('#car_images').on('filebatchuploadsuccess', function(event, data, previewId, index) {
                $('#car_images_frm').removeClass('processing');
                var successHtml = '<div class="alert alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + data.response.msg + '</div>';
                $('#car_images_frm').prepend(successHtml);
                //window.location.href = data.response.redirectURL;
            });
            $('#car_images').on('filebatchuploaderror', function(event, data, msg){
                $('#car_images_frm').find('.alert').remove();
                $('#car_images_frm').removeClass('processing');
                $("input,textarea").each(function(){
                    $(this).parents('.form-group').removeClass("has-error");
                });
                var errorStr = '';
                $.each(data.jqXHR.responseJSON.errors, function (key, value) {
                    $('[name="' + key + '"]').parents('.form-group').addClass("has-error");
                    errorStr += '- ' + value[0] + '<br/>';
                });
                var errorsHtml = '<div class="alert alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>' + errorStr + '</div>';
                $('#car_images_frm').prepend(errorsHtml);
                $('.file-error-message').hide();
                //window.location.reload(true);
            });
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
            })
        });
    </script>
@endsection

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
                                    {!! Form::select('make', $makes,$make, ['class' => 'form-control', 'required']) !!}
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    {!! Form::label('model', 'Model',['class'=>'control-label']) !!}
                                    {!! Form::select('model', $models,$model, ['class' => 'form-control','id'=>'models', 'required']) !!}
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
    <?php $file_count = 0;$current_files =[];$preview_config=[]; ?>
    @if(count($car_images))
        @foreach($car_images->sortBy('image_order') as $image)
            <?php
            $image_link = '<img src="'.asset('assets/car_images/'.$image->make_id.$image->model_id.'/'.$image->file_name).'" alt="'.$image->file_name.'" data-key="'.$image->uuid.'" style="width:auto;max-width:100%;max-height:100%;"/>';
            array_push($current_files,$image_link);
            $preview_config[$file_count]['caption']=$image->file_name;
            $preview_config[$file_count]['url']= route('delete-car-image');
            $preview_config[$file_count]['key']= $image->uuid;
            $file_count++;
            ?>
        @endforeach
    @endif
@endsection
@section('scripts')
    <script src="{{asset('assets/backend/vendor/fileinput/sortable.min.js')}}"></script>
    <script src="{{asset('assets/backend/vendor/fileinput/fileinput.min.js')}}"></script>
    <script>
        $(function(){
            var project_files = <?php echo json_encode($current_files); ?>, preview_config = <?php echo json_encode($preview_config); ?>;
            $("#car_images").fileinput({
                //hideThumbnailContent: true, // hide image, pdf, text or other content in the thumbnail preview
                theme: "explorer",
                uploadUrl: '{{route('admin.car_images.store')}}',
                uploadAsync: false,
                minFileCount: 1,
                overwriteInitial: false,
                showUpload:true,
                showRemove:false,
                maxFileSize:2000,
                initialPreview: project_files,
                initialPreviewConfig: preview_config,
                validateInitialCount: true,
                uploadExtraData: function(previewId, index){
                    var formValue = $('#car_images_frm').serializeArray();
                    var tempData = {};
                    formValue.forEach(function(v, i){
                        var name = v.name;
                        tempData[name] = v.value;
                    });
                    return tempData;
                }
            }).on('filesorted', function(e, params) {
                var a = $(".file-preview-thumbnails > .file-preview-frame .kv-file-content img"),
                items = new Array();
                $.each(a, function(index, item){
                    item = $(item);
                    items.push(item.attr('data-key'));
                });
                $.ajax({
                    type: 'POST',
                    url: '{{route('reorder_images')}}',
                    data: {
                        _token:'{{csrf_token()}}',
                        items: items
                    }
                });
                console.log('file sorted', e, params);
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
            /*$('.file-preview-thumbnails').sortable({
                items: '.file-preview-frame',
                tolerance: 'pointer',
                placeholder: 'ui-state-highlight',
                update: function(event, ui) {
                    $.post('/index.php?obj=...&action=sort', $('.file-preview-thumbnails').sortable('serialize'));
                }
            });*/
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

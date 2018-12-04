@extends('backend.layouts.app')
@section('styles')
    <link href="{{asset('assets/backend/vendor/switchery/switchery.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Vehicle Models</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <a href="{{route('admin.models.create')}}" data-toggle="ajax-modal" class="btn btn-info pull-right"><i class="fa fa-plus"></i> New Model</a>
                            <a href="javascript:void(0);" id="update_models" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Update Models Automatically</a>
                            <div class="clearfix"></div>
                            @if(Session('success') || Session('error'))
                                {!! message() !!}
                            @endif
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Make</th>
                                    <th>Year</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($models as $count=>$model)
                                    <tr>
                                        <td>{{$count+1}}</td>
                                        <td>{{$model->name}}</td>
                                        <td>{{$model->make_name}}</td>
                                        <td>{{$model->year}}</td>
                                        <td>
                                            @if($model->model_image)
                                            <?php
                                                $model_images = explode(',', $model->model_image);
                                            ?>
                                                @if(count($model_images))
                                                    <img src="{{ asset('assets/car_images/model_images/'.$model_images[0]) }}" class="thumbnail" />
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            {!! edit_btn('admin.models.edit', $model->id_car_model) !!}
                                            {!! delete_btn('admin.models.destroy', $model->id_car_model) !!}
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{asset('assets/backend/vendor/switchery/switchery.min.js')}}"></script>
    <script>
        
        $(document).on('change','.activate',function(){
            var key = $(this).val();
            var status = 0;
            if($(this).prop('checked')){
                status = 1;
            }
            $.post('{{route('toggle_model')}}',{key:key,status:status,"_token": "{{ csrf_token() }}"});
        });
        $('#update_models').click(function(){
            
            
             $('#loading_modal').modal('show');
            
            
            $.post("{{route('update_models')}}", function(res){
                $('#loading_modal').modal('hide');
                if(res.success){
                    var str = '<div class="modal-content"><div class="modal-header"><h3>Update Result</h3></div><div class="modal-body scrollable">';
                    str += '<div class="row"><div class="col-xs-12><span class="total_count">'+res.msg+'</span></div></div>';
                    if(res.detail.length){
                        str += '<div class="row"><div class="col-xs-12"><ul class="detail_list">';
                        $.each(res.detail, function(index,value){
                            str += '<li class="detail_list_li">'+value+'</li>';
                        });
                        str += '</ul></div></div>';
                    }
                    str += '</div>';

                    str += '<div class="modal-footer"><button type="button" data-rel="tooltip" data-placement="top" title="close" data-dismiss="modal" class="btn active btn-danger pull-right"> <i class="fa fa-times"></i> Close</button></div>';
                    str += '</div>';
                    $('#ajax-modal .modal-dialog').html(str);
                    $('#ajax-modal').modal('show');
                }
            },'json');
        });
    </script>
@endsection
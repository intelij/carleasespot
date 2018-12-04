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
                            <h2>Vehicle Trims</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <!--a href="{{route('admin.trims.create')}}" data-toggle="ajax-modal" class="btn btn-info pull-right"><i class="fa fa-plus"></i> New Trims</a-->
                            <a href="javascript:void(0);" id="update_trims" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Update Trims Automatically</a>
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
                                    <th>Model</th>
                                    <th>Year</th>
                                    <th>BodyType</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($trims as $count=>$trim)
                                    <tr>
                                        <td>{{$count+1}}</td>
                                        <td>{{$trim->name}}</td>
                                        <td>{{$trim->make_name}}</td>
                                        <td>{{$trim->model_name}}</td>
                                        <td>{{$trim->year}}</td>
                                        <td>{{$trim->car_type}}</td>
                                        <td>
                                            {!! show_detail_btn('admin.trims.detail', $trim->id_car_trim) !!}
                                            {!! delete_btn('admin.trims.destroy', $trim->id_car_trim) !!}
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
        $('#update_trims').click(function(){
            $('#loading_modal').modal('show');
            $.post("{{route('update_trims')}}", function(res){
                $('#loading_modal').modal('hide');
                if(res.success){
                    var str = '<div class="modal-content"><div class="modal-header"><h3>Update Result</h3></div><div class="modal-body scrollable">';
                    str += '<div class="row"><div class="col-xs-12><span class="total_count">'+res.msg+'</span></div></div>';
                    str += '<div class="row"><div class="col-xs-12><span class="total_count">'+res.msg1+'</span></div></div>';
                    if(res.insert_detail.length){
                        str += '<div class="row"><div class="col-xs-12"><p>Inserted List</p><ul class="detail_list">';
                        $.each(res.insert_detail, function(index, value){
                            str += '<li class="detail_list_li">'+value+'</li>';
                        });
                        str += '</ul></div></div>';
                    }
                    if(res.update_detail.length){
                        str += '<div class="row"><div class="col-xs-12"><p>Updated List</p><ul class="detail_list">';
                        $.each(res.update_detail, function(index,value){
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
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
                            <h2>Vehicle Makes</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <a href="{{route('admin.makes.create')}}" data-toggle="ajax-modal" class="btn btn-info pull-right"><i class="fa fa-plus"></i> New Make</a>
                            <a href="javascript:void(0);" id="update_makes" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Update Makes Automatically</a>
                            <div class="clearfix"></div>
                            @if(Session('success') || Session('error'))
                                {!! message() !!}
                            @endif
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Nice Name</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($makes as $count=>$make)
                                    <tr>
                                        <td>{{$count+1}}</td>
                                        <td>{{$make->name}}</td>
                                        <td>{{$make->niceName}}</td>
                                        <td>
                                            {!! edit_btn('admin.makes.edit', $make->id_car_make) !!}
                                            {!! delete_btn('admin.makes.destroy', $make->id_car_make) !!}
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
            $.post('{{route('toggle_make')}}',{key:key,status:status,"_token": "{{ csrf_token() }}"});
        });
        $('#update_makes').click(function(){
            $.post("{{route('update_makes')}}", function(res){
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
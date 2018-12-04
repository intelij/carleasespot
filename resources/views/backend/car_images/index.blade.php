@extends('backend.layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Car Images</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <a href="{{route('admin.car_images.create')}}" class="btn btn-info pull-right"><i class="fa fa-plus"></i> New Images</a>
                            <div class="clearfix"></div>
                            @if(Session('success') || Session('error'))
                                {!! message() !!}
                            @endif
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Make</th>
                                    <th>Model</th>
                                    <th>Images</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($images as $count=>$image)
                                    <tr>
                                        <td>{{$count+1}}</td>
                                        <td>{{$image->make_name}}</td>
                                        <td>{{$image->model_name}}</td>
                                        <td>{{$image->images_num}} images</td>
                                        <td>
                                            <a class="btn  active btn-success" href="{{route('admin.car_images.edit', $image->uuid)}}" title="Edit"><i class="fa fa-pencil"></i></a>
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

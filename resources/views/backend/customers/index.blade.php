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
                            <h2>customers</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <a href="{{route('admin.newcustomers')}}"  class="btn btn-info pull-right"> Deactivated customers</a>
                            <div class="clearfix"></div>
                            @if(Session('success') || Session('error'))
                                {!! message() !!}
                            @endif
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Photo</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($customers as $count=>$customer)
                                    <tr>
                                        <td>{{$count+1}}</td>
                                        <td><img src="{{asset($customer->photo != "" ? "assets/user_files/".$customer->uuid."/".$customer->photo : "assets/user_files/no-image.jpg" )}}" width="36px"></td>
                                        <td>{{$customer->name}}</td>
                                        <td>{{$customer->email}}</td>
                                        <td>@if($customer->status == 0 ) <a href="{{route('admin.customers.activate',$customer->uuid)}}"><span class="label label-success"> Activate </span></a> @else <a href="{{route('admin.customers.destroy',$customer->uuid)}}"><span class="label label-success"> Deactivate </span></a>@endif </td>
                                        <td>
                                            {!! edit_btn('admin.customers.edit', $customer->uuid) !!}
                                            {!! delete_btn('admin.customers.destroy', $customer->uuid) !!}
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


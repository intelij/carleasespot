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
                            <h2>Listings</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
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
                                    <th>Listings</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($dealers as $count=>$dealer)
                                    <tr>
                                        <td>{{$count+1}}</td>
                                        <td><img src="{{asset($dealer->photo != "" ? "assets/user_files/".$dealer->uuid."/".$dealer->photo : "assets/user_files/no-image.jpg" )}}" width="36px"></td>
                                        <td>{{$dealer->name}}</td>
                                        <td>{{$dealer->email}}</td>
                                        <td><a href="{{url('admin/listings/'.$dealer->uuid)}}">{{$dealer->listing_count}}</a></td>
                                        
                                        <td><a href="{{url('admin/listings/'.$dealer->uuid)}}" class="btn btn-info edit_btn" ><i class="fa fa-fw fa-eye"></i> View Listing Detail</a>
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
    <script>
        
    </script>
@endsection

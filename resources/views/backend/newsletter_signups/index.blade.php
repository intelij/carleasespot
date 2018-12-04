@extends('backend.layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Newsletter Signups</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <a href="{{route('admin.newsletter_signups.create')}}" data-toggle="ajax-modal" class="btn btn-info pull-right"><i class="fa fa-plus"></i> New Signup</a>
                            <div class="clearfix"></div>
                            @if(Session('success') || Session('error'))
                                {!! message() !!}
                            @endif
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($newsletter_signups as $count=>$newsletter_signup)
                                    <tr>
                                        <td>{{$count+1}}</td>
                                        <td>{{$newsletter_signup->email}}</td>
                                        <td>{!! $newsletter_signup->status == 1 ? '<span class="label label-success"> Subscribed </span>' : '<span class="label label-danger"> Unsubscribed </span>' !!}</td>
                                        <td>
                                            {!! edit_btn('admin.newsletter_signups.edit', $newsletter_signup->uuid) !!}
                                            {!! delete_btn('admin.newsletter_signups.destroy', $newsletter_signup->uuid) !!}
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

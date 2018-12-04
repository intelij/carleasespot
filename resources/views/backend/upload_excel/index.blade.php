@extends('backend.layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Upload Cars data</h2>
                            <div class="clearfix"></div>
                        </div>
                        @if(Session::has('success'))
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Message: </strong>
                            {{Session::get('success')}}
                        </div>
                        @endif

                        @if(Session::has('failure'))
                        <div class="alert alert-danger">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Message: </strong>
                            {{Session::get('failure')}}
                        </div>
                        @endif
                        <form action="{{url('/admin/postExcel')}}" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <input type="hidden" name="_token" value="{{csrf_token()}}">
                                <div class="col-md-6 form-group">
                                    <label>Upload Excel File</label>
                                    <input type="file" name="excel_file" class="form-control">
                                </div>
                                <div class="col-md-6 form-group">
                                    <button type="submit" class="btn active btn-success pull-left" style="margin-top: 23px">Upload</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

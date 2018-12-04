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
                            <h2>Dealers</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
 <a href="{{route('admin.newdealers')}}" class="btn btn-info pull-right">New Dealers</a>
                            <a href="{{route('admin.dealers.create')}}" data-toggle="ajax-modal" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New Dealer</a>
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
                                     <th>Top</th>
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
                                        <td>@if($dealer->status == 0 ) <a href="{{route('admin.dealers.activate',$dealer->uuid)}}"><span class="label label-success"> Activate </span></a> @else <a href="{{route('admin.dealers.deactivate',$dealer->uuid)}}"><span class="label label-success"> Deactivate </span></a>@endif </td>
<td>
                                        <input type="checkbox" class="js-switch feature" {{$dealer->top == 1 ? 'checked' : ''}} data-switchery="true" value="{{$dealer->uuid}}">
                                    </td>
                                        <td>
                                            {!! edit_btn('admin.dealers.edit', $dealer->uuid) !!}
                                            {!! delete_btn('admin.dealers.destroy', $dealer->uuid) !!}
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
 $(document).on('change','.feature',function(){
            var key = $(this).val();
            var featured = 0;
           if($(this).prop('checked')){
               featured = 1;
           }
            $.post('{{route('top_dealers')}}',{key:key,featured:featured,"_token": "{{ csrf_token() }}"},function(result){
			console.log(result)
			});
        });
</script>
@endsection

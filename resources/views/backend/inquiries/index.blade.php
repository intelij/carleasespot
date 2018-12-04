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
                            <h2>Inquiries</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                  <a href="{{route('inquiry.archive')}}" class="btn btn-info pull-right"> Archive</a>
                            @if(Session('success') || Session('error'))
                                {!! message() !!}
                            @endif
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Dealer</th>
                                    <th>Car</th>
                                    <th>Type</th>
                                    <th>Price</th>
                                    <th>Date</th>
                                    <th>IP  Adddress</th>
                                    <th>Action</th>
                                    <th>Archive</th>
                                </tr>
                                </thead>
                                <tbody>
                                @php($count = 1)
                                @foreach($inquiries->sortBy('created_at') as $inquiry)
                                    <tr>
                                    <td>{{$count}}</td>
                                    <td>{{$inquiry->dealer->name}}</td>
                                    <td>{{$inquiry->car}}</td>
                                    <td>{{$inquiry->type == 0 ? 'Lease' : 'Sell'}}</td>
                                    <td>{{$inquiry->price}}</td>
                                    <td>{{$inquiry->created_at}}</td>
                                    <td>{{$inquiry->ip_address}}</td>
                                    <td>
                                        <a href="{{route('admin.inquiries.show', $inquiry->uuid)}}" data-toggle="ajax-modal" class="btn btn-success"><i class="fa fa-eye"></i> View Inquiry Details</a>
                                    </td>
<td>
                                        <input type="checkbox" class="js-switch feature" {{$inquiry->archive == 1 ? 'checked' : ''}} data-switchery="true" value="{{$inquiry->uuid}}">
                                    </td>
                                    </tr>
                                    @php($count++)
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

            $.post('{{route('addarchive')}}',{key:key,"_token": "{{ csrf_token() }}"},function(result){
			 location.reload();
			});
        });
		   </script>
@endsection

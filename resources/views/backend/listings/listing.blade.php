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
                            <div class="" style="text-align: right;">
                                <a href="{{url('admin/listings')}}" class="btn btn-danger"><i class="fa fa-angle-double-left"></i> Back to Listing</a>
                            </div>
                        </div>
                        <div class="x_content">
                            @if(Session('success') || Session('error'))
                                {!! message() !!}
                            @endif
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Make</th>
                                        <th>Model</th>
                                        <th>Trim</th>
                                        <th>Type</th>
                                        <th>Mileage</th>
                                        <th>Year</th>
                                        <th>Featured</th>
                                        <th>Top</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
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

        var datatbale = $('#datatable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "{{url('admin/get_list')}}",
                "data": function(d){
                    d.dealer_id = "{{$uuid}}";
                }
            },
            "initComplete": function(settings, json){
                var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
                elems.forEach(function(html) {
                  var switchery = new Switchery(html);
                });
            }
        });
        
        $(document).on('change','.feature',function(){
            var key = $(this).val();
            var key_arr = key.split(',');
            var lid = key_arr[0];
            var trim_id = key_arr[1];
            var featured = 0;
           if($(this).prop('checked')){
               featured = 1;
           }
           var ele = $(this);
            $.post('{{route('toggle_featured')}}',{list_id:lid, trim_id:trim_id ,featured:featured,"_token": "{{ csrf_token() }}"}, function(res){
                    if(res == 'exits'){
                        alert('This car already have featured listing.');
                        ele.trigger('click');
                    }
            });
        });
        $(document).on('change','.top_listing',function(){
            var key = $(this).val();
            var key_arr = key.split(',');
            var lid = key_arr[0];
            var trim_id = key_arr[1];
            var top = 0;
            if($(this).prop('checked')){
                top = 1;
            }
            var ele = $(this);
            $.post('{{route('toggle_top')}}',{list_id:lid, trim_id:trim_id ,top:top,"_token": "{{ csrf_token() }}"},
                function(res){
                    if(res == 'exits'){
                        alert('This car already have 3 top listing.');
                        ele.trigger('click');
                    }
            });
        });
        $(document).on('change','.active',function(){
            var key = $(this).val();
            var status = 0;
            if($(this).prop('checked')){
                status = 1;
            }
            $.post('{{route('toggle_status')}}',{key:key,status:status,"_token": "{{ csrf_token() }}"});
        });
    </script>
@endsection

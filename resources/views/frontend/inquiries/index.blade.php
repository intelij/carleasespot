@if(count($inquiries) > 0)
    <div class="message-body">
        <table id="datatable" class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Car</th>
                <th>Type</th>
                <th>Price</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @php($count = 1)
            @foreach($inquiries->sortBy('created_at') as $inquiry)
                <tr>
                    <td>{{$count}}</td>
                    <td>{{$inquiry->first_name.' '.$inquiry->last_name}}</td>
                    <td>{{$inquiry->car}}</td>
                    <td>
                        @if($inquiry->type == 0)
                            Lease
                        @else
                            Sell
                        @endif
                    </td>
                    <td>{{$inquiry->price}}</td>
                    <td>{{$inquiry->created_at}}</td>
                    <td>
                        <a href="{{route('inquiries.show', $inquiry->uuid)}}" data-toggle="ajax-modal" class="btn btn-sm btn-success"><i class="fa fa-eye"></i> View Inquiry Details</a>
                    </td>
                </tr>
                @php($count++)
            @endforeach
            </tbody>
        </table>
    </div>
@else
    <h2>No Result Found.</h2>
@endif

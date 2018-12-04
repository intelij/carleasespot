@if(count($listings) > 0)
    <div class="message-body">
        <table class="table table-striped table-bordered">
            <thead>
            <tr>
                <th>#</th>
                <th>Make</th>
                <th>Model</th>
                <th>Type</th>
                <th>Mileage</th>
                <th>Year</th>
                <th>Action</th>
            </tr>
            </thead>
            @foreach($listings as $count=>$listing)
                <tr>
                    <td>{{$count+1}}</td>
                    <td>{{$listing->make_name}}</td>
                    <td>{{$listing->model_name}}</td>
                    <td>
                        @if($listing->type == 0)
                            Lease
                        @elseif($listing->type == 1)
                            Sell
                        @else
                            Lease / Sell
                        @endif
                    </td>
                    <td>{{$listing->mileage}}</td>
                    <td>{{$listing->year}}</td>
                    <td>
                        <a href="{{route('listings.edit',$listing->id)}}" class="btn btn-sm btn-xs btn-success"><i class="fa fa-pencil"></i></a>
                        {!! Form::open(array("method"=>"DELETE", "route" => array('listings.destroy',$listing->uuid), 'class' => 'form-inline', 'style'=>'display:inline')) !!}
                            <a class="btn btn-danger active btn-delete btn-xs" data-rel="tooltip" data-placement="top" title="delete"><i class="fa fa-trash"></i></a>
                        {!! Form::close() !!}
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@else
    <h2>No Result Found.</h2>
@endif

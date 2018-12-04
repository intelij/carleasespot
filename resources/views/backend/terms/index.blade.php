@extends('backend.layouts.app')
@section('title')terms@endsection

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
<a href="{{route('admin.terms.archive')}}"  class="btn btn-info pull-right"> Archive</a>
<a href="terms/create" class="btn btn-info pull-right"><i class="fa fa-plus"></i> Add New terms</a>
                            @if(Session('success') || Session('error'))
                                {!! message() !!}
                            @endif

							<table class="table table-stripped">
								<thead>
									<th colspan="1"># </th>
									<th colspan="3">Text</th>
									<th colspan="1">Action</th> 
								</thead>
								<tbody>
									@foreach($terms as  $count=>$term)
									<tr>
										<td colspan="1">{{$count+1}}</td>
										<td colspan="3">{!! $term->terms !!}</td>
									  <td>
 <a class="delete_btn" href="terms\create\{{ $term->id }}">
														Edit
													</a>
										   <a class="delete_btn" href="terms\delete\{{ $term->id }}">
														Delete
													</a>
										</td>
									</tr>
									@endforeach
								</tbody>
								{{ $terms->links() }} 
							</table>
							 </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
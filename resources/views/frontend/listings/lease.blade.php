@extends('frontend.layouts.modal')
@section('content')
    {!! Form::open(['route' => ['post_lease'], 'class' => 'ajax-submit ajaxNonReload']) !!}
        <div class="modal fade in" tabindex="-1" role="dialog" aria-hidden="true" style="display: block; padding-right: 17px;">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">@if(auth()->guard('web')->user() || auth()->guard('api')->user())<a href="{{route('get_review',$listing->id)}}"  data-toggle="ajax-modal" style="min-width:100px"><span aria-hidden="true">✕</span><span class="sr-only">Close</span></a>@else
                        <span aria-hidden="true">✕</span><span class="sr-only">Close</span>@endif
                        </button>
                        <h3 class="modal-title" id="lineModalLabel">{{$type == 0 ? 'Lease' : 'Buy'}} / {{$listing->year}} {{$listing->make_name}} {{$listing->model_name}} {{$listing->trim_style_name}}</h3>
                    </div>
                    <div class="modal-body">
                            <div class="form-group col-md-6 col-sm-12">
                                {!! Form::label('first_name', 'First Name',['class'=>'control-label']) !!}
                                {!! Form::text('first_name', null, ['class' => 'form-control input-sm', 'required']) !!}
                             
                            </div>
                            <div class="form-group  col-md-6 col-sm-12">
                                {!! Form::label('last_name', 'Last Name',['class'=>'control-label']) !!}
                                {!! Form::text('last_name', null, ['class' => 'form-control input-sm', 'required']) !!}
                            </div>
                            <div class="form-group  col-md-6 col-sm-12">
                                {!! Form::label('email', 'Email',['class'=>'control-label']) !!}
                                {!! Form::email('email', null, ['class' => 'form-control input-sm', 'required']) !!}
                            </div>
                            <div class="form-group col-md-6 col-sm-12">
                                {!! Form::label('phone', 'Phone',['class'=>'control-label']) !!}
                                {!! Form::number('phone', null, ['class' => 'form-control input-sm', 'required']) !!}
                            </div>
                            <div class="form-group col-md-12 col-sm-12">
                                {!! Form::label('message', 'Message',['class'=>'control-label']) !!}
                                {!! Form::textarea('message', null, ['class' => 'form-control input-sm', 'rows'=>'5']) !!}
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12  col-sm-12 margin-bottom-20 margin-top-20">
                                <input type="hidden" name="listing" value="{{$listing->id}}">
                              <input type="hidden" name="ip_address" value="{{$_SERVER['REMOTE_ADDR']}}">
                                <input type="hidden" name="type" value="{{$type}}">
                                <button type="submit" id="send_ad_message" class="btn btn-theme btn-block">Submit</button>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    {!! Form::close() !!}
@endsection
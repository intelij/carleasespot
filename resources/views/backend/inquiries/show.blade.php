@extends('backend.layouts.modal')
@section('content')
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                Inquiry Details
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group required">
                            {!! Form::label('first_name', 'First Name',['class'=>'control-label']) !!}
                            {!! Form::text('first_name', $inquiry->first_name, ['class' => 'form-control input-sm', 'readonly']) !!}
                        </div>
                        <div class="form-group required">
                            {!! Form::label('last_name', 'Last Name',['class'=>'control-label']) !!}
                            {!! Form::text('last_name', $inquiry->last_name, ['class' => 'form-control input-sm', 'readonly']) !!}
                        </div>
                        <div class="form-group required">
                            {!! Form::label('email', 'Email',['class'=>'control-label']) !!}
                            {!! Form::email('email', $inquiry->email, ['class' => 'form-control input-sm', 'readonly']) !!}
                        </div>
                        <div class="form-group required">
                            {!! Form::label('phone', 'Phone',['class'=>'control-label']) !!}
                            {!! Form::text('phone', $inquiry->phone, ['class' => 'form-control input-sm', 'readonly']) !!}
                        </div>
                        <div class="form-group required">
                            {!! Form::label('message', 'Message',['class'=>'control-label']) !!}
                            {!! Form::textarea('message', $inquiry->message, ['class' => 'form-control input-sm', 'readonly']) !!}
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
 <a href="{{route('inquiry.print', $inquiry->uuid)}}" target="_blank" class="btn btn-success"> Print</a>
                <button type="button" data-rel="tooltip" data-placement="top" title="close" data-dismiss="modal" class="btn active btn-danger pull-right"> <i class="fa fa-times"></i> Close</button>
            </div>
        </div>
    </div>
@endsection
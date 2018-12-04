<div class="row">
    <div class="col-md-12">
        <div class="form-group required">
            {!! Form::label('email', 'Email',['class'=>'control-label']) !!}
            {!! Form::text('email', null, ['class' => 'form-control input-sm', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', 'Status') !!}
            {!! Form::select('status', ['1'=>'Active','0'=>'Inactive'], null, ['class' => 'form-control input-sm']) !!}
        </div>
    </div>
</div>
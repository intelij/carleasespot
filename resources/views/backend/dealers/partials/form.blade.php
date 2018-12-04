<div class="row">
    <div class="col-md-12">
        <div class="form-group required">
            {!! Form::label('name', 'Name',['class'=>'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control input-sm', 'required']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('email', 'Email',['class'=>'control-label']) !!}
            {!! Form::email('email', null, ['class' => 'form-control input-sm', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('status', 'Status') !!}
            {!! Form::select('status', ['1'=>'Active','0'=>'Inactive'], null, ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password', 'Password (Leave blank if not changing password)') !!}
            {!! Form::password('password', ['class' => 'form-control input-sm']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('password_confirmation', 'Confirm Password') !!}
            {!! Form::password('password_confirmation', ['class' => 'form-control input-sm']) !!}
        </div>
    </div>
</div>
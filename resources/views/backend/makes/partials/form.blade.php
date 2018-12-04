<div class="row">
    <div class="col-md-12">
        <div class="form-group required">
            {!! Form::label('name', 'Name',['class'=>'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control input-sm', 'required']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('niceName', 'Nice Name',['class'=>'control-label']) !!}
            {!! Form::text('niceName', null, ['class' => 'form-control input-sm', 'required']) !!}
        </div>
    </div>
</div>
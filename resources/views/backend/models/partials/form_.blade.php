<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            {!! Form::label('id_car_make', 'Make *') !!}
            {!! Form::select('id_car_make',$makes, null, ['class' => 'form-control input-sm chosen', 'required']) !!}
        </div>
        <div class="form-group">
            {!! Form::label('year', 'Year *') !!}
            {!! Form::select('year',['2018' => '2018', '2019' => '2019'], null, ['class' => 'form-control input-sm chosen', 'required']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('name', 'Name',['class'=>'control-label']) !!}
            {!! Form::text('name', null, ['class' => 'form-control input-sm', 'required']) !!}
        </div>
        <div class="form-group required">
            {!! Form::label('niceName', 'Nice Name',['class'=>'control-label']) !!}
            {!! Form::text('niceName', null, ['class' => 'form-control input-sm', 'required']) !!}
        </div>
        <div class="form-group required">
            @if(isset($model) && $model->model_image != '' && $model->model_image != null)
                {!! Html::image(asset('assets/car_images/'.$model->year.'/'.$model->model_image), 'image', array('class' => 'thumbnail')) !!}
            @endif
            {!! Form::label('image', 'Model Image',['class'=>'control-label']) !!}
            {!! Form::file('model_image', null, ['class' => 'form-control input-sm', 'required']) !!}
        </div>
    </div>
</div>
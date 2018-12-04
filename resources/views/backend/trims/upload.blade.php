@extends('backend.layouts.modal')
@section('content')
    {!! Form::model($trim, ['route' => ['admin.trims.upload_image', $trim->id_car_trim], 'method'=>'PATCH','class'=>'ajax-submit']) !!}
    <div class="modal-dialog" style="max-width: 60% !important;margin: 30px auto">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                Edit Vehicle Modek
            </div>
            <div class="modal-body">
                @if (count($errors) > 0)
                    {!! form_errors($errors) !!}
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group required">
                            @if(isset($trim) && $trim->trim_image != '' && $trim->trim_image != null)
                                {!! Html::image(asset('assets/car_images/trim/'.$trim->trim_image), 'image', array('class' => 'thumbnail')) !!}
                            @endif
                            {!! Form::label('image', 'Trim Image',['class'=>'control-label']) !!}
                            {!! Form::file('trim_image', null, ['class' => 'form-control input-sm', 'required']) !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                {!! form_buttons() !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
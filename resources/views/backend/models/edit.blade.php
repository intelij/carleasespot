@extends('backend.layouts.modal')
@section('content')
    {!! Form::model($model, ['route' => ['admin.models.update', $model->id_car_model], 'method'=>'PATCH','class'=>'ajax-submit']) !!}
    <div class="modal-dialog" style="max-width: 60%; !important;margin: 30px auto; width: 680px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                Edit Vehicle Model
            </div>
            <div class="modal-body">
                @if (count($errors) > 0)
                    {!! form_errors($errors) !!}
                @endif
                @include('backend.models.partials.form')
            </div>
            <div class="modal-footer">
                {!! form_buttons() !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
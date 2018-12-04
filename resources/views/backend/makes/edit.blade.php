@extends('backend.layouts.modal')
@section('content')
    {!! Form::model($make, ['route' => ['admin.makes.update', $make->id_car_make], 'method'=>'PATCH','class'=>'ajax-submit','files'=>true]) !!}
    <div class="modal-dialog" style="max-width: 60% !important;margin: 30px auto">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                Edit Vehicle Make
            </div>
            <div class="modal-body">
                @if (count($errors) > 0)
                    {!! form_errors($errors) !!}
                @endif
                @include('backend.makes.partials.form')
            </div>
            <div class="modal-footer">
                {!! form_buttons() !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
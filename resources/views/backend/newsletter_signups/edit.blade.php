@extends('backend.layouts.modal')
@section('content')
    {!! Form::model($newsletter_signup, ['route' => ['admin.newsletter_signups.update', $newsletter_signup->uuid], 'method'=>'PATCH','class'=>'ajax-submit']) !!}
    <div class="modal-dialog" style="max-width: 60% !important;margin: 30px auto">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                Edit Newsletter Signup
            </div>
            <div class="modal-body">
                @if (count($errors) > 0)
                    {!! form_errors($errors) !!}
                @endif
                @include('backend.newsletter_signups.partials.form')
            </div>
            <div class="modal-footer">
                {!! form_buttons() !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
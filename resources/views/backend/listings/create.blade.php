@extends('backend.layouts.modal')
@section('content')
    {!! Form::open(['route' => ['admin.listings.store'], 'class' => 'ajax-submit needs-validation','novalidate']) !!}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                Add Listing
            </div>
            <div class="modal-body">
                @if (count($errors) > 0)
                    {!! form_errors($errors) !!}
                @endif
                @include('backend.listings.partials.form')
            </div>
            <div class="modal-footer">
                {!! form_buttons() !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
@endsection
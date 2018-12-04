@extends('backend.layouts.login')
@section('content')
    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                {!! Form::open(['route' => ['admin.login'], 'class' => 'needs-validation','novalidate']) !!}
                    <h1>Login Form</h1>
                    @if (isset($errors) && count($errors) > 0)
                        {!! form_errors($errors) !!}
                    @endif
                    <div class="form-group required">
                        {!! Form::email('email',null, ['class' => 'form-control', 'required','placeholder'=>'Email']) !!}
                    </div>
                    <div class="form-group required">
                        {!! Form::password('password', ['class' => 'form-control', 'required','placeholder'=>'Password']) !!}
                    </div>
                {!! Form::button('Login',['type'=>'submit']) !!}
                <p class="message">Forgot Password? <a href="#">Reset Password</a></p>
                {!! Form::close() !!}
                <div class="separator"></div>
            </section>
        </div>
    </div>
@endsection
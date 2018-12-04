@extends('backend.layouts.app')
@section('content')
    <div class="right_col" role="main">
        <div class="">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Edit profile</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">
                            <div class="card card-primary">
                                <div class="card-content table-responsive">
                                    {!! Form::model($user, ['route' => ['update_admin_profile'], 'files'=>true] ) !!}
                                    @if (count($errors) > 0)
                                        {!! form_errors($errors) !!}
                                    @endif
                                    @if(Session('success') || Session('error'))
                                        {!! message() !!}
                                    @endif
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            {!! Form::label('name', 'Name *') !!}
                                            {!! Form::text('name', null, ['class'=>'form-control','required','placeholder'=>'Name']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('email', 'Email *') !!}
                                            {!! Form::text('email', null, ['class'=>'form-control','required','placeholder'=>'Email']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('password', 'Password (Leave blank if not changing)') !!}
                                            {!! Form::password('password', ['class'=>'form-control','placeholder'=>'Password']) !!}
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('password_confirmation', 'Password Confirmation') !!}
                                            {!! Form::password('password_confirmation', ['class'=>'form-control','placeholder'=>'Password Confirmation']) !!}
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! Form::label('profile_photo', 'Profile Photo (Max width:300px, Max height:300px)') !!}<br>
                                            {!! Html::image(asset($user->photo != '' ? 'assets/user_files/admins/'.$user->uuid.'/'.$user->photo : 'assets/user_files/no-image.jpg'), 'photo') !!}
                                        </div>
                                        <div class="form-group">
                                            <input type="file" name="profile_photo" id="profile_photo"/>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            {!! Form::submit('Save Profile', ['class' => "btn btn-success"]) !!}
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
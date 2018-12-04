@extends('frontend.layouts.app')
@section('content')
<div class="vc_row wpb_row vc_row-fluid">
    <div class="wpb_column vc_column_container vc_col-sm-12">
        <div class="vc_column-inner ">
            <div class="wpb_wrapper">
                <section class="section-padding no-top gray">
                    <div class="container">
                        <div class="row">
                            <!-- Middle Content Area -->
                            <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                            
                                @if(session()->has('message'))
                                    <div class="alert alert-success">
                                        {{ session()->get('message') }}
                 
                                    </div>
                                @endif
                                <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                                    @csrf          
                                    
                                    <div class="form-group">
                                        <label>Dealership Name</label>
                                        <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Profile Photo (Max width:300px, Max height:300px)</label>
                                        <input type="file" id="profile_photo" name="profile_photo" accept = "image/*" class="sb_files-data form-control"/>
                                        @if ($errors->has('profile_photo'))
                                            <span class="invalid-feedback"><strong>{{ $errors->first('profile_photo') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Phone Number</label>
                                        <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ old('phone') }}" required>
                                        @if ($errors->has('phone'))
                                            <span class="invalid-feedback"><strong>{{ $errors->first('phone') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Address</label>
                                        <input id="address" type="text" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address') }}" required>
                                        @if ($errors->has('address'))
                                            <span class="invalid-feedback"><strong>{{ $errors->first('address') }}</strong></span>
                                        @endif
                                    </div>

                                    <!-- City -->
                                    <div class="form-group">
                                        <label>City</label>
                                        <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ old('city') }}" required autofocus>
                                        @if ($errors->has('city'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('city') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <!-- Pincode -->
                                    <div class="form-group">
                                        <label>Pin Code</label>
                                        <input id="pincode" type="number" class="form-control{{ $errors->has('pincode') ? ' is-invalid' : '' }}" name="pincode" value="{{ old('pincode') }}" required autofocus>
                                        @if ($errors->has('pincode'))
                                            <span class="invalid-feedback">
                                                <strong>{{ $errors->first('pincode') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <!-- State -->
                                    <div class="form-group">
                                        <label>State</label>
                                        {!! Form::select('state', $states) !!}
                                    </div>
                                    
                                    <!-- Password -->
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Confirm Password</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-md-12 col-sm-12">
                                                <input type="checkbox" id="minimal-checkbox-1" checked="" disabled="" name="minimal-checkbox-1">
                                                <label for="minimal-checkbox-1">I am agreed to <a href="#" title="" target=" _blank">Terms &amp; Condition</a></label>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-theme btn-lg btn-block" type="submit" id="sb_register_submit">Register</button>
                                    <br>
                                    <p class="text-center"><a href="{{route('login')}}">Already registered, login here.</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>
</div>
@endsection

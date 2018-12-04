@extends('frontend.layouts.app')
@section('content')
    <div class="vc_row wpb_row vc_row-fluid"><div class="wpb_column vc_column_container vc_col-sm-12"><div class="vc_column-inner "><div class="wpb_wrapper"> <div class="main-content-area clearfix ">
         <section class="section-padding no-top gray">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @if (session('warning'))
                                <div class="alert alert-warning">
                                    {{ session('warning') }}
                                </div>
                            @endif
                            <div class="form-grid">
                                <Center><h3>Customer Login</h3></center>
                                <form method="POST" action="{{ route('customer.login') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
                                        @if ($errors->has('email'))
                                            <span class="invalid-feedback"><strong>{{ $errors->first('email') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label>Password</label>
                                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                                        @if ($errors->has('password'))
                                            <span class="invalid-feedback"><strong>{{ $errors->first('password') }}</strong></span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-7">
                                                <input type="checkbox" name="is_remember" id="is_remember">
                                                <label for="is_remember">Remember Me</label>
                                            </div>
                                            <div class="col-xs-12 col-sm-5 text-right">
                                                <p class="help-block"><a href="{{ route('password.request') }}">Forgot password?</a></p>
                                            </div>
                                        </div>
                                    </div>
                                    <button class="btn btn-theme btn-lg btn-block" type="submit" id="sb_login_submit">Login</button>
                                    <br>
                                    <p class="text-center"><a href="{{route('customer.signup')}}">Sign up for an account.</a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
     </div>
</div>
</div>
</div>
@endsection

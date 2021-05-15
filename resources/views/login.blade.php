@extends('layouts.main-app')

@section('head-title', 'Login')

@section('body-class', 'hold-transition login-page')

@section('main-body')
<div class="login-box">
    <div class="login-logo">
      <style type="text/css">
        .logo-img {
          width: 50%; 
          height: auto;
          display: block;
          margin: auto;
        }
        .logo-title {
          font-weight: bold;
          font-size: 25px;
        }
      </style>
      <img src="{{ asset('logo/school_logo.png') }}" class="logo-img">
      <a href="#" class="logo-title">Complaint System</a>
    </div>
    <!-- /.login-logo -->

    @if ( $errors->has('error') )
      <div class="alert alert-danger alert-dismissible" 
      style="
        box-shadow: rgba(60,64,67,0.3) 0 1px 2px 0, rgba(60,64,67,0.5) 0 1px 5px
      ">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">
          &times;
        </button>
        <i class="icon fas fa-ban"></i> 
        {{ $errors->first('error') }}
      </div>
    @endif

    
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Sign In Your Account to Start Session</p>

        <form action="{{ route('login') }}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="text" name="username" value="{{ old('username') }}" class="form-control" placeholder="Username / Email" autofocus="">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-sm-6 col-md-8 col-lg-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
              
            </div>
            <!-- /.col -->
            <div class="col-sm-6 col-md-4 col-lg-4">
              <button type="submit" name="btn-login" class="btn btn-primary btn-block">
                <i class="fas fa-unlock"></i> 
                Sign In
              </button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <div class="social-auth-links text-center mb-3">
          <p>- OR -</p>
          <a href="javascript:void(0)" class="btn btn-block btn-primary" onclick="alert('To create account, Please contact the System Administrator.')">
            <i class="fas fa-user mr-2"></i> Create Account
          </a>
          <a href="{{ route('forgot.password.form') }}" class="btn btn-block btn-danger">
            <i class="fas fa-lock mr-2"></i> Forgot Password
          </a>
        </div>

      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
@endsection

@extends('layouts.main-app')

@section('head-title', 'Forgot Password')

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

  @if ( !session('success') )
    @if($errors->has('error'))
    <div class="alert alert-danger alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h5><i class="icon fas fa-ban"></i> Failed</h5>
      {{ $errors->first('error') }}
    </div>
    @endif

    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">You forgot your password? Here you can request your Administrator to reset your password</p>

        <form action="{{ route('forgot.password.post') }}" method="post">
          @csrf
          <div class="input-group mb-3">
            <input type="text" class="form-control {{ $errors->has('request') ? 'is-invalid':'' }}" name="request" value="{{ old('request') }}" placeholder="Username / Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
            @if ($errors->has('request'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('request') }}</strong>
              </span>
            @endif
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control {{ $errors->has('new-password') ? 'is-invalid':'' }}" name="new-password" value="{{ old('new-password') }}" placeholder="New Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
            @if ($errors->has('new-password'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('new-password') }}</strong>
              </span>
            @endif
          </div>
          <div class="row">
            <div class="col-12">
              <button type="submit" class="btn btn-primary btn-block">
                Request to reset password
              </button>
            </div>
            <!-- /.col -->
          </div>
        </form>

        <p class="mt-3 mb-1">
          <a href="{{ route('login') }}">Login</a>
        </p>
        <p class="mb-0">
          <a href="javascript:void(0)" class="text-center" onclick="alert('To create account, Please contact the System Administrator.')">
	          Create Account
	      </a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  @else
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">
          {{ session('success') }}
        </p>

        <p class="mt-3 mb-1">
          <a href="{{ route('login') }}" class="btn btn-block btn-primary">
            <i class="fas fa-lock"></i> Login
          </a>
        </p>
      </div>
      <!-- /.login-card-body -->
    </div>
  @endif

</div>
@endsection

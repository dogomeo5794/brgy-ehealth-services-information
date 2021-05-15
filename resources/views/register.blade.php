@extends('layouts.main-app')

@section('head-title', 'Register')

@section('body-class', 'hold-transition register-page')

@section('main-body')
<div class="register-box">
  <div class="register-logo">
    <a href="../../index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="card">
    <div class="card-body register-card-body">
      <p class="login-box-msg">Register a new membership</p>

      @if (Session::has('message'))
	      <div class="alert alert-info alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
          <i class="icon fas fa-info-circle"></i> {{ session('message') }}
        </div>
      @endif

      <form action="{{ route('save.register') }}" method="post">
      	@csrf

      	<div class="input-group mb-3">
          <input type="text" class="form-control {{$errors->has('lname') ? 'is-invalid':''}}" name="lname" placeholder="Last name" value="{{ old('lname') }}" autofocus>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
          @if ($errors->has('lname'))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $errors->first('lname') }}</strong>
            </span>
	        @endif
        </div>
        <div class="row">
        	<div class="col-sm-7">
        		<div class="input-group mb-3">
		          <input type="text" class="form-control {{ $errors->has('fname') ? 'is-invalid':'' }}" name="fname" placeholder="First name" value="{{ old('fname') }}" autofocus >
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="fas fa-user"></span>
		            </div>
		          </div>
		          @if ($errors->has('fname'))
		            <span class="invalid-feedback" role="alert">
		                <strong>{{ $errors->first('fname') }}</strong>
		            </span>
			        @endif
		        </div>
        	</div>
        	<div class="col-sm-5">
        		<div class="input-group mb-3">
		          <input type="text" class="form-control {{ $errors->has('mname') ? 'is-invalid':'' }}" name="mname" placeholder="Middle name" value="{{ old('mname') }}" autofocus >
		          <div class="input-group-append">
		            <div class="input-group-text">
		              <span class="fas fa-user"></span>
		            </div>
		          </div>
		          @if ($errors->has('mname'))
		          	<span class="invalid-feedback" role="alert">
		          		<strong>{{ $errors->first('mname') }}</strong>
		          	</span>
		          @endif
		        </div>
        	</div>
        </div>
        <div class="input-group mb-3">
          <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid':'' }}" name="username" placeholder="Username" value="{{ old('username') }}" autofocus >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @if ($errors->has('username'))
          	<span class="invalid-feedback" role="alert">
          		<strong>{{ $errors->first('username') }}</strong>
          	</span>
          @endif
        </div>
        <div class="input-group mb-3">
          <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}" name="email" placeholder="Email" value="{{ old('email') }}" autofocus >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
          @if ($errors->has('email'))
          	<span class="invalid-feedback" role="alert">
          		<strong>{{ $errors->first('email') }}</strong>
          	</span>
          @endif
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control {{ $errors->has('password') ? 'is-invalid':'' }}" name="password" placeholder="Password" value="{{ old('password') }}" autofocus >
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
          @if ($errors->has('password'))
          	<span class="invalid-feedback" role="alert">
          		<strong>{{ $errors->first('password') }}</strong>
          	</span>
          @endif
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password_confirmation" placeholder="Retype password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="btn-register" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
@endsection
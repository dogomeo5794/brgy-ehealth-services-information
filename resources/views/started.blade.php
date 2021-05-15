@extends('layouts.main-app')

@section('head-title', 'System Started')

@section('body-class', 'hold-transition register-page')

@section('main-body')
<div class="register-box">
	<div class="register-logo">
		<a href="#">Started</a>
	</div>

	@if ( $errors->has('error') )
	<div class="alert alert-danger alert-dismissible">
		<button type="button" class="close" data-dismiss="alert" aria-hidden="true">
			&times;
		</button>
		<i class="icon fas fa-ban"></i> 
		{{ $errors->first('error') }}
	</div>
	@endif

	<div class="card">
		<div class="card-body register-card-body">

			<p class="login-box-msg">Please Complete the Form.</p>

			<form action="{{ route('register.started') }}" method="post" id="register-form">
				@csrf

				<div class="form-for-register">
				@if($step == 1)
					<div class="input-group mb-3">
						<input type="text" name="generated-code" value="{{ old('generated-code') }}" class="form-control  {{$errors->has('generated-code') ? 'is-invalid':''}}" placeholder="Generated Code">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-code"></span>
							</div>
						</div>
						@if ($errors->has('generated-code'))
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $errors->first('generated-code') }}</strong>
	            </span>
		        @endif
					</div>
					<div class="input-group mb-3">
						<input type="text" name="username" value="{{ old('username') }}" class="form-control {{ $errors->has('username') ? 'is-invalid':'' }}" placeholder="Username">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-user"></span>
							</div>
						</div>
						@if ($errors->has('username'))
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $errors->first('username') }}</strong>
	            </span>
		        @endif
					</div>
					<div class="input-group mb-3">
						<input type="email" name="email" value="{{ old('email') }}" class="form-control {{ $errors->has('email') ? 'is-invalid':'' }}" placeholder="Email">
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
						<input type="password" name="password" value="{{ old('password') }}" class="form-control {{ $errors->has('password') ? 'is-invalid':'' }}" placeholder="Password">
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
						<input type="password" name="password_confirmation" value="" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid':'' }}" placeholder="Retype password">
						<div class="input-group-append">
							<div class="input-group-text">
								<span class="fas fa-lock"></span>
							</div>
						</div>
						@if ($errors->has('password_confirmation'))
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $errors->first('password_confirmation') }}</strong>
	            </span>
		        @endif
					</div>
					<div class="row" style="border-top: 0.124rem solid lightgrey;padding-top: 20px;margin-top: 30px;">
						<div class="col-12">
							<div class="float-right">
								<button type="submit" class="btn btn-primary btn-sm btn-next">
									Register
								</button>
							</div>
						</div>
					</div>
					@else
					
					<div class="row">
						<div class="col-sm-12 col-md-5 col-lg-5">
							<div class="form-group">
								<label>Employee ID</label>
								<input type="text" name="employee-id" value="{{ old('employee-id') }}" class="form-control {{ $errors->has('employee-id') ? 'is-invalid':'' }}" placeholder="ID">
								@if ($errors->has('employee-id'))
			            <span class="invalid-feedback" role="alert">
			                <strong>{{ $errors->first('employee-id') }}</strong>
			            </span>
				        @endif
							</div>
						</div>
						<div class="col-sm-12 col-md-7 col-lg-7">
							<div class="form-group">
								<label>Date Hired</label>
								<input type="date" name="date-hired" value="{{ old('date-hired') }}" class="form-control {{ $errors->has('date-hired') ? 'is-invalid':'' }}" placeholder="Hired">
								@if ($errors->has('date-hired'))
			            <span class="invalid-feedback" role="alert">
			                <strong>{{ $errors->first('date-hired') }}</strong>
			            </span>
				        @endif
							</div>
						</div>
					</div>
					<div class="form-group">
						<label>Full Name</label>
						<input type="text" name="full-name" value="{{ old('full-name') }}" class="form-control {{ $errors->has('full-name') ? 'is-invalid':'' }}" placeholder="Full Name">
						@if ($errors->has('full-name'))
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $errors->first('full-name') }}</strong>
	            </span>
		        @endif
					</div>
					<div class="form-group">
						<label>Contact</label>
						<input type="text" name="contact" value="{{ old('contact') }}" class="form-control {{ $errors->has('contact') ? 'is-invalid':'' }}" placeholder="Contact">
						@if ($errors->has('contact'))
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $errors->first('contact') }}</strong>
	            </span>
		        @endif
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" name="address" value="{{ old('address') }}" class="form-control {{ $errors->has('address') ? 'is-invalid':'' }}" placeholder="Address">
						@if ($errors->has('address'))
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $errors->first('address') }}</strong>
	            </span>
		        @endif
					</div>
					<div class="form-group">
						<label>Birthday</label>
						<input type="date" name="birthday" value="{{ old('birthday') }}" class="form-control {{ $errors->has('birthday') ? 'is-invalid':'' }}" placeholder="">
						@if ($errors->has('birthday'))
	            <span class="invalid-feedback" role="alert">
	                <strong>{{ $errors->first('birthday') }}</strong>
	            </span>
		        @endif
					</div>

					<div class="row" style="border-top: 0.124rem solid lightgrey;padding-top: 20px;margin-top: 30px;">
						<div class="col-12">
							<div class="float-right">
								<button type="submit" class="btn btn-primary btn-sm btn-next">
									Save & Continue
								</button>
							</div>
						</div>
					</div>
				@endif

				</div>
			</form>
		</div>
	</div>
</div>

@endsection


@section('script-code')
<script type="text/javascript">
	$(function() {
		$(document).on('submit', '#register-form', function(e) {
			if (!confirm('Click OK to continue.')) {
				e.preventDefault();
				return false;
			}
		})
	})		
</script>
@endsection
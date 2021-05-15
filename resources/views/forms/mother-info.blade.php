<div class="col-12 mx-auto">
	<div class="card card-primary card-outline">
		<div class="card-header">
			<h3 class="card-title">
				<small><i class="fas fa-edit"></i> [-UPDATE-]</small> - 
				Mother information
			</h3>
		</div>
		<!-- /.card-header -->
		<div class="card-body">
			<form action="" method="post" id="update-mother-info-form" data-mother="{{ $mother->id }}" data-father="{{ $father->id }}">
				<p class="label-info">Mother Information</p>
				<div class="form-group">
					<label>Last Name</label>
					<input type="text" name="last-name" value="{{ $mother->lastname }}" class="form-control" placeholder="Last Name">
				</div>
				<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label>First Name</label>
							<input type="text" name="first-name" value="{{ $mother->firstname }}" class="form-control" placeholder="First Name">
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label>Middle Name</label>
							<input type="text" name="middle-name" value="{{ $mother->middlename }}" class="form-control" placeholder="Middle Name">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-4 col-md-4 col-lg-4">
						<div class="form-group">
							<label>Civil</label>
							<select name="civil-status" class="form-control">
								@php
									$c = $mother->civil_status;
								@endphp
								<option {{ $c==''?'selected':'' }} value="" disabled selected>-- Select --</option>
								<option {{ $c=='single'?'selected':'' }} value="single">Single</option>
								<option {{ $c=='married'?'selected':'' }} value="married">Married</option>
								<option {{ $c=='widowed'?'selected':'' }} value="widowed">Widowed</option>
								<option {{ $c=='separated'?'selected':'' }} value="separated">Separated</option>
							</select>
						</div>
					</div>

					<div class="col-sm-5 col-md-5 col-lg-5">
						<div class="form-group">
							<label>Birthdate</label>
							<input type="date" max="{{ date('Y-m-d') }}" name="birthdate" value="{{ $mother->birthdate }}" class="form-control">
						</div>
					</div>
					<div class="col-sm-3 col-md-3 col-lg-3">
						<div class="form-group">
							<label>Age</label>
							<input type="number" name="age" class="form-control" value="{{ getAge($mother->birthdate) }}" step="1" min="0" max="100">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Address</label>
					<input type="text" name="address" class="form-control" value="{{ $mother->address }}" placeholder="Address">
				</div>
				<div class="form-group">
					<label>Contact</label>
					<input type="text" name="contact" class="form-control" value="{{ $mother->contact }}" placeholder="Contact">
				</div>

				<p class="label-info" style="margin-top: 50px;">Father Information</p>
				<div class="form-group">
					<label>Last Name 
						( <span class="check-same-lname">
							<i class="far fa-square"></i> Same in Mother?
						</span> )
					</label>
					<input type="text" name="father-last-name" value="{{ $father->lastname }}" class="form-control" placeholder="Last Name">
				</div>
				<div class="row">
					<div class="col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label>First Name</label>
							<input type="text" name="father-first-name" value="{{ $father->firstname }}" class="form-control" placeholder="First Name">
						</div>
					</div>
					<div class="col-sm-6 col-md-6 col-lg-6">
						<div class="form-group">
							<label>Middle Name</label>
							<input type="text" name="father-middle-name" value="{{ $father->middlename }}" class="form-control" placeholder="Middle Name">
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-8 col-md-8 col-lg-8">
						<div class="form-group">
							<label>Birthdate</label>
							<input type="date" max="{{ date('Y-m-d') }}" value="{{ $father->birthdate }}" name="father-birthdate" class="form-control">
						</div>
					</div>
					<div class="col-sm-4 col-md-4 col-lg-4">
						<div class="form-group">
							<label>Age</label>
							<input type="number" name="father-age" value="{{ getAge($father->birthdate) }}" class="form-control" step="1" min="0" max="100">
						</div>
					</div>
				</div>
				<div class="form-group">
					<label>Address 
						( <span class="check-same-address">
							<i class="far fa-square"></i> Same in Mother?
						</span> )
					</label>
					<input type="text" name="father-address" value="{{ $father->address }}" class="form-control" placeholder="Address">
				</div>
				<div class="form-group">
					<label>Contact</label>
					<input type="text" name="father-contact" value="{{ $father->contact }}" class="form-control" placeholder="Contact">
				</div>
			</form>
		</div>
		<!-- /.card-body -->
		<div class="card-footer">
			<div class="mailbox-controls float-right">
				<button type="button" class="btn btn-danger btn-sm btn-cancel-mother-update">
					<i class="fas fa-times"></i> Cancel
				</button>
				<button type="submit" form="update-mother-info-form" class="btn btn-primary btn-sm">
					<i class="fas fa-database"></i> Save changes
				</button>
			</div>
		</div>
	</div>
	<!-- /.card -->
</div>
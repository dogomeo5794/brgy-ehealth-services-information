<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>@yield('head-title', 'Title')</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="{{ asset('adminlte/plugins/fontawesome-free/css/all.min.css') }}">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- overlayScrollbars -->
	<link rel="stylesheet" href="{{ asset('adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
	<!-- SweetAlert2 -->
	<link rel="stylesheet" href="{{ asset('adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css') }}">

	<!-- icheck bootstrap -->
  	<link rel="stylesheet" href="{{ asset('adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  	<!-- Toastr -->
  	<link rel="stylesheet" href="{{ asset('adminlte/plugins/toastr/toastr.min.css') }}">
	<link rel="stylesheet" href="{{ asset('adminlte/plugins/summernote/summernote-bs4.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('adminlte/dist/css/adminlte.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/style.css') }}">
	<!-- Google Font: Source Sans Pro -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<style type="text/css">
		.activity ~ label {
			cursor: default;
		}
		.icheck-primary.empty label::before {
		    border: 2px solid #ff00004d !important;
		    background: #f99494 !important;
		}
		.icheck-primary.waiting label::before {
		    border: 2px solid #f19b54 !important;
		    background: #f3ba8bbf !important;
		}
		.prenatal-activities li.waiting .text {
			text-decoration: line-through;
		    font-style: italic;
		    color: #808080b3;
		}
	</style>

	@yield('css-file')

	@yield('css-code')

</head>
<!-- sidebar-mini layout-fixed text-sm accent-primary -->
<body class="@yield('body-class', 'sidebar-mini layout-navbar-fixed layout-fixed text-sm accent-primary')">
	
	@yield('main-body')

	<!-- jQuery -->
	<script src="{{ asset('adminlte/plugins/jquery/jquery.min.js') }}"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="{{ asset('adminlte/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
	<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
	<script>
		$.widget.bridge('uibutton', $.ui.button)
	</script>

	<!-- Bootstrap 4 -->
	<script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
	<!-- overlayScrollbars -->
	<script src="{{ asset('adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
	<!-- Toastr -->
	<script src="{{ asset('adminlte/plugins/toastr/toastr.min.js') }}"></script>
	<script src="{{ asset('adminlte/plugins/summernote/summernote-bs4.min.js') }}"></script>
	<!-- AdminLTE App -->
	<script src="{{ asset('adminlte/dist/js/adminlte.js') }}"></script>
	<script src="{{ asset('js/extendjQuery.js') }}"></script>

	<script type="text/javascript">
		const getAge = (birthDate) => {
			return Math.floor((new Date() - new Date(birthDate).getTime()) / 3.15576e+10);
		}

		const getBabyAge = (birthDate, ageAtDate) => {
			var daysInMonth = 30.436875;
			var dob = new Date(birthDate);
			var aad;
			if ( !ageAtDate ) aad = new Date();
			else add = new Date(ageAtDate);
			var yearAad = aad.getFullYear();
			var yearDob = dob.getFullYear();
			var years  = yearAad - yearDob;
			dob.setFullYear(yearAad);
			var aadMillis = aad.getTime();
			var dobMillis = dob.getTime();
			if (aadMillis < dobMillis) {
				--years;
				dob.setFullYear(yearAad - 1);
				dobMillis = dob.getTime();
			}

			var days = (aadMillis - dobMillis) / 86400000; // 8.64e+7
			var monthsDec = days / daysInMonth;
			var months = Math.floor(monthsDec);
			days = Math.floor(daysInMonth * (monthsDec - months));

			if (years > 0) {
				return years + " yrs. & " + months + " mnths. & " + days + " dys.";
			}
			else if (months > 0) {
				return months+" mnths. & "+days+" dys.";
			}
			else if (days > 0) {
				return days+" dys.";
			}
			else {
				return "Just born";
			}
			
			// return {years:years, months: months,days: days}
		}

		// console.log(getBabyAge('1994-05-07'));
		// console.log(getBabyAge('2020-05-07'));
		// console.log(getBabyAge('2021-01-10'));
		// console.log(getBabyAge('2021-01-30'));

		// class DateInterval {
		// 	constructor(start, end) {
		// 		if (start > end) [start, end] = [end, start];
		// 		this.days = end.getDate();
		// 		this.months = end.getMonth() - start.getMonth();
		// 		this.years = end.getFullYear() - start.getFullYear();
		// 		if (this.days < 0) {
		// 			this.days += (new Date(start.getFullYear(), start.getMonth() + 1, 0)).getDate();
		// 			this.months--;
		// 		}
		// 		if (this.months < 0) {
		// 			this.months += 12;
		// 			this.years--;
		// 		}
		// 	}
		// 	toString() {
		// 		const arr = ["year", "months", "days"].map(p => 
		// 			this[p] && (this[p] + " " + p.slice(0, this[p] > 1 ? undefined : -1))
		// 		).filter(Boolean);
		// 		if (!arr.length) return "0 days";
		// 		const last = arr.pop();
		// 		return arr.length ? [arr.join(", "), last].join(" and ") : last;
		// 	}
		// }

		// const computeAge = (dateString) => {
		// 	let today = new Date();
		// 	today.setHours(0,0,0,0);
		// 	let dob = new Date(dateString);
		// 	dob.setHours(0,0,0,0);
		// 	return new DateInterval(dob, today);
		// }

		// let d = new Date(2000, 1, 2);
		// setInterval(() => {
		// 	const s = d.toJSON().slice(0, 10);
		// 	console.log("Someone born on " + s + " is now " + computeAge(s));
		// 	d = new Date(d.getFullYear(), d.getMonth(), d.getDate() + 1);
		// }, 500);
		
		$(function() {

		})
	</script>

	@yield('script-file')

	@yield('script-code')

</body>

</html>
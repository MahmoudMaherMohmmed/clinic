<!DOCTYPE html>
<html>
<head>
	<title>app blade</title>
	<link rel="stylesheet" type="text/css" href="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="/css/app.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

</head>
<body>
	<div class="container">
		@include('partial.flash')
 		@yield('content')
 	</div>

<script>
	$('div.alert').not('alert-important').delay(3000).slideUp(300);
</script>
		@yield('footer')
		<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
		<script src="//code.jquery.com/jquery.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
	<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

	<script>window.jQuery || document.write('<script src="{{url('assets/jquery/jquery-2.1.4.min.js')}}"><\/script>')</script>
	<script src="{{url('assets/bootstrap/js/bootstrap.min.js')}}"></script>

	<script type="text/javascript">
		function goToForm(form)
		{
			$('.login-wrapper > form:visible').fadeOut(500, function(){
				$('#form-' + form).fadeIn(500);
			});
		}
		$(function() {
			$('.goto-login').click(function(){
				goToForm('login');
			});
			$('.goto-forgot').click(function(){
				goToForm('forgot');
			});
			$('.goto-register').click(function(){
				goToForm('register');
			});
		});
	</script>

</body>
</html>

<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>404 Page | Not found</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon
		============================================ -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/images/logo-symbol.jpg') }}">
    <!-- Google Fonts
		============================================ -->
    <link href="https://fonts.googleapis.com/css?family=Play:400,700" rel="stylesheet">
    <!-- style CSS
		============================================ -->
    <link rel="stylesheet" href="{{ asset('errorpage/style.css') }}">
</head>

<body>
    <!--[if lt IE 8]>
		<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<![endif]-->
    <div class="error-pagewrap">
		<div class="error-page-int">
			<div class="content-error">
				<h1>ERROR <span class="counter"> 404</span></h1>
				<p>Sorry, but the page you are looking for has note been found</p>
				<a href="/">Dashboard</a>
			</div>
		</div>
    </div>
    <!-- jquery
		============================================ -->
    <script src="{{ asset('errorpage/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <!-- counterup JS
		============================================ -->
    <script src="{{ asset('errorpage/js/counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('errorpage/js/counterup/waypoints.min.js') }}"></script>
    <script src="{{ asset('errorpage/js/counterup/counterup-active.js') }}"></script>
</body>

</html>
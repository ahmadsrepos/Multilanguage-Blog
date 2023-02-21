<!DOCTYPE html>

<html lang="en">

<head>
	<meta charset="utf-8">
	<title>@yield('title', $setting->title)</title>
	<meta name="description" content="@yield('meta_description', $setting->description)">
	<meta name="keywords" content="@yield('meta_keywords', $setting->title)">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!--Favicon-->
	<link rel="shortcut icon" href="{{asset('images/settings/'.$setting->favicon)}}" type="image/x-icon">

	<!-- THEME CSS
	================================================== -->
	<!-- Bootstrap -->
	<link rel="stylesheet" href="{{asset('main/plugins/bootstrap/css/bootstrap.min.css')}}">
	<!-- Themify -->
	<link rel="stylesheet" href="{{asset('main/plugins/themify/css/themify-icons.css')}}">
	<link rel="stylesheet" href="{{asset('main/plugins/slick-carousel/slick-theme.css')}}">
	<link rel="stylesheet" href="{{asset('main/plugins/slick-carousel/slick.css')}}">
	<!-- Slick Carousel -->
	<link rel="stylesheet" href="{{asset('main/plugins/owl-carousel/owl.carousel.min.css')}}">
	<link rel="stylesheet" href="{{asset('main/plugins/owl-carousel/owl.theme.default.min.css')}}">
	<link rel="stylesheet" href="{{asset('main/plugins/magnific-popup/magnific-popup.css')}}">
	<!-- manin stylesheet -->
	<link rel="stylesheet" href="{{asset('main/css/style-'.app()->getLocale().'.css')}}">
</head>

<body>

	<div class="header-instagra">
		<div class="container-fluid p-0">
			<div class="row no-gutters" id="instafeed">
			</div>
		</div>
	</div>

    @include('website.layouts.header')


	<div class="header-logo py-5">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<a class="navbar-brand d-none d-lg-block" href="/"><img src="images/logo.png" alt=""
						class="img-fluid">
                    </a>
				</div>
			</div>
		</div>
	</div>

	<section class="section-padding pt-4">
		<div class="container">
			<div class="row">
                @yield('content')
                @include('website.layouts.sidebar')
			</div>
		</div>
	</section>

    @include('website.layouts.footer')


	<!-- THEME JAVASCRIPT FILES
================================================== -->
	<!-- initialize jQuery Library -->
	<script src="{{asset('main/plugins/jquery/jquery.js')}}"></script>
	<!-- Bootstrap jQuery -->
	<script src="{{asset('main/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('main/plugins/bootstrap/js/popper.min.js')}}"></script>
	<!-- Owl caeousel -->
	<script src="{{asset('main/plugins/owl-carousel/owl.carousel.min.js')}}"></script>
	<script src="{{asset('main/plugins/slick-carousel/slick.min.js')}}"></script>
	<script src="{{asset('main/plugins/magnific-popup/magnific-popup.js')}}"></script>
	<!-- Instagram Feed Js -->
	<script src="{{asset('main/plugins/instafeed-js/instafeed.min.js')}}"></script>
	<!-- Google Map -->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCC72vZw-6tGqFyRhhg5CkF2fqfILn2Tsw"></script>
	<script src="{{asset('main/plugins/google-map/gmap.js')}}"></script>
	<!-- main js -->
	<script src="{{asset('main/js/custom.js')}}"></script>
	@stack('js')


</body>

</html>
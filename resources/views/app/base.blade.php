<!DOCTYPE html>
<html lang="en">
    <head>
		<meta charset="utf-8">
		<base href="{{ url('/') }}/">
        <meta name="csrf-token" content="{{ csrf_token() }}">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">

		<title>Electro</title>

 		<link href="https://fonts.googleapis.com/css?family=Montserrat:400,500,700" rel="stylesheet">
 		<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}"/>
 		<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/slick.css') }}"/>
 		<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/slick-theme.css') }}"/>
 		<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/nouislider.min.css') }}"/>
 		<link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
 		<link type="text/css" rel="stylesheet" href="{{ asset('assets/css/style.css') }}"/>
 		
 		<script>
 			var ob = '';
			var ot = '';
			var fo = '';
			var ge = '';
			var pr = '';
			
			var auxCont = 0;
 		</script>
    </head>
    <body class="g-sidenav-show bg-gray-100">
		<header>
			<div id="top-header">
				<div class="container">
					<ul class="header-links pull-left">
						<li><a href="#"><i class="fa fa-phone"></i> +021-95-51-84</a></li>
						<li><a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a></li>
						<li><a href="#"><i class="fa fa-map-marker"></i> 1734 Stonecoal Road</a></li>
					</ul>
					<ul class="header-links pull-right">
						<li><a href="#"><i class="fa fa-dollar"></i> USD</a></li>
						<li><a href="#"><i class="fa fa-user-o"></i> My Account</a></li>
					</ul>
				</div>
			</div>
			<div id="header">
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<div class="header-logo">
								<a href="{{ url('/') }}" class="logo">
									<img src="{{ asset('assets/img/logo.png') }}" alt="">
								</a>
							</div>
						</div>
						<div class="col-md-6">
							<div id="searchContainer" class="header-search">
								<div class="form">
									<input type="text" class="input" id="q" name="q" placeholder="Search here">
									<button type="submit" id="btSearch" class="search-btn">Search</button>
								</div>
							</div>
						</div>
						<script>
							/* global $ global showData */
							if ( document.URL.includes("/movie/") ) {
								document.getElementById("searchContainer").toggleAttribute("hidden");
							} else {
								document.getElementById("q").addEventListener('input', () => {
								    $.ajax({
								        type: 'get',
								        url: '{{ url("fetchdata") }}',
								        data: {
								        	'q': document.getElementById("q").value,
								        	'orderby': ob,
						        			'ordertype': ot,
						        			'format': fo,
								        	'genre': ge,
											'price': pr
								        },
								        success: function(data) {
								        	showData(data);
								        }
								    });
								});
							}
						</script>
						<div class="col-md-3 clearfix"> 
							<div class="header-ctn">
								<div>
									<a href="#">
										<i class="fa fa-heart-o"></i>
										<span>Your Wishlist</span>
									</a>
								</div>
								<div class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
										<i class="fa fa-shopping-cart"></i>
										<span>Your Cart</span>
									</a>
									<div class="cart-dropdown">
										<div class="cart-list">
											<div class="product-widget">
												<div class="product-img">
													<img src="{{ asset('assets/img/product01.png') }}" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">1x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
											<div class="product-widget">
												<div class="product-img">
													<img src="{{ asset('assets/img/product02.png') }}" alt="">
												</div>
												<div class="product-body">
													<h3 class="product-name"><a href="#">product name goes here</a></h3>
													<h4 class="product-price"><span class="qty">3x</span>$980.00</h4>
												</div>
												<button class="delete"><i class="fa fa-close"></i></button>
											</div>
										</div>
										<div class="cart-summary">
											<small>3 Item(s) selected</small>
											<h5>SUBTOTAL: $2940.00</h5>
										</div>
										<div class="cart-btns">
											<a href="#">View Cart</a>
											<a href="#">Checkout  <i class="fa fa-arrow-circle-right"></i></a>
										</div>
									</div>
								</div>
								<div class="menu-toggle">
									<a href="#">
										<i class="fa fa-bars"></i>
										<span>Menu</span>
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</header>
        
        @yield('content')
        
		<div id="newsletter" class="section">
			<div class="container">
				<div class="row">
					<div class="col-md-12">
						<div class="newsletter">
							<p>Sign Up for the <strong>NEWSLETTER</strong></p>
							<form>
								<input class="input" type="email" placeholder="Enter Your Email">
								<button class="newsletter-btn"><i class="fa fa-envelope"></i> Subscribe</button>
							</form>
							<ul class="newsletter-follow">
								<li>
									<a href="#"><i class="fa fa-facebook"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-twitter"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-instagram"></i></a>
								</li>
								<li>
									<a href="#"><i class="fa fa-pinterest"></i></a>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		<footer id="footer">
			<div class="section">
				<div class="container">
					<div class="row">
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">About Us</h3>
								<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut.</p>
								<ul class="footer-links">
									<li><a href="#"><i class="fa fa-map-marker"></i>1734 Stonecoal Road</a></li>
									<li><a href="#"><i class="fa fa-phone"></i>+021-95-51-84</a></li>
									<li><a href="#"><i class="fa fa-envelope-o"></i>email@email.com</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Categories</h3>
								<ul class="footer-links">
									<li><a href="#">Hot deals</a></li>
									<li><a href="#">Laptops</a></li>
									<li><a href="#">Smartphones</a></li>
									<li><a href="#">Cameras</a></li>
									<li><a href="#">Accessories</a></li>
								</ul>
							</div>
						</div>
						<div class="clearfix visible-xs"></div>
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Information</h3>
								<ul class="footer-links">
									<li><a href="#">About Us</a></li>
									<li><a href="#">Contact Us</a></li>
									<li><a href="#">Privacy Policy</a></li>
									<li><a href="#">Orders and Returns</a></li>
									<li><a href="#">Terms & Conditions</a></li>
								</ul>
							</div>
						</div>
						<div class="col-md-3 col-xs-6">
							<div class="footer">
								<h3 class="footer-title">Service</h3>
								<ul class="footer-links">
									<li><a href="#">My Account</a></li>
									<li><a href="#">View Cart</a></li>
									<li><a href="#">Wishlist</a></li>
									<li><a href="#">Track My Order</a></li>
									<li><a href="#">Help</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div id="bottom-footer" class="section">
				<div class="container">
					<div class="row">
						<div class="col-md-12 text-center">
							<ul class="footer-payments">
								<li><a href="#"><i class="fa fa-cc-visa"></i></a></li>
								<li><a href="#"><i class="fa fa-credit-card"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-paypal"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-mastercard"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-discover"></i></a></li>
								<li><a href="#"><i class="fa fa-cc-amex"></i></a></li>
							</ul>
							<span class="copyright">
								 <a target="_blank" href="https://www.templateshub.net">&copy; Electro <?= date("Y") ?></a>
							</span>
						</div>
					</div>
				</div>
			</div>
		</footer>
        <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    	<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    	<script src="{{ asset('assets/js/slick.min.js') }}"></script>
    	<script src="{{ asset('assets/js/nouislider.min.js') }}"></script>
    	<script src="{{ asset('assets/js/jquery.zoom.min.js') }}"></script>
    	<script src="{{ asset('assets/js/main.js') }}"></script>
    	<script typ="text/javascript" src="{{ url('assets/js/ajax.js') }}?{{rand(2, 20)}}"></script>
    </body>
</html>

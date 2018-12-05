<!DOCTYPE html>
<html lang="en">
	<head>
		<title>@yield('title')</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

		<link rel="stylesheet" href="{{url('css/font-awesome.min.css')}}">
		<link rel="stylesheet" href="{{url('css/bootstrap.min.css')}}">
		<link rel="stylesheet" href="{{url('css/owl/owl.carousel.min.css')}}">
		<link rel="stylesheet" href="{{url('css/owl/owl.theme.default.min.css')}}">
		<link rel="stylesheet" href="{{url('css/style.css')}}">
<script type="text/javascript">
	var APP_URL = {!! json_encode(url('/')) !!}
</script>
		@yield('css')

		
	</head>

	<!-- Top Header section -->
	<body ng-app=''>
		<div class="topheader fl w100">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 border-rt">
						<a href="{{url('/')}}">
							<img src="{{url('images/logo.png')}}" class="img-responsive" alt="logo">
						</a>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="topbar-search fl w100">


							<!-- <button type="submit"> -->
							<!-- <i class="fa fa-search" aria-hidden="true"></i> -->
							<!-- </button> -->

<form action="{{url('/search')}}" method="GET">
							<!-- Search form -->
							<div class="md-form">
								<i class="fa fa-search" aria-hidden="true"></i>
							    <input class="form-control" type="text" name="search" placeholder="Type to search your favourite car" aria-label="Search">
							</div>
							{{csrf_field()}}
						</div>
					</form>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<div class="topbar-icons">
							<span class="icons">
								<a href="#" target="_blank">
									<i class="fa fa-facebook" aria-hidden="true">
									</i>
								</a>
							</span>
							<span class="icons">
								<a href="#" target="_blank">
									<i class="fa fa-twitter" aria-hidden="true"></i>
								</a>
							</span>
							<span class="icons">
								<a href="#" target="_blank">
									<i class="fa fa-youtube" aria-hidden="true"></i>
								</a>
							</span>
							<span class="icons">
								<a href="#" target="_blank">
									<i class="fa fa-google-plus" aria-hidden="true"></i>
								</a>
							</span>
							<span class="icons">
								<a href="#" target="_blank">
									<i class="fa fa-instagram" aria-hidden="true">
									</i>
								</a>
							</span>
							<p>+91 9876543210  |  Contact</p>
						</div>

					</div>
				</div>
			</div>	
		</div>
		<div class="header fl w100">
			<!-- <div class="container"> -->
				<nav class="navbar">
					<!-- <div class="container-fluid"> -->
						<div class="navbar-header">
							<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">

								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>

						</div>
						<div class="navbar-collapse collapse" id="bs-example-navbar-collapse-1">
							<ul class="nav navbar-nav">
								<li class="w16">
									<a href="{{url('/collection')}}" class="text-center">
										<img src="{{url('images/collections.png')}}">COLLECTIONS
									</a>
								</li>
									<li class="dropdown w16">
								<a class="dropdown-toggle text-center" data-toggle="dropdown" href="#">
								<img src="{{url('images/brands.png')}}">BRANDS	
								</a>
								<ul class="dropdown-menu">

<?php $make =  Helper::MakeListing(); ?>
@foreach($make as $make)
									<li><a href="{{url('/collection/'.$make->id.'/'.str_slug($make->make))}}">{{$make->make}}</a></li>
					@endforeach
								</ul>
							</li>

										<li class="dropdown w16 home-car-style">
								<a class="dropdown-toggle text-center" data-toggle="dropdown" href="{{url('/')}}">
								<img src="{{url('images/style2.png')}}" class="style-pic">STYLE
									
								</a>
								<ul class="dropdown-menu">
						<?php $type =  Helper::TypeListing();
													 ?>


@foreach($type as $make)
									<li><a href="{{url(str_slug($make->type))}}">{{$make->type}}</a></li>
					@endforeach
								</ul>
							</li>


	

								<li class="w33">
									<a href="#" class="text-left">
										<img src="{{url('images/aboutus.png')}}">ABOUT US
									</a>
								</li>
							<a href="#" class="header-enquiry" data-toggle="modal" data-target="#enquiry">QUICK ENQUIRY</a>
									<!-- quick enquiry modal -->
							<div class="modal fade" id="enquiry" role="dialog">
								<div class="modal-dialog">
									<!-- Modal content-->
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="modal-title text-center">QUICK ENQUIRY
											</h4>
										</div>


										<div class="modal-body">

											   <div class="center-block msg">
                    <div class="alert alert-success" style="display:none"></div>
                    <div class="alert alert-danger" style="display:none"></div>
                  </div>
  <div id="form">  
											<!-- <div class="form-area" ng-app=''>  -->
												<form class="form-horizontal" method="POST" id="quickform" name="quickfrm" action="#">
													{{ csrf_field() }}
													<div class="form-group">
														<label for="company_name" class=" col-md-3">Make:</label>
														<div class=" col-md-3">
															<select name="make" id="makea" class="form-control make">
																<option></option>
															</select>
														</div>

														<label for="company_name" class=" col-md-3 text-right">Model:</label>
														<div class=" col-md-3">
															<select name="model" id="model" class="form-control model">
																<option></option>
															</select>
														</div>
													</div>

													<div class="form-group">
														<label for="first name" class=" col-md-3">First Name:</label>
														<div class=" col-md-9">
															<input type="text" class="form-control" name="first_name" value="" placeholder="First Name" ng-model="fname" required>
															<p><span ng-show="quickfrm.fname.$dirty && quickfrm.fname.$error.required" class="red-txt" >Required</span></p>
														</div>
													</div>

													<div class="form-group">
														<label for="last name" class=" col-md-3">Last Name:</label>
														<div class=" col-md-9">
															<input type="text" class="form-control" name="last_name" value="" placeholder="Last Name" ng-model="lname" required>
															<p><span ng-show="quickfrm.lname.$dirty && quickfrm.lname.$error.required" class="red-txt" >Required</span></p>
														</div>
													</div>

													<div class="form-group">
														<label for="email" class=" col-md-3">Email:</label>
														<div class=" col-md-9">
															<input type="email" class="form-control" name="email" value="" placeholder="Email" ng-model="quickemail" required>
															<p>
																<span ng-show="quickfrm.quickemail.$dirty && quickfrm.quickemail.$error.required" class="red-txt">Required </span>
																<span ng-show="quickfrm.quickemail.$dirty && quickfrm.quickemail.$error.email" class="red-txt">Not an email </span>
															</p>
														</div>
													</div>

													<div class="form-group">
														<label for="phone" class=" col-md-3">Phone:</label>
														<div class=" col-md-9">
															<input type="text" class="form-control" name="phone" value="" placeholder="Phone" ng-model="quickphone" requiredng-pattern="/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/">
															<p>
																<span ng-show="quickfrm.quickphone.$dirty && quickfrm.quickphone.$error.required" class="red-txt">Required</span> 
																<span ng-show="quickfrm.quickphone.$dirty && quickfrm.quickphone.$error.pattern" class="red-txt">Must be a valid phone number</span>
															</p>
														</div>
													</div>
													<div class="modal-footer">
														<input type="submit" name="quicksubmit" class="btn btn-primary">
														<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
													</div>
												</form>
													@include ('layouts.error')
											
												<!-- </div> -->
											</div>
										</div>
									</div>
								</div>
								<!-- modal end -->
							</ul>
						</div>	
					<!-- </div> -->
				</nav>
			<!-- </div> -->
		</div>
	<!-- End Top Header section -->

	@yield('content')

	
	<!--Footer Start-->
	<footer class="fl w100">
		<div class="follow fl w100">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="follow-us">
							<h3 class="avenir-demi"><span>Follow Us</h3>
						<div class="topbar-icons">
							<span class="icons">
								<a href="#" target="_blank">
									<i class="fa fa-facebook" aria-hidden="true">
									</i>
								</a>
							</span>
							<span class="icons">
								<a href="#" target="_blank">
									<i class="fa fa-twitter" aria-hidden="true"></i>
								</a>
							</span>
							<span class="icons">
								<a href="#" target="_blank">
									<i class="fa fa-youtube" aria-hidden="true"></i>
								</a>
							</span>
							<span class="icons">
								<a href="#" target="_blank">
									<i class="fa fa-google-plus" aria-hidden="true"></i>
								</a>
							</span>
							<span class="icons">
								<a href="#" target="_blank">
									<i class="fa fa-instagram" aria-hidden="true">
									</i>
								</a>
							</span>
						</div>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<div class="newsletter">
							<h3>Newsletter</h3>
							<form>
								<input type="text" placeholder="Enter Email">
								<i class="fa fa-paper-plane" aria-hidden="true"></i>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="footer-section fl w100">
			<div class="container">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<h4>Contact Us</h4>
						<h4>Caars Nation</h4>
						<p>Lorem Ipsum is simply dummy text 
						<br>
						Lorem Ipsum,dummy-21473.
						</p>
						<p><i class="fa fa-phone" aria-hidden="true"></i>+91 9876543210, 8976543210</p>
						<p><i class="fa fa-envelope-o" aria-hidden="true"></i>info@companymail.com</p>
					</div>
					<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
						<h4>Quick Links</h4>
						<ul>
							<li><a href="#">Privacy Policy</a></li>
							<li><a href="#">Cancellation & Refund</a></li>
							<li><a href="#">Terms of use</a></li>
						</ul>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
						<h4>Brands</h4>
						<div class="row">
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<ul>
									<li><a href="#">Aston martin</a></li>
									<li><a href="#">Audi</a></li>
									<li><a href="#">Bentley</a></li>
									<li><a href="#">BMW</a></li>
									<li><a href="#">Cadillac</a></li>
									<li><a href="#">Chrysler</a></li>
									<li><a href="#">Ferrari</a></li>
								</ul>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<ul>
									<li><a href="#">Fiat</a></li>
									<li><a href="#">Hummer</a></li>
									<li><a href="#">Jaguar</a></li>
									<li><a href="#">Lamborghini</a></li>
									<li><a href="#">Land Rover</a></li>
									<li><a href="#">Lexus</a></li>
									<li><a href="#">Maserati</a></li>
								</ul>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<ul>
									<li><a href="#">Mercedes-Benz</a></li>
									<li><a href="#">Mini</a></li>
									<li><a href="#">Porsche</a></li>
									<li><a href="#">Rolls-Royce</a></li>
									<li><a href="#">Toyota</a></li>
									<li><a href="#">Volkswagen</a></li>
									<li><a href="#">DC</a></li>
								</ul>
							</div>
							<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
								<ul>
									<li><a href="#">Ford</a></li>
									<li><a href="#">Volvo</a></li>
									<li><a href="#">Nissan</a></li>
								</ul>
							</div>
						</div>
				</div>
			</div>
		</div>
	</div>
	<div class="copyright fl w100">
		<div class="container">
			<p>Copyright &copy; 2018 Carrs Nation</p>
		</div>
	</div>
	</footer>
	<!--Footer End-->


	<script src="{{url('js/jquery-3.3.1.min.js')}}"></script>
	<script src="{{url('js/bootstrap.min.js')}}"></script>
	<!-- <script src="{{url('js/jquery.fancybox.min.js')}}"></script> -->
				<script src="{{url('js/angular.js')}}"></script>
								<script src="{{url('js/global.js')}}"></script>



	@yield('js')
	

	</body>
</html>
@extends('layouts.front')
@section('title','Details')


@section('content')

<!-- Used ferrari start -->
<section class="used-ferrari-california fl w100"> 
	<div class="container">
		<p class="text-right">Home/{{$data->make}}/
			<span class="navigation-color">{{ucfirst($data->title)}}</span>
		</p>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div id="owl-four" class="owl-carousel owl-theme">

					@foreach($images as $img)
					@if(Helper::ImageExist($img))
					<div class="item">
						<a data-fancybox="gallery" href="{{Helper::ImageExist($img)}}">
							<img  src="{{Helper::ImageExist($img)}}">
						</a>
						
					</div>
					@endif
					@endforeach

				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="vehicle-details">
					<h3 class="avenir-demi">{{$data->title}}</h3>
					@if($data->booked)
					<a href="#" class="booked">Booked</a>
					@endif
					<h3 class="avenir-demi">{{Helper::price($data->price)}}</h3>
					<table>
						@if($data->year)
						<tr>
							<td>Registration Year</td>
							<td>{{$data->year}}</td>
						</tr>
						@endif
						<tr>
							<td>Vehicle Type</td>
							<td>{{$data->type}}</td>
						</tr>
						<tr>
							<td>Fuel type</td>
							<td>{{$data->fuel}}</td>
						</tr>
						@if($data->driven)
						<tr>
							<td>Kms Driven</td>
							<td>{{$data->driven}}</td>
						</tr>
						@endif
						@if($data->exterior)	
						<tr>
							<td>Exterior</td>
							<td>{{$data->exterior}}</td>
						</tr>
						@endif

						@if($data->interior)	
						<tr>
							<td>Interior</td>
							<td>{{$data->interior}}</td>
						</tr>
						@endif

					</table>
				</div>
			</div>
		</div>
		<div class="share-experience">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-x-12">
					<p class="fl">Share your experience with friends</p>
					<div class="topbar-icons fl">
						<span class="icons">
							<a href="#">
								<i class="fa fa-facebook" aria-hidden="true">
								</i>
							</a>
						</span>
						<span class="icons">
							<a href="#">
								<i class="fa fa-twitter" aria-hidden="true"></i>
							</a>
						</span>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-x-12">
					<div class="reserve-car">
						<a href="#" data-toggle="modal" data-target="#myModal2">REQUEST CALL BACK</a>
						<a href="#">RESERVE CAR NOW</a>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End -->


	<!-- Exterior gallery starts -->
	<section class="extr-intr-gallery fl w100">
		<div class="container">
			<div class="row">
				<?php $ext = json_decode($data->ext); ?>

				@if(count($ext)>0)
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<h3 class="avenir-demi">Exterior <span class="avenir-light">Gallery</span></h3>
					<div class="row">


						@foreach($ext as $img)
						@if(Helper::ImageExist("/images/listing/exterior/".$img))
						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<a data-fancybox="gallaery" href="{{Helper::ImageExist("/images/listing/exterior/".$img)}}">
								<img src="{{Helper::ImageExist("/images/listing/exterior/".$img)}}"></a>
							</a>
						</div>
						@endif
						@endforeach


					</div>

					<div class="hgap20"></div>


				</div>
				@endif
				<?php $ext = json_decode($data->iimg); ?>

				@if(count($ext)>0)
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<h3 class="avenir-demi">Interior <span class="avenir-light">Gallery</span></h3>
					<div class="row">
						<?php $ext = json_decode($data->iimg); ?>

						@foreach($ext as $img)
						@if(Helper::ImageExist("/images/listing/interior/".$img))


						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
							<a data-fancybox="gallaery" href="{{Helper::ImageExist("/images/listing/interior/".$img)}}">
								<img src="{{Helper::ImageExist("/images/listing/interior/".$img)}}">
							</a>
						</div>

						@endif
						@endforeach

					</div>
					@endif
				</div>
			</div>	
		</div>
	</section>

	<!-- End -->

	<!-- overview section starts -->
	<section class="overview car_detail_features fl w100">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div id="exTab3">	
						<div id="exTab3">	
							<ul class="nav nav-tabs">
								<li class="active">
									<a  href="#1" data-toggle="tab"><span class="brands-pic"></span>OVERVIEW</a>
								</li>
								<li>
									<a href="#2" data-toggle="tab"><span class="price-pic"></span>FEATURES</a>
								</li>
								<li>
									<a href="#3" data-toggle="tab"><span class="price-pic"></span>SPECIFICATIONS</a>
								</li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane active" id="1">
								<table>

									@if($data->price)	
									<tr>
										<td>Price</td>
										<td>{{Helper::price($data->price)}}</td>
									</tr>
									@endif

									@if($data->transmission)	
									<tr>
										<td>Transmission</td>
										<td>{{$data->transmission}}</td>
									</tr>
									@endif

									@if($data->year)
									<tr>
										<td>Model Year</td>
										<td>{{$data->year}}</td>
									</tr>
									@endif
									<tr>
										<td>Vehicle Type</td>
										<td>{{$data->type}}</td>
									</tr>
									<tr>
										<td>Fuel type</td>
										<td>{{$data->fuel}}</td>
									</tr>
									@if($data->driven)
									<tr>
										<td>Kms Driven</td>
										<td>{{$data->driven}}</td>
									</tr>
									@endif
									@if($data->exterior)	
									<tr>
										<td>Exterior</td>
										<td>{{$data->exterior}}</td>
									</tr>
									@endif

									@if($data->interior)	
									<tr>
										<td>Interior</td>
										<td>{{$data->interior}}</td>
									</tr>
									@endif


									@if($data->register_year)	
									<tr>
										<td>Registered at</td>
										<td>{{$data->register_year}}</td>
									</tr>

									@endif




									@if($data->color)	
									<tr>
										<td>Color</td>
										<td>{{$data->color}}</td>
									</tr>
									@endif


									@if($data->owners)	
									<tr>
										<td>No. of Owner(s)</td>
										<td>{{$data->owners}}</td>
									</tr>
									@endif
									@if($data->insurance)	

									<tr>
										<td>Insurance</td>
										<td>{{$data->insurance}}</td>
									</tr>
									@endif
									@if($data->life_time_tax)	
									<tr>
										<td>Life Time Tax</td>
										<td>{{$data->life_time_tax}}</td>
									</tr>
									@endif

								</table>


							</div>
							<div class="tab-pane" id="2">

								<ul class="car_features_tab">
									@foreach($features as $f)

									<li>{{$f->features}}</li>

									@endforeach
								</ul>
							</div>
							<div class="tab-pane" id="3">
								<div class="car_specifications">
									{!!$data->spec!!}
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="car-delivery">
						<h3 class="avenir-demi">Similar <span class="avenir-light">Cars</span>
						</h3>
						<div class="border-bm"></div>
						<div id="owl-five" class="owl-carousel owl-theme">
							@foreach($similar as $featured )
							<a href="{{url('/'.str_slug($featured->make).'/'.$featured->id.'/'.str_slug($featured->title))}}">

								<div class="item">
									<img src="{{url('images/listing/base/'.$featured->base)}}">
									<p class="avenir-demi">{{str_limit(ucfirst($featured ->title),25,'..')}}
										@if($featured ->year)
										<span class="latest-models">{{$featured ->year}}</span>
										@endif
									</p>

									@if($featured ->driven)
									<p class="avenir-light">KMS {{$featured ->driven}}
										@if($featured ->fuel)
										<span class="latest-models">FUEL {{$featured ->fuel}}</span>
										@endif
									</p>
									@endif

									@if($featured ->price)
									<p class="avenir-demi">{{Helper::price($featured ->price)}}
										@if($featured ->booked)

										@endif
									</p>
									@endif


								</div>
								@endforeach

							</div>
						</div>
					</div>
				</div>
			</div>
		</section>
		<!-- End -->


		<!-- Request form modal -->
		<div class="modal fade request-callback-section" id="myModal2" role="dialog">
			<div class="modal-dialog">
				<!-- Modal content-->

				<!-- <div class="model-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div> -->

				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<div class="modal-body">
					<div class="center-block msg">
						<div class="alert alert-success" style="display:none"></div>
						<div class="alert alert-danger" style="display:none"></div>
					</div>

					<div class="used-ferrari">
						<div class="request-callback">
							<h4 class="text-center avenir-demi">YOU WANT TO KNOW MORE?</h4>
							<p class="text-center">Request call back</p>
							<!-- <div class="form-area" ng-app=''>  -->
								<form  name="reqform" method="post" action="#" class="reqform" id="request">
									{{ csrf_field() }}
									<div class="form-group">
										<input type="text" class="form-control" id="name" placeholder="Name" name="name" ng-model="name" required>
										<p><span ng-show="reqform.name.$dirty && reqform.name.$error.required" class="red-txt" >Required</span></p>
									</div>
									<div class="form-group">
										<input type="email" class="form-control" id="email" placeholder="Email" name="email" ng-model="email" required>
										<p>
											<span ng-show="frm.email.$dirty && reqform.email.$error.required" class="red-txt">Required </span>
											<span ng-show="frm.email.$dirty && reqform.email.$error.email" class="red-txt">Not an email </span>
										</p>
									</div>
									<div class="form-group">
										<input type="text" class="form-control" id="phone" placeholder="Phone" name="phone" ng-model="phone" required ng-pattern="/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/">
										<p>
											<span ng-show="frm.phone.$dirty && reqform.phone.$error.required" class="red-txt">Required</span> 
											<span ng-show="frm.phone.$dirty && reqform.phone.$error.pattern" class="red-txt">Must be a valid phone number</span>
										</p>
									</div>
									<!-- <input type="submit" name="reqsubmit" id="reqsubmit" class="reqsubmit avenir-demi" value="REQUEST CALL BACK"> -->

									<div class="text-center">
										<button type="submit" name="reqsubmit" id="reqsubmit" class="reqsubmit avenir-demi">REQUEST CALL BACK</button>
									</div>
									@include ('layouts.error')
								</form>
								<!-- </div>  -->
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- end -->

			@endsection

			@section('js')
			<script src="{{url('js/owl/owl.carousel.min.js')}}"></script>
			<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.css" />
			<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.2/dist/jquery.fancybox.min.js"></script>
			<script>
				$('#owl-four').owlCarousel({
					loop:true,
					margin:10,
					nav:true,
					autoplay:false,
					autoplayTimeout:3000,
					responsive:{
						0:{
							items:1
						},
						600:{
							items:1
						},
						1000:{
							items:1
						}
					}
				});
				$('#owl-five').owlCarousel({
					loop:true,
					margin:10,
					nav:true,
					autoplay:false,
					autoplayTimeout:3000,
					responsive:{
						0:{
							items:1
						},
						600:{
							items:1
						},
						1000:{
							items:2
						}
					}
				});
			</script>

			@endsection
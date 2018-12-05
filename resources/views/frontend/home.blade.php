@extends('layouts.front')
@section('title','Home')

@section('css')
<link rel="stylesheet" href="{{url('css/select2.min.css')}}">
<link rel="stylesheet" href="{{url('css/animate.min.css')}}">
@endsection

@section('content')

<!-- keep it simple start -->
	<section class="keep-it-simple fl w100">
		<p class="text-center">SEARCH BY</p>
		<div id="exTab2" class="container">	
			<div id="exTab2" class="container">	
				<ul class="nav nav-tabs">
					<li class="active">
		        		<a  href="#1" data-toggle="tab"><span class="brands-pic"></span>BRANDS</a>
					</li>
					<li>
						<a href="#2" data-toggle="tab"><span class="price-pic"></span>PRICE</a>
					</li>
					
				</ul>
  			</div>
			<div class="tab-content">
			  	<div class="tab-pane active" id="1">
          			<h2 class="text-center avenir-demi">LET'S KEEP IT SIMPLE</h2>
          			<h4 class="text-center avenir-light">WE ARE THE BEST WHEN IT COMES TO EXOTIC CARS
          			</h4>
          			<div class="form-group">

		                <select class="form-control select2"  id ="make" style="width: 100%;">
		                  <option selected="selected">Explore your favourite brand</option>
		                  @foreach($make as $make)


		                  <option value="{{url('/collection/'.$make->id.'/'.str_slug($make->make))}}">{{$make->make}}</option>
		           		  @endforeach	
		                </select>
              		</div>
				</div>
				<div class="tab-pane" id="2">


					<div class="search-by-price-section">
					<h2 class="text-center avenir-demi">LET'S KEEP IT SIMPLE</h2>
				<h4 class="text-center avenir-light">WE ARE THE BEST WHEN IT COMES TO EXOTIC CARS
				</h4>
					<form action="{{url('/search')}}" method="GET">
						<input type="hidden" name="price" value="{{rand(2,2)}}">
						{{csrf_field()}}
						<div class="form-group"> 
						
							<input type="text" name="from" class="form-control" placeholder="min " required="">
						</div>
						<div class="form-group">to</div>
						<div class="form-group">
							<input type="text" name="to" class="form-control" placeholder="max" required="">
						</div>
						
						<div class="form-group text-center">
							<button type="submit" class="btn btn-default">Submit</button> 
						</div>
					</form>

				</div>
					
          		
				</div>
			</div>
  		</div>
  		<div class="simple-car">
  			<img src="images/letskeepitsimple.png" class="wow" data-wow-delay="0ms" data-wow-duration="2000ms" src="images/sell.png" alt="" style="visibility: visible; animation-duration: 2000ms; animation-delay: 0ms; animation-name: slideInRight;">
  		</div>
	</section>
	<!-- End -->


	<!-- keep-it-simple-brands start -->
	<section class="customer-section fl w100">
		<div class="container">
			<div class="col-md-offset-3 col-md-8">
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<img src="images/brands-20.png">
					<div class="customers">
						<h3>20+</h3>
						<p>Brands</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<img src="images/cars-100.png">
					<div class="customers">
						<h3>100+</h3>
						<p>Cars</p>
					</div>
				</div>
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
					<img src="images/customers-2500.png">
					<div class="customers">
						<h3>2500+</h3>
						<p>Customers</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End -->






	<!-- quality used car section start -->
	<section class="used-cars fl w100">
		<img src="images/qualityusedcars.png">
		<div class="used-cars-overlay fl w100">
			<div class="overlay-text">
				<h3 class="avenir-light">Wide Variety of</h3>
				<h2 class="avenir-bold">QUALITY USED CARS</h2>
				<p class="avenir-light">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text.</p>
				<a href="#" class="avenir-demi">MORE ABOUT US</a>
			</div>
		</div>
	</section>

	<!-- End -->


	<!-- Select by car style start -->
	<section class="car-style fl w100">
		<div class="container">
			<h3 class="text-center avenir-demi">Car Select by Style</h3>
			<div class="border-bm border-middle"></div>
			<div class="row">


				<div class="car-style-1 fl w100">
					<div class="col-md-offset-2 col-md-8">

						<?php $x=0; ?>
						@foreach($type as $types)

						<?php $x++; ?>

						@if($x >= 4)
						<a href="{{url('/'.str_slug($types->type))}}">
						<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
							<img src="{{url('/images/types/'.$types->image)}}" width="137px">
							<p class="text-center">{{$types->type}}</p>
							
						</div>
					</a>
						@endif
						@endforeach

					</div>
				</div>


				<div class="col-md-offset-3 col-md-8">
					<div class="car-style-2">

									<?php $z=0; ?>
						@foreach($type as $typess)

						<?php $z++; ?>

						@if($z < 4 )

						<a href="{{url('/'.str_slug($typess->type))}}">
						<div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
							<img src="{{url('/images/types/'.$typess->image)}}">
							<p class="text-center">{{$typess->type}}</p>
							
						</div>
					</a>
						@endif
						@endforeach

					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End -->

	<!-- Select by car style start -->
	<section class="car-latest fl w100"> 
		<div class="container">
			<h3 class="avenir-demi">Car by <span class="avenir-light">Latest</span></h3>
			<div class="border-bm"></div>
			<div class="row">

				@foreach($list as $lists)
				<!-- <a href="{{url('/'.str_slug($lists->make).'/'.$lists->id.'/'.str_slug($lists->title))}}"> -->
				<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 latest-car-list">
					<a href="{{url('/'.str_slug($lists->make).'/'.$lists->id.'/'.str_slug($lists->title))}}"><img src="{{url('images/listing/base/thumb/'.$lists->base)}}"></a>
					<p class="avenir-demi car-latest-title"><a href="{{url('/'.str_slug($lists->make).'/'.$lists->id.'/'.str_slug($lists->title))}}">{{str_limit(ucfirst($lists->title),25,'..')}}</a>
					@if($lists->year)
						<span class="latest-models">{{$lists->year}}</span>
					@endif
					</p>
					@if($lists->driven)
					<p class="avenir-light">KMS {{$lists->driven}}
					@if($lists->fuel)
						<span class="latest-models">FUEL {{$lists->fuel}}</span>
					@endif
					</p>
					@endif


					@if($lists->price)
					<p class="avenir-demi">{{Helper::price($lists->price)}}
						@if($lists->booked)
						<span class="latest-models">
							<a class="booked">Booked</a>
						</span>
						@endif
					</p>
					@endif
				</div>
			<!-- </a> -->
			    @endforeach
			</div>
		</div>
	</section>
	<!-- End -->


	<!-- Select by car style start -->
	<section class="car-feature fl w100"> 
		<div class="container">
			<h3 class="avenir-demi">Car by <span class="avenir-light">Featured</span></h3>
			<div class="border-bm"></div>
				<div id="owl-one" class="owl-carousel owl-theme">
								@foreach($feature as $featured )
												<a href="{{url('/'.str_slug($featured->make).'/'.$featured->id.'/'.str_slug($featured->title))}}">

					<div class="item">
						<img src="{{url('images/listing/base/thumb/'.$featured->base)}}">
						<p class="avenir-demi car-feature-title">{{str_limit(ucfirst($featured ->title),25,'..')}}
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
			</a>
	</section>
	<!-- End -->


	<!-- client says start -->
	<section class="client-says fl w100"> 
		<div class="container">
			<div class="row">
				<div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
					<h3 class="avenir-demi">Client <span class="avenir-light">Says</span></h3>
					<div class="border-bm"></div>
					<div id="owl-two" class="owl-carousel owl-theme">
						<div class="item">
							<img src="images/clientsays.png" class="fl">
							<div class="clients fl">
								<h4 class="avenir-demi">Imperdiet ac leo</h4>
								<p>Lorem Ipsum</p>
							</div>
							<p class="fl">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
							</p>
						</div>
						<div class="item">
							<img src="images/clientsays.png" class="fl">
							<div class="clients fl">
								<h4 class="avenir-demi">Imperdiet ac leo</h4>
								<p>Lorem Ipsum</p>
							</div>
							<p class="fl">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
							</p>
						</div>
						<div class="item">
							<img src="images/clientsays.png" class="fl">
							<div class="clients fl">
								<h4 class="avenir-demi">Imperdiet ac leo</h4>
								<p>Lorem Ipsum</p>
							</div>
							<p class="fl">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
							</p>
						</div>
					</div>
				</div>
				<div class="col-lg-7 col-md-7 col-sm-7 col-xs-12">
					<div class="car-delivery">
						<h3 class="avenir-demi">Car <span class="avenir-light">Delivery</span></h3>
						<div class="border-bm"></div>
						<div id="owl-three" class="owl-carousel owl-theme">
							<div class="item">
								<img src="images/cardelivery1.jpg">
								<h4 class="avenir-demi">Imperdiet ac leo</h4>
								<p>Lorem Ipsum</p>
							</div>
							<div class="item">
								<img src="images/cardelivery2.jpg">
								<h4 class="avenir-demi">Imperdiet ac leo</h4>
								<p>Lorem Ipsum</p>
							</div>
							<div class="item">
								<img src="images/cardelivery1.jpg">
								<h4 class="avenir-demi">Imperdiet ac leo</h4>
								<p>Lorem Ipsum</p>
							</div>
							<div class="item">
								<img src="images/cardelivery2.jpg">
								<h4 class="avenir-demi">Imperdiet ac leo</h4>
								<p>Lorem Ipsum</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- End -->

	@endsection



	@section('js')
	<script src="{{url('js/owl/owl.carousel.min.js')}}"></script>
	<script src="{{url('js/wow.js')}}"></script>
	<script>
		$('#owl-one').owlCarousel({
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
		            items:4
		        }
		    }
		});
		$('#owl-two').owlCarousel({
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
		$('#owl-three').owlCarousel({
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

	<script src="{{url('js/select2.full.min.js')}}"></script>
	<script>
	  $(function () {
	    //Initialize Select2 Elements
	    $('.select2').select2()
		})

	
	</script>

	
  <script type="text/javascript">



	        $(function(){
      // bind change event to select
      $('#make').on('change', function () {
          var url = $(this).val(); // get selected value

     

          if (url) { // require a URL
              window.location = url; // redirect
          }
          return false;
      });
    });
</script>
	@endsection
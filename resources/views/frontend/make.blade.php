@extends('layouts.front')
@section('title','List')


@section('content')

<!-- Used ferrari start -->
<section class="used-ferrari main-section fl w100">
	<div class="container">
		<p class="text-right bread-crumb">Home/
			@if($cmake)
			<span class="navigation-color">{{ucfirst($cmake)}}</span>
			@endif

		</p>
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 filter-padding">
				<div class="filter fl w100">
					<p class="avenir-demi">Filter</p>
					<form name="filter-form">
						<select id="make" >
							<option value="{{url('/collection/'.$mid.'/'.str_slug($cmake))}}">Select model</option>
							@foreach($model as $make)


							<option value="{{url('/collection/'.$mid.'/'.str_slug($cmake))}}/{{$make->id}}/{{str_slug($make->model)}}"  @if($modelid == str_slug($make->id)) selected @endif>{{$make->model}}</option>
							@endforeach
						</select>
					</form>
				</div>

				<div class="request-callback fl w100">
					<h4 class="text-center avenir-demi">YOU WANT TO KNOW MORE?</h4>
					<p class="text-center">Request call back</p>
					<div class="center-block msg">
						<div class="alert alert-success" style="display:none"></div>
						<div class="alert alert-danger" style="display:none"></div>
					</div>
					<form  name="request-form" id="request">
						<div class="form-group">
							<input type="text" class="form-control" id="name" placeholder="Name" name="name">
						</div>
						<div class="form-group">
							<input type="email" class="form-control" id="email" placeholder="Email" name="email">
						</div>
						<div class="form-group">
							<input type="text" class="form-control" id="phone" placeholder="Phone" name="phone">
						</div>
						{{csrf_field()}}

						<button  type="submit" class="avenir-demi">REQUEST CALL BACK</button>
					</form> 
				</div>
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
				<h3 class="avenir-demi">{{ucfirst($cmake)}} <span class="avenir-light"></span>
				</h3>
				<div class="border-bm"></div>

				<div class="border-bm-2"></div>
				<div class="row">
					@if(count($type) > 0)

					@foreach($type as $lists)
					<a href="{{url('/'.str_slug($lists->make).'/'.$lists->id.'/'.str_slug($lists->title))}}">

						<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 car_collection_list">
							<img src="{{url('images/listing/base/thumb/'.$lists->base)}}">
							<p class="avenir-demi">{{str_limit(ucfirst($lists->title),25,'..')}}
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
					</a>
					@endforeach

					@else
					<div class="list-not-found">
						<h2>No cars Found</h2>
					</div>
					@endif
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End -->


<!-- About Ferrari start -->
@if($desc)
<section class="about-ferrari fl w100">
	<div class="container">
		<div class="row">
			<div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">	
			</div>
			<div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 about-make-section">
				<h3 class="avenir-demi">About <span class="avenir-light">{{$cmake}}</span></h3>
				<div class="border-bm"></div>
				{!!$desc!!}
			</div>
		</div>
	</div>
</section>
<!-- End -->
@endif
@endsection

@section('js')

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
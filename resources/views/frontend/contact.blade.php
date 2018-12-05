@extends('layouts.front')
@section('title','Contact')


@section('content')
<section class="contact fl w100">
	<div class="container">
		<p class="text-right">Home/
			<span class="navigation-color">Contact</span>
		</p>
		<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<h3 class="avenir-demi">Get in Touch</h3>
				<p>Lorem Ipsum is simply dummy text of the printing</p>
				<div class="form-area" ng-app=''>
					<form role="contactform"  method="post" action="" name="frm">
						<br style="clear:both">
						<div class="form-group fl w100">
							<input type="text" class="form-control" id="name" name="name" placeholder="NAME" ng-model="name" required>
							<p><span ng-show="frm.name.$dirty && frm.name.$error.required" class="red-txt" >Required</span></p>
						</div>
						<div class="form-group fl w100">
							<input type="email" class="form-control" id="email" name="email" placeholder="EMAIL" ng-model="email" required>
							<p>
								<span ng-show="frm.email.$dirty && frm.email.$error.required" class="red-txt">Required </span>
								<span ng-show="frm.email.$dirty && frm.email.$error.email" class="red-txt">Not an email </span>
							</p>
						</div>
						<div class="form-group fl w100">
							<input type="text" class="form-control" id="mobile" name="phone" placeholder="PHONE" ng-model="phone" required ng-pattern="/^[\+]?[(]?[0-9]{3}[)]?[-\s\.]?[0-9]{3}[-\s\.]?[0-9]{4,6}$/">
							<p>
								<span ng-show="frm.phone.$dirty && frm.phone.$error.required" class="red-txt">Required</span> 
								<span ng-show="frm.phone.$dirty && frm.phone.$error.pattern" class="red-txt">Must be a valid phone number</span>
							</p>
						</div>
						<div class="form-group fl w100">
							<textarea class="form-control" name="message" type="textarea" id="message" placeholder="MESSAGE"  rows="7" ng-model="message" required>
							</textarea>
							<p><span ng-show="frm.message.$dirty && frm.message.$error.required" class="red-txt">Required</span></p>
						</div>	
						<input type="submit" id="submit" name="consubmit" class="consubmit">
					</form>
				</div>
			</div>
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<h3 class="avenir-demi">Contact us</h3>
				<p>Lorem Ipsum is simply dummy text of the printing</p>
			</div>
		</div>
	</div>
</section>



@endsection


@section('js')
<script src="{{url('/')}}/js/angular.js"></script>
@endsection
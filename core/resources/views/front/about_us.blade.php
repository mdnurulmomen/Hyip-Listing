
@extends('front.layout.app')
@section('contents')

	<!-- Home Page Banner Area Start -->
	<section id="banner" class="breadcrumb">
		<div class="container">
			<div class="row">
				<div class="banner-info">
					<div class="col-12">
						<h1>{{ $aboutSettings->about_heading }}</h1>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Home Page Banner Area End -->

	<!-- businessDeal Area Start -->
	<section class="businessDeal">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 d-flex align-self-center">
					<div class="left_content">
						<!-- <h4>
							Make A Deal With Us
						</h4> -->
						<h3>
							{{ $aboutSettings->business_heading }}
						</h3>
						<ul>
							<li>
								<p style="padding: 0;">	
									{{ $aboutSettings->business_description }}
								</p>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-lg-6">
					<div class="right_content">
						<!-- <img class="img-fluid" src="{{asset('assets/front/img/aboutUs/about_us1.png')}}" alt=""> -->
						<img class="img-fluid" src="{{asset('assets/front/images/setting/'.$aboutSettings->business_image)}}" alt="">
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- businessDeal Area End -->

	

	<!-- Our Mission  Area Start -->
	<section class="ourmission">
			<div class="container">
					<div class="row">
						<div class="col-lg-6">
							<div class="left_content">
								<!-- <img class="img-fluid" src="{{asset('assets/front/img/aboutUs/about_us3.png')}}" alt=""> -->
								<img class="img-fluid" src="{{asset('assets/front/images/setting/'.$aboutSettings->mission_image)}}" alt="">
							</div>
						</div>
						<div class="col-lg-6 d-flex align-self-center">
							<div class="right_content">
								<!-- <h4>Learn About </h4> -->
								<h3>
										{{ $aboutSettings->mission_heading }}
								</h3>
								<ul class="list">
									<li>
										<p style="padding: 0;">
											<span class="margin_bottom">
												{{ $aboutSettings->mission_description }}
											</span>
										</p>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>

	</section>
		<!-- Our Mission  Area End -->

@stop
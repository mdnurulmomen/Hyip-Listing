@extends('front.layout.app')
@section('contents')

	<!-- Home Page Banner Area Start -->
	<section id="banner"  style="background: url({{ asset('assets/front/images/setting/'.$detailsPageSettings->detail_image) }}) no-repeat center;" class="breadcrumb">
		<div class="container">
			<div class="row">
				<div class="banner-info">
					<div class="col-12">
						<h1>{{ $companyToDescribe->name }}</h1>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- Home Page Banner Area End -->


	<!-- Blog Section Start -->
	<section id="blog" class="blogDetails">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="blog_box">
						<div class="top_img">
							<img class="img-fluid" src="img/blog/f1.png" alt="">
						</div>
						<div class="common_area">
							<div class="date">
								<span>{{ date('d') }}</span>
								<p>{{ date('M') }}</p>
							</div>
						</div>
							
						<div class="content">
							
							<h2 class="mt-1">
								Description
							</h2>
							
							<h3 class="lead mb-2">
								{{ $companyToDescribe->Category->name }} Category
							</h3>

							<p class="bDpb">
								{{ $companyToDescribe->description }}
							</p>

						</div>
							
					</div>
				</div>

				<div class="col-lg-4 aside">

					
					<div class="row top_choices mb-4">
			            <div class="col-12">
			              <div class="topSlider owl-carousel owl-theme">
			                @foreach($allCategories as $category)

			                <div class="box">
			                  <div class="header">
			                    <p>
			                      <i class="fas fa-medal"></i>
			                      {{ $category->name }} Category
			                    </p>
			                  </div>
			                  
			                  <div class="body media p-3 pt-3"> 
			                    <p class="b-f-p">
			                      {{ $category->description }}
			                    </p>
			                  </div>
			                </div>

			                @endforeach
			              </div>
			            </div>
			         </div>
				    

					<div class="box1">
					  {{--if Size 2 is 300*250 --}}

    					{!! adHelper(2) !!}
					</div>

					<div class="box2">
						{{--if Size 3 is 300*600 --}}

						{!! adHelper(3) !!}
					</div>
					
				</div>

			</div>
		</div>
	</section>

@stop
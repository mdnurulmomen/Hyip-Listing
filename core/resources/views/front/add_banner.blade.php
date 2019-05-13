
@extends('front.layout.app')
@section('contents')

	<section id="banner" class="breadcrumb" style="background: url({{  asset('assets/front/images/setting/'.$bannerSettings->banner_image) }}) no-repeat center;">
		<div class="container">
			<div class="row">
				<div class="banner-info">
					<div class="col-12">
						<h1>{{ $bannerSettings->banner_heading }}</h1>
					</div>
				</div>
			</div>
		</div>
	</section>

	<section class="home_main_content">
		<div class="container">
			<div class="row top_info">     
		        <div class="col-lg-12 col-xl-12 text-center">
		        
	              <div class="box-1" style="background: none;">
	              	{{--if Size 1 is 320 or Less --}}
                    {!! adHelper(1) !!}
	              </div>
		           
		        </div>        
	      	</div>


			<div class="row top_choices">
				<div class="col-lg-9">

					@if(session()->has('success'))
					    <div class="alert alert-success">
					        {{ session()->get('success') }}
					    </div>
					@endif

					@if(Session::has('errors'))
						<p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('errors') }}</p>
					@endif

					<div class="row" id="divAdPackages">

						@foreach($allAdPackages as $package)
						<div class="col-sm-6 col-lg-4"  onclick="showAdForm({{$package->id}})">
							<div class="box">
								<i class="fas fa-exchange-alt"></i>
								<h3>{{$package->name}}</h3>
								<p>
									Days : {{ $package->days }}
								</p>
								<p>
									Size Banner: {{ $package->adSize->name }}
								</p>
								<p>
									Expense: {{ $package->amount }}
								</p>
							</div>
						</div>
						@endforeach

					</div>

					<div class="row" id="divAdForm" style="display: none;">
						<div class="col-12">
							<div class="buyBanner">
								
								<div class="box">
									<div class="header d-flex justify-content-between">
										<p>
											<i class="fas fa-star"></i>
											Request for Banner
										</p>
									</div>

									<div class="buyBannrForm">
										<form method="POST" action = "{{ route('front.submit_banner') }}" enctype="multipart/form-data">
							                @csrf
							                <div class="form-row mb-4">
							                	 <input type="hidden" id="packageId" name="packageId" value="">
							                </div>
							                <div class="form-row mb-4">
							                    <div class="col-md-6">
							                        <label for="validationServer01">
							                        	Advertisement Type
							                        </label>
							                        <select name="type" class="form-control form-control-lg " required="true"> 
							                            <option selected="true" disabled="true">
							                            	--Please Select Ad Type--
							                            </option>

							                            <option value="banner" selected="true">
							                            	Banner
							                            </option>
							                            <!-- <option value="script">
							                            	Script
							                            </option> 
							                        	-->
							                        </select>
							                    </div>
							                    <div class="col-md-6">
							                        <label for="validationServer01">Advertisement Size</label>
							                        <select name="size" class="form-control form-control-lg " required="true">
							                            <option selected="true" disabled="true">--Please Select Ad Size--</option>
							                            @foreach($allAdSizes as $adSize)
							                            <option value="{{$adSize->id}}">
							                            	{{$adSize->name}}
							                            </option>
							                            @endforeach
							                        </select>
							                    </div>
							                </div>
							                
							                <div class="form-row mb-4" id="bannerDiv">
							                    <div class="col-md-4">
							                        <label for="validationServer02">Select Advertisement Url</label>
							                        <input type="url" name="url" class="form-control form-control-lg"  placeholder="Ad Url" required="true">
							                    </div>
							                    <div class="col-md-4">
							                        <label for="validationServer02">Upload Preview</label>
							                        <input type="file" name="preview" class="form-control  form-control-lg" accept="image/*" required="true">
							                    </div>
							                    <div class="col-md-4">
							                        <label for="validationServer02">Contact</label>
							                        <input type="text" name="contact_number" class="form-control form-control-lg"  placeholder="Contact Info" required="true">
							                    </div>
							                </div>

							                <br>

							                <div class="form-group row">
							                    <div class="col-sm-12">
							                    	@if(Auth::guard()->check())
							                        <button type="submit" class="btn btn-block btn-lg btn-primary">
							                        	Send
							                        </button>
							                        @else
							                        <p class="alert-danger">
							                        	Sorry, You have to Sign in to Send Advertisement 
							                        </p>
							                        @endif
							                    </div>
							                </div>
							            </form>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-lg-3 aside">

					<div class="row">
						<div class="col-12">
							<div class="addbanner_box">

								<div class="list">
                  					<ul>
									
										<li>

										{{--if Size 2 is 300*250 --}}

                        				{!! adHelper(2) !!}

										</li>

										<li>

										{{--if Size 3 is 300*600 --}}

										{!! adHelper(3) !!}

										</li>
									
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>


	<script type="text/javascript">

		function showAdForm(id){
			document.getElementById("divAdPackages").style.display = "none";
		 	document.getElementById("divAdForm").style.display = "block";
		 	document.getElementById("packageId").value = id;
		}

	</script>

	@stop
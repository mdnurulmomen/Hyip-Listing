
@extends('front.layout.app')
@section('contents')

	<section id="banner" class="breadcrumb" style="background: url({{  asset('assets/front/images/setting/'.$hyipSettings->hyip_image) }}) no-repeat center;">
		<div class="container">
			<div class="row">
				<div class="banner-info">
					<div class="col-12">
						<h1>{{ $hyipSettings->hyip_heading }}</h1>
					</div>
				</div>
			</div>
		</div>
	</section>

	<!-- Home Page Main Content Area Start -->
	<section class="home_main_content">
		<div class="container">
			<div class="row top_info">     
		        <div class="col-lg-12 col-xl-12 text-center">
		        
	              	{{--if Size 1 is 320 or Less --}}
                    {!! adHelper(1) !!}

		        </div>        
	      	</div>

			<div class="row top_choices addhype">
				<div class="col-lg-12">
					<div class="buyBanner">

						@if(session()->has('success'))
						    <div class="alert alert-success">
						        {{ session()->get('success') }}
						    </div>
						@endif

						@if(Session::has('errors'))
							<p class="alert {{ Session::get('alert-class', 'alert-danger') }}">{{ Session::get('errors') }}</p>
						@endif

						<div class="box">
							<div class="header">
								<p>
									<i class="fas fa-star"></i>
									Request for Hyip Adding
								</p>
							</div>

							<div class="buyBannrForm">
								<form method="POST" action = "{{ route('front.submit_hyip') }}" enctype="multipart/form-data">
					                @csrf
					                <div class="form-row">
					                    <div class="col-md-3">
					                        <label for="validationServer02">Category</label>
					                        <select name="categoryId" class="form-control form-control-lg " required="true">
					                            <option value="none" selected disabled="true">Please Select a Category</option>
					                            @foreach($allCategories as $category)
					                                <option value="{{ $category->id }}">{{ $category->name }}</option>
					                            @endforeach
					                        </select>
					                    </div>
					                    <div class="col-md-3">
					                        <label for="validationServer01">Hyip Name</label>
					                        <input type="text" name="name" class="form-control form-control-lg "  placeholder="Hyip Name" required="true">
					                    </div>
					                    <div class="col-md-3 mb-4">
					                        <label for="validationServer01">Hyip ROI</label>
					                        <input type="number" name="roi" class="form-control form-control-lg "  placeholder="Hyip Roi" required="true">
					                    </div>
					                    <div class="col-md-3 mb-4">
					                        <label for="validationServer02">Preview</label>
					                        <input type="file" name="preview" class="form-control  form-control-lg" accept="image/*" required="true">
					                    </div>
					                </div>
					                <br>
					                
					                <div class="form-row">
					                    <div class="col-md-4 mb-4">
					                        <label for="validationServer01">Total Investment:</label>
					                        <input type="number" name="totalInvestment" class="form-control form-control-lg "  placeholder="Total Investment" required="true">
					                    </div>
					                    <div class="col-md-4 mb-4">
					                        <label for="validationServer01">Withdrawal Type</label>
					                        <select name="withdrawalType" class="form-control form-control-lg " required="true">
					                            <option value="none" selected disabled="true">Please Select a Category</option>
					                            @foreach($allWithdrawalTypes as $withdrawType)
					                                <option value="{{ $withdrawType->id }}">{{ $withdrawType->name }}</option>
					                            @endforeach
					                        </select>
					                    </div>
					                    <div class="col-md-4 mb-4">
					                        <label for="validationServerUsername">Minimum Deposit</label>
					                        
					                            <!-- <div class="input-group-prepend">
					                                <span class="input-group-text">@ </span>
					                            </div> -->
					                            <input type="number" name="depositMin" class="form-control form-control-lg" placeholder="Minimum Deposit" required="true">
					                        
					                    </div>
					                </div>
					                <br>
					                <div class="form-row">
					                    <div class="col-md-4">
					                        <label for="validationServer02">Monitoring From</label>
					                        <input type="date" name="firstMonitored" class="form-control form-control-lg "  placeholder="Date">
					                    </div>
					                    <div class="col-md-4 mb-4">
					                        <label for="validationServer05">Total Monitored</label>
					                        <input type="number" name="numberOfMonitor" class="form-control form-control-lg " placeholder="Monitoring Time">
					                    </div>
					                    <div class="col-md-4">
					                        <label for="validationServer01">Last Payment</label>
					                        <input type="date" name="paymentLast" class="form-control form-control-lg "  placeholder="Last Disbursement" required="true">
					                    </div>
					                </div>
					                <br>

					                <div class="form-row">
					                    <div class="col-md-4 mb-4">
					                        <label for="validationServer05">Features</label>
					                        <div>
					                            @if($allFeatures->isEmpty())
					                                <div class="form-check-inline">  
					                                    <label>No Feature Available</label>
					                                </div>
					                            @else
					                                @foreach($allFeatures as $feature)
					                                    <div class="form-check-inline">  
					                                        <input type="checkbox" class="form-check-input" name="featureId[]" value="{{ $feature->id }}"> {{ $feature->name }}
					                                    </div>
					                                @endforeach
					                            @endif
					                        </div>
					                    </div>
					                    <div class="col-md-4">
					                        <label for="validationServer01">Accept</label>
					                        <div>
					                            @if($allPaymentMediums->isEmpty())
					                                <div class="form-check-inline">  
					                                    <label>No Payment Medium Available</label>
					                                </div>
					                            @else
					                                @foreach($allPaymentMediums as $medium)
					                                    <div class="form-check-inline">  
					                                        <input type="checkbox" class="form-check-input" name="mediumId[]" value="{{ $medium->id }}">{{ $medium->name }}
					                                    </div>
					                                @endforeach
					                            @endif
					                        </div>
					                    </div>
					                    <div class="col-md-4">
					                        <label for="validationServer01">Status</label>
					                        <select name="status" class="form-control form-control-lg " required="true">
					                            <option value="none" selected disabled="true">Please Select a Category</option>
					                            @foreach($allStatuses as $status)
					                                <option value="{{ $status->id }}">{{ $status->name }}</option>
					                            @endforeach
					                        </select>

					                    </div>
					                </div>
					                <br>
					                <div class="form-row">
					                    <div class="col-md-3">
					                        <label for="validationServer03">Online Days</label>
					                        <input type="number" name="onlineDays" class="form-control form-control-lg " placeholder="Online Days">
					                    </div>
					                    <div class="col-md-3">
					                        <label for="validationServer01">Rating</label>
					                        <input type="number" name="rating"  max="5" class="form-control form-control-lg "  placeholder="Rating in Five(5)" required="true">
					                    </div>
					                    <div class="col-md-3">
					                        <label for="validationServer01">Referral</label>
					                        <input type="number" name="referral" max="100" class="form-control form-control-lg"  placeholder="Percentage" required="true">
					                    </div>
					                    <div class="col-md-3">
					                        <label for="validationServer01">Contact</label>
					                        <input type="text" name="contact_number" class="form-control form-control-lg "  placeholder="Contact Info" required="true">
					                    </div>
					                </div>
					                <br>
					                <div class="form-row mb-5">
					                    <div class="col-md-12">
					                        <label for="validationServer02">Description</label>
					                        <textarea name="description" class="form-control" rows="5" id="textArea" required="true"></textarea>
					                    </div>
					                </div>
					                <div class="form-group row">
					                    <div class="col-sm-12">
					                        <button type="submit" class="btn btn-block btn-lg btn-primary">Send</button>
					                    </div>
					                </div>
					            </form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	
@stop
@extends('front.layout.app')
@section('contents')


  <!-- Home Page Banner Area Start -->
  <section id="banner" style="background: url({{  asset('assets/front/images/setting/'.$indexSettings->index_image) }}) no-repeat center;">
    <div class="container">
      <div class="row">
        <div class="banner-info">
          <div class="col-12">
            <span></span>
            <h1>{{ $indexSettings->index_heading }}</h1>
            <div class="links">
              <ul>

                <li>
                  <a href="{{ $indexSettings->learn_more_link }}" target="_blank">Learn More</a>
                </li>
                  
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Home Page Banner Area End -->

  <!-- Home Page Main Content Area Start -->
  <section class="home_main_content">
    <div class="container">

      <div class="row top_info">   
        <div class="col-lg-12 col-xl-12 text-center">
          
          {{--if Size 1 is 320 or Less --}}
          {!! adHelper(1) !!}
          
        </div>  
      </div>

      <div id="started"></div>

      <div class="row top_chart">
        <div class="col-lg-9">
          <div class="row">
            <div class="col-lg-12">
              @foreach($allCompanies as $company)
              <div class="box">
                <div class="header d-flex justify-content-between">
                  
                  <div class="col-3 text-left"> 
                    <h3>
                      <i class="fa fa-link"></i>
                      <a href="{{route('front.company_details', $company->id)}}">
                        {{$company->name}}
                      </a>
                    </h3>
                  </div>

                  <div class="col-4">
                    <p>Category : {{ $company->Category->name }} </p>
                  </div>

                  <div class="col-3 text-center">
                    <p style="background-color:{{$company->roi_color}}; padding: 2px;">
                      ROI : {{$company->roi}} %
                    </p>
                  </div>

                  <div class="col-2 text-center">
                    <p style="background-color:{{$company->status_color}}; padding: 2px;">
                      <i class="fa fas-calendar-check-o" aria-hidden="true"></i>
                      {{$company->status()->name}}
                    </p>
                  </div>

                </div>
                <div class="row">

                  <div class="col-2">
                    <div class="list">
                      <ul>
                        <li></li>
                        <li></li>
                        <li></li>
                        <li>
                          <img src="{{ asset('assets/front/images/company/'.$company->preview) }}">
                        </li>
                        <li></li>
                      </ul>
                    </div>
                  </div>

                  <div class="col-5">
                    <div class="list">
                      <ul>
                        <li class="d-flex justify-content-between">
                          <p>
                            Our Total Investment : 
                          </p>
                          <p>
                            {{ $company->total_investment }}
                          </p>
                        </li>

                        <li class="d-flex justify-content-between">
                            <p>
                              Referral: 
                            </p>
                            <p>
                              {{ $company->referral }}
                            </p>
                        </li>
                        
                        <li class="d-flex justify-content-between">
                            <p>
                              Withdrawal Type: 
                            </p>
                            <p>
                              {{ $company->withdrawalType->name }}
                            </p>
                        </li> 
                       
                        <li class="d-flex justify-content-between"> 
                            <p>
                              Minimal Deposit: 
                            </p>
                            <p>
                              {{ $company->deposit_min }}
                            </p>
                        </li>
                         
                        <li class="d-flex justify-content-between">
                            <p>
                              Last Payout: 
                            </p>
                            <p>
                              {{ $company->payment_last }}
                            </p>
                        </li>
                        
                        <li class="d-flex justify-content-between">
                            <p>
                              Our Rating: 
                            </p>
                            <p>
                              {{ $company->rating }}
                            </p>
                        </li>

                        <li class="d-flex justify-content-between">
                            <p>
                              Accept 
                            </p>
                            <p>
                              @foreach($company->paymentMediums() as $medium)
                                <img src="{{ asset('assets/admin/images/payment_medium/'.$medium->logo) }}" title="Features" height="16" width="16">
                              @endforeach
                            </p>
                        </li>

                      </ul>
                    </div>
                  </div>

                  <div class="col-5">
                    <div class="list">
                      <ul>
                        <li class="d-flex justify-content-between">
                            <p>
                              Monitor Since:
                            </p>
                            <p>
                              {{ $company->first_monitored }}
                            </p>
                        </li>
                         
                        <li class="d-flex justify-content-between"> 
                            <p>
                              Online Days: 
                            </p>
                            <p>
                              {{ $company->online_days }}
                            </p>
                        </li>
                        
                        <li class="d-flex justify-content-between"> 
                            <p>
                              Monitored: 
                            </p>
                            <p>
                              {{ $company->number_monitor }}
                            </p>
                        </li> 
                         
                        <li class="d-flex justify-content-between">
                            <p>
                              Vote:
                            </p>
                            <p>
                              😀 {{ $company->vote->very_good ?? 0 }}
                              
                              😊 {{ $company->vote->good ?? 0 }} 
                              
                              😐 {{ $company->vote->neutral ?? 0}} 
                              
                              😢 {{ $company->vote->bad ?? 0}} 
                            </p>
                        </li>
                          
                        <li class="d-flex justify-content-between">
                            <p>
                              Last Payout: 
                            </p>
                            <p>
                              {{ $company->payment_last }}
                            </p>
                        </li>

                        <li class="d-flex justify-content-between">
                            <p>
                              Our Rating: 
                            </p>
                            <p>
                              {{ $company->rating }}
                            </p>
                        </li>
                          
                        <li class="d-flex justify-content-between">   
                            <p>
                              Features 
                            </p>
                            <p>
                              @foreach($company->features() as $feature)
                                  <img src="{{ asset('assets/admin/images/feature/'.$feature->logo) }}" title="Features" height="16" width="16">
                              @endforeach
                            </p>
                        </li> 
                         
                      </ul>
                    </div>
                  </div>
                  
                </div>
              </div>
              @endforeach
            </div>
            
          </div>
        </div>
        <div class="col-lg-3 aside">
          

          <div class="row">
            <div class="col-lg-12">
              <div class="box">
                
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

          {{--
          <div class="row">
            <div class="col-lg-12">
              <div class="box box2 emoje">
                <div class="header d-flex justify-content-between">
                  <p>
                    <i class="fa fa-users"></i>
                    Votes
                  </p>
                </div>
                <div class="list">

                  <ul>
                    <li>
                      <a href="#" class="d-flex">
                        😀 
                        <div class="content d-flex align-self-center">
                          <p>Excited</p>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="d-flex">
                        😊
                        <div class="content align-self-center">
                          <p> Happy</p>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="d-flex">
                        😐
                        <div class="content align-self-center">
                          <p> Neutral</p>
                        </div>
                      </a>
                    </li>
                    <li>
                      <a href="#" class="d-flex">
                        😢
                        <div class="content align-self-center">
                          <p> Sad</p>
                        </div>
                      </a>
                    </li>
                  </ul>

                </div>
              </div>
            </div>
          </div>
          --}}

          
        </div>
      </div>


      
      <div class="row mt-5">
        <div class="col-12 text-center">  
            {{--if Size 4 is 720 --}}
            {!! adHelper(1) !!} 
        </div>
      </div>

    </div>
  </section>
  @stop
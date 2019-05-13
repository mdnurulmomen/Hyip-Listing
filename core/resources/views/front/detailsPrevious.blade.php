@extends('front.layout.app')
@section('contents')


  <div class="companyList">   
    <div class="row">
      <div class="col-3 text-left">
        {{$companyToDescribe->name}}
      </div>

      <div class="col-4 text-center">
        ROI : {{$companyToDescribe->roi}}
      </div>

      <div class="col-4 text-right">
        {{$companyToDescribe->status()->name}}
      </div>
    </div>

    <div class="row mt-1">
      <div class="col-2">
        <img src="{{asset('assets/front/images/company/'.$companyToDescribe->preview)}}" class="img-thumbnail" alt="image">
      </div>
      <div class="col-3"> 
        <p>Our Total Investment : {{ $companyToDescribe->total_investment }}</p>
        <p>Referral: {{ $companyToDescribe->referral }}</p>
        <p>Withdrawal: {{ $companyToDescribe->withdrawal_type }}</p>
        <p>Minimal Deposit: {{ $companyToDescribe->deposit_min }}</p>
        <p>Last Payout: {{ $companyToDescribe->payment_last }}</p>
        <p>Our Rating: {{ $companyToDescribe->rating }}</p>
      </div>
      <div class="col-3">
        <p>Monitor Since: {{ $companyToDescribe->first_monitored }}</p>
        <p>Online Days: {{ $companyToDescribe->online_days }}</p>
        <p>Monitored: {{ $companyToDescribe->number_monitor }}</p>
        <p>
          Vote:
          <i class="fa fa-smile-o" aria-hidden="true"></i> {{ $companyToDescribe->vote->very_good ?? ''}} 
          <i class="fa fa-smile-o" aria-hidden="true"></i> {{ $companyToDescribe->vote->good ?? ''}} 
          <i class="fa fa-frown-o" aria-hidden="true"></i> {{ $companyToDescribe->vote->neutral ?? ''}} 
          <i class="fa fa-frown-o" aria-hidden="true"></i> {{ $companyToDescribe->vote->bad ?? ''}} 

        </p>
        <p>
          Features:

          @foreach($companyToDescribe->features() as $feature)
            {{ $feature->name }},
          @endforeach
        </p>
        
        <p>
          Accept: 
          @foreach($companyToDescribe->paymentMediums() as $medium)
            {{ $medium->name }},
          @endforeach
        </p>
      </div>
      <div class="col-4">  
        <ul class="col-menu">
          <li>
            <a class="detail" href="{{ route('front.company.details', $companyToDescribe->id) }}" target="_blank">
              Program Details
            </a>
          </li>

          <li>
            <a class="scam" href="">Report Scam</a>
          </li>

          <li>
            <a class="payout" href="">Vote Now</a>
          </li>

          <li>
            <a class="traffic" href="">Monitor Code</a>
          </li>

          <li>
            <a href="" class="rcb">Bookmark</a>
          </li>
        </ul>
      </div>
    </div>
  </div>

  <div class="site-about-text">
    <div class="row mt-2">
      {{ $companyToDescribe->description }}
    </div> 
  </div>

  @stop
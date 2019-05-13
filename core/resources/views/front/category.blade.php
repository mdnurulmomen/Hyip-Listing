@extends('front.layout.app')
@section('contents')

@foreach($allCompanies as $company)
  <div class="companyList">   
    <div class="row">
      <div class="col-3 text-left">
        {{$company->name}}
      </div>

      <div class="col-4 text-center ">
        ROI : {{$company->roi}}
      </div>

      <div class="col-4 text-right">
        {{$company->status()->name}}
      </div>
    </div>

    <div class="row mt-1">
      <div class="col-2">
        <img src="{{asset('assets/front/images/company/'.$company->preview)}}" class="img-thumbnail" alt="image">
      </div>
      <div class="col-3"> 
        <p>Our Total Investment : {{ $company->total_investment }}</p>
        <p>Referral: {{ $company->referral }}</p>
        <p>Withdrawal: {{ $company->withdrawal_type }}</p>
        <p>Minimal Deposit: {{ $company->deposit_min }}</p>
        <p>Last Payout: {{ $company->payment_last }}</p>
        <p>Our Rating: {{ $company->rating }}</p>
      </div>
      <div class="col-3">
        <p>Monitor Since: {{ $company->first_monitored }}</p>
        <p>Online Days: {{ $company->online_days }}</p>
        <p>Monitored: {{ $company->number_monitor }}</p>
        <p>
          Vote:
          <i class="fa fa-smile-o" aria-hidden="true"></i> {{ $company->vote->very_good ?? ''}} 
          <i class="fa fa-smile-o" aria-hidden="true"></i> {{ $company->vote->good ?? ''}} 
          <i class="fa fa-frown-o" aria-hidden="true"></i> {{ $company->vote->neutral ?? ''}} 
          <i class="fa fa-frown-o" aria-hidden="true"></i> {{ $company->vote->bad ?? ''}} 

        </p>
        <p>
          Features:

          @foreach($company->features() as $feature)
            {{ $feature->name }},
          @endforeach
        </p>
        
        <p>
          Accept: 
          @foreach($company->paymentMediums() as $medium)
            {{ $medium->name }},
          @endforeach
        </p>
      </div>
      <div class="col-4">
        
        <ul class="col-menu">
          <li>
            <a class="detail" href="{{ route('front.company.details', $company->id) }}" target="_blank">
              Program Details
            </a>
          </li>

          <li>
            <a class="scam" href="/report_scam/lid/10816">Report Scam</a>
          </li>

          <li>
            <a class="payout" href="/add_vote/lid/10816">Vote Now</a>
          </li>

          <li>
            <a class="traffic" href="/get_code/lid/10816">Monitor Code</a>
          </li>

          <li>
            <a href="https://list4hyip.com/bookmarks/action/add/lid/10816/" class="rcb">Bookmark</a>
          </li>
          
        </ul>

      </div>
    </div>
  </div>
  @endforeach

  @stop
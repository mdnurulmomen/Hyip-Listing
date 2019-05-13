@extends('admin.layout.app')
@section('contents')
    <div class="app-title">
        <div>
          <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item"><a href="{{ route('admin.home') }}">Dashboard</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6 col-lg-3">
            
          <a href="{{route('admin.view_companies_published')}}">
            <div class="widget-small primary coloured-icon">
              <i class="icon fa fa-building-o fa-3x"></i>
              <div class="info">
                <h4>Hyips</h4>
                <p><b>{{ $totalHyips }}</b></p>
              </div>
            </div>
          </a>
            
        </div>

        <div class="col-md-6 col-lg-3">
          <a href="{{route('admin.view_features')}}">
            <div class="widget-small info coloured-icon">
              <i class="icon fa fa-braille fa-3x"></i>
              <div class="info">
                <h4>Features</h4>
                <p><b>{{ $totalFeatures }}</b></p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-6 col-lg-3">

          <a href="{{route('admin.view_payments_mediums')}}">
            <div class="widget-small warning coloured-icon"><i class="icon fa fa-cc-mastercard fa-3x"></i>
              <div class="info">
                <h4>Payment Mediums</h4>
                <p><b>{{ $totalPaymentMediums }}</b></p>
              </div>
            </div>
          </a>
        </div>

        <div class="col-md-6 col-lg-3">
          <a href="{{route('admin.view_published_advertisements')}}">
            <div class="widget-small danger coloured-icon"><i class="icon fa fa-film fa-3x"></i>
              <div class="info">
                <h4>Ads</h4>
                <p><b>{{ $totalAds }}</b></p>
              </div>
            </div>
          </a>
        </div>

    </div>
    




   

    {{--
    <div class="row">
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Monthly Sales</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="lineChartDemo"></canvas>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="tile">
            <h3 class="tile-title">Support Requests</h3>
            <div class="embed-responsive embed-responsive-16by9">
              <canvas class="embed-responsive-item" id="pieChartDemo"></canvas>
            </div>
          </div>
        </div>
    </div>
    --}}
      

    <script type="text/javascript" src="{{ asset('assets/admin/js/chart.js')}}"></script>

    <script type="text/javascript">
      var data = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [
          {
            label: "My First dataset",
            fillColor: "rgba(220,220,220,0.2)",
            strokeColor: "rgba(220,220,220,1)",
            pointColor: "rgba(220,220,220,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(220,220,220,1)",
            data: [65, 59, 80, 81, 56]
          },
          {
            label: "My Second dataset",
            fillColor: "rgba(151,187,205,0.2)",
            strokeColor: "rgba(151,187,205,1)",
            pointColor: "rgba(151,187,205,1)",
            pointStrokeColor: "#fff",
            pointHighlightFill: "#fff",
            pointHighlightStroke: "rgba(151,187,205,1)",
            data: [28, 48, 40, 19, 86]
          }
        ]
      };
      var pdata = [
        {
          value: 300,
          color: "#46BFBD",
          highlight: "#5AD3D1",
          label: "Complete"
        },
        {
          value: 50,
          color:"#F7464A",
          highlight: "#FF5A5E",
          label: "In-Progress"
        }
      ]
      
      var ctxl = $("#lineChartDemo").get(0).getContext("2d");
      var lineChart = new Chart(ctxl).Line(data);
      
      var ctxp = $("#pieChartDemo").get(0).getContext("2d");
      var pieChart = new Chart(ctxp).Pie(pdata);
    </script>
    
    <!-- Google analytics script-->
    <script type="text/javascript">
      if(document.location.hostname == 'pratikborsadiya.in') {
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
        ga('create', 'UA-72504830-1', 'auto');
        ga('send', 'pageview');
      }
    </script>    

    <script>
        function backgroundColor () {
            var inputSelected = document.getElementsByName("color")[0];
            inputSelected.style.backgroundColor = document.getElementsByName("color")[0].value;
        }
    </script>
@stop
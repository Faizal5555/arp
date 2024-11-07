@extends('layouts.master')

<style>
  .card .card-body {
    padding: 1rem 1rem !important;
}
</style>



@section('content')

{{-- daterange picker cdn --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


{{-- for chartjs --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Account Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
             {{-- date range picker --}}
            <div class="row mb-4">
              <div class="col-md-12 d-flex align-items-center">
                <label class="start_1" style="margin-right:13px; font-size:15px; margin-left:46px;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color:#5c4949;">Date:</label>
                <input type="text" name="RFQs" class="won_project " value="" id="daterange" style="max-width: 100%; max-height: 100%;  padding:auto; margin-top:-7px;  border-color: #237ee6 !important;">  
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-normal mb-3">Total Client Invoice Pending<i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5" id="client_pending">{{$total_client_invoice_pendig ? $total_client_invoice_pendig :0 }}</h2>
                    <h5 class="card-text">$  <span id="usd"></span></h5>
                    <h5 class="card-text">₹  <span id="inr"></span></h5>
                    <h5 class="card-text">€  <span id="euro"></span></h5>
                    <h5 class="card-text">£ <span id="pound"></span></h5>
                    
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-normal mb-3">Total Vendor Invoice Pending<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5" id="vendor_pending">{{$total_vendor_invoice_pending ? $total_vendor_invoice_pending :0 }}</h2>
                    <h5 class="card-text">$  <span id="usd1"></span></h5>
                    <h5 class="card-text">₹  <span id="inr1"></span></h5>
                    <h5 class="card-text">€  <span id="euro1"></span></h5>
                    <h5 class="card-text">£  <span id="pound1"></span></h5>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-normal mb-3">Total Payment Awaited<i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5" id="awaited">{{$total_client_invoice_awaited ? $total_client_invoice_awaited : 0 }} </h2>
                    <!--<h6 class="card-text">Increased by 5%</h6>-->
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
                
                <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-normal mb-3">Total Client Payment Received<i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5" id="Total_Client_Payment_Received">{{$total_client_invoice_pendig ? $total_client_invoice_pendig :0 }}</h2>
                    <h5 class="card-text">$  <span id="tcr_usd"></span></h5>
                    <h5 class="card-text">₹  <span id="tcr_inr"></span></h5>
                    <h5 class="card-text">€  <span id="tcr_euro"></span></h5>
                    <h5 class="card-text">£  <span id="tcr_pound"></span></h5>
                    
                  </div>
                </div>
              </div>
              
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-normal mb-3">Total Vendor Payment Made<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5" id="Total_Vendor_Payments_Received">{{$total_vendor_invoice_pending ? $total_vendor_invoice_pending :0 }}</h2>
                    <h5 class="card-text">$  <span id="tvr_usd"></span></h5>
                    <h5 class="card-text">₹  <span id="tvr_inr"></span></h5>
                    <h5 class="card-text">€  <span id="tvr_euro"></span></h5>
                    <h5 class="card-text">£  <span id="tvr_pound"></span></h5>
                  </div>
                </div>
              </div>
            </div>
              
            <br>
            
            <!--for chart-->
            <!-- <div class="card mb-3">-->
            <!--  <div class="col-md-12">-->
            <!--      <div class="canvas_append">-->
            <!--        <canvas id="bar_chart" style="width:100% !important; height:400; " ></canvas>-->
            <!--    </div>-->
            <!--    </div>-->
            <!--</div>-->
        
           
         </div>
 <script>
 $(document).ready(function(){
      var start_date = moment().format('YYYY-MM-DD');
      var end_date = moment().format('YYYY-MM-DD');
  
      chart(start_date,end_date)   
  });
 $(document).ready(function(){
    $('#bar_chart').remove();
          $('.canvas_append').html(' <canvas id="bar_chart"  style="width:100% !important; hight:100% !important" ></canvas>');

          var ctx = document.getElementById('bar_chart').getContext('2d');

          var myChart = new Chart(ctx, {
             type: 'bar',
             data: {
                 labels: [ 'Client Invoice Pendig ', 'Vendor Invoice Pending ','Payment Awaited'],
                 datasets: [{
                     data:[{{$total_client_invoice_pendig}},{{$total_vendor_invoice_pending}},{{$total_client_invoice_awaited}}],
                     backgroundColor: [
                         '#F0B27A',
                         '#5DADE2',
                         '#82E0AA'
                     ],
                     borderColor: [
                         '#0056b3',
                         '#0056b3',
                         '#0056b3'
   
                     ],
                     borderWidth: 0.5
                 }]
             },
             options: {
                legend: {
                  display: false
                },
                 scales: {
                  xAxes: [{ barPercentage: 0.3 }],
                  yAxes: [{
                  ticks: {
                  beginAtZero: true
                    }
                    }]
                 }
               }
              
           });
  });

 
  function chart(start_date,end_date){
    // alert(start_date);
    $.ajax({
      url:"{{route('accounts.overview1')}}",
       type:"post",
       data:{start_1:start_date,end_1:end_date},   
       success:function(data){
        // console.log(data);
           $("#client_pending").html(data.total_client_invoice_pendig);
           $("#vendor_pending").html(data.total_vendor_invoice_pending);
           $("#awaited").html(data.total_client_invoice_awaited);
           $("#inr").html(data.inr);
           $("#usd").html(data.usd);
           $("#euro").html(data.euro);
           $("#pound").html(data.pound);
           $("#inr1").html(data.inr1);
           $("#usd1").html(data.usd1);
           $("#euro1").html(data.euro1);
           $("#pound1").html(data.pound1);
           $("#Total_Client_Payment_Received").html(data.TCPR);
           $("#tcr_inr").html(data.tcr_inr);
           $("#tcr_usd").html(data.tcr_usd);
           $("#tcr_euro").html(data.tcr_euro);
           $("#tcr_pound").html(data.tcr_pound);
          $("#Total_Vendor_Payments_Received").html(data.TVPR);
           $("#tvr_inr").html(data.tvr_inr);
           $("#tvr_usd").html(data.tvr_usd);
           $("#tvr_euro").html(data.tvr_euro);
           $("#tvr_pound").html(data.tvr_pound);
       }
    })
  }
  $(function() {
    $('input[name="RFQs"]').daterangepicker({
      "showDropdowns": true,
      ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'Last 45 Days': [moment().subtract(44, 'days'), moment()],
            'Last 60 Days': [moment().subtract(59, 'days'), moment()],
            'Last 90 Days': [moment().subtract(89, 'days'), moment()],
            'Last year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
      },
      opens: 'right'
    }, 
    function(start, end, label) {
      // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      chart(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'))  
    });
  });

</script>
@endsection
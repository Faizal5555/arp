@extends('layouts.master')

<style>
/* Modern Corporate Dashboard Styles */
.dashboard-card {
    transition: all 0.3s ease-in-out;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    color: white;
    font-size: 16px;
    font-weight: bold;
    min-width: 220px;
    min-height: 180px; /* Uniform height */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    position: relative;
}

/* Updated Solid Background Colors */
.bg-client { background-color: #3d83cb; } /* Blue */
.bg-margin { background-color: #F39C12; } /* Orange */
.bg-revenue { background-color: #16a085; } /* Cyan */
.bg-vendor { background-color: #6F42C1; } /* Purple */
.bg-pending { background-color: #3d83cb; } /* Green */
.bg-payment { background-color: #343A40; } /* Dark Gray */

/* Icons */
.dashboard-icon {
    font-size: 40px;
    margin-bottom: 12px;
}

/* Hover Effect */
.dashboard-card:hover {
    transform: translateY(-5px);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
}

/* Card Footer (for currency details) */
.card-footer {
    width: 90%;
    padding: 10px;
    background: rgba(255, 255, 255, 0.15);
    border-radius: 8px;
    font-size: 14px;
    font-weight: 500;
    text-align: center;
    margin-top: 10px;
}

/* Row Fix for Equal Height */
.row .col-md-4 {
    display: flex;
    align-items: stretch;
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
            <span class="page-title-icon bg-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span> Account Dashboard
        </h3>
    </div>

    <!-- Date Range Picker -->
    <div class="row mb-4">
        <div class="col-md-4 d-flex align-items-center">
            <label class="mr-2" style="font-weight: bold;">Date:</label>
            <input type="text" name="RFQs" class="form-control" id="daterange" style="border-color: #237ee6;">
        </div>
    </div>

    <!-- Dashboard Cards -->
    <div class="row">
        <div class="col-md-4">
            <div class="dashboard-card bg-pending">
                <i class="mdi mdi-chart-line dashboard-icon"></i>
                <h5>Total Client Invoice Pending</h5>
                <h2 id="client_pending">{{$total_client_invoice_pendig ?? 0}}</h2>
                <div class="card-footer">
                    $<span id="usd"></span> | ₹<span id="inr"></span> | €<span id="euro"></span> | £<span id="pound"></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card bg-vendor">
                <i class="mdi mdi-store dashboard-icon"></i>
                <h5>Total Vendor Invoice Pending</h5>
                <h2 id="vendor_pending">{{$total_vendor_invoice_pending ?? 0}}</h2>
                <div class="card-footer">
                    $<span id="usd1"></span> | ₹<span id="inr1"></span> | €<span id="euro1"></span> | £<span id="pound1"></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card bg-payment">
                <i class="mdi mdi-cash-multiple dashboard-icon"></i>
                <h5>Total Payment Awaited</h5>
                <h2 id="awaited">{{$total_client_invoice_awaited ?? 0}}</h2>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <div class="col-md-4">
            <div class="dashboard-card bg-margin">
                <i class="mdi mdi-cash-multiple dashboard-icon"></i>
                <h5>Total Client Payment Received</h5>
                <h2 id="Total_Client_Payment_Received">{{$Total_Client_Payment_Received ?? 0}}</h2>
                <div class="card-footer">
                    $<span id="tcr_usd"></span> | ₹<span id="tcr_inr"></span> | €<span id="tcr_euro"></span> | £<span id="tcr_pound"></span>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card bg-revenue">
                <i class="mdi mdi-currency-usd dashboard-icon"></i>
                <h5>Total Vendor Payment Made</h5>
                <h2 id="Total_Vendor_Payments_Received">{{$total_vendor_invoice_pending ?? 0}}</h2>
                <div class="card-footer">
                    $<span id="tvr_usd"></span> | ₹<span id="tvr_inr"></span> | €<span id="tvr_euro"></span> | £<span id="tvr_pound"></span>
                </div>
            </div>
        </div>
    </div>
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
           $("#Total_Client_Payment_Received").html(data.tcpr_count);
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
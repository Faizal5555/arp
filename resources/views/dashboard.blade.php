<?php
 
$dataPoints = array(
	array("label"=> "Week 1", "y"=> 20),
	array("label"=> "Week 2", "y"=> 65),
	array("label"=> "Week 3", "y"=> 11),
	array("label"=> "Week 4", "y"=> 5),
	array("label"=> "Week 5", "y"=> 48),
	array("label"=> "Week 6", "y"=> 8),
	array("label"=> "Week 7", "y"=> 2),
	array("label"=> "Week 8", "y"=> 18)
);
 
?>

@extends('layouts.master')

@section('content')
<!--<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>-->

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  {{-- for chartjs --}}

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
  window.onload = function () {
   
    var chart = new CanvasJS.Chart("chartContainer", {
      title: {
        text: ""
      },
      axisX: {
        title:"Won Project of Vendor"
        
      },
      axisY: {
        title:"Won Project of Client",
        minimum: 0,
        maximum: 100,
        suffix: "days"
      },
      data: [{
        type: "column",
        yValueFormatString: "#,##0.00\"%\"",
        indexLabel: "{y}",
        dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
      }]
    });
   
    function updateChart() {
      var color,deltaY, yVal;
      var dps = chart.options.data[0].dataPoints;
      for (var i = 0; i < dps.length; i++) {
        deltaY = (2 + Math.random() * (-2 - 2));
        yVal =  Math.min(Math.max(deltaY + dps[i].y, 0), 90);
        color = yVal > 75 ? "#fed713" : yVal >= 50 ? "#1bcfb4" : yVal < 50 ? "#fe7c96" : null;
        dps[i] = {label: "Week "+(i+1) , y: yVal, color: color};
      }
      chart.options.data[0].dataPoints = dps;
      chart.render();
    };
    updateChart();
   
    setInterval(function () { updateChart() }, 1000);
   
  }
</script>

<script>
  $(document).ready(function(){
    var startDate = moment().format('YYYY-MM-DD');
    var endDate = moment().format('YYYY-MM-DD');
  
    RFQs(startDate,endDate)   
  });

  function RFQs(start_date,end_date)
     {
       // alert(start_date);
      //  alert(end_date);
       $.ajax({ 
         url:"{{route('Overview_chart')}}",
         type:"POST",
         data:{start_1:start_date,
           end_1:end_date
         },
         success:function(data){
           console.log(data);
             $(".TotalMarginValue").html(data.sum);
             $(".TotalClient").html(data.client_1);
             $(".TotalVendor").html(data.vendor_1);
             $(".RFQS_Bid_count").html(data.RFQS_Bid_count);
             $(".TotalLost").html(data.lost);
             $(".TotalWonProjects").html(data.won_project_count);
             $(".PendingFollowUp").html(data.next);
             $("#k1").html(data.RFQS_Bid_count);
             $("#k2").html(data.Total_Won_Projects);
             $("#k3").html(data.Total_Margin_Value);
             $("#k4").html(data.client_t);
             $("#k5").html(data.vendor_t);
             $("#k6").html(data.Total_Invoice_Value);
             $(".total_usd").html(data.total_usd);
             $(".total_inr").html(data.total_inr);
             $(".total_euro").html(data.total_euro);
             $(".total_pound").html(data.total_pound);
             $(".revenue_usd").html(data.revenue_usd);
             $(".revenue_inr").html(data.revenue_inr);
             $(".revenue_euro").html(data.revenue_euro);
             $(".revenue_pound").html(data.revenue_pound);
             
              
            
    
   
          $('#bar_chart').remove();
          $('.canvas_append').html(' <canvas id="bar_chart" class="chartjs-render-monitor" style="width:100% !important;" ></canvas>');
   
          var ctx = document.getElementById('bar_chart').getContext('2d');
          
          
           var myChart = new Chart(ctx, {
             type: 'bar',
             data: {
                 labels: [ 'Client Invoice Value ', 'Vendor Invoice Value ', 'Total Margin Value'],
                 datasets: [{
                     label:'Invoices',
                     data:[data.client_1,data.vendor_1,data.sum],
                     backgroundColor: [
                         '#0056b3',
                         '#0056b3',
                         '#0056b3'
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
                 scales: {
                  xAxes: [{ barPercentage: 0.3 }],
                     y: {
                         beginAtZero: true
                     }
                 }
               }
              
           });
           $('.client-invoice').html(data.client_1);
              $('.vendor-invoice').html(data.vendor_1);
              $('.total-margin').html(data.sum);
              

           
      // myChart.destroy();
          $('#bar_chart_1').remove();
          $('.barChartAppend').html('<canvas id="bar_chart_1" style="width:200;height:200px;"></canvas>');
          var ctx1= document.getElementById('bar_chart_1').getContext('2d');

          new Chart(document.getElementById("bar_chart_1"),{
            type: 'doughnut',
            data:{
            labels:["Total Won Projects","Pending Follow Up","Total Projects Lost"],
            datasets:[{
            // label:["Total Invoice Value"],
            backgroundColor:[ 
                  '#0c5ebb',
                    '#c4c452','#ca575b'],
              borderWidth: 0.5,
            data:[data.won_project_count,data.next,data.lost]
        }]
}
});

    $('.won').html(data.won_project_count);
    $('.next').html(data.next);
    $('.lost').html(data.lost);
    

         }  
       })
     }
</script>
  <script>
    // RFQs
   $(function() {
     $('input[name="RFQs"]').daterangepicker({
       "showDropdowns": true,
       ranges: {
           'Today': [moment(), moment()],
           'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
           'Last 7 Days': [moment().subtract(6, 'days'), moment()],
           'Last 30 Days': [moment().subtract(29, 'days'), moment()],
           'This Month': [moment().startOf('month'), moment().endOf('month')],
           'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
       },
       opens: 'right'
     }, 
     function(start, end, label) {
       // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
       RFQs(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'))   
     });
   
   });
   
   </script>

   
<div class="content-wrapper">
            <div class="row" id="proBanner">
              <div class="col-12">
                <span class="d-flex align-items-center ">
                  {{-- <p>Get tons of UI components, Plugins, multiple layouts, 20+ sample pages, and more!</p> --}}
                  <a href="https://www.bootstrapdash.com/product/purple-bootstrap-admin-template?utm_source=organic&utm_medium=banner&utm_campaign=free-preview" target="_blank"></a>
                  <i class="" id="bannerClose"></i>
                </span>
              </div>
            </div>
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    {{-- <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i> --}}
                  </li>
                </ul>
              </nav>
            </div>
            {{-- daterange --}}
            <div class="row mb-5" >
              <div class="col-md-12 d-flex align-items-center">
                <label class="start_1" style="margin-right:13px; font-size:15px; margin-left:46px;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color:#5c4949;">Date:</label>
                <input type="text" name="RFQs" class="won_project " value="" id="daterange" style="max-width: 100%; max-height: 100%;  padding:auto; margin-top:-7px;   border-color: #237ee6 !important;">  
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total RFQ Bid <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5" id="k1">{{$bidrfq1 ? $bidrfq1:0}}</h2>
                    {{-- <h6 class="card-text">Increased by 60%</h6> --}}
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Won Projects<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5" id="k2">{{$won_project ? $won_project:0}}</h2>
                    {{-- <h6 class="card-text">Decreased by 10%</h6> --}}
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                   <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3" >Total Client<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5" id="k4">{{$client ? $client : 0}}</h2>
                    {{-- <h6 class="card-text">Decreased by 10%</h6> --}}
                  </div>
                </div>
              </div>
            </div>
            
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Margin <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5" id="k3">{{$totalmargin ? $totalmargin : 0}}</h2>
                    <h5 class="card-text">$<span class="total_usd"></span></h5>
                    <h5 class="card-text">₹<span class="total_inr"></span></h5>
                    <h5 class="card-text">€<span class="total_euro"></span></h5>
                    <h5 class="card-text">£<span class="total_pound"></span></h5>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success  card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Revenue  <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5" id="k6">{{$totalrevenue ? $totalrevenue : 0}}</h2>
                    <h5 class="card-text">$<span class="revenue_usd"></span></h5>
                    <h5 class="card-text">₹<span class="revenue_inr"></span></h5>
                    <h5 class="card-text">€<span class="revenue_euro"></span></h5>
                    <h5 class="card-text">£<span class="revenue_pound"></span></h5>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total Vendor <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5" id="k5">{{$vendor ? $vendor : 0}}</h2>
                    {{-- <h6 class="card-text">Increased by 60%</h6> --}}
                  </div>
                </div>
              </div>
            </div>
            
            


       <!--   {{-- chart --}}-->
       <!--<div class="card">-->
       <!--   <div class="col-md-12">-->
       <!--     <div class="chart-container" style="position:relative;width:80%;height:100% !important;  margin: 20px 0px 10px 50px !important;">-->

       <!--       <div class="canvas_append">-->
       <!--         <div class="col-md-8">-->
       <!--         <canvas id="bar_chart" class="chartjs-render-monitor" style="width:100% !important; height:100% !important; margin: 20px 0px 10px 50px !important;  " ></canvas>-->
       <!--       </div>-->
       <!--     </div>-->
       <!--     </div>-->
       <!--   </div>-->
       <!-- </div>-->
       <!-- {{--end chart --}}-->

            
      
            <!--<div class="row">-->
            <!--  <div class="col-md-7 grid-margin stretch-card">-->
            <!--    <div class="card">-->
            <!--      <div class="card-body">-->
            <!--        <div class="clearfix">-->
            <!--          <h4 class="card-title float-left">Visit And Sales Statistics</h4>-->
            <!--          <div id="visit-sale-chart-legend" class="rounded-legend legend-horizontal legend-top-right float-right"></div>-->
            <!--        </div>-->
            <!--        <div id="chartContainer" style="height: 370px; width: 100%;"></div>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--  <div class="col-md-5 grid-margin stretch-card">-->
            <!--    <div class="card">-->
            <!--      <div class="card-body">-->
            <!--        <h4 class="card-title">Traffic Sources</h4>-->
            <!--        <canvas id="traffic-chart"></canvas>-->
            <!--        <div id="traffic-chart-legend" class="rounded-legend legend-vertical legend-bottom-left pt-4"></div>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->
            
      <!--        <div class="row mt-4">-->
      <!--      <div class="container d-flex flex-wrap">-->
      <!--      <div class="col-md-6 col-sm-12 card mt-2 mb-2 pr-0 pl-0">-->
      <!--        <div class="" id="default_chart" style="height:100%;">-->
      <!--         <div class="title text-center" style="margin-top: 24px">-->
      <!--          <label style="font-size:15px;">TOTAL COUNT</label>-->
      <!--        </div>-->
      <!--          <div class="barChartAppend"> -->
      <!--          <canvas id="bar_chart_1" style="width:100;height:100%;"></canvas>-->
      <!--          </div>-->
      <!--        </div>-->
      <!--      </div>-->
      <!--      <div class="col-md-6 col-sm-12">-->
      <!--        <div class="types-couont" style="margin-top:15px;">-->
      <!--          <div class="row">-->
      <!--        <div class="col-md-8 col-sm-12">-->
      <!--          <div class="my-client" style="background-color: #0c5ebb !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px;">-->
      <!--            <h5>Total Won Project </h5>-->
      <!--           <h2> <label for="" class="won">{{$won ? $won : 0}}</label></h2>-->
      <!--          </div>-->
      <!--        </div>-->
      <!--        </div>-->
      <!--        <div class="row">-->
      <!--        <div class="col-md-8 col-sm-12">-->
      <!--          <div class="my-client" style="background-color: #c4c452 !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px;">-->
      <!--            <h5>Pending Follow Ups</h5>-->
      <!--           <h2> <label for="" class="next">{{$next ? $next : 0}}</label></h2>-->
      <!--          </div>-->
      <!--        </div>-->
      <!--      </div>-->
      <!--      <div class="row">-->
      <!--        <div class="col-md-8 col-sm-12">-->
      <!--          <div class="my-client" style="background-color: #ca575b !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px;">-->
      <!--            <h5>Total Projects Lost </h5>-->
      <!--           <h2> <label for="" class="lost">{{$lost ? $lost : 0}}</label></h2>-->
      <!--        </div>-->
      <!--      </div>-->
      <!--    </div>-->
      <!--      </div>-->
        
      <!--    </div> -->
      <!--  </div>-->
      <!--</div>-->
      
            
            
 
           
              
@endsection
@section('script')

  
@endsection
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
{{-- daterangepicker --}}
 {{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
 y --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  {{-- for chartjs --}}

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
//   window.onload = function () {
   
//     var chart = new CanvasJS.Chart("chartContainer", {
//       title: {
//         text: ""
//       },
//       axisX: {
//         title:"Won Project of Vendor"
        
//       },
//       axisY: {
//         title:"Won Project of Client",
//         minimum: 0,
//         maximum: 100,
//         suffix: "days"
//       },
//       data: [{
//         type: "column",
//         yValueFormatString: "#,##0.00\"%\"",
//         indexLabel: "{y}",
//         dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
//       }]
//     });
   
//     function updateChart() {
//       var color,deltaY, yVal;
//       var dps = chart.options.data[0].dataPoints;
//       for (var i = 0; i < dps.length; i++) {
//         deltaY = (2 + Math.random() * (-2 - 2));
//         yVal =  Math.min(Math.max(deltaY + dps[i].y, 0), 90);
//         color = yVal > 75 ? "#fed713" : yVal >= 50 ? "#1bcfb4" : yVal < 50 ? "#fe7c96" : null;
//         dps[i] = {label: "Week "+(i+1) , y: yVal, color: color};
//       }
//       chart.options.data[0].dataPoints = dps;
//       chart.render();
//     };
//     updateChart();
   
//     setInterval(function () { updateChart() }, 1000);
   
//   }
// </script>

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
         //  console.log(data);
             $(".TotalMarginValue").html(data.sum);
             $(".TotalClient").html(data.client_1);
             $(".TotalVendor").html(data.vendor_1);
             $(".RFQS_Bid_count").html(data.RFQS_Bid_count);
             $(".TotalLost").html(data.lost);
             $(".TotalWonProjects").html(data.won_project_count);
             $(".PendingFollowUp").html(data.next);
   
          $('#bar_chart').remove();
          $('.canvas_append').html(' <canvas id="bar_chart" class="chartjs-render-monitor" style="width:100% !important;" ></canvas>');
   
          var ctx = document.getElementById('bar_chart').getContext('2d');
          
          
           var myChart = new Chart(ctx, {
             type: 'bar',
             data: {
                 labels: [ 'Client Invoice Value ', 'Vendor Invoice Value ', 'Total Margin Value'],
                 datasets: [{
                     label: 'DashBoardChart',
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
            labels:["Total Won Projects",'Pending Follow Up',"Total Projects Lost"],
            datasets:[{
            // label:"Total Invoice Value",
            backgroundColor:[ 
                  'rgb(0, 71, 171)',
                    'rgb(255,255,51)','rgb(255, 0, 0)'],
              borderColor: [
                  'rgb(0, 0, 0)',
                'rgb(0, 0, 0)',
                'rgb(0, 0, 0)'],
              borderWidth: 0.5,
            data:[data.won_project_count,data.next,data.lost]
        }]
},

options:{
      legend: { display: false },
      title:  {
        display:true,
        text : "Total values"
      },
  
}
});

    $('.won').html(data.won_project_count);
    4('.next').html(data.next);
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
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Client Orders <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"> {{$client ? $client : 0 }}</h2>
                    {{-- <h6 class="card-text">Increased by 60%</h6> --}}
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Vendor Orders <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">{{$vendor ? $vendor : 0 }}</h2>
                    {{-- <h6 class="card-text">Decreased by 10%</h6> --}}
                  </div>
                </div>
              </div>
        
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Won Projects <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5">{{$won_project ? $won_project : 0}}</h2>
                    {{-- <h6 class="card-text">Increased by 5%</h6> --}}
                  </div>
                </div>
              </div>
            </div>


            {{-- daterange --}}
            <div class="row">
              <div class="col-md-12 d-flex align-items-center">
                <label class="start_1" style="margin-right:13px; font-size:15px; margin-left:46px;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color:#5c4949;">Date:</label>
                <input type="text" name="RFQs" class="won_project " value="01/01/2022 - 01/15/2022" id="daterange" style="max-width: 100%; max-height: 100%;  padding:auto; margin-top:-7px;  border-radius: 16px !important; border-color: #237ee6 !important;">  
              </div>
            </div>

          {{-- chart --}}
       <div class="card">
          <div class="col-md-12">
            <div class="chart-container" style="position:relative;width:80%;height:100% !important;  margin: 20px 0px 10px 50px !important;">

              <div class="canvas_append">
                <div class="col-md-8">
                <canvas id="bar_chart" class="chartjs-render-monitor" style="width:100% !important; height:100% !important; margin: 20px 0px 10px 50px !important;  " ></canvas>
              </div>
            </div>
            </div>
          </div>
        </div>


        <div class="row mt-4">
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="mb-4">Client Invoice</h4>
                <h4> <label for="" class="client-invoice"></label></h4>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="mb-4">Vendor Invoice</h4>
                <h4> <label for="" class="vendor-invoice"></label></h4>
                {{-- <h6 class="card-text">Decreased by 10%</h6> --}}
              </div>
            </div>
          </div>
    
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="mb-4">Total Margin</h4>
                <h4> <label for="" class="total-margin"></label></h4>
                {{-- <h6 class="card-text">Increased by 5%</h6> --}}
              </div>
            </div>
          </div>
        </div>


        {{-- <div class="row mt-4">
          <div class="col-md-4 mb-4 stretch-card transparent">
            <div class="card card-tale" style="background: #5050b2;">
              <div class="card-body">
                <h3 class="mb-4">Client Invoice</h3>
                <h4> <label for="" class="client-invoice">{{$won ? $won : 0}}</label></h4>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4 stretch-card transparent">
            <div class="card card-dark-blue" style="background: #96b2fb;">
              <div class="card-body">
                <p class="mb-4">Vendor Invoice</p>
                <h4> <label for="" class="vendor-invoice">{{$won ? $won : 0}}</label></h4>
              </div>
            </div>
          </div>
          <div class="col-md-4 mb-4 stretch-card transparent">
            <div class="card card-dark-blue" style="background: #f59095;">
              <div class="card-body">
                <p class="mb-4">Total Margin</p>
                <h4> <label for="" class="total-margin">{{$won ? $won : 0}}</label></h4>
              </div>
            </div>
          </div>
        </div> --}}

        
        
          <div class="row"  >
            <div class="container d-flex ">
            <div class="col-md-6 card mt-2 mb-2 pr-0 pl-0">
              <div class="" id="default_chart" style="height:100%;">
               <div class="title text-center" style="margin-top: 24px">
                <label style="font-size:15px;">TOTAL COUNT</label>
              </div>
                <div class="barChartAppend"> 
                <canvas id="bar_chart_1" style="width:100;height:100%;"></canvas>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-sm-12">
              <div class="types-couont" style="margin-top:15px;">
                <div class="row">
              <div class="col-md-8 col-sm-12">
                <div class="my-client" style="background-color: #0c5ebb !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px;">
                  <h5>Total Won Project </h5>
                 <h2> <label for="" class="won">{{$won ? $won : 0}}</label></h2>
                </div>
              </div>
              </div>
              <div class="row">
              <div class="col-md-8 col-sm-12">
                <div class="my-client" style="background-color: #c4c452 !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px;">
                  <h5>Pending Follow Ups</h5>
                 <h2> <label for="" class="next">{{$next ? $next : 0}}</label></h2>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-8 col-sm-12">
                <div class="my-client" style="background-color: #ca575b !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px;">
                  <h5>Total Projects Lost </h5>
                 <h2> <label for="" class="lost">{{$lost ? $lost : 0}}</label></h2>
              </div>
            </div>
          </div>
            </div>
            

          </div> 
        </div>
      </div>
            <div class="row">
              <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Project Status</h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th> # </th>
                            <th> RFQ Value </th>
                            <th> Client Name </th>
                            <th> Vendor Name </th>
                            <th> Due Date </th>
                            <th> Progress </th>
                          </tr>
                        </thead>
                        <tbody>
                          @if (count($bidrfq) > 0)
                            @foreach($bidrfq as $key=>$value)
                              <tr>
                                <td>{{$key++}}</td>
                                <td> {{$value->rfq_no;}} </td>
                                <td> {{$value->client_id;}} </td>
                                <td> {{$value->vendor_id;}} </td>
                                <td> {{date('d M Y', strtotime($value->follow_up_date))}} </td>
                                <td>
                                  <div class="progress">
                                    <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                  </div>
                                </td>
                              </tr>
                            @endforeach
                          @endif
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
            </div>
         

@endsection
@section('script')

  
@endsection
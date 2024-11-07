@extends('layouts.master')
<style>
 .own-chart {
    margin-top: 13px;
}
label.start_1 {
    margin-top: 10px;
    margin-bottom: 10px;
}
</style>

@section('page_title', 'WonProject List')
@section('content')
{{-- daterangepicker --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

  {{-- for chartjs --}}

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="own-chart">
 <div class="container" style="margin:auto; padding:auto;">
   <div class="row" style="height:100%; background:#0b6acb;">
      <div class="col-md-12">

         
        <label class="start_1" style="margin-right:13px; font-size:22px; margin-left:46px;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;color:whitesmoke;">Start-Date End-Date:</label>
        <input type="text" name="RFQs" class="won_project " value="01/01/2022 - 01/15/2022" id="daterange" style="max-width: 100%; max-height: 100%;  padding:auto;">   
      </div>
    
      <div class="col-md-12" style="background:blanchedalmond;max-height:520px;">
        <div class="chart">
            <div class="container">
        <div  id="default_chart">
          <canvas id="bar_chart" width="400" height="175"></canvas>
        </div>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
 // RFQs
$(function() {
  $('input[name="RFQs"]').daterangepicker({
    opens: 'center'
  }, 
  function(start, end, label) {
    // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    RFQs(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'))   
  });
  function RFQs(start_date,end_date)
  {
    // alert(start_date);
    // alert(end_date);
    $.ajax({
      url:"{{route('Overview_chart')}}",
      type:"POST",
      data:{start_1:start_date,
        end_1:end_date
      },
      success:function(data){
       console.log(data);
        const ctx = document.getElementById('bar_chart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total RFQs Bid', 'Total Won Project', 'Client Invoice Value ', 'Vendor Invoice Value ', 'Total Margin Value', 'Total Projects Lost','Pending Follow Ups'],
            datasets: [{
                label: 'OverView Chart',
                data:[data.RFQS_Bid_count , data.won_project_count,data.client_1,data.vendor_1,data.sum,data.lost,data.next],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255,0,0,0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255,0,0,1)'

                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

        }  
    })
  }
});

</script>

{{-- script for chartjs --}}
{{-- <script>
  new Chart(document.getElementById("bar_chart"),{
    type: 'bar',
    data:{
      label:["Total RFQs Bid","Total Won Project"," Client Total","Vendor Total","Total Margin Value","Total Projects Lost","Pendding Follow Ups"],
      datasets:[{
         label:"values",
        backgroundColor:['rgb(0,255,0)'],
        borderColor: [
        'rgb(255, 99, 132)'],
        borderWidth: 1,
        data:[25,25,25,25,34,23,23,23]
      }]
    }
  });
  </script> --}}
  <script>
    const ctx = document.getElementById('bar_chart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Total RFQs Bid', 'Total Won Project', 'Client Invoice Value ', 'Vendor Invoice Value ', 'Total Margin Value', 'Total Projects Lost','Pendding Follow Ups'],
            datasets: [{
                label: 'OverView Chart',
                data: [, , , , , ,],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(153, 102, 255, 0.2)',
                    'rgba(255, 159, 64, 0.2)',
                    'rgba(255,0,0,0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(153, 102, 255, 1)',
                    'rgba(255, 159, 64, 1)',
                    'rgba(255,0,0,1)'

                ],
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    </script>
     
  <style>
    @media only screen and (max-width: 1024px){
      #daterange{
        margin-left:38px;
      }
      .start_1{
        margin-left:5px;
      }
    }
  </style>
@endsection
@extends('layouts.master')
<style>
    .card {
   margin: 40px 0 20px 0;
    border:1px solid;
 }
 input#daterange,input#daterange_1 {
    padding: 0.4375rem 0.75rem;
    outline: 1px solid #89b3e2;
    color: #bbb5b5;
    border: #000;
    border-radius: 3px;
    width: 80%;
    
}
@media (max-width: 375px){
	/*Small smartphones [325px -> 425px]*/
  #daterange_1 {
    width: 100% !important;
  }
  .chart-title {
    margin-top: 50px;
    margin-bottom: 16px;
}
h5 {
    font-size: 14px;
}
.my-client {
    background-color: #00cccc !important;
    padding: 10px;
    color: #ebedf2;
}
.my-total {
    background-color: #6f42c1 !important;
    padding: 10px;
    color: #ebedf2;
}
.container {
    margin-left: 10px;
}
.card-title{
    
}
</style>
@section('page_title', 'WonProject List')
@section('content')

{{-- For date range picker --}}
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

{{-- for chartjs --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="card-header header-elements-inline mb-2" style="background: linear-gradient(43deg,#0b5dbb,#0b5dbb);">
  <a class="ml-2 card-title" style="color:white;font-size: 1.125rem; font-family:'ubuntu-medium', sans-serif;">Project Status</a>
</div>
 <div class="chart-title">
  <div class="container">
    <div class="row mt-4">
          <div class="col-md-3">
            <h4 class="card-title float-left" style="font-size:20px">Select Team Leader</h4>
            <select class="form-control label-gray-3" name="team_leader" id="team_leader" style="outline: 1px solid #89b3e2 !important;">
              <option class="label-gray-3" value="">Select Team Leader </option>
                @if(count($operation) > 0)
                @foreach($operation as $v)
                <option value="{{$v->team_leader}}">{{$v->team_leader}}</option>
                @endforeach
                @endif
            </select>
          </div>
          <div class="col-md-3">
          <h4 class="card-title float-left" style="font-size:20px">Project Manager Name</h4>
            <select class="form-control label-gray-3" name="project_manager_name" id="project_manager_name" style="outline: 1px solid #89b3e2 !important;">
              <option class="label-gray-3" value="">Select Project Manager Name</option>
                @if(count($operation) > 0)
                @foreach($operation as $v)
                <option value="{{$v->project_manager_name}}">{{$v->project_manager_name}}</option>
                @endforeach
                @endif
            </select>
          </div>
          <div class="col-md-3">
          <h4 class="card-title float-left" style="font-size:20px">Quality Analyst Name</h4>
            <select class="form-control label-gray-3" name="quality_analyst_name" id="quality_analyst_name" style="outline: 1px solid #89b3e2 !important;">
              <option class="label-gray-3" value="">Select Quality Analyst Name</option>
                @if(count($operation) > 0)
                @foreach($operation as $v)
                <option value="{{$v->quality_analyst_name}}">{{$v->quality_analyst_name}}</option>
                @endforeach
                @endif
            </select>
          </div>
    </div>
  </div>
</div>


<div class="container">
<div class="content-wrapper" style="margin-bottom: 6.7rem; margin-top:40px">
<div class="row">
  <div class="col-md-12">
    <div class="row">
    <div class="col-md-3">
     <div class="my-client" style="background-color: #00cccc !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px;">
      <h5>Closed Project </h5>
     <h2 class="Closed_projects"> <label for="" ></label>{{$closed ? $closed : 0}}</h2>
    </div>
  </div>
    <div class="col-md-3">
      <div class="my-vendor" style="background-color: #0075f2 !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px;">
     <h5 >Hold Project</h5>
      <h2 class="Hold_project"> <label for="" ></label>{{$hold ? $hold : 0}} </h2>
     </div>
    </div>
    <div class="col-md-3">
      <div class="my-total" style="background-color: #6f42c1 !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px;">
      <h5 >Stop Project </h5>
      <h2  class="Stop_project"> <label for=""></label>{{$stop ? $stop : 0}}</h2>
    </div>
  </div>
    <div class="col-md-3" id="default_chart">
      <canvas id="bar_chart" width="100%" height="100%"></canvas>
    </div>
    </div>
  </div>
</div>  
</div>
</div>

<script type="text/javascript">
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
    }
  });
$(document).on('change','#team_leader',function() {
  var team_leader= $('#team_leader').val();

  $.ajax({
        url: "{{route('operationNew.figures')}}",
        type:'post',
        data:{
          team_leader:team_leader
        },
        success:function(response){
          $('#default_chart').empty();
          $('#default_chart').html('<canvas id="bar_chart" width="100%" height="100%" ></canvas>');
          // var labels =["Total margin value","Total client invoice value","Total vendor invoice value"];
          var total_data=[response.Completed,response.hold,response.stop];
          var bgColor=["#00CCCC","#0075F2","#5A1BD0"];
          var chartdata = {
            labels:["Closed Project","Hold Project ","Stop Project"],
            datasets:[{
              label:"Total invoice values",
              backgroundColor:bgColor,
              hoverOffset: 4,
              data:total_data
            }]
          };
          var ctx=$("#bar_chart");
          var barGraph = new Chart(ctx,{
              type:'doughnut',
              data:chartdata,
               
          });
          
          $(".Closed_projects").html(response.Completed);
          $(".Hold_project").html(response.hold);
          $(".Stop_project").html(response.stop);
          },
        error:function(response){
          alert("not ok");
        }
      });
});
</script>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
    }
  });
$(document).on('change','#project_manager_name',function() {
  var project_manager_name= $('#project_manager_name').val();
  $.ajax({
        url: "{{route('operationNew.figures')}}",
        type:'post',
        data:{
          project_manager_name:project_manager_name,
        },
        success:function(response){
          $('#default_chart').empty();
          $('#default_chart').html('<canvas id="bar_chart" width="100%" height="100%" ></canvas>');
          // var labels =["Total margin value","Total client invoice value","Total vendor invoice value"];
          var total_data=[response.Completed,response.hold,response.stop];
          var bgColor=["#00CCCC","#0075F2","#5A1BD0"];
          var chartdata = {
            labels:["Closed Project","Hold Project ","Stop Project"],
            datasets:[{
              label:"Total invoice values",
              backgroundColor:bgColor,
              hoverOffset: 4,
              data:total_data
            }]
          };
          var ctx=$("#bar_chart");
          var barGraph = new Chart(ctx,{
              type:'doughnut',
              data:chartdata,
               
          });
          
          $(".Closed_projects").html(response.Completed);
          $(".Hold_project").html(response.hold);
          $(".Stop_project").html(response.stop);
          },
        error:function(response){
          alert("not ok");
        }
      });
});
</script>
<script>
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
    }
  });
$(document).on('change','#quality_analyst_name',function() {
  var quality_analyst_name= $('#quality_analyst_name').val();
  $.ajax({
        url: "{{route('operationNew.figures')}}",
        type:'post',
        data:{
          quality_analyst_name:quality_analyst_name,
        },
        success:function(response){
          $('#default_chart').empty();
          $('#default_chart').html('<canvas id="bar_chart" width="100%" height="100%" ></canvas>');
          // var labels =["Total margin value","Total client invoice value","Total vendor invoice value"];
          var total_data=[response.Completed,response.hold,response.stop];
          var bgColor=["#00CCCC","#0075F2","#5A1BD0"];
          var chartdata = {
            labels:["Closed Project","Hold Project ","Stop Project"],
            datasets:[{
              label:"Total invoice values",
              backgroundColor:bgColor,
              hoverOffset: 4,
              data:total_data
            }]
          };
          var ctx=$("#bar_chart");
          var barGraph = new Chart(ctx,{
              type:'doughnut',
              data:chartdata,
               
          });
          
          $(".Closed_projects").html(response.Completed);
          $(".Hold_project").html(response.hold);
          $(".Stop_project").html(response.stop);
          },
        error:function(response){
          alert("not ok");
        }
      });
});
</script>
@endsection
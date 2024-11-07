@extends('layouts.master')

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
                </span> Operation Dashboard
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
                <input type="text" name="RFQs" class="won_project " value="" id="daterange" style="max-width: 100%; max-height: 100%; width: 220px;   padding:auto; margin-top:-7px;  border-radius: 16px !important; border-color: #237ee6 !important;">  
              </div>
            </div>
            <div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">New Project <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5" id="new">0</h2>
                    <!--<h6 class="card-text">Increased by 60%</h6>-->
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Existing Project<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5" id="existing">0</h2>
                    <!--<h6 class="card-text">Decreased by 10%</h6>-->
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Closed Project <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5" id="closed">0</h2>
                    <!--<h6 class="card-text">Increased by 5%</h6>-->
                  </div>
                </div>
              </div>
            </div>
            
            

            <!--for chart-->
            <!--<div class="card mb-3">-->
            <!--  <div class="col-md-12">-->
            <!--    <div class="chart-container" style="position:relative;width:94%;height:100% !important;  margin: 20px 0px 10px 50px !important;">-->
            <!--      <div class="canvas_append">-->
            <!--        <div class="col-md-8">-->
            <!--        <canvas id="bar_chart" class="chartjs-render-monitor" style="width:100% !important; height:100% !important; margin: 20px 0px 10px 50px !important;  " ></canvas>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--</div>-->
        
           
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Project Status </h4>
                    <div class="table-responsive">
                      <table class="table">
                        <thead>
                          <tr>
                            <th>Project No</th>
                            <th>Team Leader </th>
                            <th>Project Manager Name</th>
                            <th>Quality Analyst Name	 </th>
                            <th>Status </th>
                            <th>Progress </th>
                          </tr>
                        </thead>
                        <tbody>
                            @if(count($operation)>0)
                            @foreach($operation as $key=> $data)
                            
                           <tr>
                               <td>{{$data->project_no}}</td>
                               
                               
                               <td> @if(count($tl)>0)
                                @foreach ($tl as $item)
                                @if($data->team_leader == $item->id)
                                {{$item->name}}
                                @endif
                                @endforeach
                                @endif
                                </td>
                               
                               <td>
                                    @if(count($pl)>0)
                                @foreach ($pl as $item)
                                @if($data->project_manager_name == $item->id)
                                {{$item->name}}
                                @endif
                                @endforeach
                                @endif
                                </td>
                                

                               <td>
                                @if(count($ql)>0)
                                @foreach ($ql as $item)
                                @if($data->quality_analyst_name == $item->id)
                                {{$item->name}}
                                @else
                                -
                                @endif
                                @endforeach
                                @endif
                                </td>
                                
                               <td class="badge badge-gradient-success">
                                      @if($data->status == 'hold')
                                       Ongoing Project
                                      @elseif($data->status == 'completed')
                                        Completed
                                      @else
                                      Project Stop In Middle
                                       @endif
                                     </td>
                                <td>
                              <div class="progress">
                                  @if($data->status == 'hold')
                                <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    @elseif($data->status == 'completed')
                                <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    @else
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    @endif
                              
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
                            <th>Ongoing  Project</th>
                            <th>Completed Project </th>
                            <th> Stop In Middle</th> 
                          </tr>
                        </thead>
                        <tbody>
                         
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-warning" role="progressbar" style="width: 50%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            
                            
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-success" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-gradient-danger" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>  
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-5 grid-margin stretch-card">
              </div>
            </div>
          </div>
<script type="text/javascript">
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

  $(document).ready(function(){
    var startDate = moment().format('YYYY-MM-DD');
    var endDate = moment().format('YYYY-MM-DD');
  
    RFQs(startDate,endDate)   
  });

  function RFQs(start_date,end_date){
    // alert(start_date);
    $.ajax({
      url:"{{route('operation.fieldoverviewChart')}}",
       type:"post",
       data:{start_1:start_date,end_1:end_date},   
       success:function(data){
        console.log(data);

      

           $("#new").html(data.new);
           $("#existing").html(data.new);
           $("#closed").html(data.closed);
       }
    })
  }
</script>
@endsection
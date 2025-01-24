@extends('layouts.master')

@section('content')

{{-- daterange picker cdn --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.2/dist/echarts.min.js"></script>

{{-- for chartjs --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .status-badge {
    font-size: 14px; /* Adjust as needed */
    font-weight: bold; /* Optional for better emphasis */
}
  </style>
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="mr-2 text-white page-title-icon bg-gradient-primary">
                  <i class="mdi mdi-home"></i>
                </span> Operation Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="align-middle mdi mdi-alert-circle-outline icon-sm text-primary"></i>
                  </li>
                </ul>
              </nav>
            </div>
            {{-- date range picker --}}
            <div class="mb-4 row">
              <div class="col-md-12 d-flex align-items-center">
                  <label class="start_1" style="margin-right:13px; font-size:15px; margin-left:46px;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color:#5c4949;">
                      Date:
                  </label>
                  <input type="text" name="RFQs" class="won_project" value="" id="daterange" style="max-width: 100%; max-height: 100%; width: 220px; padding:auto; margin-top:-7px;">
                  <button type="button" id="clear-daterange" class="ml-2 btn btn-secondary">Clear</button>
              </div>
          </div>
          
          <!--<div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                  <div class="text-white card bg-gradient-danger card-img-holder">
                      <div class="card-body">
                          <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                          <h4 class="mb-3 font-weight-normal">New Project <i class="float-right mdi mdi-chart-line mdi-24px"></i></h4>
                          <h2 class="mb-5" id="new">0</h2>
                      </div>
                  </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                  <div class="text-white card bg-gradient-info card-img-holder">
                      <div class="card-body">
                          <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                          <h4 class="mb-3 font-weight-normal">Existing Project<i class="float-right mdi mdi-bookmark-outline mdi-24px"></i></h4>
                          <h2 class="mb-5" id="existing">0</h2>
                      </div>
                  </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                  <div class="text-white card bg-gradient-success card-img-holder">
                      <div class="card-body">
                          <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                          <h4 class="mb-3 font-weight-normal">Closed Project <i class="float-right mdi mdi-diamond mdi-24px"></i></h4>
                          <h2 class="mb-5" id="closed">0</h2>
                      </div>
                  </div>
              </div>
          </div>-->
          <div class="col-md-8">
          <div id="chartContainer" style="width: 100%; height: 400px; margin-top: 20px;">

          </div>
        </div>
          
            

            <!--for chart-->
            <!--<div class="mb-3 card">-->
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
                                
                                <td>
                                  @if($data->status == 'hold')
                                      <span class="badge badge-info status-badge">Ongoing Project</span>
                                  @elseif($data->status == 'completed')
                                      <span class="badge badge-success status-badge">Completed</span>
                                  @else
                                      <span class="badge badge-danger status-badge">Project Stop In Middle</span>
                                  @endif
                              </td>
                                <td>
                              <div class="progress">
                                  @if($data->status == 'hold')
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                    @elseif($data->status == 'completed')
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                    @else
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
                                <div class="progress-bar bg-info" role="progressbar" style="width: 50%" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            
                            
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                              </div>
                            </td>
                            
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-danger" role="progressbar" style="width: 50%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
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
$(function () {
    // Initialize the date range picker
    $('input[name="RFQs"]').daterangepicker({
        "showDropdowns": true,
        "autoUpdateInput": false,
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        opens: 'right'
    }, function (start, end, label) {
        $('input[name="RFQs"]').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));
        fetchRFQData(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
    });

    // Clear Button
    $('#clear-daterange').on('click', function () {
        $('input[name="RFQs"]').val('');
        fetchRFQData('', '');
    });

    // Load initial data (all data)
    fetchRFQData('', '');

    function fetchRFQData(start_date, end_date) {
        $.ajax({
            url: "{{ route('operation.fieldoverviewChart') }}",
            type: "POST",
            data: {
                start_1: start_date,
                end_1: end_date,
                _token: "{{ csrf_token() }}"
            },
            success: function (data) {
                console.log(data);

                // Update card counts
                $("#new").html(data.new || 0);
                $("#existing").html(data.existing || 0);
                $("#closed").html(data.closed || 0);

                // Update pie chart
                renderPieChart(data.new, data.existing, data.closed);
            },
            error: function () {
                alert("Error fetching data");
            }
        });
    }

    // Render Pie Chart
    function renderPieChart(newProjects, existingProjects, closedProjects) {
        var chartDom = document.getElementById('chartContainer');
        var myChart = echarts.init(chartDom);

        var option = {
            title: {
                text: 'Projects',
                subtext: 'Completed, New, and Existing',
                left: 'center'
            },
            tooltip: {
                trigger: 'item',
                formatter: '{b}: {c}'
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: ['New Projects', 'Existing Projects', 'Closed Projects']
            },
            series: [
                {
                    name: 'Projects',
                    type: 'pie',
                    radius: ['40%', '70%'],
                    top:'10%',
                    label: {
                        show: true,
                        position: 'outside',
                        formatter: '{b}: {c}'
                    },
                    data: [
                    { 
                        value: newProjects, 
                        name: 'New Projects', 
                        itemStyle: { color: '#ffc107' } // Primary color (blue) 
                    },
                    { 
                        value: newProjects, 
                        name: 'Existing Projects', 
                        itemStyle: { color: '#17a2b8' } // Info color (teal)
                    },
                    { 
                        value: closedProjects, 
                        name: 'Closed Projects', 
                        itemStyle: { color: '#28a745' } // Success color (green)
                    }
                ]
                }
            ]
        };

        myChart.setOption(option);
    }
});

</script>
@endsection
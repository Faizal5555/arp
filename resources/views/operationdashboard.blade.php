@extends('layouts.master')

@section('content')

{{-- daterange picker cdn --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.2/dist/echarts.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{-- for chartjs --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <style>
    .status-badge {
    font-size: 14px; /* Adjust as needed */
    font-weight: bold; /* Optional for better emphasis */
}

.status-colored {
    font-weight: bold;
    border-radius: 6px;
}
.table-country{
    table-layout: fixed;
    width: 100% !important; 
 
}
th, td {
    width: 150px !important; 
    overflow: hidden;
    text-overflow: ellipsis;  /* Truncate text with an ellipsis */
    white-space: nowrap; /* Set the desired width for both th and td */
}

  </style>
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="mr-2 text-white page-title-icon bg-gradient-primary">
                  <i class="mdi mdi-home"></i>
                </span> Project Manager Dashboard
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
                            {{-- <th>Team Leader </th> --}}
                            <th>Project Manager Name</th>
                            {{-- <th>Quality Analyst Name	 </th> --}}
                            <th>Status </th>
                            <th>Progress </th>
                            {{-- <th>Target Group</th> --}}
                          </tr>
                        </thead>
                        <tbody>
                            @if(count($operation)>0)
                            @foreach($operation as $key=> $data)
                            
                           <tr>
                               <td>{{$data->project_no}}</td>
                               
                               
                               {{-- <td> 
                                
                                @if(count($tl)>0)
                                @foreach ($tl as $item)
                                @if($data->team_leader == $item->id)
                                {{$item->name}}
                                @endif
                                @endforeach
                                @endif
                                </td> --}}
                               
                               <td>
                                    @if(count($pl)>0)
                                @foreach ($pl as $item)
                                @if($data->project_manager_name == $item->id)
                                {{$item->name}}
                                @endif
                                @endforeach
                                @endif
                                </td>
                                

                               {{-- <td>
                                @if(count($ql)>0)
                                @foreach ($ql as $item)
                                @if($data->quality_analyst_name == $item->id)
                                {{$item->name}}
                                @else
                                -
                                @endif
                                @endforeach
                                @endif
                                </td> --}}
                                
                                <td>
                                    <select class="form-control form-select status-dropdown status-colored" 
                                            style="min-width: 170px; padding: 4px 8px;" 
                                            data-id="{{ $data->id }}">
                                        <option value="hold" {{ $data->status == 'hold' ? 'selected' : '' }}>Live</option>
                                        <option value="completed" {{ $data->status == 'completed' ? 'selected' : '' }} class="d-none">Completed</option>
                                        <option value="pause" {{ $data->status == 'pause' ? 'selected' : '' }}>Links Not Working</option>
                                        <option value="pause" {{ $data->status == 'pause' ? 'selected' : '' }}>Pause by Client</option>
                                        <option value="awaited" {{ $data->status == 'awaited' ? 'selected' : '' }}>ID's/PO/Awaited</option>
                                        <option value="stop" {{ $data->status == 'stop' ? 'selected' : '' }}>Cancel By Client</option>

                                    </select>
                                </td>
                                <td>
                                    <div class="progress">
                                        @if($data->status == 'hold')
                                      <div class="progress-bar bg-primary" role="progressbar" style="width: 50%" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                                      @elseif($data->status == 'pause')
                                      <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                      @elseif($data->status == 'awaited')
                                      <div class="progress-bar bg-warning" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                      @elseif($data->status == 'completed')  <!-- ✅ Show progress for completed -->
                                      <div class="progress-bar bg-success" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                      @elseif($data->status == 'stop')  <!-- ✅ Show progress for completed -->
                                      <div class="progress-bar bg-danger" role="progressbar" style="width: 100%" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
                                      @else
                                      <div class="progress-bar bg-danger" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                     @endif
                                    
                                    </div>
                              </td>

                              {{-- <td>
                                @php
                                $countries = explode(',', $data->country_name);
                                $groups = explode(',', $data->target_group);
                                $sampleTargets = json_decode($data->sample_target, true);
                                $sampleAchieved = json_decode($data->sample_achieved, true);
                                $totals = json_decode($data->total, true);
                            
                                $groupCount = count($groups);
                            
                                // Determine active columns (columns with at least one non-zero value)
                                $activeColumns = [];
                                for ($i = 0; $i < $groupCount; $i++) {
                                    $hasValue = false;
                                    foreach ($sampleTargets as $index => $targets) {
                                        if (!empty($targets[$i]) && $targets[$i] != 0) {
                                            $hasValue = true;
                                            break;
                                        }
                                    }
                                    foreach ($sampleAchieved as $index => $achieved) {
                                        if (!empty($achieved[$i]) && $achieved[$i] != 0) {
                                            $hasValue = true;
                                            break;
                                        }
                                    }
                            
                                    if ($hasValue) {
                                        $activeColumns[] = $i;
                                    }
                                }
                            @endphp
                            
                            <table class="table table-bordered text-center w-50">
                                <thead>
                                    <tr>
                                        <th rowspan="2">Country</th>
                                        @foreach ($activeColumns as $i)
                                            <th colspan="2">{{ $groups[$i] }}</th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($activeColumns as $i)
                                            <th>Sample Target</th>
                                            <th>Sample Achieved</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($countries as $index => $country)
                                        <tr>
                                            <td>{{ trim($country) }}</td>
                                            @foreach ($activeColumns as $i)
                                                <td>{{ $sampleTargets[$index][$i] ?? 0 }}</td>
                                                <td>{{ $sampleAchieved[$index][$i] ?? 0 }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th>Total</th>
                                        @foreach ($activeColumns as $i)
                                            <th>{{ $totals[$i * 2] ?? 0 }}</th>
                                            <th>{{ $totals[$i * 2 + 1] ?? 0 }}</th>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                            
                            </td> --}}

                            <td class="country">
                                @php
                                $countries = explode(',', $data->country_name);
                                $groups = explode(',', $data->target_group);
                                $sampleTargets = json_decode($data->sample_target, true);
                                $sampleAchieved = json_decode($data->sample_achieved, true);
                                $totals = json_decode($data->total, true);
                            
                                $groupCount = count($groups);
                            
                                // Determine active columns (columns with at least one non-zero value)
                                $activeColumns = [];
                                for ($i = 0; $i < $groupCount; $i++) {
                                    $hasValue = false;
                                    foreach ($sampleTargets as $index => $targets) {
                                        if (!empty($targets[$i]) && $targets[$i] != 0) {
                                            $hasValue = true;
                                            break;
                                        }
                                    }
                                    foreach ($sampleAchieved as $index => $achieved) {
                                        if (!empty($achieved[$i]) && $achieved[$i] != 0) {
                                            $hasValue = true;
                                            break;
                                        }
                                    }
                            
                                    if ($hasValue) {
                                        $activeColumns[] = $i;
                                    }
                                }
                            @endphp
                            
                            <table class="table-country table-bordered text-center w-50">
                                <thead class="country">
                                    <tr>
                                        <th rowspan="2">Country</th>
                                        @foreach ($activeColumns as $i)
                                            <th colspan="2">{{ $groups[$i] }}</th>
                                        @endforeach
                                    </tr>
                                    <tr>
                                        @foreach ($activeColumns as $i)
                                            <th>Sample Target</th>
                                            <th>Sample Achieved</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($countries as $index => $country)
                                        <tr>
                                            <td>{{ trim($country) }}</td>
                                            @foreach ($activeColumns as $i)
                                                <td>{{ $sampleTargets[$index][$i] ?? 0 }}</td>
                                                <td>{{ $sampleAchieved[$index][$i] ?? 0 }}</td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th>Total</th>
                                        @foreach ($activeColumns as $i)
                                            <th>{{ $totals[$i * 2] ?? 0 }}</th>
                                            <th>{{ $totals[$i * 2 + 1] ?? 0 }}</th>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                                
                            </td>
                            <td>{{ $data->pm_updated_at ? \Carbon\Carbon::parse($data->pm_updated_at)->format('d-m-y') : '-' }}</td>
                            <td>
                                <span style="display: block; min-width: 250px; line-height: normal; white-space: normal; padding: 5px; word-break: break-word;">
                                    {{ $data->project_comment ? $data->project_comment : '-' }}
                                </span>
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
                            <th>Live  Project</th>
                            <th>Completed Project </th>
                            <th> Stop In Middle</th> 
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                              <td>
                                  <div class="progress" style="position: relative;">
                                      <div id="ongoingProgressBar" class="progress-bar bg-info" role="progressbar"
                                           style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                      </div>
                                      <span id="ongoingCount" class="progress-count" 
                                            style="position: absolute; width: 100%; text-align: center; color: black; font-weight: bold; padding:7px;">
                                            0
                                      </span>
                                  </div>
                              </td>
                              <td>
                                  <div class="progress" style="position: relative;">
                                      <div id="completedProgressBar" class="progress-bar bg-success" role="progressbar"
                                           style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                      </div>
                                      <span id="completedCount" class="progress-count" 
                                            style="position: absolute; width: 100%; text-align: center; color: black; font-weight: bold; padding:7px;">
                                            0
                                      </span>
                                  </div>
                              </td>
                              <td>
                                  <div class="progress" style="position: relative;">
                                      <div id="stoppedProgressBar" class="progress-bar bg-danger" role="progressbar"
                                           style="width: 0%" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                      </div>
                                      <span id="stoppedCount" class="progress-count" 
                                            style="position: absolute; width: 100%; text-align: center; color: black; font-weight: bold; padding:7px;">
                                            0
                                      </span>
                                  </div>
                              </td>
                          </tr>
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

            // Counts
            const newCount = data.new || 0;
            const existingCount = data.existing || 0;
            const closedCount = data.closed || 0;
            const stopCount = data.stop || 0;
            const pauseCount = data.pause || 0;

            // Total Projects
            const totalProjects = newCount + existingCount + closedCount + stopCount;

            // Calculate percentages
            const ongoingPercentage = totalProjects > 0 ? (existingCount / totalProjects) * 100 : 0;
            const completedPercentage = totalProjects > 0 ? (closedCount / totalProjects) * 100 : 0;
            const stopPercentage = totalProjects > 0 ? (stopCount / totalProjects) * 100 : 0;

            // Update Progress Bar
            $("#ongoingProgressBar").css("width", ongoingPercentage + "%").attr("aria-valuenow", ongoingPercentage);
            $("#completedProgressBar").css("width", completedPercentage + "%").attr("aria-valuenow", completedPercentage);
            $("#stoppedProgressBar").css("width", stopPercentage + "%").attr("aria-valuenow", stopPercentage);

            // Update Progress Bar Counts
            $("#ongoingCount").html(existingCount);
            $("#completedCount").html(closedCount);
            $("#stoppedCount").html(stopCount);

            // Render Pie Chart
            renderPieChart(newCount, existingCount, closedCount,pauseCount, stopCount);
        },
        error: function () {
            alert("Error fetching data");
        }
    });
}


    // Render Pie Chart
    function renderPieChart(newProjects, existingProjects, closedProjects,pauseProjects) {
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
            data: ['New Projects', 'Existing Projects', 'Closed Projects','Paused Projects']
        },
        series: [
            {
                name: 'Projects',
                type: 'pie',
                radius: ['40%', '70%'],
                top: '10%',
                label: {
                    show: true,
                    position: 'outside',
                    formatter: '{b}: {c}'
                },
                data: [
                    {
                        value: newProjects,
                        name: 'New Projects',
                        itemStyle: { color: '#ffc107' } // Yellow
                    },
                    {
                        value: existingProjects,
                        name: 'Existing Projects',
                        itemStyle: { color: '#007bff' } // Teal
                    },
                    {
                        value: closedProjects,
                        name: 'Closed Projects',
                        itemStyle: { color: '#28a745' } // Green
                    },
                    {
                        value: pauseProjects,
                        name: 'Paused Projects',
                        itemStyle: { color: '#dc3545' } // Red (danger)
                    },
                ]
            }
        ]
    };

    myChart.setOption(option);
}

});
$(document).on('change', '.status-dropdown', function () {
    var status = $(this).val();
    var id = $(this).data('id');

    $.ajax({
        url: '{{ route("operationNew.updateStatus") }}', // ✅ Laravel named route
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            id: id,
            status: status
        },
        success: function (response) {
            Swal.fire({
                icon: 'success',
                title: 'Status Updated',
                text: 'The project status has been updated to "' + status + '".',
                timer: 2000,
                showConfirmButton: false
            });

            // Optional: You can update a badge here without reloading
            // Or reload if needed
            location.reload();
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Status update failed. Please try again!',
            });
        }
    });
});
function applySelectColor(selectElement) {
    let value = $(selectElement).val();
    $(selectElement).removeClass('bg-primary bg-success bg-danger bg-danger text-white');

    switch (value) {
        case 'hold':
            $(selectElement).addClass('bg-primary text-white');
            break;
        case 'completed':
            $(selectElement).addClass('bg-success text-white');
            break;
        case 'stop':
            $(selectElement).addClass('bg-danger text-white');
            break;
        case 'pause':
            $(selectElement).addClass('bg-danger text-white');
            break;
        case 'awaited':
            $(selectElement).addClass('bg-warning text-dark');
            break;
    }
}

// Apply on page load
$('.status-colored').each(function () {
    applySelectColor(this);
});

// Apply on change
$(document).on('change', '.status-colored', function () {
    applySelectColor(this);
});


</script>
@endsection
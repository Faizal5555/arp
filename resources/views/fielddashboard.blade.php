
@extends('layouts.master')

@section('content')
{{-- daterange picker cdn --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.2/dist/echarts.min.js"></script>

<div class="content-wrapper">
            <div class="row" id="proBanner">
              <div class="col-12">
              
              </div>
            </div>
            <div class="page-header">
              <h3 class="page-title">
                <span class="mr-2 text-white page-title-icon bg-gradient-primary">
                  <i class="mdi mdi-home"></i>
                </span> Dashboard
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
              <!-- <div class="col-md-6 d-flex align-items-center">
                <label class="start_1" style="margin-right:13px; font-size:15px; margin-left:46px;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color:#5c4949;">Date:</label>
                <input type="text" name="field" class="won_project " value="" id="daterange" style="max-width: 100%; max-height: 100%; width: 220px;   padding:auto; margin-top:-7px;   border-color: #237ee6 !important;">  
              </div> -->
              <div class="pl-3 d-flex">
                <label class="p-1 start_1" style="font-size:15px; margin-left:20px;font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif; color:#5c4949;">Date:</label>
                <input type="text" name="field" class="form-control" id="daterange" placeholder="Select Date Range">
                <button type="button" id="clear-daterange" class="ml-2 btn btn-secondary">Clear</button>
            </div>
            </div>
             {{--End date range picker --}}
            <!--<div class="row">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="text-white card bg-gradient-danger card-img-holder">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="mb-3 font-weight-normal">Total Open Project<i class="float-right mdi mdi-chart-line mdi-24px"></i>
                    </h4>
                    <h2 class="mb-5" id="new">{{$total_open ? $total_open : 0}}</h2>
                    <h6 class="card-text"></h6>
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="text-white card bg-gradient-info card-img-holder">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="mb-3 font-weight-normal">Total Closed Project<i class="float-right mdi mdi-bookmark-outline mdi-24px"></i>
                    </h4>
                    <h2 class="mb-5" id="closed">{{$total_close ? $total_close : 0}}</h2>
                    <h6 class="card-text"></h6>
                  </div>
                </div>
              </div>
            </div>
          -->
            
             <div class="row">
              <div class="col-md-8">
                  <div id="projectPieChart" style="width: 100%; height: 400px;"></div>
              </div>
          </div>
            <!--<div class="row">-->
            <!--  <div class="col-md-12 grid-margin stretch-card">-->
            <!--    <div class="card">-->
            <!--      <div class="card-body">-->
            <!--        <h4 class="card-title">Latest</h4>-->
            <!--        <div class="table-responsive">-->
            <!--          <table class="table">-->
            <!--            <thead>-->
            <!--              <tr>-->
            <!--                <th>Id</th>-->
            <!--                <th> Team Leader </th>-->
            <!--                <th> Project Manager </th>-->
            <!--                <th> Quality Analyst </th>-->
            <!--              </tr>-->
            <!--            </thead>-->
            <!--            <tbody>-->
                         
            <!--                @if(isset($fieldteam) && (count($fieldteam)>0))-->
            <!--                @foreach($fieldteam as $key=> $data)-->
            <!--               <tr>-->
            <!--                   <td>{{$data->id}}</td>-->
            <!--                   <td>{{$data->team_leader}}</td>-->
            <!--                   <td>{{$data->project_manager_name}}</td>-->
            <!--                   <td>{{$data->quality_analyst_name}}</td>-->
            <!--              </tr>-->
            <!--              @endforeach-->
            <!--              @endif-->
                          
            <!--            </tbody>-->
            <!--          </table>-->
            <!--        </div>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
              
            <!--</div>-->
          </div>
<script type="text/javascript">
$(function () {
    // Initialize the date range picker
    $('input[name="field"]').daterangepicker({
    "showDropdowns": true,
    "autoUpdateInput": false, // Prevent auto-filling initially
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
    // Update the input field with the selected date range
    $('input[name="field"]').val(start.format('YYYY-MM-DD') + ' - ' + end.format('YYYY-MM-DD'));

    // Fetch the filtered data
    field(start.format('YYYY-MM-DD'), end.format('YYYY-MM-DD'));
});

// Handle Cancel Event on Date Range Picker
$('input[name="field"]').on('cancel.daterangepicker', function () {
    $(this).val(''); // Clear the input field
    field('', ''); // Load all data
});

// Handle Clear Button Click
$('#clear-daterange').on('click', function () {
    $('input[name="field"]').val(''); // Clear the input field
    field('', ''); // Load all data
});

// Load initial data (all data)
field('', '');

    // Render data on page load
    function field(start_date, end_date) {
        $.ajax({
            url: "{{ route('operation.overviewChart') }}", // Backend route
            type: "POST",
            data: {
                start_1: start_date,
                end_1: end_date,
                _token: "{{ csrf_token() }}" // CSRF token for Laravel
            },
            success: function (data) {
                console.log(data);

                // Update card counters
                $("#new").html(data.new || 0);
                $("#closed").html(data.closed || 0);

                // Render pie chart with data
                renderPieChart(data.new, data.closed);
            },
            error: function () {
                alert("Error fetching data");
            }
        });
    }

    // Render the ECharts Doughnut Pie Chart
    function renderPieChart(totalOpen, totalClosed) {
        var chartDom = document.getElementById('projectPieChart');
        var myChart = echarts.init(chartDom);

        var option = {
            title: {
                text: 'Project',
                subtext: 'Open Projects vs Closed Projects',
                left: 'center',
            },
            tooltip: {
                trigger: 'item',
                formatter: '{a} <br/>{b}: {c}'
            },
            legend: {
                orient: 'vertical',
                left: 'left',
                data: ['Total Open Projects', 'Total Closed Projects']
            },
            
            series: [
                {
                    name: 'Projects',
                    type: 'pie',
                    radius: ['40%', '70%'], // Doughnut chart
                    top:'10%',
                    avoidLabelOverlap: false,
                    label: {
                        show: true,
                        position: 'outside', // Position labels outside
                        formatter: '{b}: {c}' // Show count (e.g., Open Projects: 50)
                    },
                    labelLine: {
                        show: true
                    },
                    emphasis: {
                        label: {
                            show: true,
                            fontSize: '18',
                            fontWeight: 'bold',
                            formatter: '{b}: {c}' // Show percentage and count on hover
                        }
                    },
                    data: [
                      { value: totalOpen, name: 'Total Open Projects' },
                      { value: totalClosed, name: 'Total Closed Projects' }
                    ]
                }
            ]
        };

        myChart.setOption(option);
    }
});

          </script>
@endsection
@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')
<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
    }
    .badge {
        padding: 2px 0px 0px 0px!important;
        position: absolute;
        top: -3px;
        right: 6px;
        width: 18px;
        height: 18px;
        border-radius: 100%!important;
        background: red;
        color: white;
        font-size: 10px;
    }
</style>
<div class="content-wrapper">
    <div class="page-header">
        <h3 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
                <i class="mdi mdi-home"></i>
            </span> Data Center Dashboard
        </h3>
    </div>

    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                <label style="font-size: larger;">Country</label>
                <select name="country" id="country" class="form-control">
                    <option class="label-gray-3" value="">Select Country</option>
                    @foreach($country as $v)
                        <option value="{{$v->name}}">{{$v->name}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <label style="font-size: larger;">Speciality</label>
                <select name="speciality" id="speciality" class="form-control">
                    <option value=""  selected>Select Speciality</option>
                    @foreach($speciality as $s)
                        <option value="{{$s->speciality}}">{{$s->speciality}}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white" style="height:200px;">
                <div class="card-body">
                    <h4 class="font-weight-normal mb-3">Total Doctors Registered<i class="mdi mdi-chart-line mdi-24px float-right"></i></h4>
                    <h2 class="mb-5 doctor_count">{{$doctor}}</h2>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <h4 class="font-weight-normal mb-3">Total Doctors Registered</h4>
            <div id="doctorPieChart" style="width: 100%; height:300px;">

            </div>
        </div>
        {{-- <div class="col-md-4">
            <h4 class="font-weight-normal mb-3">Total Consumer Registered</h4>
            <canvas id="userPieChart"></canvas>
        </div> --}}
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script>
  $(document).ready(function() {
      var doctorPieChart;
      var userPieChart;

      // Function to create or update the doctor pie chart
      function updateDoctorPieChart(data) {
          const labels = data.map(item => item.label);
          const counts = data.map(item => item.count);

          const hasData = data && data.length > 0;

          // Initialize or update the chart
          if (!doctorPieChart) {
              doctorPieChart = echarts.init(document.getElementById('doctorPieChart'));
          }

          doctorPieChart.setOption({
              title: {
                //   text: 'Doctor Distribution',
                  left: 'center'
              },
              tooltip: {
                  trigger: 'item',
                  formatter: '{b}: {c}'
              },
            //   legend: {
            //       orient: 'horizontal',
            //       data: labels,
            //   },
              series: [
                {
                    name: 'Doctors',
                    type: 'pie',
                    radius: '50%',
                    data: hasData
                        ? labels.map((label, index) => ({ name: label, value: counts[index] }))
                        : [{ name: 'No Data', value: 0 }],
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)'
                        }
                    },
                    label: {
                        show: true,
                        formatter: '{b}: {c}', // Show label and count in the pie chart
                        position: 'outside', // Place labels outside the pie chart
                    },
                    labelLine: {
                        show: true, // Display lines connecting labels to slices
                    },
                    tooltip: {
                        trigger: 'item',
                        formatter: '{b}: {c} ({d}%)' // Tooltip includes name, count, and percentage
                    }
                }
            ]

          });
      }

      // Function to create or update the user pie chart
      function updateUserPieChart(data) {
          const labels = data.map(item => item.label);
          const counts = data.map(item => item.count);

          const hasData = data && data.length > 0;

          // Initialize or update the chart
          if (!userPieChart) {
              userPieChart = echarts.init(document.getElementById('userPieChart'));
          }

          userPieChart.setOption({
              title: {
                  text: 'User Distribution',
                  left: 'center'
              },
              tooltip: {
                  trigger: 'item',
                  formatter: '{b}: {c}'
              },
              legend: {
                  orient: 'horizontal',
                  bottom: '10%',
                  data: hasData ? labels : ['No Data']
              },
              series: [
                  {
                      name: 'Users',
                      type: 'pie',
                      radius: '50%',
                      data: hasData
                          ? labels.map((label, index) => ({ name: label, value: counts[index] }))
                          : [{ name: 'No Data', value: 0 }],
                      emphasis: {
                          itemStyle: {
                              shadowBlur: 10,
                              shadowOffsetX: 0,
                              shadowColor: 'rgba(0, 0, 0, 0.5)'
                          }
                      }
                  }
              ]
          });
      }

      // Fetch initial data and update both charts
      fetchDoctorData();
      fetchUserData();

      $('#country, #speciality').change(function() {
          fetchDoctorData();
          fetchUserData();
      });

      function fetchDoctorData() {
          var country = $('#country').val();
          var speciality = $('#speciality').val();

          $.ajax({
              url: "{{ route('adminfillter') }}",
              method: 'get',
              data: { country, speciality },
              success: function(data) {
                  $('.doctor_count').html(data.datacenter || 0);
                  updateDoctorPieChart(data.chartData || []);
              },
              error: function() {
                  $('.doctor_count').html(0);
                  updateDoctorPieChart([]);
              }
          });
      }

      function fetchUserData() {
          var country = $('#country').val();

          $.ajax({
              url: "{{ route('userCountryFilter') }}", // Add a new route for this function in your controller
              method: 'get',
              data: { country },
              success: function(data) {
                  updateUserPieChart(data.userChartData || []);
              },
              error: function() {
                  updateUserPieChart([]);
              }
          });
      }
  });
</script>

@endsection

@extends('layouts.master')

@section('content')
<style>
  .bg-clients {
    background: linear-gradient(135deg, #2980B9, #3498DB); /* Blue */
  }

  .bg-projects {
    background: linear-gradient(135deg, #8E44AD, #9B59B6); /* Purple */
  }
  
  .bg-member { 
    background: linear-gradient(135deg, #16A085, #138D75); 
  } /* Green */

  .bg-closed-projects {
    background: linear-gradient(135deg, #16A085, #138D75); /* Green */
  }
  .dashboard-card {
    border-radius: 12px !important;
    transition: 0.3s ease;
    height: 150px;
  }

  .dashboard-card:hover {
    transform: translateY(-5px);
  }
</style>

<!-- External CSS and JS -->
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script src="https://cdn.jsdelivr.net/npm/echarts@5.4.2/dist/echarts.min.js"></script>

<div class="content-wrapper">
  <div class="page-header d-flex justify-content-between align-items-center">
    <h3 class="page-title">
      <span class="mr-2 text-white page-title-icon bg-gradient-primary">
        <i class="mdi mdi-home"></i>
      </span> Business Research Manager Dashboard
    </h3>
  </div>

  <!-- Filter Section -->
  <div class="row mb-4">
    <div class="col-md-3">
      <input type="text" class="form-control" id="daterange" name="daterange" placeholder="Select Date Range">
    </div>
    <div class="col-md-3">
      <select class="form-control" id="industryFilter">
        <option class="" value="" disabled selected>Select Industry</option>
        <option value="Manufacturing Industry">Manufacturing Industry</option>
        <option value="Production Industry">Production Industry</option>
        <option value="Food Industry">Food Industry</option>
        <option value="Agricultural Industry">Agricultural Industry</option>
        <option value="Technology Industry">Technology Industry</option>
        <option value="Construction Industry">Construction Industry</option>
        <option value="Factory Industry">Factory Industry</option>
        <option value="Mining Industry">Mining Industry</option>
        <option value="Finance Industry">Finance Industry</option>
        <option value="Retail Industry">Retail Industry</option>
        <option value="Engineering Industry">Engineering Industry</option>
        <option value="Marketing Industry">Marketing Industry</option>
        <option value="Education Industry">Education Industry</option>
        <option value="Transport Industry">Transport Industry</option>
        <option value="Chemical Industry">Chemical Industry</option>
        <option value="Healthcare Industry">Healthcare Industry</option>
        <option value="Hospitality Industry">Hospitality Industry</option>
        <option value="Energy Industry">Energy Industry</option>
        <option value="Science Industry">Science Industry</option>
        <option value="Waste Industry">Waste Industry</option>
        <option value="Chemistry Industry">Chemistry Industry</option>
        <option value="Teritiary Sector Industry">Teritiary Sector Industry</option>
        <option value="Real Estate Industry">Real Estate Industry</option>
        <option value="Financial Services Industry">Financial Services Industry</option>
        <option value="Telecommunications Industry">Telecommunications Industry</option>
        <option value="Distribution Industry">Distribution Industry</option>
        <option value="Medical Device Industry">Medical Device Industry</option>
        <option value="Biotechnology Industry">Biotechnology Industry</option>
        <option value="Aviation Industry">Aviation Industry</option>
        <option value="Insurance Industry">Insurance Industry</option>
        <option value="Trade Industry">Trade Industry</option>
        <option value="Stock Market Industry">Stock Market Industry</option>
        <option value="Electronics Industry">Electronics Industry</option>
        <option value="Textile Industry">Textile Industry</option>
        <option value="Computers and Information Technology Industry">Computers and Information Technology Industry</option>
        <option value="Market Research Industry">Market Research Industry</option>
        <option value="Machine Industry">Machine Industry</option>
        <option value="Recycling Industry">Recycling Industry</option>
        <option value="Information and Communication Technology Industry">Information and Communication Technology Industry</option>
        <option value="E- Commerce Industry">E- Commerce Industry</option>
        <option value="Research Industry">Research Industry</option>
        <option value="Rail Transport Industry">Rail Transport Industry</option>
        <option value="Food Processing Industry">Food Processing Industry</option>
        <option value="Small Business Industry">Small Business Industry</option>
        <option value="Wholesale Industry">Wholesale Industry</option>
        <option value="Pulp and Paper Industry">Pulp and Paper Industry</option>
        <option value="Vehicle Industry">Vehicle Industry</option>
        <option value="Steel Industry">Steel Industry</option>
        <option value="Renewable Energy Industry">Renewable Energy Industry</option>
      </select>
    </div>
  </div>

  <!-- Cards -->
  <div class="row">
    {{-- <div class="col-md-4">
      <div class="dashboard-card bg-clients text-white p-3 rounded shadow-sm d-flex justify-content-between align-items-center">
        <div>
          <h5 class="mb-1">Total Client</h5>
          <h2 class="mb-0 total_clients">{{ $clientCount }}</h2>
        </div>
        <i class="mdi mdi-account-multiple dashboard-icon"></i>
      </div>      
    </div> --}}

    <div class="col-md-4">
      <div class="dashboard-card bg-projects text-white p-3 rounded shadow-sm d-flex justify-content-between align-items-center">
        <div>
          <h5 class="mb-1">Total Existing Projects</h5>
          <h2 class="mb-0 total_projects">{{$totalProjects}}</h2>
        </div>
        <i class="mdi mdi-briefcase dashboard-icon"></i>
      </div>
    </div>

    {{-- <div class="col-md-4">
      <div class="dashboard-card bg-member text-white p-3 rounded shadow-sm d-flex justify-content-between align-items-center">
        <div>
          <h5 class="mb-1">Total Team Members</h5>
          <h2 class="mb-0 total_member">{{ $teamMembersCount }}</h2>
        </div>
        <i class="mdi mdi-account-multiple dashboard-icon"></i>
      </div>
    </div> --}}



    <div class="col-md-4">
      <div class="dashboard-card bg-closed-projects text-white p-3 rounded shadow-sm d-flex justify-content-between align-items-center">
        <div>
          <h5 class="mb-1">Total Closed Projects</h5>
          <h2 class="closed_projects">0</h2>
        </div>
        <i class="mdi mdi-checkbox-marked-circle dashboard-icon"></i>
      </div>
    </div>

  </div>

  <!-- Pie Chart -->
  <div class="row mt-4">
    <div class="col-md-8 d-none">
      <div class="card shadow-sm">
        <div class="card-body">
          <h4 class="card-title">Projects by Industry</h4>
          <div id="industryChart" style="width: 100%; height: 400px;"></div>
        </div>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>


<script>
let start_1 = moment().subtract(365, 'days'); // Default: last 30 days
let end_1 = moment();

$(function () {
  $('#daterange').daterangepicker({
    showDropdowns: true,
    opens: 'right',
    startDate: start_1,
    endDate: end_1,
    autoUpdateInput: false,
    locale: {
      cancelLabel: 'Clear',
      format: 'YYYY-MM-DD'
    },
    ranges: {
      'Today': [moment(), moment()],
      'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
      'Last 7 Days': [moment().subtract(6, 'days'), moment()],
      'Last 30 Days': [moment().subtract(29, 'days'), moment()],
      'This Month': [moment().startOf('month'), moment().endOf('month')],
      'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
    }
  }, function (start, end) {
    start_1 = start;
    end_1 = end;
    $('#daterange').val(start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
    fetchFilteredData();
  });

  $('#daterange').on('cancel.daterangepicker', function () {
    $(this).val('');
    start_1 = '';
    end_1 = '';
    fetchFilteredData();
  });

  $('#industryFilter').on('change', function () {
    fetchFilteredData();
  });

  // Set default visible value in input
  // $('#daterange').val(start_1.format('YYYY-MM-DD') + ' to ' + end_1.format('YYYY-MM-DD'));
 
  // Initial fetch with default dates
  fetchFilteredData();
  renderChart(@json($industryProjects));
});

function fetchFilteredData() {
  const industry = $('#industryFilter').val();

  let data = {
    industry: industry
  };

  if (start_1 && end_1 && typeof start_1.format === 'function') {
    data.start_date = start_1.format('YYYY-MM-DD');
    data.end_date = end_1.format('YYYY-MM-DD');
  }

  $.ajax({
    url: '{{ route("businessresearch.filter") }}',
    method: 'GET',
    data: data,
    success: function (res) {
      $('.total_clients').text(res.clientCount);
      $('.total_projects').text(res.projectCount); 
      $('.total_member').text(res.teamMembersCount);
      $('.closed_projects').text(res.closedProjectsCount);
      renderChart(res.industryData);
    },
    error: function (err) {
      console.error("Error fetching filtered data", err);
    }
  });
}

function renderChart(data, selectedIndustry = null) {
    const chartDom = document.getElementById('industryChart');
    if (!chartDom) return;

    echarts.dispose(chartDom);

    const myChart = echarts.init(chartDom);

    // ✅ Filter only selected industry if provided
    let filteredData = selectedIndustry
        ? data.filter(item => item.industry === selectedIndustry)
        : data;

    let chartData = [];

    if (filteredData.length > 0) {
        // ✅ Sort by total descending
        const sorted = [...filteredData].sort((a, b) => b.total - a.total);

        const top10 = sorted.slice(0, 10);
        const others = sorted.slice(10);

        chartData = top10.map(item => ({
            value: item.total,
            name: item.industry
        }));

        if (others.length > 0) {
            const othersTotal = others.reduce((sum, item) => sum + item.total, 0);
            chartData.push({ value: othersTotal, name: 'Others' });
        }
    } else {
        chartData = [{ value: 1, name: 'No Data' }];
    }

    const option = {
        title: {
            text: `Projects by Industry`,
            left: 'center'
        },
        tooltip: { trigger: 'item' },
        legend: {
            top: '15%',
            left: 'center'
        },
        series: [{
            name: 'Projects',
            type: 'pie',
            radius: '60%',
            data: chartData,
            top: '15%',
            emphasis: {
                itemStyle: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            },
            label: {
                show: true,
                formatter: '{b}' // Label only name
            },
            itemStyle: {
                color: filteredData.length > 0 ? undefined : '#ccc'
            }
        }]
    };

    myChart.setOption(option);
}



</script>
@endpush

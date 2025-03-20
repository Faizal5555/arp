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
        <option value="">All Industries</option>
        @foreach($industryProjects as $industry)
          <option value="{{ $industry->industry }}">{{ $industry->industry }}</option>
        @endforeach
      </select>
    </div>
  </div>

  <!-- Cards -->
  <div class="row">
    <div class="col-md-4">
      <div class="dashboard-card bg-clients text-white p-3 rounded shadow-sm d-flex justify-content-between align-items-center">
        <div>
          <h5 class="mb-1">Total Client</h5>
          <h2 class="mb-0 total_clients">{{ $clientCount }}</h2>
        </div>
        <i class="mdi mdi-account-multiple dashboard-icon"></i>
      </div>
    </div>

    <div class="col-md-4">
      <div class="dashboard-card bg-projects text-white p-3 rounded shadow-sm d-flex justify-content-between align-items-center">
        <div>
          <h5 class="mb-1">Total Projects</h5>
          <h2 class="mb-0 total_projects">{{ $projectCount }}</h2>
        </div>
        <i class="mdi mdi-briefcase dashboard-icon"></i>
      </div>
    </div>

    <div class="col-md-4">
      <div class="dashboard-card bg-member text-white p-3 rounded shadow-sm d-flex justify-content-between align-items-center">
        <div>
          <h5 class="mb-1">Total Team Members</h5>
          <h2 class="mb-0 total_member">{{ $teamMembersCount }}</h2>
        </div>
        <i class="mdi mdi-account-multiple dashboard-icon"></i>
      </div>
    </div>
  </div>

  <!-- Pie Chart -->
  <div class="row mt-4">
    <div class="col-md-8">
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

<script>
 let start_1 = '';
let end_1 = '';


$(function () {
  // Date range picker
  $('#daterange').daterangepicker({
    showDropdowns: true,
    opens: 'right',
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
      'Last 45 Days': [moment().subtract(44, 'days'), moment()],
      'Last 60 Days': [moment().subtract(59, 'days'), moment()],
      'Last 90 Days': [moment().subtract(89, 'days'), moment()],
      'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
    }
  }, function (start, end) {
    start_1 = start.format('YYYY-MM-DD');
    end_1 = end.format('YYYY-MM-DD');
    $('#daterange').val(start_1 + ' to ' + end_1);

    // Auto-fetch data when date changes
    fetchFilteredData();
  });

  $('#daterange').on('cancel.daterangepicker', function () {
    $(this).val('');
    start_1 = '';
    end_1 = '';
    fetchFilteredData();
  });

  // Auto-fetch when industry changes
  $('#industryFilter').on('change', function () {
    fetchFilteredData();
  });

  // Initial chart render
  renderChart(@json($industryProjects));
});

// Function to fetch and update chart + counts
function fetchFilteredData() {
  const industry = $('#industryFilter').val();

  $.ajax({
    url: '{{ route("businessresearch.filter") }}',
    method: 'GET',
    data: {
      start_date: start_1,
      end_date: end_1,
      industry: industry
    },
    success: function (res) {
      $('.total_clients').text(res.clientCount);
      $('.total_projects').text(res.projectCount);
      $('.total_member').text(res.teamMembersCount);
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

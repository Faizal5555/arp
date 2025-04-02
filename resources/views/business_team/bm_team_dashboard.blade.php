@extends('layouts.master')

@section('content')
<style>
  .bg-projects {
    background: linear-gradient(135deg, #8E44AD, #9B59B6); /* Purple */
  }

  .bg-clients {
    background: linear-gradient(135deg, #2980B9, #3498DB); /* Blue */
  }


  .bg-closed-projects {
    background: linear-gradient(135deg, #16A085, #138D75); /* Teal */
  }

  .dashboard-card {
    transition: all 0.3s ease-in-out;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    color: white;
    font-size: 16px;
    font-weight: bold;
    min-width: 180px;
    min-height: 120px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
  }

  /* Icons */
  .dashboard-icon {
    font-size: 35px;
    margin-bottom: 10px;
  }
</style>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<div class="content-wrapper">
  <div class="page-header">
    <h3 class="page-title">
      <span class="mr-2 text-white page-title-icon bg-gradient-primary">
        <i class="mdi mdi-home"></i>
      </span> Business Team Member Dashboard
    </h3>
    <nav aria-label="breadcrumb">
      <ul class="breadcrumb">
        <li class="breadcrumb-item active" aria-current="page">
          <span></span>Overview <i class="align-middle mdi mdi-alert-circle-outline icon-sm text-primary"></i>
        </li>
      </ul>
    </nav>
  </div>

  <div class="row">
    <!-- Industry Dropdown -->
    <div class="col-md-4">
      <label class="mr-2" for="daterange">Industry</label>
        <div class="col-lg-12 mb-3">
          <select class="form-control" name="industry">
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

    <!-- Date Range Picker -->
    <div class="col-md-4">
        <label class="mr-2" for="daterange">Date:</label>
        <input type="text" name="daterange" class="form-control" id="daterange" style="border-color: #237ee6;">
    </div>
  </div>
  
  <div class="row">
    <!-- Total Clients Card -->
    {{-- <div class="col-md-4">
      <div class="dashboard-card bg-clients">
        <i class="mdi mdi-account-group dashboard-icon"></i>
        <h5>Total Clients</h5>
        <h2 class="total_clients">0</h2>
      </div>
    </div> --}}

    <!-- Total Projects Card -->
    <div class="col-md-4">
      <div class="dashboard-card bg-projects">
        <i class="mdi mdi-chart-line dashboard-icon"></i>
        <h5>Total Existing Projects</h5>
        <h2 class="total_projects">{{$totalProjectCount}}</h2>
      </div>
    </div>

    <div class="col-md-4">
      <div class="dashboard-card bg-closed-projects">
          <i class="mdi mdi-checkbox-marked-circle dashboard-icon"></i>
          <h5>Closed Projects</h5>
          <h2 class="closed_projects">0</h2>
      </div>
  </div>
  </div>
</div>

<script>
$(document).ready(function () {
    // Initialize the date range picker
    $('#daterange').daterangepicker({
        autoUpdateInput: false,
        locale: { cancelLabel: 'Clear' },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    // Event when user selects a date range
    $('#daterange').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
        fetchData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format('YYYY-MM-DD'));
    });

    // Function to fetch projects, clients, and closed projects based on the selected date range
    function fetchData(startDate, endDate) {
        $.ajax({
            url: '{{ route('industry.date') }}', // Adjust this route as per your requirement
            method: 'GET',
            data: {
                start_date: startDate,
                end_date: endDate
            },
            success: function (response) {
                // Update the total projects, closed projects, and clients count
                $('.total_projects').text(response.projectsCount);
                $('.total_clients').text(response.clientsCount);
                $('.closed_projects').text(response.closedProjectsCount); // Update Closed Projects
            }
        });
    }

    // Industry Change Event
    $('select[name="industry"]').change(function () {
        var industry = $(this).val();

        $.ajax({
            url: "{{ route('industry.data') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                industry: industry,
                user_id: "{{ auth()->id() }}"
            },
            success: function (response) {
                $('.total_clients').text(response.clientCount);
                $('.total_projects').text(response.projectCount);  // Update total projects
                $('.closed_projects').text(response.closedProjectCount); // Update closed projects
            }
        });
    });
});

</script>

@endsection

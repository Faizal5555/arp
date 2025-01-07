@extends('layouts.master')
@section('page_title', 'User Dashboard')
@section('content')

<div class="content-wrapper">
    <!-- Dropdown to select country -->

    <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
          </span> Global Manager Dashboard
        </h3>
      </div>
    <div class="row">
        <div class="col-md-4">
            <label for="countrySelect">Select Country</label>
            <select id="countrySelect" class="form-control">
                <option value="">Select the country</option>
                @foreach($countries as $country)
                <option value="{{ $country->name }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="countrySelect">Total Hcp Registered Click to see</label>
            <button class="btn btn-primary" id="hcpRegisteredButton">HCP Dashboard</button>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mt-4 ml-3">
            <h4 class="font-weight-normal mb-3">Total Consumer Registered</h4>
            <div id="consumerChart" style="width: 100%; height: 400px;"></div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6 mt-4">
            {{-- <h4 class="font-weight-normal mb-3">Occupations</h4> --}}
            <div id="occupationChart" style="width: 100%; height: 400px;"></div>
        </div>
        <div class="col-md-6 mt-4">
            {{-- <h4 class="font-weight-normal mb-3">Organization Primary Industry</h4> --}}
            <div id="industryChart" style="width: 100%; height: 400px;"></div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const consumerChart = echarts.init(document.getElementById('consumerChart'));
    const occupationChart = echarts.init(document.getElementById('occupationChart'));
    const industryChart = echarts.init(document.getElementById('industryChart'));

    // Fetch and display data for the pie chart (all countries) on page load
    fetchUserChartData(); 

    // Listen for changes in the country dropdown and fetch data for bar charts
    document.getElementById('countrySelect').addEventListener('change', function () {
        const selectedCountry = this.value;
        fetchUserChartData(selectedCountry);
    });

    // Fetch data from the server
    function fetchUserChartData(country = null) {
        $.ajax({
            url: "{{ route('userCountryFilter') }}", // Route to fetch data
            method: 'GET',
            data: { country: country },
            success: function (response) {
                updateUserChart(response.userChartData || []);
                // updateOccupationChart(response.occupationData || []);
                // updateIndustryChart(response.industryData || []);
                if (country) {
                    updateOccupationChart(response.occupationData || []);
                    updateIndustryChart(response.industryData || []);
                } else {
                    clearBarCharts(); // Clear bar charts when no country is selected
                }
            },
            error: function () {
                Swal.fire({
                    title: "Error",
                    text: "Error fetching user data.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            },
        });
    }

    // Initialize bar charts with "No Data"
    function initializeBarCharts() {
        updateOccupationChart([]);
        updateIndustryChart([]);
    }

    // Update User Chart (Pie Chart)
    function updateUserChart(data) {
        const labels = data.length ? data.map(item => item.label) : ['No Data'];
        const counts = data.length ? data.map(item => item.count) : [0];

        const totalCount = counts.reduce((total, num) => total + num, 0);

        consumerChart.setOption({
            title: {
                text: `Total: ${totalCount}`,
                left: 'left',
                top: '85%',
                textStyle: {
                    fontSize: 20,
                    fontWeight: 'bold',
                },
            },
            tooltip: {
                trigger: 'item',
                formatter: function (params) {
                    return `${params.name}: ${params.value}`; // Tooltip shows country name and count
                },
            },
            legend: {
                orient: 'horizontal',
                left: 'center',
                data: labels,
            },
            series: [{
                type: 'pie',
                radius: '50%',
                data: labels.map((label, index) => ({
                    name: label,
                    value: counts[index],
                })),
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)',
                    },
                },
                label: {
                    show: true,
                    formatter: '{b}: {c}', // Show country name and count in pie chart labels
                },
            }],
        });
    }

    // Update Occupation Bar Chart
    function updateOccupationChart(data) {
        const labels = data.length ? data.map(item => item.label) : ['No Data'];
        const counts = data.length ? data.map(item => item.count) : [0];

        occupationChart.setOption({
            title: {
                text: 'Occupations',
                left: 'center',
            },
            tooltip: {
                trigger: 'axis',
                formatter: function (params) {
                    const value = params[0].data;
                    return `${params[0].axisValueLabel}: ${value}`;
                },
                axisPointer: {
                    type: 'shadow',
                },
            },
            grid: {
                bottom: 200, // Increased bottom space for label visibility
            },
            xAxis: {
                type: 'category',
                data: labels,
                axisLabel: {
                    interval: 0, // Show all labels
                    rotate: 45, // Rotate for better visibility
                    padding: [10, 0, 0, 0], // Add padding to avoid truncation
                    formatter: function (value) {
                        return value.length > 20 ? value.substring(0, 20) + '...' : value;
                    },
                },
            },
            yAxis: {
                type: 'value',
                min: 0,
            },
            series: [{
                type: 'bar',
                data: counts,
                barWidth: '50%',
                itemStyle: {
                    color: '#36A2EB',
                },
            }],
        });
    }

    // Update Industry Bar Chart
    function updateIndustryChart(data) {
        const labels = data.length ? data.map(item => item.label) : ['No Data'];
        const counts = data.length ? data.map(item => item.count) : [0];

        industryChart.setOption({
            title: {
                text: 'Organization Primary Industry',
                left: 'center',
            },
            tooltip: {
                trigger: 'axis',
                formatter: function (params) {
                    const value = params[0].data;
                    return `${params[0].axisValueLabel}: ${value}`;
                },
                axisPointer: {
                    type: 'shadow',
                },
            },
            grid: {
                bottom: 200, // Increased bottom space for label visibility
            },
            xAxis: {
                type: 'category',
                data: labels,
                axisLabel: {
                    interval: 0, // Show all labels
                    rotate: 45, // Rotate for better visibility
                    padding: [10, 0, 0, 0], // Add padding to avoid truncation
                    formatter: function (value) {
                        return value.length > 20 ? value.substring(0, 20) + '...' : value;
                    },
                },
            },
            yAxis: {
                type: 'value',
                min: 0,
            },
            series: [{
                type: 'bar',
                data: counts,
                barWidth: '50%',
                itemStyle: {
                    color: '#FF6384',
                },
            }],
        });
    }


    function clearBarCharts() {
        // Clear occupation chart
        occupationChart.setOption({
            // title: { text: 'No Data Available', left: 'center' },
            xAxis: { type: 'category', data: ['No Data'] },
            yAxis: { type: 'value' },
            series: [{ type: 'bar', data: [0] }]
        });

        // Clear industry chart
        industryChart.setOption({
            // title: { text: 'No Data Available', left: 'center' },
            xAxis: { type: 'category', data: ['No Data'] },
            yAxis: { type: 'value' },
            series: [{ type: 'bar', data: [0] }]
        });
    }


        document.getElementById('hcpRegisteredButton').addEventListener('click', function() {
        window.location.href = "{{ route('hcp.pieChart') }}";
    });
    });
   
    </script>
    
@endpush

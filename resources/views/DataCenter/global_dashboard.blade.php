@extends('layouts.master')
@section('page_title', 'Global Dashboard')

@section('content')

<!-- Include Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="container">
    <div class="page-header">
        <h3 class="page-title">
          <span class="page-title-icon bg-gradient-primary text-white mr-2">
            <i class="mdi mdi-home"></i>
          </span> Global Manager Dashboard
        </h3>
      </div>

    <!-- Country Select Dropdown -->
<div class="col-md-4">
    <select id="countrySelect" class="form-control">
        <option value="">Select Country</option>
        @foreach($countries as $country)
            <option value="{{ $country->name }}">{{ $country->name }}</option>
        @endforeach
    </select>

    <!-- Pie Chart -->
    <canvas id="countryChart" width="400" height="400"></canvas>
</div>

<div class="row">
    <div class="col-md-6 mt-4">
        <h4 class="font-weight-normal mb-3">Occupations</h4>
        <canvas id="occupationChart"></canvas>
    </div>

    <!-- Bar chart for industry question (27) -->
    <div class="col-md-6 mt-4">
        <h4 class="font-weight-normal mb-3">Organization Primary Industry</h4>
        <canvas id="industryChart"></canvas>
    </div>
</div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    // Fetch and display country, occupation, and industry chart data on page load
    fetchHcpChartData();

    // Handle country selection changes
    $('#countrySelect').change(function () {
        const selectedCountry = $(this).val();
        fetchHcpChartData(selectedCountry); // Fetch data for the selected country
    });

    // Function to fetch chart data based on selected country
    function fetchHcpChartData(country = null) {
        $.ajax({
            url: "{{ route('global.dashboard') }}",  // Your route to get global dashboard data
            method: 'GET',
            data: { country: country },
            success: function (response) {
                updateCountryChart(response.countryChartData); // Update pie chart for countries
                updateOccupationChart(response.occupationChartData); // Update bar chart for occupation
                updateIndustryChart(response.industryChartData); // Update bar chart for industry
            },
            error: function () {
                Swal.fire({
                    title: "Error",
                    text: "Error fetching chart data.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        });
    }

    // Function to update the country pie chart
    function updateCountryChart(data) {
        let labels, counts, colors;

        if (!data || data.length === 0) {
            labels = ['No Data'];
            counts = [1];
            colors = ['#D3D3D3']; // Light gray for "No Data"
        } else {
            labels = data.map(item => item.label);
            counts = data.map(item => item.count);
            colors = labels.map(() => getRandomColor());
        }

        if (window.countryChart instanceof Chart) {
            window.countryChart.destroy();
        }

        const ctx = document.getElementById('countryChart').getContext('2d');
        window.countryChart = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    data: counts,
                    backgroundColor: colors,
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    tooltip: {
                        enabled: data && data.length > 0, // Disable tooltips if no data
                    },
                },
            },
        });
    }

    // Function to update the occupation bar chart
    function updateOccupationChart(data) {
        let labels, counts;

        if (!data || data.length === 0) {
            labels = ['No Data'];
            counts = [1];
        } else {
            labels = data.map(item => item.label);
            counts = data.map(item => item.count);
        }

        if (window.occupationChart instanceof Chart) {
            window.occupationChart.destroy();
        }

        const ctx = document.getElementById('occupationChart').getContext('2d');
        window.occupationChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Occupation Count',
                    data: counts,
                    backgroundColor: '#FF5733',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { 
                        beginAtZero: true 
                    },
                    y: { 
                        beginAtZero: true 
                    }
                },
            },
        });
    }

    // Function to update the industry bar chart
    function updateIndustryChart(data) {
        let labels, counts;

        if (!data || data.length === 0) {
            labels = ['No Data'];
            counts = [1];
        } else {
            labels = data.map(item => item.label);
            counts = data.map(item => item.count);
        }

        if (window.industryChart instanceof Chart) {
            window.industryChart.destroy();
        }

        const ctx = document.getElementById('industryChart').getContext('2d');
        window.industryChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Industry Count',
                    data: counts,
                    backgroundColor: '#33C4FF',
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: { 
                        beginAtZero: true 
                    },
                    y: { 
                        beginAtZero: true 
                    }
                },
            },
        });
    }

    // Function to generate random colors for the chart
    function getRandomColor() {
        const letters = '0123456789ABCDEF';
        let color = '#';
        for (let i = 0; i < 6; i++) {
            color += letters[Math.floor(Math.random() * 16)];
        }
        return color;
    }
});


</script>

@endsection

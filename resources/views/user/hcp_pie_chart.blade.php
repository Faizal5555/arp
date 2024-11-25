@extends('layouts.master')
@section('page_title', 'HCP Dashboard')
@section('content')

<div class="content-wrapper">

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
    </div>

    <div class="row">
        <div class="col-md-6 mt-4">
            <h4 class="font-weight-normal mb-3">Total HCP Registered by Country</h4>
            <canvas id="countryChart"></canvas>
        </div>

        <div class="col-md-6 mt-4">
            <h4 class="font-weight-normal mb-3">Specialities</h4>
            <canvas id="specialityChart"></canvas>
        </div>
    </div>

</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Fetch and display country chart data on page load
    fetchHcpChartData();

    // Handle country selection changes
    $('#countrySelect').change(function () {
        const selectedCountry = $(this).val();
        if (selectedCountry) {
            fetchHcpChartData(selectedCountry); // Fetch data for the selected country
        } else {
            clearSpecialityChart(); // Clear speciality chart when no country is selected
        }
    });

    // Function to fetch chart data based on selected country
    function fetchHcpChartData(country = null) {
        $.ajax({
            url: "{{ route('hcp.countryData') }}",
            method: 'GET',
            data: { country: country },
            success: function (response) {
                updateCountryChart(response.countryChartData); // Update pie chart for countries

                // Show speciality bar chart only if a country is selected
                if (country) {
                    updateSpecialityChart(response.specialityChartData);
                } else {
                    clearSpecialityChart();
                }
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

    // Function to update the speciality bar chart
    function updateSpecialityChart(data) {
        let labels, counts;

        if (!data || data.length === 0) {
            labels = ['No Data'];
            counts = [1];
        } else {
            labels = data.map(item => item.label);
            counts = data.map(item => item.count);
        }

        if (window.specialityChart instanceof Chart) {
            window.specialityChart.destroy();
        }

        const ctx = document.getElementById('specialityChart').getContext('2d');
        window.specialityChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Specialties',
                    data: counts,
                    backgroundColor: data && data.length > 0 ? '#36A2EB' : '#D3D3D3', // Light gray for "No Data"
                }],
            },
            options: {
                responsive: true,
                scales: {
                    x: { ticks: { maxRotation: 0, minRotation: 0 } },
                    y: { beginAtZero: true },
                },
                plugins: {
                    legend: { display: data && data.length > 0 }, // Hide legend if no data
                    tooltip: {
                        enabled: data && data.length > 0, // Disable tooltips if no data
                    },
                },
            },
        });
    }

    // Function to clear the speciality bar chart
    function clearSpecialityChart() {
        if (window.specialityChart instanceof Chart) {
            window.specialityChart.destroy();
        }

        // Optionally display a placeholder or empty chart
        const ctx = document.getElementById('specialityChart').getContext('2d');
        window.specialityChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['No Data'],
                datasets: [{
                    label: 'Specialties',
                    data: [0],
                    backgroundColor: '#D3D3D3', // Light gray for "No Data"
                }],
            },
            options: {
                responsive: true,
                scales: {
                    x: { display: false }, // Hide x-axis when no data
                    y: { display: false }, // Hide y-axis when no data
                },
                plugins: {
                    legend: { display: false }, // Hide legend when no data
                    tooltip: { enabled: false }, // Disable tooltips when no data
                },
            },
        });
    }

    // Function to generate random colors
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
@endpush

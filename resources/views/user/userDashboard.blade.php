@extends('layouts.master')
@section('page_title', 'User Dashboard')
@section('content')

<div class="content-wrapper">
    {{-- <div class="page-header">
        <h3 class="page-title"> Consumer Registration by Country </h3>
    </div> --}}

    <!-- Dropdown to select country -->
    <div class="row">
        <div class="col-md-4">
            <label for="countrySelect">Select Country</label>
            <select id="countrySelect" class="form-control">
                <option value="">Select the country</option>
                <!-- Assuming $countries is passed to this view with a list of all countries -->
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
            <canvas id="consumerChart"></canvas>
        </div>
       
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

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>

document.addEventListener('DOMContentLoaded', function() {
    // Initial fetch for chart data
    fetchUserChartData();

    // Listen for changes in the country dropdown and fetch data accordingly
    $('#countrySelect').change(function() {
        const selectedCountry = $(this).val();
        fetchUserChartData(selectedCountry);
    });

    // Function to fetch user chart data based on selected country
    function fetchUserChartData(country = null) {
        $.ajax({
            url: "{{ route('userCountryFilter') }}",
            method: 'GET',
            data: { country: country },
            success: function(response) {
                updateUserChart(response.userChartData); // Update the pie chart with registration data
                updateBarCharts(response.occupationData, response.industryData); // Update bar charts for occupation and industry
            },
            error: function() {
                // Use a more user-friendly alert for errors
                Swal.fire({
                    title: "Error",
                    text: "Error fetching user data.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        });
    }

    // Function to update the pie chart with total user registrations by country
    function updateUserChart(data) {
    let labels, counts;

    if (data.length === 0) {
        // Display "No Data" if there is no data
        labels = ["No Data"];
        counts = [0];
    } else {
        // Populate labels and counts with actual data
        labels = data.map(item => item.label);
        counts = data.map(item => item.count);
    }

    // Generate random colors for each label
    const backgroundColors = labels.map(() => getRandomColor());

    // Check if the chart instance exists before attempting to destroy it
    if (window.consumerChart instanceof Chart) {
        window.consumerChart.destroy();
    }

    const ctx = document.getElementById('consumerChart').getContext('2d');
    window.consumerChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: counts,
                backgroundColor: backgroundColors,
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        generateLabels: function(chart) {
                            const data = chart.data;
                            return data.labels.map((label, index) => ({
                                text: `${label} (${data.datasets[0].data[index]})`,
                                fillStyle: data.datasets[0].backgroundColor[index],
                                hidden: chart.getDataVisibility(index),
                                index: index
                            }));
                        }
                    }
                }
            }
        }
    });
}

// Function to generate a random color in hex format
function getRandomColor() {
    const letters = '0123456789ABCDEF';
    let color = '#';
    for (let i = 0; i < 6; i++) {
        color += letters[Math.floor(Math.random() * 16)];
    }
    return color;
}


    // Function to update bar charts for Occupation and Industry
    function updateBarCharts(occupationData, industryData) {
    const occupationLabels = occupationData.map(item => item.label);
    const occupationCounts = occupationData.map(item => item.count);

    const industryLabels = industryData.map(item => item.label);
    const industryCounts = industryData.map(item => item.count);

    // Destroy existing bar charts if they exist
    if (window.occupationChart instanceof Chart) {
        window.occupationChart.destroy();
    }
    if (window.industryChart instanceof Chart) {
        window.industryChart.destroy();
    }

    // Occupation Bar Chart
    const ctxOccupation = document.getElementById('occupationChart').getContext('2d');
    window.occupationChart = new Chart(ctxOccupation, {
        type: 'bar',
        data: {
            labels: occupationLabels,
            datasets: [{
                label: 'Occupation',
                data: occupationCounts,
                backgroundColor: '#36A2EB',
            }]
        },
        options: {
            responsive: true,
            layout: {
                padding: {
                    bottom: 30 // Increase space at the bottom for long labels
                }
            },
            scales: {
                x: {
                    ticks: {
                        maxRotation: 0,   // Set rotation to horizontal for better wrapping
                        minRotation: 0,
                        callback: function(value) {
                            const maxLabelLength = 10; // Adjust this as needed
                            if (value.length > maxLabelLength) {
                                return value.substring(0, maxLabelLength) + '...'; // Truncate with ellipsis
                            }
                            return value;
                        }
                    }
                },
                y: { beginAtZero: true }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        title: function(tooltipItem) {
                            return occupationLabels[tooltipItem[0].dataIndex]; // Show full label in tooltip
                        }
                    }
                }
            }
        }
    });

    // Industry Bar Chart
    const ctxIndustry = document.getElementById('industryChart').getContext('2d');
    window.industryChart = new Chart(ctxIndustry, {
        type: 'bar',
        data: {
            labels: industryLabels,
            datasets: [{
                label: 'Industry',
                data: industryCounts,
                backgroundColor: '#FF6384',
            }]
        },
        options: {
            responsive: true,
            layout: {
                padding: {
                    bottom: 30 // Increase space at the bottom for long labels
                }
            },
            scales: {
                x: {
                    ticks: {
                        maxRotation: 0,   // Set rotation to horizontal for better wrapping
                        minRotation: 0,
                        callback: function(value) {
                            const maxLabelLength = 10; // Adjust this as needed
                            if (value.length > maxLabelLength) {
                                return value.substring(0, maxLabelLength) + '...'; // Truncate with ellipsis
                            }
                            return value;
                        }
                    }
                },
                y: { beginAtZero: true }
            },
            plugins: {
                tooltip: {
                    callbacks: {
                        title: function(tooltipItem) {
                            return industryLabels[tooltipItem[0].dataIndex]; // Show full label in tooltip
                        }
                    }
                }
            }
        }
    });
}

document.getElementById('hcpRegisteredButton').addEventListener('click', function() {
    window.location.href = "{{ route('hcp.pieChart') }}";
});

});

</script>


@endpush

@extends('layouts.master')
@section('page_title', 'HCP Dashboard')
@section('content')


<div class="page-header">
    <h3 class="page-title">
      <span class="page-title-icon bg-gradient-primary text-white mr-2">
        <i class="mdi mdi-home"></i>
      </span> Dashboard
    </h3>
  </div>

<div class="content-wrapper">

    <div class="row mb-4">
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
        <div class="col-md-6">
            <h4 class="font-weight-normal mb-3">Total Country</h4>
            <canvas id="countryChart"></canvas>
        </div>

        <div class="col-md-6">
            <h4 class="font-weight-normal mb-3">Specialities</h4>
            <canvas id="specialityChart"></canvas>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 mt-4">
            <h4 class="font-weight-normal mb-3">Doctors by Specialty and Country</h4>
            <table class="table table-bordered text-center" id="recruitmentTable">
                <thead>
                    <tr>
                        <th rowspan="2">Specialty</th>
                        <th colspan="{{ count($countries) + 1 }}">Countries</th>
                    </tr>
                    <tr id="countryHeaders">
                        <!-- Country headers will be dynamically populated -->
                    </tr>
                </thead>
                <tbody id="tableBody">
                    <!-- Rows will be dynamically populated -->
                </tbody>
            </table>
        </div>
    </div>

</div>

@endsection
<style>
.table th, .table td {
    text-align: center;
    vertical-align: middle;
}

.table th {
    background-color: #f8f9fa; /* Light background for header */
}

.table td:last-child {
    font-weight: bold;
    background-color: #e9ecef; /* Light gray for total count */
}

</style>

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
            url: "{{ route('get.recruitment.data') }}",
            method: 'GET',
            data: { country: country },
            success: function (response) {
                updateCountryChart(response.countryChartData || []); // Pass empty array for "No Data"
                if (country) {
                    updateSpecialityChart(response.specialityChartData || []);
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

                // Clear both charts on error
                updateCountryChart([]);
                clearSpecialityChart();
            }
        });
    }

    // Function to update the country pie chart
  // Function to update the country pie chart
function updateCountryChart(data) {
    const hasData = Array.isArray(data) && data.length > 0;
    const labels = hasData ? data.map(item => item.label) : ['No Data'];
    const counts = hasData ? data.map(item => item.count) : [1]; // Placeholder count for "No Data"
    const colors = hasData ? labels.map(() => getRandomColor()) : ['#D3D3D3']; // Gray for "No Data"

    // Destroy the existing chart if it exists
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
            }],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                },
                tooltip: {
                    enabled: hasData,
                },
                // Annotation for displaying "No Records" in the center when no data
                datalabels: {
                    display: !hasData,
                    formatter: function () {
                        return 'No Data';
                    },
                    color: '#666',
                    font: {
                        size: 16,
                    },
                },
            },
        },
    });
}



    // Function to update the speciality bar chart
    function updateSpecialityChart(data) {
        const hasData = Array.isArray(data) && data.length > 0;
        const labels = hasData ? data.map(item => item.label) : ['No Data'];
        const counts = hasData ? data.map(item => item.count) : [0];
        const color = hasData ? '#36A2EB' : '#D3D3D3'; // Gray for "No Data"

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
                    backgroundColor: color,
                }],
            },
            options: {
                responsive: true,
                scales: {
                    x: { ticks: { maxRotation: 0, minRotation: 0 } },
                    y: { beginAtZero: true },
                },
                plugins: {
                    legend: { display: hasData },
                    tooltip: { enabled: hasData },
                },
            },
        });
    }

    // Function to clear the speciality bar chart
    function clearSpecialityChart() {
        if (window.specialityChart instanceof Chart) {
            window.specialityChart.destroy();
        }

        const ctx = document.getElementById('specialityChart').getContext('2d');
        window.specialityChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['No Data'],
                datasets: [{
                    label: 'Specialties',
                    data: [0],
                    backgroundColor: '#D3D3D3',
                }],
            },
            options: {
                responsive: true,
                scales: {
                    x: { display: false },
                    y: { display: false },
                },
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false },
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

document.addEventListener('DOMContentLoaded', function () {
    fetchRecruitmentData();

    function fetchRecruitmentData() {
        $.ajax({
            url: "{{ route('get.recruitment.list') }}", // Adjust route to match your backend
            method: 'GET',
            success: function (response) {
                renderTable(response.countries, response.specialities, response.data);
            },
            error: function () {
                Swal.fire({
                    title: "Error",
                    text: "Error fetching table data.",
                    icon: "error",
                    confirmButtonText: "OK"
                });
            }
        });
    }

    function renderTable(countries, specialities, data) {
        const tableBody = document.getElementById('tableBody');
        const countryHeaders = document.getElementById('countryHeaders');

        // Clear existing table headers and rows
        countryHeaders.innerHTML = '';
        tableBody.innerHTML = '';

        // Populate country headers
        countries.forEach(country => {
            const th = document.createElement('th');
            th.textContent = country;
            countryHeaders.appendChild(th);
        });

        // Add "Total Count" header
        const totalHeader = document.createElement('th');
        totalHeader.textContent = "Total Count";
        totalHeader.style.backgroundColor = "#f8f9fa"; // Light gray for distinction
        countryHeaders.appendChild(totalHeader);

        // Add rows for each specialty
        specialities.forEach(speciality => {
            const row = document.createElement('tr');
            
            // Specialty name column
            const specialityCell = document.createElement('td');
            specialityCell.textContent = speciality;
            row.appendChild(specialityCell);

            // Country count columns
            let total = 0;
            countries.forEach(country => {
                const cell = document.createElement('td');
                const count = data[speciality] && data[speciality][country] ? data[speciality][country] : 0;
                cell.textContent = count === 0 ? '-' : count; 
                row.appendChild(cell);
                total += count;
            });

            // Total count column
            const totalCell = document.createElement('td');
            totalCell.textContent = total;
            totalCell.style.fontWeight = "bold"; // Highlight total
            totalCell.style.backgroundColor = "#e9ecef"; // Light gray for distinction
            row.appendChild(totalCell);

            // Append row to the table body
            tableBody.appendChild(row);
        });
    }
});


</script>
@endpush

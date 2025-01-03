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
            <div id="countryChart" style="width: 100%; height: 400px;"></div>
        </div>

        <div class="col-md-6 mt-4">
            <h4 class="font-weight-normal mb-3 d-flex justify-content-center">Specialities</h4>
            <div id="specialityChart" style="width: 100%; height: 400px;"></div>
        </div>
    </div>

    <div class="row">
        @if(auth()->user()->user_type == 'admin' || (auth()->user()->user_type == 'global_manager'))
        <div class="col-md-12 mt-4">
            <div class="table-container"> 
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
        @endif
    </div>
</div>

@endsection
<style>

.table-container {
    max-width: 100%; /* Constrains container width */
    overflow-x: auto; /* Enables horizontal scrolling */
    margin-top: 20px; /* Adds some spacing above the table */
    border: 1px solid #ddd; /* Optional: Add a subtle border for clarity */
    border-radius: 5px; /* Optional: Smooth corners */
}

.table {
    width: 100%; /* Allow the table to stretch fully */
    min-width: 800px; /* Adjust this based on your minimum column needs */
    border-collapse: collapse;
}
    .table th, .table td {
        text-align: center;
        vertical-align: middle;
    }
    
    .table th {
        background-color: #f8f9fa; /* Light background for header */
    }

    .table thead th {
    position: sticky;
    top: 0;
    background-color: #f8f9fa; /* Light background for the sticky header */
    z-index: 1; /* Ensure header stays above the table body */
}

    .table td:first-child, .table th:first-child {
    position: sticky;
    left: 0;
    background-color: #fff; /* White background for the sticky column */
    z-index: 2; /* Ensure the sticky column is above other content */
    box-shadow: 2px 0 5px rgba(0, 0, 0, 0.1); /* Optional: Add shadow for visual separation */
}

.table td:first-child{
    font-weight: bold;
}
    
    .table td:last-child {
        font-weight: bold;
        background-color: #e9ecef; /* Light gray for total count */
    }
    
    </style>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize charts
    const countryChart = echarts.init(document.getElementById('countryChart'));
    const specialityChart = echarts.init(document.getElementById('specialityChart'));

    // Fetch and display data on page load
    fetchHcpChartData();

    // Handle country selection changes
    document.getElementById('countrySelect').addEventListener('change', function () {
        const selectedCountry = this.value;
        if (selectedCountry) {
            fetchHcpChartData(selectedCountry); // Fetch data for the selected country
        } else {
            fetchHcpChartData(); // Fetch all data when no country is selected
        }
    });

    // Function to fetch chart data
    function fetchHcpChartData(country = null) {
        $.ajax({
            url: "{{ route('hcp.countryData') }}",
            method: 'GET',
            data: { country: country },
            success: function (response) {
                updateCountryChart(response.countryChartData); // Update pie chart
                if (country) {
                    updateSpecialityChart(response.specialityChartData); // Update bar chart
                } else {
                    clearSpecialityChart(); // Clear speciality chart when no specific country is selected
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

    // Update pie chart for countries
    function updateCountryChart(data) {
        if (data && data.length > 0) {
            const labels = data.map(item => item.label);
            const counts = data.map(item => item.count);
            const totalCount = counts.reduce((sum, count) => sum + count, 0);
            // Ensure the chart container is cleared before updating
            document.getElementById('countryChart').innerHTML = '<div id="countryChartContainer" style="width: 100%; height: 400px;"></div>';
            const chartDom = document.getElementById('countryChartContainer');
            const countryChart = echarts.init(chartDom);

            countryChart.setOption({
                title: {
                text: `Total: ${totalCount}`, // Display total count
                left: 'right', // Position on the top right
                top: '10%', // Adjust position as needed
                textStyle: {
                    fontSize: 16,
                    fontWeight: 'bold',
                },
                },
                tooltip: {
                    trigger: 'item',
                    formatter: function (params) {
                        return `${params.name}: ${params.value}`; // Tooltip format
                    },
                },
               legend: {
                    orient: data.length > 12 ? 'vertical' : 'horizontal', // Switch layout based on legend count
                    left: data.length > 12 ? 'right' : 'center',
                    top: data.length > 12 ? 'middle' : 'top',
                    data: labels,
                    type: data.length > 12 ? 'scroll' : 'plain', // Enable scroll if items are more than 12
                },
                series: [
                    {
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
                            formatter: '{b}: {c}',
                        },
                    },
                ],
            });
        } else {
            // Clear the chart and display a placeholder message
            document.getElementById('countryChart').innerHTML = `
                <div style="text-align: center; color: gray; font-size: 14px;">
                    No Data Available
                </div>`;
        }
    }

    // Update bar chart for specialties
    function updateSpecialityChart(data) {
        const labels = data && data.length ? data.map(item => item.label) : ['No Data'];
        const counts = data && data.length ? data.map(item => item.count) : [0];

        specialityChart.setOption({
            title: {
                // text: 'Specialities by Count',
                left: 'center',
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: {
                    type: 'shadow',
                },
            },
            grid: {
                bottom: 150,
            },
            xAxis: {
                type: 'category',
                data: labels,
                axisLabel: {
                    interval: 0,
                    rotate: 45,
                    padding: [10, 0, 0, 0],
                    formatter: function (value) {
                        return value.length > 20 ? value.substring(0, 20) + '...' : value;
                    },
                },
            },
            yAxis: {
                type: 'value',
                min: 0,
            },
            series: [
                {
                    type: 'bar',
                    data: counts,
                    barWidth: '50%',
                    itemStyle: {
                        color: '#36A2EB',
                    },
                },
            ],
        });
    }

    // Clear speciality bar chart
    function clearSpecialityChart() {
        specialityChart.setOption({
            title: {
                // text: 'Specialities by Count',
                left: 'center',
            },
            xAxis: {
                type: 'category',
                data: ['No Data'],
            },
            yAxis: {
                type: 'value',
                min: 0,
            },
            series: [
                {
                    type: 'bar',
                    data: [0],
                    barWidth: '50%',
                    itemStyle: {
                        color: '#D3D3D3',
                    },
                },
            ],
        });
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

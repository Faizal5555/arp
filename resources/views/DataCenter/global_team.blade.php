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
            <div id="countryChart" style="width: 100%; height: 400px;"></div>
        </div>

        <div class="col-md-6">
            <h4 class="font-weight-normal mb-3 d-flex justify-content-center">Specialities</h4>
            <div id="specialityChart" style="width: 100%; height: 400px;"></div>
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
<script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    // Initialize charts
    const countryChart = echarts.init(document.getElementById('countryChart'));
    const specialityChart = echarts.init(document.getElementById('specialityChart'));

    // Fetch and display country chart data on page load
    fetchHcpChartData();

    // Initialize the Specialities chart with "No Data" on page load
    updateSpecialityChart([]); 

    // Handle country selection changes
    document.getElementById('countrySelect').addEventListener('change', function () {
        const selectedCountry = this.value;
        fetchHcpChartData(selectedCountry); // Fetch data for the selected country or all countries
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
                    updateSpecialityChart([]); // Ensure "No Data" is shown for specialties on no country selection
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
                updateSpecialityChart([]);
            }
        });
    }

    // Function to update the country pie chart
    function updateCountryChart(data) {
        const hasData = Array.isArray(data) && data.length > 0;
        const labels = hasData ? data.map(item => item.label) : ['No Data'];
        const counts = hasData ? data.map(item => item.count) : [0]; // Placeholder count for "No Data"

        countryChart.setOption({
            title: {
                left: 'center',
            },
            tooltip: {
                trigger: 'item',
                formatter: function (params) {
                    return `${params.name}: ${params.value}`; // Tooltip format
                },
            },
            legend: {
                orient: 'horizontal',
                data: labels,
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
                        formatter: '{b}: {c}', // Show country name and count in pie chart labels
                    },
                },
            ],
        });
    }

    // Function to update the speciality bar chart
    function updateSpecialityChart(data) {
    const hasData = Array.isArray(data) && data.length > 0;
    const labels = hasData ? data.map(item => item.label) : ['No Data'];
    const counts = hasData ? data.map(item => item.count) : [0];

    specialityChart.setOption({
        title: {
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
                rotate: 45,
                formatter: function (value) {
                    return value.length > 15 ? value.substring(0, 15) + '...' : value;
                },
            },
        },
        yAxis: {
            type: 'value',
            min: 0,
            splitLine: {
                show: false, // Remove unnecessary grid lines
            },
        },
        series: [
            {
                type: 'bar',
                data: counts,
                barWidth: '50%',
                itemStyle: {
                    color: hasData ? '#36A2EB' : '#D3D3D3', // Gray for "No Data"
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

@extends('layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12 mb-3">
            <div class="col-md-4">
                <label for="countrySelect">Select Country</label>
                <select name="country" id="countryFilter" class="form-control">
                    <option value="">Select the Country</option>
                    @foreach($countries as $country)
                        <option value="{{ $country->name }}" {{ $countryFilter == $country->name ? 'selected' : '' }}>
                            {{ $country->name }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Suppliers by Country (Pie Chart) -->
        <div class="col-md-5">
            <div class="card" style="border: none;">
                <div class="card-header" style="border-bottom: none;">
                    <h5>Suppliers by Country</h5>
                </div>
                <div class="card-body">
                    <div id="suppliersByCountryPieChart" style="height: 400px;"></div>
                </div>
            </div>
        </div>

        <!-- Suppliers by Name (Bar Chart) -->
        <div class="col-md-7">
            <div class="card" style="border: none;">
                <div class="card-header" style="border-bottom: none;">
                    <h5>Suppliers by Name</h5>
                </div>
                <div class="card-body">
                    <div id="suppliersByNameBarChart" style="height: 400px;"></div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script>
 document.addEventListener('DOMContentLoaded', function () {
    const suppliersByCountryPieChart = echarts.init(document.getElementById('suppliersByCountryPieChart'));
    const suppliersByNameBarChart = echarts.init(document.getElementById('suppliersByNameBarChart'));

    // Initial empty state for the bar chart
    renderBarChart([]);

    // Render pie chart with all countries initially
    const suppliersByCountryData = {!! json_encode($suppliersByCountry) !!};
    renderPieChart(suppliersByCountryData);

    // Event listener for country filter
    document.getElementById('countryFilter').addEventListener('change', function () {
        const selectedCountry = this.value;

        // Fetch data based on the selected country
        fetch(`{{ route('supplier.dashboard') }}?country=${selectedCountry}`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
            },
        })
            .then(response => response.json())
            .then(data => {
                if (data.suppliersByCountry.length === 0) {
                    showNoRecordsMessage(suppliersByCountryPieChart, 'No Records');
                } else {
                    renderPieChart(data.suppliersByCountry);
                }

                renderBarChart(data.suppliersData); // Update bar chart with data
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    });

    // Render pie chart function remains unchanged
    function renderPieChart(data) {
    suppliersByCountryPieChart.clear(); // Clear any existing chart

    // Check if data is empty
    const chartData = data.length === 0 
        ? [{ value: 0, name: 'No Data' }] // Default "No Data" slice
        : data.map(item => ({
            value: item.count,
            name: item.supplier_country,
        }));
     
    const totalCount = chartData.reduce((sum, item) => sum + item.value, 0);
    suppliersByCountryPieChart.setOption({
        title: {
            text: `Total: ${totalCount}`,
            left: 'left', // Position on the top right
            top: '95%', // Adjust position as needed
            textStyle: {
                fontSize: 20,
                fontWeight: 'bold',
            },
        },
        tooltip: {
            trigger: 'item',
            formatter: '{b}: {c}', // Tooltip format for pie chart
        },
        // legend: {
        //     orient: 'horizontal',
        //     left: 'left',
        //     data: chartData.map(item => item.name),
        // },
        series: [
            {
                name: 'Suppliers',
                type: 'pie',
                radius: '50%',
                center: ['50%', '40%'],
                data: chartData,
                emphasis: {
                    itemStyle: {
                        shadowBlur: 10,
                        shadowOffsetX: 0,
                        shadowColor: 'rgba(0, 0, 0, 0.5)',
                    },
                },
                label: {
                    show: true,
                    formatter: '{b}: {c}', // Label format for pie chart
                    position: 'outside',
                },
            },
        ],
    });
}


    function renderBarChart(data) {
    suppliersByNameBarChart.clear(); // Clear any existing chart

    if (data.length === 0) {
        // Show "No Data" message if there's no data
        suppliersByNameBarChart.setOption({
            tooltip: {
                trigger: 'item',
                formatter: '{b}: {c}', // Show "No Data" on hover
            },
            xAxis: {
                type: 'category',
                data: ['No Data'], // Display "No Data" as the category
                axisLabel: {
                    show: true,
                    interval: 0,
                    rotate: 45,
                    color: '#999',
                },
            },
            yAxis: {
                type: 'value',
                axisLabel: {
                    show: true,
                    color: '#999',
                },
            },
            series: [
                {
                    data: [0], // Display 0 value for "No Data"
                    type: 'bar',
                    color: '#E0E0E0', // Light grey color for "No Data" bar
                },
            ],
        });
    } else {
        // Render the chart with the provided data
        suppliersByNameBarChart.setOption({
            tooltip: {
                trigger: 'axis',
                formatter: function (params) {
                    const item = params[0]; // Get the first item in the tooltip
                    return `${item.name}: ${item.value}`; // Tooltip format
                },
            },
            grid: {
                bottom: 200, // Increased bottom space for label visibility
            },
            xAxis: {
                type: 'category',
                data: data.map(item => item.supplier_company),
                axisLabel: {
                    interval: 0,
                    rotate: 45,
                    formatter: function (value) {
                        return value.length > 15
                            ? value.substring(0, 15) + '...'
                            : value; // Truncate long labels
                    },
                },
            },
            grid: {
                bottom: 150,
            },
            yAxis: {
                type: 'value',
            },
            series: [
                {
                    data: data.map(item => item.count),
                    type: 'bar',
                    color: '#5470c6', // Bar color for valid data
                },
            ],
        });
    }
}


        function showNoRecordsMessage(chart, message) {
            chart.clear(); // Clear any existing chart
            chart.setOption({
                title: {
                    text: message,
                    left: 'center',
                    top: 'center',
                    textStyle: {
                        fontSize: 18,
                        color: '#999',
                    },
                },
            });
        }
    });
</script>
@endsection

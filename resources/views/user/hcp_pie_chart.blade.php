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
</div>

@endsection

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

            // Ensure the chart container is cleared before updating
            document.getElementById('countryChart').innerHTML = '<div id="countryChartContainer" style="width: 100%; height: 400px;"></div>';
            const chartDom = document.getElementById('countryChartContainer');
            const countryChart = echarts.init(chartDom);

            countryChart.setOption({
                title: {
                    // text: 'Total HCP Registered by Country',
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
                    left: 'left',
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

</script>
@endpush

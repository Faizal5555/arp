@extends('layouts.master')
@section('page_title', 'HCP Dashboard')
@section('content')

<div class="content-wrapper">
    <div class="row">
        <div class="col-md-4">
            <input type="hidden" name="" id="user_id" value="{{ $user_id }}"> 
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
            <h4>Total HCP Registered by Country</h4>
            <div id="countryChart" style="width: 100%; height: 400px;"></div>
        </div>

        <div class="col-md-6 mt-4">
            <h4 class="d-flex justify-content-center">Specialities</h4>
            <div id="specialityChart" style="width: 100%; height: 400px;"></div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/echarts@5/dist/echarts.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const countryChart = echarts.init(document.getElementById('countryChart'));
    const specialityChart = echarts.init(document.getElementById('specialityChart'));

    // Fetch data on page load for all countries (pie chart only)
    fetchHcpChartData();

    // Fetch data when a country is selected
    document.getElementById('countrySelect').addEventListener('change', function () {
        const selectedCountry = this.value || null;
        fetchHcpChartData(selectedCountry);
    });

    function fetchHcpChartData(country = null) {
        const user_id = $('#user_id').val(); // Fetch user_id from hidden input or DOM
        $.ajax({
            url: "{{ route('hcp.country') }}",
            method: 'POST',
            data: { country: country, user_id: user_id },
            success: function (response) {
                // Update pie chart with country data
                updateCountryChart(response.countryChartData);

                // Update bar chart with specialties only when a country is selected
                if (country) {
                    updateSpecialityChart(response.specialityChartData);
                } else {
                    clearSpecialityChart(); // Clear the bar chart when no country is selected
                }
            },
            error: function () {
                Swal.fire("Error", "Failed to fetch HCP data", "error");
            }
        });
    }

    function updateCountryChart(data) {
        const hasData = data.length > 0;
        const labels = hasData ? data.map(item => item.label) : ['No Data'];
        const counts = hasData ? data.map(item => item.count) : [0];
        const totalCount = counts.reduce((sum, count) => sum + count, 0);
        countryChart.setOption({
            title: {
                text: `Total: ${totalCount}`, // Display total count
                left: 'left', // Position on the top right
                top: '85%', // Adjust position as needed
                textStyle: {
                    fontSize: 20,
                    fontWeight: 'bold',
                },
            },
            tooltip: {
                trigger: 'item',
                formatter: '{b}: {c}', // Tooltip shows country and count
            },
            // legend: {
            //     orient: 'horizontal',
            //     left: 'left',
            //     data: labels,
            // },
            series: [
                {
                    type: 'pie',
                    radius: '50%',
                    data: labels.map((label, index) => ({ name: label, value: counts[index] })),
                    emphasis: {
                        itemStyle: {
                            shadowBlur: 10,
                            shadowOffsetX: 0,
                            shadowColor: 'rgba(0, 0, 0, 0.5)',
                        },
                    },
                    label: {
                        show: true,
                        formatter: '{b}: {c}', // Pie chart label shows country and count
                    },
                },
            ],
        });
    }

    function updateSpecialityChart(data) {
        const hasData = data.length > 0;
        const labels = hasData ? data.map(item => item.label) : ['No Data'];
        const counts = hasData ? data.map(item => item.count) : [0];

        specialityChart.setOption({
            title: {
                // text: hasData ? 'Specialities by Count' : 'No Data Available',
                left: 'center',
            },
            tooltip: {
                trigger: 'axis',
                axisPointer: { type: 'shadow' },
                formatter: function (params) {
                    return `${params[0].axisValueLabel}: ${params[0].data}`; // Tooltip format
                },
            },
            grid: { bottom: 100 }, // Add space for rotated labels
            xAxis: {
                type: 'category',
                data: labels,
                axisLabel: {
                    interval: 0,
                    rotate: 45, // Rotate labels for better readability
                    formatter: function (value) {
                        return value.length > 20 ? value.substring(0, 20) + '...' : value; // Truncate long labels
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
                    itemStyle: { color: '#36A2EB' }, // Bar color
                },
            ],
        });
    }

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
                    itemStyle: { color: '#D3D3D3' },
                },
            ],
        });
    }
});

</script>
@endpush

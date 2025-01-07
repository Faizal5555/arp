@extends('layouts.master')
@section('page_title', 'User Dashboard')
@section('content')

<div class="content-wrapper">
    <!-- Dropdown to select country -->
    <div class="row">
        <input type="hidden" name="" id="user_id" value="{{ $user_id ?? '' }}"> 
        <div class="col-md-4">
            <label for="countrySelect">Select Country</label>
            <select id="countrySelect" class="form-control">
                <option value="">Select the country</option>
                @foreach($countries as $country)
                <option value="{{ $country->name }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4 mt-4">
            <a href="{{ route('dashboard.view',  ['user_id' => $user_id ?? auth()->user()->id,  'type' => 'hcp']) }}" class="btn btn-primary">
                HCP Dashboard
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mt-4">
            <h4>Total Consumer Registered</h4>
            <div id="consumerChart" style="width: 100%; height: 400px;"></div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6 mt-4">
            <h4>Occupations</h4>
            <div id="occupationChart" style="width: 100%; height: 400px;"></div>
        </div>
        <div class="col-md-6 mt-4">
            <h4>Organization Primary Industry</h4>
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

    // Fetch initial data with no filter
    fetchChartData();

    // Add event listener for the country filter dropdown
    document.getElementById('countrySelect').addEventListener('change', function () {
        const selectedCountry = this.value || null;
        fetchChartData(selectedCountry); // Fetch data based on selected country
    });

    function fetchChartData(country = null) {
        var user_id = $('#user_id').val();

        
        $.ajax({
            url: "{{ route('consumer.country') }}", // Replace with your route
            method: 'POST',
            data: { country: country, user_id }, // Pass country filter if selected
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
                    text: "Error fetching data. Please try again.",
                    icon: "error",
                    confirmButtonText: "OK"
                });

                // Reset charts to "No Data" on error
                updateUserChart([]);
                updateOccupationChart([]);
                updateIndustryChart([]);
            }
        });
    }

    function updateUserChart(data) {
    const hasData = data.length > 0;
    const labels = hasData ? data.map(item => item.label) : ['No Data'];
    const counts = hasData ? data.map(item => item.count) : [0];
    
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
            formatter: '{b}: {c}' 
        },
        legend: {
                orient: 'horizontal',
                left: 'left',
                data: labels,
            },
        series: [{
            type: 'pie',
            radius: '50%',
            data: labels.map((label, index) => ({
                name: label,
                value: counts[index],
            })),
            label: {
                show: true,
                formatter: '{b}: {c}', // Show label and count directly on the chart
                position: 'outside' // Position labels outside the pie slices
            },
            emphasis: {
                itemStyle: {
                    shadowBlur: 10,
                    shadowOffsetX: 0,
                    shadowColor: 'rgba(0, 0, 0, 0.5)'
                }
            }
        }]
    });
}


    function updateOccupationChart(data) {
        const hasData = data.length > 0;
        const labels = hasData ? data.map(item => item.label || 'Unknown') : ['No Data'];
        const counts = hasData ? data.map(item => item.count) : [0];

        const totalCount = counts.reduce((total, num) => total + num, 0);

        occupationChart.setOption({
            title: { 
                // text: hasData ? 'Occupations' : 'No Data Available',
                left: 'center' 
            },
            tooltip: { 
                trigger: 'axis', 
                axisPointer: { type: 'shadow' } 
            },
            grid: {
            bottom: 100, // Increased bottom space for label visibility
        },
            xAxis: {
                type: 'category',
                data: labels,
                axisLabel: {
                    interval: 0,
                    rotate: 45,
                    formatter: function (value) {
                        return value.length > 15 ? value.substring(0, 15) + '...' : value; // Truncate long labels
                    }
                }
            },
            yAxis: { type: 'value' },
            series: [{
                type: 'bar',
                data: counts,
                barWidth: '50%',
                itemStyle: { color: '#36A2EB' }
            }]
        });
    }

    function updateIndustryChart(data) {
        const hasData = data.length > 0;
        const labels = hasData ? data.map(item => item.label || 'Unknown') : ['No Data'];
        const counts = hasData ? data.map(item => item.count) : [0];

        industryChart.setOption({
            title: { 
                // text: hasData ? 'Industries' : 'No Data Available',
                left: 'center' 
            },
            tooltip: { 
                trigger: 'axis', 
                axisPointer: { type: 'shadow' } 
            },
            grid: {
            bottom: 100, // Increased bottom space for label visibility
        },
            xAxis: {
                type: 'category',
                data: labels,
                axisLabel: {
                    interval: 0,
                    rotate: 45,
                    formatter: function (value) {
                        return value.length > 15 ? value.substring(0, 15) + '...' : value; // Truncate long labels
                    }
                }
            },
            yAxis: { type: 'value' },
            series: [{
                type: 'bar',
                data: counts,
                barWidth: '50%',
                itemStyle: { color: '#FF6384' }
            }]
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
});


</script>
@endpush

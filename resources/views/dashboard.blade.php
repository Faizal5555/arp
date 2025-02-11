@extends('layouts.master')

@section('content')

<!-- Load ECharts & Date Range Picker -->
<script src="https://cdn.jsdelivr.net/npm/echarts/dist/echarts.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<style>
/* Corporate Styled Dashboard */
.dashboard-card {
    transition: all 0.3s ease-in-out;
    border-radius: 12px;
    padding: 20px;
    text-align: center;
    color: white;
    font-size: 16px;
    font-weight: bold;
    min-width: 180px;
    min-height: 120px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

/* Icons */
.dashboard-icon {
    font-size: 35px;
    margin-bottom: 10px;
}

/* Corporate Theme Colors with Gradient */
.bg-rfq { background: linear-gradient(135deg, #4A90E2, #357ABD); } /* Blue */
.bg-won { background: linear-gradient(135deg, #6ABF4B, #47A032); } /* Green */
.bg-client { background: linear-gradient(135deg, #9B59B6, #8E44AD); } /* Purple */
.bg-margin { background: linear-gradient(135deg, #F39C12, #D68910); } /* Orange */
.bg-revenue { background: linear-gradient(135deg, #16A085, #138D75); } /* Teal */
.bg-vendor { background: linear-gradient(135deg, #E74C3C, #C0392B); } /* Red */

/* Hover Effect */
.dashboard-card:hover {
    transform: scale(1.05);
    box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
}

/* Arrange Cards in Two Rows */
.dashboard-container {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    justify-content: space-between;
}

/* Chart Container */
.chart-container {
    background: #ffffff;
    padding: 15px;
    border-radius: 12px;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
}
</style>

<div class="container">
    <h3 class="mb-4">Dashboard</h3>

    <!-- Date Range Picker -->
    <div class="row mb-4">
        <div class="col-md-4 d-flex align-items-center">
            <label class="mr-2">Date:</label>
            <input type="text" name="daterange" class="form-control" id="daterange" style="border-color: #237ee6;">
        </div>
    </div>

    <!-- Cards Section -->
    <div class="row">
        <!-- First Row -->
        <div class="col-md-4">
            <div class="dashboard-card bg-rfq">
                <i class="mdi mdi-chart-line dashboard-icon"></i>
                <h5>Total RFQ Bid</h5>
                <h2 id="k1">{{ $bidrfq1 ?? 0 }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card bg-won">
                <i class="mdi mdi-trophy dashboard-icon"></i>
                <h5>Total Won Projects</h5>
                <h2 id="k2">{{ $won_project ?? 0 }}</h2>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card bg-client">
                <i class="mdi mdi-account-group dashboard-icon"></i>
                <h5>Total Client</h5>
                <h2 id="k4">{{ $client ?? 0 }}</h2>
            </div>
        </div>
    </div>

    <div class="row mt-3">
        <!-- Second Row -->
        <div class="col-md-4">
            <div class="dashboard-card bg-margin">
                <i class="mdi mdi-cash-multiple dashboard-icon"></i>
                <h5>Total Margin</h5>
                <h2 id="k3">{{ $totalmargin ?? 0 }}</h2>
                <p class="mb-0">$<span class="total_usd"></span> 
                    | ₹<span class="total_inr"> </span>
                    | €<span class="total_euro"> </span>
                    | £<span class="total_pound"></span></p>
                </p>
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card bg-revenue">
                <i class="mdi mdi-currency-usd dashboard-icon"></i>
                <h5>Total Revenue</h5>
                <h2 id="k6">{{ $totalrevenue ?? 0 }}</h2>
                <p class="mb-0">$<span class="revenue_usd"></span> 
                    | ₹<span class="revenue_inr"></span>
                    | €<span class="revenue_euro"></span>
                    | £<span class="revenue_pound"></span></p> 
            </div>
        </div>
        <div class="col-md-4">
            <div class="dashboard-card bg-vendor">
                <i class="mdi mdi-store dashboard-icon"></i>
                <h5>Total Vendor</h5>
                <h2 id="k5">{{ $vendor ?? 0 }}</h2>
                <p class="mb-0"><span class=""></span> | <span class=""></span></p>
            </div>
        </div>
    </div>

    <!-- Charts Section -->
    <div class="row mt-4">
        <div class="col-md-6">
            <div class="chart-container">
                <h5 class="text-center">Total Margin & Revenue</h5>
                <div id="doughnutChart" style="height: 300px;"></div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    $('#daterange').daterangepicker({
        autoUpdateInput: false,
        locale: { cancelLabel: 'Clear' },
        ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month': [moment().startOf('month'), moment().endOf('month')],
            'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        }
    });

    // Event when user selects a date range
    $('#daterange').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
        fetchData(picker.startDate.format('YYYY-MM-DD'), picker.endDate.format('YYYY-MM-DD'));
    });

    function fetchData(start_date, end_date) {
        if (!start_date || !end_date) {
            console.error("Invalid Date Range");
            return;
        }

        $.ajax({
            url: "{{ route('Overview_chart') }}",
            type: "POST",
            data: {
                start_1: start_date, // ✅ Matches backend variable
                end_1: end_date, // ✅ Matches backend variable
                _token: "{{ csrf_token() }}" // ✅ Ensures CSRF protection
            },
            success: function (data) {
                console.log("AJAX Response:", data);

                // ✅ Update dashboard values dynamically
                $("#k1").text(data.RFQS_Bid_count);
                $("#k2").text(data.Total_Won_Projects);
                $("#k3").text(data.Total_Margin_Value);
                $("#k4").text(data.client_t);
                $("#k5").text(data.vendor_t);
                $("#k6").text(data.Total_Invoice_Value);

                $(".total_usd").text(data.total_usd);
                $(".total_inr").text(data.total_inr);
                $(".revenue_usd").text(data.revenue_usd);
                $(".revenue_inr").text(data.revenue_inr);

                // ✅ Update Doughnut Chart
                updateDoughnutChart(data.Total_Margin_Value, data.Total_Invoice_Value);
            },
            error: function (xhr, status, error) {
                console.error("AJAX Error:", xhr.responseText);
            }
        });
    }

    // ✅ Function to update Doughnut Chart dynamically
    function updateDoughnutChart(margin, revenue) {
    var chart = echarts.init(document.getElementById('doughnutChart'));

    chart.setOption({
        series: [{
            type: 'pie',
            radius: ['50%', '70%'],
            label: {
                show: true, 
                position: 'outside', // Ensures text is visible
                formatter: function(params) {
                    return `${params.name}\n${params.value.toLocaleString()}`; // Displays name & formatted amount
                },
                fontSize: 14
            },
            labelLine: {
                show: true
            },
            data: [
                { value: margin, name: 'Total Margin', itemStyle: { color: '#f39c12' } },
                { value: revenue, name: 'Total Revenue', itemStyle: { color: '#16a085' } }
            ]
        }]
    });
}
});
</script>

@endsection

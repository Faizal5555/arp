@extends('layouts.master')

@section('content')

<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
        color: white;
    }
</style>

<div class="card">
    <div class="card-header header">
        <h4>Search Feasibility Projects</h4>
    </div>

    <!-- Filters Section -->
    <div class="card-body">
        <form id="filter-form">
            <div class="row">
                <!-- Date Filter -->
                <div class="col-md-3">
                    <label for="from_date">From Date</label>
                    <input type="date" name="from_date" id="from_date" class="form-control">
                </div>
                <!-- To Date Filter -->
                <div class="col-md-3">
                    <label for="to_date">To Date</label>
                    <input type="date" name="to_date" id="to_date" class="form-control">
                </div>
                <!-- PN Number Filter -->
                <div class="col-md-3">
                    <label for="pn_number">PN Number</label>
                    <input type="text" name="pn_number" id="pn_number" class="form-control" placeholder="Enter PN Number">
                </div>
                <!-- Country Filter -->
                <div class="col-md-3">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" class="form-control" placeholder="Enter Country">
                </div>
                <!-- Responded Title Filter -->
                <div class="col-md-3 mt-3">
                    <label for="responded_titles">Respondent Title</label>
                    <input type="text" name="responded_titles" id="responded_titles" class="form-control" placeholder="Enter Responded Title">
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Apply</button>
                <button type="button" id="clear-filters" class="btn btn-secondary ml-2">Clear</button>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="table-responsive">
        <table class="table table-bordered mt-3" id="feasibility-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>PN Number</th>
                    <th>Email Subject</th>
                    <th>Project Launch Date</th>
                    <th>Countries</th>
                    <th>Respondent Title</th>
                    @if(auth()->user()->user_type === 'admin') <!-- Check if the user type is admin -->
                    <th>Respondent Email</th>
                @endif
                    <th>Samples Required</th>
                    <th>Samples Delivered</th>
                    <th>Incentive Promised</th>
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic rows will be appended here -->
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script>
    $(document).ready(function () {
        // Load data initially
        fetchTableData();

        // Handle form submission using AJAX
        $('#filter-form').on('submit', function (e) {
            e.preventDefault();
            fetchTableData();
        });

        // Clear filters and reload table
        $('#clear-filters').on('click', function () {
            $('#filter-form')[0].reset();
            fetchTableData();
        });

        // Function to fetch data and render table
        function fetchTableData() {
            $.ajax({
                url: "{{ route('projectFeasibility.Data') }}",
                method: "GET",
                data: $('#filter-form').serialize(),
                success: function (response) {
                    renderTable(response.data, response.user_type);
                },
                error: function () {
                    alert("Error fetching table data. Please try again.");
                }
            });
        }

        // Function to render table data
        function renderTable(data, userType) {
    const tableBody = $('#feasibility-table tbody');
    tableBody.empty();

    if (data.length === 0) {
        tableBody.append('<tr><td colspan="11" class="text-center">No records found.</td></tr>');
        return;
    }

    let index = 1;
    data.forEach(row => {
        const countries = JSON.parse(row.target_countries || '[]').join(', ');
        const emails = JSON.parse(row.responded_emails || '[]').join(', ');
        const titles = JSON.parse(row.responded_titles || '[]').join(', ');

        tableBody.append(`
            <tr>
                <td>${index++}</td>
                <td>${row.date}</td>
                <td>${row.pn_number}</td>
                <td>${row.email_subject_line}</td>
                <td>${row.project_launch_date}</td>
                <td>${countries}</td>
                <td>${titles}</td>
                 ${userType === 'admin' ? `<td>${emails}</td>` : ''}
                <td>${row.no_of_sample_required}</td>
                <td>${row.no_of_sample_delivered}</td>
                <td>${row.incentive_promised}</td>
            </tr>
        `);
    });
}
    });
</script>
@endpush

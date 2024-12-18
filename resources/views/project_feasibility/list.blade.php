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
        <h4>Project Feasibility Table</h4>
    </div>

    <!-- Filters Section -->
    <div class="card-body">
        <form id="filter-form">
            <div class="row">
                <!-- Date Filter -->
                <div class="col-md-3">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control">
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
                <div class="col-md-3">
                    <label for="responded_titles">Responded Title</label>
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
                    <th>Responded Title</th>
                    <th>Responded Emails</th>
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
                    renderTable(response.data);
                },
                error: function () {
                    alert("Error fetching table data. Please try again.");
                }
            });
        }

        // Function to render table data
        function renderTable(data) {
    const tableBody = $('#feasibility-table tbody');
    tableBody.empty();

    if (data.length === 0) {
        tableBody.append('<tr><td colspan="11" class="text-center">No records found.</td></tr>');
        return;
    }

    let index = 1;
    data.forEach(row => {
        const countries = JSON.parse(row.target_countries || '[]').join(', '); // Join countries with commas
        const emails = JSON.parse(row.responded_emails || '[]').join(', '); // Join emails with commas
        const titles = JSON.parse(row.responded_titles || '[]').join(', '); // Join responded_titles with commas

        tableBody.append(`
            <tr>
                <td>${index++}</td>
                <td>${row.date}</td>
                <td>${row.pn_number}</td>
                <td>${row.email_subject_line}</td>
                <td>${row.project_launch_date}</td>
                <td>${countries}</td>
                <td>${titles}</td>
                <td>${emails}</td>
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

@extends('layouts.master')
@section('page_title', 'Payment to Panel Member')
@section('content')


<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h4>Payment to Panel Member</h4>
        </div>
        <div class="card-body">
            <!-- Date Filter Form -->
            <form id="filterForm" class="mb-4">
                <div class="row">
                    <div class="col-md-4">
                        <label for="from_date">From Date:</label>
                        <input type="date" id="from_date" name="from_date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <label for="to_date">To Date:</label>
                        <input type="date" id="to_date" name="to_date" class="form-control">
                    </div>
                    <div class="col-md-4 d-flex align-items-end">
                        <button type="button" id="filterButton" class="btn btn-primary">Filter</button>
                    </div>
                </div>
            </form>

            <!-- Results Table -->
            <div class="table-responsive">
                <table class="table table-bordered" id="paymentTable">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Name</th>
                            <th>Country</th>
                            <th>Speciality</th>
                            {{-- <th>Email</th> --}}
                            <th>PN Number</th>
                            <th>Incentive Promised</th>
                            <th>Total Incentive Paid</th>
                            <th>Incentive Paid Date</th>
                            <th>Mode of Payment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="9" class="text-center">No Records Found. Please apply a filter.</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
   $(document).ready(function () {
    // Fetch and populate table data based on filter
    function fetchData(fromDate, toDate) {
        $.ajax({
            url: "{{ route('fetchPayments') }}",
            method: "GET",
            data: {
                from_date: fromDate,
                to_date: toDate,
            },
            success: function (response) {
                const tbody = $('#paymentTable tbody');
                tbody.empty(); // Clear table before appending data
                if (response.length > 0) {
                    response.forEach((record, index) => {
                        tbody.append(`
                            <tr>
                                <td>${index + 1}</td>
                                <td>${record.name}</td>
                                <td>${record.country}</td>
                                <td>${record.speciality || '-'}</td>
                                <td>${record.pn_number}</td>
                                <td>${record.incentive_promised}</td>
                                <td>${record.total_incentive_paid}</td>
                                <td>${record.incentive_paid_date}</td>
                                <td>${record.mode_of_payment}</td>
                            </tr>
                        `);
                    });
                } else {
                    tbody.append('<tr><td colspan="10" class="text-center">No Records Found</td></tr>');
                }
            },
            error: function (xhr) {
                Swal.fire({
                    title: 'Error',
                    text: xhr.responseJSON?.error || 'An error occurred',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            },
        });
    }

    // Handle filter button click
    $('#filterButton').on('click', function () {
        const fromDate = $('#from_date').val();
        const toDate = $('#to_date').val();

        if (!fromDate || !toDate) {
            Swal.fire({
                title: 'Error',
                text: 'Please select both From and To dates to filter records.',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            return;
        }

        fetchData(fromDate, toDate);
    });
});

</script>

@endsection

@extends('layouts.master')
@section('page_title', 'Global Manager List')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>

    
$(document).ready(function () {

    let userType = 'doctor'; // Default user type (HCP)

    // Initialize the table for HCP by default
    initTable(userType);

    // Handle tab switching
    $('.tab-btn').click(function () {
        userType = $(this).data('user-type'); // Update the userType based on the clicked tab
        $('.tab-btn').removeClass('active'); // Remove 'active' class from all tabs
        $(this).addClass('active'); // Add 'active' class to the clicked tab
        initTable(userType); // Initialize the table for the selected user type
    });
   

    function updateTableHeader(userType) {
    const headerRow = $("#tableHeader");
    headerRow.empty(); // Clear existing header

    // Add common headers
    headerRow.append("<tr>");
    headerRow.append("<th>S.No</th>");
    headerRow.append("<th>First Name</th>");

    // Add conditional headers
    if (userType === 'doctor') {
        headerRow.append("<th>Speciality</th>");
    } else {
        headerRow.append("<th>Last Name</th>");
    }

    // Add remaining headers
    headerRow.append("<th>Country</th>");
    // headerRow.append("<th>Email</th>");
    headerRow.append("<th>Action</th>");
    headerRow.append("</tr>");
}
    

    // Function to initialize the DataTable with dynamic columns
    function initTable(userType) {
    // Update table headers dynamically
    updateTableHeader(userType);

    // Destroy any existing DataTable instance
    if ($.fn.DataTable.isDataTable('#globalManagerTable')) {
        $('#globalManagerTable').DataTable().destroy();
    }

    // Reinitialize DataTable
    $('#globalManagerTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('panelMemberListData') }}",
            data: function (data) {
                data.country = $("#country").val();
                data.speciality = $("#speciality").val();
                data.name = $("#name").val(); // Text filter for First Name
                data.lastname = $("#lastname").val(); // Text filter for Last Name
                data.email = $("#email").val(); // Text filter for Email
                data.user_type = userType; // User type (doctor or user)
            },
        },
        columns: userType === 'doctor' ? [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'firstname', name: 'firstname' },
            { data: 'speciality', name: 'speciality' },
            { data: 'country', name: 'country' },
            // { data: 'email', name: 'email' },
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    const buttonText = row.is_saved > 0 ? 'View' : 'Details';
                    const buttonClass = row.is_saved > 0 ? 'btn-success' : 'btn-info';
                    return `<button class="btn ${buttonClass} send-email-btn" data-datacenter-id="${row.id}" data-que-id="">${buttonText}</button>`;
                }
            }
        ] : [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'fname', name: 'fname' },
            { data: 'lname', name: 'lname' },
            { data: 'country', name: 'country' },
            // { data: 'email', name: 'email' },
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    const buttonText = row.is_saved > 0 ? 'View' : 'Details';
                    const buttonClass = row.is_saved > 0 ? 'btn-success' : 'btn-info';
                    return `<button class="btn ${buttonClass} send-email-btn" data-que-id="${row.id}" data-datacenter-id="">${buttonText}</button>`;
                }
            }
        ],
    });
}
$("#name, #lastname, #email, #country, #speciality").on("keyup change", function () {
    $('#globalManagerTable').DataTable().draw();
});

    // Handle opening the modal for adding details or viewing saved records
    $(document).on('click', '.send-email-btn', function () {
        const button = $(this);
        const datacenterId = button.data('datacenter-id');
        const queId = button.data('que-id');

        if (button.text() === "Details") {
            if (userType === 'doctor') {
                $('#datacenter_id').val(datacenterId);
                $('#que_id').val('');
            } else {
                $('#que_id').val(queId);
                $('#datacenter_id').val('');
            }
            $('#incentiveModal').modal('show');
        } else if (button.text() === "View") {
            const id = userType === 'doctor' ? datacenterId : queId;
            const url = userType === 'doctor'
                ? `fetchIncentive/${datacenterId}`
                : `fetchIncentiveConsumer/${queId}`;

            $.ajax({
                url: url,
                type: "GET",
                success: function (response) {
                    Swal.fire({
                        title: 'Record Details',
                        html: `
                           <div style="padding: 15px; border-radius: 10px; background-color: #f8f9fa; box-shadow: 0 4px 6px rgba(0,0,0,0.1); font-family: Arial, sans-serif;">
                            <div style="border-bottom: 1px solid #ddd; padding: 8px 0;">
                                <span style="font-weight: bold; color: #555;">PN Number:</span>
                                <span style="color: #333; float: right;">${response.pn_number}</span>
                            </div>
                            <div style="border-bottom: 1px solid #ddd; padding: 8px 0;">
                                <span style="font-weight: bold; color: #555;">Incentive Promised:</span>
                                <span style="color: #333; float: right;">${response.incentive_promised}</span>
                            </div>
                            <div style="border-bottom: 1px solid #ddd; padding: 8px 0;">
                                <span style="font-weight: bold; color: #555;">Total Incentive Paid:</span>
                                <span style="color: #333; float: right;">${response.total_incentive_paid}</span>
                            </div>
                            <div style="border-bottom: 1px solid #ddd; padding: 8px 0;">
                                <span style="font-weight: bold; color: #555;">Incentive Paid Date:</span>
                                <span style="color: #333; float: right;">${response.incentive_paid_date}</span>
                            </div>
                            <div style="padding: 8px 0;">
                                <span style="font-weight: bold; color: #555;">Mode of Payment:</span>
                                <span style="color: #333; float: right;">${response.mode_of_payment}</span>
                            </div>
                        </div>
                        `,
                        icon: 'info',
                    });
                },
                error: function () {
                    Swal.fire({
                        title: 'Error',
                        text: 'Unable to fetch the record.',
                        icon: 'error',
                    });
                }
            });
        }
    });

    // Handle form submission for saving incentive
    $('#incentiveForm').on('submit', function (e) {
        e.preventDefault();

        const formData = new FormData(this);
        formData.append('user_type', userType);

        $.ajax({
            url: "{{ route('saveIncentive') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.btn-primary').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Saving...');
            },
            success: function (response) {
                $('#incentiveModal').modal('hide');
                Swal.fire({
                    title: 'Success!',
                    text: response.message,
                    icon: 'success',
                    timer: 3000
                });
                $('#incentiveForm')[0].reset();
                const idField = userType === 'doctor' ? '#datacenter_id' : '#que_id';
                const id = $(idField).val();
                $(`button[data-${userType === 'doctor' ? 'datacenter-id' : 'que-id'}="${id}"]`)
                    .text('View')
                    .removeClass('btn-info')
                    .addClass('btn-success');
            },
            error: function (xhr) {
                Swal.fire({
                    title: 'Error',
                    text: xhr.responseJSON.error || 'An error occurred',
                    icon: 'error',
                });
            },
            complete: function () {
                $('.btn-primary').prop('disabled', false).text('Save');
            }
        });
    });
});





</script>

<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
        color: white;
        padding: 15px;
        font-size: 18px;
        border-radius: 5px;
    }

    .table_background {
        background: linear-gradient(43deg, #f1f1f1, #e0e0e0);
        color: #333;
        font-weight: bold;
    }

    .tab-btn.active {
        background-color: #0b5dbb;
        color: white;
        border-color: #0b5dbb;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card" id="header-title">
            <div class="card-header header">
                <div class="card-title" style="color:whitesmoke;">Panel Participation Incentive</div>
            </div>
            <div class="card-body">
                <div class="mb-4">
                    <button class="btn btn-info tab-btn" data-user-type="doctor">HCP</button>
                    <button class="btn btn-info tab-btn" data-user-type="user">Consumer</button>
                </div>
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label>Country</label>
                        <select class="form-control" id="country" name="country">
                            <option value="" selected disabled>Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->name }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Speciality</label>
                        <select class="form-control inbox" id="speciality" name="speciality">
                            <option value="" selected disabled>Select Speciality</option>
                            @foreach($specialities as $spec)
                                <option value="{{ $spec->speciality }}">{{ $spec->speciality }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-4">
                        <label>Search by First Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter First Name">
                    </div>
                    <div class="col-md-4">
                        <label>Search by Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="Enter Last Name">
                    </div>
                    <div class="col-md-4 d-none">
                        <label>Search by Email</label>
                        <input type="text" class="form-control" id="email" name="email" placeholder="Enter Email">
                    </div>
                </div>
                <div class="table-responsive col-md-12">
                    <table class="table-hover" id="globalManagerTable">
                        <thead>
                            <tr id="tableHeader" class="table_background">
                                <!-- Dynamic Header Will Be Set Using JavaScript -->
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal HTML -->
<!-- Email Modal -->
<!-- Modal HTML -->
<!-- Incentive Modal -->
<div class="modal fade" id="incentiveModal" tabindex="-1" aria-labelledby="incentiveModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="incentiveModalLabel">Add Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="incentiveForm">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="pnNumber">PN Number</label>
                        <input type="text" class="form-control" id="pn_number" name="pn_number" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="incentivePromised">Incentive Promised</label>
                        <input type="text" class="form-control" id="incentive_promised" name="incentive_promised" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="totalIncentivePaid">Total Incentive Paid</label>
                        <input type="text" class="form-control" id="total_incentive_paid" name="total_incentive_paid" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="incentivePaidDate">Incentive Paid Date</label>
                        <input type="date" class="form-control" id="incentive_paid_date" name="incentive_paid_date" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="modeOfPayment">Mode of Payment</label>
                        <input type="text" class="form-control" id="mode_of_payment" name="mode_of_payment" required>
                    </div>
                    <input type="hidden" id="user_id" name="user_id">
                    <input type="hidden" id="que_id" name="que_id">
                    <input type="hidden" id="datacenter_id" name="datacenter_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
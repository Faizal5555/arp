@extends('layouts.master')
@section('page_title', 'Total Registered PanelList')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    let table;

    // Function to update the table header dynamically
    function updateTableHeader(userType) {
    const headerRow = $("#tableHeader");
    headerRow.empty(); // Clear existing header

    // Common columns
    headerRow.append("<th>S.No</th>");
    headerRow.append("<th>First Name</th>");

    // Conditional columns
    if (userType === 'doctor') {
        headerRow.append("<th>Speciality</th>"); // Show Speciality for HCP
    } else {
        headerRow.append("<th>Last Name</th>"); // Show Last Name for Consumer
    }

    // Common columns
    headerRow.append("<th>Country</th>");
    headerRow.append("<th>Referral</th>"); // Add Referral column
    headerRow.append("<th>Action</th>");
}

    // Function to initialize the DataTable with dynamic columns
    function initTable(userType) {
    // Update table header dynamically
    updateTableHeader(userType);

    // Destroy any existing DataTable instance
    if (table) {
        table.destroy();
    }

    // Initialize DataTable
    table = $('#globalManagerTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('globalManagerListData') }}",
            data: function (data) {
                data.country = $("#country").val();
                data.user_type = userType;
            },
        },
        destroy: true,
        columns: userType === 'doctor' ? [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'firstname', name: 'firstname' },
            { data: 'docterSpeciality', name: 'docterSpeciality' }, // Speciality column for HCP
            { data: 'country', name: 'country' },
            { data: 'referral', name: 'referral' }, // Referral column
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `<button class="btn btn-info send-email-btn" data-email="${row.email}">
                            Send Email
                        </button>`;
                }
            }
        ] : [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'fname', name: 'fname' },
            { data: 'lname', name: 'lname' }, // Last Name column for Consumer
            { data: 'country', name: 'country' },
            { data: 'referral', name: 'referral' }, // Referral column
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `<button class="btn btn-info send-email-btn" data-email="${row.email}">
                            Send Email
                        </button>`;
                }
            }
        ],
    });
}

    // Initialize the table for HCP by default
    initTable('doctor');

    // Handle tab click
    $('.tab-btn').click(function () {
        const userType = $(this).data('user-type');
        initTable(userType);
    });

    // Handle country change filter
    $('#country').change(function () {
        if (table) {
            table.draw();
        }
    });
});

$(document).ready(function () {
    // Use event delegation to handle dynamically created buttons
    $(document).on('click', '.send-email-btn', function () {
        const email = $(this).data('email');
        $('#recipientEmail').val(email); // Populate the email field in the modal
        $('#emailModal').modal('show'); // Show the modal
    });

    // Handle form submission
    $('#sendEmailForm').on('submit', function (e) {
        e.preventDefault();

        let formData = new FormData(this);

        $.ajax({
            url: "{{ route('global.email') }}", // Replace with your route
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('.btn-primary').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Sending...');
            },
            success: function (response) {
                $('#emailModal').modal('hide');
                Swal.fire({
                    title: 'Success!',
                    text: response.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                });
                $('#sendEmailForm')[0].reset(); // Reset the form
            },
            error: function (xhr) {
                Swal.fire({
                    title: 'Error',
                    text: xhr.responseJSON.error || 'An error occurred',
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            },
            complete: function () {
                $('.btn-primary').prop('disabled', false).text('Send Email');
            }
        });
    });
});



</script>

<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
        color: white;
    }
    .table_background {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
        color: white;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card" id="header-title">
            <div class="card-header header">
                <div class="card-title" style="color:whitesmoke;">Total Registered Panelist</div>
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
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModalLabel">Send Email</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="sendEmailForm">
                <div class="modal-body">
                    <div class="form-group d-none">
                        <label for="recipientEmail">Recipient Email</label>
                        <input type="email" class="form-control" id="recipientEmail" name="recipientEmail" readonly>
                    </div>
                    <div class="form-group mt-3">
                        <label for="emailContent">Email Content</label>
                        <textarea class="form-control" id="emailContent" name="emailContent" placeholder="Enter email content here" required></textarea>
                    </div>
                    <div class="form-group mt-3">
                        <label for="attachment">Attachment (optional)</label>
                        <input type="file" class="form-control" id="attachment" name="attachment" accept=".pdf, .jpg, .jpeg, .png, .doc, .docx, .xls, .xlsx">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Send</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

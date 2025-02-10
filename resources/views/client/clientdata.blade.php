@extends('layouts.master')

@section('page_title', 'Client Data Filter')
<style>
    a.ml-2.btn.btn-primary {
    float: right;
    margin:0 0 10px 0;
}
a.btn.btn-outline-secondary {
    float: right;
    margin-bottom: 20px;
    border-color: #b66dff;
}
a.btn.btn-outline-secondary:hover {
    float: right;

    background-color: #b66dff;
}
.main-panel {
    background-color: #f8f8f8;
   }
.card {
   margin: 40px 0 20px 0;
    border:1px solid;
 }

.card-header.header-elements-inline {
    background-color: #fff;
}
     button#addRegisterButton {
    background-color: #6329a1;
    border-color: #6329a1;
}
label.col-lg-3.col-form-label.font-weight-semibold {
    font-family: "ubuntu-medium", sans-serif;
    font-weight: 500;
}
a.btn.btn-outline-secondary:hover {
    color: #fff;
}
button#addRegisterButton {
    background-color: #6329a1;
    border-color: #6329a1;
}
.card-header.header-elements-inline {
   background:linear-gradient(43deg,#0b5dbb,#0b5dbb);;
    color: #fff;
}
a.btn.btn-danger {
    background-color: #0b5dbb;
    border-color: #fff;
    float: right;
    margin: 0 0 10px 10px;
}
a.btn.btn-danger:hover {
    background-color: #2a72c4;
    border-color: #fff;
}
a.btn.btn-outline-danger {
    float: right;
}
a.btn.btn-outline-danger:hover
{

    background: #ed252d;
    color:#fff;
}
td.text-center {
    font-size: 20px;
}
a.mdi.mdi-delete {
    font-size: 23px;
    color: #ee2d34;
}
a.mdi.mdi-table-edit {
     font-size: 23px;
}
button.btn.btn-danger {
    float: right;
}
.table-responsive {
   
   overflow: hidden;
   
}
nav.flex.items-center.justify-between {
    padding-top: 20px;
}
svg.w-5.h-5 {
    display: none;
}

.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between {
    padding-top: 17px;
}
a.btn.btn-outline-danger {
    margin-left: 7px;
}
nav.flex.items-center.justify-between {
    float: right;
    padding-bottom: 10px;
}
input.form-control {
    text-transform: capitalize;
}
tr.my-row {
    background-color: #0b5dbb;
}
select.custom-select.custom-select-sm.form-control.form-control-sm {
    padding-right: 25px;
}
select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
}
select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
}
button.dt-button.buttons-excel.buttons-html5 {
    border: 1px solid #0b5dbb !important;
    border-radius: 7px !important;
    color: #0b5dbb !important;
    font-family: unset !important;
    width: 63px !important;
    height: 32px !important;
    margin-bottom: 25px;
}
button.dt-button.buttons-excel.buttons-html5:hover {
    background: linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: white !important;
}
button.dt-button.buttons-excel.buttons-html5 {
    display: none;
}
/* @if(auth()->user()->user_type == 'admin') */
button.dt-button.buttons-excel.buttons-html5 {
    display: block;
}
input#daterange, input#daterange_1 {
    padding: 0.4375rem 0.75rem;
    outline: 2px solid #89b3e2 !important;
    color: #bbb5b5 !important;
    border: #000 !important;
    border-radius: 3px important;
    width: 80% !important;
}
input#dateRange::placeholder {
        color: #6c757d !important;
        opacity: 1 !important;
        font-weight: 500;
    }
    #companyFilter, #countryFilter {
    border: 1px solid #0b5dbb !important; /* Dark border color */
    border-radius: 25px; /* Slightly rounded corners */
    padding: 10px; /* Adjust padding for better appearance */
    color: #333; /* Darker text color */
    font-weight: 500; /* Slightly bolder font */
    outline: none;
}

#companyFilter:focus, #countryFilter:focus {
    border-color: #0b5dbb !important; /* Even darker on focus */
    box-shadow: 0 0 5px rgba(52, 58, 64, 0.5); /* Soft glow effect */
}
/* @endif */
    </style>
@push('css')
<!-- Include Date Range Picker CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
<link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
<link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
<link rel="stylesheet" href="../../assets/css/style.css">
<link rel="shortcut icon" href="../../assets/images/favicon.ico" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
@endpush

@section('content')
<div class="container mt-4">
    <div class="card-header header-elements-inline">
        <a class="ml-2 card-title">Client Followup Data</a>
    </div>

    <!-- Date Range Picker -->
    <div class="row mt-3 align-items-center">
        <div class="col-md-5 d-flex">
            <input type="text" id="dateRange" class="form-control mx-3" name="daterange_1" placeholder="Select Date Range">
            <button id="clearBtn" class="btn btn-info btn-sm">Clear</button>
        </div>
    </div>
   
    <hr>

    <!-- DataTable -->
    <div class="table-responsive">
        <table class="table datatable-button-html5-columns data-table">
            <thead>
                <tr class="my-row">
                    <th>Company Name</th>
                    <th>Client Name</th>
                    <th>Title</th>
                    <th>LinkedIn ID</th>
                    <th>Country</th>
                    <th>Phone Number</th>
                    <th>Email Address</th>
                    <th>status</th>
                    <th>Follow-up Date</th>
                    <th>Comments</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

            <!-- Details Modal -->
            <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLabel">Update Follow-Up Details</h5>
                            <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                        </div>
                        <div class="modal-body">
                            <form id="updateForm">
                                @csrf
                                <input type="hidden" id="client_id" name="client_id">
                                <div class="form-group">
                                    <label for="status">Status</label>
                                    <select id="status" name="status" class="form-control" required>
                                        <option value="Client">Client</option>
                                        <option value="Important">Important</option>
                                        <option value="Normal">Normal</option>
                                        <option value="Not Responsive">Not Responsive</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="comments">Comments</label>
                                    <textarea id="comments" name="comments" class="form-control" required></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="followup_date">Follow-Up Date</label>
                                    <input type="date" id="followup_date" name="followup_date" class="form-control" required>
                                </div>
                                <button type="submit" class="btn btn-primary">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>

<!-- Details Modal -->
@endsection

@push('scripts')
<!-- Include jQuery and Date Range Picker JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Bootstrap JS (Ensure it's included) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<!-- Include DataTables Core JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Include DataTables Buttons Extension -->
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

<!-- Include Date Range Picker -->
<script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

<!-- Include SweetAlert -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
$(document).ready(function () {
    // Initialize Date Range Picker (Only Calendar, No Preset Ranges)
    $('#dateRange').daterangepicker({
        autoUpdateInput: false,
        showDropdowns: true, // Allows year and month dropdown selection
        linkedCalendars: false, // Prevents auto-selecting second date
        locale: { 
            format: 'YYYY-MM-DD', 
            cancelLabel: 'Clear' 
        },
        alwaysShowCalendars: true, // Ensures only the calendar is visible
        singleDatePicker: false // Allows range selection
    });

    // Initialize DataTable (Initially Empty)
    var table = $('.data-table').DataTable({
        processing: true,
        serverSide: true,
        searching: false, // Disable default search box
        paging: true,
        ordering: false,
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excelHtml5',
                text: 'Export',
                exportOptions: { columns: ':visible' }
            },
        ],
        ajax: {
            url: "{{ route('clientdata.filter') }}",
            type: "POST",
            data: function (d) {
                d.date_range = $('#dateRange').val();
                d._token = "{{ csrf_token() }}";
            }
        },
        columns: [
            { data: 'company_name', name: 'company_name' },
            { data: 'client_firstname', render: function(data, type, row) { return data + " " + row.client_lastname; }},
            { data: 'title', name: 'title' },
            { data: 'linkedin_id', name: 'linkedin_id' },
            { data: 'client_country', name: 'client_country' },
            { data: 'phone_number', name: 'phone_number' },
            { data: 'email_address', name: 'email_address' },
            { 
                        data: 'status', 
                        name: 'status',
                        render: function(data, type, row) {
                            let badgeClass = "";
                            switch(data) {
                                case "Client":
                                    badgeClass = "badge-info"; // Blue
                                    break;
                                case "Important":
                                    badgeClass = "badge-danger"; // Red
                                    break;
                                case "Normal":
                                    badgeClass = "badge-success"; // Green
                                    break;
                                case "Not Responsive":
                                    badgeClass = "badge-primary"; // Dark Blue
                                    break;
                                default:
                                    badgeClass = "badge-secondary"; // Default Gray
                            }
                            return `<span class="badge ${badgeClass} rounded-pill px-3 py-2">${data}</span>`;
                        }
                    },
                { 
                data: 'followup_date', 
                name: 'followup_date', 
                render: function (data) {
                    let today = moment().format('YYYY-MM-DD');
                    let followUpDate = moment(data, 'YYYY-MM-DD').format('YYYY-MM-DD');

                    if (followUpDate <= today) {
                        return `<span class="badge badge-danger rounded-pill px-3 py-2">${data}</span>`; // Red for today and past dates
                    } else {
                        return `<span class="badge badge-primary rounded-pill px-3 py-2">${data}</span>`; // Blue for future dates
                    }
                }
            },
            { data: 'comments', name: 'comments' },
            { data: 'id', render: function(data) {
                    return `<button class="btn btn-info btn-sm details-btn" data-id="${data}">Details</button>`;
                }}

        ]
    });

    // Load Data Automatically When Date is Selected
    $('#dateRange').on('apply.daterangepicker', function (ev, picker) {
        $(this).val(picker.startDate.format('YYYY-MM-DD') + ' to ' + picker.endDate.format('YYYY-MM-DD'));
        table.ajax.reload(); // Reload data after selecting date range
    });

    // Clear input and reset DataTable when canceled
    $('#dateRange').on('cancel.daterangepicker', function () {
        $(this).val('');
        table.clear().draw(); // Clear the table when no date is selected
    });

    $('#clearBtn').click(function () {
        $('#dateRange').val('').trigger('cancel.daterangepicker'); // Clear the input field
        table.clear().draw(); // Reset the table
    });

      $(document).on('click', '.details-btn', function () {
            let id = $(this).data('id');
            
            $.ajax({
                url: "{{ route('clientdata.details', ':id') }}".replace(':id', id),
                type: "GET",
                success: function (data) {
                    $('#client_id').val(data.id);
                    $('#comments').val(data.comments);
                    $('#followup_date').val(data.followup_date);
                    $('#status').val(data.status);
                    $('#detailsModal').modal('show');
                },
                error: function () {
                    Swal.fire("Error", "Failed to load client details.", "error");
                }
            });
        });


        // Submit Follow-Up Update
        $('#updateForm').on('submit', function (e) {
    e.preventDefault();
    
    $.ajax({
        url: "{{ route('clientdata.update') }}",
        type: "POST",
        data: $(this).serialize(),
        success: function (response) {
            Swal.fire({
                title: "Success!",
                text: "Client details updated successfully.",
                icon: "success",
                timer: 2000, // Auto-close after 3 seconds
                showConfirmButton: false
            });

            $('#detailsModal').modal('hide');
            $('.data-table').DataTable().ajax.reload();
        },
        error: function (xhr) {
            Swal.fire({
                title: "Error!",
                text: "Something went wrong. Please try again.",
                icon: "error",
                confirmButtonText: "OK"
            });
        }
    });
});

});




</script>
@endpush

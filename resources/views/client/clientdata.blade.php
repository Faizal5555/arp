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
    outline: 2px solid #89b3e2;
    color: #bbb5b5;
    border: #000;
    border-radius: 3px;
    width: 80%;
}
input#dateRange::placeholder {
        color: #6c757d !important;
        opacity: 1 !important;
        font-weight: 500;
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
                    <th>Follow-up Date</th>
                    <th>Comments</th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- Details Modal -->
@endsection

@push('scripts')
<!-- Include jQuery and Date Range Picker JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
    // Initialize Date Range Picker
    $('#dateRange').daterangepicker({
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
                data: 'followup_date', 
                name: 'followup_date', 
                render: function (data) {
                    let today = moment().format('YYYY-MM-DD');
                    let followUpDate = moment(data, 'YYYY-MM-DD').format('YYYY-MM-DD');

                    if (followUpDate <= today) {
                        return `<span class="badge badge-danger">${data}</span>`; // Red for today and past dates
                    } else {
                        return `<span class="badge badge-primary">${data}</span>`; // Blue for future dates
                    }
                }
            },
            { data: 'comments', name: 'comments' }
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
});


</script>
@endpush

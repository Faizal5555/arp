@extends('layouts.master')
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
@section('page_title', 'Client List')
@section('content')
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script type="text/javascript">

$('#importForm').on('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: "{{ route('clientdata.import') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            Swal.fire({
                title: 'Success',
                text: 'Clients imported successfully!',
                icon: 'success',
                timer: 3000,
                showConfirmButton: false,
            });
            $('#importModal').modal('hide');
            $('.data-table').DataTable().ajax.reload(); // Reload DataTable
        },
        error: function (xhr) {
            Swal.fire({
                title: 'Error',
                text: xhr.responseJSON.error || 'Something went wrong!',
                icon: 'error',
                confirmButtonText: 'OK',
            });
        },
    });
});

        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
        });

        
            var table = $('.data-table').DataTable({
                dom: 'Blfrtip',
                "lengthMenu": [[10, 25, 50, 75, 100, -1], [10, 25, 50, 75, 100, "All"]],
                buttons: [
                    {
                        text: 'Export',
                        extend: 'excelHtml5',
                        exportOptions: { columns: [0,1,2,3,4,5,6,7] },
                    },
                ],
                processing: true,
                serverSide: true,
                ordering : false,
                ajax: {
                    url: "{{ route('clientdata.fetch') }}",
                    type: "GET",
                    data: function (d) {
                        d.status = $('#statusFilter').val(); 
                        d.company_name = $('#companyFilter').val();
                        d.client_country = $('#countryFilter').val(); 
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
                    //{ data: 'followup_date', name: 'followup_date' },
                    { data: 'id', render: function(data) {
                        return `<button class="btn btn-info btn-sm details-btn" data-id="${data}">Details</button>`;
                    }}
                ]
            });

            $('#statusFilter, #companyFilter, #countryFilter').on('change keyup', function () {
        table.ajax.reload();
    });

            // Open Details Modal
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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Client Database</a>
                </div>
                @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                      <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-ban"></i> Error!</h4>
                          @foreach($errors->all() as $error)
                          {{ $error }} <br>
                          @endforeach      
                      </div>
                    </div>
                </div>
                @endif

                @if (Session::has('success'))
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h5>{!! Session::get('success') !!}</h5>   
                    </div>
                @endif

                @if (Session::has('fail'))
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <h4>{!! Session::get('fail') !!}</h4>
                    </div>
                @endif

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <div>
                                   
                                    <!-- Import Button -->
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#importModal">Import</button>
                                     
                                    
                                    <!-- Import Modal -->
                                    <div class="modal fade" id="importModal" tabindex="-1">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Import Clients</h5>
                                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('clientdata.import') }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="file" name="file" class="form-control" required>
                                                        <small class="form-text text-muted">
                                                            Accepted formats: CSV,XLSX.
                                                        <a href="{{ route('clientdata.downloadSample') }}">Download Sample File</a>
                                                        </small>
                                                        <br>
                                                        <button class="btn btn-success">Upload</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-5 d-flex">
                                    <div class="col-md-3 m-1">
                                        <label for="statusFilter">Filter by Status:</label>
                                        <select id="statusFilter" class="form-control">
                                            <option value="">All</option>
                                            <option value="Client">Client</option>
                                            <option value="Important">Important</option>
                                            <option value="Normal">Normal</option>
                                            <option value="Not Responsive">Not Responsive</option>
                                        </select>
                                    </div>

                                    <div class="col-md-3 m-1">
                                        <label for="statusFilter">Filter by Company:</label>
                                        <input type="text" id="companyFilter" class="form-control" placeholder="Enter Company Name">
                                    </div>
                                
                                    <!-- Country Filter -->
                                    <div class="col-md-3 m-1">
                                        <label for="countryFilter">Filter by Country:</label>
                                        <input type="text" id="countryFilter" class="form-control" placeholder="Enter Country">
                                    </div>
                                </div>

                                <!-- Client Data Table -->
                                <table class="table datatable-button-html5-columns data-table">
                                    <thead>
                                        <tr class="my-row">
                                            <th>Company Name</th>
                                            <th>Client Name</th>
                                            <th>Title</th>
                                            <th>LinkedIn ID</th>
                                            <th>Country</th>
                                            <th>Phone Number</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            {{-- <th>Follow-Up Date</th> --}}
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>

                                <!-- Details Modal -->
                                <div class="modal fade" id="detailsModal" tabindex="-1">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Update Follow-Up Details</h5>
                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
@push('css')
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
@endpush

<script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(auth()->user()->user_type == 'admin')
            document.querySelector('.dt-button.buttons-excel.buttons-html5').style.display = 'block';
        @endif
    });
</script>




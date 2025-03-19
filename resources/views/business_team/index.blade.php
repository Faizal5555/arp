@extends('layouts.master')

@section('content')
<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
        color: white;
    }
    
    a.ml-2.btn.btn-primary {
    float: right;
    }
a.ml-2.btn.btn-primary {
    background-color: #fff;
    color: #0b5dbb;
    border-color: #ffff;
}

a.ml-2.btn.btn-primary {
    /* margin-left: -3px; */
    margin: 10px;
}

select.custom-select.custom-select-sm.form-control.form-control-sm {
    margin: 11px;
    color: #000;
}
select.custom-select.custom-select-sm.form-control.form-control-sm {
    padding-left: 10px;
    padding-right: 26px;
}

/*next table follow up css*/
 label.mb-0.expired {
    background-color: #c82333;
    border-color: #bd2130;
    padding: 13px;
    border-radius: 20px;
}
label.mb-0.not-expired {
    background: #198ae3;
    border-color: #198ae3;
    padding: 13px;
    border-radius: 20px;
}
.select2-container--default .select2-selection--multiple {
    min-height: 38px;
    border: 1px solid #ccc;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #5b8eff !important;
    color:black;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    border:none !important;
    background-color: #5b8eff !important;
    color:black !important;
}
/*end table next follow up css*/


</style>
<!-- Add this in your head -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- At the bottom before </body> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- jQuery -->

<!-- Select2 CSS -->



<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="card">
    <div class="card-header header">
        <h5>Projects Lists</h5>
    </div>
    <div class="table-responsive mt-5 px-2">
        <table class="table table-bordered mt-3" id="businessTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>PN Number</th>
                    <th>Subject Line</th>
                    <th>Industry</th>
                    <th>Client Name</th>
                    <th>Team Members</th>
                    <th>Others</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

    
  
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- DataTables JS and jQuery should already be included in your layout -->
<script>
    $(document).ready(function () {
        $('#businessTable').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
            "url":"{{ route('business.allocated.projects') }}",
            "type": "GET",
            },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                { data: 'date', name: 'date' },
                { data: 'pn_number', name: 'pn_number' },
                { data: 'subject_line', name: 'subject_line' },
                { data: 'industry', name: 'industry' },
                { data: 'client_name', name: 'client_name' },
                { data: 'team_members', name: 'team_members', orderable: false, searchable: false },
                { data: 'others', name: 'others' },
                {
                data: 'id', // use 'id' to build the URL dynamically
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row, meta) {
                    var viewUrl = "{{ route('businessresearch.show', ':id') }}".replace(':id', data);
                    return `
                        <a href="${viewUrl}" class="btn btn-sm" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                         <button class="btn btn-sm action-button" data-id="${data}">
                        <i class="fas fa-check-circle"></i>
                         </button>
                    `;
                }
            }
            ]
        });
    });

    $(document).on('click', '.action-button', function () {
    var id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to close this project?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, close it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('businessresearch.close', ':id') }}".replace(':id', id),
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    Swal.fire({
                        title: 'Closed!',
                        text: response.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    setTimeout(() => location.reload(), 1500);
                },
                error: function (xhr) {
                    Swal.fire('Error', 'Something went wrong.', 'error');
                }
            });
        }
    });
});

    </script>

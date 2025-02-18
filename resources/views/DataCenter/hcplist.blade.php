@extends('layouts.master')
@section('page_title', 'HCP Panel Registration Invite')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('#hcpTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('hcpPanelInviteData') }}",
            data: function (data) {
                data.country = $("#country").val();
                data.speciality = $("#speciality").val();
            },
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'date', name: 'date' },
            { data: 'firstname', name: 'firstname' },
            { data: 'lastname', name: 'lastname' },
            { data: 'email', name: 'email' },
            { data: 'PhNumber', name: 'PhNumber' },
            { data: 'country1', name: 'country1' },
            { data: 'docterSpeciality', name: 'docterSpeciality' },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false,
                render: function(data, type, row) {
                    return `
                    <i class="fa fa-edit text-warning edit-btn" data-id="${row.id}" title="Edit" style="cursor: pointer;"></i>
                    <i class="fa fa-trash text-danger delete-btn" data-id="${row.id}" title="Delete" style="cursor: pointer; margin-left: 10px;"></i>
                `;

            }

            },

        ],
    });

    $('#country').change(function () {
        table.draw();
    });

    $('#speciality').change(function () {
        table.draw();
    });

    $('#hcpTable').on('click', '.edit-btn', function() {
    const id = $(this).data('id');
    $.ajax({
        url: `{{ route('hcp.edit', ':id') }}`.replace(':id', id),
        type: 'GET',
        success: function(response) {
            if (response.success) {
                const hcp = response.data;

                // Populate country and speciality dropdowns
                $('#editModal #country').html('');
                $('#editModal #speciality').html('');
                response.countries.forEach((country) => {
                    $('#editModal #country').append(
                        `<option value="${country.name}" ${
                            country.name === hcp.country1 ? 'selected' : ''
                        }>${country.name}</option>`
                    );
                });

                response.specialities.forEach((speciality) => {
                    $('#editModal #speciality').append(
                        `<option value="${speciality.speciality}" ${
                            speciality.speciality === hcp.docterSpeciality ? 'selected' : ''
                        }>${speciality.speciality}</option>`
                    );
                });

                // Populate other fields
                $('#editModal #hcp_id').val(id);
                $('#editModal #firstname').val(hcp.firstname);
                $('#editModal #lastname').val(hcp.lastname);
                $('#editModal #email').val(hcp.email);
                $('#editModal #phone').val(hcp.PhNumber);

                // Show modal
                $('#editModal').modal('show');
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr) {
            Swal.fire('Error', 'Failed to fetch HCP details.', 'error');
        }
    });
});


$('#updateHcpForm').on('submit', function(e) {
    e.preventDefault();
    const id = $('#editModal #hcp_id').val();
    const formData = $(this).serialize();

    $.ajax({
        url: `{{ route('hcp.update', ':id') }}`.replace(':id', id),
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response.success) {
                Swal.fire('Success', response.message, 'success');
                $('#editModal').modal('hide');
                $('#hcpTable').DataTable().ajax.reload();
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
        error: function(xhr) {
            Swal.fire('Error', 'Failed to update HCP details.', 'error');
        }
    });
});

$('#hcpTable').on('click', '.delete-btn', function() {
    const id = $(this).data('id');
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will not be able to recover this record!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: `{{ route('hcp.delete', ':id') }}`.replace(':id', id),
                type: 'DELETE',
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Deleted!', response.message, 'success');
                        $('#hcpTable').DataTable().ajax.reload();
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
                error: function(xhr) {
                    Swal.fire('Error', 'Failed to delete the HCP record.', 'error');
                }
            });
        }
    });
});

});
</script>
<style>
     .header{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        
    }
    .table_background{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        color:white;
    }
    .inbox {
        outline: 1px solid #0a51a4 !important;
        border-radius: 21px !important;
     }
     
</style>
<div class="row">
    <div class="col-md-12">
        <div class="card " id="header-title">  
            <div class="card-header header-elements-inline header">
                <div class="card-title" style="color:whitesmoke;">Hcp panel Registration</div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label>Country</label>
                        <select class="form-control inbox" id="country" name="country">
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
                            @foreach($speciality as $spec)
                                <option value="{{ $spec->speciality }}">{{ $spec->speciality }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
               
            <div class="table-responsive col-md-12">
                <table class="table-hover" id="hcpTable">
                    <thead>
                        <tr class="table_background">
                            <th>S.No</th>
                            <th>Date</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Ph Number</th>
                            <th>Country</th>
                            <th>Speciality</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                        </tr>    
                     </tbody>  
                </table>
            </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="updateHcpForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit HCP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="hcp_id" name="hcp_id">
                    <div class="form-group">
                        <label for="firstname">First Name</label>
                        <input type="text" name="firstname" id="firstname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" name="lastname" id="lastname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" name="PhNumber" id="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select name="country1" id="country" class="form-control"></select>
                    </div>
                    <div class="form-group">
                        <label for="speciality">Speciality</label>
                        <select name="docterSpeciality" id="speciality" class="form-control"></select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

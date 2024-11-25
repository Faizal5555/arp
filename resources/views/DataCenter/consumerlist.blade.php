@extends('layouts.master')
@section('page_title', 'Consumer Registration')
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

    var table = $('#consumerTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('consumerRegistrationData') }}",
            data: function (data) {
                data.country = $("#country").val();
            },
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'fname', name: 'fname' },
            { data: 'lname', name: 'lname' },
            { data: 'email', name: 'email' },
            { data: 'phone', name: 'phone' },
            { data: 'country', name: 'country' },
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
                },
            },
        ],

    });

    $('#country').change(function () {
        table.draw();
    });

    // Edit Consumer
$('#consumerTable').on('click', '.edit-btn', function() {
    const id = $(this).data('id');

    $.ajax({
        url: `{{ route('consumer.edit', ':id') }}`.replace(':id', id),
        type: 'GET',
        success: function(response) {
            if (response.success) {
                const consumer = response.data;
                const countries = response.countries;

                // Populate modal fields
                $('#editModal #consumer_id').val(id);
                $('#editModal #fname').val(consumer.fname);
                $('#editModal #lname').val(consumer.lname);
                $('#editModal #email').val(consumer.email);
                $('#editModal #phone').val(consumer.phone);

                // Populate countries
                let countryOptions = '';
                countries.forEach(country => {
                    countryOptions += `<option value="${country.name}" ${country.name === consumer.country ? 'selected' : ''}>${country.name}</option>`;
                });
                $('#editModal #country').html(countryOptions);

                // Show modal
                $('#editModal').modal('show');
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
    });
});

// Update Consumer
$('#updateConsumerForm').on('submit', function(e) {
    e.preventDefault();
    const id = $('#editModal #consumer_id').val();
    const formData = $(this).serialize();

    $.ajax({
        url: `{{ route('consumer.update', ':id') }}`.replace(':id', id),
        type: 'POST',
        data: formData,
        success: function(response) {
            if (response.success) {
                Swal.fire('Success', response.message, 'success');
                $('#editModal').modal('hide');
                $('#consumerTable').DataTable().ajax.reload();
            } else {
                Swal.fire('Error', response.message, 'error');
            }
        },
    });
});

// Delete Consumer
$('#consumerTable').on('click', '.delete-btn', function() {
    const id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: 'This action cannot be undone.',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
    }).then(result => {
        if (result.isConfirmed) {
            $.ajax({
                url: `{{ route('consumer.delete', ':id') }}`.replace(':id', id),
                type: 'DELETE',
                success: function(response) {
                    if (response.success) {
                        Swal.fire('Deleted!', response.message, 'success');
                        $('#consumerTable').DataTable().ajax.reload();
                    } else {
                        Swal.fire('Error', response.message, 'error');
                    }
                },
            });
        }
    });
});

});
</script>

<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
    }
    .table_background {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
        color: white;
    }
    .inbox {
        outline: 1px solid #0a51a4 !important;
        border-radius: 21px !important;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card" id="header-title">
            <div class="card-header header-elements-inline header">
                <div class="card-title" style="color: whitesmoke;">Consumer Registration</div>
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
                </div>
                <div class="table-responsive col-md-12">
                    <table class="table-hover" id="consumerTable">
                        <thead>
                            <tr class="table_background">
                                <th>S.No</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Country</th>
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
        <form id="updateConsumerForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Consumer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="consumer_id" name="consumer_id">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone</label>
                        <input type="text" name="phone" id="phone" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="country">Country</label>
                        <select name="country" id="country" class="form-control"></select>
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

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
/*end table next follow up css*/


</style>

<div class="card">
    <div class="card-header header">
        <h5>Existing Feasibility Projects</h5>
    </div>

    <!-- Table Section -->
    <div class="table-responsive mt-5 px-2">
        <table class="table table-bordered mt-3" id="existing-feasibility-table">
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Date</th>
                    <th>PN Number</th>
                    <th>Email Subject</th>
                    <th>Project Launch Date</th>
                    <th>Countries</th>
                    <th>Respondent Title</th>
                    @if(auth()->user()->user_type === 'admin')
                        <th>Respondent Email</th>
                    @endif
                    <th>Samples Required</th>
                    <th>Samples Delivered</th>
                    <th>Incentive Promised</th>
                    <th>Total Incentive Paid</th>
                    <th>Incentive Paid Date</th>
                    <th>Mode of Payment</th>
                    @if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'global_manager')
                        <th>Action</th>
                    @endif
                </tr>
            </thead>
            <tbody>
                <!-- Dynamic rows will be appended here -->
            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Project Feasibility</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edit-form">
                    @csrf
                    <input type="hidden" name="id" id="edit-id">

                    <div class="row">
                        <div class="col-md-6">
                            <label for="edit-date">Date</label>
                            <input type="date" name="date" id="edit-date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-pn_number">PN Number</label>
                            <input type="text" name="pn_number" id="edit-pn_number" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="edit-email_subject_line">Email Subject Line</label>
                            <input type="text" name="email_subject_line" id="edit-email_subject_line" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-project_launch_date">Project Launch Date</label>
                            <input type="date" name="project_launch_date" id="edit-project_launch_date" class="form-control" required>
                        </div>
                    </div>

                    <!-- Countries Field -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="edit-countries">Target Countries</label>
                            <div class="edit-container edit-countries">
                                <div class="d-flex mb-2">
                                    <input type="text" name="target_countries[]" class="form-control" placeholder="Enter Country" required>
                                    <button type="button" class="btn btn-info ms-2 add-country">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="edit-responded_titles">Respondent Title</label>
                            <div class="edit-container edit-titles">
                                <div class="d-flex mb-2">
                                    <input type="text" name="responded_titles[]" class="form-control" placeholder="Enter Respondent Title" required>
                                    <button type="button" class="btn btn-info ms-2 add-title">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="edit-responded_email">Respondent Email</label>
                            <div class="edit-container edit-emails">
                                <div class="d-flex mb-2">
                                    <input type="email" name="responded_email[]" class="form-control" placeholder="Enter Respondent Email" required>
                                    <button type="button" class="btn btn-info ms-2 add-email">+</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="edit-no_of_sample_required">No. of Samples Required</label>
                            <input type="text" name="no_of_sample_required" id="edit-no_of_sample_required" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-no_of_sample_delivered">No. of Samples Delivered</label>
                            <input type="text" name="no_of_sample_delivered" id="edit-no_of_sample_delivered" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="edit-incentive_promised">Incentive Promised</label>
                            <input type="text" name="incentive_promised" id="edit-incentive_promised" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-total_incentive_paid">Total Incentive Paid</label>
                            <input type="text"  name="total_incentive_paid" id="edit-total_incentive_paid" class="form-control" required>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="edit-incentive_paid_date">Incentive Paid Date</label>
                            <input type="date" name="incentive_paid_date" id="edit-incentive_paid_date" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-mode_of_payment">Mode of Payment</label>
                            <input type="text" name="mode_of_payment" id="edit-mode_of_payment" class="form-control" required>
                        </div>
                    </div>

                    <div class="mt-3 text-center">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function () {
        loadExistingProjects();

        function loadExistingProjects() {
            $('#existing-feasibility-table').DataTable({
                dom: 'Blfrtip',
                "lengthMenu": [ [10, 25, 50,75,100, -1], [10, 25, 50,75,100, "All"] ],
                ajax: {
                    url: "{{ route('project.existing') }}",
                    method: "GET",
                },
                columns: [
                    { data: null, render: function (data, type, row, meta) { return meta.row + 1; } },
                    { data: "date" },
                    { data: "pn_number" },
                    { data: "email_subject_line" },
                    { data: "project_launch_date" },
                    { data: "target_countries", render: function (data) { return JSON.parse(data || '[]').join(', '); } },
                    { data: "responded_titles", render: function (data) { return JSON.parse(data || '[]').join(', '); } },
                    @if(auth()->user()->user_type === 'admin')
                        { data: "responded_emails", render: function (data) { return JSON.parse(data || '[]').join(', '); } },
                    @endif
                    { data: "no_of_sample_required" },
                    { data: "no_of_sample_delivered" },
                    { data: "incentive_promised" },
                    { data: "total_incentive_paid" },
                    { data: "incentive_paid_date" },
                    { data: "mode_of_payment" },
                    @if(auth()->user()->user_type === 'admin' || auth()->user()->user_type === 'global_manager')
                    {
                        data: "id",
                        render: function (data) {
                            return `
                                <button class="btn btn-primary btn-sm status-btn" data-id="${data}">Status</button>
                                

                            `;
                        }
                    }
                    @endif
                ]
            });
        }

        // Delete Functionality
        $(document).on('click', '.edit-btn', function () {
    const id = $(this).data('id');
    $.ajax({
        url: `project-feasibility/${id}/edit`, // Adjust route as needed
        method: 'GET',
        success: function (response) {
            // Populate single-value fields
            $('#edit-id').val(response.id);
            $('#edit-date').val(response.date);
            $('#edit-pn_number').val(response.pn_number);
            $('#edit-email_subject_line').val(response.email_subject_line);
            $('#edit-project_launch_date').val(response.project_launch_date);
            $('#edit-no_of_sample_required').val(response.no_of_sample_required);
            $('#edit-no_of_sample_delivered').val(response.no_of_sample_delivered);
            $('#edit-incentive_promised').val(response.incentive_promised);
            $('#edit-total_incentive_paid').val(response.total_incentive_paid);
            $('#edit-incentive_paid_date').val(response.incentive_paid_date);
            $('#edit-mode_of_payment').val(response.mode_of_payment);

            // Populate multiple-value fields (countries)
            const countriesContainer = $('.edit-countries'); // Use the correct class
            countriesContainer.empty(); // Clear existing fields
            const countries = JSON.parse(response.target_countries || '[]'); // Parse the countries JSON
            if (countries.length === 0) {
                // Add a single row if no countries are present
                countriesContainer.append(`
                    <div class="d-flex mb-2">
                        <input type="text" name="target_countries[]" class="form-control" placeholder="Enter Country" required>
                        <button type="button" class="btn btn-info ms-2 add-field add-country">+</button>
                    </div>
                `);
            } else {
                countries.forEach((country, index) => {
                    countriesContainer.append(`
                        <div class="d-flex mb-2">
                            <input type="text" name="target_countries[]" class="form-control" value="${country}" required>
                            ${index === countries.length - 1
                                ? '<button type="button" class="btn btn-info ms-2 add-field add-country">+</button>'
                                : '<button type="button" class="btn btn-danger ms-2 remove-field">-</button>'}
                        </div>
                    `);
                });
            }

            // Populate multiple-value fields (respondent titles)
            const titlesContainer = $('.edit-titles'); // Use the correct class
            titlesContainer.empty(); // Clear existing fields
            const titles = JSON.parse(response.responded_titles || '[]'); // Parse the titles JSON
            if (titles.length === 0) {
                // Add a single row if no titles are present
                titlesContainer.append(`
                    <div class="d-flex mb-2">
                        <input type="text" name="responded_titles[]" class="form-control" placeholder="Enter Respondent Title" required>
                        <button type="button" class="btn btn-info ms-2 add-field add-title">+</button>
                    </div>
                `);
            } else {
                titles.forEach((title, index) => {
                    titlesContainer.append(`
                        <div class="d-flex mb-2">
                            <input type="text" name="responded_titles[]" class="form-control" value="${title}" required>
                            ${index === titles.length - 1
                                ? '<button type="button" class="btn btn-info ms-2 add-field add-title">+</button>'
                                : '<button type="button" class="btn btn-danger ms-2 remove-field">-</button>'}
                        </div>
                    `);
                });
            }

            // Populate multiple-value fields (respondent emails)
            const emailsContainer = $('.edit-emails'); // Use the correct class
            emailsContainer.empty(); // Clear existing fields
            const emails = JSON.parse(response.responded_emails || '[]'); // Parse the emails JSON
            if (emails.length === 0) {
                // Add a single row if no emails are present
                emailsContainer.append(`
                    <div class="d-flex mb-2">
                        <input type="email" name="responded_email[]" class="form-control" placeholder="Enter Respondent Email" required>
                        <button type="button" class="btn btn-info ms-2 add-field add-email">+</button>
                    </div>
                `);
            } else {
                emails.forEach((email, index) => {
                    emailsContainer.append(`
                        <div class="d-flex mb-2">
                            <input type="email" name="responded_email[]" class="form-control" value="${email}" required>
                            ${index === emails.length - 1
                                ? '<button type="button" class="btn btn-info ms-2 add-field add-email">+</button>'
                                : '<button type="button" class="btn btn-danger ms-2 remove-field">-</button>'}
                        </div>
                    `);
                });
            }

            // Open the modal
            $('#editModal').modal('show');
        },
        error: function () {
            alert('Error fetching project data.');
        }
    });
});



// Add New Field
// Add Country Field
// Add Country Field
// Add Country Field
$(document).on('click', '.add-country', function () {
    const container = $('.edit-countries');
    container.append(`
        <div class="d-flex mb-2">
            <input type="text" name="target_countries[]" class="form-control" placeholder="Enter Country" required>
            <button type="button" class="btn btn-danger ms-2 remove-field">-</button>
            <button type="button" class="btn btn-info ms-2 add-country">+</button>
        </div>
    `);

    // Remove the "Add" button from all rows except the last one
    container.find('.add-country').not(':last').remove();

    // Update visibility of Remove buttons
    updateRemoveButtons(container);
});

// Add Respondent Title Field
$(document).on('click', '.add-title', function () {
    const container = $('.edit-titles');
    container.append(`
        <div class="d-flex mb-2">
            <input type="text" name="responded_titles[]" class="form-control" placeholder="Enter Respondent Title" required>
            <button type="button" class="btn btn-danger ms-2 remove-field">-</button>
            <button type="button" class="btn btn-info ms-2 add-title">+</button>
        </div>
    `);

    // Remove the "Add" button from all rows except the last one
    container.find('.add-title').not(':last').remove();

    // Update visibility of Remove buttons
    updateRemoveButtons(container);
});

// Add Respondent Email Field
$(document).on('click', '.add-email', function () {
    const container = $('.edit-emails');
    container.append(`
        <div class="d-flex mb-2">
            <input type="email" name="responded_email[]" class="form-control" placeholder="Enter Respondent Email" required>
            <button type="button" class="btn btn-danger ms-2 remove-field">-</button>
            <button type="button" class="btn btn-info ms-2 add-email">+</button>
        </div>
    `);

    // Remove the "Add" button from all rows except the last one
    container.find('.add-email').not(':last').remove();

    // Update visibility of Remove buttons
    updateRemoveButtons(container);
});

// Remove Field
$(document).on('click', '.remove-field', function () {
    const container = $(this).closest('.edit-container'); // Get the parent container

    // Remove the current row
    $(this).closest('.d-flex').remove();

    // If no "Add" button exists, add it to the last row
    const lastRow = container.find('.d-flex').last();
    if (lastRow.find('.add-country').length === 0 && container.hasClass('edit-countries')) {
        lastRow.append(`<button type="button" class="btn btn-info ms-2 add-country">+</button>`);
    }
    if (lastRow.find('.add-title').length === 0 && container.hasClass('edit-titles')) {
        lastRow.append(`<button type="button" class="btn btn-info ms-2 add-title">+</button>`);
    }
    if (lastRow.find('.add-email').length === 0 && container.hasClass('edit-emails')) {
        lastRow.append(`<button type="button" class="btn btn-info ms-2 add-email">+</button>`);
    }

    // Update visibility of Remove buttons
    updateRemoveButtons(container);
});

// Function to Update Remove Buttons
function updateRemoveButtons(container) {
    const rows = container.find('.d-flex');
    if (rows.length === 1) {
        // Hide the Remove button if there's only one row
        rows.find('.remove-field').hide();
    } else {
        // Show the Remove button for all rows
        rows.find('.remove-field').show();
    }
}


$(document).on('submit', '#edit-form', function (e) {
    e.preventDefault();

    const id = $('#edit-id').val(); // Get the ID of the record to update
    const formData = $(this).serialize(); // Serialize form data

    $.ajax({
        url: `project-feasibility/${id}`, // Route for the update function
        method: 'PUT',
        data: formData,
        success: function (response) {
            if (response.success) {
                // Show SweetAlert Success Popup
                Swal.fire({
                    title: 'Success!',
                    text: response.message,
                    icon: 'success',
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Reload the page on clicking OK
                        location.reload();
                    }
                });

                // Hide the modal
                $('#editModal').modal('hide');
            }
        },
        error: function (xhr) {
            // Handle validation errors
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                let errorMessage = 'Please correct the following errors:\n';
                for (let field in errors) {
                    errorMessage += `${errors[field].join('\n')}\n`;
                }
                Swal.fire({
                    title: 'Validation Error!',
                    text: errorMessage,
                    icon: 'error',
                    confirmButtonText: 'OK'
                });
            } else {
                alert('Error updating project. Please try again.');
            }
        },
    });
});


$(document).on('click', '.delete-btn', function () {
    const id = $(this).data('id'); // Get the ID of the record to delete

    // Show confirmation popup using SweetAlert
    Swal.fire({
        title: 'Are you sure?',
        text: 'You will be delete this!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Make AJAX request to delete the record
            $.ajax({
                url: `project-feasibility/${id}`, // Route for the delete function
                method: 'DELETE',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content') // CSRF token
                },
                success: function (response) {
                    if (response.success) {
                        // Show success message
                        Swal.fire({
                            title: 'Deleted!',
                            text: response.message,
                            icon: 'success',
                            confirmButtonText: 'OK'
                        }).then(() => {
                            // Reload the page or remove the deleted row from the table
                            location.reload();
                        });
                    } else {
                        Swal.fire({
                            title: 'Error!',
                            text: response.message,
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }
                },
                error: function () {
                    Swal.fire({
                        title: 'Error!',
                        text: 'An error occurred while deleting the project feasibility. Please try again.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            });
        }
    });
});

$(document).on('click', '.status-btn', function () {
    const id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: 'Do you want to close this project?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Close it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('projectFeasibility.changeStatus', ':id') }}".replace(':id', id),
                method: 'PUT',
                data: { _token: '{{ csrf_token() }}' },
                success: function (response) {
                    if (response.success) {
                        Swal.fire('Closed!', response.message, 'success');
                        $('#existing-feasibility-table').DataTable().ajax.reload(null, false);
                    } else {
                        Swal.fire('Error!', response.message, 'error');
                    }
                },
                error: function (xhr) {
                    if (xhr.status === 404) {
                        Swal.fire('Error!', 'Project not found or already closed', 'error');
                    } else {
                        Swal.fire('Error!', 'An unexpected error occurred. Please try again.', 'error');
                    }
                }
            });
        }
    });
});

    });
    
</script>
@endpush

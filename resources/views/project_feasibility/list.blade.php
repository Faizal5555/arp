@extends('layouts.master')

@section('content')

<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
        color: white;
    }
</style>

<div class="card">
    <div class="card-header header">
        <h4>Search Feasibility Projects</h4>
    </div>

    <!-- Filters Section -->
    <div class="card-body">
        <form id="filter-form">
            <div class="row">
                <!-- Date Filter -->
                <div class="col-md-3">
                    <label for="from_date">From Date</label>
                    <input type="date" name="from_date" id="from_date" class="form-control">
                </div>
                <!-- To Date Filter -->
                <div class="col-md-3">
                    <label for="to_date">To Date</label>
                    <input type="date" name="to_date" id="to_date" class="form-control">
                </div>
                <!-- PN Number Filter -->
                <div class="col-md-3">
                    <label for="pn_number">PN Number</label>
                    <input type="text" name="pn_number" id="pn_number" class="form-control" placeholder="Enter PN Number">
                </div>
                <!-- Country Filter -->
                <div class="col-md-3">
                    <label for="country">Country</label>
                    <input type="text" name="country" id="country" class="form-control" placeholder="Enter Country">
                </div>
                <!-- Responded Title Filter -->
                <div class="col-md-3 mt-3">
                    <label for="responded_titles">Respondent Title</label>
                    <input type="text" name="responded_titles" id="responded_titles" class="form-control" placeholder="Enter Responded Title">
                </div>
            </div>
            <div class="mt-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">Apply</button>
                <button type="button" id="clear-filters" class="btn btn-secondary ml-2">Clear</button>
            </div>
        </form>
    </div>

    <!-- Table Section -->
    <div class="table-responsive">
        <table class="table table-bordered mt-3" id="feasibility-table">
            <thead>
                <tr>
                    <th>S.no</th>
                    <th>Date</th>
                    <th>PN Number</th>
                    <th>Respondent FirstName</th>
                    <th>Respondent LastName</th>
                    <th>Email Subject</th>
                    <th>Project Launch Date</th>
                    <th>Countries</th>
                    <th>Respondent Title</th>
                    @if(auth()->user()->user_type === 'admin') <!-- Check if the user type is admin -->
                    <th>Respondent Email</th>
                @endif
                    <th>Samples Required</th>
                    <th>Samples Delivered</th>
                    <th>Incentive Promised</th>
                    <th>Total Incentive paid</th>
                    <th>Incentive Paid Date</th>
                    <th>Mode of Payment</th>
                    @if($user_type === 'admin' || $user_type === 'global_manager')
                    <th>Action</th> <!-- Show 'User' column only for admins -->
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

                    <div class="row mt-3">
                        <div class="col-md-6">
                            <label for="edit-respondent_firstname">Respondent FirstName</label>
                            <input type="text" name="respondent_firstname" id="edit-respondent_firstname" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label for="edit-respondent_lastname">Respondent LastName</label>
                            <input type="text" name="respondent_lastname" id="edit-respondent_lastname"  class="form-control" required>
                        </div>
                    </div>

                    <!-- Countries Field -->
                    <div class="row mt-3">
                        <div class="col-md-12">
                            <label for="edit-countries">Target Countries</label>
                            <div class="edit-container edit-countries">
                                <div class="d-flex mb-2">
                                    <input type="text" name="target_countries[]" class="form-control" placeholder="Enter Country" required>
                                    <button type="button" class="btn btn-info mx-2 add-country">+</button>
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
                                    <button type="button" class="btn btn-info mx-2 add-title">+</button>
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
                                    <button type="button" class="btn btn-info mx-2 add-email">+</button>
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
                            <div class="edit-container edit-payments">
                                <div class="d-flex mb-2">
                                <input type="text" name="mode_of_payment[]" class="form-control" required>
                                <button type="button" class="btn btn-info mx-2 add-payment">+</button>
                                </div>
                            </div>
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@push('scripts')
<script>
    $(document).ready(function () {
        // Load data initially
        fetchTableData();

        // Handle form submission using AJAX
        $('#filter-form').on('submit', function (e) {
            e.preventDefault();
            fetchTableData();
        });

        // Clear filters and reload table
        $('#clear-filters').on('click', function () {
            $('#filter-form')[0].reset();
            fetchTableData();
        });

        // Function to fetch data and render table
        function fetchTableData() {
            $.ajax({
                url: "{{ route('projectFeasibility.Data') }}",
                method: "GET",
                data: $('#filter-form').serialize(),
                success: function (response) {
                    renderTable(response.data, response.user_type);
                },
                error: function () {
                    alert("Error fetching table data. Please try again.");
                }
            });
        }

        // Function to render table data
        function renderTable(data, userType) {
    const tableBody = $('#feasibility-table tbody');
    tableBody.empty();

    if (data.length === 0) {
        tableBody.append('<tr><td colspan="11" class="text-center">No records found.</td></tr>');
        return;
    }

    let index = 1;
    data.forEach(row => {
        const countries = JSON.parse(row.target_countries || '[]').join(', ');
        const emails = JSON.parse(row.responded_emails || '[]').join(', ');
        const titles = JSON.parse(row.responded_titles || '[]').join(', ');

        let paymentModes = '-';
    try {
        const parsed = typeof row.mode_of_payment === 'string'
            ? JSON.parse(row.mode_of_payment)
            : Array.isArray(row.mode_of_payment)
                ? row.mode_of_payment
                : [];
        paymentModes = parsed.length ? parsed.join(', ') : '-';
    } catch (e) {
        console.warn('Error parsing mode_of_payment:', row.mode_of_payment);
    }

        tableBody.append(`
            <tr>
                <td>${index++}</td>
                <td>${row.date}</td>
                <td>${row.pn_number}</td>
                <td>${row.respondent_firstname ? row.respondent_firstname : '-'}</td>
                <td>${row.respondent_lastname ? row.respondent_lastname : '-'}</td>
                <td>${row.email_subject_line}</td>
                <td>${row.project_launch_date}</td>
                <td>${countries}</td>
                <td>${titles}</td>
                 ${userType === 'admin' ? `<td>${emails}</td>` : ''}
                <td>${row.no_of_sample_required ? row.no_of_sample_required : '-'}</td>
                <td>${row.no_of_sample_delivered ? row.no_of_sample_delivered : '-'}</td>
                <td>${row.incentive_promised ? row.incentive_promised : '-'}</td>
                <td>${row.total_incentive_paid ? row.total_incentive_paid : '-'}</td>
                <td>${row.incentive_paid_date ? row.incentive_paid_date : '-'}</td>
                <td>${paymentModes}</td>
                   ${userType === 'admin' || userType === 'global_manager' ? `
                    <td>
                        <button class="btn btn-info btn-sm edit-btn" data-id="${row.id}">Edit</button>
                        <button class="btn btn-danger btn-sm delete-btn" data-id="${row.id}">Delete</button>
                    </td>
                ` : ''}
            </tr>
        `);
    });
}
    });



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
            $('#edit-respondent_firstname').val(response.respondent_firstname);
            $('#edit-respondent_lastname').val(response.respondent_lastname);
            $('#edit-email_subject_line').val(response.email_subject_line);
            $('#edit-project_launch_date').val(response.project_launch_date);
            $('#edit-no_of_sample_required').val(response.no_of_sample_required);
            $('#edit-no_of_sample_delivered').val(response.no_of_sample_delivered);
            $('#edit-incentive_promised').val(response.incentive_promised);
            $('#edit-total_incentive_paid').val(response.total_incentive_paid);
            $('#edit-incentive_paid_date').val(response.incentive_paid_date);
           

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

            const paymentContainer = $('.edit-payments');
            paymentContainer.empty();
            const payments = JSON.parse(response.mode_of_payment || '[]');
            if (payments.length === 0) {
                paymentContainer.append(`
                    <div class="d-flex mb-2">
                        <input type="text" name="mode_of_payment[]" class="form-control" placeholder="Enter Mode of Payment" required>
                        <button type="button" class="btn btn-info ms-2 add-payment">+</button>
                    </div>
                `);
            } else {
                payments.forEach((payment, index) => {
                    paymentContainer.append(`
                        <div class="d-flex mb-2">
                            <input type="text" name="mode_of_payment[]" class="form-control" value="${payment}" required>
                            ${index === payments.length - 1
                                ? '<button type="button" class="btn btn-info ms-2 add-payment">+</button>'
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


$(document).on('click', '.add-payment', function () {
    const container = $('.edit-payments');

    // Remove + buttons from all rows
    container.find('.add-payment').remove();

    // Add new row with both + and - buttons
    container.append(`
        <div class="d-flex mb-2">
            <input type="text" name="mode_of_payment[]" class="form-control" placeholder="Enter Mode of Payment" required>
            <button type="button" class="btn btn-danger ms-2 remove-field">-</button>
            <button type="button" class="btn btn-info ms-2 add-payment">+</button>
        </div>
    `);

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
    if (lastRow.find('.add-payment').length === 0 && container.hasClass('edit-payments')) {
        lastRow.append(`<button type="button" class="btn btn-info ms-2 add-payment">+</button>`);
    }

    // Update visibility of Remove buttons
    updateRemoveButtons(container);
});

// Function to Update Remove Buttons
function updateRemoveButtons(container) {
    const rows = container.find('.d-flex');
    if (rows.length === 1) {
        rows.find('.remove-field').hide(); // Hide remove if only one row
    } else {
        rows.find('.remove-field').show(); // Show remove otherwise
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



</script>
@endpush

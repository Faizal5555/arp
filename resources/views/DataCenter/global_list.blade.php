@extends('layouts.master')
@section('page_title', 'Total Registered PanelList')
@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- Summernote CSS and JS -->
<!-- jQuery (required for Bootstrap & Summernote) -->


<!-- Summernote CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

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

    if (userType === 'doctor') {
            headerRow.append("<th>Date</th>");
        }
    headerRow.append("<th>First Name</th>");
    headerRow.append("<th>Last Name</th>");

    // Conditional columns
    if (userType === 'doctor') {
        headerRow.append("<th>Speciality</th>"); // Show Speciality for HCP
    } 

    // Common columns
    headerRow.append("<th>Country</th>");
    headerRow.append("<th>Referral</th>"); // Add Referral column
    // headerRow.append("<th>Action</th>");
}

    // Function to initialize the DataTable with dynamic columns
    function initTable(userType) {
    // Destroy and remove the old DataTable instance
    if ($.fn.DataTable.isDataTable('#globalManagerTable')) {
        $('#globalManagerTable').DataTable().clear().destroy();
    }

    // Update the table header dynamically
    updateTableHeader(userType);

    // Define the base columns
    let columns = [
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false }
    ];

    // Add Date column ONLY for doctors
    if (userType === 'doctor') {
        columns.push({ data: 'date', name: 'date' }); // Date column for doctors
    }

    // First Name column (always included)
    columns.push(
    { data: 'firstname', name: 'firstname' },
    {
        data: null,
        name: 'lastname',
        render: function (data, type, row) {
            return row.lastname || row.lname || '-';
        }
    }
);
    

    // Conditional column: Speciality for Doctors, Last Name for Consumers
    if (userType === 'doctor') {
        columns.push({ data: 'docterSpeciality', name: 'docterSpeciality' }); // Speciality for doctors
    } 

    // Common columns
    columns.push(
        { data: 'country', name: 'country' },
        { data: 'referral', name: 'referral' },
        // {
        //     data: null,
        //     name: 'action',
        //     orderable: false,
        //     searchable: false,
        //     render: function (data, type, row) {
        //         return `<button class="btn btn-info send-email-btn1" data-email="${row.email}">Send Email</button>`;
        //     }
        // }
    );

    // Reinitialize the DataTable
    $('#globalManagerTable').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        ajax: {
            url: "{{ route('globalManagerListData') }}",
            data: function (data) {
                data.country = $("#country").val();
                data.user_type = userType;
            },
        },
        columns: columns // Use dynamically built columns array
    });
}

// Initialize the table for HCP by default
initTable('doctor');

// Handle tab click
$('.tab-btn').click(function () {
    $('.tab-btn').removeClass('active');
    $(this).addClass('active');

    const userType = $(this).data('user-type');
    initTable(userType);

    if (userType === 'doctor') {
        $('#filterSpeciality').closest('.form-group').show(); // Show if needed
        loadDoctorPanelists();
    } else {
        $('#filterSpeciality').closest('.form-group').hide(); // Hide speciality for consumers
        loadConsumerList();
    }
});

// Handle country change filter
$('#country').change(function () {
    $('#globalManagerTable').DataTable().draw();
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
     
        let formData = new FormData();
        
        const recipients = $('input[name="recipients[]"]:checked');
    if (recipients.length === 0) {
        Swal.fire({
            icon: 'warning',
            title: 'No Recipients',
            text: 'Please select at least one panelist to send the email.',
        });
        return;
    }

    // ✅ Second: validate the email content from Summernote
            const emailContent = $('#emailContent').summernote('code').trim();
            const cleanText = $('<div>').html(emailContent).text().trim();

            if (cleanText === '') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Missing Content',
                    text: 'Please enter email content before sending.',
                });

                $('#emailContent').summernote('focus'); // Focus editor
                return;
            }

            // ✅ Add email content
            formData.append('emailContent', emailContent);

            // ✅ Add attachment (if available)
            const attachment = $('#attachment')[0]?.files[0];
            if (attachment) {
                formData.append('attachment', attachment);
            }

            // ✅ Add selected recipients
            recipients.each(function () {
                formData.append('recipients[]', $(this).val());
            });

        $.ajax({
            url: "{{ route('global.email') }}", // Replace with your route
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#send-email').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Sending...');
            },
            success: function (response) {
                $('#send-email')
                    .prop('disabled', false)
                    .html('Submit');
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
                $('#send-email')
                    .prop('disabled', false)
                    .html('Submit');
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


    $('#openGlobalEmailModalBtn').on('click', function () {
    const currentTab = $('.tab-btn.active').data('user-type') || 'doctor';

    // Reset filters in modal (optional)
    

        $('#panelistList').html('');
        $('#panelistSection').hide();
        $('#selectAll').prop('checked', false);
        $('#emailContent').summernote('code', '');

        // Reset filters in modal (optional)
        $('#filterCountry').val('');
        $('#filterSpeciality').val('');

      


    // Load appropriate panelists when modal opens
    if (currentTab === 'doctor') {
        $('#emailModalLabel').text('Send Email to Panelists');
        $('#filterSpeciality').closest('.form-group').show();
        loadDoctorPanelists();
    } else {
        $('#emailModalLabel').text('Send Email to Consumers');
        $('#filterSpeciality').closest('.form-group').hide();
        loadConsumerList();
    }
});
    
});


$(document).ready(function () {
    function loadDoctorPanelists() {
        const country = $('#filterCountry').val();
        const speciality = $('#filterSpeciality').val();

        if (country || speciality) {
        $('#panelistSection').show();
    } else {
        $('#panelistSection').hide();
        $('#panelistList').html('');
        return;
    }


        $('#panelistList').html('<p>Loading...</p>');

        $.ajax({
            url: "{{ route('get.filtered.doctors') }}",
            type: "GET",
            data: {
                country: country,
                speciality: speciality
            },
            success: function (data) {
                let html = '';

                if (data.length > 0) {
                    data.forEach((doctor, index) => {
                        html += `<div class="form-check mb-2 d-flex align-items-start">
                            <input type="checkbox" class="panelist-checkbox mt-2 mr-2" name="recipients[]" value="${doctor.email}" id="panelist${index}">
                             <strong>${doctor.firstname} ${doctor.lastname}</strong>
                               
                        </div>`;
                    });
                } else {
                    html = '<strong>No panelists found.</strong>';
                }

                $('#panelistList').html(html);
            },
            error: function () {
                $('#panelistList').html('<p>Error loading panelists.</p>');
            }
        });
    }

    // Load when filters change
    $('#filterCountry, #filterSpeciality').on('change', function () {
    const currentTab = $('.tab-btn.active').data('user-type') || 'doctor';

    if (currentTab === 'doctor') {
        loadDoctorPanelists();
    } else {
        loadConsumerList();
    }
    });

    // Handle "Select All"
    $('#selectAll').on('change', function () {
        $('.panelist-checkbox').prop('checked', this.checked);
    });
    
    
    function loadConsumerList() {
    const country = $('#filterCountry').val();

    if (!country) {
        $('#panelistSection').hide();
        $('#panelistList').html('');
        return;
    }

    $('#panelistSection').show();
    $('#panelistList').html('<p>Loading...</p>');

    $.ajax({
        url: "{{ route('get.filtered.consumers') }}", // Create this route in your controller
        type: "GET",
        data: { country: country },
        success: function (data) {
            let html = '';

            if (data.length > 0) {
                data.forEach((user, index) => {
                    html += `<div class="form-check mb-2 d-flex align-items-start">
                        <input type="checkbox" class="panelist-checkbox mt-2 mr-2" name="recipients[]" value="${user.email}" id="consumer${index}">
                        <strong>${user.fname} ${user.lname}</strong>
                    </div>`;
                });
            } else {
                html = '<strong>No consumers found.</strong>';
            }

            $('#panelistList').html(html);
        },
        error: function () {
            $('#panelistList').html('<p>Error loading consumers.</p>');
        }
    });
}

});




$(document).ready(function() {
        $('#emailContent').summernote({
            height: 200,
            placeholder: 'Write your email content here...',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture']],
                ['view', ['codeview']]
            ]
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
                <div class="row mb-4 align-items-end">
                    <div class="col-md-4">
                        <label>Country</label>
                        <select class="form-control" id="country" name="country">
                            <option value="" selected disabled>Select Country</option>
                            @foreach($countries as $country)
                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-8 d-flex justify-content-end">
                        <button class="btn btn-primary send-email-btn" id="openGlobalEmailModalBtn" data-toggle="modal" data-target="#emailModal">Send Email</button>
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
{{-- <div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
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
</div> --}}

<!-- Email Modal -->
<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="emailModalLabel">Send Email to Panelists</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="sendEmailForm">
                <div class="modal-body">
                    <!-- Filters -->
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="filterCountry">Country</label>
                            <select class="form-control" id="filterCountry" name="filterCountry">
                                <option value="">Select Country</option>
                                @foreach($countries as $country)
                                    <option value="{{ $country->name }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="filterSpeciality">Speciality</label>
                            <select class="form-control" id="filterSpeciality" name="filterSpeciality">
                                <option value="">Select Speciality</option>
                                @foreach($specialities->sortBy('speciality') as $speciality)
                                    <option value="{{ $speciality->speciality }}">{{ $speciality->speciality }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Panelist list -->
                    <div class="form-group mt-3" id="panelistSection" style="display: none;">
                        <label>Panelists</label><br>
                        <input type="checkbox" id="selectAll"> <strong>Select All</strong>
                        <div id="panelistList" class="border p-2 mt-2" style="max-height: 200px; overflow-y: auto;">
                            <!-- Dynamically loaded -->
                        </div>
                    </div>

                    <!-- Email content -->
                    <div class="form-group mt-3">
                        <label>Email Content</label>
                        <textarea class="form-control" id="emailContent" name="emailContent"></textarea>
                    </div>

                    <!-- Attachment -->
                    <div class="form-group mt-3">
                        <label for="attachment">Attachment (optional)</label>
                        <input type="file" class="form-control" id="attachment" name="attachment" accept=".pdf,.jpg,.jpeg,.png,.doc,.docx,.xls,.xlsx">
                    </div>
                </div>

                <!-- Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="send-email">Send Email</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

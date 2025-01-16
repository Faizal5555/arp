@extends('layouts.master')
@section('page_title', 'Consumer Registration Invite')
@section('content')

<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
    }

    .error {
        color: red;
        margin-top: 3px;
    }

</style>
<!-- SweetAlert2 CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="col-md-12">
    <div class="card" id="header-title">
        <div class="card-header header-elements-inline header">
            <div class="card-title" style="color:whitesmoke;">Hcp Panel Bulk Registration Invite</div>
        </div>

        <div class="card-body" id="cardbody">
            <div class="row mb-2" id="wondiv">
                <div class="col-lg-6 col-md-12">
                    <form id="inviteForm" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="emailFile">Upload a File with Emails:</label>
                            <input type="file" class="form-control" name="emailFile" id="emailFile" accept=".csv, .txt, .xlsx" required>
                            <small class="form-text text-muted">
                                Accepted formats: CSV, TXT, or XLSX (one email per line or cell).
                                <a href="{{ route('sampleEmailFile') }}">Download Email Sample File</a>
                            </small>
                            <span id="fileError" class="text-danger" style="display: none;">Invalid file format. Only CSV, TXT, or XLSX files are allowed.</span>
                        </div>
                        
                        <div class="form-group">
                            <label for="emailContent">Email Content</label>
                            <textarea class="form-control" name="emailContent" id="emailContent" placeholder="Enter email content here" style="height: 150px;" required></textarea>
                        </div>
                    
                        <div class="form-group">
                            <label for="attachment">Attachment (optional):</label>
                            <input type="file" name="attachment" id="attachment" class="form-control" accept=".pdf, .jpg, .jpeg, .png, .doc, .docx, .xls, .xlsx">
                        </div>
                    
                        <button type="button" id="submitInvite" class="btn btn-success">
                            Send Invite
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function () {
    // Allowed file extensions
    const allowedExtensions = ['csv', 'txt', 'xlsx'];

    // File type validation for emailFile input
    $('#emailFile').on('change', function () {
        validateFile(this);
    });

    // Function to validate the file
    function validateFile(input) {
        const file = input.files[0];
        const fileExtension = file ? file.name.split('.').pop().toLowerCase() : '';

        if (!file || !allowedExtensions.includes(fileExtension)) {
            $('#fileError').text("Invalid file format. Please upload a CSV, TXT, or XLSX file.").show(); // Show error message
            input.value = ''; // Clear the input
            return false;
        } else if (file.size > 2 * 1024 * 1024) { // Check file size (2MB limit)
            $('#fileError').text("File size exceeds 2MB. Please upload a smaller file.").show();
            input.value = '';
            return false;
        } else {
            $('#fileError').hide(); // Hide error message if file is valid
            return true;
        }
    }

    // AJAX request on form submit
    $('#submitInvite').on('click', function (e) {
        e.preventDefault(); // Prevent default form submission

        const emailFileInput = $('#emailFile')[0];
    if (!validateFile(emailFileInput)) {
        Swal.fire({
            icon: 'error',
                title: 'No File Selected',
                text: 'Please select a file to upload.',
        });
        return;
    }

    let formData = new FormData($('#inviteForm')[0]);

        $.ajax({
            url: "{{ route('invite1') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function () {
                $('#submitInvite').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Sending...');
            },
            success: function (response) {
                Swal.fire({
                    title: 'Success!',
                    text: response.message,
                    icon: 'success',
                    showConfirmButton: false,
                    timer: 3000
                });
                $('#inviteForm')[0].reset();
                $('#fileError').hide(); // Hide any error if it was previously shown
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
                $('#submitInvite').prop('disabled', false).text('Send Invite');
            }
        });
    });
});


</script>

@endsection

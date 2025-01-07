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
                            <input type="file" class="form-control" name="emailFile" id="emailFile" accept=".csv, .txt" required>
                            <small class="form-text text-muted">
                                Accepted formats: CSV or TXT (one email per line).
                                <a href="{{ asset('adminapp/public/assets/sample-email-file.csv') }}" download="sample-email-file.csv">Download sample file</a>
                            </small>
                            <span id="fileError" class="text-danger" style="display: none;">Invalid file format. Only CSV and TXT files are allowed.</span>
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
  $(document).ready(function() {
    // File type validation for emailFile input
    $('#emailFile').on('change', function() {
        const allowedExtensions = ['csv', 'txt'];
        const file = this.files[0];
        const fileExtension = file ? file.name.split('.').pop().toLowerCase() : '';

        if (!allowedExtensions.includes(fileExtension)) {
            $('#fileError').show(); // Show error message
            this.value = ''; // Clear the input
        } else {
            $('#fileError').hide(); // Hide error message if file is valid
        }
    });

    // AJAX request on form submit
    $('#submitInvite').on('click', function() {
        let formData = new FormData($('#inviteForm')[0]);

        // Validate file extension before submitting
        const emailFile = $('#emailFile').val();
        const allowedExtensionsRegex = /(\.csv|\.txt)$/i;
        if (emailFile && !allowedExtensionsRegex.exec(emailFile)) {
            alert("Invalid file format for emails. Please upload a CSV or TXT file.");
            return;
        }

        $.ajax({
            url: "{{ route('invite1') }}",
            type: "POST",
            data: formData,
            contentType: false,
            processData: false,
            beforeSend: function() {
                $('#submitInvite').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Sending...');
            },
            success: function(response) {
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
            error: function(xhr) {
                Swal.fire({
                title: 'Error',
                text: xhr.responseJSON.error || 'An error occurred',
                icon: 'error',
                confirmButtonText: 'OK'
            });
            },
            complete: function() {
                $('#submitInvite').prop('disabled', false).text('Send Invite');
            }
        });
    });
});

</script>

@endsection

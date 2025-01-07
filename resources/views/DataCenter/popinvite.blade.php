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
            <div class="card-title" style="color: whitesmoke;">Consumer Registration Invite</div>
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
                            <textarea id="emailContent" name="emailContent" class="form-control" rows="5" placeholder="Enter email content here" required></textarea>
                        </div>
                    
                        <div class="form-group">
                            <label for="attachment">Attachment (optional):</label>
                            <input type="file" name="attachment" id="attachment" class="form-control">
                        </div>
                    
                        <button type="button" id="submitInvite" class="btn btn-success">Send Invite</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    // Check file type when user selects a file for email list
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

        $.ajax({
            url: "{{ route('popinvite1') }}",
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
                    timer: 2000
                });
                $('#inviteForm')[0].reset();
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

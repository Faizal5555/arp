@extends('layouts.master')
@section('page_title', 'Send Email to Panelist')
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="card" id="header-title">
    <div class="card-header header-elements-inline header">
        <div class="card-title" style="color: whitesmoke;">Send Email to Panelist</div>
    </div>

    <div class="card-body" id="cardbody">
        <!-- Filters for Country and Specialty -->
        <form id="emailFilterForm">
            <div class="row mb-2">
                <div class="col-md-4">
                    <label for="country">Country</label>
                    <select name="country" id="country" class="form-control">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4">
                    <label for="speciality">Specialty</label>
                    <select name="speciality" id="speciality" class="form-control">
                        <option value="">Select Specialty</option>
                        @foreach($specialities as $speciality)
                            <option value="{{ $speciality->speciality }}">{{ $speciality->speciality }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="button" id="filterDoctors" class="btn btn-primary">Search</button>
                </div>
            </div>
        </form>

        <!-- Display filtered doctors -->
        <div id="doctorList" class="mt-4">
            <!-- AJAX will load doctor list here -->
        </div>

        <!-- Email Content Form -->
        <form id="sendEmailForm" style="display: none;" enctype="multipart/form-data">
            <div class="form-group">
                <label for="emailContent">Email Content</label>
                <textarea id="emailContent" name="emailContent" class="form-control" rows="5" placeholder="Enter email content here"></textarea>
            </div>
            
            <!-- Attachment input field -->
            <div class="form-group col-md-4">
                <label for="emailAttachment">Attach File</label>
                <input type="file" id="emailAttachment" name="emailAttachment" class="form-control">
            </div>
        
            <button type="button" id="sendEmail" class="btn btn-success">Send Email</button>
        </form>
    </div>
</div>

@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Filter doctors based on country and specialty
    $('#filterDoctors').click(function() {
        var country = $('#country').val();
        var speciality = $('#speciality').val();

        $.ajax({
            url: "{{ route('filterDoctors') }}",
            method: 'GET',
            data: { country: country, speciality: speciality },
            success: function(data) {
                $('#doctorList').html(data);
                $('#sendEmailForm').show();

                // Add event listener for "Select All" checkbox after doctor list is loaded
                $('#select_all').on('change', function() {
                    $('.doctor-checkbox').prop('checked', this.checked);
                });

                // Uncheck "Select All" if any individual checkbox is manually unchecked
                $(document).on('change', '.doctor-checkbox', function() {
                    if ($('.doctor-checkbox:checked').length === $('.doctor-checkbox').length) {
                        $('#select_all').prop('checked', true);
                    } else {
                        $('#select_all').prop('checked', false);
                    }
                });
            },
            error: function() {
                swal.fire({
                    title: "Error",
                    text: "Error loading doctor list.",
                    icon: "error",
                    button: "OK"
                });
            }
        });
    });

    // Send email to selected doctors
    $('#sendEmail').click(function() {
        var selectedDoctors = [];
        $('input[name="doctors[]"]:checked').each(function() {
            selectedDoctors.push($(this).val());
        });
        var emailContent = $('#emailContent').val();
        var emailAttachment = $('#emailAttachment')[0].files[0]; // Get the attachment file

        if (selectedDoctors.length === 0 || emailContent === "") {
            swal.fire({
                title: "Warning",
                text: "Please select doctors and enter email content.",
                icon: "warning",
                button: "OK"
            });
            return;
        }

        var formData = new FormData();
        formData.append("_token", "{{ csrf_token() }}");
        selectedDoctors.forEach(function(doctor) {
            formData.append("doctors[]", doctor); // Ensure doctors are added as an array
        });
        formData.append("emailContent", emailContent);
        if (emailAttachment) {
            formData.append("emailAttachment", emailAttachment); // Add the attachment if it exists
        }

        $.ajax({
            url: "{{ route('sendEmailToPanelists') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            beforeSend: function() {
                $('#sendEmail').prop('disabled', true).html('<span class="spinner-border spinner-border-sm"></span> Sending...');
            },
            success: function(response) {
                swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success",
                    button: "OK"
                });
                $('#sendEmailForm').hide();
                $('#doctorList').empty();
            },
            error: function() {
                swal.fire({
                    title: "Error",
                    text: "Error sending email.",
                    icon: "error",
                    button: "OK"
                });
            },
            complete: function() {
                $('#sendEmail').prop('disabled', false).text('Send Email');
            }
        });
    });
});


</script>
@endpush

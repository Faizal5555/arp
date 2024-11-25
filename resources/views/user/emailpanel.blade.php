@extends('layouts.master')
@section('page_title', 'Send Email to Users')
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="card" id="header-title">
    <div class="card-header header-elements-inline header">
        <div class="card-title" style="color: whitesmoke;">Send Email to Consumers</div>
    </div>

    <div class="card-body" id="cardbody">
        <!-- Filters -->
        <form id="emailFilterForm">
            <div class="row mb-2">
                <div class="col-md-3">
                    <label for="country">Country</label>
                    <select name="country" id="country" class="form-control">
                        <option value="">Select Country</option>
                        @foreach($countries as $country)
                            <option value="{{ $country->name }}">{{ $country->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="que_26">Occupation</label>
                    <select name="que_26" id="que_26" class="form-control">
                        <option value="">Select Occupation</option>
                        @foreach(config('answer_key.answers.twentysix') as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="que_27">Industry</label>
                    <select name="que_27" id="que_27" class="form-control">
                        <option value="">Select Industry</option>
                        @foreach(config('answer_key.answers.twentyseven') as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3 d-flex align-items-end">
                    <button type="button" id="filterUsers" class="btn btn-primary">Search</button>
                </div>
            </div>
          
        </form>

        <!-- User List -->
        <div id="userList" class="mt-4"></div>

        <!-- Email Content Form -->
        <form id="sendEmailForm" style="display: none;" enctype="multipart/form-data">
            <div class="form-group">
                <label for="emailContent">Email Content</label>
                <textarea id="emailContent" name="emailContent" class="form-control" rows="5" placeholder="Enter email content here"></textarea>
            </div>
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
    // Filter users based on country, occupation, and industry
    $('#filterUsers').click(function() {
        var country = $('#country').val();
        var que_26 = $('#que_26').val();
        var que_27 = $('#que_27').val();

        $.ajax({
            url: "{{ route('filterUsers') }}",
            method: 'GET',
            data: { country: country, que_26: que_26, que_27: que_27 },
            success: function(data) {
                $('#userList').html(data);
                $('#sendEmailForm').show();
            },
            error: function() {
                swal.fire({
                    title: "Error",
                    text: "Error loading user list.",
                    icon: "error",
                    button: "OK"
                });
            }
        });
    });

    // Send email to selected users
    $('#sendEmail').click(function() {
        var selectedUsers = [];
        $('input[name="users[]"]:checked').each(function() {
            selectedUsers.push($(this).val());
        });
        var emailContent = $('#emailContent').val();
        var emailAttachment = $('#emailAttachment')[0].files[0];

        if (selectedUsers.length === 0 || emailContent === "") {
            swal.fire({
                title: "Warning",
                text: "Please select users and enter email content.",
                icon: "warning",
                button: "OK"
            });
            return;
        }

        var formData = new FormData();
        formData.append("_token", "{{ csrf_token() }}");
        selectedUsers.forEach(function(user) {
            formData.append("users[]", user);
        });
        formData.append("emailContent", emailContent);
        if (emailAttachment) {
            formData.append("emailAttachment", emailAttachment);
        }

        $.ajax({
            url: "{{ route('sendEmailToUsers') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                swal.fire({
                    title: "Success",
                    text: response.message,
                    icon: "success",
                    button: "OK"
                });
                $('#sendEmailForm').hide();
                $('#userList').empty();
            },
            error: function() {
                swal.fire({
                    title: "Error",
                    text: "Error sending email.",
                    icon: "error",
                    button: "OK"
                });
            }
        });
    });
});
</script>
@endpush

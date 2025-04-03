@extends('layouts.master')
@section('page_title')
@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.14/js/bootstrap-multiselect.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.14/css/bootstrap-multiselect.css" />

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<style>
.header {
    background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
}

.multiselect.dropdown-toggle {
    justify-content: space-between;
    display: flex;
    width: 100%;
    align-items: center;
}

.multiselect-container.dropdown-menu {
    width: 100%;
    height: 300px;
    overflow-y: auto;
}

#supplier-table {
    margin-top: 20px;
}

#loader {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    z-index: 9999;
}
</style>

<div id="loader">
    <div class="spinner-border text-primary" role="status">
        <span class="sr-only">Loading...</span>
    </div>
</div>

<div class="col-md-12 show_hide">
    <div class="card">
        <div class="card-header header text-white">
            <h5>Cost Request</h5>
        </div>
        <div class="card-body">
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="country" class="font-weight-bold">Country <span class="text-danger">*</span></label>
                    <select class="form-control" name="country[]" id="country" multiple="multiple">
                        @foreach($country as $v)
                            <option value="{{ $v->name }}">{{ $v->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-6 d-flex align-items-end">
                    <button class="btn btn-sm btn-success" id="next">Next</button>
                </div>
            </div>

            <div class="row d-none" id="supplier-section">
                <div class="col-md-6">
                    <table class="table table-bordered" id="supplier-table">
                        <thead>
                            <tr>
                                <th>
                                    <input type="checkbox" id="select-all">
                                    Select All
                                </th>
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-md-12 mt-3">
                        {{-- <label for="email-content" class="font-weight-bold">Email Content</label>
                        <textarea id="email-content" class="form-control" rows="5" required></textarea> --}}
                        <label for="email-content" class="font-weight-bold">Email Content</label>
                        <textarea id="email-content" class="form-control" required></textarea>
                    </div>
                    <div class="col-md-12 mt-3">
                        <label for="upload-file" class="font-weight-bold">Upload File</label>
                        <input type="file" id="upload-file" class="form-control" />
                    </div>
                </div>
                <div class="col-md-12 mt-3">
                    <button class="btn btn-sm btn-info form-submit">Send Email</button>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $('#country').multiselect({
        includeSelectAllOption: true,
        buttonWidth: '100%',
    });

    $('#next').click(function () {
    let selectedCountries = $('#country').val();
    if (!selectedCountries || selectedCountries.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please select at least one country.',
        });
        return;
    }

    // Fetch companies based on selected countries
    $.ajax({
        url: "{{ route('supplierCountry') }}",
        type: "GET",
        data: { supplierdata: selectedCountries },
        beforeSend: function () {
            $('#loader').show();
        },
        success: function (response) {
            $('#loader').hide();
            $('#supplier-section').removeClass('d-none');

            if (response.supplierManagement.length === 0) {
                Swal.fire({
                    icon: 'info',
                    title: 'No Data Found',
                    text: 'No suppliers found for the selected countries.',
                });
                return;
            }

            let rows = '';
            response.supplierManagement.forEach((supplier) => {
                rows += `
                    <tr>
                        <td>
                            <input type="checkbox" class="supplier-checkbox" value="${supplier.id}">
                            ${supplier.supplier_company}
                        </td>
                    </tr>
                `;
            });
            $('#supplier-table tbody').html(rows);
        },
        error: function () {
            $('#loader').hide();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Failed to fetch supplier data.',
            });
        },
    });
});

$('#select-all').change(function () {
    const isChecked = $(this).is(':checked');
    $('.supplier-checkbox').prop('checked', isChecked);
});

$('.form-submit').click(function () {
    let selectedSuppliers = [];
    // let emailContent = $('#email-content').val().trim(); // Get the email content and trim whitespace
     
     let emailContent = $('#email-content').summernote('code');  

    // Check if email content is empty
    if (!emailContent || $('<div>').html(emailContent).text().trim() === '') {  
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Email content is required.',
        });
        return;
    }

    // Loop through checked suppliers
    $('.supplier-checkbox:checked').each(function () {
        const id = $(this).val();
        const fileInput = $('#upload-file')[0].files[0]; // Get the file input
        selectedSuppliers.push({
            id: id,
            content: emailContent, // Add the email content for each supplier
            file: fileInput ? fileInput : null, // Add file or null if not selected
        });
    });

    // Check if at least one supplier is selected
    if (selectedSuppliers.length === 0) {
        Swal.fire({
            icon: 'error',
            title: 'Error',
            text: 'Please select at least one supplier.',
        });
        return;
    }

    let formData = new FormData();
    selectedSuppliers.forEach((supplier, index) => {
        formData.append(`data[${index}][id]`, supplier.id);
        formData.append(`data[${index}][content]`, supplier.content);
        if (supplier.file) {
            formData.append(`data[${index}][file]`, supplier.file);
        }
    });

    // Show loader
    $('#loader').show();

    // Send email request
    $.ajax({
        url: "{{ route('supplierMail') }}",
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        success: function (response) {
            $('#loader').hide();
            if (response.success === 1) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Email sent successfully!',
                });
            } else if (response.success === 2) {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: response.message,
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'Failed to send email.',
                });
            }
        },
        error: function () {
            $('#loader').hide();
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'An error occurred.',
            });
        },
    });
});

 $(document).ready(function() {
        $('#email-content').summernote({
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
@endsection

@extends('layouts.master')

@section('content')

<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
    }
</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="col-md-12">
    <div class="card pb-3" id="header-title">  
        <div class="card-header header-elements-inline header">
            <div class="card-title" style="color:whitesmoke;">New Project/Feasibility Request</div>
        </div>
        <form id="project-feasibility-form">
            
            @csrf
            <input type="hidden" class="form-control" name="userid"  value="{{$user_id}}">
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group mt-3">
                    <label for="date">Date</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
                <div class="col-md-5 form-group mt-3"></div>
            </div>
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group">
                    <label for="pn_number">PN Number</label>
                    <input type="text" name="pn_number" id="pn_number" class="form-control" required>
                </div>
                <div class="col-md-5 form-group">
                    <label for="email_subject_line">Email Subject Line</label>
                    <input type="text" name="email_subject_line" id="email_subject_line" class="form-control" required>
                </div>
            </div>
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group">
                    <label for="project_launch_date">Project Launch Date</label>
                    <input type="date" name="project_launch_date" id="project_launch_date" class="form-control" required>
                </div>
                <div class="col-md-5 form-group">
                    <label for="target_countries">Target Countries</label>
                    <div id="countries-container">
                        <div class="d-flex">
                            <input type="text" name="target_countries[]" class="form-control mb-2" required>
                            <button type="button" class="btn btn-info ml-2 add-country" style="height:38px;">+</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group">
                    <label for="project_launch_date">Respondent Firstname</label>
                    <input type="text" name="respondent_firstname" id="respondent_firstname" class="form-control" required>
                </div>
                <div class="col-md-5 form-group">
                    <label for="target_countries">Respondent Lastname</label>
                    <input type="text" name="respondent_lastname" id="respondent_lastname" class="form-control" required>
                </div>
            </div>
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group">
                    <label for="responded_title">Respondent Title</label>
                    <div id="titles-container">
                        <div class="d-flex">
                            <input type="text" name="responded_titles[]" class="form-control mb-2" required>
                            <button type="button" class="btn btn-info ml-2 add-title" style="height:38px;">+</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 form-group">
                    <label for="no_of_sample_required">No. of Samples Required</label>
                    <input type="text" name="no_of_sample_required" id="no_of_sample_required" class="form-control" required>
                </div>
            </div>
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group">
                    <label for="no_of_sample_delivered">No. of Samples Delivered</label>
                    <input type="text" name="no_of_sample_delivered" id="no_of_sample_delivered" class="form-control" required>
                </div>
                <div class="col-md-5 form-group">
                    <label for="incentive_promised">Incentive Promised</label>
                    <input type="text" name="incentive_promised" id="incentive_promised" class="form-control" required>
                </div>
            </div>
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group">
                    <label for="responded_email">Respondent Email</label>
                    <div id="emails-container">
                        <div class="d-flex">
                            <input type="email" name="responded_email[]" class="form-control mb-2" required>
                            <button type="button" class="btn btn-info ml-2 add-email" style="height:38px;">+</button>
                        </div>
                    </div>
                </div>
                <div class="col-md-5 form-group">
                    <label for="total_incentive_paid">Total Incentive Paid</label>
                    <input type="text" name="total_incentive_paid" id="total_incentive_paid" class="form-control" required>
                </div>
            </div>
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group">
                    <label for="incentive_paid_date">Incentive Paid Date</label>
                    <input type="date" name="incentive_paid_date" id="incentive_paid_date" class="form-control" required>
                </div>
                <div class="col-md-5 form-group">
                    <label for="mode_of_payment">Mode of Payment</label>
                    <input type="text" name="mode_of_payment" id="mode_of_payment" class="form-control" required>
                </div>
            </div>
            
            <div class="d-flex justify-content-center">
                <button type="button" id="save-project" class="btn btn-primary">Save</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const saveButton = document.getElementById('save-project');
        const form = document.getElementById('project-feasibility-form');

        // Handle the form submission via AJAX
        saveButton.addEventListener('click', function (e) {
            e.preventDefault();

            // Create form data
            const formData = new FormData(form);

            // AJAX Request
            fetch('{{ route("ProjectFeasibility.store") }}', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                },
                body: formData
            })
            .then(response => {
                if (!response.ok) throw response; // Handle HTTP errors
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        title: 'Success!',
                        text: data.message,
                        icon: 'success',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.href = '{{ route("ProjectFeasibility") }}';
                    });
                } else {
                    Swal.fire({
                        title: 'Error!',
                        text: 'Something went wrong. Please check your input.',
                        icon: 'error',
                        confirmButtonText: 'OK'
                    });
                }
            })
            .catch(error => {
                    error.json().then(errData => {
                        let errorMessage = '';
                        if (errData.errors) {
                            // Display validation errors as paragraphs
                            for (const key in errData.errors) {
                                errorMessage += `<p>${errData.errors[key][0]}</p>`;
                            }
                        } else {
                            errorMessage = '<p>An unexpected error occurred.</p>';
                        }

                        Swal.fire({
                            title: 'Validation Error!',
                            html: errorMessage, // Use HTML instead of text
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    }).catch(() => {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Unable to process the request.',
                            icon: 'error',
                            confirmButtonText: 'OK'
                        });
                    });
                });
        });

        // Add more countries dynamically
        document.querySelector('.add-country').addEventListener('click', function () {
            const container = document.getElementById('countries-container');
            const div = document.createElement('div');
            div.classList.add('d-flex', 'mt-2');
            div.innerHTML = `
                <input type="text" name="target_countries[]" class="form-control mb-2" required>
                <button type="button" class="btn btn-danger ml-2 remove-country" style="height:38px;">-</button>
            `;
            container.appendChild(div);
        });

        // Remove country dynamically
        document.getElementById('countries-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-country')) {
                e.target.parentElement.remove();
            }
        });

        // Add more emails dynamically
        document.querySelector('.add-email').addEventListener('click', function () {
            const container = document.getElementById('emails-container');
            const div = document.createElement('div');
            div.classList.add('d-flex', 'mt-2');
            div.innerHTML = `
                <input type="email" name="responded_email[]" class="form-control mb-2" required>
                <button type="button" class="btn btn-danger ml-2 remove-email" style="height:38px;">-</button>
            `;
            container.appendChild(div);
        });

        // Remove email dynamically
        document.getElementById('emails-container').addEventListener('click', function (e) {
            if (e.target.classList.contains('remove-email')) {
                e.target.parentElement.remove();
            }
        });
    });
    document.querySelector('.add-title').addEventListener('click', function () {
    const container = document.getElementById('titles-container');
    const div = document.createElement('div');
    div.classList.add('d-flex', 'mt-2');
    div.innerHTML = `
        <input type="text" name="responded_titles[]" class="form-control mb-2" required>
        <button type="button" class="btn btn-danger ml-2 remove-title" style="height:38px;">-</button>
    `;
    container.appendChild(div);
});

// Remove responded title dynamically
document.getElementById('titles-container').addEventListener('click', function (e) {
    if (e.target.classList.contains('remove-title')) {
        e.target.parentElement.remove();
    }
});
</script>

@endsection

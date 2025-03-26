@extends('layouts.master')

@section('content')

<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
    }
    .dropdown-toggle::after {
        float: right;
        font-size: 16px !important;
       
    }
    .dropdown-menu {
        width: 100%;
        border: 1px solid #0b5dbb;
        border-radius: 8px;

    }

    label {
        font-weight: 600;
        font-size: 16px;
        color: #333;
    }
    .form-control, .form-check-input {
        border-radius: 8px;
        border: 1px solid #ced4da;
        font-size: 16px;
        padding: 10px;
        transition: border-color 0.3s ease-in-out;
    }

    .form-control:focus, .form-check-input:focus {
        border-color: #0056b3;
        box-shadow: none;
    }

</style>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- jQuery -->

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<div class="col-md-12">
    <div class="card pb-3" id="header-title">  
        <div class="card-header header-elements-inline header">
            <div class="card-title" style="color:whitesmoke;">New Project</div>
        </div>
        <form id="project-form">
            
            @csrf
            <input type="hidden" class="form-control" name="userid"  value="{{$user_id}}">
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group mt-3">
                    <label for="date">Date</label>
                    <input type="date" name="date" value="{{ $today_date_input}}"  id="date" class="form-control" readonly required>
                </div>
                <div class="col-md-5 form-group mt-3">
                    <label for="pn_number">PN Number</label>
                    <input type="text" name="pn_number" id="pn_number" class="form-control" required>
                </div>
            </div>
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group">
                    <label for="subject_line">Subject Line</label>
                    <input type="text" name="subject_line" id="subject_line" class="form-control" required>
                </div>
                <div class="col-md-5 form-group">
                    <label for="project_launch_date">Client Name</label>
                    <input type="text" name="client_name" id="client_name" class="form-control" required>
                </div>
            </div>
            <div class="row pl-2 d-flex justify-content-center">
               
                <div class="col-md-5 form-group">
                    <label for="select_industry">Select Industry</label>
                    <select class="form-control" name="industry">
                        <option class="" value="" disabled selected>Select
                            Industry
                        </option>
                        <option value="Manufacturing Industry">Manufacturing Industry</option>
                        <option value="Production Industry">Production Industry</option>
                        <option value="Food Industry">Food Industry</option>
                        <option value="Agricultural Industry">Agricultural Industry</option>
                        <option value="Technology Industry">Technology Industry</option>
                        <option value="Construction Industry">Construction Industry</option>
                        <option value="Factory Industry">Factory Industry</option>
                        <option value="Mining Industry">Mining Industry</option>
                        <option value="Finance Industry">Finance Industry</option>
                        <option value="Retail Industry">Retail Industry</option>
                        <option value="Engineering Industry">Engineering Industry</option>
                        <option value="Marketing Industry">Marketing Industry</option>
                        <option value="Education Industry">Education Industry</option>
                        <option value="Transport Industry">Transport Industry</option>
                        <option value="Chemical Industry">Chemical Industry</option>
                        <option value="Healthcare Industry">Healthcare Industry</option>
                        <option value="Hospitality Industry">Hospitality Industry</option>
                        <option value="Energy Industry">Energy Industry</option>
                        <option value="Science Industry">Science Industry</option>
                        <option value="Waste Industry">Waste Industry</option>
                        <option value="Chemistry Industry">Chemistry Industry</option>
                        <option value="Teritiary Sector Industry">Teritiary Sector Industry</option>
                        <option value="Real Estate Industry">Real Estate Industry</option>
                        <option value="Financial Services Industry">Financial Services Industry
                        </option>
                        <option value="Telecommunications Industry">Telecommunications Industry
                        </option>
                        <option value="Distribution Industry">Distribution Industry</option>
                        <option value="Medical Device Industry">Medical Device Industry</option>
                        <option value="Biotechnology Industry">Biotechnology Industry</option>
                        <option value="Aviation Industry">Aviation Industry</option>
                        <option value="Insurance Industry">Insurance Industry</option>
                        <option value="Trade Industry">Trade Industry</option>
                        <option value="Stock Market Industry">Stock Market Industry</option>
                        <option value="Electronics Industry">Electronics Industry</option>
                        <option value="Textile Industry">Textile Industry</option>
                        <option value="Computers and Information Technology Industry">Computers and
                            Information Technology Industry</option>
                        <option value="Market Research Industry">Market Research Industry</option>
                        <option value="Machine Industry">Machine Industry</option>
                        <option value="Recycling Industry">Recycling Industry</option>
                        <option value="Information and Communication Technology Industry">
                            Information and Communication Technology Industry</option>
                        <option value="E- Commerce Industry">E- Commerce Industry</option>
                        <option value="Research Industry">Research Industry</option>
                        <option value="Rail Transport Industry">Rail Transport Industry</option>
                        <option value="Food Processing Industry">Food Processing Industry</option>
                        <option value="Small Business Industry">Small Business Industry</option>
                        <option value="Wholesale Industry">Wholesale Industry</option>
                        <option value="Pulp and Paper Industry">Pulp and Paper Industry</option>
                        <option value="Vehicle Industry">Vehicle Industry</option>
                        <option value="Steel Industry">Steel Industry</option>
                        <option value="Renewable Energy Industry">Renewable Energy Industry</option>
                    </select>
                </div>
                <div class="col-md-5 form-group">
                    <label for="responded_title">Others</label>
                    <div id="titles-container">
                            <input type="text" name="others" class="form-control mb-2" required>
                    </div>
                </div>
            </div>
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group mt-3">
                    <label for="attachments">Upload Attachments(Select Multiple) </label>
                    <input type="file" name="attachments[]" class="form-control" multiple>
                </div>
                
                <div class="col-md-5 form-group mt-3">
                    <label for="import" class="form-label">Import</label><br>
                    <button type="button" class="btn btn-primary mt-1" data-toggle="modal" data-target="#exampleModal">
                        Import Data
                      </button>
                </div>
            </div>

            <div class="row  pl-2 d-flex justify-content-center">
              
                <div class="col-md-4 form-group mt-3">
                    <label for="team_members">Allocated to Team Members</label>
                    <div class="dropdown">
                        <button class="form-control dropdown-toggle text-left" type="button" id="dropdownTeamMembers"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Select Team Members
                        </button>
                        <div class="dropdown-menu w-100 p-2 m-0" aria-labelledby="dropdownTeamMembers" style="max-height: 200px; overflow-y: auto;">
                            @foreach($team_member as $member)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="users[]" value="{{ $member->id }}" id="user_{{ $member->id }}">
                                    <label class="form-check-label" for="user_{{ $member->id }}">
                                        {{ $member->name }}
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
                <div class="col-md-5"></div>
            </div>



            
            <div class="d-flex justify-content-center mt-3">
                <button type="button" id="save-project" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    $(document).ready(function () {
        $('input[name="users[]"]').on('change', function () {
            let selected = [];
            $('input[name="users[]"]:checked').each(function () {
                selected.push($(this).next('label').text().trim());
            });

            let buttonText = selected.length > 0 ? selected.join(', ') : 'Select Team Members';
            $('#dropdownTeamMembers').text(buttonText);
        });
  
    $("#project-form").validate({
        rules: {
            date: { required: true },
            pn_number: { required: true },
            subject_line: { required: true },
            client_name: { required: true },
            industry: { required: true },
            others: { required: true },
            attachments:{required: true},
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        },
        submitHandler: function (form) {
            var formData = new FormData(form);
            $.ajax({
                type: "POST",
                url: "{{ route('businessresearch.store') }}", // Change this to your actual route
                data: formData,
                processData: false,
                contentType: false,
                beforeSend: function () {
                        // Disable the submit button and show the loader inside it
                $('#save-project')
                    .prop('disabled', true)
                    .html('<span class="spinner-border spinner-border-sm"></span> Submitting...');
                },
                success: function (response) {
                    $('#save-project')
                            .prop('disabled', false)
                            .html('Submit');
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'Project saved successfully.',
                        timer: 2000,
                        showConfirmButton: false
                    }).then(() => {
                        window.location = "{{ route('businessresearch.index') }}"; // Or redirect to another page
                    });
                },
                error: function (xhr) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops!',
                        text: 'Something went wrong. Please try again.'
                    });
                }
            });
        }
    });

    // Submit button click triggers validation
    $('#save-project').click(function () {
        $('#project-form').submit();
    });

});

</script>
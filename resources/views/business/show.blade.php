@extends('layouts.master')
@section('page_title', 'Business Team')
@section('content')
@php
    $authId = auth()->id();
@endphp

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
    textarea.form-control {
        border-color:#0056b3;
    }

</style>
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="col-md-12">
    <div class="card pb-3" id="header-title">  
        <div class="card-header header-elements-inline header">
            <div class="card-title" style="color:whitesmoke;">View Project</div>
        </div>
        <form>
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group mt-3">
                    <label>Date</label>
                    <input type="date" class="form-control" value="{{ $record->date }}" readonly>
                </div>
                <div class="col-md-5 form-group mt-3">
                    <label>PN Number</label>
                    <input type="text" class="form-control" value="{{ $record->pn_number }}" readonly>
                </div>
            </div>
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group">
                    <label>Subject Line</label>
                    <input type="text" class="form-control" value="{{ $record->subject_line }}" readonly>
                </div>
                <div class="col-md-5 form-group">
                    <label>Client Name</label>
                    <input type="text" class="form-control" value="{{ $record->client_name }}" readonly>
                </div>
            </div>
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group">
                    <label>Industry</label>
                    <input type="text" class="form-control" value="{{ $record->industry }}" readonly>
                </div>
                <div class="col-md-5 form-group">
                    <label>Others</label>
                    <input type="text" class="form-control" value="{{ $record->others }}" readonly>
                </div>
            </div>
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group mt-3">
                    <label for="team_member_id">Allocated Team Member</label>
                        <select class="form-control" id="team_member_id" name="team_member_id">
                            <option value="">-- Select --</option>
                            @foreach($record->teamMembers as $member)
                                <option value="{{ $member->id }}">{{ $member->user->name }}</option>
                            @endforeach
                        </select>
                </div>
                <div class="col-md-5">
                    <label>Attachments</label>
                    @php
                        $attachments = $record->attachments ? explode(',', $record->attachments) : [];
                    @endphp
                
                    @if(count($attachments))
                        <ul class="list-unstyled">
                            @foreach($attachments as $attachment)
                                @php $attachment = trim($attachment); @endphp
                                @if($attachment)
                                    <li>
                                        <a href="{{ asset('adminapp/storage/app/public/' . $attachment) }}" target="_blank" download>
                                            {{ basename($attachment) }}
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @else
                        <p>No attachments found.</p>
                    @endif
                </div>
            </div>


           
        </form>
        

        <form id="qa-form">
            @csrf
                      <input type="hidden" id="business_research_id" value="{{ $businessResearch->id }}">
                      <input type="hidden" name="team_member_id" value="{{ $selectedTeamMemberId }}">
                    <div id="qa_section">
                     {{-- Questions and answers will be loaded here via AJAX --}}
                    </div>

           

            <div class="col-md-12 d-flex align-items-center justify-content-center mt-4">
                <a href="{{ route('businessresearch.team') }}" class=" btn btn-outline-secondary">Back</a>
                <button type="submit" id="addRegisterButton"
                    class="ml-2 btn btn-primary">Submit</button>

            </div>
        </form>
    </div>

       
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
   $(document).ready(function () {
        $(document).on('click', '.add-qa-btn', function () {
            var newRow = `
                <div class="row qa-row mb-3">
                      <div class="col-md-1"></div>
                    <div class="col-md-3">
                        <textarea class="form-control" name="que[]" placeholder="Enter question"></textarea>
                    </div>
                    <div class="col-md-3">
                        <textarea class="form-control" name="ans[]" placeholder="Enter answer"></textarea>
                    </div>
                    <div class="col-md-3">
                        <input type="file" class="form-control" name="attachment[]">
                    </div>
                    <div class="col-md-1 d-flex align-items-start">
                        <button type="button" class="btn btn-sm btn-danger remove-qa-btn m-2 mt-1">−</button>
                    </div>
                </div>
            `;
            $('#qa-wrapper').append(newRow);
        });

        $(document).on('click', '.remove-qa-btn', function () {
            $(this).closest('.qa-row').remove();
        });
    });
$(document).ready(function () {

$.ajaxSetup({
            headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
        });
// Submit form with AJAX POST
$('#qa-form').on('submit', function (e) {
    e.preventDefault();

    let form = this; // reference the form
    let formData = new FormData(form); // gather all form data

    $.ajax({
        url: "{{ route('business.research.save.que', $record->id) }}", // your Laravel route
        type: "POST",
        data: formData,
        processData: false, // prevent jQuery from converting the data
        contentType: false, // prevent jQuery from setting content type
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // better to use meta token
        },
        success: function (response) {
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: 'Question & Answer saved successfully.',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                location.reload(); // reload after alert
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
});



$('#team_member_id').on('change', function () {
    let teamMemberId = $(this).val();
   let researchId = $('#business_research_id').val(); // or pass via hidden input

    if (teamMemberId) {
        $.ajax({
            url: "{{ route('businessresearch.question') }}",
            method: 'GET',
            data: {
                research_id: researchId,
                team_member_id: teamMemberId
            },
            success: function (response) {
                $('#qa_section').html(response); // load the returned HTML into the section
                $('input[name="team_member_id"]').val(teamMemberId); // update hidden field for submission
            }
        });
    } else {
        $('#qa_section').html('');
    }


    
});

});
</script>

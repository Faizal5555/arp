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
                    <label>End Date</label>
                    <input type="text" class="form-control" value="{{ $record->end_date }}" readonly>
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
                <div class="col-md-5 form-group">
                    <label>Target Respondent</label>
                    <input type="text" class="form-control" value="{{ $record->target_respondent }}" readonly>
                </div>
                <div class="col-md-5 form-group">
                    <label>Target Countries</label>
                    <input type="text" class="form-control" value="{{ $record->target_countries }}" readonly>
                </div>
            </div>

            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group mt-3">
                    <label>Allocated Team Member</label>
                    <ul class="list-group">
                        @foreach($record->teamMembers as $member)
                            @if($member->user_id == $authUserId)
                                    <input type="text" class="form-control" value="{{ $member->user->name ?? 'N/A' }}" readonly>
                            @endif
                        @endforeach
                    </ul>
                </div>
                <div class="col-md-5">
                    <label>Attachments</label>
                    @php
                        $attachments = $record->attachments ? explode(',', $record->attachments) : [];
                    @endphp
                
                    @if(count($attachments))
                        <div style="max-height: 150px; overflow-y: auto; border: 1px solid #ccc; padding: 10px; border-radius: 5px;">
                            <ul class="list-unstyled mb-0">
                                @foreach($attachments as $attachment)
                                    @php $attachment = trim($attachment); @endphp
                                    @if($attachment)
                                        <li class="mb-1">
                                            <a href="{{ asset('adminapp/storage/app/public/' . $attachment) }}" target="_blank" download>
                                                {{ basename($attachment) }}
                                            </a>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    @else
                        <p>No attachments found.</p>
                    @endif
                </div>
            </div>
            <div class="row pl-2 d-flex justify-content-center">
                <div class="col-md-5 form-group">
                    <label>Industry</label>
                    <input type="text" class="form-control" value="{{ $record->industry }}" readonly>
                </div>
                <div class="col-md-5 form-group">
                    <label>Has the feasibility done with panel members?</label><br>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="feasibility_done" id="feasibility_yes" value="1"
                            {{ $record->feasibility_done == 1 ? 'checked' : '' }} onclick="return false;">
                        <label class="form-check-label m-0" for="feasibility_yes">Yes</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="feasibility_done" id="feasibility_no" value="0"
                            {{ $record->feasibility_done == 0 ? 'checked' : '' }} onclick="return false;">
                        <label class="form-check-label m-0" for="feasibility_no">No</label>
                    </div>
                </div>
            </div>
        </form>
        

        <form id="qa-form">
            @csrf
            <div class="d-flex justify-content-center">
                <div class="col-md-12">
                    <label class="mb-2 pl-5"><strong>Question & Answer Section</strong></label>
                    <div id="qa-wrapper">
                        @if($record->questions->isNotEmpty())
                        @foreach($record->questions as $index => $qa)
                             
                                <input type="hidden" name="question_id[]" value="{{ $qa->id }}">
                                <div class="row qa-row mb-3">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3">
                                        <textarea class="form-control" name="que[]" placeholder="Enter question">{{ $qa->question }}</textarea>
                                    </div>
                                    <div class="col-md-3">
                                        <textarea class="form-control" name="ans[]" placeholder="Enter answer">{{ $qa->answer }}</textarea>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="file" class="form-control" name="attachment[]">
                                        @if($qa->attachment)
                                        <div>
                                            <a href="{{ url('adminapp/storage/app/public/' . $qa->attachment) }}" target="_blank" download>
                                                {{ ($qa->attachment) }}
                                            </a>
                                        </div>
                                    @endif
                                    </div>
                                    <div class="col-md-1 d-flex align-items-start">
                                        @if($index == 0)
                                            <button type="button" class="btn btn-sm btn-success add-qa-btn m-2 mt-1">+</button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger remove-qa-btn m-2 mt-1">−</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <!-- Default empty row if no questions exist -->
                            <div class="row qa-row mb-3">
                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <textarea class="form-control" name="que[]" placeholder="Enter question"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <textarea class="form-control" name="ans[]" placeholder="Enter answer"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <input type="file" class="form-control mb-1" name="attachment[]">
                                
                                    
                                </div>
                                <div class="col-md-1 d-flex align-items-start">
                                    <button type="button" class="btn btn-sm btn-success add-qa-btn m-2 mt-1">+</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>


            <div class="col-md-12 d-flex align-items-center justify-content-center mt-4">
                <a href="{{ route('businessresearch.team') }}" class=" btn btn-outline-secondary">Back</a>
                <button type="submit" id="addRegisterButton"
                    class="ml-2 btn btn-primary">Submit</button>

            </div>
        </form>
         
        <div class="progress" style="height: 25px; display: none;">
            <div class="progress-bar progress-bar-striped progress-bar-animated" 
                role="progressbar" 
                style="width: 0%" 
                aria-valuenow="0" 
                aria-valuemin="0" 
                aria-valuemax="100">
                0%
            </div>
        </div>
    </div>

       
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
//    $(document).ready(function () {
//     $(document).on('click', '.add-qa-btn', function () {
//     const userId = {{ auth()->id() }};
//     const newRow = `
//         <div class="row qa-row mb-3">
//             <div class="col-md-1"></div>
//             <div class="col-md-3">
//                 <textarea class="form-control" name="que[${userId}][]" placeholder="Enter question"></textarea>
//             </div>
//             <div class="col-md-3">
//                 <textarea class="form-control" name="ans[${userId}][]" placeholder="Enter answer"></textarea>
//             </div>
//             <div class="col-md-3">
//                 <input type="file" class="form-control" name="attachment[${userId}][]">
//             </div>
//             <div class="col-md-1 d-flex align-items-start">
//                 <button type="button" class="btn btn-sm btn-danger remove-qa-btn m-2 mt-1">−</button>
//             </div>
//         </div>
//     `;
//     $('#qa-wrapper').append(newRow);
// });

//         $(document).on('click', '.remove-qa-btn', function () {
//             $(this).closest('.qa-row').remove();
//         });
//     });

$(document).ready(function () {
    $(document).on('click', '.add-qa-btn', function () {
        const newRow = `
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
        xhr: function() {
                        var xhr = new window.XMLHttpRequest();
                        
                        // Track the progress of the request
                        xhr.upload.addEventListener("progress", function(evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = Math.round((evt.loaded / evt.total) * 100);
                                
                                // Update the progress bar
                                $(".progress-bar")
                                    .css("width", percentComplete + "%")
                                    .attr("aria-valuenow", percentComplete)
                                    .text(percentComplete + "%");
                            }
                        }, false);

                        return xhr;
                    },
        beforeSend: function () {
        // Disable the submit button and show the loader inside it
        $('#addRegisterButton')
            .prop('disabled', true)
            .html('<span class="spinner-border spinner-border-sm"></span> Sending...');
            $(".progress-bar")
                            .css("width", "0%")
                            .attr("aria-valuenow", "0")
                            .text("0%");
                        $(".progress").show();
        },
        success: function (response) {
            $(".progress").hide();
            $('#addRegisterButton')
            .prop('disabled', false)
            .html('Submit');
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
            $(".progress").hide();
            $('#addRegisterButton')
            .prop('disabled', false)
            .html('Submit');
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Something went wrong. Please try again.'
            });
        }
    });
});

});
</script>

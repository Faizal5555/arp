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
                    {{-- <label for="team_member_id">Allocated Team Member</label>
                        <select class="form-control" id="team_member_id" name="team_member_id">
                            <option value="">-- Select --</option>
                            @foreach($record->teamMembers as $member)
                                <option value="{{ $member->id }}">{{ $member->user->name }}</option>
                            @endforeach
                        </select> --}}
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
                <div class="col-md-5">
                </div>
            </div>


           
        </form>
        

        <form id="qa-form" method="POST" enctype="multipart/form-data" action="{{ route('business.research.save.que', $businessResearch->id) }}">
            @csrf
        
            @foreach($teamData as $data)
                <div class="mt-5 border p-3 rounded shadow-sm">
                    <h5 class="text-primary">Team Member: {{ $data['member'] }}</h5>
                    @php $wrapperId = 'qa-wrapper-' . $data['user_id']; @endphp
                    <div id="{{ $wrapperId }}" class="qa-wrapper-container">
                        @if($data['questions']->isNotEmpty())
                            @foreach($data['questions'] as $index => $qa)
                                <input type="hidden" name="question_id[{{ $data['user_id'] }}][]" value="{{ $qa->id }}">
                                <div class="row qa-row mb-3">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3">
                                        <textarea class="form-control" name="que[{{ $data['user_id'] }}][]" placeholder="Enter question">{{ $qa->question }}</textarea>
                                    </div>
                                    <div class="col-md-3">
                                        <textarea class="form-control" name="ans[{{ $data['user_id'] }}][]" placeholder="Enter answer">{{ $qa->answer }}</textarea>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="file" class="form-control" name="attachment[{{ $data['user_id'] }}][]">
                                        @if($qa->attachment)
                                            <div>
                                                <a href="{{ url('adminapp/storage/app/public/' . $qa->attachment) }}" target="_blank" download>
                                                    {{ basename($qa->attachment) }}
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-1 d-flex align-items-start">
                                        @if($loop->first)
                                            <button type="button" class="btn btn-sm btn-success add-qa-btn m-2 mt-1"
                                                data-target="{{ $wrapperId }}"
                                                data-user="{{ $data['user_id'] }}">+</button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-danger remove-qa-btn m-2 mt-1">−</button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="row qa-row mb-3">
                                <div class="col-md-1"></div>
                                <div class="col-md-3">
                                    <textarea class="form-control" name="que[{{ $data['user_id'] }}][]" placeholder="Enter question"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <textarea class="form-control" name="ans[{{ $data['user_id'] }}][]" placeholder="Enter answer"></textarea>
                                </div>
                                <div class="col-md-3">
                                    <input type="file" class="form-control mb-1" name="attachment[{{ $data['user_id'] }}][]">
                                </div>
                                <div class="col-md-1 d-flex align-items-start">
                                    <button type="button" class="btn btn-sm btn-success add-qa-btn m-2 mt-1"
                                        data-target="{{ $wrapperId }}"
                                        data-user="{{ $data['user_id'] }}">+</button>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        
            <div class="text-center mt-4">
                <button type="submit" id="save-que" class="btn btn-primary">Submit</button>
            </div>
        </form>
        
    

           

            {{-- <div class="col-md-12 d-flex align-items-center justify-content-center mt-4">
                <a href="{{ route('businessresearch.team') }}" class=" btn btn-outline-secondary">Back</a>
                <button type="submit" id="addRegisterButton"
                    class="ml-2 btn btn-primary">Submit</button>

            </div> --}}
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
    const wrapperId = $(this).data('target');
    const userId = $(this).data('user');
    const newRow = `
        <div class="row qa-row mb-3">
            <div class="col-md-1"></div>
            <div class="col-md-3">
                <textarea class="form-control" name="que[${userId}][]" placeholder="Enter question"></textarea>
            </div>
            <div class="col-md-3">
                <textarea class="form-control" name="ans[${userId}][]" placeholder="Enter answer"></textarea>
            </div>
            <div class="col-md-3">
                <input type="file" class="form-control" name="attachment[${userId}][]">
            </div>
            <div class="col-md-1 d-flex align-items-start">
                <button type="button" class="btn btn-sm btn-danger remove-qa-btn m-2 mt-1">−</button>
            </div>
        </div>
    `;
    $('#' + wrapperId).append(newRow);
});
        $(document).on('click', '.remove-qa-btn', function () {
            $(this).closest('.qa-row').remove();
        });
    });


    $(document).ready(function () {
        $('#qa-form').on('submit', function (e) {
    e.preventDefault();

    let formData = new FormData(this);

    $.ajax({
        url: $(this).attr('action'), // use dynamic form action
        type: "POST",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
                        // Disable the submit button and show the loader inside it
        $('#save-que')
            .prop('disabled', true)
            .html('<span class="spinner-border spinner-border-sm"></span> Sending...');
        },
        success: function () {
            $('#save-que')
            .prop('disabled', false)
            .html('Submit');
            Swal.fire({
                icon: 'success',
                title: 'Saved!',
                text: 'All team member Q&A saved.',
                timer: 2000,
                showConfirmButton: false
            }).then(() => {
                location.reload(); // reload after alert
            });
        },
        error: function () {
            Swal.fire({
                icon: 'error',
                title: 'Oops!',
                text: 'Something went wrong.'
            });
        }
    });
});
});




// $('#team_member_id').on('change', function () {
//     let teamMemberId = $(this).val();
//    let researchId = $('#business_research_id').val(); // or pass via hidden input

//     if (teamMemberId) {
//         $.ajax({
//             url: "{{ route('businessresearch.question') }}",
//             method: 'GET',
//             data: {
//                 research_id: researchId,
//                 team_member_id: teamMemberId
//             },
//             success: function (response) {
//                 $('#qa_section').html(response); // load the returned HTML into the section
//                 $('input[name="team_member_id"]').val(teamMemberId); // update hidden field for submission
//             }
//         });
//     } else {
//         $('#qa_section').html('');
//     }


    
// });


</script>

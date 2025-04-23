@extends('layouts.master')

@section('content')
<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
        color: white;
    }
    
    a.ml-2.btn.btn-primary {
    float: right;
    }
a.ml-2.btn.btn-primary {
    background-color: #fff;
    color: #0b5dbb;
    border-color: #ffff;
}

a.ml-2.btn.btn-primary {
    /* margin-left: -3px; */
    margin: 10px;
}

select.custom-select.custom-select-sm.form-control.form-control-sm {
    margin: 11px;
    color: #000;
}
select.custom-select.custom-select-sm.form-control.form-control-sm {
    padding-left: 10px;
    padding-right: 26px;
}

/*next table follow up css*/
 label.mb-0.expired {
    background-color: #c82333;
    border-color: #bd2130;
    padding: 13px;
    border-radius: 20px;
}
label.mb-0.not-expired {
    background: #198ae3;
    border-color: #198ae3;
    padding: 13px;
    border-radius: 20px;
}
.select2-container--default .select2-selection--multiple {
    min-height: 38px;
    border: 1px solid #ccc;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #5b8eff !important;
    color:black;
}
.select2-container--default .select2-selection--multiple .select2-selection__choice__remove {
    border:none !important;
    background-color: #5b8eff !important;
    color:black !important;
}
/*end table next follow up css*/


</style>
<!-- Add this in your head -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<!-- At the bottom before </body> -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<!-- jQuery -->

<!-- Select2 CSS -->



<!-- SweetAlert2 JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<div class="card">
    <div class="card-header header">
        <h5>Projects Lists</h5>
    </div>
    <div class="table-responsive mt-5 px-2">
        <table class="table table-bordered mt-3" id="businessTable">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Date</th>
                    <th>PN Number</th>
                    <th>Subject Line</th>
                    <th>Industry</th>
                    {{-- <th>Client Name</th> --}}
                    <th>Team Members</th>
                    <th>Others</th>
                    <th>Target Respondent</th>
                    <th>Target Countries</th>
                    <th>End Date</th>
                    <th>Feasibility Done</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <form id="editForm" method="POST">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Edit Business Research</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Add your input fields here -->
            <input type="hidden" name="id" id="edit_id">
            
            <div class="row pl-2 justify content center">
                <div class="col-md-6 mb-3">
                    <label>Date</label>
                    <input type="date" name="date" id="edit_date" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label>PN Number</label>
                    <input type="text" name="pn_number" id="edit_pn_number" class="form-control">
                  </div>
            </div>
  
           
            <div class="row pl-2 justify content center">
                
                <div class="col-md-6 mb-3">
                    <label for="edit_industry_select">Industry</label>
                     <select class="form-control" id="edit_industry_select" name="industry">
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
                <div class="col-md-6 mb-3">
                    <label>Subject Line</label>
                    <input type="text" name="subject_line" id="edit_subject_line" class="form-control">
                </div>
            </div>
  
           
            <div class="row pl-2 justify content center">
                <div class="col-md-6 mb-3">
                    <label>End Date</label>
                    <input type="date" name="end_date" id="edit_end_date" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_team_members">Allocated to Team Members</label>
                    <select name="team_members[]" id="edit_team_members" class="form-control" multiple>
                       
                        @foreach($team_members as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
  
          
            <div class="row pl-2 justify content center">
                <div class="col-md-6 mb-3">
                <label>Others</label>
                <textarea name="others" id="edit_others" class="form-control"></textarea>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_feasibility_done">Feasibility Done</label>
                    <select name="feasibility_done" id="edit_feasibility_done" class="form-control">
                        <option value="" disabled selected>Select Status</option>
                        <option value="1">Yes</option>
                        <option value="0">No</option>
                    </select>
                </div>
            </div>

            <div class="row pl-2 justify content center">
                <div class="col-md-6 mb-3">
                    <label>Target Respondent</label>
                    <input type="text" name="target_respondent" id="edit_target_respondent" class="form-control">
                </div>
                <div class="col-md-6 mb-3">
                    <label for="edit_target_countries">Target Countries</label>
                    <input type="text" name="target_countries" id="edit_target_countries" class="form-control">
                </div>
            </div>
  
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-success">Update</button>
          </div>
        </div>
      </form>
    </div>
  </div>
  
@endsection

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!-- DataTables JS and jQuery should already be included in your layout -->

<script>
$(document).ready(function() {
    $('#businessTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            "url":"{{ route('businessresearch.index') }}",
            "type": "GET",
            },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex' },
            { data: 'date', name: 'date' },
            { data: 'pn_number', name: 'pn_number' },
            { data: 'subject_line', name: 'subject_line' },
            { data: 'industry', name: 'industry' },
            // { data: 'client_name', name: 'client_name' },
            { data: 'team_members', name: 'team_members' },
            { data: 'others', name: 'others' },
            { data: 'target_respondent', name: 'target_respondent'},
            { data: 'target_countries', name: 'target_countries'},
            { data: 'end_date',name:'end_date'},
            {
            data: 'feasibility_done',
            name: 'feasibility_done',
            render: function (data, type, row) {
            return data == 1 ? 'Yes' : 'No';
            }
            },
            {
            data: 'id',
            name: 'action',
            orderable: false,
            searchable: false,
            render: function (data, type, row, meta) {
                var viewUrl = "{{ route('businessresearch.project', ':id') }}".replace(':id', data);
                return `
                      <a href="${viewUrl}" class="btn btn-sm" title="View">
                            <i class="fas fa-eye"></i>
                        </a>
                    <button class="btn btn-sm edit-button" data-id="${data}">
                        <i class="fas fa-edit"></i>
                    </button>
                    <button class="btn btn-sm action-button" data-id="${data}">
                        <i class="fas fa-check-circle"></i>
                    </button>
                `;
            }
        }
        ]
    });


    function setSelectedIndustry(industry) {
    $('#edit_industry_select').val(industry);
}

    $(document).on('click', '.edit-button', function () {
    var id = $(this).data('id');

    // Use route helper - replace :id with actual ID
    var editUrl = "{{ route('businessresearch.edit', ':id') }}".replace(':id', id);

    $.get(editUrl, function (data) {
        // Show modal
        $('#editModal').modal('show');

        // Populate form fields
        $('#edit_id').val(data.id);
        $('#edit_date').val(data.date);
        $('#edit_pn_number').val(data.pn_number);
        $('#edit_subject_line').val(data.subject_line);
        $('#edit_industry_select').val(data.industry);
        $('#edit_client_name').val(data.client_name);
        $('#edit_others').val(data.others);
        $('#edit_team_members').val(data.team_members).trigger('change');
        $('#edit_feasibility_done').val(data.feasibility_done);
        $('#edit_target_respondent').val(data.target_respondent);
        $('#edit_target_countries').val(data.target_countries);
        $('#edit_end_date').val(data.end_date);

        
    });
});





$(document).on('submit', '#editForm', function (e) {
    e.preventDefault();

    var id = $('#edit_id').val(); // Get the ID of the record
    var formData = $(this).serialize();
    

    $.ajax({
        url: `update/${id}`, 
        type: 'POST',
        data: formData,
        success: function (response) {
            $('#editModal').modal('hide');
            $('#businessTable').DataTable().ajax.reload();

            Swal.fire({
                icon: 'success',
                title: 'Updated!',
                text: response.message,
                timer: 1500,
                showConfirmButton: false
            });
        },
        error: function (xhr) {
            let errors = xhr.responseJSON.errors;
            let errorMsg = 'Something went wrong!';
            if (errors) {
                errorMsg = Object.values(errors).join('\n');
            }

            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: errorMsg
            });
        }
    });
});

    // Delete button click handler
    $(document).on('click', '.delete-button', function() {
    let id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: "You will be delete this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('businessresearch.destroy', ':id') }}".replace(':id', id),
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    Swal.fire('Deleted!', response.message, 'success');
                    $('#businessTable').DataTable().ajax.reload();
                },
                error: function(xhr) {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                }
            });
        }
    });
});
});

$(document).on('click', '.action-button', function () {
    var id = $(this).data('id');

    Swal.fire({
        title: 'Are you sure?',
        text: "Do you want to close this project?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, close it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: "{{ route('businessresearch.close', ':id') }}".replace(':id', id),
                type: 'POST',
                data: {
                    _token: $('meta[name="csrf-token"]').attr('content'),
                },
                success: function (response) {
                    Swal.fire({
                        title: 'Closed!',
                        text: response.message,
                        icon: 'success',
                        timer: 1500,
                        showConfirmButton: false
                    });
                    setTimeout(() => location.reload(), 1500);
                },
                error: function (xhr) {
                    Swal.fire('Error', 'Something went wrong.', 'error');
                }
            });
        }
    });
});

$(document).ready(function () {
    $('#edit_team_members').select2({
        placeholder: "Select Team Members",
        width: '100%'
    });
});


</script>


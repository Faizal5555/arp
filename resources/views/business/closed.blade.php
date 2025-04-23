@extends('layouts.master')
@section('page_title', 'Business Team')
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
        <h5>Closed Projects</h5>
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
                    <th>Feasibility Done</th>
                    <th>Others</th>
                    <th>Target Respondent</th>
                    <th>Target Countries</th>
                    <th>End Date</th>
                </tr>
            </thead>
        </table>
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
            "url":"{{ route('businessresearch.closed') }}",
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
           
        ]
    });
});
</script>
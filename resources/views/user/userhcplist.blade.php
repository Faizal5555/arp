@extends('layouts.master')
@section('page_title', 'HCP List')
@section('content')
<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('#hcpTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('userHcpListData') }}",
            data: function (data) {
                data.country = $("#country").val();
                data.speciality = $("#speciality").val();
            },
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'firstname', name: 'firstname' },
            { data: 'lastname', name: 'lastname' },
            { data: 'country1', name: 'country1' },
            { data: 'docterSpeciality', name: 'docterSpeciality' },
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `
                        <a href="{{ route('panelist') }}" class="btn btn-primary btn-sm">Send Email</a>
                    `;
                }
            }
        ],
    });

    $('#country').change(function () {
        table.draw();
    });

    $('#speciality').change(function () {
        table.draw();
    });
});
</script>

<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
        color: white;
    }
    .table_background {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
        color: white;
    }
</style>

<div class="row">
    <div class="col-md-12">
        <div class="card" id="header-title">
            <div class="card-header header">
                <div class="card-title" style="color:whitesmoke;">HCP Registration View</div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label>Country</label>
                        <select class="form-control" id="country" name="country">
                            <option value="" selected disabled>Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->name }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Speciality</label>
                        <select class="form-control" id="speciality" name="speciality">
                            <option value="" selected disabled>Select Speciality</option>
                            @foreach($speciality as $spec)
                                <option value="{{ $spec->speciality }}">{{ $spec->speciality }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="table-responsive col-md-12">
                    <table class="table-hover" id="hcpTable">
                        <thead>
                            <tr class="table_background">
                                <th>S.No</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Country</th>
                                <th>Speciality</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

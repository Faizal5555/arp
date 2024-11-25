@extends('layouts.master')
@section('page_title', 'Consumer Registration View')
@section('content')

<script>
$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var table = $('#consumerTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('user.consumer.list.data') }}",
            data: function (data) {
                data.country = $("#country").val();
                data.occupation = $("#occupation").val();
                data.industry = $("#industry").val();
            },
        },
        columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            { data: 'fname', name: 'fname' },
            { data: 'lname', name: 'lname' },
            { data: 'country',name: 'country'},
            { data: 'que_26', name: 'que_26', title: 'Occupation' },
            { data: 'que_27', name: 'que_27', title: 'Industry' },
            {
                data: null,
                name: 'action',
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `
                        <a href="{{ route('emailPanel') }}" class="btn btn-primary btn-sm">Send Email</a>
                    `;
                }
            }
        ],
    });

    $('#country, #occupation, #industry').change(function () {
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
                <div class="card-title" style="color:whitesmoke;">Consumer Registration View</div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label>Country</label>
                        <select class="form-control" id="country" name="country">
                            <option value="" selected>Select Country</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->name }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Occupation</label>
                        <select class="form-control" id="occupation" name="occupation">
                            <option value="" selected>Select Occupation</option>
                            @foreach($occupations as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>Industry</label>
                        <select class="form-control" id="industry" name="industry">
                            <option value="" selected>Select Industry</option>
                            @foreach($industries as $key => $value)
                                <option value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="table-responsive col-md-12">
                    <table class="table-hover" id="consumerTable">
                        <thead>
                            <tr class="table_background">
                                <th>S.No</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Country</th>
                                <th>Occupation</th>
                                <th>Industry</th>
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

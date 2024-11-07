@extends('layouts.master')
@section('page_title', 'Test List')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Test List</a>
                    
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <div class="input-group" >
                                    <div>
                                        <!-- <input class="form-control border-end-0 border rounded-pill" id="search" type="search" name="search" placeholder="search" id="example-search-input"> -->
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive">
                                <!-- <div>
                                <a href="{{route('vendor.export')}}" class="ml-4 btn btn-secondary">Import</a>
                                </div> -->
                                
                            <table class="table datatable-button-html5-columns table1">
                                <thead>
                                    <tr>
                                        <th>RFQ No </th>
                                        <th>Client Name</th>
                                        <th>Date</th>
                                        <th>Follow Up Date</th>  
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@push('css')
 
<link rel="stylesheet" href="https://dashboard.netwoglobal.com/common/vendor/datatable/datatables.min.css">

        <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.2/css/buttons.dataTables.min.css">
    <style>
    
    .input-group
    {
        width:auto !important;
    }
    .card{
        border: none !important;
    }
</style>
@endpush
@push('scripts')
     
<script>
 $(document).ready(function() {
   
    var table = $('.table1').dataTable({
        processing: true,
        serverSide: true,
        ajax: {
          url: "{{ route('test.index') }}",         
          data: function (d) {
                d.rfq_no = $('#search').val(),
                d.client_name = $('#search').val(),
                d.date = $('#search').val(),
                d.follow_up_date = $('#search').val(),
                d.search = $('input[type="search"]').val()
            }
        },
        columns: [         
            {data: 'rfq_no', name: 'rfq_no'},
            {data: 'client_name', name: 'client_name'},
            {data: 'date', name: 'date'},
            {data: 'follow_up_date', name: 'follow_up_date'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });
   
   
  
  });
</script>
@endpush
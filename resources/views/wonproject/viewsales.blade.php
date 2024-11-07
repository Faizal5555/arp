@extends('layouts.master')
@section('page_title', 'WonProject List')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Vendor List</a>
                    <a href="{{route('wonproject.create')}}" class="ml-2 btn btn-primary">Add</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form id="update" class="form col-md-12 d-flex flex-wrap"
                           enctype="multipart/form-data">
                           @csrf
                           <input type="hidden" value="rfq_no_id">
                            
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="" class="col-lg-3 col-form-label font-weight-semibold">Total Project Invoice Value<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="vendor_total" value=""
                                                id="" type="date" class="form-control" placeholder="Total Project Invoice Value">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="" class="col-lg-3 col-form-label font-weight-semibold">Total Margins<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="total_margin" value=""
                                                id="" type="date" class="form-control" placeholder="Total Margin">
                                        </div>
                                    </div>
                                </div>
                            {{-- <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <a href="{{route('wonproject.index')}}" class=" btn btn-primary">Back</a>
                                <button type="submit" id="addRegisterButton"
                                    class="btn btn-success ml-2">Submit</button>
                            </div> --}}
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <!-- <div>
                                <a href="{{route('vendor.export')}}" class="ml-4 btn btn-secondary">Import</a>
                                </div> -->
                            <table class="table datatable-button-html5-columns">
                                <thead>
                                    <tr>
                                        <th>RFQ No</th>
                                        <th>Project Type</th>
                                        <th>Project Name</th>
                                        <th>Project Execution</th>
                                        <th>Start Date</th>      
                                        <th>End Date</th>                                    
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($wonproject) > 0)
                                    @foreach($wonproject as $t)
                                    <tr>
                                        <td>{{ $t->rfq_no }}</td>
                                        <td>{{ $t->project_type }}</td>
                                        <td>{{ $t->project_name }}</td>
                                        <td>{{ $t->project_execution }}</td>
                                        <td>{{ date('d M Y', strtotime($t->project_start_date)) }}</td>
                                        <td>{{ date('d M Y', strtotime($t->project_end_date)) }}</td>
                                        <td class="text-center">
                                            
                                            <a href="{{route('wonproject.delete')}}" class="mdi mdi-delete">Delete</a>
                                            <a href="/wonproject/edit/{{$t->id}}" class="mdi mdi-table-edit">Edit</a>
                                            <!-- <a href="{{route('vendor.create')}}" class="mdi mdi-view-quilt">View</a> -->
                                           
                                        </td>
                                       
                                    </tr>
                                    @endforeach
                                    @else
                                    @endif
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
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
    <script src="<https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.4/xlsx.min.js>"></script>
@endpush
@section('scripts')
@endsection
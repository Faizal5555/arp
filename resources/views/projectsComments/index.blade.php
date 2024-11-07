@extends('layouts.master')
@section('page_title', 'Lost Project List')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Lost Project</a>
                    {{-- <a href="{{route('vendor.create')}}" class="ml-2 btn btn-primary">Add</a> --}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                {{-- <div>
                                <a href="{{route('vendor.export')}}" class="ml-4 btn btn-secondary">Import</a>
                                </div> --}}
                            <table class="table datatable-button-html5-columns">
                                <thead>
                                    <tr>
                                        <th>RFQ No</th>
                                        <th>Comments</th>                                       
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @if (count($comment) > 0)
                                    @foreach($comment as $t)
                                    <tr>
                                        <td>{{ $t->getRfq->rfq_no }}</td>
                                        <td>{{ $t->comments }}</td>
                                        {{-- <td class="text-center">
                                            
                                            <a href="{{route('vendor.delete')}}" class="mdi mdi-delete">Delete</a>
                                            <a href="/vendor/edit/{{$t->id}}" class="mdi mdi-table-edit">Edit</a>
                                            <!-- <a href="{{route('vendor.create')}}" class="mdi mdi-view-quilt">View</a> -->
                                           
                                        </td> --}}
                                       
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
@endpush
@section('scripts')



@endsection
@extends('layouts.master')
<style>
    a.ml-2.btn.btn-primary {
    float: right;
}
.table1{
    background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
}
a.mdi.mdi-eye {
    color: #0008f7 !important;
    font-size: 20px;
}
.card-header.header-elements-inline {
  background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: #fff;
}
</style>
    
@section('page_title', 'BidRfq List')
@section('content')
<script type="text/javascript">
    
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: "{{route('doctor.list')}}",
          columns: [
            // {data:'project_no',name:'project_no'},
            {data:'firstname',name:'firstname'},
            {data:'lastname',name:'lastname'},
            {data:'docterSpeciality',name:'docterSpeciality'},
            {data:'totalExperience',name:'totalExperience'},

            {data:'',
                 render:(data,typr,row)=>{
                 return `<a href='/doctor_list/${row.id}' class='mdi mdi-eye'></a>`     
                 }
        }
          ]
      });
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Doctor List</a>
                    {{-- <a href="{{route('bidrfq.create')}}" class="ml-2 btn btn-primary">Add</a> --}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                {{-- <div class="input-group" >
                                    <div>
                                        <input class="form-control border-end-0 border rounded-pill"  id="myInput" onkeyup="myFunction()" type="text" name="search" placeholder="search" id="example-search-input">
                                    </div>
                                </div> --}}
                            </div>
                            <div class="table-responsive" id="myTable">
                                
                            <table class="table  table1 data-table">
                                <thead>
                                    <tr>
                                        {{-- <th>project_no </th> --}}
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Doctor Speciality</th>
                                        <th>Total Experience</th>
                                        {{-- <th>quality_analyst_name</th>
                                        <th>project_deliverable</th>
                                        <th>country_name</th>
                                        <th>sample_target </th>
                                        <th>sample_achieved</th>
                                        <th>Status</th> --}}
                                        <th>View</th>

                                    </tr>
                                </thead>
                                <tbody id="myTable">
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
    <style>

    .input-group
    {
        width:auto !important;
    }
    .card{
        border: none !important;
    }
    .list-group-item:first-child{
        background-color: #ffdae2;
        border-color: #ffdae2;
        text-align: center;
        border-radius: 10px;
    }
    .list-group-item:last-child {
    margin-bottom: 0;
    border-bottom-right-radius: .25rem;
    border-bottom-left-radius: .25rem;
    background-color: #bff2ea;
    border: #bff2ea;
    border-radius: 10px;
    text-align: center;
    margin-top: 10px;
    }
    #vendor-color{
    background-color: #ffdae2;
    border-color: #ffdae2;
    }
    .table td, .table th {
    padding: .75rem;
    vertical-align: middle !important;
    border-top: 1px solid #dee2e6;
    }
</style>
@endpush
@section('script')
@endsection

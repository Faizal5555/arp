@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')
<style>
 
    .header{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        
    }
    .table_background{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
    }
</style>
<div class="row mb-5 mt-5">
    <div class="col-md-12">
        <div class="card " id="header-title">  

            <div class="card-header header-elements-inline header">
            <div class="card-title " style="color:whitesmoke;">Accounts Register List</div>
            </div>
            <div class="card-body"  id="cardbody">
                <div class="table-responsive col-md-12">
                    <table id="table" >
                        <thead>
                            <tr class="table_background" style="color:whitesmoke;" >
                                <th>Docter Name</th>
                                <th>Account Holder Name</th>
                                <th>Account Number </th>
                                <th>Ifc Code</th>
                                <th>Branch Name</th> 
                                <th>Bank Name</th>
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
<script>
     $(function () {
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        })
        var table = $('#table').DataTable({
 
            processing: true,
            serverSide: true,

            ajax: {
                "url":"{{route('accountRegisterList') }}", 
                "type":"get",
            },

            columns: [

                {data:'user_name',name:'user_name'},

                {data: 'account_holder_name', name: 'account_holder_name'},

                {data: 'account_number', name: 'account_number'},

                {data: 'ifc_code', name: 'ifc_code'},

                {data: 'branch_name', name: 'branch_name'},
                
                {data:'bank_name',name:'bank_name'},

                ]
        });    
     });
</script>
@endsection
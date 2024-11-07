@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')

<script>
    $(function () {
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
     });
 var table = $('#table').DataTable({
 
     processing: true,
 
     serverSide: true,
 
     ajax: {
        "url":"{{route('adminactivedview') }}", 
     },
 
     columns: [
 
         {data: 'firstname', name: 'firstname'},
 
         {data: 'lastname', name: 'lastname'},
 
         {data: 'cityname', name: 'cityname'},
 
         {data: 'citycode', name: 'citycode'},
 
         {data: 'PhNumber', name: 'PhNumber'},
 
         {data: 'email', name: 'email'},
 
         {data: 'whatdsappNumber', name: 'whatdsappNumber'},
 
         {data: 'docterSpeciality', name: 'docterSpeciality'},
 
         {data: 'totalExperience', name: 'totalExperience'},
 
         {data: 'practice', name: 'practice'},
 
         {data: 'licence', name: 'licence'},
 
         {data: 'PatientsMonth', name: 'PatientsMonth'},
 
         {data: 'country1', name: 'country1'},
 
         {data: 'document', name: 'document'},
 
         {data: 'profile_image', name: 'profile_image'},

          
         {data:'',
                 render:(data,type,row)=>{
                 return `<a href='/send/amount/${row.id}'><i class="fa fa-eye"></i></a>`     
                 }
        }
     ]
  
 
 });
 
 
 
 });
 </script>
<style>
 
    .header{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        
    }
   </style>
<div class="col-md-12">
    <div class="card " id="header-title">  

        <div class="card-header header-elements-inline header">
          <div class="card-title " style="color:whitesmoke;">Registeration  view</div>
        </div>
        <div class="card-body"  id="cardbody">
            <div class="table-responsive col-md-12">
                <table id="table" >
                    <thead>
                        <tr class="bg-primary" style="color:whitesmoke;">
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Cityname</th>
                            <th>Citycode</th>
                            <th>Phone </th>
                            <th>Email</th>
                            <th>Whatsapp </th>
                            <th>Docter </th>
                            <th>Experience</th>
                            <th>Practice</th>
                            <th>Iicence</th>
                            <th>PatientsMonth</th>
                            <th>Country</th>
                            <th>Profile</th>
                            <th>Document</th>
                            <th>Action </th>
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


@endsection
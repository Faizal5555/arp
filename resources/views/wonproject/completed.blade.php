@extends('layouts.master')
<style>
    a.ml-2.btn.btn-primary {
    float: right;
}
.main-panel {
    background-color: #f8f8f8;
   }
.card {
   margin: 40px 0 20px 0;
    border:1px solid;
 }

.card-header.header-elements-inline {
    background-color: #fff;
}
     button#addRegisterButton {
    background-color: #6329a1;
    border-color: #6329a1;
}
label.col-lg-3.col-form-label.font-weight-semibold {
    font-family: "ubuntu-medium", sans-serif;
    font-weight: 500;
}
a.btn.btn-outline-secondary:hover {
    color: #fff;
}
button#addRegisterButton {
    background-color: #6329a1;
    border-color: #6329a1;
}
.card-header.header-elements-inline {
   background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: #fff;
}
a.ml-2.btn.btn-primary {
    background-color: #fff;
    color: #0b5dbb;
    border-color: #ffff;
}
a.mdi.mdi-delete {
    font-size: 23px;
    color: #ee2d34;
}
a.mdi.mdi-table-edit {
     font-size: 23px;
}
.my-won {
     color:white;
    background-color: #0b5dbb;
}

select.custom-select.custom-select-sm.form-control.form-control-sm {
    padding-left: 10px;
    padding-right: 26px;
    color: #000;
}
label {
    margin-top: 76px;
}
input#rfq_no {
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
}
input#project_execution{
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
}
input#project_start_date1{
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
}
input#project_start_date2{
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
    margin-top:5px;
    
}
input#project_end_date1{
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
}
input#project_end_date2{
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
    margin-top:5px;
    
}
select#mode{
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
    margin-top:5px;
}

div#won-table_filter {
    margin-left: 40px;
}
in
"bLengthChangep:true,ut.form-control.form-control-sm {
    border-radius: 40px;
    border-color: #0b5dbb;
}

input.form-control.form-control-sm {
    display: none !important;
}
label {
    /*display: none !important;*/
}
.row.pl-3.pr-3.dt_head {
    margin-bottom: 25px;
}
p.search {
    margin-left: 9px;
}
select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
}
    </style>
@section('page_title', 'WonProject List')
@section('content')
<script type="text/javascript">
        

    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      var table = $('#won-table').DataTable({
         "language": {
         processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
         processing: true,
         serverSide: true,
        //  paging: true,
         
         ajax: {
              
              "url":"{{ route('wonproject.completed') }}",
               'data': function(data){
                  data.rfq_no=$('#rfq_no').val();
                  data.project_execution=$('#project_execution').val();
                  data.project_start_date1=$('#project_start_date1').val();
                  data.project_start_date2=$('#project_start_date2').val();
                  data.project_end_date1=$('#project_end_date1').val();
                  data.project_end_date2=$('#project_end_date2').val();
                  data.mode=$('#mode').val();
                
                }
            },
          
          columns: [

              
              
            
              {data: 'rfq', name: 'rfq'},
              {data: 'country_name', name: 'country_name'},
              {data: 'client_id', name: 'client_id'},
              {data: '', 
                    render: (data,type,row) => {
                        return `<div class="text-center">
                                    <div class="list-icons d-flex">
                                       
                                        <p class="project_status mt-1 mr-1" data-id=${row.rfq}><i class="fa-solid fa-eye"></i></p>
                                      
                                         
      
                                         @if(auth()->user()->user_type == 'admin')
                                            <a href='/wonproject/delete/${row.id}'  class='mdi mdi-delete'></a>
                                           @endif
                                        </div>
                                    </div>
                                </div>`;
                        }},
            ],
             "lengthMenu":[
                [5,10,15,-1],
                [5,10,15,"All"]
            ],
            
          
      });
     
   $(document).on('keyup','#rfq_no',function(){
      table.draw(); 
   });
   
   $(document).on('keyup','#project_execution',function(){
      table.draw(); 
   });
   
    $(document).on('change','#project_start_date1',function(){
      table.draw(); 
   });
   
    $(document).on('change','#project_start_date2',function(){
      table.draw(); 
   });
   
    $(document).on('change','#project_end_date1',function(){
      table.draw(); 
   });
   
    $(document).on('change','#project_end_date2',function(){
      table.draw(); 
   });
   
   $(document).on('change','#mode',function(){
      table.draw(); 
   });
   
   
      
    });

    

 $(document).on('click','.project_status',function(e){
    e.preventDefault();
        $.ajaxSetup({
            headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
        });
     var id =$(this).attr('data-id');
     console.log(id)
     $.ajax({
         type: "post",
         url:"{{route('wonproject.getstatus')}}",
         data:{
             id:id,
         },
         success: function (data) {
             if(data.success == 1){
             window.location.href=""+ '/adminapp/wonproject/'+'projectstatus/'+data.rfq,
             console.log(data);
             }
             if(data.success == 0){
                swal({
                            title:'Not Assigned',
                            icon:"warning",
                            button:false
                     })
             }

         },
         error: function (data) {
           
         }
     });
 });
    </script>

<!--target table-->
<!--<p class="project_status mt-1 mr-1" data-id=${row.id}><i class="fa-solid fa-eye"></i></p>-->
<!--<p class="project_status mt-1 mr-1" data-id=${row.id}><i class="fa-solid fa-eye"></i></p>-->
<!--end target table-->
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">completed Commissioned Project List</a>
                    <!--<a href="{{route('wonproject.create')}}" class="ml-2 btn btn-primary">Add</a>-->
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                           
                            <div class="row" style="margin-top: -57px;">
                                <div class="col-md-3">
                               <label class="fcol-lg-3 col-form-label font-weight-semibold ml-3"> <span>RFQ No</span></label>
                               <input type='text' class="form-control" id='rfq_no' placeholder='Search RFQ No' name='rfq_no'  autocomplete='off'>
                               </div>
                               {{-- <div class="col-md-3" style="padding-left: 20px !important;">
                               <label class="fcol-lg-3 col-form-label font-weight-semibold ml-3"> <span>Project Execution</span></label>
                                  <input type='text' class="form-control"  id='project_execution' placeholder='Search Project Execution' name='project_execution' autocomplete='off'> 
                               </div>
                               <div class="col-md-3" style="padding-left: 49px !important;">
                                   <label class="fcol-lg-3 col-form-label font-weight-semibold"> <span>Project Start Date</span></label>
                                   <input type='date' class="form-control" id='project_start_date1' placeholder='Search Start Date' name='project_start_date1' autocomplete='off'>
                                
                                   <input type='date' class="form-control" id='project_start_date2' placeholder='Search Start Date' name='project_start_date2' autocomplete='off'>
                               </div>
                               <div class="col-md-3">
                                   <label class="fcol-lg-3 col-form-label font-weight-semibold"> <span>Project End Date</span></label>
                                   <input type='date' class="form-control" id='project_end_date1' placeholder='Search End Date' name='project_end_date1' autocomplete='off'>
                                   <input type='date' class="form-control"  id='project_end_date2' placeholder='Search End Date' name='project_end_date2' autocomplete='off'>
                               </div>
                               <div class="col-md-3">
                                   <label class="fcol-lg-3 col-form-label font-weight-semibold ml-3"> <span>Mode</span></label>
                                   <select class="form-control label-gray-3" name="mode" id="mode">
                                                <option class="label-gray-3" disabled selected>Select Mode</option>
                                                <option value="">All</option>
                                                <option value="Online">Online</option>
                                                <option value="Offline">Offline</option>
                                   </select>
                               </div> --}}
                               </div>
                               
                               
                            <div class="table-responsive">
                            <table class="table datatable-button-html5-columns" id="won-table">
                                <thead>
                                    <tr class="my-won">
                                        <th>RFQ No</th>
                                        <th>Country Name</th>
                                        <th>Client Name</th>
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
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
@endpush
@section('scripts')
@endsection

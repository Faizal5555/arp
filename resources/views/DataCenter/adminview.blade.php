@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script>

   $(document).ready(function(){
       $("#export_btn").click(function(){
         $('.dt-button.buttons-excel.buttons-html5').trigger('click');
       })
   })
    $(function () {
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
     });
    var table = $('#table').DataTable({
      dom: 'Blfrtip',
       "lengthMenu": [ [10, 25, 50,75,100, -1], [10, 25, 50,75,100, "All"] ],
      buttons: [
                 {
                extend: 'excelHtml5',
                text: 'Export',
                exportOptions: {
                  columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
                },
            },
            ],
     processing: true,
 
     serverSide: true,
 
     ajax: {
        "url":"{{route('adminactivedview1')}}", 
        "data":function(data){
          data.pno=$("#po_no").val();
          data.speciality=$("#speciality").val();
          data.fname=$('#fname').val();
          data.lname=$('#lname').val();
        },
     },
 
     columns: [
         { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
         
         {data:'pno',name:'pno'},
             
         {data: 'firstname', name: 'firstname'},
 
         {data: 'lastname', name: 'lastname'},
 
         {data: 'cityname', name: 'cityname'},
 
         {data: 'citycode', name: 'citycode'},
         @if(auth()->user()->user_type == 'admin')
         {data: 'PhNumber', name: 'PhNumber'},
         @endif
         @if(auth()->user()->user_type == 'admin')
         {data: 'email', name: 'email'},
         @endif
         
         @if(auth()->user()->user_type == 'admin')
         {data: 'whatdsappNumber', name: 'whatdsappNumber'},
          @endif
 
         {data: 'docterSpeciality', name: 'docterSpeciality'},
 
         {data: 'totalExperience', name: 'totalExperience'},
 
         {data: 'practice', name: 'practice'},
 
         {data: 'licence', name: 'licence'},
 
         {data: 'PatientsMonth', name: 'PatientsMonth'},
 
         {data: 'country1', name: 'country1'},
 
        //  {data: 'document', name: 'document'},
         
        {data: 'document',  render:(data,type,row)=>{
            if(row.document!=null){
                 return `${row.document}`     
            }else{
            return "----"
            }
                 }},
 
         {data: 'profile_image',  render:(data,type,row)=>{
            if(row.profile_image!=null){
                 return `${row.profile_image}`     
            }else{
            return "----"
            }
                 }},

          
         {data:'',
                 render:(data,type,row)=>{
                 return `<a href='/adminapp/send/amount/${row.id}'><i class="fa fa-eye"></i></a>`     
                 }
        }
     ]
  
 
 });
        $('#speciality').change(function(){
          table.draw();
        });
        $("#po_no").keyup(function(){
            table.draw();
        })
        
        $('#fname').keyup(function(){
            table.draw();
        })
        
        $('#lname').keyup(function(){
            table.draw();
        })
 
 
 });
        // $(document).on('change','#speciality',function(){
        //   table.draw();
        // });
 </script>
<style>
 
    .header{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        
    }
    .table_background{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        color:white;
    }
    .inbox {
        outline: 1px solid #0a51a4 !important;
        border-radius: 21px !important;
     }
    button.dt-button.buttons-excel.buttons-html5 {
     border: 1px solid #0b5dbb !important;
    border-radius: 7px !important;
    color: #0b5dbb !important;
    font-family: unset !important;
    width: 76px  !important;
    height: 39px !important ;
    margin-bottom:25px;
    
    }
     button.dt-button.buttons-excel.buttons-html5:hover{
         background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
         color: white !important;
         
     }
     select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
}
select.custom-select.custom-select-sm.form-control.form-control-sm {
    padding-right: 25px;
}
.dt-buttons{
    display:flex !important;
    justify-content:flex-end !important;
}
.dt-buttons{
    visibility: hidden;
}
   </style>
   <div class="row">
        <div class="col-md-12">
            <div class="card " id="header-title">  
                <div class="card-header header-elements-inline header">
                  <div class="card-title " style="color:whitesmoke;">View Registration</div>
                </div>
                <div class="card-body"  id="cardbody">
                        @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                      <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-ban"></i> Error!</h4>
                          @foreach($errors->all() as $error)
                          {{ $error }} <br>
                          @endforeach      
                      </div>
                    </div>
                </div>
                @endif
  
                @if (Session::has('success'))
                    <div class="row">
                        
                      <div class="col-md-8 col-md-offset-1">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5>{!! Session::get('success') !!}</h5>   
                        </div>
                      </div>
                    </div>
                @endif
                
                @if (Session::has('fail'))
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                      <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-ban"></i></h4>
                           @foreach(Session::get('fail')  as  $key=> $in)
                          <tr>
                                          <td>{{$in[$key]}}</td>
                         </tr>
                        @endforeach
                      </div>
                    </div>
                </div>
                @endif
                
                     <div class="row">
                        <div class="col-md-12" style="display:flex;justify-content:right;">
                                                          <!-- Button trigger modal -->
                         <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#exampleModal">Import</button>
                         
                         @if(auth()->user()->user_type == "admin")
                         <button type="button" class="btn btn-primary" id="export_btn" >Export</button>
                         @endif
                         
                         
                        </div>
                     </div>
                   <div class="row mt-5 mb-4">
                        <div class="col-md-3">
                            <label>RNOD Number</label>
                            <input type="text" class="form-control inbox" id="po_no" name="purchase_order_no">
                        </div>
                       
                        <div class="col-md-3">
                            <label>Speciality</label>
                             <select class="form-control inbox" name="speciality" id="speciality"> 
                              <option value="" disabled selected>Select Speciality</option>
                              @if(count($speciality)>0)
                              @foreach($speciality as $ss)
                              <option value="{{$ss->speciality}}">{{$ss->speciality}}</option>
                              @endforeach
                              @endif
                            </select>
                        </div>
                         <div class="col-md-3">
                            <label>First Name</label>
                            <input type="text" class="form-control inbox" id="fname" name="fname">
                        </div>
                        
                         <div class="col-md-3">
                            <label>Last Name</label>
                            <input type="text" class="form-control inbox" id="lname" name="lname">
                        </div>
                        <div class="col-md-3">
                            
                        </div>
                        <div class="col-md-3">
                            
                        </div>
                    </div>
                   
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            


           
            <form action="{{ route('datacenter.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
              
                <input type="file" name="file" class="form-control" required>
                <br>
                <button class="btn btn-success">Import Doctor Data</button>
                
                <a href="{{url('global_assets/demoexample/datacenter_example_file.csv')}}">Example Doctor sheet</a>
            
            </form>
        </div>
        
      </div>
    </div>
  </div>
                      
                    <div class="table-responsive col-md-12">
                        <table class="table-hover" id="table" >
                            <thead>
                                <tr class="table_background" >
                                    <th>S.No</th>
                                    <th>RNOD</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>City Name</th>
                                    <th>City Code</th>
                                     @if(auth()->user()->user_type == 'admin')
                                    <th>Phone </th>
                                    <th>Email</th>
                                    <th>Whatsapp </th>
                                    @endif
                                    <th>Doctor Speciality </th>
                                    <th>Experience</th>
                                    <th>Practice</th>
                                    <th>licence</th>
                                    <th>Patients Month</th>
                                    <th>Country</th>
                                    <th>Document</th>
                                    <th>Profile</th>
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
    </div>


@endsection
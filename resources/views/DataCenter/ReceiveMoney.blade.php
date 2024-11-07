@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')

<style>
 
    .header{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        
    }
    .table_color{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
       
    }
    div.dataTables_wrapper div.dataTables_length select {
        width: 50px;
        height: 33px;
        color: #0b5dbb;
        border: 1px solid #0b5dbb;
        display: inline-block;
        border-radius:10px !important;
    }
    div.dataTables_wrapper div.dataTables_filter input{
            border-radius: 10px;
            border: 1px solid #0b5dbb;
    }
    .redeem_id{
            border: 1px solid #0b5dbb !important;
             border-radius: 10px !important;
             color: #0b5dbb !important;
             font-family: unset !important;
    }
    .redeem_id:hover{
        background:#0b5dbb;
        color:white !important;
    }
    .table td, .table th {
    padding: 0.75rem;
    vertical-align: initial;
}
div.dataTables_wrapper div.dataTables_length select {
    width:55px !important;
}
    
   </style>
   <div class="row" >
        <div class="col-md-12">
            <div class="card " id="header-title">  
                <div class="card-header header-elements-inline header">
                <div class="card-title " style="color:whitesmoke;">Receive Money</div>
                </div>
            </div>
            <div class="card-body"  id="cardbody" >
                <div class="row mt-5 mb-5">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-hover" style="width:100%;" id="table" >
                            <thead class="">
                                <tr class="table_color" style="color:whitesmoke !important;">
                                    <th>S.No</th>
                                    <th>Admin Name</th>
                                    <th>Money</th>
                                    <th>Comments</th>
                                    <th>Receive Date</th>
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
    
    <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Are You Sure</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-center ">
        
        <button class="btn btn-success yes" name="yes" value="">Yes</button>
        <button class="btn btn-danger ml-5 no" data-dismiss="modal">No</button>
      </div>
      
    </div>
  </div>
</div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>

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
             "url":"{{route('receive.money1')}}", 
            },
            
            columns: [
            
        { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
         {data:'user_name',name:'user_name'},
             
         {data: 'money', name: 'money'},
         {data:'comments', name:'comments'},
 
        {data:'',
                render: ( data, type, row ) =>{
                   return moment(row.created_at).format('DD/MM/YYYY');
                 },
             },
         
          
         {data:'',
                 render:(data,type,row)=>{
                 return `<button class='btn  redeem_id'  value='${row.id}' data-toggle="modal" data-target="#exampleModal">Redeem</button>`;     
                 }
        }]
 
      })
  });
  
  $(document).on('click','.redeem_id',function(){
   var redeemvalue =$(this).val();
   <!--alert(redeemvalue);-->
          var docter_accept=$('.yes').val(redeemvalue);
  });
     $(document).on('click','.yes',function(){
      <!--alert("hi");-->
          var yes_value=$(this).val();
           <!--alert(yes_value);-->
         $.ajax({
             type: "post",
             url: "{{route('redeemValue')}}",
             data: {id:yes_value},
             dataType: "json",
             success: function (data) {
                if(data.success == 1){
                    swal({
                            title:'Redeemed Successfully',
                            icon:'success',
                            button:false
                           }) 
                             location.reload();
                         
                 }
             }
         });
      });
      $(document).on('click','.no',function(){
     
          var no_value=$('.yes').val();
         $.ajax({
             type: "post",
             url: "{{route('noredeemValue')}}",
             data: {id:no_value},
             dataType: "json",
             success: function (data) {
                if(data.success == 1){
                    swal({
                            title:'Redeem  Cancelled  Successfully',
                            icon:'success',
                            button:false
                        }) 
                             location.reload();
                         
                 }
             }
         });
      })   

     
</script> 
@endsection
@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')
<style>
 
    .header{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        
    }
    .table_color{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        color:white;
    }
    .inbox {
        outline: 1px solid #0a51a4 !important;
        border-radius: 21px !important;
     }
    
    div.dataTables_wrapper div.dataTables_filter input{
            border-radius: 10px;
            border: 1px solid #0b5dbb;
    }
    
     .money-button{
            border-radius: 10px;
       font-family: inherit;
     }
    
    
     .voucher-button{
          border-radius: 10px;
          font-family: inherit;
    }
    select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
       }
   select.custom-select.custom-select-sm.form-control.form-control-sm {
    padding-right: 25px;
    margin-top: 4px;
    }
    
</style>
<div class="row mt-5">
    <div class="col-md-12">
        <div class="card " id="header-title">  

            <div class="card-header header-elements-inline header">
            <div class="card-title " style="color:whitesmoke;">Send Money/Voucher</div>
            </div>
            <div class="card-body">
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
                <div class="table-responsive col-md-12">
                    <table id="table" class="table-hover">
                        <thead>
                            <tr class="table_color style="color:whitesmoke;">
                                <th>S.No</th>
                                <th>RNOD Number</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>City Name</th>
                                <th>City Code</th>
                                <th>Phone </th>
                                <th>Email</th>
                                <th>Whatsapp </th>
                                <th>Doctor Speciality</th>
                                <th>Experience</th>
                                <th>Practice</th>
                                <th>Licence</th>
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
{{-- modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" style="color:white;" id="exampleModalLabel">SEND MONEY</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="money_form">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12 row">
                        <input type="hidden" value="{{Auth::user()->name}}" name="user_name" id="money_user_name" >
                        <input type="hidden"  class="user_id" name="userId" id="money_user_id" >
                        <input type="hidden" class="docter_id" name="docterId" id="money_docter_id">
                    
                        <div class='col-md-6 d-flex justify-content-center align-items-center'>
                            <label style="font-size:15px;"> Send Money :</label>
                        </div>
                        
                        <div class="col-md-6 d-flex  align-items-center">
                        <input type="text" placeholder="money" name="money" id="money" class="form-control"> 
                        </div>
                        
                          <div class='col-md-6 d-flex justify-content-center align-items-center mt-4'>
                            <label style="font-size:15px;"> Comments :</label>
                        </div>
                        <div class="col-md-6 d-flex  align-items-center mt-4">
                       <textarea name="comments" id="comments" value=""
                                    class="form-control" placeholder="Comments here..." required="comments"></textarea>
                        </div>
                
                        
                    </div>
                
                   
                </div>
                <button type="sumbit" class="btn btn-success float-right">Send Money</button>
            </form>
        </div>

      </div>
    </div>
  </div>

  {{-- voucher modal --}}
  <div class="modal fade" id="voucher" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" style="color:white;" id="exampleModalLabel"> SEND VOUCHER </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="voucher_form">
                @csrf
                <div class="form-group row">
                    <div class="col-md-12 row">
                        <input type="hidden" name="User_name" id="voucher_user_name" value="{{Auth::user()->name}}" >
                        <input type="hidden" name="user_id" class="voucher_user_id" id="voucher_user_id">
                        <input type="hidden" class="vocher_docter_id" name="docter_id" id="voucher_docter_id"  >
                    
                        <div class='col-md-6 d-flex justify-content-center align-items-center'>
                            <label style="font-size:15px;"> Voucher code :</label>
                        </div>
                        <div class="col-md-6 d-flex  align-items-center">
                        <input type="text" placeholder="voucher_code" name="voucher_code" id="voucher_code" class="form-control"> 
                        </div>
                    </div>
                
                   
                </div>
                <button type="sumbit" class="btn btn-danger float-right">Send Voucher</button>
            </form>
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
     });
 var table = $('#table').DataTable({
 
     processing: true,
 
     serverSide: true,
 
     ajax: {
        "url":"{{route('Money.send1') }}",
        "data":function(data){
          data.pno=$("#po_no").val();
          data.speciality=$("#speciality").val();
          data.fname =$('#fname').val();
          data.lname =$('#lname').val();
        },
     },
 
     columns: [
         { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
         
         {data:'pno',name:'pno'},
 
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
 
        {data: 'profile_image',  render:(data,type,row)=>{
            if(row.profile_image!=null){
                 return `${row.profile_image}`     
            }else{
            return "----"
            }
                 }},

          
         {data:'',
                 render:(data,type,row)=>{
                 return `<div class="d-flex"><button class="btn btn-success money-button mr-2" data-money="${row.user_id}" data-id="${row.id}" data-toggle="modal" data-target="#exampleModal">Send Money</button></a>
                 <button class="btn btn-danger voucher-button" data-toggle="modal" data-target="#voucher" data-voucher="${row.user_id}" data-id="${row.id}">Voucher code</button> </div>`   
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
$(document).on('click','.money-button',function() {
    var money = $(this).attr('data-money');
    var id = $(this).attr('data-id');
        $('.user_id').val(money);
        $('.docter_id').val(id);
});
$(document).on('click','.voucher-button',function() {
    var money = $(this).attr('data-voucher');
    var id = $(this).attr('data-id');
        $('#voucher_user_id').val(money);
        $('#voucher_docter_id').val(id);
});

$(document).ready(function(){
   $("#money_form").validate({
        rules:{
            money_user_id:{
                required:true
            },   
            money_docter_id:{
                required:true
            },
            money_user_name:{
                required:true
            },
            money:{
                required:true
            },
        }, 
        submitHandler: function (form) {
           
            var money_Data=new FormData(form);
            // alert("hi");
            $.ajax({
                type:"post",
                url:"{{route('Admin.MoneySend')}}",
                data:money_Data,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (data) {
                   console.log(data); 
                   if(data.success == 1){
                                $("#exampleModal").modal('hide');
                                swal({
                                        title:'Money Sent Successfully',
                                        icon:'success',
                                        button:false
                                }) 
                            }
                }
            }); 
        }
    })
})

//voucher send ajax
$(document).ready(function(){
    $("#voucher_form").validate({
        rules:{
            voucher_user_name:{
                required:true
            },   
            voucher_user_id:{
                required:true
            },
            voucher_docter_id:{
                required:true
            },
            voucher_code:{
                required:true
            },
        },
            submitHandler: function (form) {
           
           var Voucher_Data=new FormData(form);
        //   alert("hi");
           $.ajax({
               type:"post",
               url:"{{route('Admin.VoucherSend')}}",
               data:Voucher_Data,
               processData: false,
               contentType: false,
               dataType: "json",
               success: function (data) {
                  console.log(data); 
                  if(data.success == 1){
                                $("#voucher").modal('hide');
                                swal({
                                        title:'Voucher Sent Successfully',
                                        icon:'success',
                                        button:false
                                }) 
                            }
               }
           }); 
        }
        });
    
});
$(document).on('click','.money-button',function(){
    $('#money').val(''); 
});

$(document).on('click','.voucher-button',function(){
    $("#voucher_code").val('');
});
 </script>
@endsection
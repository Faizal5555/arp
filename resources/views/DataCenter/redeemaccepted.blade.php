@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')
<style>
 
    .header{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        
    }
     select#staus{
     outline: 1px solid #0a51a4;
     border-radius: 21px;
   }
    .table_color{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        color:white;
    }
    /*div.dataTables_wrapper div.dataTables_filter input{*/
    /*        border-radius: 10px;*/
    /*        border: 1px solid #0b5dbb;*/
    /*}*/
    div.dataTables_wrapper div.dataTables_length select{
        width:57px!important;
    }
    select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
    }
   select.custom-select.custom-select-sm.form-control.form-control-sm {
    padding-right: 25px;
   }
   input#po_no {
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
    }
   </style>
   <script type="text/javascript">
   var table = $('.data-table');
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

       table = $('.data-table').DataTable({
          scrollX: true,
          processing: true,
          serverSide: true,
          ajax:{
              "url":"{{route('reddemAccept1')}}",
              'data':function(data){
                  data.status=$('#status').val();
                  data.pno=$('#po_no').val();
              },

          }, 
          columns: [
              {data:'datacenternew.pno',name:'datacenternew.pno'},
            {data:'datacenternew.firstname',name:'datacenternew.firstname'},
            {data:'money',name:'money'},
            // {data:'status',name:'status'},
            {data:'',
                 render:(data,type,row)=>{
                 return `<button class='btn ${row.status == 'Money Sent' ? 'btn-primary'  : row.status == 'stop' ? 'btn-warning text-dark' : row.status == 'Paid' ? 'btn-success' :'btn-danger accept'}'  data-paid_id="${row.id}"  value='${row.status}' style='border-radius:10px;'>${row.status}</button>`;    
                 
                 },
            }
          ]
      });
      $(document).on('change','#status',function(){
          table.draw();
      });
      $(document).on('keyup',"#po_no",function(){
            table.draw();
      });
    
    });
    
    // $(".accept").click(function(){
    //     alert("hi");
    // });
    $(document).on('click','.accept',function(){
        // alert("hi");
        var data_paid=$(this).data("paid_id");
        // alert(data_paid);
        
        $('#exampleModal').modal('show');
       $(".yes").val(data_paid);
    });
        
       $(document).on('click','.yes',function(){
            var yes_button=$(this).val();
            $.ajax({
              url: "{{route('paid_upsection')}}",
              type: "Post",
              data:
              {'yes_button':yes_button},
               success: function (data) {
                    console.log(data);
                    if(data.success == 1){
                     $("#exampleModal").modal('hide');
                        swal({
                                title:'Paid Successfully',
                                icon:'success',
                                button:false
                            }) 
                         table.draw();
                    }
                },
            });
        })
    
        
 
</script>
  <div clas="row mt-5 mb-5">
   <div class="col-md-12 ">
     <div class="card">
        <div class="card " id="header-title">  
          <div class="card-header header-elements-inline header">
            <div class="card-title " style="color:whitesmoke;">Redeem Accept List</div>
          </div>
        </div>
        <div class="card-body"  id="cardbody">
          <div class="row">
               <div class="col-md-3"> 
                <label>RNOD Number</label>
                <input type="text" class="form-control inbox" id="po_no" name="purchase_order_no">
               </div>
              <div class="col-md-3">
                  <label>Status List</label>
                  <select class="form-control label-gray-3 inbox" name="status" id="status">
                                                <option value="">All</option>
                                                <option value="Money Sent">Money Sent</option>
                                                <option value="Pending">Pending</option>
                                                <option value="Paid">Paid</option>
                                        </select>
              </div>
               <div class="col-md-3"></div>
              
            <div class="col-md-12 table-resposive mt-4">
              <table class="table table-hover data-table" style="width:100%;">
                <thead class="">
                  <tr class="table_color" >
                     <th scope="col">RNOD Number</th>
                    <th scope="col">Doctor Name</th>
                    <th scope="col">Receive Money</th>
                    <th scope="col">Status</th>
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
  
  <!--modal-->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header bg-primary">
        <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-center ">
        
        <button class="btn btn-success yes" name="yes" value="">Paid</button>
        <button class="btn btn-danger ml-5" data-dismiss="modal">Pending</button>
      </div>
      
    </div>
  </div>
</div>
@endsection
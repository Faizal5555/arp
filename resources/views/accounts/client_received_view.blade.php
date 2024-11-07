@extends('layouts.master')
<style>
    a.ml-2.card-title {
    color: #fff;
    }
    .card-header.header-elements-inline {
    background-color: #0b5dbb;
    }
    .awite-row{
        background-color: #0b5dbb;  
    }
    input#daterange {
    outline: 1px solid #0a51a4;
    border-radius: 21px;
    }
    input#client_id {
        outline: 1px solid #0a51a4;
        border-radius: 21px;
    }
    input#po_no {
        outline: 1px solid #0a51a4;
        border-radius: 21px;
    }
    input#project_no {
        outline: 1px solid #0a51a4;
        border-radius: 21px;
    }
   select#invoice_type {
   outline: 1px solid #0a51a4;
   border-radius: 21px;
  }
  div.dataTables_wrapper div.dataTables_length select {
    width: 57px !important; 
    display: inline-block;
  }
  .dataTables_wrapper .dataTables_length{
    margin-top:8px;
}
div.dataTables_wrapper div.dataTables_filter{
    margin-top:8px;
    margin-right:8px;
}
select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
}
</style>

@section('content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript">
            var startdate=moment(new Date()).format('Y-MM-DD');
            var enddate=moment(new Date()).format('Y-MM-DD');
    $(function( ){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      var table = $('.data-table').DataTable({
          scrollX: true,
          processing: true,
          serverSide: true,
           "searching": false,
          ajax:{
               "url":"{{route('accounts.paymentreceived1')}}",
               data:function(data){
                data.purchase_order_no=$('#po_no').val();
                data.project_no=$('#project_no').val();
                data.client_id=$('#client_id').val();
                data.invoice_type=$('#invoice_type').val();
                data.startdate=startdate,
                data.enddate=enddate
                
              }

          }, 
          columns: [
            {data:'client.operation.project_no',name:'project_no'},
            {data:'client.operation.purchase_order_no',name:'purchase_order_no'},
            {data:'client.operation.rfq',name:'rfq'},
            {data:'client.client_id',name:'client_id'},
            {data:'client.invoice_type',name:'invoice_type'},
            {data:'client.amount',name:'client_amount'},
            {data:'transaction_number',name:'transaction_number'},
            {data:'bank_name',name:'bank_name'},
            {data:'date_payment',name:'date_payment'},
            {data:'',
                    render: (data,type,row) => {
                            return `<div class="text-center">
                                        <div class="list-icons ">
                                            <a href='/adminapp/accounts/getreceivedview/${row.id}'><i class="fas fa-eye"></i></a>
                                            </div>
                                        </div>`;
                            }},
          ]
      });
      $(document).on('change','#daterange',function(){
          table.draw();
      });
      $(document).on('keyup','#po_no',function(){
          table.draw();
      });
      $(document).on('keyup','#project_no',function(){
          table.draw();
      });
      $(document).on('keyup','#client_id',function(){
          table.draw();
      });
    $(document).on('change','#invoice_type',function(){
          table.draw();
      });
      
      $('input[name="daterange"]').daterangepicker({
    ranges: {
        'Today': [moment(), moment()],
        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'Last 45 Days': [moment().subtract(44, 'days'), moment()],
        'Last 60 Days': [moment().subtract(59, 'days'), moment()],
        'Last 90 Days': [moment().subtract(89, 'days'), moment()]
    },
         }, function(start, end, label) {
       startdate =start.format('YYYY-MM-DD');
       enddate=end.format('YYYY-MM-DD');
     });
      

    });
    
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
              
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title" style="color:#fff !important;">Client Payment Received</a>
                </div>

                    <div class="card-body">
                       <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <label>Invoice Type</label>
                                
                                 <select class="form-control label-gray-3" name="invoice_type" id="invoice_type">
                                                <option value="">All</option>
                                                <option value="advance">Advance</option>
                                                <option value="balance">Balance</option></option>
                                        </select>
                            </div>
                            <div class="col-md-4"></div>
                            
                        </div>
                        <div class="row mt-5">
                            
                            <div class="col-md-3">
                                <label>Po No</label>
                                <input type="text" class="form-control" id="po_no" name="purchase_order_no" >
                            </div>
                            <div class="col-md-3">
                                <label>Client Name</label>
                                <input type="text" class="form-control" id="client_id" name="client_id">
                            </div>
                            <div class="col-md-3">
                                <label>Project No</label>
                                <input type="text" class="form-control" id="project_no" name="project_no" >
                            </div>
                            <div class="col-md-3">
                            <label>Date</label>
                            <input type="text" class="form-control" name="daterange"   id="daterange"/>
                            </div>
                        </div>
                    <div class="table-responsive mt-4" id="awittable">
                                
                                <table class="table table-hover table1 data-table">
                                    <thead>
                                        <tr class="awite-row">
                                            <th>Project No </th>
                                            <th>PO No</th>
                                            <th>RFQ No</th>
                                            <th>Client Name</th>
                                            <th>Invoice Type</th>
                                            <th>Client Amount</th>
                                            <th>Transaction Number</th>
                                            <th>Bank Name</th>
                                            <th>Date</th>
                                            <th>view</th>
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
@endsection
@section('script')
@endsection
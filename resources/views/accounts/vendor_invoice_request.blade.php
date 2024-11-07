


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
    input#po_no {
    outline: 1px solid #0a51a4;
    border-radius: 21px;
   }
   input#vendor_id {
    outline: 1px solid #0a51a4;
    border-radius: 21px;
   }
   input#project_no {
   outline: 1px solid #0a51a4;
   border-radius: 21px;
   }
   input#project_no {
   outline: 1px solid #0a51a4;
   border-radius: 21px;
   }
   input#daterange {
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
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      var table = $('.data-table').DataTable({
          scrollX: true,
          processing: true,
          serverSide: true,
          order:[0,'desc'],
          ajax:{
              "url":"{{route('accounts.Vendorrequestadvance1')}}",
              'data':function(data){
                data.purchase_order_no=$('#po_no').val();
                data.project_no=$('#project_no').val();
                data.vendor_id=$('#vendor_id').val();
                data.invoice_type=$('#invoice_type').val();
                data.startdate=startdate,
                data.enddate=enddate
              
              }

          }, 
          columns: [
            {data:'operation.project_no',name:'operation.project_no'},
            {data:'operation.purchase_order_no',name:'operation.purchase_order_no'},
            {data:'operation.rfq',name:'operation.rfq'},
            {data:'vendor_id',name:'vendor_id'},
            {data:'invoice_type',name:'invoice_type'},
            {data:'amount',name:'amount'},
            {data:'created_at',name:'created_at'},
            {data:'',
                render: (data,type,row) => {
                        return `<div class="text-center">
                                    <div class="list-icons ">
                                        
                                       
                                       <a href='/adminapp/accounts/advanceview/${row.id}' ><i class="fas fa-eye"></i></a>
                                        
                                        </div>
                                    </div>
                                </div>`;
                        }},

          ]
      });
      $(document).on('change','#daterange',function(){
          table.draw();
      });
      $(document).on('keyup','#vendor_id',function(){
          table.draw();
      });

      $(document).on('keyup','#po_no',function(){
          table.draw();
      });
      $(document).on('keyup','#project_no',function(){
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
                    <a class="ml-2 card-title" style="color:#fff !important;">Vendor Invoice Request</a>
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
                                <input type="text" class="form-control" id="po_no" name="po_no" >
                            </div>
                            <div class="col-md-3">
                                <label>Vendor Name</label>
                                <input type="text" class="form-control" id="vendor_id" name="vendor_id">
                            </div>
                            <div class="col-md-3">
                            <label>Project No</label>
                                <input type="po112" class="form-control" id="project_no" name="project_no">
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
                                            <th>Rfq No</th>
                                            <th>Vendor Name</th>
                                            <th>Invoice Type</th>
                                            <th>Vendor Amount</th>
                                            <th>Date</th>
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


       


        @endsection
        @section('script')


        @endsection
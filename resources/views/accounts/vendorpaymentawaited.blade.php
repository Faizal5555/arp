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
   select#invoice_type {
   outline: 1px solid #0a51a4;
   border-radius: 21px;
   }
   div.dataTables_wrapper div.dataTables_length select {
    width: 58px !important;
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
          processing: true,
          serverSide: true,
          ajax:{
              "url":"{{route('accounts.vendorpayment')}}",
              'data':function(data){
                  data.invoice_type=$('#invoice_type').val(),
                  data.startdate=startdate,
                data.enddate=enddate
              }

          }, 
          columns: [
            {data:'project_no',name:'project_no'},
            {data:'purchase_order_no',name:'purchase_order_no'},
            {data:'rfq',name:'rfq'},
            {data:'vendor_id',name:'vendor_id'},
            {data:'invoice_type',name:'invoice_type'},
            {data:'amount',name:'amount'},
            {data:'updated_at',name:'updated_at'},
            {data:'',
                render: (data,type,row) => {
                        return `<div class="text-center">
                                    <div class="list-icons ">
                                        <a href='/adminapp/accounts/awaitview/${row.id}'><i class="fas fa-eye"></i></a>
                                        </div>
                                    </div>`;
                        }},

          ]
      });
      $(document).on('change','#start_date',function(){
          table.draw();
      });
      $(document).on('change','#end_date',function(){
          table.draw();
      });
      $(document).on('keyup','#po_no',function(){
          table.draw();
      });
      
       $(document).on('change','#daterange',function(){
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
                    <a class="ml-2 card-title" style="color:#fff !important;">Vendor Payment Due</a>
                </div>

                    <div class="card-body">
                        <div class="row">
                            <!--<div class="col-md-3">-->
                            <!--    <label>Po No</label>-->
                            <!--    {{-- <input type="po112" class="form-control" id="po_no" name="po_no" value="po111"> --}}-->
                            <!--    <input type="po112" class="form-control" id="po_no" name="po_no" value="">-->
                            <!--</div>-->
                            <!--<div class="col-md-3">-->
                            <!--    <label>Vendor Name</label>-->
                            <!--    <input type="text" class="form-control" id="vendor_id" name="vendor_id">-->
                            <!--</div>-->
                            <!--<div class="col-md-3">-->
                            <!-- <label>Start Date</label>-->
                            <!--<input type="date"  class="form-control" id="start_date" name="start_date">-->
                            <!--</div>-->
                            <!--<div class="col-md-3">-->
                            <!--<label>End Date</label>-->
                            <!--<input type="date"  class="form-control" id="end_date" name="end_date">-->
                            <!--</div>-->
                            <div class="col-md-3">
                               
                            </div>
                            <div class="col-md-3">
                                 <label>Invoice Type</label>
                                
                                 <select class="form-control label-gray-3" name="invoice_type" id="invoice_type">
                                                <option value="">All</option>
                                                <option value="advance">Advance</option>
                                                <option value="balance">Balance</option></option>
                                        </select>
                            </div>
                            <div class="col-md-3">
                            <label>Date</label>
                            <input type="text" class="form-control" name="daterange"   id="daterange"/>
                            </div>
                            <div class="col-md-3">
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
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
  .client_id{
      outline: 1px solid #0a51a4;
    border-radius: 21px !important; 
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
              "url":"{{route('accounts.payment1')}}",
              'data':function(data){
                data.invoice_type=$('#invoice_type').val(),
                data.client_id=$("#client_id").val();
                data.startdate=startdate,
                data.enddate=enddate
              }

          }, 
          columns: [
            {data:'project_no',name:'project_no'},
            {data:'purchase_order_no',name:'purchase_order_no'},
            {data:'rfq',name:'rfq'},
            {data:'client_id',name:'client_id'},
            {data:'invoice_type',name:'invoice_type'},
            {data:'amount',name:'amount'},
            {data:'updated_at',name:'updated_at'},
            {data:'',
                render: (data,type,row) => {
                        return `<div class="text-center">
                                    <div class="list-icons ">
                                        <a href='/adminapp/accounts/awitview/${row.id}'><i class="fas fa-eye"></i></a>
                                        </div>
                                    </div>`;
                        }},

          ]
      });
      $(document).on('change','#invoice_type',function(){
          table.draw();
      });
      $(document).on('change','#daterange',function(){
          table.draw();
      });
      
      $(document).on('keyup','#client_id',function(){
          table.draw();
      })
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
                    <a class="ml-2 card-title" style="color:#fff !important;">Client Payment Awaited</a>
                </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                               <label>Client Name</label>
                                <input type="text" class="form-control label-gray-3 client_id" id="client_id" name="client_id" >
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
                                            <th>Client Name</th>
                                            <th>Client Advance</th>
                                            <th>Invoice Type</th>
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
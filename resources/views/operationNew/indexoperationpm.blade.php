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
   margin: 40px -50px 20px -46px;
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
a.ml-2.btn.btn-primary {
    background-color: #a278d6;
    border-color: #a278d6;
}
a.ml-2.btn.btn-primary:hover {
    background-color: #5f2ba1;
    border-color: #5f2ba1;
}
.border {
    border: 1px solid #a278d6!important;
}
.form-control:focus {

    box-shadow: 0 0 0 0.2rem rgb(150 91 196);
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
.card .card-body {

    margin-right: -39px;
}
.card-header.header-elements-inline {
    background: linear-gradient(
43deg
,#0b5dbb,#0b5dbb);
    color: #fff;
}
select.custom-select.custom-select-sm.form-control.form-control-sm {
    margin: 11px;
    color: #000;
}
select.custom-select.custom-select-sm.form-control.form-control-sm {
    padding-left: 10px;
    padding-right: 26px;
}
select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
}
div.table-responsive>div.dataTables_wrapper>div.row>div[class^="col-"]:last-child{
    display:flex;
    justify-content:center;
    align-items:center;
}
input#daterange{
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
}
input#po_no{
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
}
</style>
    
@section('page_title', 'BidRfq List')
@section('content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript">
    // $(function(){
    //     $.ajaxSetup({
    //        headers: {
    //            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //        }
    //  });
    //  var table=$('#myTable').DataTable({    
    //      processing:true,
    //      serverside:true,
    //      pagging:true,
    //      ajax:{
    //          "url": "{{route('operationNew.index')}}",
    //          columns:[
    //              {data:'project_no',name:'project_no'},
    //              {data:'purchase_order_no',name:'purchase_order_no'}
    //          ],
    //          "lengthMenu":[
    //             [5,25,50,-1],
    //             [5,10,15,"All"]
    //         ],
    //      }
    //  });
    // });
   
    $(function () {
         var startdate='';
         var enddate='';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      var table = $('.data-table').DataTable({
          "scrollX": true,
          processing: true,
          serverSide: true,
          order:[0,'desc'],
          ajax: {
              "url":"{{route('operationNew.indexpm')}}",
              'data':function(data){
                data.startdate=startdate,
                data.enddate=enddate,
                data.pno=$('#po_no').val()
              
              }
              },
          columns: [
            {data:'project_no',name:'project_no'},
            {data:'purchase_order_no',name:'purchase_order_no'},
            {data:'respondent_incentives',name:'respondent_incentives'},
            // {data:'team_leader',name:'team_leader'},
            // {data:'project_manager_name',name:'project_manager_name'},
            // {data:'quality_analyst_name',name:'quality_analyst_name'},
            {data:'project_deliverable',name:'project_deliverable'},
            {data:'country_name',name:'country_name'},
            // {data:'sample_target',name:'sample_target'},
            // {data:'sample_achieved',name:'sample_achieved'},
            { 
            data: 'status', 
            name: 'status',
            render: function(data, type, row) {
                return data === 'hold' ? 'live' : data; 
            }
        },
            {data:'',
                 render:(data,typr,row)=>{
                 return `<a href='/adminapp/operationNew/editpm/${row.id}' class='mdi mdi-table-edit'></a>`     
                 }
        }
          ]
      });
      
      $(document).on('keyup','#po_no',function(){
          table.draw();
      })
      $(document).on('change','#daterange',function(){
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
            <div class="card" style="margin-left: 1px;">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Existings Project</a>
                    {{-- <a href="{{route('bidrfq.create')}}" class="ml-2 btn btn-primary">Add</a> --}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                {{-- <div class="input-group" >
                                    <div>
                                        <input class="form-control border-end-0 border rounded-pill"  id="myInput" onkeyup="myFunction()" type="text" name="search" placeholder="search" id="example-search-input">
                                    </div>
                                </div> --}}
                            </div>
                            <div class="table-responsive" id="myTable">
                              <div class="row mt-5 mb-3">
                            
                                
                                        
                            <div class="col-md-3">
                                <label>Po No</label>
                                <input type="text" class="form-control" id="po_no" name="po_no">
                            </div>
                            
                            <div class="col-md-3">
                            <label>Date</label>
                            <input type="text" class="form-control" name="daterange" id="daterange">
                            </div>
                        </div>
                        
                            <table class="table table-hover table1 data-table">
                                <thead>
                                    <tr style="background-color: #0b5dbb !important;">
                                        <th>Project No </th>
                                        <th>Purchase Order No</th>
                                        <th>Respondent Incentives</th>
                                        <!--<th>team_leader</th>-->
                                        <!--<th>project_manager_name</th>-->
                                        <!--<th>quality_analyst_name</th>-->
                                        <th>Project Deliverable</th>
                                        <th>Country Name</th>
                                        <!--<th>sample_target </th>-->
                                        <!--<th>sample_achieved</th>-->
                                        <th>Status</th>
                                        <th>Action</th>

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
    </div>
</div>

@endsection
@push('css')
    <style>

    .input-group
    {
        width:auto !important;
    }
    .card{
        border: none !important;
    }
    .list-group-item:first-child{
        background-color: #ffdae2;
        border-color: #ffdae2;
        text-align: center;
        border-radius: 10px;
    }
    .list-group-item:last-child {
    margin-bottom: 0;
    border-bottom-right-radius: .25rem;
    border-bottom-left-radius: .25rem;
    background-color: #bff2ea;
    border: #bff2ea;
    border-radius: 10px;
    text-align: center;
    margin-top: 10px;
    }
    #vendor-color{
    background-color: #ffdae2;
    border-color: #ffdae2;
    }
    .table td, .table th {
    padding: .75rem;
    vertical-align: middle !important;
    border-top: 1px solid #dee2e6;
    }
</style>
@endpush
@section('script')
@endsection

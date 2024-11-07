@extends('layouts.master')
<style>
    .card {
   margin: 40px 0 20px 0;
    border:1px solid;
 }
 input#daterange,input#daterange_1 {
    padding: 0.4375rem 0.75rem;
    outline: 1px solid #89b3e2;
    color: #bbb5b5;
    border: #000;
    border-radius: 3px;
    width: 80%;
    
}
@media (max-width: 375px){
	/*Small smartphones [325px -> 425px]*/
  #daterange_1 {
    width: 100% !important;
  }
  .chart-title {
    margin-top: 50px;
    margin-bottom: 16px;
}
h5 {
    font-size: 14px;
}
.my-client {
    background-color: #00cccc !important;
    padding: 10px;
    color: #ebedf2;
}
.my-total {
    background-color: #6f42c1 !important;
    padding: 10px;
    color: #ebedf2;
}
}
</style>
@section('page_title', 'WonProject List')
@section('content')

{{-- daterange picker cdn --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

<!--new table-->
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      var table = $('.my-data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
              "url":"{{route('operationNew.operationnewperformancefilter')}}",
              'data':function(data){
                data.op=$('#op').val();
                data.daterange=$('#daterange').val();
                data.new=$('#status1').val();
              }
              },
          columns: [
            {data:'project_no',name:'project_no'},
            {data:'purchase_order_no',name:'purchase_order_no'},
            {data:'respondent_incentives',name:'respondent_incentives'},
            {data:'project_deliverable',name:'project_deliverable'},
            {data:'country_name',name:'country_name'},
            {data:'',
                 render:(data,typr,row)=>{
                 return `<a href='/operationNew/closeoperationperformance/edit/${row.id}'><i class="fas fa-eye"></a>`     
                 }
        }
          ]
      });
      $(document).on('change','#op',function(){
          table.draw();
      })
      $(document).on('change','#daterange',function(){
          table.draw();
      });
    });
    $(document).on('click','.my-new',function(){
     $('#new-table').removeClass('d-none');
     $('#new-find').addClass('d-none');
    });
    $(document).on('click','#back',function(){
     $('#new-table').addClass('d-none');
     $('#new-find').removeClass('d-none');
 })
</script>
<!--new table-->

<!--closed table-->
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
              "url":"{{route('operationNew.operationperformancefilter')}}",
              'data':function(data){
                data.opeartion=$('#op').val();
                data.daterange=$('#daterange').val();
                data.close=$('#status').val();
              
              }
              },
          columns: [
            {data:'project_no',name:'project_no'},
            {data:'purchase_order_no',name:'purchase_order_no'},
            {data:'respondent_incentives',name:'respondent_incentives'},
            {data:'project_deliverable',name:'project_deliverable'},
            {data:'country_name',name:'country_name'},
            {data:'',
                 render:(data,typr,row)=>{
                 return `<a href='/operationNew/closeoperationperformance/edit/${row.id}'><i class="fas fa-eye"></a>`     
                 }
        }
          ]
      });
        $('#op').change(function(){
          table.draw();
      });
        $('#daterange').change(function(){
          table.draw();
        });
    });
     $(document).on('click','.my-close',function(){
     $('#close-table').removeClass('d-none');
     $('#new-find').addClass('d-none');
     });
     
</script>
<script>
    $(document).on('click','#back-close',function(){
        console.log('hii')
     $('#close-table').addClass('d-none');
     $('#new-find').removeClass('d-none');
 })
 $(document).on('click','#back-new',function(){
        console.log('hii')
     $('#new-table').addClass('d-none');
     $('#new-find').removeClass('d-none');
 })
</script>
<!--end closed table-->


    <script>
     
       $(function () {
            $('#daterange').daterangepicker({
                    "showDropdowns": true,
                    ranges: {
                        'Today': [moment(), moment()],
                        'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                        'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                        'This Month': [moment().startOf('month'), moment().endOf('month')],
                        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,'month').endOf('month')]
                    },
                    opens: 'right'
                },
                function (start, end, label) {
            from =start.format('YYYY-MM-DD');
           to =end.format('YYYY-MM-DD');
           var op= $('#op').val();
           
          $.ajax({
          type: "get",
          url: "{{route('operationNew.getoperationperfomance')}}",
          data: {
              id:op,
              start:from,
              end:to,
          },
          dataType: "json",
          success: function (data) {
            if(data.success==0){

            }
            if(data.success==1){
              console.log(data);
              $('.total_new').html(data.newProject);
              $('.total_close').html(data.closeProject);

       

            }
                       
           }

            });
        });
        });
    </script> 

{{-- For date range picker --}}
 <div class="chart-title">
  <div class="container">
    <div class="row">
          <div class="col-md-3 mt-3">
            <h4 class="card-title float-left" style="margin-bottom:40px !important">Operation Team</h4>
            <select class="form-control label-gray-3 sales" name="op" id="op" style="outline: 1px solid #89b3e2 !important; ">
              <option class="label-gray-3" value="">Select Operation Person Name</option>
              
              <option value="{{$all2}}">Selact All</option>
                @if(count($opeartion) > 0)
                @foreach($opeartion as $v)
                <option value="{{$v->id}}">{{$v->name}}</option>
                @endforeach
                @endif
            </select>
          </div>
          <div class="col-md-3 mt-3"> 
          <h4 class="card-title" style="margin-bottom:40px !important">Date</h4>
            <input type="text" id="daterange" name="RFQs" /><br><br>
            <input type="hidden" id="status" name="status"  value="completed"/><br><br>
            <input type="hidden" id="status1" name="status"  value="hold"/><br><br>
          </div>
    </div>
  </div>
</div>

  
<div class="container mt-2 mb-5">
<div class="content-wrapper mt-4" id="new-find">
<div class="row">
  <div class="col-md-12">
    <div class="row">
    <div class="col-md-4">
     <div class="my-client my-new" style="background-color: #0075f2 !important; padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
      <h5>Total  New Project</h5>
     <h2> <label for="" class="total_new">0</label></h2>
    </div>
  </div>
    <div class="col-md-4">
      <div class="my-vendor my-close" style="background-color: #b5ab31 !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
     <h5 >Total Closed Project</h5>
      <h2> <label for="" class="total_close">0</label></h2>
     </div>
    </div>
    </div>

  </div>
</div>  
</div>
</div>

                        <div class="table-responsive d-none" id="new-table">
                             <div class="container">  
                            <table class="table table-hover table1 my-data-table">
                                <thead>
                                    <tr style="background-color: #0b5dbb;">
                                        <th>Project No </th>
                                        <th>Purchase Order No</th>
                                        <th>Respondent  Incentives</th>
                                        <th>Project Deliverable</th>
                                        <th>Country Name</th>
                                        <th>Action</th>

                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                </tbody>
                            </table>
                             <button class="btn btn-success" id="back-new">Back</button>
                            </div> 
                        </div>      
                        
                    <div class="table-responsive d-none" id="close-table">
                           <div class="container">       
                            <table class="table table-hover table1 data-table">
                                <thead>
                                    <tr style="background-color: #0b5dbb;">
                                        <th>Project No </th>
                                        <th>Purchase Order No</th>
                                        <th>Respondent  Incentives</th>
                                        <th>Project Deliverable</th>
                                        <th>Country Name</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="myTable">
                                </tbody>
                            </table>
                            <button class="btn btn-success" id="back-close">Back</button>
                            </div>
                        </div>        








@endsection
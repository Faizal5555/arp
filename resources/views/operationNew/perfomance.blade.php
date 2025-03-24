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
.my-client, .my-vendor {
    border-radius: 12px;
    padding: 20px;
    color: white;
    text-align: center;
    font-size: 16px;
    font-weight: bold;
    min-height: 160px; /* Ensures uniform height */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
    position: relative;
    transition: all 0.3s ease-in-out;
}

/* Updated Solid Background Colors */
.my-new { background-color: #007BFF !important; } /* Blue */
.my-close { background-color: #16a085 !important; } /* Deep Orange */

/* Hover Effect */
.my-client:hover, .my-vendor:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Card Title */
.my-client h5, .my-vendor h5 {
    font-size: 14px;
    margin-bottom: 4px;
    font-weight: 500;
    opacity: 0.9;
}

/* Card Amount Styling */
.my-client h2, .my-vendor h2 {
    font-size: 26px;
    font-weight: bold;
}

/* Row Fix for Equal Height */
/* Container Styling */
.content-wrapper {
    padding: 20px;
    background: #f8f9fa;
    border-radius: 10px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
}
.head{
  font-size:20px;
}

</style>
@section('page_title', 'WonProject List')
@section('content')

{{-- daterange picker cdn --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

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
            var Tl=$('#tel').val();
            var pm=$('#pem').val();
            var ql=$('#qel').val();
          $.ajax({
          type: "get",
          url: "{{route('operationNew.getfieldperfomance')}}",
          data: {
              fid:Tl,
              pid:pm,
              qid:ql,
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
    
      <script>
     $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      var table = $('.new-data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax:{ 
          "url":"{{route('operationNew.closedperformancefilter')}}",
           "data":function(data){
                 data.tid=$(".tel").val();
                 data.pid=$("#pem").val();
                 data.qid=$("#qel").val();
                 data.close =$('#closed').val();
                 data.daterange=$('#daterange').val();
            },   
          },
          columns: [
            {data:'project_no',name:'project_no'},
            {data:'purchase_order_no',name:'purchase_order_no'},
            {data:'respondent_incentives',name:'respondent_incentives'},
            {data:'project_deliverable',name:'project_deliverable'},
            {data:'country_name',name:'country_name'},
            {data:'status',name:'status'},
            {data:'',
                 render:(data,typr,row)=>{
                 return `<a href='/adminapp/operationNew/closefieldperformance/edit/${row.id}'><i class="fas fa-eye"></a>`     
                 }
        }
          ]
      });
      $('#tel').change(function(){
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
   $(document).on('click','#back-close',function(){
     $('#close-table').addClass('d-none');
     $('#new-find').removeClass('d-none');
 })
</script>  

    <script>
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax:{ 
          "url":"{{route('operationNew.fieldperformancefilter')}}",
           "data":function(data){
                 data.tid=$(".tel").val();
                 data.pid=$("#pem").val();
                 data.qid=$("#qel").val();
                 data.field =$('#new').val();
                 data.daterange=$('#daterange').val();
            },   
          },
          columns: [
            {data:'project_no',name:'project_no'},
            {data:'purchase_order_no',name:'purchase_order_no'},
            {data:'respondent_incentives',name:'respondent_incentives'},
            {data:'project_deliverable',name:'project_deliverable'},
            {data:'country_name',name:'country_name'},
            {data:'status',name:'status'},
            {data:'',
                 render:(data,typr,row)=>{
                 return `<a href='/adminapp/operationNew/closefieldperformance/edit/${row.id}' class='mdi mdi-table-edit'></a>`     
                 }
        }
          ]
      });
      $('#tel').change(function(){
          table.draw();
      });
        $('#daterange').change(function(){
          table.draw();
        });
    });
    $(document).on('click','.my-new',function(){
     $('#new-table').removeClass('d-none');
     $('#new-find').addClass('d-none');
   });
   $(document).on('click','#back-new',function(){
     $('#new-table').addClass('d-none');
     $('#new-find').removeClass('d-none');
  });
</script>  

{{-- For date range picker --}}
  


 <div class="chart-title">
  <div class="container  mt-3">
    <div class="row">
          {{-- <div class="col-md-3 mt-3">
            <h4 class="card-title float-left" style="margin-bottom:40px !important">Team Leader Name</h4>
            <select class="form-control label-gray-3 sales tel" name="tl" id="tel" style="outline: 1px solid #89b3e2 !important; ">
              <option class="label-gray-3" value="" disabled selected>Select Team Leader </br> Name</option>
                    @if(count($Team_Leader) > 0)
                @foreach($Team_Leader as $v)

                <option value="{{$v->id}}">{{$v->name}}</option>
                @endforeach
                @endif
            </select>
          </div> --}}
          <div class="col-md-3 mt-3">
            <h4 class="card-title float-left">Project Manager Name</h4>
            <select class="form-control label-gray-3 sales" name="pm" id="pem" style="outline: 1px solid #89b3e2 !important;">
              <option class="label-gray-3" value="" disabled selected>Select Project Manager Name</option>
                    @if(count($project_manager) > 0)
                @foreach($project_manager as $v)

                <option value="{{$v->id}}">{{$v->name}}</option>
                @endforeach
                @endif
            </select>
          </div>
          <div class="col-md-3 mt-3">
            <h4 class="card-title float-left">Quality Analyst Name</h4>
            <select class="form-control label-gray-3 sales" name="ql" id="qel" style="outline: 1px solid #89b3e2 !important;">
              <option class="label-gray-3" value="" disabled selected>Select Quality Analyst Name</option>
                    @if(count($quality_analyst) > 0)
                @foreach($quality_analyst as $v)

                <option value="{{$v->id}}">{{$v->name}}</option>
                @endforeach
                @endif
            </select>
          </div>
          <div class="col-md-3 mt-3"> 
          <h4 class="card-title" style="margin-bottom:40px !important">Date</h4>
            <input type="text" id="daterange" name="RFQs" /><br><br>
            <input type="hidden" id="new" name="status" value="hold">
            <input type="hidden" id="closed" name="status" value="completed">
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
     <div class="my-client my-new">
      <p class="head">Total  New Project</p>
     <h2> <label for="" class="total_new">0</label></h2>
    </div>
  </div>
    <div class="col-md-4">
      <div class="my-vendor my-close">
     <p class="head">Total Closed Project</p>
      <h2> <label for="" class="total_close">0</label></h2>
     </div>
    </div>


   
    </div>

  </div>
</div>  

  

</div>
</div>

<div class="table-responsive d-none" id="new-table">
                                
                            <table class="table table-hover table1 data-table">
                                <thead>
                                    <tr style="background-color: #0b5dbb;">
                                        <th>Project No </th>
                                        <th>Purchase Order No</th>
                                        <th>Respondent  Incentives</th>
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
                             <button class="btn btn-success" id="back-new">Back</button>
                        </div>
                        
              <div class="table-responsive d-none" id="close-table">
                                
                            <table class="table table-hover table1 new-data-table">
                                <thead>
                                    <tr style="background-color: #0b5dbb;">
                                        <th>Project No </th>
                                        <th>Purchase Order No</th>
                                        <th>Respondent  Incentives</th>
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
                             <button class="btn btn-success" id="back-close">Back</button>
                        </div>




@endsection
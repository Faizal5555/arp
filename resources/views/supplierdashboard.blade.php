@extends('layouts.master')

<style>
  .card .card-body {
    padding: 1rem 1rem !important;
}
select#supplier_country {
    outline: 1px solid #0a51a4;
    border-radius: 21px;
    }
    input#supplier_company {
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
</style>



@section('content')

{{-- daterange picker cdn --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />


{{-- for chartjs --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  
<div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title">
                <span class="page-title-icon bg-gradient-primary text-white mr-2">
                  <i class="mdi mdi-home"></i>
                </span> Supplier Dashboard
              </h3>
              <nav aria-label="breadcrumb">
                <ul class="breadcrumb">
                  <li class="breadcrumb-item active" aria-current="page">
                    <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
                  </li>
                </ul>
              </nav>
            </div>
            <!--<div class="row">-->
            <!--  <div class="col-md-4 stretch-card grid-margin">-->
            <!--    <div class="card bg-gradient-danger card-img-holder text-white">-->
            <!--      <div class="card-body">-->
            <!--        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />-->
            <!--        <h4 class="font-normal mb-3">Total Suppliers<i class="mdi mdi-chart-line mdi-24px float-right"></i>-->
            <!--        </h4>-->
            <!--        <h2 class="mb-5" id="total_supplier">{{$total_supplier ? $total_supplier :0 }}</h2>-->
                    
                    <!--<h6 class="card-text">Increased by 60%</h6>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
            <!--  <div class="col-md-4 stretch-card grid-margin">-->
            <!--    <div class="card bg-gradient-info card-img-holder text-white">-->
            <!--      <div class="card-body">-->
            <!--        <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />-->
            <!--        <h4 class="font-normal mb-3">Total RFQ Sent<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>-->
            <!--        </h4>-->
            <!--    
                    <!--<h6 class="card-text">Decreased by 10%</h6>-->
            <!--      </div>-->
            <!--    </div>-->
            <!--  </div>-->
              
            <!--</div>-->
            
            {{-- date range picker --}}
            {{--  --}}
            <div class="row mt-5">
              
              <div class="col-md-3">
                
                  <label>Date</label>
                  <input type="text" class="form-control" id="daterange" name="daterange" value="" >

              </div>
              <div class="col-md-3">
                  <label>Supplier Country</label>
                  {{-- <input type="po112" class="form-control" id="po_no" name="po_no" value="po111"> --}}
                  {{-- <input type="text" class="form-control" id="supplier_country" name="supplier_country" value=""> --}}
                  <select class='form-control border border-secondary label-gray-3' name='supplier_country' id='supplier_country'> 
                    <option value=""> Select Country</option>
                    @if(isset ($country) && count($country) > 0)
                    @foreach($country as $v)
                <option value="{{$v->name}}">{{$v->name}}</option>
                    @endforeach
                    @endif
                </select>
              </div>
              <div class="col-md-3">
                  <label>Supplier Company</label>
                  <input type="text" class="form-control" id="supplier_company" name="supplier_company">
              </div>
             
          </div>
            <br>
            <div class="row mt-4">
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-danger card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="mb-4">Total Supplier</h4>
                    <h2 class="mb-5" id="total_supplier1"></h2>
                    
                  </div>
                </div>
              </div>
              <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-info card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="mb-4">Total Cost Request </h4>
                    <h2 class="mb-5" id="total_cost_request1"></h2>
                    {{-- <h6 class="card-text">Decreased by 10%</h6> --}}
                  </div>
                </div>
              </div>
        
              <div class="col-md-4 stretch-card grid-margin">
                
              </div> 
            </div>
            <br>
            
            <!--for chart-->
            <!-- <div class="card mb-3">-->
            <!--  <div class="col-md-12">-->
            <!--      <div class="canvas_append "style="width:80% !important;">-->
            <!--        <canvas id="bar_chart" style="width:100% !important; height:400; " ></canvas>-->
            <!--    </div>-->
            <!--    </div>-->
            <!--</div>-->

            
    
        
           
         </div>
 <script>
   var start_1="";
   var end_1="";
   $(document).on('keyup','#supplier_company',function(){
     var supplier_company = $('#supplier_company').val();
     var supplier_country = $('#supplier_country').val();
    // console.log(supplier_company);
    //  graph(supplier_company);
    $.ajax({
      url:"{{route('supplier.overview1')}}",
       type:"post",
       data:{supplier_company:supplier_company,supplier_country:supplier_country,start_1:start_1,end_1,end_1},   
       success:function(data){
        // console.log(data);
           $("#total_supplier1").html(data.total_supplier);
           $("#total_cost_request1").html(data.total_cost_request);
          //  $("#awaited").html(data.total_client_invoice_awaited);
       }
    })
      });



      $(document).on('change','#supplier_country',function(){
        var supplier_country = $('#supplier_country').val();
        var supplier_company = $('#supplier_company').val();
        $.ajax({
      url:"{{route('supplier.overview1')}}",
       type:"post",
       data:{supplier_country:supplier_country,supplier_company:supplier_company,start_1:start_1,end_1,end_1},   
       success:function(data){
        // console.log(data);
           $("#total_supplier1").html(data.total_supplier);
           $("#total_cost_request1").html(data.total_cost_request);
          //  $("#awaited").html(data.total_client_invoice_awaited);
       }
    })

       });

      // $("#supplier_coutry").on('change',function(){
 $(document).ready(function(){
  
        start_1=moment().format('YYYY-MM-DD');
        end_1=moment().format('YYYY-MM-DD');
        chart(start_1,end_1);  
 });
  
      
 $(document).ready(function(){

   
           
           
           
  });


  function chart(start_date,end_date){
    var supplier_country = $('#supplier_country').val();
        var supplier_company = $('#supplier_company').val();
    // alert(start_date);
    $.ajax({
      url:"{{route('supplier.overview1')}}",
       type:"post",
       data:{supplier_country:supplier_country,supplier_company:supplier_company,start_1:start_1,end_1,end_1},   
       success:function(data){
        // console.log(data);
           $("#total_supplier1").html(data.total_supplier);
           $("#total_cost_request1").html(data.total_cost_request);
          //  $("#awaited").html(data.total_client_invoice_awaited);
       }
    })
  }
  $(function() {
    $('#daterange').daterangepicker({
      "showDropdowns": true,
      ranges: {
            'Today': [moment(), moment()],
            'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days': [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'Last 45 Days': [moment().subtract(44, 'days'), moment()],
            'Last 60 Days': [moment().subtract(59, 'days'), moment()],
            'Last 90 Days': [moment().subtract(89, 'days'), moment()],
            'Last year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
      },
      opens: 'right'
    }, 
    function(start, end, label) {
      // console.log("A new date selection was made: " + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD'));
      start_1=start.format('YYYY-MM-DD');
      end_1=end.format('YYYY-MM-DD');
      chart(start.format('YYYY-MM-DD'),end.format('YYYY-MM-DD'))  
    });
  });
  

</script>
@endsection
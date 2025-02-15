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
<script>
       
</script>   
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
            var client=$('#sales').val();
          $.ajax({
          type: "get",
          url: "{{route('accounts.getperfomance')}}",
          data: {
              id:client,
              start:from,
              end:to,
          },
          dataType: "json",
          success: function (data) {
            if(data.success==0){

            }
            if(data.success==1){
              console.log(data);
              $('.total_client').html(data.client);
              $('.total_vendor').html(data.total_vendor);
              $('.total_rfq').html(data.rfq);
              $('.Total_client_invoice').html(data.client_invoice);
              $('.Total_vendor_invoice').html(data.vendor_invoice);
              $('.total_margin').html(data.total_margin);
              $('.rfq_follow').html(data.rfq_follow);
       

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
          <div class="col-md-3">
            <h4 class="card-title float-left">Accounts Name</h4>
            <select class="form-control label-gray-3 sales" name="sales" id="sales" style="outline: 1px solid #89b3e2 !important;">
              <option class="label-gray-3" value="">Select  Name</option>
                @if(count($user_name) > 0)
                @foreach($user_name as $v)

                <option value="{{$v->id}}">{{$v->name}}</option>
                @endforeach
                @endif
            </select>
          </div>
          <div class="col-md-3">
          <h4 class="card-title">Date</h4>
            <input type="text" id="daterange" name="RFQs" /><br><br>
          </div>
    </div>
  </div>
</div>

  
<div class="container mt-2">
<div class="content-wrapper">
<div class="row">
  <div class="col-md-12">
    <div class="row">
        
    

    <div class="col-md-3">
     <div class="my-client" style="background-color: #0075f2 !important; padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
      <h5>Total  Client Invoice Pending</h5>
     <h2> <label for="" class="total_client_pending"></label></h2>
    </div>
  </div>
    <div class="col-md-3">
      <div class="my-vendor" style="background-color: #b5ab31 !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
     <h5 >Total Vendor Invoice Pending</h5>
      <h2> <label for="" class="total_vendor_pending"></label></h2>
     </div>
    </div>
    <div class="col-md-3">
      <div class="my-total" style="background-color: #28a745 !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
      <h5 >Total Client Payment Received </h5>
      <h2> <label for="" class="total_client_receive"></label></h2>
    </div>
  </div>
   <div class="col-md-3">
      <div class="my-total" style="background-color: #28a745 !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
      <h5 >Total Vendor Payment Received  </h5>
      <h2> <label for="" class="total_vendor_receive"></label></h2>
    </div>
  </div>
    </div>

    
      

        
    <div class="row">
        
    

        <div class="col-md-3">
         <div class="my-client" style="background-color: #0075f2 !important; padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
          <h5>Total Payment Awaited</h5>
         <h2> <label for="" class="total_awited"></label></h2>
        </div>
      </div>
        
        
       
        </div>

  </div>
</div>  
</div>
</div>






@endsection
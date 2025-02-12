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
.my-client, .my-vendor, .my-total {
    border-radius: 12px;
    padding: 20px;
    color: white;
    text-align: center;
    font-size: 16px;
    font-weight: bold;
    min-height: 140px; /* Ensures uniform height */
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    box-shadow: 0 5px 12px rgba(0, 0, 0, 0.15);
    position: relative;
    transition: all 0.3s ease-in-out;
}

/* Solid Background Colors */
.my-client { background-color: #007BFF !important; } /* Blue */
.my-vendor { background-color: #FF9800 !important; } /* Orange */
.my-total { background-color: #28A745 !important; } /* Green */
.my-margin { background-color: #E74C3C !important; } /* Red */
.my-followup { background-color: #17A2B8 !important; } /* Cyan */
.my-invoice { background-color: #6C757D !important; } /* Dark Gray */
.my-vendor-invoice { background-color: #03A9F4 !important; } /* Light Blue */

/* Card Hover Effect */
.my-client:hover, .my-vendor:hover, .my-total:hover, .my-margin:hover, .my-followup:hover, .my-invoice:hover, .my-vendor-invoice:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
}

/* Amount Styling */
.my-client h2, .my-vendor h2, .my-total h2 {
    font-size: 24px;
    font-weight: bold;
}

/* Currency Labels */
.my-client h5, .my-vendor h5, .my-total h5 {
    font-size: 14px;
    margin-bottom: 4px;
    font-weight: 500;
    opacity: 0.9;
}



/* Row Fix for Equal Height */
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
          url: "{{route('wonproject.salesperfomance')}}",
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
            <h4 class="card-title float-left">Sales Manager Name</h4>
            <select class="form-control label-gray-3 sales" name="sales" id="sales" style="outline: 1px solid #89b3e2 !important;">
              <option class="label-gray-3" value="">Select Sales Manager Name</option>
              <option value="{{$all2}}">All</option>
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
      <p class="head">Total  Client</p>
     <h2> <label for="" class="total_client">0</label></h2>
    </div>
  </div>
    <div class="col-md-3">
      <div class="my-vendor" style="background-color: #FF9800 !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
     <p class="head" >Total Vendor</p>
      <h2> <label for="" class="total_vendor">0</label></h2>
     </div>
    </div>
    <div class="col-md-3">
      <div class="my-total" style="background-color: #28A745 !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
      <p class="head">Total Bidrfq </p>
      <h2> <label for="" class="total_rfq">0</label></h2>
    </div>
  </div>
  <div class="col-md-3">
         <div class="my-client" style="background-color: #6C757D   !important; padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
          <p class="head">Total  Margin</p>
         <h2> <label for="" class="total_margin">0</label></h2>
        </div>
        </div>
   
    </div>

    <div class="row">
        
       <div class="col-md-3">
         <div class="my-client" style="background-color: #9956b5 !important; padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
          <p class="head">Rfq Followup</p>
         <h2> <label for="" class="rfq_follow">0</label></h2>
        </div>
      </div>
        <div class="col-md-3">
          <div class="my-vendor" style="background-color:#E74C3C !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
         <p class="head">Total Client Invoice</p>
          <h2> <label for="" class="Total_client_invoice">0</label></h2>
         </div>
        </div>
        <div class="col-md-3">
          <div class="my-total" style="background-color: #03a9f4  !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
          <p class="head">Total Vendor Invoice</p>
          <h2> <label for="" class="Total_vendor_invoice">0</label></h2>
        </div>
      </div>
       
        </div>

        
    <div class="row">
    
      
    </div>

  </div>
</div>  
</div>
</div>






@endsection
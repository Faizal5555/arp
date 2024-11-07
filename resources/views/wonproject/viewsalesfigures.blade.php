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

{{-- For date range picker --}}
  <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
  <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />

{{-- for chartjs --}}
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

 <div class="chart-title">
  <div class="container">
    <div class="row">
          <div class="col-md-5">
            <h4 class="card-title float-left">Client Name</h4>
            <select class="form-control label-gray-3" name="client_id" id="client_id" style="outline: 1px solid #89b3e2 !important;">
              <option class="label-gray-3" value="">Select Client Name</option>
                @if(count($client) > 0)
                @foreach($client as $v)
                <option value="{{$v->rfq_no}}">{{$v->rfq_no}}</option>
                @endforeach
                @endif
            </select>
          </div>
          <!--<div class="col-md-3">-->

          <!--</div>-->
          <div class="col-md-6">
            <h4 class="card-title">Date</h4>
            <input type="text" id="daterange_1" name="daterange_1"  /><br><br>
          </div>
    </div>
  </div>
</div>

    {{-- <div class="row">
      <div class="col-md-12">
        <div class="row">
      
        <div class="col-md-3 stretch-card grid-margin">
          <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
              <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
              <h5 class="font-weight-normal mb-3">Total Client Invoice <i class="mdi mdi-chart-line mdi-24px float-right"></i> </h5>
              <h2> <label for="" class="total_client_invoice">{{$client_total ? $client_total : 0}}</label></h2>
            </div>
          </div>    
          
        </div>
        <div class="col-md-3 stretch-card grid-margin">
          <div class="card bg-gradient-danger card-img-holder text-white">
            <div class="card-body">
              <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
              <h5 class="font-weight-normal mb-3">Total Vendor Invoice <i class="mdi mdi-chart-line mdi-24px float-right"></i></h5>
              <h2> <label for="" class="total_vendor_invoice">{{$vendor_toatl ? $vendor_toatl : 0}}</label></h2>
            </div>
          </div>
        </div>
       <div class="col-md-3 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
            <img src="{{asset('assets/images/dashboard/circle.svg')}}" class="card-img-absolute" alt="circle-image" />
            <h5 class="font-weight-normal mb-3">Total Margin Values <i class="mdi mdi-chart-line mdi-24px float-right"></i></h5>
            <h2> <label for="" class="total_margin">{{$wonproject ? $wonproject : 0}}</label></h2>
          </div>
        </div>
      </div>
      <div class="col-md-3 stretch-card grid-margin" id="">
         <canvas id="bar_chart" width="100%" height="100%"></canvas> 
      </div>
    </div>
  </div>
</div> --}}


        
{{-- report --}}
<div class="container float-right mb-4">
  
      <button id="btnExport" class="btn btn-success" style="float:right" onclick="fnExcelReport();"> Download Report </button>
      
</div>
{{-- end report --}}
<div class="container">
<div class="content-wrapper">
<div class="row">
  <div class="col-md-12">
    <div class="row">
        
    

    <div class="col-md-3">
     <div class="my-client" style="background-color: #0075f2 !important; padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
      <h5>Total  Client Invoice </h5>
     <h2> <label for="" class="total_client_invoice">{{$client_total ? $client_total : 0}}</label></h2>
     <h5>$<span class="client_usd"></span></h5>
     <h5>₹<span class="client_inr"></span></h5>
     <h5>€<span class="client_euro"></span></h5>
     <h5>£<span class="client_pound"></span></h5>
    </div>
  </div>
    <div class="col-md-3">
      <div class="my-vendor" style="background-color: #b5ab31 !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
     <h5 >Total Vendor Invoice </h5>
      <h2> <label for="" class="total_vendor_invoice">{{$vendor_toatl ? $vendor_toatl : 0}}</label></h2>
      
     <h5>$<span class="vendor_usd"></span></h5>
     <h5>₹<span class="vendor_inr"></span></h5>
     <h5>€<span class="vendor_euro"></span></h5>
     <h5>£<span class="vendor_pound"></span></h5>
     </div>
    </div>
    <div class="col-md-3">
      <div class="my-total" style="background-color: #28a745 !important;  padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
      <h5 >Total Margin Values </h5>
      <h2> <label for="" class="total_margin">{{$wonproject ? $wonproject : 0}}</label></h2>
      
     <h5>$<span class="total_usd"></span></h5>
     <h5>₹<span class="total_inr"></span></h5>
     <h5>€<span class="total_euro"></span></h5>
     <h5>£<span class="total_pound"></span></h5>
    </div>
  </div>
    <div class="col-md-3" id="default_chart">
      <canvas id="bar_chart" width="100%" height="100%"></canvas>
    </div>
    </div>
  </div>
</div>  
</div>
</div>

<iframe id="txtArea1" style="display:none"></iframe>
{{-- report table --}}
<div class="">
  <table id="export_table" class="d-none">
    <tr>
    <th>RFQ NO</th>
    <th>Client Name</th>
    <th>Currency</th>
    <th>Total Margin</th>
    <th>Client Invoice</th>
    <th>vendor Invoice</th>
    </tr>
    
    
  </table>
</div>
{{--end report table --}}


<script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
<script type="text/javascript">

function fnExcelReport()
{
    
    let table = document.getElementsByTagName("table");
        TableToExcel.convert(table[0], { // html code may contain multiple tables so here we are refering to 1st table tag
           name: `export.xlsx`, // fileName you could use any name
           sheet: {
              name: 'Sheet 1' // sheetName
           }
        });
        
return "";        
    var tab_text="<table border='2px'><tr bgcolor='#87AFC6'>";
    var tab_text="";
    var textRange; var j=0;
    tab = document.getElementById('export_table'); // id of table

    for(j = 0 ; j < tab.rows.length ; j++) 
    {     
        tab_text=tab_text+tab.rows[j].innerHTML;
        tab_text=tab_text+"</tr>";
    }

    tab_text=tab_text+"</table>";
    tab_text= tab_text.replace(/<A[^>]*>|<\/A>/g, "");//remove if u want links in your table
    tab_text= tab_text.replace(/<img[^>]*>/gi,""); // remove if u want images in your table
    tab_text= tab_text.replace(/<input[^>]*>|<\/input>/gi, ""); // reomves input params

    var ua = window.navigator.userAgent;
    var msie = ua.indexOf("MSIE "); 

    if (msie > 0 || !!navigator.userAgent.match(/Trident.*rv\:11\./))      // If Internet Explorer
    {
        txtArea1.document.open("txt/html","replace");
        txtArea1.document.write(tab_text);
        txtArea1.document.close();
        txtArea1.focus(); 
        sa=txtArea1.document.execCommand("SaveAs",true,"Say Thanks to Sumit.xls");
    }  
    else                 //other browser not tested on IE 11
        sa = window.open('data:application/vnd.ms-excel,' + encodeURIComponent(tab_text));  

    return (sa);
 
  
}







  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="token"]').attr('content')
    }
  });

$(document).ready(function() {

  var from =moment().subtract(365, 'days').format('YYYY-MM-DD') ;
  var to = moment().format('YYYY-MM-DD');
  var rfq_no= $('#client_id').val();

  $.ajax({
        url: "{{url('/adminapp/wonproject/viewsalesfigures_invoice')}}",
        type:'post',
        data:{
          start:from,
          end:to,
          client_id:rfq_no
        },
        success:function(response){
          $('#default_chart').empty();
          $('#default_chart').html('<canvas id="bar_chart" width="100%" height="100%" ></canvas>');
          // var labels =["Total margin value","Total client invoice value","Total vendor invoice value"];
          var total_data=[response.client_total,response.vendor_total,response.total_margin];
          var bgColor=["#0075f2","#b5ab31","#28a745"];
          var chartdata = {
            labels:["Client Invoice  ","Vendor Invoice","Margin Value "],
            datasets:[{
              label:"Total invoice values",
              backgroundColor:bgColor,
              hoverOffset: 4,
              data:total_data
            }]
          };
          var ctx=$("#bar_chart");
          var barGraph = new Chart(ctx,{
              type:'doughnut',
              data:chartdata,
               
          });
          
          $(".total_margin").html(response.total_margin);
          $(".total_client_invoice").html(response.client_total);
          $(".total_vendor_invoice").html(response.vendor_total);
          $(".client_usd").html(response.client_usd);
          $(".client_inr").html(response.client_inr);
          $(".client_euro").html(response.client_euro);
          $(".client_pound").html(response.client_pound);
          $(".vendor_usd").html(response.vendor_usd);
          $(".vendor_inr").html(response.vendor_inr);
          $(".vendor_euro").html(response.vendor_euro);
          $(".vendor_pound").html(response.vendor_pound);
          $(".total_usd").html(response.total_usd);
          $(".total_inr").html(response.total_inr);
          $(".total_euro").html(response.total_euro);
          $(".total_pound").html(response.total_pound);
          },
        error:function(response){
          alert("not ok");
        }
      });

      $.ajax({
        url: "{{url('/adminapp/wonproject/downdata')}}",
        type:'post',
        data:{
          start:from,
          end:to,
          client_id:rfq_no
        },
        success:function(response){
          // console.log(response);
          html = "<thead> <tr><th>RFQ NO</th> <th>Client name</th> <th>currency</th> <th>Total margin</th> <th>Client invoice</th> <th>vendor invoice</th> </tr></thead><tbody>";
          if(response.down_data.length > 0)
          {
            $( "#btnExport" ).removeClass( 'd-none');
            $.each(response.down_data,function(key,val){
              html += `
              <tr>
                <td>${val.rfq_no}</td>
                <td>${val.client_id}</td>
                <td>${val.currency}</td>
                <td>${val.total_margin}</td>
                <td>${val.client_total}</td>
                <td>${val.vendor_total}</td>
              </tr>
              `;
            });
            html+='</tbody>'
            $('#export_table').html(html);
          }
        //   else{
        //     html +="";
        //     $('#export_table').html(html);
        //     $( "#btnExport" ).addClass( 'd-none');
        //   }
         
          },
        error:function(response){
          alert("Failed");
        }
      });

 
  $(function() {
    $('input[name="daterange_1"]').daterangepicker({
      startDate:moment().subtract(365, 'days'),
      endDate:moment(),  
      ranges: {
        'Last 30 Days': [moment().subtract(29, 'days'), moment()],
        'This Month': [moment().startOf('month'), moment().endOf('month')],
        'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
        'Last 12 months': [moment().subtract(365, 'days'), moment()]
    },
      opens: 'right'
    }
    , 
    function(start, end, label) {
       from =start.format('YYYY-MM-DD');
       to =end.format('YYYY-MM-DD');
       var rfq_no= $('#client_id').val();
      $.ajax({
        url: "{{url('/adminapp/wonproject/viewsalesfigures_invoice')}}",
        type:'post',
        data:{
          start:from,
          end:to,
          client_id:rfq_no
        },
        success:function(response){
          $('#default_chart').empty();
          $('#default_chart').html('<canvas id="bar_chart" width="100%" height="100%"></canvas>');
          // var labels =["Total margin value","Total client invoice ","Total vendor invoice "];
          var total_data=[response.client_total,response.vendor_total,response.total_margin];
          var bgColor=["#00CCCC","#0075F2","#5A1BD0"];
          var chartdata = {
            labels:["Client Invoice  ","Vendor Invoice","Margin Value  "],
            datasets:[{
              label:"Total invoice values",
              backgroundColor:bgColor,
              hoverOffset: 4,
              data:total_data
            }]
          };
          var ctx=$("#bar_chart");
          var barGraph = new Chart(ctx,{
              type:'doughnut',
              data:chartdata,
               
          });
          
          $(".total_margin").html(response.total_margin);
          $(".total_client_invoice").html(response.client_total);
          $(".total_vendor_invoice").html(response.vendor_total);
          $(".client_usd").html(response.client_usd);
          $(".client_inr").html(response.client_inr);
          $(".client_euro").html(response.client_euro);
          $(".client_pound").html(response.client_pound);
          $(".vendor_usd").html(response.vendor_usd);
          $(".vendor_inr").html(response.vendor_inr);
          $(".vendor_euro").html(response.vendor_euro);
          $(".vendor_pound").html(response.vendor_pound);
          $(".total_usd").html(response.total_usd);
          $(".total_inr").html(response.total_inr);
          $(".total_euro").html(response.total_euro);
          $(".total_pound").html(response.total_pound);
          },
        error:function(response){
          alert("no response");
        }
      });

      $.ajax({
        url: "{{url('/adminapp/wonproject/downdata')}}",
        type:'post',
        data:{
          start:from,
          end:to,
          client_id:rfq_no
        },
        success:function(response){
            console.log(response);
          html = " <tr> <th>RFQ NO</th> <th>Client Name</th> <th>Currency</th> <th>Total Margin</th> <th>Client Invoice</th> <th>Vendor Invoice</th> </tr>";
          if(response.down_data.length > 0)
          {
            $("#btnExport" ).removeClass( 'd-none');
            $.each(response.down_data,function(key,val){
              let sum = 0;
              let vendor_total = val.vendor_total.split(',');
                for(i=0;i<vendor_total.length;i++)
                    sum =sum + parseInt(vendor_total[i])
              
              html += `
              <tr>
                <td>${val.rfq_no}</td>
                <td>${val.client_id}</td>
                <th>${val.currency}</td>
                <td>${val.total_margin}</td>
                <td>${val.client_total}</td>
                <td>${sum}</td>
              </tr>
              `;
                
            });
            $('#export_table').html(html);
          }
          else{
              if(response.down_data){
                //   alert(response.down_data);
            html +="";
            $('#export_table').html(html);
            $( "#btnExport" ).addClass( 'd-none');
          }
          }
         
          },
        error:function(response){
          alert("Failed");
        }
      });
   

    });

    
  });
});


</script>
@endsection
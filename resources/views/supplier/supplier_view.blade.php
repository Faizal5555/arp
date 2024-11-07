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
    input#supplier_company {
    outline: 1px solid #0a51a4;
    border-radius: 21px;
   }
   select#supplier_country {
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
   
</style>
@section('content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript">
    $(function(){
        var startdate='';
        var enddate='';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

      var table = $('.data-table').DataTable({
          scrollX: true,
          processing: true,
          serverSide: true,
          ajax:{
              "url":"{{route('supplier.view1')}}",
              'data':function(data){
                data.supplier_company=$('#supplier_company').val();
                data.supplier_country=$('#supplier_country').val();
                
                data.startdate=startdate,
                data.enddate=enddate
              
              }

          }, 
          columns: [
            {data:'supplier_company',name:'supplier_company'},
            {data:'supplier_manager',name:'supplier_manager'},
             @if(auth()->user()->user_type == 'admin')
             {data:'supplier_email',name:'supplier_email'},
             {data:'supplier_phone',name:'supplier_phone'},
             {data:'supplier_whatsapp',name:'supplier_whatsapp'},
             @endif
            {data:'supplier_country',name:'supplier_country'},
            {data:'other_detail',name:'other_detail'},
           

          ]
      });
   
      $(document).on('change','#daterange',function(){
          table.draw();
      });
      $(document).on('keyup','#supplier_company',function(){
          table.draw();
      });
      $(document).on('change','#supplier_country',function(){
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
                    <a class="ml-2 card-title" style="color:#fff !important;">View Total Cost Requests Sent To Supplier</a>
                </div>

                    <div class="card-body">
                       
                        <div class="row mt-5">
                            
                                
                                        
                            <div class="col-md-3">
                                <label>Supplier Name</label>
                                <input type="text" class="form-control" id="supplier_company" name="supplier_company" >
                            </div>
                            <div class="col-md-3">
                                <label>Supplier Country</label>
                                
                                <select class="form-control label-gray-3" name="country_0[]" id="supplier_country">
                                    <option class="label-gray-3" value="">Country</option>
                                        @if(count($country) > 0)
                                        @foreach($country as $v)
                                    <option value="{{$v->name}}">{{$v->name}}</option>
                                        @endforeach
                                        @endif
                                </select>
                            </div>
                            <div class="col-md-3">
                               
                            </div>
                            <div class="col-md-3">
                               
                            </div>
                        </div>
                    <div class="table-responsive mt-4" id="cost_request_view">
                                
                                <table class="table table-hover table1 data-table">
                                    <thead>
                                        <tr class="awite-row">
                                            <th>Supplier Name </th>
                                            <th>Supplier Manager</th>
                                            @if(auth()->user()->user_type == 'admin')
                                            <th>Supplier Email</th>
                                            <th>Supplier Phone Number</th>
                                            <th>Supplier Whatsapp Number</th>
                                            @endif
                                            <th>Supplier Country</th>
                                            <th>Other Details</th>
                                            
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
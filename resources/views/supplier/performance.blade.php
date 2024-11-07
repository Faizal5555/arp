@extends('layouts.master')
<style>
    .card {
        margin: 40px 0 20px 0;
        border: 1px solid;
    }

    input#daterange,
    input#daterange_1 {
        padding: 0.4375rem 0.75rem;
        outline: 1px solid #89b3e2;
        color: #bbb5b5;
        border: #000;
        border-radius: 3px;
        width: 80%;

    }
    .table_background{
        background:#0b5dbb;
        color:white;
    }

    @media (max-width: 375px) {

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
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1,
                        'month').endOf('month')]
                },
                opens: 'right'
            },
            function (start, end, label) {
                from = start.format('YYYY-MM-DD');
                to = end.format('YYYY-MM-DD');
                var client = $('#sales').val();
                $.ajax({
                    type: "get",
                    url: "{{route('supplier.supplierperfomance')}}",
                    data: {
                        id:client,
                        start:from,
                        end:to,
                    },
                    dataType: "json",
                    success :function(res){
                       console.log(res);
                       $(".total_cost").html(res.supplier_cost);
                       $('.total_supplier').html(res.total_supplier);
                    }
                })
            });
    });

</script>

<script>
//total supplier
    $(function () {
      var startdate='';
      var enddate='';
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
       }); 
        var table = $('#table').DataTable({
             processing: true,
             serverSide: true, dom: "'<'row pl-3 pr-3 dt_head'<'col-md-8 pl-0'<'table_head'>><'p-0'f><'col-md-4 d-flex flex-row-reverse p-0'B>>" +"<'row pl-3 pr-3 table-responsive'<'col-sm-12 p-0'tr>>" +"<'row footer_padding'<'col-md-12'>>"+"<'row pl-3 pr-3'<'col-sm-5'i><'col-sm-7'p>>",
            "language": {
             processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
             serverSide: true,
             paging: true,
     
             ajax: {
                 type: "get",
                "url":"{{route('supplier.performance_filter')}}",
                "data":function(data){
                  data.sales=$("#sales").val();
                  data.daterange=$('#daterange').val();
                 },
             },
     
             columns: [
                      {data: 'rfq_no', name: 'rfq_no'},
                      {data: 'supplier_company', name: 'supplier_company'},
                      {data: 'supplier_manager', name: 'supplier_manager'},
                      {data: 'supplier_email', name: 'supplier_email'},
                      {data: 'supplier_phone', name: 'supplier_phone'},
                      {data: 'supplier_whatsapp', name: 'supplier_whatsapp'},
                      {data: 'supplier_country', name: 'supplier_country'},
                      {data: 'other_detail', name: 'other_detail'},
                      
                 {data:'',
                         render:(data,type,row)=>{
                         return ` <a href='/supplier/supplier_performance_view/${row.id}'  class="mdi mdi-eye"></a>`     
                         },
                 },
             ],
              "lengthMenu":[
                    [5,25,50,-1],
                    [5,10,15,"All"]
                ],
        });
        
        $('#daterange').change(function(){
          table.draw();
        });
        $("#sales").change(function(){
            table.draw();
        });
     
    });
 
</script>
 <!--total_cost_function -->

    
    


<script>

    $(document).on('click','.my-supplier',function(){
         $('#doctor-table').removeClass('d-none');
         $('#new-table').addClass('d-none');
     });
     $(document).on('click','#back',function(){
       $('#doctor-table').addClass('d-none');
        $('#new-table').removeClass('d-none');
     });
</script>
{{-- For date range picker --}}


<div class="chart-title">
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <h4 class="card-title float-left">Supplier Name</h4>
                <select class="form-control label-gray-3 sales" name="sales" id="sales"
                    style="outline: 1px solid #89b3e2 !important;">
                    <option class="label-gray-3"  disabled selected>Select Supplier Name</option>
                    <option value="{{$all}}">All</option>
                    @if(count($supplier_detail) > 0)
                    @foreach($supplier_detail as $v)
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


<div class="container mt-3">
    <div class="content-wrapper"id="new-table">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    
                     <div class="col-md-4">
                        <div class="my-supplier"
                            style="background-color: #b5ab31  !important; padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
                            <h5>Total Supplier</h5>
                            <h2> <label for="" value="" class="total_supplier">0</label></h2>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="my-client"
                            style="background-color: #0075f2 !important; padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
                            <h5>Total Cost Request</h5>
                            <h2> <label for="" value="" class="total_cost">0</label></h2>
                         </div>
                    </div>

                   
                </div>
            </div>
        </div>
    </div>
</div>

<div class="conatainer">
    <div class="table-responsive col-md-12 d-none" id="doctor-table">
            <table class="table-hover" id="table" >
                <thead>
                    <tr class="table_background" >
                        <th>RFQ No</th>
                        <th>Supplier Company Name</th>
                        <th>Supplier Manager</th>
                        <th>Supplier Email</th>
                        <th>Supplier Phone  </th>
                        <th>Supplier Whatsapp</th>
                        <th>Country</th>
                        <th>Other_detail</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                <tr>
                </tr>    
                </tbody>  
            </table>
        <button class="btn btn-success" id="back">Back</button>
    </div>
</div>


@endsection

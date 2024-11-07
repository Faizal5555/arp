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
    tr.table_background {
    background-color: #0b5dbb;
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
                    url: "{{route('datacenter.bydoctor')}}",
                    data: {
                        id:client,
                        start:from,
                        end:to,
                    },
                    dataType: "json",
                    success :function(res){
                       console.log(res);
                       $(".total_doctors").html(res.datcenter_doctor_total);
                    }
                })
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
    var table = $('#table').DataTable({
      dom: 'Blfrtip',
       "lengthMenu": [ [10, 25, 50,75,100, -1], [10, 25, 50,75,100, "All"] ],
      buttons: [
                 {
                extend: 'excelHtml5',
                text: 'Export',
                exportOptions: {
                  columns: [0,1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16]
                },
            },
            ],
     processing: true,
 
     serverSide: true,
 
     ajax: {
        "url":"{{route('performancefilter')}}", 
        "data":function(data){
          data.sales=$("#sales").val();
          data.daterange=$('#daterange').val();
        },
     },
 
     columns: [
         { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
         
         {data:'pno',name:'pno'},
             
         {data: 'firstname', name: 'firstname'},
 
         {data: 'lastname', name: 'lastname'},
 
         {data: 'cityname', name: 'cityname'},
 
         {data: 'citycode', name: 'citycode'},
         @if(auth()->user()->user_type == 'admin')
         {data: 'PhNumber', name: 'PhNumber'},
         @endif
         @if(auth()->user()->user_type == 'admin')
         {data: 'email', name: 'email'},
         @endif
 
         {data: 'whatdsappNumber', name: 'whatdsappNumber'},
         
 
        //  {data: 'docterSpeciality', name: 'docterSpeciality'},
 
        //  {data: 'totalExperience', name: 'totalExperience'},
 
        //  {data: 'practice', name: 'practice'},
 
        //  {data: 'licence', name: 'licence'},
 
        //  {data: 'PatientsMonth', name: 'PatientsMonth'},
 
        //  {data: 'country1', name: 'country1'},
 
        // //  {data: 'document', name: 'document'},
         
        // {data: 'document',  render:(data,type,row)=>{
        //     if(row.document!=null){
        //          return `${row.document}`     
        //     }else{
        //     return "----"
        //     }
        //          }},
 
        //  {data: 'profile_image',  render:(data,type,row)=>{
        //     if(row.profile_image!=null){
        //          return `${row.profile_image}`     
        //     }else{
        //     return "----"
        //     }
        //          }},

          
         {data:'',
                 render:(data,type,row)=>{
                 return `<a href='/datacenter/view/doctor/${row.id}'><i class="fa fa-eye"></i></a>`     
                 }
        }
     ]
 });
        $('#daterange').change(function(){
          table.draw();
        });
        $("#sales").change(function(){
            table.draw();
        });
 });
 $(document).on('click','.my-client',function(){
     $('#doctor-table').removeClass('d-none');
     $('#new-find').addClass('d-none');
 });
 $(document).on('click','#back',function(){
     $('#doctor-table').addClass('d-none');
     $('#new-find').removeClass('d-none');
 })
</script>

{{-- For date range picker --}}


<div class="chart-title">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <h4 class="card-title float-left">Datacenter Person Name</h4>
                <select class="form-control label-gray-3 sales" name="sales" id="sales"
                    style="outline: 1px solid #89b3e2 !important;">
                    <option class="label-gray-3"  disabled value="">Select Datacenter Person Name</option>
                    
                    <option class="label-gray-3" value="{{$all2}}">All</option>
                    @if(count($datacenter_total) > 0)
                    @foreach($datacenter_total as $v)

                    <option value="{{$v->id}}">{{$v->name}}</option>
                    @endforeach
                    @endif
                </select>
            </div>
            <div class="col-md-5">
                <h4 class="card-title">Date</h4>
                <input type="text" id="daterange" /><br><br>
                <input type="hidden" name="range_start" id="range_start">
               <input type="hidden" name="range_end" id="range_end">
            </div>
        </div>
    </div>
</div>



<div class="container mt-2">
    <div class="content-wrapper" id="new-find">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <div class="my-client"
                            style="background-color: #0075f2 !important; padding: 10px; color: #ebedf2; margin-bottom: 12px; margin-top: 30px;">
                            <h5 style='text-align:center;'>Total Doctors</h5>
                            <h2 style='text-align:center;'> <label for="" value="" class="total_doctors">0</label></h2>
                        </div>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
        </div>
    </div>
</div>

  <div class="table-responsive col-md-12 d-none" id="doctor-table">
                        <table class="table-hover" id="table" >
                            <thead>
                                <tr class="table_background" >
                                    <th>S.No</th>
                                    <th>RNOD</th>
                                    <th>First Name</th>
                                    <th>Last Name</th>
                                    <th>City Name</th>
                                    <th>City Code</th>
                                     @if(auth()->user()->user_type == 'admin')
                                    <th>Phone </th>
                                    <th>Email</th>
                                    @endif
                                    <th>Whatsapp </th>
                                    <!--<th>Doctor Speciality </th>-->
                                    <!--<th>Experience</th>-->
                                    <!--<th>Practice</th>-->
                                    <!--<th>licence</th>-->
                                    <!--<th>Patients Month</th>-->
                                    <!--<th>Country</th>-->
                                    <!--<th>Document</th>-->
                                    <!--<th>Profile</th>-->
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                            </tr>    
                            </tbody>  
                        </table>
                        
                        <button class="btn btn-success" id="back">Back</button>
                    </div>






@endsection
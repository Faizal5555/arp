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

    /*margin-right: -39px;*/
}
a.ml-2.card-title {
padding: 29px;
}
a.ml-2.btn.btn-primary {
    /* margin-left: -3px; */
    margin: 10px;
}
.my-row {
    background-color: #0b5dbb;
}
.card {
    margin-left: 7px;
}
select.custom-select.custom-select-sm.form-control.form-control-sm {
    margin: 11px;
    color: #000;
}
select.custom-select.custom-select-sm.form-control.form-control-sm {
    padding-left: 10px;
    padding-right: 26px;
}
div#bid-table_filter {
    margin-top: 50px;
}
input#rfq_no {
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
}
input#client_id {
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
}
input#date {
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
}
input#industry{
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
}
input.form-control.form-control-sm {
    margin-top: 25px;
}

/*next table follow up css*/
 label.mb-0.expired {
    background-color: #c82333;
    border-color: #bd2130;
    padding: 13px;
    border-radius: 20px;
}
label.mb-0.not-expired {
    background: #198ae3;
    border-color: #198ae3;
    padding: 13px;
    border-radius: 20px;
}
/*end table next follow up css*/

select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
}
svg.svg-inline--fa.fa-eye {
    color: #171616;
    font-size: 16px;
    margin-bottom: 4px;
}
    </style>
@section('page_title', 'BidRfq List')
@section('content')
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script type="text/javascript">

    $(document).ready(function(){
       $("#export_btn").click(function(){
         $('.dt-button.buttons-excel.buttons-html5').trigger('click');
       })
   })
   
    $(function () {
        console.log($('#bid-table').length);
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
     });


    //  $('#bid-table thead th').each( function () {
    //     var title = $('#bid-table thead th').eq( $(this).index() ).text();
    //     $(this).html( '<input type="text" placeholder="Search '+title+'" />' );
    // } );
     var table = $('#bid-table').DataTable({
          dom: 'Blfrtip',
        "lengthMenu": [ [10, 25, 50,75,100, -1], [10, 25, 50,75,100, "All"] ],
        buttons: [
                 {
                extend: 'excelHtml5',
                text: 'Export',
                exportOptions: {
                  columns: [0,1,2,3,4,5,6]
                },
            },
            ],
        //  dom: "'<'row pl-3 pr-3 dt_head'<'col-md-8 pl-0'<'table_head'>><'p-0'f><'col-md-4 d-flex flex-row-reverse p-0'B>>" +"<'row pl-3 pr-3 table-responsive'<'col-sm-12 p-0'tr>>" +"<'row footer_padding'<'col-md-12'>>"+"<'row pl-3 pr-3'<'col-sm-5'i><'col-sm-7'p>>",
         "language": {
         processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
         processing: true,
         serverSide: true,
         
        //  "initComplete": function( settings, json ) {
        //     $('.expired').parent('td').parent('tr').css('background-color','red');
        //     $('.not-expired').parent('td').parent('tr').css('background-color','blue');

        // },
        // "fnDrawCallback": function( oSettings ) {
        //     $('.expired').parent('td').parent('tr').css('background-color','red');
        //     $('.not-expired').parent('td').parent('tr').css('background-color','blue');

        // },
         ajax: {
                "url":"{{ route('bidrfq.index') }}",
               
                'data': function(data){
                   data.rfq_no=$('#rfq_no').val();
                     data.client_id=$('#client_id').val();
                     data.industry=$('#industry').val();
                     data.startdate=$('#start').val();
                     data.enddate=$('#end').val();
                 }
               },
         columns: [
             {data: 'rfq_no',  name: 'rfq_no'},
             {data: 'industry', name: 'industry'},
             {data: 'vendor_id', "render": function (data, type,row) {
                var data = data.replaceAll('[','');
                data = data.replaceAll(']','');
                data = data.replaceAll('&quot;','');
                console.log(data);
                return data;
            }},
            {data: 'client_id', "render": function (data, type,row) {
                var data = data.replaceAll('[','');
                data = data.replaceAll(']','');
                data = data.replaceAll('&quot;','');
                console.log(data);
                return data;
            }},
             {data:'date'  ,name:'date'},
             {data:'industry',name:'industry'},
            //  {data:'country'  ,name:'country'},
            //  {data:'sample_size'  ,name:'sample_size'},
            //  {data: 'setup_cost', name: 'setup_cost'},
            //  {data:'recruitment'  ,name:'recruitment'},
            //  {data:'incentives'  ,name:'incentives'},
            //  {data:'moderation'  ,name:'moderation'},
            //  {data:'transcript'  ,name:'transcript'},
            //  {data:'others'  ,name:'others'},
            //  {data: 'total_cost', name: 'total_cost'},
             { data: 'follow_up_date', 
                "render": function ( data, type, row ) {

                    if(row.type == "next")
                    {
                        var val = compare_date(row.follow_up_date);
                        if(val == 1)
                        {
                            return '<label class="mb-0 expired">'+row.follow_up_date+'</label>';
                        }
                        return '<label class="mb-0 not-expired">'+row.follow_up_date+'</label>';
                    }else{
                        return '<label class="mb-0 not-expired">'+row.follow_up_date+'</label>';
                    }
                } 
            },
            {data:'',
                render: (data,type,row) => {
                        return `<div class="text-center">
                                    <div class="list-icons ">
                                         <a href='/adminapp/bidrfq/pdfview/${row.id}' class='mdi mdi-table-download'><i class="fa-solid fa-eye"></i></a>
                                       
                                        <a href='/adminapp/bidrfq/edit/${row.id}' class='mdi mdi-table-edit'></a>
                                         

                                         @if(auth()->user()->user_type == 'admin')
                                            <a href='/adminapp/bidrfq/delete/${row.id}'  class='mdi mdi-delete'></a>
                                          @endif 
                                        </div>
                                    </div>
                                </div>`;
                        }},
            ],
            "lengthMenu":[
                [5,10,15,-1],
                [5,10,15,"All"]
            ],
     });

     $(document).on('change','#client_id', function(){
            table.draw();
        });
        
        $(document).on('change','#industry',function(){
            table.draw();
        });

        $(document).on('keyup','#rfq_no',function(){
           table.draw();
        });
        $(document).on('change','#start',function(){
            table.draw();
        });
        $(document).on('change','#end',function(){
            table.draw();
        });
    });
    
    function compare_date(date){
    var varDate = new Date(date); //dd-mm-YYYY
    var today = new Date();
    today.setHours(0,0,0,0);
    if(varDate <= today) {
        return 1;
    }
    else{
        return 0;
    }
}
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">RFQ List</a>
                    <a href="{{route('bidrfq.create')}}" class="ml-2 btn btn-primary">Add</a>
                </div>
                 <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                <div class="input-group" >
                                    {{-- <div>
                                        <input class="form-control border-end-0 border rounded-pill"  id="myInput" onkeyup="myFunction()" type="text" name="search" placeholder="search" id="example-search-input">
                                    </div> --}}
                                </div>
                            </div>
                
                            <div class="table table-responsive">
                                  <div class="container">  
                            <div class="row">
                                <div class="container">
                                <div class="col-md-12">
                                <div class="export-option mt-2">
                                <button type="button" class="btn btn-primary float-right " id="export_btn" >Export</button>
                                </div>
                                <div class="row">
                               
                                <div class="col-md-3 mt-5">
                                    <label class="fcol-lg-3 col-form-label font-weight-semibold"> <span>RFQ No</span></label>
                                    <input type='text' id='rfq_no' placeholder='Search RFQ No' class="form-control" name='rfq_no' autocomplete='off'>
                                       
                                        </label>
                                </div>

                                   <div class="col-md-3 mt-5">
                                        <label class="col-lg-3 col-form-label">Industry<span
                                                class="text-danger"></span> </label>
                                      
                                            <select class="form-control label-gray-3" name="industry" id="industry" placeholder="Select Industry">
                                                <option class="label-gray-3" value=""disabled selected>Select Industry</option>
                                                <option>Manufacturing Industry</option>
                                                <option>Production Industry</option>
                                                <option>Food Industry</option>
                                                <option>Agricultural Industry</option>
                                                <option>Technology Industry</option>
                                                <option>Construction Industry</option>
                                                <option>Factory Industry</option>
                                                <option>Mining Industry</option>
                                                <option>Finance Industry</option>
                                                <option>Retail Industry</option>
                                                <option>Engineering Industry</option>
                                                <option>Marketing Industry</option>
                                                <option>Education Industry</option>
                                                <option>Transport Industry</option>
                                                <option>Chemical Industry</option>
                                                <option>Healthcare Industry</option>
                                                <option>Hospitality Industry</option>
                                                <option>Energy Industry</option>
                                                <option>Science Industry</option>
                                                <option>Waste Industry</option>
                                                <option>Chemistry Industry</option>
                                                <option>Teritiary Sector Industry</option>
                                                <option>Real Estate Industry</option>
                                                <option>Financial Services Industry</option>
                                                <option>Telecommunications Industry</option>
                                                <option>Distribution Industry</option>
                                                <option>Medical Device Industry</option>
                                                <option>Biotechnology Industry</option>
                                                <option>Aviation Industry</option>
                                                <option>Insurance Industry</option>
                                                <option>Trade Industry</option>
                                                <option>Stock Market Industry</option>
                                                <option>Electronics Industry</option>
                                                <option>Textile Industry</option>
                                                <option>Computers and Information Technology Industry</option>
                                                <option>Market Research Industry</option>
                                                <option>Machine Industry</option>
                                                <option>Recycling Industry</option>
                                                <option>Information and Communication Technology Industry</option>
                                                <option>E- Commerce Industry</option>
                                                <option>Research Industry</option>
                                                <option>Rail Transport Industry</option>
                                                <option>Food Processing Industry</option>
                                                <option>Small Business Industry</option>
                                                <option>Wholesale Industry</option>
                                                <option>Pulp and Paper Industry</option>
                                                <option>Vehicle Industry</option>
                                                <option>Steel Industry</option>
                                                <option>Renewable Energy Industry</option>
                                            </select>
                                            
                                       
                                        </div>


                                        <div class="col-md-3 mt-5">
                                            <label class="fcol-lg-3 col-form-label font-weight-semibold"> <span>Client Name</span></label>
                                            <select class="form-control label-gray-3" name="client_id" id="client_id">
                                                <option class="label-gray-3" value="">Client</option>
                                                    @if(count($client) > 0)
                                                    @foreach($client as $v)
                                                <option value="{{$v->client_name}}">{{$v->client_name}}</option>
                                               
                                                    @endforeach
                                                    @endif
                                            </select>
                                           
                                            </label></td>
                                        </div>
                                   


                                    <div class="col-md-3 mt-5">
                                        <div class='bid-date'>
                                        <label class="fcol-lg-3 col-form-label font-weight-semibold"> <span>Date</span></label>
                                       
                                     <input type="date" class="input-sm form-control" name="start" id="start"  />
                                    </div>
                                     <div class="date-end">
                                        <span class="input-group-addon">to</span>
                                    <input type="date" class="input-sm form-control" name="end" id="end" />
                                     </div>
                                        
                                    </div>

                                           
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <table class="table table-hover table1 table-responsive" id="bid-table">
                                <thead>
                                    <tr class="my-row">
                                        <th>RFQ No </th>
                                        <th>Industry</th>
                                        <th>Vendor Name</th>
                                        <th>Client Name</th>
                                        <th>Date</th>
                                        <th>Industry</th>
                                        <!--<th>Country Name</th>-->
                                        <!--<th>Sample Size</th>-->
                                        <!--<th>Setup Cost</th>-->
                                        <!--<th>Recruitment</th>-->
                                        <!--<th>Incentives</th>-->
                                        <!--<th>Moderation</th>-->
                                        <!--<th>Transcript</th>-->
                                        <!--<th>Others</th>-->
                                        <!--<th>Total Cost</th>-->
                                        <th>Follow Up Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
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
    div#bid-table_filter {
    margin-top: 50px;
    display: none;
   }
  .row.pl-3.pr-3.table-responsive {
    margin-top: 33px;
  }
  label.col-lg-3.col-form-label {
    display: flex;
  }
  select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
  }
  input#start {
    outline: 1px solid #0b5dbb!important;
    border-radius: 23px;
  }
 input#end {
    outline: 1px solid #0b5dbb!important;
    border-radius: 23px;
  }
  div#bid-table_wrapper {
    margin-top: 10px;
  }
  /*datatable export btn*/
  button.dt-button.buttons-excel.buttons-html5 {
     border: 1px solid #0b5dbb !important;
    border-radius: 7px !important;
    color: #0b5dbb !important;
    font-family: unset !important;
    width: 76px  !important;
    height: 39px !important ;
    margin-bottom:25px;
    
    }
     button.dt-button.buttons-excel.buttons-html5:hover{
         background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
         color: white !important;
         
     }
     .dt-buttons{
    display:flex !important;
    justify-content:flex-end !important;
   }
  .dt-buttons{
    visibility: hidden;
  }
/*datatable export btn*/
</style>
@endpush
@section('script')






@endsection

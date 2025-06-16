@extends('layouts.master')
<style>
    label.col-lg-3.col-form-label {
    display: flex;
}
.card-header.header-elements-inline {
    background-color: #0b5dbb;
    color: #fff;
}
div#lost-table_filter {
    display: none;
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
select.won-drop {
    padding: 10px 83px 10px 39px;
    margin: 10px;
}
label.col-lg-3.col-form-label {
    display: flex;  
}
.row.pl-3.pr-3.table-responsive {
    margin-top: 33px;
}
select.custom-select.custom-select-sm.form-control.form-control-sm {
    padding-left: 10px;
    padding-right: 26px;
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
  div#lost-table_wrapper {
    margin-top: 15px;
}
tr {
    background-color: #0b5dbb;
}
</style>
@section('page_title', 'Lost Project List')
@section('content')
<script type="text/javascript">
     $(function () {
        
        $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
   });
   var table = $('#lost-table').DataTable({
    "language": {
        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
        processing:true,
        serverSide:true,
        paggind:true,
        ajax:{
            "url":"{{route('bidrfq.lostproject')}}",
            'data':function(data){
                data.rfq_no=$('#rfq_no').val();
                console.log(data.rfq_no);
                data.industry=$('#industry').val();
                console.log(data.industry);
                data.start_date = $('#start').val();
                data.end_date =$('#end').val();
            },
        },
        columns:[
            {data:'rfq_no',name:'rfq_no'},
            {data:'date'  ,name:'date'},
            {data:'follow_up_date',name:'follow_up_date'},
            {data:'industry',name:'industry'},
            {data:'comments',name:'comments'},
            {data:'',
             render:(data,type,row)=>{
                return `<a href="" class="tablinks btn btn-gradient-danger btn-rounded btn-fw">lost</a>`
             }},
            {data:'',
             render:(data,type,row)=>{
                 
                 return `<a class="d-flex justify-content-center align-items-center mt-3"href='/adminapp/lostproject/view/${row.id}'><i class="fa fa-eye"></i></a>` 
             }}
        ],
        "lengthMenu":[
                [5,10,15,-1],
                [5,10,15,"All"]
            ],


   });
   $(document).on('keyup','#rfq_no',function(){
       table.draw();
   });
   $(document).on('change','#industry',function(){
        table.draw();
   });
   $(document).on('change','#client_id',function(){
        table.draw();
   });
   $(document).on('change','#start',function(){
       table.draw();
   });
   $(document).on('change','#end',function(){
       table.draw();
   });
   
  });
</script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Lost Project</a>
                    {{-- <a href="{{route('bidrfq.create')}}" class="ml-2 btn btn-gradient-info btn-fw">Add</a> --}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                              
                            </div>

                            <div class="table-responsive">

                                 <div class="container">  
                                    <div class="row">
                                        <div class="container">
                                        <div class="col-md-12">
                                        <div class="row">
                                       
                                        <div class="col-md-3">
                                            <label class="fcol-lg-3 col-form-label font-weight-semibold"> <span>RFQ No</span></label>
                                            <input type='text'  id='rfq_no' placeholder='Search RFQ No' class="form-control" name='rfq_no' autocomplete='off'>
                                               
                                                </label>
                                        </div>
        
                                           <div class="col-md-3">
                                                <label class="col-lg-3 col-form-label">Industry<span
                                                        class="text-danger"></span> </label>
                                              
                                                    <select class="form-control" name="industry" id="industry">
                                                        <option class="label-gray-3" value="" selected>Select
                                                            Industry
                                                        </option>
                                                        <option value="Gen-Pop">Gen-Pop</option>
                                                        <option value="Manufacturing Industry">Manufacturing Industry</option>
                                                        <option value="Production Industry">Production Industry</option>
                                                        <option value="Food Industry">Food Industry</option>
                                                        <option value="Agricultural Industry">Agricultural Industry</option>
                                                        <option value="Technology Industry">Technology Industry</option>
                                                        <option value="Construction Industry">Construction Industry</option>
                                                        <option value="Factory Industry">Factory Industry</option>
                                                        <option value="Mining Industry">Mining Industry</option>
                                                        <option value="Finance Industry">Finance Industry</option>
                                                        <option value="Retail Industry">Retail Industry</option>
                                                        <option value="Engineering Industry">Engineering Industry</option>
                                                        <option value="Marketing Industry">Marketing Industry</option>
                                                        <option value="Education Industry">Education Industry</option>
                                                        <option value="Transport Industry">Transport Industry</option>
                                                        <option value="Chemical Industry">Chemical Industry</option>
                                                        <option value="Healthcare Industry">Healthcare Industry</option>
                                                        <option value="Hospitality Industry">Hospitality Industry</option>
                                                        <option value="Energy Industry">Energy Industry</option>
                                                        <option value="Science Industry">Science Industry</option>
                                                        <option value="Waste Industry">Waste Industry</option>
                                                        <option value="Chemistry Industry">Chemistry Industry</option>
                                                        <option value="Teritiary Sector Industry">Teritiary Sector Industry</option>
                                                        <option value="Real Estate Industry">Real Estate Industry</option>
                                                        <option value="Financial Services Industry">Financial Services Industry
                                                        </option>
                                                        <option value="Telecommunications Industry">Telecommunications Industry
                                                        </option>
                                                        <option value="Distribution Industry">Distribution Industry</option>
                                                        <option value="Medical Device Industry">Medical Device Industry</option>
                                                        <option value="Biotechnology Industry">Biotechnology Industry</option>
                                                        <option value="Aviation Industry">Aviation Industry</option>
                                                        <option value="Insurance Industry">Insurance Industry</option>
                                                        <option value="Trade Industry">Trade Industry</option>
                                                        <option value="Stock Market Industry">Stock Market Industry</option>
                                                        <option value="Electronics Industry">Electronics Industry</option>
                                                        <option value="Textile Industry">Textile Industry</option>
                                                        <option value="Computers and Information Technology Industry">Computers and
                                                            Information Technology Industry</option>
                                                        <option value="Market Research Industry">Market Research Industry</option>
                                                        <option value="Machine Industry">Machine Industry</option>
                                                        <option value="Recycling Industry">Recycling Industry</option>
                                                        <option value="Information and Communication Technology Industry">
                                                            Information and Communication Technology Industry</option>
                                                        <option value="E- Commerce Industry">E- Commerce Industry</option>
                                                        <option value="Research Industry">Research Industry</option>
                                                        <option value="Rail Transport Industry">Rail Transport Industry</option>
                                                        <option value="Food Processing Industry">Food Processing Industry</option>
                                                        <option value="Small Business Industry">Small Business Industry</option>
                                                        <option value="Wholesale Industry">Wholesale Industry</option>
                                                        <option value="Pulp and Paper Industry">Pulp and Paper Industry</option>
                                                        <option value="Vehicle Industry">Vehicle Industry</option>
                                                        <option value="Steel Industry">Steel Industry</option>
                                                        <option value="Renewable Energy Industry">Renewable Energy Industry</option>
                                                    </select>
                                               
                                                </div>
        
        
                                                <div class="col-md-3">
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
                                           
        
        
                                            <div class="col-md-3">
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
                                
                            <table class="table datatable-button-html5-columns table1 table-hover" id="lost-table">
                                <thead>
                                    <tr>
                                        <th>RFQ No </th>
                                        <th>Date</th>
                                        <th>Follow Up Date</th>
                                        <th>Industry</th>
                                        <th>Comments</th>
                                        <th>Status</th>
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

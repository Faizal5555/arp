@extends('layouts.master')
<style>
    .main-panel {
    background-color: #f8f8f8;
   }
.card {
   margin: 40px 0 20px 0;
    border:none;
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
    background-color: #0b5dbb;
    border-color: #0b5dbb;
}
button#addRegisterButton:hover {
    background-color: #0b5dbb;
    border-color: #0b5dbb;

}
.card-header.header-elements-inline {
  background: linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: #fff;
}
.sub-text {
    color: #fff;
}
a.ml-2.btn.btn-primary {
    float: right;
    background: #fff;
    color: #0b5dbb;
}
input#supplier_company {
    border-radius: 33px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
}
input#supplier_manager{
    border-radius: 33px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px; 
}
select#supplier_country{
    outline: 1px solid #0a51a4;
   border-radius: 21px;
}
 input#daterange {
   outline: 1px solid #0a51a4;
   border-radius: 21px;
   }
div.dataTables_wrapper div.dataTables_filter {
    text-align: right;
    display: none;
}
a.mdi.mdi-table-edit {
    font-size: 24px;
}
a.mdi.mdi-delete {
    color: red;
    font-size: 24px;
}
a.mdi.mdi-eye {
    font-size: 24px;
}
.row.pl-3.pr-3.dt_head {
    margin-bottom: 34px;
}


/*.form-group{
  padding:10px;
  border:2px solid;
  margin:10px;
}
.form-group>label{
  position:absolute;
  top:-1px;
  left:20px;
  background-color:#aaa;
}

.form-group>input{
  border:none;
}*/
.style{
        background: #1463bd !important;
    color: white !important;
}



</style>
@section('page_title')
@section('content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<script type="text/javascript">
 $(function () {
      var startdate='';
        var enddate='';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });


      var table = $('#supplier-table').DataTable({
            dom: "'<'row pl-3 pr-3 dt_head'<'col-md-8 pl-0'<'table_head'>><'p-0'f><'col-md-4 d-flex flex-row-reverse p-0'B>>" +"<'row pl-3 pr-3 table-responsive'<'col-sm-12 p-0'tr>>" +"<'row footer_padding'<'col-md-12'>>"+"<'row pl-3 pr-3'<'col-sm-5'i><'col-sm-7'p>>",
        "language": {
        processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
         processing: true,
         serverSide: true,
         paging: true,
         
           
          ajax: {
              
              "url":"{{ route('Supplier.index') }}",
               'data': function(data){
                data.supplier_company=$('#supplier_company').val();
                data.supplier_country=$('#supplier_country').val();
                data.supplier_manager=$('#supplier_manager').val();
                
                 data.startdate=startdate,
                data.enddate=enddate
                  // Read values
                  var option = '';

                  if($('input[name="filter"]')){
                    var col = $('#includes').val();
                    data.column = col;
                  }

                  $("th[id^='includes']").css({'display':'none;'});

                //   $('.table_head td input,.table_head td select').each(function(){
                //         data[$(this).attr('id')] = $('#'+$(this).attr('id')).val();
                //     });
                }
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
              
              {data: '', 
                    render: (data,type,row) => {
                        return `<div class="text-center">
                                    <div class="list-icons ">
                                        <a href='/supplier/supplier_view/${row.id}'  class="mdi mdi-eye"></a>
                                        <a href='/Supplier/edit/${row.id}' class='mdi mdi-table-edit'></a>
                                        
                                        @if(auth()->user()->user_type == 'admin')
                                        <a href='/Supplier/delete/${row.id}' class='mdi mdi-delete'></a>
                                        @endif
                                      
                                        </div>
                                    </div>
                                </div>`;
                        }},
            ],
            "lengthMenu":[
                [5,25,50,-1],
                [5,10,15,"All"]
            ],
          
      });
    //   $('.table_head').html("<table><tr><td><input type='text' id='supplier_company' placeholder='Search Supplier Company' name='supplier_company' autocomplete='off'> <td><input type='text' id='supplier_manager' placeholder='Search Supplier Manager' name='supplier_manager' autocomplete='off'></td> <td><input type='text' id='supplier_country' placeholder='Search Supplier Country' name='supplier_country' autocomplete='off'></td> </tr></table>"); 
      
      $(document).on('click', 'input[name="filter"]', function(){
            table.draw();
        });
        // $(document).on('keyup','.table_head td',function(){
        //     table.draw();
        // });

    $(document).on('change','#daterange',function(){
          table.draw();
      });
      $(document).on('keyup','#supplier_company',function(){
          table.draw();
      });
       $(document).on('keyup','#supplier_manager',function(){
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
        'Last 90 Days': [moment().subtract(89, 'days'), moment()],
        'Last year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
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
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Supplier List</a>
                    <a href="{{route('Supplier.create')}}" class="ml-2 btn btn-primary">Add</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row mt-5">
                            
                                
                                        
                           <div class="col-md-3">
                                <label>Supplier Company</label>
                                <input type="text" class="form-control" id="supplier_company" name="supplier_company">
                            </div>
                            <div class="col-md-3">
                                <label>Supplier Manager</label>
                                <input type="text" class="form-control" id="supplier_manager" name="supplier_manager">
                            </div>
                            <div class="col-md-3">
                                <label>Supplier Country</label>
                  
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
                                <label>Date</label>
                                <input type="text" class="form-control" name="daterange"   id="daterange"/>
                            </div>
                            
                        </div>
                            <div class="table-responsive">
                              

                            <table class="table  supplier-table" id="supplier-table">
                                <thead>
                                    <tr class="style">
                                        <th>RFQ No</th>
                                        <th>Supplier Company Name</th>
                                        <th>Supplier Manager</th>
                                        <th>Supplier Email</th>
                                        <th>Supplier Phone</th>
                                        <th>Supplier Whatsapp</th>
                                        <th>Supplier Country</th>
                                        <th>Other Deatils</th>
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

@section('css')
<style>
    .error {
        color: red;
        font-size: 11px;
        font-weight: bold;
    }

</style>
@endsection

@section('scripts')

@endsection

@extends('layouts.master')
<style>
     a.ml-2.btn.btn-primary {
    float: right;
    margin:0 0 10px 0;
}
a.btn.btn-outline-secondary {
    float: right;
    margin-bottom: 20
px
;
    border-color: #b66dff;
}
a.btn.btn-outline-secondary:hover {
    float: right;

    background-color: #b66dff;
}
.main-panel {
    background-color: #f8f8f8;
   }
.card {
   margin: 40px 0 20px 0;
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
a.btn.btn-danger {
    background-color: #fe7c96;
    border-color: #fff;
    float: right;
    margin: 0 0 10px 10px;
}
a.btn.btn-danger:hover {
    background-color: #2a72c4;
    border-color: #fff;
}
a.btn.btn-outline-danger {
    float: right;
}
a.btn.btn-outline-danger:hover
{

    background: #ed252d;
    color:#fff;
}

.card-header.header-elements-inline {
    background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: #fff;
}
a.mdi.mdi-delete {
    font-size: 23px;
    color: #ee2d34;
}
a.mdi.mdi-table-edit {
     font-size: 23px;
}
button.btn.btn-danger {
    float: right;
}
/*.table-responsive {*/
   
/*   overflow: hidden;*/
   
/*}*/
/*.table-responsive {*/
/*    overflow: hidden;*/
/*}*/
nav.flex.items-center.justify-between {
    padding-top: 20px;
    /* float: left; */
}
svg.w-5.h-5 {
    display: none;
}

.hidden.sm\:flex-1.sm\:flex.sm\:items-center.sm\:justify-between {
    padding-top: 17px;
}
nav.flex.items-center.justify-between {
    float: right;
}
input.form-control {
    text-transform: capitalize;
}
tr.my-row {
    background-color: #0b5dbb;
}
.table-responsive {
    overflow: hidden;
}
select.custom-select.custom-select-sm.form-control.form-control-sm {
    padding-right: 25px;
}
select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
}
button.dt-button.buttons-excel.buttons-html5 {
    border: 1px solid #0b5dbb !important;
    border-radius: 7px !important;
    color: #0b5dbb !important;
    font-family: unset !important;
    width: 63px !important;
    height: 32px !important;
    margin-bottom: 25px;
}
button.dt-button.buttons-excel.buttons-html5:hover {
    background: linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: white !important;
}
button.dt-button.buttons-excel.buttons-html5:hover {
    background: linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: white !important;
}
button.dt-button.buttons-excel.buttons-html5 {
    display: none;
}
@if(auth()->user()->user_type == 'admin')
button.dt-button.buttons-excel.buttons-html5 {
    display: block;
}
@endif
    </style>
@section('page_title', 'Vendor List')
@section('content')
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<script type="text/javascript">
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      var table = $('.data-table').DataTable({
          dom: 'Blfrtip',
           buttons: [
                 {
                text:'Export',
                extend: 'excelHtml5',
                exportOptions: {
                  columns: [0,1,2,3,4,5]
                },
            },
            ],
          processing: true,
          serverSide: true,
          ordering: false,
          ajax: "{{route('vendor.index')}}",
          columns: [
            {data:'vendor_name',name:'vendor_name'},
            {data:'vendor_country',name:'vendor_country'},
            {data:'vendor_email',name:'vendor_email'},
            {data:'vendor_manager',name:'vendor_manager'},
            {data:'vendor_phoneno',name:'vendor_phoneno'},
            {data:'vendor_whatsapp',name:'vendor_whatsapp'},
            {data:'',
                 render:(data,typr,row)=>{
                 return `<a href='/adminapp/vendor/edit/${row.id}' class='mdi mdi-table-edit'> </a>
                         @if(auth()->user()->user_type == 'admin')
                        <a id="${row.id}" href="/adminapp/vendor/delete/${row.id}" class="mdi mdi-delete"></a>
                        @endif`   
                  
                 }
                },
          ]
      });
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Vendor List</a>


                </div>
                 @if (count($errors) > 0)
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                      <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-ban"></i> Error!</h4>
                          @foreach($errors->all() as $error)
                          {{ $error }} <br>
                          @endforeach      
                      </div>
                    </div>
                </div>
                @endif
  
                @if (Session::has('success'))
                    <div class="row">
                        
                      <div class="col-md-8 col-md-offset-1">
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <h5>{!! Session::get('success') !!}</h5>   
                        </div>
                      </div>
                    </div>
                @endif
                
                @if (Session::has('fail'))
                <div class="row">
                    <div class="col-md-8 col-md-offset-1">
                      <div class="alert alert-danger alert-dismissible">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                          <h4><i class="icon fa fa-ban"></i>{!! Session::get('fail') !!}</h4>
                      </div>
                    </div>
                </div>
                @endif
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive" >
                                <div>
                                    <a href="{{route('vendor.create')}}" class=" btn btn-danger">Add</a>
                                 
                                    {{-- <a href="{{route('vendor.export')}}" class="btn btn-outline-danger">Import</a> --}}
                                    @if(auth()->user()->user_type == 'admin')    
                                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                                        Import
                                      </button>
                                      @endif
                                      
                                      <!-- Modal -->
                                      <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                          <div class="modal-content">
                                            <div class="modal-header">
                                              <h5 class="modal-title" id="exampleModalLabel">Import</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('vendor.import') }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="file" name="file" accept=".csv" class="form-control" required>
                                                    <br>
                                                    <button class="btn btn-success">Import User Data</button>
                                                    <a href="{{url('/adminapp/public/global_assets/demoexample/demovendor.csv')}}">Example ClientSheet</a>
                                                
                                                </form>
                                            </div>
                                            
                                          </div>
                                        </div>
                                      </div>
                                    
                                </div>
                            <table class="table datatable-button-html5-columns data-table" >
                                <thead>
                                    <tr class="my-row">
                                        <th>Vendor Name</th>
                                        <th>Vendor Country</th>
                                        <th>Vendor Email</th>
                                        <th>Vendor Manager</th>
                                        <th>Vendor Phone No</th>
                                        <th>Vendor WhatsApp No</th>
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
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
@endpush
@section('scripts')



@endsection

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
a.btn.btn-danger {
    background-color: #0b5dbb;
    border-color: #fff;
    float: right;
    margin: 0 0 10px 10px;
}
a.btn.btn-danger:hover {
    background-color: #2a72c4;
    border-color: #fff;
}
button.btn.btn-danger {
    float: right;
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
div.dataTables_wrapper div.dataTables_length select {
    width: 50px !important;
    margin-top: 6px;
}
select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
}

button.dt-button.buttons-excel.buttons-html5{
    border: 1px solid #0b5dbb !important;
    border-radius: 7px !important;
    color: #0b5dbb !important;
    font-family: unset !important;
    width: 76px !important;
    height: 39px !important;
    margin-bottom: 25px;
    
}
button.dt-button.buttons-excel.buttons-html5:hover {
    background: linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: white !important;
}

.dt-buttons{
    visibility: hidden;
}

    .note-editor.note-frame {
        width: 100% !important;
    }

</style>
@section('page_title')
@section('content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script type="text/javascript">
    $(document).ready(function () {
        // Initialize variables for startdate and enddate
        var startdate = ''; // Empty by default to show all data
        var enddate = '';   // Empty by default to show all data

        // Trigger export button programmatically
        $("#export").click(function () {
            $('.dt-button.buttons-excel.buttons-html5').trigger('click');
        });

        // Set up AJAX headers
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
        });

        // Initialize DataTable
        var table = $('#supplier-table').DataTable({
            dom: 'Blfrtip',
            dom: " lft'<'row pl-3 pr-3 dt_head'<'col-md-8 pl-0'<'table_head'>><'p-0'f><'col-md-4 d-flex flex-row-reverse p-0'B>>" +
                 "<'row pl-3 pr-3 table-responsive'<'col-sm-12 p-0'tr>>" +
                 "<'row footer_padding'<'col-md-12'>>" +
                 "<'row pl-3 pr-3'<'col-sm-5'i><'col-sm-7'p>>",
            language: {
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span>',
            },
            buttons: [
                {
                    text: 'Export',
                    extend: 'excelHtml5',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7],
                    },
                },
            ],
            processing: true,
            serverSide: true,
            paging: true,
            ajax: {
                url: "{{ route('Supplier.index') }}",
                data: function (data) {
                    data.supplier_company = $('#supplier_company').val();
                    data.supplier_country = $('#supplier_country').val();
                    data.supplier_manager = $('#supplier_manager').val();
                    data.startdate = startdate; // Pass startdate to the server
                    data.enddate = enddate;     // Pass enddate to the server
                },
            },
            columns: [
                { data: 'rfq_no', name: 'rfq_no' },
                { data: 'supplier_company', name: 'supplier_company' },
                { data: 'supplier_manager', name: 'supplier_manager' },
                @if(auth()->user()->user_type == 'admin')
                { data: 'supplier_email', name: 'supplier_email' },
                { data: 'supplier_phone', name: 'supplier_phone' },
                { data: 'supplier_whatsapp', name: 'supplier_whatsapp' },
                @endif
                { data: 'supplier_country', name: 'supplier_country' },
                { data: 'other_detail', name: 'other_detail' },
                {
                    data: '',
                    render: (data, type, row) => {
                        return `<div class="text-center">
                                    <div class="list-icons">
                                        <a href='/adminapp/supplier/supplier_view/${row.id}' class="mdi mdi-eye"></a>
                                        <a href='/adminapp/Supplier/edit/${row.id}' class='mdi mdi-table-edit'></a>
                                        @if(auth()->user()->user_type == 'admin')
                                        <a href='/adminapp/Supplier/delete/${row.id}' class='mdi mdi-delete'></a>
                                        @endif
                                          <button class="btn btn-sm btn-primary ml-2 send-email-btn" 
                                                data-id="${row.id}" 
                                                data-name="${row.supplier_company}" 
                                                data-email="${row.supplier_email}">
                                           send email
                                        </button>
                                    </div>
                                </div>`;
                    },
                },
            ],
            lengthMenu: [
                [5, 25, 50, -1],
                [5, 10, 15, "All"],
            ],
        });

        // Event to redraw table when filters change
        $(document).on('keyup change', '#supplier_company, #supplier_manager, #supplier_country', function () {
            table.draw();
        });

        // Initialize daterangepicker
        $('input[name="daterange"]').daterangepicker(
            {
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'Last 45 Days': [moment().subtract(44, 'days'), moment()],
                    'Last 60 Days': [moment().subtract(59, 'days'), moment()],
                    'Last 90 Days': [moment().subtract(89, 'days'), moment()],
                    'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')],
                },
                autoUpdateInput: false, // Prevent input from being pre-filled
            },
            function (start, end, label) {
                // Update startdate and enddate
                startdate = start.format('YYYY-MM-DD');
                enddate = end.format('YYYY-MM-DD');
                table.draw(); // Redraw the table with the updated dates
            }
        );

        // Handle apply button in daterangepicker
        $('input[name="daterange"]').on('apply.daterangepicker', function (ev, picker) {
            $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
            startdate = picker.startDate.format('YYYY-MM-DD');
            enddate = picker.endDate.format('YYYY-MM-DD');
            table.draw(); // Redraw the table
        });

        // Handle cancel button in daterangepicker
        $('input[name="daterange"]').on('cancel.daterangepicker', function () {
            $(this).val(''); // Clear the input field
            startdate = '';  // Reset startdate to empty
            enddate = '';    // Reset enddate to empty
            table.draw();    // Redraw the table to show all data
        });
    });


    $(document).on('click', '.send-email-btn', function () {
    const id = $(this).data('id');
    const name = $(this).data('name');
    const email = $(this).data('email');

    $('#supplier_id').val(id);
    $('#supplier_name').val(name);
    $('#supplier_email').val(email);
    $('#emailContent').summernote('code', '');
    $('#attachment').val('');

    $('#emailModal').modal('show');
});

// Initialize Summernote
$('#emailContent').summernote({
            height: 200,
            placeholder: 'Write your email content here...',
            toolbar: [
                ['style', ['bold', 'italic', 'underline', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['insert', ['link', 'picture']],
                ['view', ['codeview']]
            ]
        });

// Handle form submit
$(document).ready(function() {
$('#supplierEmailForm').on('submit', function (e) {
    e.preventDefault();

    const supplierId = $('#supplier_id').val();
        const emailContent = $('#emailContent').summernote('code').trim();
        const plainText = $('<div>').html(emailContent).text().trim(); // Strip HTML to validate actual content

        // ✅ Validation: check if content is empty
        if (plainText === '') {
            Swal.fire({
                icon: 'warning',
                title: 'Missing Email Content',
                text: 'Please enter email content before sending.',
            });
            $('#emailContent').summernote('focus');
            return;
        }


    let formData = new FormData();
    formData.append('data[0][id]', $('#supplier_id').val());
    formData.append('data[0][content]', $('#emailContent').summernote('code'));

    const file = $('#attachment')[0].files[0];
    if (file) {
        formData.append('data[0][file]', file);
    }

    $.ajax({
        url: "{{ route('supplierMail') }}",
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        beforeSend: function () {
            Swal.fire({
                title: 'Sending...',
                allowOutsideClick: false,
                didOpen: () => Swal.showLoading()
            });
        },
        success: function (response) {
            Swal.fire({
                title: 'Success!',
                text: response.message,
                icon: 'success',
                timer: 3000,
                showConfirmButton: false
            });
            $('#emailModal').modal('hide');
        },
        error: function (xhr) {
            Swal.fire('Error', xhr.responseJSON?.message || 'Something went wrong.', 'error');
        }
    });
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
                    <!--<a  class="ml-2 btn btn-primary">Import</a>-->
                    <!--<a href="{{route('Supplier.create')}}" class="ml-2 btn btn-primary">Add</a>-->
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
                             @foreach(Session::get('fail')  as  $key=> $in)
                             <tr>
                                          <td>{{$in[$key]}}</td>
                             </tr>
                             @endforeach  
                        </div>
                      </div>
                    </div>
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

            


           
            <form action="{{ route('supplier.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
              
                <input type="file" name="file" class="form-control" required>
                <br>
                <button class="btn btn-success">Import Supplier Data</button>
                
                <a href="{{url('global_assets/demoexample/demoSupplier.csv')}}">Example clientsheet</a>
            
            </form>
        </div>
        
      </div>
    </div>
  </div>

                <div class="card-body">
                    <div class="row">
                         <div class="col-md-12" style="display:flex;justify-content:flex-end;">
                             <button type="button" class="btn btn-danger mr-2" data-toggle="modal" data-target="#exampleModal">
                             Import
                            </button>
                            @if(auth()->user()->user_type == "admin")
                            <button type="button" class="btn btn-primary" id="export">Export</button>
                            @endif
                            <a href="{{route('Supplier.create')}}" class="ml-2 btn btn-primary">Add</a>
                              
                            </div>
                        <div class="col-md-12">
                       
                            <div class="row mb-5" style="margin-top: 50px;">
                            
                                
                                        
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
                                        <th>Supplier Name</th>
                                        <th>Supplier Manager</th>
                                         @if(auth()->user()->user_type == 'admin')
                                        <th>Supplier Email</th>
                                        <th>Supplier Phone</th>
                                        <th>Supplier Whatsapp</th>
                                        @endif
                                        <th>Supplier Country</th>
                                        <th>Other Details</th>
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


<div class="modal fade" id="emailModal" tabindex="-1" aria-labelledby="emailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <form id="supplierEmailForm" enctype="multipart/form-data">
          <div class="modal-header">
            <h5 class="modal-title">Send Email to Supplier</h5>
            <button type="button" class="close" data-dismiss="modal">
             X
            </button>
          </div>
          <div class="modal-body">
            <input type="hidden" name="supplier_id" id="supplier_id">
            <div class="form-group mt-3">
              <label>Supplier Name</label>
              <input type="text" id="supplier_name" class="form-control" readonly>
            </div>
            <div class="form-group mt-3">
              <label>Supplier Email</label>
              <input type="email" id="supplier_email" class="form-control" readonly>
            </div>
            <div class="form-group mt-3">
              <label>Email Content</label>
              <textarea id="emailContent" name="emailContent" class="form-control"></textarea>
            </div>
            <div class="form-group mt-3">
              <label>Attachment</label>
              <input type="file" name="attachment" id="attachment" class="form-control">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Send Email</button>
          </div>
        </form>
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

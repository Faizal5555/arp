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

    margin-right: -39px;
}
.card-header.header-elements-inline {
    background: linear-gradient(
43deg
,#0b5dbb,#0b5dbb);
    color: #fff;
}
select.custom-select.custom-select-sm.form-control.form-control-sm {
    margin: 11px;
    color: #000;
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
div.table-responsive>div.dataTables_wrapper>div.row>div[class^="col-"]:last-child{
    display:flex;
    justify-content:center;
    align-items:center;
}
input#daterange{
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
}
input#po_no{
    border-radius: 21px;
    padding: 10px;
    border-color: #0b5dbb;
    margin-right: 18px;
}
 .badge {
        padding: 2px 0px 0px 0px !important;
        position: absolute;
        top: -3px;
        right: 6px;
        width: 18px;
        height: 18px;
        border-radius: 100% !important;
        background: red;
        color: white;
        font-size: 10px;
    }

    .dropdown-content-two {
        display: none;
    }

    .dropdown-content a:hover {
        background-color: #4982C2;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .btnn:hover .dropdown-content-two {
        display: block;
    }
</style>
    
@section('page_title', 'BidRfq List')
@section('content')
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.4/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment-timezone/0.5.43/moment-timezone-with-data.min.js"></script>
<script>
    const currentUserType = "{{ auth()->user()->user_type }}";
</script>
<script type="text/javascript">
    // $(function(){
    //     $.ajaxSetup({
    //        headers: {
    //            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //        }
    //  });
    //  var table=$('#myTable').DataTable({    
    //      processing:true,
    //      serverside:true,
    //      pagging:true,
    //      ajax:{
    //          "url": "{{route('operationNew.index')}}",
    //          columns:[
    //              {data:'project_no',name:'project_no'},
    //              {data:'purchase_order_no',name:'purchase_order_no'}
    //          ],
    //          "lengthMenu":[
    //             [5,25,50,-1],
    //             [5,10,15,"All"]
    //         ],
    //      }
    //  });
    // });
   
    $(function () {
         var startdate='';
         var enddate='';
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      var table = $('.data-table').DataTable({
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
          scrollX: true,
          processing: true,
          serverSide: true,
          order:[0,'desc'],
          ajax: {
              "url":"{{route('operationNew.index')}}",
              'data':function(data){
                data.startdate=startdate,
                data.enddate=enddate,
                data.pno=$('#po_no').val();
                data.status = $('#status').val();
              
              }
              },
          columns: [
            {data:'project_no',name:'project_no'},
            {data:'purchase_order_no',name:'purchase_order_no'},
            {data:'respondent_incentives',name:'respondent_incentives'},
            // {data:'team_leader',name:'team_leader'},
            // {data:'project_manager_name',name:'project_manager_name'},
            // {data:'quality_analyst_name',name:'quality_analyst_name'},
            {data:'project_deliverable',name:'project_deliverable'},
            {data:'country_name',name:'country_name'},
            // {data:'sample_target',name:'sample_target'},
            // {data:'sample_achieved',name:'sample_achieved'},
            { 
            data: 'status', 
            name: 'status',
            render: function(data, type, row) {
                return data === 'hold' ? 'live' : data; 
            }
        },
        {
            data: 'updated_at',
            name: 'updated_at',
            render: function (data, type, row) {
                if (!data) return '-';  // Handle null values
                return moment.utc(data).tz('Asia/Kolkata').format('DD/MM/YYYY hh:mm A');
            }
        },

            {data:'',
            render: (data, type, row) => {
                    let editBtn = `
                        <a href="/adminapp/operationNew/edit/${row.id}" class="btn btn-sm p-1">
                            <i class="mdi mdi-table-edit text-primary" style="font-size: 20px;"></i>
                        </a>
                    `;

                    let deleteBtn = '';
                    if (currentUserType === 'admin') {
                        deleteBtn = `
                            <button type="button" class="btn btn-sm p-1 delete-operation" data-id="${row.id}">
                                <i class="mdi mdi-delete text-danger" style="font-size: 20px;"></i>
                            </button>
                        `;
                    }

                    return `
                        <div class="d-flex align-items-center gap-2">
                            ${editBtn}
                            ${deleteBtn}
                        </div>
                    `;
                }
        }
          ]
      });
      
      $(document).on('keyup','#po_no',function(){
          table.draw();
      })
      $(document).on('change','#daterange',function(){
          table.draw();
      });
      $(document).on('change', '#status', function() {
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
            <div class="card" style="margin-left: 1px;">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Existing Project</a>
                    {{-- <a href="{{route('bidrfq.create')}}" class="ml-2 btn btn-primary">Add</a> --}}
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-flex justify-content-end">
                                {{-- <div class="input-group" >
                                    <div>
                                        <input class="form-control border-end-0 border rounded-pill"  id="myInput" onkeyup="myFunction()" type="text" name="search" placeholder="search" id="example-search-input">
                                    </div>
                                </div> --}}
                            </div>
                            <div class="table-responsive" id="myTable">
                              <div class="row mt-5 mb-3">
                            
                                
                                        
                            <div class="col-md-3">
                                <label>Po No</label>
                                <input type="text" class="form-control" id="po_no" name="po_no">
                            </div>
                            
                            <div class="col-md-3">
                            <label>Date</label>
                            <input type="text" class="form-control" name="daterange" id="daterange">
                            </div>

                            <div class="col-md-3">
                                <label>Status</label>
                                <select class="form-control" id="status" name="status">
                                    <option value="">-- Select Status --</option>
                                    <option value="live">Live</option>
                                    <option value="pause">Pause</option>
                                </select>
                            </div>
                        </div>
                        
                            <table class="table table-hover table1 data-table">
                                <thead>
                                    <tr style="background-color: #0b5dbb !important;">
                                        <th>Project No </th>
                                        <th>Purchase Order No</th>
                                        <th>Respondent Incentives</th>
                                        <!--<th>team_leader</th>-->
                                        <!--<th>project_manager_name</th>-->
                                        <!--<th>quality_analyst_name</th>-->
                                        <th>Project Deliverable</th>
                                        <th>Country Name</th>
                                        <!--<th>sample_target </th>-->
                                        <!--<th>sample_achieved</th>-->
                                        <th>Status</th>
                                        <th>Last Updated At</th> 
                                        <th>Action</th>

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
</style>
@endpush
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    $(document).ready(function() {
  $(document).on('click', '.delete-operation', function () {
    let id = $(this).data('id');
    let url = "{{ route('operationNew.delete', ':id') }}".replace(':id', id);

    Swal.fire({
        title: 'Are you sure?',
        text: 'This will delete the RFQ and all related records!',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#e3342f',
        cancelButtonColor: '#6c757d',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: url,
                type: 'GET',
                success: function (response) {
                    Swal.fire('Deleted!', response.message, 'success');
                    $('.data-table').DataTable().ajax.reload();
                },
                error: function () {
                    Swal.fire('Error!', 'Something went wrong.', 'error');
                }
            });
        }
    });
});
});
</script>


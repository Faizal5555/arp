@extends('layouts.master')
<style>
    a.ml-2.btn.btn-primary {
    float: right;
}
.table1{
    background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
}
a.mdi.mdi-eye {
    color: #0008f7 !important;
    font-size: 20px;
}
.card-header.header-elements-inline {
  background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color:white !important;
}
.inbox {
    outline: 1px solid #0a51a4 !important;
    border-radius: 20px !important;
}
    /*div.dataTables_wrapper div.dataTables_filter input{*/
    /*        border-radius: 10px;*/
    /*        border: 1px solid #0b5dbb;*/
    /*}*/
    div.dataTables_wrapper div.dataTables_length select{
        width:58px !important;
    }
     select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
       }
   select.custom-select.custom-select-sm.form-control.form-control-sm {
    padding-right: 25px;
    margin-top: 4px;
    }
</style>
    
@section('page_title', 'BidRfq List')
@section('content')
<script type="text/javascript">
    
   $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      var table = $('.data-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: {
               "url":"{{route('doctor.list_filder')}}",
               "data":function(data){
                data.pno=$("#po_no").val();
                data.docterSpeciality=$("#speciality").val();
          },
        },
          columns: [
            // {data:'project_no',name:'project_no'},
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data:'pno',name:"pno"},
            {data:'firstname',name:'firstname'},
            {data:'lastname',name:'lastname'},
            {data:'docterSpeciality',name:'docterSpeciality'},
            {data:'totalExperience',name:'totalExperience'},

            {data:'',
                 render:(data,typr,row)=>{
                 return `<p style="color:0b5dbb;" data-doctor_doucument=${row.id}  class='mdi mdi-eye doctor_document'></p>`     
                 }
        }
          ]
      });

      $("#po_no").keyup(function(){
        table.draw();
      })
      $("#speciality").change(function(){
          table.draw();
      })
    });
    
    $(document).on('click','.doctor_document',function(){
       var document_id =$(this).data('doctor_doucument');
    //   alert(document_id);
        $.ajax({
           type:'post',
           url:"{{route('doctor_document_list')}}",
           data:{"document_id":document_id},
           dataType: "json",
           success: function(data){
               if(data.error == 0){
                    swal({
                        title:"No Document fount",
                        icon:'success',
                        button:false
                    })  
                }if(data.success == 1){
                   window.location.href= '/doctor_list/'+data.doctor_doc;
                }    
               
           }
        })
    });
</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Doctor List</a>
                    {{-- <a href="{{route('bidrfq.create')}}" class="ml-2 btn btn-primary">Add</a> --}}
                </div>
                <div class="card-body">
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
                   
                    <div class="row mt-5 mb-4">
                        <div class="col-md-3">
                            <label>RNOD Number</label>
                            <input type="text" class="form-control inbox" id="po_no" name="purchase_order_no">
                        </div>
                        <div class="col-md-3">
                             <label>Speciality</label>
                             <select class="form-control inbox" name="speciality" id="speciality"> 
                              <option value="" disabled selected>Select Speciality</option>
                              @if(count($speciality)>0)
                              @foreach($speciality as $ss)
                              <option value="{{$ss->speciality}}">{{$ss->speciality}}</option>
                              @endforeach
                              @endif
                            </select>
                        </div>
                        <div class="col-md-3">
                            
                        </div>
                        <div class="col-md-3">
                            
                        </div>
                    </div>
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
                                
                            <table class="table  table1 data-table">
                                <thead>
                                    <tr style="color:white;">
                                        <th>Project No </th> 
                                        <th>RNOD Number</th>
                                        <th>First Name</th>
                                        <th>Last Name</th>
                                        <th>Doctor Speciality</th>
                                        <th>Total Experience</th>
                                        {{-- <th>quality_analyst_name</th>
                                        <th>project_deliverable</th>
                                        <th>country_name</th>
                                        <th>sample_target </th>
                                        <th>sample_achieved</th>
                                        <th>Status</th> --}}
                                        <th>View</th>

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
@section('script')
@endsection

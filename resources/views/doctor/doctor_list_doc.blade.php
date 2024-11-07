@extends('layouts.master')
<style>
#image-error {
    color:  #df0000;
}
#document-error {
    color:  #df0000;
}
.table1{
    background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
}
a.mdi.mdi-eye {
    color: #0008f7 !important;
    font-size: 20px;
}
div.dataTables_wrapper div.dataTables_length select{
    width:58px !important;
}
div#document_table_length {
    margin-top: 10px;
}
select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
}
</style>
@section('content')
 
<div class="container mt-4">
    <div class="row">
    <div class="col-md-12">
      <div class="row">
          {{-- <div class="col-md-4">
            <button type="button" class="btn btn-primary " data-toggle="modal" data-target="#exampleModalDocument">
              Add Document
            </button>
          </div> --}}
    </div><br>
      
      <!-- Modal -->
      <div class="modal fade" id="exampleModalDocument" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Upload Documet</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form id="document_upload" enctype='multipart/form-data' >
                    @csrf
                    <input type="hidden" name="docter_id" id="docter_id" value="{{$doctor && $doctor->id ? $doctor->id : '' }}">
                    <span class="text-warning">Only image and pdf files  accepted</span><br><br>
                    <input type="file" name="document" placeholder="Choose document" id="document">
                    <div class="col-md-12 d-flex justify-content-end ">
                        <button type="submit" class=" btn btn-success">Save</button>
                    </div>
                </form>
            </div>
            
          </div>
        </div>
      </div>
      
      
      <div class="row">
        <div class="col-md-11">

      <div class="table table-responsive">
      <table class="table table1 " id="document_table">
        <thead>
            <tr class="my-row">
                <th>S.No</th>
                <th>Document</th>
                <th>Document Type</th>
                <th>View</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
      </div>
        </div>
      </div>
      {{-- <iframe src="{{$url}}/your file path here" width="100%" height="600"></iframe> --}}

</div>

</div>
</div>
{{-- image view modal --}}
{{-- <div class="modal fade" id="ImageView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content">
      {{-- <div class="modal-header">
        {{-- <h5 class="modal-title" id="exampleModalLabel">Documet</h5> --
        
      </div> --
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <img id="document_image" src="" alt="document" height="100%" width="100%">
      </div>
     </div>
  </div>
</div> --}}


{{-- pdf view modal --}}
{{-- <div class="modal fade modal-xl" id="DocumentView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl" role="document">
    <div class="modal-content modal-xl">
      
      <div class="modal-body modal-xl">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <iframe id="document_pdf" src="" width="100%" height="600"></iframe>
      </div>
     </div>
  </div>
</div> --}}



{{-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button> --}}
{{-- Image view modal --}}
<div class="modal fade bd-example-modal-lg" id="ImageView" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
       
      <div class="modal-body">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <img id="document_image" src="" alt="document" height="100%" width="100%">
      </div>
    </div>
  </div>
</div>


{{-- pdf view modal --}}

<div class="modal fade bd-example-modal-lg" id="DocumentView" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body ">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <iframe id="document_pdf" src="" width="100%" height="600"></iframe>
      </div>
    </div>
  </div>
</div>

 
<script >
  
  function check(doc_path,doc_type){
    // alert(doc_type);
    // document_image
    if(doc_type == "jpg" || doc_type == "jpeg" || doc_type == "png" || doc_type == "image" || doc_type == "JPG" || doc_type == "JPEG" || doc_type == "PNG" ){
    $("#document_image").attr("src","/"+doc_path );
    $('#ImageView').modal('show');
  }
  else if(doc_type == "pdf" || doc_type == "PDF" || doc_type == "document"){
    // alert("this is pdf file")
    $("#document_pdf").attr("src","/"+doc_path );
    $('#DocumentView').modal('show');
  }
  else{
    alert("invalid format");
  }
  }


$(function () {
var table = $('#document_table').DataTable({
        //  scrollX:true,
         "language": {
         processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> '},
         processing: true,
         serverSide: true,
         paging: true,
         ajax: {
                "url":"{{ route('doctor.document_index') }}",
                'data': function(data){
                
                     data.doctor_id=$('#docter_id').val();
                
                 }
               },
         columns: [
            //  {data: 'id',  name: 'id'},
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
             {data: 'document', name: 'document'},
             {data: 'document_type', name: 'document_type'},
            {data:'',
                render: (data,type,row) => {
                        return `<div class="text-center">
                                    <div class="list-icons ">
                                        <a  onclick='check("${row.document_path}","${row.document_type}")' class='mdi mdi-eye' ></a>
                                        
                                        </div>
                                    </div>
                                </div>`;
                        }},
            ],
            "lengthMenu":[
                [25,50,-1],
                [25,50,"All"]
            ],
     });


$("#document_upload").validate({
              rules:{
                  document:{
                      required:true
                  },
              },
                  submitHandler: function (form) {
                      var data=new FormData(form);
                    $.ajax({
                        type:"post",
                        url: "{{route('doctor.document_store')}}",
                        data:data,
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function (data) {
                            if(data.success == 1){
                                // location.reload();
                                // $("#document_table").reload();
                                swal({
                                    title:'Upload Successfully',
                                    icon:'success',
                                    button:false
                                })
                                table.draw();
                                $('#exampleModalDocument').modal('hide');
                                $('#document_upload').trigger("reset");
                                
                        //  $("#image").attr(src)
                            }else if(data.success == 2){
                            swal({
                            title:'Only Image And PDF Accepted',
                            dangerMode: true,
                            icon:'fail',
                            button:false
                        })
                        
                        $('#document_upload').trigger("reset");
                            }
                                
                            
                        },
                        error:function (data) {
                         $('#document_upload').get(0).reset()
                            }
                    });
                  } 
    
          });

});



 
</script>
@endsection

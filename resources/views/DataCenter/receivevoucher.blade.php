@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')
<style>
.header
{
    background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
    
}
.table_color{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        color:white;
    }
    div.dataTables_wrapper div.dataTables_length select {
        width: 50px;
        height: 33px;
        color: #0b5dbb;
        border: 1px solid #0b5dbb;
        display: inline-block;
        border-radius:10px !important;
    }
    div.dataTables_wrapper div.dataTables_filter input{
            border-radius: 10px;
            border: 1px solid #0b5dbb;
    }
    .voucher_code_Copy{
            border: 1px solid #0b5dbb !important;
             border-radius: 10px !important;
             color: #0b5dbb !important;
             font-family: unset !important;
    }
    .voucher_code_Copy:hover{
        background:#0b5dbb;
        color:white !important;
    }
    .table td, .table th {
    padding: 0.75rem;
    vertical-align: initial;
}
div.dataTables_wrapper div.dataTables_length select {
    width:55px !important;
}
</style>
<div class="row mb-5">
    <div class="col-md-12 ">
        <div class="card">
        <div class="card " id="header-title">  
            <div class="card-header header-elements-inline header">
            <div class="card-title " style="color:whitesmoke;">Receive Voucher</div>
            </div>
        </div>
        <div class="card-body"  id="cardbody">
                <div class="row">
                    <div class="col-md-12 table-responsive">
                        <table class="table table-hover" style="width:100%;" id="table" >
                            <thead >
                                <tr  class="table_color style="color:whitesmoke;">
                                    <th>S.No</th>
                                    <th>Admin Name</th>
                                    <th>Voucher Code</th>
                                    <th>Receive Date</th>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
<script>
    $(function () {
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });
        
        var table = $('#table').DataTable({
          processing: true,
          serverSide: true,
          
          ajax: {
             "url":"{{route('receive.voucher1')}}", 
            },
            
         columns: [
         
         { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
         
             {data:'user_name',name:'user_name'},
                 
             {data: 'voucher',  render:(data,type,row)=>{
                     return `<input type="text" id="voucher_code_${row.id}" readonly value='${row.voucher}'style="border:none;background:transparent;outline:none" >` ;     
                     }},
             
             {data:'',
                render: ( data, type, row ) =>{
                   return moment(row.created_at).format('DD/MM/YYYY');
                 },
             },
             
              
             {data:'',
                     render:(data,type,row)=>{
                     return `<button class='btn  voucher_code_Copy' onclick="myFunction(${row.id})" value='${row.id}'>Copy</button>`;     
                     }
             },
            ]    
        });
    });
    
    
      function myFunction(val)
    {
    
	    var temp = $("<input>");
        $("body").append(temp);
        temp.val($("#voucher_code_"+val).val()).select();
        document.execCommand("copy");
        temp.remove();
        $("#voucher_code_"+val).select();
        
        <!--var copyText = document.getElementById("voucher_code_"+val);-->

        <!--/* Select the text field */-->
        <!--copyText.select();-->
        <!--copyText.setSelectionRange(0, 99999); /* For mobile devices */-->

        <!--/* Copy the text inside the text field */-->
        <!--navigator.clipboard.writeText(copyText.value);-->
    }
</script>

@endsection
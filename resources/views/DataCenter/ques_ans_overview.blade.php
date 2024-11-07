@extends('layouts.master')
<style>
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
   .my-row {
    background-color: #0b5dbb;
   }
   select.form-control {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
    color: #c9c8c8;
   }
   .border-secondary {
    border-color: none
  }
  input.form-control.ques_name {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
  }
  input.form-control.ques_email {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
  }
  input.form-control.ques_phone {
    outline: 1px solid #0b5dbb!important;
    border-radius: 21px;
 }
  select.custom-select.custom-select-sm.form-control.form-control-sm {
    margin: 11px;
      color: #000;
  }
  select.custom-select.custom-select-sm.form-control.form-control-sm {
      padding-left: 10px;
      padding-right: 26px;
  }
</style>
@section('page_title', 'Client List')
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

     var table = $('#bid-table').DataTable({
        dom: 'Blfrtip',
        "lengthMenu": [ [10, 25, 50,75,100, -1], [10, 25, 50,75,100, "All"] ],
        buttons: [
                 {
                extend: 'excelHtml5',
                text: 'Export',
                exportOptions: {
                  columns: [0,1,2,3,4,5]
                },
            },
            ],
         processing: true,
         serverSide: true,
         
         ajax: {
                "url":"{{ route('viewQue_search') }}",
               
                'data': function(data){
                     data.country=$('.ques_country').val();
                     data.name=$('.ques_name').val();
                     data.phone=$('.ques_phone').val();
                     data.email=$('.ques_email').val();
                    
                 }
               },
         columns: [
             {data: 'country',  name: 'country'},
             {data: 'fname', name: 'fname'},
             {data:'lname'  ,name:'lname'},
             {data:'phone',name:'phone'},
             {data:'email'  ,name:'email'},
             {data:'zipcode'  ,name:'zipcode'},
            {data:'',
                render: (data,type,row) => {
                        return `<div class="text-center">
                                    <div class="list-icons ">
                
                                      <a href='/adminapp/ques_ans/pdf/download/${row.id}' class='mdi mdi-table-edit'></a>
                                      <a href='/adminapp/ques_ans/pdf/download/pdf/${row.id}' class='mdi mdi-arrow-down-bold' download target='blank'></a>
                                      
                                         
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

     $(document).on('change','.ques_country', function(){
            table.draw();
        });

        $(document).on('keyup','.ques_name',function(){
           table.draw();
        });
        $(document).on('keyup','.ques_email',function(){
            table.draw();
        });
        $(document).on('keyup','.ques_phone',function(){
            table.draw();
        });
    });
</script>
<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);

    }

    .error {
        color: red;
        margin-top: 3px;
    }

</style>
<div class="col-md-12">
    <div class="card " id="header-title">

        <div class="card-header header-elements-inline header">
            <div class="card-title " style="color:whitesmoke;">View User</div>

        </div>

        <div class="card-body" id="cardbody">
            <div class="row mb-2">
               <div class="col-md-3">
                 <label class="col-form-label  mt-1">Country<span class="text-danger">*</span></label>
               </div>
               <div class="col-md-3">
                 <label class=" col-form-label  mt-1">Name<span class="text-danger">*</span></label>
               </div>
               <div class="col-md-3">
                 <label class=" col-form-label  mt-1">Email<span class="text-danger">*</span></label>
               </div>
               <div class="col-md-3">
                 <label class=" col-form-label  mt-1">Phone<span class="text-danger">*</span></label>
               </div>
            </div>
            <div class="row mb-2">
               <div class="col-md-3">
                   <select class="form-control border border-secondary label-gray-3 ques_country" name="country"
                     id="country">
                        <option class="label-gray-3" value="" disabled selected>Select Country<i class="fas fa-globe-asia"></i></option>
                          @foreach($country as $con=> $c)
                        <option value="{{$c->name}}">{{$c->name}}</option>
                          @endforeach
                    </select>
               </div>
               <div class="col-md-3">
                <input type="text" class="form-control ques_name" name="name">
               </div>
               <div class="col-md-3">
                 <input type="email" class="form-control ques_email" name="email">
               </div>
               <div class="col-md-3"> 
                <input type="number" class="form-control ques_phone" name="phone">
               </div>
            </div>
            
            <div class="ques-table mt-5">
                <button type="button" class="btn btn-primary float-right " id="export_btn" >Export</button>
                    <table class="table table-hover table1 table-responsive" id="bid-table">
                            <thead>
                                 <tr class="my-row">
                                     <th>Country</th>
                                     <th>FirstName</th>
                                     <th>LastName</th>
                                     <th>Phone</th>
                                     <th>Email</th>
                                     <th>Zipcode</th>
                                     <th>Action</th>
                                 </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                    </table>
            </div>


        </div>
    </div>
   <script>
     $(document).ready(function(){

        

    $(document).on('click','#qus_search',function(){
          var country=$('.ques_country').val();
          var name=$('.ques_name').val();
          console.log(name);
          var email=$('.ques_email').val();
          var phone=$('.ques_phone').val();
          console.log(phone);
          if(country){
            $('.ques-table').removeClass('d-none');
          }
          else if(name){
            $('.ques-table').removeClass('d-none');
          }
          else if(email){
            $('.ques-table').removeClass('d-none');
          }
          else if(phone){
            $('.ques-table').removeClass('d-none');
          }
          else{
                   swal({
                            title: "Please Fill  Fields",
                            type: "warning",
                             dangerMode: true,
                         
                        })
          }
     })
    });

    
   </script>


@endsection

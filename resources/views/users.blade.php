@extends('layouts.master')
<style>
.card {
   margin: 40px 0 20px 0;
    border:1px solid;
 }

.card-header.header-elements-inline {
    background-color: #fff;
}
label.col-form-label.font-weight-semibold {
    font-family: "ubuntu-medium", sans-serif;
    font-weight: 500;
}
button#addFieldTeam {
    background-color: #0b5dbb;
    border-color: #0b5dbb;
}
button#addFieldTeam:hover {
    background-color: #0b5dbb;
    border-color: #0b5dbb;

}
.card-header.header-elements-inline {
 background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: #fff;
}
.sub-text {
    color: #fff;
}
.error{
    color:red;
    padding:10px;
}
#delete_modal:hover{
    cursor: pointer;
}
.edit_btn{
  cursor: pointer;  
}
div.dataTables_wrapper div.dataTables_length select{
  width: 63px !important;
}
table tfoot th {
    font-weight: normal !important;
    color: #fff !important;
}
</style>
@section('page_title', 'users')
@section('content')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.css" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/1.3.1/jquery.pnotify.js"></script><script>
    $(document).ready(function(){

      
        $('#user-reg').validate({
            rules:{
                name:{
                    required:true
                },
                email:{
                    required:true,
                    email: true
                },
                password:{
                    required:true
                },
                password_confirmation:{
                    required:true,
                    equalTo: "#password",
                },
                user:{
                    required:true
                }
            },
            errorPlacement: function (error, element) {
                if (element.hasClass("select2-hidden-accessible")) {
                    error.insertAfter(element.siblings('span.select2'));
                } else if (element.hasClass("floating-input")) {
                    element.closest('.form-floating-label').addClass("error-cont").append(error);
                } else {
                    error.insertAfter(element);
                }
            },
            submitHandler: function (form) {
                var data = new FormData(form);

            $.ajax({
                type:"POST",
                url:"{{route('registerform')}}",
                data: data,
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                 processData: false,
                 contentType: false,
                 dataType: "json",
                 success:function(data){
                    if(data.success == 0){
                        $.each(data.errors, function(index, error){  
                                        $(form).find( "[name='"+index+"']" ).addClass("error").after( "<label class='error'>"+error+"</label>" ); 
                                }); 
                 }  
                 if(data.success == 1){
                    swal({
                            title:'Success',
                            text:'User Create Successfully',
                            icon:'success',
                            buttons:false
                        })
                        location.reload();
                 }
                }
                
            })
        }
        })
    
    })
</script>
<script type="text/javascript">
    
    $(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });
      var table = $('.data-table').DataTable({
          scrollX: true,
          processing: true,
          serverSide: true,
          ajax: "{{route('usersview')}}",
          columns: [
            { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
            {data:'name',name:'name'},
            {data:'email',name:'email'},
            {data:'user_type',name:'user_type'},
            
        
            {data:'',
                 render:(data,typr,row)=>{
                 return `
                 <div class="d-flex justify-content-center align-items-center">
                 <a href='/adminapp/user/edit/${row.id}' style="text-decoration: none;font-size: 15px; color:#007bff" class="edit_btn"><i class="mdi mdi-table-edit menu-icon"></i>Edit</a>
                 <p style="color:red;text-decoration:none; margin-top:15px;"  id="delete_modal" data-delete_id='${row.id}'; class=""><i class="mdi mdi-delete menu-icon"></i>Delete</p>
                 </div>`
                 }
        }
          ]
      });
    });
   
</script>
<script>
    $(document).on('click', '#delete_modal', function () {
        $("#exampleModal").modal('show');
        var delete_id = $(this).data('delete_id');
        $("#delete_id_append").val(delete_id);
        // console.log(delete_id);
    });
    
     $(document).on('click', '#modal_delete_btn', function () {
                var delete_id_send = $("#delete_id_append").val();
                // console.log(delete_id_send);
                console.log(delete_id_send);
                $.ajax({
                    type: "POST",
                    url:"{{route('delete_user')}}",
                    data: {
                        "delete_id_send": delete_id_send
                    },
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    dataType: "json",
                    success: function (data) {
                        console.log(data);

                        if(data.success=="1"){
                            $("#exampleModal").modal('hide');
                            swal({
                               title: 'User Deleted Successfully',
                               icon: 'success',
                               buttons: false
                            });
                            location.reload();
                        }
                    }
                })
            })
    
</script>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
    
                    <div class="card-header header-elements-inline">
                      <div class="card-title">
                          <div class="sub-text">
                            User List
                         </div>
                        </div>
                    </div>
                    <div class="card-body" >
                    <div class="text-center  font-weight-light"> 
                    <button type="button" class="btn btn-success float-right" data-toggle="modal" data-target="#exampleModalLong">
                    Add User
                    </button>
                  </div>
                        <div class="table-responsive mt-5" id="myTable">
                        <table  id="dtHorizontalExample" class="table table-hover table1 data-table" width="100%">
                            <thead>
                                <tr style="background-color: #0b5dbb;">
                                <th scope="col">S.No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">User Type</th>
                                <th scope="col">Actions</th>
                               
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

        <!-- Button trigger modal -->
 <!-- delete user -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="exampleModalLabel">Are You Sure</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" style="color:#fff;">&times;</span>
                    </button>
                </div>

                <div class="modal-footer d-flex justify-content-center align-items-center">
                    <input type="hidden" name="delete_id" id="delete_id_append">
                    <button type="button" id="modal_delete_btn" class="btn btn-primary">yes</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header btn btn-primary">
        <h5 class="modal-title" id="exampleModalLongTitle">Add User</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
      <form id="user-reg">
            @csrf
                  <div class="form-group mt-4">
                      <label style="font-weight:bold;font-size:15px;margin-left:4px;">Username</label>
                    <input type="text" class="form-control" placeholder="Username" id="name"  name="name" :value="old('name')" required autofocus />
                  </div>
                  <div class="form-group mt-4">
                      <label style="font-weight:bold;font-size:15px;margin-left:4px;">Email</label>
                    <input type="email" class="form-control " id="email" placeholder="Email" name="email" :value="old('email')" required pattern="[a-z0-9._]+@[a-z]+\.[com]{3,6}" />
                </div>

                  <div class="form-group mt-4">
                     <label style="font-weight:bold;font-size:15px;margin-left:4px;">Password</label> 
                    <input type="password" class="form-control" id="password"
                                type="password"
                                name="password"
                                placeholder="Password"
                                required autocomplete="new-password" />
                  </div>
                   <div class="form-group">
                        <label style="font-weight:bold;font-size:15px;margin-left:4px;">Confirmation Password</label> 
                    <input  class="form-control" id="password_confirmation"
                                type="password"
                                name="password_confirmation"  placeholder="Confirmation Password" required />
                  </div>
                   <div class="form-group mt-4">
                    <label style="font-weight:bold;font-size:15px;margin-left:4px;">User Type</label> 

                    <select name="user_type" class="form-control">

                    <option name= "user_type" value="admin">Admin</option>
                    <option name= "user_type" value="sales">Sales</option>
                    <option name= "user_type" value="accounts">Accounts</option>
                    <option name= "user_type" value="supplier">Supplier</option>
                    <option name= "user_type" value="operation">Operation</option>
                    <option name= "user_type" value="field_team">Field Team</option>
                    <option name= "user_type" value="data_center">Data Center</option>
                    <option name= "user_type" value="global_manager">Global Manager</option>
                    <option name= "user_type" value="global_field_team">Global Field Team</option>
                </select>
                </div>
                <div class="form-group mt-4">
                     <label style="font-weight:bold;font-size:15px;margin-left:4px;">User Role</label> 
                    <select name= "user_role" class="form-control">
                    <option name= "user_role" value="admin">Admin</option>
                    <option name= "user_role" value="subadmin">Sub Admin</option>
                    <option name= "user_role" value="sales">Sales</option>
                    <option name= "user_role" value="accounts">Accounts</option>
                    <option name= "user_role" value="supplier">Supplier</option>
                    <option name= "user_role" value="operation">Operation</option>
                    <option name= "user_role" value="team_leader">Team Leader</option>
                    <option name= "user_role" value="project_manager">Project Manager</option>
                    <option name= "user_role" value="quality_analyst">Quality Analyst</option>
                    <option name= "user_role" value="data_center">Data Center</option>
                    <option name= "user_role" value="global_manager">Global Manager</option>
                    <option name= "user_role" value="global_field_team">Global Field Team</option>
                </select>
                  </div>
                  <div class="row">
                  <div class="col"></div>
                  <div class="col mt-3">
                    <button type="submit"  class="btn btn-primary">SIGN UP</a>
                  </div>
                  <div class="col"></div>
                  </div>
                 
                </form>
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
    </div>




    
    
    
    @endsection
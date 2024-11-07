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
</style>
@section('page_title', 'users')
@section('content')
<!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pnotify/3.2.1/pnotify.css" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pnotify/1.3.1/jquery.pnotify.js"></script>
<script>
    $(document).on('click','#mission',function(){
        $('#password1').removeClass('d-none');
        $('#password2').removeClass('d-none');
        $('#password3').removeClass('d-none');
    });
    $(document).ready(function(){
        $('#passed').validate({
            rules:{
                newpassword:{
                    'required':true,
                },
                confirmpassword:{
                    equalTo: "#newpassword",
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
                url:"{{route('usersupdate')}}",
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
                            text:'Password Change Successfully',
                            icon:'success',
                            buttons:false
                        })
                 }
                }
                
            })
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
                            User View
                         </div>
                        </div>
                    </div>
                    <div class="card-body" >
                    <div class="text-center  font-weight-light"> 
                    <button type="button"  id="mission" class="btn btn-danger float-right" data-toggle="modal" data-target="#exampleModalLong">
                     Change Password
                    </button>
                  </div>
                   <form id="passed">    
                       @csrf 
                       <input type="hidden" name="id" id="id" value="{{$create && $create->id ? $create->id :'' }}">
                  <div class="row mt-5">
                  <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">User Name <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$create  && $create->name ?  $create->name:''}}">
                                    </div>
                 </div>
                 </div>
                 <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">User Email <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$create  && $create->email ?  $create->email:''}}">
                                    </div>
                 </div>
                  </div>

                  <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">User Role <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$create  && $create->user_role ?  $create->user_role :''}}">
                                    </div>
                 </div>
                  </div>

                  <div class="col-md-12 d-none" id="password1">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">New Password <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" name="newpassword" id="newpassword" value="">
                                    </div>
                 </div>
                  </div>

                  <div class="col-md-12 d-none" id="password2">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Confirm Password <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" name="confirmpassword" id="confirmpassword" value="">
                                    </div>
                 </div>
                  </div>
                  
                  <div class="col-md-12 d-none" id="password3">
                      <div class="row">
                      <div class="col-md-3"></div>
                      <div class="col-md-3 mt-3">
                      <div class="my-btn" >
                      <button type="submit" class="btn btn-success">submit</button>
                    </div>
                      </div>
                      <div class="col-md-3"></div>
                      </div>
                 </div>
                  
                  

                    </div>
             </form>
                </div>
            </div>
        </div>

        <!-- Button trigger modal -->




    </div>




    
    
    
    @endsection
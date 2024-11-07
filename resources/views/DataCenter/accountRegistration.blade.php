@extends('layouts.master')
@section('page_title', 'WonProject Form')
@section('content')
<style>
 
    .header{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        
    }
    .error{
        color:red;
        margin-top:5px;
    }
</style>
<div class="row  mt-5" style="margin-bottom: 93px;">
    <div class="col-md-12">
        <div class="card">
            <div class="card-title" id="header-title">  
                <div class="card-header header-elements-inline header">
                    <div class="card-title " style="color:whitesmoke;">Account Registration</div>
                </div>
            </div>
            <div clas="card-body">
                <form id="account_register">
                    <div class="row ml-5"> 
                        <div class="col-md-12 ">
                            <div class="form-group row d-flex">
                                <input type="hidden" name="user_name" id="user_name"  value="{{$user_id->firstname}}">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">ACCOUNT HOLDER NAME<span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" type="text" name="account_holder_name" id="account_holder_name" placeholder="ACCOUNT HOLDER NAME">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">ACCOUNT NUMBER <span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" type="text" name="account_number" id="account_number" placeholder="Account Number">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">IFC CODE<span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control"  type="text" name="ifc_code" id="ifc_code" placeholder="IFC CODE">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">BRANCH NAME<span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" type="text" name="branch_name" id="branch_name" placeholder="BRANCH NAME">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">BANK NAME<span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" type="text" name="bank_name" id="bank_name" placeholder="BANK NAME">
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12 text-center mb-2">
                            <button class="btn btn-success mr-2" type="sumbit">Sumbit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
      $("#account_register").validate({
            rules:{
                account_holder_name:{
                    required:true
                },   
                ifc_code:{
                    required:true
                },
                account_number:{
                    required:true
                },
                branch_name:{
                    required:true 
                },
                bank_name:{
                    required:true
                },

            },
            submitHandler: function (form) {
            var data = new FormData(form);  
             // alert(data);
                $.ajax({
                    type:"post" ,
                    url: "{{route('account.registerForm')}}",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        if(data.success == 1){
                            swal({
                                    title:'Account Register Successfully',
                                    icon:'success',
                                    button:false
                            }) 
                        }
                    }
                });
            }    
        });
    });

</script>

@endsection
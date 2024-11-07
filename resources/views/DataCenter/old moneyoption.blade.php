@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')
<style>
 
    .header{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        
    }
   </style>

<div class="col-md-12">
    <div class="card " id="header-title">  

        <div class="card-header header-elements-inline header">
          <div class="card-title " style="color:whitesmoke;">Send Money</div>
        </div>
        <div class="card-body">
        <div class="row mb-4">
            <div class="col-md-4">
                <img src="{{asset("$moneyoption->profile_image")}}" alt="view_image" style="width:100px;height:100px; border-radius:8px;">
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>
            <div class="row ">
                <input type="hidden" id="id" name="id" value="14">

               <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">First Name <span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" readonly="readonly" value="{{$moneyoption->firstname}}">
                                </div>
                            </div>
                </div>
                 <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">Last Name <span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" readonly="readonly" value="{{$moneyoption->lastname}}">
                                </div>
                            </div>
                </div>
                <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">City Name<span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" readonly="readonly" value="{{$moneyoption->cityname}}">
                                </div>
                            </div>
                </div>
                <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">City Code<span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" readonly="readonly" value="{{$moneyoption->citycode}}">
                                </div>
                            </div>
               </div>
                 <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">Phone Number<span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" readonly="readonly" value="{{$moneyoption->PhNumber}}">
                                </div>
                            </div>
               </div>
               <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">Email <span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" readonly="readonly" value="{{$moneyoption->email}}">
                                </div>
                            </div>
               </div>
               <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">Whatsapp Number <span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" readonly="readonly" value="{{$moneyoption->whatdsappNumber}}">
                                </div>
                            </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row d-flex">
                        <label class="col-lg-4 col-form-label font-weight-bold text-dark"> Docter Specility<span class="text-danger"></span></label>
                        <div class="col-lg-4">
                        <input class="form-control" readonly="readonly" value="{{$moneyoption->docterSpeciality}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row d-flex">
                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Total Experience <span class="text-danger"></span></label>
                        <div class="col-lg-4">
                        <input class="form-control" readonly="readonly" value="{{$moneyoption->totalExperience}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row d-flex">
                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Practice <span class="text-danger"></span></label>
                        <div class="col-lg-4">
                        <input class="form-control" readonly="readonly" value="{{$moneyoption->practice}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row d-flex">
                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Licence <span class="text-danger"></span></label>
                        <div class="col-lg-4">
                        <input class="form-control" readonly="readonly" value={{$moneyoption->licence}}>
                        </div>
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group row d-flex">
                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Patients Month<span class="text-danger"></span></label>
                        <div class="col-lg-4">
                        <input class="form-control" readonly="readonly" value={{$moneyoption->PatientsMonth}}>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row d-flex">
                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Country<span class="text-danger"></span></label>
                        <div class="col-lg-4">
                        <input class="form-control" readonly="readonly" value="{{$moneyoption->country1}}">
                        </div>
                    </div>
               </div>
               
                <div class="col-md-12">
                    <div class="form-group row d-flex">
                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Document<span class="text-danger"></span></label>
                        <div class="col-lg-4 d-flex">
                        <input class="form-control" readonly="readonly" value="{{$moneyoption->document}}">
                        {{-- <button class="btn btn-primary">Download</button> --}}
                        <a target="_blank" href="{{url($moneyoption->document)}}"><i class="fa fa-download mt-2 ml-1 " id="dowload"  aria-hidden="true"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                <a href="{{route('adminactivedview')}}" class="btn btn-success mr-2">back</a>
                <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Send Money</button>
                </div>


            </div>    
                </div> 
    </div>
</div>
{{-- modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary">
          <h5 class="modal-title" style="color:white;" id="exampleModalLabel">MONEY SEND</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="form">
                <div class="form-group row">
                    <div class="col-md-12 row">
                        <input type="hidden" name="User_name" id="user_name" value="{{Auth::user()->name}}">
                        <input type="hidden" name="user_id" id="user_id" value="{{$moneyoption->user_id}}">
                        <input type="hidden" name="docter_id" id="docter_id" value="{{$moneyoption->id}}">
                    
                        <div class='col-md-6 d-flex justify-content-center align-items-center'>
                            <label style="font-size:15px;"> Send Money :</label>
                        </div>
                        <div class="col-md-6 d-flex  align-items-center">
                        <input type="text" placeholder="money" name="money" id="money" class="form-control"> 
                        </div>
                    </div>
                
                   
                </div>
                <div class="form-group row">
                    <div class="col-md-12 row">   
                        <div class='col-md-6 d-flex justify-content-center align-items-center'>
                            <label style="font-size:15px;">Voucher Code :</label>
                        </div>
                        <div class="col-md-6 d-flex  align-items-center">
                        <input type="text" placeholder="voucher_code" name="voucher_code" id="voucher_code" class="form-control"> 
                        </div>
                    </div>
                   
                </div>
                <button type="sumbit" class="btn btn-success float-right">Send Money</button>
            </form>
        </div>

      </div>
    </div>
  </div>
  <script>
       $(document).ready(function () {
            $("#form").validate({
                rules:{
                    money:{
                        required:true
                    },   
                    voucher_code:{
                        required:true
                    }
                },
                submitHandler: function (form) {
                var data = new FormData(form);  
                    $.ajax({
                        type:"post" ,
                        url: "{{route('sendmoneyadmin')}}",
                        data: data,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function (data) {
                            if(data.success == 1){
                                $("#exampleModal").modal('hide');
                                swal({
                                        title:'Money Request Successfully',
                                        // text:'RFQ Created Successfully',
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
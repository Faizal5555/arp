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




</style>
@section('page_title')
@section('content')
<script>
    $(document).ready(function(){
        $("#update").validate({
            rules:{
                supplier_name:{
                    required:true
                },
                // supplier_manager:{
                //     required:true
                // },
                supplier_email:{
                    required:true
                },
                // supplier_phone:{
                //     required:true
                // },
                // supplier_whatsapp:{
                //     required:true
                // },
                supplier_country:{
                required:true
                },
                // other_detail:{
                //     required:true
                // }
                
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
                type: "POST",
                url:"{{route('Supplier.update')}}",
                data:data,
                // headers: {
                // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                // },
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (data) {
                    if(data.success == 1 ){
                    swal({
                    title:'Supplier Updated Successfully',
                    icon:'success',
                    buttons:false
                })

                   window.location="{{route('Supplier.index')}}";

                    }
                    else{
                  console.log('data');

                    }
                },
                
              
              
                
            });
         }
        });
             
         })

        
    




</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border-light">

                <div class="card-header header-elements-inline">
                <div class="card-title">
                    <div class="sub-text">Edit Supplier
                     </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form  class="form col-md-12 d-flex flex-wrap"
                           enctype="multipart/form-data" id="{{ $supplier && $supplier->id ? 'update' : 'register'}}" >
                           @csrf


                          <input type="hidden" name="id" value="{{$supplier && $supplier->id ? $supplier->id :''}}"/>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold ">Supplier Company Name <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">

                                        <input name="supplier_company" 
                                              value="{{$supplier && $supplier->supplier_company ? $supplier->supplier_company :''}}"  type="text" class="form-control" style="font-family: FontAwesome;" placeholder='&#xf007  Supplier Company Name'>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold ">Supplier Manager Name <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">

                                        <input name="supplier_manager" 
                                            type="text" value="{{$supplier && $supplier->supplier_manager ? $supplier->supplier_manager :''}}" class="form-control" style="font-family: FontAwesome;" placeholder='&#xf234  Supplier Manager Name   '>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold ">Supplier Email <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                        <input name="supplier_email"
                                            
                                            type="text" value="{{$supplier && $supplier->supplier_email ? $supplier->supplier_email :''}}" class="form-control" style="font-family: FontAwesome;" placeholder='&#xf199 Supplier Email    '>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold ">Supplier<br> PhoneNo<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                        <input name="supplier_phone" 
                                            type="number" value="{{$supplier && $supplier->supplier_phone ? $supplier->supplier_phone :''}}" class="form-control" style="font-family: FontAwesome;" placeholder='&#xf10b SupplierPhone No   '>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold ">Supplier WhatsApp<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                        <input name="supplier_whatsapp" 
                                            type="number" value="{{$supplier && $supplier->supplier_whatsapp ? $supplier->supplier_whatsapp :''}}" class="form-control"  style="font-family: FontAwesome;" placeholder='&#xf232 Supplier Whatspp   '>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold  ">  Country<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                        <select class="form-control label-gray-3" name="supplier_country">
                                            <option class="label-gray-3" value="">Select Country<i class="fas fa-globe-asia"></i></option>
                                                @if(isset ($country) && count($country) > 0)
                                                @foreach($country as $v)
                                            <option value="{{$v->name}}" {{$supplier->supplier_country == $v->name ? 'selected' : ''}}>{{$v->name}}</option>
                                                @endforeach
                                                @endif
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold  ">Other Details<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                       <input type="text" name="other_detail" value="{{$supplier && $supplier->other_detail ? $supplier->other_detail :''}}" class="form-control" placeholder="enter your detail">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                               
                                <button type="submit" id="addRegisterButton"
                                    class="btn btn-success ml-2">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
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

@extends('layouts.master')
<style>
    .main-panel {
    background-color: #f8f8f8;
   }
.card {
   margin: 40px 0 20px 0;
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
    background-color: #0b5dbb;
    border-color: #0b5dbb;
}
button#addRegisterButton:hover {
    background-color: #0b5dbb;
    border-color: #0b5dbb;

}
.card-header.header-elements-inline {
   background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: #fff;
}
.card .card-title {
    color: #ffffff;
}
.sub-text {
    color: #fff;
}
select.form-control.label-gray-3 {
    color: #6e6868;
}
 .error {
        color: red;
       margin-top:8px;
    }
    
    .form-control.error,.form-control.label-gray-3.error{
    border:1px solid red !important;
}


</style>
@section('page_title', 'Vendor Form')
@section('content')

<script>
    $(document).ready(function () {
        $("#register").validate({
            rules: {
                vendor_name: {
                    required: true
                },
                vendor_country: {
                    required: true
                },
                vendor_email: {
                    required: true,
                    email:true
                },
                vendor_manager: {
                    required: true
                },
                vendor_phoneno: {
                    required: true,
                    number:true,
                    minlength:9,
                    maxlength:15
                },
                vendor_whatsapp: {
                    required: true,
                    number: true,
		            minlength: 9,
		            maxlength: 15
                },
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
                // loadButton('#addRegisterButton');

                $.ajax({
                    type: "POST",
                    url: "{{route('vendor.store')}}",
                    data: data,

                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        console.log(data.error);
                         if (data.success == 1) {
                            swal({
                            title:'Success',
                            text:'Vendor Added Successfully',
                            icon:'success',
                            buttons:false
                        })
                        $('#register').get(0).reset()
                        window.location="{{route('vendor.index')}}";
                        }
                       if (data.success == 0) {
                            $.each(data.error, function(index, error){  
                                        $(form).find( "[name='"+index+"']" ).addClass("error").after( "<label class='error'>"+error+"</label>" ); 
                                }); 
                       }
                    }

                });
            }
        });
    })
</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card border border-light">

                <div class="card-header header-elements-inline">
                <div class="card-title .text-white">
                    <div class="sub-text">
                        Vendor Form
                    </div>
                </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form id="register" class="form col-md-12 d-flex flex-wrap">
                           @csrf
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold text-white">Vendor Name <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                        <input name="vendor_name" value="{{$vendor && $vendor->vendor_name ? $vendor->vendor_name : ''}}"
                                             type="text" class="form-control"  style="font-family: FontAwesome;" placeholder='&#xf007 Vendor Name'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold text-white">Vendor Country<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                        <!-- <input name="vendor_country" value="{{$vendor && $vendor->vendor_country ? $vendor->vendor_country : ''}}" type="text"
                                            class="form-control" placeholder="Country"> -->
                                            <select class="form-control label-gray-3" name="vendor_country">
                                                <option class="label-gray-3" value="">Select Country</option>
                                                @if(count($country) > 0)
                                                @foreach($country as $v)
                                                <option value="{{$v->name}}">{{$v->name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold text-white">Vendor Manager<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                        <input name="vendor_manager" value="{{$vendor && $vendor->vendor_manager ? $vendor->vendor_manager : ''}}"
                                            type="text" class="form-control" style="font-family: FontAwesome;" placeholder='&#xf234 Vendor Manager'>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="col-md-6">-->
                            <!--    <div class="form-group row">-->
                            <!--        <label class="col-lg-3 col-form-label font-weight-semibold text-white">Client<span-->
                            <!--                class="text-danger"></span></label>-->
                            <!--        <div class="col-lg-9">-->
                            <!--            {{-- <input name="vendor_manager" value="{{$vendor && $vendor->vendor_manager ? $vendor->vendor_manager : ''}}"-->
                            <!--                type="text" class="form-control" placeholder="Vendor Manager"> --}}-->
                            <!--                <select class="form-control label-gray-3" name="client_id">-->
                            <!--                    <option class="label-gray-3" value="">Select Client</option>-->
                            <!--                    @if(count($client) > 0)-->
                            <!--                    @foreach($client as $v)-->
                            <!--                    <option value="{{$v->id}}">{{$v->client_name}}</option>-->
                            <!--                    @endforeach-->
                            <!--                    @endif-->
                            <!--                </select>-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold text-white">Vendor Email<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                        <input name="vendor_email"
                                            value="{{$vendor && $vendor->vendor_email ? $vendor->vendor_email : ''}}"
                                            type="text" class="form-control" style="font-family: FontAwesome;" placeholder='&#xf199 Vendor Email' required pattern="[^@]+@[^@]+\.[com]{3,6}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold text-white">Vendor Phone No<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                        <input name="vendor_phoneno" value="{{$vendor && $vendor->vendor_phoneno ? $vendor->vendor_phoneno : ''}}"
                                            type="number" class="form-control" style="font-family: FontAwesome;" placeholder='&#xf10b Vendor Phone No'>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold text-white">Vendor WhatsApp<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-9">
                                        <input name="vendor_whatsapp" value="{{$vendor && $vendor->vendor_whatsapp ? $vendor->vendor_whatsapp : ''}}"
                                            type="number" class="form-control"  style="font-family: FontAwesome;" placeholder='&#xf232  Vendor Whatsapp No '>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <a href="{{route('vendor.index')}}" class=" btn btn-outline-secondary">Back</a>
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

@endsection

@section('scripts')

@endsection

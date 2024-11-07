@extends('layouts.master')
<style>
    .card-header.header-elements-inline {
    background: linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: #fff;
}
thead {
    background-color: #0b5dbb;
    color: #f3f2f2;
}
</style>



@section('content')
<script>
  $(document).ready(function(){
    $('.vendor-awaited').click(function(){
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            $.ajax({
                url: "{{ route('accounts.sent')}}",
                method: 'post',
                data: {
                  id:$('#id').val(),
                 },
                success: function(result){
                    if(result.success == 1)
                       {
                        swal({
                            title:'Payment Awaited Successfully',
                            icon:'success',
                            button:false
                        })
                        // window.location="{{route('accounts.vendorpayment')}}";
                        window.location.reload();
                       }
                }
            });
        });
   });
   
    $(document).ready(function(){
    $('#request').validate({
            rules: {
                id:{
                    required:true
                },
                upload_invoice:{
                    required:true
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

                $.ajax({
                    type: "POST",
                    url: "{{route('accounts.vendoruploadinvoicestore')}}",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        if(data.success == 1)
                       {
                        swal({
                            title:'Payment Due Successfully',
                            icon:'success',
                            button:false
                        })
                        // window.location="{{route('accounts.vendorpayment')}}";
                        
                        window.location.reload();
                       }
                        if(data.success==0){
                             swal({
                            title:'Please Fill Fields',
                            icon:'warning',
                            buttons:false
                        })
                        }
                        if(data.success == 2){
                           swal({
                            title:'Already Sent',
                            icon:'warning',
                            buttons:false
                        }) 
                        }
                    }

                });
            }
        });
   });
   
</script>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Vendor Invoice Request View</a>
                    </div>

                <div class="card-body">

            
 <form  id="request" enctype="multipart/form-data">
                <div class="row">
                    <input type="hidden" id="id" name="id" value="{{$vendoradvance && $vendoradvance->id ?  $vendoradvance->id:''}}">

                   
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">RFQ No <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendoradvance && $vendoradvance->rfq ?  $vendoradvance->rfq:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Vendor Name<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendoradvance && $vendoradvance->vendor_id ?  $vendoradvance->vendor_id:''}}">
                                    </div>
                                </div>
                   </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Invoice Type<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendoradvance && $vendoradvance->invoice_type ?  $vendoradvance->invoice_type:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Vendor Amount <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value=" {{$vendoradvance && $vendoradvance->currency ?  $vendoradvance->currency:''}}{{$vendoradvance && $vendoradvance->amount ?  $vendoradvance->amount:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Vendor Contract <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4 d-flex">
                                  <input  class="form-control" readonly="readonly" value="{{$vendoradvance && $vendoradvance->vendor_contract ?  $vendoradvance->vendor_contract:''}}">
                              
                                    <a target="_blank" download href="../.././public/{{$vendoradvance && $vendoradvance->vendor_contract ?  $vendoradvance->vendor_contract:''}}" class="mdi mdi-download" style="
    margin-top: 10px;
"></a>

                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Date <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendoradvance && $vendoradvance->created_at ?  $vendoradvance->created_at:''}}">
                                    </div>
                                </div>
                    </div>
                     <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Invoice Copy</label> <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4 d-flex">
                                    @if($vendoradvance->upload_invoice!='')
                                     <input  class="form-control" readonly="readonly" value="{{$vendoradvance && $vendoradvance->vendor_contract ?  $vendoradvance->vendor_contract:''}}">
                                    <a target="_blank" download href="../.././public/{{$vendoradvance && $vendoradvance->upload_invoice ?  $vendoradvance->upload_invoice:''}}"class="mdi mdi-download" style="
                                      margin-top: 10px;
                                     "></a>
                                     @else
                                     <input type="file" name="upload_invoice" id="upload_invoice" value="{{$vendoradvance && $vendoradvance->upload_invoice ?  $vendoradvance->upload_invoice:''}}" class="form-control" required> 
                                     @endif
                                    </div>
                                </div>
                    </div>

                    <div class="col-md-12 text-center">
                    <button class="btn btn-success">Pay Vendor Invoice</button>
                    </div>


                </div>    
                </form>
                    </div>
                   
                  </div>
                </div>
              </div>
           

              
           

@endsection
@section('script')


@endsection
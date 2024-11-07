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
.error{
    color:red;
}
input#swift {
    text-transform: capitalize;
}

</style>



@section('content')
{{-- <script>
  $(document).ready(function(){
    $('.client-awaited').click(function(){
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            var cid:$('#id').val();
            $.ajax({
                url: "{{ route('accounts.awitview',"cid")}}",
                method: 'get',
                data: {
                  cid:$('#id').val(),
                 },
                success: function(result){
                    if(result.success == 1)
                       {
                        swal({
                            title:'Updated Successfully',
                            icon:'success',
                            button:false
                        })
                       }
                }
            });
        });
   });
</script> --}}
<script>
$(document).ready(function(){
    $('.vendor_paid').click(function(){
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });

            $('#exampleModal').modal('show');
           
        });
        $("#payment").validate({
            rules: {
                transaction_number: {
                    required: true
                },
                date_payment: {
                    required: true
                },
                bank_name: {
                    required: true
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
                url: "{{route('accounts.vendorpaid')}}",
                data: data,
                processData: false,
                contentType: false,
                dataType: "json",
                success: function (data) {
                    swal({
                        title:'Payment Received Successfully',
                        // text:'Received Created Successfully',
                        icon:'success',
                        buttons:false
                    })
                    window.location="{{route('accounts.vendorreceived')}}";
                    $('#payment').get(0).reset()
                    $('#exampleModal').modal('hide');
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
                    <a class="ml-2 card-title">Vendor Payment Due View</a>
                    </div>

                <div class="card-body">

        
                <div class="row">
                    

                   
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">RFQ No <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorrequestadvance  && $vendorrequestadvance->rfq ?  $vendorrequestadvance->rfq:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Vendor Name<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorrequestadvance  && $vendorrequestadvance->vendor_id ?  $vendorrequestadvance->vendor_id:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Invoice Type <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorrequestadvance  && $vendorrequestadvance->invoice_type?  $vendorrequestadvance->invoice_type:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Vendor Advance <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value=" {{$vendorrequestadvance  && $vendorrequestadvance->currency?  $vendorrequestadvance->currency:''}}{{$vendorrequestadvance  && $vendorrequestadvance->amount?  $vendorrequestadvance->amount:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Vendor Contract <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4 d-flex">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorrequestadvance  && $vendorrequestadvance->vendor_contract ?  $vendorrequestadvance->vendor_contract:''}}">
                                    <a target="_blank" href="../.././public/{{$vendorrequestadvance->vendor_contract}}"><i class="fa fa-download mt-2 ml-1"></i></a>
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Invoice Date <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorrequestadvance  && $vendorrequestadvance->created_at ?  $vendorrequestadvance->created_at:''}}">
                                    </div>
                                </div>
                    </div>
                     
                    <div class="col-md-12 text-center">
                    <button class="btn btn-success vendor_paid">Payment Made</button>
                    </div>


                </div>    
                    </div>
                   
                  </div>
                </div>
              </div>
           

<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment Received</h5>
        {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button> --}}
        <button type="button" class="close" style="color:red;" data-dismiss="modal" aria-label="Close"><i class="mdi mdi-close-circle"></i>
      </div>
      <div class="modal-body">
      <form  id="payment" enctype="multipart/form-data">
                @csrf
                <input type="hidden" id="vendor_id" name="vendor_id" value="{{$vendorrequestadvance  && $vendorrequestadvance->id ?  $vendorrequestadvance->id:''}}" readonly>
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Transaction Number</label>
            <input type="text" name="transaction_number" id="transaction_number" class="form-control" placeholder="Transaction Number">
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Date Of Payment</label>
            <input type="date" name="date_payment" id="date_payment" class="form-control">  
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Bank Name</label>
            <input type="text" name="bank_name" id="bank_name" class="form-control" placeholder="Bank Name">  
          </div>
           <div class="mb-3">
                     <label for="message-text" class="col-form-label">Swift Copy<span
                                            class="text-danger"></span></label>
                     <input type="file" name="swift" id="swift" class="form-control">  
           </div>
           <div class="mb-3 d-none">
            <input type="text" name="upload_invoice" id="upload_invoice" value="{{$vendorrequestadvance && $vendorrequestadvance->upload_invoice ? $vendorrequestadvance->upload_invoice:'' }}" class="form-control">  
          </div>
          <div class="col-md-12">
          <button type="submit" class="btn btn-success text-center">Save</button>
         </div>
        </form>
           
      </div>
    </div>
  </div>
</div>
   
           

@endsection
@section('script')


@endsection
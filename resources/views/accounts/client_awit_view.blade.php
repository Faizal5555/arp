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
</style>



@section('content')

<script>
 $(document).ready(function(){    
       $('#payment').validate({
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
                firc:{
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
                    url: "{{route('accounts.paidstore')}}",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        if(data.success==1){
                        swal({
                            title:'success',
                            text:'Received Added Successfully',
                            icon:'success',
                            buttons:false
                        })
                        $('#payment').get(0).reset();
                        window.location="{{route('accounts.paymentreceived')}}";
                        }
                        if(data.success==0){
                             swal({
                            title:'Please Fill Fields',
                            icon:'warning',
                            buttons:false
                        })
                        }
                        
                    }

                });
            }
        });
    // });
//   $(document).ready(function(){
    $('#client-paid').click(function(){
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            $.ajax({
                url: "{{ route('accounts.clientpaid')}}",
                method: 'post',
                data: {
                  id:$('#id').val(),
                 },
                success: function(result){
                    if(result.success == 1)
                       {
                         swal({
                            title:'success',
                            text:'Received Added Successfully',
                            icon:'success',
                            buttons:false
                        })
                       }
                }
                      
            });
        });
        
        $('.client-paid').click(function(){
            $('#exampleModal').modal('show');
            
        });
   });

</script>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Client Payment Awaited View</a>
                    </div>

                <div class="card-body">

        
                <div class="row">
                    <input type="hidden" id="id" name="id" value="{{$clientrequest  && $clientrequest->id ?  $clientrequest->id:''}}">

                   
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">RFQ No <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientrequest  && $clientrequest->rfq ?  $clientrequest->rfq:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Client Name<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientrequest  && $clientrequest->client_id ?  $clientrequest->client_id:''}}">
                                    </div>
                                </div>
                   </div>
                  <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Invoice Type<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientrequest  && $clientrequest->invoice_type ?  $clientrequest->invoice_type:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Client Amount <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value=" {{$clientrequest  && $clientrequest->currency ?  $clientrequest->currency:''}}{{$clientrequest  && $clientrequest->amount ?  $clientrequest->amount:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Client Contract <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4 d-flex">
                                    <input  class="form-control" readonly="readonly" value="{{$clientrequest  && $clientrequest->client_contract ?  $clientrequest->client_contract:''}}">
                                    <a target="_blank" href="../.././public/{{$clientrequest->client_contract}}"><i class="fa fa-download mt-2 ml-1"></i></a>
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Invoice Date <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientrequest && $clientrequest->created_at ?  $clientrequest->created_at:''}}">
                                    </div>
                                </div>
                    </div>
                     <div class="col-md-12 d-none" >
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Invoice Copy <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientrequest && $clientrequest->upload_invoice ?  $clientrequest->upload_invoice:''}}">
                                     <a target="_blank" href="../.././public/{{$clientrequest->upload_invoice}}"><i class="fa fa-download mt-2 ml-1"></i></a>
                                    </div>
                                </div>
                    </div>

                    <div class="col-md-12 text-center">
                    <button class="btn btn-success client-paid">Payment Received</button>
                    </div>


                </div>    
                    </div>
                   
                  </div>
                </div>
              </div>
 
 <!-- client payment received details -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment Received</h5>
          <button type="button" class="close" style="color:red;" data-dismiss="modal" aria-label="Close"><i class="mdi mdi-close-circle"></i>
      </div>
      <div class="modal-body">
      <form  id="payment" enctype="multipart/form-data">
                @csrf
     <input type="hidden" name="advance_id" value="{{$clientrequest  && $clientrequest->id ?  $clientrequest->id:''}}">
          <div class="mb-3">
            <label for="recipient-name" class="col-form-label">Transaction Number</label>
            <input type="text" name="transaction_number" id="transaction_number" class="form-control" placeholder="Transaction Number"> 
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Date Of Payment</label>
            <input type="date" name="date_payment" id="date_of_payment" class="form-control">  
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Bank Name</label>
            <input type="text" name="bank_name" id="date_payment" class="form-control" placeholder="Bank Name">  
          </div>
            <div class="mb-3">
            <label for="message-text" class="col-form-label">FIRC Copy</label>
            <input type="file" name="firc" id="firc" class="form-control">  
          </div>
          <div class="mb-3 d-none">
           <input  class="form-control" readonly="readonly"name="upload_invoice" value="{{$clientrequest && $clientrequest->upload_invoice ?  $clientrequest->upload_invoice:''}}">
          </div>
          <div class="col-md-12">
          <button type="submit" id="client-paid" class="btn btn-success text-center">Save</button>
         </div>
        </form>
            
      </div>
      <div class="modal-footer">
      </div>
    </div>
  </div>
</div>
 <!-- client payment received details -->

              
           

@endsection
@section('script')


@endsection
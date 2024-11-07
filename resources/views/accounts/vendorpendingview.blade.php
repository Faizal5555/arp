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
div.dataTables_wrapper div.dataTables_length select {
    width: 53px;
}
.dataTables_wrapper .dataTables_length{
    margin-top:8px;
}
div.dataTables_wrapper div.dataTables_filter{
    margin-top:8px;
    margin-right:8px;
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
                            title:'Updated Successfully',
                            icon:'success',
                            button:false
                        })
                        window.location="{{route('accounts.vendorpayment')}}";
                       }
                }
            });
        });
   });
</script>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Vendor Invoice Pending</a>
                    </div>

                <div class="card-body">

            

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
                                    <input  class="form-control" readonly="readonly" value="{{$vendoradvance && $vendoradvance->amount ?  $vendoradvance->amount:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Vendor Contract <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendoradvance && $vendoradvance->vendor_contract ?  $vendoradvance->vendor_contract:''}}">
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

                    <div class="col-md-12 text-center">
                    <button class="btn btn-success "  onclick="window.location.href='https://arp.stagingzar.com/accounts/vendorpending'">Back</button>
                    </div>


                </div>    
                    </div>
                   
                  </div>
                </div>
              </div>
           

              
           

@endsection
@section('script')


@endsection
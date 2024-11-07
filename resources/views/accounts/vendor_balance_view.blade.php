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
                url: "{{ route('accounts.balancesent')}}",
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
                    <a class="ml-2 card-title">Vendor Invoice Request</a>
                    </div>

                <div class="card-body">

            

                <div class="row">
                    <input type="hidden" id="id" name="id" value="{{$vendorbalance && $vendorbalance->id ?  $vendorbalance->id:''}}">

                   
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Rfq No <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorbalance && $vendorbalance->rfq ?  $vendorbalance->rfq:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Vendor Name<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorbalance && $vendorbalance->vendor_id ?  $vendorbalance->vendor_id:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Vendor Balance <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorbalance && $vendorbalance->vendor_balance ?  $vendorbalance->vendor_balance:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Vendor Contract <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorbalance && $vendorbalance->vendor_contract ?  $vendorbalance->vendor_contract:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Day <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorbalance && $vendorbalance->created_at ?  $vendorbalance->created_at:''}}">
                                    </div>
                                </div>
                    </div>

                    <div class="col-md-12 text-center">
                    <button class="btn btn-success vendor-awaited">Invoice Sent</button>
                    </div>


                </div>    
                    </div>
                   
                  </div>
                </div>
              </div>
           

              
           

@endsection
@section('script')


@endsection
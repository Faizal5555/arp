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
    $('.client-awaited').click(function(){
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            $.ajax({
                url: "{{ route('accounts.clientsent1')}}",
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
                    <a class="ml-2 card-title">Client Advance View</a>
                    </div>

                <div class="card-body">

        
                <div class="row">
                    <input type="hidden" id="id" name="id" value="{{$clientrequest1  && $clientrequest1->id ?  $clientrequest1->id:''}}">

                   
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Rfq No <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientrequest1  && $clientrequest1->rfq ?  $clientrequest1->rfq:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Client Name<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientrequest1  && $clientrequest1->client_id ?  $clientrequest1->client_id:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Client Advance <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientrequest1  && $clientrequest1->client_balance ?  $clientrequest1->client_balance:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Client Contract <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientrequest1  && $clientrequest1->client_contract ?  $clientrequest1->client_contract:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Day <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientrequest1  && $clientrequest1->created_at ?  $clientrequest1->created_at:''}}">
                                    </div>
                                </div>
                    </div>

                    <div class="col-md-12 text-center">
                    <button class="btn btn-success client-awaited">Invoice Sent</button>
                    </div>


                </div>    
                    </div>
                   
                  </div>
                </div>
              </div>
           

              
           

@endsection
@section('script')


@endsection
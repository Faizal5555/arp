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
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Client Pending View</a>
                    </div>

                <div class="card-body">

            

                <div class="row">
                    <input type="hidden" id="id" name="id" value="{{$clientrequest  && $clientrequest->id ?  $clientrequest ->id:''}}">

                   
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Rfq No <span
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
                                    <input  class="form-control" readonly="readonly" value="{{$clientrequest  && $clientrequest ->client_id ?  $clientrequest->client_id:''}}">
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
                                    <input  class="form-control" readonly="readonly" value="{{$clientrequest  && $clientrequest->amount ?  $clientrequest->amount:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Client Contract <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientrequest  && $clientrequest->client_contract ?  $clientrequest->client_contract:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Day <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientrequest  && $clientrequest->created_at ?  $clientrequest->created_at:''}}">
                                    </div>
                                </div>
                    </div>

                    <div class="col-md-12 text-center">
                   <a href="{{route('accounts.clientpending')}}" class="btn btn-success">Back</a>
                    </div>


                </div>    
                    </div>
                   
                  </div>
                </div>
              </div>
           

              
           

@endsection
@section('script')


@endsection
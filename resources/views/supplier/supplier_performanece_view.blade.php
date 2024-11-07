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

</script>


<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Supplier Details</a>
                    </div>

                <div class="card-body">

            

                <div class="row">
                    <input type="hidden" id="id" name="id" value="{{$supplier  && $supplier->id ?  $supplier ->id:''}}">

                   
                    <!--<div class="col-md-12">-->
                    <!--            <div class="form-group row d-flex">-->
                    <!--                <label class="col-lg-4 col-form-label font-weight-bold text-dark">RFQ No<span-->
                    <!--                        class="text-danger"></span></label>-->
                    <!--                <div class="col-lg-4">-->
                    <!--                <input  class="form-control" readonly="readonly" value="{{$supplier  && $supplier->rfq_no ?  $supplier->rfq_no:''}}">-->
                    <!--                </div>-->
                    <!--            </div>-->
                    <!--</div>-->
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Supplier No<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$supplier  && $supplier->sp_no ?  $supplier->sp_no:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Supplier Name<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$supplier  && $supplier->supplier_company ?  $supplier->supplier_company:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Supplier Manager<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$supplier  && $supplier ->supplier_manager ?  $supplier->supplier_manager:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Supplier Email<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$supplier  && $supplier->supplier_email ?  $supplier->supplier_email:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Supplier Phone Number <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$supplier  && $supplier->supplier_phone ?  $supplier->supplier_phone:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Supplier Whatsapp Number  <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$supplier  && $supplier->supplier_whatsapp ?  $supplier->supplier_whatsapp:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Supplier Country<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$supplier  && $supplier->supplier_country ?  $supplier->supplier_country:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group row d-flex">
                            <label class="col-lg-4 col-form-label font-weight-bold text-dark">Other Details<span
                                    class="text-danger"></span></label>
                            <div class="col-lg-4">
                            <input  class="form-control" readonly="readonly" value="{{$supplier  && $supplier->other_detail ?  $supplier->other_detail:''}}">
                            </div>
                        </div>
                    </div>
             
                   <div class="col-md-12 text-center">
                     <a href="{{route('supplier.performance')}}" class="btn btn-success">Back</a>
                    </div>


                </div>    
                    </div>
                   
                  </div>
                </div>
              </div>
           

              
           

@endsection
@section('script')


@endsection
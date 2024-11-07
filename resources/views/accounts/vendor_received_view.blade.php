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
button#firc {
    float: right;
}
</style>



@section('content')
<script>
    $(document).ready(function(){
        $('#Swift').click(function(){
            $('#exampleModalCenter').modal('show');
        })
    })
</script>

<script>
    $(document).ready(function(){
        $('#swiftcopy-upload').validate({
            rules:{
            swiftcopy:{
                required:true
            },
            },
                submitHandler: function (form) {
                var data = new FormData(form);
                $.ajax({
                    type: "POST",
                    url: "{{route('accounts.swift')}}",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        if (data.success == 1) {
                            swal({
                            title:'updated Successfully',
                            text:'Swift Copy updated Successfully',
                            icon:'success',
                            buttons:false
                        })
                            
                        }
                        else {
                            flash({ msg: data.message, type: 'info' });
                        }
                    }

                });
            }
            
        })
    });
</script>

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-title">vendor List</div> -->
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Vendor Payment Received View</a>
                    </div>

                <div class="card-body">

                 <div class="col-md-12 d-flex justify-content-end">
                    
                   <!--<button class="btn btn-success" id="Swift">Upload Swift Copy</button>-->
                    
                   
                    </div>

                <div class="row">

                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Project No <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendoroperation && $vendoroperation->project_no ?  $vendoroperation->project_no:''}}">
                                    </div>
                                </div>
                    </div>
                     <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">PO No <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendoroperation && $vendoroperation->purchase_order_no ?  $vendoroperation->purchase_order_no:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">RFQ No <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorclient && $vendorclient->rfq ?  $vendorclient->rfq:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Vendor Name<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorclient && $vendorclient->vendor_id ?  $vendorclient->vendor_id:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Invoice Type<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorclient && $vendorclient->invoice_type ?  $vendorclient->invoice_type:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Amount<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorclient && $vendorclient->amount ?  $vendorclient->amount:''}}">
                                    </div>
                                </div>
                   </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Transaction Number<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorreceived && $vendorreceived->transaction_number ?  $vendorreceived->transaction_number:''}}">
                                    </div>
                                </div>
                   </div>
                   
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Date of Payment <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorreceived && $vendorreceived->payment_date ?  $vendorreceived->payment_date:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Bank <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$vendorreceived && $vendorreceived->bank_name ?  $vendorreceived->bank_name:''}}">
                                    </div>
                                </div>
                    </div>
                           <div class="col-md-12">
                                   <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Swift Copy<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4 d-flex">
                                       <input readonly="readonly"  class="form-control" value="{{$vendorreceived && $vendorreceived->swift ? $vendorreceived->swift : '' }}">
                                       <a target="_blank" download href="../.././public/{{$vendorreceived && $vendorreceived->swift ? $vendorreceived->swift : '' }}" style="margin-top:10px;" class='mdi mdi-download' ></a>
                                       </div>
                                    </div>
                                </div>
                  
                    
                     <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Vendor Invoice<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4 d-flex">
                                      <input readonly="readonly"  class="form-control" value="{{$vendorreceived && $vendorreceived->upload_invoice ? $vendorreceived->upload_invoice : '' }}">
                                      <a target="_blank" download href="../.././public/{{$vendorreceived && $vendorreceived->upload_invoice ? $vendorreceived->upload_invoice : ''}}" style="margin-top:10px;" class='mdi mdi-download' ></a>
                                      </div>
                                    </div>
                                </div>
                       </div>

                    <div class="col-md-12 text-center">
                    <button class="btn btn-success "  onclick="window.location.href='https://arp.stagingzar.com/accounts/vendor_received'">Back</button>
                    </div>


                </div>    
                    </div>
                   
                  </div>
                </div>
              </div>
           

 
 <div class="modal fade"  id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload Swift Copy</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="swiftcopy-upload" method="post" enctype="multipart/form-data">
              @csrf
                                   <input type="hidden" name="id" value="{{$vendorreceived && $vendorreceived->id ?  $vendorreceived->id:''}}"
                                    <div class="col-lg-12">
                                    <input  class="form-control" type="file" name="swift" id="swiftcopy" >
                                    </div>
                                
                   
    <div class="d-flex justify-content-center mt-3">
        <button  value="submit" class="btn btn-success">submit</button>
    </div>
      </form>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>
             


@endsection
@section('script')


@endsection
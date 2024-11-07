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
        $('#firc').click(function(){
            $('#exampleModalCenter').modal('show');
        })
    })
</script>

<script>
    $(document).ready(function(){
        $('#firc-upload').validate({
            rules:{
            firccopy:{
                required:true
            },
            },
                submitHandler: function (form) {
                var data = new FormData(form);
                alert(data);
                $.ajax({
                    type: "POST",
                    url: "{{route('accounts.fircopy')}}",
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
                       window.location.reload(true);
                            
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
                    <a class="ml-2 card-title">Client Payment Received View</a>
                    </div>

                <div class="card-body">
                  <div class="col-md-12 d-flex justify-content-end">
                    
                   <!--<button class="btn btn-success" id="firc">Upload FIRC Copy</button>-->
                    
                   
                    </div>
            

                <div class="row">
                    <input type="hidden" id="id" name="id" value="{{$clientreceived  && $clientreceived->id ?  $clientreceived ->id:''}}">

                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Project No <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientoperation && $clientoperation->project_no ? $clientoperation->project_no:''}}">
                                    </div>
                                </div>
                    </div>
                     <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">PO No <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientoperation && $clientoperation->purchase_order_no ?  $clientoperation->purchase_order_no:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">RFQ No <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$client1 && $client1->rfq ?  $client1->rfq:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Vendor Name<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$client1 && $client1->client_id ?  $client1->client_id:''}}">
                                    </div>
                                </div>
                   </div>
                     <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Transaction Number<span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientreceived && $clientreceived->transaction_number ?  $clientreceived->transaction_number:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Date of Payment <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientreceived && $clientreceived->date_payment ?  $clientreceived->date_payment:''}}">
                                    </div>
                                </div>
                   </div>
                   <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Bank <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4">
                                    <input  class="form-control" readonly="readonly" value="{{$clientreceived && $clientreceived->bank_name ?  $clientreceived->bank_name:''}}">
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">FIRC Copy <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4 d-flex">
                                   <input readonly="readonly" class="form-control" value="{{$clientreceived && $clientreceived->firccopy ?  $clientreceived->firccopy:''}}">
                                   <a target="_blank" download href="../.././public/{{$clientreceived && $clientreceived->firccopy ?  $clientreceived->firccopy:''}}" style="margin-top:10px;" class='mdi mdi-download'></a>
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12">
                                <div class="form-group row d-flex">
                                    <label class="col-lg-4 col-form-label font-weight-bold text-dark">Invoice Copy <span
                                            class="text-danger"></span></label>
                                    <div class="col-lg-4 d-flex">
                                   <input readonly="readonly" class="form-control" value="{{$clientreceived && $clientreceived->upload_invoice ?  $clientreceived->upload_invoice:''}}">
                                   <a target="_blank" download href="../.././public/{{$clientreceived && $clientreceived->upload_invoice ?  $clientreceived->upload_invoice:''}}" style="margin-top:10px;" class='mdi mdi-download'></a>
                                    </div>
                                </div>
                    </div>
                    <div class="col-md-12 text-center">
                    <a href="{{route('accounts.paymentreceived')}}" class="btn btn-success">Back</a>
                    </div>


                </div>    
                    </div>
                    
                    
                    <div class="modal fade"  id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Upload FIRC Copy </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <form id="firc-upload" method="post" enctype="multipart/form-data">
              @csrf
                                    <input type="hidden" name="id" id="id" value="{{$clientreceived  && $clientreceived->id ?  $clientreceived ->id:''}}">
                                    <div class="col-lg-12">
                                    <input  class="form-control" type="file" name="firccopy" id="firccopy" >
                                    </div>
                                
                   
                                    <div class="d-flex justify-content-center mt-3">
                                    <button type="submit" class="btn btn-success">submit</button>
                                    </div>
                                     </form>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>
                   
                  </div>
                </div>
              </div>
              </div>
           

              
           

@endsection
@section('script')


@endsection
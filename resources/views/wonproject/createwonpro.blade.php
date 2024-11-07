@extends('layouts.master')
<style>
    a.ml-2.btn.btn-primary {
    float: right;
}
.main-panel {
    background-color: #f8f8f8;
   }
.card {
   margin: 40px 0 20px 0;
    border:1px solid;
 }

.card-header.header-elements-inline {
    background-color: #fff;
}
     button#addRegisterButton {
    background-color: #6329a1;
    border-color: #6329a1;
}
label.col-lg-3.col-form-label.font-weight-semibold {
    font-family: "ubuntu-medium", sans-serif;
    font-weight: 500;
}
a.btn.btn-outline-secondary:hover {
    color: #fff;
}

button#addRegisterButton {
    background-color: #0b5dbb;
    border-color: #0b5dbb;
}
button#addRegisterButton:hover {
    background-color: #0b5dbb;
    border-color: #0b5dbb;

}
.card-header.header-elements-inline {
 background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: #fff;
}
.sub-text {
    color: #fff;
}
select.form-control.label-gray-3 {
    color: #6e6868;
}
/* currency */
label.currency {
    margin-top: 12px;
    margin-left: 5px;
    position: absolute;
}
input.txtCal.valid {
    padding-left: 20px;
    z-index: 1;
}
    </style>
@section('page_title', 'WonProject Form')
@section('content')

<script>
    $(document).ready(function () {
        $("#register").validate({
            rules: {
                rfq_no: {
                    required: true
                },
                project_name: {
                    required: true
                },
                project_execution: {
                    required: true
                },
                project_type: {
                    required: true
                },
                project_start_date: {
                    required: true
                },
                project_end_date: {
                    required: true
                },
                client_total: {
                    required: true
                },
                vendor_total: {
                    required: true
                },
                client_advance: {
                    required: true
                },
                client_balance: {
                    required: true
                },
                vendor_advance: {
                    required: true
                },
                vendor_balance: {
                    required: true
                },
                client_contract: {
                    required: true
                },
                vendor_contract: {
                    required: true
                },
                total_margin: {
                    required: true
                },
                date: {
                    required: true
                },
                currency:{
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
                    url: "{{route('wonproject.store')}}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        swal({
                            title:'Form Created Successfully',
                            text:'Won Project Created Successfully',
                            icon:'success',
                            buttons:false
                        })
                        $('#register').get(0).reset()
                      window.location = "{{route('wonproject.index')}}";
                        // if (data.success == 1) {
                        //     // loadButton('#addRegisterButton');
                        //     flash({ msg: data.message, type: 'success' });
                        //     window.location = "{{route('wonproject.index')}}";
                        // }
                        // else {
                        //     flash({ msg: data.message, type: 'info' });
                        // }
                    }
                });

            }
        });

        $("#update").validate({
            rules: {
                type: {
                    required: true
                },
                rfq_no: {
                    required: true
                },
                project_name: {
                    required: true
                },
                project_execution: {
                    required: true
                },
                project_type: {
                    required: true
                },
                project_start_date: {
                    required: true
                },
                project_end_date: {
                    required: true
                },
                client_total: {
                    required: true
                },
                vendor_total: {
                    required: true
                },
                client_advance: {
                    required: true
                },
                client_balance: {
                    required: true
                },
                vendor_advance: {
                    required: true
                },
                vendor_balance: {
                    required: true
                },
                client_contract: {
                    required: true
                },
                vendor_contract: {
                    required: true
                },
                total_margin: {
                    required: true
                },
                date: {
                    required: true
                },
                 currency:{
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
                    url: "{{route('wonproject.update')}}",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        swal({
                            title:'Form update Successfully',
                            text:'Won Project Update Successfully',
                            icon:'success',
                            buttons:false
                        })
                        $('#update').get(0).reset()
                        if (data.success == 1) {
                            flash({ msg: data.message, type: 'success' });
                            window.location = "{{route('wonproject.index')}}";
                        }
                        else {
                            flash({ msg: data.message, type: 'info' });
                        }
                    }

                });
            }
        });

    })
</script>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header header-elements-inline">
                <div class="card-title">
                    <div class="sub-text">
                        Commissioned Project
                    </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <form id="{{ $wonproject && $wonproject->id ? 'update' : 'register'}}" class="form col-md-12 d-flex flex-wrap"
                           enctype="multipart/form-data">
                           @csrf
                           <input type="hidden" name="id" value="{{$wonproject && $wonproject->id ? $wonproject->id  : ''}}">

                           <input type="hidden" value="rfq_no_id">
                            
                            <div class="row ">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">RFQ No <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <!-- <input name="rfq_no" value="{{$wonproject && $wonproject->rfq_no ? $wonproject->rfq_no : ''}}"
                                                 type="text" class="form-control" placeholder="wonproject Name"> -->
                                            <select class="form-control label-gray-3" name="rfq_no" id="rfq_no">
                                                <option class="label-gray-3" value="">Select RFQ No</option>
    
                                                    @if (count($bidrfq) > 0)
                                                    @foreach($bidrfq as $value)
                                                    @if(!empty($value['client_id']))
                                                    @foreach(explode(",",$value['client_id']) as $t)
                                                    <option value="{{$value->rfq_no}}_{{ $t }}">{{$value->rfq_no}}-{{ $t }}</option>
                                                    @endforeach
                                                    @endif
                                                    @endforeach
                                                    @endif
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold" id="otherField1">Project Name<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="project_name" value="{{$wonproject && $wonproject->project_name ? $wonproject->project_name : ''}}" type="text"
                                                id="otherField1" class="form-control" placeholder="Project Name">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold" id="otherField2">Project Type<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                                <select class="form-control label-gray-3" name="project_type" id="project_type">
                                                    <option class="label-gray-3" disabled selected>Select Execution</option>
                                                    <option value="Qualitative">Qualitative</option>
                                                    <option value="Quantitative">Quantitative</option>
                                                    <option value="Community">Community</option>
                                                </select>    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField3" class="col-lg-3 col-form-label font-weight-semibold">Project Execution<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <!-- <input name="project_execution" value="{{$wonproject && $wonproject->project_execution ? $wonproject->project_execution : ''}}"
                                                id="otherField3" type="text" class="form-control" placeholder="Project Execution"> -->
                                            <select class="form-control label-gray-3" name="project_execution" id="project_execution">
                                                <option class="label-gray-3" disabled selected>Select Execution</option>
                                                <option value="Insource">Insource</option>
                                                <option value="Outsource">Outsource</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">Choose Currency<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                          
                                            <select class="form-control label-gray-3" name="currency" id="worldcurrency">
                                                <option value="" disabled selected>Select Currency</option>
                                                <option value="₹">INR</option>
                                                <option value="$">USD</option>
                                                <option value="€">Euro</option>
                                                <option value="£">Pound</option>     
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField4" class="col-lg-3 col-form-label font-weight-semibold">Start Date<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="project_start_date" value="{{$wonproject && $wonproject->project_start_date ? $wonproject->project_start_date : ''}}"
                                                id="otherField4" type="date" class="form-control" placeholder="Start Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField5" class="col-lg-3 col-form-label font-weight-semibold">End Date<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="project_end_date" value="{{$wonproject && $wonproject->project_end_date ? $wonproject->project_end_date : ''}}"
                                                id="otherField5" type="date" class="form-control" placeholder="End Date">
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-lg-9">
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField6" class="col-lg-3 col-form-label font-weight-semibold">Client Total Project Invoice Value<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                              <label class="currency" id="client_total_currency"></label>
                                            <input name="client_total" value="{{$wonproject && $wonproject->client_total ? $wonproject->client_total : ''}}"
                                                id="otherField6" type="text" class="form-control" placeholder="Client Total Project Invoice Value">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField7" class="col-lg-3 col-form-label font-weight-semibold">Vendor Total Project Invoice Value<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="vendor_total_currency"></label>
                                            <input name="vendor_total" value="{{$wonproject && $wonproject->vendor_total ? $wonproject->vendor_total : ''}}"
                                                id="otherField7" type="text" class="form-control" placeholder="Vendor Total Project Invoice Value">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField8" class="col-lg-3 col-form-label font-weight-semibold">Total Margins<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                             <label class="currency" id="total_margin_currency"></label>
                                            <input name="total_margin" value="{{$wonproject && $wonproject->total_margin ? $wonproject->total_margin : ''}}"
                                                id="otherField8" type="text" class="form-control" placeholder="Total Margin">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label id="otherField9" class="col-lg-3 col-form-label font-weight-semibold"><u>Client Invoicing Terms</u></label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField10" class="col-lg-3 col-form-label font-weight-semibold">Advance Payment <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="client_advance_currency"></label>
                                            <input name="client_advance" value="{{$wonproject && $wonproject->client_advance ? $wonproject->client_advance : ''}}"
                                                id="otherField10" type="text" class="form-control" placeholder="Advance Payment">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField11" class="col-lg-3 col-form-label font-weight-semibold">Balance Payment<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="client_balance_currency"></label>
                                            <input name="client_balance" value="{{$wonproject && $wonproject->client_balance ? $wonproject->client_balance : ''}}"
                                                id="otherField11" type="text" class="form-control" placeholder="Balance Payment">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label id="otherField12" class="col-lg-3 col-form-label font-weight-semibold"><u>Vendor Invoicing Terms</u></label>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField13" class="col-lg-3 col-form-label font-weight-semibold">Advance Payment <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="vendor_advance_currency"></label>
                                            <input name="vendor_advance" value="{{$wonproject && $wonproject->vendor_advance ? $wonproject->vendor_advance : ''}}"
                                                id="otherField13" type="text" class="form-control" placeholder="Advance Payment">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField14" class="col-lg-3 col-form-label font-weight-semibold">Balance Payment<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="vendor_balance_currency"></label>
                                            <input name="vendor_balance" value="{{$wonproject && $wonproject->vendor_balance ? $wonproject->vendor_balance : ''}}"
                                                id="otherField14" type="text" class="form-control" placeholder="Balance Payment">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField15" class="col-lg-3 col-form-label font-weight-semibold">Attach Client Contract / Email <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="client_contract" style="text-transform: capitalize;" value="{{$wonproject && $wonproject->client_contract ? $wonproject->client_contract : ''}}"
                                                id="otherField15" type="file" class="form-control p-1" placeholder="Attach Client Contract">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField16" class="col-lg-3 col-form-label font-weight-semibold">Attach Vendor Contract / Email<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">

                                           
                                            <input name="vendor_contract" style="text-transform: capitalize;" value=""
                                                id="otherField16" type="file" class="form-control p-1" placeholder="Attach Vendor Contract">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <a href="{{route('bidrfq.index')}}" class=" btn btn-outline-secondary">Back</a>
                                <button type="submit" id="addRegisterButton"
                                    class="btn btn-success ml-2">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
@endsection

@section('css')
<style>
    .error {
        color: red;
        font-size: 11px;
        font-weight: bold;
    }
    #otherFieldDiv {
  /* max-width: 900px; */
  display: none;
  /* margin: 0 auto; */
}
</style>
@endsection

@section('scripts')

<script>

// // $( document ).ready(function() {
//     $(document).on('change', '#rfq_no', function() {
//         // $("#rfq_no").change(function() {
//         var seeanother = $(this).val();
//         // alert(seeanother);
//         if (seeanother != "") {
//             // alert("xx");
//             $('#otherFieldDiv').removeClass('d-none');
//             $('#otherField1').addClass('required', '');
//             $('#otherField1').addClass('data-error', 'This field is required.');
//             $('#otherField2').addClass('required', '');
//             $('#otherField2').addClass('data-error', 'This field is required.');
//             $('#otherField3').addClass('required', '');
//             $('#otherField3').addClass('data-error', 'This field is required.');
//             $('#otherField4').addClass('required', '');
//             $('#otherField4').addClass('data-error', 'This field is required.');
//             $('#otherField5').addClass('required', '');
//             $('#otherField5').addClass('data-error', 'This field is required.');
//         } else {
//             $('#otherFieldDiv').addClass('d-none');
//             $('#otherField1').removeClass('required');
//             $('#otherField1').removeClass('data-error');
//             $('#otherField2').removeClass('required');
//             $('#otherField2').removeClass('data-error');
//             $('#otherField3').removeClass('required');
//             $('#otherField3').removeClass('data-error');
//             $('#otherField4').removeClass('required');
//             $('#otherField4').removeClass('data-error');
//             $('#otherField5').removeClass('required');
//             $('#otherField5').removeClass('data-error');
//         }
//     });
// // $("#rfq_no").trigger("change");
// // });
</script>
<script>
$(document).on('change','#worldcurrency',function(){
    var id=$(this).val();
    var inputs = $('input[type="text"]');
    $('#client_advance_currency').html(id);
    $('#client_balance_currency').html(id);
    $('#vendor_advance_currency').html(id);
    $('#vendor_balance_currency').html(id);
    $('#total_margin_currency').html(id);
    $('#client_total_currency').html(id);
    $('#vendor_total_currency').html(id);
    inputs.removeAttr('placeholder');
});

</script>

 </script>
@endsection

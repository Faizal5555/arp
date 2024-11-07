@extends('layouts.master')
@section('page_title', 'BidRfq Form')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header header-elements-inline">
                <div class="card-title">BidRfq Form</div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <form id="{{ $bidrfq && $bidrfq->id ? 'update' : 'register'}}" class="form col-md-12 d-flex flex-wrap"
                           enctype="multipart/form-data">
                           @csrf
                           <input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Rfq No <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="rfq_no" value="{{$rfq_no}}"
                                             type="text" class="form-control" placeholder="RFQ NO">
                                    </div>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Date<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="date" value="{{$bidrfq && $bidrfq->date ? $bidrfq->date : ''}}"
                                            type="date" class="form-control" placeholder="Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Industry<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <!-- <input name="industry" value="{{$bidrfq && $bidrfq->industry ? $bidrfq->industry : ''}}"
                                            type="text" class="form-control" placeholder="Industry"> -->
                                        <select class="form-control label-gray-3" name="industry">
                                            <option class="label-gray-3" value="">Select Industry</option>
                                            <option value="Sugar">Sugar</option>
                                            <option value="Fertilizer">Fertilizer</option>
                                            <option value="Paper">Paper</option>
                                            <option value="Automobile">Automobile</option>
                                            <option value="textile">textile</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Follow Up date<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="follow_up_date" value="{{$bidrfq && $bidrfq->follow_up_date ? $bidrfq->follow_up_date : ''}}" 
                                            type="date" class="form-control" placeholder="Follow Up date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 table-responsive" style="overflow-x:auto;">
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label font-weight-semibold">Industry Table<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                    <table border="1" name="" id="mtable">
                                        <tr>
                                            <th></th>
                                            <th>Vendor / Client Name</th>
                                            <th>
                                                <select class="form-control label-gray-3" name="vendor_id_0[]">
                                                    <option class="label-gray-3" value="">Vendor</option>
                                                        @if(count($vendor) > 0)
                                                        @foreach($vendor as $v)
                                                    <option value="{{$v->vendor_name}}">{{$v->vendor_name}}</option>
                                                        @endforeach
                                                        @endif
                                                </select>
                                            </th>
                                            <th>
                                                <select class="form-control label-gray-3" name="client_id_0[]">
                                                    <option class="label-gray-3" value="">Client</option>
                                                        @if(count($client) > 0)
                                                        @foreach($client as $v)
                                                    <option value="{{$v->client_name}}">{{$v->client_name}}</option>
                                                        @endforeach
                                                        @endif
                                                </select>
                                            </th>
                                           
                                            
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>
                                                <select class="form-control label-gray-3" name="country_0[]">
                                                    <option class="label-gray-3" value="">Country</option>
                                                        @if(count($country) > 0)
                                                        @foreach($country as $v)
                                                    <option value="{{$v->name}}">{{$v->name}}</option>
                                                        @endforeach
                                                        @endif
                                                </select>
                                            </td>
                                            <td colspan="2" >Insert self</td>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td>Sample Size</td>
                                            <td><input type="text" class="border-0" name="sample_size_0[]" placeholder="sample size"></td>
                                            <td><input type="text" class="border-0" name="sample_size_0[]" placeholder="sample size"></td>
                                            </tr>
                                        <tr>
                                            <td>Setup Cost</td>
                                            <td>Insert self</td>
                                            <td><input type="text" class="border-0" placeholder="setup cost" name="setup_cost_0[]"></td>
                                            <td><input type="text" class="border-0" placeholder="setup cost" name="setup_cost_0[]"></td>
                                            </tr>
                                        <tr>
                                            <td>Recruitment</td>
                                            <td>Insert self</td>
                                            <td><input type="text" class="border-0" placeholder="recruitment" name="recruitment_0[]"></td>
                                            <td><input type="text" class="border-0" placeholder="recruitment" name="recruitment_0[]"></td>
                                           </tr>
                                        <tr>
                                            <td>Incentives</td>
                                            <td>Insert self</td>
                                            <td><input type="text" class="border-0" placeholder="incentives" name="incentives_0[]"></td>
                                            <td><input type="text" class="border-0" placeholder="incentives" name="incentives_0[]"></td>
                                            </tr>
                                        <tr>
                                            <td>Moderation</td>
                                            <td>Insert self</td>
                                            <td><input type="text" class="border-0" placeholder="moderation" name="moderation_0[]"></td>
                                            <td><input type="text" class="border-0" placeholder="moderation" name="moderation_0[]"></td>
                                             </tr>
                                        <tr>
                                            <td>Transcript</td>
                                            <td>Insert self</td>
                                            <td><input type="text" class="border-0" placeholder="transcript" name="transcript_0[]"></td>
                                            <td><input type="text" class="border-0" placeholder="transcript" name="transcript_0[]"></td>
                                             </tr>
                                        <tr>
                                            <td>Others</td>
                                            <td>Insert self</td>
                                            <td><input type="text" class="border-0" placeholder="others" name="others_0[]"></td>
                                            <td><input type="text" class="border-0" placeholder="others" name="others_0[]"></td>
                                           </tr>
                                        <tr>
                                            <td>Total Cost</td>
                                            <td>0</td>
                                            <td><input type="text" class="border-0"></td>
                                            <td><input type="text" class="border-0"></td>
                                        </tr>
                                    </table><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <a href="{{route('bidrfq.index')}}" class=" btn btn-primary">Back</a>
                                <button type="submit" id="addRegisterButton"
                                    class="btn btn-success ml-2">Submit</button>
                                    <button class="btn btn-danger  ml-2" id="addBtn" type="button">
                                    Add New Industry
                                </button>
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
</style>
@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#register").validate({
            rules: {
                rfq_no: {
                    required: true
                },
                client_id: {
                    required: true
                },
                vendor_id: {
                    required: true
                },
                country: {
                    required: true
                },
                industry: {
                    required: true
                },
                date: {
                    required: true
                },
                follow_up_date: {
                    required: true
                },
                sample_size: {
                    required: true
                },
                setup_cost: {
                    required: true
                },
                recruitment: {
                    required: true
                },
                incentives: {
                    required: true
                },
                moderation: {
                    required: true
                },
                transcript: {
                    required: true
                },
                others: {
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
                // loadButton('#addRegisterButton');
               
                $.ajax({
                    type: "POST",
                    url: "{{route('bidrfq.store')}}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        $('#register').get(0).reset()
                        if (data.success == 1) {
                            // loadButton('#addRegisterButton');
                            flash({ msg: data.message, type: 'success' });
                            window.location = "{{route('bidrfq.index')}}";
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
<script>
    $(document).ready(function () {
        $('#addBtn').click(function(){
            if($('#mtable tr').length!=0){
                for(i=0;i<2;i++){
                    $.each($('#mtable tr'),function(index,value){
                        // console.log($(value).find('th:nth-child(3)').html());
                        // console.log($(value).find('td:nth-child(3)').html());
                        if(i==0){
                            if(index==0)
                                $(value).append("<th>"+$(value).find('th:nth-child(3)').html()+"</th>");
                            else{
                                if(index==1)
                                    $(value).append("<td colspan='2'>"+$(value).find('td:nth-child(3)').html()+"</td>");
                                else
                                    $(value).append("<td>"+$(value).find('td:nth-child(3)').html()+"</td>");
                            }
                        }else{
                            if(index==0)
                                $(value).append("<th>"+$(value).find('th:nth-child(4)').html()+"</th>");
                            else{
                                if(index!=1)
                                    $(value).append("<td>"+$(value).find('td:nth-child(4)').html()+"</td>");
                                }
                        }
                    });
                }
            }
        });
    });
</script>
@endsection
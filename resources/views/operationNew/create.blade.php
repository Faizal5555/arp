@extends('layouts.master')
<style>
    .error{
        color:red;
        padding:10px;
    }
    th.operation-country {
    padding-left: 10px;
    padding-right: 88px;
}
button#addBtn {
    float: right;
    margin-bottom: 17px;
}
th {
    padding: 10px;
}
</style>
@section('page_title', 'Operation New Project')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header header-elements-inline">
                <div class="card-title">Operation New Project</div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <form id="{{ $operation && $operation->id ? 'update' : 'register'}}" class="form col-md-12 d-flex flex-wrap"
                           enctype="multipart/form-data">
                           @csrf
                           <input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Project No <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="project_no" value="{{$project_no}}" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">PO number <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="purchase_order_no" value ="{{$purchase_order_no}}"
                                             type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Respondent Incentives <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="respondent_incentives" value=""
                                             type="text" class="form-control" placeholder="Respondent Incentives">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Assign Team Leader <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                      
                                        {{-- <input name="team_leader" value=""
                                             type="text" class="form-control" placeholder="Assign Team Leader"> --}}
                                        <select class="form-control label-gray-3" name="team_leader">
                                            <option class="label-gray-3" value="" >Select Team Leader</option>
                                            @if(count($fieldteam)>0)
                                            @foreach ($fieldteam as $item)
                                            <option class="label-gray-3" value="{{$item->team_leader}}">{{$item->team_leader}}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                      
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Project Manager Name <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        {{-- <input name="project_manager_name" value=""
                                             type="text" class="form-control" placeholder="Project Manager Name"> --}}
                                            <select class="form-control label-gray-3" name="project_manager_name">
                                                <option class="label-gray-3" value="" >Select ManagerName</option>
                                                @if(count($fieldteam)>0)
                                                @foreach($fieldteam as  $data)
                                                <option class="label-gray-3" value="{{$data->project_manager_name}}">{{$data->project_manager_name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Quality Analyst Name <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        {{-- <input name="quality_analyst_name" value=""
                                             type="text" class="form-control" placeholder="Quality Analyst Name"> --}}
                                            <select class="form-control label-gray-3" name="quality_analyst_name">
                                                <option class="label-gray-3" value="" >Select QualityAnalyst Name</option>
                                                @if(count($fieldteam)>0)
                                                @foreach($fieldteam as $value)
                                                <option class="label-gray-3" value="{{$value->quality_analyst_name}}">{{$value->quality_analyst_name}}</option>
                                                @endforeach
                                                @endif
                                            </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Project Deliverables <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="project_deliverable" value=""
                                             type="text" class="form-control" placeholder="Project Deliverables">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Attach Questionnaire <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="questionnarie" value=""
                                             type="file" class="form-control" placeholder="Attach Questionnaire">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Attach Other Documents <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="other_document" value=""
                                             type="file" class="form-control" placeholder="Attach Other Documents">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Attach Survey Link <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="survey_link" value=""
                                             type="file" class="form-control" placeholder="Attach Survey Link">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label font-weight-semibold">Target Table<span
                                            class="text-danger">*</span></label>
                                            <button class="btn btn-danger  ml-2"  style="float: right;"id="addBtn" type="button">
                                                Add New Industry
                                            </button>
                                    <div class="col-md-12 table-responsive" style="overflow-x:auto;">
                                       
                                        {{-- <button class="btn btn-danger  ml-2" class="removeBtn" type="button">
                                            remove Industry
                                        </button> --}}
                                    <table border="1" name="" id="mtable">
                                        <tr>
                                            <th class="operation-country">country</th>
                                            <th colspan="2" style="text-align: center">Target Group 1</th>
                                            <th colspan="2" style="text-align: center">Target Group 2</th>
                                            <th colspan="2" style="text-align: center">Target Group 3</th>
                                            <th colspan="2" style="text-align: center">Target Group 4</th>
                                            <th colspan="2" style="text-align: center">Target Group 5</th>
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td  style="text-align: center">Sample Target</td>
                                            <td  style="text-align: center">Sample Achieved</td>
                                            <td  style="text-align: center">Sample Target</td>
                                            <td  style="text-align: center">Sample Achieved</td>
                                            <td  style="text-align: center">Sample Target</td>
                                            <td  style="text-align: center">Sample Achieved</td>
                                            <td  style="text-align: center">Sample Target</td>
                                            <td  style="text-align: center">Sample Achieved</td>
                                            <td  style="text-align: center">Sample Target</td>
                                            <td  style="text-align: center">Sample Achieved</td>
                                        </tr>
                                        <tr>
                                            
                                            <td>
                                                <select class="form-control label-gray-3" name="country_name_0[]" id="country_name" required>
                                                <option class="label-gray-3" value="">Select Country</option>
                                                    
                                                    @if (count($country) > 0)
                                                    @foreach($country as $value)
                                                    <option value="{{$value->name}}">{{$value->name}}</option>
                                                    @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
                                            </td>
                                            <td>
                                                <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
                                            </td>
                                            <td>
                                                <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
                                            </td>
                                            <td>
                                                <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
                                            </td><td>
                                                <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
                                            </td>
                                            <td>
                                                <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
                                            </td><td>
                                                <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
                                            </td>
                                            <td>
                                                <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
                                            </td><td>
                                                <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
                                            </td>
                                            <td>
                                                <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
                                            </td>

                                        </tr>
                                    </table><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <a href="{{route('operationNew.create')}}" class=" btn btn-primary">Back</a>
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

@endsection

@section('scripts')
<script>
    $(document).ready(function () {
        $("#register").validate({
            rules: {
                project_no: {
                    required: true
                },
                purchase_order_no: {
                    required: true
                },
                respondent_incentives: {
                    required: true
                },
                project_manager_name: {
                    required: true
                },
                quality_analyst_name: {
                    required: true
                },
                project_deliverable: {
                    required: true
                },
                questionnarie: {
                    required: true
                },
                other_document: {
                    required: true
                },
                survey_link: {
                    required: true
                },
                country_name_0: {
                    required: true
                },
                sample_target_0: {
                    required: true
                },
                sample_achieved_0: {
                    required: true
                },
                team_leader: {
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
                    url: "{{route('operationNew.store')}}",
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
                            swal({
                            title:'Form Created Successfully',
                            text:'RFQ Created Successfully',
                            icon:'success',
                            button:false
                        })
                            // flash({ msg: data.message, type: 'success' });
                            // window.location = "{{route('operationNew.index')}}";
                        }
                        else {
                            swal({
                            title:'Please Fill All Fields',
                            icon:"warning",
                            button:false
                        })
                            
                        }
                    }

                });
            }
        });
    })
</script>
<script>
$(document).ready(function(){
    html=`<tr id="addoperation">
                                            
        <td>
            <select class="form-control label-gray-3" name="country_name_0[]" id="country_name" required>
            <option class="label-gray-3" value="">Select Country</option>
                
                @if (count($country) > 0)
                @foreach($country as $value)
                <option value="{{$value->name}}">{{$value->name}}</option>
                @endforeach
                @endif
            </select>
        </td>
        <td>
            <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
        </td>
        <td>
            <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
        </td>
        <td>
            <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
        </td>
        <td>
            <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
        </td><td>
            <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
        </td>
        <td>
            <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
        </td><td>
            <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
        </td>
        <td>
            <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
        </td><td>
            <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
        </td>
        <td>
            <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
        </td>
        <td>
            <button class="btn btn-danger  ml-2" id="removeBtn" type="button">
                                            remove Industry
                                        </button>
        </td>
    </tr>`;
    $(document).on('click' ,'#addBtn',function(){
    $("#mtable").append(html);
    });
   $(document).on('click', '#removeBtn', function(){  
         $(this).closest("tr").remove();
    });


    

});
</script>
@endsection
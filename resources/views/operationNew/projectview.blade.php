@extends('layouts.master')
<style>
.card {
   margin: 40px 0 20px 0;
    border:1px solid;
 }

.card-header.header-elements-inline {
    background-color: #fff;
}
label.col-form-label.font-weight-semibold {
    font-family: "ubuntu-medium", sans-serif;
    font-weight: 500;
}
button#addFieldTeam {
    background-color: #0b5dbb;
    border-color: #0b5dbb;
}
button#addFieldTeam:hover {
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
.error{
    color:red;
    padding:10px;
}
</style>
@section('page_title', 'projectview')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
    
                    <div class="card-header header-elements-inline">
                      <div class="card-title">
                          <div class="sub-text">
                            Project File
                         </div>
                        </div>
                    </div>
                    <div class="card-body" >
                        {{-- <form  class="form col-md-12 d-flex flex-wrap" enctype="multipart/form-data" id="add_field">
                            @csrf
                            <div  id="main_div" class="col-md-9 ">
                               <div class="form-group row">
                                    <label class="col-lg-4 col-form-label font-weight-semibold">Assign Team Leader <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input name="team_leader" id="team_leader" value="" type="text" class="form-control" placeholder="Enetr Assign Team Leader">
                                    </div>
                                    <br>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label font-weight-semibold">Project Manager Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input name="project_manager_name" id="project_manager_name" value="" type="text" class="form-control" placeholder="Enetr Project Manager Name">
                                    </div>
                                    <br>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label font-weight-semibold">Quality Analyst Name <span class="text-danger">*</span></label>
                                    <div class="col-lg-6">
                                        <input name="quality_analyst_name" id="quality_analyst_name" value="" type="text" class="form-control" placeholder="Enetr Quality Analyst Name">
                                    </div>
                                </div>
                                <div class="col-md-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary" id="addFieldTeam" >Submit</button>
                                </div>
                            </div>
                        </form> --}}
                        {{-- class="table table-striped table-dark"          table-dark --}}
                        <table  id="dtHorizontalExample" class="table table-striped  table-responsive" width="100%">
                            <thead>
                              <tr>
                                <th scope="col">Project No</th>
                                <th scope="col">Purchase Order No</th>
                                <th scope="col">RFQ No</th>
                                <th scope="col">Respondent Incentives</th>
                                <th scope="col">Team Leader</th>
                                <th scope="col">Project Manager Name</th>
                                <th scope="col">Quality Analyst Name</th>
                                <th scope="col">Project Deliverable</th>
                                <th scope="col">Country Name</th>
                                <th scope="col">Comments</th>
                                <th scope="col">Status</th>
                                <!--<th scope="col">Client Name</th>-->
                                <!--<th scope="col">Client Advance</th>-->
                                <!--<th scope="col">Client Balance</th>-->
                                <!--<th scope="col">Client Finalvalue</th>-->
                                <!--<th scope="col">Client Contract</th>-->
                                <!--<th scope="col">Vendor Advance</th>-->
                                <!--<th scope="col">Vendor Balance</th>-->
                                <!--<th scope="col">Vendor Final Value</th>-->
                                <!--<th scope="col">Vendor Contract</th>-->
                                <th scope="col">Questionnarie</th>
                                <th scope="col">Other Document</th>
                                <th scope="col">Survey Link</th>
                                <!--<th scope="col">Sample Target</th>-->
                                <!--<th scope="col">Sample Achieved</th>-->
                                {{-- <th scope="col"></th> --}}
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>{{$operation && $operation->project_no ? $operation->project_no :''}}</td>
                                <td>{{$operation && $operation->purchase_order_no ? $operation->purchase_order_no :''}}</td>
                                <td>{{$operation && $operation->rfq ? $operation->rfq :''}}</td>
                                <td>{{$operation && $operation->respondent_incentives ? $operation->respondent_incentives :''}}</td>
                                <td>{{$operation && $operation->team_leader ? $operation->team_leader :''}}</td>
                                <td>{{$operation && $operation->project_manager_name ? $operation->project_manager_name :''}}</td>
                                <td>{{$operation && $operation->quality_analyst_name ? $operation->quality_analyst_name :''}}</td>
                                <td>{{$operation && $operation->project_deliverable ? $operation->project_deliverable :''}}</td>
                                <td>{{$operation && $operation->country_name ? $operation->country_name :''}}</td>
                                <td>{{$operation && $operation->comments ? $operation->comments :''}}</td>
                                <td>{{$operation && $operation->status ? $operation->status :''}}</td>
                                <!--<td>{{$operation && $operation->client_id ? $operation->client_id :''}}</td>-->
                                <!--<td>{{$operation && $operation->client_advance ? $operation->client_advance :''}}</td>-->
                                <!--<td>{{$operation && $operation->client_balance ? $operation->client_balance :''}}</td>-->
                                <!--<td>{{$operation && $operation->client_finalvalue ? $operation->client_finalvalue :''}}</td>-->
                                <!--<td>{{$operation && $operation->client_contract ? $operation->client_contract :''}}</td>-->
                                <!--<td>{{$operation && $operation->vendor_advance ? $operation->vendor_advance :''}}</td>-->
                                <!--<td>{{$operation && $operation->vendor_balance ? $operation->vendor_balance :''}}</td>-->
                                <!--<td>{{$operation && $operation->vendor_finalvalue ? $operation->vendor_finalvalue :''}}</td>-->
                                <!--<td>{{$operation && $operation->vendor_contract ? $operation->vendor_contract :''}}</td>-->
                                <td>{{$operation && $operation->questionnarie ? $operation->questionnarie :''}}</td>
                                <td>{{$operation && $operation->other_document ? $operation->other_document :''}}</td>
                                <td>{{$operation && $operation->survey_link ? $operation->survey_link :''}}</td>
                                <!--<td>{{$operation && $operation->sample_target ? $operation->sample_target :''}}</td>-->
                                <!--<td>{{$operation && $operation->sample_achieved ? $operation->sample_achieved :''}}</td>-->
                              </tr>
                              {{-- <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                              </tr>
                              <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                              </tr> --}}
                            </tbody>
                          </table>
                    </div>
                </div>
            </div>
        </div>
    </div>



<script>
    $(document).ready(function () {
        // console.log({{$operation && $operation->id ? $operation->id :''}});
    });
    //     $("#add_field").validate({
    //         rules: {
    //             team_leader: {
    //                 required: true
    //             },
    //             project_manager_name: {
    //                 required: true
    //             },
    //             quality_analyst_name: {
    //                 required: true
    //             },
              
    //         },
    //         errorPlacement: function (error, element) {
    //             if (element.hasClass("select2-hidden-accessible")) {
    //                 error.insertAfter(element.siblings('span.select2'));
    //             } 
    //             else if (element.hasClass("floating-input")) {
    //                 element.closest('.form-floating-label').addClass("error-cont").append(error);
    //             } 
    //             else {
    //                 error.insertAfter(element);
    //             }
    //         },
    //         submitHandler: function (form) {
    //             var data = $( "#add_field" ).serialize();
    //             // alert(data);
    //              $.ajax({
    //                 type: "POST",
    //                 url: "{{route('operationNew.addFieldTeam')}}",
    //                 data: data,
    //                 headers: {
    //                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                 },
    //                 success: function () {
    //                     $('#add_field')[0].reset();
    //                     alert();
    //                 },
    //                 error:function(){
    //                 alert("not saved");
    //                 }
    //             });
                                    
    //         }
    //     });
    // });
</script>
    
    
    
    @endsection
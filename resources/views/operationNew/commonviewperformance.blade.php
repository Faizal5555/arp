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
.my-second {
    margin-top: 20px;
}
button#commentsubmit {
    margin-top: 18px;
}
.card-header.header-elements-inline {
    background: linear-gradient( 43deg ,#0b5dbb,#0b5dbb);
    color: #fff;
}
.card .card-title {
    color: #fff;
}
input#respondentfile {
    text-transform: capitalize;
}
input#clientinvoicefile{
    text-transform: capitalize;
}
input#vendorinvoicefile {
    text-transform: capitalize;
}
input#client_confirmation{
    text-transform: capitalize;
}
input#vendor_confirmation{
   text-transform: capitalize;
}
input.form-control {
    text-transform: capitalize;
}
.msg-bubble {
    padding: 15px;
    border-radius: 15px;
    background: #ececec;
}
.msg-info-name {
    margin-right: 10px;
    font-weight: bold;
}
.msg-bubble1 {
    padding: 15px;
    border-radius: 15px;
    background: #579ffb;
}
.msg-text1 {
    color: #fff;
}
.msg-info-name1 {
    color: #fff;
}
.msger-inputarea {
    display: flex;
    padding: 10px;
    border-top: #ddd;
    background: #eee;
}
.msger-input {
    flex: 1;
    background: #ddd;
}
.msger-send-btn {
    margin-left: 10px;
    background: rgb(0, 196, 65);
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.23s;
}
.msger-inputarea * {
    padding: 10px;
    border: none;
    border-radius: 3px;
    font-size: 1em;
}
.right-msg .msg-bubble {
    background: #579ffb;
    color: #fff;
    border-bottom-right-radius: 0;
}
.form-control:disabled, .form-control[readonly] {
    background-color: #e9ecef;
    opacity: 1;
    color: black;
}
</style>
@section('page_title', 'Operation New Project')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header header-elements-inline">
                <div class="card-title" style="color: #fff;">Operation New Project</div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <form id="update" class="form col-md-12 d-flex flex-wrap"
                           enctype="multipart/form-data">
                           @csrf
                          <input type="hidden" name="id"  id="id" value="{{$operation && $operation->id ? $operation->id :''}}">
                           
                          <input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount"> 
                          <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Project No <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="project_no" value="{{$operation && $operation->project_no ? $operation->project_no :''}}" type="text" class="form-control" readonly="readonly">
                                    </div>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">PO number <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="purchase_order_no" value ="{{$operation && $operation->purchase_order_no ? $operation->purchase_order_no:''}}"
                                             type="text" class="form-control"  readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Respondent Incentives <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="respondent_incentives" value="{{$operation && $operation->respondent_incentives ? $operation->respondent_incentives :''}}"
                                             type="text" class="form-control" placeholder="Respondent Incentives"  readonly="readonly">
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
                                        <select class="form-control label-gray-3" name="team_leader" disabled>
                                            @if(count($user)>0)
                                            @foreach ($user as $item)
                                            <option class="label-gray-3" value="{{$item->id}}"{{ $operation->team_leader == $item->id ? 'selected' :'' }}>{{$item->name}}</option>
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
                                             <select class="form-control label-gray-3" name="project_manager_name" disabled>
                                                @if(count($user1)>0)
                                                @foreach ($user1 as $item)
                                                <option class="label-gray-3" value="{{$item->id}}"{{$operation->project_manager_name == $item->id ? 'selected' :''}}>{{$item->name}}</option>
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
                                            <select class="form-control label-gray-3" name="quality_analyst_name" disabled>
                                                @if(count($user2)>0)
                                                @foreach ($user2 as $item)
                                                <option class="label-gray-3" value="{{$item->id}}"{{$operation->quality_analyst_name == $item->id ? 'selected' :''}}>{{$item->name}}</option>
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
                                        <input name="project_deliverable" value="{{$operation && $operation->project_deliverable ? $operation->project_deliverable:''}}"
                                             type="text" class="form-control" placeholder="Project Deliverables"  readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Attach Questionnaire <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9 d-flex">
                                        <input name="questionnarie" value="{{$operation && $operation->questionnarie ? $operation->questionnarie : ''}}"
                                             type="text" id="my-questionnarie" class="form-control" placeholder="Attach Questionnaire"  readonly="readonly">
                                             <a target="_blank" download href="{{url($operation && $operation->questionnarie ? $operation->questionnarie : '')}}" class="mdi mdi-download" style="
                                         margin-top: 10px;
                                     "></a>
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Attach Other Documents <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                   
                                     @foreach($operation->operationNewImage as $k=> $value)
                                        <div class="division_{{$value->id}} d-flex" >
                                     
                                          <input name="other_document[]"  value="{{$value && $value->other_documents  ? $value->other_documents  : ''}}"
                                             type="text"  class="form-control mb-2" name="other_document[]" placeholder="Attach Other Documents"  readonly="readonly">
                                              <a download href="{{url($value && $value->other_documents  ? $value->other_documents  : '')}}" target="_blank" class="other_document_{{$k}} mdi mdi-download"style="
                                         margin-top: 10px;
                                     "></a>
                                              </div>
                                             <div id="other_document"></div>
                                    
                                        
                                     @endforeach
                                   
                                       </div>
                                       
                                    </div>
                                </div>
                       
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Attach Survey Link <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9 d-flex">
                                    
                                        <input name="survey_link" value="{{$operation && $operation->survey_link  ? $operation->survey_link  : ''}}"
                                             type="text" id="my-survey_link"  class="form-control" placeholder="Attach Survey Link"  readonly="readonly">
                                             <a target="_blank" download href="{{url($operation && $operation->survey_link  ? $operation->survey_link  : '')}}" class="mdi mdi-download" style="
                                         margin-top: 10px;
                                     "></a>
                                    </div>
                                </div>
                            </div>
                            <!--<div class="col-md-6">-->
                            <!--    <div class="form-group row">-->
                            <!--        <label class="col-lg-3 col-form-label font-weight-semibold">comments <span-->
                            <!--                class="text-danger">*</span></label>-->
                            <!--        <div class="col-lg-9">-->
                            <!--            @if(auth()->user()->user_type =="operation")-->
                            <!--            <textarea type="text"  name="comments" value="{{$operation && $operation->comments   ? $operation->comments   : ''}}"-->
                            <!--                   class="form-control comments" placeholder="comments">{{$operation && $operation->comments   ? $operation->comments   : ''}}</textarea>-->
                            <!--            @else-->
                            <!--             <textarea type="text"  name="comments" value="{{$operation && $operation->comments   ? $operation->comments   : ''}}"-->
                            <!--                   class="form-control comments" placeholder="comments" readonly>{{$operation && $operation->comments   ? $operation->comments   : ''}}</textarea>-->
                            <!--            @endif-->
                            <!--        </div>-->
                            <!--    </div>-->
                            <!--</div>-->
                            <div class="col-md-12 ">
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label font-weight-semibold">Target Table<span
                                            class="text-danger"></span></label>
                                            <!--<button class="btn btn-danger  ml-2"  style="float: right;"id="addBtn" type="button">-->
                                            <!--    Add New Country-->
                                            <!--</button>-->
                                    <div class="col-md-12 table-responsive" style="overflow-x:auto;">
                                    
                                        <?php
                                        $world=explode(",",$operation->country_name);
                                        $sample_target=json_decode($operation->sample_target,true);
                                        $sample_achieved=json_decode($operation->sample_achieved,true);
                                        $target_group=explode(",",$operation->target_group);
                                        
                                        ?>  
                                       
                                        {{-- <button class="btn btn-danger  ml-2" class="removeBtn" type="button">
                                            remove Industry
                                        </button> --}}
                                    <table border="1" name="" id="mtable">
                                      
                                        <tr>
                                            <th class="operation-country">Country</th>
                                          
                                            @foreach($target_group as $rrr=> $data)
                                            <th colspan="2" style="text-align: center">
                                            <input type="text" class="form-control" name="target_group[{{$rrr}}]" style="text-align: center" value="{{$data}}" readonly="readonly">
                                        </th>
                                            @endforeach
                                            
                                        </tr>
                                        <tr>
                                            <td></td>
                                            <td style="text-align: center">Sample Target</td>
                                            <td style="text-align: center">Sample Achieved</td>
                                            <td style="text-align: center">Sample Target</td>
                                            <td style="text-align: center">Sample Achieved</td>
                                            <td style="text-align: center">Sample Target</td>
                                            <td style="text-align: center">Sample Achieved</td>
                                            <td style="text-align: center">Sample Target</td>
                                            <td style="text-align: center">Sample Achieved</td>
                                            <td style="text-align: center">Sample Target</td>
                                            <td style="text-align: center">Sample Achieved</td>
                                            <td style="text-align: center">Sample Target</td>
                                            <td style="text-align: center">Sample Achieved</td>
                                        </tr>
                                            
                                                
                                               
                                                    
                                            @foreach ($world as $c=> $data )
                                            <tr>
                                                <td >
                                               
                                                <select class="form-control label-gray-" name="country_name_0[]" id="country_name" disabled>
                                                    <option class="label-gray-3" value="{{$data}}" disabled>Country</option>
                                                        
                                                        @if (count($country) > 0)
                                                        @foreach($country as $key=> $value)
                                                         
                                                            <option value="{{$value->name}}" {{$data == $value->name ? 'selected' :'' }}>{{$value->name}}
                                                            </option>
                                                        @endforeach
                                                        @endif
                                                    </select>
                                                    </td>   
                                                     
                                                      
                                                     
                                                        @foreach ($sample_target  as $k1=> $value1)  
                                                          
                                                        @if($c == $k1)
                                                        @foreach($value1 as $k11=> $data)
                                                          
                                                     
                                                           
                                                            
                                                            <td>
                                                                <input type="text" value="{{$data}}"class="border-0" name="sample_target_0[{{$c}}][]" placeholder="Sample Target"  readonly="readonly">
                                                            </td>
                                                            <td>
                                                                <input type="text" value="{{$sample_achieved[$c][$k11]}}"class="border-0" name="sample_achieved_0[{{$c}}][]" placeholder="Sample Target"  readonly="readonly">
                                                            </td>
                                                            
                                                            @endforeach
                                                            @endif
                                                        @endforeach



                                        </tr>
                                                            @endforeach  
                                    </table><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <a href="{{route('operationNew.fieldperfomance')}}" class=" btn btn-primary">Back</a>
                                <!--<button type="submit" id="addRegisterButton"-->
                                <!--    class="btn btn-success ml-2">Update</button>-->
                                    
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- header popup --}}
<div class="modal fade bd-example-modal-lg" id="exampleModal"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                     @if(auth()->user()->user_type == 'operation' or auth()->user()->user_type == 'admin' )
                    <div class="col-md-4">
                       
                          <button type="button" class="btn btn-primary" id="my-comments" data-toggle="modal" data-target="#exampleModalCenter">
                            view Comments 
                          </button>
                    </div>
                   
                    <div class="col-md-4">
                        <div class="middle">
                        <button type="button" class="btn btn-primary" id="my-stop" data-toggle="modal" data-target="#exampleModalCenterstop">
                            Project Stopped In The Middle
                          </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <button type="button" class="btn btn-primary" id="client-topic" data-toggle="modal" data-target="#exampleModalCenterstopclient">
                            Client Invoice Request
                          </button>
                    </div>
                     @elseif(auth()->user()->user_role == 'team_leader')
                       <div class="col-md-4">
                          <button type="button" class="btn btn-primary" id="tl-comments" data-toggle="modal" data-target="#tlexampleModalCenter">
                            Open Comments Box
                          </button>
                    </div>
                      <div class="col-md-4">
                        <div class="middle">
                        <button type="button" class="btn btn-primary" id="my-stop" data-toggle="modal" data-target="#exampleModalCenterstop">
                            Project Stopped In The Middle
                          </button>
                        </div>
                    </div>
                
                    <div class="col-md-4">
                         <button type="button" class="btn btn-primary" id="client-topic" data-toggle="modal" data-target="#exampleModalCenterstopclient">
                            Client Invoice Request
                          </button>
                    </div>
                     @elseif(auth()->user()->user_role == 'project_manager')
                       <div class="col-md-4">
                          <button type="button" class="btn btn-primary" id="pl-comments" data-toggle="modal" data-target="#pmexampleModalCenter">
                            Open Comments Box
                          </button>
                    </div>
                      <div class="col-md-4">
                        <div class="middle">
                        <button type="button" class="btn btn-primary" id="my-stop" data-toggle="modal" data-target="#exampleModalCenterstop">
                            Project Stopped In The Middle
                          </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <button type="button" class="btn btn-primary" id="client-topic" data-toggle="modal" data-target="#exampleModalCenterstopclient">
                            Client Invoice Request
                          </button>
                    </div>
                     @else
                       <div class="col-md-4">
                          <button type="button" class="btn btn-primary" id="ql-comments" data-toggle="modal" data-target="#qlexampleModalCenter">
                            Open Comments Box
                          </button>
                    </div>
                      <div class="col-md-4">
                        <div class="middle">
                        <button type="button" class="btn btn-primary" id="my-stop" data-toggle="modal" data-target="#exampleModalCenterstop">
                            Project Stopped In The Middle
                          </button>
                        </div>
                    </div>
                    <div class="col-md-4">
                         <button type="button" class="btn btn-primary" id="client-topic" data-toggle="modal" data-target="#exampleModalCenterstopclient">
                            Client Invoice Request
                          </button>
                    </div>
                    
                     @endif
                    
                </div>
             <div class="my-second">
                <div class="row">
                    <div class="col-md-3">

                    </div>
                    <div class="vendor">
                    <div class="col-md-3">        
                        <button type="button" class="btn btn-primary" id="vendor-topic" data-toggle="modal" data-target="#exampleModalCenterstopvendor">
                            Vendor Invoice Request 
                          </button>
                    </div>
                </div>
                    <div class="col-md-3">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCentercompleted">
                            Project Completed 
                          </button>
                    </div>
                    <div class="col-md-3"></div>
                </div>
            </div>
            </div>
            <div class="modal-footer">
            </div>
          </div>
    </div>
  </div>
  {{-- end header popup --}}


  <!--  Open Comments BOX-->

  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Comments BOX</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
    <!--    <form id="commentupdate" enctype="multipart/form-data">-->
    <!--        @csrf-->
    <!--        <input type="hidden" name="id"  id="id" value="{{$operation && $operation->id ? $operation->id : ''}}">-->
    <!--        <label class="col-lg-3 col-form-label font-weight-semibold">Comments<span-->
    <!--            class="text-danger">*</span></label>-->
    <!--    <div class="col-lg-9">-->
    <!--       {{-- {{dd($operation->comments)}} --}}-->
    <!--        <textarea name="comments" id="comments" value=""-->
    <!--        class="form-control" placeholder="Comments here..." required></textarea>-->
    <!--    </div>-->
    <!--    <div class="col-lg-9">-->
    <!--    Save changes</button>-->
    <!--    </div>-->
    <!--</form>   -->
    
         <div class="msg-bubble">
                 <div class="msg-info">
                  <div class="msg-info-name">Team Leader</div>
                </div>

            <div class="msg-text">
               {{$operation && $operation->tl_msg ? $operation->tl_msg : ''}}
            </div>
           </div>
           
           <div class="msg-bubble mt-3">
                 <div class="msg-info">
                  <div class="msg-info-name">Project Manager</div>
                </div>

            <div class="msg-text">
               {{$operation && $operation->pm_msg ? $operation->pm_msg : ''}}
            </div>
           </div>
           
           <div class="msg-bubble mt-3">
                 <div class="msg-info">
                  <div class="msg-info-name">Quality Analyst</div>
                </div>

            <div class="msg-text">
               {{$operation && $operation->ql_msg ? $operation->ql_msg : ''}}
            </div>
           </div>
           
           @if($operation->comments!='')
            <div class="right-msg mt-3 col-md-12">
                <div class="col-md-3"></div>
                <div class="msg-bubble mt-3">
                    <div class="col-md-6">
                 <div class="msg-info">
                  <div class="msg-info-name">You</div>
                </div>

            <div class="msg-text">
               {{$operation && $operation->comments ? $operation->comments : ''}}
            </div>
            </div>
            </div>
           </div>
           @endif
           
           
           
           <div class="msger-inputarea mt-3">
             <textarea name="comments" id="comments" value=""
            class="form-control msger-input" placeholder="Comments here..." required></textarea>
            <button type="button" id="commentsubmit" class="msger-send-btn">Send</button>
          </div>
           
           
        </div>
        
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
    <!--  Open Comments BOX End-->

<!--  Open team leader Comments BOX-->

  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="tlexampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Comments BOX</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="tlcommentupdate" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id"  id="id" value="{{$operation && $operation->id ? $operation->id : ''}}">
             <div class="msg-bubble">
                 <div class="msg-info">
                  <div class="msg-info-name">operation</div>
                </div>

            <div class="msg-text">
               {{$operation && $operation->comments ? $operation->comments : ''}}
            </div>
           </div>
             @if($operation->tl_msg!='')
            <div class="right-msg mt-3 col-md-12">
                <div class="col-md-3"></div>
                <div class="msg-bubble mt-3">
                    <div class="col-md-6">
                 <div class="msg-info">
                  <div class="msg-info-name">You</div>
                </div>

            <div class="msg-text">
               {{$operation && $operation->tl_msg ? $operation->tl_msg : ''}}
            </div>
            </div>
            </div>
           </div>
           @endif
           
           <div class="msger-inputarea mt-3">
               <textarea name="tl_comments" id="tl_comments" value=""
            class="form-control msger-input" placeholder="Comments here..." required></textarea>
             <button type="button" id="tlcommentsubmit" class="msger-send-btn">Send</button>
          </div>
           
        </form>   
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
    <!--  Open team leader Comments BOX End-->
    
    

<!--  Open Project Manager Comments BOX-->

  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="pmexampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Comments BOX</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            
            <form id="pmcommentupdate" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id"  id="id" value="{{$operation && $operation->id ? $operation->id : ''}}">
             <div class="msg-bubble">
                 <div class="msg-info">
                  <div class="msg-info-name">operation</div>
                </div>

            <div class="msg-text">
               {{$operation && $operation->comments ? $operation->comments : ''}}
            </div>
           </div>
           
            @if($operation->pm_msg!='')
            <div class="right-msg mt-3 col-md-12">
                <div class="col-md-3"></div>
                <div class="msg-bubble mt-3">
                    <div class="col-md-6">
                 <div class="msg-info">
                  <div class="msg-info-name">You</div>
                </div>

            <div class="msg-text">
               {{$operation && $operation->pm_msg ? $operation->pm_msg : ''}}
            </div>
            </div>
            </div>
           </div>
           @endif
           
           <div class="msger-inputarea mt-3">
             <textarea name="pm_comments" id="pm_comments" value=""
            class="form-control msger-input" placeholder="Comments here..." required></textarea>
             <button type="button" id="pmcommentsubmit" class="msger-send-btn">Send</button>
          </div>
           
        </form>   
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
    <!--  Open Project Manager Comments BOX End-->
    
    <!--  Open Qulity Analist Comments BOX-->

  <!-- Modal -->
  <div class="modal fade bd-example-modal-lg" id="qlexampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">Comments BOX</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="qlcommentupdate" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id"  id="id" value="{{$operation && $operation->id ? $operation->id : ''}}">
             <div class="msg-bubble">
                 <div class="msg-info">
                  <div class="msg-info-name">operation</div>
                </div>

            <div class="msg-text">
               {{$operation && $operation->comments ? $operation->comments : ''}}
            </div>
           </div>
           
           @if($operation->ql_msg!='')
            <div class="right-msg mt-3 col-md-12">
                <div class="col-md-3"></div>
                <div class="msg-bubble mt-3">
                    <div class="col-md-6">
                 <div class="msg-info">
                  <div class="msg-info-name">You</div>
                </div>

            <div class="msg-text">
               {{$operation && $operation->ql_msg ? $operation->ql_msg : ''}}
            </div>
            </div>
            </div>
           </div>
           @endif
           
           <div class="msger-inputarea mt-3">
            <textarea name="ql_comments" id="ql_comments" value=""
            class="form-control msger-input" placeholder="Comments here..." required></textarea>
             <button type="button" id="qlcommentsubmit" class="msger-send-btn">Send</button>
          </div>
          
        </div>
        <div class="modal-footer">
        </div>
      </div>
    </div>
  </div>
    <!--  Open Project Manager Comments BOX End-->
    
    
    

      <!-- Project stopped in the middle-->

    <div class="modal fade" id="exampleModalCenterstop" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle"> Project Stopped In The Middle</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="{{$operation && $operation->id ? $operation->id :''}}">
             <label>Are You Sure Project Stopped In The Middle </label>
             <button type="button" class="btn btn-primary" id="stop">Yes</button>
             <button type="button" class="btn btn-secondary"  data-dismiss="modal">No</button>
            </div>
            <div class="modal-footer">
              
            </div>
          </div>
        </div>
    </div>
    
    
      <!-- end Project stopped in the middle-->
    


    
        <!-- Client Invoice Request-->
        <div class="modal fade bd-example-modal-lg" id="exampleModalCenterstopclient"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLongTitle">Client Invoice Request</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                    <div class="row">
               
                              <div class="col-md-6">
                                <button type="button"  id="advanceinvoice" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenteradvance">
                                    Advance Invoice   
                                  </button>
                             </div>
                             
                              <div class="col-md-6">
                                <button type="button"  id="balanceinvoice" class="btn btn-primary" data-toggle="modal" data-target="#clientbalance1">
                                    Final Invoice   
                                  </button>
                             </div>
                              <!--<div class="col-md-4">-->
                              <!--    <button type="button"  id="clientfinal" class="btn btn-primary" data-toggle="modal" data-target="#clientfinalvalue">-->
                              <!--       Final Invoice Value -->
                              <!--    </button>-->
                              <!--</div>-->
                            </div>
                        </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <!--<button type="button" class="btn btn-primary">Save changes</button>-->
                </div>
              
            </div>
          </div>
        </div>
   
      <!-- end Client Invoice Request-->

    
    <!-- Modal -->
        <!--Vendor Invoice Request Invoice Request-->

    <div class="modal fade bd-example-modal-lg" id="exampleModalCenterstopvendor" tabindex="-1" role="dialog"        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Vendor Invoice Request       </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="row">
                  <div class="col-md-6">
                <button type="button"  id="vendoradvance1" class="btn btn-primary" data-toggle="modal" data-target="#samplevendoradvance">
                    Advance Invoice   
                  </button>
                  </div>
                  <div class="col-md-6">
                  <button type="button"  id="vendorbalance1" class="btn btn-primary" data-toggle="modal" data-target="#samplevendorbalanc">
                    Final Invoice   
                  </button>
                  </div>
                  <!--<div class="col-md-4">-->
                  <!--    <button type="button"  id="vendorfinal" class="btn btn-primary" data-toggle="modal" data-target="#vendorfinalvalue">Final Invoice Value</button>-->
                  <!--</div>-->
                  </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <!--<button type="button" class="btn btn-primary">Save changes</button>-->
            </div>
          </div>
        </div>
      </div>
      <!-- end Vendor Invoice Request       -->

   <!--Vendor Invoice Request Invoice Request-->
      
       <div class="modal fade bd-example-modal-lg" id="exampleModalCentercompleted"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Project Completed</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div  id="main_div" class="col-md-9 ">
        <form id="complete" enctype="multipart/form-data">
                @csrf
                    <div class="form-group row">
                         <label class="col-lg-6 col-form-label font-weight-semibold">Client Advance Invoice Paid <span class="text-danger">*</span></label>
                         <div class="col-lg-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="clientadvance" id="clientadvance" value="Yes">
                                <label class="form-check-label" for="ClientAdvance">Yes</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="clientadvance" id="clientadvance" value="No">
                                <label class="form-check-label" for="ClientAdvance">No</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="clientadvance" id="clientadvance" value="NA">
                                <label class="form-check-label" for="ClientAdvance">NA</label>
                              </div>
                        </div>
                     </div>
                     <div class="form-group row">
                         <label class="col-lg-6 col-form-label font-weight-semibold">Client Balance Invoice Paid <span class="text-danger">*</span></label>
                         <div class="col-lg-6">
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="clientbalance" id="clientbalance" value="Yes">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="clientbalance" id="clientbalance" value="No">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                              </div>
                               <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="clientbalance" id="clientbalance" value="NA">
                                <label class="form-check-label" for="clientbalance">NA</label>
                              </div>
                           
                         </div>
                         <br>
                     </div>

                     <div class="form-group row">
                        <label class="col-lg-6 col-form-label font-weight-semibold">Vendor Advance Invoice Paid  <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                           <div class="form-check form-check-inline">
                               <input class="form-check-input" type="radio" name="vendoradvance" id="vendoradvance" value="Yes">
                               <label class="form-check-label" for="inlineRadio1">Yes</label>
                             </div>
                             <div class="form-check form-check-inline">
                               <input class="form-check-input" type="radio" name="vendoradvance" id="vendoradvance" value="No">
                               <label class="form-check-label" for="inlineRadio2">No</label>
                             </div>
                             <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="vendoradvance" id="vendoradvance" value="NA">
                                <label class="form-check-label" for="vendoradvance">NA</label>
                              </div>
                        </div>
                    </div>

                     <div class="form-group row">
                         <label class="col-lg-6 col-form-label font-weight-semibold">Vendor Balance Invoice Paid  <span class="text-danger">*</span></label>
                         <div class="col-lg-6">
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="vendorbalance" id="vendorbalance" value="Yes">
                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="vendorbalance" id="vendorbalance" value="No">
                                <label class="form-check-label" for="inlineRadio2">No</label>
                              </div>
                              <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="vendorbalance" id="vendorbalance" value="NA">
                                <label class="form-check-label" for="vendorbalance">NA</label>
                              </div>
                         </div>
                     </div>



                     <div class="form-group row">
                        <label class="col-lg-6 col-form-label font-weight-semibold">Attach Respondent Incentive File <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input name="respondentfile" value=""
                            id="respondentfile" type="file" class="form-control p-1" placeholder="Attach Respondent incentive file">
                          
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-lg-6 col-form-label font-weight-semibold">Attach Client Invoice File<span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input name="clientinvoicefile" value=""
                            id="clientinvoicefile" type="file" class="form-control p-1" placeholder="Attach Client invoice file">
                          
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-6 col-form-label font-weight-semibold">Attach Vendor Invoice File <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input name="vendorinvoicefile" value=""
                            id="vendorinvoicefile" type="file" class="form-control p-1" placeholder="Attach vendorinvoicefile">
                          
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-lg-6 col-form-label font-weight-semibold">Attach Client Confirmation Email <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input name="client_confirmation" value=""
                            id="client_confirmation" type="file" class="form-control p-1" placeholder="Attach Client project Confirmation Email">
                          
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-6 col-form-label font-weight-semibold">Attach Vendor Confirmation Email <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input name="vendor_confirmation" value=""
                            id="vendor_confirmation" type="file" class="form-control p-1" placeholder="Attach Vendor Confirmation Email">
                          
                        </div>
                    </div>

                     <div class="col-md-12 d-flex justify-content-end">
                         <button type="submit"  class="btn btn-primary"  >Submit</button>
                     </div>
                 </div>
       </form>
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
      <!-- end Vendor Invoice Request       -->


      {{-- status bar --}}
      <div class="modal fade" id="statusbar" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Status </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
               
                <div class="row">
                    <div class="col-md-12 d-flex justify-content-center text-center">
                        <div class="row">
                            <div class="col-md-6" id="project_hold">
                               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenterhold">
                                Project Ongoing /Hold 
                                 </button>
                            </div>
                            <div class="col-md-6" id="project_closed">
                               <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenterstscompleted">
                                Project Completed 
                                 </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="modal-footer">
              
            </div>
          </div>
        </div>
    </div>
     {{-- status bar --}}



      <div class="modal fade" id="exampleModalCenterhold" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle"> Project Ongoing /Hold  </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="{{$operation && $operation->id ? $operation->id :''}}">
             <label>Are you  Project Ongoing /Hold  </label>
             <button type="button" class="btn btn-primary" id="hold">yes</button>
             <button type="button" class="btn btn-secondary"  data-dismiss="modal">no</button>
             
            </div>
            <div class="modal-footer">
              
            </div>
          </div>    
        </div>
    </div>


    <div class="modal fade" id="exampleModalCenterstscompleted" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle"> Project Completed  </h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <input type="hidden" name="id" value="{{$operation && $operation->id ? $operation->id :''}}">
             <label>Are you sure that you want to close the project  </label>
              <button type="button" class="btn btn-primary" id="stscomplete">yes</button>
             <button type="button" class="btn btn-secondary"  data-dismiss="modal">no</button>
            
            </div>
            <div class="modal-footer">
              
            </div>
          </div>
        </div>
    </div>


  {{-- client advance balance list-wonproject --}}

    <div class="modal fade" id="exampleModalCenteradvance" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" > Advance Invoice     </h5>
              <button type="button"   class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <form  enctype="multipart/form-data">
                    @csrf

                {{-- important --}}
             <div class="form-group">   
             <input type="hidden" name="operation_id" id="operation_id" class="form-control" value="{{$operation && $operation->id ? $operation->id :''}}">
             <input type="hidden" name="id" id="advanceid" class="form-control" value="{{$operation && $operation->rfq ? $operation->rfq :''}}">
             <input type="hidden" name="invoice_type" value="advance" id="invoice_type">
            </div>

             {{-- important --}}
               <div class="form-group">  
                <label>Client Name</label>    
                <input type="type" name="client_id" id="client_id" class="form-control">
               </div>

               <div class="form-group">  
                <label>Client Advance</label>    
                <input type="type" name="client_advance" id="client_advance" class="form-control">
               </div>

               <div class="form-group">  
                <label>Client Contract </label>    
                <input type="type" name="client_contract" id="client_contract" class="form-control">
               </div>
               <div class="modal-footer d-flex justify-content-between">
                   <a href="/operationNew/projectview/{{$operation && $operation->id ? $operation->id :''}}" style="color:green;text-decoration: none;" class="d-flex justify-content-start">Project File</a>
                    <button value="submit" class="btn btn-success" id="client_Advance_request">Submit</button>
               </div>

               
            <!--<div class="modal-footer">-->
            </form>
              
            <!--</div>-->
          </div>
        </div>
    </div>
</div>



<div class="modal fade" id="clientbalance1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle"> Balance Invoice </h5>
          <button type="button"  class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form enctype="multipart/form-data">
                    @csrf
            {{-- important --}}
            <input type="hidden" name="operation_id" id="operationid" class="form-control" value="{{$operation && $operation->id ? $operation->id :''}}">
            <input type="hidden" name="invoice_type" value="balance" id="invoice_type1">
         <div class="form-group">  
         <!--<label>Client Name</label>    -->
         <input type="hidden" name="id" id="balanceid" class="form-control" value="{{$operation && $operation->rfq ? $operation->rfq :''}}">
        </div>
           {{--end  important --}}
        <div class="form-group">  
            <label>Client Name</label>    
            <input type="type" name="client_id" id="clientid" class="form-control">
           </div>

           <div class="form-group">  
            <label>Client Balance</label>    
            <input type="type" name="client_balance" id="client_balance" class="form-control">
           </div>
           <div class="form-group">  
            <label>Client Contract </label>    
            <input type="type" name="client_contract" id="clientcontract" class="form-control">
           </div>
           <div class="modal-footer d-flex justify-content-between">
           <a href="/operationNew/projectview/{{$operation && $operation->id ? $operation->id :''}}" style="color:green;text-decoration: none;" class="d-flex justify-content-start">Project File</a>
           <button value="submit" class="btn btn-success" id="client_balance_request">Submit</button>
           </div>
           
        </div>
    </div>
   </div>
</div>


       {{--  end  client advance balance list-wonproject --}}
       
<!--{{-- for client final value --}}-->
    <!--    <div class="modal fade" id="clientfinalvalue" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">-->
    <!--        <div class="modal-dialog modal-dialog-centered" role="document">-->
    <!--          <div class="modal-content">-->
    <!--            <div class="modal-header">-->
    <!--              <h5 class="modal-title" id="exampleModalLongTitle"> Final Invoice Value </h5>-->
    <!--              <button type="button"  class="close" data-dismiss="modal" aria-label="Close">-->
    <!--                <span aria-hidden="true">&times;</span>-->
    <!--              </button>-->
    <!--            </div>-->
               
               
    <!--            <div class="modal-body">-->
    <!--                <form id="client_final_value" enctype="multipart/form-data" > <!--id="client_final_value"-->
    <!--                @csrf -->
    <!--                    {{-- important --}}-->
    <!--                     <div class="form-group">  -->
    <!--                        <label>Client Name</label>    -->
                             <!--<input type="type" name="client_final_id" id="client_final_id" class="form-control" value={{$operation && $operation->client_id ? $operation->client_id :'-'}} readonly>-->
                             <!--<input type="type" name="client_id" id="clientid" class="form-control">-->
    <!--                         <input type="hidden" name="client_final_id" id="client_final_id" class="form-control" value="{{$operation && $operation->rfq ? $operation->rfq :''}}">-->
    <!--                         <input type="type" name="client_final" id="client_final" class="form-control" readonly >-->
    <!--                    </div>-->
    <!--                    {{--end  important --}}-->
    <!--                    <div class="form-group"> -->
    <!--                        <label>Final Invoice Value </label>    -->
    <!--                        <input type="type" name="client_final_val" id="client_final_val" class="form-control" value={{$operation && $operation->client_final_invoice ? $operation->client_final_invoice :''}}>-->
    <!--                    </div>-->
    <!--                    <div class="col-md-12 d-flex justify-content-end">-->
    <!--                         <button type="submit"  class="btn btn-success" id="client_final_value" >Submit</button>-->
    <!--                    </div>-->
                    
    <!--            </div>-->
    <!--            </form>-->
            
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
        

<!--{{-- for end client final value --}}       -->
       
       

    
       <div class="modal fade" id="samplevendoradvance" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" > Advance Invoice     </h5>
              <button type="button"   class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body" id="main-body">
            <form enctype="multipart/form-data">
                @csrf
                {{-- important --}}
             <div class="form-group">   
            <input type="hidden" name="operation_id" id="venid" class="form-control" value="{{$operation && $operation->id ? $operation->id :''}}">
            <input type="hidden" name="id" id="vendoradvanceid" class="form-control" value="{{$operation && $operation->rfq ? $operation->rfq :''}}">
            <input type="hidden" name="invoice_type" value="advance" id="vendor_invoice_type">
            </div>

             {{-- important --}}
             <div class="col-md-12" id="vendor-template">

             </div>
              
              



          </div>
        </div>
    </div>
   </div>
   <!--samplevendorbalance-->
    <div class="modal fade" id="samplevendorbalanc" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" > Balance Invoice     </h5>
          <button type="button"   class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
        <form enctype="multipart/form-data">
                @csrf

            {{-- important --}}
         <div class="form-group">   
         <input type="hidden" name="operation_id" id="venid1" class="form-control" value="{{$operation && $operation->id ? $operation->id :''}}">
         <input type="hidden" name="id" id="vendorbalanceid" class="form-control" value="{{$operation && $operation->rfq ? $operation->rfq :''}}">
         <input type="hidden" name="invoice_type" value="balance" id="vendor_invoice_type1">
        </div>

         {{-- important --}}

         <div class="col-md-12" id="vendor_template1">

         </div>
        
      </div>
    </div>
</div>
</div>

<!--{{-- for vendor final value --}}-->
    <!--    <div class="modal fade" id="vendorfinalvalue" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">-->
    <!--        <div class="modal-dialog modal-dialog-centered" role="document">-->
    <!--          <div class="modal-content">-->
    <!--            <div class="modal-header">-->
    <!--              <h5 class="modal-title" id="exampleModalLongTitle"> Final Invoice Value </h5>-->
    <!--              <button type="button"  class="close" data-dismiss="modal" aria-label="Close">-->
    <!--                <span aria-hidden="true">&times;</span>-->
    <!--              </button>-->
    <!--            </div>-->
               
               
    <!--            <div class="modal-body">-->
    <!--                <form  enctype="multipart/form-data" >-->
    <!--                @csrf -->
    <!--                    {{-- important --}}-->
    <!--                     <div class="form-group">  -->
    <!--                        <label>Vendor Name</label>    -->
                             <!--<input type="type" name="client_final_id" id="client_final_id" class="form-control" value={{$operation && $operation->client_id ? $operation->client_id :'-'}} readonly>-->
                             <!--<input type="type" name="client_id" id="clientid" class="form-control">-->
    <!--                         <input type="hidden" name="vendor_final_id" id="vendor_final_id" class="form-control" value="{{$operation && $operation->rfq ? $operation->rfq :''}}">-->
    <!--                         <input type="type" name="vendor_final" id="vendor_final" class="form-control" readonly>-->
    <!--                    </div>-->
    <!--                    {{--end  important --}}-->
    <!--                    <div class="form-group"> -->
    <!--                        <label>Final Invoice Value </label>    -->
    <!--                        <input type="type" name="vendor_final_val" id="vendor_final_val" class="form-control" value={{$operation && $operation->vendor_final_invoice ? $operation->vendor_final_invoice :''}}>-->
    <!--                    </div>-->
    <!--                    <div class="col-md-12 d-flex justify-content-end">-->
    <!--                         <button type="submit"  class="btn btn-success" id="vendor_final_value" >Submit</button>-->
    <!--                    </div>-->
                    
    <!--            </div>-->
    <!--            </form>-->
            
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
        

<!--{{-- for end vendor final value --}}       -->


@endsection

@section('css')

@endsection

@section('scripts')

{{-- update --}}
<script>
        $("#update").validate({
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
                // questionnarie: {
                //     required: true
                // },
                // other_document: {
                //     required: true
                // },
                // survey_link: {
                //     required: true
                // },
                country_name_0: {
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
                    url: "{{route('operationNew.update')}}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        if (data.success == 1) {
                            
                            $('#exampleModal').modal('show');
                        //     swal({
                        //     title:'Form Created Successfully',
                        //     text:'RFQ Created Successfully',
                        //     icon:'success',
                        //     button:false
                        // })
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
</script>
{{-- end update --}}

{{-- data append --}}
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
        </td>
        <td>
            <button class="btn btn-danger  ml-2" id="removeBtn" type="button">
                                            Remove Country
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
{{-- end data append --}}

<script>
    $(document).on('click','#client-topic',function(){
        $('#exampleModal').modal('hide');
    });
     $(document).on('click','#vendor-topic',function(){
        $('#exampleModal').modal('hide');
    });
</script>

{{-- project completed script --}}
<script>
$("#complete").validate({
    rules:{
        clientadvance:{
            required: true
        },
        clientbalance:{
            required: true
        },
        vendoradvance:{
            required: true
        },
        vendorbalance:{
            required:true
        },
        respondentfile:{
            required: true
        },
        clientinvoicefile:{
            required:true
        },
        vendorinvoicefile:{
            required:true
        },
        client_confirmation:{
            required:true
        },
        vendor_confirmation:{
            required:true
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
                    type:"POST",
                    url: "{{route('operationNew.addproject')}}",
                    data:data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData:false,
                    contentType:false,
                    dataType: "json",
                    success: function(data) {
                       


                        if(data.success == 1 ){
                           
                            if(data.vendorbalance=='Yes'&&data.vendoradvance=='Yes'&&data.clientbalance=='Yes'&&data.clientadvance=='Yes'){
                            $( "#project_hold" ).addClass( 'd-none');
                            $( "#project_closed" ).removeClass( 'd-none');
                            $('#statusbar').modal('show');
                           }
                           else{
                            $( "#project_closed" ).addClass( 'd-none');
                            $( "#project_hold" ).removeClass( 'd-none');
                            $('#statusbar').modal('show');
                           }

                        }
                        else{
                            alert('fail');
                        }
                    }


                });
            }

});
</script>
{{-- project completed script --}}


{{-- commments --}}
<script>

    $("#commentsubmit").click(function(e){
        e.preventDefault();
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            $.ajax({
                type:"POST",
                data:{
                    id:$('#id').val(),
                    comments:$('#comments').val(),
                },
                url:"{{route('operationNew.add')}}",
                // contentType:true,
                // processData:true,
                dataType:"json",
                success:function(data) {
                    if(data.success == 1){
                        swal({
                            title:'Updated Successfully',
                            icon:'success',
                            button:false
                    })
                     $('#exampleModal').modal('show');
                     $('#exampleModalCenter').modal('hide');
                     window.location.reload();
                }
                else{
                        swal({
                            title:'Please Fill Comment',
                            icon:'success',
                            button:false
                    })
                    }

                }
            });
        });
         $(document).on('click','#my-comments',function(){
          $('#exampleModal').modal('hide');
        });
        
        
        $("#tlcommentsubmit").click(function(e){
        e.preventDefault();
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            $.ajax({
                type:"POST",
                data:{
                    id:$('#id').val(),
                    comments:$('#tl_comments').val(),
                },
                url:"{{route('operationNew.tladd')}}",
                // contentType:true,
                // processData:true,
                dataType:"json",
                success:function(data) {
                    if(data.success == 1){
                        swal({
                            title:'Updated Successfully',
                            icon:'success',
                            button:false
                    })
                     $('#tlexampleModalCenter').modal('hide');
                     window.location.reload();
                }
                else{
                        swal({
                            title:'Please Fill Comment',
                            icon:'success',
                            button:false
                    })
                    }

                }
            });
        });
         $(document).on('click','#tl-comments',function(){
          $('#exampleModal').modal('hide');
        });
        
        
        
         $("#qlcommentsubmit").click(function(e){
        e.preventDefault();
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            $.ajax({
                type:"POST",
                data:{
                    id:$('#id').val(),
                    comments:$('#ql_comments').val(),
                },
                url:"{{route('operationNew.qladd')}}",
                // contentType:true,
                // processData:true,
                dataType:"json",
                success:function(data) {
                    if(data.success == 1){
                        swal({
                            title:'Updated Successfully',
                            icon:'success',
                            button:false
                    })
                    //  $('#exampleModal').modal('show');
                     $('#qlexampleModalCenter').modal('hide');
                     window.location.reload();
                }
                else{
                        swal({
                            title:'Please Fill Comment',
                            icon:'success',
                            button:false
                    })
                    }

                }
            });
        });
         $(document).on('click','#ql-comments',function(){
          $('#exampleModal').modal('hide');
        });
        
        
        $("#pmcommentsubmit").click(function(e){
        e.preventDefault();
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            $.ajax({
                type:"POST",
                data:{
                    id:$('#id').val(),
                    comments:$('#pm_comments').val(),
                },
                url:"{{route('operationNew.pmadd')}}",
                // contentType:true,
                // processData:true,
                dataType:"json",
                success:function(data) {
                    if(data.success == 1){
                        swal({
                            title:'Updated Successfully',
                            icon:'success',
                            button:false
                    })
                    //  $('#exampleModal').modal('show');
                     $('#pmexampleModalCenter').modal('hide');
                     window.location.reload();
                }
                else{
                        swal({
                            title:'Please Fill Comment',
                            icon:'success',
                            button:false
                    })
                    }

                }
            });
        });
         $(document).on('click','#pm-comments',function(){
          $('#exampleModal').modal('hide');
        });
        
      
</script>
{{-- end commments --}}

{{-- project stop --}}
<script>
    $('#stop').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
        });

        $.ajax({
            type:"POST",
            data:{
                id:$('#id').val()
            },
            url:"{{route('operationNew.middle')}}",
            dataType:'json',
            success:function(data){
                if(data.success == 1){
                    swal({
                            title:'Project Stopped Updated',
                            icon:'success',
                            button:false
                    });
                    window.location="{{route('operationNew.index')}}"
                    
                }
                else{
                    alert('fail');
                }
            }

        });

    });
    $(document).on('click','#my-stop',function(){
        $('#exampleModal').modal('hide');
    });
</script>
{{-- end project stop --}}

{{-- Project hold --}}
<script>
    $('#hold').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
        });

        $.ajax({
            type:"POST",
            data:{
                id:$('#id').val()
            },
            url:"{{route('operationNew.hold')}}",
            dataType:'json',
            success:function(data){
                if(data.success == 1){
                    swal({
                            title:'Project Hold Updated Successfully',
                            icon:'success',
                            button:false
                    })
                    window.location="{{route('operationNew.index')}}";
                }
                else{
                    alert('fail');
                }
            }

        });

    });
</script>

{{-- Project closed --}}
<script>
    $('#stscomplete').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
        });

        $.ajax({
            type:"POST",
            data:{
                id:$('#id').val()
            },
            url:"{{route('operationNew.getclose')}}",
            dataType:'json',
            success:function(data){
                if(data.success == 1){
                    swal({
                            title:'Project Completed Successfully',
                            icon:'success',
                            button:false
                    }) 
                    window.location="{{route('operationNew.indexclose')}}";
                }
                else{
                    alert('fail');
                }
            }

        });

    });
</script>

{{-- client advance invoice --}}
<script>
    $('#advanceinvoice').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
        });

        $.ajax({
            type:"get",
            data:{
                id:$('#advanceid').val(),
            },
            url:"{{route('operationNew.getclientadvance')}}",
            dataType:'json',
            success:function(data){
                if(data.success == 1){
                    console.log(data.wonproject);
                    $('#client_id').val(data.wonproject.client_id);
                    $('#client_advance').val(data.wonproject.currency+' '+data.wonproject.client_advance);
                    $('#client_contract').val(data.wonproject.client_contract);
                    

                    console.log(data.wonproject);
                }
                else{
                    alert('fail');

                }

            }


        });
    })
</script>
{{-- end client advance invoice --}}

{{-- client balance invoice --}}
<script>
    $('#balanceinvoice').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
        });

        $.ajax({
            type:"get",
            data:{
                id:$('#balanceid').val(),
            },
            url:"{{route('operationNew.getclientbalance')}}",
            dataType:'json',
            success:function(data){
                if(data.success == 1){
                    console.log(data.wonproject);
                    $('#clientid').val(data.wonproject.client_id);
                    $('#client_balance').val(data.wonproject.currency+' '+data.wonproject.client_balance);
                    $('#clientcontract').val(data.wonproject.client_contract);
                }
                else{
                    alert('fail');

                }

            }


        });
    })
</script>
{{-- end client balance invoice --}}

{{-- client final invoice --}}
<script>
    $('#clientfinal').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
        });

        $.ajax({
            type:"get",
            data:{
                id:$('#client_final_id').val(),
            },
            url:"{{route('operationNew.getclientadvance')}}",
            dataType:'json',
            success:function(data){
                if(data.success == 1){
                    $('#client_final').val(data.wonproject.client_id);
                    // $('#client_advance').val(data.wonproject.client_advance);
                    // $('#client_contract').val(data.wonproject.client_contract);

                    // console.log(data.wonproject);
                }
                else{
                    alert('fail');

                }

            }


        });
    })
</script>
{{-- end client final invoice --}}



<script>
        $('#vendoradvance1').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
        });

        $.ajax({
            type:"get",
            data:{
                id:$('#vendoradvanceid').val(),
            },
            url:"{{route('operationNew.getvendoradvance')}}",
            dataType:'json',
            success:function(data){
                if(data.success == 1){
                   var moderation_html='';
                   console.log(data.wonproject);
                  var advancehtml = "";
                   $.each(data.wonproject.vendor_id.split(','),function(i,v){
                    let vendor_advance = data.wonproject.vendor_advance.split(',');
                    let vendor_contract = data.wonproject.vendor_contract.split(',');
                    let vendor_currency = data.wonproject.currency;
                
                        advancehtml+=`<div class="vendor_design vendor_design_${i} ${i != 0 ? 'd-none' :''}" ><div class="form-group"><label>Vendor Name</label><input type="type" name="vendor_id"  value="${v}" class="form-control" id="vendor_id_${i}"></div>
                     <label>Vendor Advance</label><input type="type" name="vendor_advance" id="vendor_advance_${i}" value="${vendor_currency} ${vendor_advance[i]}" class="form-control">
                     <div class="form-group mt-3"><label>Vendor Contract </label><input type="type" name="vendor_contract" id="vendor_contract_${i}" value="${vendor_contract[i]}" class="form-control"><a class="mdi mdi-download mt-3" href="../../${vendor_contract[i]}" id="version-1" download >download</a></div>
                      <div class="modal-footer d-flex justify-content-between"><button value="submit" class="btn btn-success vendor_advance_request" data-id="${i}">Submit</button></div>
                    <div class="modal-footer d-flex justify-content-between"><button  class="btn btn-success  vendor_design_prev" data-prev="${i-1}">Prev</button><button  class="btn btn-success  vendor_design_next" data-next=${i+ 1}>Next</button></div></div>`;
                    $('#vendor-template').html(advancehtml);
                    });
                 }
                 else{
                    alert('fail');

                }

            }


        });
    })

    $(document).on('click','.vendor_design_next',function(){
        var id = $(this).attr('data-next');
  
        if( $('.vendor_design_'+id).length){
        $('.vendor_design').addClass('d-none');
        $('.vendor_design_'+id).removeClass('d-none');
        }
    });
    $(document).on('click','.vendor_design_prev',function(){
        var id = $(this).attr('data-prev');
        if($('.vendor_design_'+id).length){
        $('.vendor_design').addClass('d-none');
        $('.vendor_design_'+id).removeClass('d-none');
        }
    });
    
     $('#vendorbalance1').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
        });

        $.ajax({
            type:"get",
            data:{
                id:$('#vendorbalanceid').val(),
            },
            url:"{{route('operationNew.getvendoradvance')}}",
            dataType:'json',
            success:function(data){
                if(data.success == 1){
                    console.log(data.wonproject);
                    var html = "";
                    $.each(data.wonproject.vendor_id.split(','),function(i,v){
                       console.log(i);
                    let vendor_balance = data.wonproject.vendor_balance.split(',');
                    let vendor_contract = data.wonproject.vendor_contract.split(',');  
                    let vendor_currency = data.wonproject.currency;
                  html += `<div class="vendor_sign vendor_sign_${i} ${i != 0 ? 'd-none' :''}"><div class="col-md-12"></div><div class="form-group"><label>Vendor Name</label><input type="type" name="vendor_id" value="${v}" id="vendor_id1_${i}" class="form-control">
               </div><div class="form-group"><label>Vendor Balance</label><input type="type" name="vendor_balance" id="vendor_balance_${i}" value="${vendor_currency} ${vendor_balance[i]}" class="form-control"></div><div class="form-group"><label>Vendor Contract </label><input type="type" name="vendor_contract1" id="vendor_contract1_${i}" value="${vendor_contract[i]}" class="form-control"></div><a class="mdi mdi-download"  id="version-2" download href=''>download</a><div class="modal-footer d-flex justify-content-between"><a href="/operationNew/projectview/{{$operation && $operation->id ? $operation->id :''}}" style="color:green;text-decoration: none;" class="d-flex justify-content-start">Project File</a><button type="button" class="btn btn-success vendor_balance_request" data-id="${i}" >Submit</button></div><div><button type="button"  class="btn btn-success      vendor_sign_pre" data-pre="${i-1}">Prev</button><button type="button" class="btn btn-success  float-right vendor_sign_next" data-nxt=${i+ 1}>Next</button>
               </div></div></div>`;
            });          
             $('#vendor_template1').html(html)
                }
                else{
                    alert('fail');

                }

            }


        });
    });

    $(document).on('click','.vendor_sign_next',function(){
        var id = $(this).attr('data-nxt');
        console.log(id);
  
        if( $('.vendor_sign_'+id).length){
        $('.vendor_sign').addClass('d-none');
        $('.vendor_sign_'+id).removeClass('d-none');
        }
    });
    $(document).on('click','.vendor_sign_pre',function(){
        var id = $(this).attr('data-pre');
        if($('.vendor_sign_'+id).length){
        $('.vendor_sign').addClass('d-none');
        $('.vendor_sign_'+id).removeClass('d-none');
        }
    });
    
    
       $('#vendorfinal').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
        });

        $.ajax({
            type:"get",
            data:{
                id:$('#vendor_final_id').val(),
            },
            url:"{{route('operationNew.getvendoradvance')}}",
            dataType:'json',
            success:function(data){
                if(data.success == 1){
                    // console.log(data.wonproject);
                    $('#vendor_final').val(data.wonproject.vendor_id);
                    // $('#vendor_balance').val(data.wonproject.client_advance);
                    // $('#vendor_contract1').val(data.wonproject.client_contract);
                }
                else{
                    alert('fail');

                }

            }


        });
    })
    
    
    // <!--for vendor final invoice store-->
    //  $('#vendor_final_value').click(function(e){
    //     e.preventDefault();
    //     if($("#vendor_final_val").val() != ''){
    //     $.ajaxSetup({
    //         headers: {
    //                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //              },
    //     });

    //     $.ajax({
    //         type:"post",
    //         data:{
                
    //             id:$('#vendor_final_id').val(),
    //             vendor_final_val:$('#vendor_final_val').val()
               
    //         },
    //         url: "{{route('operationNew.vendorfinal')}}",
    //         datatype:'json',

    //         success:function(data){
    //             if(data.success == 1){
    //                 $('#vendor_final_val').next('p').remove();
    //                 swal({
    //                         title:'Added Successfully',
    //                         icon:'success',
    //                         button:false
    //                 }) 
    //                 $('#vendorfinalvalue').modal('hide');
                     
    //         }
    //         else{

    //             swal({
    //                         title:'Not Added Invoice',
    //                         icon:"warning",
    //                         button:false
    //                     })
    //         }
    //         },
            

    //     });
    //     }
    //     else{
    //         $('#vendor_final_val').after("<p class='error'>This field is required.</p>");
    //     }
    // })    
// <!--end vendor final invoice store-->    
</script>



<!--for client final invoice store-->

<script>


<!--for client final invoice store-->
    // $('#client_final_value').validate({
        
    //     rules:{
    //         client_final_id:{
    //             required: true
    //         },
    //         client_final_val:{
    //             required: true
    //         },
            
    //     },
    //     errorPlacement: function (error, element) {
    //                 if (element.hasClass("select2-hidden-accessible")) {
    //                     error.insertAfter(element.siblings('span.select2'));
    //                 } else if (element.hasClass("floating-input")) {
    //                     element.closest('.form-floating-label').addClass("error-cont").append(error);
    //                 } else {
    //                     error.insertAfter(element);
    //                 }
    //             },
    
    //             submitHandler: function (form) {
    //                 var data = new FormData(form);
    //                 // console.log(data);
    
    //                 $.ajax({
    //                     type:"POST",
    //                     url: "{{route('operationNew.clientfinal')}}",
    //                     data:data,
    //                     headers: {
    //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //                     },
    //                     processData:false,
    //                     contentType:false,
    //                     dataType: "json",
    //                     success: function(data) {
                           
    
    
    //                         if(data.success == 1 ){
    //                             $( "#clientfinalvalue" ).modal( 'hide');
                               
    
    //                         }
    //                         else{
    //                             alert('fail');
    //                         }
    //                     }
    
    
    //                 });
    //             }
    
    // });
    
    // $('#client_final_value').click(function(e){
    //     e.preventDefault();
    //     if($("#client_final_val").val() != ''){
    //     $.ajaxSetup({
    //         headers: {
    //                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //              },
    //     });

    //     $.ajax({
    //         type:"post",
    //         data:{
                
    //             id:$('#client_final_id').val(),
    //             client_final_val:$('#client_final_val').val()
               
    //         },
    //         url: "{{route('operationNew.clientfinal')}}",
    //         datatype:'json',

    //         success:function(data){
    //             if(data.success == 1){
    //                 $('#client_final_val').next('p').remove();
    //                 swal({
    //                         title:'Added Successfully',
    //                         icon:'success',
    //                         button:false
    //                 }) 
    //                 $('#clientfinalvalue').modal('hide');
                     
    //         }
    //         else{

    //             swal({
    //                         title:'Not Added Invoice',
    //                         icon:"warning",
    //                         button:false
    //                     })
    //         }
    //         },
            

    //     });
    //     }
    //     else{
    //         $('#client_final_val').after("<p class='error'>This field is required.</p>");
    //     }
    // })    
    
    
    </script>
    
    <!--end client final invoice store-->



    <!-- Account client Request -->

<script>
      $('#client_Advance_request').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
        });

        $.ajax({
            type:"post",
            data:{
                operation_id:$('#operation_id').val(),
                id:$('#advanceid').val(),
                client_id:$('#client_id').val(),
                amount:$('#client_advance').val(),
                client_contract:$('#client_contract').val(),
                invoice_type:$('#invoice_type').val()
            },
            url:"{{route('operationNew.clientrequest')}}",
            datatype:'json',

            success:function(data){
                if(data.success == 1){
                    swal({
                            title:'Invoice Raised Successfully',
                            icon:'success',
                            button:false
                    }) 
                    $('#exampleModalCenteradvance').modal('hide');
            }
            if(data.success == 0){
                swal({
                            title:'Invoice Raised UnSuccessfully',
                            icon:"warning",
                            button:false
                        })

            }
            if(data.success == 2){
                swal({
                            title:'Invoice Already Submitted ',
                            icon:"warning",
                            button:false
                        })

            }
            
            }
            

        });
        
    })

    $('#client_balance_request').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
        });

        $.ajax({
            type:"post",
            data:{
                operation_id:$('#operationid').val(),
                id:$('#balanceid').val(),
                client_id:$('#clientid').val(),
                amount:$('#client_balance').val(),
                client_contract:$('#clientcontract').val(),
                invoice_type:$('#invoice_type1').val()
            },
            url:"{{route('operationNew.clientrequest')}}",
            datatype:'json',

            success:function(data){
                if(data.success == 1){
                    swal({
                            title:'Invoice Raised Successfully',
                            icon:'success',
                            button:false
                    }) 
                    $('#clientbalance1').modal('hide');
            }
            if(data.success == 0){
                swal({
                            title:'Invoice Raised UnSuccessfully',
                            icon:"warning",
                            button:false
                        })

            }
            if(data.success == 2){
                swal({
                            title:'Invoice Already Submitted',
                            icon:"warning",
                            button:false
                        })

            }
            },
            

        });
        
    })
</script>



      <!-- Account Vendor Request -->
<script>
 $(document).on('click','.vendor_advance_request',function(){
        var id = $(this).attr('data-id');
        var vendoradvanceid=$('#vendoradvanceid').val();
        var operationid=$('#venid').val();
        var vendorname = $('#vendor_id_'+id+'').val();
        var vendoradvance = $('#vendor_advance_'+id+'').val();
        var vendorcontract = $('#vendor_contract_'+id+'').val();
        var invoice_type= $('#vendor_invoice_type').val()
        $.ajax({
            type:"get",
            data:{
                operation_id:operationid,
                id:vendoradvanceid,
                vendor_id:vendorname,
                amount:vendoradvance,
                vendor_contract:vendorcontract,
                invoice_type:invoice_type
            },
            url:"{{route('operationNew.vendorrequestadvance')}}",
            datatype:'json',

            success:function(data){
                if(data.success == 1){
                    swal({
                            title:'Invoice Raised Successfully',
                            icon:'success',
                            button:false
                    }) 
                }
               if(data.success == 0){
                swal({
                            title:'Invoice Raised UnSuccessfully',
                            icon:"warning",
                            button:false
                        })

            }
            if(data.success == 2){
                swal({
                            title:'Invoice Already Submitted',
                            icon:"warning",
                            button:false
                        })
            
            }
        }
            

        });

        
    })

    $(document).on('click','.vendor_balance_request',function(){
        var id = $(this).attr('data-id');
        var vendorbalanceid=$('#vendorbalanceid').val();
        var operationid=$('#venid1').val();
        var vendorname = $('#vendor_id1_'+id+'').val();
        var vendorbalance = $('#vendor_balance_'+id+'').val();
        var vendorcontract = $('#vendor_contract1_'+id+'').val();
        var invoice_type= $('#vendor_invoice_type1').val()
        $.ajax({
            type:"get",
            data:{
                operation_id:operationid,
                id:vendorbalanceid,
                vendor_id:vendorname,
                amount:vendorbalance,
                vendor_contract:vendorcontract,
                invoice_type:invoice_type
            },
            url:"{{route('operationNew.vendorrequestadvance')}}",
            datatype:'json',

            success:function(data){
                if(data.success == 1){
                    swal({
                            title:'Invoice Raised Successfully',
                            icon:'success',
                            button:false
                    }) 
                    // $('#exampleModalCenteradvance').modal('hide');
            }
              if(data.success == 0){
                swal({
                            title:'Invoice Raised UnSuccessfully',
                            icon:"warning",
                            button:false
                        })

            }
            if(data.success == 2){
                swal({
                            title:'Invoice Already Submitted ',
                            icon:"warning",
                            button:false
                        })
            }
            
           
            }
            

        });

        
    })
    </script>

<script>
   $(document).on('change','#my-questionnarie',function(){
     $('.questionnarie').remove();     
    });
    $(document).on('change','#my-other_document',function(){
     $('.other_document').remove();     
    });
    $(document).on('change','#my-survey_link',function(){
     $('.survey_link').remove();     
    });
    
      $(document).on('click', '.add', function () {
        // alert("hi");
        $("#other_document").append(
            `<div class="d-flex"><input type="file" style="width:100%;" name="other_document[]" class="form-control mt-1"><i class="fa-solid fa-circle-minus minus" style="color:red;"></i> </div>`
        );
        
    });

    $(document).on('click', '.minus', function () {
        // alert("hi");
        $(this).parent().remove();
    });
    $(document).on('click','.removebutton',function(){
        var id = $(this).attr("data-id");
        // alert(id);
        $("#removebutton").modal('show');

        // $('.other_document_'+id).remove();
        $(".remove_image_button").val(id);
    })
   $(".remove_image_button").click(function(){
    //    alert("hi");
     var value= $(this).val();
    $.ajax({
        url:"{{route('remove_Image')}}",
        type:"post",
        data:{"value":$(this).val(),},
        success :function (data){
            console.log(data);
            swal({
                    title:'Removed Image Successfully',
                    icon:'success',
                    button:false
                }) 
                // location.reload();
                $(".division_"+value).remove();
                $("#removebutton").modal('hide');
        }
    })
   })
</script>
@endsection
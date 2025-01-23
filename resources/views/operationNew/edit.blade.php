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
</style>
@section('page_title', 'Operation New Project')
@section('content')

<div class="container-fluid">
    <div class="row" id="edit-rfq">
        <div class="col-md-12">
            <div class="card">
                {{-- {{$user}} --}}
                <div class="card-header header-elements-inline">
                <div class="card-title" style="color: #fff;">Commissioned Project</div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form id="rfq" class="form col-md-12 d-flex flex-wrap update"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$bidrfq && $bidrfq->id ? $bidrfq->id  : ''}}">
                            <input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount">
                           
                             <div class="col-md-6">
                                 <div class="form-group row">
                                     <label class="col-lg-3 col-form-label font-weight-semibold">RFQ No <span
                                             class="text-danger">*</span></label>
                                     <div class="col-lg-9">
                                         <input name="rfq_no" value="{{ $bidrfq->rfq_no}}" readonly="readonly"
                                              type="text" class="form-control" placeholder="{{$bidrfq->rfq_no}}">
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
                                  <select class="form-control label-gray-3" name="industry" placeholder="Select Industry">
                                <option value="Manufacturing Industry" {{$bidrfq && $bidrfq->industry =='Manufacturing Industry' ? 'selected' : '' }}>Manufacturing Industry</option>                                      
                                <option value="Production Industry" {{$bidrfq && $bidrfq->industry =='Production Industry' ? 'selected' : '' }}>Production Industry</option>
                                <option value="Food Industry" {{$bidrfq && $bidrfq->industry =='Food Industry' ? 'selected' : '' }} >Food Industry</option>
                                <option value="Agricultural Industry" {{$bidrfq && $bidrfq->industry =='Agricultural Industry' ? 'selected' : '' }}>Agricultural Industry</option>
                                <option value="Technology Industry" {{$bidrfq && $bidrfq->industry =='Technology Industry' ? 'selected' : '' }}>Technology Industry</option>
                                <option value="Construction Industry" {{$bidrfq && $bidrfq->industry =='Construction Industry' ? 'selected' : '' }}>Construction Industry</option>
                                <option value="Factory Industry" {{$bidrfq && $bidrfq->industry =='Factory Industry' ? 'selected' : '' }}>Factory Industry</option>
                                <option value="Mining Industry" {{$bidrfq && $bidrfq->industry =='Mining Industry' ? 'selected' : '' }}>Mining Industry</option>
                                <option value="Finance Industry" {{$bidrfq && $bidrfq->industry =='Finance Industry' ? 'selected' : '' }}>Finance Industry</option>
                                <option value="Retail Industry" {{$bidrfq && $bidrfq->industry =='Retail Industry' ? 'selected' : '' }}>Retail Industry</option>
                                <option value="Engineering Industry" {{$bidrfq && $bidrfq->industry =='Engineering Industry' ? 'selected' : '' }}>Engineering Industry</option>
                                <option value="Marketing Industry" {{$bidrfq && $bidrfq->industry =='Marketing Industry' ? 'selected' : '' }}>Marketing Industry</option>
                                <option value="Education Industry" {{$bidrfq && $bidrfq->industry =='Education Industry' ? 'selected' : '' }}>Education Industry</option>
                                <option value="Transport Industry" {{$bidrfq && $bidrfq->industry =='Transport Industry' ? 'selected' : '' }}>Transport Industry</option>
                                <option value="Chemical Industry" {{$bidrfq && $bidrfq->industry =='Chemical Industry' ? 'selected' : '' }}>Chemical Industry</option>
                                <option value="Healthcare Industry" {{$bidrfq && $bidrfq->industry =='Healthcare Industry' ? 'selected' : '' }}>Healthcare Industry</option>
                                <option value="Hospitality Industry" {{$bidrfq && $bidrfq->industry =='Hospitality Industry' ? 'selected' : '' }}>Hospitality Industry</option>
                                <option value="Energy Industry" {{$bidrfq && $bidrfq->industry =='Energy Industry' ? 'selected' : '' }}>Energy Industry</option>
                                <option value="Science Industry" {{$bidrfq && $bidrfq->industry =='Science Industry' ? 'selected' : '' }}>Science Industry</option>
                                <option value="Waste Industry" {{$bidrfq && $bidrfq->industry =='Waste Industry' ? 'selected' : '' }}>Waste Industry</option>
                                <option value="Chemistry Industry" {{$bidrfq && $bidrfq->industry =='Chemistry Industry' ? 'selected' : '' }}>Chemistry Industry</option>
                                <option value="Teritiary Sector Industry" {{$bidrfq && $bidrfq->industry =='Teritiary Sector Industry' ? 'selected' : '' }}>Teritiary Sector Industry</option>
                                <option value="Real Estate Industry" {{$bidrfq && $bidrfq->industry =='Real Estate Industry' ? 'selected' : '' }}>Real Estate Industry</option>
                                <option value="Financial Services Industry"{{$bidrfq && $bidrfq->industry =='Financial Services Industry' ? 'selected' : '' }}>Financial Services Industry</option>
                                <option value="Telecommunications Industry" {{$bidrfq && $bidrfq->industry =='Telecommunications Industry' ? 'selected' : '' }}>Telecommunications Industry</option>
                                <option value="Distribution Industry" {{$bidrfq && $bidrfq->industry =='Distribution Industry' ? 'selected' : '' }}>Distribution Industry</option>
                                <option value="Medical Device Industry" {{$bidrfq && $bidrfq->industry =='Medical Device Industry' ? 'selected' : '' }}>Medical Device Industry</option>
                                <option value="Biotechnology Industry" {{$bidrfq && $bidrfq->industry =='Biotechnology Industry' ? 'selected' : '' }}>Biotechnology Industry</option>
                                <option value="Aviation Industry" {{$bidrfq && $bidrfq->industry =='Aviation Industry' ? 'selected' : '' }}>Aviation Industry</option>
                                <option value="Insurance Industry" {{$bidrfq && $bidrfq->industry =='Insurance Industry' ? 'selected' : '' }}>Insurance Industry</option>
                                <option value="Trade Industry" {{$bidrfq && $bidrfq->industry =='Trade Industry' ? 'selected' : '' }}>Trade Industry</option>
                                <option value="Stock Market Industry" {{$bidrfq && $bidrfq->industry =='Stock Market Industry' ? 'selected' : '' }}>Stock Market Industry</option>
                                <option value="Electronics Industry" {{$bidrfq && $bidrfq->industry =='Electronics Industry' ? 'selected' : '' }}>Electronics Industry</option>
                                <option value="Textile Industry" {{$bidrfq && $bidrfq->industry =='Textile Industry' ? 'selected' : '' }}>Textile Industry</option>
                                <option value="Computers and Information Technology Industry" {{$bidrfq && $bidrfq->industry =='Computers and Information Technology Industry' ? 'selected' : '' }}>Computers and Information Technology Industry</option>
                                <option value="Market Research Industry" {{$bidrfq && $bidrfq->industry =='Market Research Industry' ? 'selected' : '' }}>Market Research Industry</option>
                                <option value="Machine Industry" {{$bidrfq && $bidrfq->industry =='Machine Industry' ? 'selected' : '' }}>Machine Industry</option>
                                <option value="Recycling Industry" {{$bidrfq && $bidrfq->industry =='Recycling Industry' ? 'selected' : '' }}>Recycling Industry</option>
                                <option value="Information and Communication Technology Industry" {{$bidrfq && $bidrfq->industry =='Information and Communication Technology Industry' ? 'selected' : '' }}>Information and Communication Technology Industry</option>
                                <option value="E- Commerce Industry" {{$bidrfq && $bidrfq->industry =='E- Commerce Industry' ? 'selected' : '' }}>E- Commerce Industry</option>
                                <option value="Research Industry" {{$bidrfq && $bidrfq->industry =='Research Industry' ? 'selected' : '' }}>Research Industry</option>
                                <option value="Rail Transport Industry" {{$bidrfq && $bidrfq->industry =='Rail Transport Industry' ? 'selected' : '' }}>Rail Transport Industry</option>
                                <option value="Food Processing Industry" {{$bidrfq && $bidrfq->industry =='Food Processing Industry' ? 'selected' : '' }}>Food Processing Industry</option>
                                <option value="Small Business Industry" {{$bidrfq && $bidrfq->industry =='Small Business Industry' ? 'selected' : '' }}>Small Business Industry</option>
                                <option value="Wholesale Industry" {{$bidrfq && $bidrfq->industry =='Wholesale Industry' ? 'selected' : '' }}>Wholesale Industry</option>
                                <option value="Pulp and Paper Industry" {{$bidrfq && $bidrfq->industry =='Pulp and Paper Industry' ? 'selected' : '' }}>Pulp and Paper Industry</option>
                                <option value="Vehicle Industry" {{$bidrfq && $bidrfq->industry =='Vehicle Industry' ? 'selected' : '' }}>Vehicle Industry</option>
                                <option value="Steel Industry" {{$bidrfq && $bidrfq->industry =='Steel Industry' ? 'selected' : '' }}>Steel Industry</option>
                                <option value="Renewable Energy Industry" {{$bidrfq && $bidrfq->industry =='Renewable Energy Industry' ? 'selected' : '' }}>Renewable Energy Industry</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Follow Up Date<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                       
                                        <input name="follow_up_date" value="{{$bidrfq && $bidrfq->follow_up_date ? $bidrfq->follow_up_date : ''}}" 
                                            type="date" class="form-control" placeholder="Follow Up date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Choose Currency<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                      
                                        <select class="form-control label-gray-3" id="currency" name="currency">
                                            <option value="₹"{{$bidrfq && $bidrfq->currency == '₹' ? 'selected' : ''}}>INR</option>
                                            <option value="$" {{$bidrfq && $bidrfq->currency == '$' ? 'selected' : ''}}>USD</option>
                                            <option value="€"{{$bidrfq && $bidrfq->currency == '€' ? 'selected' : ''}} >Euro</option>
                                            <option value="£" {{$bidrfq && $bidrfq->currency == '£' ? 'selected' : ''}}>Pound</option>     
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 table-responsive" style="overflow-x:auto;">
                                <div class="form-group row">
                                <button class="btn btn-success btn-country mb-4 ml-2" type="button">Add country</button>
                              
                                  
                                    <div class="col-lg-12 edit-table-bid d-flex">
                                    <table id="mtable" class="table">
                                        <?php
                                        $arr=json_decode($bidrfq->sample_size,true); 
                                        $setup_cost=json_decode($bidrfq->setup_cost,true);
                                        $recruitment = json_decode($bidrfq->recruitment,true);
                                        $incentives = json_decode($bidrfq->incentives,true);
                                        $moderation = json_decode($bidrfq->moderation,true);
                                        $transcript = json_decode($bidrfq->transcript);
                                        $others = json_decode($bidrfq->others);
                                        $world = json_decode($bidrfq->country);
                                        $total_cost = json_decode($bidrfq->total_cost);
                                        $client_id =json_decode($bidrfq->client_id);
                                        $vendor_id = json_decode($bidrfq->vendor_id);
                                        ?>
                                        <tr>
                                        <th></th>
                                        @foreach($world as $kv=> $value)
                                        
                                         @foreach($value as $data)
                                        
                                         <th class="country_remove_{{$kv}}_13">
                                         <button class="btn btn-danger remove-country mb-4 ml-2"  data-remove="{{$kv}}" type="button">
                                                            <i class="fa-solid fa-xmark"></i>
                                        </button>     
                                        </th>
                                        
                                         
                                        @foreach($vendor_id as $k1=> $value)                  
                                      
                                                    @foreach($value as $k=> $data)
                                                        @if($kv == $k1)
                                                        <th class="country_remove_{{$kv}}_12 abcversion_{{$kv}}_11">
                                                        </th>
                                                        @endif
                                                    @endforeach
                                               
                                        @endforeach
                                        
                                       
                                        @endforeach
                                        @endforeach
                                        </tr>

                                         <tr>                                           
                                               <th>Country</th>

                                              
                                                @foreach($world as $kv=> $value)
                                                @foreach($value as $data)
                                               
                                                <th class="data-country country_remove_{{$kv}}">
                                                    <label class="form-group has-float-label">
                                                    <select class="form-control label-gray-3" name="country_0[{{$kv}}][]">
                                                        <option class="label-gray-3" value="{{$data}}">Country</option>
                                            
                                                       
                                                            @if(count($country) > 0)
                                                            @foreach($country as $v)
                                                        <option value="{{$v->name}}" {{$data == $v->name ? 'selected' : ''}}>{{$v->name}}</option>
                                                            @endforeach
                                                            @endif
                                                    </select>
                                                   
                                                    <span>Country</span>
                                            
                                                @foreach($vendor_id as $k1=> $value)                  
                                                
                                                    @foreach($value as $k=> $data)
                                                   
                                                        @if($kv == $k1)
                                                          @if($k !=0)
                                                        <td class="country_remove_{{$kv}}_11 "></td>
                                                        @endif
                                                         @endif
                                                         
                                                    @endforeach
                                               
                                                @endforeach
                                       
                                                <th class="abcversion_{{$kv}}_coun country_remove_{{$kv}}_10"><button class="btn btn-success  ml-2 float-left addvendor" data-button="{{$kv}}" type="button">
                                                                                                Add vendor
                                                                                            </button>
                                                                                            <button class="btn btn-success btn-remove mb-4 ml-2"  data-remove="{{$kv}}" type="button"><i class="fa-solid fa-xmark"></i></button></th>
                                                @endforeach
                                                @endforeach
                                            </tr>   
                                            
                                            <tr> 
                                                <td>Client Name/Vendor Name</td>
    

   
                                             @foreach($client_id as $key=> $value)
                                                
                                                
                                                @foreach($value as $data)
                                               
                                                <td class="country_remove_{{$key}}_1">
                                              
                                                    <label class="form-group has-float-label">
                                                    <select class="form-control label-gray-3" name="client_id_0[{{$key}}][]">
                                                        <option class="label-gray-3" value="{{$data}}">Client</option>
                                                            @if(count($client) > 0)
                                                            @foreach($client as $v)
                                                        <option value="{{$v->client_name}}" {{$data == $v->client_name ? 'selected' : ''}}>{{$v->client_name}} </option>
                                                            @endforeach
                                                            @endif
                                                    </select>
                                                    <span>Client Name</span>
                                             
                                                </td>
                                            @foreach($vendor_id as $k1=> $value)                  
                                                @foreach($value as $k=> $data)
                                                  
                                                      @if($key == $k1)
                                                      <td class="abcversion_{{$key}} country_remove_{{$key}}_2" data-arr="{{$k1}}">
                                                          <label class="form-group has-float-label">
                                                          <select class="form-control label-gray-3" name="vendor_id_0[{{$key}}][]">
                                                              <option class="label-gray-3" value="{{$data}}">Vendor</option>
                                                                  @if(count($vendor) > 0)
                                                                  @foreach($vendor as $v)
                                                              <option value="{{$v->vendor_name}}"  {{$data == $v->vendor_name ? 'selected' : ''}}>{{$v->vendor_name}}</option>
                                                                  @endforeach
                                                                  @endif
                                                          </select>
                                                          <span>Vendor Name</span>
                                                  
                                                      </label>   
                                                     </td>  
                                                      @endif
                                                      
                                                      
                                                      @endforeach
                                                   
                                                      </td>
                                                      @endforeach
                                                  
                                            @endforeach
                                            
                                            @endforeach   
  
                                           </tr> 
                                        <tr>                     
                                            
                                            <td>Sample Size</td>
                                                @php $i=2; @endphp
                                                @foreach($arr as $key=> $value)
                                                @foreach($value as $data)
                                                <td class="abcversion_{{$key}}_1 my-samplesize country_remove_{{$key}}_3"  data-id="{{$i++}}">
                                                <input type="number" class="border-0" value="{{$data}}"  name="sample_size_0[{{$key}}][]">   
                                                </td>
                                                @endforeach
                                                
                                                @endforeach
                                        </tr>
                                        <tr>
                                            <td>Setup Cost</td>
                                               
                                                @php $i=2; @endphp
                                                @foreach( $setup_cost as $key => $value)
                                                  @foreach($value as $k=>$data)
                                                    <td class="table_version abcversion_{{$key}}_2 country_remove_{{$key}}_3" data-id="{{$i++}}" data-cal="{{$k}}"  data-culation="{{$key}}">
                                                    <input type="number" class="cal_{{$key}}_{{$k}}" value="{{$data}}" name="setup_cost_0[{{$key}}][]">
                                                    </td> 
                                                @endforeach
                                                @endforeach
                                        </tr>
                                        <tr>
                                          <td>Recruitment</td>
                                            @php $i=2; @endphp
                                            @foreach($recruitment as $key=> $value)
                                            @foreach($value as $s=> $data)
                            <td class="table_version abcversion_{{$key}}_3 country_remove_{{$key}}_4" data-id="{{$i++}}" data-cal="{{$s}}" data-culation="{{$key}}">
                                                <input type="number" class="cal_{{$key}}_{{$s}}" value="{{$data}}" name="recruitment_0[{{$key}}][]">
                                            </td>
                                            @endforeach
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Incentives</td>
                                            @php $i=2; @endphp
                                            @foreach($incentives as $key=> $value)
                                            @foreach($value as $s=> $data)
                                            <td class="table_version abcversion_{{$key}}_4 country_remove_{{$key}}_5" data-id="{{$i++}}" data-cal="{{$s}}" data-culation="{{$key}}">
                                                <input type="number" class="cal_{{$key}}_{{$s}}" value="{{$data}}" name="incentives_0[{{$key}}][]">
                                            </td>
                                            @endforeach
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Moderation</td>
                                            @php $i=2; @endphp
                                            @foreach($moderation as $key=> $value)
                                            @foreach($value as $s=> $data)
                                            <td class="table_version abcversion_{{$key}}_5 country_remove_{{$key}}_6" data-id="{{$i++}}" data-cal="{{$s}}" data-culation="{{$key}}">
                                                <input type="number" class="cal_{{$key}}_{{$s}}" value="{{$data}}" name="moderation_0[{{$key}}][]">
                                                </td>
                                            @endforeach
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Transcript</td>
                                            @php $i=2; $k=0 @endphp
                                            @foreach($transcript as $key=> $value)
                                            @foreach($value as $s=> $data)
                                            <td class="table_version abcversion_{{$key}}_6 country_remove_{{$key}}_7"  data-id="{{$i++}}" data-cal="{{$s}}" data-culation="{{$key}}">
                                                <input type="number" class="cal_{{$key}}_{{$s}}" value="{{$data}}" name="transcript_0[{{$key}}][]">
                                                </td>
                                            @endforeach
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Others</td>
                                            @php $i=2;  @endphp
                                            @foreach($others as $key=> $value)
                                            @foreach($value as $s=> $data)
                                            <td class="table_version abcversion_{{$key}}_7 country_remove_{{$key}}_8" data-id="{{$i++}}" data-cal="{{$s}}" data-culation="{{$key}}">
                                                <input type="number" class="cal_{{$key}}_{{$s}}" value="{{$data}}" name="others_0[{{$key}}][]">
                                                </td>
                                            @endforeach
                                            @endforeach
                                        </tr>
                                        <tr>
                                            <td>Total Cost</td>
                                           
                                            @foreach($total_cost as $key=> $value)
                                            @foreach($value as $s=> $data)
                                            <td class="table_version abcversion_{{$key}}_8 country_remove_{{$key}}_9">
                                                <!-- <label class="my-currency">{{($bidrfq->currency)}}</label> -->
                                                <input type="text" class="total_cost_{{$key}}_{{$s}}" value="{{$data}}" name="total_cost_0[{{$key}}][]">
                                                </td>
                                            @endforeach
                                            @endforeach
                                        </tr>
                                    </table><br>
                                  </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <a href="{{route('operationNew.index')}}" class=" btn btn-outline-secondary" id="won-rfq-btn1">Back</a>
                                <button type="submit" id="addRegisterButton"
                                    class="btn btn-success ml-2 rfq-sub d-none">Update</button>
                                <p id="nextrfq" class="btn btn-primary m-2 won-rfq-btn2">Next</button>
                            </div>
                            <div class="col-md-12 d-flex align-items-end justify-content-end">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Last Edited by</label>
                                    <div class="col-lg-9 pl-2">
                                        <input name="last_editor_by" id="user" value="{{$user3->name}}" type="text" class="form-control" placeholder="Last Editor Name" readonly>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                </div>
                </div>
                </div>
                </div>

                
                <div class="container-fluid">
                    <div class="row d-none" id="otherFieldDiv">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header header-elements-inline">
                                    <div class="card-title" style="color: #fff;">Commissioned Project</div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <form id="won" class="form col-md-12 d-flex flex-wrap update"
                                       enctype="multipart/form-data">
                                       @csrf
                                        <input type="hidden" value="rfq_no_id">
                                        <input type="hidden" name="id"
                                            value="{{ $wonproject && $wonproject->id ? $wonproject->id : '' }}">
                                        <input id="bidrfqCount" type="hidden" value="1" name="wonCount">
                                        <div class="row add">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label font-weight-semibold">RFQ No <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input name="rfq_no" type="text" readonly="readonly"
                                                            value="{{ $wonproject && $wonproject->rfq_no ? $wonproject->rfq_no : '' }}"
                                                            id="rfq_no" class="form-control" placeholder="Project Name">
                                                        <!--     <select class="form-control label-gray-3" name="rfq_no" id="rfq_no">-->
                                                        <!--<option class="label-gray-3" value="" disabled selected>Select RFQ No</option>-->
            
                                                        <!--    <option class="label-gray-3" value="{{ $wonproject && $wonproject->rfq_no ? $wonproject->rfq_no : '' }}">{{ $wonproject && $wonproject->rfq_no ? $wonproject->rfq_no : '' }}</option>-->
            
            
                                                        <!--</select>-->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label font-weight-semibold"
                                                        id="otherField1">Project Name<span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input name="project_name" type="text"
                                                            value="{{ $wonproject && $wonproject->project_name ? $wonproject->project_name : '' }}"
                                                            id="otherField1" class="form-control" placeholder="Project Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label font-weight-semibold"
                                                        id="otherField2">Project Type<span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control label-gray-3" name="project_type"
                                                            id="project_type">
                                                            <option class="label-gray-3" disabled selected>Select Execution</option>
                                                            <option value="Qualitative"
                                                                {{ $wonproject && $wonproject->project_type == 'Qualitative' ? 'selected' : '' }}>
                                                                Qualitative</option>
                                                            <option value="Quantitative"
                                                                {{ $wonproject && $wonproject->project_type == 'Quantitative' ? 'selected' : '' }}>
                                                                Quantitative</option>
                                                            <option value="Community"
                                                                {{ $wonproject && $wonproject->project_type == 'Community' ? 'selected' : '' }}>
                                                                Community</option>
                                                            <option value="Qual and Quant"
                                                                {{ $wonproject && $wonproject->project_type == 'Qual and Quant' ? 'selected' : '' }}>
                                                                Qual and Quant</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField3"
                                                        class="col-lg-3 col-form-label font-weight-semibold">Project Execution<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control label-gray-3" name="project_execution"
                                                            id="project_execution">
                                                            <option class="label-gray-3" disabled selected>Select Execution</option>
                                                            <option value="Insource"
                                                                {{ $wonproject && $wonproject->project_execution == 'Insource' ? 'selected' : '' }}>
                                                                Insource</option>
                                                            <option value="Outsource"
                                                                {{ $wonproject && $wonproject->project_execution == 'Outsource' ? 'selected' : '' }}>
                                                                Outsource</option>
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
                                                            <option value="₹"
                                                                {{ $wonproject && $wonproject->currency == '₹' ? 'selected' : '' }}>
                                                                INR</option>
                                                            <option value="$"
                                                                {{ $wonproject && $wonproject->currency == "$" ? 'selected' : '' }}>
                                                                USD</option>
                                                            <option value="€"
                                                                {{ $wonproject && $wonproject->currency == '€' ? 'selected' : '' }}>
                                                                Euro</option>
                                                            <option value="£"
                                                                {{ $wonproject && $wonproject->currency == '£' ? 'selected' : '' }}>
                                                                Pound</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
            
            
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField4" class="col-lg-3 col-form-label font-weight-semibold">Start
                                                        Date<span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input name="project_start_date" id="otherField4" type="date"
                                                            value="{{ $wonproject->project_start_date ? $wonproject->project_start_date : '' }}"
                                                            class="form-control" placeholder="Start Date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField5" class="col-lg-3 col-form-label font-weight-semibold">End
                                                        Date<span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input name="project_end_date" id="otherField5"
                                                            value="{{ $wonproject->project_end_date ? $wonproject->project_end_date : '' }}"
                                                            type="date" class="form-control" placeholder="End Date">
                                                    </div>
                                                </div>
                                            </div>
            
            
            
            
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField8" class="col-lg-3 col-form-label font-weight-semibold">Total
                                                        Margins<span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <label class="currency" id="total_margin_currency"></label>
                                                        <label class="currency1"></label>
                                                        <input name="total_margin"
                                                            value="{{ $wonproject->total_margin ? $wonproject->total_margin : '' }}"
                                                            id="otherField8" type="text" class="form-control"
                                                            placeholder="Total Margin">
                                                    </div>
                                                </div>
                                            </div>
            
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField3"
                                                        class="col-lg-3 col-form-label font-weight-semibold">Mode<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <select class="form-control label-gray-3" name="mode" id="mode">
                                                            <option class="label-gray-3" disabled selected>Select Mode</option>
                                                            <option value="Online"
                                                                {{ $wonproject && $wonproject->mode == 'Online' ? 'selected' : '' }}>
                                                                Online</option>
                                                            <option value="Offline"
                                                                {{ $wonproject && $wonproject->mode == 'Offline' ? 'selected' : '' }}>
                                                                Offline</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
            
                                            <div class="col-md-12">
                                                <div class="form-group row">
            
                                                    <label id="otherField9"
                                                        class="col-lg-3 col-form-label font-weight-semibold"><u>Client Invoicing
                                                            Terms</u></label>
            
                                                </div>
                                            </div>
                                            <div class="col-md-6 count-vendor" data-won="0">
                                                <div class="form-group row">
                                                    <label id="otherField10"
                                                        class="col-lg-3 col-form-label font-weight-semibold">Advance Payment <span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <label class="currency" id="client_advance_currency"></label>
                                                        <label class="currency1"></label>
                                                        <input name="client_advance" id="otherField10"
                                                            value="{{ $wonproject->client_advance ? $wonproject->client_advance : '' }} "type="text"
                                                            class="form-control" placeholder="Advance Payment" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField11"
                                                        class="col-lg-3 col-form-label font-weight-semibold">Balance Payment<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <label class="currency" id="client_balance_currency"></label>
                                                        <label class="currency1"></label>
                                                        <input name="client_balance" id="otherField11"
                                                            value="{{ $wonproject->client_balance ? $wonproject->client_balance : '' }} "
                                                            type="text" class="form-control" placeholder="Balance Payment"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField6"
                                                        class="col-lg-3 col-form-label font-weight-semibold">Client Total Project
                                                        Invoice Value<span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <label class="currency" id="client_total_currency"></label>
                                                        <label class="currency1"></label>
                                                        <input name="client_total" id="otherField6" type="text"
                                                            value="{{ $wonproject->client_total ? $wonproject->client_total : '' }} "
                                                            class="form-control" placeholder="Client Total Project Invoice Value"
                                                            required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField15"
                                                        class="col-lg-3 col-form-label font-weight-semibold">Attach Client Contract /
                                                        Email <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <a download target="_blank"
                                                            href="{{ url($wonproject->client_contract ? 'adminapp/public/'.$wonproject->client_contract : '') }}">{{ $wonproject->client_contract ? 'adminapp/public/'.$wonproject->client_contract : '' }}</a>
                                                        <input name="client_contract" style="text-transform: capitalize;"
                                                            id="otherField15" type="file"
                                                            value="{{ $wonproject->client_contract ? $wonproject->client_contract : '' }} "
                                                            class="form-control p-1" placeholder="Attach Client Contract">
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                            $vendor_id = explode(',', $wonproject->vendor_id);
                                            $vendor_advance = explode(',', $wonproject->vendor_advance);
                                            $vendor_balance = explode(',', $wonproject->vendor_balance);
                                            $vendor_total = explode(',', $wonproject->vendor_total);
                                            $vendor_contract = explode(',', $wonproject->vendor_contract);
                                            ?>
                                            <div class="col-md-6">
                                                <div class="form-group row">
            
                                                    <label class="col-lg-12 col-form-label font-weight-semibold"><u>Vendor Invoicing
                                                            Terms</u></label>
            
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <div class="col-md-6"></div>
                                                    <div class="col-md-6"> <button class="won-add-vendor btn btn-success d-none"
                                                            type="button">Add Vendor</button> </div>
            
                                                </div>
                                            </div>
            
                                            @foreach ($vendor_id as $key => $value)
                                                <div class="col-md-6">
                                                    <div class="form-group row">
                                                        <label id="otherField13"
                                                            class="col-lg-3 col-form-label font-weight-semibold">Vendor Name <span
                                                                class="text-danger">*</span></label>
                                                        <div class="col-lg-9">
            
                                                            <select class="form-control label-gray-3"
                                                                name="vendor_id_0[{{ $key }}]" id="vendor_id">
            
                                                                <option class="label-gray-3" value="{{ $value }}" selected>
                                                                    {{ $value }}</option>
                                                            </select>
            
            
                                                        </div>
                                                    </div>
                                                </div>
            
            
                                                @foreach ($vendor_advance as $k => $value1)
                                                    @if ($key == $k)
                                                        <div class="col-md-6 my_vendor_0">
                                                            <div class="form-group row">
                                                                <label id="otherField13"
                                                                    class="col-lg-3 col-form-label font-weight-semibold">Advance
                                                                    Payment <span class="text-danger">*</span></label>
                                                                <div class="col-lg-9">
                                                                    <label class="currency" id="vendor_advance_currency"></label>
                                                                    <input name="vendor_advance_0[{{ $key }}]"
                                                                        value="{{ $value1 }}" id="otherField13"
                                                                        type="number" class="form-control"
                                                                        placeholder="Advance Payment" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
            
            
                                                @foreach ($vendor_balance as $k1 => $value2)
                                                    @if ($key == $k1)
                                                        <div class="col-md-6 my_vendor_1">
                                                            <div class="form-group row">
                                                                <label id="otherField14"
                                                                    class="col-lg-3 col-form-label font-weight-semibold">Balance
                                                                    Payment<span class="text-danger">*</span></label>
                                                                <div class="col-lg-9">
                                                                    <label class="currency" id="vendor_balance_currency"></label>
                                                                    <input name="vendor_balance_0[{{ $key }}]"
                                                                        id="otherField14" type="number"
                                                                        value="{{ $value2 }}" class="form-control"
                                                                        placeholder="Balance Payment" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
            
                                                @foreach ($vendor_total as $k2 => $value3)
                                                    @if ($key == $k2)
                                                        <div class="col-md-6">
                                                            <div class="form-group row">
                                                                <label id="otherField7"
                                                                    class="col-lg-3 col-form-label font-weight-semibold">Vendor Total
                                                                    Project Invoice Value<span class="text-danger">*</span></label>
                                                                <div class="col-lg-9">
                                                                    <label class="currency" id="vendor_total_currency"></label>
                                                                    <input name="vendor_total_0[{{ $key }}]"
                                                                        id="otherField7" value="{{ $value3 }}" type="number"
                                                                        class="form-control"
                                                                        placeholder="Vendor Total Project Invoice Value" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
            
                                                @foreach ($vendor_contract as $k3 => $value4)
                                                    @if ($key == $k3)
                                                        <div class="col-md-6 my_vendor_3">
                                                            <div class="form-group row">
                                                                <label id="otherField16"
                                                                    class="col-lg-3 col-form-label font-weight-semibold">Attach Vendor
                                                                    Contract / Email<span class="text-danger">*</span></label>
                                                                <div class="col-lg-9">
            
                                                                    <a target="_blank" download
                                                                    href="{{ url($value4 ? 'adminapp/public/'.$value4 : '') }}">{{ $value4 ? 'adminapp/public/'.$value4 : '' }}</a>

                                                                    <input name="vendor_contract_0[{{ $key }}]"
                                                                        style="text-transform: capitalize;" id="otherField16"
                                                                        type="file" value="{{ $value4 }}"
                                                                        class="form-control p-1" placeholder="Attach Vendor Contract">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endforeach
            
            
                                            <div class="col-md-6" id="won-rfq1">
                                                <div class="form-group row">
                                                    <div class="col-lg-9">
                                                    </div>
                                                </div>
                                            </div>
            
                                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                                <button id="Won_back" class="btn btn-outline-secondary">Back</button>
                                                <button id="next" class="btn btn-success ml-2">Next</button>
                                                {{-- <button type="submit" id="addRegisterButton"
                                            class="btn btn-success ">Submit</button>
                                            <a href="{{route('operationNew.create')}}" class=" btn btn-primary ml-2">Next</a> --}}
                                            </div>
                                            <div class="col-md-12 d-flex align-items-end justify-content-end">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label font-weight-semibold">Last Edited by</label>
                                                    <div class="col-lg-9 pl-2">
                                                        <input name="last_edited_by" id="user" value="{{ $user3->name }}"
                                                            type="text" class="form-control user" placeholder="Last Editor by"
                                                            readonly>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


<div class="container-fluid">
    <div class="row d-none" id="bidrfq_edit">
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
                                        <input name="project_no" value="{{$operation && $operation->project_no ? $operation->project_no :''}}" type="text" class="form-control">
                                    </div>
                                </div>
                            </div>  
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">PO number <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="purchase_order_no" value ="{{$operation && $operation->purchase_order_no ? $operation->purchase_order_no:''}}"
                                             type="text" class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Respondent Incentives <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="respondent_incentives" value="{{$operation && $operation->respondent_incentives ? $operation->respondent_incentives :''}}"
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
                                             <select class="form-control label-gray-3" name="project_manager_name">
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
                                            <select class="form-control label-gray-3" name="quality_analyst_name">
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
                                             type="text" class="form-control" placeholder="Project Deliverables">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Attach Questionnaire <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                    <a target="_blank" download href="{{ url($operation && $operation->questionnarie ? 'adminapp/public/'.$operation->questionnarie : '') }}">
                                        {{ $operation && $operation->questionnarie ? 'adminapp/public/'.$operation->questionnarie : '' }}
                                    </a>
                                        <input name="questionnarie" value="{{$operation && $operation->questionnarie ? $operation->questionnarie : ''}}"
                                             type="file" id="my-questionnarie" class="form-control" placeholder="Attach Questionnaire">
                                    </div>
                                </div>
                            </div>
                             <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Attach Other Documents <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                    @if(isset($operation->operationNewImage) && count($operation->operationNewImage)>0)
                                     @foreach($operation->operationNewImage as $k=> $value)
                                        <div class="division_{{$value->id}}" >
                                      <a download href="{{ url($value && $value->other_documents ? 'adminapp/public/'.$value->other_documents : '') }}" target="_blank" class="other_document_{{$k}}">
                                        {{ $value && $value->other_documents ? 'adminapp/public/'.$value->other_documents : '' }}
                                    </a>
                                         
                                         @if($k != 0)<i class="fa-solid fa-circle-minus removebutton" style="color:red;" data-id="{{$value->id}}"></i>
                                         @endif
                                        </div>
                                        
                                     @endforeach
                                    @endif
                                        <i class="fa-solid fa-circle-plus add float-right mb-2 mt-1" style="color:green;" ></i>
                                        <input name="other_document[]"  value="{{$operation && $operation->other_document  ? $operation->other_document  : ''}}"
                                             type="file"  class="form-control" name="other_document[]" placeholder="Attach Other Documents">
                                             <div id="other_document"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Attach Survey Link <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                    <a target="_blank" download href="{{ url($operation && $operation->survey_link ? 'adminapp/public/'.$operation->survey_link : '') }}">
                                        {{ $operation && $operation->survey_link ? 'adminapp/public/'.$operation->survey_link : '' }}
                                    </a>
                                    
                                        <input name="survey_link" value="{{$operation && $operation->survey_link   ? $operation->survey_link   : ''}}"
                                             type="file" id="my-survey_link"  class="form-control" placeholder="Attach Survey Link">
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
                                            <button class="btn btn-danger  ml-2"  style="float: right;"id="addBtn" type="button">
                                                Add New Country
                                            </button>
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
                                    <table border="1" name="" id="mtables">
                                      
                                        <tr>
                                            <th class="operation-country">Country</th>
                                          
                                            @foreach($target_group as $rrr=> $data)
                                            <th colspan="2" style="text-align: center">
                                            <input type="text" class="form-control" name="target_group[{{$rrr}}]" style="text-align: center" value="{{$data}}">
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
                                               
                                                <select class="form-control label-gray-" name="country_name_0[]" id="country_name" required>
                                                    <option class="label-gray-3" value="{{$data}}">Country</option>
                                                        
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
                                                                <input type="text" value="{{$data}}"class="border-0" name="sample_target_0[{{$c}}][]" placeholder="Sample Target">
                                                            </td>
                                                            <td>
                                                                <input type="text" value="{{$sample_achieved[$c][$k11]}}"class="border-0" name="sample_achieved_0[{{$c}}][]" placeholder="Sample Target">
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
                                <button type="button" id="Operation" class="btn btn-primary">Back</button>
                                <button type="submit" id="addRegisterButton"
                                    class="btn btn-success ml-2">Update</button>
                                    
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
          </form>
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
                         <button type="submit" class="btn btn-primary">Submit</button>
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
                               <button type="button" id="Project" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenterstscompleted">
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
              <h5 class="modal-title" id="exampleModalLongTitle"> Project Completed </h5>
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
                    // $('.rfq-sub').trigger('click');
                    }

                });
            }
        });
</script>
{{-- end update --}}

{{-- data append --}}
<script>


$(document).ready(function () {
       
       $(document).on('keyup', 'table td', function () {
         var first = $(this).attr("data-culation");
         var second= $(this).attr("data-cal");
         console.log(('.cal_'+first+'_'+second));

        
        
         var sum = 0;
         $('.cal_'+first+'_'+second).each(function(i,v) {
            //  console.log($(this).val());
                if($(this).val()!='' && i!=7){
                    sum += Number($(this).val());
                    console.log(sum);
        
                   
                }
            });
            $('.total_cost_'+first+'_'+second).val(sum);

       });
   
    });


    

$(document).on('click','.addvendor',function(){
        debugger
      var key = $(this).attr('data-button');
      var d =  1 + parseInt($('.abcversion_'+key+'_2').last().attr("data-id"));
      var count = 1;
        var dataArr = $('.abcversion_'+key).last().attr('data-arr');
        if (dataArr !== undefined && dataArr !== null && dataArr !== '') {
            count += parseInt(dataArr);
        }
      var calc =  parseInt ($('.abcversion_'+key+'_2').last().attr('data-cal'))+1;

      $('.abcversion_'+key+'_coun').last().before("<td class='abcversion_"+key+"_coun'></td>"); 
      $('.abcversion_'+key+'_11').last().before("<td class='abcversion_"+key+"_11'></td>");
      $('.abcversion_'+key).last().after("<td class='abcversion_"+key+"' data-arr="+count+"><select class='form-control label-gray-3' name='vendor_id_0["+key+"][]'><option class='label-gray-3' value=''>Vendor</option>@if(count($vendor) > 0)@foreach($vendor as $v)<option value='{{$v->vendor_name}}'>{{$v->vendor_name}}</option> @endforeach @endif</select></div></label></td>"); 
      $('.abcversion_'+key+'_1').last().after("<td class='abcversion_"+key+"_1'><input type='text' class='txtCal' placeholder='Sample size' name='sample_size_0["+key+"][]'></div></td>");
      $('.abcversion_'+key+'_2').last().after("<td class='abcversion_"+key+"_2' data-id="+d+" data-cal="+calc+" data-culation="+key+"><input type='text' class='cal_"+key+"_"+calc+"' placeholder='Setup Cost' name='setup_cost_0["+key+"][]'></div></td>");
      $('.abcversion_'+key+'_3').last().after("<td class='abcversion_"+key+"_3' data-id="+d+" data-cal="+calc+" data-culation="+key+"><input type='text' class='cal_"+key+"_"+calc+"' placeholder='Recruitment' name='recruitment_0["+key+"][]'></div></td>");
      $('.abcversion_'+key+'_4').last().after("<td class='abcversion_"+key+"_4' data-id="+d+" data-cal="+calc+" data-culation="+key+"><input type='text' class='cal_"+key+"_"+calc+"' placeholder='Incentives' name='incentives_0["+key+"][]'></div></td>");
      $('.abcversion_'+key+'_5').last().after("<td class='abcversion_"+key+"_5' data-id="+d+" data-cal="+calc+" data-culation="+key+"><input type='text' class='cal_"+key+"_"+calc+"' placeholder='Moderation' name='moderation_0["+key+"][]'></div></td>");
      $('.abcversion_'+key+'_6').last().after("<td class='abcversion_"+key+"_6' data-id="+d+" data-cal="+calc+" data-culation="+key+"><input type='text' class='cal_"+key+"_"+calc+"' placeholder='Transcript' name='transcript_0["+key+"][]'></div></td>");
      $('.abcversion_'+key+'_7').last().after("<td class='abcversion_"+key+"_7' data-id="+d+" data-cal="+calc+" data-culation="+key+"><input type='text' class='cal_"+key+"_"+calc+"' placeholder='Others'     name='others_0["+key+"][]'></div></td>");
      $('.abcversion_'+key+'_8').last().after("<td class='abcversion_"+key+"_8' ><input type='text' class='total_cost_"+key+"_"+calc+"' placeholder='Total Cost' name='total_cost_0["+key+"][]'></div></td>");
      console.log('key:', key);
    console.log('dataArr:', d);
    console.log('calc:', calc);


    });



$(document).on('click','.btn-country',function(){
    // debugger
      var rar=1+ parseInt($('.addvendor').last().attr('data-button'));
      var id= $('.my-samplesize').last().attr('data-id');

      console.log(id);
        var html ='';
            html +=`<table class="table  add-country_${rar} ml-5" id="mtable" >
                      <tbody class="mytbody_${rar}">
                      <tr>
                      <th class="btn-length">
                      <button class="btn btn-danger  ml-2 float-left btn-remove-country1" data-country1="${rar}"  type="button">
                                        <i class="fa-solid fa-xmark"></i></button>
                      </th>
                      </tr>
                      <tr class="pop">
                       <th>
                         <label class="form-group has-float-label1">
                            <select class="form-control label-gray-3" name="country_0[][]">
                               <option class="label-gray-3" value="">Country</option>
                                  @if(count($country) > 0)
                                    @foreach($country as $v)
                                     <option value="{{$v->name}}">{{$v->name}}</option>
                                         @endforeach
                                            @endif
                                    </select>
                                             </label>
                                            
                                        
                                </th>
                                <th>
                                <button class="btn btn-success   float-left addvendor" data-button="${rar}" data-count="0"   type="button">
                                        Add vendor
                                    </button>
                                    
                                </th>
                                
                                <th>
                                <button class="btn btn-success   float-left btn-remove" data-remove="${rar}"  type="button">
                                        <i class="fa-solid fa-xmark"></i></button>
                                </th>
                            </tr>
                            
                            <tr>
                            <td>
                            <table>
                            <tbody class="sub-body_">
                                <tr class="first-row">
                                    <div class="d-flex">
                                        <td></td>
                                    <td>
                                        <select class="form-control label-gray-3" name="client_id_0[${rar}][]">
                                        <option class="label-gray-3" value="">Client</option>
                                        @if(!empty($client))
                                            @foreach($client as $v)
                                                <option value="{{$v->client_name}}">{{$v->client_name}}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    </td>
                                    <td class="abcversion_${rar}" data-arr="0">
                                    
                                   
                                </div>
                                </label>
                                </td>
                                    </tr>
                                    <tr>
                                
                                
                                <td class="sub-cost"></td>
                                
                                
                                <td class="remove" data-id="${id+1}" data-cal="${rar}">
                                    <input  type="number"   name="sample_size_0[${rar}][]" placeholder="Sample Size">
                                    </div>
                                </td>
                                
                                <td class="remove abcversion_${rar}_1 my-samplesize" data-id="${id+2}">
                                    
                                    <input type="number" class="txtbol" name="sample_size_0[${rar}][]" placeholder="Sample Size">
                                    </div>
                                </td>
                                
                            </tr>
                            

                            <tr>
                                <td></td>
                                
                                <td class="bidrfq-client" data-id="${id}+1" data-cal="0" data-culation="${rar}">
                                    

                                    
                                    <input type="number" class='cal_${rar}_0' placeholder="Setup Cost" name="setup_cost_0[${rar}][]">
                                    
                                </td>
                                
                                    <td  class="bidrfq-client abcversion_${rar}_2" data-id="${id+2}" data-cal="1" data-culation="${rar}">

                                    <input type="number" class='cal_${rar}_1'  placeholder="Setup Cost" name="setup_cost_0[${rar}][]">

                                    </td>
                                </tr>
                            <tr>

                                <td></td>
                                
                            <td  class="bidrfq-client" data-id="${id+1}" data-cal="0" data-culation="${rar}">
                                    
                                    <input type="number" class='cal_${rar}_0' placeholder="Recruitment" name="recruitment_0[${rar}][]">
                                    
                                </td>
                                <td class="abcversion_${rar}_3" data-id="${id+2}" data-cal="1" data-culation="${rar}">

                                       <input type="number" class='cal_${rar}_1'  placeholder="Recruitment" name="recruitment_0[${rar}][]">

                                </td>
                                
                            </tr>
                            <tr>
                                <td></td>
                                
                                <td  class="bidrfq-client" data-id="${id+1}" data-cal="0" data-culation="${rar}">
                                    
                                    <input type="number" class='cal_${rar}_0' placeholder="Incentives" name="incentives_0[${rar}][]">
                                
                                </td>

                                <td class="abcversion_${rar}_4" data-id="${id+2}" data-cal="1" data-culation="${rar}">

                                    <input type="number" class='cal_${rar}_1'  placeholder="Incentives" name="incentives_0[${rar}][]">
                                    
                                </td>

                            </tr>

                            <tr>
                                <td></td>
                                
                                <td class="bidrfq-client" data-id="${id+1}" data-cal="0" data-culation="${rar}">
                                    
                                        <input type="number" class='cal_${rar}_0' placeholder="Moderation" name="moderation_0[${rar}][]">

                                    
                                </td>
                                    
                                <td class="abcversion_${rar}_5" data-id="${id+2}" data-cal="1" data-culation="${rar}">

                                        <input type="number" class='cal_${rar}_1'   placeholder="Moderation" name="moderation_0[${rar}][]">

                                </td>
                                    </tr>
                            <tr>
                                <td></td>
                                
                                <td class="bidrfq-client" data-id="${id+1}" data-cal="0" data-culation="${rar}">
                                    
                                        <input type="number" class='cal_${rar}_0' placeholder="Transcript" name="transcript_0[${rar}][]">
                                    
                                </td>
                                <td class="abcversion_${rar}_6" data-id="${id+2}" data-cal="1" data-culation="${rar}">

                                   <input type="number" class='cal_${rar}_1'  placeholder="Transcript" name="transcript_0[${rar}][]">
                                </td>

                            </tr>

                            <tr>
                                <td></td>
                                
                                <td class="bidrfq-client" data-id="${id+1}" data-cal="0" data-culation="${rar}">

                                        <input type="number" class='cal_${rar}_0' placeholder="Others" name="others_0[${rar}][]">
                                    
                                </td>
                                <td class="bidrfq-vendor abcversion_${rar}_7" data-id="${id+2}" data-cal="1" data-culation="${rar}">

                                <input type="number" class='cal_${rar}_1' placeholder="Others" name="others_0[${rar}][]">

                                </td>
                                </tr>
                            <tr>
                                <td></td>   
                                
                                
                                <td> 
                                    <input type="text" class="total_cost_${rar}_0"  placeholder="Total Cost" name="total_cost_0[${rar}][]"></b></td>
                                
                                <td class="abcversion_${rar}_8">
                                    <input type="text" class="total_cost_${rar}_1" placeholder="Total Cost" name="total_cost_0[${rar}][]"></td>
                            </tr>


                                
                                </div>
                                </tr>
                                </tbody>
                                </table>
                            </td>
                                        <tr>
                                        </tbody>
                                        </table>`;
                                        $('.edit-table-bid').append(html);
                                       var j=2;
                                        $('.edit-table-bid tr td').each(function(index,value){
        if($(this).data('id')){
            $(this).attr('data-id',j);
            j++;
            console.log(('.edit-table-bid tr:nth-child(4) td').length);
            if($('.edit-table-bid tr:nth-child(4) td').length<j){
                j=2;
            }
        }else{
            j=2;
        }
      });
                                       
    });




    
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
                                            Remove
                                        </button>
        </td>
    </tr>`;
    $(document).on('click' ,'#addBtn',function(){
    $("#mtables").append(html);
    });
   $(document).on('click', '#removeBtn', function(){  
         $(this).closest("tr").remove();
    });
});


$(document).on('click','.btn-remove-country1',function(){
var tom= $(this).attr('data-country1');
console.log('add-country_'+tom);
$('.add-country_'+tom).remove();
});

$(document).on('click','.btn-remove',function(){
   var key = $(this).attr('data-remove');  
 
   if($('th .abcversion_'+key+'_coun')){
    $('.abcversion_'+key+'_coun').last().prev('td').remove();
   }

    if($('.abcversion_'+key).length>1){
    $('.abcversion_'+key).last().remove();
    }

    if($('.abcversion_'+key+'_1').length>2){
    $('.abcversion_'+key+'_1').last().remove(); 
    }
    
    if($('.abcversion_'+key+'_2').length>2){
    $('.abcversion_'+key+'_2').last().remove();
    }

    if($('.abcversion_'+key+'_3').length>2){
    $('.abcversion_'+key+'_3').last().remove();
    }

    if($('.abcversion_'+key+'_4').length>2){
    $('.abcversion_'+key+'_4').last().remove();
    }

    if($('.abcversion_'+key+'_5').length>2){
    $('.abcversion_'+key+'_5').last().remove();
    }

    if($('.abcversion_'+key+'_6').length>2){
    $('.abcversion_'+key+'_6').last().remove();
    }

    if($('.abcversion_'+key+'_7').length>2){
    $('.abcversion_'+key+'_7').last().remove();
    }

    if($('.abcversion_'+key+'_8').length>2){
    $('.abcversion_'+key+'_8').last().remove();
    }
    
    if($('.abcversion_'+key+'_11').length>2){
    $('.abcversion_'+key+'_11').last().remove();
    }
    });



$(document).on('click','.remove-country',function(){
    var country =$(this).attr('data-remove');
 
    $('.country_remove_'+country).remove();
    $('.country_remove_'+country+'_1').remove();
    $('.country_remove_'+country+'_2').remove();
    $('.country_remove_'+country+'_3').remove();
    $('.country_remove_'+country+'_4').remove();
    $('.country_remove_'+country+'_5').remove();
    $('.country_remove_'+country+'_6').remove();
    $('.country_remove_'+country+'_7').remove();
    $('.country_remove_'+country+'_8').remove();
    $('.country_remove_'+country+'_9').remove();
    $('.country_remove_'+country+'_10').remove();
    $('.country_remove_'+country+'_11').remove();
    $('.country_remove_'+country+'_12').remove();
    $('.country_remove_'+country+'_13').remove();
  

})



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



<script>
    $(document).ready(function () {
     $("#rfq").validate({
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
             total_margin: {
                 required: true
             },
             date: {
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
                 url: "{{route('bidrfq.update')}}",
                 data: data,
                 processData: false,
                 contentType: false,
                 dataType: "json",
                 success: function (data) {
                     // $('#update').get(0).reset()
                     if (data.success == 1) {
                    //   swal({
                    //      title:'Success',
                    //      text:'WonProject Updated Successfully',
                    //      icon:'success',
                    //      button:false
                    //  })
                    //  console.log('hii');
                        //  window.location = "{{route('operationNew.index')}}";
                     }
                     if (data.success == 0) {
                      swal({
                         title:'Please Fill All Fields',
                         icon:"warning",
                         button:false
                     })
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


   $(document).on('click',"#nextrfq",function(){
       $('#edit-rfq').addClass('d-none');
       $('#otherFieldDiv').removeClass('d-none');
       $('#bidrfq_edit').addClass('d-none');
   });

   $(document).on('click',"#next",function(){
       $('#edit-rfq').addClass('d-none');
       $('#otherFieldDiv').addClass('d-none');
       $('#bidrfq_edit').removeClass('d-none');
   });

   $(document).on('click',"#Won_back",function(){
       $('#edit-rfq').removeClass('d-none');
       $('#otherFieldDiv').addClass('d-none');
       $('#bidrfq_edit').addClass('d-none');
   });

   $(document).on('click',"#Operation",function(){
       $('#edit-rfq').addClass('d-none');
       $('#otherFieldDiv').removeClass('d-none');
       $('#bidrfq_edit').addClass('d-none');
   });


   $(document).on('click','#nextrfq',function(){
    $('.rfq-sub').trigger('click');
   });

   
   $(document).ready(function () {
        
     

        $("#won").validate({
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
                total_margin: {
                    required: true
                },
                date: {
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
                        // $('#update').get(0).reset()
                        if (data.success == 1) {
                        //  swal({
                        //     title:'Success',
                        //     text:'WonProject Updated Successfully',
                        //     icon:'success',
                        //     button:false
                        // })
                        // console.log('hii');
                            // window.location = "{{route('wonproject.index')}}";
                        }
                        if (data.success == 0) {
                         swal({
                            title:'Please Fill All Fields',
                            icon:"warning",
                            button:false
                        })
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
@endsection
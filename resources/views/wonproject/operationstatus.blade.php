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
div#vendor-template {
    position: relative;
}

</style>
@section('page_title', 'Operation New Project')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header header-elements-inline">
                    <a class="ml-2 card-title">Operation Status</a>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                        <div class="col-md-12 ">
                                <div class="form-group row">
                                     <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Project No <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="project_no" value="{{$operation->project_no}}" type="text" class="form-control">
                                    </div>
                                </div>
                            </div> 
                                    <label class="col-lg-12 col-form-label font-weight-semibold">Target Table<span
                                            class="text-danger">*</span></label>
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
                                            <input type="text" class="form-control" name="target_group[{{$rrr}}]" style="text-align: center" value="{{$data}}">
                                        </th>
                                        @endforeach
                                            
                                        </tr>
                                        <tr>
                                            @php
                                                $totalData = json_decode($operation->total, true);
                                            @endphp

                                            @if(isset($totalData) && is_array($totalData) && count($totalData) > 0)
                                                <td></td>
                                                @for ($i = 0; $i < count($totalData); $i+=2) 
                                                    <td style="text-align: center">Sample Target</td>
                                                    <td style="text-align: center">Sample Achieved</td>
                                                @endfor
                                            @endif
                                                   
                                            
                                                
                                               
                                                    
                                            @foreach ($world as $c=> $data )
                                            <tr>
                                                <td >
                                               
                                                <select class="form-control label-gray-" name="country_name_0[]" id="country_name">
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
                                                            @php
                                                            $totalData = json_decode($operation->total, true); // Decode JSON safely
                                                        @endphp
                                                            
                                                            <tr id="totalRow">
                                                                @if(isset($totalData) && is_array($totalData) && count($totalData) > 0)
                                                                    <td>Total</td>
                                                                    @foreach ($totalData as $total)
                                                                        <td class="total"><input type="text" name="total[]" class="border-0" value="{{ $total }}"></td>
                                                                    @endforeach
                                                                @endif
                                                            </tr>
                                    </table><br>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        Comments <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <textarea name="project_comment" style="height:150px;" class="form-control" readonly>{{ $operation && $operation->project_comment ? $operation->project_comment : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            @endsection

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
                      
@section('css')

@endsection

@section('scripts')
@endsection
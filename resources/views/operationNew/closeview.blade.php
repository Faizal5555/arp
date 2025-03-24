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
.add-country {
        flex: 1 1 30%;
        min-width: 300px;
        border: 1px solid #ccc;
        padding: 10px;
    }

    tr {
        border: 1px solid #aaa;
        border-color: rgb(0 123 255 / 25%);
    }

    .table-group {
        display: flex;
        flex-wrap: nowrap;
        gap: 10px;
        align-items: center;
        padding: 10px;
        border: 1px solid #ddd;
        position: relative;
    }
    .country-wrapper {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        gap: 10px;
        padding: 10px;
        border: 1px solid #ddd;
        /* background: #f8f9fa; */
        position: relative;
    }
    .bid-table{
        pointer-events:none;
    }
 /* new design */
 .card {
        margin: 40px 0 20px 0;
       
    }

    .card-header.header-elements-inline {
        background-color: #fff;
    }

    label.col-lg-3.col-form-label.font-weight-semibold {
        font-family: "ubuntu-medium", sans-serif;
        font-weight: 500;
    }
    .card-header.header-elements-inline {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
        color: #fff;
    }

    .sub-text {
        color: #fff;
    }


    .tab-container {
        display: flex;
        gap: 10px;
        margin-bottom: 10px;
    }
    .tab-button {
        padding: 10px 15px;
        border: none;
        background: #007bff; 
        color: white;
        cursor: pointer;
        border-radius: 5px;
    }
    .tab-button.inactive {
        background: #6c757d;
    }
  
    .table-container {
        overflow-x: auto
    }
    .table-bordered {
        table-layout: fixed;
        width: 100%;
        border-collapse: collapse;
    }
    .table-bordered td, .table-bordered th {
        border: 1px solid hsl(0, 0%, 44%);
        padding: 5px;
        text-align: center;
        width: auto;
        word-wrap: break-word;
    }
    input.form-control {
        width: 100%;
    }
    .append-controls {
        display: flex;
        justify-content: flex-start;
        margin-bottom: 10px;
        width: 100%;
    }
    .hidden-column {
        display: none;
    }
    .other-controls {
        display: flex;
        justify-content: flex-start;
        margin-top: 10px;
    }
    .add-other, .remove-other ,.multiple_country_other, .remove_multiple_country,.interview_depth_other, .remove_interview_depth, .remove_online_community, .online_community_other {
        position: relative;
        left: -3px;
      
    }
    .relative {
        position: relative;
    }
    .remove-column{
        position: absolute;
        top: -25px;
        right: -10px;
    }
    
    .removeMultipleCountry{
        position: absolute;
        top: -25px;
        right: -10px;
    }
    .removeInterviewDepth{
        position: absolute;
        top: -25px;
        right: -10px;
    }
    .removeOnlineCommunity{
        position: absolute;
        top: -25px;
        right: -10px;
    }


  /* #costingTable td:first-child {
        background-color: navy;
        color: white;
        font-weight: bold;
        padding: 10px;
    } */

    /* Input fields - Green Border */
    #costingTable {
        border: 2px solid green;
        background-color:#28a745;
        border-radius: 5px;
        color:white;
        
        
    }

    /* Dropdowns - Green Border */
    #costingTable select.form-control {
        border: 2px solid green;
        border-radius: 5px;
        
    }

    /* "Total Cost" row - Different Color */
    #costingTable tr:last-child td,#MultipleCountry tr:last-child td, #InterviewDepth tr:last-child td, #OnlineCommunity tr:last-child td {
        background-color: #ffcc00; /* Yellow background for emphasis */
        font-weight: bold;
        color:black;
    }


    /* Button Styling */
    .add-other, .multiple_country_other,.interview_depth_other,.online_community_other{
        background-color: white;
        border: none;
        color: green !important;
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 50%;
    }

    .add-other:hover, .multiple_country_other:hover, .interview_depth_other:hover, .online_community_other:hover {
        background-color: white;
    }

    .static-field {
        background-color: navy;
        color: white;
        font-weight: bold;
        padding: 10px;
    }

    #MultipleCountry,#InterviewDepth,#OnlineCommunity,#costingTable{
        border: 2px solid green;
        background-color:#28a745;
        border-radius: 5px;
        color:white;
        
        
    }
     #MultipleCountry select.form-control, #InterviewDepth select.form-control, #OnlineCommunity select.form-control {
        border: 2px solid green;
        border-radius: 5px;
        
    }

    .form-control::placeholder {
        color: #155724;
        opacity: 0.7;
    }

    .total-cost {
        background-color: #ffcc00 !important;
        color: black;
        font-weight: bold;
        text-align: center;
    }

    .total-value {
        background-color: #f8f9fa; /* Light gray for totals */
        font-weight: bold;
        text-align: center;
    }
    #costingTable,#MultipleCountry, #InterviewDepth, #OnlineCommunity {
    table-layout: fixed; /* Ensures uniform column width */
    width: 50%; /* Optional: Set table width */
    border-collapse: collapse; /* Ensures no extra spacing */
    margin-top: 30px;
    }


    #costingTable td {
        width: 300px !important; /* Set your desired width */
        word-wrap: break-word; /* Ensures text breaks properly */
        text-align: center; /* Align text in the center */
        padding: 5px; /* Optional: Add spacing */
        border:1px solid white;
    }
    #MultipleCountry td {
        width: 400px !important; /* Set your desired width */
        word-wrap: break-word; /* Ensures text breaks properly */
        text-align: center; /* Align text in the center */
        padding: 5px; /* Optional: Add spacing */
        border:1px solid white;
    }

        #interview-depth td {
        width: 400px !important; /* Set your desired width */
        word-wrap: break-word; /* Ensures text breaks properly */
        text-align: center; /* Align text in the center */
        padding: 5px; /* Optional: Add spacing */
        border:1px solid white;
        }
        #OnlineCommunity td {
        width: 400px !important; /* Set your desired width */
        word-wrap: break-word; /* Ensures text breaks properly */
        text-align: center; /* Align text in the center */
        padding: 5px; /* Optional: Add spacing */
        border:1px solid white;
        }
        .label-gray-3{
            width:240px !important;
        }

        button#addRegisterButton {
        background-color: #0b5dbb;
        border-color: #0b5dbb;
        }

         button#addRegisterButton:hover {
        background-color: #0b5dbb;
        border-color: #0b5dbb;

    }

</style>
@section('page_title', 'Operation New Project')
@section('content')

<div class="container-fluid">
    <div class="row" id="edit-rfq">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header header-elements-inline">
                <div class="card-title" style="color: #fff;">Commissioned Project</div>
                </div>
    <div class="card-body">
        <div class="row">
            <form id="rfq" class="flex-wrap form col-md-12 d-flex update"
                enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{$newrfq && $newrfq->id ? $newrfq->id  : ''}}">
                <input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount">
            
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">RFQ No <span
                                class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input name="rfq_no" value="{{ $newrfq->rfq_no}}" readonly="readonly"
                                type="text" class="form-control" placeholder="{{$newrfq->rfq_no}}">
                        </div>
                    </div>
                </div> 
                
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Date<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-9">
                            <input name="date" value="{{$newrfq && $newrfq->date ? $newrfq->date : ''}}"
                                type="date" class="form-control" placeholder="Date" readonly>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                <label class="col-lg-3 col-form-label font-weight-semibold">Industry<span
                        class="text-danger">*</span></label>
                <div class="col-lg-9">
                    <!-- <input name="industry" value="{{$newrfq && $newrfq->industry ? $newrfq->industry : ''}}"
                        type="text" class="form-control" placeholder="Industry"> -->
                    <select class="form-control label-gray-3" name="industry" placeholder="Select Industry" disabled>
                    <option value="Manufacturing Industry" {{$newrfq && $newrfq->industry =='Manufacturing Industry' ? 'selected' : '' }}>Manufacturing Industry</option>                                      
                    <option value="Production Industry" {{$newrfq && $newrfq->industry =='Production Industry' ? 'selected' : '' }}>Production Industry</option>
                    <option value="Food Industry" {{$newrfq && $newrfq->industry =='Food Industry' ? 'selected' : '' }} >Food Industry</option>
                    <option value="Agricultural Industry" {{$newrfq && $newrfq->industry =='Agricultural Industry' ? 'selected' : '' }}>Agricultural Industry</option>
                    <option value="Technology Industry" {{$newrfq && $newrfq->industry =='Technology Industry' ? 'selected' : '' }}>Technology Industry</option>
                    <option value="Construction Industry" {{$newrfq && $newrfq->industry =='Construction Industry' ? 'selected' : '' }}>Construction Industry</option>
                    <option value="Factory Industry" {{$newrfq && $newrfq->industry =='Factory Industry' ? 'selected' : '' }}>Factory Industry</option>
                    <option value="Mining Industry" {{$newrfq && $newrfq->industry =='Mining Industry' ? 'selected' : '' }}>Mining Industry</option>
                    <option value="Finance Industry" {{$newrfq && $newrfq->industry =='Finance Industry' ? 'selected' : '' }}>Finance Industry</option>
                    <option value="Retail Industry" {{$newrfq && $newrfq->industry =='Retail Industry' ? 'selected' : '' }}>Retail Industry</option>
                    <option value="Engineering Industry" {{$newrfq && $newrfq->industry =='Engineering Industry' ? 'selected' : '' }}>Engineering Industry</option>
                    <option value="Marketing Industry" {{$newrfq && $newrfq->industry =='Marketing Industry' ? 'selected' : '' }}>Marketing Industry</option>
                    <option value="Education Industry" {{$newrfq && $newrfq->industry =='Education Industry' ? 'selected' : '' }}>Education Industry</option>
                    <option value="Transport Industry" {{$newrfq && $newrfq->industry =='Transport Industry' ? 'selected' : '' }}>Transport Industry</option>
                    <option value="Chemical Industry" {{$newrfq && $newrfq->industry =='Chemical Industry' ? 'selected' : '' }}>Chemical Industry</option>
                    <option value="Healthcare Industry" {{$newrfq && $newrfq->industry =='Healthcare Industry' ? 'selected' : '' }}>Healthcare Industry</option>
                    <option value="Hospitality Industry" {{$newrfq && $newrfq->industry =='Hospitality Industry' ? 'selected' : '' }}>Hospitality Industry</option>
                    <option value="Energy Industry" {{$newrfq && $newrfq->industry =='Energy Industry' ? 'selected' : '' }}>Energy Industry</option>
                    <option value="Science Industry" {{$newrfq && $newrfq->industry =='Science Industry' ? 'selected' : '' }}>Science Industry</option>
                    <option value="Waste Industry" {{$newrfq && $newrfq->industry =='Waste Industry' ? 'selected' : '' }}>Waste Industry</option>
                    <option value="Chemistry Industry" {{$newrfq && $newrfq->industry =='Chemistry Industry' ? 'selected' : '' }}>Chemistry Industry</option>
                    <option value="Teritiary Sector Industry" {{$newrfq && $newrfq->industry =='Teritiary Sector Industry' ? 'selected' : '' }}>Teritiary Sector Industry</option>
                    <option value="Real Estate Industry" {{$newrfq && $newrfq->industry =='Real Estate Industry' ? 'selected' : '' }}>Real Estate Industry</option>
                    <option value="Financial Services Industry"{{$newrfq && $newrfq->industry =='Financial Services Industry' ? 'selected' : '' }}>Financial Services Industry</option>
                    <option value="Telecommunications Industry" {{$newrfq && $newrfq->industry =='Telecommunications Industry' ? 'selected' : '' }}>Telecommunications Industry</option>
                    <option value="Distribution Industry" {{$newrfq && $newrfq->industry =='Distribution Industry' ? 'selected' : '' }}>Distribution Industry</option>
                    <option value="Medical Device Industry" {{$newrfq && $newrfq->industry =='Medical Device Industry' ? 'selected' : '' }}>Medical Device Industry</option>
                    <option value="Biotechnology Industry" {{$newrfq && $newrfq->industry =='Biotechnology Industry' ? 'selected' : '' }}>Biotechnology Industry</option>
                    <option value="Aviation Industry" {{$newrfq && $newrfq->industry =='Aviation Industry' ? 'selected' : '' }}>Aviation Industry</option>
                    <option value="Insurance Industry" {{$newrfq && $newrfq->industry =='Insurance Industry' ? 'selected' : '' }}>Insurance Industry</option>
                    <option value="Trade Industry" {{$newrfq && $newrfq->industry =='Trade Industry' ? 'selected' : '' }}>Trade Industry</option>
                    <option value="Stock Market Industry" {{$newrfq && $newrfq->industry =='Stock Market Industry' ? 'selected' : '' }}>Stock Market Industry</option>
                    <option value="Electronics Industry" {{$newrfq && $newrfq->industry =='Electronics Industry' ? 'selected' : '' }}>Electronics Industry</option>
                    <option value="Textile Industry" {{$newrfq && $newrfq->industry =='Textile Industry' ? 'selected' : '' }}>Textile Industry</option>
                    <option value="Computers and Information Technology Industry" {{$newrfq && $newrfq->industry =='Computers and Information Technology Industry' ? 'selected' : '' }}>Computers and Information Technology Industry</option>
                    <option value="Market Research Industry" {{$newrfq && $newrfq->industry =='Market Research Industry' ? 'selected' : '' }}>Market Research Industry</option>
                    <option value="Machine Industry" {{$newrfq && $newrfq->industry =='Machine Industry' ? 'selected' : '' }}>Machine Industry</option>
                    <option value="Recycling Industry" {{$newrfq && $newrfq->industry =='Recycling Industry' ? 'selected' : '' }}>Recycling Industry</option>
                    <option value="Information and Communication Technology Industry" {{$newrfq && $newrfq->industry =='Information and Communication Technology Industry' ? 'selected' : '' }}>Information and Communication Technology Industry</option>
                    <option value="E- Commerce Industry" {{$newrfq && $newrfq->industry =='E- Commerce Industry' ? 'selected' : '' }}>E- Commerce Industry</option>
                    <option value="Research Industry" {{$newrfq && $newrfq->industry =='Research Industry' ? 'selected' : '' }}>Research Industry</option>
                    <option value="Rail Transport Industry" {{$newrfq && $newrfq->industry =='Rail Transport Industry' ? 'selected' : '' }}>Rail Transport Industry</option>
                    <option value="Food Processing Industry" {{$newrfq && $newrfq->industry =='Food Processing Industry' ? 'selected' : '' }}>Food Processing Industry</option>
                    <option value="Small Business Industry" {{$newrfq && $newrfq->industry =='Small Business Industry' ? 'selected' : '' }}>Small Business Industry</option>
                    <option value="Wholesale Industry" {{$newrfq && $newrfq->industry =='Wholesale Industry' ? 'selected' : '' }}>Wholesale Industry</option>
                    <option value="Pulp and Paper Industry" {{$newrfq && $newrfq->industry =='Pulp and Paper Industry' ? 'selected' : '' }}>Pulp and Paper Industry</option>
                    <option value="Vehicle Industry" {{$newrfq && $newrfq->industry =='Vehicle Industry' ? 'selected' : '' }}>Vehicle Industry</option>
                    <option value="Steel Industry" {{$newrfq && $newrfq->industry =='Steel Industry' ? 'selected' : '' }}>Steel Industry</option>
                    <option value="Renewable Energy Industry" {{$newrfq && $newrfq->industry =='Renewable Energy Industry' ? 'selected' : '' }}>Renewable Energy Industry</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Follow Up Date<span
                                class="text-danger">*</span></label>
                        <div class="col-lg-9">
                        
                            <input name="follow_up_date" value="{{$newrfq && $newrfq->follow_up_date ? $newrfq->follow_up_date : ''}}" 
                                type="date" class="form-control" placeholder="Follow Up date" readonly>
                        </div>
                    </div>
                </div>
               
                
                <div class="col-md-6">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Choose Company
                            Name<span class="text-danger">*</span></label>
                        <div class="col-lg-9">

                            <select class="form-control label-gray-3" id="company_name"
                                name="company_name" disabled>
                                <option
                                    value="Asia Research Partners"{{ $newrfq && $newrfq->company_name == 'Asia Research Partners' ? 'selected' : '' }}>
                                    Asia Research Partners</option>
                                <option value="Universal Research Panels"
                                    {{ $newrfq && $newrfq->company_name == 'Universal Research Panels' ? 'selected' : '' }}>
                                    Universal Research Panels</option>
                                <option
                                    value="Healthcare Panels India"{{ $newrfq && $newrfq->company_name == 'Healthcare Panels India' ? 'selected' : '' }}>
                                    Healthcare Panels India</option>

                            </select>
                        </div>
                    </div>
                </div>
                <div class="w-100">
                    <div class="container mt-5">
                        <div class="tab-container">
                            @if(isset($newrfq) && isset($newrfq->single))
                                <button class="tab-button active" type="button" data-target="#single-country">
                                    CATI / CAPI / Online Research Single Country
                                </button>
                            @endif
                        
                            @if(isset($newrfq) && isset($newrfq->multiple))
                                <button class="tab-button active" type="button" data-target="#mulitple-country">
                                    CATI / CAPI / Online Research Multiple Countries
                                </button>
                            @endif
                        
                            @if(isset($newrfq) && isset($newrfq->interview))
                                <button class="tab-button active" type="button" data-target="#interview-depth">
                                    In-Depth Interviews / Focus Groups
                                </button>
                            @endif
                        
                            @if(isset($newrfq) && isset($newrfq->online))
                                <button class="tab-button active" type="button" data-target="#online-community">
                                    Online Community - Costing Sheet
                                </button>
                            @endif
                        </div>
                        <div class="{{ isset($newrfq) && isset($newrfq->single) ? '' : 'd-none' }}" id="single-country">
                            <?php
                            if(isset($newrfq) && isset($newrfq->single)){
                                $single_methodology = json_decode($newrfq->single->single_methodology);
                                $single_currency = json_decode($newrfq->single->single_currency);
                                $single_loi = json_decode($newrfq->single->single_loi);
                                $single_country = json_decode($newrfq->single->single_country);
                                $single_client = json_decode($newrfq->single->single_client);
                                $single_sample = json_decode($newrfq->single->single_sample);
                                $single_fieldwork = json_decode($newrfq->single->single_fieldwork);
                                $single_other = json_decode($newrfq->single->single_other);
                                $single_total_cost = json_decode($newrfq->single->single_total_cost);
                            }   
                            ?>
                            <h5>CATI / CAPI / Online Research Single Country</h5>
                            @if(isset($newrfq) && isset($newrfq->single))
                            <div class="table-container mt-2">
                                <table class="" id="costingTable">
                                    <tbody>
                                        <tr>
                                            <td class="static-field">Methodology</td>
                                            @if(count($single_methodology) > 0)
                                            @foreach($single_methodology as $key => $methodology)
                                                <td>
                                                <input type="text" class="form-control" name="single_methodology[]" value="{{$methodology}}">
                                                </td>
                                            @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="static-field remove-other_{{$key - 1}}">Currency</td>
                                            @if(count($single_currency) > 0)
                                            @foreach($single_currency as $currency)
                                                <td><input type="text" class="form-control" name="single_currency[]"value="{{$currency}}" ></td>
                                            @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="static-field remove-other_{{$key - 1}}">LOI</td>
                                            @if(count($single_loi) > 0)
                                            @foreach($single_loi as $loi)
                                                <td><input type="text" class="form-control" name="single_loi[]" value="{{$loi}}"></td>
                                            @endforeach
                                            @endif
                                        </tr>
                                        
                                        <tr>
                                            <td class="static-field remove-other_{{$key - 1}}">Country</td>
                                            @if(count($single_country) > 0)
                                            @foreach($single_country as $country)
                                                <td><input type="text" class="form-control" name="single_country[]" value="{{$country}}"></td>
                                            @endforeach
                                            @endif
                                        </tr>
                                        
                                        <tr>
                                        <td class="static-field remove-other_{{$key - 1}}">Client</td>
                                        @if(count($single_client) > 0)
                                        @foreach($single_client as $value)
                                            <td>
                                                <select class="form-control"
                                                    name="single_client[]">
                                                    <option class=""
                                                        value="">Client</option>
                                                    @if (count($client) > 0)
                                                        @foreach ($client as $v)
                                                            <option
                                                                value="{{ $v->client_name }}" {{$v->client_name == $value ? 'selected' : ''}}>
                                                                {{ $v->client_name }}
                                                            </option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                            </td>
                                        @endforeach
                                        @endif
                                        </tr>
                                        
                                        <tr>
                                        <td class="static-field remove-other_{{$key - 1}}">Sample</td>
                                        @if(count($single_sample) > 0)
                                        @foreach($single_sample as $sample)
                                            <td><input type="text" class="form-control" name="single_sample[]" value="{{$sample}}"></td>
                                        @endforeach
                                        @endif
                                        </tr>
                                        <tr>
                                            <td class="static-field remove-other_{{$key - 1}}">Fieldwork CPI</td>
                                            @if(count($single_fieldwork) > 0)
                                            @foreach($single_fieldwork as $fieldwork)
                                                <td><input type="text" class="form-control" name="single_fieldwork[]" value="{{$fieldwork}}">
                                            @endforeach
                                            @endif
                                            </td>
                                        </tr>
                                        
                                        @if(count($single_other) > 0)
                                        @foreach($single_other as $k => $value)
                                        <tr id="otherFields">
                                        @if(count($value) > 0)
                                        @foreach($value as $key => $other)
                                            @if($key % 3 === 0)
                                            <td class="d-flex">
                                                
                                                <button type="button" class="d-none btn btn-sm  {{$k == 0 ? 'add-other btn-light' : 'remove-other btn-danger'}}">{{$k == 0 ? '+' : 'x'}}</button> 
                                                <input type="text" class="form-control" placeholder="Others" name="single_other[{{$k}}][]" value="{{$other}}">
                                            </td>
                                            @else
                                            <td><input type="text" class="form-control" name="single_other[{{$k}}][]" value="{{$other}}"></td>
                                            @endif
                                        @endforeach
                                        @endif
                                        </tr>
                                        @endforeach
                                        @endif
                                        <tr>
                                            <td>Total Cost</td>
                                            @if(count($single_total_cost) > 0)
                                            @foreach($single_total_cost as $total_cost)
                                                <td><input type="text" class="form-control" name="single_total_cost[]" value="{{$total_cost}}"></td>
                                            @endforeach
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                
                
                    <div class="container">
                
                        <div class="{{ isset($newrfq) && isset($newrfq->multiple) ? '' : 'd-none' }}" id="mulitple-country">
                            <h5>CATI / CAPI / Online Research Multiple Country</h5>
                            <?php
                            if(isset($newrfq) && isset($newrfq->multiple)){
                                $multiple_methodology = json_decode($newrfq->multiple->multiple_methodology);
                                $multiple_currency = json_decode($newrfq->multiple->multiple_currency);
                                $multiple_loi = json_decode($newrfq->multiple->multiple_loi);
                                $multiple_client = json_decode($newrfq->multiple->multiple_client);
                                $multiple_countries = json_decode($newrfq->multiple->multiple_countries);
                                $multiple_other = json_decode($newrfq->multiple->multiple_other);
                                $multiple_total_cost = json_decode($newrfq->multiple->multiple_total_cost);
                            }   
                            ?>
                           
                                @if(isset($newrfq) && isset($newrfq->multiple))
                            <div class="table-container mt-2">
                                <table class="" id="MultipleCountry">
                                    <tbody>
                                        <tr>
                                            <td class="static-field">Methodology</td>
                                            @if(count($multiple_methodology) > 0)
                                                @foreach($multiple_methodology as $key => $methodology)
                                                    <td  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control" name="multiple_methodology[]" value="{{$methodology}}" placeholder="Online">
                                                    </label>
                                                @endforeach
                                            @endif
                                            </td>
                                        </tr>
                                        <tr>
                                        <td class="static-field relative ">Currency</td>
                                            @if(count($multiple_currency) > 0)
                                                @foreach($multiple_currency as $key => $currency)
                                                <td class="editable-field removeMultipleCountry_{{$key - 1}}"  colspan="3">
                                                <label class="mb-0 label">
                                                <input type="text" class="form-control" name="multiple_currency[]" value="{{$currency}}" placeholder="currency">
                                                </label>
                                                @endforeach
                                            @endif
                                            </td>
                                        </tr>
                                        <tr>
                                        <td class="static-field relative ">LOI</td>
                                            @if(count($multiple_loi) > 0)
                                            @foreach($multiple_loi as $key => $loi)
                                            <td class="editable-field removeMultipleCountry_{{$key - 1}}"  colspan="3">
                                                <label class="mb-0 label">
                                                <input type="text" class="form-control" name="multiple_loi[]" value="{{$loi}}" placeholder="mins">
                                                </label>
                                            @endforeach
                                            @endif
                                            </td>
                                        </tr>
                                        <tr>
                                        <td class="static-field relative ">Client</td>
                                        @if(count($multiple_client) > 0)
                                            @foreach($multiple_client as $key => $value)
                                            <td class="editable-field removeMultipleCountry_{{$key - 1}}"  colspan="3">
                                                <label class="mb-0 label"> 
                                                <select class="form-control label-gray-3" name="multiple_client[]">
                                                    <option class="label-gray-3" value="">Client</option>
                                                    @foreach ($client as $v)
                                                        <option value="{{ $v->client_name }}" {{$v->client_name == $value ? 'selected' : ''}}> 
                                                        {{ $v->client_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                </label>
                                            </td>
                                            @endforeach
                                        @endif
                                        </tr>
                                        <tr>
                                            <td class="static-field relative ">Countries</td>
                                            @if(count($multiple_countries) > 0)
                                            @foreach($multiple_countries as $key => $multiple)
                                            <td class="static-field removeMultipleCountry_{{$key - 1}}">Sample</td>
                                            <td class="static-field removeMultipleCountry_{{$key - 1}}">CPI</td>
                                            <td class="static-field removeMultipleCountry_{{$key - 1}}">Total</td>
                                            @endforeach
                                            @endif
                                        </tr>
                                        @if(count($multiple_countries) > 0)
                                        @foreach ($multiple_countries as $k => $countries)
                                            <tr>
                                            <?php 
                                                $i = "";
                                            ?>
                                            @if(count($countries) > 0)
                                            @foreach ($countries as $key => $country)
                                                <?php 
                                                if($key == 4)
                                                {
                                                    $i = 0;
                                                }
                                                ?>
                                                <td class="removeMultipleCountry_{{$i}}"><input type="text" class="form-control" name="multiple_countries[{{$k}}][]" value="{{$country}}" attr="{{($key) % 3 === 0 && $key > 0 ? 'total' : ''}}"></td>
                                                <?php
                                                if($key % 3 === 0 && $key > 3)
                                                {
                                                    $i++;
                                                }
                                                ?>
                                            @endforeach
                                            @endif
                                            </tr>
                                        @endforeach
                                        @endif
                                        @if(count($multiple_other) > 0)
                                        @foreach($multiple_other as $k => $value)
                                            <?php 
                                            $i = "";
                                        ?>
                                        <tr id="otherFieldMultipleCountry">
                                        @if(count($value) > 0)
                                        @foreach($value as $key => $other)
                                            <?php 
                                            if($key == 4)
                                            {
                                                $i = 0;
                                            }
                                            ?>
                                            @if($key % 3 === 0 && $key == 0)
                                            <td class="d-flex removeMultipleCountry_{{$i}}">
                                                
                                                <button type="button" class="d-none btn btn-sm  {{$k == 0 ? 'multiple_country_other btn-light' : 'remove_multiple_country btn-danger'}}">{{$k == 0 ? '+' : 'x'}}</button> 
                                                <input type="text" class="form-control" placeholder="Others" name="multiple_other[{{$k}}][]" value="{{$other}}">
                                            </td>
                                            @elseif($key % 3 === 0)
                                            <td class="removeMultipleCountry_{{$i}}"><input type="text" class="form-control" name="multiple_other[{{$k}}][]" attr="total" value="{{$other}}"></td>
                                            @else
                                            <td class="removeMultipleCountry_{{$i}}"><input type="text" class="form-control" name="multiple_other[{{$k}}][]" value="{{$other}}"></td>
                                            @endif
                                            <?php
                                            if($key % 3 === 0 && $key > 3)
                                            {
                                                $i++;
                                            }
                                            ?>
                                        @endforeach
                                        @endif
                                        </tr>
                                        @endforeach
                                        @endif
                                        <tr>
                                            <td class="total-cost relative ">Total project Cost</td>
                                            @if(count($multiple_total_cost) > 0)
                                            @foreach ($multiple_total_cost as $key => $value)
                                            <td class="total-cost removeMultipleCountry_{{$key - 1}}"></td>
                                            <td class="total-cost removeMultipleCountry_{{$key - 1}}"></td>
                                            <td class="removeMultipleCountry_{{$key - 1}}"><input type="text" class="form-control " name="multiple_total_cost[]" value="{{$value}}"></td>
                                            @endforeach
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                
                
                    <div class="container">
                
                        <div class="{{ isset($newrfq) && isset($newrfq->interview) ? '' : 'd-none' }}" id="interview-depth">
                            <h5>In-Depth Interviews /Focus Groups Costing Sheet/ Central Location Tests Costing Sheet</h5>
                            <?php
                            if(isset($newrfq) && isset($newrfq->interview)){
                                $interview_depth_methodology = json_decode($newrfq->interview->interview_depth_methodology);
                                $interview_depth_currency = json_decode($newrfq->interview->interview_depth_currency);
                                $interview_depth_loi = json_decode($newrfq->interview->interview_depth_loi);
                                $interview_depth_client = json_decode($newrfq->interview->interview_depth_client);
                                $interview_depth_no_fgd = json_decode($newrfq->interview->interview_depth_no_fgd);
                                $interview_depth_sample_fgd = json_decode($newrfq->interview->interview_depth_sample_fgd);
                                $interview_depth_countries = json_decode($newrfq->interview->interview_depth_countries);
                                $interview_depth_requirements = json_decode($newrfq->interview->interview_depth_requirements);
                                $interview_depth_incentives = json_decode($newrfq->interview->interview_depth_incentives);
                                $interview_depth_moderation = json_decode($newrfq->interview->interview_depth_moderation);
                                $interview_depth_transcripts = json_decode($newrfq->interview->interview_depth_transcripts);
                                $interview_depth_project_management = json_decode($newrfq->interview->interview_depth_project_management);
                                $interview_depth_other = json_decode($newrfq->interview->interview_depth_other);
                                $interview_depth_total_cost_1 = json_decode($newrfq->interview->interview_depth_total_cost_1);
                                $interview_depth_total_cost_2 = json_decode($newrfq->interview->interview_depth_total_cost_2);
                            }   
                            ?>
                            @if(isset($newrfq) && isset($newrfq->interview))
                           
                
                            <div class="table-container mt-2">
                                <table class="" id="InterviewDepth">
                                    <tbody>
                                        <tr>
                                            <td class="static-field">Methodology</td>
                                            @if(count($interview_depth_methodology) > 0)
                                                @foreach($interview_depth_methodology as $key => $methodology)
                                                    <td colspan="3">
                                                        <label class="mb-0 label">
                                                        <input type="text" class="form-control" name="interview_depth_methodology[]" value="{{$methodology}}" placeholder="Online FGDs">
                                                        </label>
                                                    </td>
                                                @endforeach
                                            @endif
                                            
                                        </tr>
                                        <tr>
                                            <td class="static-field">Currency</td>
                                            @if(count($interview_depth_currency) > 0)
                                                @foreach($interview_depth_currency as $key => $currency)
                                                    <td class="editable-field removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                                        <label class="mb-0 label">
                                                        <input type="text" class="form-control" name="interview_depth_currency[]" value="{{$currency}}"  placeholder="currency">
                                                        </label>
                                                    </td>
                                                @endforeach
                                            @endif
                                            
                                        </tr>
                                        <tr>
                                            <td class="static-field">LOI</td>
                                            @if(count($interview_depth_loi) > 0)
                                                @foreach($interview_depth_loi as $key => $loi)
                                                    <td class="editable-field removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                                        <label class="mb-0 label">
                                                        <input type="text" class="form-control sample" name="interview_depth_loi[]" value="{{$loi}}"  placeholder="mins">
                                                        </label>
                                                    </td>
                                                @endforeach
                                            @endif
                                            
                                        </tr>
                                        <tr>
                                            <td class="static-field">Client</td>
                                            @if(count($interview_depth_client) > 0)
                                                @foreach($interview_depth_client as $key => $value)
                                                    <td class="editable-field removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                                    <label class="mb-0 label"> 
                                                        <select class="form-control label-gray-3" name="interview_depth_client[]">
                                                        <option class="label-gray-3" value="">Client</option>
                                                        @foreach ($client as $v)
                                                            <option value="{{ $v->client_name }}" {{$v->client_name == $value ? 'selected' : ''}}>{{ $v->client_name }}</option>
                                                        @endforeach
                                                        </select>
                                                    </label>
                                                    </td>
                                                @endforeach
                                            @endif
                                            
                                        </tr>
                                        <tr>
                                            <td class="static-field">No of FGDs</td>
                                            @if(count($interview_depth_no_fgd) > 0)
                                                @foreach($interview_depth_no_fgd as $key => $fgd)
                                                    <td class="editable-field removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                                        <label class="mb-0 label">
                                                        <input type="text" class="form-control sample" name="interview_depth_fgd[]" value="{{$fgd}}"  placeholder="value">
                                                        </label>
                                                    </td>
                                                @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="static-field">Samples per FGD/IDI</td>
                                            @if(count($interview_depth_sample_fgd) > 0)
                                                @foreach($interview_depth_sample_fgd as $key => $fgd)
                                                <td class="editable-field removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control sample" name="interview_depth_sample_fgd[]" value="{{$fgd}}"  placeholder="value">
                                                    </label>
                                                </td>
                                                @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="static-field">Country</td>
                                            @if(count($interview_depth_countries) > 0)
                                                @foreach($interview_depth_countries as $key => $country)
                                                <td class="editable-field removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                                <label class="mb-0 label">
                                                <input type="text" class="form-control sample" value="{{$country}}" name="interview_depth_countries[]"  placeholder="country">
                                                </label>
                                                </td>
                                                @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="static-field"></td>
                                            @if(count($interview_depth_countries) > 0)
                                            @foreach($interview_depth_countries as $key => $country)
                                                <td class="static-field removeInterviewDepth_{{$key - 1}}">Sample</td>
                                                <td class="static-field removeInterviewDepth_{{$key - 1}}">CPI</td>
                                                <td class="static-field removeInterviewDepth_{{$key - 1}}">Total</td>
                                            @endforeach
                                            @endif
                                        </tr>
                
                                        <tr>
                                            <td class="static-field ">Recruitment</td>
                                            <?php 
                                                $i = "";
                                            ?>
                                            @if(count($interview_depth_requirements) > 0)
                                            @foreach($interview_depth_requirements as $key => $value)
                                                <?php 
                                                if($key == 3)
                                                {
                                                    $i = 0;
                                                }
                                                ?>
                                                <td class="removeInterviewDepth_{{$i}}"><input type="text" class="form-control  sample" name="interview_depth_requirement[]" value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                                <?php
                                                if(($key + 1) % 3 === 0 && $key > 3)
                                                {
                                                    $i++;
                                                }
                                                ?>
                                            @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            <?php 
                                                $i = "";
                                            ?>
                                            <td class="static-field removeInterviewDepth_{{$key - 1}}">Incentives</td>
                                            @if(count($interview_depth_incentives) > 0)
                                            @foreach($interview_depth_incentives as $key => $value)
                                                <?php
                                                if($key == 3)
                                                {
                                                    $i = 0;
                                                }
                                                ?>
                                                <td class="removeInterviewDepth_{{$i}}"><input type="text" class="form-control sample" name="interview_depth_incentives[]" value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                                <?php
                                                if(($key + 1) % 3 === 0 && $key > 3)
                                                {
                                                    $i++;
                                                }
                                                ?>
                                            @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            <?php 
                                                $i = "";
                                            ?>
                                            <td class="static-field removeInterviewDepth_{{$key - 1}}">Moderation</td>
                                            @if(count($interview_depth_moderation) > 0)
                                            @foreach($interview_depth_moderation as $key => $value)
                                            <?php 
                                                if($key == 3)
                                                {
                                                    $i = 0;
                                                }
                                                ?>
                                                <td class="removeInterviewDepth_{{$i}}"><input type="text" class="form-control sample" name="interview_depth_moderation[]" value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                                <?php
                                                if(($key + 1) % 3 === 0 && $key > 3)
                                                {
                                                    $i++;
                                                }
                                                ?>
                                            @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            <?php 
                                                $i = "";
                                            ?>
                                            <td class="static-field removeInterviewDepth_{{$key - 1}}">Transcripts</td>
                                            @if(count($interview_depth_transcripts) > 0)
                                            @foreach($interview_depth_transcripts as $key => $value)
                                            <?php 
                                                if($key == 3)
                                                {
                                                    $i = 0;
                                                }
                                                ?>
                                                <td class="removeInterviewDepth_{{$i}}"><input type="text" class="form-control sample" name="interview_depth_transcripts[]" value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                                <?php
                                                if(($key + 1) % 3 === 0 && $key > 3)
                                                {
                                                    $i++;
                                                }
                                                ?>
                                            @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                        <?php 
                                                $i = "";
                                            ?>
                                            <td class="static-field removeInterviewDepth_{{$key - 1}}">Project Management</td>
                                            @if(count($interview_depth_project_management) > 0)
                                            @foreach($interview_depth_project_management as $key => $value)
                                                <?php
                                                    if($key == 3)
                                                    {
                                                        $i = 0;
                                                    }
                                                ?>
                                                <td class="removeInterviewDepth_{{$i}}"><input type="text" class="form-control sample" name="interview_depth_project_management[]" value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                                <?php
                                                if(($key + 1) % 3 === 0 && $key > 3)
                                                {
                                                    $i++;
                                                }
                                                ?>
                                            @endforeach
                                            @endif
                                        </tr>
                                        @if(count($interview_depth_other) > 0)
                                        @foreach($interview_depth_other as $k => $value)
                                        <tr id="otherFieldsInterview">
                                        <?php 
                                            $i = "";
                                        ?>
                                        @if(count($value) > 0)
                                        @foreach($value as $key => $other)
                                            <?php 
                                            if($key == 4)
                                            {
                                                $i = 0;
                                            }
                                            ?>
                                            @if($key % 3 === 0 && $key == 0)
                                            <td class="d-flex removeInterviewDepth_{{$i}}">
                                                <button type="button" class="d-none btn btn-sm  {{$k == 0 ? 'interview_depth_other btn-light' : 'remove_interview_depth btn-danger'}}">{{$k == 0 ? '+' : 'x'}}</button> 
                                                <input type="text" class="form-control" placeholder="Others" name="interview_depth_other[{{$k}}][]" value="{{$other}}">
                                            </td>
                                            @elseif($key % 3 === 0)
                                            <td class="removeInterviewDepth_{{$i}}"><input type="text" class="form-control" name="interview_depth_other[{{$k}}][]" attr="total" value="{{$other}}"></td>
                                            @else
                                            <td class="removeInterviewDepth_{{$i}}"><input type="text" class="form-control" name="interview_depth_other[{{$k}}][]" value="{{$other}}"></td>
                                            @endif
                                            <?php
                                            if($key % 3 === 0 && $key > 3)
                                            {
                                                $i++;
                                            }
                                            ?>
                                        @endforeach
                                        @endif
                                        </tr>
                                        @endforeach
                                        @endif
                                        {{-- <tr id="otherFieldsInterview">
                                            <td class="d-flex"><button type="button" class="btn btn-sm interview_depth_other">+</button> <input type="text" name="interview_depth_other[0][]" class="form-control" placeholder="Others"></td>
                                            <td><input type="text" class="form-control sample" name="interview_depth_other[0][]"></td>
                                            <td><input type="text" class="form-control cpi" name="interview_depth_other[0][]"></td>
                                            <td> <input type="text" class="form-control cpi" name="interview_depth_other[0][]" attr="total" value=""></td>
                                        </tr> --}}
                                        <tr>
                                        @if(count($interview_depth_total_cost_1) > 0)
                                            <td class="total-cost"><input type="text" class="form-control" name="interview_depth_total_cost_1[]" value="{{$interview_depth_total_cost_1[0]}}" placeholder="Total cost for 1 FGD"></td>
                                            @foreach ($interview_depth_total_cost_1 as $key => $value)
                                            @if($key > 0)
                                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"></td>
                                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"></td>
                                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"><input type="text" class="form-control cpi" name="interview_depth_total_cost_1[]" attr="total1" value="{{$value}}"></td>
                                            @endif
                                            @endforeach
                                        @endif
                                        </tr>
                                        <tr>
                                        @if(count($interview_depth_total_cost_2) > 0)
                                            <td class="total-cost"><input type="text" class="form-control" name="interview_depth_total_cost_2[]" value="{{$interview_depth_total_cost_2[0]}}" placeholder="Total cost for 1 FGD"></td>
                                            @foreach ($interview_depth_total_cost_2 as $key => $value)
                                            @if($key > 0)
                                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"></td>
                                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"></td>
                                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"><input type="text" class="form-control cpi" name="interview_depth_total_cost_2[]" attr="total2" value="{{$value}}"></td>
                                            
                                            @endif
                                            @endforeach
                                        @endif
                                            {{-- <td class="total-cost"><input type="text" class="form-control"  name="interview_depth_total_cost_2[]" placeholder="Total cost for 2 FGDs"></td>
                                            <td class="total-cost"></td>
                                            <td class="total-cost"></td>
                                            <td><input type="text" class="form-control cpi" name="interview_depth_total_cost_2[]" attr="total2" value=""></td> --}}
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                
                
                
                
                
                    <div class="container">
                
                        <div class="{{ isset($newrfq) && isset($newrfq->online) ? '' : 'd-none' }}" id="online-community">
                            <h5>Online Community - Costing Sheet</h5>
                                <?php
                            if(isset($newrfq) && isset($newrfq->online)){
                                $online_community_methodology = json_decode($newrfq->online->online_community_methodology);
                                $online_community_currency = json_decode($newrfq->online->online_community_currency);
                                $online_community_client = json_decode($newrfq->online->online_community_client);
                                    $online_community_duration = json_decode($newrfq->online->online_community_duration);
                                $online_community_loi_screener = json_decode($newrfq->online->online_community_loi_screener);
                                $online_community_sample_loi_month = json_decode($newrfq->online->online_community_sample_loi_month);
                                $online_community_countries = json_decode($newrfq->online->online_community_countries);
                                $online_community_requirements = json_decode($newrfq->online->online_community_requirements);
                                $online_community_incentives = json_decode($newrfq->online->online_community_incentives);
                                $online_community_pmfree = json_decode($newrfq->online->online_community_pmfree);
                                $online_community_project_management = json_decode($newrfq->online->online_community_project_management);
                                $online_community_other = json_decode($newrfq->online->online_community_other);
                                $online_community_total_cost = json_decode($newrfq->online->online_community_total_cost);
                                
                            }   
                            ?>
                            @if(isset($newrfq) && isset($newrfq->online))
                           
                
                            <div class="table-container mt-2">
                                <table class="" id="OnlineCommunity">
                                    <tbody>
                                        <tr>
                                            <td class="static-field w-25">Methodology</td>
                                                @if(count($online_community_methodology) > 0)
                                            @foreach($online_community_methodology as $key => $methodology)
                                                <td  colspan="3">
                                                <label class="mb-0 label">
                                                <input type="text" class="form-control sample" name="online_community_methodology[]" value="{{$methodology}}"  placeholder="Online Community"></label>
                                                </td>
                                            @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            <td class="static-field ">Currency</td>
                                                @if(count($online_community_currency) > 0)
                                            @foreach($online_community_currency as $key => $currency)
                                            <td class="editable-field removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                                            <label class="mb-0 label">
                                            <input type="text" class="form-control sample" name="online_community_currency[]" value="{{$currency}}"  placeholder="currency">
                                            </label>
                                            </td>
                                            @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                        <td class="static-field ">Client</td>
                                                @if(count($online_community_client) > 0)
                                                @foreach($online_community_client as $key => $value)
                                                    <td class="editable-field removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                                                        <label class="mb-0 label"> 
                                                        <select class="form-control label-gray-3" name="online_community_client[]">
                                                            <option class="label-gray-3" value="">Client</option>
                                                            @foreach ($client as $v)
                                                                <option value="{{ $v->client_name }}" {{$v->client_name == $value ? 'selected' : ''}}> 
                                                                {{ $v->client_name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                        </label>
                                                    </td>
                                                    @endforeach
                                                @endif
                                            
                
                                        </tr>
                                        <tr>
                                            <td class="static-field ">Duration</td>
                                                @if(count($online_community_duration) > 0)
                                                @foreach($online_community_duration as $key => $duration)
                                                    <td class="editable-field removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control" name="online_community_duration[]" value="{{$duration}}" placeholder="Year" value="">
                                                    </label>
                                                    </td>
                                                @endforeach
                                                @endif
                
                                        </tr>
                                        <tr>
                                            <td class="static-field ">LOI</td>
                                                @if(count($online_community_loi_screener) > 0)
                                                @foreach($online_community_loi_screener as $key => $screener)
                                                    <td class="editable-field removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control sample" name="online_community_loi_screener[]"  value="{{$screener}}"  placeholder="mins">
                                                    </label>
                                                    </td>
                                                @endforeach
                                                @endif
                
                                        </tr>
                                        <tr>
                                            <td class="static-field ">LOI/Month</td>
                                                @if(count($online_community_sample_loi_month) > 0)
                                                @foreach($online_community_sample_loi_month as $key => $sample_loi_month)
                                                    <td class="editable-field removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control sample" name="online_community_loi_month[]" value="{{$sample_loi_month}}"  placeholder="mins">
                                                    </label>
                                                    </td>
                                                    @endforeach
                                                @endif
                
                                        </tr>
                                        <tr>
                                            <td class="static-field ">Country</td>
                                                @if(count($online_community_countries) > 0)
                                                @foreach($online_community_countries as $key => $countries)
                                                    <td class="editable-field removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control sample" name="online_community_countries[]" value="{{$countries}}"  placeholder="country">
                                                    </label>
                                                    </td>
                                                    @endforeach
                                                @endif
                
                                        </tr>
                                        <tr>
                                            <td class="static-field"></td>
                                                @if(count($online_community_countries) > 0)
                                                @foreach($online_community_countries as $key=> $online)
                                                <td class="static-field removeOnlineCommunity_{{$key - 1}}">Sample</td>
                                                <td class="static-field removeOnlineCommunity_{{$key - 1}}">CPI</td>
                                                <td class="static-field removeOnlineCommunity_{{$key - 1}}">Total</td>
                                            @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            <?php 
                                                $i = "";
                                            ?>
                                            <td class="static-field ">Recruitment</td>
                                            @if(count($online_community_requirements) > 0)
                                            @foreach($online_community_requirements as $key => $value)
                                                <?php 
                                                if($key == 3)
                                                {
                                                    $i = 0;
                                                }
                                                ?>
                                                <td class="removeOnlineCommunity_{{$i}}"><input type="text" class="form-control sample" name="online_community_requirements[]" value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                                <?php
                                                if(($key + 1) % 3 === 0 && $key > 3)
                                                {
                                                    $i++;
                                                }
                                                ?>
                                            @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            <?php 
                                                $i = "";
                                            ?>
                                            <td class="static-field ">Incentives</td>
                                            @if(count($online_community_incentives) > 0)
                                            @foreach($online_community_incentives as $key => $value)
                                                <?php 
                                                if($key == 3)
                                                {
                                                    $i = 0;
                                                }
                                                ?>
                                                <td class="removeOnlineCommunity_{{$i}}"><input type="text" class="form-control sample"  name="online_community_incentives[]"  value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                                <?php
                                                if(($key + 1) % 3 === 0 && $key > 3)
                                                {
                                                    $i++;
                                                }
                                                ?>
                                            @endforeach
                                            @endif
                                        </tr>
                                        <tr>
                                            <?php 
                                                $i = "";
                                            ?>
                                            <td class="static-field">Project Management</td>
                                            @if(count($online_community_pmfree) > 0)
                                            @foreach($online_community_pmfree as $key => $value)
                                                <?php 
                                                if($key == 3)
                                                {
                                                    $i = 0;
                                                }
                                                ?>
                                                <td class="removeOnlineCommunity_{{$i}}"><input type="text" class="form-control sample"  name="online_community_pmfree[]"  value="{{$value}}" attr="{{($key + 1) % 3 === 0 ? 'total' : ''}}"></td>
                                                <?php
                                                if(($key + 1) % 3 === 0 && $key > 3)
                                                {
                                                    $i++;
                                                }
                                                ?>
                                            @endforeach
                                            @endif
                                        </tr>
                                        @if(count($online_community_other) > 0)
                                        @foreach($online_community_other as $k => $value)
                                        <?php 
                                            $i = "";
                                        ?>
                                        <tr id="otherFieldsOnline">
                                        @if(count($value) > 0)
                                        @foreach($value as $key => $other)
                                            <?php 
                                            if($key == 4)
                                            {
                                                $i = 0;
                                            }
                                            ?>
                                            @if($key % 3 === 0 && $key == 0)
                                            <td class="d-flex removeOnlineCommunity_{{$i}}">
                                                <button type="button" class="d-none btn btn-sm  {{$k == 0 ? 'online_community_other btn-light' : 'remove_online_community btn-danger'}}">{{$k == 0 ? '+' : 'x'}}</button> 
                                                <input type="text" class="form-control" placeholder="Others" name="online_community_other[{{$k}}][]" value="{{$other}}">
                                            </td>
                                            @elseif($key % 3 === 0)
                                            <td class="removeOnlineCommunity_{{$i}}"><input type="text" class="form-control" name="online_community_other[{{$k}}][]" attr="total" value="{{$other}}"></td>
                                            @else
                                            <td class="removeOnlineCommunity_{{$i}}"><input type="text" class="form-control" name="online_community_other[{{$k}}][]" value="{{$other}}"></td>
                                            @endif
                                            <?php
                                            if($key % 3 === 0 && $key > 3)
                                            {
                                                $i++;
                                            }
                                            ?>
                                        @endforeach
                                        @endif
                                        </tr>
                                        @endforeach
                                        @endif
                                        {{-- <tr id="otherFieldsOnline">
                                            <td class="d-flex"><button type="button" class="btn btn-sm online_community_other">+</button> <input type="text" class="form-control"  name="online_community_other[0][]"  placeholder="Others"></td>
                                            <td><input type="text" class="form-control sample"  name="online_community_other[0][]"></td>
                                            <td><input type="text" class="form-control cpi" name="online_community_other[0][]"></td>
                                            <td> <input type="text" class="form-control cpi" attr="total"  name="online_community_other[0][]" value=""></td>
                                        </tr> --}}
                                        <tr>
                                            <td class="total-cost">Total Project Cost</td>
                                            @if(count($online_community_total_cost) > 0)
                                            @foreach ($online_community_total_cost as $key => $value)
                                            <td class="total-cost removeOnlineCommunity_{{$key > 0 ? $key - 1 : ''}}"></td>
                                            <td class="total-cost removeOnlineCommunity_{{$key > 0 ? $key - 1 : ''}}"></td>
                                            <td class="removeOnlineCommunity_{{$key > 0 ? $key - 1 : ''}}"><input type="text" class="form-control" name="online_community_total_cost[]" value="{{$value}}"></td>
                                            @endforeach
                                            @endif
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            @endif
                        </div>
                    </div>
                </div> 
                        
                <div class="col-md-12 d-flex align-items-center justify-content-center mt-4">
                    <a href="{{route('operationNew.indexclose')}}" class=" btn btn-outline-secondary" id="won-rfq-btn1">Back</a>
                    <button type="submit" id="addRegisterButton"
                        class="ml-2 btn btn-success rfq-sub d-none">Update</button>
                    <p id="nextrfq" class="m-2 btn btn-primary won-rfq-btn2">Next</button>
                </div>
                <div class="col-md-12 d-flex align-items-end justify-content-end">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label font-weight-semibold">Last Edited by</label>
                        <div class="pl-2 col-lg-9">
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
                            <form id="won" class="flex-wrap form col-md-12 d-flex update"
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
                                                id="otherField1" class="form-control" placeholder="Project Name" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold"
                                            id="otherField2">Project Type<span class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select class="form-control label-gray-3" name="project_type"
                                                id="project_type" disabled>
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
                                                id="project_execution" disabled>
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

                                            <select class="form-control label-gray-3" name="currency" id="worldcurrency" disabled>
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
                                                class="form-control" placeholder="Start Date" readonly>
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
                                                type="date" class="form-control" placeholder="End Date" readonly>
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
                                                placeholder="Total Margin" readonly>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField3"
                                            class="col-lg-3 col-form-label font-weight-semibold">Mode<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select class="form-control label-gray-3" name="mode" id="mode" disabled>
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
                                                class="form-control" placeholder="Advance Payment" required readonly>
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
                                                required readonly>
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
                                                required readonly>
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
                                                href="{{ url($wonproject->client_contract ? 'adminapp/public/'.$wonproject->client_contract : '') }}">{{ $wonproject->client_contract ? $wonproject->client_contract : '' }}</a>
                                            <input name="client_contract" style="text-transform: capitalize;"
                                                id="otherField15" type="file"
                                                value="{{ $wonproject->client_contract ? 'adminapp/public/'.$wonproject->client_contract : '' }} "
                                                class="p-1 form-control" placeholder="Attach Client Contract" disabled>
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
                                                    name="vendor_id_0[{{ $key }}]" id="vendor_id" disabled>

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
                                                            placeholder="Advance Payment" required disabled>
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
                                                            placeholder="Balance Payment" required disabled>
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
                                                            placeholder="Vendor Total Project Invoice Value" required disabled>
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
                                                            href="{{ url('adminapp/public/' . $value4) }}">{{ $value4 }}</a>
                                                        <input name="vendor_contract_0[{{ $key }}]"
                                                            style="text-transform: capitalize;" id="otherField16"
                                                            type="file" value="{{ $value4 }}"
                                                            class="p-1 form-control" placeholder="Attach Vendor Contract" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endforeach

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField18" class="col-lg-3 col-form-label font-weight-semibold">Comments<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <textarea name="sales_comment" id="otherField18" class="form-control" placeholder="comments" style="text-align: left;">{{ $wonproject->sales_comment ?? '' }} </textarea>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-6" id="won-rfq1">
                                    <div class="form-group row">
                                        <div class="col-lg-9">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <button id="Won_back" class="btn btn-outline-secondary">Back</button>
                                    <button id="next" class="ml-2 btn btn-success">Next</button>
                                    {{-- <button type="submit" id="addRegisterButton"
                                class="btn btn-success ">Submit</button>
                                <a href="{{route('operationNew.create')}}" class="ml-2 btn btn-primary">Next</a> --}}
                                </div>
                                <div class="col-md-12 d-flex align-items-end justify-content-end">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">Last Edited by</label>
                                        <div class="pl-2 col-lg-9">
                                            <input name="last_by_name" id="user" value="{{ $user3->name }}"
                                                type="text" class="form-control user" placeholder="Last Edited by"
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
    <div class="row d-none"  id="bidrfq_edit">
        <div class="col-md-12">
            <div class="card">
                
                <div class="card-header header-elements-inline">
                <div class="card-title" style="color: #fff;">Operation New Project</div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <form id="update" class="flex-wrap form col-md-12 d-flex"
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
                            <div class="col-md-6 d-none">
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
                            <div class="col-md-6 d-none">
                                <div class="form-group row ">
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
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Project Operation Head Name <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        {{-- <input name="quality_analyst_name" value=""
                                             type="text" class="form-control" placeholder="Quality Analyst Name"> --}}
                                            <select class="form-control label-gray-3" name="project_operation_head">
                                                @if(count($user4)>0)
                                                @foreach ($user4 as $item)
                                                <option class="label-gray-3" value="{{$item->id}}"{{$operation->project_operation_head == $item->id ? 'selected' :''}}>{{$item->name}}</option>
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
                                        <input name="questionnarie" value="{{$operation && $operation->questionnarie ? 'adminapp/public/'.$operation->questionnarie : ''}}"
                                             type="text" id="my-questionnarie" class="form-control" placeholder="Attach Questionnaire"  readonly="readonly">
                                             <a target="_blank" download href="{{url($operation && $operation->questionnarie ? 'adminapp/public/'.$operation->questionnarie : '')}}" class="mdi mdi-download" style="
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
                                     
                                          <input name="other_document[]"  value="{{$value && $value->other_documents  ? 'adminapp/public/'.$value->other_documents  : ''}}"
                                             type="text"  class="mb-2 form-control" name="other_document[]" placeholder="Attach Other Documents"  readonly="readonly">
                                              <a download href="{{url($value && $value->other_documents  ? 'adminapp/public/'.$value->other_documents  : '')}}" target="_blank" class="other_document_{{$k}} mdi mdi-download"style="
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
                                    
                                        <input name="survey_link" value="{{$operation && $operation->survey_link  ? 'adminapp/public/'.$operation->survey_link  : ''}}"
                                             type="text" id="my-survey_link"  class="form-control" placeholder="Attach Survey Link"  readonly="readonly">
                                             <a target="_blank" download href="{{url($operation && $operation->survey_link  ? 'adminapp/public/'.$operation->survey_link  : '')}}" class="mdi mdi-download" style="
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
                                            <!--<button class="ml-2 btn btn-danger"  style="float: right;"id="addBtn" type="button">-->
                                            <!--    Add New Country-->
                                            <!--</button>-->
                                    <div class="col-md-12 table-responsive" style="overflow-x:auto;">
                                    
                                        <?php
                                        $world=explode(",",$operation->country_name);
                                        $sample_target=json_decode($operation->sample_target,true);
                                        $sample_achieved=json_decode($operation->sample_achieved,true);
                                        $target_group=explode(",",$operation->target_group);
                                        
                                        ?>  
                                       
                                        {{-- <button class="ml-2 btn btn-danger" class="removeBtn" type="button">
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
                                            @if(isset($operation) && isset($operation->total) && count(json_decode($operation->total)) > 0)
                                            <td></td>
                                            @for ($i = 0; $i < count(json_decode($operation->total)); $i+=2) 
                                                <td style="text-align: center">Sample Target</td>
                                                <td style="text-align: center">Sample Achieved</td>
                                            @endfor
                                            @endif
                                        </tr>
                                            
                                                
                                               
                                                    
                                            @foreach ($world as $c=> $data )
                                            <tr>
                                                <td >
                                               
                                                <select class="form-control label-gray-" name="country_name_0[]" id="country_name" disabled>
                                                    <option class="label-gray-3" value="{{$data}}" disabled>Country</option>
                                                        
                                                        @if (count($country_fetch) > 0)
                                                        @foreach($country_fetch as $key=> $value)
                                                         
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
                                                            <tr id="totalRow">
                                                                @if(isset($operation) && isset($operation->total) && count(json_decode($operation->total)) > 0)
                                                                <td>Total</td>
                                                                @foreach (json_decode($operation->total) as $total)
                                                                    <td class="total"><input type="text" name="total[]" class="border-0" value="{{$total}}"></td>
                                                                @endforeach
                                                                @endif
                                                            </tr>
                                    </table><br>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <button id="addRegister" class=" btn btn-primary">Back</button>
                                <!--<button type="submit" id="addRegisterButton"-->
                                <!--    class="ml-2 btn btn-success">Update</button>-->
                                    
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
           
           <div class="mt-3 msg-bubble">
                 <div class="msg-info">
                  <div class="msg-info-name">Project Manager</div>
                </div>

            <div class="msg-text">
               {{$operation && $operation->pm_msg ? $operation->pm_msg : ''}}
            </div>
           </div>
           
           <div class="mt-3 msg-bubble">
                 <div class="msg-info">
                  <div class="msg-info-name">Quality Analyst</div>
                </div>

            <div class="msg-text">
               {{$operation && $operation->ql_msg ? $operation->ql_msg : ''}}
            </div>
           </div>
           
           @if($operation->comments!='')
            <div class="mt-3 right-msg col-md-12">
                <div class="col-md-3"></div>
                <div class="mt-3 msg-bubble">
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
           
           
           
           <div class="mt-3 msger-inputarea">
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
            <div class="mt-3 right-msg col-md-12">
                <div class="col-md-3"></div>
                <div class="mt-3 msg-bubble">
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
           
           <div class="mt-3 msger-inputarea">
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
            <div class="mt-3 right-msg col-md-12">
                <div class="col-md-3"></div>
                <div class="mt-3 msg-bubble">
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
           
           <div class="mt-3 msger-inputarea">
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
            <div class="mt-3 right-msg col-md-12">
                <div class="col-md-3"></div>
                <div class="mt-3 msg-bubble">
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
           
           <div class="mt-3 msger-inputarea">
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
                            id="respondentfile" type="file" class="p-1 form-control" placeholder="Attach Respondent incentive file">
                          
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-lg-6 col-form-label font-weight-semibold">Attach Client Invoice File<span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input name="clientinvoicefile" value=""
                            id="clientinvoicefile" type="file" class="p-1 form-control" placeholder="Attach Client invoice file">
                          
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-6 col-form-label font-weight-semibold">Attach Vendor Invoice File <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input name="vendorinvoicefile" value=""
                            id="vendorinvoicefile" type="file" class="p-1 form-control" placeholder="Attach vendorinvoicefile">
                          
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-lg-6 col-form-label font-weight-semibold">Attach Client Confirmation Email <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input name="client_confirmation" value=""
                            id="client_confirmation" type="file" class="p-1 form-control" placeholder="Attach Client project Confirmation Email">
                          
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-6 col-form-label font-weight-semibold">Attach Vendor Confirmation Email <span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input name="vendor_confirmation" value=""
                            id="vendor_confirmation" type="file" class="p-1 form-control" placeholder="Attach Vendor Confirmation Email">
                          
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
                    <div class="text-center col-md-12 d-flex justify-content-center">
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
                
                @if (count($country_fetch) > 0)
                @foreach($country_fetch as $value)
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
            <button class="ml-2 btn btn-danger" id="removeBtn" type="button">
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
                     <div class="mt-3 form-group"><label>Vendor Contract </label><input type="type" name="vendor_contract" id="vendor_contract_${i}" value="${vendor_contract[i]}" class="form-control"><a class="mt-3 mdi mdi-download" href="../../${vendor_contract[i]}" id="version-1" download >download</a></div>
                      <div class="modal-footer d-flex justify-content-between"><button value="submit" class="btn btn-success vendor_advance_request" data-id="${i}">Submit</button></div>
                    <div class="modal-footer d-flex justify-content-between"><button  class="btn btn-success vendor_design_prev" data-prev="${i-1}">Prev</button><button  class="btn btn-success vendor_design_next" data-next=${i+ 1}>Next</button></div></div>`;
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
               </div><div class="form-group"><label>Vendor Balance</label><input type="type" name="vendor_balance" id="vendor_balance_${i}" value="${vendor_currency} ${vendor_balance[i]}" class="form-control"></div><div class="form-group"><label>Vendor Contract </label><input type="type" name="vendor_contract1" id="vendor_contract1_${i}" value="${vendor_contract[i]}" class="form-control"></div><a class="mdi mdi-download"  id="version-2" download href=''>download</a><div class="modal-footer d-flex justify-content-between"><a href="/operationNew/projectview/{{$operation && $operation->id ? $operation->id :''}}" style="color:green;text-decoration: none;" class="d-flex justify-content-start">Project File</a><button type="button" class="btn btn-success vendor_balance_request" data-id="${i}" >Submit</button></div><div><button type="button"  class="btn btn-success vendor_sign_pre" data-pre="${i-1}">Prev</button><button type="button" class="float-right btn btn-success vendor_sign_next" data-nxt=${i+ 1}>Next</button>
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
    
    //   $(document).on('click', '.add', function () {
    //     // alert("hi");
    //     $("#other_document").append(
    //         `<div class="d-flex"><input type="file" style="width:100%;" name="other_document[]" class="mt-1 form-control"><i class="fa-solid fa-circle-minus minus" style="color:red;"></i> </div>`
    //     );
        
    // });

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

   $(document).on('click',"#Won_back",function(){
       $('#edit-rfq').removeClass('d-none');
       $('#otherFieldDiv').addClass('d-none');
       $('#bidrfq_edit').addClass('d-none');
   });

   $(document).on('click',"#next",function(){
       $('#edit-rfq').addClass('d-none');
       $('#otherFieldDiv').addClass('d-none');
       $('#bidrfq_edit').removeClass('d-none');
   });

   $(document).on('click',"#addRegister",function(){
       $('#edit-rfq').addClass('d-none');
       $('#otherFieldDiv').removeClass('d-none');
       $('#bidrfq_edit').addClass('d-none');
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

        function calculateTotals()
    {
        const columnCount = $("#mtables .operation_target:first").children().length;
        console.log(columnCount);
        let totals = new Array(columnCount).fill(0);
        // console.log(totals);
        $(".operation_target").each(function () {
            // $(this).find("tr").each(function (index) {
                $(this).find("td input").each(function (index) {
                    totals[index] += parseFloat($(this).val()) || 0;
                    console.log($(this).val());
                });
            // })
        });

        $("#totalRow").empty();
        $("#totalRow").append(`<td><b>Total</b></td>`);
        totals.forEach((total,key) => {
            if(key < columnCount - 1){
                $("#totalRow").append(`<td><input type="text" name="total[]" value="${total}"></td>`);
                
            }
        });
    }

    $(document).on("keyup", ".operation_target input", function () {
        calculateTotals()
    });
        
    })




</script>
@endsection
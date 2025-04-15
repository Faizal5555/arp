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
    .remove-group {
        position: absolute;
        top: -22px;
        right: 0px;
    }
    .relative{
        position: relative;
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
                        <form id="rfq" class="flex-wrap form col-md-12 d-flex update"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id" value="{{$newrfq && $newrfq->id ? $newrfq->id  : ''}}">
                            <input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount">
                            <input type="hidden" name="single_form"   value="{{isset($newrfq) && isset($newrfq->single) ? 1 : 0}}" id="single_form">
                            <input type="hidden" name="multiple_form"   value="{{isset($newrfq) && isset($newrfq->multiple) ? 1 : 0}}"id="multiple_form">
                            <input type="hidden" name="interview_form"  value="{{isset($newrfq) && isset($newrfq->interview) ? 1 : 0}}" id="interview_form">
                            <input type="hidden" name="online_form"  value="{{isset($newrfq) && isset($newrfq->online) ? 1 : 0}}" id="online_form">
                           
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
                                             type="date" class="form-control" placeholder="Date">
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
                                  <select class="form-control label-gray-3" name="industry" placeholder="Select Industry">
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
                                            type="date" class="form-control" placeholder="Follow Up date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 d-none">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Choose Currency<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                      
                                        <select class="form-control label-gray-3" id="currency" name="currency">
                                            <option value="₹"{{$newrfq && $newrfq->currency == '₹' ? 'selected' : ''}}>INR</option>
                                            <option value="$" {{$newrfq && $newrfq->currency == '$' ? 'selected' : ''}}>USD</option>
                                            <option value="€"{{$newrfq && $newrfq->currency == '€' ? 'selected' : ''}} >Euro</option>
                                            <option value="£" {{$newrfq && $newrfq->currency == '£' ? 'selected' : ''}}>Pound</option>     
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Choose Company Name<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                      
                                        <select class="form-control label-gray-3" id="company_name" name="company_name">
                                            <option value="Asia Research Partners"{{$newrfq && $newrfq->company_name == 'Asia Research Partners' ? 'selected' : ''}}>Asia Research Partners</option>
                                            <option value="Universal Research Panels" {{$newrfq && $newrfq->company_name == 'Universal Research Panels' ? 'selected' : ''}}>Universal Research Panels</option>
                                            <option value="Healthcare Panels India"{{$newrfq && $newrfq->company_name == 'Healthcare Panels India' ? 'selected' : ''}} >Healthcare Panels India</option>
                                                
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
                                                        <td class="static-field">No of FGDs/IDI</td>
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
                                                            <input type="text" class="form-control sample" value="{{$country}}" name="interview_depth_countries[]"  placeholder="Country">
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
                                                        <td class="static-field ">Requirements</td>
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
                                                                <input type="text" class="form-control sample" name="online_community_countries[]" value="{{$countries}}"  placeholder="Country">
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
                            <div class="col-md-6">
                            </div>
                            
                           
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <a href="{{route('operationNew.index')}}" class=" btn btn-outline-secondary" id="won-rfq-btn1">Back</a>
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
                                                            class="p-1 form-control" placeholder="Attach Client Contract">
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
                                                                        class="p-1 form-control" placeholder="Attach Vendor Contract">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            @endforeach
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField18" class="col-lg-3 col-form-label font-weight-semibold">Comments
                                                        <span class="text-danger">*</span></label>
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
                            <div class="col-md-6 d-none">
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
                           
                            <div class="col-md-6 d-none">
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
                            @if (auth()->user()->user_type == "admin")
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
                            @endif
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
                                         
                                         @if($k != 0)<i class="fa-solid fa-circle-minus minus" style="color:red;" data-id="{{$value->id}}"></i>
                                         @endif
                                        </div>
                                        
                                     @endforeach
                                    @endif
                                        <i class="float-right mt-1 mb-2 fa-solid fa-circle-plus add-file" style="color:green;" ></i>
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
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        Respondent Type <span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9" id="respondent_type_container">
                                        @php
                                            $respondentTypes = isset($operation->respondent_type) ? json_decode($operation->respondent_type) : [''];
                                        @endphp
                            
                                        @foreach($respondentTypes as $key => $type)
                                            <div class="d-flex mb-2 align-items-center respondent-type-row">
                                                <input type="text" name="respondent_type[]"  class="form-control" value="{{ $type }}" required>
                                                
                                                @if($key === 0)
                                                    {{-- Plus icon only for the first row --}}
                                                    <i class="fa-solid fa-circle-plus ml-2 text-success add-respondent-type" style="cursor:pointer;"></i>
                                                @else
                                                    {{-- Minus icon for additional rows --}}
                                                    <i class="fa-solid fa-circle-minus ml-2 text-danger remove-respondent-type" style="cursor:pointer;"></i>
                                                @endif
                                            </div>
                                        @endforeach
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
                            <?php
                                $world=explode(",",$operation->country_name);
                                $sample_target=json_decode($operation->sample_target,true);
                                $sample_achieved=json_decode($operation->sample_achieved,true);
                                $target_group=explode(",",$operation->target_group);
                            ?>  
                            <div class="col-md-12 ">
                                <div class="form-group row">
                                    <label class="col-lg-12 col-form-label font-weight-semibold">Target Table<span
                                            class="text-danger"></span></label>
                                            <button class="ml-2 btn btn-danger"  style="float: right;"id="addBtn" data-count="{{count($world) - 1}}" type="button">
                                                Add New Country
                                            </button>
                                            <button class="ml-2 btn-sm btn-success" style="float: right; height: 40px;"id="AddTargetGroup"
                                                data-count="0" type="button"><i class="fa-solid fa-plus"></i>
                                                Add Target Group
                                            </button>
                                    <div class="col-md-12 table-responsive" style="overflow-x:auto;">
                                    
                                        
                                       
                                        {{-- <button class="ml-2 btn btn-danger" class="removeBtn" type="button">
                                            remove Industry
                                        </button> --}}
                                    <table border="1" name="" class="mt-4" id="mtables">
                                      
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
                                            <tr class="operation_target" data-count="{{$c}}">
                                                <td >
                                               
                                                <select class="form-control label-gray-" name="country_name_0[]" id="country_name" required>
                                                    <option class="label-gray-3" value="{{$data}}">Country</option>
                                                        
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
                                        {{-- @if() --}}
                                    </table><br>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        Comments <span class="text-danger"></span>
                                    </label>
                                    <div class="col-lg-9">
                                        <textarea name="project_comment" style="height:150px;" class="form-control">{{ $operation && $operation->project_comment ? $operation->project_comment : '' }}</textarea>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <button type="button" id="Operation" class="btn btn-primary">Back</button>
                                <button type="submit" id="addRegisterButton"
                                    class="ml-2 btn btn-success">Update</button>
                                    
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
                     @if(auth()->user()->user_type == 'admin' )
                    <div class="col-md-4">
                       
                          <button type="button" class="btn btn-primary" id="my-comments" data-toggle="modal" data-target="#exampleModalCenter">
                            view Comments 
                          </button>
                    </div>
                   
                    {{-- <div class="col-md-4">
                        <div class="middle">
                        <button type="button" class="btn btn-primary" id="my-stop" data-toggle="modal" data-target="#exampleModalCenterstop">
                            Project Stopped In The Middle
                          </button>
                        </div>
                    </div> --}}
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
                      {{-- <div class="col-md-4">
                        <div class="middle">
                        <button type="button" class="btn btn-primary" id="my-stop" data-toggle="modal" data-target="#exampleModalCenterstop">
                            Project Stopped In The Middle
                          </button>
                        </div>
                    </div> --}}
                
                    <div class="col-md-4">
                         <button type="button" class="btn btn-primary" id="client-topic" data-toggle="modal" data-target="#exampleModalCenterstopclient">
                            Client Invoice Request
                          </button>
                    </div>
                     @elseif(auth()->user()->user_role == 'project_manager')
                       <div class="col-md-4">
                          <button type="button" class="btn btn-primary" id="pm-comments" data-toggle="modal" data-target="#pmexampleModalCenter">
                            Open Comments Box 
                          </button>
                    </div>
                      {{-- <div class="col-md-4">
                        <div class="middle">
                        <button type="button" class="btn btn-primary" id="my-stop" data-toggle="modal" data-target="#exampleModalCenterstop">
                            Project Stopped In The Middle
                          </button>
                        </div>
                    </div> --}}
                    <div class="col-md-4">
                         <button type="button" class="btn btn-primary" id="client-topic" data-toggle="modal" data-target="#exampleModalCenterstopclient">
                            Client Invoice Request
                          </button>
                    </div>
                    @elseif(auth()->user()->user_role == 'operation_head')
                    <div class="col-md-4">
                       <button type="button" class="btn btn-primary" id="oh-comments" data-toggle="modal" data-target="#ohexampleModalCenter">
                         Open Comments Box
                       </button>
                 </div>
                   {{-- <div class="col-md-4">
                     <div class="middle">
                     <button type="button" class="btn btn-primary" id="my-stop" data-toggle="modal" data-target="#exampleModalCenterstop">
                         Project Stopped In The Middle
                       </button>
                     </div>
                 </div> --}}
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
                        {{-- <div class="middle">
                        <button type="button" class="btn btn-primary" id="my-stop" data-toggle="modal" data-target="#exampleModalCenterstop">
                            Project Stopped In The Middle
                          </button>
                        </div>
                    </div> --}}
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

           <div class="mt-3 msg-bubble">
            <div class="msg-info">
             <div class="msg-info-name">Operation Head</div>
           </div>

       <div class="msg-text">
          {{$operation && $operation->oh_msg ? $operation->oh_msg : ''}}
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
  
    <!--  Open Operation Head Comments BOX End-->
    <div class="modal fade bd-example-modal-lg" id="ohexampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLongTitle">Comments BOX</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                
                <form id="ohcommentupdate" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id"  id="id" value="{{$operation && $operation->id ? $operation->id : ''}}">
                 <div class="msg-bubble">
                     <div class="msg-info">
                      <div class="msg-info-name">Operation</div>
                    </div>
    
                <div class="msg-text">
                   {{$operation && $operation->comments ? $operation->comments : ''}}
                </div>
               </div>
               
                @if($operation->oh_msg!='')
                <div class="mt-3 right-msg col-md-12">
                    <div class="col-md-3"></div>
                    <div class="mt-3 msg-bubble">
                        <div class="col-md-6">
                     <div class="msg-info">
                      <div class="msg-info-name">You</div>
                    </div>
    
                <div class="msg-text">
                   {{$operation && $operation->oh_msg ? $operation->oh_msg : ''}}
                </div>
                </div>
                </div>
               </div>
               @endif
               
               <div class="mt-3 msger-inputarea">
                 <textarea name="oh_comments" id="oh_comments" value=""
                class="form-control msger-input" placeholder="Comments here..." required></textarea>
                 <button type="button" id="ohcommentsubmit" class="msger-send-btn">Send</button>
              </div>
               
            </form>   
            </div>
            <div class="modal-footer">
            </div>
          </div>
        </div>
      </div>
    
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
                        <input type="hidden" name="id" value="{{$operation && $operation->id ? $operation->id :''}}">
                         <label class="col-lg-6 col-form-label font-weight-semibold">Client Advance Invoice Raised <span class="text-danger"></span></label>
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
                         <label class="col-lg-6 col-form-label font-weight-semibold">Client Balance Invoice Raised <span class="text-danger">*</span></label>
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
                        <label class="col-lg-6 col-form-label font-weight-semibold">Vendor Advance Invoice Paid  <span class="text-danger"></span></label>
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
                         <label class="col-lg-6 col-form-label font-weight-semibold">Vendor Balance Invoice Paid  <span class="text-danger"></span></label>
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
                        <label class="col-lg-6 col-form-label font-weight-semibold">Attach Respondent Incentive File <span class="text-danger"></span></label>
                        <div class="col-lg-6">
                            <input name="respondentfile" value=""
                            id="respondentfile" type="file" class="p-1 form-control" placeholder="Attach Respondent incentive file">
                          
                        </div>
                    </div>


                    <div class="form-group row">
                        <label class="col-lg-6 col-form-label font-weight-semibold">Attach Project Data File<span class="text-danger">*</span></label>
                        <div class="col-lg-6">
                            <input name="clientinvoicefile" value=""
                            id="clientinvoicefile" type="file" class="p-1 form-control" placeholder="Attach Client invoice file">
                          
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-lg-6 col-form-label font-weight-semibold">Attach Any Other File <span class="text-danger"></span></label>
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
                        <label class="col-lg-6 col-form-label font-weight-semibold">Attach Vendor Confirmation Email <span class="text-danger"></span></label>
                        <div class="col-lg-6">
                            <input name="vendor_confirmation" value=""
                            id="vendor_confirmation" type="file" class="p-1 form-control" placeholder="Attach Vendor Confirmation Email">
                          
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
                    <div class="text-center col-md-12 d-flex justify-content-center">
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
                <label>Client Manager</label>    
                <input type="type" name="client_manager" id="client_manager" class="form-control">
                </div>
                <div class="form-group">  
                        <label>Client Address</label>    
                        <input type="type" name="client_address" id="client_address" class="form-control">
                    </div>
                <div class="form-group">  
                        <label>PO Number</label>    
                        <input type="type" name="client_po_number" id="client_po_number" class="form-control">
                    </div>
                    <div class="form-group">  
                        <label>PN Number</label>    
                        <input type="type" name="client_pn_number" id="client_pn_number" class="form-control">
                </div>

               <div class="form-group">  
                <label>Client Advance</label>    
                <input type="type" name="client_advance" id="client_advance" class="form-control">
               </div>

               <div class="form-group">  
                <label>Client Contract </label>    
                <input type="type" name="client_contract" id="client_contract" class="form-control">
               </div>
               <div class="form-group">
                <label>Comments</label>    
                <textarea type="type" name="advance_comment" id="advance_comment" class="form-control"></textarea>
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
                <label>Client Manager</label>    
                <input type="type" name="client_manager" id="client_manager1" class="form-control">
           </div>
           <div class="form-group">  
                <label>Client Address</label>    
                <input type="type" name="client_address" id="client_address1" class="form-control">
            </div>
           <div class="form-group">  
                <label>PO Number</label>    
                <input type="type" name="client_po_number" id="client_po_number1" class="form-control">
            </div>
            <div class="form-group">  
                <label>PN Number</label>    
                <input type="type" name="client_pn_number" id="client_pn_number1" class="form-control">
           </div>
           <div class="form-group">  
            <label>Client Balance</label>    
            <input type="type" name="client_balance" id="client_balance" class="form-control">
           </div>
           <div class="form-group">  
            <label>Client Contract </label>    
            <input type="type" name="client_contract" id="clientcontract" class="form-control">
           </div>
           <div class="form-group">
            <label>Comments</label>    
            <textarea type="type" name="balance_comment" id="balance_comment"  class="form-control"></textarea>
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
                // quality_analyst_name: {
                //     required: true
                // },
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
                // project_comment:{
                //     required: true
                // },
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


    
    $(document).on('keyup', '.bid-table td input:not(input[name^="sample_size"])', function() {
                // code logic here
        let index = $(this).closest("td").index();
        let table = $(this).closest('table');
        let row = table.find("tr");
        let rowLength = row.length;
        var sum = 0;
        row.each(function(key){
            if(key > 2 && key < (rowLength - 1))
            {
                let val = parseInt($(this).children('td').eq(index).find('input').val());
                if(!isNaN(val))
                {
                    sum = sum + val;
                }
            }
            if(key == (rowLength - 1))
            {
                console.log('hi');
                $(this).children('td').eq(index).find('input').val(sum)
            }
            
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
                      <button class="float-left ml-2 btn btn-danger btn-remove-country1" data-country1="${rar}"  type="button">
                                        <i class="fa-solid fa-xmark"></i></button>
                      </th>
                      </tr>
                      <tr class="pop">
                       <th>
                         <label class="form-group has-float-label1">
                            <select class="form-control label-gray-3" name="country_0[][]">
                               <option class="label-gray-3" value="">Country</option>
                                  @if(count($country_fetch) > 0)
                                    @foreach($country_fetch as $v)
                                     <option value="{{$v->name}}">{{$v->name}}</option>
                                         @endforeach
                                            @endif
                                    </select>
                                             </label>
                                            
                                        
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
    // html=`<tr id="addoperation">
                                            
    //     <td>
    //         <select class="form-control label-gray-3" name="country_name_0[]" id="country_name" required>
    //         <option class="label-gray-3" value="">Select Country</option>
                
    //             @if (count($country_fetch) > 0)
    //             @foreach($country_fetch as $value)
    //             <option value="{{$value->name}}">{{$value->name}}</option>
    //             @endforeach
    //             @endif
    //         </select>
    //     </td>
    //     <td>
    //         <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
    //     </td>
    //     <td>
    //         <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
    //     </td>
    //     <td>
    //         <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
    //     </td>
    //     <td>
    //         <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
    //     </td><td>
    //         <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
    //     </td>
    //     <td>
    //         <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
    //     </td><td>
    //         <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
    //     </td>
    //     <td>
    //         <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
    //     </td>
    //     <td>
    //         <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
    //     </td>
    //     <td>
    //         <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
    //     </td>
    //     <td>
    //         <input type="text" class="border-0" name="sample_target_0[]" placeholder="Sample Target">
    //     </td>
    //     <td>
    //         <input type="text" class="border-0" name="sample_achieved_0[]" placeholder="Sample Achieved">
    //     </td>
    //     <td>
    //         <button class="ml-2 btn btn-danger" id="removeBtn" type="button">
    //                                         Remove
    //                                     </button>
    //     </td>
    // </tr>`;       
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
    $(document).on('click' ,'#addBtn',function(){
        var lastRow = $('.operation_target').last();
        var count = lastRow.length ? parseInt(lastRow.attr('data-count')) + 1 : 0;
        let td_length = $('#mtables .operation_target:first').find('td').length;
        // Construct the new row
        var html = `
        <tr class="operation_target" data-count="${count}">
            <td>
                <select class="form-control label-gray-3" name="country_name_0[${count}]" required>
                    <option value="">Select Country</option>
                    @if (count($country_fetch) > 0)
                    @foreach ($country_fetch as $value)
                    <option value="{{ $value->name }}">{{ $value->name }}</option>
                    @endforeach
                    @endif
                </select>
            </td>
            <td><input type="text" class="border-0" name="sample_target_0[${count}][]" placeholder="Sample Target"></td>
            <td><input type="text" class="border-0" name="sample_achieved_0[${count}][]" placeholder="Sample Achieved"></td>
            <td><input type="text" class="border-0" name="sample_target_0[${count}][]" placeholder="Sample Target"></td>
            <td><input type="text" class="border-0" name="sample_achieved_0[${count}][]" placeholder="Sample Achieved"></td>
            <td><input type="text" class="border-0" name="sample_target_0[${count}][]" placeholder="Sample Target"></td>
            <td><input type="text" class="border-0" name="sample_achieved_0[${count}][]" placeholder="Sample Achieved"></td>
            <td><input type="text" class="border-0" name="sample_target_0[${count}][]" placeholder="Sample Target"></td>
            <td><input type="text" class="border-0" name="sample_achieved_0[${count}][]" placeholder="Sample Achieved"></td>
            <td><input type="text" class="border-0" name="sample_target_0[${count}][]" placeholder="Sample Target"></td>
            <td><input type="text" class="border-0" name="sample_achieved_0[${count}][]" placeholder="Sample Achieved"></td>
            <td><input type="text" class="border-0" name="sample_target_0[${count}][]" placeholder="Sample Target"></td>
            <td><input type="text" class="border-0" name="sample_achieved_0[${count}][]" placeholder="Sample Achieved"></td>
            `
        if(td_length > 13)
        {
            let remove_count = $('.remove-group').map(function () {
                return $(this).data('count');
            }).get();
            let j = 0;
            for(i = 13; i < td_length; i+=2)
            {
                html += `<td class="remove-group-${remove_count[j]}"><input type="text" class="border-0" name="sample_target_0[${count}][]" placeholder="Sample Target"></td>
                <td class="remove-group-${remove_count[j]}"><input type="text" class="border-0" name="sample_achieved_0[${count}][]" placeholder="Sample Achieved"></td>`;
                j++;
            }
        }
        html +=`<td>
                    <button type="button" class="ml-2 btn btn-danger removeBtn">Remove</button>
                </td>
            </tr>`;

        // Append the new row to the table
        $('#totalRow').before(html);
        calculateTotals();
    });
   $(document).on('click', '#removeBtn', function(){  
         $(this).closest("tr").remove();
         calculateTotals();
    });
    $(document).on('input', '.operation_target input[type="text"]', function () {
        calculateTotals();
    });
    $('#AddTargetGroup').click(function () {
        let html = "";
        let j = $(this).attr('data-count');
        $(this).attr('data-count',parseInt(j) + 1);

        $('#mtables tr').each(function (key, value) {
            let i = $(this).attr('data-count');
            if(key == 0)
            {
                $(this).append(`<th colspan="2" class="relative remove-group-${j}"><input type="text" class="form-control" name="target_group[]" style="text-align: center" value="Target Group "><button type="button" class="ml-2 btn btn-danger remove-group" data-count="${j}">x</button></th>`);
            }else if(key == 1){
                $(this).append(`
                <td style="text-align: center" class="remove-group-${j}">Sample Target</td><td style="text-align: center" class="remove-group-${j}">Sample Achieved</td>`)
            }else if( key + 1 == $('#mtables tr').length){
                $(this).append(`<td class="total remove-group-${j}"><input type="text" name="total[]" value="0" class="border-0"></td><td class="total remove-group-${j}"><input type="text" name="total[]" value="0" class="border-0"></td>`)
            }else if (key >= 2 && key < ({{count($world)}} + 2)){
                $(this).append(`<td class="remove-group-${j}">
                                    <input type="text" class="border-0" name="sample_target_0[${i}][]" placeholder="Sample Target">
                                </td>
                                <td class="remove-group-${j}">
                                    <input type="text" class="border-0" name="sample_achieved_0[${i}][]" placeholder="Sample Achieved">
                                </td>`)
            }else{
                $(this).find('td:last').before(`<td class="remove-group-${j}">
                                    <input type="text" class="border-0" name="sample_target_0[${i}][]" placeholder="Sample Target">
                                </td><td class="remove-group-${j}">
                                    <input type="text" class="border-0" name="sample_achieved_0[${i}][]" placeholder="Sample Achieved">
                                </td>`   );
            }
        })
        calculateTotals();
        // Append the new row to the table  
    })
    $(document).on('click', '.remove-group', function () {
        let i = $(this).attr('data-count');
        $(`.remove-group-${i}`).remove();
        calculateTotals();
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
        // clientadvance:{
        //     required: true
        // },
        clientbalance:{
            required: true
        },
        // vendoradvance:{
        //     required: true
        // },
        // vendorbalance:{
        //     required:true
        // },
        // respondentfile:{
        //     required: true
        // },
        clientinvoicefile:{
            required:true
        },
        // vendorinvoicefile:{
        //     required:true
        // },
        client_confirmation:{
            required:true
        },
        // vendor_confirmation:{
        //     required:true
        // },
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
                let projectId = $('#complete input[name="id"]').val();

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
                        if (data.success == 1) {
                        if (data.clientbalance === 'Yes') {
                            // Show Project Completed Popup
                            $("#project_hold").addClass('d-none');
                            $("#project_closed").removeClass('d-none');
                        } else {
                            // Show Project Ongoing/Hold Popup
                            $("#project_closed").addClass('d-none');
                            $("#project_hold").removeClass('d-none');
                        }
                        $('#statusbar').modal('show'); // Show modal after setting classes
                    } else {
                        alert('Fail'); // This appears if `success` is not 1
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
             sales_comment:{
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


        $("#ohcommentsubmit").click(function(e){
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
                    comments:$('#oh_comments').val(),
                },
                url:"{{route('operationNew.ohadd')}}",
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
                     $('#ohexampleModalCenter').modal('hide');
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
         $(document).on('click','#oh-comments',function(){
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
                     <div class="mt-3 form-group"><label>Vendor Contract </label><input type="type" name="vendor_contract" id="vendor_contract_${i}" value="${vendor_contract[i]}" class="form-control"><a class="mt-3 mdi mdi-download" href="adminapp/public/                                                                                                     ${vendor_contract[i]}" id="version-1" download >download</a></div>
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
               </div><div class="form-group"><label>Vendor Balance</label><input type="type" name="vendor_balance" id="vendor_balance_${i}" value="${vendor_currency} ${vendor_balance[i]}" class="form-control"></div><div class="form-group"><label>Vendor Contract </label><input type="type" name="vendor_contract1" id="vendor_contract1_${i}" value="adminapp/public/${vendor_contract[i]}" class="form-control"></div><a class="mdi mdi-download"  id="version-2" download href=''>download</a><div class="modal-footer d-flex justify-content-between"><a href="/operationNew/projectview/{{$operation && $operation->id ? $operation->id :''}}" style="color:green;text-decoration: none;" class="d-flex justify-content-start">Project File</a><button type="button" class="btn btn-success vendor_balance_request" data-id="${i}" >Submit</button></div><div><button type="button"  class="btn btn-success vendor_sign_pre" data-pre="${i-1}">Prev</button><button type="button" class="float-right btn btn-success vendor_sign_next" data-nxt=${i+ 1}>Next</button>
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

function sanitizeAddress(str) {
    return str
        .replaceAll("/", "[slash]")
        .replaceAll(",", "[comma]")
        .replaceAll(".", "[dot]")
        .replaceAll(":", "[colon]")
        .replaceAll(";", "[semicolon]")
        .replaceAll("'", "[quote]")
        .replaceAll('"', "[doublequote]")
        .replaceAll("&", "[and]")
        .replaceAll("#", "[hash]")
        .replaceAll("%", "[percent]")
        .replaceAll("?", "[question]")
        .replaceAll("=", "[equal]")
        .replaceAll("+", "[plus]")
        .replaceAll("@", "[at]");
}

      $('#client_Advance_request').click(function(e){
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
        });

        //const encodedAddress = encodeURIComponent($('#client_address').val());

       
        $.ajax({
            type:"post",
            data:{
                operation_id:$('#operation_id').val(),
                id:$('#advanceid').val(),
                client_id:$('#client_id').val(),
                client_pn_number:$('#client_pn_number').val(),
                client_po_number:$('#client_po_number').val(),
                client_manager:$('#client_manager').val(),
                client_address: sanitizeAddress($('#client_address').val()),
                amount:$('#client_advance').val(),
                client_contract:$('#client_contract').val(),
                invoice_type:$('#invoice_type').val(),
                advance_comment:$('#advance_comment').val(),
               
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

        //const encodedAddress = encodeURIComponent($('#client_address1').val());


        $.ajax({
            type:"post",
            data:{
                operation_id:$('#operationid').val(),
                id:$('#balanceid').val(),
                client_id:$('#clientid').val(),
                client_pn_number:$('#client_pn_number1').val(),
                client_po_number:$('#client_po_number1').val(),
                client_manager:$('#client_manager1').val(),
                client_address: sanitizeAddress($('#client_address1').val()),
                amount:$('#client_balance').val(),
                client_contract:$('#clientcontract').val(),
                invoice_type:$('#invoice_type1').val(),
                balance_comment:$('#balance_comment').val(),

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
    
      $(document).on('click', '.add-file', function () {
        // alert("hi");
        console.log('clicked')
        $("#other_document").append(
            `<div class="d-flex"><input type="file" style="width:100%;" name="other_document[]" class="mt-1 form-control"><i class="fa-solid fa-circle-minus minus" style="color:red;"></i> </div>`
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
                sales_comment:{
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


    $(document).ready(function() {
            $(document).on('keyup', '#costingTable td input', function() {
                let index = $(this).closest("td").index();
                let table = $(this).closest('table');
                let row = table.find("tr");
                let rowLength = row.length;
                var sum = 0;
                let sample = 1;
                row.each(function(key){
                    if(key == 5)
                    {
                        let val = parseFloat($(this).children('td').eq(index).find('input').val());
                        if(!isNaN(val))
                        {
                        sample = val;
                        }
                    }
                    if(key > 5 && key < (rowLength - 1))
                    {
                        let val = parseFloat($(this).children('td').eq(index).find('input').val());
                        if(!isNaN(val))
                        {
                            sum = sum + val;
                        }
                    }
                    if(key == (rowLength - 1))
                    {   
                        let total = (sum * sample).toFixed(2); 
                        $(this).children('td').eq(index).find('input').val(total);
                    }
                    
                });
            });


       //Multiple Country

            $(document).on('keyup', '#MultipleCountry td input', function() {
                let totalValues = [];
                let total_length = $('#MultipleCountry tbody td:has(input[attr="total"])').length;
                let overall_total_length = $('#MultipleCountry tbody td:has(input[name="multiple_total_cost[]"])').length;
                $('#MultipleCountry tbody td:has(input[attr="total"])').each(function(){
                    let cpi = parseFloat($(this).prev().find('input').val());
                    let sample = parseFloat ($(this).prev().prev().find('input').val());
                    if(!isNaN(cpi) && !isNaN(sample))
                    {
                        let total = (cpi * sample).toFixed(2); // Ensure two decimal places
                        $(this).find('input').val((cpi*sample).toFixed(2));
                        totalValues.push(cpi*sample);
                    }else{
                        $(this).find('input').val("");
                        totalValues.push(0);
                    }
                })
                let colIndex = 3;
                $('#MultipleCountry tbody td:has(input[name="multiple_total_cost[]"])').each(function() {
                    let sum = 0;
                    $("#MultipleCountry tbody tr").each(function () {
                        let inputValue = parseFloat($(this).find("td").eq(colIndex).find("input[attr='total']").val()) || 0;
                        sum += inputValue;
                    });
                    colIndex+=3;
                    $(this).find('input').val(sum.toFixed(2)); 
                })
            });

            // interview in depth calculation
            $(document).on('keyup', '#InterviewDepth td input', function() {
                let totalValues = [];
                let total_length = $('#InterviewDepth tbody td:has(input[attr="total"])').length;
                let overall_total_length = $('#InterviewDepth tbody td:has(input[name="interview_depth_total_cost_1[]"])').length;
                $('#InterviewDepth tbody td:has(input[attr="total"])').each(function(){
                    let cpi = parseFloat($(this).prev().find('input').val());
                    let sample = parseFloat ($(this).prev().prev().find('input').val());
                    if(!isNaN(cpi) && !isNaN(sample))
                    {
                        let total = (cpi * sample).toFixed(2); // Ensure two decimal places
                        $(this).find('input').val((cpi*sample).toFixed(2));
                        totalValues.push(cpi*sample);
                    }else{
                        $(this).find('input').val("");
                        totalValues.push(0);
                    }
                })
                let colIndex = 3;
                $('#InterviewDepth tbody td:has(input[attr="total1"])').each(function() {
                    let sum = 0;
                    $("#InterviewDepth tbody tr").each(function () {
                        let inputValue = parseFloat($(this).find("td").eq(colIndex).find("input[attr='total']").val()) || 0;
                        sum += inputValue;
                    });
                    colIndex+=3;
                    $(this).find('input').val(sum.toFixed(2)); 
                })
                // let index = 1;
                $('#InterviewDepth tbody td:has(input[attr="total2"])').each(function(index) {
                    let total = 0;
                    // $("#InterviewDepth tbody tr").each(function () {
                    //     console.log(index)
                        let multiple = parseFloat($("input[name='interview_depth_fgd[]']").eq(index).val()) || 0;
                        console.log(multiple);
                        let inputValue = parseFloat($("input[attr='total1']").eq(index).val()) || 0;
                        total = inputValue * multiple;
                    // });
                    // index++;
                    $(this).find('input').val(total);
                })
            });

            // online community

            $(document).on('keyup', '#OnlineCommunity td input', function() {
                console.log("hello");
                let totalValues = [];
                let total_length = $('#OnlineCommunity tbody td:has(input[attr="total"])').length;
                let overall_total_length = $('#OnlineCommunity tbody td:has(input[name="online_community_total_cost[]"])').length;
                $('#OnlineCommunity tbody td:has(input[attr="total"])').each(function(){
                    let cpi = parseFloat($(this).prev().find('input').val());
                    let sample = parseFloat ($(this).prev().prev().find('input').val());
                    if(!isNaN(cpi) && !isNaN(sample))
                    {
                        let total = (cpi * sample).toFixed(2); // Ensure two decimal places
                        $(this).find('input').val((cpi*sample).toFixed(2));
                        console.log(cpi*sample)
                        totalValues.push(cpi*sample);
                    }else{
                        $(this).find('input').val("");
                        totalValues.push(0);
                    }
                })
                let colIndex = 3;
                $('#OnlineCommunity tbody td:has(input[name="online_community_total_cost[]"])').each(function() {
                    let sum = 0;
                    $("#OnlineCommunity tbody tr").each(function () {
                        let inputValue = parseFloat($(this).find("td").eq(colIndex).find("input[attr='total']").val()) || 0;
                        sum += inputValue;
                    });
                    colIndex+=3;
                    $(this).find('input').val(sum.toFixed(2)); 
                })
            });
        });

        
        $(document).on('click', '.add-respondent-type', function () {
    let html = `
        <div class="d-flex mb-2 align-items-center respondent-type-row">
            <input type="text" name="respondent_type[]" class="form-control" placeholder="Enter Respondent Type" required>
            <i class="fa-solid fa-circle-minus ml-2 text-danger remove-respondent-type" style="cursor:pointer;"></i>
        </div>
    `;
    $('#respondent_type_container').append(html);
});

$(document).on('click', '.remove-respondent-type', function () {
    $(this).closest('.respondent-type-row').remove();
});




</script>
@endsection
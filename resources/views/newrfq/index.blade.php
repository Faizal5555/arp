@extends('layouts.master')
@section('page_title', 'Costing Sheet')
@section('content')

<style>

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
        /* padding: 5px 10px;
        border-radius: 50%; */
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

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header header-elements-inline">
                    <div class="card-title">
                        <div class="sub-text">
                            Create RFQ Form
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">

                        <form id="register"class="flex-wrap form col-md-12 d-flex" enctype="multipart/form-data">
                            <input type="hidden" name="single_form" id="single_form">
                            <input type="hidden" name="multiple_form" id="multiple_form">
                            <input type="hidden" name="interview_form" id="interview_form">
                            <input type="hidden" name="online_form" id="online_form">
                            @csrf
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">RFQ No <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="rfq_no" value="{{ $rfq_no }}"
                                            type="text" class="form-control" placeholder="RFQ NO" readonly="readonly">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Date<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">

                                        <input name="date" value="{{ date('Y-m-d') }}" type="date"
                                            class="form-control " placeholder="Date">


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Industry<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="industry">
                                            <option class="" value="" disabled selected>Select
                                                Industry
                                            </option>
                                            <option value="Manufacturing Industry">Manufacturing Industry</option>
                                            <option value="Production Industry">Production Industry</option>
                                            <option value="Food Industry">Food Industry</option>
                                            <option value="Agricultural Industry">Agricultural Industry</option>
                                            <option value="Technology Industry">Technology Industry</option>
                                            <option value="Construction Industry">Construction Industry</option>
                                            <option value="Factory Industry">Factory Industry</option>
                                            <option value="Mining Industry">Mining Industry</option>
                                            <option value="Finance Industry">Finance Industry</option>
                                            <option value="Retail Industry">Retail Industry</option>
                                            <option value="Engineering Industry">Engineering Industry</option>
                                            <option value="Marketing Industry">Marketing Industry</option>
                                            <option value="Education Industry">Education Industry</option>
                                            <option value="Transport Industry">Transport Industry</option>
                                            <option value="Chemical Industry">Chemical Industry</option>
                                            <option value="Healthcare Industry">Healthcare Industry</option>
                                            <option value="Hospitality Industry">Hospitality Industry</option>
                                            <option value="Energy Industry">Energy Industry</option>
                                            <option value="Science Industry">Science Industry</option>
                                            <option value="Waste Industry">Waste Industry</option>
                                            <option value="Chemistry Industry">Chemistry Industry</option>
                                            <option value="Teritiary Sector Industry">Teritiary Sector Industry</option>
                                            <option value="Real Estate Industry">Real Estate Industry</option>
                                            <option value="Financial Services Industry">Financial Services Industry
                                            </option>
                                            <option value="Telecommunications Industry">Telecommunications Industry
                                            </option>
                                            <option value="Distribution Industry">Distribution Industry</option>
                                            <option value="Medical Device Industry">Medical Device Industry</option>
                                            <option value="Biotechnology Industry">Biotechnology Industry</option>
                                            <option value="Aviation Industry">Aviation Industry</option>
                                            <option value="Insurance Industry">Insurance Industry</option>
                                            <option value="Trade Industry">Trade Industry</option>
                                            <option value="Stock Market Industry">Stock Market Industry</option>
                                            <option value="Electronics Industry">Electronics Industry</option>
                                            <option value="Textile Industry">Textile Industry</option>
                                            <option value="Computers and Information Technology Industry">Computers and
                                                Information Technology Industry</option>
                                            <option value="Market Research Industry">Market Research Industry</option>
                                            <option value="Machine Industry">Machine Industry</option>
                                            <option value="Recycling Industry">Recycling Industry</option>
                                            <option value="Information and Communication Technology Industry">
                                                Information and Communication Technology Industry</option>
                                            <option value="E- Commerce Industry">E- Commerce Industry</option>
                                            <option value="Research Industry">Research Industry</option>
                                            <option value="Rail Transport Industry">Rail Transport Industry</option>
                                            <option value="Food Processing Industry">Food Processing Industry</option>
                                            <option value="Small Business Industry">Small Business Industry</option>
                                            <option value="Wholesale Industry">Wholesale Industry</option>
                                            <option value="Pulp and Paper Industry">Pulp and Paper Industry</option>
                                            <option value="Vehicle Industry">Vehicle Industry</option>
                                            <option value="Steel Industry">Steel Industry</option>
                                            <option value="Renewable Energy Industry">Renewable Energy Industry</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Follow Up Date<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="follow_up_date"
                                            value=""
                                            type="date" class="form-control" placeholder="Follow Up date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">
                                        Choose Company<span class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-9">
                                        <select class="form-control" name="company_name"
                                            id="company_name">
                                            <option class="" value="" disabled selected>Select
                                                Company</option>
                                            <option value="Asia Research Partners">Asia Research Partners</option>
                                            <option value="Universal Research Panels">Universal Research Panels
                                            </option>
                                            <option value="Healthcare Panels India">Healthcare Panels India</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                   
              
                            <div class="container mt-5">
                                <div class="tab-container">
                                    <button class="tab-button inactive" type="button" data-target="#single-country">CATI / CAPI / Online Research Single Country</button>
                                    <button class="tab-button inactive" type="button" data-target="#mulitple-country">CATI / CAPI / Online Research Multiple Countries</button>
                                    <button class="tab-button inactive" type="button" data-target="#interview-depth">In-Depth Interviews / Focus Groups</button>
                                    <button class="tab-button inactive" type="button" data-target="#online-community">Online Community - Costing Sheet</button>
                                </div>
                                <div class="d-none" id="single-country">
                                    <h5>CATI / CAPI / Online Research Single Country</h5>
                                
                                <div class="append-controls">
                                    <button type="button" class="btn btn-success btn-sm" id="addMore">Add More</button>
                                </div>

                                <div class="table-container mt-2">
                                    <table class="" id="costingTable">
                                        <tbody>
                                            <tr>
                                                <td class="static-field">Methodology</td>
                                                <td><input type="text" class="form-control" name="single_methodology[]"></td>
                                            </tr>
                                            <tr>
                                                <td class="static-field">Currency</td>
                                                <td><input type="text" class="form-control" name="single_currency[]"></td>
                                            </tr>
                                            <tr>
                                                <td class="static-field">LOI</td>
                                                <td><input type="text" class="form-control" name="single_loi[]"></td>
                                            </tr>
                                            
                                            <tr>
                                                <td class="static-field">Country</td>
                                                <td><input type="text" class="form-control" name="single_country[]"></td>
                                            </tr>
                                            
                                            <tr>
                                            <td class="static-field">Client</td>
                                            <td>
                                            <select class="form-control"
                                                name="single_client[]">
                                                <option class=""
                                                    value="">Client</option>
                                                @if (count($client) > 0)
                                                    @foreach ($client as $v)
                                                        <option
                                                            value="{{ $v->client_name }}">
                                                            {{ $v->client_name }}
                                                        </option>
                                                    @endforeach
                                                @endif
                                            </select>
                                            </td>
                                            </tr>
                                            
                                            <tr>
                                            <td class="static-field">Sample</td>
                                            <td><input type="text" class="form-control" name="single_sample[]"></td>
                                            </tr>
                                            <tr>
                                                <td class="static-field">Fieldwork CPI</td>
                                                <td><input type="text" class="form-control" name="single_fieldwork[]">
                                                </td>
                                            </tr>
                                            
                                            <tr id="otherFields">
                                                <td class="d-flex">
                                                    <button type="button" class="btn btn-sm add-other">+</button> 
                                                    <input type="text" class="form-control" placeholder="Others" name="single_other[0][]">
                                                </td>
                                                <td><input type="text" class="form-control" name="single_other[0][]"></td>
                                            </tr>
                                            <tr>
                                                <td>Total Cost</td>
                                                <td><input type="text" class="form-control" name="single_total_cost[]"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>


                            <div class="container">

                                <div class="d-none" id="mulitple-country">
                                        <h5>CATI / CAPI / Online Research Multiple Country</h5>
                                    
                                    <div class="tab-container">
                                        <button type="button" class="btn btn-success btn-sm" id="addMultipleCountryBtn">Add More</button>
                                    </div>

                                    <div class="table-container mt-2">
                                        <table class="" id="MultipleCountry">
                                            <tbody>
                                                <tr>
                                                    <td class="static-field">Methodology</td>
                                                    <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control" name="multiple_methodology[]" value="" placeholder="Online">
                                                    </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                <td class="static-field">Currency</td>
                                                <td class="editable-field"  colspan="3">
                                                <label class="mb-0 label">
                                                <input type="text" class="form-control" name="multiple_currency[]" value="" placeholder="currency">
                                                </label></td>
                                                </tr>
                                                <tr>
                                                <td class="static-field">LOI</td>
                                                <td class="editable-field"  colspan="3">
                                                <label class="mb-0 label">
                                                <input type="text" class="form-control" name="multiple_loi[]" value="" placeholder="mins">
                                                </label></td>
                                                </tr>
                                                <tr>
                                                <td class="static-field">Client</td>
                                                <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label"> 
                                                    <select class="form-control label-gray-3" name="multiple_client[]">
                                                        <option class="label-gray-3" value="">Client</option>
                                                        @foreach ($client as $v)
                                                            <option value="{{ $v->client_name }}">{{ $v->client_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    </label>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">Countries</td>
                                                    <td class="static-field">Sample</td>
                                                    <td class="static-field">CPI</td>
                                                    <td class="static-field">Total</td>
                                                </tr>
                                                <tr>
                                                    <td class="editable-field"><input type="text" class="form-control" name="multiple_countries[0][]" placeholder="country"></td>
                                                    <td><input type="text" class="form-control" name="multiple_countries[0][]" value=""></td>
                                                    <td><input type="text" class="form-control" name="multiple_countries[0][]" value=""></td>
                                                    <td><input type="text" class="form-control" name="multiple_countries[0][]" attr="total" value=""></td>
                                                </tr>
                                                <tr>
                                                    <td class="editable-field"><input type="text" class="form-control" name="multiple_countries[1][]" placeholder="country"></td>
                                                    <td><input type="text" class="form-control sample"  name="multiple_countries[1][]"></td>
                                                    <td><input type="text" class="form-control cpi"  name="multiple_countries[1][]"></td>
                                                    <td><input type="text" class="form-control cpi" attr="total"  name="multiple_countries[1][]"></td>
                                                </tr>
                                                {{-- <tr>
                                                    <td class="editable-field"><input type="text" class="form-control" name="multiple_countries[2][]" placeholder="country"></td>
                                                    <td><input type="text" class="form-control sample"  name="multiple_countries[2][]"></td>
                                                    <td><input type="text" class="form-control cpi"  name="multiple_countries[2][]"></td>
                                                    <td><input type="text" class="form-control cpi" attr="total"  name="multiple_countries[2][]"></td>
                                                </tr>
                                                <tr>
                                                    <td class="editable-field"><input type="text" class="form-control" name="multiple_countries[3][]" placeholder="country"></td>
                                                    <td><input type="text" class="form-control"  name="multiple_countries[3][]"></td>
                                                    <td><input type="text" class="form-control"  name="multiple_countries[3][]"></td>
                                                    <td><input type="text" class="form-control" attr="total"  name="multiple_countries[3][]"></td>
                                                </tr> --}}
                                                <tr id="otherFieldMultipleCountry">
                                                    <td class="d-flex"><button type="button" class="btn btn-sm multiple_country_other">+</button> <input type="text" name="multiple_other[0][]" class="form-control" placeholder="Others"></td>
                                                    <td><input type="text" class="form-control" name="multiple_other[0][]"></td>
                                                    <td><input type="text" class="form-control" name="multiple_other[0][]"></td>
                                                    <td> <input type="text" class="form-control" name="multiple_other[0][]" attr="total"></td>
                                                </tr>
                                                <tr>
                                                    <td class="total-cost">Total project cost</td>
                                                    <td class="total-cost"></td>
                                                    <td class="total-cost"></td>
                                                    <td><input type="text" class="form-control" name="multiple_total_cost[]" value=""></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="container">

                                <div class="d-none" id="interview-depth">
                                    <h5>In-Depth Interviews /Focus Groups Costing Sheet/ Cenetral Location Tests Costing Sheet</h5>
                                
                                    <div class="tab-container">
                                        <button type="button" class="btn btn-success btn-sm" id="addInterviewDepthBtn">Add More</button>
                                    </div>

                                    <div class="table-container mt-2">
                                        <table class="" id="InterviewDepth">
                                            <tbody>
                                                <tr>
                                                    <td class="static-field">Methodology</td>
                                                    <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control" name="interview_depth_methodology[]" value="" placeholder="Online FGDs">
                                                    </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">Currency</td>
                                                    <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control" name="interview_depth_currency[]" value=""  placeholder="currency">
                                                    </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">LOI</td>
                                                    <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control sample" name="interview_depth_loi[]" value=""  placeholder="mins">
                                                    </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">Client</td>
                                                    <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label"> 
                                                        <select class="form-control label-gray-3" name="interview_depth_client[]">
                                                        <option class="label-gray-3" value="">Client</option>
                                                        @foreach ($client as $v)
                                                            <option value="{{ $v->client_name }}">{{ $v->client_name }}</option>
                                                        @endforeach
                                                        </select>
                                                    </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">No of FGDs</td>
                                                    <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control sample" name="interview_depth_fgd[]" value=""  placeholder="value">
                                                    </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">Samples per FGD</td>
                                                    <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control sample" name="interview_depth_sample_fgd[]" value=""  placeholder="value">
                                                    </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">Country</td>
                                                    <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control sample" value="" name="interview_depth_countries[]"  placeholder="country">
                                                    </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field"></td>
                                                    <td class="static-field">Sample</td>
                                                    <td class="static-field">CPI</td>
                                                    <td class="static-field">Total</td>
                                                </tr>

                                                <tr>
                                                    <td class="static-field">Recruitment</td>
                                                    <td><input type="text" class="form-control sample" name="interview_depth_requirement[]" value=""></td>
                                                    <td><input type="text" class="form-control cpi" name="interview_depth_requirement[]" value=""></td>
                                                    <td><input type="text" class="form-control total" name="interview_depth_requirement[]" attr="total" value=""></td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">Incentives</td>
                                                    <td><input type="text" class="form-control sample" name="interview_depth_incentives[]" value=""></td>
                                                    <td><input type="text" class="form-control cpi" name="interview_depth_incentives[]" value=""></td>
                                                    <td><input type="text" class="form-control cpi" name="interview_depth_incentives[]" attr="total" value=""></td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">Moderation</td>
                                                    <td><input type="text" class="form-control sample" name="interview_depth_moderation[]" value=""></td>
                                                    <td><input type="text" class="form-control cpi" name="interview_depth_moderation[]" value=""></td>
                                                    <td><input type="text" class="form-control cpi" name="interview_depth_moderation[]" attr="total" value=""></td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">Transcripts</td>
                                                    <td><input type="text" class="form-control sample" name="interview_depth_transcripts[]" value=""></td>
                                                    <td><input type="text" class="form-control cpi" name="interview_depth_transcripts[]" value=""></td>
                                                    <td><input type="text" class="form-control cpi" name="interview_depth_transcripts[]" attr="total" value=""></td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">Project Management</td>
                                                    <td><input type="text" class="form-control sample" name="interview_depth_project_management[]" value=""></td>
                                                    <td><input type="text" class="form-control cpi" name="interview_depth_project_management[]" value=""></td>
                                                    <td><input type="text" class="form-control cpi" name="interview_depth_project_management[]" attr="total" value=""></td>
                                                </tr>
                                                <tr id="otherFieldsInterview">
                                                    <td class="d-flex"><button type="button" class="btn btn-sm interview_depth_other">+</button> <input type="text" name="interview_depth_other[0][]" class="form-control" placeholder="Others"></td>
                                                    <td><input type="text" class="form-control sample" name="interview_depth_other[0][]"></td>
                                                    <td><input type="text" class="form-control cpi" name="interview_depth_other[0][]"></td>
                                                    <td> <input type="text" class="form-control cpi" name="interview_depth_other[0][]" attr="total" value=""></td>
                                                </tr>
                                                <tr>
                                                    <td class="total-cost"><input type="text" class="form-control" name="interview_depth_total_cost_1[]" placeholder="Total cost for 1 FGD"></td>
                                                    <td class="total-cost"></td>
                                                    <td class="total-cost"></td>
                                                    <td class="total-cost"><input type="text" class="form-control cpi" name="interview_depth_total_cost_1[]" attr="total1" value=""></td>
                                                </tr>
                                                <tr>
                                                    <td class="total-cost"><input type="text" class="form-control"  name="interview_depth_total_cost_2[]" placeholder="Total cost for 2 FGDs"></td>
                                                    <td class="total-cost"></td>
                                                    <td class="total-cost"></td>
                                                    <td><input type="text" class="form-control cpi" name="interview_depth_total_cost_2[]" attr="total2" value=""></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>





                            <div class="container">

                                <div class="d-none" id="online-community">
                                    <h5>Online Community - Costing Sheet</h5>
                                
                                    <div class="tab-container">
                                        <button type="button" class="btn btn-success btn-sm" id="OnlineCommunityBtn">Add More</button>
                                    </div>

                                    <div class="table-container mt-2">
                                        <table class="" id="OnlineCommunity">
                                            <tbody>
                                                <tr>
                                                    <td class="static-field w-25">Methodology</td>
                                                    <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control sample" name="online_community_methodology[]" value="" placeholder="Online Community"></label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">Currency</td>
                                                    <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control sample" name="online_community_currency[]" value=""  placeholder="currency">
                                                    </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">Client</td>
                                                    <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <select class="form-control label-gray-3" name="online_community_client[]">
                                                        <option class="label-gray-3" value="">Client</option>
                                                        @foreach ($client as $v)
                                                            <option value="{{ $v->client_name }}">{{ $v->client_name }}</option>
                                                        @endforeach
                                                    </select>
                                                    </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">Duration</td>
                                                    <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control" name="online_community_duration[]"  placeholder="Year" value="">
                                                    </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">LOI screener</td>
                                                    <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control sample" name="online_community_loi_screener[]"  value=""  placeholder="mins">
                                                    </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">LOI/Month</td>
                                                    <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control sample" name="online_community_loi_month[]" value=""  placeholder="mins">
                                                    </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">country</td>
                                                    <td class="editable-field"  colspan="3">
                                                    <label class="mb-0 label">
                                                    <input type="text" class="form-control sample" name="online_community_countries[]" value=""  placeholder="country">
                                                    </label>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field"></td>
                                                    <td class="static-field">Sample</td>
                                                    <td class="static-field">CPI</td>
                                                    <td class="static-field">Total</td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">Requirements</td>
                                                    <td><input type="text" class="form-control sample" name="online_community_requirements[]" value=""></td>
                                                    <td><input type="text" class="form-control cpi"  name="online_community_requirements[]"  value=""></td>
                                                    <td><input type="text" class="form-control total" attr="total"   name="online_community_requirements[]" value=""></td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">Incentives</td>
                                                    <td><input type="text" class="form-control sample"  name="online_community_incentives[]"  value=""></td>
                                                    <td><input type="text" class="form-control cpi"  name="online_community_incentives[]"  value=""></td>
                                                    <td><input type="text" class="form-control cpi" attr="total"   name="online_community_incentives[]"  value=""></td>
                                                </tr>
                                                <tr>
                                                    <td class="static-field">PM Fee</td>
                                                    <td><input type="text" class="form-control sample"  name="online_community_pmfree[]"  value=""></td>
                                                    <td><input type="text" class="form-control cpi"  name="online_community_pmfree[]" value=""></td>
                                                    <td><input type="text" class="form-control cpi" attr="total"   name="online_community_pmfree[]" value=""></td>
                                                </tr>
                                                <tr id="otherFieldsOnline">
                                                    <td class="d-flex"><button type="button" class="btn btn-sm online_community_other">+</button> <input type="text" class="form-control"  name="online_community_other[0][]"  placeholder="Others"></td>
                                                    <td><input type="text" class="form-control sample"  name="online_community_other[0][]"></td>
                                                    <td><input type="text" class="form-control cpi" name="online_community_other[0][]"></td>
                                                    <td> <input type="text" class="form-control cpi" attr="total"  name="online_community_other[0][]" value=""></td>
                                                </tr>
                                                <tr>
                                                    <td class="total-cost">Total Project cost</td>
                                                    <td class="total-cost"></td>
                                                    <td class="total-cost"></td>
                                                    <td><input type="text" class="form-control cpi"  name="online_community_total_cost[]"  value=""></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="button-container d-none col-md-12  align-items-center justify-content-center mt-5">
                                <a href="{{ route('bidrfq.index') }}" class=" btn btn-outline-secondary">Back</a>
                                <button type="submit" id="addRegisterButton"
                                    class="ml-2 btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(document).ready(function () {
    // Hide all sections on page load
    $(".tab-content").addClass("d-none");

    $(".tab-button").click(function () {
        let target = $(this).attr("data-target");
        
        if ($(this).hasClass("active")) {
            // If already active, deactivate it
            $(this).removeClass("active").css("background-color", "#6c757d");
            $(target).addClass("d-none");
            if(target == "#single-country")
            {
                $('#single_form').val(0);
            }else if(target == "#mulitple-country"){
                $('#multiple_form').val(0);
            }else if(target == "#interview-depth"){
                $('#interview_form').val(0);
            }else if(target == "#online-community"){
                $('#online_form').val(0);
            }
        } else {
            // Activate the clicked tab and show its section
            $(this).addClass("active").css("background-color", "#0047ff");
            $(target).removeClass("d-none");
            if(target == "#single-country")
            {
                $('#single_form').val(1);
            }else if(target == "#mulitple-country"){
                $('#multiple_form').val(1);
            }else if(target == "#interview-depth"){
                $('#interview_form').val(1);
            }else if(target == "#online-community"){
                $('#online_form').val(1);
            }

            
        }
        if ($(".tab-button.active").length > 0) {
            $(".button-container").removeClass("d-none").addClass("d-flex");
        } else {
            $(".button-container").addClass("d-none").removeClass("d-flex");
        }
    });
    
});


$(document).ready(function() {
            $("#register").validate({
                rules: {
                    rfq_no: {
                        required: true
                    },
                    single_client: {
                        required: true
                    },
                    single_vendor: {
                        required: true
                    },
                    single_currency: {
                        required: true
                    },
                    company_name: {
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
                },
                errorPlacement: function(error, element) {
                    if (element.hasClass("select2-hidden-accessible")) {
                        error.insertAfter(element.siblings('span.select2'));
                    } else if (element.hasClass("floating-input")) {
                        element.closest('.form-floating-label').addClass("error-cont").append(error);
                    } else {
                        error.insertAfter(element);
                    }
                },
                submitHandler: function(form) {
                    var data = new FormData(form);
                    // loadButton('#addRegisterButton');
                    $.ajax({
                        type: "POST",
                        url: "{{ route('newrfq.store') }}",
                        data: data,
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(data) {
                            if (data.success == 1) {
                                swal({
                                    title: 'Success',
                                    text: 'RFQ Added Successfully',
                                    icon: 'success',
                                    button: false
                                })
                                $('#register').get(0).reset();
                                window.location = "{{ route('bidrfq.index') }}";
                            }
                            if (data.success == 0) {
                                swal({
                                    title: 'Please Fill All Fields',
                                    icon: "warning",
                                    button: false
                                })
                            } else {
                                flash({
                                    msg: data.message,
                                    type: 'info'
                                });
                            }
                        }

                    });
                }
            });
        })


</script>
<script>
$(document).ready(function() {
    // Add More Columns to All Rows (with remove button)
    $('#addMore').click(function() {
      
        let totalColumns = $('#costingTable tr:first td').length;

        // Append Remove Button
        // $('.append-controls').append('<button class="btn btn-danger btn-sm remove-column">-</button>');

        // Append New Column to Each Row
        $('#costingTable tbody tr').each(function(key, value) {
            let btn = ""
            let position = "";
            let columnLabel = $(this).find("td:first").text().trim(); 
            if(key === 0) {
                btn = '<button type="button" class="btn btn-danger btn-sm remove-column">x</button>';
                position = "relative";
            }
            //$(this).append(`<td class="${position}"><input type="text" class="form-control">${btn}</td>`);
             let newColumn = "";

            if (columnLabel === "Client") {
                // If it's the Client row, append a dropdown
                newColumn = `<td class="${position}">
                    <select class="form-control" name="single_client[]" required>
                        <option class="" value="">Client</option>
                        @foreach ($client as $v)
                            <option value="{{ $v->client_name }}">{{ $v->client_name }}</option>
                        @endforeach
                    </select>
                    ${btn}
                </td>`;
            } else {
                // Otherwise, append a normal text input
                let name = $(this).find("td input").attr("name");
                newColumn = `<td class="${position}"><input type="text" name="${name}" class="form-control">${btn}</td>`;
            }

            $(this).append(newColumn);
        });
    });

    // Remove Column from All Rows
    $(document).on('click', '.remove-column', function() {
        let columnIndex = $('.remove-column').index(this);
        
        // Remove corresponding column from all rows
        $('#costingTable tr').each(function() {
            $(this).find('td').eq(columnIndex + 2).remove(); // Adjusting index to match added column
        });

        // Remove the remove button itself
        $(this).remove();

    });

    // Add Full Row in Other Fields
    $(document).on('click', '.add-other', function() {
        let colCount = $('#costingTable tr:first td').length; // Get total columns
        let count = $('.remove-other').length + 1;
        let newRow = `<tr>`;
        for (let i = 0; i < colCount; i++) {
            if (i === 0) {
                newRow += `<td class="d-flex"><button type="button" class="btn btn-danger btn-sm remove-other">x</button> 
                    <input type="text" class="form-control" name="single_other[${count}][]" placeholder="Other"></td>`;
            } else {
                newRow += `<td><input type="text" name="single_other[${count}][]" class="form-control"></td>`;
            }
        }
        newRow += '</tr>';
        
        $('#costingTable tbody tr:last').before(newRow);
        
    });

    // Remove Specific "Other Fields" Row
    $(document).on('click', '.remove-other', function() {
        $(this).closest('tr').remove();
        $('#costingTable td input').trigger('keyup')
    });

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
                let val = parseInt($(this).children('td').eq(index).find('input').val());
                if(!isNaN(val))
                {
                   sample = val;
                }
            }
            if(key > 5 && key < (rowLength - 1))
            {
                let val = parseInt($(this).children('td').eq(index).find('input').val());
                if(!isNaN(val))
                {
                    sum = sum + val;
                }
            }
            if(key == (rowLength - 1))
            {
                $(this).children('td').eq(index).find('input').val(sum * sample)
            }
            
        });
    });
    

});
</script>

<script>


$('#addMultipleCountryBtn').click(function() {
    // Get the number of columns in the first row
    let totalColumns = $('#MultipleCountry tr:first td').length;
    let length = $('.removeMultipleCountry').length;

    let i = 0;
    $('#MultipleCountry tbody tr').each(function(index) {
        let removeBtn = "";
        let positionClass = "";
        
       
        if (index === 0) {
            removeBtn = `<button type="button" class="btn btn-danger btn-sm removeMultipleCountry" attr="${length}">x</button>`;
            positionClass = "relative";
        }
        
        // Append new columns to each row
        if(index <= 3)
        {
             let label = $(this).find("td:last .label").html();
            $(this).append(`<td class="${positionClass} removeMultipleCountry_${length}" colspan="3"><label class="label">${label}</label>${removeBtn}</td>`);
        }else{
            if(index == 4){
                $(this).append(`<td class="static-field removeMultipleCountry_${length}">Sample</td>`);
                $(this).append(`<td class="static-field removeMultipleCountry_${length}">CPI</td>`);
                $(this).append(`<td class="static-field removeMultipleCountry_${length}">Total</td>`);
            }else{
                
                if(index == ($('#MultipleCountry tbody tr').length - 1))
                {
                    
                    $(this).append(`<td class="removeMultipleCountry_${length}"></td>`);
                    $(this).append(`<td class="removeMultipleCountry_${length}"></td>`);
                    $(this).append(`<td class="removeMultipleCountry_${length}"><input type="text" class="form-control" name="multiple_total_cost[]"></td>`);
                }else{
                    let input_name = $(this).find('input').attr('name');
                    // if(index <= 8)
                    // {
                        $(this).append(`<td class="removeMultipleCountry_${length}"><input type="text" name="${input_name}" class="form-control"></td>`);
                        $(this).append(`<td class="removeMultipleCountry_${length}"><input type="text" name="${input_name}" class="form-control"></td>`);
                        $(this).append(`<td class="removeMultipleCountry_${length}"><input type="text" name="${input_name}" attr="total" class="form-control"></td>`);
                    //     i++;
                    // }else{
                    //     $(this).append(`<td class="removeMultipleCountry_${length}"><input type="text" name="multiple_other[${index-9}][]" class="form-control"></td>`);
                    //     $(this).append(`<td class="removeMultipleCountry_${length}"><input type="text" name="multiple_other[${index-9}][]" class="form-control"></td>`);
                    //     $(this).append(`<td class="removeMultipleCountry_${length}"><input type="text" name="multiple_other[${index-9}][]" attr="total" class="form-control"></td>`);
                    // }
                }
            }
        }

        
    });

   
   
});

// Remove Specific Column from All Rows
$(document).on('click', '.removeMultipleCountry', function() {
    let attr = $(this).attr('attr');
    $('.removeMultipleCountry_'+attr).remove();
});

$(document).on('click', '.multiple_country_other', function() {
    let currentRow = $('#otherFieldMultipleCountry');
    let lastRow = $('#MultipleCountry tr:last');
    
    // Get the current row
    let newRow = `<tr>`;
    currentRow.find('td').each(function(index) {
        let className = $(this).attr('class')
        let td_length = currentRow.find('td').length;
        
        var input_name = $('.remove_multiple_country').length + 1;
        if (index === 0) {
            newRow += `<td class="d-flex ${className ? className : ''}">
                <button type="button" class="btn btn-danger btn-sm remove_multiple_country">x</button> 
                <input type="text" class="form-control" name="multiple_other[${input_name}][]" placeholder="Other">
            </td>`;
        } else {
            let attr = "";
            if((index ) % 3 === 0)
            {
                attr= "total";
            }
            newRow += `<td class="${className ? className : ''}"><input type="text" name="multiple_other[${input_name}][]" attr="${attr}" class="form-control"></td>`;
        }
    });

    newRow += `</tr>`;

    lastRow.before(newRow); // Append the new row right below the current row
});

// Remove Specific "Other Fields" Row
$(document).on('click', '.remove_multiple_country', function() {
    $(this).closest('tr').remove();
    $('#MultipleCountry td input').trigger('keyup')
});
$(document).on('keyup', '#MultipleCountry td input', function() {
    let totalValues = [];
    let total_length = $('#MultipleCountry tbody td:has(input[attr="total"])').length;
    let overall_total_length = $('#MultipleCountry tbody td:has(input[name="multiple_total_cost[]"])').length;
    $('#MultipleCountry tbody td:has(input[attr="total"])').each(function(){
        let cpi = parseInt($(this).prev().find('input').val());
        let sample = parseInt ($(this).prev().prev().find('input').val());
        if(!isNaN(cpi) && !isNaN(sample))
        {
            $(this).find('input').val(cpi*sample);
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
        $(this).find('input').val(sum);
    })
});
</script>


<script>


$('#addInterviewDepthBtn').click(function() {
    // Get the number of columns in the first row
    let totalColumns = $('#InterviewDepth tr:first td').length;
    let length = $('.removeInterviewDepth').length;

    
    $('#InterviewDepth tbody tr').each(function(index) {
        let removeBtn = "";
        let positionClass = "";

       
        if (index === 0) {
            removeBtn = `<type="button" class="btn btn-danger btn-sm removeInterviewDepth" attr="${length}">x</button>`;
            positionClass = "relative";
            
        }

        // Append new columns to each row
        if(index <= 6)
        {
            
            let label = $(this).find("td:last .label").html();
            $(this).append(`<td class="${positionClass} removeInterviewDepth_${length}" colspan="3"><label class="label">${label}</label>${removeBtn}</td>`);
        }else{
            if(index == 7 ){
                $(this).append(`<td class="static-field removeInterviewDepth_${length}">Sample</td>`);
                $(this).append(`<td class="static-field removeInterviewDepth_${length}">CPI</td>`);
                $(this).append(`<td class="static-field removeInterviewDepth_${length}">Total</td>`);
            }else{
                let input_name = $(this).find('input').attr('name');
                let attr = $(this).find('input:last').attr('attr');
                if(index >= ($('#InterviewDepth tbody tr').length - 2))
                {
                    console.log(attr)
                    $(this).append(`<td class="total-cost removeInterviewDepth_${length}"></td>`);
                    $(this).append(`<td class="total-cost removeInterviewDepth_${length}"></td>`);
                    $(this).append(`<td class="total-cost removeInterviewDepth_${length}"><input type="text" class="form-control" name="${input_name}" attr="${attr}"></td>`);

                }else{
                    // if(index > 12)
                    // {
                    $(this).append(`<td class="removeInterviewDepth_${length}"><input type="text" name="${input_name}"  class="form-control"></td>`);
                    $(this).append(`<td class="removeInterviewDepth_${length}"><input type="text" name="${input_name}"  class="form-control"></td>`);
                    $(this).append(`<td class="removeInterviewDepth_${length}"><input type="text" name="${input_name}"  class="form-control" attr="total"></td>`);
                    // }else{
                    //     $(this).append(`<td class="removeInterviewDepth_${length}"><input type="text" name="" class="form-control"></td>`);
                    //     $(this).append(`<td class="removeInterviewDepth_${length}"><input type="text" name="" class="form-control"></td>`);
                    //     $(this).append(`<td class="removeInterviewDepth_${length}"><input type="text" name="" class="form-control"></td>`);
                    // }
                }
          }
        }
    });
});

// Remove Specific Column from All Rows
$(document).on('click', '.removeInterviewDepth', function() {
    let attr = $(this).attr('attr');
    $('.removeInterviewDepth_'+attr).remove();
});

 $(document).on('click', '.interview_depth_other', function() {
    let currentRow = $('#otherFieldsInterview'); // Get the current row
    let lastTwoRows = $('#InterviewDepth tr').slice(-2);
    
    let newRow = `<tr>`;
    currentRow.find('td').each(function(index) {
        let className = $(this).attr('class')
        var count = $('.remove_interview_depth').length + 1;
        if (index === 0) {
            newRow += `<td class="d-flex ${className ? className : ''}">
                <button type="button" class="btn btn-danger btn-sm remove_interview_depth">x</button> 
                <input type="text" class="form-control" name="interview_depth_other[${count}][]" placeholder="Other">
            </td>`;
        } else {
            let attr = "";
            if((index ) % 3 === 0)
            {
                attr= "total";
            }
            newRow += `<td class="${className ? className : ''}"><input type="text" class="form-control" name="interview_depth_other[${count}][]" attr="${attr}"></td>`;
        }
    });

    newRow += `</tr>`;

    lastTwoRows.first().before(newRow); // Append the new row right below the current row
});

// Remove Specific "Other Fields" Row
$(document).on('click', '.remove_interview_depth', function() {
    $(this).closest('tr').remove();
});
$(document).on('keyup', '#InterviewDepth td input', function() {
    let totalValues = [];
    let total_length = $('#InterviewDepth tbody td:has(input[attr="total"])').length;
    let overall_total_length = $('#InterviewDepth tbody td:has(input[name="interview_depth_total_cost_1[]"])').length;
    $('#InterviewDepth tbody td:has(input[attr="total"])').each(function(){
        let cpi = parseInt($(this).prev().find('input').val());
        let sample = parseInt ($(this).prev().prev().find('input').val());
        if(!isNaN(cpi) && !isNaN(sample))
        {
            $(this).find('input').val(cpi*sample);
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
        $(this).find('input').val(sum);
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
</script>



<script>


$('#OnlineCommunityBtn').click(function() {
    // Get the number of columns in the first row
    let totalColumns = $('#OnlineCommunity tr:first td').length;
    let length = $('.removeOnlineCommunity').length;

    
    $('#OnlineCommunity tbody tr').each(function(index) {
        let removeBtn = "";
        let positionClass = "";

       
        if (index === 0) {
            removeBtn = `<button type="button" class="btn btn-danger btn-sm removeOnlineCommunity" attr="${length}">x</button>`;
            positionClass = "relative";
        }

        // Append new columns to each row
        if(index <= 6)
        {
            
            let label = $(this).find("td:last .label").html();
            $(this).append(`<td class="${positionClass} removeOnlineCommunity_${length}" colspan="3"><label class="label">${label}</label>${removeBtn}</td>`);
        }else{
            if(index == 7){
                $(this).append(`<td class="static-field removeOnlineCommunity_${length}">Sample</td>`);
                $(this).append(`<td class="static-field removeOnlineCommunity_${length}">CPI</td>`);
                $(this).append(`<td class="static-field removeOnlineCommunity_${length}">Total</td>`);
            }else{
                let input_name = $(this).find('input').attr('name');
                if(index == ($('#OnlineCommunity tbody tr').length - 1))
                {
                    $(this).append(`<td class="removeOnlineCommunity_${length}"></td>`);
                    $(this).append(`<td class="removeOnlineCommunity_${length}"></td>`);
                    $(this).append(`<td class="removeOnlineCommunity_${length}"><input type="text" name="${input_name}" class="form-control"></td>`);
        
                }else{
                    $(this).append(`<td class="removeOnlineCommunity_${length}"><input type="text" name="${input_name}" class="form-control"></td>`);
                    $(this).append(`<td class="removeOnlineCommunity_${length}"><input type="text" name="${input_name}" class="form-control"></td>`);
                    $(this).append(`<td class="removeOnlineCommunity_${length}"><input type="text" name="${input_name}" attr="total" class="form-control"></td>`);
                }
         }
        }
    });
});

// Remove Specific Column from All Rows
$(document).on('click', '.removeOnlineCommunity', function() {
    let attr = $(this).attr('attr');
    $('.removeOnlineCommunity_'+attr).remove();
});

 $(document).on('click', '.online_community_other', function() {
    let currentRow = $('#otherFieldsOnline');
    let lastRow = $('#OnlineCommunity tr:last'); // Get the current row
    let count = $('.remove_online_community').length + 1;
    let newRow = `<tr>`;
    let td_length = currentRow.find('td').length;
    
    currentRow.find('td').each(function(index) {
        let className = $(this).attr('class')
        if (index === 0) {
            newRow += `<td class="d-flex ${className ? className : ''}">
                <button type="button" class="btn btn-danger btn-sm remove_online_community">x</button> 
                <input type="text" class="form-control" name="online_community_other[${count}][]" placeholder="Other">
            </td>`;
        } else {
            let attr = "";
            if((index ) % 3 === 0)
            {
                attr= "total";
            }

            newRow += `<td class="${className ? className : ''}"><input type="text" class="form-control" name="online_community_other[${count}][]" attr="${attr}"></td>`;
        }
    });

    newRow += `</tr>`;

    lastRow.before(newRow); // Append the new row right below the current row
});

// Remove Specific "Other Fields" Row
$(document).on('click', '.remove_online_community', function() {
    $(this).closest('tr').remove();
});

$(document).on('keyup', '#OnlineCommunity td input', function() {
    let totalValues = [];
    let total_length = $('#OnlineCommunity tbody td:has(input[attr="total"])').length;
    let overall_total_length = $('#OnlineCommunity tbody td:has(input[name="online_community_total_cost[]"])').length;
    $('#OnlineCommunity tbody td:has(input[attr="total"])').each(function(){
        let cpi = parseInt($(this).prev().find('input').val());
        let sample = parseInt ($(this).prev().prev().find('input').val());
        if(!isNaN(cpi) && !isNaN(sample))
        {
            $(this).find('input').val(cpi*sample);
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
        $(this).find('input').val(sum);
    })
});


 
</script>
@endsection

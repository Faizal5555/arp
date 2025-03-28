@extends('layouts.master')
<style>
    a.ml-2.card-title {
        padding: 29px;
    }

    select.form-control.label-gray-3.valid {
        color: #000;
    }

    .card-header.header-elements-inline {
        background-color: #2166b6;
    }

    .card .card-title {
        color: #ecedee;
    }

    .error {
        color: red;
        margin-top: 8px;
    }

    .form-control.error,
    .form-control.label-gray-3.error {
        border: 1px solid red !important;
    }

    select.form-control {
        padding: 0.4375rem 0.75rem;
        border: 0;
        outline: 1px solid #ebedf2;
        color: #131212;
    }

    select.form-control.label-gray-3 {
        color: #131212;
    }

    label.currency {
        margin-top: 12px;
        margin-left: 5px;
        position: absolute;
    }

    input.txtCal.valid {
        padding-left: 20px;
        z-index: 1;
    }

    label.my-currency {
        margin-left: 3px;
        margin-top: 4px;
        position: absolute;
    }

    input.total_cost.border {
        z-index: 1;
        padding-left: 12px;
    }

    input.total_cost.border {
        z-index: 1;
        padding-left: 12px;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6;
        padding-left: 33px;
        padding-right: 23px;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .removevendor {
        top: 1px;
        margin-right: auto;
        position: absolute;
        font-size: 14px;
        color: #eb3030;
        z-index: 7;
        padding-left: 202px;
    }

    td.won-second1 {
        padding-top: 27px;
    }

    .title-sub-vendor {
        padding-top: -17px;
        top: -5px;
        left: 197px;
        position: relative;
        color: red;
    }

    .remove-won {
        top: -5px;
        left: 197px;
        position: relative;
        color: red;
    }

    .app-vendor {
        top: -5px;
        left: 197px;
        position: relative;
        color: red;
    }

    label.form-group.has-float-label1 {
        padding-bottom: 7px;
    }

    button.btn.btn-success.ml-2.float-left.btn-remove {
        margin-top: 11px;
    }

    tr.first-row td {
        padding: 1.5rem;
    }

    button.btn.btn-danger.ml-2.float-left.btn-remove-country1 {
        margin-bottom: 34px;
    }

    th.country_remove_0_13 {
        height: 88px;
    }

    .country_remove_0_13 button.btn.btn-danger.remove-country.mb-4.ml-2 {
        display: none;
    }

    img {
        width: 66%;
        float: right;
    }

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
        /* border: 2px solid green; */
        /* background-color:#28a745; */
        border-radius: 5px;
        color:white;
        
        
    }

    /* Dropdowns - Green Border */
    #costingTable select.form-control {
        /* border: 2px solid green; */
        border-radius: 5px;
        
    }

    /* "Total Cost" row - Different Color */
    #costingTable tr:last-child td,#MultipleCountry tr:last-child td, #InterviewDepth tr:last-child td, #OnlineCommunity tr:last-child td {
        /* background-color: ; Yellow background for emphasis */
        font-weight: bold;
        color:black;
    }


    /* Button Styling */
    .add-other, .multiple_country_other,.interview_depth_other,.online_community_other{
        background-color: white;
        border: none;
        /* color: green !important; */
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 50%;
    }

    .add-other:hover, .multiple_country_other:hover, .interview_depth_other:hover, .online_community_other:hover {
        background-color: white;
    }

    .static-field {
        background-color: white;
        color: black;
        font-weight: bold;
        padding: 10px;
    }

    #MultipleCountry,#InterviewDepth,#OnlineCommunity,#costingTable{
        border: 1px solid black;
        /* background-color:#28a745; */
        border-radius: 5px;
        color:white;
        
        
    }
     #MultipleCountry select.form-control, #InterviewDepth select.form-control, #OnlineCommunity select.form-control {
        /* border: 1px solid green; */
        border-radius: 5px;
        
    }

    .form-control::placeholder {
        color: #155724;
        opacity: 0.7;
    }

    .total-cost {
        background-color: white !important;
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
        width: 200px !important; /* Set your desired width */
        word-wrap: break-word; /* Ensures text breaks properly */
        text-align: center; /* Align text in the center */
        padding: 5px; /* Optional: Add spacing */
        border:1px solid black;
    }
    #MultipleCountry td {
        width: 200px !important; /* Set your desired width */
        word-wrap: break-word; /* Ensures text breaks properly */
        text-align: center; /* Align text in the center */
        padding: 5px; /* Optional: Add spacing */
        border:1px solid black;
    }

        #interview-depth td {
        width: 200px !important; /* Set your desired width */
        word-wrap: break-word; /* Ensures text breaks properly */
        text-align: center; /* Align text in the center */
        padding: 5px; /* Optional: Add spacing */
        border:1px solid black;
        }
        #OnlineCommunity td {
        width: 200px !important; /* Set your desired width */
        word-wrap: break-word; /* Ensures text breaks properly */
        text-align: center; /* Align text in the center */
        padding: 5px; /* Optional: Add spacing */
        border:1px solid black;
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
    .viewer{
        color:black;
    }
</style>

@section('page_title', 'BidRfq Form')

@section('content')

<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div class="logo">
            <img src="{{ asset('adminapp/assets/images/logo-3.png') }}">
        </div>
    </div>
</div>

<div class="row ml-3">
    <div class="col-md-2">
        <label class="font-weight-bold">RFQ No:</label>
        <div>{{ $newrfq->rfq_no }}</div>
    </div>

    <div class="col-md-4">
        <label class="font-weight-bold">Company Name:</label>
        <div>{{ $newrfq->company_name ?? 'N/A' }}</div>
    </div>

    <div class="col-md-3">
        <label class="font-weight-bold">Date:</label>
        <div>{{ $newrfq->date ?? 'N/A' }}</div>
    </div>
</div>


<div class="w-100">
    <div class="container mt-5">
        <div class="tab-container d-none">
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
                                <td class="viewer"> 
                                {{$methodology}}
                                </td>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="static-field remove-other_{{$key - 1}}">Currency</td>
                            @if(count($single_currency) > 0)
                            @foreach($single_currency as $currency)
                                <td class="viewer">{{$currency}}</td>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="static-field remove-other_{{$key - 1}}">LOI</td>
                            @if(count($single_loi) > 0)
                            @foreach($single_loi as $loi)
                                <td class="viewer">{{$loi}}</td>
                            @endforeach
                            @endif
                        </tr>
                        
                        <tr>
                            <td class="static-field remove-other_{{$key - 1}}">Country</td>
                            @if(count($single_country) > 0)
                            @foreach($single_country as $country)
                                <td class="viewer">{{$country}}</td>
                            @endforeach
                            @endif
                        </tr>
                        
                        <tr>
                        <td class="static-field remove-other_{{$key - 1}}">Client</td>
                        @if(count($single_client) > 0)
                        @foreach($single_client as $value)
                            <td class="viewer">{{$value}}
                            </td>
                        @endforeach
                        @endif
                        </tr>
                        
                        <tr>
                        <td class="static-field remove-other_{{$key - 1}}">Sample</td>
                        @if(count($single_sample) > 0)
                        @foreach($single_sample as $sample)
                            <td class="viewer">{{$sample}}</td>
                        @endforeach
                        @endif
                        </tr>
                        <tr>
                            <td class="static-field remove-other_{{$key - 1}}">Fieldwork CPI</td>
                            @if(count($single_fieldwork) > 0)
                            @foreach($single_fieldwork as $fieldwork)
                                <td class="viewer">{{$fieldwork}}
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
                            <td class="viewer">
                                 {{$other}}
                            </td>
                            @else
                            <td class="viewer">{{$other}}</td>
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
                                <td>{{$total_cost}}</td>
                            @endforeach
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>


    <div class="container mt-4">

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
                                    <td class="viewer" colspan="3">
                                    <label class="mb-0 label">
                                  {{$methodology}}
                                    </label>
                                @endforeach
                            @endif
                            </td>
                        </tr>
                        <tr>
                        <td class="static-field relative ">Currency</td>
                            @if(count($multiple_currency) > 0)
                                @foreach($multiple_currency as $key => $currency)
                                <td class="editable-field viewer removeMultipleCountry_{{$key - 1}}"  colspan="3">
                                <label class="mb-0 label">
                               {{$currency}}
                                </label>
                                @endforeach
                            @endif
                            </td>
                        </tr>
                        <tr>
                        <td class="static-field relative ">LOI</td>
                            @if(count($multiple_loi) > 0)
                            @foreach($multiple_loi as $key => $loi)
                            <td class="editable-field viewer removeMultipleCountry_{{$key - 1}}"  colspan="3">
                                <label class="mb-0 label">
                              {{$loi}}
                                </label>
                            @endforeach
                            @endif
                            </td>
                        </tr>
                        <tr>
                        <td class="static-field relative ">Client</td>
                        @if(count($multiple_client) > 0)
                            @foreach($multiple_client as $key => $value)
                            <td class="editable-field viewer "  colspan="3">
                                <label class="mb-0 label"> 
                                    {{$value }}
                                </select>
                                </label>
                            </td>
                            @endforeach
                        @endif
                        </tr>
                        <tr>
                            <td class="static-field relative ">Countries</td>
                            @if(count($multiple_client) > 0)
                            @foreach($multiple_client as $key => $multiple)
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
                                <td class="viewer">{{$country}}</td>
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
                            <td class="viewer removeMultipleCountry_{{$i}}">
                                 {{$other}}
                            </td>
                            @else
                            <td class="viewer removeMultipleCountry_{{$i}}">{{$other}}</td>
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
                            <td class="removeMultipleCountry_{{$key - 1}}">{{$value}}</td>
                            @endforeach
                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>


    <div class="container mt-4">

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
                                    <td colspan="3" class="viewer">
                                        <label class="mb-0 label">
                                            {{$methodology}}
                                        </label>
                                    </td>
                                @endforeach
                            @endif
                            
                        </tr>
                        <tr>
                            <td class="static-field">Currency</td>
                            @if(count($interview_depth_currency) > 0)
                                @foreach($interview_depth_currency as $key => $currency)
                                    <td class="editable-field viewer removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                        <label class="mb-0 label">
                                            {{$currency}}
                                        </label>
                                    </td>
                                @endforeach
                            @endif
                            
                        </tr>
                        <tr>
                            <td class="static-field">LOI</td>
                            @if(count($interview_depth_loi) > 0)
                                @foreach($interview_depth_loi as $key => $loi)
                                    <td class="editable-field viewer removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                        <label class="mb-0 label">
                                            {{$loi}}
                                        </label>
                                    </td>
                                @endforeach
                            @endif
                            
                        </tr>
                        <tr>
                            <td class="static-field">Client</td>
                            @if(count($interview_depth_client) > 0)
                                @foreach($interview_depth_client as $key => $value)
                                    <td class="editable-field viewer removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                    <label class="mb-0 label"> 
                                       
                                        
                                        {{$value}}
                                      
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
                                        <label class="mb-0 label viewer">
                                            {{$fgd}}
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
                                    <label class="mb-0 label viewer">
                                        {{$fgd}}
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
                                <label class="mb-0 label viewer">
                                    {{$country}}
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
                                <td class=" viewer removeInterviewDepth_{{$i}}">
                                    {{$value}}
                                </td>
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
                            <td class="static-field viewer removeInterviewDepth_{{$key - 1}}">Incentives</td>
                            @if(count($interview_depth_incentives) > 0)
                            @foreach($interview_depth_incentives as $key => $value)
                                <?php
                                if($key == 3)
                                {
                                    $i = 0;
                                }
                                ?>
                                <td class=" viewer removeInterviewDepth_{{$i}}">
                                    {{$value}}
                                </td>
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
                            <td class="static-field viewer removeInterviewDepth_{{$key - 1}}">Moderation</td>
                            @if(count($interview_depth_moderation) > 0)
                            @foreach($interview_depth_moderation as $key => $value)
                            <?php 
                                if($key == 3)
                                {
                                    $i = 0;
                                }
                                ?>
                                <td class="viewer removeInterviewDepth_{{$i}}">
                                    {{$value}}
                                </td>
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
                            <td class="static-field  viewer removeInterviewDepth_{{$key - 1}}">Transcripts</td>
                            @if(count($interview_depth_transcripts) > 0)
                            @foreach($interview_depth_transcripts as $key => $value)
                            <?php 
                                if($key == 3)
                                {
                                    $i = 0;
                                }
                                ?>
                                <td class=" viewer removeInterviewDepth_{{$i}}">
                                    {{$value}}
                                </td>
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
                            <td class="static-field viewer removeInterviewDepth_{{$key - 1}}">Project Management</td>
                            @if(count($interview_depth_project_management) > 0)
                            @foreach($interview_depth_project_management as $key => $value)
                                <?php
                                    if($key == 3)
                                    {
                                        $i = 0;
                                    }
                                ?>
                                <td class="viewer removeInterviewDepth_{{$i}}">
                                    {{$value}}
                                </td>
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
                            <td class="viewer removeInterviewDepth_{{$i}}">
                                 {{$other}}
                            </td>
                            @else
                            <td class="viewer removeInterviewDepth_{{$i}}">{{$other}}</td>
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
                            <td class="total-cost">
                                {{$interview_depth_total_cost_1[0]}}</td>
                            @foreach ($interview_depth_total_cost_1 as $key => $value)
                            @if($key > 0)
                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"></td>
                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"></td>
                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}">
                                {{$value}}
                            </td>
                            @endif
                            @endforeach
                        @endif
                        </tr>
                        <tr>
                        @if(count($interview_depth_total_cost_2) > 0)
                            <td class="total-cost">
                                {{$interview_depth_total_cost_2[0]}}</td>
                            @foreach ($interview_depth_total_cost_2 as $key => $value)
                            @if($key > 0)
                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"></td>
                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}"></td>
                            <td class="total-cost removeInterviewDepth_{{$key > 1 ? $key - 2 : ''}}">
                                {{$value}}
                            </td>
                            
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





    <div class="container mt-4">

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
                            <td class="static-field viewer w-25">Methodology</td>
                                @if(count($online_community_methodology) > 0)
                            @foreach($online_community_methodology as $key => $methodology)
                                <td  colspan="3" class="viewer">
                                <label class="mb-0 label">
                                    {{$methodology}}
                                </td>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="static-field ">Currency</td>
                                @if(count($online_community_currency) > 0)
                            @foreach($online_community_currency as $key => $currency)
                            <td class="editable-field viewer removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                            <label class="mb-0 label">
                                {{$currency}}
                            </label>
                            </td>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                        <td class="static-field ">Client</td>
                                @if(count($online_community_client) > 0)
                                @foreach($online_community_client as $key => $value)
                                    <td class="editable-field viewer removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                                        <label class="mb-0 label"> 
            
                                          
                                           
                                            {{$value}}
                                          
                
                                        </label>
                                    </td>
                                    @endforeach
                                @endif
                            

                        </tr>
                        <tr>
                            <td class="static-field ">Duration</td>
                                @if(count($online_community_duration) > 0)
                                @foreach($online_community_duration as $key => $duration)
                                    <td class="editable-field viewer removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                                    <label class="mb-0 label">
                                        {{$duration}}
                                    </label>
                                    </td>
                                @endforeach
                                @endif

                        </tr>
                        <tr>
                            <td class="static-field ">LOI</td>
                                @if(count($online_community_loi_screener) > 0)
                                @foreach($online_community_loi_screener as $key => $screener)
                                    <td class="editable-field viewer removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                                    <label class="mb-0 label viewer ">
                                        {{$screener}}
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
                                    <label class="mb-0 label viewer">
                                        {{$sample_loi_month}}
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
                                    <label class="mb-0 label viewer">
                                        {{$countries}}
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
                                <td class=" viewer removeOnlineCommunity_{{$i}}">
                                    {{$value}}</td>
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
                                <td class=" viewer removeOnlineCommunity_{{$i}}">
                                    {{$value}}
                                </td>
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
                                <td class="viewer removeOnlineCommunity_{{$i}}">
                                    {{$value}}
                                </td>
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
                            <td class="viewer removeOnlineCommunity_{{$i}}">
                                <button type="button" class="d-none btn btn-sm  {{$k == 0 ? 'online_community_other btn-light' : 'remove_online_community btn-danger'}}">{{$k == 0 ? '+' : 'x'}}</button> 
                                {{$other}}
                            </td>
                            @elseif($key % 3 === 0)
                            <td class="viewer removeOnlineCommunity_{{$i}}">
                                {{$other}}
                            </td>
                            @else
                            <td class="viewer removeOnlineCommunity_{{$i}}">
                                {{$other}}
                            </td>
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
                            <td class="removeOnlineCommunity_{{$key > 0 ? $key - 1 : ''}}">
                                {{$value}}</td>
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
     <div class="d-flex justify-content-start p-5 mt-3">
        <a href="{{ URL::to('/adminapp/bidrfq/downloadpdf/'.$newrfq->id) }}" class="btn btn-primary">Download
            PDF</a>
        </div>
        @endsection
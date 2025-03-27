@extends('layouts.master')
<style>
    .main-panel {
        background-color: #f8f8f8;
    }

    .card {
        margin: 40px 0 20px 0;
        border: none;
    }

    .card-header.header-elements-inline {
        background-color: #fff;
    }

    button#addRegisterButton {
        background-color: #6329a1;
        border-color: #6329a1;
    }

    label.col-lg-3.col-form-label.font-weight-semibold {
        font-family: "ubuntu-medium", sans-serif;
        font-weight: 500;
    }

    a.btn.btn-outline-secondary:hover {
        color: #fff;
    }

    button#addRegisterButton {
        background-color: #0b5dbb;
        border-color: #0b5dbb;
    }

    button#addRegisterButton:hover {
        background-color: #0b5dbb;
        border-color: #0b5dbb;

    }

    .card-header.header-elements-inline {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
        color: #fff;
    }

    .sub-text {
        color: #fff;
    }

    /* operaion */
    table#mtable {
        margin-top: 12px;
    }

    select.form-control {
        padding: 0.4375rem 0.75rem;
        border: 0;
        outline: 1px solid #ebedf2;
        color: #3e3d3d !important;
    }

    label.currency {
        margin-top: 12px;
        margin-left: 5px;
        position: absolute;
    }

    input.txtCal.valid {
        /* padding-left: 20px; */
        z-index: 1;
    }

    .error {
        color: red;
        margin-top: 8px;
    }

    /*for notification*/

    .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f1f1f1;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .badge {
        padding: 2px 0px 0px 0px !important;
        position: absolute;
        top: -3px;
        right: 6px;
        width: 18px;
        height: 18px;
        border-radius: 100% !important;
        background: red;
        color: white;
        font-size: 10px;
    }

    .dropdown-content-two {
        display: none;
    }

    .dropdown-content a:hover {
        background-color: #4982C2;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .btnn:hover .dropdown-content-two {
        display: block;
    }
    .country-table{
        flex: 1 1 30%;
        min-width: 300px;
        border: 1px solid #ccc;
        padding: 10px;
        margin-right:15px;
    }

    .nested-table-group {
        position: relative;
        /* ✅ Needed for absolute positioning of remove button */
        display: flex;
        flex-wrap: nowrap;
        /* ✅ Keeps all tables in the same row */
        gap: 10px;
        /* ✅ Ensures spacing between tables */
        align-items: center;
        justify-content: flex-start;
        width: 100%;
        white-space: nowrap;
    }

    .table-group {
        display: flex;
        flex-wrap: nowrap;
        /* ✅ Prevents wrapping, keeps tables in the same row */
        gap: 10px;
        /* ✅ Ensures spacing between the two tables in a pair */
        align-items: center;
        padding: 10px;
        border: 1px solid #ddd;
        position: relative;
        /* ✅ Needed for correct placement of remove button */
    }
    .sub-table{
        border: 1px solid #dee2e6;
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


    /*for notification*/
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

    /* end new design */
</style>

@section('page_title', 'WonProject Form')

@section('content')
<input type="hidden" id="rfq_no_hidden">

    {{-- won project --}}
    <div class="container-fluid">
        <!--/*for notification*/-->
        <br>
        <div id="won_noti">
            <div class="container col-md-11 d-flex justify-content-end">
                <div class="dropdown">
                    <a class="nav-link " href="#"><i class="fas fa-bell fa-lg"></i>
                        <span class="badge">{{ count($notification) }}</span> 
                    </a>
                    <div class="dropdown-content " style="width: 200px; margin-left:-100px">
                        <div class="btnn">
                            @if ($notificationCount > 0)
                                <h6 class="text-center" style="color:rgb(183,110,255)">
                                    <button class="btn1" style="all:unset">{{ $notificationCount }} New Won Project</button>
                                </h6>
                            @endif
                            <div class="dropdown-content-two" id="ui-notification">
                                <ul class="nav flex-column sub-menu1">
                                    @if (count($notification) > 0)
                                        @foreach ($notification as $value)
                                            <li class="text-center notify-won" data-win="{{ $value->rfq_no }}">
                                                {{ $value->rfq_no }}
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/*for notification*/-->

        <div class="row">
            <div class="col-md-12">
                <div class="card" id="header-title">

                    <div class="card-header header-elements-inline">
                        <div class="card-title" style="color:white !important ">Won Project Form</div>
                    </div>

                    <div class="card-body">
                        <div class="row">
                            {{-- <form id="update" class="flex-wrap form col-md-12 d-flex"
                           enctype="multipart/form-data">
                           @csrf --}}
                            <input type="hidden" value="rfq_no_id">

                            <div class="col-md-6">
                                <div class="form-group row" id="wondiv">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">RFQ No <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">

                                        <select class="form-control label-gray-3" name="rfq_no" id="rfq_no">
                                            <option class="label-gray-3" value="">Select RFQ No</option>

                                            @if (count($wonproject) > 0)
                                                @foreach ($wonproject as $value)
                                                @if ((auth()->user()->user_type == "admin" || auth()->user()->user_type == "operation_head" || auth()->user()->user_role == "project_manager") && !in_array($value->rfq_no, $rfq))
                                                        <option value="{{ $value->rfq_no }}">{{ $value->rfq_no }}</option>
                                                    {{-- @elseif (auth()->user()->user_role == "project_manager") 
                                                        <option value="{{ $value->rfq_no }}">{{ $value->rfq_no }}</option> --}}
                                                    @endif
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body d-none w-100" id="edit-rfq">
                                <div class="row">
                                    <form id="rfq" class="flex-wrap form col-md-12 d-flex update"
                                        enctype="multipart/form-data">
                                        @csrf
                                        {{-- <input type="hidden" name="id" id="id" value="">
                                        <input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount"> --}}
                                        <div class="operation-data w-100">

                                            
                                        </div>
                                        
                                        <div class="col-md-12 d-flex align-items-center justify-content-center mt-4">
                                            <a href="" class=" btn btn-outline-secondary"
                                                id="won-rfq-btn1">Back</a>
                                            <button type="submit" id="addRegisterButtons"
                                                class="ml-2 btn btn-success rfq-sub d-none">Update</button>
                                            <p id="nextrfq" class="m-2 btn btn-primary won-rfq-btn2">Next</button>

                                        </div>
                                        <div class="col-md-12 d-flex align-items-end justify-content-end">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">Last Edited by</label>
                                                <div class="pl-2 col-lg-9">
                                                    <input name="last_edited_by" id="user" type="text"
                                                        class="form-control user" placeholder="Last Edited by" readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row d-none" id="otherFieldDiv">
                                    <form id="won" class="flex-wrap form col-md-12 d-flex update"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="row">
                                            <input type="hidden" name="client_id" id="client_id">
                                            <input type="hidden" name="id" id="id_no"
                                            value="">
                                        <input id="wonCount" type="hidden" value="1" name="wonCount">
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label font-weight-semibold">RFQ NO<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input name="rfq_no" value="" type="text"
                                                            id="rfqno" class="form-control rfqno"
                                                            placeholder="rfq_no">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label font-weight-semibold"
                                                        id="otherField1">Project Name<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input name="project_name" value="" type="text"
                                                            id="projectname" class="form-control"
                                                            placeholder="Project Name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label font-weight-semibold"
                                                        id="otherField2">Project Type<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input name="project_type" value="" id="projecttype"
                                                            class="form-control" placeholder="project type">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField3"
                                                        class="col-lg-3 col-form-label font-weight-semibold">Project
                                                        Execution<span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">

                                                        <select class="form-control label-gray-3" name="project_execution"
                                                            id="project_execution">
                                                            <option class="label-gray-3">Select Execution</option>
                                                            <option value="Insource">Insource</option>
                                                            <option value="Outsource">Outsource</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label class="col-lg-3 col-form-label font-weight-semibold">Choose
                                                        Currency<span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">

                                                        <select class="form-control label-gray-3" name="currency"
                                                            id="worldcurrency">
                                                            <option value="" disabled selected>Select Currency
                                                            </option>
                                                            <option value="₹">INR</option>
                                                            <option value="$">USD</option>
                                                            <option value="€">Euro</option>
                                                            <option value="£">Pound</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField4"
                                                        class="col-lg-3 col-form-label font-weight-semibold">Start
                                                        Date<span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input name="project_start_date" value=""
                                                            id="project_start_date" type="date" class="form-control"
                                                            placeholder="Start Date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField5"
                                                        class="col-lg-3 col-form-label font-weight-semibold">End Date<span
                                                            class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <input name="project_end_date" value=""
                                                            id="project_end_date" type="date" class="form-control"
                                                            placeholder="End Date">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField8"
                                                        class="col-lg-3 col-form-label font-weight-semibold">Total
                                                        Margins<span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <label class="currency"></label>
                                                        <input name="total_margin" value="" id="total_margin"
                                                            type="text" class="form-control"
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
                                                        <select class="form-control label-gray-3" name="mode"
                                                            id="mode">
                                                            <option class="label-gray-3" disabled selected>Select Mode
                                                            </option>
                                                            <option value="Online">Online</option>
                                                            <option value="Offline">Offline</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group row">
                                                    <label id="otherField9"
                                                        class="col-lg-3 col-form-label font-weight-semibold"><u>Client
                                                            Invoicing
                                                            Terms</u></label>

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField10"
                                                        class="col-lg-3 col-form-label font-weight-semibold">Advance
                                                        Payment <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <label class="currency"></label>
                                                        <input name="client_advance" value="" id="client_advance"
                                                            type="text" class="form-control"
                                                            placeholder="Advance Payment">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField11"
                                                        class="col-lg-3 col-form-label font-weight-semibold">Balance
                                                        Payment<span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <label class="currency"></label>
                                                        <input name="client_balance" value="" id="client_balance"
                                                            type="text" class="form-control"
                                                            placeholder="Balance Payment">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField6"
                                                        class="col-lg-3 col-form-label font-weight-semibold">Client Total
                                                        Project
                                                        Invoice Value<span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <label class="currency"></label>
                                                        <input name="client_total" value="" id="client_total"
                                                            type="text" class="form-control"
                                                            placeholder="Client Total Project Invoice Value">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group row">
                                                    <label id="otherField15"
                                                    class="col-lg-3 col-form-label font-weight-semibold">Attach Client
                                                    Contract
                                                    / Email <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <div id="client_contract_attachment">
                                                        </div>
                                                        <!--<input name="client_contract" value=""-->
                                                        <!--    id="client_contract" type="file" class="p-1 form-control" placeholder="Attach Client Contract">-->
                                                    </div>
                                                </div>
                                            </div>
                                            

                                            <?php
                                            $vendor_id = $vendor_advance = $vendor_balance = $vendor_total = $vendor_contract = []; // Default empty arrays
                                            
                                            if (isset($wonproject[0])) {
                                                $vendor_id = explode(',', $wonproject[0]->vendor_id);
                                                $vendor_advance = explode(',', $wonproject[0]->vendor_advance);
                                                $vendor_balance = explode(',', $wonproject[0]->vendor_balance);
                                                $vendor_total = explode(',', $wonproject[0]->vendor_total);
                                                $vendor_contract = explode(',', $wonproject[0]->vendor_contract);
                                            }
                                            ?>
                                            {{-- {{dd($vendor_id)}} --}}
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
                                                                        type="number" class="form-control  vendor_advance_input"
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
                                                                        value="{{ $value2 }}" class="form-control vendor_balance_input"
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
                                                                        class="form-control vendor_total_input"
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
                                                                        href="{{ url('adminapp/public/' . $value4) }}">{{ 'adminapp/public/' . $value4 }}</a>
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
                                                    <label id="otherField18"
                                                        class="col-lg-3 col-form-label font-weight-semibold">Comments
                                                        <span class="text-danger">*</span></label>
                                                    <div class="col-lg-9">
                                                        <textarea name="sales_comment" value="" id="sales_comment"
                                                            type="text" class="form-control"
                                                            placeholder="Comments"></textarea>
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
                                                        <input name="last_edited_by" id="user" type="text"
                                                            class="form-control user" placeholder="Last edited by"
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
            </div>
            {{-- end won project --}}


            {{-- operation --}}

            <div class="container-fluid d-none" id="operation-title">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">

                            <div class="card-header header-elements-inline">
                                <div class="card-title" style="color:white !important">Operation New Project</div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <form id="{{ $operation && $operation->id ? 'update' : 'register' }}"
                                        class="flex-wrap form col-md-12 d-flex" enctype="multipart/form-data">
                                        @csrf
                                        <input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount">
                                        <input type="hidden" name="rfq" id="operation_rfq_no">
                                        <input type="hidden" name="client_id" id="opertion_client_id">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">Project No
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input name="project_no" value="" type="text"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">PO Number <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input name="purchase_order_no" value=""
                                                        type="text" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">Respondent
                                                    Incentives
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input name="respondent_incentives" value="" type="text"
                                                        class="form-control" placeholder="Respondent Incentives">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-none">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">Assign Team
                                                    Leader
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">

                                                    {{-- <input name="team_leader" value=""
                                             type="text" class="form-control" placeholder="Assign Team Leader"> --}}
                                                    <select class="form-control label-gray-3" name="team_leader">
                                                        <option class="label-gray-3" value="" disabled selected>
                                                            Select Team
                                                            Leader</option>
                                                        @if (count($user) > 0)
                                                            @foreach ($user as $item)
                                                                <option class="label-gray-3" value="{{ $item->id }}">
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">Project Manager
                                                    Name
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    {{-- <input name="project_manager_name" value=""
                                             type="text" class="form-control" placeholder="Project Manager Name"> --}}
                                                    <select class="form-control label-gray-3" name="project_manager_name">
                                                        <option class="label-gray-3" value="" disabled selected>
                                                            Select
                                                            Manager Name</option>
                                                        @if (count($user1) > 0)
                                                            @foreach ($user1 as $item)
                                                                <option class="label-gray-3" value="{{ $item->id }}">
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 d-none">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">Quality Analyst
                                                    Name
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    {{-- <input name="quality_analyst_name" value=""
                                             type="text" class="form-control" placeholder="Quality Analyst Name"> --}}
                                                    <select class="form-control label-gray-3" name="quality_analyst_name">
                                                        <option class="label-gray-3" value="" disabled selected>
                                                            Select
                                                            Quality Analyst Name</option>
                                                        @if (count($user2) > 0)
                                                            @foreach ($user2 as $item)
                                                                <option class="label-gray-3" value="{{ $item->id }}">
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        @if (auth()->user()->user_type == "admin")
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">Project Operation Head Name
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    {{-- <input name="quality_analyst_name" value=""
                                             type="text" class="form-control" placeholder="Quality Analyst Name"> --}}
                                                    <select class="form-control label-gray-3" name="project_operation_head">
                                                        <option class="label-gray-3" value="" disabled selected>
                                                            Select Project Operation Head Name</option>
                                                        @if (count($user3) > 0)
                                                            @foreach ($user3 as $item)
                                                                <option class="label-gray-3" value="{{ $item->id }}">
                                                                    {{ $item->name }}</option>
                                                            @endforeach
                                                        @endif
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">Project
                                                    Deliverables
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input name="project_deliverable" value="" type="text"
                                                        class="form-control" placeholder="Project Deliverables">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">Attach
                                                    Questionnaire
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input name="questionnarie" style="text-transform: capitalize";
                                                        value="" type="file" class="form-control"
                                                        placeholder="Attach Questionnaire">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">Attach Other
                                                    Documents
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <i class="float-right fa-solid fa-circle-plus add"
                                                        style="color:green;" data-id="1"></i>
                                                    <input name="other_document[]" style="text-transform: capitalize" ;
                                                        value="" type="file" class="form-control"
                                                        placeholder="Attach Other Documents">
                                                    <div id="other_document"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">Attach Survey
                                                    Link
                                                    <span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input name="survey_link" style="text-transform: capitalize";
                                                        value="" type="file" class="form-control"
                                                        placeholder="Attach Survey Link">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group row">
                                            <label class="col-lg-3 col-form-label font-weight-semibold">
                                                Respondent Type <span class="text-danger">*</span>
                                            </label>
                                            <div class="col-lg-9">
                                                <i class="float-right fa-solid fa-circle-plus add-respondent-type" style="color:green;" data-id="1"></i>
                                                <input name="respondent_type[]" type="text" class="form-control mt-1" placeholder="Enter Respondent Type">
                                                <div id="respondent_type_wrapper"></div>
                                            </div>
                                        </div>
                                    </div>
                                        <div class="col-md-12 ">
                                            <div class="form-group row">
                                                <label class="col-lg-12 col-form-label font-weight-semibold">Target
                                                    Table<span class="text-danger">*</span></label>
                                                <button class="ml-2 btn btn-danger" style="float: right;"id="addBtn"
                                                    data-count="0" type="button">
                                                    Add New Country
                                                </button>
                                                <button class="ml-2 btn btn-success" style="float: right;"id="AddTargetGroup"
                                                data-count="0" type="button"><i class="fa-solid fa-plus"></i>
                                                Add Target Group
                                            </button>
                                                <div class="col-md-12 table-responsive" style="overflow-x:auto;">

                                                    {{-- <button class="ml-2 btn btn-danger" class="removeBtn" type="button">
                                                    remove Industry
                                                </button> --}}
                                                    <table border="1" name="" id="mtables" class="mt-4">
                                                        <tr>
                                                            <th class="operation-country">Country</th>
                                                            <th colspan="2" style="text-align: center"><input
                                                                    type="text" class="form-control"
                                                                    name="target_group[0]" style="text-align: center"
                                                                    value="Target Group 1"></th>
                                                            <th colspan="2" style="text-align: center"><input
                                                                    type="text" class="form-control"
                                                                    name="target_group[1]" style="text-align: center"
                                                                    value="Target Group 2"></th>
                                                            <th colspan="2" style="text-align: center"><input
                                                                    type="text" class="form-control"
                                                                    name="target_group[2]" style="text-align: center"
                                                                    value="Target Group 3"></th>
                                                            <th colspan="2" style="text-align: center"><input
                                                                    type="text" class="form-control"
                                                                    name="target_group[3]" style="text-align: center"
                                                                    value="Target Group 4"></th>
                                                            <th colspan="2" style="text-align: center"><input
                                                                    type="text" class="form-control"
                                                                    name="target_group[4]" style="text-align: center"
                                                                    value="Target Group 5"></th>
                                                            <th colspan="2" style="text-align: center"><input
                                                                    type="text" class="form-control"
                                                                    name="target_group[5]" style="text-align: center"
                                                                    value="Target Group 6"></th>
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
                                                        <tr class="operation_target" data-count="0">

                                                            <td>
                                                                <select class="form-control label-gray-3"
                                                                    name="country_name_0[0]" id="country_name"
                                                                    style="width:200px" required>
                                                                    <option class="label-gray-3" value="">Select
                                                                        Country
                                                                    </option>

                                                                    @if (count($country) > 0)
                                                                        @foreach ($country as $value)
                                                                            <option value="{{ $value->name }}">
                                                                                {{ $value->name }}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="border-0"
                                                                    name="sample_target_0[0][]"
                                                                    placeholder="Sample Target">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="border-0"
                                                                    name="sample_achieved_0[0][]"
                                                                    placeholder="Sample Achieved">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="border-0"
                                                                    name="sample_target_0[0][]"
                                                                    placeholder="Sample Target">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="border-0"
                                                                    name="sample_achieved_0[0][]"
                                                                    placeholder="Sample Achieved">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="border-0"
                                                                    name="sample_target_0[0][]"
                                                                    placeholder="Sample Target">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="border-0"
                                                                    name="sample_achieved_0[0][]"
                                                                    placeholder="Sample Achieved">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="border-0"
                                                                    name="sample_target_0[0][]"
                                                                    placeholder="Sample Target">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="border-0"
                                                                    name="sample_achieved_0[0][]"
                                                                    placeholder="Sample Achieved">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="border-0"
                                                                    name="sample_target_0[0][]"
                                                                    placeholder="Sample Target">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="border-0"
                                                                    name="sample_achieved_0[0][]"
                                                                    placeholder="Sample Achieved">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="border-0"
                                                                    name="sample_target_0[0][]"
                                                                    placeholder="Sample Target">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="border-0"
                                                                    name="sample_achieved_0[0][]"
                                                                    placeholder="Sample Achieved">
                                                            </td>

                                                        </tr>
                                                    </table><br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label 
                                                    class="col-lg-3 col-form-label font-weight-semibold">Comments
                                                    <span class="text-danger"></span></label>
                                                <div class="col-lg-9">
                                                    <textarea name="project_comment" style="height:150px;" value="" id="project_comment"
                                                        type="text" class="form-control"
                                                        placeholder="Comments"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex align-items-center justify-content-center">
                                            <a href="" id="add_reg1" class="btn btn-outline-secondary">Back</a>
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
            {{-- end operaation --}}
        @endsection

        @section('css')
            <style>
                .error {
                    color: red;
                    font-size: 11px;
                    font-weight: bold;
                }

                #otherFieldDiv {
                    /* max-width: 900px; */
                    display: none;
                    /* margin: 0 auto; */
                }
            </style>
        @endsection

        @section('scripts')

            <script>
                // $(document).on('click', '.won-rfq-btn2', function () {
                //     debugger
                //     // Create a FormData object and append form elements
                //     var id= $('.my-samplesize').last().attr('data-id');

                //     $.ajax({
                //         type: "POST",
                //         url: "{{ route('bidrfq.wonupdate') }}",
                //         data: id, // Use the formData object
                //         processData: false,
                //         contentType: false,
                //         dataType: "json",
                //         success: function (data) {
                //             if (data.success == 1) {
                //                 console.log('Updated Successfully');
                //             }
                //             if (data.success == 0) {
                //                 swal({
                //                     title: "Server Site Error",
                //                     type: "warning",
                //                     dangerMode: true,
                //                 });
                //             }
                //             if (data.success == 2) {
                //                 swal({
                //                     title: "Something Went Wrong",
                //                     type: "warning",
                //                     dangerMode: true,
                //                 });
                //             }
                //         }
                //     });
                // });





                $(document).on('change', '#worldcurrency', function() {
                    var cur = $(this).val();
                    $('.currency').html(cur);
                    // $(".total_cost.border").removeAttr("placeholder");

                });
            </script>


            <script>
                //     $(document).ready(function () {

                //         $("#register").validate({
                //             rules: {
                //                 rfq_no: {
                //                     required: true
                //                 },
                //                 project_name: {
                //                     required: true
                //                 },
                //                 project_execution: {
                //                     required: true
                //                 },
                //                 project_type: {
                //                     required: true
                //                 },
                //                 project_start_date: {
                //                     required: true
                //                 },
                //                 project_end_date: {
                //                     required: true
                //                 },
                //                 client_total: {
                //                     required: true
                //                 },
                //                 vendor_total: {
                //                     required: true
                //                 },
                //                 client_advance: {
                //                     required: true
                //                 },
                //                 client_balance: {
                //                     required: true
                //                 },
                //                 vendor_advance: {
                //                     required: true
                //                 },
                //                 vendor_balance: {
                //                     required: true
                //                 },
                //                 client_contract: {
                //                     required: true
                //                 },
                //                 vendor_contract: {
                //                     required: true
                //                 },
                //                 total_margin: {
                //                     required: true
                //                 },
                //                 date: {
                //                     required: true
                //                 },
                //             },
                //             errorPlacement: function (error, element) {
                //                 if (element.hasClass("select2-hidden-accessible")) {
                //                     error.insertAfter(element.siblings('span.select2'));
                //                 } else if (element.hasClass("floating-input")) {
                //                     element.closest('.form-floating-label').addClass("error-cont").append(error);
                //                 } else {
                //                     error.insertAfter(element);
                //                 }
                //             },
                //             submitHandler: function (form) {
                //                 // console.log('xxx');
                //                 debugg();

                //                 var data = new FormData(form);
                //                 // alert(data);
                //                 // die();
                //                 // loadButton('#addRegisterButton');

                //                 $.ajax({
                //                     type: "POST",
                //                     url: "{{ route('operationNew.storeWon') }}",
                //                     data: data,
                //                     headers: {
                //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //                     },
                //                     processData: false,
                //                     contentType: false,
                //                     dataType: "json",
                //                     success: function (data) {
                //                         $('#register').get(0).reset()
                //                         if (data.success == 1) {
                //                             // loadButton('#addRegisterButton');
                //                             flash({ msg: data.message, type: 'success' });
                //                             window.location = "{{ route('wonproject.index') }}";
                //                         }
                //                         else {
                //                             flash({ msg: data.message, type: 'info' });
                //                         }
                //                     }
                //                 });

                //             }
                //         });

                //         $("#update").validate({
                //             rules: {
                //                 type: {
                //                     required: true
                //                 },
                //                 rfq_no: {
                //                     required: true
                //                 },
                //                 project_name: {
                //                     required: true
                //                 },
                //                 project_execution: {
                //                     required: true
                //                 },
                //                 project_type: {
                //                     required: true
                //                 },
                //                 project_start_date: {
                //                     required: true
                //                 },
                //                 project_end_date: {
                //                     required: true
                //                 },
                //                 client_total: {
                //                     required: true
                //                 },
                //                 vendor_total: {
                //                     required: true
                //                 },
                //                 client_advance: {
                //                     required: true
                //                 },
                //                 client_balance: {
                //                     required: true
                //                 },
                //                 vendor_advance: {
                //                     required: true
                //                 },
                //                 vendor_balance: {
                //                     required: true
                //                 },
                //                 client_contract: {
                //                     required: true
                //                 },
                //                 vendor_contract: {
                //                     required: true
                //                 },
                //                 total_margin: {
                //                     required: true
                //                 },
                //                 date: {
                //                     required: true
                //                 },
                //             },
                //             errorPlacement: function (error, element) {
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
                //                 $.ajax({
                //                     type: "POST",
                //                     url: "{{ route('wonproject.update') }}",
                //                     data: data,
                //                     processData: false,
                //                     contentType: false,
                //                     dataType: "json",
                //                     success: function (data) {
                //                         $('#update').get(0).reset()
                //                         if (data.success == 1) {
                //                             flash({ msg: data.message, type: 'success' });
                //                             window.location = "{{ route('wonproject.index') }}";
                //                         }
                //                         else {
                //                             flash({ msg: data.message, type: 'info' });
                //                         }
                //                     }

                //                 });
                //             }
                //         });
                //         function storeFunction() {
                //   alert("The form was submitted");
                // }

                //     })
            </script>


            <script>
                $(document).ready(function() {
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
                            sales_comment: {
                                required: true
                            },
                            date: {
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
                        $('.rfqno').val($('#rfq_no_hidden').val());
                            var data = new FormData(form);
                            $.ajax({
                                type: "POST",
                                url: "{{ route('bidrfq.update') }}",
                                data: data,
                                processData: false,
                                contentType: false,
                                dataType: "json",
                                success: function(data) {
                                    // $('#update').get(0).reset()
                                    if (data.success == 1) {
                                        // swal({
                                        //     title: 'Success',
                                        //     text: 'WonProject Updated Successfully',
                                        //     icon: 'success',
                                        //     button: false
                                        // })
                                        // console.log('hii');
                                        // window.location = "{{ route('operationNew.createWon') }}";
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

                    $(document).on('keyup', 'table td', function() {
                        var first = $(this).attr("data-culation");
                        var second = $(this).attr("data-cal");
                        console.log(('.cal_' + first + '_' + second));



                        var sum = 0;
                        $('.cal_' + first + '_' + second).each(function(i, v) {
                            //  console.log($(this).val());
                            if ($(this).val() != '' && i != 7) {
                                sum += Number($(this).val());
                                console.log(sum);


                            }
                        });
                        $('.total_cost_' + first + '_' + second).val(sum);

                    });

                });



                $(document).on('change', '#rfq_no', function() {
                    // debugger
                    var id = $(this).val();
                    $('#rfq_no_hidden').val(id);
                    // var rfqNo = $(this).find('option:selected').data('rfqno');

                    // console.log("ID:", id);
                    // console.log("RFQ No:", rfqNo);
                    // var url = "{{ route('operationNew.editoper', ':id') }}".replace(':id', id);
                    // // Perform your AJAX request here using the 'id' and 'rfqNo' variables
                    $.ajax({
                        type: "GET",
                        url: "{{ route('operationNew.editoper') }}",
                        data: {
                            id: id,
                        },
                        dataType: "json",
                        success: function(data) {
                            // console.log(data);
                           var userName = data.user.name;
                            console.log("User Name:", userName);
                            // var sampleSize = JSON.parse(data.bidrfq.sample_size);
                            // // console.log(sampleSize);
                            // var setupCost = JSON.parse(data.bidrfq.setup_cost);
                            // var recruitment = JSON.parse(data.bidrfq.recruitment);
                            // var methodology = JSON.parse(data.bidrfq.methodology);
                            // var incentives = JSON.parse(data.bidrfq.incentives);
                            // var moderation = JSON.parse(data.bidrfq.moderation);
                            // var transcript = JSON.parse(data.bidrfq.transcript);
                            // var others = JSON.parse(data.bidrfq.others);
                            // var world = JSON.parse(data.bidrfq.country);
                            // var totalCost = JSON.parse(data.bidrfq.total_cost);
                            // var client_id = JSON.parse(data.bidrfq.client_id);
                            // console.log(client_id);
                            // var vendor_id = JSON.parse(data.bidrfq.vendor_id);
                            // var all_country = data.all_country;
                            // var all_client = data.all_client;
                            // var all_vendor = data.all_vendor;
                            var operation_data_html = "";

                           
                            $('.operation-data').html(data.operation_data)

                            // $("#id").val(data.bidrfq.id);
                            // $(".rfqno").val(data.bidrfq.rfqno);
                            // $("#date").val(data.bidrfq.date);
                            // $("#industry").val(data.bidrfq.industry);
                            // console.log(data.bidrfq.industry);
                            // $("#follow_up_date").val(data.bidrfq.follow_up_date);
                            // //$("#currency").val(data.bidrfq.currency);
                            // $("#company_name").val(data.bidrfq.company_name);
                            //$("#respondent_title").val(data.bidrfq.respondent_title);
                            //$("#interview_length").val(data.bidrfq.interview_length);
                            //$("#others_field").val(data.bidrfq.others_field);
                            $(".user").val(data.user.name);
                    // first page end
                            console.log(data);
                            console.log(data.bidrfq.vendor_id);

                            $.each(data.bidrfq.vendor_id.split(','), function(i, v) {

                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"><div class="col-md-3"><label id="otherField13" >Vendor Name<spanclass="text-danger">*</span></label></div><div class="col-lg-9" ></label><input name="vendor_name" value="' +
                                    v +
                                    '" id="vendor_advance" type="text" class="form-control" placeholder="Advance Payment"></div></div></div>'
                                );

                                let vendor_advance = data.bidrfq.vendor_advance.split(',');

                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"><div class="col-md-3"><label id="otherField13" >Advance Payment <spanclass="text-danger">*</span></label></div><div class="col-lg-9" ><label class="currency"></label><input name="vendor_advance" value="' +
                                    vendor_advance[i] +
                                    '" id="vendor_advance" type="text" class="form-control" placeholder="Advance Payment"></div></div></div>'
                                );

                                let vendor_balane = data.bidrfq.vendor_balance.split(',');

                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"><div class="col-md-3"><label id="otherField14">Balance Payment</label></div><div class="col-lg-9" id="vendor_balance1"><label class="currency"></label><input name="vendor_balance" value="' +
                                    vendor_balane[i] +
                                    '" id="vendor_balance" type="text" class="form-control" placeholder="Advance Payment"></div></div></div>'
                                );

                                let vendor_total = data.bidrfq.vendor_total.split(',')
                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"><div class="col-md-3"><label id="otherField7">Vendor Total Project Invoice Value</label></div><div class="col-lg-9" ><label class="currency"></label><input name="vendor_total" value="' +
                                    vendor_total[i] +
                                    '" id="vendor_total" type="text" class="form-control" placeholder="Advance Payment"></div></div></div>'
                                );

                                let vendor_contract = data.bidrfq.vendor_contract.split(',')
                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"> <label id="otherField16" class="col-lg-3 col-form-label font-weight-semibold">Attach Vendor Contract / Email<span class="text-danger">*</span></label><div class="col-lg-9" id="vendor_contract1"><a target="_blank" download href="../../adminapp/public/' +
                                    vendor_contract[i] + '">"' + vendor_contract[i] +
                                    '"</a></div></div></div><div class="col-md-6"></div>');
                            });


                            // $("#vendor_advance").val(data.bidrfq.vendor_advance);
                            // $("#vendor_balance").val(data.bidrfq.vendor_balance);
                            $("#client_contract_attachment").html(
                                `<a target="_blank" download href="/adminapp/public/${data.bidrfq.client_contract}" style=" text-decoration: none !important;">${data.bidrfq.client_contract}</a>`
                            );
                            // $("#vendor_contract_attachment").html( `<a href="${data.bidrfq.vendor_contract}" style=" text-decoration: none !important;">${data.bidrfq.vendor_contract}</a>`);
                            $(".currency").html(data.bidrfq.currency);
                            // console.log(data.bidrfq.client_contract);
                            // $("#client_contract").val(data.bidrfq.client_contract);
                            // $("#vendor_contract").val(data.bidrfq.vendor_contract);



                            if (id != "") {
                                $('#my-div').addClass('d-none');
                                $('#wondiv').addClass('d-none');
                                $('#won_noti').addClass('d-none');
                                $('#edit-rfq').removeClass('d-none');
                                $('#otherField1').addClass('required', '');
                                $('#otherField1').addClass('data-error', 'This field is required.');
                                $('#otherField2').addClass('required', '');
                                $('#otherField2').addClass('data-error', 'This field is required.');
                                $('#otherField3').addClass('required', '');
                                $('#otherField3').addClass('data-error', 'This field is required.');
                                $('#otherField4').addClass('required', '');
                                $('#otherField4').addClass('data-error', 'This field is required.');
                                $('#otherField5').addClass('required', '');
                                $('#otherField5').addClass('data-error', 'This field is required.');
                            } else {
                                $('#edit-rfq').addClass('d-none');
                                $('#otherField1').removeClass('required');
                                $('#otherField1').removeClass('data-error');
                                $('#otherField2').removeClass('required');
                                $('#otherField2').removeClass('data-error');
                                $('#otherField3').removeClass('required');
                                $('#otherField3').removeClass('data-error');
                                $('#otherField4').removeClass('required');
                                $('#otherField4').removeClass('data-error');
                                $('#otherField5').removeClass('required');
                                $('#otherField5').removeClass('data-error');
                            }
                            console.log("id: "+ id);
                               

                        }
                    });

                   
                });

                $(document).on('keyup', '.bid-table td input:not(input[name^="sample_size"])', function() {
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

                $(document).on('click', '.addvendor', function() {
                    //debugger
                    var key = $(this).attr('data-button');
                    var d = 1 + parseInt($('.abcversion_' + key + '_2').last().attr("data-id"));
                    var count = 1;
                    var dataArr = $('.abcversion_' + key).last().attr('data-arr');
                    if (dataArr !== undefined && dataArr !== null && dataArr !== '') {
                        count += parseInt(dataArr);
                    }
                    var calc = parseInt($('.abcversion_' + key + '_2').last().attr('data-cal')) + 1;

                    $('.abcversion_' + key + '_coun').last().before("<td class='abcversion_" + key + "_coun'></td>");
                    $('.abcversion_' + key + '_11').last().before("<td class='abcversion_" + key + "_11'></td>");
                    $('.abcversion_' + key).last().after("<td class='abcversion_" + key + "' data-arr=" + count +
                        "><select class='form-control label-gray-3' name='vendor_id_0[" + key +
                        "][]'><option class='label-gray-3' value=''>Vendor</option>@if (count($vendor) > 0)@foreach ($vendor as $v)<option value='{{ $v->vendor_name }}'>{{ $v->vendor_name }}</option> @endforeach @endif</select></div></label></td>"
                    );
                    $('.abcversion_' + key + '_1').last().after("<td class='abcversion_" + key +
                        "_1'><input type='text' class='txtCal' placeholder='Sample size' name='sample_size_0[" + key +
                        "][]'></div></td>");
                    $('.abcversion_' + key + '_2').last().after("<td class='abcversion_" + key + "_2' data-id=" + d +
                        " data-cal=" + calc + " data-culation=" + key + "><input type='text' class='cal_" + key + "_" +
                        calc + "' placeholder='Setup Cost' name='setup_cost_0[" + key + "][]'></div></td>");
                    $('.abcversion_' + key + '_3').last().after("<td class='abcversion_" + key + "_3' data-id=" + d +
                        " data-cal=" + calc + " data-culation=" + key + "><input type='text' class='cal_" + key + "_" +
                        calc + "' placeholder='Recruitment' name='recruitment_0[" + key + "][]'></div></td>");
                    $('.abcversion_' + key + '_4').last().after("<td class='abcversion_" + key + "_4' data-id=" + d +
                        " data-cal=" + calc + " data-culation=" + key + "><input type='text' class='cal_" + key + "_" +
                        calc + "' placeholder='Incentives' name='incentives_0[" + key + "][]'></div></td>");
                    $('.abcversion_' + key + '_5').last().after("<td class='abcversion_" + key + "_5' data-id=" + d +
                        " data-cal=" + calc + " data-culation=" + key + "><input type='text' class='cal_" + key + "_" +
                        calc + "' placeholder='Moderation' name='moderation_0[" + key + "][]'></div></td>");
                    $('.abcversion_' + key + '_6').last().after("<td class='abcversion_" + key + "_6' data-id=" + d +
                        " data-cal=" + calc + " data-culation=" + key + "><input type='text' class='cal_" + key + "_" +
                        calc + "' placeholder='Transcript' name='transcript_0[" + key + "][]'></div></td>");
                    $('.abcversion_' + key + '_7').last().after("<td class='abcversion_" + key + "_7' data-id=" + d +
                        " data-cal=" + calc + " data-culation=" + key + "><input type='text' class='cal_" + key + "_" +
                        calc + "' placeholder='Others'     name='others_0[" + key + "][]'></div></td>");
                    $('.abcversion_' + key + '_8').last().after("<td class='abcversion_" + key +
                        "_8' ><input type='text' class='total_cost_" + key + "_" + calc +
                        "' placeholder='Total Cost' name='total_cost_0[" + key + "][]'></div></td>");
                    console.log('key:', key);
                    console.log('dataArr:', d);
                    console.log('calc:', calc);


                });



                $(document).on('click', '.btn-country', function() {
                    // debugger
                    var rar = 1 + parseInt($('.addvendor').last().attr('data-button'));
                    var id = $('.my-samplesize').last().attr('data-id');

                    console.log(id);
                    var html = '';
                    html += `<table class="table  add-country_${rar} ml-5" id="mtable" >
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
                                  @if (count($country) > 0)
                                    @foreach ($country as $v)
                                     <option value="{{ $v->name }}">{{ $v->name }}</option>
                                         @endforeach
                                            @endif
                                    </select>
                                             </label>
                                            
                                        
                                </th>
                                <th>
                                
                                </th>
                                
                                <th>
                                <button class="float-left btn btn-success btn-remove" data-remove="${rar}"  type="button">
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
                                        @if (!empty($client))
                                            @foreach ($client as $v)
                                                <option value="{{ $v->client_name }}">{{ $v->client_name }}</option>
                                            @endforeach
                                        @endif
                                    </select>

                                    </td>
                                    <td class="abcversion_${rar}" data-arr="0">
                                     <select class="form-control label-gray-3" name="vendor_id_0[${rar}][]">
                                        <option class="label-gray-3" value="">Vendor</option>
                                            @if(count($vendor) > 0)
                                            @foreach($vendor as $v)
                                        <option value="{{$v->vendor_name}}">{{$v->vendor_name}}</option>
                                            @endforeach
                                            @endif
                                    </select>
                                   
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
                    var j = 2;
                    $('.edit-table-bid tr td').each(function(index, value) {
                        if ($(this).data('id')) {
                            $(this).attr('data-id', j);
                            j++;
                            console.log(('.edit-table-bid tr:nth-child(4) td').length);
                            if ($('.edit-table-bid tr:nth-child(4) td').length < j) {
                                j = 2;
                            }
                        } else {
                            j = 2;
                        }
                    });

                });


                $(document).on('click', '.btn-remove', function() {
                    var key = $(this).attr('data-remove');

                    if ($('th .abcversion_' + key + '_coun')) {
                        $('.abcversion_' + key + '_coun').last().prev('td').remove();
                    }

                    if ($('.abcversion_' + key).length > 1) {
                        $('.abcversion_' + key).last().remove();
                    }

                    if ($('.abcversion_' + key + '_1').length > 2) {
                        $('.abcversion_' + key + '_1').last().remove();
                    }

                    if ($('.abcversion_' + key + '_2').length > 2) {
                        $('.abcversion_' + key + '_2').last().remove();
                    }

                    if ($('.abcversion_' + key + '_3').length > 2) {
                        $('.abcversion_' + key + '_3').last().remove();
                    }

                    if ($('.abcversion_' + key + '_4').length > 2) {
                        $('.abcversion_' + key + '_4').last().remove();
                    }

                    if ($('.abcversion_' + key + '_5').length > 2) {
                        $('.abcversion_' + key + '_5').last().remove();
                    }

                    if ($('.abcversion_' + key + '_6').length > 2) {
                        $('.abcversion_' + key + '_6').last().remove();
                    }

                    if ($('.abcversion_' + key + '_7').length > 2) {
                        $('.abcversion_' + key + '_7').last().remove();
                    }

                    if ($('.abcversion_' + key + '_8').length > 2) {
                        $('.abcversion_' + key + '_8').last().remove();
                    }

                    if ($('.abcversion_' + key + '_11').length > 2) {
                        $('.abcversion_' + key + '_11').last().remove();
                    }
                });



                $(document).on('change', '#rfq_no', function() {
                    var id = $(this).val();
                    $('#rfq_no_hidden').val(id);
                    $.ajax({
                        type: "GET",
                        url: "{{ route('operationNew.change') }}",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(data) {

                            console.log(data);
                            
                            $("#id_no").val(data.wonProject.id);
                            $(".rfqno").val(id);
                            $("#client_id").val(data.wonProject.client_id);
                            $("#projectname").val(data.wonProject.project_name);
                            $("#projecttype").val(data.wonProject.project_type);
                            $("#project_execution").val(data.wonProject.project_execution);
                            $("#worldcurrency").val(data.wonProject.currency);
                            $("#project_start_date").val(data.wonProject.project_start_date);
                            $("#project_end_date").val(data.wonProject.project_end_date);
                            $("#client_total").val(data.wonProject.client_total);
                            $("#mode").val(data.wonProject.mode);
                            $("#total_margin").val(data.wonProject.total_margin);
                            $("#sales_comment").val(data.wonProject.sales_comment);
                            $("#client_advance").val(data.wonProject.client_advance);
                            $("#client_balance").val(data.wonProject.client_balance);
                            $(".user").val(data.user3.name);
                            console.log(data.wonProject.vendor_id);
                            $.each(data.wonProject.vendor_id.split(','), function(i, v) {
                                $('#vendor_id').html(`<option value="${data.wonProject.vendor_id}">${data.wonProject.vendor_id}</option>`)
                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"><div class="col-md-3"><label id="otherField13" >Vendor Name<spanclass="text-danger">*</span></label></div><div class="col-lg-9" ></label><input name="vendor_name" value="' +
                                    v +
                                    '" id="vendor_advance" type="text" class="form-control" placeholder="Advance Payment"></div></div></div>'
                                );

                                let vendor_advance = data.wonProject.vendor_advance.split(',');
                                $('.vendor_advance_input').val(data.wonProject.vendor_advance);
                                console.log(data.wonProject.vendor_advance)
                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"><div class="col-md-3"><label id="otherField13" >Advance Payment <spanclass="text-danger">*</span></label></div><div class="col-lg-9" ><label class="currency"></label><input name="vendor_advance" value="' +
                                    vendor_advance[i] +
                                    '" id="vendor_advance" type="text" class="form-control" placeholder="Advance Payment"></div></div></div>'
                                );

                                let vendor_balane = data.wonProject.vendor_balance.split(',');
                                $('.vendor_balance_input').val(data.wonProject.vendor_balance);                   
                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"><div class="col-md-3"><label id="otherField14">Balance Payment</label></div><div class="col-lg-9" id="vendor_balance1"><label class="currency"></label><input name="vendor_balance" value="' +
                                    vendor_balane[i] +
                                    '" id="vendor_balance" type="text" class="form-control" placeholder="Advance Payment"></div></div></div>'
                                );

                                let vendor_total = data.wonProject.vendor_total.split(',')
                                $('.vendor_total_input').val(data.wonProject.vendor_total);   
                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"><div class="col-md-3"><label id="otherField7">Vendor Total Project Invoice Value</label></div><div class="col-lg-9" ><label class="currency"></label><input name="vendor_total" value="' +
                                    vendor_total[i] +
                                    '" id="vendor_total" type="text" class="form-control" placeholder="Advance Payment"></div></div></div>'
                                );

                                let vendor_contract = data.wonProject.vendor_contract.split(',')
                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"> <label id="otherField16" class="col-lg-3 col-form-label font-weight-semibold">Attach Vendor Contract / Email<span class="text-danger">*</span></label><div class="col-lg-9" id="vendor_contract1"><a target="_blank" download href="../../adminapp/public/' +
                                    vendor_contract[i] + '">"' + vendor_contract[i] +
                                    '"</a></div></div></div><div class="col-md-6"></div>');
                            });


                            // $("#vendor_advance").val(data.wonProject.vendor_advance);
                            // $("#vendor_balance").val(data.wonProject.vendor_balance);
                            $("#client_contract_attachment").html(
                                `<a target="_blank" download href="/adminapp/public/${data.wonProject.client_contract}" style=" text-decoration: none !important;">adminapp/public/${data.wonProject.client_contract}</a>`
                            );
                            // $("#vendor_contract_attachment").html( `<a href="${data.wonProject.vendor_contract}" style=" text-decoration: none !important;">${data.wonProject.vendor_contract}</a>`);
                            $(".currency").html(data.wonProject.currency);
                            // console.log(data.wonProject.client_contract);
                            // $("#client_contract").val(data.wonProject.client_contract);
                            // $("#vendor_contract").val(data.wonProject.vendor_contract);



                            if (id != "") {
                                $('#my-div').addClass('d-none');
                                $('#wondiv').addClass('d-none');
                                $('#won_noti').addClass('d-none');
                                $('#edit-rfq').removeClass('d-none');
                                $('#otherField1').addClass('required', '');
                                $('#otherField1').addClass('data-error', 'This field is required.');
                                $('#otherField2').addClass('required', '');
                                $('#otherField2').addClass('data-error', 'This field is required.');
                                $('#otherField3').addClass('required', '');
                                $('#otherField3').addClass('data-error', 'This field is required.');
                                $('#otherField4').addClass('required', '');
                                $('#otherField4').addClass('data-error', 'This field is required.');
                                $('#otherField5').addClass('required', '');
                                $('#otherField5').addClass('data-error', 'This field is required.');
                            } else {
                                $('#edit-rfq').addClass('d-none');
                                $('#otherField1').removeClass('required');
                                $('#otherField1').removeClass('data-error');
                                $('#otherField2').removeClass('required');
                                $('#otherField2').removeClass('data-error');
                                $('#otherField3').removeClass('required');
                                $('#otherField3').removeClass('data-error');
                                $('#otherField4').removeClass('required');
                                $('#otherField4').removeClass('data-error');
                                $('#otherField5').removeClass('required');
                                $('#otherField5').removeClass('data-error');
                            }
                            


                        }
                    });


                });

                $(document).on('click', '.btn-remove-country1', function() {
                    var tom = $(this).attr('data-country1');
                    console.log('add-country_' + tom);
                    $('.add-country_' + tom).remove();
                });



                $(document).on('click', '.remove-country', function() {
                    var country = $(this).attr('data-remove');
                    $(`.remove-country-${country}`).remove();
                    $('.country_remove_' + country).remove();
                    $('.country_remove_' + country + '_1').remove();
                    $('.country_remove_' + country + '_2').remove();
                    $('.country_remove_' + country + '_3').remove();
                    $('.country_remove_' + country + '_4').remove();
                    $('.country_remove_' + country + '_5').remove();
                    $('.country_remove_' + country + '_6').remove();
                    $('.country_remove_' + country + '_7').remove();
                    $('.country_remove_' + country + '_8').remove();
                    $('.country_remove_' + country + '_9').remove();
                    $('.country_remove_' + country + '_10').remove();
                    $('.country_remove_' + country + '_11').remove();
                    $('.country_remove_' + country + '_12').remove();
                    $('.country_remove_' + country + '_13').remove();
                    // $(this).closest('th').remove();
                    // $(this).remove();

                })


                // for notification
                function rfq_won(id) {
                    $.ajax({
                        type: "GET",
                        url: "{{ route('operationNew.change') }}",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(data) {
                            $("#rfqno").val(data.wonProject.rfq_no);
                            $("#client_id").val(data.wonProject.client_id);
                            $("#projectname").val(data.wonProject.project_name);
                            $("#projecttype").val(data.wonProject.project_type);
                            $("#project_execution").val(data.wonProject.project_execution);
                            $("#mode").val(data.wonProject.mode);
                            $("#date").val(data.wonProject.date);
                            $("#project_start_date").val(data.wonProject.project_start_date);
                            $("#project_end_date").val(data.wonProject.project_end_date);
                            $("#client_total").val(data.wonProject.client_total);
                            $("#vendor_total").val(data.wonProject.vendor_total);
                            $("#total_margin").val(data.wonProject.total_margin);
                            $("#sales_comment").val(data.wonProject.sales_comment);
                            $("#client_advance").val(data.wonProject.client_advance);
                            $("#client_balance").val(data.wonProject.client_balance);
                            $("#vendor_advance").val(data.wonProject.vendor_advance);
                            $("#vendor_balance").val(data.wonProject.vendor_balance);





                            if (id != "") {
                                $('#my-div').addClass('d-none');
                                $('#wondiv').addClass('d-none');
                                $('#won_noti').addClass('d-none');
                                $('#otherFieldDiv').removeClass('d-none');
                                $('#otherField1').addClass('required', '');
                                $('#otherField1').addClass('data-error', 'This field is required.');
                                $('#otherField2').addClass('required', '');
                                $('#otherField2').addClass('data-error', 'This field is required.');
                                $('#otherField3').addClass('required', '');
                                $('#otherField3').addClass('data-error', 'This field is required.');
                                $('#otherField4').addClass('required', '');
                                $('#otherField4').addClass('data-error', 'This field is required.');
                                $('#otherField5').addClass('required', '');
                                $('#otherField5').addClass('data-error', 'This field is required.');
                            } else {
                                $('#otherFieldDiv').addClass('d-none');
                                $('#otherField1').removeClass('required');
                                $('#otherField1').removeClass('data-error');
                                $('#otherField2').removeClass('required');
                                $('#otherField2').removeClass('data-error');
                                $('#otherField3').removeClass('required');
                                $('#otherField3').removeClass('data-error');
                                $('#otherField4').removeClass('required');
                                $('#otherField4').removeClass('data-error');
                                $('#otherField5').removeClass('required');
                                $('#otherField5').removeClass('data-error');
                            }





                        }
                    });

                }


                $(document).on('click', "#nextrfq", function() {

                    $('#edit-rfq').addClass('d-none');
                    $('#won-rfq').removeClass('d-none');
                    $('#won-rfq1').removeClass('d-none');
                    $('#won-rfq-btn').removeClass('d-none');
                    $('#otherFieldDiv').removeClass('d-none');
                    $('.won-rfq-btn2').removeClass('d-none');
                });
                $(document).on('click', '#rfq-back', function() {
                    $('#edit-rfq').removeClass('d-none');
                    $('#won-rfq').addClass('d-none');
                    $('#won-rfq1').addClass('d-none');
                    $('#won-rfq-btn').addClass('d-none');

                    $('.won-rfq-btn2').removeClass('d-none');
                });
                $(document).on('click', '#Won_back', function() {
                    // Show the elements that should be visible
                    $('#edit-rfq').removeClass('d-none');
                    $('#otherFieldDiv').addClass('d-none');
                    $('#won-rfq').addClass('d-none');
                    $('#wondiv').addClass('d-none');
                });

                $(document).on('click', '#won-rfq-btn1', function() {
                    $('#wondiv').addClass('d-none');
                    $('#wondiv').removeClass('d-none');
                    $('#otherFieldDiv').addClass('d-none');
                    $('#won-rfq').addClass('d-none');
                    $('#won-rfq-btn1').addClass('d-none');
                    $('.won-rfq-btn2').addClass('d-none');
                });
                $(document).on('click', '#add_reg1', function() {
                    $('#edit-rfq').addClass('d-none');
                    $('#won-rfq').addClass('d-none');
                    $('#won-rfq1').addClass('d-none');
                    $('#won-rfq-btn').addClass('d-none');
                    $('#otherFieldDiv').removeClass('d-none');
                    $('.won-rfq-btn2').addClass('d-none');
                });

                $(document).on('click','#nextrfq',function(){
                    $('.rfq-sub').trigger('click');
                });


                $(document).ready(function() {



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
                            sales_comment: {
                                required: true
                            },
                            date: {
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
                        $('.rfqno').val($('#rfq_no_hidden').val());
                            var data = new FormData(form);
                            $.ajax({
                                type: "POST",
                                url: "{{ route('wonproject.update') }}",
                                data: data,
                                processData: false,
                                contentType: false,
                                dataType: "json",
                                success: function(data) {
                                    // $('#update').get(0).reset()
                                    if (data.success == 1) {
                                        //  swal({
                                        //     title:'Success',
                                        //     text:'WonProject Updated Successfully',
                                        //     icon:'success',
                                        //     button:false
                                        // })
                                        // console.log('hii');
                                        // window.location = "{{ route('wonproject.index') }}";
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




                $(document).ready(function() {
                    if ("{{ $notificationCount }}" < 1) {
                        $(".badge").addClass('d-none');

                    }
                });
                
                // for notification
            </script>

            <script>
                $(document).on('click', '.notify-won', function() {
                    var id = $(this).attr('data-win');

                    $.ajax({
                        type: "GET",
                        url: "{{ route('operationNew.change') }}",
                        data: {
                            id: id
                        },
                        dataType: "json",
                        success: function(data) {
                            $("#rfqno").val(data.wonProject.rfq_no);
                            $("#client_id").val(data.wonProject.client_id);
                            $("#projectname").val(data.wonProject.project_name);
                            $("#projecttype").val(data.wonProject.project_type);
                            $("#project_execution").val(data.wonProject.project_execution);
                            $("#worldcurrency").val(data.wonProject.currency);
                            $("#project_start_date").val(data.wonProject.project_start_date);
                            $("#project_end_date").val(data.wonProject.project_end_date);
                            $("#client_total").val(data.wonProject.client_total);
                            $("#mode").val(data.wonProject.mode);
                            $("#total_margin").val(data.wonProject.total_margin);
                            $("#sales_comment").val(data.wonProject.sales_comment);
                            $("#client_advance").val(data.wonProject.client_advance);
                            $("#client_balance").val(data.wonProject.client_balance);
                            console.log(data.wonProject.vendor_id);
                            $.each(data.wonProject.vendor_id.split(','), function(i, v) {

                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"><div class="col-md-3"><label id="otherField13" >Advance Payment <spanclass="text-danger">*</span></label></div><div class="col-lg-9" ></label><input name="vendor_name" value="' +
                                    v +
                                    '" id="vendor_advance" type="text" class="form-control" placeholder="Advance Payment"></div></div></div>'
                                );

                                let vendor_advance = data.wonProject.vendor_advance.split(',');

                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"><div class="col-md-3"><label id="otherField13" >Advance Payment <spanclass="text-danger">*</span></label></div><div class="col-lg-9" ><label class="currency"></label><input name="vendor_advance" value="' +
                                    vendor_advance[i] +
                                    '" id="vendor_advance" type="text" class="form-control" placeholder="Advance Payment"></div></div></div>'
                                );

                                let vendor_balane = data.wonProject.vendor_balance.split(',');

                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"><div class="col-md-3"><label id="otherField14">Balance Payment</label></div><div class="col-lg-9" id="vendor_balance1"><label class="currency"></label><input name="vendor_balance" value="' +
                                    vendor_balane[i] +
                                    '" id="vendor_balance" type="text" class="form-control" placeholder="Advance Payment"></div></div></div>'
                                );

                                let vendor_total = data.wonProject.vendor_total.split(',')
                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"><div class="col-md-3"><label id="otherField7">Vendor Total Project Invoice Value</label></div><div class="col-lg-9" ><label class="currency"></label><input name="vendor_total" value="' +
                                    vendor_total[i] +
                                    '" id="vendor_total" type="text" class="form-control" placeholder="Advance Payment"></div></div></div>'
                                );

                                let vendor_contract = data.wonProject.vendor_contract.split(',')
                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"> <label id="otherField16" class="col-lg-3 col-form-label font-weight-semibold">Attach Vendor Contract / Email<span class="text-danger">*</span></label><div class="col-lg-9" id="vendor_contract1"><a target="_blank" download href="../../' +
                                    vendor_contract[i] + '">"' + vendor_contract[i] +
                                    '"</a></div></div></div><div class="col-md-6"></div>');
                            });




                            $("#client_contract_attachment").html(
                                `<a target="_blank" download href="/adminapp/public/${data.wonProject.client_contract}" style=" text-decoration: none !important;">adminapp/public/${data.wonProject.client_contract}</a>`
                            );
                            $(".currency").html(data.wonProject.currency);


                            if (id != "") {
                                $('#my-div').addClass('d-none');
                                $('#wondiv').addClass('d-none');
                                $('#won_noti').addClass('d-none');
                                $('#otherFieldDiv').removeClass('d-none');
                                $('#otherField1').addClass('required', '');
                                $('#otherField1').addClass('data-error', 'This field is required.');
                                $('#otherField2').addClass('required', '');
                                $('#otherField2').addClass('data-error', 'This field is required.');
                                $('#otherField3').addClass('required', '');
                                $('#otherField3').addClass('data-error', 'This field is required.');
                                $('#otherField4').addClass('required', '');
                                $('#otherField4').addClass('data-error', 'This field is required.');
                                $('#otherField5').addClass('required', '');
                                $('#otherField5').addClass('data-error', 'This field is required.');
                            } else {
                                $('#otherFieldDiv').addClass('d-none');
                                $('#otherField1').removeClass('required');
                                $('#otherField1').removeClass('data-error');
                                $('#otherField2').removeClass('required');
                                $('#otherField2').removeClass('data-error');
                                $('#otherField3').removeClass('required');
                                $('#otherField3').removeClass('data-error');
                                $('#otherField4').removeClass('required');
                                $('#otherField4').removeClass('data-error');
                                $('#otherField5').removeClass('required');
                                $('#otherField5').removeClass('data-error');
                            }





                        }
                    });



                })

                $(document).on('click', '.add-country', function() {
    const countryCount = $('table thead tr th').length;
    $('table thead tr').append(`<th>Country ${countryCount}</th>`);
    $('table tbody tr').each(function() {
        $(this).append('<td><input type="text" value="0"></td>');
    });
});
            </script>
             <script>
                $(document).on('click', '#next', function() {
                    var rfq = $('#rfqno').val();
                    var client_advance = $('#client_advance').val();
                    var client_id = $('#client_id').val()
                    $('#header-title').addClass('d-none');
                    $('#operation-title').removeClass('d-none');
                    $('#operation_rfq_no').val(rfq);
                    $('#operation_client_advance').val(client_advance);
                    $('#opertion_client_id').val(client_id)
                })
    
            </script>


            <script>
                $(document).ready(function() {
                    $("#register").validate({
                        rules: {
                            project_no: {
                                required: true
                            },
                            purchase_order_no: {
                                required: true
                            },
                            respondent_incentives: {
                                required: true,
                            },
                            project_manager_name: {
                                required: true
                            },
                            project_operation_head: {
                                required: true
                            },
                            quality_analyst_name: {
                                required: true
                            },
                            project_deliverable: {
                                required: true,
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
                            // project_comment:{
                            //     required: true
                            // },
                            "other_document[]": {
                                required: true
                            },
                            "respondent_type[]": {
                                required: true
                            }
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
                                url: "{{ route('operationNew.store') }}",
                                data: data,
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                processData: false,
                                contentType: false,
                                dataType: "json",
                                beforeSend: function () {
                        // Disable the submit button and show the loader inside it
                                $('#addRegisterButton')
                                    .prop('disabled', true)
                                    .html('<span class="spinner-border spinner-border-sm"></span> Submitting...');
                                },
                                success: function(data) {
                                    $('#addRegisterButton')
                                    .prop('disabled', false)
                                    .html('Submit');

                                    if (data.success == 1) {
                                        swal({
                                            title: 'Success',
                                            text: 'New Project Added Successfully',
                                            icon: 'success',
                                            button: false
                                        })
                                        $('#register').get(0).reset()
                                        // $('.rfq-sub').trigger('click');
                                        window.location = "{{ route('operationNew.index') }}";
                                        // flash({ msg: data.message, type: 'success' });

                                    }
                                    if (data.success == 0) {
                                        swal({
                                            title: 'Please Fill All Fields',
                                            icon: "warning",
                                            button: false
                                        })
                                    } else {


                                    }
                                }

                            });
                        }
                    });
                })
            </script>
            <script>
$(document).ready(function () {

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
                  
    // Add new country functionality
    $('#addBtn').on('click', function () {
        // Get the last row's data-count or initialize to -1 if no rows exist
        var lastRow = $('.operation_target').last();
        var count = lastRow.length ? parseInt(lastRow.attr('data-count')) + 1 : 0;
        let td_length = $('#mtables .operation_target:first').find('td').length;
        // Construct the new row
        var html = `
        <tr class="operation_target" data-count="${count}">
            <td>
                <select class="form-control label-gray-3" name="country_name_0[${count}]" required>
                    <option value="">Select Country</option>
                    @if (count($country) > 0)
                    @foreach ($country as $value)
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

    // Remove country functionality
    $(document).on('click', '.removeBtn', function () {
        $(this).closest('tr').remove();
        calculateTotals();
    });

    $(document).on('input', '.operation_target input[type="text"]', function () {
        calculateTotals();
    });

    var totalRowHtml = `
    <tr id="totalRow">
        <td><b>Total</b></td>
        <td class="total"><input type="text" name="total[]" value=""></td>
        <td class="total"><input type="text" name="total[]" value=""></td>
        <td class="total"><input type="text" name="total[]" value=""></td>
        <td class="total"><input type="text" name="total[]" value=""></td>
        <td class="total"><input type="text" name="total[]" value=""></td>
        <td class="total"><input type="text" name="total[]" value=""></td>
        <td class="total"><input type="text" name="total[]" value=""></td>
        <td class="total"><input type="text" name="total[]" value=""></td>
        <td class="total"><input type="text" name="total[]" value=""></td>
        <td class="total"><input type="text" name="total[]" value=""></td>
        <td class="total"><input type="text" name="total[]" value=""></td>
        <td class="total"><input type="text" name="total[]" value=""></td>

        
    </tr>`;
    $('#mtables tbody').append(totalRowHtml);


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
                $(this).append(`<td class="total remove-group-${j}"><input type="text" name="total[]" value="0"></td><td class="total remove-group-${j}"><input type="text" name="total[]" value="0"></td>`)
            }else if (key == 2){
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

        // Append the new row to the table  
    })
    $(document).on('click', '.remove-group', function () {
        let i = $(this).attr('data-count');
        $(`.remove-group-${i}`).remove();
        calculateTotals();
    });
});



                $(document).on('click', '.add', function() {
                    var data_id = parseInt($(this).attr('data-id'));
                    $("#other_document").append(
                        `<div class="d-flex"><input type="file" style="width:100%;" name="other_document[${data_id}]" class="mt-1 form-control"><i class="fa-solid fa-circle-minus minus" style="color:red;"></i> </div>`
                    );
                    $('.add').attr('data-id', `${data_id+1}`);
                });


                $(document).on('click', '.minus', function() {
                    // alert("hi");
                    $(this).parent().remove();
                });

                $(document).on('click', '.add-respondent-type', function() {
                var data_id = parseInt($(this).attr('data-id'));
                $("#respondent_type_wrapper").append(`
                    <div class="d-flex mt-2">
                        <input type="text" name="respondent_type[${data_id}]" class="form-control" placeholder="Enter Respondent Type">
                        <i class="fa-solid fa-circle-minus remove-respondent-type ml-2" style="color:red; cursor:pointer;"></i>
                    </div>
                `);
                $('.add-respondent-type').attr('data-id', `${data_id + 1}`);
            });

            // Remove respondent type input
            $(document).on('click', '.remove-respondent-type', function() {
                $(this).parent().remove();
            });
                            
            </script>
        @endsection

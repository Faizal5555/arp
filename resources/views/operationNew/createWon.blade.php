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
        padding-left: 20px;
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
    

    /*for notification*/
</style>

@section('page_title', 'WonProject Form')

@section('content')


    {{-- won project --}}
    <div class="container-fluid">
        <!--/*for notification*/-->
        <br>
        <div id="won_noti">
            <div class="container col-md-11 d-flex justify-content-end">
                <div class="dropdown">
                    <a class="nav-link " href="#"><i class="fas fa-bell fa-lg"></i><span
                            class="badge">{{ $notificationCount }}</span></a>
                    <div class="dropdown-content " style="width: 200px;margin-left:-100px">
                        <div class="btnn">
                            @if ($notificationCount > 0)
                                <h6 class="text-center" style="color:rgb(183,110,255)"><button class="btn1"
                                        style="all:unset">{{ $notificationCount }} New Won Project</button></h6>
                            @endif
                            <div class="dropdown-content-two" id="ui-notification">
                                <ul class="nav flex-column sub-menu1">
                                    @if (count($notification) > 0)
                                        @foreach ($notification as $value)
                                            <li class="text-center notify-won" data-win="{{ $value->rfq_no }}">
                                                {{ $value->rfq_no }}</li>
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
                                                    @if (auth()->user()->user_type == "admin" && !in_array($value->rfq_no, $rfq))
                                                        <option value="{{ $value->rfq_no }}">{{ $value->rfq_no }}</option>
                                                    @elseif (auth()->user()->user_role == "project_manager" )
                                                        <option value="{{ $value->rfq_no }}">{{ $value->rfq_no }}</option>
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
                                        <input type="hidden" name="id" id="id" value="">
                                        <input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount">

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">RFQ No <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input name="rfq_no" value="" id="rfqno" readonly="readonly"
                                                        type="text" class="form-control rfqno"
                                                        placeholder="{{ $value->rfq_no }}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">Date<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input name="date" value="" id="date" type="date"
                                                        class="form-control" placeholder="Date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">Industry<span
                                                        class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    {{-- <input name="industry" value="" id="industry"
                                                  type="text" class="form-control" placeholder="Industry"> --}}
                                                    <select class="form-control label-gray-3" id="industry"
                                                        name="industry">
                                                        <option class="label-gray-3" value="" disabled selected>Select
                                                            Industry</option>
                                                        <option value="Manufacturing Industry">Manufacturing Industry
                                                        </option>
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
                                                        <option value="Teritiary Sector Industry">Teritiary Sector Industry
                                                        </option>
                                                        <option value="Real Estate Industry">Real Estate Industry</option>
                                                        <option value="Financial Services Industry">Financial Services
                                                            Industry</option>
                                                        <option value="Telecommunications Industry">Telecommunications
                                                            Industry</option>
                                                        <option value="Distribution Industry">Distribution Industry
                                                        </option>
                                                        <option value="Medical Device Industry">Medical Device Industry
                                                        </option>
                                                        <option value="Biotechnology Industry">Biotechnology Industry
                                                        </option>
                                                        <option value="Aviation Industry">Aviation Industry</option>
                                                        <option value="Insurance Industry">Insurance Industry</option>
                                                        <option value="Trade Industry">Trade Industry</option>
                                                        <option value="Stock Market Industry">Stock Market Industry
                                                        </option>
                                                        <option value="Electronics Industry">Electronics Industry</option>
                                                        <option value="Textile Industry">Textile Industry</option>
                                                        <option value="Computers and Information Technology Industry">
                                                            Computers and Information Technology Industry</option>
                                                        <option value="Market Research Industry">Market Research Industry
                                                        </option>
                                                        <option value="Machine Industry">Machine Industry</option>
                                                        <option value="Recycling Industry">Recycling Industry</option>
                                                        <option value="Information and Communication Technology Industry">
                                                            Information and Communication Technology Industry</option>
                                                        <option value="E- Commerce Industry">E- Commerce Industry</option>
                                                        <option value="Research Industry">Research Industry</option>
                                                        <option value="Rail Transport Industry">Rail Transport Industry
                                                        </option>
                                                        <option value="Food Processing Industry">Food Processing Industry
                                                        </option>
                                                        <option value="Small Business Industry">Small Business Industry
                                                        </option>
                                                        <option value="Wholesale Industry">Wholesale Industry</option>
                                                        <option value="Pulp and Paper Industry">Pulp and Paper Industry
                                                        </option>
                                                        <option value="Vehicle Industry">Vehicle Industry</option>
                                                        <option value="Steel Industry">Steel Industry</option>
                                                        <option value="Renewable Energy Industry">Renewable Energy Industry
                                                        </option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">Follow Up
                                                    Date<span class="text-danger">*</span></label>
                                                <div class="col-lg-9">

                                                    <input name="follow_up_date" value="" id="follow_up_date"
                                                        type="date" class="form-control" placeholder="Follow Up date">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">Choose
                                                    Currency<span class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    {{-- <input name="currency" value="" id="currency"
                                                    type="text" class="form-control" placeholder="currency"> --}}
                                                    <select class="form-control label-gray-3" name="currency"
                                                        id="currency">
                                                        <option class="label-gray-3" value="" disabled selected>
                                                            Select Currency</option>
                                                        <option value="₹">INR</option>
                                                        <option value="$">USD</option>
                                                        <option value="€">Euro</option>
                                                        <option value="£">Pound</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 table-responsive" style="overflow-x:auto;">
                                            <div class="form-group row">
                                                <button class="mb-4 ml-2 btn btn-success btn-country" type="button">Add
                                                    country</button>


                                                <div class="col-lg-12 edit-table-bid d-flex">
                                                    <table id="mtable" class="table">
                                                        <?php
                                                        $arr = json_decode($bidrfq[0]->sample_size, true);
                                                        $setup_cost = json_decode($bidrfq[0]->setup_cost, true);
                                                        $recruitment = json_decode($bidrfq[0]->recruitment, true);
                                                        $incentives = json_decode($bidrfq[0]->incentives, true);
                                                        $moderation = json_decode($bidrfq[0]->moderation, true);
                                                        $transcript = json_decode($bidrfq[0]->transcript);
                                                        $others = json_decode($bidrfq[0]->others);
                                                        $world = json_decode($bidrfq[0]->country);
                                                        $total_cost = json_decode($bidrfq[0]->total_cost);
                                                        $client_id = json_decode($bidrfq[0]->client_id);
                                                        $vendor_id = json_decode($bidrfq[0]->vendor_id);
                                                        ?>
                                                        <tr id="remove_country_row">
                                                            {{-- <th><th> --}}
                                                            @if (!is_null($world))
                                                                @foreach ($world as $kv => $value)
                                                                    @if (!is_null($value))
                                                                        @foreach ($value as $data)
                                                                        <th class="country_remove_{{$kv}}_13">
                                                                            <button class="mb-4 ml-2 btn btn-danger remove-country"  data-remove="{{$kv}}" type="button">
                                                                                               <i class="fa-solid fa-xmark"></i> 
                                                                           </button>     
                                                                           </th>
                                                                            @if (!is_null($vendor_id))
                                                                                @foreach ($vendor_id as $k1 => $v1)
                                                                                    @if (!is_null($v1))
                                                                                        @foreach ($v1 as $k => $data)
                                                                                            @if ($kv == $k1)
                                                                                                <th
                                                                                                    class="country_remove_{{ $kv }}_12 abcversion_{{ $kv }}_11">
                                                                                                </th>
                                                                                            @endif
                                                                                        @endforeach
                                                                                    @endif
                                                                                @endforeach
                                                                            @endif
                                                                        @endforeach
                                                                    @endif
                                                                @endforeach
                                                            @endif

                                                        </tr>

                                                        <tr id="world_row">

                                                        </tr>

                                                        <tr id="vendor_row">

                                                        </tr>

                                                        <tr id="sample_row">

                                                        </tr>
                                                        <tr id="setup_row">

                                                        </tr>
                                                        <tr id="recruitment_row">

                                                        </tr>
                                                        <tr id="incentives_row">

                                                        </tr>
                                                        <tr id="moderation_row">

                                                        </tr>
                                                        <tr id="transcript_row">

                                                        </tr>
                                                        <tr id="others_row">

                                                        </tr>
                                                        <tr id="totalCost_row">

                                                        </tr>
                                                    </table><br>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 d-flex align-items-center justify-content-center">
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
                                            $vendor_id = explode(',', $wonproject[0]->vendor_id);
                                            $vendor_advance = explode(',', $wonproject[0]->vendor_advance);
                                            $vendor_balance = explode(',', $wonproject[0]->vendor_balance);
                                            $vendor_total = explode(',', $wonproject[0]->vendor_total);
                                            $vendor_contract = explode(',', $wonproject[0]->vendor_contract);
                                            ?>
                                            {{-- {{dd($vendor_id)}} --}}
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
                                                                        href="{{ url($value4) }}">{{ $value4 }}</a>
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
                                                    <input name="project_no" value="{{ $project_no }}" type="text"
                                                        class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label class="col-lg-3 col-form-label font-weight-semibold">PO Number <span
                                                        class="text-danger">*</span></label>
                                                <div class="col-lg-9">
                                                    <input name="purchase_order_no" value="{{ $purchase_order_no }}"
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
                                        <div class="col-md-6">
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
                                        <div class="col-md-6">
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
                                        <div class="col-md-12 ">
                                            <div class="form-group row">
                                                <label class="col-lg-12 col-form-label font-weight-semibold">Target
                                                    Table<span class="text-danger">*</span></label>
                                                <button class="ml-2 btn btn-danger" style="float: right;"id="addBtn"
                                                    data-count="0" type="button">
                                                    Add New Country
                                                </button>
                                                <div class="col-md-12 table-responsive" style="overflow-x:auto;">

                                                    {{-- <button class="ml-2 btn btn-danger" class="removeBtn" type="button">
                                            remove Industry
                                        </button> --}}
                                                    <table border="1" name="" id="mtables">
                                                        <tr>
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
                            var sampleSize = JSON.parse(data.bidrfq.sample_size);
                            // console.log(sampleSize);
                            var setupCost = JSON.parse(data.bidrfq.setup_cost);
                            var recruitment = JSON.parse(data.bidrfq.recruitment);
                            var incentives = JSON.parse(data.bidrfq.incentives);
                            var moderation = JSON.parse(data.bidrfq.moderation);
                            var transcript = JSON.parse(data.bidrfq.transcript);
                            var others = JSON.parse(data.bidrfq.others);
                            var world = JSON.parse(data.bidrfq.country);
                            var totalCost = JSON.parse(data.bidrfq.total_cost);
                            var client_id = JSON.parse(data.bidrfq.client_id);
                            var vendor_id = JSON.parse(data.bidrfq.vendor_id);
                            console.log("user", user);
                            let worldHtml = '<th>Country</th>';
                            let removeHtml = `<th><th>`;

                                if (world.length != 0) {
                                    $.each(world, function (kv, value) {
                                        if (value != null) {
                                            $.each(value, function (dataIndex, data) {
                                                worldHtml += '<th class="data-country country_remove_' + kv + '">';
                                                worldHtml += '<label class="form-group has-float-label">';
                                                worldHtml +=
                                                    '<select class="form-control label-gray-3" name="country_0[' +
                                                    kv + '][]">';
                                                worldHtml += '<option class="label-gray-3" value="' + data + '">' + data + '</option>';
                                                if(kv == 0)
                                                {
                                                    removeHtml += `<th class="remove-country-${kv}"></th>`;
                                                }else{
                                                    removeHtml += `<th class="remove-country-${kv}"><button class="mb-4 ml-2 btn btn-danger remove-country"  data-remove="${kv}" type="button">
                                                                                        <i class="fa-solid fa-xmark"></i>
                                                                    </button></th>`;
                                                }
                                                removeHtml += `<th class="remove-country-${kv}"></th>`;
                                                // Loop through countries passed from Blade
                                                var countries = <?php echo json_encode($country); ?>;
                                                if (countries.length > 0) {
                                                    $.each(countries, function (index, country) {
                                                        worldHtml += '<option value="' + country.name + '"';
                                                        if (data === country.name) {
                                                            worldHtml += ' selected';
                                                        }
                                                        worldHtml += '>' + country.name + '</option>';
                                                    });
                                                }

                                                worldHtml += '</select>';
                                                worldHtml += '<span>Country</span>';

                                                // Append Add Vendor and Remove Country buttons only once per country
                                                // worldHtml += '<td class="country_remove_' + kv + '_11"></td>';
                                                worldHtml +=
                                                    '<th class="abcversion_' +
                                                    kv +
                                                    '_coun country_remove_' +
                                                    kv +
                                                    '_10">';
                                                worldHtml +=
                                                    '<button class="float-left ml-2 btn btn-success addvendor" data-button="' +
                                                    kv +
                                                    '" type="button">Add vendor</button>';
                                                worldHtml +=
                                                    '<button class="mb-4 ml-2 btn btn-danger btn-remove" data-remove="' +
                                                    kv +
                                                    '" type="button"><i class="fa-solid fa-xmark"></i></button>';
                                                worldHtml += '</th>';
                                                worldHtml += '</label>';
                                                worldHtml += '</th>';
                                            });
                                        }
                                    });
                                }

                            // Render the final HTML
                            $('#remove_country_row').html(removeHtml);
                            $('#world_row').html(worldHtml);



                            let vendorRowHtml = '<tr>';

                            vendorRowHtml += '<td>Client Name/Vendor Name</td>';

                            client_id.forEach((value, key) => {
                                value.forEach((data) => {
                                    vendorRowHtml += `<td class="country_remove_${key}_1">`;
                                    vendorRowHtml +=
                                        '<label class="form-group has-float-label">';
                                    vendorRowHtml +=
                                        `<select class="form-control label-gray-3" name="client_id_0[${key}][]">`;
                                    vendorRowHtml +=
                                        `<option class="label-gray-3" value="${data}">Client</option>`;

                                    // Loop through the client data passed from Blade using JavaScript
                                    const clientData = <?= json_encode($client) ?>;
                                    if (clientData.length > 0) {
                                        $.each(clientData, function(index, clientItem) {
                                            vendorRowHtml += '<option value="' +
                                                clientItem.client_name + '"';
                                            if (data === clientItem
                                                .client_name) {
                                                vendorRowHtml += ' selected';
                                            }
                                            vendorRowHtml += '>' + clientItem
                                                .client_name + '</option>';
                                        });
                                    }

                                    vendorRowHtml += '</select>';
                                    vendorRowHtml += '<span>Client Name</span>';
                                    vendorRowHtml += '</label>';
                                    vendorRowHtml += '</td>';
                                });

                                vendor_id[key].forEach((data) => {
                                    vendorRowHtml +=
                                        `<td class="abcversion_${key} country_remove_${key}_2" data-arr="${key}">`;
                                    vendorRowHtml +=
                                        '<label class="form-group has-float-label">';
                                    vendorRowHtml +=
                                        `<select class="form-control label-gray-3" name="vendor_id_0[${key}][]">`;
                                    vendorRowHtml +=
                                        `<option class="label-gray-3" value="${data}">Vendor</option>`;

                                    const vendorData = <?= json_encode($vendor) ?>;
                                    if (vendorData.length > 0) {
                                        $.each(vendorData, function(index, vendorItem) {
                                            vendorRowHtml += '<option value="' +
                                                vendorItem.vendor_name + '"';
                                            if (data === vendorItem
                                                .vendor_name) {
                                                vendorRowHtml += ' selected';
                                            }
                                            vendorRowHtml += '>' + vendorItem
                                                .vendor_name + '</option>';
                                        });
                                    }

                                    vendorRowHtml += '</select>';
                                    vendorRowHtml += '<span>Vendor Name</span>';
                                    vendorRowHtml += '</label>';
                                    vendorRowHtml += '</td>';
                                });
                            });

                            vendorRowHtml += '</tr>';

                            $('#vendor_row').replaceWith(vendorRowHtml);



                            var sampleSizeHtml = '<td>Sample Size</td>';
                            var i = 2;

                            $.each(sampleSize, function(outerIndex, outerArray) {
                                $.each(outerArray, function(innerIndex, value) {
                                    sampleSizeHtml += '<td class="abcversion_' + outerIndex +
                                        '_1 my-samplesize country_remove_' + outerIndex +
                                        '_3" data-id="' + (i++) + '">';
                                    sampleSizeHtml +=
                                        '<input type="number" class="border-0" value="' +
                                        parseInt(value, 10) + '" name="sample_size_0[' +
                                        outerIndex + '][]">';
                                    sampleSizeHtml += '</td>';
                                });
                            });

                            $('#sample_row').html(sampleSizeHtml);

                            var setupCostHtml = '<td>Setup Cost</td>';
                            var i = 2;
                            $.each(setupCost, function(key, value) {
                                $.each(value, function(k, data) {
                                    setupCostHtml += '<td class="table_version abcversion_' +
                                        key + '_2 country_remove_' + key + '_3" data-id="' + (
                                            i++) + '" data-cal="' + k + '" data-culation="' +
                                        key + '">';
                                    setupCostHtml += '<input type="number" class="cal_' + key +
                                        '_' + k + '" value="' + data + '" name="setup_cost_0[' +
                                        key + '][]">';
                                    setupCostHtml += '</td>';
                                });
                            });

                            $('#setup_row').html(setupCostHtml);


                            var RecruitmentHtml = '<td>recruitment</td>';
                            var i = 2;
                            $.each(recruitment, function(key, value) {
                                $.each(value, function(k, data) {
                                    RecruitmentHtml += '<td class="table_version abcversion_' +
                                        key + '_3 country_remove_' + key + '_3" data-id="' + (
                                            i++) + '" data-cal="' + k + '" data-culation="' +
                                        key + '">';
                                    RecruitmentHtml += '<input type="number" class="cal_' +
                                        key + '_' + k + '" value="' + data +
                                        '" name="recruitment_0[' + key + '][]">';
                                    RecruitmentHtml += '</td>';
                                });
                            });

                            $('#recruitment_row').html(RecruitmentHtml);


                            var IncentivesHtml = '<td>Incentives</td>';
                            var i = 2;
                            $.each(incentives, function(key, value) {
                                $.each(value, function(k, data) {
                                    IncentivesHtml += '<td class="table_version abcversion_' +
                                        key + '_4 country_remove_' + key + '_3" data-id="' + (
                                            i++) + '" data-cal="' + k + '" data-culation="' +
                                        key + '">';
                                    IncentivesHtml += '<input type="number" class="cal_' + key +
                                        '_' + k + '" value="' + data + '" name="incentives_0[' +
                                        key + '][]">';
                                    IncentivesHtml += '</td>';
                                });
                            });

                            $('#incentives_row').html(IncentivesHtml);


                            var ModerationHtml = '<td>Moderation</td>';
                            var i = 2;
                            $.each(moderation, function(key, value) {
                                $.each(value, function(k, data) {
                                    ModerationHtml += '<td class="table_version abcversion_' +
                                        key + '_5 country_remove_' + key + '_3" data-id="' + (
                                            i++) + '" data-cal="' + k + '" data-culation="' +
                                        key + '">';
                                    ModerationHtml += '<input type="number" class="cal_' + key +
                                        '_' + k + '" value="' + data + '" name="moderation_0[' +
                                        key + '][]">';
                                    ModerationHtml += '</td>';
                                });
                            });

                            $('#moderation_row').html(ModerationHtml);

                            var TranscriptHtml = '<td>Transcript</td>';
                            var i = 2;
                            $.each(transcript, function(key, value) {
                                $.each(value, function(k, data) {
                                    TranscriptHtml += '<td class="table_version abcversion_' +
                                        key + '_6 country_remove_' + key + '_3" data-id="' + (
                                            i++) + '" data-cal="' + k + '" data-culation="' +
                                        key + '">';
                                    TranscriptHtml += '<input type="number" class="cal_' + key +
                                        '_' + k + '" value="' + data + '" name="transcript_0[' +
                                        key + '][]">';
                                    TranscriptHtml += '</td>';
                                });
                            });

                            $('#transcript_row').html(TranscriptHtml);



                            var OtherstHtml = '<td>Others</td>';

                            var i = 2;
                            $.each(others, function(key, value) {
                                $.each(value, function(k, data) {
                                    OtherstHtml += '<td class="table_version abcversion_' +
                                        key + '_7 country_remove_' + key + '_3" data-id="' + (
                                            i++) + '" data-cal="' + k + '" data-culation="' +
                                        key + '">';
                                    OtherstHtml += '<input type="number" class="cal_' + key +
                                        '_' + k + '" value="' + data + '" name="others_0[' +
                                        key + '][]">';
                                    OtherstHtml += '</td>';
                                });
                            });

                            $('#others_row').html(OtherstHtml);


                            var totalCostHtml = '<td>totalCost</td>';

                            var i = 2;
                            $.each(totalCost, function(key, value) {
                                $.each(value, function(k, data) {
                                    totalCostHtml += '<td class="table_version abcversion_' +
                                        key + '_8 country_remove_' + key + '_3" data-id="' + (
                                            i++) + '" data-cal="' + k + '" data-culation="' +
                                        key + '">';
                                    totalCostHtml += '<input type="number" class="total_cost_' +
                                        key + '_' + k + '" value="' + data +
                                        '" name="total_cost_0[' + key + '][]">';
                                    totalCostHtml += '</td>';
                                });
                            });

                            $('#totalCost_row').html(totalCostHtml);


                            $("#id").val(data.bidrfq.id);
                            $(".rfqno").val(data.bidrfq.rfqno);
                            $("#date").val(data.bidrfq.date);
                            $("#industry").val(data.bidrfq.industry);
                            console.log(data.bidrfq.industry);
                            $("#follow_up_date").val(data.bidrfq.follow_up_date);
                            $("#currency").val(data.bidrfq.currency);
                            $(".user").val(data.user.name);

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
                                    '<div class="col-md-6"><div class="form-group row"> <label id="otherField16" class="col-lg-3 col-form-label font-weight-semibold">Attach Vendor Contract / Email<span class="text-danger">*</span></label><div class="col-lg-9" id="vendor_contract1"><a target="_blank" download href="../../' +
                                    vendor_contract[i] + '">"' + vendor_contract[i] +
                                    '"</a></div></div></div><div class="col-md-6"></div>');
                            });


                            // $("#vendor_advance").val(data.bidrfq.vendor_advance);
                            // $("#vendor_balance").val(data.bidrfq.vendor_balance);
                            $("#client_contract_attachment").html(
                                `<a target="_blank" download href="adminapp/public/${data.bidrfq.client_contract}" style=" text-decoration: none !important;">adminapp/public/${data.bidrfq.client_contract}</a>`
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
                                $("input[name=rfq_ no]").val(id);

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
                                <button class="float-left btn btn-success addvendor" data-button="${rar}" data-count="0"   type="button">
                                        Add vendor
                                    </button>
                                    
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
                            $(".rfqno").val(data.wonProject.rfq_no);
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
                            $("#client_advance").val(data.wonProject.client_advance);
                            $("#client_balance").val(data.wonProject.client_balance);
                            $(".user").val(data.user3.name);
                            console.log(data.wonProject.vendor_id);
                            $.each(data.wonProject.vendor_id.split(','), function(i, v) {

                                $("#vendor_advance1").append(
                                    '<div class="col-md-6"><div class="form-group row"><div class="col-md-3"><label id="otherField13" >Vendor Name<spanclass="text-danger">*</span></label></div><div class="col-lg-9" ></label><input name="vendor_name" value="' +
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


                            // $("#vendor_advance").val(data.wonProject.vendor_advance);
                            // $("#vendor_balance").val(data.wonProject.vendor_balance);
                            $("#client_contract_attachment").html(
                                `<a target="_blank" download href="adminapp/public/${data.wonProject.client_contract}" style=" text-decoration: none !important;">adminapp/public/${data.wonProject.client_contract}</a>`
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


                            $("input[name=rfq_ no]").val(id);


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
                                    '<div class="col-md-6"><div class="form-group row"> <label id="otherField16" class="col-lg-3 col-form-label font-weight-semibold">Attach Vendor Contract / Email<span class="text-danger">*</span></label><div class="col-lg-9" id="vendor_contract1"><a target="_blank" download href="' +
                                    vendor_contract[i] + '">"' + vendor_contract[i] +
                                    '"</a></div></div></div><div class="col-md-6"></div>');
                            });




                            $("#client_contract_attachment").html(
                                `<a target="_blank" download href="adminapp/public/${data.wonProject.client_contract}" style=" text-decoration: none !important;">adminapp/public/${data.wonProject.client_contract}</a>`
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
                            "other_document[]": {
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
                                url: "{{ route('operationNew.store') }}",
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
    // Add new country functionality
    $('#addBtn').on('click', function () {
        // Get the last row's data-count or initialize to -1 if no rows exist
        var lastRow = $('.operation_target').last();
        var count = lastRow.length ? parseInt(lastRow.attr('data-count')) + 1 : 0;

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
            <td>
                <button type="button" class="ml-2 btn btn-danger removeBtn">Remove</button>
            </td>
        </tr>`;

        // Append the new row to the table
        $('#mtables').append(html);
    });

    // Remove country functionality
    $(document).on('click', '.removeBtn', function () {
        $(this).closest('tr').remove();
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
                
            </script>
        @endsection

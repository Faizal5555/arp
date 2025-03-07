<!DOCTYPE html>
<html lang="en">
<style>
    img {
        width: 30%;
        float: right;
    }

    body {
        font-family: Arial, sans-serif;
    }

    h3,
    h4 {
        color: #0b5dbb;
    }

    .table th,
    .table td {
        text-align: center;
    }

    .company-header {
        font-weight: bold;
        color: red;
    }

    .subtitle {
        color: #0b5dbb;
        font-weight: bold;
    }

    .rfq-table th,
    .rfq-table td {
        font-size: 15px;
        padding-bottom: 10px;
    }

    .rfq-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .rfq-details {
        font-weight: bold;
    }

    .table-bordered td,
    .table-bordered th {
        border: 1px solid #dee2e6;
        padding-left: 33px;
        padding-right: 23px;
        padding-top: 10px;
        padding-bottom: 10px;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .header-container img {
        width: 150px;
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

    .table-bordered td,
    .table-bordered th {
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

    .add-other,
    .remove-other,
    .multiple_country_other,
    .remove_multiple_country,
    .interview_depth_other,
    .remove_interview_depth,
    .remove_online_community,
    .online_community_other {
        position: relative;
        left: -3px;

    }

    .relative {
        position: relative;
    }

    .remove-column {
        position: absolute;
        top: -25px;
        right: -10px;
    }

    .removeMultipleCountry {
        position: absolute;
        top: -25px;
        right: -10px;
    }

    .removeInterviewDepth {
        position: absolute;
        top: -25px;
        right: -10px;
    }

    .removeOnlineCommunity {
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
        color: white;


    }

    /* Dropdowns - Green Border */
    #costingTable select.form-control {
        /* border: 2px solid green; */
        border-radius: 5px;

    }

    /* "Total Cost" row - Different Color */
    #costingTable tr:last-child td,
    #MultipleCountry tr:last-child td,
    #InterviewDepth tr:last-child td,
    #OnlineCommunity tr:last-child td {
        /* background-color: ; Yellow background for emphasis */
        font-weight: bold;
        color: black;
    }


    /* Button Styling */
    .add-other,
    .multiple_country_other,
    .interview_depth_other,
    .online_community_other {
        background-color: white;
        border: none;
        /* color: green !important; */
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 50%;
    }

    .add-other:hover,
    .multiple_country_other:hover,
    .interview_depth_other:hover,
    .online_community_other:hover {
        background-color: white;
    }

    .static-field {
        /* background-color: white; */
        color: black;
        font-weight: bold;
        padding: 10px;
    }

    #MultipleCountry,
    #InterviewDepth,
    #OnlineCommunity,
    #costingTable {
        border: 1px solid black;
        /* background-color:#28a745; */
        border-radius: 5px;
        color: white;


    }

    #MultipleCountry select.form-control,
    #InterviewDepth select.form-control,
    #OnlineCommunity select.form-control {
        /* border: 1px solid green; */
        border-radius: 5px;

    }

    .form-control::placeholder {
        color: #155724;
        opacity: 0.7;
    }

    .total-cost {
        /* background-color: white !important; */
        color: black;
        font-weight: bold;
        text-align: center;
    }

    .total-value {
        background-color: #f8f9fa;
        /* Light gray for totals */
        font-weight: bold;
        text-align: center;
    }

    #costingTable,
    #MultipleCountry,
    #InterviewDepth,
    #OnlineCommunity {
        table-layout: fixed;
        /* Ensures uniform column width */
        width: 100%;
        border-collapse: collapse;
        /* Ensures no extra spacing */
        margin-top: 30px;
    }


    #costingTable td {
        width: 200px !important;
        /* Set your desired width */
        word-wrap: break-word;
        /* Ensures text breaks properly */
        text-align: center;
        /* Align text in the center */
        padding: 5px;
        /* Optional: Add spacing */
        border: 1px solid black;
    }

    #MultipleCountry td {
        width: 200px !important;
        /* Set your desired width */
        word-wrap: break-word;
        /* Ensures text breaks properly */
        text-align: center;
        /* Align text in the center */
        padding: 5px;
        /* Optional: Add spacing */
        border: 1px solid black;
    }

    #interview-depth td {
        width: 200px !important;
        /* Set your desired width */
        word-wrap: break-word;
        /* Ensures text breaks properly */
        text-align: center;
        /* Align text in the center */
        padding: 5px;
        /* Optional: Add spacing */
        border: 1px solid black;
    }

    #OnlineCommunity td {
        width: 200px !important;
        /* Set your desired width */
        word-wrap: break-word;
        /* Ensures text breaks properly */
        text-align: center;
        /* Align text in the center */
        padding: 5px;
        /* Optional: Add spacing */
        border: 1px solid black;
    }

    .label-gray-3 {
        width: 240px !important;
    }

    button#addRegisterButton {
        background-color: #0b5dbb;
        border-color: #0b5dbb;
    }

    button#addRegisterButton:hover {
        background-color: #0b5dbb;
        border-color: #0b5dbb;

    }

    .viewer {
        color: black;
    }


.watermark {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url("{{ $logo }}") no-repeat center !important;
    background-size: 50%; /* Adjust watermark size */
    background-repeat: no-repeat !important; /* Prevent multiple watermarks */
    opacity:0.25; /* Lighter transparency */
    z-index: -1; /* Behind the text */
}

.content {
    position: relative;
    z-index: 1;
    width: 100%;
    background: transparent !important; /* Remove white background */
}
   .title{
    color: black !important;
    font-size:14px;
    font-weight: bold;
   }   


</style>

<body>
    <div class="watermark">
    </div>
        <div class="container mt-4 content" style="width: 100% !imporant;">
            <div class="header-container">
                <div>
                    <p class="company-header">ASIA Research Partners LLP</p>
                    <p class="subtitle">Accurate Solutions & Insightful Analysis</p>
                </div>
                <img src="{{$logo}}" alt="Company Logo" style="margin-top:-85px">
            </div>
            <br>


            <table style="width: 100% !important; border-collapse: collapse;">
                <tr>
                    <td style="width: 50%; text-align: left;"><strong>RFQ No:</strong> {{ $newrfq->rfq_no }}</td>
                    <td style="width: 50%;"><strong>Date:</strong> {{ $newrfq->date }} </td>
                </tr>
            </table>
            <br>
          

            <!-- ARP Sales Manager Name -->

            <!--content-->
            <div class="content" style="width:100% !important;">
            <h3>Dear Client,</h3>
            <p style="font-family: DejaVu Sans;">We thank you for sending us the project specifications. Our operations team has checked feasibility, and
                the project is feasible with us. Below, you will find our costs. If you have any different
                considerations regarding the costs, please do not hesitate to contact us back.</p>
            <p style="font-family: DejaVu Sans;">We have strong panels and use multi-dimension approach for recruitments such as using
                proprietary panels, phone recruitments, social media, LinkedIn, Snowball, Industry contact and
                other ways.</p>
            <p style="font-family: DejaVu Sans;">We have strong experience in this industry and would be happy to send you case studies.</p>
            <p style="font-family: DejaVu Sans;">Also for qualitative research, please note that we only use 10+ years of native moderators
                operating from their respective countries.</p>
            </div>
            <!--End content-->



            <div class="w-100">
                {{-- <div class="container mt-5">
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
        </div> --}}
                <div class="{{ isset($newrfq) && isset($newrfq->single) ? '' : '' }}"
                    style="{{ isset($newrfq) && isset($newrfq->single) ? '' : 'display: none;' }}" id="single-country">
                    <?php
                    if(isset($newrfq) && isset($newrfq->single)){
                        $single_methodology_chunk = json_decode($newrfq->single->single_methodology);
                        $single_methodology = array_chunk($single_methodology_chunk, 3);
                        $single_currency_chunk = json_decode($newrfq->single->single_currency);
                        $single_currency = array_chunk($single_currency_chunk, 3);
                        $single_loi_chunk = json_decode($newrfq->single->single_loi);
                        $single_loi = array_chunk($single_loi_chunk, 3);
                        $single_country_chunk = json_decode($newrfq->single->single_country);
                        $single_country = array_chunk($single_country_chunk, 3);
                        $single_client_chunk = json_decode($newrfq->single->single_client);
                        $single_client = array_chunk($single_client_chunk, 3);
                        $single_sample_chunk = json_decode($newrfq->single->single_sample);
                        $single_sample = array_chunk($single_sample_chunk, 3);
                        $single_fieldwork_chunk = json_decode($newrfq->single->single_fieldwork);
                        $single_fieldwork = array_chunk($single_fieldwork_chunk, 3);
                        $single_other = json_decode($newrfq->single->single_other);
                        // $single_other = array_chunk($single_other_chunk, 3);
                        $single_total_cost_chunk = json_decode($newrfq->single->single_total_cost);
                        $single_total_cost = array_chunk($single_total_cost_chunk, 3);
                    }   
                    ?>
                    @if(isset($newrfq) && isset($newrfq->single))
                     <div class="table-container mt-2">
                @if(count($single_methodology) > 0)
                @foreach ($single_methodology as $j => $online)
                <table class="" id="costingTable">
                    <tbody>
                        <tr>
                            <td class="static-field">Methodology</td>
                            @if(count($single_methodology[$j]) > 0)
                            @foreach($single_methodology[$j] as $key => $methodology)
                                <td class="viewer"> 
                                {{$methodology}}
                                </td>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="static-field remove-other_{{$key - 1}}">Currency</td>
                            @if(count($single_currency[$j]) > 0)
                            @foreach($single_currency[$j] as $currency)
                                <td class="viewer">{{$currency}}</td>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="static-field remove-other_{{$key - 1}}">LOI</td>
                            @if(count($single_loi[$j]) > 0)
                            @foreach($single_loi[$j] as $loi)
                                <td class="viewer">{{$loi}}</td>
                            @endforeach
                            @endif
                        </tr>
                        
                        <tr>
                            <td class="static-field remove-other_{{$key - 1}}">Country</td>
                            @if(count($single_country[$j]) > 0)
                            @foreach($single_country[$j] as $country)
                                <td class="viewer">{{$country}}</td>
                            @endforeach
                            @endif
                        </tr>
                        
                        <tr>
                        <td class="static-field remove-other_{{$key - 1}}">Client</td>
                        @if(count($single_client[$j]) > 0)
                        @foreach($single_client[$j] as $value)
                            <td class="viewer">{{$value}}
                            </td>
                        @endforeach
                        @endif
                        </tr>
                        
                        <tr>
                        <td class="static-field remove-other_{{$key - 1}}">Sample</td>
                        @if(count($single_sample[$j]) > 0)
                        @foreach($single_sample[$j] as $sample)
                            <td class="viewer">{{$sample}}</td>
                        @endforeach
                        @endif
                        </tr>
                        <tr>
                            <td class="static-field remove-other_{{$key - 1}}">Fieldwork CPI</td>
                            @if(count($single_fieldwork[$j]) > 0)
                            @foreach($single_fieldwork[$j] as $fieldwork)
                                <td class="viewer">{{$fieldwork}}
                            @endforeach
                            @endif
                            </td>
                        </tr>
                        
                        @if(count($single_other) > 0)
                        @foreach($single_other as $k => $value)
                        <?php
                            $first_value = array_shift($value);
                            $value = array_chunk($value, 3);    
                        ?>
                        <tr id="otherFields">
                        @if(count($value) > 0)
                        <td class="viewer">
                            {{$first_value}}
                       </td>
                        @foreach($value[$j] as $key => $other)
                        <td class="viewer">
                        {{$other}}
                        </td>
                        @endforeach
                        @endif
                        </tr>
                        @endforeach
                        @endif
                        <tr>
                            <td>Total Cost</td>
                            @if(count($single_total_cost[$j]) > 0)
                            @foreach($single_total_cost[$j] as $total_cost)
                                <td>{{$total_cost}}</td>
                            @endforeach
                            @endif
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @endif
            </div>
                    @endif
                </div>
            </div>


            <div class="container">

                <div class="{{ isset($newrfq) && isset($newrfq->multiple) ? '' : '' }}"
                    style="{{ isset($newrfq) && isset($newrfq->multiple) ? '' : 'display: none;' }}"
                    id="mulitple-country">
                    <?php
            if(isset($newrfq) && isset($newrfq->multiple)){
                $multiple_methodology_chunk = json_decode($newrfq->multiple->multiple_methodology);
                $multiple_methodology = array_chunk($multiple_methodology_chunk,2);
                $multiple_currency_chunk = json_decode($newrfq->multiple->multiple_currency);
                $multiple_currency = array_chunk($multiple_currency_chunk, 2);
                $multiple_loi_chunk = json_decode($newrfq->multiple->multiple_loi);
                $multiple_loi = array_chunk($multiple_loi_chunk, 2);
                $multiple_client_chunk = json_decode($newrfq->multiple->multiple_client);
                $multiple_client = array_chunk($multiple_client_chunk, 2);
                $multiple_countries = json_decode($newrfq->multiple->multiple_countries);
                $multiple_other = json_decode($newrfq->multiple->multiple_other);
                $multiple_total_cost_chunk = json_decode($newrfq->multiple->multiple_total_cost);
                $multiple_total_cost = array_chunk($multiple_total_cost_chunk, 2);
            }   
            ?>

                    @if(isset($newrfq) && isset($newrfq->multiple))
                     <div class="table-container mt-2">
                @if(count($multiple_methodology) > 0)
                @foreach ($multiple_methodology as $j => $multiple)
                <table class="" id="MultipleCountry">
                    <tbody>
                        <tr>
                            <td class="title">Methodology</td>
                            @if(count($multiple_methodology[$j]) > 0)
                                @foreach($multiple_methodology[$j] as $key => $methodology)
                                    <td class="viewer" colspan="3">
                                    <label class="mb-0 label">
                                  {{$methodology}}
                                    </label>
                                @endforeach
                            @endif
                            </td>
                        </tr>
                        <tr>
                        <td class="title relative ">Currency</td>
                            @if(count($multiple_currency[$j]) > 0)
                                @foreach($multiple_currency[$j] as $key => $currency)
                                <td class="editable-field viewer removeMultipleCountry_{{$key - 1}}"  colspan="3">
                                <label class="mb-0 label">
                               {{$currency}}
                                </label>
                                @endforeach
                            @endif
                            </td>
                        </tr>
                        <tr>
                        <td class="title relative ">LOI</td>
                            @if(count($multiple_loi[$j]) > 0)
                            @foreach($multiple_loi[$j] as $key => $loi)
                            <td class="editable-field viewer removeMultipleCountry_{{$key - 1}}"  colspan="3">
                                <label class="mb-0 label">
                              {{$loi}}
                                </label>
                            @endforeach
                            @endif
                            </td>
                        </tr>
                        <tr>
                        <td class="title relative ">Client</td>
                        @if(count($multiple_client[$j]) > 0)
                            @foreach($multiple_client[$j] as $key => $value)
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
                            <td class="title relative ">Countries</td>
                            @if(count($multiple_client[$j]) > 0)
                            @foreach($multiple_client[$j] as $key => $multiple)
                            <td class="static-field removeMultipleCountry_{{$key - 1}}">Sample</td>
                            <td class="static-field removeMultipleCountry_{{$key - 1}}">CPI</td>
                            <td class="static-field removeMultipleCountry_{{$key - 1}}">Total</td>
                            @endforeach
                            @endif
                        </tr>
                        @if(count($multiple_countries) > 0)
                        @foreach ($multiple_countries as $k => $countries)
                        <?php
                        $first_value = array_shift($countries);
                        $countries = array_chunk($countries, 6);    
                        ?>
                        <tr>
                        
                        @if(count($countries[$j]) > 0)
                        <td class="viewer">
                            {{$first_value}}
                        </td>
                        @foreach ($countries[$j] as $key => $country)
                            <td class="viewer">{{$country}}</td>
                        @endforeach
                        @endif
                        </tr>
                        @endforeach
                        @endif
                        @if(count($multiple_other) > 0)
                        @foreach($multiple_other as $k => $value)
                            <?php
                            $first_value = array_shift($value);
                            $value = array_chunk($value, 6);    
                            ?>
                        <tr id="otherFieldMultipleOthers">
                            @if(count($value[$j]) > 0)
                            <td class="viewer">
                                {{$first_value}}
                           </td>
                           @foreach($value[$j] as $key => $other)
                            <td class="viewer">
                                {{$other}}
                            </td>
                            @endforeach
                            @endif
                        </tr>
                        @endforeach
                        @endif
                        <tr>
                            <td class="total-cost relative ">Total project Cost</td>
                            @if(count($multiple_total_cost[$j]) > 0)
                            @foreach ($multiple_total_cost[$j] as $key => $value)
                            <td class="total-cost removeMultipleCountry_{{$key - 1}}"></td>
                            <td class="total-cost removeMultipleCountry_{{$key - 1}}"></td>
                            <td class="removeMultipleCountry_{{$key - 1}}">{{$value}}</td>
                            @endforeach
                            @endif
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @endif
            </div>
                    @endif
                </div>
            </div>


            <div class="container">

                <div class="{{ isset($newrfq) && isset($newrfq->interview) ? '' : '' }}"
                    style="{{ isset($newrfq) && isset($newrfq->interview) ? '' : 'display: none;' }}"
                    id="interview-depth">

              <?php
            if(isset($newrfq) && isset($newrfq->interview)){
                $interview_depth_methodology_chunk = json_decode($newrfq->interview->interview_depth_methodology);
                $interview_depth_methodology = array_chunk($interview_depth_methodology_chunk, 2);
                $interview_depth_currency_chunk = json_decode($newrfq->interview->interview_depth_currency);
                $interview_depth_currency = array_chunk($interview_depth_currency_chunk, 2);
                $interview_depth_loi_chunk = json_decode($newrfq->interview->interview_depth_loi);
                $interview_depth_loi = array_chunk($interview_depth_loi_chunk, 2);
                $interview_depth_client_chunk = json_decode($newrfq->interview->interview_depth_client);
                $interview_depth_client = array_chunk($interview_depth_client_chunk, 2);
                $interview_depth_no_fgd_chunk = json_decode($newrfq->interview->interview_depth_no_fgd);
                $interview_depth_no_fgd = array_chunk($interview_depth_no_fgd_chunk, 2);
                $interview_depth_sample_fgd_chunk = json_decode($newrfq->interview->interview_depth_sample_fgd);
                $interview_depth_sample_fgd = array_chunk($interview_depth_sample_fgd_chunk, 2);
                $interview_depth_countries_chunk = json_decode($newrfq->interview->interview_depth_countries);
                $interview_depth_countries = array_chunk($interview_depth_countries_chunk, 2);
                $interview_depth_requirements_chunk = json_decode($newrfq->interview->interview_depth_requirements);
                $interview_depth_requirements = array_chunk($interview_depth_requirements_chunk, 6);
                $interview_depth_incentives_chunk = json_decode($newrfq->interview->interview_depth_incentives);
                $interview_depth_incentives = array_chunk($interview_depth_incentives_chunk, 6);
                $interview_depth_moderation_chunk = json_decode($newrfq->interview->interview_depth_moderation);
                $interview_depth_moderation = array_chunk($interview_depth_moderation_chunk, 6);
                $interview_depth_transcripts_chunk = json_decode($newrfq->interview->interview_depth_transcripts);
                $interview_depth_transcripts = array_chunk($interview_depth_transcripts_chunk, 6);
                $interview_depth_project_management_chunk = json_decode($newrfq->interview->interview_depth_project_management);
                $interview_depth_project_management = array_chunk($interview_depth_project_management_chunk, 6);
                $interview_depth_other = json_decode($newrfq->interview->interview_depth_other);
                //$interview_depth_other = array_chunk($interview_depth_other_chunk, 9);
                $interview_depth_total_cost_1 = json_decode($newrfq->interview->interview_depth_total_cost_1);
                $interview_depth_total_cost_2 = json_decode($newrfq->interview->interview_depth_total_cost_2);
                
            }   
            ?>
                    @if(isset($newrfq) && isset($newrfq->interview))


                      <div class="table-container mt-2">
                @if(count($interview_depth_methodology) > 0)
                @foreach ($interview_depth_methodology as $j => $interview)
                <table class="" id="InterviewDepth">
                    <tbody>
                        <tr>
                            <td class="title">Methodology</td>
                            @if(count($interview_depth_methodology[$j]) > 0)
                                @foreach($interview_depth_methodology[$j] as $key => $methodology)
                                    <td colspan="3" class="viewer">
                                        <label class="mb-0 label">
                                            {{$methodology}}
                                        </label>
                                    </td>
                                @endforeach
                            @endif
                            
                        </tr>
                        <tr>
                            <td class="title">Currency</td>
                            @if(count($interview_depth_currency[$j]) > 0)
                                @foreach($interview_depth_currency[$j] as $key => $currency)
                                    <td class="editable-field viewer removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                        <label class="mb-0 label">
                                            {{$currency}}
                                        </label>
                                    </td>
                                @endforeach
                            @endif
                            
                        </tr>
                        <tr>
                            <td class="title">LOI</td>
                            @if(count($interview_depth_loi[$j]) > 0)
                                @foreach($interview_depth_loi[$j] as $key => $loi)
                                    <td class="editable-field viewer removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                        <label class="mb-0 label">
                                            {{$loi}}
                                        </label>
                                    </td>
                                @endforeach
                            @endif
                            
                        </tr>
                        <tr>
                            <td class="title">Client</td>
                            @if(count($interview_depth_client[$j]) > 0)
                                @foreach($interview_depth_client[$j] as $key => $value)
                                    <td class="editable-field viewer removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                    <label class="mb-0 label"> 
                                       
                                        
                                        {{$value}}
                                      
                                    </label>
                                    </td>
                                @endforeach
                            @endif
                            
                        </tr>
                        <tr>
                            <td class="title">No of FGDs/IDI</td>
                            @if(count($interview_depth_no_fgd[$j]) > 0)
                                @foreach($interview_depth_no_fgd[$j] as $key => $fgd)
                                    <td class="editable-field removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                        <label class="mb-0 label viewer">
                                            {{$fgd}}
                                        </label>
                                    </td>
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="title">Samples per FGD/IDI</td>
                            @if(count($interview_depth_sample_fgd[$j]) > 0)
                                @foreach($interview_depth_sample_fgd[$j] as $key => $fgd)
                                <td class="editable-field removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                    <label class="mb-0 label viewer">
                                        {{$fgd}}
                                    </label>
                                </td>
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="title">Country</td>
                            @if(count($interview_depth_countries[$j]) > 0)
                                @foreach($interview_depth_countries[$j] as $key => $country)
                                <td class="editable-field removeInterviewDepth_{{$key - 1}}"  colspan="3">
                                <label class="mb-0 label viewer">
                                    {{$country}}
                                </label>
                                </td>
                                @endforeach
                            @endif
                        </tr>
                        <tr>
                            <td class="title"></td>
                            @if(count($interview_depth_countries[$j]) > 0)
                            @foreach($interview_depth_countries[$j] as $key => $country)
                                <td class="static-field removeInterviewDepth_{{$key - 1}}">Sample</td>
                                <td class="static-field removeInterviewDepth_{{$key - 1}}">CPI</td>
                                <td class="static-field removeInterviewDepth_{{$key - 1}}">Total</td>
                            @endforeach
                            @endif
                        </tr>

                        <tr>
                            <td class="title ">Recruitment</td>
                            <?php 
                                $i = "";
                            ?>
                            @if(count($interview_depth_requirements[$j]) > 0)
                            @foreach($interview_depth_requirements[$j] as $key => $value)
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
                            <td class="title viewer removeInterviewDepth_{{$key - 1}}">Incentives</td>
                            @if(count($interview_depth_incentives[$j]) > 0)
                            @foreach($interview_depth_incentives[$j] as $key => $value)
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
                            <td class="title viewer removeInterviewDepth_{{$key - 1}}">Moderation</td>
                            @if(count($interview_depth_moderation[$j]) > 0)
                            @foreach($interview_depth_moderation[$j] as $key => $value)
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
                            <td class="title  viewer removeInterviewDepth_{{$key - 1}}">Transcripts</td>
                            @if(count($interview_depth_transcripts[$j]) > 0)
                            @foreach($interview_depth_transcripts[$j] as $key => $value)
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
                            <td class="title viewer removeInterviewDepth_{{$key - 1}}">Project Management</td>
                            @if(count($interview_depth_project_management[$j]) > 0)
                            @foreach($interview_depth_project_management[$j] as $key => $value)
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
                        <?php
                            $first_value = array_shift($value);
                            $value = array_chunk($value, 6);    
                        ?>
                        @if(count($value[$j]) > 0)
                        <td class="viewer removeInterviewDepth_{{$i}}">
                            {{$first_value}}
                       </td>
                       @foreach($value[$j] as $key => $other)
                        <td class="viewer">
                            {{$other}}
                        </td>
                        @endforeach
                        @endif
                        </tr>
                        @endforeach
                        @endif
                        <tr>
                        @if(count($interview_depth_total_cost_1) > 0)
                        <?php
                        $val = $interview_depth_total_cost_1;
                        $first_value = array_shift($val);
                        $val = array_chunk($val, 2);    
                        ?>
                        <td class="total-cost">{{$first_value}}</td>
                        @foreach ($val[$j] as $k => $value)
                        <td class="total-cost"></td>
                        <td class="total-cost"></td>
                        <td class="total-cost">
                            {{$value}}
                        </td>
                        @endforeach
                        @endif
                        </tr>
                        <tr>
                        @if(count($interview_depth_total_cost_2) > 0)
                        <?php
                        $val = $interview_depth_total_cost_2;
                        $first_value = array_shift($val);
                        $val = array_chunk($val, 2);    
                        ?>
                        <td class="total-cost">{{$first_value}}</td>
                        @foreach ($val[$j] as  $value)
                        <td class="total-cost"></td>
                        <td class="total-cost"></td>
                        <td class="total-cost">
                            {{$value}}
                        </td>
                        @endforeach
                        @endif
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @endif
            </div>
                    @endif
                </div>
            </div>





            <div class="container">

                <div class="{{ isset($newrfq) && isset($newrfq->online) ? '' : '' }}"
                    style="{{ isset($newrfq) && isset($newrfq->online) ? '' : 'display: none;' }}"
                    id="online-community">

                    <?php
            if(isset($newrfq) && isset($newrfq->online)){
                $online_community_methodology_chunk = json_decode($newrfq->online->online_community_methodology);
                $online_community_methodology = array_chunk($online_community_methodology_chunk, 2);
                $online_community_currency_chunk = json_decode($newrfq->online->online_community_currency);
                $online_community_currency = array_chunk($online_community_currency_chunk, 2);
                $online_community_client_chunk = json_decode($newrfq->online->online_community_client);
                $online_community_client = array_chunk($online_community_client_chunk, 2);
                $online_community_duration_chunk = json_decode($newrfq->online->online_community_duration);
                $online_community_duration = array_chunk($online_community_duration_chunk, 2);
                $online_community_loi_screener_chunk = json_decode($newrfq->online->online_community_loi_screener);
                $online_community_loi_screener = array_chunk($online_community_loi_screener_chunk, 2);
                $online_community_sample_loi_month_chunk = json_decode($newrfq->online->online_community_sample_loi_month);
                $online_community_sample_loi_month = array_chunk($online_community_sample_loi_month_chunk, 2);
                $online_community_countries_chunk = json_decode($newrfq->online->online_community_countries);
                $online_community_countries = array_chunk($online_community_countries_chunk, 2);
                $online_community_requirements_chunk = json_decode($newrfq->online->online_community_requirements);
                $online_community_requirements = array_chunk($online_community_requirements_chunk, 6);
                $online_community_incentives_chunk = json_decode($newrfq->online->online_community_incentives);
                $online_community_incentives = array_chunk($online_community_incentives_chunk, 6);
                $online_community_pmfree_chunk = json_decode($newrfq->online->online_community_pmfree);
                $online_community_pmfree = array_chunk($online_community_pmfree_chunk, 6);
                $online_community_other = json_decode($newrfq->online->online_community_other);
                // $online_community_other = array_chunk($online_community_other_chunk, 9);
                // dd($online_community_other_chunk);
                $online_community_total_cost_chunk = json_decode($newrfq->online->online_community_total_cost);
                $online_community_total_cost = array_chunk($online_community_total_cost_chunk, 2);
            }   
            ?>
            @if(isset($newrfq) && isset($newrfq->online))
           

            <div class="table-container mt-2">
                @if(count($online_community_methodology) > 0)
                @foreach ($online_community_methodology as $j => $online)
                <table class="" id="OnlineCommunity">
                    <tbody>
                        <tr>
                            <td class="title viewer w-25">Methodology</td>
                            @if(count($online_community_methodology[$j]) > 0)
                            @foreach($online_community_methodology[$j] as $key => $methodology)
                                <td  colspan="3" class="viewer">
                                <label class="mb-0 label">
                                    {{$methodology}}
                                </td>
                            @endforeach
                            @endif
                        </tr>
                        <tr>
                        <td class="title">Currency</td>
                        @if(count($online_community_currency[$j]) > 0)
                        @foreach($online_community_currency[$j] as $key => $currency)
                        <td class="editable-field viewer removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                        <label class="mb-0 label">
                            {{$currency}}
                        </label>
                        </td>
                        @endforeach
                        @endif
                        </tr>
                        <tr>
                        <td class="title">Client</td>
                        @if(count($online_community_client[$j]) > 0)
                        @foreach($online_community_client[$j] as $key => $value)
                        <td class="editable-field viewer removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                            <label class="mb-0 label"> 
                                {{$value}}
                            </label>
                        </td>
                        @endforeach
                        @endif
                        </tr>
                        <tr>
                        <td class="title">Duration</td>
                        @if(count($online_community_duration[$j]) > 0)
                        @foreach($online_community_duration[$j] as $key => $duration)
                            <td class="editable-field viewer removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                            <label class="mb-0 label">
                                {{$duration}}
                            </label>
                            </td>
                        @endforeach
                        @endif
                        </tr>
                        <tr>
                        <td class="title">LOI</td>
                        @if(count($online_community_loi_screener[$j]) > 0)
                        @foreach($online_community_loi_screener[$j] as $key => $screener)
                            <td class="editable-field viewer removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                            <label class="mb-0 label viewer ">
                                {{$screener}}
                            </label>
                            </td>
                        @endforeach
                        @endif
                        </tr>
                        <tr>
                        <td class="title">LOI/Month</td>
                        @if(count($online_community_sample_loi_month[$j]) > 0)
                        @foreach($online_community_sample_loi_month[$j] as $key => $sample_loi_month)
                            <td class="editable-field removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                            <label class="mb-0 label viewer">
                                {{$sample_loi_month}}
                            </label>
                            </td>
                            @endforeach
                        @endif
                        </tr>
                        <tr>
                        <td class="title">Country</td>
                        @if(count($online_community_countries[$j]) > 0)
                        @foreach($online_community_countries[$j] as $key => $countries)
                            <td class="editable-field removeOnlineCommunity_{{$key - 1}}"  colspan="3">
                            <label class="mb-0 label viewer">
                                {{$countries}}
                            </label>
                            </td>
                            @endforeach
                        @endif
                        </tr>
                        <tr>
                        <td class="title"></td>
                        @if(count($online_community_countries[$j]) > 0)
                        @foreach($online_community_countries[$j] as $key=> $online)
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
                            <td class="title">Recruitment</td>
                            @if(count($online_community_requirements[$j]) > 0)
                            @foreach($online_community_requirements[$j] as $key => $value)
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
                            <td class="title">Incentives</td>
                            @if(count($online_community_incentives[$j]) > 0)
                            @foreach($online_community_incentives[$j] as $key => $value)
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
                            <td class="title">Project Management</td>
                            @if(count($online_community_pmfree[$j]) > 0)
                            @foreach($online_community_pmfree[$j] as $key => $value)
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
                        <tr id="otherFieldsOnline">
                        <?php
                            $first_value = array_shift($value);
                            $value = array_chunk($value, 6);    
                        ?>
                        @if(count($value[$j]) > 0)
                        <td class="viewer removeOnlineCommunity_{{$i}}">
                            {{$first_value}}
                        </td>
                        @foreach($value[$j] as $key => $other)
                        <td class="viewer">
                            {{$other}}
                        </td>
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
                            @if(count($online_community_total_cost[$j]) > 0)
                            @foreach ($online_community_total_cost[$j] as $key => $value)
                            <td class="total-cost "></td>
                            <td class="total-cost "></td>
                            <td class="">
                                {{$value}}</td>
                            @endforeach
                            @endif
                        </tr>
                    </tbody>
                </table>
                @endforeach
                @endif
            </div>
            @endif
                </div>
            </div>
        </div>


        <br>
        <br>

        <h3 style="text-decoration:underline">About - Asia Research Partners LLP</h3>

        <p>Asia Research Partners LLP is an award-winning and ISO 9001:2015 & ISO/IEC 27001:2013
            certified global market research agency, providing state-of-the-art business intelligence
            solutions to companies across industries and regions. Our custom research solutions are
            tailored to our client’s strategic and informative knowledge needs. We have extensive
            experience in various industries and geographic locations, including APAC, Europe, Middle
            East, AMERICAS and Africa.</p>
            <p style="font-family: DejaVu Sans;">
                • For more information, Please visit 
                <a href="https://www.asiaresearchpartners.com" target="_blank">
                    https://www.asiaresearchpartners.com
                </a>
            </p>

        <h3 style="text-decoration: underline; color:black;">Terms and Conditions for the proposal</h3>
        <p style="font-family: DejaVu Sans;">• Quotation is valid only for three months.</p>
        <p style="font-family: DejaVu Sans;">• 100% payment to be made within 30 days of project completion.</p>
        <p style="font-family: DejaVu Sans;">• In case client delays payment determined in the Agreement hereto, Asia
            Research Partners
            is entitled to claim penalty at the rate of 4% of the invoice value each month.</p>
        <p style="font-family: DejaVu Sans;">• The parties acknowledge that the purpose of the relationship created will
            be that of an
            independent contractor relationship only (Asia Research Partners as independent
            contractor of Client). Client and Asia Research Partners as mutually agree as to the
            objectives, scope of services and the Service Level Agreements set forth. Asia Research
            Partners as shall use client methodology to complete the research fieldwork however Asia
            Research Partners as is also free to use its own methodology if needed to accomplish the
            tasks outlined in the scope of work.</p>
        <p style="font-family: DejaVu Sans;">• The parties recognize and agree that no joint venture or partnership
            agreement is intended
            or created hereby. No agent, employee or servant of client shall be or deemed to be the
            agent, employee or servant of Asia Research Partners nor shall any agent, employee or
            servant of ARP be or deemed to be the agent, employee or servant of client. ARP will have
            full power and authority to select the means, manner and the method of performing the
            work and accomplishing the tasks outlined in the scope of work. Neither Asia Research
            Partners nor client shall act on behalf or represent itself directly or by implication as having
            authority to act on behalf of the other party except as specifically set forth in this
            Agreement. Neither party shall have the authority to create any obligation for, on behalf of,
            or in the name of the other party except as specifically set forth herein.</p>
        <p style="font-family: DejaVu Sans;">• The parties acknowledge that client will disclose to Asia Research
            Partners certain
            information (Confidential Information) relating to the business of client’s client. Asia
            Research Partners agrees that it shall not use such information except in the pursuit of Asia
            Research Partners’s responsibilities and rights under this Agreement.</p>
        <p style="font-family: DejaVu Sans;">• Asia Research Partners will retain the project documents, project data
            and other
            information only for 3 (three) months from the date of project completion.</p>
        <p style="font-family: DejaVu Sans;">• Any re-contacts with respondents will happen on best effort basis only.
        </p>
        <p style="font-family: DejaVu Sans;">• The information contained in the data collection will be based on the
            responses
            collected by individual respondents.<p>
                <p style="font-family: DejaVu Sans;">• Asia Research Partners LLP will make no warranty (express,
                    implied, or otherwise),
                    nor assumes any legal liability or responsibility of the information that will come from
                    respondents. The opinion that will be expressed in the data collection will be the
                    opinion based on the responses given by individual respondents at the time of data
                    collection and is subject to change from time to time.</p>

</body>

</html>
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

<?php
                                        $sample_size=json_decode($biddownload->sample_size,true); 
                                        $setup_cost=json_decode($biddownload->setup_cost,true);
                                        $methodology=json_decode($biddownload->methodology,true);
                                        $recruitment = json_decode($biddownload->recruitment,true);
                                        $incentives = json_decode($biddownload->incentives,true);
                                        $moderation = json_decode($biddownload->moderation,true);
                                        $transcript = json_decode($biddownload->transcript);
                                        $others = json_decode($biddownload->others);
                                        $world = json_decode($biddownload->country);
                                        $total_cost = json_decode($biddownload->total_cost);
                                        $client_id =json_decode($biddownload->client_id);
                                        $vendor_id = json_decode($biddownload->vendor_id);

                                        $costItems = [
                                            'Methodology' => $methodology,
                                            'Sample Size' => $sample_size,
                                            'Setup Cost' => $setup_cost,
                                            'Recruitment' => $recruitment,
                                            'Incentives' => $incentives,
                                            'Moderation' => $moderation,
                                            'Transcript' => $transcript,
                                            'Others' => $others
                                        ];
                                        ?>
<div class="container mt-5">
    <div class=" col-md-12">
        <div class="row">
            <div class="col-md-4">
                <label class="font-weight-bold">RFQ No:</label>
            </div>
            <div class="col-md-4">
                {{ $biddownload->rfq_no }}
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                <label class="font-weight-bold">Country:</label>
            </div>
            <div class="col-md-4">
                @foreach($world as $countryGroup)
                @foreach($countryGroup as $country)
                {{ $country }}
                @endforeach
                @endforeach
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-4">
                <label class="font-weight-bold">Currency:</label>
            </div>
            <div class="col-md-4">
                {{ $biddownload->currency }}
            </div>
        </div>
    </div>

    <div class="container mt-5">
        <div class=" col-md-12">
            @foreach ($world as $key => $country)
            <h6>Country:{{$country[0]}}</h6>
            <table class="table table-bordered border-primary add-country">
                <tr>
                    <th>Client Name/Vendor Name</th>
                    @foreach ($client_id[$key] as  $data)
                        <th>Client</th>
                    @endforeach
                </tr>
                @foreach ($costItems as $label => $costArray)
                <tr>
                    <td class="sub-cost">{{ $label }}</td>
                    @foreach ($costArray[$key] as $key1 => $data)
                        @if ($label == 'Others')
                            @if ($key1 % 3 == 1) 
                                <td>{{ $data }}</td>
                            @endif
                        @else
                            @if ($key1 % 2 == 0)
                                <td>{{ $data }}</td>
                            @endif
                        @endif
                    @endforeach
                </tr>
            @endforeach
            </table>
            @endforeach
        </div>
        <div class=" col-md-12 d-none">

            @foreach($world as $main=> $country1)
            @foreach($sample_size as $k1=> $value)
            @if($k1==$main)
            @foreach($country1 as $cou=> $countries)
            <h6>Country:{{$countries}}</h6>
            @endforeach

            <table class="table table-bordered border-primary add-country">
                <tr>
                    <th>Client Name/Vendor Name</th>



                    @foreach($vendor_id as $key=> $vendor)

                    @foreach($vendor as $k=> $data)
                    <th>Client</th>

                    @endforeach
                    @endforeach




                </tr>
                <!-- Sample Size -->
                <tr>
                    <td class="sub-cost">Sample Size</td>


                    @foreach($value as $k=> $data)
                    <td>
                        {{$data}}
                    </td>
                    @endforeach


                </tr>
                <!-- Setup Cost -->
                <tr>
                    <td class="sub-cost">Setup Cost</td>
                    @foreach($value as $k=> $data)
                    <td>
                        {{$setup_cost[$k1][$k]}}
                    </td>
                    @endforeach
                </tr>

                <!-- Incentives -->
                <tr>
                    <td class="sub-cost">Incentives</td>
                    @foreach($value as $k=> $data)
                    <td>
                        {{$incentives[$k1][$k]}}
                    </td>
                    @endforeach
                </tr>

                <!-- Moderation -->
                <tr>
                    <td class="sub-cost">Moderation</td>
                    @foreach($value as $k=> $data)
                    <td>
                        {{$moderation[$k1][$k]}}
                    </td>
                    @endforeach

                </tr>

                <!-- Transcript -->

                <tr>
                    <td class="sub-cost">Transcript</td>
                    @foreach($value as $k=> $data)
                    <td>
                        {{$transcript[$k1][$k]}}
                    </td>
                    @endforeach
                </tr>

                <!-- Others -->

                <tr>
                    <td class="sub-cost">Others</td>
                    @foreach($value as $k=> $data)
                    <td>
                        {{$others[$k1][$k]}}
                    </td>
                    @endforeach
                </tr>

                <!-- Methodology (Newly Added) -->

                <tr>
                    <td class="sub-cost">Total Cost</td>


                    @foreach($value as $k3=> $data)
                    <td>
                        {{$total_cost[$k1][$k3]}}
                    </td>
                    @endforeach

                </tr>
            </table>

            @endif
            @endforeach
            @endforeach



        </div>

        <a href="{{ URL::to('/adminapp/bidrfq/downloadpdf/'.$biddownload->id) }}" class="btn btn-download">Download
            PDF</a>

        @endsection
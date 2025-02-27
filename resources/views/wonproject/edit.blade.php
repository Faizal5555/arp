@extends('layouts.master')
<style>
    a.ml-2.btn.btn-primary {
    float: right;
}
.main-panel {
    background-color: #f8f8f8;
   }
.card {
   margin: 40px 0 20px 0;
    border:1px solid;
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
 background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
    color: #fff;
}
.sub-text {
    color: #fff;
}
/*input.valid {*/
/*    width: 100%;*/
/*}*/
label.currency1 {
    margin-top: 12px;
    margin-left: 5px;
    position: absolute;
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
.table-bordered td, .table-bordered th {
    border: 1px solid #dee2e6;
    padding-left: 33px;
    padding-right: 23px;
    padding-top:10px;
    padding-bottom:10px;
}
.panvendor {
    float: right !important;
    padding-bottom: 10px !important;
}
.error{
    color:red;
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
@section('page_title', 'WonProject Form')
@section('content')

<script>
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
                            swal({
                            title:'Success',
                            text:'WonProject Updated Successfully',
                            icon:'success',
                            button:false
                        })
                          $('#exampleModal').modal('show');
                        }
                        if (data.success == 0) {
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

       
    })
</script>
<script>
   $(document).on('change','#my-vendor',function(){
     $('.vendorfile').remove();     
    });
    $(document).on('change','#my-client',function(){
     $('.clientfile').remove();
    });
</script>
<script>
    $(document).on('change','#worldcurrency',function(){
        var cur = $(this).val();
        $('.currency').html(cur);
        // $(".total_cost.border").removeAttr("placeholder");

    });

    // single Country Calculation
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


       //Multiple Country

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

            // interview in depth calculation
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

            // online community

            $(document).on('keyup', '#OnlineCommunity td input', function() {
                console.log("hello");
                let totalValues = [];
                let total_length = $('#OnlineCommunity tbody td:has(input[attr="total"])').length;
                let overall_total_length = $('#OnlineCommunity tbody td:has(input[name="online_community_total_cost[]"])').length;
                $('#OnlineCommunity tbody td:has(input[attr="total"])').each(function(){
                    let cpi = parseInt($(this).prev().find('input').val());
                    let sample = parseInt ($(this).prev().prev().find('input').val());
                    if(!isNaN(cpi) && !isNaN(sample))
                    {
                        $(this).find('input').val(cpi*sample);
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
                    $(this).find('input').val(sum);
                })
            });
        });

</script>
<div class="container-fluid" >
    <div class=" row" id="wonproject-id">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header header-elements-inline">
                  <div class="card-title">
                    <div class="sub-text">
                        Commissioned Project
                    </div>
                </div>
                </div>

                <div class="card-body d-none" id="won-rfq">
                    <div class="row">
                        <form id="won" class="flex-wrap form col-md-12 d-flex update"
                           enctype="multipart/form-data">
                           @csrf
                           <input type="hidden" value="rfq_no_id">
                           <input type="hidden" name="id" id="won_id" value="{{$wonproject && $wonproject->id ? $wonproject->id : ''}}" >
                           <input id="bidrfqCount" type="hidden" value="1" name="wonCount">
                            <div class="row add">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">RFQ No <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                          <input name="rfq_no" type="text" readonly="readonly" value="{{$wonproject && $wonproject->rfq_no ? $wonproject->rfq_no : ''}}"
                                                id="rfq_no" class="form-control" placeholder="Project Name">
                                            <!--     <select class="form-control label-gray-3" name="rfq_no" id="rfq_no">-->
                                            <!--<option class="label-gray-3" value="" disabled selected>Select RFQ No</option>-->
                                        
                                            <!--    <option class="label-gray-3" value="{{$wonproject && $wonproject->rfq_no ? $wonproject->rfq_no : ''}}">{{$wonproject && $wonproject->rfq_no ? $wonproject->rfq_no : ''}}</option>-->
                                                
                                              
                                            <!--</select>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold" id="otherField1">Project Name<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="project_name" type="text" value="{{$wonproject && $wonproject->project_name ? $wonproject->project_name : ''}}"
                                                id="otherField1" class="form-control" placeholder="Project Name">
                                        </div>
                                    </div>
                                </div>
                                 <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold" id="otherField2">Project Type<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                                <select class="form-control label-gray-3" name="project_type" id="project_type">
                                                    <option class="label-gray-3" disabled selected>Select Execution</option>
                                                    <option value="Qualitative" {{ $wonproject && $wonproject->project_type == "Qualitative" ? 'selected' : ''}}>Qualitative</option>
                                                    <option value="Quantitative" {{ $wonproject && $wonproject->project_type == "Quantitative" ? 'selected' : ''}}>Quantitative</option>
                                                    <option value="Community" {{ $wonproject && $wonproject->project_type == "Community" ? 'selected' : ''}}>Community</option>
                                                    <option value="Qual and Quant" {{$wonproject && $wonproject->project_type =="Qual and Quant" ? 'selected' :''}}>Qual and Quant</option>
                                                </select>    
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField3" class="col-lg-3 col-form-label font-weight-semibold">Project Execution<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select class="form-control label-gray-3" name="project_execution" id="project_execution">
                                                <option class="label-gray-3" disabled selected>Select Execution</option>
                                                <option value="Insource" {{ $wonproject && $wonproject->project_execution == "Insource" ? 'selected' : ''}}>Insource</option>
                                                <option value="Outsource" {{ $wonproject && $wonproject->project_execution == "Outsource" ? 'selected' : ''}}>Outsource</option>
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
                                                <option value="₹" {{ $wonproject && $wonproject->currency == "₹" ? 'selected' : ''}}>INR</option>
                                                <option value="$" {{ $wonproject && $wonproject->currency == "$" ? 'selected' : ''}}>USD</option>
                                                <option value="€" {{ $wonproject && $wonproject->currency == "€" ? 'selected' : ''}}>Euro</option>
                                                <option value="£" {{ $wonproject && $wonproject->currency == "£" ? 'selected' : ''}}>Pound</option>     
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField4" class="col-lg-3 col-form-label font-weight-semibold">Start Date<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="project_start_date" 
                                                id="otherField4" type="date" value="{{$wonproject->project_start_date ? $wonproject->project_start_date :''}}" class="form-control" placeholder="Start Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField5" class="col-lg-3 col-form-label font-weight-semibold">End Date<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="project_end_date" 
                                                id="otherField5" value="{{$wonproject->project_end_date ? $wonproject->project_end_date :''}}" type="date" class="form-control" placeholder="End Date">
                                        </div>
                                    </div>
                                </div>
                                
                            
                                
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField8" class="col-lg-3 col-form-label font-weight-semibold">Total Margins<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                             <label class="currency" id="total_margin_currency"></label>
                                               <label class="currency1"></label>
                                            <input name="total_margin" 
                                            value="{{$wonproject->total_margin ? $wonproject->total_margin :''}}" id="otherField8" type="text" class="form-control" placeholder="Total Margin">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField3" class="col-lg-3 col-form-label font-weight-semibold">Mode<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <select class="form-control label-gray-3" name="mode" id="mode">
                                                <option class="label-gray-3" disabled selected>Select Mode</option>
                                                <option value="Online" {{ $wonproject && $wonproject->mode == "Online" ? 'selected' : ''}}>Online</option>
                                                <option value="Offline" {{ $wonproject && $wonproject->mode == "Offline" ? 'selected' : ''}}>Offline</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-md-12">
                                    <div class="form-group row">
                                    
                                        <label id="otherField9" class="col-lg-3 col-form-label font-weight-semibold"><u>Client Invoicing Terms</u></label>
                                    
                                    </div>
                                </div>
                                <div class="col-md-6 count-vendor" data-won="0">
                                    <div class="form-group row">
                                        <label id="otherField10" class="col-lg-3 col-form-label font-weight-semibold">Advance Payment <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="client_advance_currency"></label>
                                              <label class="currency1"></label>
                                            <input name="client_advance" 
                                                id="otherField10" value="{{$wonproject->client_advance ? $wonproject->client_advance :''}} "type="text" class="form-control" placeholder="Advance Payment" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField11" class="col-lg-3 col-form-label font-weight-semibold">Balance Payment<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="client_balance_currency"></label>
                                              <label class="currency1"></label>
                                            <input name="client_balance" 
                                                id="otherField11" value="{{$wonproject->client_balance ? $wonproject->client_balance :''}} " type="text" class="form-control" placeholder="Balance Payment" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField6" class="col-lg-3 col-form-label font-weight-semibold">Client Total Project Invoice Value<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                              <label class="currency" id="client_total_currency"></label>
                                                <label class="currency1"></label>
                                            <input name="client_total" 
                                                id="otherField6" type="text" value="{{$wonproject->client_total ? $wonproject->client_total :''}} " class="form-control" placeholder="Client Total Project Invoice Value" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField15" class="col-lg-3 col-form-label font-weight-semibold">Attach Client Contract / Email <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <a download target="_blank" href="{{url($wonproject->client_contract ? $wonproject->client_contract :'')}}">{{$wonproject->client_contract ? $wonproject->client_contract :''}}</a>
                                            <input name="client_contract" style="text-transform: capitalize;" 
                                                id="otherField15" type="file"  value="{{$wonproject->client_contract ? $wonproject->client_contract :''}} " class="p-1 form-control" placeholder="Attach Client Contract">
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                $vendor_id = explode(',',$wonproject->vendor_id);
                                $vendor_advance= explode(',',$wonproject->vendor_advance);
                                $vendor_balance= explode(',',$wonproject->vendor_balance);
                                $vendor_total= explode(',',$wonproject->vendor_total);
                                $vendor_contract= explode(',',$wonproject->vendor_contract);
                                ?>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        
                                        <label class="col-lg-12 col-form-label font-weight-semibold"><u>Vendor Invoicing Terms</u></label>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6"> <button class="won-add-vendor btn btn-success d-none" type="button">Add Vendor</button> </div>
                                   
                                    </div>
                                </div>
                               
                                @foreach($vendor_id as $key=> $value)
                               
                                <div class="col-md-6">
                                    <div class="form-group row">
                                    <label id="otherField13" class="col-lg-3 col-form-label font-weight-semibold">Vendor Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                       
                                        <select class="form-control label-gray-3" name="vendor_id_0[{{$key}}]" id="vendor_id">
                                        
                                         <option class="label-gray-3" value="{{$value}}" selected>{{$value}}</option>
                                        </select> 
                                        

                                        </div>
                                    </div>
                                </div>

                                
                                @foreach($vendor_advance as $k=> $value1)
                                @if($key == $k)
                                 <div class="col-md-6 my_vendor_0">
                                      <div class="form-group row">
                                        <label id="otherField13" class="col-lg-3 col-form-label font-weight-semibold">Advance Payment <span
                                                class="text-danger">*</span></label>
                                            <div class="col-lg-9">
                                                <label class="currency" id="vendor_advance_currency"></label>
                                                <input name="vendor_advance_0[{{$key}}]" value="{{$value1}}"
                                                    id="otherField13" type="number" class="form-control" placeholder="Advance Payment" required>
                                             </div>
                                           </div>
                                </div>
                                @endif
                                @endforeach 
                               

                                @foreach($vendor_balance as $k1=> $value2)
                                @if($key == $k1)
                                <div class="col-md-6 my_vendor_1">
                                    <div class="form-group row">
                                        <label id="otherField14" class="col-lg-3 col-form-label font-weight-semibold">Balance Payment<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="vendor_balance_currency"></label>
                                            <input name="vendor_balance_0[{{$key}}]"
                                                id="otherField14" type="number" value="{{$value2}}" class="form-control" placeholder="Balance Payment" required>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach 

                                @foreach($vendor_total as $k2=> $value3)
                                @if($key == $k2)
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField7" class="col-lg-3 col-form-label font-weight-semibold">Vendor Total Project Invoice Value<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="vendor_total_currency"></label>
                                            <input name="vendor_total_0[{{$key}}]" 
                                                id="otherField7" value="{{$value3}}" type="number" class="form-control" placeholder="Vendor Total Project Invoice Value" required>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach

                                @foreach($vendor_contract as $k3=> $value4)
                                @if($key == $k3)
                                <div class="col-md-6 my_vendor_3">
                                    <div class="form-group row">
                                        <label id="otherField16" class="col-lg-3 col-form-label font-weight-semibold">Attach Vendor Contract / Email<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">

                                           <a target="_blank" download href="{{url($value4)}}">{{$value4}}</a>
                                            <input name="vendor_contract_0[{{$key}}]" style="text-transform: capitalize;" 
                                                id="otherField16" type="file" value="{{$value4}}" class="p-1 form-control" placeholder="Attach Vendor Contract">
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
                                
                            <div class="col-md-12 d-flex align-items-center justify-content-center" id="won-rfq-btn">
                                 <p class="mt-3 btn btn-primary" id="rfq-back">Back</p>
                                <button type="submit" id="addRegisterButton1"
                                    class="ml-2 btn btn-success won-sub">Update</button>
                               
                            </div>
                        </form>
                    </div>
                </div>
                </div>
         
                
                
                   
                   <div class="card-body" id="edit-rfq">
                    <div class="row">
                        <form id="rfq" class="flex-wrap form col-md-12 d-flex update"
                            enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="id"  value="{{$newrfq && $newrfq->id ? $newrfq->id  : ''}}">
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
                         
                            
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Choose Company
                                        Name<span class="text-danger">*</span></label>
                                    <div class="col-lg-9">

                                        <select class="form-control label-gray-3" id="company_name"
                                            name="company_name" >
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
                                    <div class="tab-container d-none">
                                        <button type="button" class="btn btn-success btn-sm" id="addMultipleCountryBtn">Add More</button>
                                    </div>
                                     @if(isset($newrfq) && isset($newrfq->multiple))
                                    <div class="table-container mt-2">
                                        <table class="" id="MultipleCountry">
                                            <tbody>
                                                <tr>
                                                    <td class="static-field">Methodology</td>
                                                    @if(count($multiple_methodology) > 0)
                                                        @foreach($multiple_methodology as $key => $methodology)
                                                            <td class="editable-field"  colspan="3">
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
                                                    <td class="total-cost relative ">Total project cost</td>
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
                                    <h5>In-Depth Interviews /Focus Groups Costing Sheet/ Cenetral Location Tests Costing Sheet</h5>
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
                                    <div class="tab-container">
                                        <button type="button" class="btn btn-success btn-sm" id="addInterviewDepthBtn">Add More</button>
                                    </div>

                                    <div class="table-container mt-2">
                                        <table class="" id="InterviewDepth">
                                            <tbody>
                                                <tr>
                                                    <td class="static-field">Methodology</td>
                                                    @if(count($interview_depth_methodology) > 0)
                                                        @foreach($interview_depth_methodology as $key => $methodology)
                                                            <td class="editable-field"  colspan="3">
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
                                                    <td class="static-field">Samples per FGD</td>
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
                                                        <td class="editable-field"  colspan="3">
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
                                                    <td class="static-field ">LOI screener</td>
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
                                                    <td class="static-field ">country</td>
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
                                                    <td class="static-field ">Requirements</td>
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
                                                    <td class="static-field">PM Free</td>
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
                                                    <td class="total-cost">Total Project cost</td>
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


                            <div class="col-md-12 d-flex align-items-center justify-content-center mt-5">
                                <a href="{{route('bidrfq.index')}}" class=" btn btn-outline-secondary" id="won-rfq-btn1">Back</a>
                                <button type="submit" id="addRegisterButton"
                                    class="ml-2 btn btn-success rfq-sub d-none">Update</button>
                                <p id="nextrfq" class="m-2 btn btn-primary won-rfq-btn2">Next</button>
                                   
                            </div>
                        </form>
                    </div>
                </div>
  
  
             
           


    

   

    

            </div>
        </div>
    </div>
</div>

      <!-- Modal -->
                <div class="modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                   <div class="modal-dialog">
                     <div class="modal-content">
                       <div class="modal-header">
                         <h5 class="modal-title" id="exampleModalLabel">Status</h5>
                         <button type="button" class="btn-close btn btn-danger" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
                       </div>
                       <div class="modal-body">
                        <h6>Are you sure Project Complete</h6>
                       </div>
                       <div class="modal-footer">
                        <button type="button" class="btn btn-primary sts-update">Yes</button>
                         <button type="button" class="btn btn-secondary sts-no" data-bs-dismiss="modal" >No</button>
                      
                       </div>
                     </div>
                   </div>
                 </div>
             

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
    $(document).on('change','#worldcurrency',function(){
        var id=$(this).val();
        var inputs = $('input[type="text"]');
        $('.currency1').hide();
        $('#client_advance_currency').html(id);
        $('#client_balance_currency').html(id);
        $('#vendor_advance_currency').html(id);
        $('#vendor_balance_currency').html(id);
        $('#total_margin_currency').html(id);
        $('#client_total_currency').html(id);
        $('#vendor_total_currency').html(id);
        inputs.removeAttr('placeholder');
    });
    
    </script>
    <script>
        $(document).ready(function(){
            var data = $('#worldcurrency').val();
            $('.currency1').html(data);
        })
    </script>

  <!--rfq script-->
 
      <!--end calculation-->
<script>
    $(document).ready(function () {
        $("#rfq").validate({
            rules: {
                rfq_no: {
                    required: true
                },
                client_id: {
                    required: true
                },
                vendor_id: {
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
                currency:{
                     required: true
                },
                total_cost: {
                    required: true
                }
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
                    url: "{{route('bidrfq.wonupdate')}}",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                      if (data.success == 1) {
                      
                        }
                        
                        if(data.success==0){
                           swal({
                            title: "Server Site Error",
                            type: "warning",
                            dangerMode: true,
                        })
                        }
                        if(data.success==2){
                            swal({
                            title: "Something Went Wrong",
                            type: "warning",
                            dangerMode: true,
                        })
                        }
                        
                    }

                });
            }
        });
    })
</script>

<script>
    $(document).on('change','#currency',function(){
        var id=$(this).val();
        $('.my-currency').html(id);
    })
</script>

<script>
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
      var key = $(this).attr('data-button');
      var d =  1 + parseInt($('.abcversion_'+key+'_2').last().attr("data-id"));
      var count = 1+parseInt($('.abcversion_'+key).last().attr('data-arr'));
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


    $(document).on('click','.btn-country',function(){
      var rar=1+ parseInt($('.addvendor').last().attr('data-button'));
      var id= $('.my-samplesize').last().attr('data-id');
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
                                
                                     <option value=""></option>
                                      
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
                                            @if(count($client) > 0)
                                            @foreach($client as $v)
                                        <option value="{{$v->client_name}}">{{$v->client_name}}</option>
                                        
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
                                       var j=2;
                                        $('.edit-table-bid tr td').each(function(index,value){
        if($(this).data('id')){
            $(this).attr('data-id',j);
            j++;
            if($('.edit-table-bid tr:nth-child(4) td').length<j){
                j=2;
            }
        }else{
            j=2;
        }
      });
                                       
    });


$(document).on('click','.btn-remove-country1',function(){
var tom= $(this).attr('data-country1');
$('.add-country_'+tom).remove();
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


<script>
$(document).ready(function () {
       
       $(document).on('keyup', 'table td', function () {
         var first = $(this).attr("data-culation");
         var second= $(this).attr("data-cal");

         var sum = 0;
         $('.cal_'+first+'_'+second).each(function(i,v) {
                if($(this).val()!='' && i!=7){
                    sum += Number($(this).val());
                }
            });
            $('.total_cost_'+first+'_'+second).val(sum);

       });
   
    });
    </script>
     <!--rfq script-->
     
<script>
// $("#nextrfq").click(function(){
// $('#won-rfq').css("visibility", 'hidden',);
// $('#won-rfq1').css("visibility", 'hidden');
// $('#won-rfq-btn1').css("visibility", 'hidden');
// $('#won-rfq-btn2').css("visibility", 'hidden');
//  $('#edit-rfq').removeClass('d-none');

// });

    $(document).on('click',"#nextrfq",function(){
       
        $('#edit-rfq').addClass('d-none');
                    $('#won-rfq').removeClass('d-none');
        $('#won-rfq1').removeClass('d-none');
        $('#won-rfq-btn').removeClass('d-none');
        $('#won-rfq-btn1').removeClass('d-none');
        $('.won-rfq-btn2').removeClass('d-none');
    });
    $(document).on('click','#rfq-back',function(){
        $('#edit-rfq').removeClass('d-none');
        $('#won-rfq').addClass('d-none');
        $('#won-rfq1').addClass('d-none');
        $('#won-rfq-btn').addClass('d-none');
        $('#won-rfq-btn1').removeClass('d-none');
        $('.won-rfq-btn2').removeClass('d-none');
    })
    $(document).on('click','.won-sub',function(){
    
        $('.rfq-sub').trigger('click');
    });
       $(document).on('click','.sts-update',function(e){
        e.preventDefault();
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            $.ajax({
                url: "{{ route('wonproject.status') }}",
                method: 'post',
                data: {
                    id:$('#won_id').val(),
                    status: "1",
                 },
                success: function(result){
                     if(result.success == 1)
                       {
                        swal({
                            title:'Status Updated Successfully',
                            icon:'success',
                            button:false
                        })
                       window.location = "{{route('wonproject.completed')}}";
                       }else{
                           swal({
                            title: result.message,
                            type: "warning",
                             dangerMode: true,
                         
                        })
                        
                       }
                    
                    }
                
            });
        });
        $(document).on('click','.sts-no',function(e){
            window.location = "{{route('wonproject.index')}}";
        });
</script>     

@endsection

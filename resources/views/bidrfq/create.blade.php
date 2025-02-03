@extends('layouts.master')

<style>
    .bid-table {
        display: flex;
        flex-wrap: nowrap;
        /* ✅ Keeps tables in the same row */
        gap: 15px;
        /* ✅ Ensures spacing between tables */
        align-items: flex-start;
        justify-content: flex-start;
        // overflow-x: auto; /* ✅ Allows scrolling if too many tables */
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
        //min-width: 700px;
        /* ✅ Ensures country tables don't collapse */
        //max-width: 100%;
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

    .removetable {
        position: absolute;
        top: -20px;
        /* ✅ Moves button to the top */
        right: 0px;
        /* ✅ Aligns button to the right */
        z-index: 10;
        /* ✅ Ensure button stays above content */
    }

    .table-wrapper {
        display: flex;
        flex-wrap: nowrap;
        justify-content: space-between;
    }

    .add-country {
        flex: 1 1 30%;
        /* ✅ Ensures three tables fit inside the row */
        min-width: 300px;
        border: 1px solid #ccc;
        padding: 10px;
    }












    a.ml-2.btn.btn-primary {
        float: right;
    }

    .main-panel {
        background-color: #f8f8f8;
    }

    .card {
        margin: 40px 0 20px 0;
        border: 1px solid;
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

    tr {
        border: 1px solid #aaa;
        border-color: rgb(0 123 255 / 25%);
    }

    button#addBtn {
        margin-bottom: 19px;
        float: right;
    }

    /* label.form-group.has-float-label {
    margin-right: 62px;
}*/
    th.hidden {
        display: none;
    }

    input.border-0 {
        margin-right: 14px;
    }

    select.form-control.label-gray-3 {
        color: #6e6868;
    }

    button#removeBtn {
        margin: 0px 0 17px 0;
    }

    button#removeBtn {
        font-size: 10px;
        padding-left: 11px;
    }

    label.form-group.has-float-label span {
        margin: -6px;
    }

    /* currency */

    label.my-currency {
        margin-left: 3px;
        position: absolute;
        margin-top: 4px;
    }

    button#addvendor {
        float: right;
    }

    .removevendor {
        top: 84px;
        margin-left: 165px;
        margin-top: 1px;
        position: absolute;
        font-size: 14px;
        color: #eb3030;
        z-index: 7;
    }

    input.total_cost.border.valid {
        padding-left: 10px;
    }

    input.total_cost.border.valid {
        padding-left: 10px;
    }

    .error {
        color: red;
        padding-top: 5px;
    }

    .format-btn-1.active,
    .format-btn-2.active {
        background-color: #007bff;
        /* Active button background color */
        border-color: #007bff;
        /* Active button border color */
        color: #fff;
        /* Active button text color */
    }

    /* Non-active button styling */
    .format-btn-1:not(.active),
    .format-btn-2:not(.active) {
        background-color: #f8f9fa;
        /* Default button background color */
        color: #000;
        /* Default button text color */
    }

    /* Text color for active button */
</style>
@section('page_title', 'BidRfq Form')
@section('content')
    <script>
        $(document).ready(function() {
            var format = 1; // Default format is Format 1

            // Format 2 Button Click
            $('.format-btn-2').click(function() {
                $("#register")[0].reset();
                $('.format-2').addClass('d-none'); // Hide elements for Format 2
                format = 2;
                $('.format').html('Format - 2');

                // Toggle active class
                $('.format-btn-2').addClass('active');
                $('.format-btn-1').removeClass('active');
            });

            // Format 1 Button Click
            $('.format-btn-1').click(function() {
                $("#register")[0].reset();
                $('.format-2').removeClass('d-none'); // Show elements for Format 1
                format = 1;
                $('.format').html('Format - 1');

                // Toggle active class
                $('.format-btn-1').addClass('active');
                $('.format-btn-2').removeClass('active');
            });
            $('.addBtn').click(function() {
                console.log('✅ Add Country button clicked!');

                // ✅ Dynamically find any container that might be a valid parent
                var sectionWrapper = $(this).closest('*').hasClass('rfq-table') ? $(this).closest(
                        '.rfq-table') :
                    $(this).closest('*').hasClass('country-wrapper') ? $(this).closest('.country-wrapper') :
                    $(this).closest('*').hasClass('container') ? $(this).closest('.container') :
                    $(this).closest('*').hasClass('main-wrapper') ? $(this).closest('.main-wrapper') :
                    null;

                if (!sectionWrapper || sectionWrapper.length === 0) {
                    console.warn("⚠ No valid parent found in direct selectors. Trying absolute search...");
                    sectionWrapper = $('body').find(
                        '.rfq-table, .country-wrapper, .container, .main-wrapper').first();

                    if (!sectionWrapper || sectionWrapper.length === 0) {
                        console.error("❌ No valid parent container found. Exiting...");
                        return;
                    }
                }

                console.log('✅ Correct Parent Container Found:', sectionWrapper);

                // ✅ Find or create the `.bid-table` inside the correct section
                var parentRow = sectionWrapper.find('.bid-table');

                if (parentRow.length === 0) {
                    console.warn("⚠ .bid-table NOT found, creating one inside the correct section...");
                    sectionWrapper.append('<div class="flex-wrap bid-table d-flex"></div>');
                    parentRow = sectionWrapper.find('.bid-table');
                }

                var d = 1 + parseInt($('.add-country').last().attr("data-by") || 0);
                var i = parseInt($(this).attr('attr'));
                var o = 1 + parseInt($('.bidrfq-client').last().attr("data-id") || 1);
                console.log(`✅ Adding country table, Data-by: ${d}`);

                var html = `
                    <div class="country-wrapper" data-by="${d}">
                        <div class="btn-var"></div>
                        <div class=" d-flex">
                        <table class="table table-striped add-country" id="main-table" data-by="${d}">
                            <tr>
                                <td>
                                    <label class="form-group has-float-label">
                                        <select class="form-control label-gray-3" name="country_0[${d}][]" required>
                                            <option class="label-gray-3" value="">Country</option>
                                            @if (count($country) > 0)
                                                @foreach ($country as $v)
                                                    <option value="{{ $v->name }}">{{ $v->name }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </label>
                                </td>
                                <td>
                                    <button class="ml-2 btn btn-success addvendor" data-vendor="${i}" data-count="${d}" type="button">
                                        Add table
                                    </button>
                                </td>
                                <td>
                                    <button class="ml-2 btn btn-danger removecountry" type="button">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">
                                    <div class="nested-table-group nested-table-group-${d} d-flex flex-nowrap">
                                        <table class="sub-table">
                                            <tbody class="sub-body_${i}">
                                                <tr class="first-row">
                                                    <td>Client/Vendor Name</td>
                                                    <td>
                                                        <select class="form-control label-gray-3" name="client_id_0[${d}][]" required>
                                                            <option class="label-gray-3" value="">Client</option>
                                                            @if (count($client) > 0)
                                                                @foreach ($client as $v)
                                                                    <option value="{{ $v->client_name }}">{{ $v->client_name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="form-control label-gray-3" name="vendor_id_0[${d}][]" required>
                                                            <option class="label-gray-3" value="">Vendor</option>
                                                            @if (count($vendor) > 0)
                                                                @foreach ($vendor as $v)
                                                                    <option value="{{ $v->vendor_name }}">{{ $v->vendor_name }}</option>
                                                                @endforeach
                                                            @endif
                                                        </select>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Methodology</td>
                                                    <td><input type="text" class='txtCal' value="0" name="methodology_0[${d}][]" placeholder="Methodology"></td>
                                                    <td><input type="text" class="txtbol" value="0" name="methodology_0[${d}][]" placeholder="Methodology"></td>
                                                </tr>
                                                <tr>
                                                    <td>Sample Size</td>
                                                    <td><input type="text" class='txtCal' value="0" name="sample_size_0[${d}][]" placeholder="Sample Size"></td>
                                                    <td><input type="text" class="txtbol" value="0" name="sample_size_0[${d}][]" placeholder="Sample Size"></td>
                                                </tr>
                                                <tr>
                                                    <td>Setup Cost</td>
                                                    <td class="bidrfq-client" data-id="${o}"><input type="text" class='txtCal' value="0" placeholder="Setup Cost" name="setup_cost_0[${d}][]"></td>
                                                    <td class="bidrfq-client" data-id="${o + 1}"><input type="text" class="txtbol" value="0" placeholder="Setup Cost" name="setup_cost_0[${d}][]"></td>
                                                </tr>
                                                <tr>
                                                    <td>Recruitment</td>
                                                    <td class="bidrfq-client" data-id="${o}"><input type="text" class='txtCal' value="0" placeholder="Recruitment" name="recruitment_0[${d}][]"></td>
                                                    <td><input type="text" class="txtbol" value="0" placeholder="Recruitment" name="recruitment_0[${d}][]"></td>
                                                </tr>
                                                <tr>
                                                    <td>Incentives</td>
                                                    <td class="bidrfq-client" data-id="${o}"><input type="text" class='txtCal' value="0" placeholder="Incentives" name="incentives_0[${d}][]"></td>
                                                    <td><input type="text" class="txtbol" value="0" placeholder="Incentives" name="incentives_0[${d}][]"></td>
                                                </tr>
                                                <tr>
                                                    <td>Moderation</td>
                                                    <td class="bidrfq-client" data-id="${o}"><input type="text" class='txtCal' value="0" placeholder="Moderation" name="moderation_0[${d}][]"></td>
                                                    <td><input type="text" class="txtbol" value="0" placeholder="Moderation" name="moderation_0[${d}][]"></td>
                                                </tr>
                                                <tr>
                                                    <td>Transcript</td>
                                                    <td class="bidrfq-client" data-id="${o}"><input type="text" class='txtCal' value="0" placeholder="Transcript" name="transcript_0[${d}][]"></td>
                                                    <td><input type="text" class="txtbol" value="0" placeholder="Transcript" name="transcript_0[${d}][]"></td>
                                                </tr>
                                                <tr>
                                                    <td>Others</td>
                                                    <td class="bidrfq-client" data-id="${o}"><input type="text" class='txtCal' value="0" placeholder="Others" name="others_0[${d}][]"></td>
                                                    <td><input type="text" class="txtbol" value="0" placeholder="Others" name="others_0[${d}][]"></td>
                                                </tr>
                                                <tr>
                                                    <td class="my-currency">Total Costs</td>
                                                    <td><input type="text" class="border total_cost" placeholder="Total Cost" name="total_cost_0[${d}][]"></td>
                                                    <td><input type="text" class="border total_cost" placeholder="Total Cost" name="total_cost_0[${d}][]"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        </div>
                    </div>`;

                parentRow.append(html);


                $(document).on('click', '.removecountry', function() {
                    $(this).closest('.country-wrapper').remove();
                });
                $('.addbtn').attr('attr', i + 1);

            });



            $(document).on('click', '.addvendor', function() {
                console.log('✅ Add Vendor button clicked!');
                let attr = $(this).attr('data-count');
                console.log(attr);
                var firstTable = $('.nested-table-group-'+attr).find('.sub-table:first');
                var tableCount = $('.nested-table-group-'+attr).find('.nested-table-group .table-group').length + 1;
                var tableGroup = $('<div class="table-group d-flex"></div>');
                
                for (let i = 0; i < 2; i++) {
                    var newTable = firstTable.clone();
                    newTable.find('tr').show();
                    newTable.attr('data-by', tableCount);
                    newTable.find('input, select').each(function() {
                        var name = $(this).attr('name');
                        if (name) {
                            var updatedName = name.replace(/\[\d+\]/g, `[${attr}]`);
                            $(this).attr('name', updatedName);
                        }
                        if($(this).attr('type') == "text")
                        {
                            $(this).val(0);
                        }
                        $(this).val();
                    });

                    tableGroup.append(newTable);
                }
                var removeButton = $(`  
                    <button class="p-2 ml-2 btn btn-danger removetable" type="button">
                        <i class="fa-solid fa-xmark"></i> 
                    </button>
                `);
                tableGroup.append(removeButton);
                // ✅ Ensure the tables are added to the correct container!
                $('.nested-table-group-'+attr).append(tableGroup); // ✅ Appends inside the correct container

                console.log("✅ Table pair successfully added inside the correct container"); //


                $(document).on('click', '.removetable', function() {
                    $(this).closest('.table-group').remove(); // ✅ Remove both tables together
                });
            });

            //$('.addvendor').attr('data-vendor', i);

        });
    </script>




    {{-- calculate --}}

    <script>
        $(document).ready(function() {

            $(document).on('keyup', 'td input:not(input[name^="sample_size"])', function() {
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
                // console.log(sum);
                // var id = $(this).parent().data('id');
                // var sum = 0;
                // $($(this).closest('table').find('td:nth-child(' + id +
                //     ') input:not(input[name^="sample_size"])')).each(function(i, v) {
                //     if ($(this).val() != '' && i != 6) {
                //         sum += Number($(this).val());
                //         console.log(i + $(this).val());
                //     }
                // });
                // $($(this).closest('table').find('td:nth-child(' + id + ') input.total_cost')).val(sum);
            });

        });
    </script>


    <script>
        $(document).ready(function() {
            $("#register").validate({
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
                    currency: {
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
                    sample_size: {
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
                        url: "{{ route('bidrfq.store') }}",
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
        $(document).on('click', '#addvendor', function() {
            $('#mtable tr  ').append();

        })
    </script>


{{-- 
<script>
        
        
        $(document).on('change', '#currency', function() {
            
            
            
            var cur = $(this).val();
            
        
            $('.my-currency').html(cur);
            
            $(".total_cost.border").removeAttr("placeholder");
            

            
        });
        
        
    </script> --}}



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

                            <form id="{{ $bidrfq && $bidrfq->id ? 'update' : 'register' }}"
                                class="flex-wrap form col-md-12 d-flex" enctype="multipart/form-data">
                                @csrf


                                <input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">RFQ No <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="rfq_no" value="{{ $rfq_no }}" readonly="readonly"
                                                type="text" class="form-control" placeholder="RFQ NO">
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
                                            <!-- <input name="industry" value="{{ $bidrfq && $bidrfq->industry ? $bidrfq->industry : '' }}"
                                                type="text" class="form-control" placeholder="Industry"> -->
                                            <select class="form-control label-gray-3" name="industry">
                                                <option class="label-gray-3" value="" disabled selected>Select
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
                                                value="{{ $bidrfq && $bidrfq->follow_up_date ? $bidrfq->follow_up_date : '' }}"
                                                type="date" class="form-control" placeholder="Follow Up date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">Choose Currency<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">

                                            <select class="form-control label-gray-3" name="currency" id="currency">
                                                <option class="label-gray-3" value="" disabled selected>Select
                                                    Currency
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
                                        <label class="col-lg-3 col-form-label font-weight-semibold">
                                            Choose Company<span class="text-danger">*</span>
                                        </label>
                                        <div class="col-lg-9">
                                            <select class="form-control label-gray-3" name="company_name"
                                                id="company_name" required>
                                                <option class="label-gray-3" value="" disabled selected>Select
                                                    Company</option>
                                                <option value="Asia Research Partners">Asia Research Partners</option>
                                                <option value="Universal Research Panels">Universal Research Panels
                                                </option>
                                                <option value="Healthcare Panels India">Healthcare Panels India</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12" style="overflow-x:auto;">
                                    <div class="form-group row">
                                        <label class="col-lg-12 col-form-label font-weight-semibold">
                                            Industry Table<span class="text-danger">*</span>
                                        </label>
                                        <button class="ml-2 btn btn-success addBtn" id="addBtn" attr="1"
                                            type="button" data-count="0">
                                            Add Country
                                        </button>

                                        <div class="mb-4 col-md-12 d-flex align-items-center justify-content-center">
                                            <button class="btn btn-success d-none format-btn-1 active" type="button">
                                                Qualitative RFQs
                                            </button>
                                            <button class="ml-2 btn btn-secondary format-btn-2 d-none" type="button">
                                                Quantitative RFQs
                                            </button>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="rfq-table">
                                                <div class="btn-var"></div>
                                                <div class="bid-table d-flex">
                                                    <table class="table table-striped add-country" id="main-table"
                                                        data-by="0">
                                                        <!-- Country Selection -->
                                                        <tr>
                                                            <td>
                                                                <label class="form-group has-float-label">
                                                                    <select class="form-control label-gray-3"
                                                                        name="country_0[0][]" required>
                                                                        <option class="label-gray-3" value="">
                                                                            Country</option>
                                                                        @if (count($country) > 0)
                                                                            @foreach ($country as $v)
                                                                                <option value="{{ $v->name }}">
                                                                                    {{ $v->name }}</option>
                                                                            @endforeach
                                                                        @endif
                                                                    </select>
                                                                </label>
                                                            </td>
                                                            <td></td>
                                                            <td>
                                                                <button class="float-left ml-2 btn btn-success addvendor"
                                                                    data-vendor="0" data-count="0" type="button">
                                                                    Add table
                                                                </button>
                                                            </td>
                                                        </tr>

                                                        <!-- Client/Vendor Name -->
                                                        <tr>
                                                            <td>
                                                                <div class="nested-table-group nested-table-group-0 d-flex flex-nowrap">
                                                                    <table class="sub-table">
                                                                        <tbody class="sub-body_0">
                                                                            <tr class="first-row">
                                                                                <td>Client/Vendor Name</td>
                                                                                <td>
                                                                                    <select class="form-control label-gray-3"
                                                                                        name="client_id_0[0][]" required>
                                                                                        <option class="label-gray-3"
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
                                                                                <td class="v">
                                                                                    <select class="form-control label-gray-3"
                                                                                        name="vendor_id_0[0][]" required>
                                                                                        <option class="label-gray-3"
                                                                                            value="">Vendor</option>
                                                                                        @if (count($vendor) > 0)
                                                                                            @foreach ($vendor as $v)
                                                                                                <option
                                                                                                    value="{{ $v->vendor_name }}">
                                                                                                    {{ $v->vendor_name }}
                                                                                                </option>
                                                                                            @endforeach
                                                                                        @endif
                                                                                    </select>
                                                                                </td>
                                                                            </tr>
                                                                            
                                                                            <tr>
                                                                                <td class="sub-cost">Methodology</td>
                                                                                <td class="remove">
                                                                                    <input type="text" class="txtCal" value="0"
                                                                                        name="methodology_0[0][]"
                                                                                        placeholder="Methodology">
                                                                                </td>
                                                                                <td class="remove">
                                                                                    <input type="text" class="txtbol" value="0"
                                                                                        name="methodology_0[0][]"
                                                                                        placeholder="Methodology">
                                                                                </td>
                                                                            </tr>

                                                                            <!-- Sample Size -->
                                                                            <tr>
                                                                                <td class="sub-cost">Sample Size</td>
                                                                                <td class="remove">
                                                                                    <input type="text" class="txtCal" value="0"
                                                                                        name="sample_size_0[0][]"
                                                                                        placeholder="Sample Size">
                                                                                </td>
                                                                                <td class="remove">
                                                                                    <input type="text" class="txtbol" value="0"
                                                                                        name="sample_size_0[0][]"
                                                                                        placeholder="Sample Size">
                                                                                </td>
                                                                            </tr>
    
                                                                            <!-- Setup Cost -->
                                                                            <tr>
                                                                                <td>Setup Cost</td>
                                                                                <td class="bidrfq-client" data-id="2">
                                                                                    <input type="text" class="txtCal" value="0"
                                                                                        placeholder="Setup Cost"
                                                                                        name="setup_cost_0[0][]">
                                                                                </td>
                                                                                <td class="bidrfq-vendor" data-id="3">
                                                                                    <input type="text" class="txtbol" value="0"
                                                                                        placeholder="Setup Cost"
                                                                                        name="setup_cost_0[0][]">
                                                                                </td>
                                                                            </tr>
    
                                                                            <!-- Recruitment -->
                                                                            <tr>
                                                                                <td>Recruitment</td>
                                                                                <td class="bidrfq-client" data-id="2">
                                                                                    <input type="text" class="txtCal" value="0"
                                                                                        placeholder="Recruitment"
                                                                                        name="recruitment_0[0][]">
                                                                                </td>
                                                                                <td class="bidrfq-vendor" data-id="3">
                                                                                    <input type="text" class="txtbol" value="0"
                                                                                        placeholder="Recruitment"
                                                                                        name="recruitment_0[0][]">
                                                                                </td>
                                                                            </tr>
    
                                                                            <!-- Incentives -->
                                                                            <tr>
                                                                                <td>Incentives</td>
                                                                                <td class="bidrfq-client" data-id="2">
                                                                                    <input type="text" class="txtCal" value="0"
                                                                                        placeholder="Incentives"
                                                                                        name="incentives_0[0][]">
                                                                                </td>
                                                                                <td class="bidrfq-vendor" data-id="3">
                                                                                    <input type="text" class="txtbol" value="0"
                                                                                        placeholder="Incentives"
                                                                                        name="incentives_0[0][]">
                                                                                </td>
                                                                            </tr>
    
                                                                            <!-- Moderation -->
                                                                            <tr class="format-2">
                                                                                <td>Moderation</td>
                                                                                <td class="bidrfq-client" data-id="2">
                                                                                    <input type="text" class="txtCal" value="0"
                                                                                        placeholder="Moderation"
                                                                                        name="moderation_0[0][]">
                                                                                </td>
                                                                                <td class="bidrfq-vendor" data-id="3">
                                                                                    <input type="text" class="txtbol" value="0"
                                                                                        placeholder="Moderation"
                                                                                        name="moderation_0[0][]">
                                                                                </td>
                                                                            </tr>
    
                                                                            <!-- Transcript -->
                                                                            <tr class="format-2">
                                                                                <td>Transcript</td>
                                                                                <td class="bidrfq-client" data-id="2">
                                                                                    <input type="text" class="txtCal" value="0"
                                                                                        placeholder="Transcript"
                                                                                        name="transcript_0[0][]">
                                                                                </td>
                                                                                <td class="bidrfq-vendor" data-id="3">
                                                                                    <input type="text" class="txtbol" value="0"
                                                                                        placeholder="Transcript"
                                                                                        name="transcript_0[0][]">
                                                                                </td>
                                                                            </tr>
    
                                                                            <!-- Others -->
                                                                            <tr>
                                                                                <td>Others</td>
                                                                                <td class="bidrfq-client" data-id="2">
                                                                                    <input type="text" class="txtCal" value="0"
                                                                                        placeholder="Others"
                                                                                        name="others_0[0][]">
                                                                                </td>
                                                                                <td class="bidrfq-vendor" data-id="3">
                                                                                    <input type="text" class="txtbol" value="0"
                                                                                        placeholder="Others"
                                                                                        name="others_0[0][]">
                                                                                </td>
                                                                            </tr>
    
                                                                            <!-- Total Cost -->
                                                                            <tr>
                                                                                <td>Total Cost</td>
                                                                                <td>
                                                                                    <label class="my-currency"></label>
                                                                                    <input type="text"
                                                                                        class="border total_cost"
                                                                                        placeholder="Total Cost"
                                                                                        name="total_cost_0[0][]">
                                                                                </td>
                                                                                <td>
                                                                                    <label class="my-currency"></label>
                                                                                    <input type="text"
                                                                                        class="border total_cost"
                                                                                        placeholder="Total Cost"
                                                                                        name="total_cost_0[0][]">
                                                                                </td>
                                                                            </tr>
    
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </td>
                                                        </tr>

                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>

                                </div>
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
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
@endsection

@section('css')
    <style>
        .error {
            color: red;
            font-size: 11px;
            font-weight: bold;
        }
    </style>
@endsection

@push('js')
@endpush

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
    .format-btn-1.active, .format-btn-2.active {
    background-color: #007bff; /* Active button background color */
    border-color: #007bff;    /* Active button border color */
    color: #fff;              /* Active button text color */
}

/* Non-active button styling */
.format-btn-1:not(.active), .format-btn-2:not(.active) {
    background-color: #f8f9fa; /* Default button background color */
    color: #000;               /* Default button text color */
}           /* Text color for active button */

</style>
@section('page_title', 'BidRfq Form')
@section('content')
<script>
    $(document).ready(function () {
        var format = 1; // Default format is Format 1

        // Format 2 Button Click
        $('.format-btn-2').click(function () {
            $("#register")[0].reset();
            $('.format-2').addClass('d-none'); // Hide elements for Format 2
            format = 2;
            $('.format').html('Format - 2');

            // Toggle active class
            $('.format-btn-2').addClass('active');
            $('.format-btn-1').removeClass('active');
        });

        // Format 1 Button Click
        $('.format-btn-1').click(function () {
            $("#register")[0].reset();
            $('.format-2').removeClass('d-none'); // Show elements for Format 1
            format = 1;
            $('.format').html('Format - 1');

            // Toggle active class
            $('.format-btn-1').addClass('active');
            $('.format-btn-2').removeClass('active');
        });
        $('.addbtn').click(function () {
            var d = 1 + parseInt($('.add-country').last().attr("data-by"));
            var i = $(this).attr('attr');
            var o = 1 + parseInt($('.bidrfq-client').last().attr("data-id"));
            console.log(d);
            var html = '';
            html += `<table class="table table-striped add-country" id="main-table" data-by="${d}" >
                      <tr>
                       <td>
                         <label class="form-group has-float-label">
                            <select class="form-control label-gray-3" name="country_0[${d}][]" required>
                               <option class="label-gray-3" value="">Country</option>
                                  @if(count($country) > 0)
                                    @foreach($country as $v)
                                     <option value="{{$v->name}}">{{$v->name}}</option>
                                         @endforeach
                                            @endif
                                    </select>
                                             </label>
                                            
                                        
                                </td>
                                <td>
                                <button class="btn btn-success  ml-2 float-left addvendor" data-vendor="${i}"  data-count="${d}" type="button">
                                        Add vendor
                                    </button>
                                </td>
                                <td>
                                <button class="btn btn-danger  ml-2 float-left removebtn"  type="button">
                                        <i class="fa-solid fa-xmark"></i>
                            </button>
                                </td>
                            </tr>
                            


                            <tr>
                            <td>
                            <table>
                            <tbody class="sub-body_${i}">

                            
                                <tr class="first-row">
                                    <div class="d-flex">
                                        <td></td>
                                    <td>
                                        <select class="form-control label-gray-3" name="client_id_0[${d}][]" required>
                                        <option class="label-gray-3" value="">Client</option>
                                            @if(count($client) > 0)
                                            @foreach($client as $v)
                                        <option value="{{$v->client_name}}">{{$v->client_name}}</option>
                                        
                                            @endforeach
                                            @endif
                                    </select>
                                    </td>
                                    <td class="remove">
                                    
                                        
                                    <select class="form-control label-gray-3" name="vendor_id_0[${d}][]" required>
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
                                
                                
                                <td class="remove">

                                    
                                    
                                    <input  type="text" class='txtCal'  name="sample_size_0[${d}][]" placeholder="Sample Size">
                                    </div>
                                </td>
                                
                                <td class="remove">
                                    
                                    <input type="text" class="txtbol" name="sample_size_0[${d}][]" placeholder="Sample Size">
                                    </div>
                                </td>
                                
                            </tr>
                            

                            <tr>
                                <td></td>
                                
                                <td class="bidrfq-client" data-id="2">
                                    

                                    
                                    <input type="text" class='txtCal' placeholder="Setup Cost" name="setup_cost_0[${d}][]">
                                    
                                </td>
                                
                                    <td  class="bidrfq-client" data-id="3"><input type="text" class="txtbol" placeholder="Setup Cost" name="setup_cost_0[${d}][]"></td>
                                </tr>
                            <tr>
                                <td></td>
                                
                                <td  class="bidrfq-client" data-id="2">
                                    
                                    <input type="text" class='txtCal' placeholder="Recruitment" name="recruitment_0[${d}][]">
                                    

                                
                                </td>
                                <td data-id="3"><input type="text" class="txtbol" placeholder="Recruitment" name="recruitment_0[${d}][]"></td>
                                </tr>
                            <tr>
                                <td></td>
                                
                                <td  class="bidrfq-client" data-id="2">
                                    
                                    <input type="text" class='txtCal' placeholder="Incentives" name="incentives_0[${d}][]">
                                
                                </td>

                                <td  data-id="3">
                                    <input type="text" class="txtbol" placeholder="Incentives" name="incentives_0[${d}][]"></td>
                                </tr>
                            <tr class="format-2 ${format == 2 ? 'd-none' : ''}">
                                <td></td>
                                
                                <td class="bidrfq-client" data-id="2">
                                    
                                        <input type="text" class='txtCal' placeholder="Moderation" name="moderation_0[${d}][]">

                                    
                                </td>
                                    
                                <td data-id="3"><input type="text" class="txtbol" placeholder="Moderation" name="moderation_0[${d}][]"></td>
                                    </tr>
                            <tr class="format-2 ${format == 2 ? 'd-none' : ''}">
                                <td></td>
                                
                                <td class="bidrfq-client" data-id="2">
                                    
                                        <input type="text"class='txtCal' placeholder="Transcript" name="transcript_0[${d}][]">
                                    
                                    </td>
                                <td data-id="3"><input type="text" class="txtbol" placeholder="Transcript" name="transcript_0[${d}][]"></td>
                                    </tr>
                            <tr>
                                <td></td>
                                
                                <td class="bidrfq-client" data-id="2">
                                    <input type="text" class='txtCal' placeholder="Others" name="others_0[${d}][]">
                                    
                                    </td>
                                <td class="bidrfq-vendor" data-id="3"><input type="text" class="txtbol" placeholder="Others" name="others_0[${d}][]"></td>
                                </tr>
                            <tr>
                                <td></td>
                                
                                
                                <td> <label class="my-currency"></label>
                                    <input type="text" class="total_cost border" placeholder="Total Cost" name="total_cost_0[${d}][]"></b></td>
                                
                                <td> <label class="my-currency"></label>
                                    <input type="text" class="total_cost border" placeholder="Total Cost" name="total_cost_0[${d}][]"></td>
                            </tr>


                                
                                </div>
                                </tr>
                                </tbody>
                                </table>
                            </td>



                                        <tr>
                                        </table>`;

            $('.bid-table').append(html);

            $(document).on('click', '.removebtn', function () {
                $(this).closest('table').remove();
            });
            $('.addbtn').attr('attr', i + 1);

        });



        $(document).on('click', '.addvendor', function () {
            var i = $('.addbtn').attr('attr');
            var j = $(this).attr('data-vendor');
            console.log($(this).closest('tbody').find('table .bidrfq-vendor:last-child').html());
            var k = 1 + parseInt($(this).closest('tbody').find('table .bidrfq-vendor:last-child').attr(
                "data-id"));

            if ($('.sub-body_' + j + ' tr').length != 0) {
                for (i = 0; i < 2; i++) {
                    $.each($('.sub-body_' + j + ' tr'), function (index, value) {
                        if (i == 0) {
                            $(value).append(
                                "<td class='bidrfq-vendor' id='col-vendor' data-id=" + k +
                                ">" + $(value).find('td:nth-child(3)').html() + "</td>");

                        }
                    })
                }
                $('.sub-body_' + j).find('.first-row td:last-child').append(
                    "<div class='removevendor'><i class='fa-solid fa-circle-minus'></i></div>");
            }

            $(document).on('click', '.removevendor', function () {
                $(this).parent().parent().parent().find('tr td:last-child').remove();

            });
        });
        $('.addvendor').attr('data-vendor', i);

    });
</script>




{{--calculate--}}

<script>
    $(document).ready(function () {

        $(document).on('keyup', 'td input:not(input[name^="sample_size"])', function () {
            // code logic here
            var id = $(this).parent().data('id');
            console.log($(this).closest('table').find('td:nth-child(' + id +
                ') input:not(input[name^="sample_size"])'));
            var sum = 0;
            $($(this).closest('table').find('td:nth-child(' + id +
                ') input:not(input[name^="sample_size"])')).each(function (i, v) {
                if ($(this).val() != '' && i != 6) {
                    sum += Number($(this).val());
                    console.log(i + $(this).val());
                }
            });
            $($(this).closest('table').find('td:nth-child(' + id + ') input.total_cost')).val(sum);
        });

    });
</script>


<script>
    $(document).ready(function () {
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
                    url: "{{route('bidrfq.store')}}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        if (data.success == 1) {
                            swal({
                                title: 'Success',
                                text: 'RFQ Added Successfully',
                                icon: 'success',
                                button: false
                            })
                            $('#register').get(0).reset();
                            window.location = "{{route('bidrfq.index')}}";
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
    $(document).on('click', '#addvendor', function () {
        $('#mtable tr  ').append();

    })
</script>



<!--<script>-->
<!--    $(document).on('change','#currency',function(){-->
<!--        var cur = $(this).val();-->
<!--        $('.my-currency').html(cur);-->
<!--        $(".total_cost.border").removeAttr("placeholder");-->

<!--    });-->
<!--</script>-->



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

                        <form id="{{ $bidrfq && $bidrfq->id ? 'update' : 'register'}}"
                            class="form col-md-12 d-flex flex-wrap" enctype="multipart/form-data">
                            @csrf


                            <input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount">
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">RFQ No <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="rfq_no" value="{{$rfq_no}}" readonly="readonly" type="text"
                                            class="form-control" placeholder="RFQ NO">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Date<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">

                                        <input name="date" value="{{ date('Y-m-d') }}" type="date" class="form-control "
                                            placeholder="Date">


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Industry<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <!-- <input name="industry" value="{{$bidrfq && $bidrfq->industry ? $bidrfq->industry : ''}}"
                                            type="text" class="form-control" placeholder="Industry"> -->
                                        <select class="form-control label-gray-3" name="industry">
                                            <option class="label-gray-3" value="" disabled selected>Select Industry
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
                                            value="{{$bidrfq && $bidrfq->follow_up_date ? $bidrfq->follow_up_date : ''}}"
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
                                            <option class="label-gray-3" value="" disabled selected>Select Currency
                                            </option>
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
                                    <label class="col-lg-12 col-form-label font-weight-semibold">Industry Table<span
                                            class="text-danger">*</span></label>
                                    <button class="btn btn-success  ml-2 addBtn" id="addBtn" attr="1" type="button"
                                        data-count="0">
                                        Add Country
                                    </button>
                                    <div class="col-md-12 d-flex align-items-center justify-content-center mb-4">
                                        <button class="btn btn-sucess format-btn-1 active" type="button">
                                            Format 1
                                        </button>
                                        <button class="btn btn-seconday format-btn-2 ml-2" type="button">
                                            Format 2
                                        </button>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="rfq-table">
                                            <div class="btn-var">





                                            </div>

                                            <div class="bid-table d-flex">

                                                <table class="table table-striped add-country" id="main-table"
                                                    data-by="0">

                                                    <!-- country -->
                                                    <tr>





                                                        <td>

                                                            <label class="form-group has-float-label">
                                                                <select class="form-control label-gray-3"
                                                                    name="country_0[0][]" required>
                                                                    <option class="label-gray-3" value="">Country
                                                                    </option>
                                                                    @if(count($country) > 0)
                                                                    @foreach($country as $v)
                                                                    <option value="{{$v->name}}">{{$v->name}}</option>
                                                                    @endforeach
                                                                    @endif
                                                                </select>

                                                            </label>


                                                        </td>
                                                        <td></td>
                                                        <td>
                                                            <button class="btn btn-success  ml-2 float-left addvendor"
                                                                data-vendor="0" data-count="0" type="button">
                                                                Add vendor
                                                            </button>
                                                        </td>

                                                    </tr>
                                                    <!--end country -->


                                                    <tr>
                                                        <td>


                                                            <table class="sub-table">
                                                                <tbody class="sub-body_0">

                                                                    <!-- client/vendor name  -->

                                                                    <tr class="first-row">

                                                                        <div class="d-flex">
                                                                            <td>Client/Vendor Name</td>
                                                                            <td>
                                                                                <select
                                                                                    class="form-control label-gray-3"
                                                                                    name="client_id_0[0][]" required>
                                                                                    <option class="label-gray-3"
                                                                                        value="">Client</option>
                                                                                    @if(count($client) > 0)
                                                                                    @foreach($client as $v)
                                                                                    <option value="{{$v->client_name}}">
                                                                                        {{$v->client_name}}</option>

                                                                                    @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </td>


                                                                            <td class="v">


                                                                                <select
                                                                                    class="form-control label-gray-3"
                                                                                    name="vendor_id_0[0][]" required>
                                                                                    <option class="label-gray-3"
                                                                                        value="">Vendor</option>
                                                                                    @if(count($vendor) > 0)
                                                                                    @foreach($vendor as $v)
                                                                                    <option value="{{$v->vendor_name}}">
                                                                                        {{$v->vendor_name}}</option>
                                                                                    @endforeach
                                                                                    @endif
                                                                                </select>
                                                                            </td>

                                                                    </tr>

                                                                    <!-- end client/vendor name  -->


                                                                    <!-- sample size -->
                                                                    <tr>


                                                                        <td class="sub-cost">Sample Size</td>


                                                                        <td class="remove">



                                                                            <input type="text" class='txtCal'
                                                                                name="sample_size_0[0][]"
                                                                                placeholder="Sample Size">
                                            </div>
                                            </td>

                                            <td class="remove">

                                                <input type="text" class="txtbol" name="sample_size_0[0][]"
                                                    placeholder="Sample Size">
                                        </div>
                                        </td>

                                        </tr>
                                        <!--end sample size -->

                                        <tr>
                                            <td>Setup Cost</td>

                                            <td data-id="2" class="bidrfq-client">



                                                <input type="text" class='txtCal' placeholder="Setup Cost"
                                                    name="setup_cost_0[0][]">

                                            </td>

                                            <td class="bidrfq-vendor" data-id="3"><input type="text" class="txtbol"
                                                    placeholder="Setup Cost" name="setup_cost_0[0][]"></td>
                                        </tr>
                                        <tr>
                                            <td>Recruitment</td>

                                            <td data-id="2" class="bidrfq-client">

                                                <input type="text" class='txtCal' placeholder="Recruitment"
                                                    name="recruitment_0[0][]">



                                            </td>
                                            <td class="bidrfq-vendor" data-id="3"><input type="text" class="txtbol"
                                                    placeholder="Recruitment" name="recruitment_0[0][]"></td>
                                        </tr>
                                        <tr>
                                            <td>Incentives</td>

                                            <td data-id="2" class="bidrfq-client">

                                                <input type="text" class='txtCal' placeholder="Incentives"
                                                    name="incentives_0[0][]">

                                            </td>

                                            <td class="bidrfq-vendor" data-id="3">
                                                <input type="text" class="txtbol" placeholder="Incentives"
                                                    name="incentives_0[0][]"></td>
                                        </tr>
                                        <tr class="format-2">
                                            <td>Moderation</td>

                                            <td data-id="2" class="bidrfq-client">

                                                <input type="text" class='txtCal' placeholder="Moderation"
                                                    name="moderation_0[0][]">


                                            </td>

                                            <td class="bidrfq-vendor" data-id="3"><input type="text" class="txtbol"
                                                    placeholder="Moderation" name="moderation_0[0][]"></td>
                                        </tr>
                                        <tr class="format-2">
                                            <td>Transcript</td>

                                            <td data-id="2" class="bidrfq-client">

                                                <input type="text" class='txtCal' placeholder="Transcript"
                                                    name="transcript_0[0][]">

                                            </td>
                                            <td class="bidrfq-vendor" data-id="3"><input type="text" class="txtbol"
                                                    placeholder="Transcript" name="transcript_0[0][]"></td>
                                        </tr>
                                        <tr>
                                            <td>Others</td>

                                            <td data-id="2" class="bidrfq-client">
                                                <input type="text" class='txtCal' placeholder="Others"
                                                    name="others_0[0][]">

                                            </td>
                                            <td class="bidrfq-vendor" data-id="3"><input type="text" class="txtbol"
                                                    placeholder="Others" name="others_0[0][]"></td>
                                        </tr>
                                        <tr>
                                            <td>Total Cost</td>


                                            <td> <label class="my-currency"></label>
                                                <input type="text" class="total_cost border" placeholder="Total Cost"
                                                    name="total_cost_0[0][]"></b></td>

                                            <td> <label class="my-currency"></label>
                                                <input type="text" class="total_cost border" placeholder="Total Cost"
                                                    name="total_cost_0[0][]"></td>
                                        </tr>



                                    </div>
                                    </tr>
                                    </tbody>
                                    </table>
                                    </td>



                                    <tr>

                                        </table>
                                </div>
                                <div>

                                </div>
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <a href="{{route('bidrfq.index')}}" class=" btn btn-outline-secondary">Back</a>
                                    <button type="submit" id="addRegisterButton"
                                        class="btn btn-success ml-2">Submit</button>

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
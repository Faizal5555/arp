@extends('layouts.master')
<style>
    .card-header.header-elements-inline {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
        color: #fff;
    }

    thead {
        background-color: #0b5dbb;
        color: #f3f2f2;
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
    .bid-table{
        pointer-events:none;
    }
</style>



@section('content')
    <script>
        $(document).ready(function() {
            $('.client-awaited').click(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                });
                $.ajax({
                    url: "{{ route('accounts.clientsent') }}",
                    method: 'post',
                    data: {
                        id: $('#id').val(),
                    },
                    success: function(result) {
                        if (result.success == 1) {
                            swal({
                                title: 'Payment Awaited Successfully',
                                icon: 'success',
                                button: false
                            })
                            // window.location="{{ route('accounts.payment') }}";
                        }
                    }
                });
            });

            $('#send-invoice').click(function() {
                $('#exampleModal').modal('show');
            });
        });


        $(document).ready(function() {
            $('#request').validate({
                rules: {
                    id: {
                        required: true
                    },
                    upload_invoice: {
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
                        url: "{{ route('accounts.uploadinvoicestore') }}",
                        data: data,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function(data) {
                            if (data.success == 1) {
                                swal({
                                    title: 'Payment Awaited Successfully',
                                    icon: 'success',
                                    button: false
                                })
                                // window.location="{{ route('accounts.payment') }}";
                                window.location.reload();
                            }
                            if (data.success == 0) {
                                swal({
                                    title: 'Please Fill Fields',
                                    icon: 'warning',
                                    buttons: false
                                })
                            }
                            if (data.success == 2) {
                                swal({
                                    title: 'Already Sent',
                                    icon: 'warning',
                                    buttons: false
                                })
                            }

                        }

                    });
                }
            });
        });

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
                                //   swal({
                                //      title:'Success',
                                //      text:'WonProject Updated Successfully',
                                //      icon:'success',
                                //      button:false
                                //  })
                                //  console.log('hii');
                                //  window.location = "{{ route('operationNew.index') }}";
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

        $(document).on('click', "#nextrfq", function() {
            $('#edit-rfq').addClass('d-none');
            $('#otherFieldDiv').removeClass('d-none');
            $('#Awaited').addClass('d-none');
        });
        $(document).on('click', "#Won_back", function() {
            $('#edit-rfq').removeClass('d-none');
            $('#otherFieldDiv').addClass('d-none');
            $('#Awaited').addClass('d-none');
        });

        $(document).on('click', "#next", function() {
            $('#edit-rfq').addClass('d-none');
            $('#otherFieldDiv').addClass('d-none');
            $('#Awaited').removeClass('d-none');
        });
        $(document).on('click', "#won-rfq", function() {
            $('#edit-rfq').addClass('d-none');
            $('#otherFieldDiv').removeClass('d-none');
            $('#Awaited').addClass('d-none');
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
                      <button class="btn btn-danger  ml-2 float-left btn-remove-country1" data-country1="${rar}"  type="button">
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
                                <button class="btn btn-success   float-left addvendor" data-button="${rar}" data-count="0"   type="button">
                                        Add vendor
                                    </button>
                                    
                                </th>
                                
                                <th>
                                <button class="btn btn-success   float-left btn-remove" data-remove="${rar}"  type="button">
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

        $(document).on('click', '.addvendor', function() {
            debugger
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


        $(document).on('click','#nextrfq',function(){
            $('.rfq-sub').trigger('click');
        });

        $(document).on('click', '.btn-remove-country1', function() {
            var tom = $(this).attr('data-country1');
            console.log('add-country_' + tom);
            $('.add-country_' + tom).remove();
        });



        $(document).on('click', '.remove-country', function() {
            var country = $(this).attr('data-remove');

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


        })

        $(document).on('click', '.btn-remove', function() {
            debugger
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

    </script>


    <div class="container-fluid">
        <div class="row" id="edit-rfq">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header header-elements-inline">
                        <div class="card-title" style="color: #fff;">Commissioned Project</div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <form id="rfq" class="form col-md-12 d-flex flex-wrap update"
                                enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id"
                                    value="{{ $bidrfq && $bidrfq->id ? $bidrfq->id : '' }}">
                                <input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount">

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">RFQ No <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="rfq_no" value="{{ $bidrfq->rfq_no }}" readonly="readonly"
                                                type="text" class="form-control" placeholder="{{ $bidrfq->rfq_no }}">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">Date<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="date"
                                                value="{{ $bidrfq && $bidrfq->date ? $bidrfq->date : '' }}" type="date"
                                                class="form-control" placeholder="Date">
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
                                            <select class="form-control label-gray-3" name="industry"
                                                placeholder="Select Industry">
                                                <option value="Manufacturing Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Manufacturing Industry' ? 'selected' : '' }}>
                                                    Manufacturing Industry</option>
                                                <option value="Production Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Production Industry' ? 'selected' : '' }}>
                                                    Production Industry</option>
                                                <option value="Food Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Food Industry' ? 'selected' : '' }}>
                                                    Food Industry</option>
                                                <option value="Agricultural Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Agricultural Industry' ? 'selected' : '' }}>
                                                    Agricultural Industry</option>
                                                <option value="Technology Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Technology Industry' ? 'selected' : '' }}>
                                                    Technology Industry</option>
                                                <option value="Construction Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Construction Industry' ? 'selected' : '' }}>
                                                    Construction Industry</option>
                                                <option value="Factory Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Factory Industry' ? 'selected' : '' }}>
                                                    Factory Industry</option>
                                                <option value="Mining Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Mining Industry' ? 'selected' : '' }}>
                                                    Mining Industry</option>
                                                <option value="Finance Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Finance Industry' ? 'selected' : '' }}>
                                                    Finance Industry</option>
                                                <option value="Retail Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Retail Industry' ? 'selected' : '' }}>
                                                    Retail Industry</option>
                                                <option value="Engineering Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Engineering Industry' ? 'selected' : '' }}>
                                                    Engineering Industry</option>
                                                <option value="Marketing Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Marketing Industry' ? 'selected' : '' }}>
                                                    Marketing Industry</option>
                                                <option value="Education Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Education Industry' ? 'selected' : '' }}>
                                                    Education Industry</option>
                                                <option value="Transport Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Transport Industry' ? 'selected' : '' }}>
                                                    Transport Industry</option>
                                                <option value="Chemical Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Chemical Industry' ? 'selected' : '' }}>
                                                    Chemical Industry</option>
                                                <option value="Healthcare Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Healthcare Industry' ? 'selected' : '' }}>
                                                    Healthcare Industry</option>
                                                <option value="Hospitality Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Hospitality Industry' ? 'selected' : '' }}>
                                                    Hospitality Industry</option>
                                                <option value="Energy Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Energy Industry' ? 'selected' : '' }}>
                                                    Energy Industry</option>
                                                <option value="Science Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Science Industry' ? 'selected' : '' }}>
                                                    Science Industry</option>
                                                <option value="Waste Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Waste Industry' ? 'selected' : '' }}>
                                                    Waste Industry</option>
                                                <option value="Chemistry Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Chemistry Industry' ? 'selected' : '' }}>
                                                    Chemistry Industry</option>
                                                <option value="Teritiary Sector Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Teritiary Sector Industry' ? 'selected' : '' }}>
                                                    Teritiary Sector Industry</option>
                                                <option value="Real Estate Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Real Estate Industry' ? 'selected' : '' }}>
                                                    Real Estate Industry</option>
                                                <option
                                                    value="Financial Services Industry"{{ $bidrfq && $bidrfq->industry == 'Financial Services Industry' ? 'selected' : '' }}>
                                                    Financial Services Industry</option>
                                                <option value="Telecommunications Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Telecommunications Industry' ? 'selected' : '' }}>
                                                    Telecommunications Industry</option>
                                                <option value="Distribution Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Distribution Industry' ? 'selected' : '' }}>
                                                    Distribution Industry</option>
                                                <option value="Medical Device Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Medical Device Industry' ? 'selected' : '' }}>
                                                    Medical Device Industry</option>
                                                <option value="Biotechnology Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Biotechnology Industry' ? 'selected' : '' }}>
                                                    Biotechnology Industry</option>
                                                <option value="Aviation Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Aviation Industry' ? 'selected' : '' }}>
                                                    Aviation Industry</option>
                                                <option value="Insurance Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Insurance Industry' ? 'selected' : '' }}>
                                                    Insurance Industry</option>
                                                <option value="Trade Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Trade Industry' ? 'selected' : '' }}>
                                                    Trade Industry</option>
                                                <option value="Stock Market Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Stock Market Industry' ? 'selected' : '' }}>
                                                    Stock Market Industry</option>
                                                <option value="Electronics Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Electronics Industry' ? 'selected' : '' }}>
                                                    Electronics Industry</option>
                                                <option value="Textile Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Textile Industry' ? 'selected' : '' }}>
                                                    Textile Industry</option>
                                                <option value="Computers and Information Technology Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Computers and Information Technology Industry' ? 'selected' : '' }}>
                                                    Computers and Information Technology Industry</option>
                                                <option value="Market Research Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Market Research Industry' ? 'selected' : '' }}>
                                                    Market Research Industry</option>
                                                <option value="Machine Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Machine Industry' ? 'selected' : '' }}>
                                                    Machine Industry</option>
                                                <option value="Recycling Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Recycling Industry' ? 'selected' : '' }}>
                                                    Recycling Industry</option>
                                                <option value="Information and Communication Technology Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Information and Communication Technology Industry' ? 'selected' : '' }}>
                                                    Information and Communication Technology Industry</option>
                                                <option value="E- Commerce Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'E- Commerce Industry' ? 'selected' : '' }}>
                                                    E- Commerce Industry</option>
                                                <option value="Research Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Research Industry' ? 'selected' : '' }}>
                                                    Research Industry</option>
                                                <option value="Rail Transport Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Rail Transport Industry' ? 'selected' : '' }}>
                                                    Rail Transport Industry</option>
                                                <option value="Food Processing Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Food Processing Industry' ? 'selected' : '' }}>
                                                    Food Processing Industry</option>
                                                <option value="Small Business Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Small Business Industry' ? 'selected' : '' }}>
                                                    Small Business Industry</option>
                                                <option value="Wholesale Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Wholesale Industry' ? 'selected' : '' }}>
                                                    Wholesale Industry</option>
                                                <option value="Pulp and Paper Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Pulp and Paper Industry' ? 'selected' : '' }}>
                                                    Pulp and Paper Industry</option>
                                                <option value="Vehicle Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Vehicle Industry' ? 'selected' : '' }}>
                                                    Vehicle Industry</option>
                                                <option value="Steel Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Steel Industry' ? 'selected' : '' }}>
                                                    Steel Industry</option>
                                                <option value="Renewable Energy Industry"
                                                    {{ $bidrfq && $bidrfq->industry == 'Renewable Energy Industry' ? 'selected' : '' }}>
                                                    Renewable Energy Industry</option>
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

                                            <select class="form-control label-gray-3" id="currency" name="currency">
                                                <option
                                                    value="₹"{{ $bidrfq && $bidrfq->currency == '₹' ? 'selected' : '' }}>
                                                    INR</option>
                                                <option value="$"
                                                    {{ $bidrfq && $bidrfq->currency == '$' ? 'selected' : '' }}>USD
                                                </option>
                                                <option
                                                    value="€"{{ $bidrfq && $bidrfq->currency == '€' ? 'selected' : '' }}>
                                                    Euro</option>
                                                <option value="£"
                                                    {{ $bidrfq && $bidrfq->currency == '£' ? 'selected' : '' }}>Pound
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <?php
                                $arr = json_decode($bidrfq->sample_size, true);
                                $methodology = json_decode($bidrfq->methodology, true);
                                $setup_cost = json_decode($bidrfq->setup_cost, true);
                                $recruitment = json_decode($bidrfq->recruitment, true);
                                $incentives = json_decode($bidrfq->incentives, true);
                                $moderation = json_decode($bidrfq->moderation, true);
                                $transcript = json_decode($bidrfq->transcript);
                                $others = json_decode($bidrfq->others);
                                $world = json_decode($bidrfq->country,true);
                                $total_cost = json_decode($bidrfq->total_cost);
                                $client_id = json_decode($bidrfq->client_id);
                                $vendor_id = json_decode($bidrfq->vendor_id);
                                ?>
                                    <div class="col-md-12 table-responsive" style="overflow-x:auto;">
                                        <div class="form-group row">
    
    
                                            <div class="col-lg-6">
                                                <div class="rfq-table">
                                                    <div class="btn-var"></div>
                                                    <div class="bid-table d-flex">
                                                        @if(count($world) > 0)
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
                                                                                    <option value="{{ $v->name }}" {{ $world[0] && $v->name == $world[0][0] ? 'selected' : '' }}>
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
                                                                    <div
                                                                        class="nested-table-group nested-table-group-0 d-flex flex-nowrap">
                                                                        <table class="sub-table">
                                                                            <tbody class="sub-body_0">
                                                                                <tr class="first-row">
                                                                                    <td>Client/Vendor Name</td>
                                                                                    <td>
                                                                                        <select
                                                                                            class="form-control label-gray-3"
                                                                                            name="client_id_0[0][]" required>
                                                                                            <option class="label-gray-3"
                                                                                                value="">Client</option>
                                                                                            @if (count($client) > 0)
                                                                                                @foreach ($client as $v)
                                                                                                    <option
                                                                                                        value="{{ $v->client_name }}" {{ count($client_id) > 0 && count($client_id[0]) > 0 && $client_id[0][0] == $v->client_name ? 'selected' : '' }}>
                                                                                                        {{ $v->client_name }}
                                                                                                    </option>
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
                                                                                            @if (count($vendor) > 0)
                                                                                                @foreach ($vendor as $v)
                                                                                                    <option
                                                                                                        value="{{ $v->vendor_name }}" {{ count($vendor_id) > 0 && count($vendor_id[0]) > 0 && $vendor_id[0][0] == $v->vendor_name ? 'selected' : '' }}>
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
                                                                                        <input type="text" class="txtCal"
                                                                                            value="{{ $methodology && $methodology[0] && count($methodology[0]) > 0 ? $methodology[0][0] : 0  }}"
                                                                                            name="methodology_0[0][]"
                                                                                            placeholder="Methodology">
                                                                                    </td>
                                                                                    <td class="remove">
                                                                                        <input type="text" class="txtbol"
                                                                                            value="{{$methodology && $methodology[0] && count($methodology[0]) > 1 ? $methodology[0][1] : 0  }}"
                                                                                            name="methodology_0[0][]"
                                                                                            placeholder="Methodology">
                                                                                    </td>
                                                                                </tr>
    
                                                                                <!-- Sample Size -->
                                                                                <tr>
                                                                                    <td class="sub-cost">Sample Size</td>
                                                                                    <td class="remove">
                                                                                        <input type="text" class="txtCal"
                                                                                            value="{{ $arr[0] && count($arr[0]) > 0 ? $arr[0][0] : 0  }}"
                                                                                            name="sample_size_0[0][]"
                                                                                            placeholder="Sample Size">
                                                                                    </td>
                                                                                    <td class="remove">
                                                                                        <input type="text" class="txtbol"
                                                                                            value="{{ $arr[0] && count($arr[0]) > 1 ? $arr[0][1] : 0  }}"
                                                                                            name="sample_size_0[0][]"
                                                                                            placeholder="Sample Size">
                                                                                    </td>
                                                                                </tr>
    
                                                                                <!-- Setup Cost -->
                                                                                <tr>
                                                                                    <td>Setup Cost/PM</td>
                                                                                    <td class="bidrfq-client" data-id="2">
                                                                                        <input type="text" class="txtCal"
                                                                                            value="{{ $setup_cost[0] && count($setup_cost[0]) > 0 ? $setup_cost[0][0] : 0  }}"
                                                                                            placeholder="Setup Cost"
                                                                                            name="setup_cost_0[0][]">
                                                                                    </td>
                                                                                    <td class="bidrfq-vendor" data-id="3">
                                                                                        <input type="text" class="txtbol"
                                                                                            value="{{ $setup_cost[0] && count($setup_cost[0]) > 1 ? $setup_cost[0][1] : 1  }}"
                                                                                            placeholder="Setup Cost"
                                                                                            name="setup_cost_0[0][]">
                                                                                    </td>
                                                                                </tr>
    
                                                                                <!-- Recruitment -->
                                                                                <tr>
                                                                                    <td>Recruitment</td>
                                                                                    <td class="bidrfq-client" data-id="2">
                                                                                        <input type="text" class="txtCal"
                                                                                            value="{{ $recruitment[0] && count($recruitment[0]) > 0 ? $recruitment[0][0] : 0  }}"
                                                                                            placeholder="Recruitment"
                                                                                            name="recruitment_0[0][]">
                                                                                    </td>
                                                                                    <td class="bidrfq-vendor" data-id="3">
                                                                                        <input type="text" class="txtbol"
                                                                                            value="{{ $recruitment[0] && count($recruitment[0]) > 1 ? $recruitment[0][1] : 0  }}"
                                                                                            placeholder="Recruitment"
                                                                                            name="recruitment_0[0][]">
                                                                                    </td>
                                                                                </tr>
    
                                                                                <!-- Incentives -->
                                                                                <tr>
                                                                                    <td>Incentives</td>
                                                                                    <td class="bidrfq-client" data-id="2">
                                                                                        <input type="text" class="txtCal"
                                                                                            value="{{ $incentives[0] && count($incentives[0]) > 0 ? $incentives[0][0] : 0  }}"
                                                                                            placeholder="Incentives"
                                                                                            name="incentives_0[0][]">
                                                                                    </td>
                                                                                    <td class="bidrfq-vendor" data-id="3">
                                                                                        <input type="text" class="txtbol"
                                                                                            value="{{ $incentives[0] && count($incentives[0]) > 1 ? $incentives[0][1] : 0  }}"
                                                                                            placeholder="Incentives"
                                                                                            name="incentives_0[0][]">
                                                                                    </td>
                                                                                </tr>
    
                                                                                <!-- Moderation -->
                                                                                <tr class="format-2">
                                                                                    <td>Moderation</td>
                                                                                    <td class="bidrfq-client" data-id="2">
                                                                                        <input type="text" class="txtCal"
                                                                                            value="{{ $moderation[0] && count($moderation[0]) > 0 ? $moderation[0][0] : 0  }}"
                                                                                            placeholder="Moderation"
                                                                                            name="moderation_0[0][]">
                                                                                    </td>
                                                                                    <td class="bidrfq-vendor" data-id="3">
                                                                                        <input type="text" class="txtbol"
                                                                                            value="{{ $moderation[0] && count($moderation[0]) > 1 ? $moderation[0][1] : 0  }}"
                                                                                            placeholder="Moderation"
                                                                                            name="moderation_0[0][]">
                                                                                    </td>
                                                                                </tr>
    
                                                                                <!-- Transcript -->
                                                                                <tr class="format-2">
                                                                                    <td>Transcript</td>
                                                                                    <td class="bidrfq-client" data-id="2">
                                                                                        <input type="text" class="txtCal"
                                                                                            value="{{ $transcript[0] && count($transcript[0]) > 0 ? $transcript[0][0] : 0  }}"
                                                                                            placeholder="Transcript"
                                                                                            name="transcript_0[0][]">
                                                                                    </td>
                                                                                    <td class="bidrfq-vendor" data-id="3">
                                                                                        <input type="text" class="txtbol"
                                                                                            value="{{ $transcript[0] && count($transcript[0]) > 1 ? $transcript[0][1] : 0  }}"
                                                                                            placeholder="Transcript"
                                                                                            name="transcript_0[0][]">
                                                                                    </td>
                                                                                </tr>
    
                                                                                <!-- Others -->
                                                                                <tr>
                                                                                    <td>
                                                                                        <input type="text" class="txtCal" attr="Others" value="{{ $others[0] && count($others[0]) > 0 ? $others[0][0] : 'Others' }}" attr="Others"
                                                                                        placeholder="Others"
                                                                                        name="others_0[0][]">
                                                                                    </td>
                                                                                    <td class="bidrfq-client" data-id="2">
                                                                                        <input type="text" class="txtCal"
                                                                                            value="{{ $others[0] && count($others[0]) > 1 ? $others[0][1] : 0  }}"
                                                                                            placeholder="Others"
                                                                                            name="others_0[0][]">
                                                                                    </td>
                                                                                    <td class="bidrfq-vendor" data-id="3">
                                                                                        <input type="text" class="txtbol"
                                                                                            value="{{ $others[0] && count($others[0]) > 2 ? $others[0][2] : 0  }}"
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
                                                                                            value="{{ $total_cost[0] && count($total_cost[0]) > 0 ? $total_cost[0][0] : 0  }}"
                                                                                            class="border total_cost"
                                                                                            placeholder="Total Cost"
                                                                                            name="total_cost_0[0][]">
                                                                                    </td>
                                                                                    <td>
                                                                                        <label class="my-currency"></label>
                                                                                        <input type="text"
                                                                                            value="{{ $total_cost[0] && count($total_cost[0]) > 1 ? $total_cost[0][1] : 0  }}"
                                                                                            class="border total_cost"
                                                                                            placeholder="Total Cost"
                                                                                            name="total_cost_0[0][]">
                                                                                    </td>
                                                                                </tr>
    
                                                                            </tbody>
                                                                        </table>
                                                                        <?php $j = 1; ?>
                                                                        @if(count($total_cost[0])>2)
                                                                        @for($i = 2; $i < count($total_cost[0]); $i+=2 )
                                                                        <div class="table-group d-flex">
                                                                            <table class="sub-table" data-by="1">
                                                                                <tbody class="sub-body_0">
                                                                                    <tr class="first-row">
                                                                                        <td>Client/Vendor Name</td>
                                                                                        <td>
                                                                                            <select
                                                                                                class="form-control label-gray-3"
                                                                                                name="client_id_0[0][]" required>
                                                                                                <option class="label-gray-3"
                                                                                                    value="">Client</option>
                                                                                                @if (count($client) > 0)
                                                                                                    @foreach ($client as $v)
                                                                                                        <option
                                                                                                            value="{{ $v->client_name }}" {{ count($client_id) > 0 && count($client_id[0]) > 0 && $client_id[0][$j] == $v->client_name ? 'selected' : '' }}>
                                                                                                            {{ $v->client_name }}
                                                                                                        </option>
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
                                                                                                @if (count($vendor) > 0)
                                                                                                    @foreach ($vendor as $v)
                                                                                                        <option
                                                                                                            value="{{ $v->vendor_name }}" {{ count($vendor_id) > 0 && count($vendor_id[0]) > 0 && $vendor_id[0][$j] == $v->vendor_name ? 'selected' : '' }}>
                                                                                                            {{ $v->vendor_name }}
                                                                                                        </option>
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            </select>
                                                                                        </td>
                                                                                    </tr>
                                                                                    
                                                                                    <tr {{ $j++ }}>
                                                                                        <td class="sub-cost">Methodology</td>
                                                                                        <td class="remove">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{  $methodology &&  $methodology[0] && count($methodology[0]) > $i ? $methodology[0][$i] : 0  }}"
                                                                                                name="methodology_0[0][]"
                                                                                                placeholder="Methodology">
                                                                                        </td>
                                                                                        <td class="remove">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $methodology && $methodology[0] && count($methodology[0]) > $i + 1 ? $methodology[0][$i + 1] : 0  }}"
                                                                                                name="methodology_0[0][]"
                                                                                                placeholder="Methodology">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                    <!-- Sample Size -->
                                                                                    <tr>
                                                                                        <td class="sub-cost">Sample Size</td>
                                                                                        <td class="remove">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{ $arr[0] && count($arr[0]) > $i ? $arr[0][$i] : 0  }}"
                                                                                                name="sample_size_0[0][]"
                                                                                                placeholder="Sample Size">
                                                                                        </td>
                                                                                        <td class="remove">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $arr[0] && count($arr[0]) > $i + 1 ? $arr[0][$i + 1] : 0  }}"
                                                                                                name="sample_size_0[0][]"
                                                                                                placeholder="Sample Size">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                    <!-- Setup Cost -->
                                                                                    <tr>
                                                                                        <td>Setup Cost/PM</td>
                                                                                        <td class="bidrfq-client"
                                                                                            data-id="2">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{ $setup_cost[0] && count($setup_cost[0]) > $i ? $setup_cost[0][$i] : 0  }}"
                                                                                                placeholder="Setup Cost"
                                                                                                name="setup_cost_0[0][]">
                                                                                        </td>
                                                                                        <td class="bidrfq-vendor"
                                                                                            data-id="3">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $setup_cost[0] && count($setup_cost[0]) > $i + 1 ? $setup_cost[0][$i + 1] : 0  }}"
                                                                                                placeholder="Setup Cost"
                                                                                                name="setup_cost_0[0][]">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                    <!-- Recruitment -->
                                                                                    <tr>
                                                                                        <td>Recruitment</td>
                                                                                        <td class="bidrfq-client"
                                                                                            data-id="2">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{ $recruitment[0] && count($recruitment[0]) > $i ? $recruitment[0][$i] : 0  }}"
                                                                                                placeholder="Recruitment"
                                                                                                name="recruitment_0[0][]">
                                                                                        </td>
                                                                                        <td class="bidrfq-vendor"
                                                                                            data-id="3">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $recruitment[0] && count($recruitment[0]) > $i + 1 ? $recruitment[0][$i + 1] : 0  }}"
                                                                                                placeholder="Recruitment"
                                                                                                name="recruitment_0[0][]">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                    <!-- Incentives -->
                                                                                    <tr>
                                                                                        <td>Incentives</td>
                                                                                        <td class="bidrfq-client"
                                                                                            data-id="2">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{ $incentives[0] && count($incentives[0]) > $i ? $incentives[0][$i] : 0  }}"
                                                                                                placeholder="Incentives"
                                                                                                name="incentives_0[0][]">
                                                                                        </td>
                                                                                        <td class="bidrfq-vendor"
                                                                                            data-id="3">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $incentives[0] && count($incentives[0]) > $i + 1 ? $incentives[0][$i + 1] : 0  }}"
                                                                                                placeholder="Incentives"
                                                                                                name="incentives_0[0][]">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                    <!-- Moderation -->
                                                                                    <tr class="format-2">
                                                                                        <td>Moderation</td>
                                                                                        <td class="bidrfq-client"
                                                                                            data-id="2">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{ $moderation[0] && count($moderation[0]) > $i ? $moderation[0][$i] : 0  }}"
                                                                                                placeholder="Moderation"
                                                                                                name="moderation_0[0][]">
                                                                                        </td>
                                                                                        <td class="bidrfq-vendor"
                                                                                            data-id="3">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $moderation[0] && count($moderation[0]) > $i + 1 ? $moderation[0][$i + 1] : 0  }}"
                                                                                                placeholder="Moderation"
                                                                                                name="moderation_0[0][]">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                    <!-- Transcript -->
                                                                                    <tr class="format-2">
                                                                                        <td>Transcript</td>
                                                                                        <td class="bidrfq-client"
                                                                                            data-id="2">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{ $transcript[0] && count($transcript[0]) > $i ? $transcript[0][$i] : 0  }}"
                                                                                                placeholder="Transcript"
                                                                                                name="transcript_0[0][]">
                                                                                        </td>
                                                                                        <td class="bidrfq-vendor"
                                                                                            data-id="3">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $transcript[0] && count($transcript[0]) > $i + 1 ? $transcript[0][$i + 1] : 0  }}"
                                                                                                placeholder="Transcript"
                                                                                                name="transcript_0[0][]">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                    <!-- Others -->
                                                                                    <tr>
                                                                                        <td>
                                                                                            <input type="text" 
                                                                                                class="txtCal" attr="Others" value="{{ $others[0] && count($others[0]) > $i + 1 ? $others[0][$i + 1] : 'Others'  }}"
                                                                                                placeholder="Others"
                                                                                                name="others_0[0][]">
                                                                                        </td>
                                                                                        <td class="bidrfq-client"
                                                                                            data-id="2">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{ $others[0] && count($others[0]) > $i + 2 ? $others[0][$i + 2] : 0  }}"
                                                                                                placeholder="Others"
                                                                                                name="others_0[0][]">
                                                                                        </td>
                                                                                        <td class="bidrfq-vendor"
                                                                                            data-id="3">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $others[0] && count($others[0]) > $i + 3 ? $others[0][$i + 3] : 0  }}"
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
                                                                                                value="{{ $total_cost[0] && count($total_cost[0]) > $i ? $total_cost[0][$i] : 0  }}"
                                                                                                class="border total_cost"
                                                                                                placeholder="Total Cost"
                                                                                                name="total_cost_0[0][]">
                                                                                        </td>
                                                                                        <td>
                                                                                            <label class="my-currency"></label>
                                                                                            <input type="text"
                                                                                                value="{{ $total_cost[0] && count($total_cost[0]) > $i + 1 ? $total_cost[0][$i + 1] : 0  }}"
                                                                                                class="border total_cost"
                                                                                                placeholder="Total Cost"
                                                                                                name="total_cost_0[0][]">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                </tbody>
                                                                            </table>
                                                                            <?php $i += 2 ?>
                                                                            <table class="sub-table" data-by="1">
                                                                                <tbody class="sub-body_0">
                                                                                    <tr class="first-row">
                                                                                        <td>Client/Vendor Name</td>
                                                                                        <td>
                                                                                            <select
                                                                                                class="form-control label-gray-3"
                                                                                                name="client_id_0[0][]" required>
                                                                                                <option class="label-gray-3"
                                                                                                    value="">Client</option>
                                                                                                @if (count($client) > 0)
                                                                                                    @foreach ($client as $v)
                                                                                                        <option
                                                                                                            value="{{ $v->client_name }}" {{ count($client_id) > 0 && count($client_id[0]) > 0 && $client_id[0][$j] == $v->client_name ? 'selected' : '' }}>
                                                                                                            {{ $v->client_name }}
                                                                                                        </option>
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
                                                                                                @if (count($vendor) > 0)
                                                                                                    @foreach ($vendor as $v)
                                                                                                        <option
                                                                                                            value="{{ $v->vendor_name }}" {{ count($vendor_id) > 0 && count($vendor_id[0]) > 0 && $vendor_id[0][$j] == $v->vendor_name ? 'selected' : '' }}>
                                                                                                            {{ $v->vendor_name }}
                                                                                                        </option>
                                                                                                    @endforeach
                                                                                                @endif
                                                                                            </select>
                                                                                        </td>
                                                                                    </tr>
                                                                                    
                                                                                    <tr {{ $j++ }}>
                                                                                        <td class="sub-cost">Methodology</td>
                                                                                        <td class="remove">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{ $methodology && $methodology[0] && count($methodology[0]) > $i ? $methodology[0][$i] : 0  }}"
                                                                                                name="methodology_0[0][]"
                                                                                                placeholder="Methodology">
                                                                                        </td>
                                                                                        <td class="remove">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $methodology && $methodology[0] && count($methodology[0]) > $i + 1 ? $methodology[0][$i + 1] : 0  }}"
                                                                                                name="methodology_0[0][]"
                                                                                                placeholder="Methodology">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                    <!-- Sample Size -->
                                                                                    <tr>
                                                                                        <td class="sub-cost">Sample Size</td>
                                                                                        <td class="remove">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{ $arr[0] && count($arr[0]) > $i ? $arr[0][$i] : 0  }}"
                                                                                                name="sample_size_0[0][]"
                                                                                                placeholder="Sample Size">
                                                                                        </td>
                                                                                        <td class="remove">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $arr[0] && count($arr[0]) > $i + 1 ? $arr[0][$i + 1] : 0  }}"
                                                                                                name="sample_size_0[0][]"
                                                                                                placeholder="Sample Size">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                    <!-- Setup Cost -->
                                                                                    <tr>
                                                                                        <td>Setup Cost/PM</td>
                                                                                        <td class="bidrfq-client"
                                                                                            data-id="2">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{ $setup_cost[0] && count($setup_cost[0]) > $i ? $setup_cost[0][$i] : 0  }}"
                                                                                                placeholder="Setup Cost"
                                                                                                name="setup_cost_0[0][]">
                                                                                        </td>
                                                                                        <td class="bidrfq-vendor"
                                                                                            data-id="3">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $setup_cost[0] && count($setup_cost[0]) > $i + 1 ? $setup_cost[0][$i + 1] : 0  }}"
                                                                                                placeholder="Setup Cost"
                                                                                                name="setup_cost_0[0][]">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                    <!-- Recruitment -->
                                                                                    <tr>
                                                                                        <td>Recruitment</td>
                                                                                        <td class="bidrfq-client"
                                                                                            data-id="2">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{ $recruitment[0] && count($recruitment[0]) > $i ? $recruitment[0][$i] : 0  }}"
                                                                                                placeholder="Recruitment"
                                                                                                name="recruitment_0[0][]">
                                                                                        </td>
                                                                                        <td class="bidrfq-vendor"
                                                                                            data-id="3">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $recruitment[0] && count($recruitment[0]) > $i + 1 ? $recruitment[0][$i + 1] : 0  }}"
                                                                                                placeholder="Recruitment"
                                                                                                name="recruitment_0[0][]">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                    <!-- Incentives -->
                                                                                    <tr>
                                                                                        <td>Incentives</td>
                                                                                        <td class="bidrfq-client"
                                                                                            data-id="2">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{ $incentives[0] && count($incentives[0]) > $i ? $incentives[0][$i] : 0  }}"
                                                                                                placeholder="Incentives"
                                                                                                name="incentives_0[0][]">
                                                                                        </td>
                                                                                        <td class="bidrfq-vendor"
                                                                                            data-id="3">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $incentives[0] && count($incentives[0]) > $i + 1 ? $incentives[0][$i + 1] : 0  }}"
                                                                                                placeholder="Incentives"
                                                                                                name="incentives_0[0][]">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                    <!-- Moderation -->
                                                                                    <tr class="format-2">
                                                                                        <td>Moderation</td>
                                                                                        <td class="bidrfq-client"
                                                                                            data-id="2">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{ $moderation[0] && count($moderation[0]) > $i ? $moderation[0][$i] : 0  }}"
                                                                                                placeholder="Moderation"
                                                                                                name="moderation_0[0][]">
                                                                                        </td>
                                                                                        <td class="bidrfq-vendor"
                                                                                            data-id="3">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $moderation[0] && count($moderation[0]) > $i + 1 ? $moderation[0][$i + 1] : 0  }}"
                                                                                                placeholder="Moderation"
                                                                                                name="moderation_0[0][]">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                    <!-- Transcript -->
                                                                                    <tr class="format-2">
                                                                                        <td>Transcript</td>
                                                                                        <td class="bidrfq-client"
                                                                                            data-id="2">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{ $transcript[0] && count($transcript[0]) > $i ? $transcript[0][$i] : 0  }}"
                                                                                                placeholder="Transcript"
                                                                                                name="transcript_0[0][]">
                                                                                        </td>
                                                                                        <td class="bidrfq-vendor"
                                                                                            data-id="3">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $transcript[0] && count($transcript[0]) > $i + 1 ? $transcript[0][$i + 1] : 0  }}"
                                                                                                placeholder="Transcript"
                                                                                                name="transcript_0[0][]">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                    <!-- Others -->
                                                                                    <tr>
                                                                                        <td>
                                                                                            <input type="text" attr="Others"
                                                                                                class="txtCal" value="{{ $others[0] && count($others[0]) > $i + 2 ? $others[0][$i + 2] : "Other"  }}"
                                                                                                placeholder="Others"
                                                                                                name="others_0[0][]">
                                                                                        </td>
                                                                                        <td class="bidrfq-client"
                                                                                            data-id="2">
                                                                                            <input type="text"
                                                                                                class="txtCal" value="{{ $others[0] && count($others[0]) > $i + 3 ? $others[0][$i + 3] : 0  }}"
                                                                                                placeholder="Others"
                                                                                                name="others_0[0][]">
                                                                                        </td>
                                                                                        <td class="bidrfq-vendor"
                                                                                            data-id="3">
                                                                                            <input type="text"
                                                                                                class="txtbol" value="{{ $others[0] && count($others[0]) > $i + 4 ? $others[0][$i + 4] : 0  }}"
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
                                                                                            value="{{ $total_cost[0] && count($total_cost[0]) > $i ? $total_cost[0][$i] : 0  }}"
                                                                                                class="border total_cost"
                                                                                                placeholder="Total Cost"
                                                                                                name="total_cost_0[0][]">
                                                                                        </td>
                                                                                        <td>
                                                                                            <label class="my-currency"></label>
                                                                                            <input type="text"
                                                                                            value="{{ $total_cost[0] && count($total_cost[0]) > $i + 1 ? $total_cost[0][$i + 1] : 0  }}"
                                                                                                class="border total_cost"
                                                                                                placeholder="Total Cost"
                                                                                                name="total_cost_0[0][]">
                                                                                        </td>
                                                                                    </tr>
    
                                                                                </tbody>
                                                                            </table><button
                                                                                class="p-2 ml-2 btn btn-danger removetable"
                                                                                type="button">
                                                                                <svg class="svg-inline--fa fa-xmark"
                                                                                    aria-hidden="true" focusable="false"
                                                                                    data-prefix="fa-solid" data-icon="xmark"
                                                                                    role="img"
                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                    viewBox="0 0 320 512" data-fa-i2svg="">
                                                                                    <path fill="currentColor"
                                                                                        d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z">
                                                                                    </path>
                                                                                </svg><!-- <i class="fa-solid fa-xmark"></i> Font Awesome fontawesome.com -->
                                                                            </button>
                                                                        </div>
                                                                        @endfor
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                            </tr>
    
                                                        </table>
                                                        @endif
                                                        @if(count($world) > 1)
                                                        @foreach($world as $key => $value)
                                                        @if($key > 0)
    
                                                        <div class="country-wrapper" data-by="1">
                                                            <div class="btn-var"></div>
                                                            <div class=" d-flex">
                                                                <table class="table table-striped add-country" id="main-table"
                                                                    data-by="1">
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <label class="form-group has-float-label">
                                                                                    <select class="form-control label-gray-3"
                                                                                    name="country_0[{{ $key }}][]" required>
                                                                                    <option class="label-gray-3" value="">
                                                                                        Country</option>
                                                                                    @if (count($country) > 0)
                                                                                        @foreach ($country as $v)
                                                                                            <option value="{{ $v->name }}" {{ $world[0] && $v->name == $world[$key][0] ? 'selected' : '' }}>
                                                                                                {{ $v->name }}</option>
                                                                                        @endforeach
                                                                                    @endif
                                                                                </select>
                                                                                </label>
                                                                            </td>
                                                                            <td>
                                                                                <button class="ml-2 btn btn-success addvendor"
                                                                                    data-vendor="1" data-count="{{ $key }}"
                                                                                    type="button">
                                                                                    Add table
                                                                                </button>
                                                                            </td>
                                                                            <td>
                                                                                <button
                                                                                    class="ml-2 btn btn-danger removecountry"
                                                                                    type="button">
                                                                                    <svg class="svg-inline--fa fa-xmark"
                                                                                        aria-hidden="true" focusable="false"
                                                                                        data-prefix="fa-solid"
                                                                                        data-icon="xmark" role="img"
                                                                                        xmlns="http://www.w3.org/2000/svg"
                                                                                        viewBox="0 0 320 512"
                                                                                        data-fa-i2svg="">
                                                                                        <path fill="currentColor"
                                                                                            d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z">
                                                                                        </path>
                                                                                    </svg><!-- <i class="fa-solid fa-xmark"></i> Font Awesome fontawesome.com -->
                                                                                </button>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td colspan="3">
                                                                                <div
                                                                                    class="nested-table-group nested-table-group-{{$key}} d-flex flex-nowrap">
                                                                                    <table class="sub-table">
                                                                                        <tbody class="sub-body_1">
                                                                                            <tr class="first-row">
                                                                                                <td>Client/Vendor Name</td>
                                                                                                <td>
                                                                                                    <select
                                                                                                        class="form-control label-gray-3"
                                                                                                        name="client_id_0[{{ $key }}][]" required>
                                                                                                        <option class="label-gray-3"
                                                                                                            value="">Client</option>
                                                                                                        @if (count($client) > 0)
                                                                                                            @foreach ($client as $v)
                                                                                                                <option
                                                                                                                    value="{{ $v->client_name }}" {{ count($client_id) > 0 && count($client_id[$key]) > 0 && $client_id[$key][0] == $v->client_name ? 'selected' : '' }}>
                                                                                                                    {{ $v->client_name }}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                    </select>
                                                                                                </td>
                                                                                                <td class="v">
                                                                                                    <select
                                                                                                        class="form-control label-gray-3"
                                                                                                        name="vendor_id_0[{{ $key }}][]" required>
                                                                                                        <option class="label-gray-3"
                                                                                                            value="">Vendor</option>
                                                                                                        @if (count($vendor) > 0)
                                                                                                            @foreach ($vendor as $v)
                                                                                                                <option
                                                                                                                    value="{{ $v->vendor_name }}" {{ count($vendor_id) > 0 && count($vendor_id[$key]) > 0 && $vendor_id[$key][0] == $v->vendor_name ? 'selected' : '' }}>
                                                                                                                    {{ $v->vendor_name }}
                                                                                                                </option>
                                                                                                            @endforeach
                                                                                                        @endif
                                                                                                    </select>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Methodology</td>
                                                                                                <td><input type="text"
                                                                                                        class="txtCal"
                                                                                                        value="{{ $methodology && $methodology[$key] && count($methodology[$key]) > 0 ? $methodology[$key][0] : 0  }}"
                                                                                                        name="methodology_0[{{ $key }}][]"
                                                                                                        placeholder="Methodology">
                                                                                                </td>
                                                                                                <td><input type="text"
                                                                                                        class="txtbol"
                                                                                                        value="{{ $methodology && $methodology[$key] && count($methodology[$key]) > 1 ? $methodology[$key][1] : 0  }}"
                                                                                                        name="methodology_0[{{ $key }}][]"
                                                                                                        placeholder="Methodology">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Sample Size</td>
                                                                                                <td><input type="text"
                                                                                                        class="txtCal"
                                                                                                        value="{{ $arr[$key] && count($arr[$key]) > 0 ? $arr[$key][0] : 0  }}"
                                                                                                        name="sample_size_0[{{ $key }}][]"
                                                                                                        placeholder="Sample Size">
                                                                                                </td>
                                                                                                <td><input type="text"
                                                                                                        class="txtbol"
                                                                                                        value="{{ $arr[$key] && count($arr[$key]) > 1 ? $arr[$key][1] : 0  }}"
                                                                                                        name="sample_size_0[{{ $key }}][]"
                                                                                                        placeholder="Sample Size">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Setup Cost/PM</td>
                                                                                                <td class="bidrfq-client"
                                                                                                    data-id="3"><input
                                                                                                        type="text"
                                                                                                        class="txtCal"
                                                                                                        value="{{ $setup_cost[$key] && count($setup_cost[$key]) > 0 ? $setup_cost[$key][0] : 0  }}"
                                                                                                        placeholder="Setup Cost"
                                                                                                        name="setup_cost_0[{{ $key }}][]">
                                                                                                </td>
                                                                                                <td class="bidrfq-client"
                                                                                                    data-id="4"><input
                                                                                                        type="text"
                                                                                                        class="txtbol"
                                                                                                        value="{{ $setup_cost[$key] && count($setup_cost[$key]) > 1 ? $setup_cost[$key][1] : 0  }}"
                                                                                                        placeholder="Setup Cost"
                                                                                                        name="setup_cost_0[{{ $key }}][]">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Recruitment</td>
                                                                                                <td class="bidrfq-client"
                                                                                                    data-id="3"><input
                                                                                                        type="text"
                                                                                                        class="txtCal"
                                                                                                        value="{{ $recruitment[$key] && count($recruitment[$key]) > 0 ? $recruitment[$key][0] : 0  }}"
                                                                                                        placeholder="Recruitment"
                                                                                                        name="recruitment_0[{{ $key }}][]">
                                                                                                </td>
                                                                                                <td><input type="text"
                                                                                                        class="txtbol"
                                                                                                        value="{{ $recruitment[$key] && count($recruitment[$key]) > 1 ? $recruitment[$key][1] : 0  }}"
                                                                                                        placeholder="Recruitment"
                                                                                                        name="recruitment_0[{{ $key }}][]">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Incentives</td>
                                                                                                <td class="bidrfq-client"
                                                                                                    data-id="3"><input
                                                                                                        type="text"
                                                                                                        class="txtCal"
                                                                                                        value="{{ $incentives[$key] && count($incentives[$key]) > 0 ? $incentives[$key][0] : 0  }}"
                                                                                                        placeholder="Incentives"
                                                                                                        name="incentives_0[{{ $key }}][]">
                                                                                                </td>
                                                                                                <td><input type="text"
                                                                                                        class="txtbol"
                                                                                                        value="{{ $incentives[$key] && count($incentives[$key]) > 1 ? $incentives[$key][1] : 0  }}"
                                                                                                        placeholder="Incentives"
                                                                                                        name="incentives_0[{{ $key }}][]">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Moderation</td>
                                                                                                <td class="bidrfq-client"
                                                                                                    data-id="3"><input
                                                                                                        type="text"
                                                                                                        class="txtCal"
                                                                                                        value="{{ $moderation[$key] && count($moderation[$key]) > 0 ? $moderation[$key][0] : 0  }}"
                                                                                                        placeholder="Moderation"
                                                                                                        name="moderation_0[{{ $key }}][]">
                                                                                                </td>
                                                                                                <td><input type="text"
                                                                                                        class="txtbol"
                                                                                                        value="{{ $moderation[$key] && count($moderation[$key]) > 1 ? $moderation[$key][1] : 0  }}"
                                                                                                        placeholder="Moderation"
                                                                                                        name="moderation_0[{{ $key }}][]">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Transcript</td>
                                                                                                <td class="bidrfq-client"
                                                                                                    data-id="3"><input
                                                                                                        type="text"
                                                                                                        class="txtCal"
                                                                                                        value="{{ $transcript[$key] && count($transcript[$key]) > 0 ? $transcript[$key][0] : 0  }}"
                                                                                                        placeholder="Transcript"
                                                                                                        name="transcript_0[{{ $key }}][]">
                                                                                                </td>
                                                                                                <td><input type="text"
                                                                                                        class="txtbol"
                                                                                                        value="{{ $transcript[$key] && count($transcript[$key]) > 1 ? $transcript[$key][1] : 0  }}"
                                                                                                        placeholder="Transcript"
                                                                                                        name="transcript_0[{{ $key }}][]">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>
                                                                                                    <input
                                                                                                        type="text"
                                                                                                        class="txtCal" attr="Others"
                                                                                                        value="{{ $others[$key] && count($others[$key]) > 0 ? $others[$key][0] : "Others"  }}"
                                                                                                        placeholder="Others"
                                                                                                        name="others_0[{{ $key }}][]">
                                                                                                </td>
                                                                                                <td class="bidrfq-client"
                                                                                                    data-id="3"><input
                                                                                                        type="text"
                                                                                                        class="txtCal"
                                                                                                        value="{{ $others[$key] && count($others[$key]) > 1 ? $others[$key][1] : 0  }}"
                                                                                                        placeholder="Others"
                                                                                                        name="others_0[{{ $key }}][]">
                                                                                                </td>
                                                                                                <td><input type="text"
                                                                                                        class="txtbol"
                                                                                                        value="{{ $others[$key] && count($others[$key]) > 2 ? $others[$key][2] : 0  }}"
                                                                                                        placeholder="Others"
                                                                                                        name="others_0[{{ $key }}][]">
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td class="my-currency">Total
                                                                                                    Costs</td>
                                                                                                <td><input type="text"
                                                                                                        value="{{ $total_cost[$key] && count($total_cost[$key]) > 0 ? $total_cost[$key][0] : 0  }}"
                                                                                                        class="border total_cost"
                                                                                                        placeholder="Total Cost"
                                                                                                        name="total_cost_0[{{ $key }}][]">
                                                                                                </td>
                                                                                                <td><input type="text"
                                                                                                    value="{{ $total_cost[$key] && count($total_cost[$key]) > 1 ? $total_cost[$key][1] : 0  }}"
                                                                                                        class="border total_cost"
                                                                                                        placeholder="Total Cost"
                                                                                                        name="total_cost_0[{{ $key }}][]">
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                    <?php 
                                                                                        $j = 1; 
                                                                                    ?>
                                                                                    @if(count($total_cost[$key])>2)
    
                                                                                    @for($i = 2; $i < count($total_cost[$key]); $i+=2 )
                                                                                    <div class="table-group d-flex" >
                                                                                        <table class="sub-table"
                                                                                            data-by="1">
                                                                                            <tbody class="sub-body_1">
                                                                                                <tr class="first-row">
                                                                                                    <td>Client/Vendor Name</td>
                                                                                                    <td>
                                                                                                        <select
                                                                                                            class="form-control label-gray-3"
                                                                                                            name="client_id_0[{{ $key }}][]" required>
                                                                                                            <option class="label-gray-3"
                                                                                                                value="">Client</option>
                                                                                                            @if (count($client) > 0)
                                                                                                                @foreach ($client as $v)
                                                                                                                    <option
                                                                                                                        value="{{ $v->client_name }}" {{ count($client_id) > 0 && count($client_id[$key]) > 0 && $client_id[$key][$j] == $v->client_name ? 'selected' : '' }}>
                                                                                                                        {{ $v->client_name }}
                                                                                                                    </option>
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                        </select>
                                                                                                    </td>
                                                                                                    <td class="v">
                                                                                                        <select
                                                                                                            class="form-control label-gray-3"
                                                                                                            name="vendor_id_0[{{ $key }}][]" required>
                                                                                                            <option class="label-gray-3"
                                                                                                                value="">Vendor</option>
                                                                                                            @if (count($vendor) > 0)
                                                                                                                @foreach ($vendor as $v)
                                                                                                                    <option
                                                                                                                        value="{{ $v->vendor_name }}" {{ count($vendor_id) > 0 && count($vendor_id[$key]) > 0 && $vendor_id[$key][$j] == $v->vendor_name ? 'selected' : '' }}>
                                                                                                                        {{ $v->vendor_name }}
                                                                                                                    </option>
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                        </select>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                                <tr {{ $j++ }}>
                                                                                                    <td>Methodology</td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $methodology && $methodology[$key] && count($methodology[$key]) > $i ? $methodology[$key][$i] : 0  }}"
                                                                                                            name="methodology_0[{{ $key }}][]"
                                                                                                            placeholder="Methodology">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $methodology && $methodology[$key] && count($methodology[$key]) > $i + 1 ? $methodology[$key][$i + 1] : 0  }}"
                                                                                                            name="methodology_0[{{ $key }}][]"
                                                                                                            placeholder="Methodology">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Sample Size</td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $arr[$key] && count($arr[$key]) > $i ? $arr[$key][$i] : 0  }}"
                                                                                                            name="sample_size_0[{{ $key }}][]"
                                                                                                            placeholder="Sample Size">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $arr[$key] && count($arr[$key]) > $i + 1 ? $arr[$key][$i + 1] : 0  }}"
                                                                                                            name="sample_size_0[{{ $key }}][]"
                                                                                                            placeholder="Sample Size">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Setup Cost/PM</td>
                                                                                                    <td class="bidrfq-client"
                                                                                                        data-id="3"><input
                                                                                                            type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $setup_cost[$key] && count($setup_cost[$key]) > $i ? $setup_cost[$key][$i] : 0  }}"
                                                                                                            placeholder="Setup Cost"
                                                                                                            name="setup_cost_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td class="bidrfq-client"
                                                                                                        data-id="4"><input
                                                                                                            type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $setup_cost[$key] && count($setup_cost[$key]) > $i + 1 ? $setup_cost[$key][$i + 1] : 0  }}"
                                                                                                            placeholder="Setup Cost"
                                                                                                            name="setup_cost_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Recruitment</td>
                                                                                                    <td class="bidrfq-client"
                                                                                                        data-id="3"><input
                                                                                                            type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $recruitment[$key] && count($recruitment[$key]) > $i ? $recruitment[$key][$i] : 0  }}"
                                                                                                            placeholder="Recruitment"
                                                                                                            name="recruitment_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $recruitment[$key] && count($recruitment[$key]) > $i + 1 ? $recruitment[$key][$i + 1] : 0  }}"
                                                                                                            placeholder="Recruitment"
                                                                                                            name="recruitment_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Incentives</td>
                                                                                                    <td class="bidrfq-client"
                                                                                                        data-id="3"><input
                                                                                                            type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $incentives[$key] && count($incentives[$key]) > $i ? $incentives[$key][$i] : 0  }}"
                                                                                                            placeholder="Incentives"
                                                                                                            name="incentives_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $incentives[$key] && count($incentives[$key]) > $i + 1 ? $incentives[$key][$i + 1] : 0  }}"
                                                                                                            placeholder="Incentives"
                                                                                                            name="incentives_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Moderation</td>
                                                                                                    <td class="bidrfq-client"
                                                                                                        data-id="3"><input
                                                                                                            type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $moderation[$key] && count($moderation[$key]) > $i ? $moderation[$key][$i] : 0  }}"
                                                                                                            placeholder="Moderation"
                                                                                                            name="moderation_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $moderation[$key] && count($moderation[$key]) > $i + 1 ? $moderation[$key][$i + 1] : 0  }}"
                                                                                                            placeholder="Moderation"
                                                                                                            name="moderation_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Transcript</td>
                                                                                                    <td class="bidrfq-client"
                                                                                                        data-id="3"><input
                                                                                                            type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $transcript[$key] && count($transcript[$key]) > $i ? $transcript[$key][$i] : 0  }}"
                                                                                                            placeholder="Transcript"
                                                                                                            name="transcript_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $transcript[$key] && count($transcript[$key]) > $i + 1 ? $transcript[$key][$i + 1] : 0  }}"
                                                                                                            placeholder="Transcript"
                                                                                                            name="transcript_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="txtCal" attr="Others"
                                                                                                            value="{{ $others[$key] && count($others[$key]) > $i + 1 ? $others[$key][$i + 1] : 'Others'  }}"
                                                                                                            placeholder="Others"
                                                                                                            name="others_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td class="bidrfq-client"
                                                                                                        data-id="3"><input
                                                                                                            type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $others[$key] && count($others[$key]) > $i + 2 ? $others[$key][$i + 2] : 0  }}"
                                                                                                            placeholder="Others"
                                                                                                            name="others_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $others[$key] && count($others[$key]) > $i + 3 ? $others[$key][$i + 3] : 0  }}"
                                                                                                            placeholder="Others"
                                                                                                            name="others_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td class="my-currency">
                                                                                                        Total Costs</td>
                                                                                                    <td><input type="text"
                                                                                                            value="{{ $total_cost[$key] && count($total_cost[$key]) > $i ? $total_cost[$key][$i] : 0  }}"
                                                                                                            class="border total_cost"
                                                                                                            placeholder="Total Cost"
                                                                                                            name="total_cost_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            value="{{ $total_cost[$key] && count($total_cost[$key]) > $i + 1 ? $total_cost[$key][$i + 1] : 0  }}"
                                                                                                            class="border total_cost"
                                                                                                            placeholder="Total Cost"
                                                                                                            name="total_cost_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table>
                                                                                        <?php  $i += 2  ?>
                                                                                        <table class="sub-table"
                                                                                            data-by="1">
                                                                                            <tbody class="sub-body_1">
                                                                                                <tr class="first-row">
                                                                                                    <td>Client/Vendor Name</td>
                                                                                                    <td>
                                                                                                        <select
                                                                                                            class="form-control label-gray-3"
                                                                                                            name="client_id_0[{{ $key }}][]" required>
                                                                                                            <option class="label-gray-3"
                                                                                                                value="">Client</option>
                                                                                                            @if (count($client) > 0)
                                                                                                                @foreach ($client as $v)
                                                                                                                    <option
                                                                                                                        value="{{ $v->client_name }}" {{ count($client_id) > 0 && count($client_id[$key]) > 0 && $client_id[$key][$j] == $v->client_name ? 'selected' : '' }}>
                                                                                                                        {{ $v->client_name }}
                                                                                                                    </option>
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                        </select>
                                                                                                    </td>
                                                                                                    <td class="v">
                                                                                                        <select
                                                                                                            class="form-control label-gray-3"
                                                                                                            name="vendor_id_0[{{ $key }}][]" required>
                                                                                                            <option class="label-gray-3"
                                                                                                                value="">Vendor</option>
                                                                                                            @if (count($vendor) > 0)
                                                                                                                @foreach ($vendor as $v)
                                                                                                                    <option
                                                                                                                        value="{{ $v->vendor_name }}" {{ count($vendor_id) > 0 && count($vendor_id[$key]) > 0 && $vendor_id[$key][$j] == $v->vendor_name ? 'selected' : '' }}>
                                                                                                                        {{ $v->vendor_name }}
                                                                                                                    </option>
                                                                                                                @endforeach
                                                                                                            @endif
                                                                                                        </select>
                                                                                                    </td>
                                                                                                </tr>
                                                                                                
                                                                                                <tr {{ $j++ }}>
                                                                                                    <td>Methodology</td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $methodology && $methodology[$key] && count($methodology[$key]) > $i ? $methodology[$key][$i] : 0  }}"
                                                                                                            name="methodology_0[{{ $key }}][]"
                                                                                                            placeholder="Methodology">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $methodology && $methodology[$key] && count($methodology[$key]) > $i + 1 ? $methodology[$key][$i + 1] : 0  }}"
                                                                                                            name="methodology_0[{{ $key }}][]"
                                                                                                            placeholder="Methodology">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Sample Size</td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $arr[$key] && count($arr[$key]) > $i ? $arr[$key][$i] : 0  }}"
                                                                                                            name="sample_size_0[{{ $key }}][]"
                                                                                                            placeholder="Sample Size">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $arr[$key] && count($arr[$key]) > $i + 1 ? $arr[$key][$i + 1] : 0  }}"
                                                                                                            name="sample_size_0[{{ $key }}][]"
                                                                                                            placeholder="Sample Size">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Setup Cost/PM</td>
                                                                                                    <td class="bidrfq-client"
                                                                                                        data-id="3"><input
                                                                                                            type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $setup_cost[$key] && count($setup_cost[$key]) > $i ? $setup_cost[$key][$i] : 0  }}"
                                                                                                            placeholder="Setup Cost"
                                                                                                            name="setup_cost_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td class="bidrfq-client"
                                                                                                        data-id="4"><input
                                                                                                            type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $setup_cost[$key] && count($setup_cost[$key]) > $i + 1 ? $setup_cost[$key][$i + 1] : 0  }}"
                                                                                                            placeholder="Setup Cost"
                                                                                                            name="setup_cost_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Recruitment</td>
                                                                                                    <td class="bidrfq-client"
                                                                                                        data-id="3"><input
                                                                                                            type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $recruitment[$key] && count($recruitment[$key]) > $i ? $recruitment[$key][$i] : 0  }}"
                                                                                                            placeholder="Recruitment"
                                                                                                            name="recruitment_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $recruitment[$key] && count($recruitment[$key]) > $i + 1 ? $recruitment[$key][$i + 1] : 0  }}"
                                                                                                            placeholder="Recruitment"
                                                                                                            name="recruitment_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Incentives</td>
                                                                                                    <td class="bidrfq-client"
                                                                                                        data-id="3"><input
                                                                                                            type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $incentives[$key] && count($incentives[$key]) > $i ? $incentives[$key][$i] : 0  }}"
                                                                                                            placeholder="Incentives"
                                                                                                            name="incentives_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $incentives[$key] && count($incentives[$key]) > $i + 1 ? $incentives[$key][$i + 1] : 0  }}"
                                                                                                            placeholder="Incentives"
                                                                                                            name="incentives_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Moderation</td>
                                                                                                    <td class="bidrfq-client"
                                                                                                        data-id="3"><input
                                                                                                            type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $moderation[$key] && count($moderation[$key]) > $i ? $moderation[$key][$i] : 0  }}"
                                                                                                            placeholder="Moderation"
                                                                                                            name="moderation_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $moderation[$key] && count($moderation[$key]) > $i + 1 ? $moderation[$key][$i + 1] : 0  }}"
                                                                                                            placeholder="Moderation"
                                                                                                            name="moderation_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>Transcript</td>
                                                                                                    <td class="bidrfq-client"
                                                                                                        data-id="3"><input
                                                                                                            type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $transcript[$key] && count($transcript[$key]) > $i ? $transcript[$key][$i] : 0  }}"
                                                                                                            placeholder="Transcript"
                                                                                                            name="transcript_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $transcript[$key] && count($transcript[$key]) > $i + 1 ? $transcript[$key][$i + 1] : 0  }}"
                                                                                                            placeholder="Transcript"
                                                                                                            name="transcript_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td>
                                                                                                        <input
                                                                                                            type="text"
                                                                                                            class="txtCal" attr="Others"
                                                                                                            value="{{ $others[$key] && count($others[$key]) > $i + 2 ? $others[$key][$i + 2] : 'Others'  }}"
                                                                                                            placeholder="Others"
                                                                                                            name="others_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td class="bidrfq-client"
                                                                                                        data-id="3"><input
                                                                                                            type="text"
                                                                                                            class="txtCal"
                                                                                                            value="{{ $others[$key] && count($others[$key]) > $i + 3 ? $others[$key][$i + 3] : 0  }}"
                                                                                                            placeholder="Others"
                                                                                                            name="others_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            class="txtbol"
                                                                                                            value="{{ $others[$key] && count($others[$key]) > $i + 4 ? $others[$key][$i + 4] : 0  }}"
                                                                                                            placeholder="Others"
                                                                                                            name="others_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                </tr>
                                                                                                <tr>
                                                                                                    <td class="my-currency">
                                                                                                        Total Costs</td>
                                                                                                    <td><input type="text"
                                                                                                            value="{{ $total_cost[$key] && count($total_cost[$key]) > $i ? $total_cost[$key][$i] : 0  }}"
                                                                                                            class="border total_cost"
                                                                                                            placeholder="Total Cost"
                                                                                                            name="total_cost_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                    <td><input type="text"
                                                                                                            value="{{ $total_cost[$key] && count($total_cost[$key]) > $i + 1 ? $total_cost[$key][$i + 1] : 0  }}"
                                                                                                            class="border total_cost"
                                                                                                            placeholder="Total Cost"
                                                                                                            name="total_cost_0[{{ $key }}][]">
                                                                                                    </td>
                                                                                                </tr>
                                                                                            </tbody>
                                                                                        </table><button
                                                                                            class="p-2 ml-2 btn btn-danger removetable"
                                                                                            type="button">
                                                                                            <svg class="svg-inline--fa fa-xmark"
                                                                                                aria-hidden="true"
                                                                                                focusable="false"
                                                                                                data-prefix="fa-solid"
                                                                                                data-icon="xmark"
                                                                                                role="img"
                                                                                                xmlns="http://www.w3.org/2000/svg"
                                                                                                viewBox="0 0 320 512"
                                                                                                data-fa-i2svg="">
                                                                                                <path fill="currentColor"
                                                                                                    d="M310.6 361.4c12.5 12.5 12.5 32.75 0 45.25C304.4 412.9 296.2 416 288 416s-16.38-3.125-22.62-9.375L160 301.3L54.63 406.6C48.38 412.9 40.19 416 32 416S15.63 412.9 9.375 406.6c-12.5-12.5-12.5-32.75 0-45.25l105.4-105.4L9.375 150.6c-12.5-12.5-12.5-32.75 0-45.25s32.75-12.5 45.25 0L160 210.8l105.4-105.4c12.5-12.5 32.75-12.5 45.25 0s12.5 32.75 0 45.25l-105.4 105.4L310.6 361.4z">
                                                                                                </path>
                                                                                            </svg><!-- <i class="fa-solid fa-xmark"></i> Font Awesome fontawesome.com -->
                                                                                        </button>
                                                                                    </div>
                                                                                    @endfor
                                                                                    @endif
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-md-12 d-flex align-items-center justify-content-center">
                                    <a href="{{ route('accounts.clientrequestadvance') }}"
                                        class=" btn btn-outline-secondary" id="won-rfq-btn1">Back</a>
                                    <button type="submit" id="addRegisterButton"
                                        class="btn btn-success ml-2 rfq-sub d-none">Update</button>
                                    <button id="nextrfq" class="btn btn-primary m-2 won-rfq-btn2">Next</button>
                                </div>
                                <div class="col-md-12 d-flex align-items-end justify-content-end">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">Last Edited by</label>
                                        <div class="col-lg-9 pl-2">
                                            <input name="last_edited_by" id="user" value="{{ $user3->name }}"
                                                type="text" class="form-control" placeholder="Last Editor by"
                                                readonly>
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
                            <form id="won" class="form col-md-12 d-flex flex-wrap update"
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
                                            href="{{ url($wonproject->client_contract ? 'adminapp/public/'.$wonproject->client_contract : '') }}">
                                            {{ $wonproject->client_contract ? 'adminapp/public/'.$wonproject->client_contract : '' }}
                                        </a>
                                            <input name="client_contract" style="text-transform: capitalize;"
                                                id="otherField15" type="file"
                                                value="{{ $wonproject->client_contract ? $wonproject->client_contract : '' }} "
                                                class="form-control p-1" placeholder="Attach Client Contract">
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
                                                            class="form-control p-1" placeholder="Attach Vendor Contract">
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
                                    <button id="next" class="btn btn-success ml-2">Next</button>
                                    {{-- <button type="submit" id="addRegisterButton"
                                class="btn btn-success ">Submit</button>
                                <a href="{{route('operationNew.create')}}" class=" btn btn-primary ml-2">Next</a> --}}
                                </div>
                                <div class="col-md-12 d-flex align-items-end justify-content-end">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">Last Edited by</label>
                                        <div class="col-lg-9 pl-2">
                                            <input name="last_editor_name" id="user" value="{{ $user3->name }}"
                                                type="text" class="form-control user" placeholder="Last Edited by"
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


    <div class="container">
        <div class="row d-none" id="Awaited">
            <div class="col-md-12">
                <div class="card">
                    <!-- <div class="card-title">vendor List</div> -->
                    <div class="card-header header-elements-inline">
                        <a class="ml-2 card-title">Client Invoice Request View</a>
                    </div>

                    <div class="card-body">

                        <form id="request" enctype="multipart/form-data">
                            <div class="row">

                                @csrf
                                <input type="hidden" id="id" name="id"
                                    value="{{ $clientrequest && $clientrequest->id ? $clientrequest->id : '' }}">
                                <div class="col-md-12">
                                    <div class="form-group row d-flex">
                                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">RFQ No
                                            <span class="text-danger"></span></label>
                                        <div class="col-lg-4">
                                            <input class="form-control" readonly="readonly"
                                                value="{{ $clientrequest && $clientrequest->rfq ? $clientrequest->rfq : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row d-flex">
                                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Client
                                            Name<span class="text-danger"></span></label>
                                        <div class="col-lg-4">
                                            <input class="form-control" readonly="readonly"
                                                value="{{ $clientrequest && $clientrequest->client_id ? $clientrequest->client_id : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row d-flex">
                                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Invoice
                                            Type<span class="text-danger"></span></label>
                                        <div class="col-lg-4">
                                            <input class="form-control" readonly="readonly"
                                                value="{{ $clientrequest && $clientrequest->invoice_type ? $clientrequest->invoice_type : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row d-flex">
                                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Client
                                            Amount<span class="text-danger"></span></label>
                                        <div class="col-lg-4">
                                            <input class="form-control" readonly="readonly"
                                                value="{{ $clientrequest && $clientrequest->currency ? $clientrequest->currency : '' }} {{ $clientrequest && $clientrequest->amount ? $clientrequest->amount : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row d-flex">
                                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Client
                                            Contract <span class="text-danger"></span></label>
                                        <div class="col-lg-4 d-flex">
                                            <input class="form-control" readonly="readonly"
                                                value="{{ $clientrequest && $clientrequest->client_contract ? $clientrequest->client_contract : '' }}">
                                                <a target="_blank" download
                                                href="{{ url($clientrequest && $clientrequest->client_contract ? 'adminapp/public/'.$clientrequest->client_contract : '') }}"
                                                class="mdi mdi-download"
                                                style="
                                                    margin-top: 10px;
                                                ">
                                             </a>
                                             
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row d-flex">
                                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Invoice
                                            Date</label> <span class="text-danger"></span></label>
                                        <div class="col-lg-4">
                                            <input class="form-control" readonly="readonly"
                                                value="{{ $clientrequest && $clientrequest->created_at ? $clientrequest->created_at : '' }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group row d-flex">
                                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Invoice
                                            Copy</label> <span class="text-danger"></span></label>
                                        <div class="col-lg-4 d-flex">
                                            @if ($clientrequest->upload_invoice != '')
                                                <input class="form-control" readonly="readonly"
                                                    value="{{ $clientrequest && $clientrequest->upload_invoice ? $clientrequest->upload_invoice : '' }}">
                                                    <a target="_blank" download
                                                    href="{{ url($clientrequest && $clientrequest->upload_invoice ? 'adminapp/public/'.$clientrequest->upload_invoice : '') }}"
                                                    class="mdi mdi-download"
                                                    style="
                                                        margin-top: 10px;
                                                    ">
                                                 </a>
                                            @else
                                                <input type="file" name="upload_invoice" id="upload_invoice"
                                                    class="form-control" required>
                                            @endif
                                        </div>
                                    </div>
                                </div>


                                <div class="col-md-12 text-center">

                                    <!--<button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">-->
                                    <!--  Send Invoice  client-awaited-->
                                    <!--</button>-->
                                    <button type="button" class="btn btn-outline-secondary" id="won-rfq">Back</button>
                                    <button type="submit" class="btn btn-success" id="client-awaited1">Send
                                        Invoice</button>
                                </div>


                            </div>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        </div>

        <!--upload -->
        <!--   <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">-->
        <!--     <div class="modal-dialog">-->
        <!--       <div class="modal-content">-->
        <!--         <div class="modal-header">-->

        <!--                 <h5 class="modal-title" id="exampleModalLabel">Upload Documents</h5>-->
        <!--                    <button type="button" class="close" style="color:red;" data-dismiss="modal" aria-label="Close"><i class="mdi mdi-close-circle"></i>-->
        <!--                 </div>-->
        <!--         <div class="modal-body">-->
        <!--           <form  id="request" enctype="multipart/form-data">-->
        <!--              @csrf-->
        <!--               <input type="hidden" id="upload_id" name="upload_id" value="{{ $clientrequest && $clientrequest->id ? $clientrequest->id : '' }}">-->

        <!--               <div class="mb-3">-->
        <!--               <label for="message-text" class="col-form-label">Upload Invoice</label>-->
        <!--               <input type="file" name="upload_invoice" id="upload_invoice" class="form-control" required>  -->
        <!--             </div>-->
        <!--             <div class="col-md-12">-->
        <!--             <button type="submit" id="client-awaited1" class="btn btn-success text-center">Save</button>-->
        <!--            </div>-->
        <!--           </form>-->

        <!--         </div>-->
        <!--         <div class="modal-footer">-->
        <!--         </div>-->
        <!--       </div>-->
        <!--     </div>-->
        <!--   </div>-->
        <!-- upload -->
    @endsection
    @section('script')
    @endsection

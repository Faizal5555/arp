@extends('layouts.master')

<style>
    .error{
        color:red;
        padding:10px;
    }
    th.operation-country {
    padding-left: 10px;
    padding-right: 88px;
}
button#addBtn {
    float: right;
    margin-bottom: 17px;
}
th {
    padding: 10px;
}
.my-second {
    margin-top: 20px;
}
button#commentsubmit {
    margin-top: 18px;
}
.card-header.header-elements-inline {
    background: linear-gradient( 43deg ,#0b5dbb,#0b5dbb);
    color: #fff;
}
.card .card-title {
    color: #fff;
}
input#respondentfile {
    text-transform: capitalize;
}
input#clientinvoicefile{
    text-transform: capitalize;
}
input#vendorinvoicefile {
    text-transform: capitalize;
}
input#client_confirmation{
    text-transform: capitalize;
}
input#vendor_confirmation{
   text-transform: capitalize;
}
input.form-control {
    text-transform: capitalize;
}
.msg-bubble {
    padding: 15px;
    border-radius: 15px;
    background: #ececec;
}
.msg-info-name {
    margin-right: 10px;
    font-weight: bold;
}
.msg-bubble1 {
    padding: 15px;
    border-radius: 15px;
    background: #579ffb;
}
.msg-text1 {
    color: #fff;
}
.msg-info-name1 {
    color: #fff;
}
.msger-inputarea {
    display: flex;
    padding: 10px;
    border-top: #ddd;
    background: #eee;
}
.msger-input {
    flex: 1;
    background: #ddd;
}
.msger-send-btn {
    margin-left: 10px;
    background: rgb(0, 196, 65);
    color: #fff;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.23s;
}
.msger-inputarea * {
    padding: 10px;
    border: none;
    border-radius: 3px;
    font-size: 1em;
}
.right-msg .msg-bubble {
    background: #579ffb;
    color: #fff;
    border-bottom-right-radius: 0;
}
.form-control:disabled, .form-control[readonly] {
    background-color: #e9ecef;
    opacity: 1;
    color: black;
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

</style>

@section('page_title', 'BidRfq Form')

@section('content')
<!--calculation-->
<!-- <script>
    $(document).ready(function () {
           
        $(document).on('keyup','#mtable td input:not(input[name^="sample_size"])', function () {
           // code logic here
            var id = $(this).parent().data('id');
            console.log(id);
               // console.log(sum);
            var sum = 0;
            $('#mtable td:nth-child('+id+') input:not(input[name^="sample_size"],[name^="total_cost"])').each(function(i,v) {
                if($(this).val()!='' && i!=7){
                    sum += Number($(this).val());
                    console.log($(this).val());
                }
            });
            $("#mtable td:nth-child("+id+") input.total_cost").val(sum);
        });
    
     });  
</script> -->


     <!--end calculation-->
<script>
    $(document).ready(function () {
        $("#update").validate({
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
                sample_size: {
                    required: true
                },
                setup_cost: {
                    required: true
                },
                recruitment: {
                    required: true
                },
                incentives: {
                    required: true
                },
                moderation: {
                    required: true
                },
                transcript: {
                    required: true
                },
                others: {
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
                    url: "{{route('bidrfq.update')}}",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        //   $('#register').get(0).reset();
                     if (data.success == 1) {
                           $('#ajaxModel').modal('show');  
                        }
                        else {
                             console.log(data.error);
                            
                            swal({
                            title: "Please Fill All Fields",
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
    $(document).on('click','.addvendor',function(){
      var key = $(this).attr('data-button');
      var d =  1 + parseInt($('.abcversion_'+key+'_2').last().attr("data-id"));
      var count = 1+parseInt($('.abcversion_'+key).last().attr('data-arr'));
      var calc =  parseInt ($('.abcversion_'+key+'_2').last().attr('data-cal'))+1;
      console.log(calc);

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

      console.log(id);
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
                                  @if(count($country) > 0)
                                    @foreach($country as $v)
                                     <option value="{{$v->name}}">{{$v->name}}</option>
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
                                    <input  type="text"   name="sample_size_0[${rar}][]" placeholder="Sample Size">
                                    </div>
                                </td>
                                
                                <td class="remove abcversion_${rar}_1 my-samplesize" data-id="${id+2}">
                                    
                                    <input type="text" class="txtbol" name="sample_size_0[${rar}][]" placeholder="Sample Size">
                                    </div>
                                </td>
                                
                            </tr>
                            

                            <tr>
                                <td></td>
                                
                                <td class="bidrfq-client" data-id="${id}+1" data-cal="0" data-culation="${rar}">
                                    

                                    
                                    <input type="text" class='cal_${rar}_0' placeholder="Setup Cost" name="setup_cost_0[${rar}][]">
                                    
                                </td>
                                
                                    <td  class="bidrfq-client abcversion_${rar}_2" data-id="${id+2}" data-cal="1" data-culation="${rar}">

                                    <input type="text" class='cal_${rar}_1'  placeholder="Setup Cost" name="setup_cost_0[${rar}][]">

                                    </td>
                                </tr>
                            <tr>

                                <td></td>
                                
                            <td  class="bidrfq-client" data-id="${id+1}" data-cal="0" data-culation="${rar}">
                                    
                                    <input type="text" class='cal_${rar}_0' placeholder="Recruitment" name="recruitment_0[${rar}][]">
                                    
                                </td>
                                <td class="abcversion_${rar}_3" data-id="${id+2}" data-cal="1" data-culation="${rar}">

                                       <input type="text" class='cal_${rar}_1'  placeholder="Recruitment" name="recruitment_0[${rar}][]">

                                </td>
                                
                            </tr>
                            <tr>
                                <td></td>
                                
                                <td  class="bidrfq-client" data-id="${id+1}" data-cal="0" data-culation="${rar}">
                                    
                                    <input type="text" class='cal_${rar}_0' placeholder="Incentives" name="incentives_0[${rar}][]">
                                
                                </td>

                                <td class="abcversion_${rar}_4" data-id="${id+2}" data-cal="1" data-culation="${rar}">

                                    <input type="text" class='cal_${rar}_1'  placeholder="Incentives" name="incentives_0[${rar}][]">
                                    
                                </td>

                            </tr>

                            <tr>
                                <td></td>
                                
                                <td class="bidrfq-client" data-id="${id+1}" data-cal="0" data-culation="${rar}">
                                    
                                        <input type="text" class='cal_${rar}_0' placeholder="Moderation" name="moderation_0[${rar}][]">

                                    
                                </td>
                                    
                                <td class="abcversion_${rar}_5" data-id="${id+2}" data-cal="1" data-culation="${rar}">

                                        <input type="text" class='cal_${rar}_1'   placeholder="Moderation" name="moderation_0[${rar}][]">

                                </td>
                                    </tr>
                            <tr>
                                <td></td>
                                
                                <td class="bidrfq-client" data-id="${id+1}" data-cal="0" data-culation="${rar}">
                                    
                                        <input type="text" class='cal_${rar}_0' placeholder="Transcript" name="transcript_0[${rar}][]">
                                    
                                </td>
                                <td class="abcversion_${rar}_6" data-id="${id+2}" data-cal="1" data-culation="${rar}">

                                   <input type="text" class='cal_${rar}_1'  placeholder="Transcript" name="transcript_0[${rar}][]">
                                </td>

                            </tr>

                            <tr>
                                <td></td>
                                
                                <td class="bidrfq-client" data-id="${id+1}" data-cal="0" data-culation="${rar}">

                                        <input type="text" class='cal_${rar}_0' placeholder="Others" name="others_0[${rar}][]">
                                    
                                </td>
                                <td class="bidrfq-vendor abcversion_${rar}_7" data-id="${id+2}" data-cal="1" data-culation="${rar}">

                                <input type="text" class='cal_${rar}_1' placeholder="Others" name="others_0[${rar}][]">

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
            console.log(('.edit-table-bid tr:nth-child(4) td').length);
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
console.log('add-country_'+tom);
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
         console.log(('.cal_'+first+'_'+second));

        
        
         var sum = 0;
         $('.cal_'+first+'_'+second).each(function(i,v) {
            //  console.log($(this).val());
                if($(this).val()!='' && i!=7){
                    sum += Number($(this).val());
                    console.log(sum);
        
                   
                }
            });
            $('.total_cost_'+first+'_'+second).val(sum);

       });
   
    });
    </script>

   



<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card-body">
                <div class="row">
                    <form id="rfq" class="flex-wrap form col-md-12 d-flex update"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{$newrfq && $newrfq->id ? $newrfq->id  : ''}}">
                        <input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount">
                    
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
                                        type="date" class="form-control" placeholder="Date" readonly>
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
                            <select class="form-control label-gray-3" name="industry" placeholder="Select Industry" disabled>
                            <option value="Gen-Pop" {{$newrfq && $newrfq->industry =='Gen-Pop' ? 'selected' : '' }}>Gen-Pop</option>                                      
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
                                        type="date" class="form-control" placeholder="Follow Up date" readonly>
                                </div>
                            </div>
                        </div>
                       
                        
                        <div class="col-md-6">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Choose Company
                                    Name<span class="text-danger">*</span></label>
                                <div class="col-lg-9">
        
                                    <select class="form-control label-gray-3" id="company_name"
                                        name="company_name" disabled>
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
                        <div class="w-100">
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
                                   
                                        @if(isset($newrfq) && isset($newrfq->multiple))
                                    <div class="table-container mt-2">
                                        <table class="" id="MultipleCountry">
                                            <tbody>
                                                <tr>
                                                    <td class="static-field">Methodology</td>
                                                    @if(count($multiple_methodology) > 0)
                                                        @foreach($multiple_methodology as $key => $methodology)
                                                            <td  colspan="3">
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
                                                    <td class="total-cost relative ">Total project Cost</td>
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
                                                            <td colspan="3">
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
                                                    <td class="static-field">Samples per FGD/IDI</td>
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
                                                        <td  colspan="3">
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
                                                    <td class="static-field ">LOI</td>
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
                                                    <td class="static-field ">Country</td>
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
                                                    <td class="static-field ">Recruitment</td>
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
                                                    <td class="static-field">Project Management</td>
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
                                                    <td class="total-cost">Total Project Cost</td>
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
                        </div> 
                                
                        <div class="col-md-12 d-flex align-items-center justify-content-center mt-4">
                            <a href="{{route('operationNew.indexclose')}}" class=" btn btn-outline-secondary" id="won-rfq-btn1">Back</a>
                            <button type="submit" id="addRegisterButton"
                                class="ml-2 btn btn-success rfq-sub d-none">Update</button>
                            <p id="nextrfq" class="m-2 btn btn-primary won-rfq-btn2">Next</button>
                        </div>
                        {{-- <div class="col-md-12 d-flex align-items-end justify-content-end">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Last Edited by</label>
                                <div class="pl-2 col-lg-9">
                                    <input name="last_editor_by" id="user" value="{{$user3->name}}" type="text" class="form-control" placeholder="Last Editor Name" readonly>
                                </div>
                            </div>
                        </div> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade"id="ajaxModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="text-center modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Status</h5>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                     <div class="row">
                    <div class="col-md-4">
                        <div class="won-my">
                        <button class="btn btn-success btn-rounded btn-fw" id="project_won">Project Won</button>
                    </div>
                </div>
                    <div class="col-md-4">
                        <div class="lost-my">
                        <a type="button" id="editCompany" class="tablinks btn btn-danger btn-rounded btn-fw editCompany"
                                                data-id="" data-toggle="modal" data-target="#examplelost">
                                                Project Lost
                                                    {{-- dd({{$value->id}});  --}}
                                                </a>
                    </div>
                   </div>
                    <div class="col-md-4">
                        <div class="next-my">
                        <a type="button" id="editNext" class="tablinks btn btn-info btn-rounded btn-fw editNext"
                                                    data-id="" data-toggle="modal" data-target="#exampleNext">
                                                    Next Follow Up
                                                    {{-- dd({{$value->id}});  --}}
                                                </a>
                    </div>
                </div>
                </div>
            </div>  
            </div>
            </div>
          </div>
        </div>
      </div>
    

   

       <!-- lost Modal -->
    <div class="modal fade" id="examplelost" tabindex="-1" role="dialog" aria-labelledby="examplelostLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="examplelostLabel">Lost Project</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <form id="lostupdate" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id"  id="id" value="{{$newrfq && $newrfq->id ? $newrfq->id  : ''}}" >
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Date<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="follow_up_date" id="follow_up_date" value=""
                                        type="date" class="form-control" placeholder="Follow Up date" required="date">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Comments<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <textarea name="comments" id="comments" value=""
                                    class="form-control" placeholder="Comments here..." required="comments"></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" id="addRegisterButton2" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>


     <!-- next Modal -->
    <div class="modal fade" id="exampleNext" tabindex="-1" role="dialog" aria-labelledby="exampleNextLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleNextLabel">Next Follow Up Date</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-danger" style="display:none"></div>
                    <form id="update"  >
                        @csrf
                        <input type="hidden" name="id"  id="id" value="{{$newrfq && $newrfq->id ? $newrfq->id  : ''}}" >
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Next Follow Up Date<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <input name="follow_up_date" id="follow_up_date1" value=""
                                        type="date" class="form-control" placeholder="Follow Up date"/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group row">
                                <label class="col-lg-3 col-form-label font-weight-semibold">Comments<span
                                        class="text-danger">*</span></label>
                                <div class="col-lg-9">
                                    <textarea name="comments" id="comments1" value=""
                                    class="form-control" placeholder="Comments here..." /></textarea>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" id="addRegisterButton1" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>
    </div>
    
    
   
                                            
<div class="container-fluid">
    <div class=" row d-none" id="wonproject-id">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header header-elements-inline">
                <div class="card-title">
                    <div class="sub-text">
                        Commissioned Project
                    </div>
                    </div>
                </div>

                {{-- <div class="card-body">
                    <div class="row">
                        <form id="register1" class="flex-wrap form col-md-12 d-flex"
                           enctype="multipart/form-data">
                           @csrf
                           <input type="hidden" value="rfq_no_id">
                           <input id="bidrfqCount" type="hidden" value="1" name="wonCount">
                            <div class="row add">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">RFQ No <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                        
                                                 <select class="form-control label-gray-3" name="rfq_no" id="rfq_no">
                                            <option class="label-gray-3" value="" disabled selected>Select RFQ No</option>
                                        
                                            @foreach($client_id as $key=>  $value)
                                            @foreach($value as $v)
                                            
                                             @if (!in_array(( $newrfq->rfq_no.'_'.$v), $rfq)) 
                                                <option class="label-gray-3" value="{{ $newrfq->rfq_no}}_{{$v}}">{{ $newrfq->rfq_no}}-{{$v}}</option>
                                             @endif
                                           
                                                 
                                                 @endforeach 
                                                 @endforeach
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold" id="otherField1">Project Name<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="project_name" type="text"
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
                                                    <option class="label-gray-3" disabled selected>Select Project Type</option>
                                                    <option value="Qualitative">Qualitative</option>
                                                    <option value="Quantitative">Quantitative</option>
                                                    <option value="Community">Community</option>
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
                                                <option value="Insource">Insource</option>
                                                <option value="Outsource">Outsource</option>
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
                                        <label id="otherField4" class="col-lg-3 col-form-label font-weight-semibold">Start Date<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="project_start_date" 
                                                id="otherField4" type="date" class="form-control" placeholder="Start Date">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField5" class="col-lg-3 col-form-label font-weight-semibold">End Date<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="project_end_date" 
                                                id="otherField5" type="date" class="form-control" placeholder="End Date">
                                        </div>
                                    </div>
                                </div>
                                
                            
                                
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField8" class="col-lg-3 col-form-label font-weight-semibold">Total Margins<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                             <label class="currency" id="total_margin_currency"></label>
                                            <input name="total_margin" 
                                                id="otherField8" type="text" class="form-control" placeholder="Total Margin">
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
                                            <input name="client_advance" 
                                                id="otherField10" type="text" class="form-control" placeholder="Advance Payment">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField11" class="col-lg-3 col-form-label font-weight-semibold">Balance Payment<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="client_balance_currency"></label>
                                            <input name="client_balance" 
                                                id="otherField11" type="text" class="form-control" placeholder="Balance Payment">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField6" class="col-lg-3 col-form-label font-weight-semibold">Client Total Project Invoice Value<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                              <label class="currency" id="client_total_currency"></label>
                                            <input name="client_total" 
                                                id="otherField6" type="text" class="form-control" placeholder="Client Total Project Invoice Value">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField15" class="col-lg-3 col-form-label font-weight-semibold">Attach Client Contract / Email <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <input name="client_contract" style="text-transform: capitalize;" 
                                                id="otherField15" type="file" class="p-1 form-control" placeholder="Attach Client Contract">
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        
                                        <label class="col-lg-12 col-form-label font-weight-semibold"><u>Vendor Invoicing Terms</u></label>
                                        
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-md-6"></div>
                                        <div class="col-md-6"> <button class="won-add-vendor btn btn-success" type="button">Add Vendor</button> </div>
                                   
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                    <label id="otherField13" class="col-lg-3 col-form-label font-weight-semibold">Vendor Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                        <select class="form-control label-gray-3" name="vendor_id_0[0]" id="vendor_id">
                                           <option class="label-gray-3" value="" disabled selected>Select Vendor Name</option>
                                           @foreach($vendor_id as $key=>  $value)
                                       @foreach($value as $k)
                                         <option class="label-gray-3" value="{{$k}}">{{$k}}</option>
                                        @endforeach
                                        @endforeach 
                                        </select> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my_vendor_0">
                                    <div class="form-group row">
                                        <label id="otherField13" class="col-lg-3 col-form-label font-weight-semibold">Advance Payment <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="vendor_advance_currency"></label>
                                            <input name="vendor_advance_0[0]" 
                                                id="otherField13" type="text" class="form-control" placeholder="Advance Payment">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my_vendor_1">
                                    <div class="form-group row">
                                        <label id="otherField14" class="col-lg-3 col-form-label font-weight-semibold">Balance Payment<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="vendor_balance_currency"></label>
                                            <input name="vendor_balance_0[0]"
                                                id="otherField14" type="text" class="form-control" placeholder="Balance Payment">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label id="otherField7" class="col-lg-3 col-form-label font-weight-semibold">Vendor Total Project Invoice Value<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="vendor_total_currency"></label>
                                            <input name="vendor_total_0[0]" 
                                                id="otherField7" type="text" class="form-control"  placeholder="Vendor Total Project Invoice Value">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my_vendor_3">
                                    <div class="form-group row">
                                        <label id="otherField16" class="col-lg-3 col-form-label font-weight-semibold">Attach Vendor Contract / Email<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">

                                           
                                            <input name="vendor_contract_0[0]" style="text-transform: capitalize;" 
                                                id="otherField16" type="file" class="p-1 form-control" placeholder="Attach Vendor Contract">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-lg-9">
                                        </div>
                                    </div>
                                </div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <a href="{{route('bidrfq.lostproject')}}" class=" btn btn-outline-secondary">Back</a>
                                <button type="submit" id="addRegisterButton"
                                    class="ml-2 btn btn-success">Submit</button>
                            </div>
                        </form>
                    </div>
                </div> --}}


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

@section('scripts')

{{-- next followupdate --}}

<script>
    $(document).ready(function(){
        $('#addRegisterButton1').click(function(e){
            e.preventDefault();
            
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            $.ajax({
                url: "{{ route('bidrfq.nextFollowupdate') }}",
                method: 'post',
                data: {
                    id:$('#id').val(),
                    follow_up_date: $('#follow_up_date1').val(),
                    comments: $('#comments1').val(),

                 },
                success: function(result){
                    
                     if(result.success == 1)
                       {
                        swal({
                            title:'Updated Successfully',
                            icon:'success',
                            button:false
                        })
                        window.location="{{route('bidrfq.followup')}}";
                       }else{
                           swal({
                            title: "Please Fill All Fields",
                            type: "warning",
                             dangerMode: true,
                         
                        })
                    }
                }
            });
            
        });
     });
</script>


{{-- lost followupdate --}}

<script>
    $(document).ready(function(){
        $('#addRegisterButton2').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            $.ajax({
                url: "{{ route('bidrfq.Followupdate') }}",
                method: 'post',
                data: {
                    id:$('#id').val(),
                    follow_up_date: $('#follow_up_date').val(),
                    comments: $('#comments').val(),
                  

                 },
                success: function(result){
                     if(result.success == 1)
                       {
                        swal({
                            title:'Lost Updated Successfully',
                            icon:'success',
                            button:false
                        })
                       window.location = "{{route('bidrfq.index')}}";
                       }else{
                           swal({
                            title: "Please Fill All Fields",
                            type: "warning",
                             dangerMode: true,
                         
                        })
                       }
                    
                    }
                
            });
        });
     });
</script>

<!-- wonproject script -->
<script>

$(document).on('click','#project_won',function(){
    $('#wonproject-id').removeClass('d-none');
    $('#ajaxModel').modal('hide');
    $('#bidrfq').addClass('d-none');
});
</script>

<script>
$(document).on('change','#worldcurrency',function(){
    var id=$(this).val();
    var inputs = $('input[type="text"]');
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
$(document).ready(function () {
        $("#register1").validate({
            rules: {
                rfq_no: {
                    required: true
                },
                client_id:{
                    required: true
                },
                vendor_id:{
                    required: true
                },
                project_name: {
                    required: true
                },
                project_execution: {
                    required: true
                },
                currency:{
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
                client_contract: {
                    required: true
                },
                vendor_contract: {
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
                    url: "{{route('wonproject.store')}}",
                    data: data,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        if(data.success == 1){
                        swal({
                            title:'Success',
                            text:'Won Project Added Successfully',
                            icon:'success',
                            buttons:false
                        })
                        window.location="{{route('wonproject.index')}}";
                    }
                    else{
                           swal({
                            title: "Please Fill All Fields",
                            type: "warning",
                             dangerMode: true,
                         
                        })
                    }
                    }
                });

            }
        });
    });

</script>



{{-- <script>
        $(document).on('click','.won-add-vendor',function(){
            var woncount=1+ parseInt($('div.count-vendor:last').attr('data-won'));
            console.log(woncount);
           
            var html=`<div class="col-md-6 remove_${woncount}">
                                    <div class="form-group row">
                                        <div class="col-lg-9"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 my_vendor_0 remove_${woncount}">
                                    <div class="form-group row">
                                      
                                        <div class="col-lg-12">
                                        <div class="count-vendor"  data-won="${woncount}">
                                        <div class="float-right icons won-remove-vendor" data-wrap="${woncount}">
                                        <i class="float-left fa-solid fa-circle-minus "></i>
                                        </div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 remove_${woncount}">
                                    <div class="form-group row">
                                    <label id="otherField13" class="col-lg-3 col-form-label font-weight-semibold">Vendor Name <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                        <select class="form-control label-gray-3" name="vendor_id_0[${woncount}]" id="vendor_id">
                                           <option class="label-gray-3" value="" disabled selected>Select Vendor Name</option>
                                           @foreach($vendor_id as $key=>  $value)
                                       @foreach($value as $k)
                                         <option class="label-gray-3" value="{{$k}}">{{$k}}</option>
                                        @endforeach
                                        @endforeach 
                                            <option class="label-gray-3" value=""></option>
                                           
                                        </select> 
                                        </div>
                                    </div>
                                </div>
                              <div class="col-md-6 my_vendor_0 remove_${woncount}">
                                    <div class="form-group row">
                                        <label id="otherField13" class="col-lg-3 col-form-label font-weight-semibold">Advance Payment <span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="vendor_advance_currency"></label>
                                            <input name="vendor_advance_0[${woncount}]" 
                                                id="otherField13" type="text" class="form-control" placeholder="Advance Payment">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my_vendor_1 remove_${woncount}">
                                    <div class="form-group row">
                                        <label id="otherField14" class="col-lg-3 col-form-label font-weight-semibold">Balance Payment<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="vendor_balance_currency"></label>
                                            <input name="vendor_balance_0[${woncount}]"
                                                id="otherField14" type="text" class="form-control" placeholder="Balance Payment">
                                        </div>
                                    </div>
                                </div> 
                                <div class="col-md-6 my_vendor_4 remove_${woncount}">
                                    <div class="form-group row">
                                        <label id="otherField7" class="col-lg-3 col-form-label font-weight-semibold">Vendor Total Project Invoice Value<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">
                                            <label class="currency" id="vendor_total_currency"></label>
                                            <input name="vendor_total_0[${woncount}]" 
                                                id="otherField7" type="text" class="form-control" placeholder="Vendor Total Project Invoice Value">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 my_vendor_3 remove_${woncount}">
                                    <div class="form-group row">
                                        <label id="otherField16" class="col-lg-3 col-form-label font-weight-semibold">Attach Vendor Contract / Email<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">

                                           
                                            <input name="vendor_contract_0[${woncount}]" style="text-transform: capitalize;" 
                                                id="otherField16" type="file" class="p-1 form-control" placeholder="Attach Vendor Contract">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                    <div class="form-group row">
                                        <div class="col-lg-9">
                                        </div>
                                    </div>
                                </div>`;
            $('.add').last().append(html);
        }); --}}
        {{-- $(document).on('click','.won-remove-vendor',function(){
          var k = $(this).attr('data-wrap');
          $('.remove_'+k).remove(); --}}

        });
    </script>

@endsection
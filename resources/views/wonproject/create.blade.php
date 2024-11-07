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
select.form-control {
    padding: 0.4375rem 0.75rem;
    border: 0;
    outline: 1px solid #ebedf2;
    color: #000000;
}
select.won-drop {
    border: none;
    padding: 0.4375rem 0.75rem;
    border: 0;
    outline: 1px solid #ebedf2;
    color: #000;
    border-radius: 5px;
}
select.won-drop {
 
    margin-right: 42px;
}
select.client-drop {
    padding: 0.4375rem 0.75rem;
    border: 0;
    outline: 1px solid #ebedf2;
    color: #000;
    border-radius: 5px;
    margin-right: 42px;
}
select.vendor-drop {
    padding: 0.4375rem 0.75rem;
    border: 0;
    outline: 1px solid #ebedf2;
    color: #000;
    border-radius: 5px;
    margin-right: 42px;
}
input.i {
    margin-right: 10px;
}
input#setup_cost {
    margin-right: 10px;
}
input#recruitment {
    margin-right: 10px;
}
input#moderation {
    margin-right: 10px;
}
input#incentives {
    margin-right: 10px;
}
input#transcript {
    margin-right: 10px;
}
input#others {
    margin-right: 10px;
}
input#total_sum_value {
     margin-right: 10px;
}

    </style>
@section('page_title', 'WonProject Form')
@section('content')

<script>
    $(document).ready(function () {
        $("#register").validate({
            rules: {
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
                        swal({
                            title:'Form Created Successfully',
                            text:'Won Project Created Successfully',
                            icon:'success',
                            buttons:false
                        })
                        $('#register').get(0).reset()
                        // if (data.success == 1) {
                        //     // loadButton('#addRegisterButton');
                        //     flash({ msg: data.message, type: 'success' });
                        //     window.location = "{{route('wonproject.index')}}";
                        // }
                        // else {
                        //     flash({ msg: data.message, type: 'info' });
                        // }
                    }
                });

            }
        });

        $("#update").validate({
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
                    url: "{{route('wonproject.update')}}",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        swal({
                            title:'Form update Successfully',
                            text:'Won Project Update Successfully',
                            icon:'success',
                            buttons:false
                        })
                        $('#update').get(0).reset()
                        if (data.success == 1) {
                            flash({ msg: data.message, type: 'success' });
                            window.location = "{{route('wonproject.index')}}";
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
    <div class="row">
        <div class="col-md-12">
            <div class="card">

                <div class="card-header header-elements-inline">
                <div class="card-title">
                    <div class="sub-text">
                        WonProject Form
                    </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                    </div>
                    <form  class="form col-md-12 d-flex flex-wrap"
                       enctype="multipart/form-data" id="update">
                       @csrf

                       
                       
                       {{-- <input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount"> --}}
                           <input type="hidden" value="rfq_no_id">
                            <div class="col-md-6 " id="my-div">
                                
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">RFQ No <span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <!-- <input name="rfq_no" value="{{$wonproject && $wonproject->rfq_no ? $wonproject->rfq_no : ''}}"
                                             type="text" class="form-control" placeholder="wonproject Name"> -->
                                        <select class="form-control label-gray-3 " name="rfq_no" id="rfq_no"  data-id="rfq_no">
                                            <option class="label-gray-3" value="">Select RFQ No</option>

                                                @if (count($bidrfq) > 0)
                                                @foreach($bidrfq as $value)
                                                @if(!empty($value['client_id']))
                                                @foreach(explode(",",$value['client_id']) as $t)
                                                <option value="{{$value->rfq_no}}">{{$value->rfq_no}} -  {{ $t }}</option>
                                                @endforeach
                                                @endif
                                                @endforeach
                                                @endif
                                        </select>
                                    </div>
                                </div>
                            </div>

                           

                            <div class="row d-none" id="otherFieldDiv">
                            
                          
                               
                         <input type="hidden" name="id"  value="{{$value && $value->id ? $value->id  : ''}}" >  
                           <input id="bidrfqCount" type="hidden" value="1" name="bidrfqCount">


                             {{-- <input type="text" id="id" value={{$bidrfq && $bidrfq->id ? $bidrfq->id : ''}} > --}}
                              
                                   
                             
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-lg-3 col-form-label font-weight-semibold">Rfq No<span
                                                class="text-danger">*</span></label>
                                        <div class="col-lg-9">

                                            <input type="text" name="rfq_no" value="" id="rfqno" readonly="readonly"  class="form-control " placeholder="rfq_no">
                                        </div>
                                    </div>
                                </div>


                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Date<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input name="date" value="{{$value && $value->date ? $value->date : ''}}"
                                        id="date" type="date" class="form-control " placeholder="Date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label   class="col-lg-3 col-form-label font-weight-semibold">Industry<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                       
                                        <select class="form-control label-gray-3" name="industry" id="industry">
                                            <option class="label-gray-3" value="">Select Industry</option>
                                            <option value="Sugar">Sugar</option>
                                            <option value="Fertilizer">Fertilizer</option>
                                            <option value="Paper">Paper</option>
                                            <option value="Automobile">Automobile</option>
                                            <option value="textile">Textile</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group row">
                                    <label class="col-lg-3 col-form-label font-weight-semibold">Follow Up date<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-9">
                                        <input  id="follow_up_date" name="follow_up_date" value="{{$value && $value->follow_up_date ? $value->follow_up_date : ''}}"
                                            type="date" class="form-control" placeholder="Follow Up date">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 table-responsive" style="overflow-x:auto;">
                                <div class="form-group row">
                                    <label  id="otherField5" class="col-lg-12 col-form-label font-weight-semibold">Industry Table<span
                                            class="text-danger">*</span></label>
                                    <div class="col-lg-12">
                                        <div class="rfq-table">
                                    <table class="table table-striped" id="myTable" >
                                       
                                        
                                        
                                        <tr>
                                           
                                        <tr>
                                          
                                            <th >Vendorname</th>

                                            <th>
                                                <div class="vendorname"></div>
                                                {{-- <label class="form-group has-float-label">
                                                <select class="form-control label-gray-3" name="vendor_id_0[]" id="vendor_id">
                                                    <option class="label-gray-3" value="">Vendor</option>
                                                        @if(isset ($vendor) && count($vendor) > 0)
                                                        @foreach($vendor as $v)
                                                    <option value="{{$v->vendor_name}}" {{$value->vendor_id == $v->vendor_name ?'selected' :''}}>{{$v->vendor_name}}</option>
                                                        @endforeach
                                                        @endif
                                                </select>
                                                <span>Vendor Name</span>
                                            </label> --}}
                                            </th>

                                          <th></th>
                                        </tr>
                                        <tr>

                                            <th>Clientname</th>
                                            <th>
                                                <div class="clientname"></div>
                                                {{-- <label class="form-group has-float-label">
                                                <select class="form-control label-gray-3" name="client_id_0[]" id="client_id">
                                                    <option class="label-gray-3" value="">Client</option>
                                                        @if(isset ($client) && count($client) > 0)
                                                        @foreach($client as $v)
                                                    <option value="{{$v->client_name}}"{{$value->client_id == $v->client_name ? 'selected' : ''}}>{{$v->client_name}}</option>
                                                   
                                                        @endforeach
                                                        @endif
                                                </select>
                                                <span>Client Name</span>
                                                </label> --}}
                                            </th>

                                        <th></th>

                                        </tr>
                                       
                                    
                                        <tr>
                                            <td>Country</td>
                                            <td>
                                                {{-- {{dd($world)}} --}}
                                                <div class="country"></div>
                                                {{-- <label class="form-group has-float-label">
                                                <select class="form-control label-gray-3" name="country_0[]" id="country">
                                                    <option class="label-gray-3" value="">Country</option>
                                                        @if(isset ($country) && count($country) > 0)
                                                        @foreach($country as $v)
                                                    <option value="{{$v->name}}"{{$value->country == $v->name ? 'selected' : ''}}>{{$v->name}}</option>
                                                        @endforeach
                                                        @endif
                                                </select>
                                                <span>Country</span>
                                            </label> --}}

                                            </td>
                                            <td></td>
                                           
                                        </tr>

                                        
                                        <tr>
                                         
                                            
                                            <td>Sample Size</td>
                                           
                                            <td>
                                                {{-- {{dd($sample_size)}} --}}
                                                
                                                <div class="sample_size">

                                                </div>
                                                {{-- <input  type="text" class='i'  value="{{$value && $value->sample_size ? $value->sample_size :''}}"  name="sample_size_0[]"  id="sample_size" placeholder="Sample Size"> 
                                                --}}
                                            </td>
                                            
                                          
                                            
                                        <tr>
                                            <td>Setup Cost</td>
                                           
                                            <td>
                                                

                                               <div class="setup_cost">

                                               </div>
                                            
                                                
                                            </td>
                                            
                                             
                                            </tr>
                                        <tr>
                                            <td>Recruitment</td>
                                            
                                            <td>
                                                <div class="recruitment">
                                                    
                                                </div>
                                               
                                                {{-- <input type="text" class='txtCal' value="{{$value && $value->recruitment ? $value->recruitment :''}}" placeholder="Recruitment" id="recruitment" name="recruitment_0[]"> --}}
                                                

                                            
                                            </td>
                                           
                                           </tr>
                                        <tr>
                                            <td>Incentives</td>
                                          
                                            <td>
                                                <div class="incentives">

                                                </div>
                                                
                                                {{-- <input type="text" class='txtCal' value="{{$value && $value->incentives ? $value->incentives:''}}"  placeholder="Incentives" id="incentives" name="incentives_0[]"> --}}
                                            
                                            </td>

                                          
                                            </tr>
                                        <tr>
                                            <td>Moderation</td>
                                           
                                            <td>
                                               <div class="moderation">
                                                   
                                               </div>
                                                    {{-- <input type="text" class='txtCal' value="{{$value && $value->moderation ? $value->moderation :''}}"   placeholder="Moderation" id="moderation" name="moderation_0[]"> --}}

                                               
                                            </td>
                                               
                                            
                                             </tr>
                                        <tr>
                                            <td>Transcript</td>
                                           
                                            <td>

                                                <div class="transcript">

                                                </div>
                                                
                                                    {{-- <input type="text"class='txtCal' value="{{$value && $value->transcript ? $value->transcript :''}}" placeholder="transcript" id="transcript" name="transcript_0[]"> --}}
                                                
                                                </td>
                                            
                                             </tr>
                                        <tr>
                                            <td>Others</td>
                                            
                                            <td>
                                                <div class="others"></div>
                                                {{-- <input type="text" class='txtCal' value="" placeholder="Others" id="others" name="others_0[]"> --}}
                                                
                                                </td>
                                            
                                           </tr>
                                        <tr>
                                            <td>Total Cost</td>
                                            
                                            <td>
                                                <div class="total_cost"></div>
                                                {{-- <input type="text" id="total_sum_value"   class="border" placeholder="Total Cost" name="total_cost_0[]"></b> --}}
                                            </td>
                                            
                                        </tr>
                                   
                                    </table><br>
                                    <div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 d-flex align-items-center justify-content-center">
                                <a href="{{route('wonproject.index')}}" class=" btn btn-outline-secondary">Back</a>
                                <a href="{{route('wonproject.createwon')}}" class=" btn btn-primary ml-2">Next</a>
                                <button type="submit" id="addRegisterButton"
                                    class="btn btn-success ml-2">Submit</button>
                                  
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


$(document).on('change', '#rfq_no', function() {

    var id = $(this).val();
    
    

$.ajax({
      type: "GET",
      url: "{{route('wonproject.view')}}",
      data: {
          id:id,
         
          
      },
      dataType: "json",
      success: function (data) {

        var vendor_html="";
        var client_html = "";
        var country_html ="";
        var sample_html = "";
        var setup_html = "";
        var recruitment_html ="";
        var incentives_html="";
        var moderation_html="";
        var transcript_html="";
        var others_html="";
        var total_cost_html="";



        
      
       $("#rfqno").val(data.bidrfq.rfq_no);
     
       $("#date").val(data.bidrfq.date);
       $("#follow_up_date").val(data.bidrfq.follow_up_date);
       $("#industry").val(data.bidrfq.industry);

       $.each(data.bidrfq.vendor_id.split(','),function(index,val){
        vendor_html +=`<select name="vendor_name" class="vendor-drop">`
       $.each(data.vendor,function(index,value){
           if(val == value.vendor_name){
               vendor_html +=`<option value="${value.vendor_name}" selected>${value.vendor_name}</option>`
           }
           else{
               vendor_html +=`<option value="${value.vendor_name}">${value.vendor_name}</option>`
           }

       });     
            vendor_html +=`</select>`

       });
       $('.vendorname').html(vendor_html);
     


      $.each(data.bidrfq.client_id.split(','),function(index,val){
       client_html +=`<select name="client" class="client-drop">`
       $.each(data.client,function(key,value){
           if(val == value.client_name)
           {
            client_html +=`<option value="${value.client_name}" selected>${value.client_name}</option>`
            
           }
           else{
            client_html +=`<option value="${value.client_name}">${value.client_name}</option>`
           }
           
       });     
            client_html +=`</select>`
      });
      $('.clientname').html(client_html);




         console.log(data.bidrfq.country);
         $.each(data.bidrfq.country.split(','),function(index,val){
            country_html += `<select name="country" class="won-drop">`;
       
            $.each(data.country,function(key,value){
            if(val == value.name)
            {
                country_html += ` <option value="${value.name}" selected >${value.name}</option> `

            }else{
                country_html += ` <option value="${value.name}" >${value.name}</option> `

            }
            });
            country_html += `</select>`;
        });
       
    //    console.log(data.country);
     
    //  console.log(country_html);
     $('.country').html(country_html);
      

                                            
    
     


        $("#sample_size").val(data.bidrfq.sample_size);
        $.each(data.bidrfq.sample_size.split(','),function(index,val){
            sample_html += `<input  type="text" class='i'  value="${val}"  name="sample_size_0[]"   placeholder="Sample Size">`;
        });
        $('.sample_size').html(sample_html);

      
       $("#setup_cost").val(data.bidrfq.setup_cost);
       $.each(data.bidrfq.setup_cost.split(','),function(index,val){
        setup_html +=` <input type="text" class='txtCal' value="${val}" placeholder="Setup Cost" id="setup_cost" name="setup_cost_0[]">`
       });
       $('.setup_cost').html(setup_html);
       
       $("#recruitment").val(data.bidrfq.recruitment);
       $.each(data.bidrfq.recruitment.split(','),function(index,val){
        recruitment_html +=`<input type="text" class='txtCal' value="${val}" placeholder="Recruitment" id="recruitment" name="recruitment_0[]"> `
       });
       $('.recruitment').html(recruitment_html);

       
       $("#incentives").val(data.bidrfq.incentives);
       $.each(data.bidrfq.incentives.split(','),function(index,val){
        incentives_html +=` <input type="text" class='txtCal' value="${val}"  placeholder="Incentives" id="incentives" name="incentives_0[]">`
       });
       $('.incentives').html(incentives_html);



       $("#moderation").val(data.bidrfq.moderation);
       $.each(data.bidrfq.moderation.split(','),function(index,val){
        moderation_html +=`<input type="text" class='txtCal' value="${val}"   placeholder="Moderation" id="moderation" name="moderation_0[]">`
       });
       $('.moderation').html(moderation_html);


       $("#transcript").val(data.bidrfq.transcript);
       $.each(data.bidrfq.transcript.split(','),function(index,val){
        transcript_html +=`<input type="text"class='txtCal' value="${val}" placeholder="transcript" id="transcript" name="transcript_0[]">`
       });
       $('.transcript').html(transcript_html);


       $("#others").val(data.bidrfq.others);
       $.each(data.bidrfq.others.split(','),function(index,val){
        others_html +=`<input type="text" class='txtCal' value="${val}" placeholder="Others" id="others" name="others_0[]">`
       });
       $('.others').html(others_html);


       $("#total_sum_value").val(data.bidrfq.total_cost);
       $.each(data.bidrfq.total_cost.split(','),function(index,val){
        total_cost_html +=`<input type="text" id="total_sum_value" value="${val}"  class="border" placeholder="Total Cost" name="total_cost_0[]"> `
       });
       $('.total_cost').html( total_cost_html );


      
      
       if (id != "") {
        $('#my-div').addClass('d-none');
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
    } 
    else {
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
});




</script>
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
                    url: "{{route('wonproject.bidrfq')}}",
                    data: data,
                    processData: false,
                    contentType: false,
                    dataType: "json",
                    success: function (data) {
                        swal({
                            title:'Form Update Successfully',
                            text:'Client update Successfully',
                            icon:'success',
                            buttons:false
                        })
                        $('#update').get(0).reset()
                        if (data.success == 1) {
                            flash({ msg: data.message, type: 'success' });
                            window.location = "{{route('bidrfq.index')}}";
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

@endsection

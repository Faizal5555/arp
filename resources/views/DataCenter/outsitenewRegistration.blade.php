<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ARP</title>
    <link rel="stylesheet" href="https://cdn.rawgit.com/tonystar/bootstrap-float-label/v4.0.1/dist/bootstrap-float-label.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

   <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
             rel='stylesheet'>
         
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js" >
       </script>
           <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
       {{-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" > --}}
       {{-- </script> --}}
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{asset('assets/images/favicon.ico')}}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
    {{-- <script src="{{asset('assets/vendors/js/vendor.bundle.base.js')}}"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    {{-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
    {{-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   --}}
    {{-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> --}}
    {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    
        @stack('css')
    @stack('scripts')
    <style>

    </style>
  </head>
  <body>
{{-- @extends('layouts.master') --}}
{{-- @section('page_title', 'OutsideDataNew') --}}
{{-- @section('content') --}}

<style>
 
 .header{
     background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
     
 }
 .error{
     color:red;
     margin-top:3px;
 }
</style>
<div class="row">
<div class="col-md-2">

</div>
<div class="col-md-8 ">
    <br><br>
    <div class="card " id="header-title">  

        <div class="card-header header-elements-inline header">
          <div class="card-title " style="color:whitesmoke;">New Registration</div>
        </div>

        <div class="card-body"  id="cardbody">
            <div class="row mb-2" id="wondiv">
                <div class="col-md-12">
                    <!--<div class="main-content">-->
                    <!--        <h6>Dear Doctor / Healthcare Practitioner,</h6>-->
        
                    <!--        <p>Welcome to Online Panel Registration. We are a medical research company supporting large healthcare organisations in their global research requirements.</p>-->
        
                    <!--         <p>Today, we would like to invite you to join our growing panels and offer your valuable feedback towards medical research projects. We will send you online surveys for which you would be paid cash incentives or Amazon vouchers for your valuable feedback and time. All your responses will be kept confidential and will be used for analytical purposes only.</p>-->
                             
                             
                    <!--          <p>The cash incentives or Amazon vouchers will be dependent on the type of surveys that you will participate.</p>-->
                              
                              
                    <!--          <p>Kindly click on next button below and complete your details and become our panel member. Please ensure that you fill all the details and attach your Medical licence Certificate. The Certificate helps us to verify that you are a genuine healthcare professional.</p>-->
                    <!--          <p>Incase of any query please revert on the email and our representative will get back to you at the earliest.</p>-->
                    <!--          <p>Regards</p>-->
                    <!--          <p>Online Panel Team</p>-->
                    <!--         <button class="btn btn-success" id="main-btn">Next</button>-->
                    <!--        </div>-->
                    <div class="form-group row" >
                        
                        
                        <div class="main-country ">
                            <div class="main-sub-country d-flex">
                        <label class="col-lg-3 col-form-label  mt-1">COUNTRY<span class="text-danger">*</span></label>
                        <div class="col-lg-9 form-group">
                            <select class="form-control border border-secondary label-gray-3" name="country" id="country">
                                <option class="label-gray-3" value="">Select Country<i class="fas fa-globe-asia"></i></option>
                                @if(count($country_loop_1) > 0)
                                                @foreach($country_loop_1 as $v)
                                            <option value="{{$v->name}}">{{$v->name}}</option>
                                                @endforeach
                                                @endif
                            </select>
                        </div>
                        </div>
                    </div>
                    </div>
                    {{-- <button class="btn btn-success " id='submit'> Submit</button> --}}
                </div>
            </div>
            
                
            <div class=" d-none" id="otherFieldDiv">
                <form class="row" id="form_id" autocomplete="off" enctype='multipart/form-data'>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row" >
                            <label class="col-lg-3 col-form-label">Country<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" id="country1" name="country1"  class="form-control border border-secondary"  readonly>

                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row" >
                          
                            <div class="col-lg-9">
                                

                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row" >
                            <label class="col-lg-3 col-form-label">Reg No<span class="text-danger">*</span></label>
                            <div class="col-lg-9">
                                <input type="text" id="pno" name="pno" value="{{$pno_no}}"  class="form-control border border-secondary"  readonly>

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row">
                            <label class="col-md-3 col-form-label font-weight-semibold" style="font-size:16px;">Medical Document Attachment<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="file" name="file" id="file" class="form-control" placeholder="Document Files" style="width:100%; outline:1px solid #8d7e7e;">
                            </div>
                        </div>
                    </div> 
                    <div class="col-lg-6 col-md-12">
                        <div class=" form-group row ">
                            <label class=" col-md-3 col-form-label font-weight-semibold " style="font-size:16px;">First Name<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="firstname" id="firstname" class="form-control border border-secondary" placeholder="First Name" style="width:100%;" >
                            </div>
                        </div>
                    </div>
                    
                  

                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row">
                            <label class=" col-md-3 col-form-label font-weight-semibold " style="font-size:16px;">Last Name<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="lastname" id="lastname"  class="form-control border border-secondary" placeholder="Last Name" style="width:100%;" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mt-2">
                        <div class="form-group row">
                            <label class=" col-md-3 col-form-label font-weight-semibold "  style="font-size:16px;">City Name<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="Cityname" id="cityname" class="form-control border border-secondary"  placeholder="City Name" style="width:100%;" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 mt-2">
                        <div class="form-group row">
                            <label class=" col-md-3 col-form-label font-weight-semibold " style="font-size:16px;">City Code<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="Citycode" id="citycode" class="form-control border border-secondary" placeholder="Citycode"  style="width:100%;" onkeypress="return isNumber1(event)" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row d-flex justify-content-center align-items-center">
                            <label class=" col-md-3 col-form-label font-weight-semibold "  style="font-size:16px;">Phone Number <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="PhoneNumber" id="phoneNumber" class="form-control border border-secondary"  placeholder="Phone Number"  onkeypress="return isNumber(event)" style="width:100%;" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row d-flex justify-content-center align-items-center">
                            <label class=" col-md-3 col-form-label font-weight-semibold " style="font-size:16px;">Email Address <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="email" name="email" id="email" class="form-control border border-secondary"  placeholder="Email Address"  style="width:100%;" pattern="[a-z0-9._]+@[a-z]+\.[com]{3,6}">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row d-flex justify-content-center align-items-center">
                            <label class=" col-md-3 col-form-label font-weight-semibold " style="font-size:16px;">Whatsapp Number<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="whatsappNumber" id="whatsappNumber" class="form-control border border-secondary" placeholder="Whatsapp Number"  onkeypress="return isNumber(event)" style="width:100%;" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row d-flex justify-content-center align-items-center">
                            <label class=" col-md-3 col-form-label font-weight-semibold " style="font-size:16px;">Doctor Speciality<span class="text-danger">*</span></label>
                            <div class="col-md-9 form-group mt-2">
                                
                                 <select  name="docterSpeciality"  class="form-control" id="docterSpecility" style="width:100%; outline:1px solid #646161 !important;">
                                 <option value="" disabled selected>Select Speciality</option>
                                 @if(count($speciality)>0)
                                 @foreach($speciality as $s)
                                 <option value="{{$s->speciality}}">{{$s->speciality}}</option>
                                 @endforeach
                                 @endif
                                  
                                 </select>
                                <!--<input type="text" name="docterSpecility" id="docterSpecility" class="form-control border border-secondary" placeholder="Doctor Speciality"  style="width:100%;" >-->
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row d-flex justify-content-center align-items-center">
                            <label class=" col-md-3 col-form-label font-weight-semibold " style="font-size:16px;">Total Years Experience<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                              <select  name="Experience"  class="form-control" id="Experience" style="width:100%; outline:1px solid #646161 !important;">
                                    <option value="" disabled selected>Select Experience</option>
                            <?php
                            
                            for($i= 1 ; $i<=55 ; $i ++)
                            {
                            ?>        
                                     <option value="{{ $i }}" >{{$i}}</option>
                            <?php } ?>        
                                    <!--<option value="2">2years</option>-->
                                    <!--<option value="3">3years</option>-->
                                    <!--<option value="4">4years</option>-->
                                    <!--<option value="5">5years</option>-->
                                    <!--<option value="6">6years</option>-->
                                    <!--<option value="7">7years</option>-->
                                    <!--<option value="8">8years</option>-->
                                    <!--<option value="9">9years</option>-->
                                    <!--<option value="10">10years</option>-->
                                    <!--<option value="11">11years</option>-->
                                    <!--<option value="12">12years</option>-->
                                    <!--<option value="13">13years</option>-->
                                    <!--<option value="14">14years</option>-->
                                    <!--<option value="15">15years</option>-->
                                    <!--<option value="16">16years</option>-->
                                    <!--<option value="17">17years</option>-->
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row d-flex justify-content-center align-items-center">
                            <label class=" col-md-3 col-form-label font-weight-semibold " style="font-size:16px;">Type of Practice <span class="text-danger">*</span></label>
                            <div class="col-md-9 form-group mt-2 ">
                                <select  name="Practice"  class="form-control" id="Practice" style="width:100%; outline:1px solid #646161 !important;">
                                    <option value="" disabled selected>Select Practice</option>
                                    <option value="Private "> Private </option>
                                    <option value="Public">Public </option>
                                    <option value="both">both</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row d-flex justify-content-center align-items-center">
                            <label class=" col-md-3 col-form-label font-weight-semibold " style="font-size:16px;">Practice Licence Number<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="licenceNumber" id="licenceNumber" class="form-control border border-secondary" placeholder="Practice Licence Number"   style="width:100%;" >
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 ">
                        <div class="form-group row d-flex justify-content-center align-items-center">
                            <label class=" col-md-3 col-form-label font-weight-semibold " style="font-size:16px;">Average Patients Per Month<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="permonth" id="permonth" class="form-control border border-secondary" placeholder="Average Patients Per Month" style="width:100%;" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                     <button type="sumbit" class="btn btn-success ">Submit</button>
                    </div>
                </form>
            </div> 
        </div>
        <div class="col-md-12 d-none" id="send">
            <h2  class="d-flex justify-content-center"> You Have Register Successfully</h2>
            <h2 class="d-flex justify-content-center">Kindly check  Your Email For Activation Membership Email</h2>
            {{-- <p  class="d-flex justify-content-center">You Will Be Redirected in <span></span> &nbsp;sec</p> --}}
        </div>
    </div>
</div>
<div class="col-md-2">

</div>
</div>
{{--  --}}
<script>
// $('#main-btn').click(function(){
//         $('.main-content').addClass('d-none');
//         $('.main-country').removeClass('d-none');
//     });
    $("#country").change(function(){
        $("#wondiv").addClass('d-none');

        // console.log($(this).val());

        $('#country1').val($(this).val());  
        
      $("#otherFieldDiv").removeClass();
    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
            if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                return false;
            }
            return true;
    }
     function isNumber1(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        console.log(charCode);
           if (charCode == 45) 
           return true;
            if (charCode > 31 &&  (charCode < 48 || charCode > 57) ) {
                return false;
            }
            return true;
    }

    var counter = 0;
  var interval = setInterval(function() {
    counter++;
    // Display 'counter' wherever you want to display it.
    if (counter == 5) {
        // Display a login box
        clearInterval(interval);
    }
}, 1000); 

    
    $(document).ready(function(){
        $.validator.addMethod(
    /* The value you can use inside the email object in the validator. */
    "regex",

    /* The function that tests a given string against a given regEx. */
    function(value, element, regexp)  {
        /* Check if the value is truthy (avoid null.constructor) & if it's not a RegEx. (Edited: regex --> regexp)*/

        if (regexp && regexp.constructor != RegExp) {
           /* Create a new regular expression using the regex argument. */
           regexp = new RegExp(regexp);
        }

        /* Check whether the argument is global and, if so set its last index to 0. */
        else if (regexp.global) regexp.lastIndex = 0;

        /* Return whether the element is optional or the result of the validation. */
        return this.optional(element) || regexp.test(value);
    }
);
        $('#form_id').validate({
            rules:{
                firstname:{
                    required:true
                },
                lastname:{
                    required:true
                },
                Cityname:{
                    required:true
                },
                Citycode:{
                    required:true,
                },
                PhoneNumber:{
                    required:true,
                    minlength: 10
                },
                email:{
                     required:true,
                     email:true,
                     regex: /^\b[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,4}\b$/i,
                }, 
                whatsappNumber:{
                    required:true,
                    minlength: 10
                },
                docterSpecility:{
                    required:true
                },
                Experience:{
                    required:true
                },
                Practice:{
                    required:true
                },
                licenceNumber:{
                    required:true
                },
                permonth:{
                    required:true
                },
                file:{
                    required:true
                }
            },
           
            
            submitHandler: function (form) {
                var data =new FormData(form);              
                $.ajax({
                   url:"{{route('outsideNewForm')}}",
                   type:"post",
                   processData: false,
                     processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i><span class="sr-only">Loading...</span> ',
                     processing: true,
                   contentType: false,
                   headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                   dataType: "json",
                   data:data,
                   success:function(data){
                    if(data.success == 0){
                        $.each(data.errors, function(index, error){  
                                        $(form).find( "[name='"+index+"']" ).addClass("error").after( "<label class='error'>"+error+"</label>" ); 
                                }); 
                 }  
                 if(data.success == 1){
                    swal({
                            title:'Success',
                            text:'Doctor Added Successfully',
                            icon:'success',
                            buttons:false
                        })
                    $("#otherFieldDiv").addClass('d-none');
                    $("#send").removeClass();
                 }
                 if(data.success == 2){
                      swal({
                            title:'Warning',
                            text:'This Email is already Used',
                            icon:'success',
                            buttons:false
                        })
                 }
                   
                  }
              })
            }
    });
       
});
    
    

</script>

</body>
</html>
{{-- @endsection --}}


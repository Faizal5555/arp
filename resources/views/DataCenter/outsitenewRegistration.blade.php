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
 
 body {
      background: url('{{asset("adminapp/assets/images/back.png")}}') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Roboto', sans-serif;
      color: #333;
    }

    .container {
      margin-top: 50px;
    }

    .card {
      box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
      border-radius: 12px;
      background: rgba(255, 255, 255, 0.9);
      padding: 20px;
    }

    .logo {
      display: block;
      margin: 0 auto 20px;
      width: 200px;
    }

    .header {
      background: linear-gradient(43deg, #0b5dbb, #0b5dbb);
      color: white;
      border-radius: 12px 12px 0 0;
      padding: 15px;
      text-align: center;
      font-weight: bold;
    }

    .btn-primary {
      background: #0b5dbb;
      border: none;
    }

    .btn-primary:hover {
      background: #094a96;
    }

    .form-control {
      border-radius: 8px;
      transition: all 0.3s ease;
    }

    .form-control:focus {
      border-color: #0b5dbb;
      box-shadow: 0 0 5px rgba(11, 93, 187, 0.5);
    }

    .error {
      color: red;
      margin-top: 3px;
    }

    #otherFieldDiv {
  display: none;
  opacity: 0;
  animation: fadeInSlow 1s ease-in-out forwards;
}

@keyframes fadeInSlow {
  0% {
    opacity: 0;
    transform: translateY(20px);
  }
  100% {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>
<div class="row">
<div class="col-md-2">

</div>
<div class="col-md-8 ">
    <img class="logo mt-2" src="{{asset('adminapp/assets/images/logo-3.png')}}" alt="logo">
    <div class="" id="header-title">  
        <div class="text-center">
            <h4 class="mb-0">New Registration</h4>
          </div>

        <div class="card-body"  id="cardbody">
            <div class="row mb-2" id="wondiv">
                <div class="col-md-12 d-flex justify-content-center">
                    <div class="form-group row mt-5" >  
                        <div class="main-country ">
                            <div class="main-sub-country d-flex">
                        <label class="col-lg-3 col-form-label text-nowrap mt-1 px-0">Country Of Practice<span class="text-danger">*</span></label>
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
                    <input type="hidden" class="form-control" name="userid"  value="{{$user_id ? $user_id :''}}">
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row" >
                            <label class="col-lg-3 col-form-label">Country Of Practice<span class="text-danger">*</span></label>
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
                            <label class="col-md-3 col-form-label font-weight-semibold" style="font-size:16px;">Medical Document Attachment<span class="text-danger"></span></label>
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
                                <span id="phone-error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row d-flex justify-content-center align-items-center">
                            <label class=" col-md-3 col-form-label font-weight-semibold " style="font-size:16px;">Email Address <span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="email" name="email" id="email" class="form-control border border-secondary"  placeholder="Email Address"  style="width:100%;" pattern="[a-z0-9._]+@[a-z]+\.[com]{3,6}">
                                <span id="email-error" class="text-danger"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12">
                        <div class="form-group row d-flex justify-content-center align-items-center">
                            <label class=" col-md-3 col-form-label font-weight-semibold " style="font-size:16px;">Whatsapp Number<span class="text-danger">*</span></label>
                            <div class="col-md-9">
                                <input type="text" name="whatsappNumber" id="whatsappNumber" class="form-control border border-secondary" placeholder="Whatsapp Number"  onkeypress="return isNumber(event)" style="width:100%;" >
                                <div id="whatsapp-error" class="invalid-feedback"></div>
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
                                 @foreach($speciality->sortBy('speciality') as $s)
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
                            
                            for($i= 1 ; $i<=80 ; $i ++)
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
                     <button type="sumbit" id="submitInvite" class="btn btn-success " disabled>Submit</button>
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
                    required:true,
                    
                },
                permonth:{
                    required:true,
                    maxlength:4,
                    digits: true
                },
                // file:{
                //     required:true
                // }
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
                   beforeSend: function () {
                // Disable the submit button and show the loader inside it
                $('#submitInvite')
                    .prop('disabled', true)
                    .html('<span class="spinner-border spinner-border-sm"></span> Sending...');
                   },
                   success:function(data){

                    $('#submitInvite')
                    .prop('disabled', false)
                    .html('Submit');
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
    
$(document).ready(function () {
      // When country is selected
      $('#country').change(function () {
        const selectedCountry = $(this).val();
        if (selectedCountry) {
          $('#countrySelection').hide();
          $('#country1').val(selectedCountry);
          $('#otherFieldDiv').css('display', 'block').addClass('fadeIn');
        } else {
          $('#otherFieldDiv').hide().removeClass('fadeIn');
          $('#countrySelection').show();
        }
      });
    });
    $(document).ready(function () {
    // CSRF Token setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
        },
    });

    // Email validation on blur and input
    $('#email').on('blur', function () {
        validateEmail();
    });

    $('#email').on('input', function () {
        clearEmailError(); // Clear error message on new input
    });

    // Phone number validation on blur and input
    $('#phoneNumber').on('blur', function () {
        validatePhone();
    });

    $('#phoneNumber').on('input', function () {
        clearPhoneError(); // Clear error message on new input
    });

    // Email validation function
    function validateEmail() {
        var email = $('#email').val();
        if (email) {
            $.ajax({
                url: "{{ route('checkEmail') }}",
                type: "POST",
                data: { email: email },
                success: function () {
                    // Clear error message if validation passes
                    $('#email').removeClass('is-invalid');
                    $('#email-error').text('').hide(); // Hide error message
                    checkFormValidity();
                },
                error: function (xhr) {
                    // Show error message if validation fails
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        $('#email').addClass('is-invalid');
                        $('#email-error')
                            .text(xhr.responseJSON.message) // Set error message
                            .show(); // Ensure the error is visible
                        checkFormValidity();
                    }
                },
            });
        } else {
            // Clear error if input is empty
            clearEmailError();
        }
    }

    // Phone number validation function
    function validatePhone() {
        var phone = $('#phoneNumber').val();
        if (phone) {
            $.ajax({
                url: "{{ route('checkEmail') }}", // Replace with the actual route for phone validation
                type: "POST",
                data: { phone: phone },
                success: function () {
                    // Clear error message if validation passes
                    $('#phoneNumber').removeClass('is-invalid');
                    $('#phone-error').text('').hide(); // Hide error message
                    checkFormValidity();
                },
                error: function (xhr) {
                    // Show error message if validation fails
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        $('#phoneNumber').addClass('is-invalid');
                        $('#phone-error')
                            .text(xhr.responseJSON.message) // Set error message
                            .show(); // Ensure the error is visible
                        checkFormValidity();
                    }
                },
            });
        } else {
            // Clear error if input is empty
            clearPhoneError();
        }
    }

    // Clear email error
    function clearEmailError() {
        $('#email').removeClass('is-invalid');
        $('#email-error').text('').hide(); // Clear and hide error message
        checkFormValidity();
    }

    // Clear phone error
    function clearPhoneError() {
        $('#phoneNumber').removeClass('is-invalid');
        $('#phone-error').text('').hide(); // Clear and hide error message
        checkFormValidity();
    }

    // Form validity checker
    function checkFormValidity() {
        // Disable submit button if there are validation errors
        if ($('.is-invalid').length > 0) {
            $('#submitInvite').prop('disabled', true); // Disable the button
        } else {
            $('#submitInvite').prop('disabled', false); // Enable the button
        }
    }

    // Initial form validity check
    //checkFormValidity();

    $('#whatsappNumber').on('blur', function () {
        validateWhatsAppNumber();
    });

    $('#whatsappNumber').on('input', function () {
        clearWhatsAppError(); // Clear error message on new input
    });

    // WhatsApp number validation function
    function validateWhatsAppNumber() {
        var whatsappNumber = $('#whatsappNumber').val();
        if (whatsappNumber) {
            $.ajax({
                url: "{{ route('checkEmail') }}", // Use the same route for validation
                type: "POST",
                data: { phone: whatsappNumber },
                success: function () {
                    // Clear error message if validation passes
                    $('#whatsappNumber').removeClass('is-invalid');
                    $('#whatsapp-error').text('').hide(); // Hide error message
                    checkFormValidity();
                },
                error: function (xhr) {
                    // Show error message if validation fails
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        $('#whatsappNumber').addClass('is-invalid');
                        $('#whatsapp-error')
                            .text(xhr.responseJSON.message) // Set error message
                            .show(); // Ensure the error is visible
                        checkFormValidity();
                    }
                },
            });
        } else {
            // Clear error if input is empty
            clearWhatsAppError();
        }
    }

    // Clear WhatsApp error
    function clearWhatsAppError() {
        $('#whatsappNumber').removeClass('is-invalid');
        $('#whatsapp-error').text('').hide(); // Clear and hide error message
        checkFormValidity();
    }

    // Updated form validity checker
    function checkFormValidity() {
        if ($('.is-invalid').length > 0) {
            $('#submitInvite').prop('disabled', true); // Disable the button
        } else {
            $('#submitInvite').prop('disabled', false); // Enable the button
        }
    }

    // Initial form validity check
    checkFormValidity();
});

$('#permonth').on('keypress', function (e) {
    const charCode = e.which ? e.which : e.keyCode;
    if (charCode < 48 || charCode > 57) { // Allow only numbers (ASCII 48-57)
        e.preventDefault();
    }
});



</script>

</body>
</html>
{{-- @endsection --}}


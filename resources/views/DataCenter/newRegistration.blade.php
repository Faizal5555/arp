@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')

<style>
 
 .header{
     background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
     
 }
  .error{
     color:red;
     margin-top:3px;
 }
 .import{
     display:flex;
     justify-content:space-between;
 }
</style>
@if (session('validationErrors'))
    <div class="alert alert-danger">
        <h4>Validation Errors:</h4>
        <ul>
            @foreach (session('validationErrors') as $row => $errors)
                <li>
                    <strong>Row {{ $row }}:</strong>
                    <ul>
                        @foreach ($errors as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<meta name="csrf-token" content="{{ csrf_token() }}">
<div class="col-md-12">
    <div class="card " id="header-title">  

        <div class="card-header header-elements-inline header ">
          <div class="card-title " style="color:whitesmoke;">New Registration</div>
        </div>

        <div class="card-body"  id="cardbody">
            <div class="row mb-2" id="wondiv">
                <div class="col-lg-6 col-md-12 " >
                    
                   
                    <div class="form-group row" >
                        <label class="col-lg-3 col-form-label  mt-1">COUNTRY<span class="text-danger">*</span></label>
                        <div class="col-lg-9 form-group">
                            <select class="form-control border border-secondary label-gray-3" name="country" id="country">
                                <option class="label-gray-3" value="">Select Country<i class="fas fa-globe-asia"></i></option>
                                               @if(isset($country) && count($country) > 0)
                                                @foreach($country as $v)
                                            <option value="{{$v->name}}">{{$v->name}}</option>
                                                @endforeach
                                                @endif
                            </select>
                        </div>
                    </div>
                    {{-- <button class="btn btn-success " id='submit'> Submit</button> --}}
                </div>
            </div>
                
            <div class=" d-none" id="otherFieldDiv">
                <form class="row" id="form_id" autocomplete="off" enctype='multipart/form-data'>
                    <input type="hidden" class="form-control" name="userid"  value="{{$user_id ? $user_id :''}}">
                    @csrf
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
                            <label class="col-lg-3 col-form-label">Import Files</label>
                            <div class="col-lg-9">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                    Import Data
                                  </button>
                                  

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
                                <input type="text" name="Citycode" id="citycode" class="form-control border border-secondary" placeholder="Citycode"   style="width:100%;" >
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
                                <input type="email" name="email" id="email" class="form-control border border-secondary"  placeholder="Email Address" style="width:100%;"  required data-msg-email="Enter a valid email account!" pattern="[a-z0-9._]+@[a-z]+\.[a-z]{2,10}" >
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
                            <label class=" col-md-3 col-form-label font-weight-semibold " style="font-size:16px;">Speciality<span class="text-danger">*</span></label>
                            <div class="col-md-9 form-group mt-2">
                              <select  name="docterSpeciality"  class="form-control" id="docterSpeciality" style="width:100%; outline:1px solid #646161 !important;">
                                 <option value="" disabled selected>Select Speciality</option>
                                 {{$speciality}}
                                 @if(isset($speciality) && count($speciality) > 0)
                                 @foreach($speciality as $s)
                                 <option value="{{$s->speciality}}">{{$s->speciality}}</option>
                                 @endforeach
                                 @endif
                                 </select>
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
                            <label class=" col-md-3 col-form-label font-weight-semibold " style="font-size:16px;">Practice Licence Number<span class="text-danger"></span></label>
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

                    <div class="col-lg-6 col-md-12 ">
                        <div class="form-group row d-flex justify-content-center align-items-center">
                            <label class=" col-md-3 col-form-label font-weight-semibold " style="font-size:16px;">LinkedIn/ Facebook URL<span class="text-danger"></span></label>
                            <div class="col-md-9">
                                <input type="text" name="social_url" id="social_url" class="form-control border border-secondary" placeholder="LinkedIn/ Facebook URL" style="width:100%;" >
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center">
                     <button type="sumbit" id="submitInvite" class="btn btn-success" disabled>Submit</button>
                    </div>
                </form>
            </div> 
        </div>
        <div class="col-md-12 d-none" id="send">
            <h2  class="d-flex justify-content-center"> Registered Successfully</h2>
            <h2 class="d-flex justify-content-center">Kindly Check  Your Email For Activation Membership </h2>
            {{-- <p  class="d-flex justify-content-center">You Will Be Redirected in <span></span> &nbsp;sec</p> --}}
        </div>
    </div>
</div>


  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Import</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            
            

           
            <form id="importForm" action="{{ route('datacenter.import') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
              
                <input type="file" name="file" class="form-control" required>
                <small class="form-text text-muted">
                    Accepted formats: CSV,XLSX.
                    <a href="{{ route('hcp.sample.download') }}">Download Sample File</a>
                </small>
                <br>
                <button class="btn btn-success" id="importSubmit">Import Hcp Data</button>
                
            
            </form>
        </div>
        
      </div>
    </div>
  </div>

  {{-- <!-- Modal -->
<div class="modal fade" id="importModal" tabindex="-1" role="dialog" aria-labelledby="importModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="importModalLabel">Import Doctor Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('datacenter.importDoctors') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="file" name="file" class="form-control" required>
                    <small>Upload a CSV file only.</small>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Import</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div> --}}


<script>


$(document).ready(function () {
    // CSRF Token setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Email validation on blur and input
    $('#email').on('blur input', function () {
        validateEmail();
    });

    // Phone number validation on blur and input
    $('#phoneNumber').on('blur input', function () {
        validatePhone();
    });

    // Email validation function
    function validateEmail() {
        var email = $('#email').val();
        if (email) {
            $.ajax({
                url: "{{ route('checkEmail') }}",
                type: "POST",
                data: { email: email },
                success: function (response) {
                    // Clear error message if validation passes
                    $('#email').removeClass('is-invalid');
                    $('#email-error').text('').hide(); // Clear and hide the error message
                    checkFormValidity(); // Re-check form validity
                },
                error: function (xhr) {
                    // Show error message if validation fails
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        $('#email').addClass('is-invalid');
                        $('#email-error').text(xhr.responseJSON.message).show(); // Show the error message
                        checkFormValidity(); // Re-check form validity
                    }
                }
            });
        } else {
            // Reset error if input is empty
            $('#email').removeClass('is-invalid');
            $('#email-error').text('').hide(); // Clear and hide error message
            checkFormValidity();
        }
    }

    // Phone number validation function
    function validatePhone() {
        var phone = $('#phoneNumber').val();
        if (phone) {
            $.ajax({
                url: "{{ route('checkEmail') }}",
                type: "POST",
                data: { phone: phone },
                success: function (response) {
                    // Clear error message if validation passes
                    $('#phoneNumber').removeClass('is-invalid');
                    $('#phone-error').text('').hide(); // Clear and hide the error message
                    checkFormValidity(); // Re-check form validity
                },
                error: function (xhr) {
                    // Show error message if validation fails
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        $('#phoneNumber').addClass('is-invalid');
                        $('#phone-error').text(xhr.responseJSON.message).show(); // Show the error message
                        checkFormValidity(); // Re-check form validity
                    }
                }
            });
        } else {
            // Reset error if input is empty
            $('#phoneNumber').removeClass('is-invalid');
            $('#phone-error').text('').hide(); // Clear and hide error message
            checkFormValidity();
        }
    }

    // $('#whatsappNumber').on('blur', function () {
    //     validateWhatsAppNumber();
    // });

    // $('#whatsappNumber').on('input', function () {
    //     clearWhatsAppError(); // Clear error message on new input
    // });

    // WhatsApp number validation function
    // function validateWhatsAppNumber() {
    //     var whatsappNumber = $('#whatsappNumber').val();
    //     if (whatsappNumber) {
    //         $.ajax({
    //             url: "{{ route('checkEmail') }}", // Use the same route for validation
    //             type: "POST",
    //             data: { phone: whatsappNumber },
    //             success: function () {
    //                 // Clear error message if validation passes
    //                 $('#whatsappNumber').removeClass('is-invalid');
    //                 $('#whatsapp-error').text('').hide(); // Hide error message
    //                 checkFormValidity();
    //             },
    //             error: function (xhr) {
    //                 // Show error message if validation fails
    //                 if (xhr.responseJSON && xhr.responseJSON.message) {
    //                     $('#whatsappNumber').addClass('is-invalid');
    //                     $('#whatsapp-error')
    //                         .text(xhr.responseJSON.message) // Set error message
    //                         .show(); // Ensure the error is visible
    //                     checkFormValidity();
    //                 }
    //             },
    //         });
    //     } else {
    //         // Clear error if input is empty
    //         clearWhatsAppError();
    //     }
    // }

    // Clear WhatsApp error
    // function clearWhatsAppError() {
    //     $('#whatsappNumber').removeClass('is-invalid');
    //     $('#whatsapp-error').text('').hide(); // Clear and hide error message
    //     checkFormValidity();
    // }


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
    checkFormValidity();
});
$('#permonth').on('keypress', function (e) {
    const charCode = e.which ? e.which : e.keyCode;
    if (charCode < 48 || charCode > 57) { // Allow only numbers (ASCII 48-57)
        e.preventDefault();
    }
});


    $("#country").change(function(){
        $("#wondiv").addClass('d-none');

        console.log($(this).val());

        $('#country1').val($(this).val());  
        
      $("#otherFieldDiv").removeClass();
    });

    function isNumber(evt) {
        evt = (evt) ? evt : window.event;
        var charCode = (evt.which) ? evt.which : evt.keyCode;
        console.log(charCode);
           
            if (charCode > 31 &&  (charCode < 48 || charCode > 57) ) {
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

      $.ajaxSetup({
         headers: {
           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
      });

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
                    number:true,
                    minlength: 10
                   
                },
                email:{
                    required:true,
                    email: true
                }, 
                whatsappNumber:{
                    required:true,
                    number:true,
                    minlength: 10
                },
                docterSpeciality:{
                    required:true
                },
                Experience:{
                    required:true
                },
                Practice:{
                     required:true,
                },
                // licenceNumber:{
                //     required:true,
                // },
                permonth:{
                    required:true,
                     number:true,
                     maxlength:4,
                     digits: true
                }
                // file:{
                //     required:true
                // }
            },
           
            
            submitHandler: function (form) {
                var data =new FormData(form);       
                
                $.ajax({
                   url:"{{route('NewForm')}}",
                   type:"post",
                   processData: false,
                   contentType: false,
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
                            text:'Lead Submitted successfully',
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





document.addEventListener('DOMContentLoaded', function () {
    const form = document.querySelector('#importForm');
    const submitButton = document.querySelector('#importSubmit');

    if (form && submitButton) {
        form.addEventListener('submit', function () {
            // Disable the button and add spinner
            submitButton.disabled = true;
            submitButton.innerHTML = `
                <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Importing...`;
        });
    }
});

</script>
@endsection


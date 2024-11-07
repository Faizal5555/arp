<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>ARP</title>
  <link rel="stylesheet"
    href="https://cdn.rawgit.com/tonystar/bootstrap-float-label/v4.0.1/dist/bootstrap-float-label.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href='https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css' rel='stylesheet'>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js">
  </script>
  <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js" > --}}
  {{-- </script> --}}
  <!-- plugins:css -->
  <link rel="stylesheet"
    href="{{ asset('assets/vendors/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('assets/vendors/css/vendor.bundle.base.css') }}">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <!-- endinject -->
  <!-- Layout styles -->
  <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
  <!-- End layout styles -->

  <link rel="shortcut icon" href="{{ asset('assets/images/favicon.ico') }}" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>
  {{-- <script src="{{asset('assets/vendors/js/vendor.bundle.base.js') }}">
  </script> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
  {{-- <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet"> --}}
  {{-- <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet"> --}}
  {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script> --}}
  {{-- <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> --}}
  {{-- <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script> --}}

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  @stack('css')
  @stack('scripts')
  <style>
  </style>
</head>

<body style="overflow-x: none;">
  {{-- @extends('layouts.master') --}}
  {{-- @section('page_title', 'OutsideDataNew') --}}
  {{-- @section('content') --}}

  <style>
    .header {
      background: linear-gradient(43deg, #0b5dbb, #0b5dbb);

    }

    .error {
      color: red;
      margin-top: 3px;
    }
    .card-header{
      background-color: #007bff;
    }
    .dropdown .dropdown-menu .dropdown-item:hover {
    background-color: #3777b8;
    color: #f7eded;
    }
    .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: 80%;
     }
     body{
         overflow-x:hidden;
     }
     h3.title-2 {
    margin-top: 18px;
    }
    .title-3 {
    margin-top: 18px;
   }
   .title-4 {
    margin-top: 18px;
   }
   #success h4 {
    color: #DC3545;
    text-align:center;
   }
   #success p {
    text-align:center;
   }
  </style>
    <div class="lang-question-ans">
    <form id="register">
    <div class="row mt-4">
    <div class="col-md-2"></div>
    <div class="col-md-8">
    <div class="conatiner">
        <div class="card">
           <h5 class="card-header">Registration</h5>
         <div class="card-body">
        
            <!--country-->
                  <div class="main-country ">
                    <div class="main-sub-country d-flex">
                      <label class="col-lg-3 col-form-label  mt-1">COUNTRY<span class="text-danger">*</span></label>
                      <div class="col-lg-9 form-group">
                        <select class="form-control border border-secondary label-gray-3 changeLang" name="country"
                          id="country">
                          <option class="label-gray-3" value="" disabled selected>Select Country<i class="fas fa-globe-asia"></i></option>
                          @foreach($country as $con=> $c)
                          <option value="{{$c->name}}">{{$c->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>

                    <button class="btn btn-success lang-click text-center float-right mt-5" type="button">Next</button>

                  </div>
            <!-- end country-->

            <!--terms and condition-->
            <div class="lang-content d-none">
                  <h1 class="title-1">
                    Complete Online Surveys & Earn money
                  </h1>
                  <h3 class="title-2">
                    Sign up for free, participate in paid surveys and make money online without leaving your home.
                  </h3>


                  <h5 class="title-3">
                    We care about your privacy
                  </h5>
                  <h6 class="title-4">
                    By sharing your personal data, you will be able to get research opportunities targeted to your interests, help improve products and services and earn rewards for participating
                  </h6>
                  <div class="col-md-12 mt-2">

                    <div class="row">
                      <div class="col-md-9 mt-3">
                        <p>Agree to all
                          <p>
                      </div>
                      <div class="col-md-3 mt-1">

                        <div class="form-check">
                          <input class="form-check-input selectall" name="agree_all" type="checkbox" id="flexCheckDefault" >
                          <label class="form-check-label" for="flexCheckDefault">
                          </label>
                        </div>

                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-9 mt-3">
                        <p>
                          I agree to the Privacy Policy and Terms and Conditions
                          <p>
                      </div>
                      <div class="col-md-3 mt-1">

                        <div class="form-check duplicate">
                          <input class="form-check-input" name="agree_all" type="checkbox" id="flexCheckDefault" >
                          <label class="form-check-label" for="flexCheckDefault">
                          </label>
                        </div>

                      </div>
                    </div>


                    <div class="row">
                      <div class="col-md-9 mt-3">
                        <p>
                          I agree to participate in surveys and other market research activities
                          <p>
                      </div>
                      <div class="col-md-3 mt-1">

                        <div class="form-check duplicate">
                          <input class="form-check-input" name="agree_all" type="checkbox" id="flexCheckDefault" >
                          <label class="form-check-label" for="flexCheckDefault">
                          </label>
                        </div>

                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-9 mt-3">
                        <p>
                          I agree to the use of cookies for market research purposes
                          <p>
                      </div>
                      <div class="col-md-3 mt-1">

                        <div class="form-check duplicate">
                          <input class="form-check-input" name="agree_all" type="checkbox" id="flexCheckDefault" >
                          <label class="form-check-label" for="flexCheckDefault">
                          </label>
                        </div>

                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-9 mt-3">
                        <p>
                          I agree to the collection and or sharing of my mobile advertising identifiers or other identifiers
                          <p>
                      </div>
                      <div class="col-md-3 mt-1">

                        <div class="form-check duplicate">
                          <input class="form-check-input" name="agree_all" type="checkbox" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                          </label>
                        </div>

                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-9 mt-3">
                        <p>
                          I agree to the use of third-party cookies for market research purposes
                          <p>
                      </div>
                      <div class="col-md-3 mt-1">

                        <div class="form-check duplicate">
                          <input class="form-check-input" name="agree_all" type="checkbox" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                          </label>
                        </div>

                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-9 mt-3">
                        <p>
                          I agree to share my profile information with third-parties for market research purposes
                          <p>
                      </div>
                      <div class="col-md-3 mt-1">

                        <div class="form-check duplicate">
                          <input class="form-check-input" name="agree_all" type="checkbox" id="flexCheckDefault">
                          <label class="form-check-label" for="flexCheckDefault">
                          </label>
                        </div>

                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-9 mt-3">
                        <p>
                          I agree to share my sensitive data for market research purposes
                          <p>
                      </div>
                      <div class="col-md-3 mt-1">

                        <div class="form-check duplicate">
                          <input class="form-check-input" name="agree_all" type="checkbox" id="flexCheckDefault" >
                          <label class="form-check-label" for="flexCheckDefault">
                          </label>
                        </div>

                      </div>
                    </div>

                    <button class="btn btn-success float-right lang-cond" type="button" disabled>Continue</button>


                  </div>
            </div>
            <!--end terms and condition-->


            <!--persoanl info-->
        <div class="lang-personal d-none">
          <div class="col-md-12 mt-2">

              <div class="row">
                <div class="col-md-6 mt-3">
                  <label>First Name<p>
                </div>
                <div class="col-md-6 mt-1">

                  <div class="form-check">
                    <input class="form-control lang-name lang-cal" type="text" name="fname" required>
                    </label>
                  </div>

                </div>
              </div>


              <div class="row">
                <div class="col-md-6 mt-3">
                  <label>Last Name<p>
                </div>
                <div class="col-md-6 mt-1">

                  <div class="form-check">
                    <input class="form-control lang-name lang-cal1" type="text" name="lname" required>
                    </label>
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mt-3">
                  <label>Mobile Number
                    <p>
                </div>
                <div class="col-md-6 mt-1">

                  <div class="form-check">
                    <input class="form-control lang-name lang-cal2" type="number" name="phone" minlength="9" minlength="10" required>
                    </label>
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mt-3">
                  <label>Email<p>
                </div>
                <div class="col-md-6 mt-1">

                  <div class="form-check">
                    <input class="form-control lang-name lang-cal3" type="email" name="email" required pattern="[^@]+@[^@]+\.[com]{3,6}">
                    </label>
                  </div>

                </div>
              </div>



              <div class="row">
                <div class="col-md-6 mt-3">
                  <label>Address<p>
                </div>
                <div class="col-md-6 mt-1">

                  <div class="form-check">
                      <textarea class="form-control lang-name lang-cal4" name="address"
                      rows="5" cols="33"></textarea>
                    <!--<input class="form-control lang-name lang-cal4" type="text" name="address" required>-->
                    </label>
                  </div>

                </div>
              </div>


              <div class="row">
                <div class="col-md-6 mt-3">
                  <label>Zip Code<p>
                </div>
                <div class="col-md-6 mt-1">

                  <div class="form-check">
                    <input class="form-control lang-name lang-cal5" type="number" name="zipcode" required>
                    </label>
                  </div>

                </div>
              </div>
           

            <div class="btn-personal">

              <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4 mt-5 ml-4">
                  <button class="btn btn-success sub-personal" type="button" disabled>continue</button>
                </div>
                <div class="col-md-4">

                </div>
            </div>

          </div>

        </div>
      </div>
            <!--end persoanl info-->
          
            <!--All Questions-->
              <!-- Questions-1 -->
              <div class="lang-first-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.1 How would you characterize the place where you live?</h5>
                        </div>
                          <div class="ans1 ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_1" value="URBAN"> <span>URBAN</span>
                                </label>    
                          </div>
                          <div class="ans1 ml-2">
                              <label class="radio">
                               <input type="radio" name="que_1" value="SUB URBAN"> <span>SUB URBAN</span>
                              </label>    
                          </div>
                           <div class="ans1 ml-2">
                                 <label class="radio"> 
                                 <input type="radio" name="que_1" value="RURAL"> <span>RURAL</span>
                                </label>    
                           </div>
                    </div>

                    </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-1" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-1 " type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-1 -->

              <!-- Questions-2 -->
              <div class="lang-second-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.2 QWhat type of research (except online surveys) are you interested to be invited to participate in? (Additional incentives are paid)?</h5>
                        </div>
                        <div class="ans ml-2">
                        <select class="selectpicker" multiple aria-label="Default select example" data-live-search="true" name="que_2[]">
                              <option value="1">  Focus group studies</option>
                              <option value="1"> Inhome testing of new products</option>
                              <option value="1">  Webcamera studies</option>
                              <option value="1"> Online bulletin boards/diaries</option>
                              <option value="1"> Phone surveys</option>
                              <option value="1"> SMS / WhatsApp surveys</option>
                              <option value="1"> Mobile usage studies / Mobile phone surveys</option>
                              <option value="1">  Food/wine tasting</option>
                              <option value="1"> None of the above</option>
                              <option value="1">  Prefer not to say</option>
                        </select>     
                           </div>
                    </div>

                    </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-2" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-2 " type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-2 -->

              <!-- Questions-3 -->
              <div class="lang-third-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.3 Does the computer you primarily use to interact with research studies have a web camera?</h5>
                        </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_3" value="1"> <span>Yes</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_3" value="2"> <span>No</span>
                              </label>    
                          </div>
                    </div>

                    </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-3" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-3" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-3 -->

              <!-- Questions-4 -->
              <div class="lang-four-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.4 Would you be willing to participate in a research study that reads your facial expressions to analyse emotional response? The data is fully anonymous and would be used for research purposes only.</h5>
                        </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_4" value="1"> <span>Yes</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_4" value="2"> <span>No</span>
                              </label>    
                          </div>
                    </div>

                    </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-4" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-4" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-4 -->

              											
             
              <!-- Questions-5 -->
              <div class="lang-five-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.5   Do you agree to opt-in and participate in types of research that may require you to download an application (on mobile, PC or tablet) that will track your online behaviour?</h5>
                        </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_5" value="1"> <span>Yes</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_5" value="2"> <span>No</span>
                              </label>    
                          </div>
                    </div>

                    </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-5" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-5" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-5 -->

              <!-- Questions-6 -->
              <div class="lang-six-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.6 Do you agree to opt-in and participate in types of research that may require cookies to be dropped onto your Mobile/PC/Tablet that will track your exposure to certain advertising?</h5>
                        </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_6" value="1"> <span>Yes</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_6" value="2"> <span>No</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_6" value="3"> <span>Next</span>
                              </label>    
                          </div>
                    </div>

                    </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-6" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-6" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-6 -->

              <!-- Questions-7 -->
              <div class="lang-seven-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.7 What is your highest level of education?</h5>
                        </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_7" value="1"> <span>Illiterate</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_7" value="2"> <span>Literate but no formal schooling</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_7" value="3"> <span>School - up to 4 years</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_7" value="4"> <span>School - 5 to 9 years</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_7" value="5"> <span>SSC / HSC</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_7" value="6"> <span>Some College but not graduate</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_7" value="7"> <span>Graduate / Post Graduate - General</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_7" value="8"> <span>Graduate / Post Graduate - Professional</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_7" value="9"> <span>PhD</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_7" value="10"> <span>Masters/Post-Graduate</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_7" value="11"> <span>MBA</span>
                              </label>    
                          </div>
                    </div>

                    </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-7" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-7" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-7 -->
  
              <!-- Questions-8 -->
              <div class="lang-eight-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.8 What year did you graduate from university/college?</h5>
                        </div>
                        <div class="ans ml-2">
                        <div class="container mt-5">
                          <select class="form-control" name="que_8">
                             <option value="" disabled selected>Nothing selected</option>
                          @foreach($answers_9 as $k_9=> $ans_9)
                            <option value="{{$k_9}}">{{$ans_9}}</option>
                            @endforeach
                          </select>
                        </div>
                              											

                            </select>   
                          </div>
                    </div>

                    </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-8" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-8" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-8 -->

              <!-- Questions-9 -->
              <div class="lang-nine-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.9 On average, how many hours of television do you watch per week?</h5>
                        </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_9" value="1"> <span>I don t watch TV	</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_9" value="2"> <span>5 hours or less</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_9" value="3"> <span>6 to 10 hours</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_9" value="4"> <span>11 to 20 hours</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_9" value="5"> <span>More than 20 hours</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_9" value="6"> <span>Prefer not to say</span>
                              </label>    
                          </div>
                    </div>

                    </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-9" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-9" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-9 -->

              <!-- Questions-10 -->
              <div class="lang-ten-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.10 Do you smoke?</h5>
                        </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_10" value="1"> <span>Yes, I smoke</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_10" value="2"> <span>Yes, I smoke now and then</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_10" value="3"> <span>Yes, I smoke but I m planning to quit</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_10" value="4"> <span>No, I have quit</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_10" value="5"> <span>No, I don’t smoke</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_10" value="6"> <span>No, I don’t smoke, but use other tobacco products</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_10" value="7"> <span>Prefer not to say</span>
                              </label>    
                          </div>
                    </div>

                    </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-10" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-10" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-10 -->

              <!-- Questions-11 -->
              <div class="lang-eleven-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.11 What brand of cigarettes do you smoke?</h5>
                        </div>
                        <div class="ans ml-2">
                        <select class="selectpicker" multiple aria-label="Default select example" data-live-search="true" name="que_11[]">
                            @foreach($answers_11 as $k=> $ans_11)
                              <option value="{{$k}}">{{$ans_11}}</option>
                            @endforeach
                            </select>   
                        </div>
                         
                    </div>

                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-11" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-11" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-11 -->

              <!-- Questions-12 -->
              <div class="lang-twelve-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.12 On average, how many cigarettes do you smoke in a day?</h5>
                        </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_12" value="1"> <span>I dont smoke cigarettes</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_12" value="2"> <span>1 to 3 cigarettes</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_12" value="3"> <span>4 to 6 cigarettes</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_12" value="4"> <span>7 to 10 cigarettes</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_12" value="5"> <span>More than 10 cigarettes</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_12" value="6"> <span>Prefer not to say</span>
                              </label>    
                          </div>
                    </div>
                         
                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-12" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-12" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-12 -->

              <!-- Questions-13 -->
              <div class="lang-thirteen-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.13 Do you have access to a car?</h5>
                        </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_13" value="1"> <span>I own a car/cars</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_13" value="2"> <span>I lease/have a company car</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_13" value="3"> <span>I have access to a car/cars</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_13" value="4"> <span>No, I dont have access to a car</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_13" value="5"> <span>Prefer not to say</span>
                              </label>    
                          </div>
                    </div>       
                  </div>

                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-13" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-13" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-13 -->

              <!-- Questions-14 -->
              <div class="lang-fourteen-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.14 Are you the primary decision maker in your household for automotive-related purchases?</h5>
                        </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_14" value="1"> <span>Yes</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_14" value="2"> <span>No</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_14" value="3"> <span>I contribute equally in automotive decisions</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_14" value="4"> <span>Prefer not to say</span>
                                </label>    
                          </div>
                    </div>
                         
                  </div>

                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-14" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-14" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-14 -->

              <!-- Questions-15 -->
              <div class="lang-fifteen-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.15 How many cars are there in your household (including leasing or company cars)?</h5>
                        </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_15" value="1"> <span>1</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_15" value="2"> <span>2</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_15" value="3"> <span>3</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_15" value="4"> <span>4</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_15" value="5"> <span>OR MORE</span>
                                </label>    
                          </div>
                    </div>
                         
                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-15" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-15" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-15 -->

              <!-- Questions-16 -->
              <div class="lang-sixteen-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.16 If you own/lease a car(s), which brand are they?</h5>
                        </div>
                        <div class="ans ml-2">
                        <select class="selectpicker" multiple aria-label="Default select example" data-live-search="true" name="que_16[]">
                          @foreach($answers_16 as $k_16 => $ans_16)
                              <option value="{{$k_16}}">{{$ans_16}}</option>
                          @endforeach
                        </select>
                        </div>
                    </div>
                         
                  </div>

                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-16" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-16" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-16 -->

              <!-- Questions-17 -->
              <div class="lang-seventeen-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.17 How would you describe the car(s) you own/lease?</h5>
                        </div>
                        <div class="ans ml-2">
                        <select class="selectpicker" multiple aria-label="Default select example" data-live-search="true" name="que_17[]">
                          @foreach($answers_17 as $k_17 => $ans_17)
                              <option value="{{ $k_17 }}">{{$ans_17}}</option>
                          @endforeach
                          </select>
                        </div>
                         
                         
                    </div>

                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-17" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-17" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-17 -->

              <!-- Questions-18 -->
              <div class="lang-eighteen-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.18 What year was your main car (owned or leased) manufactured?</h5>
                        </div>
                        <div class="ans ml-2">
                        <select class="form-control" name="que_18">
                         <option value="" disabled selected>Nothing selected</option>
                          @foreach($answers_18 as $k_18 => $ans_18)
                              <option value="{{$k_18}}">{{$ans_18}}</option>
                          @endforeach
                          </select>
                        </div>
                         
                    </div>

                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-18" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-18" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-18 -->

              <!-- Questions-19 -->
              <div class="lang-nineteen-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.19 Do you own a motorcycle?</h5>
                        </div>
                        <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_19" value="1"> <span>Yes</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_19" value="2"> <span>No</span>
                              </label>    
                          </div>
                        
                         
                    </div>

                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-19" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-19" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <!-- Questions-19 -->

              <!-- Questions-20 -->
              <div class="lang-twenty-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.20 If you own a two wheeled vehicle, which brand are they?</h5>
                        </div>
                        <div class="ans ml-2">
                        <select class="selectpicker" multiple aria-label="Default select example" data-live-search="true" name="que_20[]">
                            @foreach($answers_20 as $k_20 => $ans_20)
                              <option value="{{$k_20}}">{{$ans_20}}</option>
                            @endforeach
                            
                          </select>
                        </div>

                       
                         
                    </div>

                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-20" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-20" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-20-->

              <!-- Questions-21 -->
              <div class="lang-twenty-one-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.21 If you own a two wheeled vehicle, what engine capacity does it have?</h5>
                        </div>
                        <div class="ans ml-2">
                            <select class="form-control my-3" name="que_21">
                            <option value="" disabled selected>Nothing selected</option>
                            <option value="1">Less than 100 CC</option>  
                            <option value="2">100-149 CC</option>
                            <option value="3">150-199 CC</option>
                            <option value="4">200 CC+</option>
                            <option value="5">I don’t own a two wheeled vehicle</option>
                            <option value="6">Prefer not to say</option>
                            </select>   
                        </div>
                         
                    </div>

                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-21" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-21" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-21 -->

              <!-- Questions-22 -->
              <div class="lang-twenty-two-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.22 If you own a two wheeled vehicle, how would you describe it?</h5>
                        </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_22" value="1"> <span>I don’t own a two wheeled vehicle</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_22" value="2"> <span>Standard</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_22" value="3"> <span>Cruiser</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_22" value="4"> <span>Sports bike</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_22" value="5"> <span>Touring</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_22" value="6"> <span>Sports touring</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_22" value="7"> <span>Dual-sport</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_22" value="8"> <span>Scooter, underbone or moped</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_22" value="9"> <span>Other</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_22" value="10"> <span>Prefer not to say</span>
                                </label>    
                          </div>
                    </div>
                         
                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-22" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-22" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-22 -->

              <!-- Questions-23 -->
              <div class="lang-twenty-three-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.23 If you own/lease a car(s), what fuel do they use?</h5>
                        </div>
                        <div class="ans ml-2">
                            <select class="form-control my-3" name="que_23">
                              <option value="" disabled selected>Nothing selected</option>
                              <option value="1">Bio-diesel / Bio-gas</option>			
                              <option value="2">Diesel</option>			
                              <option value="3">Electric (EV)</option>		
                              <option value="4">Ethanol / Flexible Fuel (FFV)</option>			
                              <option value="5">Hybrid (HEV/PHEV)</option>			
                              <option value="6">Hydrogen / Fuel Cell (FCEV)</option>			
                              <option value="7">Natural Gas (NGV)</option>			
                              <option value="8">Petrol / Gasoline</option>			
                              <option value="9">Propane / Liquefied Petroleum Gas (LPG)</option>			
                              <option value="10">Other</option>			
                              <option value="11">None of the above</option>			
                              <option value="12">I dont own/lease a car</option>	
                            </select>
                        </div>		
                    </div>       
                  </div>

                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-23" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-23" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-23 -->

              <!-- Questions-24 -->
              <div class="lang-twenty-four-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.24 Are you considering buying or leasing a new or used car within the next 2 years?</h5>
                        </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_24" value="1"> <span>No, I m not considering it</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_24" value="2"> <span>Yes, I m considering buying or leasing a used car</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_24" value="3"> <span>Yes, Im considering buying or leasing a new car</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_24" value="4"> <span>Yes, but unsure if the car will be used or new</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_24" value="5"> <span>I do not know</span>
                                </label>    
                          </div>
                    </div>
                         
                  </div>

                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-24" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-24" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-24 -->

              <!-- Questions-25 no-->
              <div class="lang-twenty-five-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.25 What is your current occupational status?</h5>
                        </div>
                          <div class="ans ml-2"> 
                                <select name="que_25" class="form-control my-3">
                                   <option value="" disabled selected>Nothing selected</option>
                                   <option value="1">Studies</option>	
                                   <option value="2">Full-time work</option>		
                                   <option value="3">Part-time work</option>			
                                   <option value="4">Own business / Self-employed / Freelance</option>			
                                   <option value="5">Active military service</option>			
                                   <option value="6">Parental leave</option>		
                                   <option value="7">Retired</option>		
                                   <option value="8">Unemployed</option>			
                                   <option value="9">Homemaker</option>			
                                   <option value="10">Leave of absence</option>			
                                   <option value="11">Unable to work</option>			
                                   <option value="12">Other type of paid work</option>		
                                   <option value="14">Prefer not to say</option>		 
                                </select>    
                          </div>
                    </div>
                         
                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-25" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-25" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-25 -->

              <!-- Questions-26 -->
              <div class="lang-twenty-six-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.26 What is your occupation?</h5>
                        </div>
                        <div class="ans ml-2">
                          <select class="form-control my-3" name="que_26">
                              <option value="" disabled selected>Nothing selected</option>
                              <option value="1">Unskilled Worker</option>		
                              <option value="2">Skilled Worked</option>		
                              <option value="3">Petty Trader</option>		
                              <option value="4">Shop Owner</option>		
                              <option value="5">Businessman / Industrialist - No employees</option>			
                              <option value="6">Businessman / Industrialist - 1-9 employees</option>			
                              <option value="7">Businessman / Industrialist - 10+ employees</option>			
                              <option value="8">Self Employed Professional</option>			
                              <option value="9">Clerical / Salesman</option>			
                              <option value="10">Supervisory Level</option>			
                              <option value="11">Officers / Executives - Junior</option>			
                              <option value="12">Officers / Executives - Middle / Senior</option>		
                          </select>
                        </div>
                    </div>
                         
                  </div>

                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-26" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-26" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-26 -->

              <!-- Questions-27 -->
              <div class="lang-twenty-seven-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.27 Which of the following categories best describes your organisation's primary industry?</h5>
                        </div>
                        <div class="ans ml-2">
                        <select name="que_27" class="form-control">
                            <option value="" disabled selected>Nothing selected</option>
                          @foreach($answers_27 as $k_27 => $ans_27)
                              <option value="{{$k_27}}">{{$ans_27}}	</option>
                          @endforeach
                          </select>
                        </div>
                         
                         
                    </div>

                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-27" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-27" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-27 -->

              <!-- Questions-28 -->
              <div class="lang-twenty-eight-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.28  Approximately how many employees work at your organisation (all locations)?</h5>
                        </div>
                        <div class="ans ml-2">
                          <select class="form-control my-3" name="que_28">
                              <option value="" disabled selected>Nothing selected</option>
                              <option value="1">1-10</option>
                              <option value="2">10-25</option>
                              <option value="3">26-50</option>
                              <option value="4">51-100</option>
                              <option value="5">101-250</option>
                              <option value="6">251-500</option>
                              <option value="7">501-1000</option>
                              <option value="8">1001-5000</option>
                              <option value="9">Greater than 5000</option>
                              <option value="10">I don't work/I don't know</option>
                              <option value="11">Prefer not to say</option>
                          </select>
                        </div>
                         
                    </div>

                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-28" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-28" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-28 -->

              <!-- Questions-29 -->
              <div class="lang-twenty-nine-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.29  Which department do you primarily work within at your organisation?</h5>
                        </div>
                          <div class="ans ml-2">
                          <select name="que_29" class="form-control my-3">
                           <option value="" disabled selected>Nothing selected</option>									
                           <option value="1">Administration/General Staff</option>
                           <option value="2">Human Resources</option>
                           <option value="3">Finance/Accounting</option>
                           <option value="4">Marketing/Advertising	</option>
                           <option value="5">Technology Implementation</option>
                           <option value="6">Production</option>
                           <option value="7">Management</option>
                           <option value="8">Medical</option>
                           <option value="9">Legal/Law/Compliance</option>
                           <option value="10">Engineering</option>
                           <option value="11">Creative/Design</option>
                           <option value="12">Entertainment</option>
                           <option value="13">Customer Service/Client Service</option>
                           <option value="14">Sales/Business Development</option>
                           <option value="15">IT/IS/MIS</option>
                           <option value="16">App/Software Development</option>
                           <option value="17">Operations</option>
                           <option value="18">Procurement</option>
                           <option value="19">Executive Leadership</option>
                           <option value="20">Product Management/Product Development</option>
                           <option value="21">Market Research</option>
                           <option value="22">Research/Development</option>
                           <option value="23">Logistics/Shipping</option>
                           <option value="24">Other</option>
                           <option value="25">I don't work</option>
                           <option value="26">Prefer not to say</option>
                          </select>
                                 
                          </div>    
                    </div>
                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-29" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-29" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
              <!-- Questions-29 -->

              <!-- Questions-30 -->
              <div class="lang-thirty-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.30  If you work in your organisation's IT department, please provide more detail about your role.</h5>
                        </div>
                        <div class="ans ml-2">
                        <select name="que_30" class="form-control">
                             <option value="" disabled selected>Nothing selected</option>
                            @foreach($answers_30 as $k_30 => $ans_30)
                              <option value="{{$k_30}}">{{$ans_30}}</option>
                            @endforeach
                            
                          </select>
                        </div>

                       
                         
                    </div>

                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-30" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-30" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-30-->

              <!-- Questions-31 -->
              <div class="lang-thirty-one-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.31  What is your primary role in your organisation?</h5>
                        </div>
                        <div class="ans ml-2">
                        <select class="form-control" name="que_31">
                            <option value="" disabled selected>Nothing selected</option>
                            @foreach($answers_31 as $k_31 => $ans_31)
                             <option value="{{$k_31}}">{{$ans_31}}</option>
                            @endforeach  
                            </select>   
                        </div>
                         
                    </div>

                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-31" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-31" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-31 -->

              <!-- Questions-32 -->
              <div class="lang-thirty-two-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.32  What is your professional position in the organisation you work for?</h5>
                        </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_32" value="1"> <span>Director/Manager</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_32" value="2"> <span>Not a managing position</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_32" value="3"> <span>Other decision maker</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_32" value="4"> <span>I don't work</span>
                                </label>    
                          </div>
                          <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_32" value="5"> <span>Prefer not to say</span>
                              </label>    
                          </div>
                    </div>
                         
                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-32" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-32" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-32 -->

              <!-- Questions-33 -->
              <div class="lang-thirty-three-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.33  Have you been diagnosed with any of the following illnesses/conditions? Note that the information will be kept in strictest confidence.</h5>
                        </div>
                        <div class="ans ml-2">
                        <select class="selectpicker" multiple aria-label="Default select example" data-live-search="true" name="que_33[]">
                              @foreach($answers_33 as $k_33 => $ans_33)
                               <option value="{{$k_33}}">{{$ans_33}}</option>
                              @endforeach 	
                            </select>
                        </div>		
                    </div>       
                  </div>

                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-33" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-33" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-33 -->

              <!-- Questions-34 -->
              <div class="lang-thirty-four-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.34  If you stated that you have been diagnosed with cancer, can you define the type of cancer?</h5>
                        </div>
                        <div class="ans ml-2">
                            <select class="form-control my-3" name="que_34">
                              <option value="" disabled selected>Nothing selected</option>
                              <option value="1">Bowel cancer</option>			
                              <option value="2">Breast cancer</option>			
                              <option value="3">Kidney cancer	</option>									
                              <option value="4">Leukaemia</option>			
                              <option value="5">Liver cancer</option>			
                              <option value="6">Ovarian cancer</option>
                              <option value="7">Prostate cancer</option>			
                              <option value="8">Melanoma/Skin cancer</option>			
                              <option value="9">Bladder cancer</option>
                              <option value="10">Lung cancer</option>			
                              <option value="11">Non-Hodgkin's Lymphoma</option>			
                              <option value="12">Pancreatic cancer</option>
                              <option value="13">Thyroid cancer</option>			
                              <option value="14">Other cancer type</option>			
                              <option value="15">I don't have cancer	</option>
                              <option value="16">Prefer not to say</option> 
                            </select>
                        </div>	

                    </div>
                         
                  </div>

                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-34" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-34" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-34 -->

              <!-- Questions-35 -->
              <div class="lang-thirty-five-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.35  If you stated that you have been diagnosed with diabetes, can you define the type of diabetes?</h5>
                        </div>
                        <div class="ans ml-2">
                          <select class="form-control my-3" name="que_35">
                              <option value="" disabled selected>Nothing selected</option>
                              <option value="1">Diabetes Type 1</option>
                              <option value="2">Diabetes Type 2</option>
                              <option value="3">Diabetes Type 3	</option>
                              <option value="4">I don't have diabetes	</option>
                              <option value="5">Prefer not to say</option>
                          </select>
                        </div>
                    </div>
                         
                  </div>

                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-35" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-35" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-35 -->

              <!-- Questions-36 -->
              <div class="lang-thirty-six-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.36  Do you use glasses or contact lenses?</h5>
                        </div>
                        <div class="ans ml-2">
                          <select class="form-control my-3" name="que_36">
                              <option value="" disabled selected>Nothing selected</option>
                              <option value="1">Glasses</option>
                              <option value="2">Contact lenses</option>
                              <option value="3">Diabetes Type 3	</option>
                              <option value="4">Both Glasses and Contact lenses</option>
                              <option value="5">I don't use Glasses/Contact lenses</option>	
                              <option value="6">Prefer not to say</option>
                          </select>
                        </div>
                    </div>
                         
                  </div>

                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-36" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-36" type="button">
                            Next<i class="fa fa-angle-right ml-2">
                            </i>
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-36 -->

              <!-- Questions-37 -->
              <div class="lang-thirty-seven-que d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                            <h5 class="mt-1 ml-2">Q.37  Do you use a hearing aid?</h5>
                        </div>
                        <div class="ans ml-2">
                              <label class="radio">
                               <input type="radio" name="que_37" value="1"> <span>YES</span>
                              </label>    
                          </div>
                          <div class="ans ml-2">
                                <label class="radio"> 
                                <input type="radio" name="que_37" value="2"> <span>NO</span>
                                </label>    
                          </div>
                         
                         
                    </div>

                  </div>
                    <div class="col-md-12">
                        <div class="row mt-4">
                            <div class="col-md-4">
                               <button class="btn btn-primary  btn-danger lang-prev-37" type="button">
                               <i class="fa fa-angle-left mt-1 mr-1"></i>&nbsp;previous</button>
                            </div>
                            <div class="col-md-4">

                            </div>
                            <div class="col-md-4">
                            <button class="btn btn-primary border-success align-items-center btn-success lang-que-37 form_submit" type="button">
                            Submit
                            </button>
                            </div>
                        </div>
                    </div>
                      

                </div>
              </div>
              <!-- Questions-37 -->
              
              <!--success-->
              <div class="lang-success d-none">
                <div class="row">
                  <div class="container">
                    <div class="bg-white p-3 border">
                        <div class="question"> 
                           <div class="mt-5" id="success">
                             <h4>Success! </h4>
                                <p>Thank you for taking the time to complete this survey.</p>
                            </div>
                        </div>
                        
                         
                         
                    </div>

                  </div>
            
                      

                </div>
              </div>
              
              <!--end success-->
              




              
              							
             


            <!--End All Questions-->

        </div>
      </div>
    </div>
    <div class="col-md-2">
    </div>
    </div>
    </form>
    </div>
    
   <script type="text/javascript">
    
   
  </script>
  <!-- next -->
  <script>
    $(".lang-click").click(function () {
      if($('.changeLang').val()){
      $('.main-country').addClass('d-none');
      $('.lang-content').removeClass('d-none');
      }
      else{
        swal({
                             title:'Warning',
                             text:'Please Choose Country',
                             icon:'success',
                             buttons:false
            })
      }
    });
    $(".lang-cond").click(function () {
      $('.main-country').addClass('d-none');
      $('.lang-content').addClass('d-none');
      $('.lang-personal').removeClass('d-none');
    });
    $('.sub-personal').click(function () {
        if(($('.lang-cal').val()!='' && $('.lang-cal1').val()!='' && $('.lang-cal2').val()!='' && $('.lang-cal3').val()!='' && $('.lang-cal4').val()!='' && $('.lang-cal5').val()!='' )){
        
        $('.lang-personal').addClass('d-none')
        $('.lang-first-que').removeClass('d-none');
        }
        else{
            swal({
                             title:'Warning',
                             text:'Please Fill All Fields',
                             icon: 'error',
                             buttons:false
            })
        }
      });
    $('.lang-que-1').click(function () {
      $('.lang-first-que').addClass('d-none');
      $('.lang-second-que').removeClass('d-none');
    })
    $('.lang-que-2').click(function () {
      $('.lang-second-que').addClass('d-none');
      $('.lang-third-que').removeClass('d-none');
    })
    $('.lang-que-3').click(function () {
      $('.lang-third-que').addClass('d-none');
      $('.lang-four-que').removeClass('d-none');
    })
    $('.lang-que-4').click(function () {
      $('.lang-four-que').addClass('d-none');
      $('.lang-five-que').removeClass('d-none');
    })
    $('.lang-que-5').click(function () {
      $('.lang-five-que').addClass('d-none');
      $('.lang-six-que').removeClass('d-none');
    })
    $('.lang-que-6').click(function () {
      $('.lang-six-que').addClass('d-none');
      $('.lang-seven-que').removeClass('d-none');
    })
    $('.lang-que-7').click(function () {
      $('.lang-seven-que').addClass('d-none');
      $('.lang-eight-que').removeClass('d-none');
    })
    $('.lang-que-8').click(function () {
      $('.lang-eight-que').addClass('d-none');
      $('.lang-nine-que').removeClass('d-none');
    })
    $('.lang-que-9').click(function () {
      $('.lang-nine-que').addClass('d-none');
      $('.lang-ten-que').removeClass('d-none');
    })
    $('.lang-que-10').click(function () {
      $('.lang-ten-que').addClass('d-none');
      $('.lang-eleven-que').removeClass('d-none');
    })
    $('.lang-que-11').click(function () {
      $('.lang-eleven-que').addClass('d-none');
      $('.lang-twelve-que').removeClass('d-none');
    })
    $('.lang-que-12').click(function () {
      $('.lang-twelve-que').addClass('d-none');
      $('.lang-thirteen-que').removeClass('d-none');
    })
    $('.lang-que-13').click(function () {
      $('.lang-thirteen-que').addClass('d-none');
      $('.lang-fourteen-que').removeClass('d-none');
    })
    $('.lang-que-14').click(function () {
      $('.lang-fourteen-que').addClass('d-none');
      $('.lang-fifteen-que').removeClass('d-none');
    })
    $('.lang-que-15').click(function () {
      $('.lang-fifteen-que').addClass('d-none');
      $('.lang-sixteen-que').removeClass('d-none');
    })
    $('.lang-que-16').click(function () {
      $('.lang-sixteen-que').addClass('d-none');
      $('.lang-seventeen-que').removeClass('d-none');
    })
    $('.lang-que-17').click(function () {
      $('.lang-seventeen-que').addClass('d-none');
      $('.lang-eighteen-que').removeClass('d-none');
    })
    $('.lang-que-18').click(function () {
      $('.lang-eighteen-que').addClass('d-none');
      $('.lang-nineteen-que').removeClass('d-none');
    })
    $('.lang-que-19').click(function () {
      $('.lang-nineteen-que').addClass('d-none');
      $('.lang-twenty-que').removeClass('d-none');
    })
    $('.lang-que-20').click(function () {
      $('.lang-twenty-que').addClass('d-none');
      $('.lang-twenty-one-que').removeClass('d-none');
    })
    $('.lang-que-21').click(function () {
      $('.lang-twenty-one-que').addClass('d-none');
      $('.lang-twenty-two-que').removeClass('d-none');
    })
    $('.lang-que-22').click(function () {
      $('.lang-twenty-two-que').addClass('d-none');
      $('.lang-twenty-three-que').removeClass('d-none');
    })
    $('.lang-que-23').click(function () {
      $('.lang-twenty-three-que').addClass('d-none');
      $('.lang-twenty-four-que').removeClass('d-none');
    })
    $('.lang-que-24').click(function () {
      $('.lang-twenty-four-que').addClass('d-none');
      $('.lang-twenty-five-que').removeClass('d-none');
    })
    $('.lang-que-25').click(function () {
      $('.lang-twenty-five-que').addClass('d-none');
      $('.lang-twenty-six-que').removeClass('d-none');
    })
    $('.lang-que-26').click(function () {
      $('.lang-twenty-six-que').addClass('d-none');
      $('.lang-twenty-seven-que').removeClass('d-none');
    })
    $('.lang-que-27').click(function () {
      $('.lang-twenty-seven-que').addClass('d-none');
      $('.lang-twenty-eight-que').removeClass('d-none');
    })
    $('.lang-que-28').click(function () {
      $('.lang-twenty-eight-que').addClass('d-none');
      $('.lang-twenty-nine-que').removeClass('d-none');
    })
    $('.lang-que-29').click(function () {
      $('.lang-twenty-nine-que').addClass('d-none');
      $('.lang-thirty-que').removeClass('d-none');
    })
    $('.lang-que-30').click(function () {
      $('.lang-thirty-que').addClass('d-none');
      $('.lang-thirty-one-que').removeClass('d-none');
    })
    $('.lang-que-31').click(function () {
      $('.lang-thirty-one-que').addClass('d-none');
      $('.lang-thirty-two-que').removeClass('d-none');
    })
    $('.lang-que-32').click(function () {
      $('.lang-thirty-two-que').addClass('d-none');
      $('.lang-thirty-three-que').removeClass('d-none');
    })
    $('.lang-que-33').click(function () {
      $('.lang-thirty-three-que').addClass('d-none');
      $('.lang-thirty-four-que').removeClass('d-none');
    })
    $('.lang-que-34').click(function () {
      $('.lang-thirty-four-que').addClass('d-none');
      $('.lang-thirty-five-que').removeClass('d-none');
    })
    $('.lang-que-35').click(function () {
      $('.lang-thirty-five-que').addClass('d-none');
      $('.lang-thirty-six-que').removeClass('d-none');
    })
    $('.lang-que-36').click(function () {
      $('.lang-thirty-six-que').addClass('d-none');
      $('.lang-thirty-seven-que').removeClass('d-none');
    })


    $('.lang-prev-1').click(function () {
      $('.lang-first-que').addClass('d-none');
      $('.lang-personal').removeClass('d-none');
    })
    $('.lang-prev-2').click(function () {
      $('.lang-second-que').addClass('d-none');
      $('.lang-first-que').removeClass('d-none');
    })
    $('.lang-prev-3').click(function () {
      $('.lang-third-que').addClass('d-none');
      $('.lang-second-que').removeClass('d-none');
    })
    $('.lang-prev-4').click(function () {
      $('.lang-four-que').addClass('d-none');
      $('.lang-third-que').removeClass('d-none');
    })
    $('.lang-prev-5').click(function () {
      $('.lang-five-que').addClass('d-none');
      $('.lang-four-que').removeClass('d-none');
    })
    $('.lang-prev-6').click(function () {
      $('.lang-six-que').addClass('d-none');
      $('.lang-five-que').removeClass('d-none');
    })
    $('.lang-prev-7').click(function () {
      $('.lang-seven-que').addClass('d-none');
      $('.lang-six-que').removeClass('d-none');
    })
    $('.lang-prev-8').click(function () {
      $('.lang-eight-que').addClass('d-none');
      $('.lang-seven-que').removeClass('d-none');
    })
    $('.lang-prev-9').click(function () {
      $('.lang-nine-que').addClass('d-none');
      $('.lang-eight-que').removeClass('d-none');
    })
    $('.lang-prev-10').click(function () {
      $('.lang-ten-que').addClass('d-none');
      $('.lang-nine-que').removeClass('d-none');
    })
    $('.lang-prev-11').click(function () {
      $('.lang-eleven-que').addClass('d-none');
      $('.lang-ten-que').removeClass('d-none');
    })
    $('.lang-prev-12').click(function () {
      $('.lang-twelve-que').addClass('d-none');
      $('.lang-eleven-que').removeClass('d-none');
    })
    $('.lang-prev-13').click(function () {
      $('.lang-thirteen-que').addClass('d-none');
      $('.lang-twelve-que').removeClass('d-none');
    })
    $('.lang-prev-14').click(function () {
      $('.lang-fourteen-que').addClass('d-none');
      $('.lang-thirteen-que').removeClass('d-none');
    })
    $('.lang-prev-15').click(function () {
      $('.lang-fifteen-que').addClass('d-none');
      $('.lang-fourteen-que').removeClass('d-none');
    })
    $('.lang-prev-16').click(function () {
      $('.lang-sixteen-que').addClass('d-none');
      $('.lang-fifteen-que').removeClass('d-none');
    })
    $('.lang-prev-17').click(function () {
      $('.lang-seventeen-que').addClass('d-none');
      $('.lang-sixteen-que').removeClass('d-none');
    })
    $('.lang-prev-18').click(function () {
      $('.lang-eighteen-que').addClass('d-none');
      $('.lang-seventeen-que').removeClass('d-none');
    })
    $('.lang-prev-19').click(function () {
      $('.lang-nineteen-que').addClass('d-none');
      $('.lang-eighteen-que').removeClass('d-none');
    })
    $('.lang-prev-20').click(function () {
      $('.lang-twenty-que').addClass('d-none');
      $('.lang-nineteen-que').removeClass('d-none');
    })
    $('.lang-prev-21').click(function () {
      $('.lang-twenty-one-que').addClass('d-none');
      $('.lang-twenty-que').removeClass('d-none');
    })
    $('.lang-prev-22').click(function () {
      $('.lang-twenty-two-que').addClass('d-none');
      $('.lang-twenty-one-que').removeClass('d-none');
    })
    $('.lang-prev-23').click(function () {
      $('.lang-twenty-three-que').addClass('d-none');
      $('.lang-twenty-two-que').removeClass('d-none');
    })
    $('.lang-prev-24').click(function () {
      $('.lang-twenty-four-que').addClass('d-none');
      $('.lang-twenty-three-que').removeClass('d-none');
    })
    $('.lang-prev-25').click(function () {
      $('.lang-twenty-five-que').addClass('d-none');
      $('.lang-twenty-four-que').removeClass('d-none');
    })
    $('.lang-prev-26').click(function () {
      $('.lang-twenty-six-que').addClass('d-none');
      $('.lang-twenty-five-que').removeClass('d-none');
    })
    $('.lang-prev-27').click(function () {
      $('.lang-twenty-seven-que').addClass('d-none');
      $('.lang-twenty-six-que').removeClass('d-none');
    })
    $('.lang-prev-28').click(function () {
      $('.lang-twenty-eight-que').addClass('d-none');
      $('.lang-twenty-seven-que').removeClass('d-none');
    })
    $('.lang-prev-29').click(function () {
      $('.lang-twenty-nine-que').addClass('d-none');
      $('.lang-twenty-eight-que').removeClass('d-none');
    })
    $('.lang-prev-30').click(function () {
      $('.lang-thirty-que').addClass('d-none');
      $('.lang-twenty-nine-que').removeClass('d-none');
    })
    $('.lang-prev-31').click(function () {
      $('.lang-thirty-one-que').addClass('d-none');
      $('.lang-thirty-que').removeClass('d-none');
    })
    $('.lang-prev-32').click(function () {
      $('.lang-thirty-two-que').addClass('d-none');
      $('.lang-thirty-one-que').removeClass('d-none');
    })
    $('.lang-prev-33').click(function () {
      $('.lang-thirty-three-que').addClass('d-none');
      $('.lang-thirty-two-que').removeClass('d-none');
    })
    $('.lang-prev-34').click(function () {
      $('.lang-thirty-four-que').addClass('d-none');
      $('.lang-thirty-three-que').removeClass('d-none');
    })
    $('.lang-prev-35').click(function () {
      $('.lang-thirty-five-que').addClass('d-none');
      $('.lang-thirty-four-que').removeClass('d-none');
    })
    $('.lang-prev-36').click(function () {
      $('.lang-thirty-six-que').addClass('d-none');
      $('.lang-thirty-five-que').removeClass('d-none');
    })
    $('.lang-prev-37').click(function () {
      $('.lang-thirty-seven-que').addClass('d-none');
      $('.lang-thirty-six-que').removeClass('d-none');
    })

    $(function () {
      var checkBox = 'input[type="checkbox"]';
      console.log($(checkBox).length);
      $('.form-check-input').change(function () {
        console.log('hii');
        console.log($(checkBox + ':checked').length);
        if ($(checkBox + ':checked').length > 7) {
          $('.lang-cond').removeAttr("disabled");
        } else {
          $('.lang-cond').attr("disabled", true);
        }

      })
    })


    $('.selectall').change(function() {
      console.log('hii');
    if ($(this).is(':checked')) {
      console.log('hii');
        $('.duplicate input').attr('checked', true);
    } else {
        $('.duplicate input').attr('checked', false);
    }
 });
 
      
   


    $('.lang-name').keyup(function () {
      // $('input[name="fname"], input[name="lname"], input[name="phone"],input[name="email"],input[name="address"],input[name="zipcode"]')
      if (($('.lang-cal').val()) && ($('.lang-cal1').val()) && ($('.lang-cal2').val()) && ($('.lang-cal3').val()) &&
        ($('.lang-cal4').val()) && ($('.lang-cal5').val())) {
        $('.sub-personal').removeAttr('disabled');

      } else if (($('.lang-cal').val() == '') && ($('.lang-cal1').val() == '') && ($('.lang-cal2').val() == '') && (
          $('.lang-cal3').val() == '') &&
        ($('.lang-cal4').val() == '') && ($('.lang-cal5').val() == '')) {
        $('sub-personal').attr('disabled', 'disabled');
      } else {
        $('sub-personal').attr('disabled', 'disabled');
      }
    });

    $(document).ready(function () {
      $(function () {
        $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
     });
    });
    })


    $('#register').validate({
            rules:{
                
            },
           
            
            submitHandler: function (form) {
                var data =new FormData(form);       
                
                $.ajax({
                   url:"{{route('new_register')}}",
                   type:"post",
                   processData: false,
                   contentType: false,
                   dataType: "json",
                   data:data,
                   success:function(data){
                //      if(data.success == 0){
                //         $.each(data.errors, function(index, error){  
                //                         $(form).find( "[name='"+index+"']" ).addClass("error").after( "<label class='error'>"+error+"</label>" ); 
                //                 }); 
                //  }  
                 if(data.success == 1){
                    swal({
                            title:'Success',
                            text:data.message,
                            icon:'success',
                            buttons:false
                        })
                        $('.lang-thirty-seven-que').addClass('d-none');
                        $('.lang-success').removeClass('d-none');
                    // $("#otherFieldDiv").addClass('d-none');
                    // $("#send").removeClass();
                    
                 }
                 if(data.success == 0){
                      swal({
                            title:'Warning',
                            icon:'danger',
                            buttons:false
                        })
                 }
                 
                   }
               })  
            } 

        });
   

        $('.form_submit').click(function(){
          $('#register').submit()
        });

  </script>

</body>

</html>
{{-- @endsection --}}
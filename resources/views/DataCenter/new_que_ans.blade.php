<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;1,200;1,300;1,400;1,500;1,600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"></script>

  <!-- multi dropdown -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/css/bootstrap-select.min.css" integrity="sha512-ARJR74swou2y0Q2V9k0GbzQ/5vJ2RBSoCWokg4zkfM29Fb3vZEQyv0iWBMW/yvKgyHSR/7D64pFMmU8nYmbRkg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
  </script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.18/js/bootstrap-select.min.js" integrity="sha512-yDlE7vpGDP7o2eftkCiPZ+yuUyEcaBwoJoIhdXv71KZWugFqEphIS3PU60lEkFaz8RxaVsMpSvQxMBaKVwA5xg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
 <!-- end multi dropdown -->

 <!--alert-->
 <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
 <!--end alert-->


</head>
<style>
    body {
    background: #f7f9ff;
    font-family: 'Josefin Sans', sans-serif;
    font-size: 16px;
    font-size: 1rem;
    font-weight: 600;
    line-height: 1.4;
    color: #555;
}
 
h1,
h2,
h3,
h4,
h5,
h6 {
    color: #00011c;
}
 
p {
    margin-bottom: 24px;
    line-height: 1.9;
}
 
label {
    font-size: 16px;
    font-size: 1rem;
    font-weight: 600;
    margin-bottom: 5px;
    color: #00011c;
}
#title-container {
    min-height: 460px;
    height: 100%;
    color: #fff;
    background-color: #c8f9fd;
    text-align: center;
    padding: 105px 28px 28px 28px;
    box-sizing: border-box;
    position: relative;
    box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
    -webkit-box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
    -moz-box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
}
 
#title-container h2 {
    font-size: 45px;
    font-weight: 800;
    color: #fff;
    padding: 0;
    margin-bottom: 0px;
}
 
#title-container h3 {
    font-size: 25px;
    font-weight: 600;
    color: #82000a !important;
    padding: 0;
}
 
#title-container p {
    font-size: 13px;
    padding: 0 25px;
    line-height: 20px;
}
 
.covid-image {
    width: 214px;
    margin-top: 15px;
}
#qbox-container {
    background: url('{{asset("adminapp/assets/images/bg4.jpg")}}');
    background-repeat: no-repeat;
    background-size:cover;
    position: relative;
    padding: 62px;
    min-height: 630px;
    box-shadow: 10px 8px 21px 0px rgb(204 204 204 / 75%);
    -webkit-box-shadow: 10px 8px 21px 0px rgb(204 204 204 / 75%);
    -moz-box-shadow: 10px 8px 21px 0px rgba(204, 204, 204, 0.75);
}
 
#steps-container {
    margin: auto;
    width: 500px;
    min-height: 420px;
    display: flex;
    vertical-align: middle;
    align-items: center;
}
 
.step {
    display: none;
}
 
.lang h4 {
    margin: 0 0 26px 0;
    padding: 0;
    position: relative;
    font-weight: 500;
    font-size: 23px;
    font-size: 1.4375rem;
    line-height: 1.6;
}
 
button#prev-btn,
button#next-btn,
button#submit-btn {
    font-size: 17px;
    font-weight: bold;
    position: relative;
    width: 130px;
    height: 40px;
    background: #DC3545;
    margin: 0 auto;
    margin-top: 40px;
    overflow: hidden;
    z-index: 1;
    cursor: pointer;
    transition: color .3s;
    text-align: center;
    color: #fff;
    border: 0;
    -webkit-border-bottom-right-radius: 5px;
    -webkit-border-bottom-left-radius: 5px;
    -moz-border-radius-bottomright: 5px;
    -moz-border-radius-bottomleft: 5px;
    border-bottom-right-radius: 5px;
    border-bottom-left-radius: 5px;
    border-radius:10px;
}
 
button#prev-btn:after,
button#next-btn:after,
button#submit-btn:after {
    position: absolute;
    top: 90%;
    left: 0;
    width: 100%;
    height: 100%;
    background: #cc0616;
    content: "";
    z-index: -2;
    transition: transform .3s;
}
 
button#prev-btn:hover::after,
button#next-btn:hover::after,
button#submit-btn:hover::after {
    transform: translateY(-80%);
    transition: transform .3s;
}
 
.progress {
    border-radius: 0px !important;
    height:unset !important
}
 
.q__question {
    position: relative;
}
 
.q__question:not(:last-child) {
    margin-bottom: 10px;
}
 
.question__input {
    position: absolute;
    left: -9999px;
}
 
.question__label {
    position: relative;
    display: block;
    line-height: 40px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    background-color: #fff;
    padding: 5px 20px 5px 50px;
    cursor: pointer;
    transition: all 0.15s ease-in-out;
}
 
.question__label:hover {
    border-color: #DC3545;
}
 
.question__label:before,
.question__label:after {
    position: absolute;
    content: "";
}
 
.question__label:before {
    top: 12px;
    left: 10px;
    width: 26px;
    height: 26px;
    border-radius: 50%;
    background-color: #fff;
    box-shadow: inset 0 0 0 1px #ced4da;
    -webkit-transition: all 0.15s ease-in-out;
    -moz-transition: all 0.15s ease-in-out;
    -o-transition: all 0.15s ease-in-out;
    transition: all 0.15s ease-in-out;
}
 
.question__input:checked+.question__label:before {
    background-color: #DC3545;
    box-shadow: 0 0 0 0;
}
 
.question__input:checked+.question__label:after {
    top: 22px;
    left: 18px;
    width: 10px;
    height: 5px;
    border-left: 2px solid #fff;
    border-bottom: 2px solid #fff;
    transform: rotate(-45deg);
}
 
.form-check-input:checked,
.form-check-input:focus {
    background-color: #DC3545 !important;
    outline: none !important;
    border: none !important;
}
 
input:focus {
    outline: none;
}
 
#input-container {
    display: inline-block;
    box-shadow: none !important;
    margin-top: 36px !important;
}
 
label.form-check-label.radio-lb {
    margin-right: 15px;
}
 
#q-box__buttons {
    text-align: center;
}
 
input[type="text"],
input[type="email"] {
    padding: 8px 14px;
}
 
input[type="text"]:focus,
input[type="email"]:focus {
    border: 1px solid #DC3545;
    border-radius: 5px;
    outline: 0px !important;
    -webkit-appearance: none;
    box-shadow: none !important;
    -webkit-transition: all 0.15s ease-in-out;
    -moz-transition: all 0.15s ease-in-out;
    -o-transition: all 0.15s ease-in-out;
    transition: all 0.15s ease-in-out;
}
 
.form-check-input:checked[type=radio],
.form-check-input:checked[type=radio]:hover,
.form-check-input:checked[type=radio]:focus,
.form-check-input:checked[type=radio]:active {
    border: none !important;
    -webkit-outline: 0px !important;
    box-shadow: none !important;
}
 
.form-check-input:focus,
input[type="radio"]:hover {
    box-shadow: none;
    cursor: pointer !important;
}
 

#success h4 {
    color: #DC3545;
}
 
.back-link {
    font-weight: 700;
    color: #DC3545;
    text-decoration: none;
    font-size: 18px;
}
 
.back-link:hover {
    color: #82000a;
}

#preloader-wrapper {
    width: 100%;
    height: 100%;
    z-index: 1000;
    display: none;
    position: fixed;
    top: 0;
    left: 0;
}
 
#preloader {
    background-image: url('../img/preloader.png');
    width: 120px;
    height: 119px;
    border-top-color: #fff;
    border-radius: 100%;
    display: block;
    position: relative;
    top: 50%;
    left: 50%;
    margin: -75px 0 0 -75px;
    -webkit-animation: spin 2s linear infinite;
    animation: spin 2s linear infinite;
    z-index: 1001;
}
 
@-webkit-keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
 
@keyframes spin {
    0% {
        -webkit-transform: rotate(0deg);
        -ms-transform: rotate(0deg);
        transform: rotate(0deg);
    }
    100% {
        -webkit-transform: rotate(360deg);
        -ms-transform: rotate(360deg);
        transform: rotate(360deg);
    }
}
 
#preloader-wrapper .preloader-section {
    width: 51%;
    height: 100%;
    position: fixed;
    top: 0;
    background: #F7F9FF;
    z-index: 1000;
}
 
#preloader-wrapper .preloader-section.section-left {
    left: 0
}
 
#preloader-wrapper .preloader-section.section-right {
    right: 0;
}
 
.loaded #preloader-wrapper .preloader-section.section-left {
    transform: translateX(-100%);
    transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
}
 
.loaded #preloader-wrapper .preloader-section.section-right {
    transform: translateX(100%);
    transition: all 0.7s 0.3s cubic-bezier(0.645, 0.045, 0.355, 1.000);
}
 
.loaded #preloader {
    opacity: 0;
    transition: all 0.3s ease-out;
}
 
.loaded #preloader-wrapper {
    visibility: hidden;
    transform: translateY(-100%);
    transition: all 0.3s 1s ease-out;
}
@media (min-width: 990px) and (max-width: 1199px) {
    #title-container {
        padding: 80px 28px 28px 28px;
    }
    #steps-container {
        width: 85%;
    }
}
 
@media (max-width: 991px) {
    #title-container {
        padding: 30px;
        min-height: inherit;
    }
}
 
@media (max-width: 767px) {
    #qbox-container {
        padding: 30px;
    }
    #steps-container {
        width: 100%;
        min-height: 400px;
    }
    #title-container {
        padding-top: 50px;
    }
}
 
@media (max-width: 560px) {
    #qbox-container {
        padding: 40px;
    }
    #title-container {
        padding-top: 45px;
    }
}
@media (max-width: 560px) {
  .main-country.col-lg-12.col-sm-12 {
    margin-left: 50px;
  }
  .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: 150%;
}

   .progress-bar{
    display: none;
   }
}
p.lang-p {
    visibility: hidden;
}
   /* multiple choice */
   .bootstrap-select>.dropdown-toggle.bs-placeholder{
     color: #211f1f;
   }
   .btn-light {
       color: #000;
       border-color: #ced4da;
       background-color: #fff;
   }
   .dropdown .dropdown-menu .dropdown-item:hover {
    background-color: #DC3545;
    color: #f7eded;
   }
    .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
      width: 40%;
     }
   .btn-light:hover {
    color: #000;
    background-color: #f9fafb;
    border-color: #dc3545;
   }

   /* end multiple choice */

   .bootstrap-select:not([class*=col-]):not([class*=form-control]):not(.input-group-btn) {
    width: 80%;
    margin-left: 13%;
}
#title-container h3 {
    color: #fff; 
}
.error{
    color:red;
}

</style>
<body>
<!-- CONTAINER -->
<div class="container d-flex align-items-center min-vh-100">
  <div class="row g-0 justify-content-center">
      <!-- TITLE -->
      <div class="col-lg-4 offset-lg-1 mx-0 px-0">
         <div id="title-container">
           <h3>Self Checker Form</h3>
           <img class="covid-image" src="{{asset('adminapp/assets/images/logo-3.png')}}" alt="logo">
            <p class="lang-p">A clinical assessment multi-step form that will assist individuals on deciding when to seek testing or medical care if they suspect they or someone they know has contracted COVID-19 or has come into close contact with someone who has COVID-19</p>
         </div>
      </div>
      <!-- FORMS -->
    <div class="col-lg-7 mx-0 px-0">
     <div class="progress">
      <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="50" class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 0%"></div>
     </div>
     <div id="qbox-container">
      <form id="register">
        @csrf
         <div id="steps-container">
         <input type="hidden" class="form-control" name="userid"  value="{{$user_id ? $user_id :''}}">
         <!-- country -->
           <div class="main-country col-lg-12 col-sm-12 lang">
              <div class="col-lg-12 col-sm-12">
                <h4 style="text-align:center;">Select Country<span class="text-danger">*</span>:</h4>
                <div class="mt-1 q-box__question"> 
                       <select class="selectpicker changeLang" name="country"
                          id="country">
                          <option class="label-gray-3" value="">Select Country<i class="fas fa-globe-asia"></i></option>
                          @foreach($country as $con=> $c)
                          <option value="{{$c->name}}">{{$c->name}}</option>
                          @endforeach
                        </select>
                </div>
                <div id="q-box__buttons"> 
                  <button id="submit-btn" class="lang-click" type="button">Continue</button>
                </div>
              </div>
           </div>

           <!-- end country -->

           <!-- term & conditions -->
            <div class="lang-content d-none">
                  <h1>
                    Complete online surveys & earn money
                  </h1>
                  <h3>
                    Sign up for free, participate in paid surveys and make money online without leaving your home.
                  </h3>


                  <h5>
                    We care about your privacy
                  </h5>
                  <h6>
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

                    <button class="lang-cond" id="submit-btn" type="button" disabled>Continue</button>


                  </div>
            </div>
           <!-- end term & conditions -->

           <!-- personal Details -->
            <div class="lang lang-personal d-none">
               <h4>Provide us with your personal information:</h4>
               <div class="mt-1">
                  <label class="form-label">First Name:</label> 
                  <input class="form-control lang-cal" id="full_name" name="fname" type="text" pattern="[a-zA-Z]+">
               </div>
               <div class="mt-1">
                  <label class="form-label">Last Name:</label> 
                  <input class="form-control lang-cal1" id="last_name" name="lname" type="text">
               </div>
               <div class="mt-2">
                  <label class="form-label">Email:</label> 
                  <input class="form-control lang-cal2" id="email" name="email" type="email" required pattern="[^@]+@[^@]+\.[com]{3,6}">
               </div>
               <div class="mt-2">
                  <label class="form-label">Phone / Mobile Number:</label> 
                  <input class="form-control lang-cal3" id="phone" name="phone" type="number" name="phone" minlength="9" minlength="10">
               </div>
               <div class="mt-2">
                  <label class="form-label">Address:</label> 
                  <input class="form-control lang-cal4" id="address" name="address" type="text">
               </div>
               <div class="mt-2">
                  <div class="">
                     <label class="form-label">Zip Code:</label>
                     <div class="input-container">
                        <input class="form-control lang-cal5" id="age" name="zipcode" type="number">
                     </div>
                </div>
               </div>
               <div id="q-box__buttons"> 
                  <button id="submit-btn" class="sub-personal" type="button">Continue</button>
               </div>
            </div>
            <!-- end personal Details -->

            <!-- question-1 -->
            <div class="lang lang-first-que d-none">
               <h4>1.Q How would you characterize the place where you live?</h4>
               <div class="form-check ps-0 q-box">
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_1" name="que_1" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_1">URBAN</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_2" name="que_1" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_2">SUB URBAN</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_3" name="que_1" type="radio" value="3"> 
                     <label class="form-check-label question__label" for="q_3">RURAL</label>
                  </div>
               </div>
               <div id="q-box__buttons"> 
                  <button id="prev-btn" class="lang-prev-1" type="button">Prev</button> 
                  <button id="next-btn" class="lang-que-1" type="button">Next</button>
               </div>
            </div>
            <!-- question-1 -->

            <!-- question-2 -->
            <div class="lang lang-second-que d-none">
               <h4>2.Q What type of research (except online surveys) are you interested to be invited to participate in? (Additional incentives are paid)?</h4>
                  <div class="q-box__question">
                        <select class="selectpicker" id="ques_2" multiple aria-label="Default select example" data-live-search="true" data-selected-text-format="count>1" name="que_2[]">
                              <option class="ans-2" value="1">  Focus group studies</option>
                              <option class="ans-2" value="2"> Inhome testing of new products</option>
                              <option class="ans-2" value="3">  Webcamera studies</option>
                              <option class="ans-2" value="4"> Online bulletin boards/diaries</option>
                              <option class="ans-2" value="5"> Phone surveys</option>
                              <option class="ans-2" value="6"> SMS / WhatsApp surveys</option>
                              <option class="ans-2" value="7"> Mobile usage studies / Mobile phone surveys</option>
                              <option class="ans-2" value="8">  Food/wine tasting</option>
                              <option class="ans-2" value="9"> None of the above</option>
                              <option class="ans-2" value="10">  Prefer not to say</option>
                        </select>
                  </div>
                 
                  <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-2" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-2" type="button">Next</button>
                  </div>

            </div>
            <!-- question-2 -->

            <!-- question-3 -->
            <div class="lang lang-third-que d-none">
               <h4>Q.3 Does the computer you primarily use to interact with research studies have a web camera?</h4>
               <div class="form-check ps-0 q-box">
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_3_1" name="que_3" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_3_1">Yes</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_3_2" name="que_3" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_3_2">No</label>
                  </div>
               </div>
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-3" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-3" type="button">Next</button>
               </div>

            </div>
            <!-- question-3 -->

            <!-- question-4 -->
            <div class="lang lang-four-que d-none">
               <h4>Q.4 Would you be willing to participate in a research study that reads your facial expressions to analyse emotional response? The data is fully anonymous and would be used for research purposes only.</h4>
               <div class="form-check ps-0 q-box">
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_4_1" name="que_4" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_4_1">Yes</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_4_2" name="que_4" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_4_2">No</label>
                  </div>
               </div>
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-4" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-4" type="button">Next</button>
               </div>

            </div>
            <!-- question-4 -->

            <!-- question-5 -->
            <div class="lang lang-five-que d-none">
               <h4>Q.5   Do you agree to opt-in and participate in types of research that may require you to download an application (on mobile, PC or tablet) that will track your online behaviour?</h4>
               <div class="form-check ps-0 q-box">
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_5_1" name="que_5" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_5_1">Yes</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_5_2" name="que_5" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_5_2">No</label>
                  </div>
               </div>
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-5" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-5" type="button">Next</button>
               </div>

            </div>
            <!-- question-5 -->

            <!-- question-6 -->
            <div class="lang lang-six-que d-none">
               <h4>Q.6 Do you agree to opt-in and participate in types of research that may require cookies to be dropped onto your Mobile/PC/Tablet that will track your exposure to certain advertising?</h4>
               <div class="form-check ps-0 q-box">
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_6_1" name="que_6" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_6_1">Yes</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_6_2" name="que_6" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_6_2">No</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_6_3" name="que_6" type="radio" value="3"> 
                     <label class="form-check-label question__label" for="q_6_3">Next</label>
                  </div>
               </div>
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-6" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-6" type="button">Next</button>
               </div>

            </div>

            <!-- question-6 -->

            <!-- question-7 -->
            <div class="lang lang-seven-que d-none">
               <h4>Q.7 What is your highest level of education?</h4>
               <div class="form-check ps-0 q-box">
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_7_1" name="que_7" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_7_1">Illiterate</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_7_2" name="que_7" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_7_2">Literate but no formal schooling</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_7_3" name="que_7" type="radio" value="3"> 
                     <label class="form-check-label question__label" for="q_7_3">School - up to 4 years</label>
                  </div>

                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_7_4" name="que_7" type="radio" value="4"> 
                     <label class="form-check-label question__label" for="q_7_4">School - 5 to 9 years</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_7_5" name="que_7" type="radio" value="5"> 
                     <label class="form-check-label question__label" for="q_7_5">SSC / HSC</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_7_6" name="que_7" type="radio" value="6"> 
                     <label class="form-check-label question__label" for="q_7_6">Some College but not graduate</label>
                  </div>

                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_7_7" name="que_7" type="radio" value="7"> 
                     <label class="form-check-label question__label" for="q_7_7">Graduate / Post Graduate - General</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_7_8" name="que_7" type="radio" value="8"> 
                     <label class="form-check-label question__label" for="q_7_8">Graduate / Post Graduate - Professional</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_7_9" name="que_7" type="radio" value="9"> 
                     <label class="form-check-label question__label" for="q_7_9">PhD</label>
                  </div>

                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_7_10" name="que_7" type="radio" value="10"> 
                     <label class="form-check-label question__label" for="q_7_10">Masters/Post-Graduate</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_7_11" name="que_7" type="radio" value="11"> 
                     <label class="form-check-label question__label" for="q_7_11">MBA</label>
                  </div>
                 
               </div>
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-7" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-7" type="button">Next</button>
               </div>

            </div>
            <!-- question-7 -->

            <!-- question-8 -->
            <div class="lang lang-eight-que d-none">
               <h4>Q.8 What year will/did you graduate from university/college?</h4>
               <div class="col-md-12">
                <div class="q-box__question">
                      <select class="selectpicker" id="ques_8" name="que_8">
                          <option value="" disabled selected>Nothing Selected</option>
                          @foreach($answers_9 as $k_9=> $ans_9)
                            <option value="{{$k_9}}">{{$ans_9}}</option>
                            @endforeach
                      </select>
                </div>
               </div>
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-8" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-8" type="button">Next</button>
               </div>

            </div>
            <!-- question-8 -->
            
             <!-- question-9 -->
             <div class="lang lang-nine-que d-none">
               <h4>Q.9 On average, how many hours of television do you watch per week?</h4>
               <div class="col-md-12">
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_9_1" name="que_9" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_9_1">I don t watch TV</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_9_2" name="que_9" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_9_2">5 hours or less</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_9_3" name="que_9" type="radio" value="3"> 
                     <label class="form-check-label question__label" for="q_9_3">6 to 10 hours</label>
                  </div>

                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_9_4" name="que_9" type="radio" value="4"> 
                     <label class="form-check-label question__label" for="q_9_4">11 to 20 hours</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_9_5" name="que_9" type="radio" value="5"> 
                     <label class="form-check-label question__label" for="q_9_5">More than 20 hours</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_9_6" name="que_9" type="radio" value="6"> 
                     <label class="form-check-label question__label" for="q_9_6">Prefer not to say</label>
                  </div>
               </div>
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-9" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-9" type="button">Next</button>
               </div>

             </div>
             <!-- question-9 -->

             <!-- question-10 -->
             <div class="lang lang-ten-que d-none">
               <h4>Q.10 Do you smoke?</h4>
               <div class="col-md-12">
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_10_1" name="que_10" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_10_1">Yes, I smoke</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_10_2" name="que_10" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_10_2">Yes, I smoke now and then</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_10_3" name="que_10" type="radio" value="3"> 
                     <label class="form-check-label question__label" for="q_10_3">Yes, I smoke but I m planning to quit</label>
                  </div>

                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_10_4" name="que_10" type="radio" value="4"> 
                     <label class="form-check-label question__label" for="q_10_4">No, I have quit</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_10_5" name="que_10" type="radio" value="5"> 
                     <label class="form-check-label question__label" for="q_10_5">No, I don’t smoke</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_10_6" name="que_10" type="radio" value="6"> 
                     <label class="form-check-label question__label" for="q_10_6">No, I don’t smoke, but use other tobacco products</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_10_7" name="que_10" type="radio" value="7"> 
                     <label class="form-check-label question__label" for="q_10_7">Prefer not to say</label>
                  </div>
               </div>
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-10" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-10" type="button">Next</button>
               </div>

             </div>
             <!-- question-10 -->

              <!-- question-11 -->
            <div class="lang lang-eleven-que d-none">
               <h4>Q.11 What brand of cigarettes do you smoke?</h4>
                  <div class="q-box__question">
                        <select class="selectpicker" id="ques_11" multiple aria-label="Default select example" data-live-search="true"  data-selected-text-format="count>1" name="que_11[]">
                            @foreach($answers_11 as $k=> $ans_11)
                              <option value="{{$k}}">{{$ans_11}}</option>
                            @endforeach
                        </select>
                  </div>
                 
                  <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-11" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-11" type="button">Next</button>
                  </div>

            </div>
            <!-- question-11 -->

              <!-- question-12 -->
              <div class="lang lang-twelve-que d-none">
               <h4>Q.12 On average, how many cigarettes do you smoke in a day?</h4>
               <div class="col-md-12">
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_12_1" name="que_12" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_12_1">I dont smoke cigarettes</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_12_2" name="que_12" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_12_2">1 to 3 cigarettes</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_12_3" name="que_12" type="radio" value="3"> 
                     <label class="form-check-label question__label" for="q_12_3">4 to 6 cigarettes</label>
                  </div>

                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_12_4" name="que_12" type="radio" value="4"> 
                     <label class="form-check-label question__label" for="q_12_4">7 to 10 cigarettes</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_12_5" name="que_12" type="radio" value="5"> 
                     <label class="form-check-label question__label" for="q_12_5">More than 10 cigarettes</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_12_6" name="que_12" type="radio" value="6"> 
                     <label class="form-check-label question__label" for="q_12_6">Prefer not to say</label>
                  </div>
               </div>
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-12" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-12" type="button">Next</button>
               </div>

              </div>
              <!-- question-12 -->

               <!-- question-13 -->
               <div class="lang lang-thirteen-que d-none">
                 <h4>Q.13 Do you have access to a car?</h4>
                 <div class="col-md-12">
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_13_1" name="que_13" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_13_1">I own a car/cars</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_13_2" name="que_13" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_13_2">I lease/have a company car</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_13_3" name="que_13" type="radio" value="3"> 
                     <label class="form-check-label question__label" for="q_13_3">I have access to a car/cars</label>
                  </div>

                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_13_4" name="que_13" type="radio" value="4"> 
                     <label class="form-check-label question__label" for="q_13_4">No, I dont have access to a car</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_13_5" name="que_13" type="radio" value="5"> 
                     <label class="form-check-label question__label" for="q_13_5">Prefer not to say</label>
                  </div>
                 </div>
                 <div id="q-box__buttons"> 
                      <button id="prev-btn" class="lang-prev-13" type="button">Prev</button> 
                      <button id="next-btn" class="lang-que-13" type="button">Next</button>
                 </div>

               </div>
               <!-- question-13 -->

               <!-- question-14 -->
               <div class="lang lang-fourteen-que d-none">
                 <h4>Q.14 Are you the primary decision maker in your household for automotive-related purchases?</h4>
                 <div class="col-md-12">
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_14_1" name="que_14" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_14_1">Yes</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_14_2" name="que_14" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_14_2">No</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_14_3" name="que_14" type="radio" value="3"> 
                     <label class="form-check-label question__label" for="q_14_3">I contribute equally in automotive decision</label>
                  </div>

                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_14_4" name="que_14" type="radio" value="4"> 
                     <label class="form-check-label question__label" for="q_14_4">Prefer not to say</label>
                  </div>
                 </div>
                 <div id="q-box__buttons"> 
                      <button id="prev-btn" class="lang-prev-14" type="button">Prev</button> 
                      <button id="next-btn" class="lang-que-14" type="button">Next</button>
                 </div>

               </div>
               <!-- question-14 -->

               <!-- question-15 -->
               <div class="lang lang-fifteen-que d-none">
                 <h4>Q.15 How many cars are there in your household (including leasing or company cars)?</h4>
                 <div class="col-md-12">
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_15_1" name="que_15" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_15_1">1</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_15_2" name="que_15" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_15_2">2</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_15_3" name="que_15" type="radio" value="3"> 
                     <label class="form-check-label question__label" for="q_15_3">3</label>
                  </div>

                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_15_4" name="que_15" type="radio" value="4"> 
                     <label class="form-check-label question__label" for="q_15_4">4</label>
                  </div>
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_15_5" name="que_15" type="radio" value="5"> 
                     <label class="form-check-label question__label" for="q_15_5">OR MORE</label>
                  </div>
                 </div>
                 <div id="q-box__buttons"> 
                      <button id="prev-btn" class="lang-prev-15" type="button">Prev</button> 
                      <button id="next-btn" class="lang-que-15" type="button">Next</button>
                 </div>

               </div>
               <!-- question-15 -->

                <!-- question-16 -->
                <div class="lang lang-sixteen-que d-none">
                 <h4>Q.16 If you own/lease a car(s), which brand are they?</h4>
                 <div class="q-box__question">
                        <select class="selectpicker" id="ques_16" multiple aria-label="Default select example" data-live-search="true" data-selected-text-format="count>1"  name="que_16[]">
                            @foreach($answers_16 as $k=> $ans_16)
                              <option value="{{$k}}">{{$ans_16}}</option>
                            @endforeach
                        </select>
                  </div>
                 <div id="q-box__buttons"> 
                      <button id="prev-btn" class="lang-prev-16" type="button">Prev</button> 
                      <button id="next-btn" class="lang-que-16" type="button">Next</button>
                 </div>

                </div>
               <!-- question-16 -->

                <!-- question-17 -->
                <div class="lang lang-seventeen-que d-none">
                 <h4>Q.17 How would you describe the car(s) you own/lease?</h4>
                 <div class="q-box__question">
                        <select class="selectpicker" id="ques_17" multiple aria-label="Default select example" data-live-search="true" data-selected-text-format="count>1" name="que_17[]">
                            @foreach($answers_17 as $k=> $ans_17)
                              <option value="{{$k}}">{{$ans_17}}</option>
                            @endforeach
                        </select>
                  </div>
                 <div id="q-box__buttons"> 
                      <button id="prev-btn" class="lang-prev-17" type="button">Prev</button> 
                      <button id="next-btn" class="lang-que-17" type="button">Next</button>
                 </div>

                </div>
               <!-- question-17 -->

               <!-- question-18 -->
               <div class="lang lang-eighteen-que d-none">
                 <h4>Q.18 What year was your main car (owned or leased) manufactured?</h4>
                 <div class="q-box__question">
                        <select class="selectpicker" id="ques_18" aria-label="Default select example" data-live-search="true" name="que_18">
                           <option value="" disabled selected>Nothing Selected</option>
                            @foreach($answers_18 as $k=> $ans_18)
                              <option value="{{$k}}">{{$ans_18}}</option>
                            @endforeach
                        </select>
                  </div>
                 <div id="q-box__buttons"> 
                      <button id="prev-btn" class="lang-prev-18" type="button">Prev</button> 
                      <button id="next-btn" class="lang-que-18" type="button">Next</button>
                 </div>

               </div>
               <!-- question-18 -->

               <!-- question-19 -->
                <div class="lang lang-nineteen-que d-none">
                   <h4>Q.19 Do you own a motorcycle</h4>
                   <div class="form-check ps-0 q-box">
                      <div class="q-box__question">
                         <input class="form-check-input question__input" id="q_19_1" name="que_19" type="radio" value="1"> 
                         <label class="form-check-label question__label" for="q_19_1">Yes</label>
                      </div>
                      <div class="q-box__question">
                         <input  class="form-check-input question__input" id="q_19_2" name="que_19" type="radio" value="2"> 
                         <label class="form-check-label question__label" for="q_19_2">No</label>
                      </div>
                   </div>
                   <div id="q-box__buttons"> 
                        <button id="prev-btn" class="lang-prev-19" type="button">Prev</button> 
                        <button id="next-btn" class="lang-que-19" type="button">Next</button>
                   </div>

                </div>
              <!-- question-19 -->

              <!-- question-20 -->
              <div class="lang lang-twenty-que d-none">
                 <h4>Q.20 If you own a two wheeled vehicle, which brand are they?</h4>
                 <div class="q-box__question">
                        <select class="selectpicker" id="ques_20" multiple aria-label="Default select example" data-live-search="true" data-selected-text-format="count>1" name="que_20[]">
                            @foreach($answers_20 as $k=> $ans_20)
                              <option value="{{$k}}">{{$ans_20}}</option>
                            @endforeach
                        </select>
                  </div>
                 <div id="q-box__buttons"> 
                      <button id="prev-btn" class="lang-prev-20" type="button">Prev</button> 
                      <button id="next-btn" class="lang-que-20" type="button">Next</button>
                 </div>

               </div>
              <!-- question-20 -->
              
               <!-- question-21 -->
               <div class="lang lang-twenty-one-que d-none">
                 <h4> Q.21 If you own a two wheeled vehicle, what engine capacity does it have?</h4>
                 <div class="col-md-12">
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_21_1" name="que_21" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_21_1">Less than 100 CC</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_21_2" name="que_21" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_21_2">100-149 CC</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_21_3" name="que_21" type="radio" value="3"> 
                     <label class="form-check-label question__label" for="q_21_3">150-199 CC</label>
                  </div>

                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_21_4" name="que_21" type="radio" value="4"> 
                     <label class="form-check-label question__label" for="q_21_4">200 CC+</label>
                  </div>
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_21_5" name="que_21" type="radio" value="5"> 
                     <label class="form-check-label question__label" for="q_21_5">I don’t own a two wheeled vehicle</label>
                  </div>
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_21_6" name="que_21" type="radio" value="6"> 
                     <label class="form-check-label question__label" for="q_21_6">Prefer not to say</label>
                  </div>
                 </div>
                 <div id="q-box__buttons"> 
                      <button id="prev-btn" class="lang-prev-21" type="button">Prev</button> 
                      <button id="next-btn" class="lang-que-21" type="button">Next</button>
                 </div>

               </div>
               <!-- question-21 -->

               <!-- question-22 -->
               <div class="lang lang-twenty-two-que d-none">
                 <h4>Q.22 If you own a two wheeled vehicle, how would you describe it?</h4>
                 <div class="row">
                   <div class="col-md-6">
                  <div class="q-box__question ">
                     <input class="form-check-input question__input" id="q_22_1" name="que_22" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_22_1">I don’t own a two wheeled vehicle</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_22_2" name="que_22" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_22_2">Standard</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_22_3" name="que_22" type="radio" value="3"> 
                     <label class="form-check-label question__label" for="q_22_3">Cruiser</label>
                  </div>

                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_22_4" name="que_22" type="radio" value="4"> 
                     <label class="form-check-label question__label" for="q_22_4">Sports bike</label>
                  </div>
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_22_5" name="que_22" type="radio" value="5"> 
                     <label class="form-check-label question__label" for="q_22_5">Touring</label>
                  </div>
                   </div>
                   <div class="col-md-6">
                  <div class="q-box__question ">
                     <input class="form-check-input question__input" id="q_22_6" name="que_22" type="radio" value="6"> 
                     <label class="form-check-label question__label" for="q_22_6">Sports touring</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_22_7" name="que_22" type="radio" value="7"> 
                     <label class="form-check-label question__label" for="q_22_7">Dual-sport</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_22_8" name="que_22" type="radio" value="8"> 
                     <label class="form-check-label question__label" for="q_22_8">Scooter, underbone or moped</label>
                  </div>

                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_22_9" name="que_22" type="radio" value="9"> 
                     <label class="form-check-label question__label" for="q_22_9">Other</label>
                  </div>
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_22_10" name="que_22" type="radio" value="10"> 
                     <label class="form-check-label question__label" for="q_22_10">Prefer not to say</label>
                  </div>
                   </div>
                 </div>
                 <div id="q-box__buttons"> 
                      <button id="prev-btn" class="lang-prev-22" type="button">Prev</button> 
                      <button id="next-btn" class="lang-que-22" type="button">Next</button>
                 </div>

               </div>
               <!-- question-22 -->

              <!-- question-23 -->
              <div class="lang lang-twenty-three-que d-none">
               <h4>Q.23 If you own/lease a car(s), what fuel do they use</h4>
               <div class="col-md-12">
                <div class="q-box__question">
                      <select class="selectpicker" id="ques_23" name="que_23">
                          <option value="" disabled selected>Nothing Selected</option>
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
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-23" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-23" type="button">Next</button>
               </div>

              </div>
              <!-- question-23 -->

              <!-- question 24-->
              <div class="lang lang-twenty-four-que d-none">
                 <h4>Q.24 Are you considering buying or leasing a new or used car within the next 2 years?</h4>
                 <div class="col-md-12">
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_24_1" name="que_24" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_24_1">No, I m not considering it</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_24_2" name="que_24" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_24_2">Yes, I m considering buying or leasing a used car</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_24_3" name="que_24" type="radio" value="3"> 
                     <label class="form-check-label question__label" for="q_24_3">Yes, Im considering buying or leasing a new car</label>
                  </div>

                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_24_4" name="que_24" type="radio" value="4"> 
                     <label class="form-check-label question__label" for="q_24_4">Yes, but unsure if the car will be used or new</label>
                  </div>
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_24_5" name="que_24" type="radio" value="5"> 
                     <label class="form-check-label question__label" for="q_24_5">I do not know</label>
                  </div>
                 </div>
                 <div id="q-box__buttons"> 
                      <button id="prev-btn" class="lang-prev-24" type="button">Prev</button> 
                      <button id="next-btn" class="lang-que-24" type="button">Next</button>
                 </div>

              </div>
              <!-- question 24-->

              <!-- question-25 -->
              <div class="lang lang-twenty-five-que d-none">
               <h4>Q.25 What is your current occupational status?</h4>
               <div class="col-md-12">
                <div class="q-box__question">
                      <select class="selectpicker" id="ques_25" name="que_25">
                                   <option value="" disabled selected>Nothing Selected</option>
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
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-25" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-25" type="button">Next</button>
               </div>

              </div>
              <!-- question-25 -->

              <!-- question-26 -->
              <div class="lang lang-twenty-six-que d-none">
               <h4>Q.26 What is your occupation?</h4>
               <div class="col-md-12">
                <div class="q-box__question">
                      <select class="selectpicker" id="ques_26" name="que_26">
                              <option value="" disabled selected>Nothing Selected</option>
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
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-26" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-26" type="button">Next</button>
               </div>

              </div>
              <!-- question-26 -->

              <!-- question-27 -->
              <div class="lang lang-twenty-seven-que d-none">
               <h4>Q.27 Which of the following categories best describes your organisation's primary industry?</h4>
               <div class="col-md-12">
                <div class="q-box__question">
                      <select class="selectpicker" id="ques_27" name="que_27">
                              <option value="" disabled selected>Nothing Selected</option>
                              @foreach($answers_27 as $k_27 => $ans_27)
                               <option value="{{$k_27}}">{{$ans_27}}	</option>
                              @endforeach			
                      </select>
                </div>
               </div>
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-27" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-27" type="button">Next</button>
               </div>

              </div>
              <!-- question-27 -->

              <!-- question-28 -->
              <div class="lang lang-twenty-eight-que d-none">
               <h4>Q.28  Approximately how many employees work at your organisation (all locations)?</h4>
               <div class="col-md-12">
                <div class="q-box__question">
                      <select class="selectpicker" id="ques_28" name="que_28">
                              <option value="" disabled selected>Nothing Selected</option>
                              <option value="1">1-10</option>
                              <option value='2'>10-25</option>
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
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-28" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-28" type="button">Next</button>
               </div>

              </div>
              <!-- question-28 -->

              <!-- question-29 -->
              <div class="lang lang-twenty-nine-que d-none">
               <h4>Q.29  Which department do you primarily work within at your organisation?</h4>
               <div class="col-md-12">
                <div class="q-box__question">
                      <select class="selectpicker" id="ques_29" name="que_29">
                              <option value="" disabled selected>Nothing Selected</option>
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
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-29" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-29" type="button">Next</button>
               </div>

              </div>
              <!-- question-29 -->

              <!-- question-30 -->
              <div class="lang lang-thirty-que d-none">
               <h4>Q.30  If you work in your organisation's IT department, please provide more detail about your role.</h4>
               <div class="col-md-12">
                <div class="q-box__question">
                      <select class="selectpicker" id="ques_30" name="que_30">
                              <option value="" disabled selected>Nothing Selected</option>
                              @foreach($answers_30 as $k_30 => $ans_30)
                               <option value="{{$k_30}}">{{$ans_30}}	</option>
                              @endforeach			
                      </select>
                </div>
               </div>
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-30" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-30" type="button">Next</button>
               </div>

              </div>
              <!-- question-30 -->

              <!-- question-31 -->
              <div class="lang lang-thirty-one-que d-none">
               <h4>Q.31  What is your primary role in your organisation?</h4>
               <div class="col-md-12">
                <div class="q-box__question">
                      <select class="selectpicker" id="ques_31" name="que_31">
                              <option value="" disabled selected>Nothing Selected</option>
                              @foreach($answers_31 as $k_31 => $ans_31)
                               <option value="{{$k_31}}">{{$ans_31}}</option>
                              @endforeach 			
                      </select>
                </div>
               </div>
               <div id="q-box__buttons"> 
                    <button id="prev-btn" class="lang-prev-31" type="button">Prev</button> 
                    <button id="next-btn" class="lang-que-31" type="button">Next</button>
               </div>

              </div>
              <!-- question-31 -->

              <!-- question-32 -->
              <div class="lang lang-thirty-two-que d-none">
                 <h4>Q.32  What is your professional position in the organisation you work for?</h4>
                 <div class="col-md-12">
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_32_1" name="que_32" type="radio" value="1"> 
                     <label class="form-check-label question__label" for="q_32_1">Director/Manager</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_32_2" name="que_32" type="radio" value="2"> 
                     <label class="form-check-label question__label" for="q_32_2">Not a managing position</label>
                  </div>
                  <div class="q-box__question">
                     <input  class="form-check-input question__input" id="q_32_3" name="que_32" type="radio" value="3"> 
                     <label class="form-check-label question__label" for="q_32_3">Other decision maker</label>
                  </div>

                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_32_4" name="que_32" type="radio" value="4"> 
                     <label class="form-check-label question__label" for="q_32_4">I don't work</label>
                  </div>
                  <div class="q-box__question">
                     <input class="form-check-input question__input" id="q_32_5" name="que_32" type="radio" value="5"> 
                     <label class="form-check-label question__label" for="q_32_5">Prefer not to say</label>
                  </div>
                 </div>
                 <div id="q-box__buttons"> 
                      <button id="prev-btn" class="lang-prev-32" type="button">Prev</button> 
                      <button id="next-btn" class="lang-que-32" type="button">Next</button>
                 </div>

              </div>
              <!-- question-32 -->

               <!-- question-33-->
               <div class="lang lang-thirty-three-que d-none">
                 <h4>Q.33  Have you been diagnosed with any of the following illnesses/conditions? Note that the information will be kept in strictest confidence.</h4>
                 <div class="col-md-12">
                  <div class="q-box__question">
                      <select class="selectpicker" id="ques_33" name="que_33[]" multiple aria-label="Default select example" data-live-search="true" data-selected-text-format="count>1">
                              @foreach($answers_33 as $k_33=> $ans_33)
                               <option value="{{$k_33}}">{{$ans_33}}</option>
                              @endforeach 			
                      </select>
                  </div>
                 </div>
                 <div id="q-box__buttons"> 
                      <button id="prev-btn" class="lang-prev-33" type="button">Prev</button> 
                      <button id="next-btn" class="lang-que-33" type="button">Next</button>
                 </div>

               </div>
               <!-- question-33-->

               <!-- question-34-->
               <div class="lang lang-thirty-four-que d-none">
                 <h4>Q.34  If you stated that you have been diagnosed with cancer, can you define the type of cancer?</h4>
                 <div class="col-md-12">
                <div class="q-box__question">
                      <select class="selectpicker" id="ques_34" name="que_34">
                              <option value="" disabled selected>Nothing Selected</option> 			
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
                 <div id="q-box__buttons"> 
                      <button id="prev-btn" class="lang-prev-34" type="button">Prev</button> 
                      <button id="next-btn" class="lang-que-34" type="button">Next</button>
                 </div>

               </div>
               <!-- question-34-->

               <!-- question-35-->
               <div class="lang lang-thirty-five-que d-none">
                 <h4>Q.35  If you stated that you have been diagnosed with diabetes, can you define the type of diabetes?</h4>
                 <div class="col-md-12">
                <div class="q-box__question">
                      <select class="selectpicker" id="ques_35" name="que_35">
                              <option value="" disabled selected>Nothing Selected</option> 	
                              <option value="1">Diabetes Type 1</option>
                              <option value="2">Diabetes Type 2</option>
                              <option value="3">Diabetes Type 3	</option>
                              <option value="4">I don't have diabetes	</option>
                              <option value="5">Prefer not to say</option>		
                      </select>
                </div>
                 </div>
                 <div id="q-box__buttons"> 
                      <button id="prev-btn" class="lang-prev-35" type="button">Prev</button> 
                      <button id="next-btn" class="lang-que-35" type="button">Next</button>
                 </div>

               </div>
               <!-- question-35-->

               <!-- question-36-->
               <div class="lang lang-thirty-six-que d-none">
                 <h4>Q.36  Do you use glasses or contact lenses?</h4>
                 <div class="col-md-12">
                <div class="q-box__question">
                      <select class="selectpicker" id="ques_36" name="que_36">
                              <option value="" disabled selected>Nothing Selected</option> 	
                              <option value="1">Glasses</option>
                              <option value="2">Contact lenses</option>
                              <option value="3">Diabetes Type 3	</option>
                              <option value="4">Both Glasses and Contact lenses</option>
                              <option value="5">I don't use Glasses/Contact lenses</option>	
                              <option value="6">Prefer not to say</option>	
                      </select>
                </div>
                 </div>
                 <div id="q-box__buttons"> 
                      <button id="prev-btn" class="lang-prev-36" type="button">Prev</button> 
                      <button id="next-btn" class="lang-que-36" type="button">Next</button>
                 </div>

               </div>
               <!-- question-36-->

               <!-- question-37-->
               <div class="lang lang-thirty-seven-que d-none">
                  <h4>Q.37  Do you use a hearing aid?</h4>
                  <div class="form-check ps-0 q-box">
                    <div class="q-box__question">
                       <input class="form-check-input question__input" id="q_37_1" name="que_37" type="radio" value="1"> 
                       <label class="form-check-label question__label" for="q_37_1">Yes</label>
                    </div>
                    <div class="q-box__question">
                       <input  class="form-check-input question__input" id="q_37_2" name="que_37" type="radio" value="2"> 
                       <label class="form-check-label question__label" for="q_37_2">No</label>
                    </div>
                  </div>
                  <div id="q-box__buttons"> 
                  <button id="prev-btn" class="lang-prev-37" type="button">Prev</button> 
                  <button id="next-btn" class="lang-que-37 form_submit" type="button" value="submit">Save</button>
                  </div>
              </div>
               <!-- question-37-->

             <div id="success" class="lang-success d-none">
               <div class="mt-5">
                  <h4>Thank you for registering with us! </h4>
                  <p>You will receive the activation link on your registered email address.</p>
                  <!--<a class="back-link" href="">Go back from the beginning ➜</a>-->
               </div>
             </div>
               


         </div>
      </form>
     </div>
    </div>


  </div>
</div>
<!-- END CONTAINER -->

<!-- loader -->
 <div id="preloader-wrapper">
   <div id="preloader"></div>
   <div class="preloader-section section-left"></div>
   <div class="preloader-section section-right"></div>
 </div>
<!-- end loader -->


<script>
    $(".lang-click").click(function () {
      if($('#country').val()!=''){
        toastr.clear();
        $('.main-country').addClass('d-none');
        $('.lang-content').removeClass('d-none');
      }
      else{
        toastr.warning('Please Select Country!' ,{
                        closeButton: true,
                    });
      }
    });

    $(".lang-cond").click(function () {
      $('.main-country').addClass('d-none');
      $('.lang-content').addClass('d-none');
      $('.lang-personal').removeClass('d-none');
    });

    $('.sub-personal').click(function () {
      if(($('.lang-cal').val()!='' && $('.lang-cal1').val()!='' && $('.lang-cal2').val()!='' && $('.lang-cal3').val()!='' && $('.lang-cal4').val()!='' && $('.lang-cal5').val()!='' )){
       if($('.form-control').hasClass("error")){
           toastr.warning('Please Fill Correct Values!' ,{
                        closeButton: true,
                    });
       }
       else{
        toastr.clear();
        $('.progress-bar').width(50);
        $('.lang-personal').addClass('d-none')
        $('.lang-first-que').removeClass('d-none');
       }
      }
      else{
        toastr.warning('Please Fill All Fields!' ,{
                        closeButton: true,
                    });
      }
    });

    $('.lang-que-1').click(function () {
      if($("input:radio[name='que_1']").is(":checked")) {
        toastr.clear();
        $('.lang-first-que').addClass('d-none');
        $('.lang-second-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })

    $('.lang-que-2').click(function () {     
      if ($("#ques_2 option:selected").length > 0) {
        toastr.clear();
      $('.lang-second-que').addClass('d-none');
      $('.lang-third-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-3').click(function () {
      if($("input:radio[name='que_3']").is(":checked")) {
        toastr.clear();
        $('.lang-third-que').addClass('d-none');
        $('.lang-four-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-4').click(function () {
      if($("input:radio[name='que_4']").is(":checked")) {
        toastr.clear();
        $('.lang-four-que').addClass('d-none');
        $('.lang-five-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-5').click(function () {
      if($("input:radio[name='que_5']").is(":checked")) {
        toastr.clear();
        $('.progress-bar').width(75);
        $('.lang-five-que').addClass('d-none');
        $('.lang-six-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-6').click(function () {
      if($("input:radio[name='que_6']").is(":checked")) {
        toastr.clear();
        $('.lang-six-que').addClass('d-none');
        $('.lang-seven-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-7').click(function () {
      if($("input:radio[name='que_7']").is(":checked")) {
        toastr.clear();
        $('.lang-seven-que').addClass('d-none');
      $('.lang-eight-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-8').click(function () {
      if (($("#ques_8 option:selected").length > 0)) {
        if($("#ques_8 option:selected").val()!=''){
          console.log($("#ques_8").val());
        toastr.clear();
        $('.progress-bar').width(100);
        $('.lang-eight-que').addClass('d-none');
        $('.lang-nine-que').removeClass('d-none');
        }
        else{
        toastr.warning('Please Select Value!' ,{
                        closeButton: true,
                    });
      }
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-9').click(function () {
      if($("input:radio[name='que_9']").is(":checked")) {
        toastr.clear();
        $('.lang-nine-que').addClass('d-none');
        $('.lang-ten-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-10').click(function () {
      if($("input:radio[name='que_10']").is(":checked")) {
        toastr.clear();
        $('.progress-bar').width(200);
      $('.lang-ten-que').addClass('d-none');
      $('.lang-eleven-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-11').click(function () {
      if ($("#ques_11 option:selected").length > 0) {
        toastr.clear();
       $('.lang-eleven-que').addClass('d-none');
       $('.lang-twelve-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-12').click(function () {
      if($("input:radio[name='que_12']").is(":checked")) {
        toastr.clear();
        $('.lang-twelve-que').addClass('d-none');
        $('.lang-thirteen-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-13').click(function () {
      if($("input:radio[name='que_13']").is(":checked")) {
        toastr.clear();
        $('.lang-thirteen-que').addClass('d-none');
        $('.lang-fourteen-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-14').click(function () {
      if($("input:radio[name='que_14']").is(":checked")) {
        toastr.clear();
        $('.lang-fourteen-que').addClass('d-none');
        $('.lang-fifteen-que').removeClass('d-none');
      } 
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-15').click(function () {
      if($("input:radio[name='que_15']").is(":checked")) {
        toastr.clear();
        $('.progress-bar').width(250);
        $('.lang-fifteen-que').addClass('d-none');
        $('.lang-sixteen-que').removeClass('d-none');
      }  
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-16').click(function () {
      if ($("#ques_16 option:selected").length > 0) {
        toastr.clear();
        $('.lang-sixteen-que').addClass('d-none');
        $('.lang-seventeen-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-17').click(function () {
      if ($("#ques_17 option:selected").length > 0) {
        toastr.clear();
        $('.lang-seventeen-que').addClass('d-none');
        $('.lang-eighteen-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-18').click(function () {
      if (($("#ques_18 option:selected").length > 0)) {
        if($("#ques_18 option:selected").val()!=''){
          console.log($("#ques_18").val());
          $('.progress-bar').width(350);
          $('.lang-eighteen-que').addClass('d-none');
          $('.lang-nineteen-que').removeClass('d-none');
        }
        else{
          toastr.warning('Please Select Value!' ,{
                        closeButton: true,
                    });
        }
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-19').click(function () {
      if($("input:radio[name='que_19']").is(":checked")) {
        toastr.clear();
        $('.lang-nineteen-que').addClass('d-none');
        $('.lang-twenty-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-20').click(function () {
      if ($("#ques_20 option:selected").length > 0) {
        toastr.clear();
        $('.progress-bar').width(450);
        $('.lang-twenty-que').addClass('d-none');
        $('.lang-twenty-one-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-21').click(function () {
      if($("input:radio[name='que_21']").is(":checked")) {
        toastr.clear();
        $('.lang-twenty-one-que').addClass('d-none');
        $('.lang-twenty-two-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-22').click(function () {
      if($("input:radio[name='que_22']").is(":checked")) {
        toastr.clear();
        $('.lang-twenty-two-que').addClass('d-none');
        $('.lang-twenty-three-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-23').click(function () {
      if (($("#ques_23 option:selected").length > 0)) {
        if($("#ques_23 option:selected").val()!=''){
          toastr.clear();
          $('.progress-bar').width(490);
          $('.lang-twenty-three-que').addClass('d-none');
          $('.lang-twenty-four-que').removeClass('d-none');

        }
        else{
        toastr.warning('Please Select Value!' ,{
                        closeButton: true,
                    });
        }
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-24').click(function () {
      if($("input:radio[name='que_24']").is(":checked")) {
        toastr.clear();
        $('.lang-twenty-four-que').addClass('d-none');
        $('.lang-twenty-five-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-25').click(function () {
      if (($("#ques_25 option:selected").length > 0)) {
        if($("#ques_25 option:selected").val()!=''){
          toastr.clear();
          $('.progress-bar').width(500);
          $('.lang-twenty-five-que').addClass('d-none');
          $('.lang-twenty-six-que').removeClass('d-none');
        }
        else{
          toastr.warning('Please Select Value!' ,{
                          closeButton: true,
                      });
        }
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-26').click(function () {
      if (($("#ques_26 option:selected").length > 0)) {
        if($("#ques_26 option:selected").val()!=''){
           toastr.clear();
           $('.lang-twenty-six-que').addClass('d-none');
           $('.lang-twenty-seven-que').removeClass('d-none');
        }
        else{
        toastr.warning('Please Select Value!' ,{
                        closeButton: true,
                    });
        }
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-27').click(function () {
      if (($("#ques_27 option:selected").length > 0)) {
        if($("#ques_27 option:selected").val()!=''){
           toastr.clear();
           $('.progress-bar').width(510);
           $('.lang-twenty-seven-que').addClass('d-none');
           $('.lang-twenty-eight-que').removeClass('d-none');

        }
        else{
        toastr.warning('Please Select Value!' ,{
                        closeButton: true,
                    });
        }
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-28').click(function () {
      if (($("#ques_28 option:selected").length > 0)) {
        if($("#ques_28 option:selected").val()!=''){
           toastr.clear();
           $('.lang-twenty-eight-que').addClass('d-none');
           $('.lang-twenty-nine-que').removeClass('d-none');

        }
        else{
        toastr.warning('Please Select Value!' ,{
                        closeButton: true,
                    });
        }
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-29').click(function () {
      if (($("#ques_29 option:selected").length > 0)) {
        if($("#ques_29 option:selected").val()!=''){
           toastr.clear();
           $('.lang-twenty-nine-que').addClass('d-none');
           $('.lang-thirty-que').removeClass('d-none');

        }
        else{
        toastr.warning('Please Select Value!' ,{
                        closeButton: true,
                    });
        }
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-30').click(function () {
      if (($("#ques_30 option:selected").length > 0)) {
        if($("#ques_30 option:selected").val()!=''){
           toastr.clear();
           $('.progress-bar').width(520);
           $('.lang-thirty-que').addClass('d-none');
           $('.lang-thirty-one-que').removeClass('d-none');

        }
        else{
        toastr.warning('Please Select Value!' ,{
                        closeButton: true,
                    });
        }
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-31').click(function () {
      if (($("#ques_31 option:selected").length > 0)) {
        if($("#ques_31 option:selected").val()!=''){
           toastr.clear();
           $('.progress-bar').width(530);
           $('.lang-thirty-one-que').addClass('d-none');
           $('.lang-thirty-two-que').removeClass('d-none');

        }
        else{
        toastr.warning('Please Select Value!' ,{
                        closeButton: true,
                    });
        }
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-32').click(function () {
      if($("input:radio[name='que_32']").is(":checked")) {
        toastr.clear();
        $('.progress-bar').width(540);
        $('.lang-thirty-two-que').addClass('d-none');
        $('.lang-thirty-three-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Choose Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-33').click(function () {
      if ($("#ques_33 option:selected").length > 0) {
        toastr.clear();
        $('.progress-bar').width(550);
        $('.lang-thirty-three-que').addClass('d-none');
        $('.lang-thirty-four-que').removeClass('d-none');
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-34').click(function () {
      if (($("#ques_34 option:selected").length > 0)) {
        if($("#ques_34 option:selected").val()!=''){
           toastr.clear();
           $('.progress-bar').width(560);
           $('.lang-thirty-four-que').addClass('d-none');
           $('.lang-thirty-five-que').removeClass('d-none');

        }
        else{
        toastr.warning('Please Select Value!' ,{
                        closeButton: true,
                    });
        }
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-35').click(function () {
      if (($("#ques_35 option:selected").length > 0)) {
        if($("#ques_35 option:selected").val()!=''){
           toastr.clear();
           $('.progress-bar').width(570);
           $('.lang-thirty-five-que').addClass('d-none');
           $('.lang-thirty-six-que').removeClass('d-none');

        }
        else{
        toastr.warning('Please Select Value!' ,{
                        closeButton: true,
                    });
        }
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    $('.lang-que-36').click(function () {
      if (($("#ques_36 option:selected").length > 0)) {
        if($("#ques_36 option:selected").val()!=''){
           toastr.clear();
           $('.progress-bar').width(630);
           $('.lang-thirty-six-que').addClass('d-none');
           $('.lang-thirty-seven-que').removeClass('d-none');

        }
        else{
        toastr.warning('Please Select Value!' ,{
                        closeButton: true,
                    });
        }
      }
      else{
        toastr.warning('Please Select Option!' ,{
                        closeButton: true,
                    });
      }
    })
    // $('.lang-que-37').click(function () {
    //   console.log($("input:radio[name='que_37']").val());
    //   if($("input:radio[name='que_37']").is(":checked")) {
    //   if($("input:radio[name='que_37']").val()!=''){
    //     toastr.clear();
    //     $('.progress-bar').width(1000);
    //     }
    //     else{
    //       toastr.warning('Please Choose Option!' ,{
    //                     closeButton: true,
    //                 });
    //     }
    //   }
    //   else{
    //     toastr.warning('Please Choose Option!' ,{
    //                     closeButton: true,
    //                 });
    //   }
    // });


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
        // console.log('hii');
        console.log($(checkBox + ':checked').length);
        if ($(checkBox + ':checked').length > 7) {
          $('.lang-cond').removeAttr("disabled");
        } else {
          $('.lang-cond').attr("disabled", true);
        }

      })

    })


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


    $('.selectall').change(function() {
     if ($(this).is(':checked')) {
    //   console.log('hii');
         $('.duplicate input').attr('checked', true);
     } else {
         $('.duplicate input').attr('checked', false);
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
                // fname: { lettersonly: true }
            },
           
            
            submitHandler: function (form) {
                var data =new FormData(form);       
                
                
                $.ajax({
                  headers: {
                      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                  },
                   url:"{{route('new_register')}}",
                   type:"POST",
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
                  toastr.success('Saved Successfully' ,{
                        closeButton: true,
                    });
                        $('.progress-bar').width(1000);
                        $('.lang-thirty-seven-que').addClass('d-none');
                        $('.lang-success').removeClass('d-none');
                    // $("#otherFieldDiv").addClass('d-none');
                    // $("#send").removeClass();
                    
                 } 

                 if(data.validation = 0){
                   swal({
                            title:'Warning',
                            text:'This Email is already Used',
                            icon:'success',
                            buttons:false
                        })
                 }
                //  if(data.success == 2){
                //       swal({
                //             title:'Warning',
                //             text:'This Email is already Used',
                //             icon:'success',
                //             buttons:false
                //         })
                //  }
                 
                   }
               })  
            } 

        });
   

        $('.form_submit').click(function(){
          if($("input:radio[name='que_37']").is(":checked")) {
            console.log($("input:radio[name='que_37']").val());
              if($("input:radio[name='que_37']").val()!=''){
                console.log($("input:radio[name='que_37']").val());
               toastr.clear();
                 $('.progress-bar').width(1000);
                 $('#register').submit();
               }
               else{
                 toastr.warning('Please Choose Option!' ,{
                               closeButton: true,
                           });
               }
             }
             else{
               toastr.warning('Please Choose Option!' ,{
                               closeButton: true,
                           });
             }
        });
  
        $('#full_name').keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z]+$");
             var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
            return true;
            }
        
            e.preventDefault();
            return false;
        });
        
        $('#last_name').keypress(function (e) {
            var regex = new RegExp("^[a-zA-Z]+$");
             var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
            if (regex.test(str)) {
            return true;
            }
        
            e.preventDefault();
            return false;
        });
  </script>
</body>
</html>



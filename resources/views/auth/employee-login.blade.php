<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>arp</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../adminapp/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../adminapp/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../adminapp/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../adminapp/assets/images/favicon.ico" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>

      /*button*/
      button.btn.btn-block.btn-gradient-primary.btn-lg.font-weight-medium.auth-form-btn {
               background: #0b5dbb;
          }
          /*button end*/
          .content-wrapper {
    background: none;
          }
    .auth .auth-form-light {
    background: #ffffff;
    border-radius: 11px;
     }
    .eye_pass{
    float: right;
    margin-top: -33px;
    margin-right: 10px;
   }

          </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper" style="background-image: url('assets/images/login_1.jpg'); background-size: cover;">


        <div class="content-wrapper d-flex align-items-center auth " >
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">
                <div class="brand-logo d-flex justify-content-center">
                   <a href="/login">
                <img class="btMainLogo" style="width: 200px;" data-hw="1.7966666666667" src="www.asiaresearchpartners.com/adminapp/assets/images/logo-3.png" alt="Asia Research Partners LLP">
            </a>
                </div>
                <h4>Hello! let's get started</h4>
                <h6 class="font-weight-light">Sign in to continue.</h6>
                <form method="POST" class="pt-3" action="{{ route('employee.login') }}">
                     @csrf
                                <!-- Validation Errors -->
                  <x-auth-validation-errors class="mb-4" :errors="$errors" />
                  <div class="form-group">
                    <input id="email"  type="email" name="email" :value="old('email')" required autofocus  class="form-control form-control-lg" placeholder="Email">
                  </div>
                  <div class="form-group passwordfil">
                    <input id="password"  type="password" class="form-control form-control-lg"
                                name="password"
                                required autocomplete="current-password" placeholder="Password">
                                <span class="eye_pass"><i class="fa-regular fa-eye"></i><i class="fa-regular fa-eye-slash d-none"></i></span>
                  </div>
                  <div class="mt-3">
                    <button value="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn"> Log in</a>
                  </div>
                  <div class="my-2 d-flex justify-content-between align-items-center">
                    <div class="form-check">

                        <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                      Remember me</label>
                </label>
                    </div>
                    <a href="{{ route('password.request') }}" class="auth-link text-black">Forgot password?</a>
                  </div>

                  <!--<div class="text-center mt-4 font-weight-light"> Don't have an account?-->
                  <!--     <a href="{{ route('register') }}" class="text-primary">Create</a>-->
                  <!--</div>-->
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- content-wrapper ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        $(document).on('click', '.eye_pass', function() {
        var input = $("#password");
        if (input.attr("type") === "password") {
        $('.fa-regular.fa-eye-slash').removeClass('d-none');
        $('.fa-regular.fa-eye').addClass('d-none');
        input.attr("type", "text");
        } else {
       input.attr("type", "password");
       $('.fa-regular.fa-eye-slash').addClass('d-none');
       $('.fa-regular.fa-eye').removeClass('d-none');
       }
       });
    </script>
    <!-- plugins:js -->
    <script src="../../adminapp/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../adminapp/assets/js/off-canvas.js"></script>
    <script src="../../adminapp/assets/js/hoverable-collapse.js"></script>
    <script src="../../adminapp/assets/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>

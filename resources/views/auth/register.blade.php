

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>arp</title>
    <style>
    .brand-logo.d-flex.justify-content-center {
    margin-top: -19px;
    padding-top: -10px;
      }
      button.btn.btn-block.btn-gradient-primary.btn-lg.font-weight-medium.auth-form-btn {
               background: #0b5dbb;
          }
          .content-wrapper {
           background:none;
    
   }
         .text-primary {
    color: #ed1d25 !important;
    text-decoration:none;
}
a ..text-primary{
    text-decoration:none;

}
a:hover {
    color: #0056b3;
    text-decoration: none;
}
a.text-primary:hover, .list-wrapper .completed a.remove:hover, a.text-primary:focus, .list-wrapper .completed a.remove:focus {
    color: #0b5dbb !important;
    text-decoration: none;
}
   
 
   
;
}
</style>
    <!-- plugins:css -->
    <link rel="stylesheet" href="../../assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="../../assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="../../assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="../../assets/images/favicon.ico" />
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper full-page-wrapper" style="background-image: url('assets/images/slider-3.jpg'); background-size: cover;">
        <div class="content-wrapper d-flex align-items-center auth">
          <div class="row flex-grow">
            <div class="col-lg-4 mx-auto">
              <div class="auth-form-light text-left p-5">

                 <div class="brand-logo d-flex justify-content-center">
                   <a href="/login">
                <img class="btMainLogo" style="width: 200px;" data-hw="1.7966666666667" src="https://www.universalresearchpanels.com/wp-content/uploads/2021/06/logo.png" alt="Asia Research Partners LLP">
            </a>

                </div>
                <h4>New here?</h4>
                <h6 class="font-weight-light">Signing up is easy. It only takes a few steps</h6>
                 <x-auth-validation-errors class="mb-4" :errors="$errors" />
                <form method="POST"  class="pt-3" action="{{ route('register') }}">
            @csrf
                  <div class="form-group">
                    <input type="text" class="form-control form-control-lg" placeholder="Username" id="name"  name="name" :value="old('name')" required autofocus />
                  </div>
                  <div class="form-group">
                    <input type="email" class="form-control form-control-lg" id="email" placeholder="email" name="email" :value="old('email')" required />
                </div>

                  <div class="form-group">
                    <input type="password" class="form-control form-control-lg" id="password"
                                type="password"
                                name="password"
                                placeholder="Password"
                                required autocomplete="new-password" />
                  </div>
                   <div class="form-group">
                    <input  class="form-control form-control-lg" id="password_confirmation"
                                type="password"
                                name="password_confirmation"  placeholder="confirmation Password" required />
                  </div>
                  <div class="mb-4">
                    <div class="form-check">
                      <label class="form-check-label text-muted">
                        <input type="checkbox" class="form-check-input"> I agree to all Terms & Conditions </label>
                    </div>
                  </div>

                   <div class="form-group">
                    <select name="user_type" class="form-control form-control-lg">

                    <option name= "user_type" value="admin">Admin</option>
                    <option name= "user_type" value="sales">Sales</option>
                    <option name= "user_type" value="accounts">Accounts</option>
                    <option name= "user_type" value="supplier">Supplier</option>
                    <option name= "user_type" value="operation">Operation</option>
                    <option name= "user_type" value="field_team">Field Team</option>
                    <option name= "user_type" value="data_center">Data Center</option>
                </select>
                  </div>
                  <div class="mt-3">
                    <button value="submit" class="btn btn-block btn-gradient-primary btn-lg font-weight-medium auth-form-btn">SIGN UP</a>
                  </div>
                  <div class="text-center mt-4 font-weight-light"> Already have an account? <a href="{{ route('login') }}" class="text-red">Login</a>
                  </div>
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
    <!-- plugins:js -->
    <script src="../../assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="../../assets/js/off-canvas.js"></script>
    <script src="../../assets/js/hoverable-collapse.js"></script>
    <script src="../../assets/js/misc.js"></script>
    <!-- endinject -->
  </body>
</html>

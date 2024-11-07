@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')
<style>
    .header {
        background: linear-gradient(43deg, #0b5dbb, #0b5dbb);

    }
    .label_style {
        font-size: x-large;
        font-family: auto;
    }
</style>
<div class='col-md-12'>
    <div class="card" id="header-title">
         <div class="card-header header-elements-inline header">
            <div class="card-title " style="color:whitesmoke;">View Profile</div>
        </div>
        <div class="card-body" id="cardbody">
            <!--<div class="row h-50">-->
            <!--    <div class ="col-md-12">-->
            <!--         <div class="form-group">-->
            <!--             <label class="label_style">First Name:</label>-->
            <!--             <input class="form-control" type="text" value="{{$view->fname}}">-->
            <!--         </div>-->
                     
            <!--         <div class="form-group">-->
            <!--             <label class="label_style">Last Name:</label>-->
            <!--             <input class="form-control" type="text" value="{{$view->lname}}">-->
            <!--         </div>-->
            <!--         <div class="form-group">-->
            <!--              <label class="label_style">Phone:</label>-->
            <!--             <input class="form-control" type="text" value="{{$view->phone}}">-->
            <!--         </div>-->
            <!--         <div class="form-group">-->
            <!--             <label class="label_style">Email:</label>-->
            <!--             <input class="form-control" type="text" value="{{$view->email}}">-->
            <!--         </div>-->
            <!--         <div class="form-group">-->
            <!--             <label class="label_style">Address:</label>-->
            <!--             <textarea class="form-control" type="text" value="">{{$view->address}}</textarea>-->
            <!--         </div>-->
            <!--         <div class="form-group">-->
            <!--            <label class="label_style">Zipcode:</label>-->
            <!--             <input class="form-control" type="text" value="{{$view->zipcode}}">-->
            <!--         </div>-->
                     
            <!--    </div>-->
            <!--</div>-->
               <div class="lang-personal ">
          <div class="col-md-12 mt-2">

              <div class="row">
                <div class="col-md-6 mt-3">
                  <label>First Name<p>
                </div>
                <div class="col-md-6 mt-1">

                  <div class="form-check">
                    <input class="form-control lang-name lang-cal" type="text" name="fname" value="{{$view->fname}}"  required  readonly>
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
                    <input class="form-control lang-name lang-cal1" type="text" name="lname" value="{{$view->lname}}" required readonly> 
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
                    <input class="form-control lang-name lang-cal2" type="number" name="phone" minlength="9" minlength="10" value="{{$view->phone}}" required readonly>
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
                    <input class="form-control lang-name lang-cal3" type="email" name="email" value="{{$view->email}}" required pattern="[^@]+@[^@]+\.[com]{3,6}" readonly>
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
                      rows="5" cols="33" readonly>{{$view->address}}</textarea>
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
                    <input class="form-control lang-name lang-cal5" type="number" name="zipcode" value="{{$view->zipcode}}" required readonly>
                    </label>
                  </div>

                </div>
              </div>

        </div>
        </div>
    </div>
</div>
@endsection
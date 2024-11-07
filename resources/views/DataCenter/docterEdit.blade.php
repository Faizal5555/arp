@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')

<div class="col-md-12">
    <div class="card " id="header-title">  
        <div class="card-header header-elements-inline header" style="background: linear-gradient(43deg,#0b5dbb,#0b5dbb);">
          <div class="card-title " style="color:whitesmoke;">Docter Dashboard</div>
        </div>
        <div class="card-body" id="cardbody">
         <div class="col-sm-12">
             <div class="bg-primary card">
                 <div class="profile-user-box card-body">
                     <div class="row">
                         <div class="col-sm-8">
                             <div class="align-items-center row">
                                 <div class="col-auto col">
                                     <div class="avatar-lg">
                                         <img src="{{asset('assets/docter_Image.png')}}" alt=""  style="height: 100px; width:100px; border-radius:8px;">
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div>
                                            <h4 class="mt-1 mb-1 text-white">{{$doctor && $doctor->firstname ? $doctor->firstname : '' }}</h4>
                                            <p class="font-13 text-white-50"> {{$doctor && $doctor->lastname ? $doctor->lastname : '' }}</p>
                                            <ul class="mb-0 list-inline text-light">
                                                <li class="list-inline-item me-3">
                                                    <h5 class="mb-1"></h5>
                                                    
                                                </li>
                                                <li class="list-inline-item">
                                                    <h5 class="mb-1"></h5>
                                                    <p class="mb-0 font-13 text-white-50"></p>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                    <div class=" card">
                        <div class="profile-user-box card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-name" class="form-control-label">First Name</label>
                                        <div class="">
                                            <input type="text" value="{{$doctor && $doctor->firstname ? $doctor->firstname : '' }}" readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-email" class="form-control-label">Last Name</label>
                                        <div class="">
                                            <input type="text" value="{{$doctor && $doctor->lastname ? $doctor->lastname : '' }}" readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-name" class="form-control-label">City Name</label>
                                        <div class="">
                                            <input type="text" value="{{$doctor && $doctor->cityname ? $doctor->cityname : '' }}" readonly class="form-control">
                                        </div>
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-email" class="form-control-label">City Code</label>
                                        <div class="">
                                            <input type="text" value="{{$doctor && $doctor->citycode ? $doctor->citycode : '' }}" readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-name" class="form-control-label">Phone Number</label>
                                        <div class="">
                                            <input type="text" value="{{$doctor && $doctor->PhNumber ? $doctor->PhNumber : '' }}" readonly class="form-control">
                                        </div>
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-email" class="form-control-label">Email</label>
                                        <div class="">
                                            <input type="text" value="{{$doctor && $doctor->email ? $doctor->email : '' }}" readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-name" class="form-control-label">Whatsapp Number</label>
                                        <div class="">
                                            <input type="text" value="{{$doctor && $doctor->whatdsappNumber ? $doctor->whatdsappNumber : '' }}" readonly class="form-control">
                                        </div>
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-email" class="form-control-label">Docter Specility</label>
                                        <div class="">
                                            <input type="text" value="{{$doctor && $doctor->docterSpeciality ? $doctor->docterSpeciality : '' }}" readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-name" class="form-control-label">Total experience</label>
                                        <div class="">
                                            <input type="text" value="{{$doctor && $doctor->totalExperience ? $doctor->totalExperience : '' }}" readonly class="form-control">
                                         </div>
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-email" class="form-control-label">Practice</label>
                                        <div class="">
                                            <input type="text" value="{{$doctor && $doctor->practice ? $doctor->practice : '' }}" readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-name" class="form-control-label">Licence</label>
                                        <div class="">
                                            <input type="text" value="{{$doctor && $doctor->licence ? $doctor->licence : '' }}" readonly class="form-control">
                                        </div>
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-email" class="form-control-label">Patient Month</label>
                                        <div class="">
                                            <input type="text" value="{{$doctor && $doctor->PatientsMonth ? $doctor->PatientsMonth : '' }}" readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-name" class="form-control-label">Country</label>
                                        <div class="">
                                            <input type="text" value="{{$doctor && $doctor->country1 ? $doctor->country1 : '' }}" readonly class="form-control">
                                        </div>
                                </div>
                            </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-email" class="form-control-label">Document</label>
                                        <div class="">
                                            <input type="text" value="{{$doctor && $doctor->document ? $doctor->document : '' }}" readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
           
                </div>
        </div>  
    </div>
</div>
</div>
     
@endsection
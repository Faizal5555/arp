@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')
<style>
 
    .header{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        
    }
   </style>

<div class="col-md-12">
    <div class="card " id="header-title">  

        <div class="card-header header-elements-inline header">
          <div class="card-title " style="color:whitesmoke;">Doctor Details</div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form id="dotor_export" action="{{route('doctor.export')}}"  method="get">
                        @csrf
                        <input type="hidden" id="doctor_id" name="doctor_id" value="{{ $moneyoption->id }}">
                        <button class="btn btn-danger mb-3 float-right" id="doctor_export" type="submit">Export</button>
                    </form>
                </div>
        <div class="row mb-4">
            <div class="col-md-4">
                @if(isset($moneyoption->profile_image))
                <img src="{{asset("$moneyoption->profile_image")}}" alt="view_image" style="width:100px;height:100px; border-radius:8px;">
                @else
                <label>Doctor Does not Upload Image</label>
                @endif
            </div>
            <div class="col-md-4"></div>
            <div class="col-md-4"></div>
        </div>
            <div class="row ">
                <input type="hidden" id="id" name="id" value="14">

               <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">First Name <span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" readonly="readonly" value="{{$moneyoption->firstname}}">
                                </div>
                            </div>
                </div>
                 <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">Last Name <span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" readonly="readonly" value="{{$moneyoption->lastname}}">
                                </div>
                            </div>
                </div>
                <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">City Name<span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" readonly="readonly" value="{{$moneyoption->cityname}}">
                                </div>
                            </div>
                </div>
                <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">City Code<span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" readonly="readonly" value="{{$moneyoption->citycode}}">
                                </div>
                            </div>
               </div>
               @if(auth()->user()->user_type=='admin')
                 <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">Phone Number<span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" readonly="readonly" value="{{$moneyoption->PhNumber}}">
                                </div>
                            </div>
               </div>
               <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">Email <span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" readonly="readonly" value="{{$moneyoption->email}}">
                                </div>
                            </div>
               </div>
               @endif
               <div class="col-md-12">
                            <div class="form-group row d-flex">
                                <label class="col-lg-4 col-form-label font-weight-bold text-dark">Whatsapp Number <span class="text-danger"></span></label>
                                <div class="col-lg-4">
                                <input class="form-control" readonly="readonly" value="{{$moneyoption->whatdsappNumber}}">
                                </div>
                            </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row d-flex">
                        <label class="col-lg-4 col-form-label font-weight-bold text-dark"> Doctor Speciality<span class="text-danger"></span></label>
                        <div class="col-lg-4">
                        <input class="form-control" readonly="readonly" value="{{$moneyoption->docterSpeciality}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row d-flex">
                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Total Experience <span class="text-danger"></span></label>
                        <div class="col-lg-4">
                        <input class="form-control" readonly="readonly" value="{{$moneyoption->totalExperience}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row d-flex">
                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Practice<span class="text-danger"></span></label>
                        <div class="col-lg-4">
                        <input class="form-control" readonly="readonly" value="{{$moneyoption->practice}}">
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row d-flex">
                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Licence<span class="text-danger"></span></label>
                        <div class="col-lg-4">
                        <input class="form-control" readonly="readonly" value={{$moneyoption->licence}}>
                        </div>
                    </div>
                </div> 
                <div class="col-md-12">
                    <div class="form-group row d-flex">
                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Patients Months<span class="text-danger"></span></label>
                        <div class="col-lg-4">
                        <input class="form-control" readonly="readonly" value={{$moneyoption->PatientsMonth}}>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group row d-flex">
                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Country<span class="text-danger"></span></label>
                        <div class="col-lg-4">
                        <input class="form-control" readonly="readonly" value="{{$moneyoption->country1}}">
                        </div>
                    </div>
               </div>
               
                <div class="col-md-12">
                    <div class="form-group row d-flex">
                        <label class="col-lg-4 col-form-label font-weight-bold text-dark">Document<span class="text-danger"></span></label>
                        <div class="col-lg-4 d-flex">
                        @if(isset($moneyoption->document))
                        <input class="form-control" readonly="readonly" value="{{$moneyoption->document}}">
                        {{-- <button class="btn btn-primary">Download</button> --}}
                        <a target="_blank" href="{{url($moneyoption->document)}}"><i class="fa fa-eye mt-2 ml-1"></i></a>
                        @else
                        <label>Doctor Does not Upload File</label>
                         @endif
                        </div>
                    </div>
                </div>

                <div class="col-md-12 text-center">
                <a href="{{route('datacenter.performance')}}" class="btn btn-success mr-2">Back</a>
                {{-- <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">Send Money</button> --}}
                </div>


            </div>    
                </div> 
    </div>
</div>

@endsection
@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')
<style>
    .Edit:hover{
        color:white !important;
    }
    .blod_style{
        font-weight: bolder;
    }
    .border_style{
        border: 1px solid #b5adc9 !important;
        border-radius: 10px !important;
    }
   .error{
     color:red;
     margin-top:3px;
   }  
    
</style>
<script>

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
    
    $(document).ready(function() {

        $("#document").click(function(){
            $(".document_none").addClass('d-none');
        }),
        
        $("#Doctor_image").click(function(){
            $(".image_none").addClass('d-none');
        }),
        
        $.ajaxSetup({
            headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
             }
        });
        $("#edit").validate({
              rules:{
                  first:{
                      required:true
                  },
                  last:{
                      required:true
                  },
                  city:{
                      required:true
                  },
                  code:{
                      required:true
                  },
                  phone:{
                       required:true,
                       number:true,
                       minlength: 10
                  },
                  whatsapp:{
                      required:true,
                       number:true,
                       minlength: 10
                  },
                  docter:{
                      required:true
                  },
                  experience:{
                      required:true
                  },
                  Practice:{
                      required:true
                  }, 
                  licence:{
                       required:true,
                       number:true,
                  },
                  patient:{
                      required:true,
                      number:true,
                      maxlength:2
                  },
                  country:{
                      required:true
                  },  
              },
                  submitHandler: function (form) {
                      var data=new FormData(form);
                    //   alert(data);
                    $.ajax({
                        type:"post",
                        url: "{{route('editdata')}}",
                        data:data,
                        processData: false,
                        contentType: false,
                        dataType: "json",
                        success: function (data) {
                            if(data.success == 1){
                                // $("#exampleModal").modal('hide');
                                 swal({
                                        title:'Doctor Updated Successfully',
                                        icon:'success',
                                        button:false
                                }) 
                                location.reload();
                         console.log(data.data.profile_image);
                         $("#image").attr(src)
                            }else{
                                
                            }
                        }
                    });
                  } 
          })

    });
    
</script>

<div class="col-md-12">
    <div class="card " id="header-title">  
        <div class="card-header header-elements-inline header" style="background: linear-gradient(43deg,#0b5dbb,#0b5dbb);">
          <div class="card-title " style="color:whitesmoke;">Doctor Dashboard</div>
        </div>
        <div class="card-body" id="cardbody">
            {{-- <div class="row">
                <div class="col-md-12 mb-4" style="position:relative">
                    <i class="fa fa-bell float-right" style="font-size:20px;"></i>
                    <label class="number mb-0 d-flex align-items-center justify-content-center" style="position: absolute; top:-10px;right:0.9%; width:18px;height:18px;border-radius:10px; font-size: 13px;
                      background:#ef2828; color:#fff;">
                        
                    </label>
                </div>
            </div> --}}
         <div class="col-sm-12">
             <div class="bg-primary card">
                 <div class="profile-user-box card-body">
                     <div class="row">
                         <div class="col-sm-8">
                             <div class="align-items-center row">
                                 <div class="col-auto col">
                                     <div class="avatar-lg">
                                         
                                         @if(isset($doctor) && $doctor->profile_image)
                                         <img src="{{$doctor && $doctor->profile_image ? $doctor->profile_image : ''}}" alt="" id="image"  style="height: 100px; width:100px; border-radius:8px;">
                                         @else
                                         <img src="{{asset('assets/docter_Image.png')}}" alt="" id="image"  style="height: 100px; width:100px; border-radius:8px;">
                                         @endif
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
                            <div class="col-sm-4 mt-4">
                                <div class="text-center mt-sm-0 mt-3 text-sm-end">
                                 <button type="button Edit" class="btn btn-light" id="edit_profile" data-toggle="modal" data-target="#exampleModal">
                                        <i class="mdi mdi-account-edit me-1"></i> Edit Profile</button>
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
                                        <label for="user-email" class="form-control-label">Doctor Speciality</label>
                                        <div class="">
                                            <input type="text" value="{{$doctor && $doctor->docterSpeciality ? $doctor->docterSpeciality : '' }}" readonly class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="user-name" class="form-control-label">Total Experience</label>
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
                                        <div class="d-flex">
                                            <input type="text" value="{{$doctor && $doctor->document ? $doctor->document : '' }}" readonly class="form-control">
                                            <a target="_blank" href="{{url($doctor && $doctor->document ? $doctor->document : '' )}}"><i class="fa fa-download mt-2 ml-1 " id="dowload"  aria-hidden="true"></i></a>
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
     
{{-- modal --}}
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-primary ">
          <h5 class="modal-title" id="exampleModalLabel" style="color:white;">Doctor Edit</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form id="edit" enctype='multipart/form-data' >
               @csrf
                <input type="hidden" name="docter_id" id="docter_id" value="{{$doctor && $doctor->id ? $doctor->id : '' }}">
                
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label blod_style">First Name</label>
                            <div class="">
                                <input type="text" id="first" name="first" value="{{$doctor && $doctor->firstname ? $doctor->firstname : '' }}"  class="form-control border_style">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label blod_style">Last Name</label>
                            <div class="">
                                <input type="text" id="last" name="last" value="{{$doctor && $doctor->lastname ? $doctor->lastname : '' }}"  class="form-control border_style">
                            </div>
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label blod_style">City Name</label>
                            <div class="">
                                <input type="text" id="city" name="city" value="{{$doctor && $doctor->cityname ? $doctor->cityname : '' }}"  class="form-control border_style">
                            </div>
                    </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label blod_style">City Code</label>
                            <div class="">
                                <input type="text" id="code" name="code" value="{{$doctor && $doctor->citycode ? $doctor->citycode : '' }}"   onkeypress="return isNumber1(event)" class="form-control border_style">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label blod_style">Phone Number</label>
                            <div class="">
                                <input type="text" name="phone" id="phone" value="{{$doctor && $doctor->PhNumber ? $doctor->PhNumber : '' }}" onkeypress="return isNumber(event)"  class="form-control border_style">
                            </div>
                    </div>
                </div>
                <div class="col-md-6 ">
                    <div class="form-group">
                        <label  class="form-control-label blod_style"> Doctor Image Upload</label>
                        <div class="">
                          
                          <a class="image_none" target="_blank" href="{{$doctor && $doctor->profile_image ? $doctor->profile_image : '' }}"> {{$doctor && $doctor->profile_image ? $doctor->profile_image : '' }}</a>
                            <input type="file" value=""  name="image" id="Doctor_image" class="form-control border_style" accept="image/*">
                        </div>
                    </div>
                </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label blod_style">Whatsapp Number</label>
                            <div class="">
                                <input type="text" name="whatsapp" id="whatsapp" value="{{$doctor && $doctor->whatdsappNumber ? $doctor->whatdsappNumber : '' }}"  class="form-control border_style" onkeypress="return isNumber(event)">
                            </div>
                    </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label blod_style">Doctor Speciality</label>
                            <div class="">
                               <select  name="docterSpeciality"  class="form-control border_style" id="docterSpeciality" style="width:100%; ">
                                    <option value="" disabled selected>Select Speciality</option>
                                      @if(isset($speciality) && count($speciality)>0)
                                      @foreach($speciality as $ss)
                                      <option value="{{$ss->speciality}}"{{$ss->speciality == $doctor->docterSpeciality  ? 'selected' : ''}}>{{$ss->speciality}}</option>
                                      @endforeach
                                      @endif
                                 </select>
                                
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label blod_style">Total Experience</label>
                            <div class="">
                                <select  name="Experience"  class="form-control border_style" id="Experience" style="width:100%; ">
                                   <?php
                            
                            for($i= 1 ; $i<=55 ; $i ++)
                            {
                            ?>        
                                     <option value="{{ $i }}"{{ $i == $doctor->totalExperience ? 'selected' : '' }} >{{$i}}</option>
                            <?php } ?> 
                                </select>
                                <!--<input type="text"   name="experience" id="experience" value="{{$doctor && $doctor->totalExperience ? $doctor->totalExperience : '' }}"  class="form-control">-->
                             </div>
                    </div>
                </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label blod_style">Practice</label>
                            <div class="">
                                <select  name="Practice"  class="form-control  border_style"  name="Practice" id="Practice" style="width:100%; ">
                                    <option value="private" {{$doctor->practice && $doctor->practice == 'private' ? 'selected':''}} >private</option>
                                    <option value="public "{{$doctor->practice && $doctor->practice == 'public' ? 'selected':''}} >public</option>
                                    <option value="both"{{$doctor->practice && $doctor->practice == 'both' ? 'selected':''}} >both</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label blod_style">Licence</label>
                            <div class="">
                                <input type="text"  name="licence" id="licence" value="{{$doctor && $doctor->licence ? $doctor->licence : '' }}"  class="form-control border_style">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label blod_style">Patient Month</label>
                            <div class="">
                                <input type="text" name="patient" id="patient" value="{{$doctor && $doctor->PatientsMonth ? $doctor->PatientsMonth : '' }}"  class="form-control border_style">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-name" class="form-control-label blod_style">Country</label>
                            <div class="">
                                {{-- <input type="text" id="country" name="country" value="{{$doctor && $doctor->country1 ? $doctor->country1 : '' }}"  class="form-control border_style"> --}}
                                <select name="country" id="country" class="form-control border_style ">
                                    @if(isset($country) && count($country) > 0)
                                    @foreach($country as $v)
                                <option value="{{$v->name}}"{{$doctor->country1 == $v->name ?'selected' : ''}}>{{$v->name}}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="user-email" class="form-control-label blod_style">Document</label>
                            <div class="">
                                <a class="document_none" target="_blank" href="{{$doctor && $doctor->document ? $doctor->document : '' }}">{{$doctor && $doctor->document ? $doctor->document : '' }} </a>
                                <input type="file" id="document" name="document"  value=""  class="form-control border_style">
                            </div>
                        </div>
                    </div>
                </div>
               
                <div class="row">
                    <div class="col-md-4">

                    </div>
                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <button type="submit" class=" btn btn-success">Save</button>
                    </div>
                    <div class="col-md-4">

                    </div>
                </div>
                
            </form>
            
        </div>
        
      </div>
    </div>
  </div>

  
@endsection
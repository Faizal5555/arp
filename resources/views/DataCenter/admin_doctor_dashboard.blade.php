@extends('layouts.master')
@section('page_title', 'Client List')
@section('content')
<style>
    .header{
        background:linear-gradient(43deg,#0b5dbb,#0b5dbb);
        
    }
      
    .dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}
.badge {
    padding: 2px 0px 0px 0px!important;
  position: absolute;
  top: -3px;
  right: 6px;
  width: 18px;
  height: 18px;
  border-radius: 100%!important;
  background: red;
  color: white;
  font-size: 10px;
}
.dropdown-content-two{
    display: none;
}
.dropdown-content li:hover {background-color: #4982C2;}
.dropdown:hover .dropdown-content {display: block;}
.btnn:hover .dropdown-content-two {display: block;}
select.form-control {
    padding: 0.4375rem 0.75rem;
    border: 0;
    outline: 1px solid #0c5ebb !important;
    color: #c9c8c8;
}
</style>
<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="mdi mdi-home"></i>
        </span> Data Center Dashboard
      </h3>
      <nav aria-label="breadcrumb">
        <ul class="breadcrumb">
          <li class="breadcrumb-item active" aria-current="page">
            <span></span>Overview <i class="mdi mdi-alert-circle-outline icon-sm text-primary align-middle"></i>
          </li>
        </ul>
      </nav>
    </div>
    <div id="won_noti">
              <div class="col-md-11 container d-flex justify-content-end mb-3" >
      
                  <div class="dropdown">
                      <a class="nav-link " href="#"><i class="fas fa-bell fa-lg"></i><span class="badge">{{$doctornotification}}</span></a>
                      <div class="dropdown-content  " style="width: 200px;margin-left:-100px">
                          <div class="btnn">
                         
                          <h6 class="text-center" style="color:rgb(183,110,255)"><button class="btn1" style="all:unset"> New Message</button></h6>
                          
                          <input type="hidden" name="status" id="status" value="3">
                              <div class="dropdown-content-two"  id="ui-notification">
                                  <ul class="nav flex-column  sub-menu1">
                                          <li class="text-center" id="notify-movo">Receive Money/voucher</a><p> {{$doctornotificationmv}}message</p></li>
                                          <li class="text-center" id="notify-reg" val="1">New Doctor Registration</a><p> {{$doctornotification2}}message</p></li>
                                  </ul> 
                              </div>
                          </div>
          
                      </div>
                  </div>
              </div>
    </div>
    <div class="row">
        <div class="col-md-4">
             <div class="form-group">
                 <label style="font-size: larger;">Country</label> 
                 <select name="country" id="country" class="form-control">
                      <option class="label-gray-3" value="">Select Country<i class="fas fa-globe-asia"></i></option>
                           @if(isset($country) && count($country) > 0)
                            @foreach($country as $v)
                                <option value="{{$v->name}}">{{$v->name}}</option>
                            @endforeach
                            @endif
                 </select>
            </div>
        </div>
        <div class="col-md-4">
             <div class="form-group">
                 <label style="font-size: larger;">Speciality</label>
                 <select name="speciality" id="speciality" class="form-control">
                     <option value="" disabled selected>Select Speciality</option>
                         @if(isset($speciality) && count($speciality) > 0)
                         @foreach($speciality as $s)
                                 <option value="{{$s->speciality}}">{{$s->speciality}}</option>
                         @endforeach
                         @endif
                 </select>
             </div>
        </div>
    </div>
    
    
    <div class="row">
        
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
           
            <h4 class="font-weight-normal mb-3">Total Doctor<i class="mdi mdi-chart-line mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5 doctor_count">{{$doctor}}</h2>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
          <div class="card-body">
           
            <h4 class="font-weight-normal mb-3">Redeem Accept List<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">{{$doctorRedeemAcceptList}}</h2>
          </div>
        </div>
      </div>
   </div>
<script>
  $(document).ready(function(){
    $('#notify-movo').click(function(){
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            $.ajax({
                url: "{{ route('adminconcept')}}",
                method: 'post',
                data: {
                  status: $('#status').val(),
                 },
                success: function(result){
                    if(result.success == 1)
                       {
                        location.reload(true);
                        window.location="{{route('reddemAcept')}}";

                       }
                }
            });
        });
        $('#notify-reg').click(function(){
       
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            $.ajax({
                url: "{{route('adminreg1')}}",
                method: 'post',
                data: {
                  status:1,
                 },
                success: function(result){
                    if(result.success == 1)
                       {
                        location.reload(true);
                        window.location="{{route('adminactivedview')}}";

                       }
                }
            });
        });
   });
 
 $(document).on('change','#country,#speciality',function(){
    var country = $('#country').val();
    var speciality = $('#speciality').val();
     $.ajax({
         url:"{{route('adminfillter')}}",
         method:'get',
         data: {
             country,speciality
         },
         success: function(data){
            //  console.log(data.datacenter);
             $('.doctor_count').html(data.datacenter);
         }
     })
 })
//  $(document).on('change','#speciality',function(){
//      console.log($(this).val());
//      $.ajax({
//          url:"{{route('adminfillter')}}",
//          method:'get',
//          data: {
//              speciality:$(this).val(),
//          },
//          success: function(data){
//             $('.doctor_count').html(data.datacenter);
//          }
//      })
//  })
   </script>
@endsection
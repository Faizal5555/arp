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

</style>
<script>
  $(document).ready(function(){
    $('#notify-money').click(function(){
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            $.ajax({
                url: "{{ route('notifymoney')}}",
                method: 'post',
                data: {
                  user_id: $('#user_id').val(),
                 },
                success: function(result){
                    if(result.success == 1)
                       {
                        location.reload(true);
                        window.location="{{route('receive.money')}}";

                       }
                }
            });
        });
   });

   $(document).ready(function(){
    $('#notify-vocher').click(function(){
            $.ajaxSetup({
             headers: {
                     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                 },
            });
            $.ajax({
                url: "{{ route('notifyvocher')}}",
                method: 'post',
                data: {
                  user_id: $('#user_id').val(),
                 },
                success: function(result){
                    if(result.success == 1)
                       {
                        window.location="{{route('receive.voucher')}}";
                       }
                }
            });
        });
   });
  
</script>
<div class="content-wrapper">
    <div class="page-header">
      <h3 class="page-title">
        <span class="page-title-icon bg-gradient-primary text-white mr-2">
          <i class="mdi mdi-home"></i>
        </span> Doctor Dashboard
      </h3>
    
            <div id="won_noti">
              <div class="col-md-11 container d-flex justify-content-end" >
      
                  <div class="dropdown">
                      <a class="nav-link " href="#"><i class="fas fa-bell fa-lg"></i><span class="badge">{{$doctornotification}}</span></a>
                      <div class="dropdown-content  " style="width: 200px;margin-left:-100px">
                          <div class="btnn">
                         
                          <h6 class="text-center" style="color:rgb(183,110,255)"><button class="btn1" style="all:unset"> New Message</button></h6>
                          
                          <input type="hidden" name="user_id" id="user_id" value="{{Auth::user()->id}}">
                              <div class="dropdown-content-two"  id="ui-notification">
                                  <ul class="nav flex-column  sub-menu1">
                                    
                                          <li class="text-center" id="notify-money"> <span id="notify-money">Receive Money</span>
                                           <p> {{$doctornotificationmoney}}message</p></li>
                                          <li class="text-center" id="notify-vocher">Receive voucher</a><p> {{$doctornotification1}}message</p></li>
                                  </ul>
                              </div>
                          </div>
          
                      </div>
                  </div>
              </div>
          </div>
         
    </div>
    <div class="row">
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-danger card-img-holder text-white">
          <div class="card-body">
            <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
            <h4 class="font-weight-normal mb-3"> Redeem Count<i class="mdi mdi-chart-line mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">{{$money_count}}</h2>
          </div>
        </div>
      </div>
      <div class="col-md-4 stretch-card grid-margin">
        <div class="card bg-gradient-info card-img-holder text-white">
          <div class="card-body">
            <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
            <h4 class="font-weight-normal mb-3">Voucher Count<i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
            </h4>
            <h2 class="mb-5">{{$voucher_count}}</h2>
          </div>
        </div>
      </div>
    </div>
</div>

@endsection
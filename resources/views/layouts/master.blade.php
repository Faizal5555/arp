@php
$user_id = auth()->id();
@endphp
<!DOCTYPE html >
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="content-type" content="text/plain; charset=UTF-8"/>
    <title>ARP</title>
    <link rel="stylesheet" href="https://cdn.rawgit.com/tonystar/bootstrap-float-label/v4.0.1/dist/bootstrap-float-label.min.css">


      <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('adminapp/assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('adminapp/assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('adminapp/assets/css/style.css')}}">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{asset('adminapp/assets/images/favicon.ico')}}" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js"
    integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{asset('adminapp/assets/vendors/js/vendor.bundle.base.js')}}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>   --}}
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    @stack('css')
    @stack('scripts')
    <style>
    .logo{
      width: 60% !important;
      height: 100% !important;
      margin-top: 10% !important;
    }

    .navbar .navbar-brand-wrapper .navbar-brand img {

    margin-bottom: 12px;
  }

  .dropdown .dropdown-menu .dropdown-item:hover {
    background-color: #f8f9fa;
    color: #414040;
    box-shadow: 3px 3px 10px 0 rgb(123 31 162 / 50%);
}


/*sidebar*/
.sidebar {
    margin-top:37px;
}
.sidebar .nav li.nav-item.active {
   background: linear-gradient(
43deg,#0b5dbb,#0b5dbb);

    color: #fff;
    margin-top: 1 px;
    border-bottom-right-radius: 32px;
    border-top-right-radius: 32px;
}
.sidebar .nav .nav-item.active > .nav-link i {
    color: #eae7ec;
}

.sidebar .nav .nav-item:hover {
    background: #fcfcfc;
    margin-top:4px;
}
.sidebar .nav li.nav-item:hover {


    color: #fff;
    margin-top:1px;

}
.sidebar .nav .nav-item.active > .nav-link .menu-title {
    color:  #ffffff;
    font-family: "ubuntu-medium", sans-serif;

}

.sidebar .nav.sub-menu .nav-item .nav-link.active {
    color: #e5e0ea;

}
.sidebar .nav. .nav-item .nav-link {
    color: #8e8585;
}


.sidebar .nav.sub-menu1 .nav-item .nav-link:hover {
    color: #bcb9b9;
}
.sidebar .nav .nav-item .nav-link .menu-title {
    color: inherit;
    display: inline-block;
    font-size: 0.975rem;
    font: bold;
    line-height: 1;
    vertical-align: middle;
}
.sidebar .nav .nav-item.nav-profile .nav-link :hover{
  display:none;

}
.sidebar .nav.sub-menu1 .nav-item .nav-link {


    font-size: 0.955rem;

}
.sidebar .nav:not(.sub-menu) > .nav-item :not(.nav-category):not(.nav-profile) > .nav-link:hover {
    color: #eef1f4;
}
/*sidebar end*/


/*sidebar submenu*/

 .sidebar .nav.sub-menu1 .nav-item .nav-link {
    color: #888;
    position: relative;
    font-size: 0.8125rem;
    line-height: 1;
    height: auto;
    border-top: 0;
}
/*sidebar submenu end*/



/*sidebar submenu ui li*/

  ul.nav.flex-column.sub-menu1 li.nav-item .nav-link{
      color:#a49c9c;
      font-size:0.93rem;
      font-weight:200;
      text-align:center;

  }


   ul.nav.flex-column.sub-menu1 li.nav-item.active > .nav-link{
      color:#fff;
      font-size:0.85rem;

  }



ul.nav.flex-column.sub-menu1 li.nav-item .nav-link.active {
    background: linear-gradient(45deg,#4982c2,#4982c2);
    margin: 10px -35px 10px -13px;
    padding-left: 34px;
    color: #fff;

    border-bottom-right-radius: 32px;

    border-top-right-radius: 32px;
    padding-left:10px;
}
ul.nav.flex-column.sub-menu1 li.nav-item:hover {

    background: linear-gradient(45deg,#4982c2,#4982c2);
    border-bottom-right-radius: 32px;
    border-top-right-radius: 32px;
    color: #fff;
    padding-left:5px;
    

}
ul.nav.flex-column.sub-menu1 li.nav-item .nav-link:hover{
    color: #fff;

}
/*sidebar submenu ui li end*/

.bg-gradient-primary {

    background: linear-gradient(to right, #007bff, #da747d) !important;
}


/*submenus margin*/
#client_management,#vendor_management,#create_rfq,#view_rfq,#view_sales_figure,#overview,#commissioned_project,#lost_project,#rfq_follow_up{
    margin-bottom:4px;
}

li.nav-item.active{
        background: linear-gradient(45deg,#4982c2,#4982c2);
    border-bottom-right-radius: 32px;
    border-top-right-radius: 32px;
    color: #fff;
}
.sidebar .nav li.nav-item.active a,.sidebar .nav li.nav-item.active a:hover{
    color:white !important;
}
.sidebar{
    transition: width 0.2s linear;
}
button#nav-button {
    outline: none;
}
#invite{
    font-size: 0.975rem;
}
.accounts-sub :hover{
    background: linear-gradient(45deg,#4982c2,#4982c2);
    border-bottom-right-radius: 32px;
    border-top-right-radius: 32px;
    color: #fff;
}
a.my-link {
    text-decoration: none;
    color: #a49c9c;
}
.drp-selected{
    position: absolute;
    top: 11px;
    left: 50%;
  }
  .drp-calendar.left {
  margin: 23px 0px;
  }
   .drp-calendar.right {
  margin: 23px 0px;
  }
  .daterangepicker td.in-range {
    background-color: #2276d7 !important;
      
  }
#user-icon{
    margin-left:auto;
}
#home-icon{
     margin-left:auto;
}
table tfoot th {
    font-weight: normal !important;
    color: #fff !important;
}
.navbar .navbar-menu-wrapper .navbar-nav .nav-item.nav-profile .nav-link .nav-profile-img img {
    border-radius:0px;
}
.navbar .navbar-menu-wrapper .navbar-nav .nav-item.nav-profile .nav-link.dropdown-toggle:after {
    margin-top:5px;
}
.sidebar .nav .nav-item
{
   padding-left: 10px;
}
select.form-control{
  color: #495057;
}
    </style>
  </head>
  <body id="top-body" class=""> 
    <div class="container-scroller">
      <!-- partial:partials/_navbar.html -->
      <nav class="navbar default-layout-navbar col-lg-12 col-12 p-0 fixed-top d-flex flex-row">
        <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-center">
          <a class="navbar-brand brand-logo" href="{{route('dashboard')}}"><img class="logo"  src="{{asset('adminapp/assets/images/logo-3.png')}}" alt="logo" /></a>
          <a class="navbar-brand brand-logo-mini" href="{{route('dashboard')}}"><img class="logo" src="{{asset('adminapp/assets/images/logo-3.png')}}" alt="logo" /></a>
        </div>
        <div class="navbar-menu-wrapper d-flex align-items-stretch">
          <button class="navbar-toggler  align-self-center" id="nav-button" type="button" data-toggle="minimize" data-target="#sidebar">
            <span class="mdi mdi-menu navbar-toggler-icon"></span>
          </button>
          <!--<div class="search-field d-none d-md-block">-->
          <!--  <form class="d-flex align-items-center h-100" action="#">-->
          <!--    <div class="input-group">-->
          <!--      <div class="input-group-prepend bg-transparent">-->
          <!--        <i class="input-group-text border-0 mdi mdi-magnify"></i>-->
          <!--      </div>-->
          <!--      <input type="text" class="form-control bg-transparent border-0" placeholder="Search projects">-->
          <!--    </div>-->
          <!--  </form>-->
          <!--</div>-->
          <ul class="navbar-nav navbar-nav-right">

            <li class="nav-item d-none d-lg-block full-screen-link">
              <a class="nav-link">
                {{-- <i class="mdi mdi-fullscreen" id="fullscreen-button"></i> --}}
              </a>
            </li>
            <li class="nav-item dropdown">
              <!--<a class="nav-link count-indicator dropdown-toggle" id="messageDropdown" href="#" data-toggle="dropdown" aria-expanded="false">-->
              <!--  <i class="mdi mdi-email-outline"></i>-->
              <!--  <span class="count-symbol bg-warning"></span>-->
              <!--</a>-->
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="messageDropdown">
                <h6 class="p-3 mb-0">Messages</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{asset('assets/images/faces/face4.jpg')}}" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Mark send you a message</h6>
                    <p class="text-gray mb-0"> 1 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{asset('assets/images/faces/face2.jpg')}}" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Cregh send you a message</h6>
                    <p class="text-gray mb-0"> 15 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <img src="{{asset('assets/images/faces/face3.jpg')}}" alt="image" class="profile-pic">
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject ellipsis mb-1 font-weight-normal">Profile picture updated</h6>
                    <p class="text-gray mb-0"> 18 Minutes ago </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">4 new messages</h6>
              </div>
            </li>
            <li class="nav-item dropdown">
              <!--<a class="nav-link count-indicator dropdown-toggle" id="notificationDropdown" href="#" data-toggle="dropdown">-->
              <!--  <i class="mdi mdi-bell-outline"></i>-->
              <!--  <span class="count-symbol bg-danger"></span>-->
              </a>
              <div class="dropdown-menu dropdown-menu-right navbar-dropdown preview-list" aria-labelledby="notificationDropdown">
                <h6 class="p-3 mb-0">Notifications</h6>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-success">
                      <i class="mdi mdi-calendar"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Event today</h6>
                    <p class="text-gray ellipsis mb-0"> Just a reminder that you have an event today </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-warning">
                      <i class="mdi mdi-settings"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Settings</h6>
                    <p class="text-gray ellipsis mb-0"> Update dashboard </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item preview-item">
                  <div class="preview-thumbnail">
                    <div class="preview-icon bg-info">
                      <i class="mdi mdi-link-variant"></i>
                    </div>
                  </div>
                  <div class="preview-item-content d-flex align-items-start flex-column justify-content-center">
                    <h6 class="preview-subject font-weight-normal mb-1">Launch Admin</h6>
                    <p class="text-gray ellipsis mb-0"> New admin wow! </p>
                  </div>
                </a>
                <div class="dropdown-divider"></div>
                <h6 class="p-3 mb-0 text-center">See all notifications</h6>
              </div>
            </li>
            <li class="nav-item nav-logout d-none d-lg-block">
              <a class="nav-link" href="#">
                {{-- <i class="mdi mdi-power"></i> --}}
              </a>
            </li>
            <li class="nav-item nav-settings d-none d-lg-block">
              <a class="nav-link" href="#">
                {{-- <i class="mdi mdi-format-line-spacing"></i> --}}
              </a>
               <li class="nav-item nav-profile dropdown">
              <a class="nav-link dropdown-toggle" id="profileDropdown" href="#" data-toggle="dropdown" aria-expanded="false">
                <div class="nav-profile-img">
                  <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/57/OOjs_UI_icon_userAvatar-progressive.svg/1200px-OOjs_UI_icon_userAvatar-progressive.svg.png" alt="image">
                  <!--<span class="availability-status online"></span>-->
                </div>
                <div class="nav-profile-text">
                  <p class="mb-1 text-black" style="margin-top:6px;">{{ Auth::user()->name }}</p>
                </div>
              </a>
              <div class="dropdown-menu navbar-dropdown" aria-labelledby="profileDropdown">
                <!--<a class="dropdown-item" href="#">-->
                <!--  <i class="mdi mdi-cached mr-2 text-success"></i> Activity Log </a>-->
                <div class="dropdown-divider"></div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                  <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();this.closest('form').submit();">
                    <i class="mdi mdi-logout mr-2 text-primary"></i> Signout </a>
                </form>
              </div>
              <!-- <form method="POST" action="{{ route('logout') }}">
                    @csrf
                <div class="dropdown-divider"></div>

                  <i class="mdi mdi-logout mr-2 text-primary"></i>

                    <a class="dropdown-item" href="{{route('logout')}}"onclick="event.preventDefault();this.closest('form').submit();">
                    Log Out</a>

              </div>
              </form> -->
            </li>
            </li>
          </ul>
          <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
          </button>
        </div>
      </nav>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        <nav class="sidebar sidebar-offcanvas" id="sidebar">
          <ul class="nav">
            <!--<li class="nav-item nav-profile">
              <a href="#" class="nav-link">
                <div class="nav-profile-image">
                  <img src="{{asset('assets/images/faces/face1.jpg')}}" alt="profile">
                  <span class="login-status online"></span>
                  change to offline or busy as needed
                </div>
                <div class="nav-profile-text d-flex flex-column">
                  <span class="font-weight-bold mb-2">{{ Auth::user()->name }}</span>
                  <span class="text-secondary text-small">{{Auth::user()->user_type}}</span>
                </div>
                {{-- <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i> --}}
              </a>
            </li>-->

            <li class=" nav-item ">
              @if(auth()->user()->user_type != 'global_manager')
              <a class="nav-link " href="{{route('dashboard')}}">
                <span class="menu-title">Dashboard</span>
                <i class="fas fa-home"  id="home-icon"></i>
              </a>
              @endif

            </li>
            @if(auth()->user()->user_type == 'sales' )
            <li class="nav-item">

              <a class="nav-link " data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Sales</span>
                <i class="menu-arrow"></i>
                <i class="fas fa-address-card"></i>
              </a>

              <div class="collapse"  id="ui-basic">
                <ul class="nav flex-column  sub-menu1">
                   <li class="nav-item" > <a class="nav-link {{ (Route::is('client.data')) ? 'active' : '' }}"  href="{{route('client.data')}}">Client Database</a></li>
                  <li class="nav-item" > <a class="nav-link {{ (Route::is('client.clientdata')) ? 'active' : '' }}"  href="{{route('clientdata.index')}}">Client FollowUp Date</a></li>
                  <li class="nav-item  {{ (Route::is('client.index')) ? 'active' : '' }} "  id="client_management"> <a class="nav-link " href="{{route('client.index')}}">Client Management</a></li>
                  <li class="nav-item  {{ (Route::is('vendor.index')) ? 'active' : '' }}" id="vendor_management"> <a class="nav-link" href="{{route('vendor.index')}}">Vendor Management</a></li>
                  <li class="nav-item {{ (Route::is('newrfq.index')) ? 'active' : '' }}" id="create_rfq"> <a class="nav-link  " href="{{route('newrfq.index')}}">Create RFQ</a></li>
                  <li class="nav-item {{ (Route::is('bidrfq.index')) ? 'active' : '' }}" id="view_rfq"> <a class="nav-link  "href="{{route('bidrfq.index')}}">View RFQ</a></li>
                  <li class="nav-item {{ (Route::is('wonproject.viewsalesfigures')) ? 'active' : '' }}" id="view_sales_figure">  <a class="nav-link " href="{{route('wonproject.viewsalesfigures')}}">View Sales Figures</a></li>
                  <!--<li class="nav-item {{ (Route::is('dashboard')) ? 'active' : '' }}" id="overview"> <a class="nav-link" href="{{route('salesdashboard')}}">Overview</a></li>-->
                  <!--<li class="nav-item"> <a class="nav-link {{ (Route::is('dashboard')) ? 'active' : '' }}"  href="{{route('dashboard')}}">Overview</a></li> -->
                </ul>
               </div>

            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Project Status</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic1">
                <ul class="nav flex-column sub-menu1">
                 <li class="nav-item Commissioned {{ (Route::is('wonproject.index')) ? 'active' : '' }}" id="commissioned_project"> <a class="compro nav-link " href="{{route('wonproject.index')}}">Commissioned Project</a></li>
                 <li class="nav-item completed Commissioned {{ (Route::is('wonproject.completed')) ? 'active' : '' }}" > <a class="nav-link " href="{{route('wonproject.completed')}}">Completed Commissioned Project</a></li>
                        <li class="nav-item  {{ (Route::is('bidrfq.lostproject')) ? 'active' : '' }}" id="lost_project"><a class="nav-link " href="{{route('bidrfq.lostproject')}}">Lost Project</a></li>
                        <li class="nav-item followup  {{ (Route::is('bidrfq.index')) ? 'active' : '' }}" id="rfq_follow_up"> <a class="nav-link" href="{{route('bidrfq.index')}}">RFQ Follow Up</a></li>
                         <!--<li class="nav-item Commissioned {{ (Route::is('wonproject.index')) ? 'active' : '' }}"> <a class="compro nav-link " href="{{route('wonproject.index')}}">Project Completed</a></li>-->
                </ul>
              </div>
            </li>
            
            
            {{-- @elseif(auth()->user()->user_type == 'operation') --}}
            {{-- <li class="nav-item"> 
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Operations</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-crosshairs-gps menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="#">New Project</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Existing Projects</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Closed Projects</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Add Field Team</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">View Project</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Overview</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">Data Center</a></li>
                </ul>
              </div>
            </li>
            @elseif(auth()->user()->user_type == 'field item')
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Field Item</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="#">NEW PROJECT</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">EXISTING PROJECTS </a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">CLOSED PROJECTS</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">VIEW PROJECT </a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">PROJECT STATUS</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">OVERVIEW</a></li>
                </ul>
              </div>
            </li>--}}
            
            <!--admin-->
            
             @elseif((auth()->user()->user_type == 'sales') or (auth()->user()->user_type == 'admin'))
             <li class="nav-item">
              <a class="nav-link"  href="{{route('usersview')}}" >
                <span class="menu-title">Users</span>
                
                {{-- <i class="mdi mdi-format-list-bulleted menu-icon"></i> --}}
                <!--<i class="mdi  mdi-account-multiple-outline menu-icon"></i>-->
                 <i class="fas fa-user-friends" id="user-icon"></i>
              </a>
             
             <li>
            
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Sales</span>
                <i class="menu-arrow"></i>
                <i class="fas fa-address-card"></i>
              </a>
              <div class="collapse"  id="ui-basic">

                <ul class="nav flex-column sub-menu1">
                    <div data-aos="fade-right">
                  
                  <li class="nav-item" > <a class="nav-link {{ (Route::is('client.data')) ? 'active' : '' }}"  href="{{route('client.data')}}">Client Database</a></li>
                  <li class="nav-item" > <a class="nav-link {{ (Route::is('client.clientdata')) ? 'active' : '' }}"  href="{{route('clientdata.index')}}">Client FollowUp Date</a></li>
                  <li class="nav-item"> <a class="nav-link {{ (Route::is('client.index')) ? 'active' : '' }} {{ (Route::is('client.create')) ? 'active' : '' }} {{ (Route::is('client.edit')) ? 'active' : '' }}" href="{{route('client.index')}}">Client Management</a></li>
                  <li class="nav-item" > <a class="nav-link {{ (Route::is('vendor.index')) ? 'active' : '' }} {{ (Route::is('vendor.create')) ? 'active' : '' }} {{ (Route::is('vendor.edit')) ? 'active' : '' }}" href="{{route('vendor.index')}}">Vendor Management</a></li>
                  <li class="nav-item" > <a class="nav-link {{ (Route::is('newrfq.index')) ? 'active' : '' }}"  href="{{route('newrfq.index')}}">Create RFQ</a></li>
                  <li class="nav-item" > <a class="nav-link {{ (Route::is('bidrfq.index')) ? 'active' : '' }}"  href="{{route('bidrfq.index')}}">View RFQ</a></li>
                  <li class="nav-item" > <a class="nav-link {{ (Route::is('wonproject.viewsalesfigures')) ? 'active' : '' }}"  href="{{route('wonproject.viewsalesfigures')}}">View Sales Figures</a></li>
                  <li class="nav-item {{ (Route::is('wonproject.perfomance')) ? 'active' : '' }}" id="view_sales_figure">  <a class="nav-link " href="{{route('wonproject.perfomance')}}">Performance</a></li>
                  <li class="nav-item" > <a class="nav-link {{ (Route::is('salesdashboard')) ? 'active' : '' }}"  href="{{route('salesdashboard')}}">Overview</a></li>
                  
                <li class="nav-item" style="padding-left: 10px;">
                 <a class="nav-link" style="padding-left:27px;" data-toggle="collapse" href="#ui-basic1" aria-expanded="false" aria-controls="ui-basic">
                 <span class="menu-title">Project Status</span>
                 <i class="menu-arrow"></i>
                 <i class="mdi mdi-table-large menu-icon"></i>
                 </a>
                <div class="collapse" id="ui-basic1">
                  <ul class="nav flex-column sub-menu1">
                     <li class="nav-item Commissioned {{ (Route::is('wonproject.index')) ? 'active' : '' }}" > <a class="nav-link " href="{{route('wonproject.index')}}">Commissioned Project</a></li>
                     <li class="nav-item completed Commissioned {{ (Route::is('wonproject.completed')) ? 'active' : '' }}" > <a class="nav-link " href="{{route('wonproject.completed')}}">Completed Commissioned Project</a></li>
                     <li class="nav-item lost {{ (Route::is('bidrfq.lostproject')) ? 'active' : '' }}" > <a class="nav-link " href="{{route('bidrfq.lostproject')}}">Lost Project</a></li>
                     <li class="nav-item followup  {{ (Route::is('bidrfq.index')) ? 'active' : '' }}" > <a class="nav-link" href="{{route('bidrfq.index')}}">RFQ Follow Up</a></li>
                </ul>
              </div>
              </li>
                </div>
                </ul>

              </div>
            </li>
             
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic2" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Operations Head</span>
                <i class="menu-arrow"></i>
                <i class="fas fa-users-cog"></i>
              </a>
              <div class="collapse" id="ui-basic2">
                <ul class="nav flex-column sub-menu1">
                   <li class="nav-item {{ (Route::is('operationNew.createWon')) ? 'active' : '' }}"> <a class="nav-link"  href="{{route('operationNew.createWon')}}">New Projects</a></li>
                  <li class="nav-item {{ (Route::is('operationNew.index')) ? 'active' : '' }}"> <a class="nav-link" href="{{route('operationNew.index')}}">Existing Projects </a></li>
                  <li class="nav-item {{ (Route::is('operationNew.indexclose')) ? 'active' : '' }}"> <a class="nav-link" href="{{route('operationNew.indexclose')}}">Closed Projects</a></li>
                  <li class="nav-item {{ (Route::is('operationNew.operation')) ? 'active' : '' }}"> <a class="nav-link" href="{{route('operationNew.operation')}}">Project Status </a></li>
                   <li class="nav-item {{ (Route::is('operationNew.operationperfomance')) ? 'active' : '' }}"> <a class="nav-link" href="{{route('operationNew.operationperfomance')}}">Performance</a></li>
                  <li class="nav-item {{ (Route::is('operationdashboard')) ? 'active' : '' }}"> <a class="nav-link" href="{{route('operationdashboard')}}">Overview</a></li>
                </ul>
              </div>
            </li>
             <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic3" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Project Manager</span>
                <i class="menu-arrow"></i>
                <i class="fas fa-user-shield"></i>
              </a>
              <div class="collapse" id="ui-basic3">
                <ul class="nav flex-column sub-menu1">
                  <li class="nav-item {{ (Route::is('operationNew.indexpm')) ? 'active' : '' }}"> <a class="nav-link" href="{{route('operationNew.indexpm')}}">Existing Projects</a></li>
                  <!--<li class="nav-item {{ (Route::is('operationNew.add_field_team')) ? 'active' : '' }}"> <a class="nav-link" href="{{route('operationNew.add_field_team')}}">ADD FIELD PROJECTS</a></li>-->
                  <!--<li class="nav-item {{ (Route::is('operationdashboard')) ? 'active' : '' }}"> <a class="nav-link" href="{{route('operationdashboard')}}">OVERVIEW</a></li>-->
                   <li class="nav-item {{ (Route::is('operationNew.fieldperfomance')) ? 'active' : '' }}"> <a class="nav-link" href="{{route('operationNew.fieldperfomance')}}">Performance</a></li>
                   <li class="nav-item"> <a class="nav-link" href="{{route('fieldteamDashboard')}}">Overview</a></li>
                   
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Accounts</span>
                <i class="menu-arrow"></i>
               <i class="fas fa-briefcase"></i>
              </a>
              <div class="collapse" id="ui-basic4">
                <ul class="nav flex-column sub-menu1">
                  <!--<li class="nav-item"> <a class="nav-link" href="{{route('accounts.overview')}}">OVERVIEW</a></li>-->
                 <li class="accounts-sub">
                     <a class="nav-link" style="padding-left:25px;" data-toggle="collapse" href="#ui-basic44" aria-expanded="false" aria-controls="ui-basic">
                      <span class="menu-title">Client Receivable</span>
                      <i class="menu-arrow"></i>
                      <!--<i class="mdi mdi-table-large menu-icon"></i>-->
                      </a>
                  <div class="collapse" id="ui-basic44">
                      <ul class="nav flex-column sub-menu1">
                           <li class="nav-item {{(Route::is('accounts.clientrequestadvance')) ? 'active' : ''}}"> <a class="nav-link"  style="font-size: 0.73rem !important;" href="{{route('accounts.clientrequestadvance')}}">Client Invoice Request</a></li>
                           <li class="nav-item {{(Route::is('accounts.payment')) ? 'active' : ''}}"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.payment')}}">Client Payment Awaited</a></li>
                           <li class="nav-item {{(Route::is('accounts.paymentreceived')) ? 'active' : ''}}"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.paymentreceived')}}">Client Payment Received</a></li>
                           <!--<li class="nav-item {{(Route::is('accounts.clientpending')) ? 'active' : ''}}"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.clientpending')}}">CLIENT INVOICE PENDING</a></li>-->
                      </ul>
                  </div>
                 </li>
                  <li class="accounts-sub">
                     <a class="nav-link" style="padding-left:27px;" data-toggle="collapse" href="#ui-basic444" aria-expanded="false" aria-controls="ui-basic">
                      <span class="menu-title">Vendor Payable</span>
                      <i class="menu-arrow"></i>
                      <!--<i class="mdi mdi-table-large menu-icon"></i>-->
                      </a>
                  <div class="collapse" id="ui-basic444">
                      <ul class="nav flex-column sub-menu1">
                             <li class="nav-item"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.Vendorrequestadvance')}}">Vendor Invoice Request</a></li>
                             <li class="nav-item"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.vendorpayment')}}">Vendor Payment Due</a></li>
                             <li class="nav-item"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.vendorreceived')}}">Vendor Payment Made</a></li>
                             <li class="nav-item"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.accountoverview')}}">Overview </a></li>
                      </ul>
                  </div>
                 </li>
                
                  <!--<li class="nav-item {{(Route::is('accounts.accountoverview')) ? 'active' : ''}}"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.accountoverview')}}">OVERVIEW </a></li>-->
                  
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic5" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Supplier Management</span>
                <i class="menu-arrow"></i>
                <i class="fas fa-baby-carriage"></i>
              </a>
              <div class="collapse" id="ui-basic5">
                <ul class="nav flex-column sub-menu1">
                 <li class="nav-item {{(Route::is('Supplier.create')) ? 'active' : ''}}"> <a class="nav-link" style="font-size:0.83rem   !important;margin-left:-4px !important;" href="{{route('Supplier.create')}}">Add Supplier</a></li>
                  <li class="nav-item {{(Route::is('Supplier.index')) ? 'active' : ''}}"> <a class="nav-link"  style="font-size:0.83rem   !important;margin-left:-4px !important;" href="{{route('Supplier.index')}}">View Supplier </a></li>
                  <li class="nav-item {{(Route::is('SuperLiner.cost')) ? 'active' : ''}}"> <a class="nav-link"  style="font-size:0.83rem   !important;margin-left:-4px !important;" href="{{route('SuperLiner.cost')}}">Cost Request (RFQ) </a></li>
                  <li class="nav-item {{(Route::is('supplier.costRequestView')) ? 'active' : ''}}"> <a class="nav-link"  style="font-size:0.83rem   !important;margin-left:-4px !important;"  href="{{route('supplier.costRequestView')}}">Total Cost Requests (RFQ) </a></li>
                   {{-- <li class="nav-item {{(Route::is('supplier.performance')) ? 'active' : ''}}"> <a class="nav-link" style="font-size:0.83rem   !important;margin-left:-4px !important;" href="{{route('supplier.performance')}}">Performance</a></li>
                  <!--<li class="nav-item"> <a class="nav-link"  href="{{route('supplier.view')}}">View Supplier</a></li>-->
                  <li class="nav-item {{(Route::is('supplier.overview')) ? 'active' : ''}}"> <a class="nav-link" style="font-size:0.83rem   !important;margin-left:-4px !important;" href="{{route('supplier.overview')}}">Overview</a></li>  <!--style="font-size: 0.73rem !important;"--> --}}
                  <li class="nav-item {{(Route::is('supplier.dashboard')) ? 'active' : ''}}"> <a class="nav-link"  style="font-size:0.83rem   !important;margin-left:-4px !important;"  href="{{route('supplier.dashboard')}}">Dashboard </a></li>
                  
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic6" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Data Center</span>
                <i class="menu-arrow"></i>
               <i class="fas fa-user-nurse"></i>
              </a>
              <div class="collapse" id="ui-basic6">
                <ul class="nav flex-column sub-menu1">
                    @if(auth()->user()->user_type == 'datacenter')
                    <li class="nav-item" > <a class="nav-link"   href="{{route('dataCenternew', ['id' => $user_id])}}">New Registrations</a></li>
                    
                    
                    @endif
                  <!--@if(auth()->user()->user_type == 'doctor')-->
                  <!--<li class="nav-item {{ (Route::is('receive.money')) ? 'active' : '' }}" ><a class="nav-link" href="{{route('receive.money')}}">Receive Money</a></li>-->
                  <!--{{-- <li class="nav-item {{ (Route::is('mailexample')) ? 'active' : '' }}" > <a class="nav-link" href="{{route('mailexample')}}">Mail blade example</a></li> --}}-->
                  <!--@endif-->
                  @if(auth()->user()->user_type == 'admin')
                  <li class="nav-item" > <a class="nav-link"   href="{{route('dataCenternew', ['id' => $user_id])}}">New Registrations</a></li>
                  <li class="nav-item {{ (Route::is('adminactivedview')) ? 'active' : '' }}"  ><a class="nav-link"  href="{{route('adminactivedview')}}"> View Registration</a></li>
                  {{-- <li class="nav-item {{ (Route::is('Money.send')) ? 'active' : '' }}"   ><a class="nav-link"  href="{{route('Money.send')}}"> Send Money/Voucher </a></li>
                  
                  <li class="nav-item {{ (Route::is('Money.bulksend')) ? 'active' : '' }}"   ><a class="nav-link"  href="{{route('Money.bulksend')}}"> Bulk Send Money</a></li>
                 
                  <li class="nav-item  {{ (Route::is('reddemAcept')) ? 'active' : '' }}" ><a class="nav-link" href="{{route('reddemAcept')}}">Redeem Accepted List</a></li>  --}}
                  <li class="nav-item {{ (Route::is('account.datafillter')) ? 'active' : '' }}" > <a class="nav-link" href="{{route('account.datafillter')}}">Inbox</a></li>
                  <li class="nav-item {{ (Route::is('doctorlist')) ? 'active' : '' }}" ><a class="nav-link" href="{{route('doctorlist')}}">Doctor Document</a></li> 
                  <li class="nav-item {{ (Route::is('viewQus')) ? 'active' : '' }}"><a class="nav-link" href="{{route('viewQus')}}">View User</a></li>
                  <li class="nav-item {{ (Route::is('datacenter.performance')) ? 'active' : '' }}" ><a class="nav-link" href="{{route('datacenter.performance')}}">Performance</a></li> 
                  <li class="nav-item"><a class="nav-link" href="{{route('admincenterverview')}}">Overview</a></li>
                   <!--<li class="nav-item"><a class="nav-link" href="{{route('accountRegisterList')}}"> Doctor Banking Detail</a></li> -->
                  @endif
                 </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic7" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Hcp Registration</span>
                <i class="menu-arrow"></i>
               <i class="fas fa-user-nurse"></i>
              </a>
              <div class="collapse" id="ui-basic7">
                <ul class="nav flex-column sub-menu1">
                  @if(auth()->user()->user_type == 'admin')
                  <li class="nav-item" ><a class="nav-link" href="{{route('dataCenternew', ['id' => $user_id])}}">New Registrations</a></li>
                  <li class="nav-item" ><a class="nav-link" href="{{route('hcpPanelInvite')}}">View  Registration</a></li>

                  @endif
                 </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic8" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Consumer Registration</span>
                <i class="menu-arrow"></i>
               <i class="fas fa-user-nurse"></i>
              </a>
              <div class="collapse" id="ui-basic8">
                <ul class="nav flex-column sub-menu1">
                  @if(auth()->user()->user_type == 'admin')
                  <li class="nav-item" > <a class="nav-link"   href="{{ route('consumerform', ['id' => $user_id]) }}">New Registrations</a></li>
                  <li class="nav-item" ><a class="nav-link" href="{{route('consumerRegistration')}}">View  Registration</a></li>
                  @endif
                 </ul>
              </div>
            </li>

            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic9" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Global Panel Team</span>
                <i class="menu-arrow"></i>
                <i class="fas fa-user-nurse"></i>
              </a>
              <div class="collapse" id="ui-basic9">
                <ul class="nav flex-column sub-menu1">
                  @if(auth()->user()->user_type == 'admin')
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('dataCenternew', ['id' => $user_id]) }}">HCP Registrations</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('consumerform', ['id' => $user_id]) }}">Consumer Registrations</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-global-panel-manager" aria-expanded="false" aria-controls="ui-global-panel-manager">
                      Global Panel Manager
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-global-panel-manager">
                      <ul class="nav flex-column sub-menu2">
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('get.recruitment') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{route('employee.list')}}">Panel Team Employee Dashboard</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('globalManagerList') }}">Total Registered Panelists</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('panelMemberList') }}">Panel Participation Incentive</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('PaymentsView') }}">Payment to panel Member</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('ProjectFeasibility') }}">New Project/ Feasbility Request</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('projectFeasibility.list') }}">Search Feasibility Projects</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('project.existing') }}">Existing Feasibility Projects</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('projectFeasibility.closed') }}">Closed Feasibility Projects</a>
                        </li>
                      </ul>
                    </div>
                  </li>
                  @endif
                </ul>
              </div>
            </li>



            @elseif(auth()->user()->user_type == 'doctor')
             <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic11" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Doctor</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic11">
                <ul class="nav flex-column sub-menu1">
                  <li class="nav-item {{(Route::is('doctor.profile')) ? 'active' : ''}}" ><a class="nav-link" href="{{url('/adminapp/doctor')}}">Profile</a></li>
                  <li class="nav-item {{ (Route::is('doctor.documents')) ? 'active' : '' }}" > <a class="nav-link" href="{{route('doctor.documents')}}"> Upload Documents</a></li>
                  <li class="nav-item {{ (Route::is('receive.money')) ? 'active' : '' }}" ><a class="nav-link" href="{{route('receive.money')}}">Receive Money</a></li>
                  <li class="nav-item {{ (Route::is('receive.voucher')) ? 'active' : '' }}" ><a class="nav-link" href="{{route('receive.voucher')}}">Receive Voucher</a></li>
                  <!--<li class="nav-item"><a class="nav-link" href="{{route('account.registration')}}">Account Registration</a></li>-->
                  </ul>
              </div>
            </li>
            @elseif(auth()->user()->user_type == 'user')
             <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic12" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Hcp Registration</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic12">
                <ul class="nav flex-column sub-menu1">
                  <li class="nav-item" > <a class="nav-link"   href="{{route('dataCenternew', ['id' => $user_id])}}">New Registrations</a></li>
                  <li class="nav-item" id="invite"> <a class="nav-link" href="{{route('invite')}}" >Hcp Bulk Registration Invite</a></li>
                   <li class="nav-item" id="invite"> <a class="nav-link" href="{{route('panelist')}}" >Send Email to Panelist</a></li>
                  <li class="nav-item {{(Route::is('user.userhcplist')) ? 'active' : ''}}" ><a class="nav-link" href="{{route('userHcpList')}}">View Registration</a></li>      
                </ul>
              </div>
            </li>
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic13" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Consumer Registration</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic13">
                <ul class="nav flex-column sub-menu1">
                  <li class="nav-item" > <a class="nav-link"   href="{{ route('consumerform', ['id' => $user_id]) }}">New Registrations</a></li>
                  <li class="nav-item" id="invite"> <a class="nav-link" href="{{route('popinvite')}}" >Consumer bulk Registration</a></li>
                   <li class="nav-item" id="invite"> <a class="nav-link" href="{{route('emailPanel')}}" >Send Email to Consumer</a></li>
                  <li class="nav-item {{(Route::is('user.userconsumerlist')) ? 'active' : ''}}" ><a class="nav-link" href="{{route('user.consumer.list')}}">View Registration</a></li>
                  </ul>
              </div>
            </li>

            <li class="nav-item">
              <li class="nav-item" > <a class="nav-link" href="{{ route('ProjectFeasibility') }}">New Project/ Feasbility Request</a>
            </li>
            <li class="nav-item">
              <li class="nav-item" > <a class="nav-link" href="{{ route('projectFeasibility.list') }}">Search Feasibility Projects</a>
            </li>

            @elseif(auth()->user()->user_type == 'global_team')
            <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#ui-basic12" aria-expanded="false" aria-controls="ui-basic">
               <span class="menu-title">Hcp Registration</span>
               <i class="menu-arrow"></i>
               <i class="mdi mdi-format-list-bulleted menu-icon"></i>
             </a>
             <div class="collapse" id="ui-basic12">
               <ul class="nav flex-column sub-menu1">
                 <li class="nav-item" > <a class="nav-link"   href="{{ route('dataCenternew', ['id' => $user_id]) }}">New Registrations</a></li>
                 <li class="nav-item" id="invite"> <a class="nav-link" href="{{route('invite')}}" >Hcp Bulk Registration Invite</a></li>
                  <li class="nav-item" id="invite"> <a class="nav-link" href="{{route('panelist')}}" >Send Email to Panelist</a></li>
                 <li class="nav-item {{(Route::is('user.userhcplist')) ? 'active' : ''}}" ><a class="nav-link" href="{{route('userHcpList')}}">View Registration</a></li>
                 </ul>
             </div>
           </li>
           <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#ui-basic13" aria-expanded="false" aria-controls="ui-basic">
               <span class="menu-title">Consumer Registration</span>
               <i class="menu-arrow"></i>
               <i class="mdi mdi-format-list-bulleted menu-icon"></i>
             </a>
             <div class="collapse" id="ui-basic13">
               <ul class="nav flex-column sub-menu1">
                 <li class="nav-item" > <a class="nav-link"   href="{{ route('consumerform', ['id' => $user_id]) }}">New Registrations</a></li>
                 <li class="nav-item" id="invite"> <a class="nav-link" href="{{route('popinvite')}}" >Consumer bulk Registration</a></li>
                  <li class="nav-item" id="invite"> <a class="nav-link" href="{{route('emailPanel')}}" >Send Email to Consumer</a></li>
                 <li class="nav-item {{(Route::is('user.userconsumerlist')) ? 'active' : ''}}" ><a class="nav-link" href="{{route('user.consumer.list')}}">View Registration</a></li>
                 </ul>
             </div>
           </li>

           <li class="nav-item">
             <li class="nav-item" > <a class="nav-link" href="{{ route('ProjectFeasibility') }}">New Project/ Feasbility Request</a>
           </li>
           <li class="nav-item">
             <li class="nav-item" > <a class="nav-link" href="{{ route('projectFeasibility.list') }}">Search Feasibility Projects</a>
           </li>
            
            @elseif(auth()->user()->user_type == 'global_manager')
            
            {{-- <li class="nav-item">
             <a class="nav-link" data-toggle="collapse" href="#ui-basic14" aria-expanded="false" aria-controls="ui-basic">
               <span class="menu-title">Global Panel Team</span>
               <i class="menu-arrow"></i>
               <i class="mdi mdi-format-list-bulleted menu-icon"></i>
             </a>
             <div class="collapse" id="ui-basic14">
               <ul class="nav flex-column sub-menu1">
                 <li class="nav-item" > <a class="nav-link"   href="{{route('dataCenternew', ['id' => $user_id])}}">Hcp Registrations</a></li>
                 <li class="nav-item" > <a class="nav-link"   href="{{ route('consumerform', ['id' => $user_id]) }}">Consumer Registrations</a></li>
                 <li class="nav-item" > <a class="nav-link"   href="#">View Global Registrations</a></li> 
                </ul>
                
              </div>
            </li> --}}
             <li class="nav-item">
                    <a class="nav-link" data-toggle="collapse" href="#ui-global-panel-manager" aria-expanded="false" aria-controls="ui-global-panel-manager">
                      <span class="menu-title">Global Panel Team</span>
                      <i class="menu-arrow"></i>
                    </a>
                    <div class="collapse" id="ui-global-panel-manager">
                      <ul class="nav flex-column sub-menu1">
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('get.recruitment') }}">Dashboard</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{route('employee.list')}}">Panel Team Employee Dashboard</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('globalManagerList') }}">Total Registered Panelists</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('panelMemberList') }}">Panel Participation Incentive</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('PaymentsView') }}">Payment to panel Member</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('ProjectFeasibility') }}">New Project/ Feasbility Request</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('projectFeasibility.list') }}">Search Feasibility Projects</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('project.existing') }}">Existing Feasibility Projects</a>
                        </li>
                        <li class="nav-item">
                          <li class="nav-item" > <a class="nav-link" href="{{ route('projectFeasibility.closed') }}">Closed Feasibility Projects</a>
                        </li>
                      </ul>
                    </div>
                  </li>
            @elseif(auth()->user()->user_type == 'data_center')
            <li class="nav-item" > <a class="nav-link"   href="{{route('dataCenternew', ['id' => $user_id])}}">New Registrations</a></li>
            <li class="nav-item" id="invite"> <a class="nav-link" href="{{route('invite')}}" >Hcp Panel Registration Invite</a></li>
            <li class="nav-item" id="invite"> <a class="nav-link" href="{{route('popinvite')}}" >Consumer Registration Invite</a></li>
            <li class="nav-item" id="invite"> <a class="nav-link" href="{{route('panelist')}}" >Send Email to Panelist</a></li>
             <!--<li class="nav-item {{ (Route::is('adminactivedview')) ? 'active' : '' }}"  ><a class="nav-link"  href="{{route('adminactivedview')}}"> View Registration</a></li>-->
             
                     <!--<li class="nav-item {{ (Route::is('Money.send')) ? 'active' : '' }}"   ><a class="nav-link"  href="{{route('Money.send')}}"> Send Money/Voucher </a></li>-->
                  
                     <!--<li class="nav-item {{ (Route::is('Money.bulksend')) ? 'active' : '' }}"   ><a class="nav-link"  href="{{route('Money.bulksend')}}"> Bulk Send Money</a></li>-->
                 
                     <!--<li class="nav-item  {{ (Route::is('reddemAcept')) ? 'active' : '' }}" ><a class="nav-link" href="{{route('reddemAcept')}}">Redeem Accepted List</a></li> -->
                     <!--<li class="nav-item {{ (Route::is('account.datafillter')) ? 'active' : '' }}" > <a class="nav-link" href="{{route('account.datafillter')}}">Inbox</a></li>-->
                     <!--<li class="nav-item {{ (Route::is('doctorlist')) ? 'active' : '' }}" ><a class="nav-link" href="{{route('doctorlist')}}">Doctor Document</a></li> -->
                     <!--<li class="nav-item"><a class="nav-link" href="{{route('admincenterverview')}}">Overview</a></li>-->
            
            @elseif((auth()->user()->user_type == 'operation') || (auth()->user()->user_type == 'admin'))
             <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Operations</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu1">
                   {{-- <li class="nav-item"> <a class="nav-link" {{ (Route::is('operationNew.createWon')) ? 'active' : '' }} href="{{route('operationNew.createWon')}}">NEW PROJECT</a></li> --}}
                  <li class="nav-item"> <a class="nav-link" href="{{route('operationNew.indexpm')}}">EXISTING PROJECTS </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('operationNew.indexclose')}}">CLOSED PROJECTS</a></li>
                  <!--<li class="nav-item"> <a class="nav-link" href="{{route('operationNew.add_field_team')}}">ADD FIELD TEAM</a></li>-->
                  <li class="nav-item"> <a class="nav-link" href="{{route('operationNew.operation')}}">PROJECT STATUS </a></li>
                  @if(auth()->user()->user_type == "operation")
                  <li class="nav-item d-none"> <a class="nav-link" href="{{route('dashboard')}}">OVERVIEW</a></li>
                  @endif
                  <!--<li class="nav-item"> <a class="nav-link" href="#">DATA CENTER</a></li>-->
                </ul>
              </div>
            </li>

             
            @elseif(auth()->user()->user_type == 'operation_head')
             <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Operations</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu1">
                   <li class="nav-item"> <a class="nav-link" {{ (Route::is('operationNew.createWon')) ? 'active' : '' }} href="{{route('operationNew.createWon')}}">NEW PROJECT</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('operationNew.index')}}">EXISTING PROJECTS </a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('operationNew.indexclose')}}">CLOSED PROJECTS</a></li>
                  <!--<li class="nav-item"> <a class="nav-link" href="{{route('operationNew.add_field_team')}}">ADD FIELD TEAM</a></li>-->
                  <li class="nav-item"> <a class="nav-link" href="{{route('operationNew.operation')}}">PROJECT STATUS </a></li>
                  @if(auth()->user()->user_type == "operation")
                  <li class="nav-item d-none"> <a class="nav-link" href="{{route('dashboard')}}">OVERVIEW</a></li>
                  @endif
                  <!--<li class="nav-item"> <a class="nav-link" href="#">DATA CENTER</a></li>-->
                </ul>
              </div>
            </li>
            
             @elseif((auth()->user()->user_type == 'field_team') || (auth()->user()->user_type == 'admin'))
             <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic6" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Field Team</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-format-list-bulleted menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic6">
                <ul class="nav flex-column sub-menu1">
                  <li class="nav-item"> <a class="nav-link" href="{{route('operationNew.field')}}">EXISTING PROJECTS</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('operationNew.fieldclose')}}">CLOSED PROJECTS</a></li>
                  <li class="nav-item"> <a class="nav-link" href="{{route('fieldteamDashboard')}}">OVERVIEW</a></li>
                </ul>
              </div>
            </li>
            
             @elseif((auth()->user()->user_type == 'accounts') || (auth()->user()->user_type == 'admin'))
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Accounts</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu1">
                  <!--<li class="nav-item"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.overview')}}">OVERVIEW</a></li>-->
                  <li class="accounts-sub">
                     <a class="nav-link" style="padding-left:25px;" data-toggle="collapse" href="#ui-basic44" aria-expanded="false" aria-controls="ui-basic">
                      <span class="menu-title">Client Receivable</span>
                      <i class="menu-arrow"></i>
                      <!--<i class="mdi mdi-table-large menu-icon"></i>-->
                      </a>
                  <div class="collapse" id="ui-basic44">
                      <ul class="nav flex-column sub-menu1">
                           <li class="nav-item {{(Route::is('accounts.clientrequestadvance')) ? 'active' : ''}}"> <a class="nav-link"  style="font-size: 0.73rem !important;" href="{{route('accounts.clientrequestadvance')}}">CLIENT INVOICE REQUEST</a></li>
                           <li class="nav-item {{(Route::is('accounts.payment')) ? 'active' : ''}}"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.payment')}}">CLIENT PAYMENT AWAITED</a></li>
                           <li class="nav-item {{(Route::is('accounts.paymentreceived')) ? 'active' : ''}}"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.paymentreceived')}}">CLIENT PAYMENT RECEIVED</a></li>
                           <!--<li class="nav-item {{(Route::is('accounts.clientpending')) ? 'active' : ''}}"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.clientpending')}}">CLIENT INVOICE PENDING</a></li>-->
                      </ul>
                  </div>
                 </li>
                  <li class="accounts-sub">
                     <a class="nav-link" style="padding-left:27px;" data-toggle="collapse" href="#ui-basic444" aria-expanded="false" aria-controls="ui-basic">
                      <span class="menu-title">Vendor Payable</span>
                      <i class="menu-arrow"></i>
                      <!--<i class="mdi mdi-table-large menu-icon"></i>-->
                      </a>
                  <div class="collapse" id="ui-basic444">
                      <ul class="nav flex-column sub-menu1">
                             <li class="nav-item"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.Vendorrequestadvance')}}">VENDOR INVOICE REQUEST</a></li>
                             <li class="nav-item"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.vendorpayment')}}">VENDOR PAYMENT DUE</a></li>
                             <li class="nav-item"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.vendorreceived')}}">VENDOR PAYMENT MADE</a></li>
                             <!--<li class="nav-item"> <a class="nav-link" style="font-size: 0.73rem !important;" href="{{route('accounts.vendorpending')}}">VENDOR INVOICE PENDING</a></li>-->
                      </ul>
                  </div>
                 </li>
                    @if(auth()->user()->user_type =="accounts")
                
                   @endif
                </ul>
              </div>
            </li>
            
             @elseif(auth()->user()->user_type == 'admin')
             <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Supplier Management</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic4">
                <ul class="nav flex-column sub-menu1">
                  <li class="nav-item"> <a class="nav-link" style="font-size:0.83rem   !important;margin-left:-4px !important;" href="{{route('Supplier.create')}}">Add Supplier</a></li>
                  <li class="nav-item"> <a class="nav-link" style="font-size:0.83rem   !important;margin-left:-4px !important;"  href="{{route('Supplier.index')}}">View Supplier </a></li>
                  <li class="nav-item"> <a class="nav-link" style="font-size:0.83rem   !important;margin-left:-4px !important;"  href="{{route('SuperLiner.cost')}}">Cost Request (RFQ) </a></li>
                  <li class="nav-item"> <a class="nav-link" style="font-size: 0.83rem  !important;margin-left:-4px !important;"  href="{{route('supplier.costRequestView')}}">Total Cost Requests (RFQ) </a></li>
                  <!--<li class="nav-item"> <a class="nav-link"  href="{{route('supplier.view')}}">View Supplier</a></li>-->
                  @if(auth()->user()->user_type =="supplier")
                  <li class="nav-item d-none"> <a class="nav-link"  style="font-size:0.83rem   !important;margin-left:-4px !important;" href="{{route('supplier.overview')}}">Overview</a></li>  <!--style="font-size: 0.73rem !important;"-->
                  @endif
                  
                </ul>
              </div>
            </li>
            @elseif(auth()->user()->user_type == 'supplier')
            <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic4" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Supplier Management</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic4">
                <ul class="nav flex-column sub-menu1">
                  <li class="nav-item"> <a class="nav-link" style="font-size:0.83rem   !important;margin-left:-4px !important;" href="{{route('Supplier.create')}}">Add Supplier</a></li>
                  <li class="nav-item"> <a class="nav-link" style="font-size:0.83rem   !important;margin-left:-4px !important;"  href="{{route('SuperLiner.cost')}}">Cost Request (RFQ) </a></li>
                  <li class="nav-item"> <a class="nav-link" style="font-size: 0.83rem  !important;margin-left:-4px !important;"  href="{{route('supplier.costRequestView')}}">Total Cost Requests (RFQ) </a></li>
                  <!--<li class="nav-item"> <a class="nav-link"  href="{{route('supplier.view')}}">View Supplier</a></li>-->
                </ul>
              </div>
            </li>
             
            
            {{-- <li class="nav-item">
              <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">
                <span class="menu-title">Field Item</span>
                <i class="menu-arrow"></i>
                <i class="mdi mdi-table-large menu-icon"></i>
              </a>
              <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                  <li class="nav-item"> <a class="nav-link" href="#">NEW PROJECT</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">EXISTING PROJECTS </a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">CLOSED PROJECTS</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">VIEW PROJECT </a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">PROJECT STATUS</a></li>
                  <li class="nav-item"> <a class="nav-link" href="#">OVERVIEW</a></li>
                </ul>
              </div>
            </li> --}}
            <!--<li class="nav-item">-->
            <!--  <a class="nav-link" data-toggle="collapse" href="#ui-basic" aria-expanded="false" aria-controls="ui-basic">-->
            <!--    <span class="menu-title">Supplier</span>-->
            <!--    <i class="menu-arrow"></i>-->
            <!--    <i class="mdi mdi-table-large menu-icon"></i>-->
            <!--  </a>-->
            <!--  <div class="collapse" id="ui-basic">-->
            <!--    <ul class="nav flex-column sub-menu">-->
            <!--      <li class="nav-item"> <a class="nav-link" href="{{route('Supplier.create')}}">Add Supplier</a></li>-->
            <!--      <li class="nav-item"> <a class="nav-link" href="{{route('Supplier.index')}}">Edit Supplier </a></li>-->
            <!--      <li class="nav-item"> <a class="nav-link" href="#">CLOSED PROJECTS</a></li>-->
            <!--      <li class="nav-item"> <a class="nav-link" href="#">VIEW PROJECT </a></li>-->
            <!--      <li class="nav-item"> <a class="nav-link" href="#">PROJECT STATUS</a></li>-->
            <!--      <li class="nav-item"> <a class="nav-link" href="#">OVERVIEW</a></li>-->
            <!--    </ul>-->
            <!--  </div>-->
            <!--</li>-->
            @endif


          </ul>
        </nav>
        <!-- partial -->
        <div class="main-panel">
        @yield('content')
          <!-- content-wrapper ends -->
          <!-- partial:partials/_footer.html -->
          <footer class="footer mt-4">
            <div class="container-fluid clearfix">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © arp.com <?php echo date('Y') ?></span>
              <!--<span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin templates </a> from Bootstrapdash.com</span>-->
            </div>
          </footer>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/js/all.min.js" integrity="sha512-cyAbuGborsD25bhT/uz++wPqrh5cqPh1ULJz4NSpN9ktWcA6Hnh9g+CWKeNx2R0fgQt+ybRXdabSBgYXkQTTmA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- container-scroller -->
    <!-- plugins:js -->


    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="{{asset('adminapp/assets/vendors/chart.js/Chart.min.js')}}"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="{{asset('adminapp/assets/js/off-canvas.js')}}"></script>
    <script src="{{asset('adminapp/assets/js/hoverable-collapse.js')}}"></script>
    <script src="{{asset('adminapp/assets/js/misc.js')}}"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    {{-- <script src="{{asset('adminapp/assets/js/dashboard.js')}}"></script> --}}
    <script src="{{asset('adminapp/assets/js/todolist.js')}}"></script>
    <script src="{{asset('adminapp/assets/js/validate.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>
    <!-- End custom js for this page -->

    <script>
      $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(document).on('click','.navbar-toggler',function(){
  
})

$(document).on('click','#nav-button',function(){
    $('#top-body').toggleClass('sidebar-icon-only');
});


   </script>
     <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
  <script>
    AOS.init();
  </script>

    @yield('scripts')

  </body>
</html>


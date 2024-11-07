<div class="navbar navbar-expand-md primary_color logo-header">
    <div class="col-md-2 d-flex justify-content-between">
    <div class="mt-2 text-center">
        <a href="{{ route('dashboard') }}" class="d-inline-block logo">
        <img src="{{ asset('global_assets/images/primary.png') }}" alt="">
        </a>
    </div>
  {{--  <div class="navbar-brand">
        <a href="index.html" class="d-inline-block"> logo
            <img src="{{ asset('global_assets/images/primary.png') }}" alt="">
        </a>
    </div>--}}

    <div class="d-md-none">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-mobile">
            <i class="icon-tree5"></i>
        </button>
        <button class="navbar-toggler sidebar-mobile-main-toggle" type="button">
            <i class="icon-paragraph-justify3"></i>
        </button>
    </div>
    </div>
    <div class="col-md-10">
        <div class="collapse navbar-collapse ml-0" id="navbar-mobile">
            <div class="topnav">
              <div class="search-container">
                <form action="">
                  <input type="text" placeholder="Search colleages, files, announcements.." name="search">
                  <button type="submit"><i class="fa fa-search"></i></button>
                </form>
              </div>
            </div>
            <!-- <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="#" class="navbar-nav-link sidebar-control sidebar-main-toggle d-none d-md-block ">
                        <i class="icon-paragraph-justify3 text-white"></i>
                    </a>
                </li>


            </ul> -->

    			<span class="navbar-text ml-md-3 mr-md-auto"></span>

            <ul class="navbar-nav">
            @php
            $error = url('images/error.png');
            $invites = url('images/invites.png');
            $bell = url('images/bel.png');
            @endphp
                <li class="nav-item dropdown dropdown-user d-flex align-items-center">
                    <div class="notifications">
                    <img src="{{$invites}}" class="notification1" alt="Invites" style="margin-right: 10px;" data-toggle="dropdown" data-id="mail-notification">
                    <span class="notification notification1 other-notify invites" data-toggle="dropdown" data-id="mail-notification">0</span>
                    <img src="{{$bell}}" class="notification1" alt="Notification" style="margin-right: -13px;" data-toggle="dropdown" data-id="normal-notification">
                    <span class="notification notification1 other-notify bell" data-toggle="dropdown" data-id="normal-notification">0</span>
                    <div class="dropdown-menu dropdown-menu-right p-0 notify-dropdown" id="notify" style="width:300px">
                        <div class="mail-notify d-none">
                            <div class="d-flex align-items-center justify-content-between notify-header p-15">
                                <label class="notify-label-1 mb-0">Message</label>
                                <a href="#" class="notify-label-2">Settings</a>
                            </div>
                            <div class="notify-content ">
                                <div class="d-flex justify-content-start align-items-start py-2 px-3 pb-gray">
                                    <img src="{{asset('images/icons/Oval (2).png')}}">
                                    <div class="d-flex flex-column justify-content-start pl-3">
                                        <label for="" class="notify-label-5">Arlene McCoy</label>
                                        <label for="" class="notify-label-6">Teacher ・2m ago</label>
                                        <label for="" class="notify-label-6">asking about new updates in lesson 03 Assignment</label>

                                    </div>
                                </div>
                                <div class="d-flex justify-content-start align-items-start py-2 px-3 pb-gray">
                                    <img src="{{asset('images/icons/Oval (1).png')}}">
                                    <div class="d-flex flex-column justify-content-start pl-3">
                                        <label for="" class="notify-label-5">Jerome Bell</label>
                                        <label for="" class="notify-label-6">Teacher ・2m ago</label>
                                        <label for="" class="notify-label-6">asking about new updates in lesson 03 Assignment</label>

                                    </div>
                                </div>
                                <div class="d-flex justify-content-start align-items-start py-2 px-3 pb-gray">
                                    <img src="{{asset('images/icons/Oval (3).png')}}">
                                    <div class="d-flex flex-column justify-content-start pl-3">
                                        <label for="" class="notify-label-5">Jacob Jones</label>
                                        <label for="" class="notify-label-6">Teacher ・2m ago</label>
                                        <label for="" class="notify-label-6">asking about new updates in lesson 03 Assignment</label>

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center flex-column pb-2 empty-notify d-none ">
                                <div class="d-flex align-items-center justify-content-center py-3 ">
                                    <img src="{{asset('images/icons/notification-back.png')}}" alt="" class="img-notification-back">
                                    <img src="{{asset('images/icons/notify-mail.png')}}" alt="" class="img-notification">
                                </div>
                                <label for="" class="notify-label-3 mb-1">No notifications yet.</label>
                                <label for="" class="notify-label-4">Check back later for updates </label>
                            </div>
                        </div>
                        <div class="normal-notify d-none">
                            <div class="d-flex align-items-center justify-content-between notify-header p-15">
                                <label class="notify-label-1 mb-0">Notifications</label>
                                <a href="#" class="notify-label-2">Settings</a>
                            </div>
                            <div class="notify-content ">
                                <div class="d-flex justify-content-start align-items-start py-2 px-3 pb-gray">
                                    <img src="{{asset('images/icons/Oval (2).png')}}">
                                    <div class="d-flex flex-column justify-content-start pl-3">
                                        <label for="" class="notify-label-5">Arlene McCoy</label>
                                        <label for="" class="notify-label-6">Teacher ・2m ago</label>
                                        <label for="" class="notify-label-6">asking about new updates in lesson 03 Assignment</label>

                                    </div>
                                </div>
                                <div class="d-flex justify-content-start align-items-start py-2 px-3 pb-gray">
                                    <img src="{{asset('images/icons/Oval (1).png')}}">
                                    <div class="d-flex flex-column justify-content-start pl-3">
                                        <label for="" class="notify-label-5">Jerome Bell</label>
                                        <label for="" class="notify-label-6">Teacher ・2m ago</label>
                                        <label for="" class="notify-label-6">asking about new updates in lesson 03 Assignment</label>

                                    </div>
                                </div>
                                <div class="d-flex justify-content-start align-items-start py-2 px-3 pb-gray">
                                    <img src="{{asset('images/icons/Oval (3).png')}}">
                                    <div class="d-flex flex-column justify-content-start pl-3">
                                        <label for="" class="notify-label-5">Jacob Jones</label>
                                        <label for="" class="notify-label-6">Teacher ・2m ago</label>
                                        <label for="" class="notify-label-6">asking about new updates in lesson 03 Assignment</label>

                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center flex-column pb-2 empty-notify d-none ">
                                <div class="d-flex align-items-center justify-content-center py-3 ">
                                    <img src="{{asset('images/icons/notification-back.png')}}" alt="" class="img-notification-back">
                                    <img src="{{asset('images/icons/notification.png')}}" alt="" class="img-notification">
                                </div>
                                <label for="" class="notify-label-3 mb-1">No notifications yet.</label>
                                <label for="" class="notify-label-4">Check back later for updates </label>
                            </div>
                        </div>
                        <div class="profile-dropdown d-none">
                            <a href="{{ Qs::userIsStudent() ? route('students.show', Qs::hash(Qs::findStudentRecord(Auth::user()->id)->id)) : route('users.show', Qs::hash(Auth::user()->id)) }}" class="dropdown-item"><i class="icon-user-plus"></i> My profile</a>
                            <div class="dropdown-divider"></div>
                            <a href="{{ route('my_account') }}" class="dropdown-item"><i class="icon-cog5"></i> Account settings</a>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault();
                  document.getElementById('logout-form').submit();" class="dropdown-item"><i class="icon-switch2"></i> Logout</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </div>
                    </div>
                    <a href="#" class="navbar-nav-link dropdown-toggle text-white notification1" data-toggle="dropdown" data-id="profile-dropdown">
                        <img style="width: 34px; height:50px;" src="{{ Auth::user()->photo }}" class="rounded-circle" alt="photo" onerror="this.src='{{$error}}'">
                        <span class="text-center text-muted">{{ Auth::user()->name }}</span>
                    </a>
                    

                    
                </li>
            </ul>
        </div>
    </div>
</div>
<script>
      $('.notification1').click(function(){
            var id = $(this).attr('data-id');
            if(id == "normal-notification")
            {
                $('.mail-notify').addClass('d-none');
                $('.profile-dropdown').addClass('d-none');
                $('.normal-notify').removeClass('d-none');
                $('.notify-dropdown').removeClass('dropdown-mail');
                $('.notify-dropdown').removeClass('dropdown-profile');

            }else if(id == "mail-notification"){
                $('.mail-notify').removeClass('d-none');
                $('.normal-notify').addClass('d-none');
                $('.profile-dropdown').addClass('d-none');
                $('.notify-dropdown').addClass('dropdown-mail');
                $('.notify-dropdown').removeClass('dropdown-profile');

            }else{
                $('.mail-notify').addClass('d-none');
                $('.profile-dropdown').removeClass('d-none');
                $('.normal-notify').addClass('d-none');
                $('.notify-dropdown').removeClass('dropdown-mail');
                $('.notify-dropdown').addClass('dropdown-profile');
            }
        });
</script>

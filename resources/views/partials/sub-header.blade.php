
<style>
    nav ul li {
        list-style: none;
        float: left;
        padding-right: 20px;
    }

    nav ul li a {
        text-decoration: none;
        color: #222;
        display: flex;
        flex-direction: column;
        align-items: center;
        /* background-color: #ccc; */
        /* padding: 7px; */
    }

    nav ul li a img {
        padding-bottom: 10px;
    }

    .active {
        padding-bottom: 15px;
        border-bottom: 3px solid #3949AB;
        /* color: #fff; */

    }

    .active span {
        font-weight: 500;
    }
    .breadcrumbs-link{
    font-style: normal;
    font-weight: normal;
    font-size: 12px;
    line-height: 16px;
    padding-left: 15px;
    color: #768297;
}
.breadcrumbs-fa-right{
    font-size: 18px;
    padding-left: 5px;
    /* padding-right: 5px; */
    padding-top: 1px;
    position: absolute;
    color: #768297;
}
.pl-14{
    padding-left: 14px;
}
.btn-blue {
    font-style: normal;
    font-weight: 500;
    font-size: 16px;
    line-height: 20px;
    text-align: center;
    letter-spacing: -0.34px;
    color: #FFFFFF;
    background: #3949AB;
    border-radius: 4px;
    padding: 5px 25px;
    margin-right: 10px;
}
.btn-blue:hover {
    color: #FFFFFF;
}
.page-header{
    display:none;

}
a.nav-link.active{
    border-bottom: none;
}
</style>

<div class="container-fluid p-2">
    <div class="bg-light pt-2 pr-2 pl-2" style="box-shadow: 0px 2px 4px rgb(29 30 77 / 10%);border-radius: 8px;">
        <div class="d-flex justify-content-between">
            <div>
                {{-- <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item"><a href="#">Library</a></li>
                        <li class="breadcrumb-item" aria-current="page">Data</li>
                    </ol>
                </nav>--}}
                <div class="breadcrumbs mb-2">
                    <a href="{{url('dashboard')}}" class="breadcrumbs-link">
                        Home
                    </a>
                    <i class="fa fa-angle-right breadcrumbs-fa-right" aria-hidden="true"></i>
                    <a href="#" class="breadcrumbs-link">
                        Library
                    </a>
                    <i class="fa fa-angle-right breadcrumbs-fa-right" aria-hidden="true"></i>
                    <a href="#" class="breadcrumbs-link">
                        page
                    </a>
                    
                </div>
                <h3 class="pl-14">Home Work</h3>
            </div>

            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false"
                    style="background-color: #E8EAF6; color: #3949AB; border-radius: 4px 4px 4px 4px">
                    Secondary Action
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                    <button class="dropdown-item" type="button">Action</button>
                    <button class="dropdown-item" type="button">Another action</button>
                    <button class="dropdown-item" type="button">Something else here</button>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <nav class="navecation">
                    <ul class="row p-0 m-0" id="navi">
                        <div class="col-md-1" style="margin:4px">
                            <li class=""><a href="#" class="menu"> <img
                                        src="{{asset('images/icons/Overview_ico.png')}}" alt="Overview">
                                    <span> Overview </span></a>
                            </li>
                        </div>
                        <div class="col-md-1" style="margin:4px">
                            <li class=""><a class="menu" href="#"> <img src="{{asset('images/icons/content_ico.png')}}"
                                        alt="Meterials">
                                    <span> Meterials </span></a>
                            </li>
                        </div>
                        <div class="col-md-1" style="margin: 6px; padding-top: 3px; margin-right: 12px;">
                            <li class=""><a class="menu {{ in_array(Route::currentRouteName(), ['attendance.index']) ? 'active' : '' }}" href="{{route('attendance.index')}}"> <img src="{{asset('images/icons/Attendance_ico.png')}}"
                                        alt="Attendance">
                                    <span> Attendance </span></a>
                            </li>
                        </div>
                        <div class="col-md-1" style="margin:4px; padding-top: 2px; margin-left: 10px;">
                            <li class=""><a class="menu" href="#"> <img src="{{asset('images/icons/Group.png')}}"
                                        alt="Quizzes">
                                    <span> Quizzes </span></a>
                            </li>
                        </div>
                        <div class="col-md-1" style="margin:4px; padding-top: 8px; margin-right: 9px;">
                            <li class=""><a class="menu {{ in_array(Route::currentRouteName(), ['homework.studentList']) ? 'active' : '' }}" href="{{route('homework.studentList')}}"> <img src="{{asset('images/icons/Assignments_ico.png')}}" alt="Homework">
                                    <span> Homework </span></a>
                            </li>
                        </div>
                        <div class="col-md-1" style="margin:4px; padding-top: 3px; margin-left: 10px;">
                            <li class=""><a class="menu" href="#"> <img src="{{asset('images/icons/Clip 2.png')}}"
                                        alt="Forums">
                                    <span> Forums </span></a>
                            </li>
                        </div>
                        <div class="col-md-1" style="margin:4px; padding-top: 12px;">
                            <li class=""><a class="menu" href="#"> <img src="{{asset('images/icons/Group 13.png')}}"
                                        alt="Polls">
                                    <span> Polls </span></a>
                            </li>
                        </div>
                        <div class="col-md-1" style="margin:4px; padding-top: 12px;">
                            <li class=""><a class="menu" href="#"> <img src="{{asset('images/icons/Clip 5.png')}}"
                                        alt="Grades">
                                    <span> Grades </span></a>
                            </li>
                        </div>
                        <div class="col-md-1" style="margin:4px; padding-top: 14px;">
                            <li class=""><a class="menu" href="#"> <img src="{{asset('images/icons/members_ico.png')}}"
                                        alt="Students">
                                    <span> Students </span></a>
                            </li>
                        </div>
                        <div class="col-md-1" style="margin:4px; padding-top: 3px;">
                            <li class=""><a class="menu" href="#"> <img src="{{asset('images/icons/Combined Shape.png')}}"
                                        alt="Teachers">
                                    <span> Teachers </span></a>
                            </li>
                        </div>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>




<script>
    $(document).ready(function () {
        $('.menu').click(function () {
            $('ul div li a').removeClass("active");
            $(this).addClass("active");
        });
    });
</script>
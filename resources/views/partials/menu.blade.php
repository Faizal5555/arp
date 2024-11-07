<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->

    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user d-none">
            <div class="card-body">
                <div class="media ">
                    <div class="mr-3">
                        <a href="{{ route('my_account') }}"><img src="{{ Auth::user()->photo }}" width="38" height="38"
                                class="rounded-circle" alt="photo"></a>
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">{{ Auth::user()->name }}</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-user font-size-sm"></i> &nbsp;{{ ucwords(str_replace('_', ' ',
                            Auth::user()->user_type)) }}
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="{{ route('my_account') }}" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->

        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link {{ (Route::is('dashboard')) ? 'active' : '' }}">
                        <i class="icon-home4"></i>
                        <span>Home</span>
                    </a>
                </li>
                @if(auth()->user()->user_type == 'super_admin')

                <li
                    class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['school_register', 'school_register.list','school_register.edit']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                    <a href="#" class="nav-link"><i class="icon-users"></i> <span> School Registration</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">


                        <li class="nav-item">
                            <a href="{{ route('school_register') }}"
                                class="nav-link {{ (Route::is('school_register')) ? 'active' : '' }}">Add School</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('school_register.list') }}"
                                class="nav-link {{ (Route::is('school_register.list')) ? 'active' : '' }}">School
                                List</a>
                        </li>

                    </ul>
                </li>
                @endif

                {{--Academics--}}
                @if(Qs::userIsAcademic())
                <!-- <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['tt.index', 'ttr.edit', 'ttr.show', 'ttr.manage']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="#" class="nav-link"><i class="icon-graduation2"></i> <span> Academics</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Manage Academics">

                        {{--Timetables--}}
                            <li class="nav-item"><a href="{{ route('tt.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['tt.index']) ? 'active' : '' }}">Timetables</a></li>
                        </ul>
                    </li> -->
                @endif

                {{--Administrative--}}
                @if(Qs::userIsAdministrative())
                <!-- <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.create', 'payments.invoice', 'payments.receipts', 'payments.edit', 'payments.manage', 'payments.show',]) ? 'nav-item-expanded nav-item-open' : '' }} ">
                        <a href="#" class="nav-link"><i class="icon-office"></i> <span> Administrative</span></a>

                        <ul class="nav nav-group-sub" data-submenu-title="Administrative">

                            {{--Payments--}}
                            @if(Qs::userIsTeamAccount())
                            <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.create', 'payments.edit', 'payments.manage', 'payments.show', 'payments.invoice']) ? 'nav-item-expanded' : '' }}">

                                <a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.edit', 'payments.create', 'payments.manage', 'payments.show', 'payments.invoice']) ? 'active' : '' }}">Payments</a>

                                <ul class="nav nav-group-sub">
                                    <li class="nav-item"><a href="{{ route('payments.create') }}" class="nav-link {{ Route::is('payments.create') ? 'active' : '' }}">Create Payment</a></li>
                                    <li class="nav-item"><a href="{{ route('payments.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['payments.index', 'payments.edit', 'payments.show']) ? 'active' : '' }}">Manage Payments</a></li>
                                    <li class="nav-item"><a href="{{ route('payments.manage') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['payments.manage', 'payments.invoice', 'payments.receipts']) ? 'active' : '' }}">Student Payments</a></li>

                                </ul>

                            </li>
                            @endif
                        </ul>
                    </li> -->
                @endif

                {{--Manage Students--}}
                @if(Qs::userIsTeamSAT())
                @if(!Qs::userIsTeamS())
                <li
                    class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.create', 'students.list', 'students.edit', 'students.show', 'students.promotion', 'students.promotion_manage', 'students.graduated']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                    <a href="#" class="nav-link"><i class="icon-users"></i> <span> Student Admission</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        {{--Admit Student--}}
                        @if(Qs::userIsTeamSA())
                        <li class="nav-item">
                            <a href="{{ route('students.create') }}"
                                class="nav-link {{ (Route::is('students.create')) ? 'active' : '' }}">Add Student</a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('users.list') }}"
                                class="nav-link {{ (Route::is('users.list')) ? 'active' : '' }}">Users</a>
                        </li>
                        @endif
                        @if(Qs::userIsTeamA())
                        <li class="nav-item">
                            <a href="{{ route('admission.list') }}"
                                class="nav-link {{ (Route::is('admission.list')) ? 'active' : '' }}">New Admission
                                Request</a>
                        </li>
                        @endif

                        {{--Student Information--}}
                        <li
                            class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.list', 'students.edit', 'students.show']) ? 'nav-item-expanded' : '' }}">
                            <a href="#"
                                class="nav-link {{ in_array(Route::currentRouteName(), ['students.list', 'students.edit', 'students.show']) ? 'active' : '' }}">Student
                                Information</a>
                            <ul class="nav nav-group-sub">
                                @foreach(App\Models\MyClass::orderBy('name')->where('school_id',Auth()->user()->school_id)->get() as $c)
                                <li class="nav-item"><a href="{{ route('students.list', $c->id) }}" class="nav-link ">{{
                                        $c->name }}</a></li>
                                @endforeach
                            </ul>
                        </li>

                        @if(Qs::userIsTeamSA())

                        {{--Student Promotion--}}
                        <!-- <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['students.promotion', 'students.promotion_manage']) ? 'nav-item-expanded' : '' }}"><a href="#" class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion', 'students.promotion_manage' ]) ? 'active' : '' }}">Student Promotion</a>
                                <ul class="nav nav-group-sub">
                                    <li class="nav-item"><a href="{{ route('students.promotion') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion']) ? 'active' : '' }}">Promote Students</a></li>
                                    <li class="nav-item"><a href="{{ route('students.promotion_manage') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.promotion_manage']) ? 'active' : '' }}">Manage Promotions</a></li>
                                </ul>

                                </li> -->

                        {{--Student Graduated--}}
                        <!-- <li class="nav-item"><a href="{{ route('students.graduated') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['students.graduated' ]) ? 'active' : '' }}">Students Graduated</a></li> -->
                        @endif

                    </ul>
                </li>
                @endif
                @endif
                @if(auth()->user()->user_type == 'admin')
                <li
                    class="nav-item nav-item-submenu {{ (in_array(Route::currentRouteName(), ['career.list']) ? 'nav-item-expanded nav-item-open' : '') || (in_array(Route::currentRouteName(), ['job-career','job-career.edit','job-career.list']) ? 'nav-item-expanded nav-item-open' : '') }} ">
                    <a href="#" class="nav-link"><i class="icon-users"></i> <span>Staff Recruitment</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">

                        {{--Manage Job Career--}}
                        @if(Qs::userIsTeamA())
                        <li class="nav-item">
                            <a href="{{ route('job-career.list') }}"
                                class="nav-link {{ in_array(Route::currentRouteName(), ['job-career','job-career.edit','job-career.list']) ? 'active' : '' }}">
                                <span>Job Posting</span></a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('career.list') }}"
                                class="nav-link {{ (Route::is('career.list')) ? 'active' : '' }}">Applicant List</a>
                        </li>



                    </ul>
                </li>
                @endif

                @if(Qs::userIsTeamSA())
                {{--Manage Users--}}
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"
                        class="nav-link {{ in_array(Route::currentRouteName(), ['users.index', 'users.show', 'users.edit']) ? 'active' : '' }}"><i
                            class="icon-users4"></i> <span> User Management</span></a>
                </li>

                {{--Manage Classes--}}
                <!--@if(Qs::userIsTeamA())-->

                <!--@endif-->

                {{--Manage Dorms--}}
                <!-- <li class="nav-item">
                        <a href="{{ route('dorms.index') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['dorms.index','dorms.edit']) ? 'active' : '' }}"><i class="icon-home9"></i> <span> Dormitories</span></a>
                    </li> -->

                {{--Manage Sections--}}
                <!--@if(Qs::userIsTeamA())-->

                <!--@endif-->
                <!--@if(Qs::userIsTeamSA())-->

                <!--@endif-->

                {{--Manage Subjects--}}
                <!--@if(Qs::userIsTeamA())-->

                <!--@endif-->


                @endif
                @if(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'teacher')
                <li
                    class="nav-item nav-item-submenu {{ (in_array(Route::currentRouteName(), ['classes.index','classes.edit']) ? 'nav-item-expanded nav-item-open' : '') || (in_array(Route::currentRouteName(), ['subjects.index','subjects.edit',]) ? 'nav-item-expanded nav-item-open' : '') }} ">
                    <a href="#" class="nav-link"><i class="icon-windows2"></i> <span> <span>Course Management</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">

                        <li class="nav-item">
                            <a href="{{ route('classes.index') }}"
                                class="nav-link {{ in_array(Route::currentRouteName(), ['classes.index','classes.edit']) ? 'active' : '' }}">
                                Classes</span></a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('subjects.index') }}"
                                class="nav-link {{ in_array(Route::currentRouteName(), ['subjects.index','subjects.edit',]) ? 'active' : '' }}">
                                <span>Subjects</span></a>
                        </li>



                    </ul>
                </li>
                @endif
                {{-- @if(auth()->user()->user_type == 'super_admin')
                <li class="nav-item">
                    <a href="{{ route('cohorts.index') }}"
                        class="nav-link {{ in_array(Route::currentRouteName(), ['cohorts.index','sections.edit',]) ? 'active' : '' }}"><i
                            class="icon-fence"></i> <span>Cohorts Management</span></a>
                </li>
                @endif --}}
                @if(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'teacher' )
                <li
                    class="nav-item nav-item-submenu {{ (in_array(Route::currentRouteName(), ['sections.index','sections.edit',]) ? 'nav-item-expanded nav-item-open' : '') || (in_array(Route::currentRouteName(), ['cohorts.index','sections.edit',]) ? 'nav-item-expanded nav-item-open' : '') }} ">
                    <a href="#" class="nav-link"><i class="icon-fence"></i> <span> <span>Collaborative
                                Learning</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        @if(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'teacher')
                        <li class="nav-item">
                            <a href="{{ route('sections.index') }}"
                                class="nav-link {{ in_array(Route::currentRouteName(), ['sections.index','sections.edit',]) ? 'active' : '' }}">
                                <span>Groups</span></a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="{{ route('cohorts.index') }}"
                                class="nav-link {{ in_array(Route::currentRouteName(), ['cohorts.index','sections.edit',]) ? 'active' : '' }}">
                                <span>Cohorts</span></a>
                        </li>



                    </ul>
                </li>
                @endif
                
                <li
                    class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['academic','term.list','weekly.timetable','weekly.view','timeManagement','class.timetable','vacation','vacation.list']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                    <a href="#" class="nav-link"><i class="icon-users"></i> <span> Time Table</span></a>
                    @if(auth()->user()->user_type == 'admin')
                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('academic') }}"
                                class="nav-link {{ (Route::is('academic')) ? 'active' : '' }}">Academic Year</a>
                        </li>
                    </ul>
                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('term.list') }}"
                                class="nav-link {{ (Route::is('term.list')) ? 'active' : '' }}">Term</a>
                        </li>
                    </ul>
                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('timeManagement') }}"
                                class="nav-link {{ (Route::is('timeManagement')) ? 'active' : '' }}">Time Slots</a>
                        </li>
                    </ul>
                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('vacation.list') }}"
                                class="nav-link {{ (Route::is('vacation.list')) ? 'active' : '' }}">Vacation</a>
                        </li>
                    </ul>
                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('weekly.timetable') }}"
                                class="nav-link {{ (Route::is('weekly.timetable')) ? 'active' : '' }}">Create Timetable</a>
                        </li>
                    </ul>
                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('class.timetable') }}"
                                class="nav-link {{ (Route::is('class.timetable')) ? 'active' : '' }}">Search Timetable</a>
                        </li>
                    </ul>
                    @endif
                    @if(auth()->user()->user_type == 'Teacher' || auth()->user()->user_type == 'student')
                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('weekly.view') }}"
                                class="nav-link {{ (Route::is('weekly.view')) ? 'active' : '' }}">View Timetable</a>
                        </li>
                    </ul>
                    @endif
                </li>

                {{-- @if(auth()->user()->user_type == 'admin')
                <li class="nav-item">
                    <a href="{{ route('meeting.index') }}"
                        class="nav-link {{ in_array(Route::currentRouteName(), ['meeting.index', 'meeting.show', 'meeting.edit']) ? 'active' : '' }}"><i
                            class="icon-users4"></i> <span>Meeting</span></a>
                </li>
                @endif --}}
                
                <li
                    class="nav-item nav-item-submenu d-none {{ in_array(Route::currentRouteName(), ['academic','student_assessment.list','staff_assessment.list',]) ? 'nav-item-expanded nav-item-open' : '' }} ">
                    <a href="#" class="nav-link"><i class="icon-users"></i> <span> Assessment Mangement</span></a>
                    @if(auth()->user()->user_type == 'admin')
                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                    <li class="nav-item">
                            <a href="{{ route('manage_assessment.list') }}"
                                class="nav-link {{ (Route::is('manage_assessment.list')) ? 'active' : '' }}">Manage External Assessments</a>
                        </li>
                    </ul>
                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                    <li class="nav-item">
                            <a href="{{ route('assessment.list') }}"
                                class="nav-link {{ (Route::is('assessment.list')) ? 'active' : '' }}">Formal Assessment Settings</a>
                        </li>
                    </ul>
                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('student_assessment.list') }}"
                                class="nav-link {{ (Route::is('student_assessment.list')) ? 'active' : '' }}">Student</a>
                        </li>
                    </ul>

                    <!--<ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('student_result.list') }}"
                                class="nav-link {{ (Route::is('student_result.list')) ? 'active' : '' }}">Student Result</a>
                        </li>
                    </ul> -->
                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('staff_assessment.list') }}"
                                class="nav-link {{ (Route::is('staff_assessment.list')) ? 'active' : '' }}">Staff</a>
                        </li>
                    </ul>
                    
                    @endif
                    
                </li>

                <!-- Leave Management -->
                @if(auth()->user()->user_type == 'super_admin' || auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'teacher' || auth()->user()->user_type == 'student')
                <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['leave-request.allLeaveRequestIndex']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                    <a href="#" class="nav-link"><i class="icon-users"></i> <span> Leave management</span></a>

                    @if(auth()->user()->user_type == 'admin')
                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('leave-type.list') }}"
                                class="nav-link {{ (Route::is('leave-type.list')) ? 'active' : '' }}">Leave Type</a>
                        </li>
                    </ul>
                    @endif
                    @if(auth()->user()->user_type == 'super_admin')
                   <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('leave-request.allLeaveRequestIndex') }}"
                                class="nav-link {{ (Route::is('leave-request.allLeaveRequestIndex')) ? ' ' : '' }}">Admin Leave Requests</a>
                        </li>
                    </ul>
                    @endif
                    @if(auth()->user()->user_type == 'admin')
                   <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('leave-request.allLeaveRequestIndex') }}"
                                class="nav-link {{ (Route::is('leave-request.allLeaveRequestIndex')) ? ' ' : '' }}">Teacher Leave Requests</a>
                        </li>
                    </ul>
                    @endif
                    @if(auth()->user()->user_type == 'teacher')
                   <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('leave-request.allLeaveRequestIndex') }}"
                                class="nav-link {{ (Route::is('leave-request.allLeaveRequestIndex')) ? ' ' : '' }}">Student Leave Requests</a>
                        </li>
                    </ul>
                    @endif
                    @if(auth()->user()->user_type == 'admin' || auth()->user()->user_type == 'teacher' || auth()->user()->user_type == 'student')
                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('leave-request.myLeaveRequestList') }}"
                                class="nav-link {{ (Route::is('leave-request.myLeaveRequestList')) ? 'active' : '' }}">My Leave Requests</a>
                        </li>
                    </ul>
                    @endif
                </li>
                @endif

                 <!-- Homework -->
                 @if(auth()->user()->user_type == 'Teacher' || auth()->user()->user_type == 'student')
                <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['homework.list']) ? 'nav-item-expanded nav-item-open' : '' }} ">
                    <a href="#" class="nav-link"><i class="icon-book"></i> <span>Homework Management</span></a>

                    @if(auth()->user()->user_type == 'Teacher')
                    <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('homework.list') }}"
                                class="nav-link {{ (Route::is('homework.list')) ? 'active' : '' }}">Homework</a>
                        </li>
                    </ul>
                    @endif
                    @if(auth()->user()->user_type == 'student')
                   <ul class="nav nav-group-sub" data-submenu-title="Manage Students">
                        <li class="nav-item">
                            <a href="{{ route('homework.studentList') }}"
                                class="nav-link {{ (Route::is('homework.studentList')) ? ' ' : '' }}">Homework List</a>
                        </li>
                    </ul>
                    @endif
                </li>
                @endif

                {{--Exam--}}
                @if(Qs::userIsTeamSAT())
                <!-- <li class="nav-item nav-item-submenu {{ in_array(Route::currentRouteName(), ['exams.index', 'exams.edit', 'grades.index', 'grades.edit', 'marks.index', 'marks.manage', 'marks.bulk', 'marks.tabulation', 'marks.show', 'marks.batch_fix',]) ? 'nav-item-expanded nav-item-open' : '' }} ">
                    <a href="#" class="nav-link"><i class="icon-books"></i> <span> Exams</span></a>

                    <ul class="nav nav-group-sub" data-submenu-title="Manage Exams">
                        @if(Qs::userIsTeamSA())

                        {{--Exam list--}}
                            <li class="nav-item">
                                <a href="{{ route('exams.index') }}"
                                   class="nav-link {{ (Route::is('exams.index')) ? 'active' : '' }}">Exam List</a>
                            </li>

                            {{--Grades list--}}
                            <li class="nav-item">
                                    <a href="{{ route('grades.index') }}"
                                       class="nav-link {{ in_array(Route::currentRouteName(), ['grades.index', 'grades.edit']) ? 'active' : '' }}">Grades</a>
                            </li>

                            {{--Tabulation Sheet--}}
                            <li class="nav-item">
                                <a href="{{ route('marks.tabulation') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.tabulation']) ? 'active' : '' }}">Tabulation Sheet</a>
                            </li>

                            {{--Marks Batch Fix--}}
                            <li class="nav-item">
                                <a href="{{ route('marks.batch_fix') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.batch_fix']) ? 'active' : '' }}">Batch Fix</a>
                            </li>
                        @endif

                        @if(Qs::userIsTeamSAT())
                            {{--Marks Manage--}}
                            <li class="nav-item">
                                <a href="{{ route('marks.index') }}"
                                   class="nav-link {{ in_array(Route::currentRouteName(), ['marks.index']) ? 'active' : '' }}">Marks</a>
                            </li>

                            {{--Marksheet--}}
                            <li class="nav-item">
                                <a href="{{ route('marks.bulk') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['marks.bulk', 'marks.show']) ? 'active' : '' }}">Marksheet</a>
                            </li>

                            @endif

                    </ul>
                </li> -->
                @endif


                {{--End Exam--}}


                {{--Manage Account--}}
                <!-- <li class="nav-item">
                    <a href="{{ route('my_account') }}" class="nav-link {{ in_array(Route::currentRouteName(), ['my_account']) ? 'active' : '' }}"><i class="icon-user"></i> <span>My Account</span></a>
                </li> -->

            </ul>
        </div>
    </div>
</div>
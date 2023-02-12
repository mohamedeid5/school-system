<div class="container-fluid">
    <div class="row">
        <!-- Left Sidebar start-->
        <div class="side-menu-fixed">
            @if(auth('teacher')->check())
                @include('layouts.main-sidebar.teacher-main-sidebar')
            @elseif(auth('student')->check())
                @include('layouts.main-sidebar.student-main-sidebar')
            @endif

        </div>

        <!-- Left Sidebar End-->

        <!--=================================

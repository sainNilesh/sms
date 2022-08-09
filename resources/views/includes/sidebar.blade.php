<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="" class="brand-link">

        <span class="brand-text font-weight-light">{{ auth()->user()->name }}</span>
    </a>

    <!-- Sidebar -->




    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('students.index') }}"
                    class="nav-link {{ request()->is('students*') ? 'active' : '' }}">

                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        Student
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>

            </li>
            {{-- <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false"> --}}
            <li class="nav-item">
                <a href="{{ route('subjects.index') }}"
                    class="nav-link {{ request()->is('subjects*') ? 'active' : '' }}">

                    <i class="nav-icon fab fa-accusoft	"></i>
                    <p>
                        Subject
                        <span class="right badge badge-danger"></span>
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('standards.index') }}"
                    class="nav-link {{ request()->is('standards*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-copy"></i>
                    <p>
                        Standard
                        <i class="fas fa-angle-left right"></i>
                        <span class="badge badge-info right"></span>
                    </p>
                </a>

            <li class="nav-item">
                <a href="{{ route('exams.index') }}" class="nav-link {{ request()->is('exams*') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-chart-pie"></i>
                    <p>
                        Exam
                        <i class="right fas fa-angle-clock"></i>

                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('student_standards.index') }}" class="nav-link {{ request()->is('student_standards*') ? 'active' : '' }}">
                    
                    <i class="nav-icon fas fa-user"></i>
                    <p>
                        StudentStandard
                        <i class="fas fa-angle-left right"></i>
                        <span class="badge badge-info right"></span>
                    </p>
                </a>
    </nav>
    <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
</ul>
</li>
</li>
</ul>
</nav>
<!-- /.sidebar-menu -->
</div>
<!-- /.sidebar -->
</aside>

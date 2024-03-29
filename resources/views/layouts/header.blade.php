<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>

    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">


        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ url('public/dist/img/user1-128x128.jpg') }}" alt="User Avatar"
                            class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ url('public/dist/img/user8-128x128.jpg') }}" alt="User Avatar"
                            class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ url('public/dist/img/user3-128x128.jpg') }}" alt="User Avatar"
                            class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Messages</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                <span class="badge badge-warning navbar-badge">Perfil</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-item dropdown-header">15 Notifications</span>
                <div class="dropdown-divider"></div>
                <a href="{{ url('logout') }}" class="dropdown-item">
                    <i class="fas fa-envelope mr-2"></i> Cerrar sesiòn
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-users mr-2"></i> 8 friend requests
                    <span class="float-right text-muted text-sm">12 hours</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fas fa-file mr-2"></i> 3 new reports
                    <span class="float-right text-muted text-sm">2 days</span>
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>


    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link" style="text-align: center">
        <span class="brand-text font-weight-light" style="font-weight:bold !important; font-size:20px">
            Sistema Escolar</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ url('public/dist/img/user2-160x160.jpg') }}" class="img-circle elevation-2"
                    alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>


        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->

                @if (Auth::user()->user_type == 1)
                    <li class="nav-header">Configuaciòn</li>

                    <li class="nav-item @if (Request::segment(2) == 'dashboard' ||
                            Request::segment(2) == 'admin' ||
                            Request::segment(2) == 'student' ||
                            Request::segment(2) == 'teacher' ||
                            Request::segment(2) == 'parent') menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link ">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Configuraciòn
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{ url('admin/dashboard') }}"
                                    class="nav-link  @if (Request::segment(2) == 'dashboard') active @endif">
                                    <i class="nav-icon fas fa-tachometer-alt"></i>
                                    <p>
                                        Panel Principal
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/admin/list') }}"
                                    class="nav-link  @if (Request::segment(2) == 'admin') active @endif"">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Administraciòn
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/student/list') }}"
                                    class="nav-link  @if (Request::segment(2) == 'student') active @endif"">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Estudiantes
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/teacher/list') }}"
                                    class="nav-link  @if (Request::segment(2) == 'teacher') active @endif"">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Docentes
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/parent/list') }}"
                                    class="nav-link  @if (Request::segment(2) == 'parent') active @endif"">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Padre de Familia
                                    </p>
                                </a>
                            </li>

                        </ul>
                    </li>

                    <li class="nav-item @if (Request::segment(2) == 'class' ||
                            Request::segment(2) == 'subject' ||
                            Request::segment(2) == 'assign_subject' ||
                            Request::segment(2) == 'assign_class_teacher' ||
                            Request::segment(2) == 'class_timetable') menu-is-opening menu-open @endif">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Académico
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item">
                                <a href="{{ url('admin/class/list') }}"
                                    class="nav-link  @if (Request::segment(2) == 'class') active @endif"">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Clases
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/journeys/list') }}"
                                    class="nav-link  @if (Request::segment(2) == 'journeys') active @endif"">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Jornadas
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/subject/list') }}"
                                    class="nav-link  @if (Request::segment(2) == 'subject') active @endif"">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Materias
                                    </p>
                                </a>
                            </li>

                            <li class="nav-item">
                                <a href="{{ url('admin/assign_subject/list') }}"
                                    class="nav-link  @if (Request::segment(2) == 'assign_subject') active @endif"">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Asignar Materias
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/class_timetable/list') }}"
                                    class="nav-link  @if (Request::segment(2) == 'class_timetable') active @endif"">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Horario de Clases
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/assign_class_teacher/list') }}"
                                    class="nav-link  @if (Request::segment(2) == 'assign_class_teacher') active @endif"">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Modulos -Docentes
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ url('admin/headquarter/list') }}"
                                    class="nav-link  @if (Request::segment(2) == 'headquarter') active @endif"">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Sedes
                                    </p>
                                </a>
                            </li>


                        </ul>
                    </li>

                    <li class="nav-item @if (Request::segment(2) == 'examinations') menu-is-opening menu-open @endif">
                        <a href="#"
                            class="nav-link @if (Request::segment(2) == 'examinations') menu-is-opening menu-open @endif">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Exámenes
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item ">
                                <a href="{{ url('admin/examinations/exam/list') }}"
                                    class="nav-link  @if (Request::segment(3) == 'exam') active @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Ciclos Académicos
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ url('admin/examinations/exam_schedule') }}"
                                    class="nav-link  @if (Request::segment(3) == 'exam_schedule')  @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Calendario Examenes
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ url('admin/examinations/marks_register') }}"
                                    class="nav-link  @if (Request::segment(3) == 'marks_register')  @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Registro Exámenes
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ url('admin/examinations/marks_grade') }}"
                                    class="nav-link  @if (Request::segment(3) == 'marks_grade')  @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Grados Académicos
                                    </p>
                                </a>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item @if (Request::segment(2) == 'attendance') menu-is-opening menu-open @endif">
                        <a href="#"
                            class="nav-link @if (Request::segment(2) == 'attendance') menu-is-opening menu-open @endif">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Asistencia
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item ">
                                <a href="{{ url('admin/attendance/student') }}"
                                    class="nav-link  @if (Request::segment(3) == 'student') active @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Listado
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ url('admin/attendance/report') }}"
                                    class="nav-link  @if (Request::segment(3) == 'report')  @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Reporte Asistencia
                                    </p>
                                </a>
                            </li>


                        </ul>
                    </li>
                    <li class="nav-item @if (Request::segment(2) == 'communicate') menu-is-opening menu-open @endif">
                        <a href="#"
                            class="nav-link @if (Request::segment(2) == 'communicate') menu-is-opening menu-open @endif">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Comunicaciones
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item ">
                                <a href="{{ url('admin/communicate/notice_board') }}"
                                    class="nav-link  @if (Request::segment(3) == 'notice_board') active @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Noticias
                                    </p>
                                </a>
                            </li>
                            {{--  <li class="nav-item ">
                                <a href="{{ url('admin/attendance/report') }}"
                                    class="nav-link  @if (Request::segment(3) == 'report')  @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Enviar Correo
                                    </p>
                                </a>
                            </li>  --}}


                        </ul>
                    </li>

                @elseif (Auth::user()->user_type == 2)
                    <li class="nav-header">Configuaciòn</li>
                    <li class="nav-item">
                        <a href="{{ url('teacher/dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Panel Docentes
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teacher/my_student') }}"
                            class="nav-link @if (Request::segment(2) == 'my_student') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Estudiantes
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teacher/my_calendar') }}"
                            class="nav-link @if (Request::segment(2) == 'my_calendar') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Mi Calendario Academico
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teacher/my_class_subject') }}"
                            class="nav-link @if (Request::segment(2) == 'my_class_subject') active @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Programas y Modulos
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teacher/my_exam_timetable') }}"
                            class="nav-link  @if (Request::segment(2) == 'my_exam_timetable') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Mi Horario Examenes
                            </p>
                        </a>
                    </li>

                    <li class="nav-item ">
                        <a href="{{ url('teacher/marks_register') }}"
                            class="nav-link  @if (Request::segment(2) == 'marks_register')  @endif">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Registro Exámenes
                            </p>
                        </a>
                    </li>
                     <li class="nav-item @if (Request::segment(2) == 'attendance') menu-is-opening menu-open @endif">
                        <a href="#"
                            class="nav-link @if (Request::segment(2) == 'attendance') menu-is-opening menu-open @endif">
                            <i class="nav-icon fas fa-th"></i>
                            <p>
                                Asistencia
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <li class="nav-item ">
                                <a href="{{ url('teacher/attendance/student') }}"
                                    class="nav-link  @if (Request::segment(3) == 'student') active @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Listado
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a href="{{ url('teacher/attendance/report') }}"
                                    class="nav-link  @if (Request::segment(3) == 'report')  @endif">
                                    <i class="nav-icon far fa-user"></i>
                                    <p>
                                        Reporte Asistencia
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teacher/my_notice_board') }}"
                            class="nav-link  @if (Request::segment(2) == 'my_notice_board') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Mis Noticias
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('teacher/account') }}"
                            class="nav-link  @if (Request::segment(2) == 'account') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Mi Perfil
                            </p>
                        </a>
                    </li>
                    {{--  <li class="nav-item">
                        <a href="{{ url('teacher/teacher_my_timetable') }}"
                            class="nav-link  @if (Request::segment(2) == 'teacher_my_timetable') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Mi Horario
                            </p>
                        </a>
                    </li>  --}}
                @elseif (Auth::user()->user_type == 3)
                    <li class="nav-header">Configuaciòn</li>
                    <li class="nav-item">
                        <a href="{{ url('student/dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Panel Estudiantes
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('student/my_subject') }}"
                            class="nav-link  @if (Request::segment(2) == 'my_subject') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Mis Asignaturas
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('student/my_calendar') }}"
                            class="nav-link  @if (Request::segment(2) == 'my_calendar') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Calendario Acádemico
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('student/my_timetable') }}"
                            class="nav-link  @if (Request::segment(2) == 'my_timetable') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Mi Horario
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('student/my_exam_timetable') }}"
                            class="nav-link  @if (Request::segment(2) == 'my_exam_timetable') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Mis Examenes
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('student/my_exam_result') }}"
                            class="nav-link  @if (Request::segment(2) == 'my_exam_result') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Resultado Examenes
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('student/my_attendance') }}"
                            class="nav-link  @if (Request::segment(2) == 'my_attendance') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Asistencias
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('student/my_notice_board') }}"
                            class="nav-link  @if (Request::segment(2) == 'my_notice_board') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Mis Noticias
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('student/account') }}"
                            class="nav-link  @if (Request::segment(2) == 'account') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Mi Perfil
                            </p>
                        </a>
                    </li>
                @elseif (Auth::user()->user_type == 4)
                    <li class="nav-header">Configuaciòn</li>
                    <li class="nav-item">
                        <a href="{{ url('parent/dashboard') }}"
                            class="nav-link @if (Request::segment(2) == 'dashboard') active @endif">
                            <i class="nav-icon fas fa-tachometer-alt"></i>
                            <p>
                                Panel Acudientes
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('parent/admin/list') }}" class="nav-link">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Consultas
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('parent/account') }}"
                            class="nav-link  @if (Request::segment(2) == 'account') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Mi Perfil
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ url('parent/my_student') }}"
                            class="nav-link  @if (Request::segment(2) == 'my_student') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Mi Estudiante
                            </p>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="{{ url('parent/my_notice_board') }}"
                            class="nav-link  @if (Request::segment(2) == 'my_notice_board') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Mis Noticias
                            </p>
                        </a>
                    </li>
                     <li class="nav-item">
                        <a href="{{ url('parent/my_student_notice_board') }}"
                            class="nav-link  @if (Request::segment(2) == 'my_student_notice_board') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                 Estudiante con Noticias
                            </p>
                        </a>
                    </li>
                @endif
               <li class="nav-item">
                        <a href="{{ url('admin/account') }}"
                            class="nav-link  @if (Request::segment(2) == 'account') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Mi Perfil
                            </p>
                        </a>
                    </li>

                <li class="nav-item">
                        <a href="{{ url('admin/change_password') }}"
                            class="nav-link  @if (Request::segment(2) == 'change_password') active @endif"">
                            <i class="nav-icon far fa-user"></i>
                            <p>
                                Cambiar Clave
                            </p>
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ url('logout') }}" class="nav-link">
                            <i class="nav-icon fas fa-columns"></i>
                            <p>
                                Salir
                            </p>
                        </a>
                    </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<nav id="sidebar" class="sidebar">
    <div class="sidebar-content js-simplebar">
        <a class="sidebar-brand" href="index-2.html">
            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px"
                y="0px" width="20px" height="20px" viewBox="0 0 20 20" enable-background="new 0 0 20 20"
                xml:space="preserve">
                <path
                    d="M19.4,4.1l-9-4C10.1,0,9.9,0,9.6,0.1l-9,4C0.2,4.2,0,4.6,0,5s0.2,0.8,0.6,0.9l9,4C9.7,10,9.9,10,10,10s0.3,0,0.4-0.1l9-4
      C19.8,5.8,20,5.4,20,5S19.8,4.2,19.4,4.1z" />
                <path
                    d="M10,15c-0.1,0-0.3,0-0.4-0.1l-9-4c-0.5-0.2-0.7-0.8-0.5-1.3c0.2-0.5,0.8-0.7,1.3-0.5l8.6,3.8l8.6-3.8c0.5-0.2,1.1,0,1.3,0.5
      c0.2,0.5,0,1.1-0.5,1.3l-9,4C10.3,15,10.1,15,10,15z" />
                <path
                    d="M10,20c-0.1,0-0.3,0-0.4-0.1l-9-4c-0.5-0.2-0.7-0.8-0.5-1.3c0.2-0.5,0.8-0.7,1.3-0.5l8.6,3.8l8.6-3.8c0.5-0.2,1.1,0,1.3,0.5
      c0.2,0.5,0,1.1-0.5,1.3l-9,4C10.3,20,10.1,20,10,20z" />
            </svg>

            <span class="align-middle me-3">{{ config('app.name') }}</span>
        </a>

        <ul class="sidebar-nav">
            <li class="sidebar-header">Master</li>
            <li class="sidebar-item">
                <a class="sidebar-link" href="{{ route('dashboard.index') }}">
                    <i class="align-middle" data-feather="sliders"></i>
                    <span class="align-middle">Dashboard</span>
                </a>
            </li>
            @if (auth()->user()->role->role_name == 'admin')
                <li class="sidebar-item {{ request()->routeIs('school.*') ? 'active' : '' }}">
                    <a data-bs-target="#pages" data-bs-toggle="collapse" class="sidebar-link">
                        <i class="align-middle me-2 fas fa-fw fa-school"></i>
                        <span class="align-middle">Sekolah</span>
                    </a>
                    <ul id="pages"
                        class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('school.*') ? 'show' : '' }}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{ request()->routeIs('school.create') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('school.create') }}">Tambah Sekolah</a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('school.index') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('school.index') }}">List Sekolah</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-item {{ request()->routeIs('student.*') ? 'active' : '' }}">
                    <a data-bs-target="#student" data-bs-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle me-2 fas fa-fw fa-user-graduate"></i>
                        <span class="align-middle">Siswa</span>
                    </a>
                    <ul id="student"
                        class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('student.*') ? 'show' : '' }}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{ request()->routeIs('student.create') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('student.create') }}">Tambah Siswa</a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('student.index') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('student.index') }}">List Siswa</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-header">Menu Absensi</li>
                <li class="sidebar-item {{ request()->routeIs('attendance.today') ? 'active' : '' }}">
                    <a class="sidebar-link" href="{{ route('attendance.today') }}">
                        <i class="align-middle me-2 fas fa-fw fa-chalkboard-teacher"></i>
                        <span class="align-middle">Absensi Siswa</span>
                    </a>
                </li>
            @elseif (auth()->user()->role->role_name == 'siswa')
                <li class="sidebar-item {{ request()->routeIs('journal.*') ? 'active' : '' }}">
                    <a data-bs-target="#journal" data-bs-toggle="collapse" class="sidebar-link collapsed">
                        <i class="align-middle" data-feather="layout"></i>
                        <span class="align-middle">Jurnal</span>
                    </a>
                    <ul id="journal"
                        class="sidebar-dropdown list-unstyled collapse {{ request()->routeIs('journal.*') ? 'show' : '' }}"
                        data-bs-parent="#sidebar">
                        <li class="sidebar-item {{ request()->routeIs('journal.create') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('journal.create') }}">Tambah Jurnal</a>
                        </li>
                        <li class="sidebar-item {{ request()->routeIs('journal.index') ? 'active' : '' }}">
                            <a class="sidebar-link" href="{{ route('journal.index') }}">List Jurnal</a>
                        </li>
                    </ul>
                </li>
                <li class="sidebar-header">Absensi Harian</li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('myAttendance') }}">
                        <i class="align-middle me-2 fas fa-fw fa-calendar-alt"></i>
                        <span class="align-middle">History Absen</span>
                    </a>
                </li>
            @endif

        </ul>
    </div>
</nav>

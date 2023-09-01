<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

    <div class="menu_section">
        <h3>General</h3>
        <ul class="nav side-menu">

            <li><a><i class="fa fa-home"></i> Dashboard <span class="fa fa-chevron-down"></span></a>
            <ul class="nav child_menu">
                @if (Auth::user()->role == 1)  
                    <li><a href="{{ route('a.home') }}">Home</a></li>
                @elseif(Auth::user()->role == 2)
                    <li><a href="{{ route('d.home') }}">Home</a></li>
                @else
                    <li><a href="{{ route('m.home') }}">Home</a></li>
                @endif
            </ul>
            </li>

            @if (Auth::user()->role == 1)  
                <li><a><i class="fa fa-calendar"></i> Tahun <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('a.year.add') }}">Tambah Tahun</a></li>
                        <li><a href="{{ route('a.year') }}">Lihat Tahun</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-users"></i> Dosen <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('a.lecturer.add') }}">Tambah Dosen</a></li>
                        <li><a href="{{ route('a.lecturer') }}">Lihat Dosen</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-sitemap"></i> Kelas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('a.class.add') }}">Tambah Kelas</a></li>
                        <li><a href="{{ route('a.class') }}">Lihat Kelas</a></li>
                    </ul>
                </li>   
                <li><a><i class="fa fa-random"></i> Jurusan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('a.major.add') }}">Tambah Jurusan</a></li>
                        <li><a href="{{ route('a.major') }}">Lihat Jurusan</a></li>
                    </ul>
                </li>             
                <li><a><i class="fa fa-users"></i> Mahasiswa <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('a.student.add') }}">Tambah Mahasiswa</a></li>
                        <li><a href="{{ route('a.student') }}">Lihat Mahasiswa</a></li>
                    </ul>
                </li>             
                <li><a><i class="fa fa-database"></i> Data <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#">Materi</a></li>
                    </ul>
                </li>
            @endif

            @if (Auth::user()->role == 2)                 
                <li><a><i class="fa fa-sitemap"></i> Kelas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('d.class') }}">Lihat Kelas</a></li>
                    </ul>
                </li> 
                <li><a><i class="fa fa-book"></i> Materi <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('d.material.add') }}">Tambah Materi</a></li>
                        <li><a href="{{ route('d.material.by.class') }}">Lihat Materi</a></li>
                    </ul>
                </li> 
                <li><a><i class="fa fa-tasks"></i> Tugas <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('d.task.add') }}">Tambah Tugas</a></li>
                        <li><a href="{{ route('d.task.by.class') }}">Lihat Tugas</a></li>
                        <!-- <li><a href="{{ route('d.task') }}">Lihat Semua Tugas</a></li> -->
                    </ul>
                </li> 
            @endif

            @if (Auth::user()->role == 3) 
                <li><a><i class="fa fa-sitemap"></i> Registrasi <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('m.class.select') }}">Registrasi Kelas</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-graduation-cap"></i> Kuliah <span class="fa fa-chevron-down"></span></a>
                <ul class="nav child_menu">
                    <li><a href="{{ route('m.class') }}">Kelas</a></li>
                    <li class=""><a>Tugas<span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu" style="display: none;">
                            <li>
                                <a href="{{ route('m.task') }}">Lihat Tugas</a>
                            </li>
                            <li>
                                <a href="{{ route('m.task.sent') }}">Tugas Terkirim</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="{{ route('m.material.by.class') }}">Materi</a></li>
                </ul>
                </li>
            @endif

        </ul>
    </div>

    <div class="menu_section">
        <h3>Akun</h3>
        <ul class="nav side-menu">
            @if (Auth::user()->role == 2) 
            <li><a href="#"><i class="fa fa-user"></i> Profile </a></li>
            <li><a href="{{ route('d.change.password') }}"><i class="fa fa-lock"></i> Change Password </a></li>
            @endif
            @if (Auth::user()->role == 3) 
            <li><a href="{{ route('m.profile') }}"><i class="fa fa-user"></i> Profile </a></li>
            <li><a href="{{ route('m.change.password') }}"><i class="fa fa-lock"></i> Change Password </a></li>
            @endif
            <li><a href="#" id="btnBantuan"><i class="fa fa-comments"></i> Bantuan </a></li>
            <li>
            <a href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                <i class="fa fa-power-off"></i> Logout
            </a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>
            </li>
        </ul>
    </div>

</div>
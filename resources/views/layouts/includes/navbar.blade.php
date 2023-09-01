<div class="top_nav">
    <div class="nav_menu">
        <div class="nav toggle">
            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
        </div>
        <nav class="nav navbar-nav">
        <ul class=" navbar-right">
            <li class="nav-item dropdown open" style="padding-left: 15px;">
            <a href="javascript:;" class="user-profile dropdown-toggle" aria-haspopup="true" id="navbarDropdown" data-toggle="dropdown" aria-expanded="false">                
                @if (Auth::user()->role == 1)  
                    <img src="{{ asset('gentella/production/images/user.png') }}" alt="Profile-User">{{ ucwords(strtolower(Auth::user()->nama)) }}
                @elseif(Auth::user()->role == 2)
                    <img src="{{ asset('gentella/production/images/user.png') }}" alt="Profile-User">{{ ucwords(strtolower(Auth::user()->dosen->nama_dosen)) }}
                @else
                    <img src="{{ asset('gentella/production/images/user.png') }}" alt="Profile-User">{{ ucwords(strtolower(Auth::user()->mahasiswa->nama_mahasiswa)) }}
                @endif
            </a>
            <div class="dropdown-menu dropdown-usermenu pull-right mt-3" aria-labelledby="navbarDropdown">
                @if (Auth::user()->role == 0)   
                <a class="dropdown-item"  href="{{ route('p.profile') }}">
                    <span>Profile</span>
                </a>
                <a class="dropdown-item"  href="#" id="btnBantuan">Bantuan</a>
                @endif
                <a class="dropdown-item" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out pull-right"></i> Logout
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>

            </div>
            </li>

        </ul>
        </nav>
    </div>
</div>
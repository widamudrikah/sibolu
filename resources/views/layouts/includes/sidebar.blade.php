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
                <li><a><i class="fa fa-tags"></i> Produk <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('a.tambah.produk') }}">Tambah Produk</a></li>
                        <li><a href="{{ route('a.data.produk') }}">Lihat Produk</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-shopping-cart"></i> Orderan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{ route('a.order') }}">Lihat Orderan</a></li>
                        <li><a href="#">Histori Orderan</a></li>
                    </ul>
                </li>
                <li><a><i class="fa fa-file"></i> Laporan Penjualan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#">Lihat Laporan</a></li>
                    </ul>
                </li>
            @endif

            @if (Auth::user()->role == 2)
                <li><a><i class="fa fa-bicycle"></i> Pengantaran <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="#">Lihat Pengantaran</a></li>
                        <li><a href="#">Histori Pengantaran</a></li>
                    </ul>
                </li>
            @endif

            @if (Auth::user()->role == 3)
                <li><a><i class="fa fa-shopping-cart"></i> Orderan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                        <li><a href="{{route('m.pesanan.index')}}">Lihat Orderanku</a></li>
                    </ul>
                </li>
            @endif

        </ul>
    </div>

    <div class="menu_section">
        <h3>Akun</h3>
        <ul class="nav side-menu">
            @if (Auth::user()->role == 2)
            {{-- <li><a href="#"><i class="fa fa-user"></i> Profile </a></li>
            <li><a href="{{ route('d.change.password') }}"><i class="fa fa-lock"></i> Change Password </a></li> --}}
            @endif
            @if (Auth::user()->role == 3)
            {{-- <li><a href="{{ route('m.profile') }}"><i class="fa fa-user"></i> Profile </a></li>
            <li><a href="{{ route('m.change.password') }}"><i class="fa fa-lock"></i> Change Password </a></li> --}}
            @endif
            {{-- <li><a href="#" id="btnBantuan"><i class="fa fa-comments"></i> Bantuan </a></li> --}}
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

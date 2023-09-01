<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="{{ asset('gentella/production/images/bolu.png') }}" type="image/x-icon">

    <title>@yield('title')</title>

    @include('layouts.includes.css')
    @yield('css')
    
  </head>

  <body class="nav-md">

    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              @if (Auth::user()->role == 1)  
                <a href="{{ route('a.home') }}" class="site_title d-flex align-items-center text-center">
              @elseif(Auth::user()->role == 2)
                <a href="{{ route('d.home') }}" class="site_title d-flex align-items-center text-center">
              @else
                <a href="{{ route('m.home') }}" class="site_title d-flex align-items-center text-center">
              @endif
                 <img src="{{ asset('gentella/production/images/bolu.png') }}" style="height: 30px; margin-left:8px;" alt="Brand JahitYuk">
                 &nbsp;
                 &nbsp;
                 &nbsp;
                 <span style="font-weight: 700; letter-spacing: 6px;">Sibolu</span>
              </a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="{{ asset('gentella/production/images/user.png') }}" alt="Profile-User" class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2>                  
                  @if (Auth::user()->role == 1)  
                      {{ ucwords(strtolower(Auth::user()->nama)) }}
                  @elseif(Auth::user()->role == 2)
                      {{ ucwords(strtolower(Auth::user()->dosen->nama_dosen)) }}
                  @else
                      {{ ucwords(strtolower(Auth::user()->mahasiswa->nama_mahasiswa)) }}
                      
                  @endif
                </h2>
              </div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            @include('layouts.includes.sidebar')

          </div>
        </div>

        @include('layouts.includes.navbar')

        
        <div class="right_col" role="main">
          <div class="">
            @yield('content')
          </div>
        </div>
        

        @include('layouts.includes.footer')

      </div>
    </div>

    @include('layouts.includes.js')
    @yield('js')
  </body>
</html>
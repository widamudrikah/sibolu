@extends('layouts.apps')

@section('title')
TaskApps - Ganti Password
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Ganti Password</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row mt-3">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Amankan Akun Anda</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link ml-3 mr-2"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class="close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <br>
                @if(Auth::user()->role == 2)
                    <form method="post" action="{{ route('d.change.password.proses') }}">
                @else
                    <form method="post" action="{{ route('m.change.password.proses') }}">
                @endif
                    @csrf
                    <div class="item form-group">
                        <label for="current_password" class="col-form-label col-md-3 col-sm-3 label-align">Password Sekarang <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="current_password" required class="form-control @error('current_password') is-invalid @enderror" type="password" name="current_password">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="password" class="col-form-label col-md-3 col-sm-3 label-align">Password Baru <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="password" required class="form-control @error('password') is-invalid @enderror" type="password" name="password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="password_confirmation" class="col-form-label col-md-3 col-sm-3 label-align">Konfirmasi Password <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="password_confirmation" required class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3 text-center">
                            <button type="reset" class="btn btn-warning">Clean</button>
                            <button type="submit" class="btn btn-info">Save Change</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')
    @if(session('ok'))
        <script>
            Swal.fire({
                icon: 'success',
                // title: '{{ session('success') }}',
                title: 'Password berhasil diubah',
                confirmButtonText: 'Sip',
            });
        </script>
    @endif
    @if(session('current_password'))
        <script>
            Swal.fire({
                icon: 'info',
                // title: '{{ session('success') }}',
                title: 'Password lama salah',
                confirmButtonText: 'Sip',
            });
        </script>
    @endif
@endsection


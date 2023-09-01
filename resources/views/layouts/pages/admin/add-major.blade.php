@extends('layouts.apps')

@section('title')
TaskApps - Tambah Jurusan
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Tambah Jurusan</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row mt-3">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tambah Jurusan<small>Data jurusan kampus</small></h2>
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
                <form method="post" action="{{ route('a.major.save') }}">
                    @csrf
                    <div class="item form-group">
                        <label for="nama_jurusan" class="col-form-label col-md-3 col-sm-3 label-align">Nama Jurusan <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="nama_jurusan" required class="form-control @error('nama_jurusan') is-invalid @enderror" type="text" name="nama_jurusan">
                            @error('nama_jurusan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3 text-center">
                            <button type="submit" class="btn btn-success">Submit</button>
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
                title: 'Sukses menyimpan data jurusan',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif
@endsection


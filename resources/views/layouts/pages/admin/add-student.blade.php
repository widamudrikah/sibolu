@extends('layouts.apps')

@section('title')
TaskApps - Tambah Mahasiswa
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Tambah Mahasiswa</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row">
    <form action="{{ route('a.student.save') }}" enctype="multipart/form-data" method="post" class="form-horizontal form-label-left">
    @csrf
        <div class="col-md-6 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Form Pendaftaran Akun <small>Digunakan untuk login</small></h2>
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

                        <div class="form-group row ">
                            <label for="nim" class="control-label col-md-3 col-sm-3 ">NIM <span class="required">**</span></label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="text" class="form-control" name="nim" id="nim">
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="email" class="control-label col-md-3 col-sm-3 ">Email <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 ">
                                <input value="{{ old('email') }}" type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email">
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="password" class="control-label col-md-3 col-sm-3 ">Password <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 ">
                                <input value="{{ old('password') }}" type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password">
                                @error('password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        
                </div>
            </div>
        </div>

        <div class="col-md-6 ">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Data Pribadi Mahasiswa</h2>
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
                        <div class="form-group row ">
                            <label for="nama_mahasiswa" class="control-label col-md-3 col-sm-3 ">Nama Lengkap <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 ">
                                <input value="{{ old('nama_mahasiswa') }}" type="text" class="form-control @error('nama_mahasiswa') is-invalid @enderror" name="nama_mahasiswa" id="nama_mahasiswa">
                                @error('nama_mahasiswa')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="tempat_lahir" class="control-label col-md-3 col-sm-3">Tempat Lahir <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="text" class="form-control" id="tempat_lahir" name="tempat_lahir">
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="tanggal_lahir" class="control-label col-md-3 col-sm-3 ">Tanggal Lahir <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="date" class="form-control" id="tanggal_lahir" name="tanggal_lahir">
                            </div>
                        </div>

                        <div class="item form-group">
                            <label for="jurusan_id" class="col-form-label col-md-3 col-sm-3">Jurusan <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 ">
                                <select id="jurusan_id" class="form-control @error('jurusan_id') is-invalid @enderror" name="jurusan_id">
                                    <option value="">-- Pilih Jurusan --</option>
                                    @foreach($jurusan as $dt)
                                        <option value="{{ $dt->id }}">{{ $dt->nama_jurusan }}</option>
                                    @endforeach
                                </select>
                                @error('jurusan_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="gender" class="control-label col-md-3 col-sm-3 ">Jenis Kelamin <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 ">
                                <select class="form-control @error('gender') is-invalid @enderror" name="gender">
                                    <option value="">-- Pilih --</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                @error('gender')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row ">
                            <label for="foto" class="control-label col-md-3 col-sm-3 ">Pas Foto <span class="required">*</span></label>
                            <div class="col-md-9 col-sm-9 ">
                                <input type="file" class="form-control" id="foto" name="foto">
                            </div>
                        </div>

                </div>
            </div>
        </div>

        <div class="col-md-12">                    
            <div class="ln_solid"></div>
            <div class="text-center">
                    <button type="reset" class="btn btn-primary">Reset</button>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </div>
        </div>

    </form>
</div>

@endsection


@section('js')
    @if(session('ok'))
        <script>
            Swal.fire({
                icon: 'success',
                // title: '{{ session('success') }}',
                title: 'Sukses menyimpan data mahasiswa',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif
@endsection


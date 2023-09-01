@extends('layouts.apps')

@section('title')
TaskApps - Tambah Kelas
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Tambah Kelas</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row mt-3">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tambah Kelas<small>Data kelas perkuliahan pada tahun berjalan</small></h2>
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
                <form method="post" action="{{ route('a.class.save') }}" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    @csrf
                    <div class="item form-group">
                        <label for="nama_kelas" class="col-form-label col-md-3 col-sm-3 label-align">Nama Kelas <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="nama_kelas" class="form-control  @error('nama_kelas') is-invalid @enderror" type="text" name="nama_kelas">
                            @error('nama_kelas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="tahun_id" class="col-form-label col-md-3 col-sm-3 label-align">Tahun <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <select id="tahun_id" class="form-control @error('tahun_id') is-invalid @enderror" name="tahun_id">
                                <option value="">-- Pilih Tahun --</option>
                                @foreach($tahun as $dt)
                                    <option value="{{ $dt->id }}">{{ $dt->tahun }}</option>
                                @endforeach
                            </select>
                            @error('tahun_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="dosen_id" class="col-form-label col-md-3 col-sm-3 label-align">Dosen <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <select id="dosen_id" class="form-control @error('dosen_id') is-invalid @enderror" name="dosen_id">
                                <option value="">-- Pilih Dosen --</option>
                                @foreach($dosen as $dt)
                                    <option value="{{ $dt->id }}">{{ $dt->nama_dosen }}</option>
                                @endforeach
                            </select>
                            @error('dosen_id')
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
                title: 'Sukses menyimpan data kelas',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif
@endsection


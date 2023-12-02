@extends('layouts.apps')

@section('title')
Sibolu - Tambah Produk
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Tambah Produk</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row mt-3">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data Produk<small>Masukkan informasi ikan yang akan anda jual</small></h2>
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
                <form method="post" action="{{route('a.simpan.produk')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="item form-group">
                        <label for="nama_ikan" class="col-form-label col-md-3 col-sm-3 label-align">Nama Ikan <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input required value="{{old('nama_ikan')}}" id="nama_ikan" type="text" class="form-control @error('nama_ikan') is-invalid @enderror" name="nama_ikan">
                            @error('nama_ikan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="item form-group">
                        <label for="lebar" class="col-form-label col-md-3 col-sm-3 label-align">Lebar Ikan <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input required value="{{old('lebar')}}" id="lebar" type="number" class="form-control @error('lebar') is-invalid @enderror" name="lebar">
                            @error('lebar')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="item form-group">
                        <label for="panjang" class="col-form-label col-md-3 col-sm-3 label-align">Panjang Ikan <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input required value="{{old('panjang')}}" id="panjang" type="number" class="form-control @error('panjang') is-invalid @enderror" name="panjang">
                            @error('panjang')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="item form-group">
                        <label for="harga" class="col-form-label col-md-3 col-sm-3 label-align">Harga Ikan <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input required value="{{old('harga')}}" id="harga" type="number" class="form-control @error('harga') is-invalid @enderror" name="harga">
                            @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="item form-group">
                        <label for="stok" class="col-form-label col-md-3 col-sm-3 label-align">Stok Ikan <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input required value="{{old('stok')}}" id="stok" type="number" class="form-control @error('stok') is-invalid @enderror" name="stok">
                            @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="item form-group">
                        <label for="deskripsi" class="col-form-label col-md-3 col-sm-3 label-align">Deskripsi<span class="required">*</span> </br> (Kondisi ikan)</label>
                        <div class="col-md-6 col-sm-6 ">
                            <textarea id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="deskripsi">{{old('deskripsi')}}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="item form-group">
                        <label for="foto" class="col-form-label col-md-3 col-sm-3 label-align">Gambar Ikan <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input required value="{{old('foto')}}" id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto" accept="image/jpeg, image/png">
                            @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <p>Limit File Uploud 2mb <span class="required">*</span></p>
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
                title: '{{ session('ok') }}',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif
@endsection


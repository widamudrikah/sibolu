@extends('layouts.apps')

@section('title')
Sibolu - Edit Produk
@endsection

@section('css')
<style>
    .foto-produk{
        /* display: inline-block; */
        max-width: 40%;
        height: auto;
        margin-bottom: 12px;
    }
</style>
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Edit Produk</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row mt-3">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Detail Edit Produk</h2>
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
                <form method="post" action="{{route('a.update.produk')}}" enctype="multipart/form-data">
                    @csrf

                    <div class="item form-group">
                        <label for="nama_ikan" class="col-form-label col-md-3 col-sm-3 label-align">Nama Ikan <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input value="{{$produk->id}}" type="hidden" name="id">
                            <input required value="{{$produk->nama_produk}}" id="nama_ikan" type="text" class="form-control @error('nama_ikan') is-invalid @enderror" name="nama_ikan">
                            @error('nama_ikan')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="item form-group">
                        <label for="ukuran" class="col-form-label col-md-3 col-sm-3 label-align">Ukuran Ikan <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <select required id="ukuran" class="form-control " name="ukuran">
                                <option value="">-- Pilih Ukuran --</option>
                                <option value="Besar" {{ $produk->ukuran == 'Besar' ? 'selected' : '' }}>Besar</option>
                                <option value="Sedang" {{ $produk->ukuran == 'Sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="Kecil" {{ $produk->ukuran == 'Kecil' ? 'selected' : '' }}>Kecil</option>
                            </select>
                            @error('ukuran')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="item form-group">
                        <label for="harga" class="col-form-label col-md-3 col-sm-3 label-align">Harga Ikan <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input required value="{{$produk->harga}}" id="harga" type="number" class="form-control @error('harga') is-invalid @enderror" name="harga">
                            @error('harga')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="item form-group">
                        <label for="stok" class="col-form-label col-md-3 col-sm-3 label-align">Stok Ikan <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input required value="{{$produk->stok}}" id="stok" type="number" class="form-control @error('stok') is-invalid @enderror" name="stok">
                            @error('stok')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="item form-group">
                        <label for="deskripsi" class="col-form-label col-md-3 col-sm-3 label-align">Deskripsi <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <textarea id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="3" name="deskripsi">{{$produk->deskripsi}}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="item form-group">
                        <label for="foto" class="col-form-label col-md-3 col-sm-3 label-align">Gambar Ikan <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <img src="{{$produk->foto}}" alt="{{$produk->nama_produk}}" class="foto-produk">
                            <input value="{{old('foto')}}" id="foto" type="file" class="form-control @error('foto') is-invalid @enderror" name="foto">
                            @error('foto')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3 text-center">
                            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
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


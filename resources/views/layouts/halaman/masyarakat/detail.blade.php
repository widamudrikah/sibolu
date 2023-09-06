@extends('layouts.apps')

@section('title')
Sibolu
@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet">
@endsection

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3> {{$produk->nama_produk}} </h3>
        </div>
        <div class="title_right">
            <div class="col-md-7 col-sm-7 form-group pull-right top_search">
                <form class="input-group" method="GET" action="{{ route('m.cari') }}">
                    <input type="text" class="form-control" name="search" placeholder="Cari apa...">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="submit">Mencari</button>
                    </span>
                </form>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Kalau cocok langsung checkout yaaa</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up ml-2 mr-1"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close ml-1"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>

                <div class="x_content">
                    <div class="col-md-7 col-sm-7">
                        <div class="product-image">
                            <img src="{{$produk->foto}}" alt="{{$produk->nama_produk}}">
                        </div>
                        <div class="product_gallery">
                            <a><img src="{{$produk->foto}}" alt="{{$produk->nama_produk}}"></a>
                            <a><img src="{{$produk->foto}}" alt="{{$produk->nama_produk}}"></a>
                            <a><img src="{{$produk->foto}}" alt="{{$produk->nama_produk}}"></a>
                            <a><img src="{{$produk->foto}}" alt="{{$produk->nama_produk}}"></a>
                        </div>
                    </div>
                    <div class="col-md-5 col-sm-5" style="border: 0px solid #e5e5e5;">
                        <h3 class="prod_title">{{$produk->nama_produk}}</h3>
                        <p>{{$produk->deskripsi}}</p>
                        <div class="">
                            <h2>Ukuran</h2>
                            <ul class="list-inline prod_size display-layout">
                                <li><button type="button" class="btn btn-default btn-xs">{{$produk->ukuran}}</button></li>
                            </ul>
                        </div>
                        <div class="">
                            <h2>Stok</h2>
                            <ul class="list-inline prod_size display-layout">
                                <li><button type="button" class="btn btn-default btn-xs">{{$produk->stok}} ekor</button></li>
                            </ul>
                        </div>
                        <div class="">
                            <div class="product_price">
                                <h1 class="price">Rp{{number_format($produk->harga)}}</h1>
                                <span class="price-tax">Harga : satuan</span>
                            </div>
                        </div>
                        <div class="">
                            @if ($produk->stok != 0)
                                <button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#beli{{$produk->id}}">Beli Langsung</button>
                            @else
                                <button type="button" class="btn btn-danger btn-lg" data-toggle="modal" data-target="#beli{{$produk->id}}">Stok Habis</button>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    @if ($produk->stok != 0)
        @include('layouts.modal.beli')
    @else
        @include('layouts.modal.error-beli')
    @endif

@endsection



@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>

    <script>

        $(document).ready(function() {
            $('#kota').select2();
        });

        function calculateTotal() {
            var hargaPerEkor = {{ $produk->harga }};
            var jumlahEkor = parseInt(document.getElementById("jumlah").value);
            var ongkir = parseFloat(document.getElementById("kota").value);
            var stokProduk = {{ $produk->stok }};

            if (isNaN(jumlahEkor) || jumlahEkor <= 0 || jumlahEkor > stokProduk) {
                document.getElementById("total").value = "Jumlah melebihi stok";
                document.getElementById("total2").value = 0;
            } else if (!isNaN(jumlahEkor) && !isNaN(ongkir)) {
                var totalHarga = (hargaPerEkor * jumlahEkor) + ongkir;
                document.getElementById("total").value = "Rp" + number_format(totalHarga, 0, ',', '.');
                document.getElementById("total2").value = totalHarga;
            } else if (!isNaN(ongkir)) {
                document.getElementById("total").value = "Rp" + number_format(ongkir, 0, ',', '.');
                document.getElementById("total2").value = ongkir;
            } else if(!isNaN(jumlahEkor)){
                var totalHarga = (hargaPerEkor * jumlahEkor);
                document.getElementById("total").value = "Rp" + number_format(totalHarga, 0, ',', '.');
                document.getElementById("total2").value = totalHarga;
            } else {
                document.getElementById("total").value = "Rp0";
            }
        }

    function number_format(number, decimals, dec_point, thousands_sep) {
        number = parseFloat(number);
        if (!decimals) decimals = 0;
        if (!dec_point) dec_point = '.';
        if (!thousands_sep) thousands_sep = ',';

        var rounded_number = Math.round(number * Math.pow(10, decimals)) / Math.pow(10, decimals);
        var rounded_string = rounded_number.toString();
        var decimal_count = (rounded_string.split('.')[1] || []).length;

        if (decimal_count < decimals) {
            for (var i = 0; i < decimals - decimal_count; i++) {
                rounded_string += '0';
            }
        }

        var parts = rounded_string.split('.');
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, thousands_sep);
        return parts.join(dec_point);
    }
    </script>

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

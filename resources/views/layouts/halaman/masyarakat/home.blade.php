@extends('layouts.apps')

@section('title')
Sibolu
@endsection

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3> Produk Sibolu </h3>
        </div>
        <div class="title_right">
            {{-- <div class="col-md-5 col-sm-5 form-group pull-right top_search">
                <div class="input-group">
                    <span class="input-group-btn">
                    <form method="POST" action="{{ route('m.cari') }}">
                        @csrf
                            <input type="text" class="form-control" name="search" placeholder="Cari produk">
                            <button class="btn btn-default" type="submit">Cari</button>
                        </form>
                    </span>
                </div>
            </div> --}}
            <div class="col-md-7 col-sm-7 form-group pull-right top_search">
                <form class="input-group" method="GET" action="{{ route('m.cari') }}">
                    {{-- @csrf --}}
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
                    <h2>Pilih Dan Checkout Sekarang Juga !</h2>
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up ml-2 mr-1"></i></a></li>
                        <li><a class="close-link"><i class="fa fa-close ml-1"></i></a></li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content" style="display: block;">
                    <div class="row">
                        <!-- Repeat this col-md-55 block for each image -->
                        <div id="produk-list">
                            @foreach ($produk as $dt)
                                <div class="col-md-55">
                                    <div class="thumbnail">
                                        <div class="image view view-first">
                                            <img style="width: 100%; display: block;" src="{{$dt->foto}}" alt="{{$dt->nama_produk}}">
                                            <div class="mask no-caption">
                                                <div class="tools tools-bottom">
                                                    <a href="#">Stok {{$dt->stok}}</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="caption">
                                            <a href="{{route('m.detail',$dt->id)}}">
                                                <p><strong>{{$dt->nama_produk}}</strong></p>
                                                <p title="{{$dt->deskripsi}}">{{$dt->deskripsi}}</p>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- Repeat the above block for each image -->
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('js')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function () {
            $('form').on('submit', function (e) {
                e.preventDefault(); // Mencegah halaman untuk memuat ulang
                var formData = $(this).serialize();
                $.ajax({
                    type: 'GET',
                    url: '{{ route('m.cari') }}',
                    data: formData,
                    success: function (data) {
                        // Menampilkan hasil pencarian dalam div dengan ID 'produk-list'
                        $('#produk-list').html(data);
                    }
                });
            });
        });
    </script> --}}
@endsection

@extends('layouts.apps')

@section('title')
Sibolu - Orderan
@endsection

@section('css')
    <!-- Datatables -->
    <link href="{{ asset('gentella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <style>
        table.dataTable td {
            vertical-align: middle; /* Center the content vertically */
            text-align: center;
        }
        table.dataTable th {
            text-align: center; /* Center the content vertically */
        }
        table .foto-produk{
            display: inline-block;
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Orderan</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row mt-3">

<div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List Data Orderan</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="ml-4 collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class=" ml-2 close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <p class="text-muted font-13 m-b-30">
                      Berikut List Data Orderan
                    </p>
                    <table id="databolu" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Kode</th>
                          <th>Produk</th>
                          <th>Pelanggan</th>
                          <th>Harga</th>
                          <th>Jumlah</th>
                          <th>Ongkir</th>
                          <th>Total</th>
                          <th>Pembayaran</th>
                          <th>Status</th>
                          {{-- <th>Action</th> --}}
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($pesanan as $dt)
                        <tr>
                          <td>#{{$dt->kode}}</td>
                          <td style="max-width: 100px;">
                            @php
                                $produk = App\Models\Produk::find($dt->produk_id);
                            @endphp
                            <img src="{{$produk->foto}}" alt="{{$produk->nama_produk}}" class="foto-produk mb-2">
                            {{$produk->nama_produk}}
                          </td>
                          <td>
                            @php
                                $rakyat = App\Models\Masyarakat::find($dt->masyarakat_id);
                                $user = App\Models\User::find($rakyat->user_id);
                                $masyarakat = $user->nama;
                            @endphp
                            {{$masyarakat}}
                          </td>
                          <td>Rp{{number_format($dt->harga);}}</td>
                          <td>{{$dt->jumlah}}</td>
                          <td>Rp{{number_format($dt->ongkir);}}</td>
                          <td>Rp{{number_format($dt->harga_total);}}</td>
                          <td>
                            @php

                                if ($dt->pembayaran == 'cod'){
                                    $bayar = "COD";
                                    $bayar2 = "COD";
                                } else{
                                    $bayar = "TRANSFER";
                                    $bayar2 = "TRANSFER";
                                }

                                if ($dt->status_bayar == 0){
                                    $sts_bayar = "BELUM LUNAS";
                                } elseif ($dt->status_bayar == 1) {
                                  $sts_bayar = "BELUM LUNAS";
                                } else{
                                    $sts_bayar = "LUNAS";
                                }   

                            @endphp 
                            {{-- @if ($dt->pembayaran == 'cod')
                              COD
                            @else
                              @if ($dt->bukti)
                                MENUNGGU KONFIRMASI
                              @else
                              {{$bayar}}
                              @endif 
                            @endif --}}
                            {{$bayar}}                     
                          </td>
                          <td>
                            @if ($dt->status_pesanan == 0)
                              MENUNGGU
                            @elseif ($dt->status_pesanan == 1)
                              MENUNGGU KURIR
                            @elseif ($dt->status_pesanan == 2)
                              DIANTAR KURIR
                            @else
                              SELESAI
                            @endif
                          </td>
                         {{-- <td>
                            <a href="#" data-toggle="modal" data-target="#pesananku{{$dt->id}}" class="btn btn-info" title="Klik untuk melihat detai"><i class="fa fa-eye"></i></a>
                            @include('layouts.modal.detail-pesanan')
                            <a href="#" data-toggle="modal" data-target="#pembayaranku{{$dt->id}}" class="btn btn-dark" title="Klik untuk melihat detail"><i class="fa fa-bicycle"></i></a>
                            @include('layouts.modal.detail-pembayaran')
                          </td>  --}}
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                  </div>
                  </div>
              </div>
            </div>
                </div>
              </div>

</div>
@endsection

@section('js')
    <!-- Datatables -->
    <script src="{{ asset('gentella/vendors/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('gentella/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('gentella/vendors/datatables.net-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('gentella/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('gentella/vendors/datatables.net-buttons/js/buttons.flash.min.js') }}"></script>
    <script src="{{ asset('gentella/vendors/datatables.net-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('gentella/vendors/datatables.net-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('gentella/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js') }}"></script>
    <script src="{{ asset('gentella/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js') }}"></script>
    <script src="{{ asset('gentella/vendors/datatables.net-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('gentella/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js') }}"></script>
    <script src="{{ asset('gentella/vendors/datatables.net-scroller/js/dataTables.scroller.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script type="text/javascript">
        $(function() {
          $('#databolu').DataTable({
          });
        });

        $(document).ready(function() {
            $('#status').select2();
        });
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




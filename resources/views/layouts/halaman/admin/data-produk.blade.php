@extends('layouts.apps')

@section('title')
Sibolu - Data Produk
@endsection

@section('css')
    <!-- Datatables -->
    <link href="{{ asset('gentella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
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
        <h3>Data Produk</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row mt-3">

<div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List Data Produk</h2>
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
                      Berikut List Data Produk
                    </p>
                    <table id="databolu" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>No.</th>
                          <th>Gambar</th>
                          <th>Nama Ikan</th>
                          <th>Harga</th>
                          <th>Ukuran</th>
                          <th>Stok</th>
                          <th>Deskripsi</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($produk as $dt)
                        <tr>
                          <td>{{$i++}}</td>
                          <td style="max-width: 100px;">
                            <img src="{{$dt->foto}}" alt="{{$dt->nama_produk}}" class="foto-produk">
                          </td>
                          <td>{{$dt->nama_produk}}</td>
                          <td>Rp{{number_format($dt->harga);}}</td>
                          <td class="text-left">
                              <span>
                                  Lebar :{{$dt->lebar}} cm<br>Panjang :{{$dt->panjang}} cm 
                                  
                            </span>
                              </td>
                          <td>{{$dt->stok}}</td>
                          <td>
                            <a href="#" data-toggle="modal" data-target="#lihatDeskripsi{{$dt->id}}">Lihat Deskripsi</a>
                            @include('layouts.modal.desk')
                          </td>
                          <td>
                            <a href="{{route('a.edit.produk',$dt->id)}}" class="btn btn-info" title="Klik untuk edit produk"><i class="fa fa-edit"></i></a>
                            <a href="{{route('a.hapus.produk',$dt->id)}}" onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')" class="btn btn-danger" title="Klik untuk edit produk"><i class="fa fa-trash"></i></a>
                          </td>
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

    <script type="text/javascript">
        $(function() {
          $('#databolu').DataTable({
          });
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




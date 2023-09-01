@extends('layouts.apps')

@section('title')
TaskApps - Materi Kelas {{ $kelas->nama_kelas }}
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
    </style>
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Data Materi</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row mt-3">

<div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>List Data Materi Kelas <span style="font-weight: 500; color:#73879C;">{{ $kelas->nama_kelas }}</span></h2>
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
                      Klik detail untuk melihat materi
                    </p>
                    <table id="MateriByClass" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Tanggal</th>
                          <th>Materi</th>
                          <th>Deskripsi</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
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
          $('#MateriByClass').DataTable({
              processing: true,
              serverSide: true,
              ajax: '{{ route("m.material.list",$class_id) }}',
              columns: [
                  { data: 'no', name: 'no' },
                  { data: 'tgl_materi', name: 'tgl_materi' },
                  { data: 'nama_materi', name: 'nama_materi' },
                  { data: 'rincian_materi', name: 'rincian_materi' },
                  { data: 'action', name: 'action' },
              ]
          });
        });
    </script>

    @if(session('on'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Update Status Tugas',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif

    @if(session('off'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Gagal Update Status Tugas',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif

    @if(session('ok'))
        <script>
            Swal.fire({
                icon: 'success',
                // title: '{{ session('success') }}',
                title: 'Berhasil membuat pembaruan tugas',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif

    @if(session('okk'))
        <script>
            Swal.fire({
                icon: 'success',
                // title: '{{ session('success') }}',
                title: 'Berhasil menambah materi',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif

    @if(session('ok2'))
        <script>
            Swal.fire({
                icon: 'success',
                // title: '{{ session('success') }}',
                title: 'Berhasil membuat pembaruan materi',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif

    @if(session('hapus'))
        <script>
            Swal.fire({
                icon: 'success',
                // title: '{{ session('success') }}',
                title: 'Berhasil hapus data materi',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif

@endsection
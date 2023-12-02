@extends('layouts.apps')

@section('title')
    Sibolu - Laporan
@endsection

@section('css')
    <!-- Datatables -->
    <link href="{{ asset('gentella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}"
        rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
    <style>
        table.dataTable td {
            vertical-align: middle;
            /* Center the content vertically */
            text-align: center;
        }

        table.dataTable th {
            text-align: center;
            /* Center the content vertically */
        }

        table .foto-produk {
            display: inline-block;
            max-width: 100%;
            height: auto;
        }
    </style>
@endsection

@section('content')
    <div class="page-title">
        <div class="title_left">
            <h3>Laporan</h3>
        </div>
    </div>

    <div class="clearfix"></div>

    <div class="row mt-3">

        @foreach ($transactionsY->keys() as $year)
            <div class="col-3 card">
                <div class="card-body d-flex flex-column align-items-center">
                    <h5 class="card-title">{{ $year }}</h5>
                    <a href="{{ route('a.laporan-tahun-details', ['year' => $year]) }}" class="btn btn-primary">Lihat
                        Laporan</a>
                </div>
            </div>
        @endforeach


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
            $('#databolu').DataTable({});
        });
    </script>

    @if (session('ok'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '{{ session('ok') }}',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif
@endsection

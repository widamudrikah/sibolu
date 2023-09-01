@extends('layouts.apps')

@section('title')
TaskApps - Profil Mahasiswa
@endsection

@section('css')
    <!-- Datatables -->    
    <link href="{{ asset('gentella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
    <style>
        .detail-mahasiswa {
           text-transform: uppercase;
        }
        .pas-foto{
          width: 8rem;
          height: 11rem;
          border: 1px solid #e9ecef;
          outline: 1px solid #e9ecef;          
        }
    </style>
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Profil Mahasiswa</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row mt-3">
    <div class="col-md-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Data Mahasiswa</h2>
                <ul class="nav navbar-right panel_toolbox">
                    <li><a class="ml-4 collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                    <li><a class=" ml-2 close-link"><i class="fa fa-close"></i></a>
                    </li>
                </ul>
                <div class="clearfix"></div>
            </div>
            <div class="x_content" style="display: block;">
                <br>
                <form class="form-label-left input_mask">

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">NIM </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" name="nim" class="form-control detail-mahasiswa" disabled="disabled" value="{{$nim}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Nama Mahasiswa </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" name="nama_mahasiswa" class="form-control detail-mahasiswa" disabled="disabled" value="{{$mhs->nama_mahasiswa}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Tempat Lahir </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" name="tempat_lahir" class="form-control detail-mahasiswa" disabled="disabled" value="{{ $mhs->tempat_lahir == '' ? '-' : $mhs->tempat_lahir }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Tanggal Lahir </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="{{ $mhs->tgl_lahir == '' ? 'text' : 'date' }}" name="tgl_lahir" class="form-control detail-mahasiswa" disabled="disabled" value="{{ $mhs->tgl_lahir == '' ? '-' : $mhs->tgl_lahir }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Jenis Kelamin </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input id="genderInput" type="text" name="gender" class="form-control detail-mahasiswa" disabled="disabled" value="{{$mhs->gender}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Telepon </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" name="telp" class="form-control detail-mahasiswa" disabled="disabled" value="{{ $mhs->telp == '' ? '-' : $mhs->telp }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Jurusan </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" name="jurusan_id" class="form-control detail-mahasiswa" disabled="disabled" value="{{ $jurusan->nama_jurusan }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Alasan pilih IDN</label>
                        <div class="col-md-9 col-sm-9 ">
                            <!-- <textarea class="form-control detail-mahasiswa" rows="3" name="alasan" disabled="disabled">{{ $mhs->alasan == '' ? '-' : $mhs->alasan }}</textarea> -->
                            <div class="form-control" disabled="disabled" style="height: fit-content; background-color: #e9ecef;">{!! $mhs->alasan == '' ? '-' : $mhs->alasan !!}</div>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Foto</label>
                        <div class="col-md-9 col-sm-9 ">
                            @if($mhs->foto)
                            <img src="{{ $mhs->foto }}" class="pas-foto" alt="Foto {{ucwords(strtolower($mhs->nama_mahasiswa))}}">
                            @else
                            <img src="{{ asset('gentella/production/images/mhs.jpg') }}" class="pas-foto" alt="Foto {{ucwords(strtolower($mhs->nama_mahasiswa))}}">
                            @endif
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="button" onclick="goBack()" class="btn btn-secondary">Kembali</button>
                        </div>
                    </div>

                </form>
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
        var genderInput = document.getElementById("genderInput");
        var genderValue = genderInput.value;

        if (genderValue === "L") {
            genderInput.value = "LAKI-LAKI";
        } else if (genderValue === "P") {
            genderInput.value = "PEREMPUAN";
        }

        function goBack() {
            window.history.back();
        }
    </script>

@endsection
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
                @if(Auth::user()->mahasiswa->lengkap == 1)
                    <form action="#" class="form-label-left input_mask">
                @else
                    <form action="{{ route('m.profile.save') }}" enctype="multipart/form-data" method="POST" class="form-label-left input_mask">
                    @csrf
                    @method('PUT')
                @endif                
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">NIM </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" name="nim" class="form-control detail-mahasiswa" disabled="disabled" value="{{$nim}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Nama Mahasiswa </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" name="nama_mahasiswa" disabled="disabled" class="form-control detail-mahasiswa" value="{{$mhs->nama_mahasiswa}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Tempat Lahir *</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" name="tempat_lahir" class="form-control detail-mahasiswa @error('tempat_lahir') is-invalid @enderror" value="{{ old('tempat_lahir',$mhs->tempat_lahir) }}">
                            @error('tempat_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>                                
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Tanggal Lahir *</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="date" name="tgl_lahir" class="form-control detail-mahasiswa @error('tgl_lahir') is-invalid @enderror" value="{{ old('tgl_lahir',$mhs->tgl_lahir) }}">
                            @error('tgl_lahir')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Jenis Kelamin  </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input id="genderInput" type="text" name="gender" disabled="disabled" class="form-control detail-mahasiswa" value="{{$mhs->gender}}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Telepon  *</label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" name="telp" class="form-control detail-mahasiswa @error('telp') is-invalid @enderror" value="{{ old('telp', $mhs->telp) }}">
                            @error('telp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Jurusan  </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" name="jurusan_id" class="form-control detail-mahasiswa" disabled="disabled" value="{{ $jurusan->nama_jurusan }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Alasan pilih IDN *</label>
                        <div class="col-md-9 col-sm-9 ">
                            <textarea id="alasan" class="form-control detail-mahasiswa @error('alasan') is-invalid @enderror" rows="3" name="alasan">{{ old('alasan', $mhs->alasan) }}</textarea>
                            @error('alasan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Pas Foto 3x4 *</label>
                        <div class="col-md-9 col-sm-9 ">
                            @if($mhs->foto)
                                <img src="{{ $mhs->foto }}" class="pas-foto mb-2" alt="Foto {{ucwords(strtolower($mhs->nama_mahasiswa))}}">
                                @if(Auth::user()->mahasiswa->lengkap == 0)
                                    <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
                                    @error('foto')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                @endif
                            @else
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>
                    </div>

                    <div class="ln_solid"></div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            @if(Auth::user()->mahasiswa->lengkap == 1)
                                <button type="button" class="btn btn-secondary">Hubungi Admin</button>
                            @else
                                <button type="submit" class="btn btn-info">Save Change</button>
                            @endif
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
    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <script type="text/javascript">
        var genderInput = document.getElementById("genderInput");
        var genderValue = genderInput.value;

        if (genderValue === "L") {
            genderInput.value = "LAKI-LAKI";
        } else if (genderValue === "P") {
            genderInput.value = "PEREMPUAN";
        }

        function initializeCKEditor(elementId) {
            ClassicEditor
                .create(document.querySelector(`#${elementId}`), {
                    extraPlugins: ['Link'],
                    // placeholder: 'Ketik di sini...'
                })
                .then(editor => {
                    console.log(editor);
                })
                .catch(error => {
                    console.error(error);
                });
        }
        initializeCKEditor('alasan');

    </script>

    @if(Auth::user()->mahasiswa->lengkap == 1)
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Update profile hanya dilakukan sekali, Jika ada data anda yang salah silahkan hubungi admin.',
                confirmButtonText: 'Oke',
            });
        </script>
    @else
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Harap lengkapi profil Anda terlebih dahulu',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif

    @if(session('warning'))
        <script>
            Swal.fire({
                icon: 'info',
                title: 'Harap lengkapi profil Anda terlebih dahulu',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif

@endsection
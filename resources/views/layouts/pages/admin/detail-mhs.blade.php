@extends('layouts.apps')

@section('title')
TaskApps - Edit Profil Mahasiswa
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
        <h3>Edit Profil Mahasiswa</h3>
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
                    <form action="{{ route('a.students.save.change') }}" enctype="multipart/form-data" method="POST" class="form-label-left input_mask">
                    @csrf
                    @method('PUT')              
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Email </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="hidden" name="student_id"  value="{{ Crypt::encrypt($mhs->id) }}">
                            <input type="text" name="email" class="form-control"  value="{{ old('email',$user->email) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">NIM </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" name="nim" class="form-control detail-mahasiswa"  value="{{ old('nim',$nim) }}">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Nama Mahasiswa </label>
                        <div class="col-md-9 col-sm-9 ">
                            <input type="text" name="nama_mahasiswa"  class="form-control detail-mahasiswa" value="{{ old('nama_mahasiswa',$mhs->nama_mahasiswa) }}">
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
                            <!-- <input type="text" name="gender"  class="form-control" value="{{$mhs->gender}}"> -->
                            <select id="gender" class="form-control detail-mahasiswa" name="gender">
                                <option value="L" {{ $mhs->gender == 'L' ? 'selected' : '' }}>Laki-Laki</option>
                                <option value="P" {{ $mhs->gender == 'P' ? 'selected' : '' }}>Perempuan</option>
                            </select>
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
                            <select id="jurusan_id" class="form-control detail-mahasiswa @error('jurusan_id') is-invalid @enderror" name="jurusan_id">
                                <option value="">-- Pilih Jurusan --</option>
                                @foreach($jurusan as $dt)
                                    <option value="{{ $dt->id }}" {{ $mhs->jurusan_id == $dt->id ? 'selected' : '' }}>{{ $dt->nama_jurusan }}</option>
                                @endforeach
                            </select>
                            @error('jurusan_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
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
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @else
                                <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto">
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            @endif
                        </div>
                    </div>

                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3">Kelengkapan Data  </label>
                        <div class="col-md-9 col-sm-9 ">
                            <select id="lengkap" class="form-control detail-mahasiswa" name="lengkap">
                                <option value="0" {{ $mhs->lengkap == '0' ? 'selected' : '' }}>Belum Lengkap</option>
                                <option value="1" {{ $mhs->lengkap == '1' ? 'selected' : '' }}>Sudah Lengkap</option>
                            </select>
                        </div>
                    </div>


                    <div class="ln_solid"></div>
                    <div class="form-group row">
                        <div class="col-md-9 col-sm-9  offset-md-3">
                            <button type="submit" class="btn btn-info">Save Change</button>
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

        function goBack() {
            window.history.back();
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

@endsection
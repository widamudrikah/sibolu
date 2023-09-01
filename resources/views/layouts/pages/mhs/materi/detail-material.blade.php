@extends('layouts.apps')

@section('title')
TaskApps - Detail Materi
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Detail Materi</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row mt-3">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Materi<small>{{ $materi->nama_materi }}</small></h2>
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
                    <input type="hidden" name="material_id" value="{{Crypt::encrypt($materi->id)}}">
                    <div class="item form-group">
                        <label for="kelas_id" class="col-form-label col-md-3 col-sm-3 label-align">Materi Kelas <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <select id="kelas_id" class="form-control" disabled="disabled" name="kelas_id">
                                <option value="">-- Pilih Kelas --</option>
                                <option selected>{{ $kelas->nama_kelas }}</option>
                            </select>
                        </div>
                    </div>               
                    <div class="item form-group">
                        <label for="tgl_materi" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Materi <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input value="{{ $materi->tgl_materi }}" id="tgl_materi" disabled="disabled" class="form-control" type="date" name="tgl_materi">
                        </div>
                    </div>    
                    <div class="item form-group">
                        <label for="nama_materi" class="col-form-label col-md-3 col-sm-3 label-align">Nama Materi <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <textarea id="nama_materi" class="form-control" rows="3" name="nama_materi" disabled="disabled">{{ $materi->nama_materi }}</textarea>
                        </div>
                    </div>                    
                    <div class="item form-group">
                        <label for="rincian_materi" class="col-form-label col-md-3 col-sm-3 label-align">Deskripsi Materi <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <div class="form-control" disabled="disabled" style="height: fit-content; background-color:#e9ecef;">{!! $materi->rincian_materi !!}</div>
                        </div>
                    </div>                     
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                            <button type="button" onclick="goBack()" class="btn btn-secondary">Kembali</button>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>

@endsection


@section('js')

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
    <script>
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
        initializeCKEditor('rincian_materi');
        
        function goBack() {
            window.history.back();
        }
    </script>

    @if(session('ok'))
        <script>
            Swal.fire({
                icon: 'success',
                // title: '{{ session('success') }}',
                title: 'Berhasil menambah materi',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif
@endsection


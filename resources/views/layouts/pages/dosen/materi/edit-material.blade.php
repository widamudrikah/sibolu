@extends('layouts.apps')

@section('title')
TaskApps - Edit Materi
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Edit Materi</h3>
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
                <form method="post" action="{{ route('d.material.save.change') }}" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="material_id" value="{{Crypt::encrypt($materi->id)}}">
                    <div class="item form-group">
                        <label for="kelas_id" class="col-form-label col-md-3 col-sm-3 label-align">Materi Untuk <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <select id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" name="kelas_id">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($selectClass as $dt)
                                    <?php 
                                        $jumlah = App\Models\Materi::where('kelas_id',$dt->id)->count();
                                    ?>
                                    <option value="{{ $dt->id }}" {{ $materi->kelas_id == $dt->id ? 'selected' : '' }}>{{ $dt->nama_kelas }} ({{ $jumlah }})</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>               
                    <div class="item form-group">
                        <label for="tgl_materi" class="col-form-label col-md-3 col-sm-3 label-align">Tanggal Materi <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input value="{{ $materi->tgl_materi }}" id="tgl_materi" class="form-control  @error('tgl_materi') is-invalid @enderror" type="date" name="tgl_materi">
                            @error('tgl_materi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>    
                    <div class="item form-group">
                        <label for="nama_materi" class="col-form-label col-md-3 col-sm-3 label-align">Nama Materi <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <textarea id="nama_materi" class="form-control @error('nama_materi') is-invalid @enderror" rows="3" name="nama_materi">{{ $materi->nama_materi }}</textarea>
                            @error('nama_materi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>                    
                    <div class="item form-group">
                        <label for="rincian_materi" class="col-form-label col-md-3 col-sm-3 label-align">Deskripsi Materi <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <textarea id="rincian_materi" class="form-control @error('rincian_materi') is-invalid @enderror" rows="4" name="rincian_materi">{{ $materi->rincian_materi }}</textarea>
                            <!-- @include('layouts.includes.editor') -->
                            @error('rincian_materi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>                     
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3 text-center">
                            <button type="submit" class="btn btn-success">Save Change</button>
                        </div>
                    </div>
                </form>
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


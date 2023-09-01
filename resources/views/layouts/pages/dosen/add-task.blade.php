@extends('layouts.apps')

@section('title')
TaskApps - Tambah Tugas
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Tambah Tugas</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row mt-3">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tambah Tugas<small>Untuk kelas tertentu</small></h2>
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
                <form method="post" action="{{ route('a.task.save') }}" id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">
                    @csrf
                    <div class="item form-group">
                        <label for="kelas_id" class="col-form-label col-md-3 col-sm-3 label-align">Tugas Untuk <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <select id="kelas_id" class="form-control @error('kelas_id') is-invalid @enderror" name="kelas_id">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($kelas as $dt)
                                    <?php 
                                        $jumlah = App\Models\Tugas::where('kelas_id',$dt->id)->count();
                                    ?>
                                    <option value="{{ $dt->id }}">{{ $dt->nama_kelas }} ({{ $jumlah }})</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>                       
                    <div class="item form-group">
                        <label for="jenis_tugas" class="col-form-label col-md-3 col-sm-3 label-align">Jenis Tugas <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <select id="jenis_tugas" class="form-control @error('jenis_tugas') is-invalid @enderror" name="jenis_tugas">
                                <option value="">-- Pilih --</option>
                                <option value="1">Youtube</option>
                                <option value="2">Blog, Artikel atau Lainnya</option>
                            </select>
                            @error('jenis_tugas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                    <div class="item form-group">
                        <label for="tugas_ke" class="col-form-label col-md-3 col-sm-3 label-align">Tugas Ke <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="tugas_ke" class="form-control  @error('tugas_ke') is-invalid @enderror" type="number" name="tugas_ke">
                            @error('tugas_ke')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>               
                    <div class="item form-group">
                        <label for="deadline" class="col-form-label col-md-3 col-sm-3 label-align">Batas Tanggal <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="deadline" class="form-control  @error('deadline') is-invalid @enderror" type="date" name="deadline">
                            @error('deadline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>                    
                    <div class="item form-group">
                        <label for="jam" class="col-form-label col-md-3 col-sm-3 label-align">Batas Jam <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="jam" class="form-control  @error('jam') is-invalid @enderror" type="time" name="jam">
                            @error('jam')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="soal" class="col-form-label col-md-3 col-sm-3 label-align">Soal <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <textarea id="soal" class="form-control @error('soal') is-invalid @enderror" rows="3" name="soal"></textarea>
                            @error('soal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>                    
                    <div class="item form-group">
                        <label for="deskripsi" class="col-form-label col-md-3 col-sm-3 label-align">Deskripsi Soal <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <textarea id="deskripsi" class="form-control @error('deskripsi') is-invalid @enderror" rows="4" name="deskripsi"></textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>                     
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3 text-center">
                            <button type="submit" class="btn btn-success">Submit</button>
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
        initializeCKEditor('soal');
        initializeCKEditor('deskripsi');
    </script>
    @if(session('ok'))
        <script>
            Swal.fire({
                icon: 'success',
                // title: '{{ session('success') }}',
                title: 'Berhasil mengirim tugas',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif
@endsection


@extends('layouts.apps')

@section('title')
TaskApps - Form Pilih Kelas
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Registrasi Kelas</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row mt-3">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Pilih Kelas<small>Sesuai arahan mentor</small></h2>
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
                <form method="post" action="{{ route('m.class.save') }}">
                    @csrf
                    <div class="item form-group">
                        <label for="kelas_id" class="col-form-label col-md-3 col-sm-3 label-align">Kelas <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <select id="kelas_id" required class="form-control @error('kelas_id') is-invalid @enderror" name="kelas_id">
                                <option value="">-- Pilih Kelas --</option>
                                @foreach($kelas as $dt)
                                    <?php
                                        $mentor = App\Models\Dosen::where('id',$dt->dosen_id)->first();
                                        $terdaftar = $kelasTerdaftar->contains('kelas_id', $dt->id);
                                    ?>
                                    <option value="{{ $dt->id }}" {{ $terdaftar ? 'disabled' : '' }}>{{ $dt->nama_kelas }} ({{ $mentor->nama_dosen }})</option>
                                @endforeach
                            </select>
                            @error('kelas_id')
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
    @if(session('ok'))
        <script>
            Swal.fire({
                icon: 'success',
                // title: '{{ session('success') }}',
                title: 'Berhasil Registrasi Kelas',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif
@endsection


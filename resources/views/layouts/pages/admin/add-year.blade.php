@extends('layouts.apps')

@section('title')
TaskApps - Tambah Tahun
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Tambah Tahun</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row mt-3">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Tambah Tahun<small>Data tahun perkuliahan berjalan</small></h2>
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
                <form method="post" action="{{ route('a.year.save') }}">
                    @csrf
                    <div class="item form-group">
                        <label for="tahun" class="col-form-label col-md-3 col-sm-3 label-align">Tahun <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="tahun" required class="form-control @error('tahun') is-invalid @enderror" type="number" name="tahun">
                            @error('tahun')
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
                title: 'Sukses menyimpan tahun perkuliahan',
                confirmButtonText: 'Sip',
            });
        </script>
    @endif
@endsection


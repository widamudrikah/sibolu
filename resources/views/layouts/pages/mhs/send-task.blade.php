@extends('layouts.apps')

@section('title')
TaskApps - Kirim Tugas-{{ $tugas->tugas_ke }}
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Kirim Tugas-{{ $tugas->tugas_ke }}</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row mt-3">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Kirim Tugas<small>Untuk diperiksa dan dinilai</small></h2>
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
                <form method="post" action="{{ route('m.task.send.save') }}">
                    @csrf  
                    <div class="item form-group">
                        <label for="kelas" class="col-form-label col-md-3 col-sm-3 label-align">Kelas <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="kelas" class="form-control" value="{{ $kelas->nama_kelas }}" disabled="disabled">
                        </div>
                    </div>    
                    <div class="item form-group">
                        <label for="tugas_ke" class="col-form-label col-md-3 col-sm-3 label-align">Tugas Ke <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="tugas_ke" class="form-control" value="Tugas-{{ $tugas->tugas_ke }}" disabled="disabled">
                        </div>
                    </div>  
                    <div class="item form-group">
                        <label for="pengirim" class="col-form-label col-md-3 col-sm-3 label-align">Pengirim <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="pengirim" class="form-control" value="{{ Auth::user()->mahasiswa->nama_mahasiswa }}" disabled="disabled">
                        </div>
                    </div>    
                    <div class="item form-group">
                        <label for="Penerima" class="col-form-label col-md-3 col-sm-3 label-align">Penerima <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="Penerima" class="form-control" value="{{ $dosen->nama_dosen }}" disabled="disabled">
                        </div>
                    </div>    
                    <div class="item form-group">
                        <label for="soal" class="col-form-label col-md-3 col-sm-3 label-align">Soal <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <div class="form-control" disabled="disabled" style="height: fit-content; background-color:#e9ecef;">{!! $tugas->soal !!}</div>                            
                        </div>
                    </div>
                    <div class="item form-group"> 
                        <label for="desk" class="col-form-label col-md-3 col-sm-3 label-align">Deskripsi Soal <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <div class="form-control" disabled="disabled" style="height: fit-content; background-color:#e9ecef;">{!! $tugas->deskripsi !!}</div>
                        </div>
                    </div>
                    <div class="item form-group">
                        <label for="Batas Pengiriman" class="col-form-label col-md-3 col-sm-3 label-align">Batas Pengiriman <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="Batas Pengiriman" class="form-control" value="{{ $tgl_dead}} - {{$tugas->jam_deadline}}" disabled="disabled">
                        </div>
                    </div> 
                    <div class="item form-group">
                        <label for="jenis_tugas" class="col-form-label col-md-3 col-sm-3 label-align">Jenis Tugas <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="jenis_tugas" class="form-control" value="{{ $jenis }}" disabled="disabled">
                        </div>
                    </div> 

                    <input type="hidden" name="tugas_id" value="{{$tugas->id}}">
                    <input type="hidden" name="kelas_id" value="{{$tugas->kelas_id}}">

                    <div class="item form-group">
                        <label for="link_tugas" class="col-form-label col-md-3 col-sm-3 label-align">Link Tugas <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input value="{{old('link_tugas')}}" id="link_tugas" class="form-control @error('link_tugas') is-invalid @enderror" name="link_tugas">
                            @error('link_tugas')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div> 
                    <div class="item form-group">
                        <label for="kendala" class="col-form-label col-md-3 col-sm-3 label-align">Kendala Tugas <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <textarea id="kendala" class="form-control @error('kendala') is-invalid @enderror" rows="3" name="kendala">{{old('kendala')}}</textarea>
                            @error('kendala')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>                     
                    <div class="ln_solid"></div>
                    <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3 text-center">
                            <button type="submit" class="btn btn-success"><i class="fa fa-send-o mr-2"></i>Send</button>
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
                title: 'Berhasil mengirim tugas',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif
@endsection


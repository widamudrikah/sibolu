@extends('layouts.apps')

@section('title')
TaskApps - Respon Tugas-{{ $tugas->tugas_ke }}
@endsection

@section('css')
    <!-- Datatables -->    
    <link href="{{ asset('gentella/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('gentella/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css') }}" rel="stylesheet">
    <style>
        table.dataTable td {
            vertical-align: middle; /* Center the content vertically */
            text-align: center;
        }
        table.dataTable th {
            text-align: center; /* Center the content vertically */
        }
    </style>
@endsection

@section('content')

<div class="page-title">
    <div class="title_left">
        <h3>Respon Tugas-{{ $tugas->tugas_ke }}</h3>
    </div>
</div>

<div class="clearfix"></div>

<div class="row mt-3">
    <div class="col-md-12 col-sm-12 ">
        <div class="x_panel">
            <div class="x_title">
                <h2>Informasi Tugas</h2>
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
                    <div class="item form-group">
                        <label for="kelas" class="col-form-label col-md-3 col-sm-3 label-align">Kelas <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="kelas" class="form-control" value="{{$kelas->nama_kelas}}" disabled="disabled">
                          </div>
                    </div>  
                    <div class="item form-group">
                        <label for="kelas" class="col-form-label col-md-3 col-sm-3 label-align">Dosen <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="kelas" class="form-control" value="{{$dosen->nama_dosen}}" disabled="disabled">
                          </div>
                    </div>              
                    <div class="item form-group">
                        <label for="tugas_ke" class="col-form-label col-md-3 col-sm-3 label-align">Tugas Ke <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="tugas_ke" class="form-control" value="Tugas-{{$tugas->tugas_ke}}" disabled="disabled">
                          </div>
                    </div>               
                    <div class="item form-group">
                        <label for="jenis" class="col-form-label col-md-3 col-sm-3 label-align">Jenis Tugas <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="jenis" class="form-control" value="{{ $tugas->jenis_tugas == 1 ? 'Youtube' : 'Blog, Artikel atau Lainnya' }}" disabled="disabled">
                          </div>
                    </div>               
                    <div class="item form-group">
                        <label for="deadline" class="col-form-label col-md-3 col-sm-3 label-align">Batas Tanggal <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="deadline" class="form-control" disabled="disabled" type="date" value="{{$tugas->tgl_deadline}}">
                          </div>
                    </div>                    
                    <div class="item form-group">
                        <label for="jam" class="col-form-label col-md-3 col-sm-3 label-align">Batas Jam <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <input id="jam" class="form-control" disabled="disabled" type="time" value="{{$tugas->jam_deadline}}">
                          </div>
                    </div>
                    <?php
                        $konten = $tugas->deskripsi;
                        $konten2 = $tugas->soal;
                        $deskripsi = strip_tags($konten);
                        $soal = strip_tags($konten2);
                    ?>
                    <div class="item form-group">
                        <label for="soal" class="col-form-label col-md-3 col-sm-3 label-align">Soal <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">
                            <div class="form-control" disabled="disabled" style="height: fit-content; background-color:#e9ecef;">{!! $tugas->soal !!}</div>
                          </div>
                    </div>                    
                    <div class="item form-group">
                        <label for="deskripsi" class="col-form-label col-md-3 col-sm-3 label-align">Deskripsi Soal <span class="required">*</span></label>
                        <div class="col-md-6 col-sm-6 ">                            
                            <div class="form-control" disabled="disabled" style="height: fit-content; background-color:#e9ecef;">{!! $tugas->deskripsi !!}</div>
                          </div>
                    </div>                     
                    <div class="ln_solid"></div>
            </div>
        </div>
    </div>
</div>

<div class="row">

      <div class="col-md-12 col-sm-12 ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Respon Tugas</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="ml-4 collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li><a class=" ml-2 close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
                    <p class="text-muted font-13 m-b-30">
                      Klik tombol <b>Lihat Tugas</b> untuk melihat detail tugas yang telah dikirim ke mahasiswa
                    </p>
                    <table id="Response" class="table table-striped table-bordered" style="width:100%">
                      <thead>
                        <tr>
                          <th>Tanggal Kirim</th>
                          <th>Mahasiswa</th>
                          <th>Link</th>
                          <th>Kendala</th>
                          <th>Pesan</th>
                          <th>Nilai</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      </tbody>
                    </table>
                  </div>
                  </div>
              </div>
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
        $(function() {
          $('#Response').DataTable({
              processing: true,
              serverSide: true,
              ajax: '{{ route("d.response.list",$task_id) }}',
              columns: [
                  { data: 'mengirim', name: 'mengirim' },
                  { data: 'mahasiswa_id', name: 'mahasiswa_id' },
                  { data: 'link_tugas', name: 'link_tugas' },
                  { data: 'kendala', name: 'kendala' },
                  { data: 'komentar', name: 'komentar' },
                  { data: 'nilai', name: 'nilai' },
                  { data: 'action', name: 'action' },
              ]
          });
        });
    </script>

    @if(session('on'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Hapus Data Tugas',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif

    @if(session('gas'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Berhasil Beri Feed Back',
                confirmButtonText: 'Oke',
            });
        </script>
    @endif

@endsection
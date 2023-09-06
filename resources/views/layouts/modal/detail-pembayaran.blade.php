<div class="modal fade" id="pembayaranku{{$dt->id}}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rincian Pembayaran</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Pembeli</label>
                        <div class="col-md-9 col-sm-9">
                            @php
                                $rakyat = App\Models\Masyarakat::find($dt->masyarakat_id);
                                $user = App\Models\User::find($rakyat->user_id);
                                $masyarakat = $user->nama;
                            @endphp
                            <input class="form-control" type="text" disabled value="{{ $masyarakat }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Pengantar</label>
                        <div class="col-md-9 col-sm-9">
                            @php
                                if (empty($dt->pengantar_id)){
                                    $pengantar = "-";
                                } else {
                                    $kurir = App\Models\Pengantar::find($dt->pengantar_id);
                                    $user = App\Models\Pengantar::find($kurir->user_id);
                                    $pengantar = $user->nama;
                                }
                            @endphp
                            <input class="form-control" type="text" disabled value="{{ $pengantar }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Jenis Pembayaran</label>
                        <div class="col-md-9 col-sm-9">
                            <input class="form-control" type="text" disabled value="{{ $bayar }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Status Pembayaran</label>
                        <div class="col-md-9 col-sm-9">
                            <input disabled class="form-control" type="text" value="{{ $dt->status_bayar }}" name="jumlah" id="jumlah">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Status Pesanan</label>
                        <div class="col-md-9 col-sm-9">
                            <input class="form-control" type="text" id="total" readonly value="{{ $dt->status_pesanan}}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Bukti Pembayaran</label>
                        <div class="col-md-9 col-sm-9 text-left">
                            @if ($dt->bukti)
                            <img style="width: 50%; height:auto;" src="{{ $dt->bukti }}" alt="Paid" class="img-fluid">
                            @else
                            <img style="width: 50%; height:auto;" src="{{ asset('gentella/production/images/unpaid.png') }}" alt="Unpaid" class="img-fluid">
                            @endif
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    {{-- <button type="submit" class="btn btn-info">Checkout</button> --}}
                </div>
            </form>
        </div>
    </div>
</div>

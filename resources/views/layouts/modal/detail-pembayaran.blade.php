<div class="modal fade" id="pembayaranku{{ $dt->id }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rincian Pengiriman</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            @if (Auth::user()->role == 3 || Auth::user()->role == 1)
            <form action="{{ route('a.update.status.pengantar') }}" method="POST" enctype="multipart/form-data">
            @elseif (Auth::user()->role == 2)
            <form action="{{ route('p.update.status.pengantar') }}" method="POST" enctype="multipart/form-data">
            @endif
                @csrf
                <input name="pesanan_id" type="hidden" value="{{ $dt->id }}">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Status Pesanan</label>
                        @if (Auth::user()->role == 3 || Auth::user()->role == 1)
                            <div class="col-md-9 col-sm-9">
                                @php
                                    if ($dt->status_pesanan == 0) {
                                        $sts_pesanan = 'MENUNGGU';
                                    } elseif ($dt->status_pesanan == 1) {
                                        $sts_pesanan = 'MENUNGGU KURIR';
                                    } elseif ($dt->status_pesanan == 2) {
                                        $sts_pesanan = 'SEDANG DIANTAR KURIR';
                                    } else {
                                        $sts_pesanan = 'SELESAI';
                                    }
                                @endphp
                                <input class="form-control" type="text" disabled value="{{ $sts_pesanan }}">
                            </div>
                        @elseif (Auth::user()->role == 2)
                            <div class="col-md-9 col-sm-9  text-left">
                                <select style="width: 100%;" class="form-control" name="status_pesanan" id="status"
                                    required">
                                    <option value="">-- Pilih Status Pesanan --</option>
                                    <option value="2"<?php if ($dt->status_pesanan == 2) {
                                        echo ' selected';
                                    } ?>>SEDANG DIANTAR KURIR</option>
                                    <option value="3"<?php if ($dt->status_pesanan == 3) {
                                        echo ' selected';
                                    } ?>>SELESAI</option>
                                </select>
                            </div>
                        @endif
                    </div>

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
                        @if (Auth::user()->role == 1)
                            <div class="col-md-9 col-sm-9  text-left">
                                @php
                                    $delivery = App\Models\Pengantar::all();
                                @endphp
                                <select style="width: 100%;" class="form-control" name="pengantar_id" id="status"
                                    required">
                                    <option value="">-- Pilih Pengantar --</option>
                                    @foreach ($delivery as $data)
                                        @php
                                            $userDelivery = App\Models\User::find($data->user_id);
                                        @endphp
                                        <option value="{{ $data->id }}" <?php if ($data->id == $dt->pengantar_id) {
                                            echo ' selected';
                                        } ?>>
                                            {{ $userDelivery->nama }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @elseif (Auth::user()->role == 3 || Auth::user()->role == 2)
                            <div class="col-md-9 col-sm-9">

                                @php
                                    if (empty($dt->pengantar_id)) {
                                        $pengantar = '-';
                                    } else {
                                        $kurir = App\Models\Pengantar::find($dt->pengantar_id);
                                        $userKurir = App\Models\User::find($kurir->user_id);
                                    }
                                @endphp

                                @if (empty($dt->pengantar_id))
                                    <input class="form-control" type="text" disabled value="{{ $pengantar }}">
                                @else
                                    <input class="form-control" type="text" disabled
                                        value="{{ $userKurir->telepon }} | {{ $userKurir->nama }}">
                                @endif

                            </div>
                        @endif
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Alamat Lengkap</label>
                        <div class="col-md-9 col-sm-9">
                            <textarea class="form-control" required rows="3" name="alamat" disabled>{{ $dt->alamat }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    @if (Auth::user()->role == 1 || Auth::user()->role == 2)
                        <button type="submit" class="btn btn-info">Update</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="pesananku{{ $dt->id }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rincian Pesanan</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <form action="{{ route('p.bukti.simpan') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input name="pesanan_id" type="hidden" value="{{ $dt->id }}">
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Kode Pesanan</label>
                        <div class="col-md-9 col-sm-9">
                            <input class="form-control" type="text" disabled value="#{{ $dt->kode }}">
                        </div>
                    </div>
                    @if (Auth::user()->role == 1 || Auth::user()->role == 3)
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 text-left">Status Pesanan</label>
                            @if (Auth::user()->role == 1)
                                <div class="col-md-9 col-sm-9  text-left">
                                    <select style="width: 100%;" class="form-control" name="status_pesanan"
                                        id="status" required">
                                        <option value="">-- Pilih Status Pesanan --</option>
                                        <option value="0"<?php if ($dt->status_pesanan == 0) {
                                            echo ' selected';
                                        } ?>>MENUNGGU</option>
                                        <option value="1"<?php if ($dt->status_pesanan == 1) {
                                            echo ' selected';
                                        } ?>>MENUNGGU KURIR</option>
                                        <option value="2"<?php if ($dt->status_pesanan == 2) {
                                            echo ' selected';
                                        } ?>>SEDANG DIANTAR KURIR</option>
                                        <option value="3"<?php if ($dt->status_pesanan == 3) {
                                            echo ' selected';
                                        } ?>>SELESAI</option>
                                    </select>
                                </div>
                            @elseif (Auth::user()->role == 3)
                                <div class="col-md-9 col-sm-9">
                                    @php
                                        if ($dt->status_pesanan == 0) {
                                            $sts_pesanan = 'MENUNGGU ';
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
                            @endif
                        </div>
                    @endif
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Produk</label>
                        <div class="col-md-9 col-sm-9">
                            <input class="form-control" type="text" disabled value="{{ $produk->nama_produk }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Harga</label>
                        <div class="col-md-9 col-sm-9">
                            <input class="form-control" type="text" disabled
                                value="Rp{{ number_format($produk->harga) }}/ekor">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Berapa Ekor</label>
                        <div class="col-md-9 col-sm-9">
                            <input disabled class="form-control" type="number" value="{{ $dt->jumlah }}"
                                name="jumlah" id="jumlah">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Ongkir</label>
                        <div class="col-md-9 col-sm-9">
                            <input disabled class="form-control" type="text"
                                value="Rp{{ number_format($dt->ongkir) }}" name="jumlah" id="jumlah">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Harga Total</label>
                        <div class="col-md-9 col-sm-9">
                            <input class="form-control" type="text" id="total" readonly
                                value="Rp{{ number_format($dt->harga_total) }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Status Pembayaran</label>
                        @if (Auth::user()->role == 1)
                            <div class="col-md-9 col-sm-9  text-left">
                                <select style="width: 100%;" class="form-control" name="status_bayar" id="status"
                                    required">
                                    <option value="">-- Pilih Status Pembayaran --</option>
                                    <option value="0"<?php if ($dt->status_bayar == 0) {
                                        echo ' selected';
                                    } ?>>BELUM LUNAS</option>
                                    <option value="1"<?php if ($dt->status_bayar == 1) {
                                        echo ' selected';
                                    } ?>>MENUNGGU KONFIRMASI</option>
                                    <option value="2"<?php if ($dt->status_bayar == 2) {
                                        echo ' selected';
                                    } ?>>LUNAS</option>
                                </select>
                            </div>
                        @elseif (Auth::user()->role == 3 || Auth::user()->role == 2)
                            <div class="col-md-9 col-sm-9">
                                <input class="form-control" type="text" id="total" readonly
                                    value="{{ $bayar2 }} | {{ $sts_bayar }}">
                            </div>
                        @endif
                    </div>
                    @if (Auth::user()->role == 1 || Auth::user()->role == 3 || (Auth::user()->role == 2 && $dt->pembayaran == 'cod'))
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 text-left">Bukti Pembayaran</label>

                            <div class="col-md-9 col-sm-9 text-left">
                                @if ($dt->bukti)
                                    <img style="width: 50%; height:auto;" src="{{ $dt->bukti }}" alt="Paid"
                                        class="img-fluid">
                                @else
                                    <img style="width: 50%; height:auto;"
                                        src="{{ asset('gentella/production/images/unpaid.png') }}" alt="Unpaid"
                                        class="img-fluid">
                                @endif
                            </div>
                        </div>

                    @endif
                    @if (empty($dt->bukti))
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 text-left">Bukti Pembayaran</label>
                                <div class="col-md-9 col-sm-9 text-left">
                                    <a class="form-control" href="#" data-toggle="modal"
                                        data-target="#uploadbayar{{ $dt->id }}">UPLOAD BUKTI</a>
                                    @include('layouts.modal.upload-bayar-cod')
                                </div>
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    @if (Auth::user()->role == 1)
                        <button type="submit" class="btn btn-info">Update</button>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>

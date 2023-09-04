<div class="modal fade" id="beli{{$produk->id}}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Masukkan Rincian Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <form action="{{route('m.pesanan.simpan')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Harga</label>
                        <div class="col-md-9 col-sm-9">
                            <input type="hidden" name="produk_id" value="{{$produk->id}}">
                            <input class="form-control" type="text" disabled value="Rp{{ number_format($produk->harga) }}/ekor">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Berapa Ekor</label>
                        <div class="col-md-9 col-sm-9">
                            <input required class="form-control" type="number" name="jumlah" id="jumlah" oninput="calculateTotal()">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Harga Total</label>
                        <div class="col-md-9 col-sm-9">
                            <input class="form-control" type="hidden" name="total" id="total2" readonly>
                            <input class="form-control" type="text" id="total" readonly>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Kota Tujuan</label>
                        <div class="col-md-9 col-sm-9">
                            <select style="width: 100%;" class="form-control" name="kota" id="kota" required onchange="calculateTotal()">
                                <option value="">-- Pilih Kota --</option>
                                <option value="300000">Makassar</option>
                                <option value="200000">Maros</option>
                                <option value="100000">Pangkep</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Alamat Lengkap</label>
                        <div class="col-md-9 col-sm-9">
                            <textarea class="form-control" required rows="3" name="alamat"></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Metode Pembayaran</label>
                        <div class="col-md-9 col-sm-9">
                            <select class="form-control" name="bayar" required>
                                <option value="">-- Pilih Metode --</option>
                                <option value="cod">COD</option>
                                <option value="tf">Transfer</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-info">Checkout</button>
                </div>
            </form>
        </div>
    </div>
</div>

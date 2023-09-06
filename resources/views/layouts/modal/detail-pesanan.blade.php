<div class="modal fade" id="pesananku{{$dt->id}}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Rincian Pembelian</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Kode Pesanan</label>
                        <div class="col-md-9 col-sm-9">
                            <input class="form-control" type="text" disabled value="#{{ $dt->kode }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Produk</label>
                        <div class="col-md-9 col-sm-9">
                            <input class="form-control" type="text" disabled value="{{ $produk->nama_produk }}">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Harga</label>
                        <div class="col-md-9 col-sm-9">
                            <input class="form-control" type="text" disabled value="Rp{{ number_format($produk->harga) }}/ekor">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Berapa Ekor</label>
                        <div class="col-md-9 col-sm-9">
                            <input disabled class="form-control" type="number" value="{{ $dt->jumlah }}" name="jumlah" id="jumlah">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Ongkir</label>
                        <div class="col-md-9 col-sm-9">
                            <input disabled class="form-control" type="text" value="Rp{{ number_format($dt->ongkir) }}" name="jumlah" id="jumlah">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-form-label col-md-3 col-sm-3 text-left">Harga Total</label>
                        <div class="col-md-9 col-sm-9">
                            <input class="form-control" type="text" id="total" readonly value="Rp{{ number_format($dt->harga_total) }}">
                        </div>
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
                    {{-- <button type="submit" class="btn btn-info">Checkout</button> --}}
                </div>
            </form>
        </div>
    </div>
</div>

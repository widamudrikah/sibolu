<div class="modal fade" id="beli{{$produk->id}}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Stok Habis</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body text-center">
                <img style="width: 50%; height:auto;" src="https://cdn-icons-png.flaticon.com/512/6598/6598519.png" class="img-fluid" alt="Empty Stock">
                {{-- <h3>Kosong</h3> --}}
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>

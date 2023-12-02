<div class="modal fade" id="uploadbayar{{ $dt->id }}" style="display: none;" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Upload</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <form action="{{route('p.bukti.simpan')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body"> 
                    <p>Silakan unggah bukti transfer ke rekening berikut:</p>
                    <p>Nomor Rekening: <strong>847328658</strong></p>
                    <img style="width: 30%; height:auto;" src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a0/Bank_Syariah_Indonesia.svg/2560px-Bank_Syariah_Indonesia.svg.png" alt="Logo Bank">
                    <br>
                    <br>
                    <div class="text-left mt-3">
                        <label for="bukti_transfer">Upload Bukti Transfer * :</label>
                        <input type="hidden" name="id_pesanan" value="{{$dt->id}}">
                        <input required type="file" id="bukti_transfer" class="form-control" name="bukti" required accept="image/jpeg, image/png">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                    <button type="submit" class="btn btn-info">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>


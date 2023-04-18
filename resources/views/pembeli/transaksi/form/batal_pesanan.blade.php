<form action="{{ route('pesanan.update', $id) }}" method="post">
    @csrf
    @method('put')
    <div class="col-md-12">
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control text-hitam " id="keterangan" cols="30" rows="10"
                placeholder="Masukkan Keterangan Pembatalan" style="height: 150px !important;"
                onkeyup="this.value = this.value.capitalize()" required></textarea>
        </div>
    </div>
    <input type="hidden" name="status" value="batal_pesanan">
    <button type="button" class="btn btn-danger btn_close" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

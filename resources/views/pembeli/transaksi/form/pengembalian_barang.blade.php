<form action="{{ route('pesanan.update', $id) }}" method="post" enctype="multipart/form-data">
    @csrf
    @method('put')
    <div class="col-12 mt-4" style="text-align: center;">
        <div class="form-group">
            <img src="{{ asset('/image/default.png') }}" alt="" height="10%" width="30%" class="img-preview"
                style="border-radius: 8px;">
        </div>
    </div>
    <div class="form-group col-md-12 mb-4">
        <label for="gambar">Upload Foto</label>
        <input type="file" name="gambar" id="formFile" onchange="previewImage()"
            accept="image/png, image/jpeg, image/jpg" required hidden />

        <div class="form-control alert-gambar" style="height: 40px !important;">
            <!-- our custom upload button -->
            <label class="label-file" onclick="file_form()">Pilih File</label>

            <!-- name of file chosen -->
            <span id="file-chosen" onclick="file_form()">Tidak ada file yang dipilih</span>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-group">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control text-hitam " id="keterangan" cols="30" rows="10"
                placeholder="Masukkan Keterangan Pengembalian" style="height: 150px !important;"
                onkeyup="this.value = this.value.capitalize()" required></textarea>
        </div>
    </div>
    <input type="hidden" name="status" value="pengembalian_barang">
    <button type="button" class="btn btn-danger btn_close" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary">Simpan</button>
</form>

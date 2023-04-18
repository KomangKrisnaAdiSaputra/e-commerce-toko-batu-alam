<form method="post" action="{{ route('barang.update', $id) }}" enctype="multipart/form-data">
    @method('put')
    @csrf
    <div class="row">
        <div class="form-group col-md-6" style="padding-right: 0 !important;">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                onkeyup="ucword('nama_barang', this.value)" value="{{ $data['barang']->nama_barang }}"
                placeholder="Masukkan Nama Barang" autocomplete='off'>
        </div>
        <div class="form-group col-md-6">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control" cols="30" rows="10" placeholder="Masukkan Keterangan Barang"
                style="height: 40px !important;" onkeyup="this.value = this.value.capitalize()" required>{{ $data['barang']->keterangan }}</textarea>
        </div>
    </div>
    <div class="col-12 mt-4" style="text-align: center;">
        <div class="form-group">
            @if (
                $data['barang']->gambar == '' ||
                    $data['barang']->gambar == null ||
                    file_exists(public_path('/image/barang/' . $data['barang']->gambar)) == false)
                <img src="{{ asset('/image/default.png') }}" alt="" height="10%" width="40%"
                    class="img-preview" style="border-radius: 8px;">
            @else
                <img src="{{ asset('/image/barang/' . $data['barang']->gambar) }}" alt="" height="10%"
                    width="40%" class="img-preview" style="border-radius: 8px;">
            @endif
        </div>
    </div>
    <div class="form-group col-md-12">
        <label for="gambar">Gambar</label>
        <input type="file" name="gambar" id="formFile" onchange="previewImage()"
            accept="image/png, image/jpeg, image/jpg" hidden />

        <div class="form-control alert-gambar" style="height: 40px !important;">
            <!-- our custom upload button -->
            <label class="label-file" onclick="file_form()">Pilih File</label>

            <!-- name of file chosen -->
            <span id="file-chosen" onclick="file_form()">Tidak ada file yang dipilih</span>
        </div>
    </div>
    <div id="form_ukuran">

    </div>
    <div class="form-group col-md-12">
        <a class="btn bg-gradient-success  btn-tambah" href="javascript:;">
            <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Ukuran</a>
    </div>
    <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
    <button type="button" class="btn btn-danger btn-close-modal" data-bs-dismiss="modal"
        aria-label="Close">Close</button>
    <button type="submit" class="btn btn-info">Simpan</button>
</form>
<script>
    $(document).ready(function() {

        form_ukuran();

    });

    function form_ukuran() {
        $.get("{{ route('ukuran-barang', $id) }}", {}, function(data, status) {
            $("#form_ukuran").html(data);
        });
    };

    function data_ukuran(status, id, value, id_harga) {
        var data_value = value;
        if (status == 'harga') {
            $('#' + id_harga).val(FormatRupiah(value));
            data_value = value.replaceAll(".", "");
        }
        console.log(status);
        $.get("{{ url('barang/kelola-ukuran') }}/" + status + "/" + id + "/" + data_value, {}, function(data,
            status) {});
    };

    function hapus_ukuran(link) {
        $.get(link, {}, function(data, status) {
            form_ukuran();
        });
    }

    $(".btn-tambah").on("click", function() {
        $.get("{{ route('kelola-ukuran', ['status' => 'tambah', 'id' => $id, 'value' => '0']) }}", {}, function(
            data, status) {
            form_ukuran();
        });
    })

    $(".btn-close-modal").on("click", function() {
        $.get("{{ route('kelola-ukuran', ['status' => 'close', 'id' => $id, 'value' => '0']) }}", {}, function(
            data, status) {});
    })
</script>

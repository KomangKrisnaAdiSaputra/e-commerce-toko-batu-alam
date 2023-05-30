<form method="post" action="{{ route('barang.store') }}" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="form-group col-md-6" style="padding-right: 0 !important;">
            <label for="nama_barang">Nama Barang</label>
            <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                onkeyup="ucword('nama_barang', this.value)" placeholder="Masukkan Nama Barang" autocomplete='off'
                required>
        </div>

        <div class="form-group col-md-6">
            <label for="keterangan">Keterangan</label>
            <textarea name="keterangan" class="form-control" cols="30" rows="10" placeholder="Masukkan Keterangan Barang"
                style="height: 40px !important;" onkeyup="this.value = this.value.capitalize()" required></textarea>
        </div>
    </div>

    <div class="col-12 mt-4" style="text-align: center;">
        <div class="form-group">
            <img src="{{ asset('/image/default.png') }}" alt="" height="10%" width="30%"
                class="img-preview" style="border-radius: 8px;">
        </div>
    </div>
    <div class="form-group col-md-12">
        <label for="gambar">Gambar</label>
        <input type="file" name="gambar" id="formFile" onchange="previewImage()"
            accept="image/png, image/jpeg, image/jpg" required hidden />

        <div class="form-control alert-gambar" style="height: 40px !important;">
            <!-- our custom upload button -->
            <label class="label-file" onclick="file_form()">Pilih File</label>

            <!-- name of file chosen -->
            <span id="file-chosen" onclick="file_form()">Tidak ada file yang dipilih</span>
        </div>
    </div>

    <div id="dynamic_form">
        <div class="row baru-data">
            <div class="form-group col-md-4 div-custom">
                <label for="ukuran">Ukuran</label>
                <input type="text" class="form-control" id="ukuran" name="ukuran[]" placeholder="Masukkan Ukuran"
                    required>
            </div>
            <div class="form-group col-md-4 div-custom2">
                <label for="harga">Harga</label>
                <input type="text" class="form-control" id="harga" name="harga[]" placeholder="0"
                    onkeyup="this.value = FormatRupiah(this.value)" style="text-align: right;" required>
            </div>
            <div class="form-group col-md-4 div-custom3">
                <label for="stok">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok[]" placeholder="0" min="1"
                    autocomplete='off' style="text-align: right;" required>
            </div>
            <div class="button-group col-md-2 div-btn-hapus" style="margin-top: 30px;" hidden>
                <button type="button" class="btn btn-danger btn-hapus">
                    <i class="fa fa-times"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="form-group col-md-12">
        <a class="btn bg-gradient-success  btn-tambah" href="javascript:;">
            <i class="fas fa-plus"></i>&nbsp;&nbsp;Tambah Ukuran</a>
    </div>
    <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
    <button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>
    <button type="submit" class="btn btn-info">Simpan</button>
</form>
<script>
    function addForm() {
        var addrow = '<div class="row baru-data">\
            <div class="form-group div-custom col-md-5">\
                <label for="ukuran">Ukuran</label>\
                <input type="text" class="form-control" id="ukuran" name="ukuran[]" placeholder="Masukkan Ukuran" required>\
            </div>\
            <div class="form-group div-custom2 col-md-3">\
                <label for="harga">Harga</label>\
                <input type="text" class="form-control" id="harga" name="harga[]" placeholder="0" onkeyup="this.value = FormatRupiah(this.value)" style="text-align: right;" required>\
            </div>\
            <div class="form-group div-custom3 col-md-2">\
                <label for="stok">Stok</label>\
                <input type="number" class="form-control" id="stok" name="stok[]" placeholder="0" min="1" autocomplete="off" style="text-align: right;" required>\
            </div>\
            <div class="button-group col-md-2 div-btn-hapus"  style="margin-top: 30px;">\
                <button type="button" class="btn btn-danger btn-hapus"> <i class="fa fa-times"></i>\
                </button>\
            </div>\
        </div>';
        $("#dynamic_form").append(addrow);
    }

    $(".btn-tambah").on("click", function() {
        addForm();
        if ($('.div-custom').hasClass("col-md-4")) {
            $('.div-custom').removeClass("col-md-4");
            $('.div-custom').addClass("col-md-5");
        }

        if ($('.div-custom2').hasClass("col-md-4")) {
            $('.div-custom2').removeClass("col-md-4");
            $('.div-custom2').addClass("col-md-3");
        }

        if ($('.div-custom3').hasClass("col-md-4")) {
            $('.div-custom3').removeClass("col-md-4");
            $('.div-custom3').addClass("col-md-2");
        }
        $('.div-btn-hapus').attr("hidden", false);

    })

    $("#dynamic_form").on("click", ".btn-hapus", function() {
        $(this).parent().parent('.baru-data').remove();

        var bykrow = $(".baru-data").length;
        if (bykrow == 1) {

            if ($('.div-custom').hasClass("col-md-5")) {
                $('.div-custom').removeClass("col-md-5");
                $('.div-custom').addClass("col-md-4");
            }

            if ($('.div-custom2').hasClass("col-md-3")) {
                $('.div-custom2').removeClass("col-md-3");
                $('.div-custom2').addClass("col-md-4");
            }

            if ($('.div-custom3').hasClass("col-md-2")) {
                $('.div-custom3').removeClass("col-md-2");
                $('.div-custom3').addClass("col-md-4");
            }
            $('.div-btn-hapus').attr("hidden", true);

        }
    });

    $(":submit").on("click", function() {

        if ($('#formFile').val() == "") {
            $('.alert-gambar').css('border-color', 'red');
        }
    })
</script>

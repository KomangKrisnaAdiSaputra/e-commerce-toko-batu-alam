<div class="row">
    <div class="col-lg-6 mb-5 ">
        <a href="images/menu-2.jpg" class="image-popup"><img src="{{ asset('image/barang/' . $data['barang']->gambar) }}"
                class="img-fluid" alt="Colorlib Template"></a>
    </div>
    <div class="col-lg-6 product-details pl-md-5 ">
        <h3>{{ $data['barang']->nama_barang }}</h3>
        <p class="price">
            <span id="harga_barang">
                @if ($data['ukuran']->count() == 1)
                    @currency($data['ukuran'][0]->harga)
                @else
                    @currency($data['ukuran'][0]->harga) - @currency($data['ukuran'][$data['ukuran']->count() - 1]->harga)
                @endif
            </span>
        </p>
        <p>{{ $data['barang']->keterangan }}</p>
        <div class="row mt-4">
            <div class="col-md-6">
                <div class="form-group">
                    <select name="ukuran" id="ukuran" class="form-control" style="width: 150px; cursor: pointer; "
                        onchange="ukuran(this.value)" required>
                        @if ($data['ukuran']->count() == 1)
                            <option value="{{ $data['ukuran'][0]->id }}" selected>
                                {{ $data['ukuran'][0]->ukuran }}
                            </option>
                        @else
                            <option value="" selected disabled>Ukuran</option>
                            @foreach ($data['ukuran'] as $key => $value)
                                <option value="{{ $value->id }}">{{ $value->ukuran }}</option>
                            @endforeach
                        @endif

                    </select>
                </div>
            </div>
            <div class="w-100"></div>
            <div class="input-group col-md-8 d-flex mb-3">
                <span class="input-group-btn mr-2">
                    <button type="button" class="quantity-left-minus btn" data-type="minus" data-field=""
                        onclick="jumlah('kurang')">
                        <i class="ion-ios-remove"></i>
                    </button>
                </span>
                <input type="number" id="jumlah" name="jumlah" class="form-control input-number" value="1"
                    min="1" max="{{ $data['ukuran'][0]->stok }}" onchange="jumlah_ketik()">
                <span class="input-group-btn ml-2">
                    <button type="button" class="quantity-right-plus btn" data-type="plus" data-field=""
                        onclick="jumlah('tambah')">
                        <i class="ion-ios-add"></i>
                    </button>
                </span>
            </div>
            <div class="w-100"></div>
            <div class="col-md-12 d-flex">
                <p style="color: #000;" class="mr-2">Tersisa</p>
                <p style="color: #000;" class="mr-2" id="data_stok">
                    {{ $data['ukuran']->count() > 1 ? '....' : $data['ukuran'][0]->stok }}</p>
                <p style="color: #000;">Barang</p>
            </div>
        </div>
        @if ($data['status'] == 'tambah keranjang')
            <p style="text-align: center;" class="button_simpan" {{ $data['ukuran']->sum('stok') > 0 ? '' : 'hidden' }}>
                <a href="javascript:;" class="btn btn-black py-3 px-5"
                    onclick="simpan_keranjang('keranjang')">Keranjang</a>
            </p>
        @endif

        <p style="text-align: center;" class="button_simpan" {{ $data['ukuran']->sum('stok') > 0 ? '' : 'hidden' }}>
            <a href="javascript:;" class="btn btn-white py-3 px-5" onclick="simpan_keranjang('beli sekarang')">Beli
                Sekarang</a>
        </p>

        <p style="text-align: center; color: red;" id="barang_kosong"
            {{ $data['ukuran']->sum('stok') > 0 ? 'hidden' : '' }}>
            Barang Kosong!
        </p>

    </div>
</div>
<script>
    function jumlah(status) {
        var jumlah = $('#jumlah');
        var angka = "";

        if (status == "tambah") {
            angka = parseInt(jumlah.val()) + parseInt(1);
        } else if (status == "kurang") {
            angka = parseInt(jumlah.val()) - parseInt(1);
        }

        var stok = ($('#data_stok').text() == 0) ? 1 : parseInt($('#data_stok').text());

        if (angka < 1) {
            angka = 1;
        } else if (angka > stok) {
            angka = stok;
        }

        jumlah.val(angka);
    }

    function jumlah_ketik() {
        var jumlah = $('#jumlah');

        if (jumlah.val() > parseInt("{{ $data['ukuran'][0]->stok }}")) {
            jumlah.val("{{ $data['ukuran'][0]->stok }}");
        }
    }

    function ukuran(data_ukuran) {
        $('#ukuran').css("cssText", "border-color:  !important");

        $.get("{{ url('keranjang/data-ukuran') }}/" + data_ukuran, {}, function(data, status) {
            $("#harga_barang").html(FormatRupiah(data.harga));
            $("#data_stok").html(data.stok);

            if (data.stok > 0) {
                $('.button_simpan').prop("hidden", false);
                $('#barang_kosong').prop("hidden", true);
            } else {
                $('.button_simpan').prop("hidden", true);
                $('#barang_kosong').prop("hidden", false);
            }
        });
    }

    function simpan_keranjang(status) {
        let ukuran = $('#ukuran').val();
        let jumlah = $('#jumlah').val();
        console.log(jumlah);
        if (ukuran == null) {
            $('#ukuran').css("cssText", "border-color: red !important");

        } else {
            if (status == 'keranjang') {

                $.get(
                    "{{ url('keranjang/simpan-keranjang') }}/" + "{{ $id }}/" + ukuran + "/" + jumlah +
                    "/" +
                    status, {},
                    function(data, status) {
                        $("#Modal").modal('hide');


                        if (data == 0) {
                            sweet_alert_notifikasi('Peringatan!', 'Produk Habis!', 'warning');
                        } else {
                            $("#total_keranjang").html('[' + FormatRupiah(data) + ']');
                        }
                    });
            } else if (status == "beli sekarang") {
                $.get(
                    "{{ url('keranjang/simpan-keranjang') }}/" + "{{ $id }}/" + ukuran + "/" + jumlah +
                    "/" +
                    status, {},
                    function(data, status) {
                        if (data == 0) {
                            $("#Modal").modal('hide');
                            sweet_alert_notifikasi('Peringatan!', 'Produk Habis!', 'warning');
                        } else {
                            location.href = data;
                        }
                    });
            }

        }
    }
</script>

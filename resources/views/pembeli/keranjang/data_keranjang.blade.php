<table class="table ">
    <thead class="thead-primary">
        <tr class="text-center">
            <th>
                <input type="checkbox" id="centang_semua" onclick="centang_semua()"
                    style="width: 25px; height: 25px; cursor: pointer;" {{ $data->count() === 0 ? 'disabled' : '' }}>
            </th>
            <th>&nbsp;</th>
            <th>&nbsp;</th>
            <th>Produk</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        <form id="form_keranjang" method="POST">
            @csrf
            <input type="hidden" value="huhu" name="haha">
            @foreach ($data as $key => $value)
                <tr class="text-center">
                    <td class="product-remove">
                        <input type="checkbox" value="{{ $value->id }}"
                            style="width: 25px; height: 25px; cursor: pointer;"
                            id="centang_keranjang{{ $value->id }}" name="id_keranjang[]"
                            onclick="centang_keranjang('#centang_keranjang{{ $value->id }}')"
                            {{ $value->status == 1 ? 'checked' : '' }}
                            {{ $value->tb_ukuran->stok == 0 ? 'disabled' : '' }}>
                    </td>
                    <td class="product-remove">
                        <a href="javascript:;"
                            onclick="konfirmasi('{{ route('hapus-keranjang', $value->id) }}', 'Hapus Keranjang!?', 'keranjang')">
                            <span class="ion-ios-close"></span>
                        </a>
                    </td>

                    <td class="image-prod">
                        <div class="img"
                            style="background-image:url({{ asset('image/barang/' . $value->tb_barang->gambar) }});">
                        </div>
                    </td>

                    <td class="product-name">
                        <h3>{{ $value->tb_barang->nama_barang }}</h3>
                        <p>Ukuran : {{ $value->tb_ukuran->ukuran }}</p>
                        @if ($value->tb_ukuran->stok == 0)
                            <p style="color: red;">Barang Habis!</p>
                        @endif
                    </td>

                    <td class="price">Rp @currency($value->tb_ukuran->harga)</td>

                    <td>
                        <div class=" d-flex justify-content-center mb-3">
                            <span class="input-group-btn mr-2">
                                <button type="button" class="quantity-left-minus btn btn-jumlah" data-type="minus"
                                    data-field=""
                                    onclick="jumlah('kurang', '{{ $value->tb_ukuran->stok }}', 'jumlah{{ $key }}', '{{ $value->id }}')"
                                    {{ $value->tb_ukuran->stok == 0 ? 'disabled' : '' }}>
                                    <i class="ion-ios-remove icon-jumlah"></i>
                                </button>
                            </span>
                            <input type="number" id="jumlah{{ $key }}" name="jumlah"
                                class="form-control input-number" value="{{ $value->jumlah }}" min="1">
                            <span class="input-group-btn ml-2">
                                <button type="button" class="quantity-right-plus btn btn-jumlah " data-type="plus"
                                    data-field=""
                                    onclick="jumlah('tambah', '{{ $value->tb_ukuran->stok }}', 'jumlah{{ $key }}', '{{ $value->id }}')"
                                    {{ $value->tb_ukuran->stok == 0 ? 'disabled' : '' }}>
                                    <i class="ion-ios-add icon-jumlah"></i>
                                </button>
                            </span>
                        </div>
                    </td>

                    <td class="total">Rp @currency($value->tb_ukuran->harga * $value->jumlah)</td>
                </tr><!-- END TR-->
            @endforeach
        </form>
    </tbody>
</table>

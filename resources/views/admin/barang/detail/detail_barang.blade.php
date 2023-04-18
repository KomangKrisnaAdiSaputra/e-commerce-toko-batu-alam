<div class="row">
    <div class="col-12 ">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-column" style="text-align: center;">
                    <div class="p-2">
                        @if (
                            $data['barang']->gambar == '' ||
                                $data['barang']->gambar == null ||
                                file_exists(public_path('/image/barang/' . $data['barang']->gambar)) == false)
                            <img src="{{ asset('/image/default.png') }}" alt="" height="20%" width="40%"
                                class="img-preview" style="border-radius: 20px;">
                        @else
                            <img src="{{ asset('/image/barang/' . $data['barang']->gambar) }}" alt=""
                                height="20%" width="40%" class="img-preview"
                                style="border-radius: 20px; object-fit: cover !important;">
                        @endif
                    </div>
                    <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
                    <label for="" style="text-align: left; font-weight: bold;">Nama Barang :</label>
                    <div class="p-2">{{ $data['barang']->nama_barang }}
                    </div>
                    <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
                    <label for="" style="text-align: left; font-weight: bold;">Keterangan :</label>
                    <div class="p-2">{{ $data['barang']->keterangan }}</div>
                    <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
                    <label for="" style="text-align: left; font-weight: bold;">Total Terjual :</label>
                    <div class="p-2">{{ $data['barang']->total_terjual }}</div>
                    <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
                    <table class="table-bordered">
                        <tr>
                            <td style="text-align: center; color: black; font-weight: bold;">Ukuran</td>
                            <td style="text-align: center; color: black; font-weight: bold;">Harga</td>
                            <td style="text-align: center; color: black; font-weight: bold;">Stok</td>
                        </tr>
                        @foreach ($data['ukuran'] as $key => $value)
                            <tr>
                                <td style="text-align: center;">{{ $value->ukuran }}</td>
                                <td style="text-align: right;">@currency($value->harga)</td>
                                <td style="text-align: right;">{{ $value->stok }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

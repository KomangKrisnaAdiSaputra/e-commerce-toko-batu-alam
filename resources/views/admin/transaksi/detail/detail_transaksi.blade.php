<style>
    .transaction-details {
        max-width: 800px;
        margin: 0 auto;
        padding: 20px;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .transaction-details h2 {
        font-size: 28px;
        margin-bottom: 20px;
    }

    .transaction-details p {
        font-size: 18px;
        margin-bottom: 10px;
    }

    .payment-proof {
        margin-top: 20px;
        text-align: center;

    }

    .payment-proof h3 {
        font-size: 24px;
        margin-bottom: 10px;
        text-align: left;

    }

    .payment-proof img {
        max-width: 100%;
    }

    .tabel-detail-barang {
        border-collapse: collapse;
        width: 100%;
    }

    .tabel-detail-barang th td {
        text-align: left !important;
        padding: 8px;
    }

    .tabel-detail-barang th {
        background-color: #ddd;
        font-weight: bold;
        text-align: center !important;
    }

    .tabel-detail-barang tbody tr:nth-child(even) {
        background-color: #f2f2f2;
    }
</style>
<div class="transaction-details">
    <h2>Data Transaksi</h2>
    <p>
        <b>Tanggal: </b>
        {{ Carbon\Carbon::parse($data[0]->tb_transaksi->tanggal_transaksi)->translatedFormat('d/m/Y H:i') }}
    </p>
    <p><b>Kode Transaksi: </b> {{ $data[0]->tb_transaksi->kode_transaksi }}</p>
    <p>
        <b>Nama & No WhatsApp: </b>
        {{ $data[0]->tb_transaksi->nama_pembeli . ' & ' . $data[0]->tb_transaksi->no_wa_pembeli }}
    </p>
    <p><b>Alamat: </b> {{ $data[0]->tb_transaksi->alamat_pembeli }}</p>
    <p><b>Tipe Pembayaran: </b> {{ ucwords($data[0]->tb_transaksi->tipe_pembayaran) }}</p>
    <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
    <h3>Data Barang</h3>
    <div class="table-responsive">
        <table class="tabel-detail-barang table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Barang</th>
                    <th>Ukuran</th>
                    <th>Harga</th>
                    <th>Jumlah</th>
                    <th>Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $key => $value)
                    <tr>
                        <td style="text-align: center;">{{ $key + 1 }}</td>
                        <td>{{ $value->nama_barang }}</td>
                        <td style="text-align: center;">{{ $value->ukuran }}</td>
                        <td style="text-align: right;">Rp @currency($value->harga_barang)</td>
                        <td style="text-align: right;">{{ $value->jumlah }}</td>
                        <td style="text-align: right;">Rp @currency($value->total)</td>
                    </tr>
                @endforeach
                <tr>
                    <td colspan="4" style="text-align: right;">SubTotal</td>
                    <td style="text-align: right;">{{ $data[0]->tb_transaksi->total_pembelian }}</td>
                    <td style="text-align: right;">Rp @currency($data[0]->tb_transaksi->total_harga)</td>
                </tr>
            </tbody>
        </table>
    </div>

    @if ($data[0]->tb_transaksi->tipe_pembayaran == 'transfer' && $data[0]->tb_transaksi->bukti_pembayaran != null)
        <div class="payment-proof">
            <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
            <h3>Bukti Pembayaran</h3>
            <img id="zoom_01" class="zoom_foto"
                src="{{ asset('/image/pembayaran-transaksi/' . $data[0]->tb_transaksi->bukti_pembayaran) }}"
                data-zoom-image="{{ asset('/image/pembayaran-transaksi/' . $data[0]->tb_transaksi->bukti_pembayaran) }}"
                height="20%" width="40%" style="border-radius: 20px;  object-fit: cover !important;"
                alt="" />
            @if ($data[0]->tb_transaksi->status == 2 && $data[0]->tb_transaksi->bukti_pembayaran != null)
                <p style="margin-top: 20px;"><a href="javascript:;" class="huhu"
                        onclick="$('#Modal').modal('hide'); $('#verifikasi_tr'+'{{ $data[0]->id_transaksi }}').click();">Verifikasi</a>
                </p>
            @endif
        </div>
    @endif

    @if ($data[0]->tb_transaksi->bukti_penerima != null)
        <div class="payment-proof">
            <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
            <h3>Bukti Penerima</h3>
            <img id="zoom_01" class="zoom_foto"
                src="{{ asset('/image/bukti-penerima/' . $data[0]->tb_transaksi->bukti_penerima) }}"
                data-zoom-image="{{ asset('/image/bukti-penerima/' . $data[0]->tb_transaksi->bukti_penerima) }}"
                height="20%" width="40%" style="border-radius: 20px;  object-fit: cover !important;"
                alt="" />
        </div>
    @endif

    @if ($data[0]->tb_transaksi->status == 0)
        <div class="payment-proof">
            <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
            <h3>Keterangan Batal</h3>
            <p style="text-align: left !important;">{{ $data[0]->tb_transaksi->keterangan }}</p>
        </div>
    @endif

    @if ($data[0]->tb_transaksi->status == 5)
        <div class="payment-proof">
            <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 0;" class="pb-0">
            <h3>Keterangan Pengembalian</h3>
            <p style="text-align: left !important;">{{ $data[0]->tb_transaksi->keterangan }}</p>

            <img id="zoom_01" class="zoom_foto"
                src="{{ asset('/image/bukti-pengembalian/' . $data[0]->tb_transaksi->bukti_pengembalian) }}"
                data-zoom-image="{{ asset('/image/bukti-pengembalian/' . $data[0]->tb_transaksi->bukti_pengembalian) }}"
                height="20%" width="40%" style="border-radius: 20px;  object-fit: cover !important;"
                alt="" />
        </div>
    @endif
</div>
<hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; margin-top: 20px;" class="pb-0">

<button type="button" class="btn btn-danger" data-bs-dismiss="modal" aria-label="Close">Close</button>

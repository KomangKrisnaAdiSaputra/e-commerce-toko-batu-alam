<div style="max-width: 1200px; margin: 0 auto; padding: 20px;">
    <h6 class="text-dark font-weight-bold">Kode Transaksi: {{ $data[0]->tb_transaksi->kode_transaksi }}</h6>
    <div class="d-flex justify-content-between mt-4">
        <p class="text-dark">Total Pembayaran: <b>Rp @currency($data[0]->tb_transaksi->total_harga)</b></p>
        <p class="text-dark">Waktu Pembayaran:
            <b>{{ Carbon\Carbon::parse($data[0]->tb_transaksi->tanggal_transaksi)->translatedFormat('d/m/y') }}</b>
        </p>
    </div>
    @if ($data[0]->tb_transaksi->status == 0)
        <p class="text-dark"><b>Keterangan :</b> {{ $data[0]->tb_transaksi->keterangan }}</p>
    @endif
    <hr>
    <div class="d-flex justify-content-between mt-4">
        <div class="col-md-6">
            <p class="text-dark mb-2">Rincian Pengiriman</p>
            <p class="text-dark" style="margin-bottom: 0;">Nama: {{ $data[0]->tb_transaksi->nama_pembeli }}</p>
            <p class="text-dark" style="margin-bottom: 0;">WhatsApp: {{ $data[0]->tb_transaksi->no_wa_pembeli }}</p>
            <p class="text-dark">
                {{ $data[0]->tb_transaksi->alamat_pembeli }}
            </p>
        </div>
        <div class="col-md-6 text-center">
            <p class="text-dark mb-4">Metode Pembayaran</p>
            <p class="text-dark mb-4">{{ ucwords($data[0]->tb_transaksi->tipe_pembayaran) }}</p>
        </div>
    </div>
    <hr>
    <h6 class="text-dark font-weight-bold">Rincian Pesanan</h6>
    @foreach ($data as $key => $value)
        <div class="d-flex justify-content-between mt-4">
            <div class="col-md-6">
                <p class="text-dark mb-2">{{ $value->nama_barang }}</p>
                <p class="text-dark mb-2">Ukuran: {{ $value->ukuran }}</p>
            </div>
            <div class="col-md-6 text-right">
                <p class="text-dark " style="margin-bottom: 0;">x{{ $value->jumlah }}</p>
                <p class="text-dark ">Rp @currency($value->harga_barang)</p>
            </div>
        </div>
        <hr style="margin-top: 0;">
    @endforeach

    <div class="d-flex justify-content-between mt-4 font-weight-bold">
        <p class="text-dark">Subtotal</p>
        <p class="text-dark">Rp @currency($data[0]->tb_transaksi->total_harga)</p>
    </div>
    <div class="d-flex justify-content-between mt-2 font-weight-bold">
        <p class="text-dark">Total Pembayaran</p>
        <p class="text-dark">Rp @currency($data[0]->tb_transaksi->total_harga)</p>
    </div>
</div>

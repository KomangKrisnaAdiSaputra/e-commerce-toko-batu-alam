@extends('pembeli.layouts.main')
@section('css')
    <style>
        .order-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .order-heading {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 20px;
        }

        .order-list {
            display: flex;
            flex-wrap: wrap;
        }

        .order-item {
            width: 100%;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 20px;
        }

        .order-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 10px;
        }

        .order-number {
            font-size: 16px;
            font-weight: bold;
        }

        .order-date {
            font-size: 14px;
            color: #666;
            /* margin-top: 8px; */
        }

        .order-products {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }

        .product-image {
            width: 100px;
            height: 100px;
            margin-right: 20px;
            overflow: hidden;
            border-radius: 5px;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .product-info {
            flex: 1;
        }

        .product-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .product-price {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .product-quantity {
            font-size: 14px;
            color: #666;
            margin-bottom: 5px;
        }

        .order-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .order-status {
            font-size: 14px;
            color: #666;
        }

        .no-orders-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
        }

        .no-orders-container img {
            max-width: 100%;
            margin-bottom: 20px;
        }

        .no-orders-container h2 {
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .no-orders-container p {
            font-size: 16px;
            margin-bottom: 20px;
            text-align: center;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #ee4d2d;
            border-radius: 5px;
            transition: background-color 0.2s ease-in-out;
        }

        .btn:hover {
            background-color: #ff6633;
        }

        .gambar-tidak-ada-pesanan {
            height: 200px;
            width: 200px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: bold;
            text-align: center;
            text-decoration: none;
            color: #fff;
            background-color: #ee4d2d;
            border-radius: 5px;
            transition: background-color 0.2s ease-in-out;
        }

        .btn:hover {
            background-color: #ff6633;
        }

        .btn-cancel-order {
            background-color: #57ff98;
        }

        .btn-cancel-order:hover {
            background-color: #51ff48;
        }

        .hoverdropdown:hover {
            color: #ffa45c !important;
        }

        .btn-penerima {
            color: blue !important;
        }

        .btn-penerima:hover {
            text-decoration: underline;
            color: blue !important;

        }
    </style>
@endsection
@section('data')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('assets_pembeli/images/bg_6.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9  text-center">
                    <p class="breadcrumbs"><span class="mr-2">Halaman Pesanan</span></p>
                    <h1 class="mb-0 bread">Pesanan Saya</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section bg-light">
        <div class="container">
            <div class="col-12 col-sm-12 col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="semua-tab" data-toggle="tab" href="#semua" role="tab"
                                    aria-controls="semua" aria-selected="true">Semua</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="belum-bayar-tab" data-toggle="tab" href="#belum-bayar"
                                    role="tab" aria-controls="belum-bayar" aria-selected="false">Belum Bayar</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="sedang-dikemas-tab" data-toggle="tab" href="#sedang-dikemas"
                                    role="tab" aria-controls="sedang-dikemas" aria-selected="false">Sedang
                                    Dikemas</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="dikirim-tab" data-toggle="tab" href="#dikirim" role="tab"
                                    aria-controls="dikirim" aria-selected="false">Dikirim</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="selesai-tab" data-toggle="tab" href="#selesai" role="tab"
                                    aria-controls="selesai" aria-selected="false">Selesai</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="dibatalkan-tab" data-toggle="tab" href="#dibatalkan" role="tab"
                                    aria-controls="dibatalkan" aria-selected="false">Dibatalkan</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="pengembalian-tab" data-toggle="tab" href="#pengembalian"
                                    role="tab" aria-controls="pengembalian" aria-selected="false">Pengembalian</a>
                            </li>
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="tab-pane fade show active mt-4 table-responsive" id="semua" role="tabpanel"
                                aria-labelledby="semua-tab">
                                @if ($data['semua'] == '')
                                    <div class="no-orders-container">
                                        <img src="{{ asset('image/tidak-ada-pesanan.jpg') }}" alt="No orders"
                                            class="gambar-tidak-ada-pesanan">
                                        <h2>Tidak ada pesanan</h2>
                                        <p>Anda belum melakukan pemesanan apapun.</p>
                                        <a href="{{ route('data-produk') }}" class="btn btn-primary">Mulai Berbelanja</a>
                                    </div>
                                @else
                                    @foreach ($data['semua'] as $key => $value)
                                        <div class="order-list">
                                            <div class="order-item">
                                                <div class="order-header">
                                                    <div class="order-number">Kode Transaksi:
                                                        {{ $value['kode_transaksi'] }}
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="order-date mr-2">Tanggal Pemesanan:
                                                            {{ $value['tanggal_transaksi'] }}
                                                        </div>
                                                        <div class="dropdown">
                                                            <a href="#" id="dropdown04" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Detail Pesanan"><span class="icon-more"></span></a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                                                <a class="dropdown-item hoverdropdown" href="javascript:;"
                                                                    onclick="Modal('{{ route('pesanan.show', $value['id']) }}', 'modal-lg', 'Detail Pesanan')">
                                                                    Detail Pesanan

                                                                </a>
                                                                @if (preg_match('/\bBelum Bayar\b/', $value['status']) == true || $value['status'] == 'Sedang Dikemas')
                                                                    @if (preg_match('/\bjam\b/', $value['waktu']) == true ||
                                                                            preg_match('/\bmenit\b/', $value['waktu']) == true ||
                                                                            preg_match('/\bdetik\b/', $value['waktu']) == true)
                                                                        @if ($value['tipe_pembayaran'] == 'transfer')
                                                                            <a class="dropdown-item hoverdropdown"
                                                                                href="javascript:;"
                                                                                onclick="Modal('{{ route('index-bayar-pesanan', $value['id']) }}', 'modal-lg', 'Bayar Pesanan')">
                                                                                Bayar Pesanan
                                                                            </a>
                                                                        @endif

                                                                        <a class="dropdown-item hoverdropdown"
                                                                            href="javascript:;"
                                                                            onclick="batal_pesanan('{{ route('pesanan.edit', $value['id']) }}')">
                                                                            Batalkan Pesanan
                                                                        </a>
                                                                    @endif
                                                                @endif

                                                                @if ($value['status'] == 'Diterima' && $value['bukti_penerima'] != null && $value['tanggal_penerimaan'] == date('Y-m-d'))
                                                                    <a class="dropdown-item hoverdropdown"
                                                                        href="javascript:;"
                                                                        onclick="pengembalian_barang('{{ route('index-pengembalian-barang', $value['id']) }}')">
                                                                        Pengembalian Barang
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                @foreach ($value['data_barang'] as $key2 => $value2)
                                                    <div class="order-products">
                                                        <div class="product-image">
                                                            <img
                                                                src="{{ asset('image/transaksi/' . $value2->foto_barang) }}">
                                                        </div>
                                                        <div class="product-info">
                                                            <h3 class="product-name">{{ $value2->nama_barang }}</h3>
                                                            <div class="order-footer">
                                                                <div>
                                                                    <p class="product-price">Ukuran:
                                                                        {{ $value2->ukuran }}
                                                                    </p>
                                                                    <p class="product-quantity">
                                                                        x{{ $value2->jumlah }}
                                                                    </p>
                                                                    <p class="product-price">Harga:
                                                                        @currency($value2->harga_barang)
                                                                    </p>
                                                                </div>
                                                                <p class="product-quantity">@currency($value2->total)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                                <div class="order-footer">
                                                    <div class="order-status">Status: {{ $value['status'] }}
                                                        @if ($value['status'] == 'Diterima' || $value['status'] == 'Selesai')
                                                            || <a href="javascript:;"
                                                                onclick="bukti_penerima('{{ asset('image/bukti-penerima/' . $value['bukti_penerima']) }}')"
                                                                class="btn-penerima">Penerima</a>
                                                        @endif
                                                    </div>
                                                    <div class="order-status">Total: @currency($value['total'])</div>
                                                </div>
                                                @if ($value['status'] == 'Diterima')
                                                    <button class="btn btn-cancel-order"
                                                        onclick="terima_pesanan('{{ route('pesanan.update', $value['id']) }}')">Terima
                                                        Pesanan</button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="tab-pane fade mt-4" id="belum-bayar" role="tabpanel"
                                aria-labelledby="belum-bayar-tab">
                                @if ($data['belum_bayar'] == '')
                                    <div class="no-orders-container">
                                        <img src="{{ asset('image/tidak-ada-pesanan.jpg') }}" alt="No orders"
                                            class="gambar-tidak-ada-pesanan">
                                        <h2>Tidak ada pesanan</h2>
                                        <p>Anda belum melakukan pemesanan apapun.</p>
                                        <a href="{{ route('data-produk') }}" class="btn btn-primary">Mulai Berbelanja</a>
                                    </div>
                                @else
                                    @foreach ($data['belum_bayar'] as $key => $value)
                                        <div class="order-list">
                                            <div class="order-item">
                                                <div class="order-header">
                                                    <div class="order-number">Kode Transaksi:
                                                        {{ $value['kode_transaksi'] }}
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="order-date mr-2">Tanggal Pemesanan:
                                                            {{ $value['tanggal_transaksi'] }}
                                                        </div>
                                                        <div class="dropdown">
                                                            <a href="#" id="dropdown04" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Detail Pesanan"><span class="icon-more"></span></a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                                                <a class="dropdown-item hoverdropdown" href="javascript:;"
                                                                    onclick="Modal('{{ route('pesanan.show', $value['id']) }}', 'modal-lg', 'Detail Pesanan')">
                                                                    Detail Pesanan
                                                                </a>
                                                                @if (preg_match('/\bBelum Bayar\b/', $value['status']) == true || $value['status'] == 'Sedang Dikemas')
                                                                    @if (preg_match('/\bjam\b/', $value['waktu']) == true ||
                                                                            preg_match('/\bmenit\b/', $value['waktu']) == true ||
                                                                            preg_match('/\bdetik\b/', $value['waktu']) == true)
                                                                        @if ($value['tipe_pembayaran'] == 'transfer')
                                                                            <a class="dropdown-item hoverdropdown"
                                                                                href="javascript:;"
                                                                                onclick="Modal('{{ route('index-bayar-pesanan', $value['id']) }}', 'modal-lg', 'Bayar Pesanan')">
                                                                                Bayar Pesanan
                                                                            </a>
                                                                        @endif

                                                                        <a class="dropdown-item hoverdropdown"
                                                                            href="javascript:;"
                                                                            onclick="batal_pesanan('{{ route('pesanan.edit', $value['id']) }}')">
                                                                            Batalkan Pesanan
                                                                        </a>
                                                                    @endif
                                                                @endif

                                                                @if ($value['status'] == 'Diterima' && $value['bukti_penerima'] != null && $value['tanggal_penerimaan'] == date('Y-m-d'))
                                                                    <a class="dropdown-item hoverdropdown"
                                                                        href="javascript:;"
                                                                        onclick="pengembalian_barang('{{ route('index-pengembalian-barang', $value['id']) }}')">
                                                                        Pengembalian Barang
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                @foreach ($value['data_barang'] as $key2 => $value2)
                                                    <div class="order-products">
                                                        <div class="product-image">
                                                            <img
                                                                src="{{ asset('image/transaksi/' . $value2->foto_barang) }}">
                                                        </div>
                                                        <div class="product-info">
                                                            <h3 class="product-name">{{ $value2->nama_barang }}</h3>
                                                            <div class="order-footer">
                                                                <div>
                                                                    <p class="product-price">Ukuran:
                                                                        {{ $value2->ukuran }}
                                                                    </p>
                                                                    <p class="product-quantity">
                                                                        x{{ $value2->jumlah }}
                                                                    </p>
                                                                    <p class="product-price">Harga:
                                                                        @currency($value2->harga_barang)
                                                                    </p>
                                                                </div>
                                                                <p class="product-quantity">@currency($value2->total)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                                <div class="order-footer">
                                                    <div class="order-status">Status: {{ $value['status'] }}
                                                        @if ($value['status'] == 'Diterima' || $value['status'] == 'Selesai')
                                                            || <a href="javascript:;"
                                                                onclick="bukti_penerima('{{ asset('image/bukti-penerima/' . $value['bukti_penerima']) }}')"
                                                                class="btn-penerima">Penerima</a>
                                                        @endif
                                                    </div>
                                                    <div class="order-status">Total: @currency($value['total'])</div>
                                                </div>
                                                @if ($value['status'] == 'Diterima')
                                                    <button class="btn btn-cancel-order"
                                                        onclick="terima_pesanan('{{ route('pesanan.update', $value['id']) }}')">Terima
                                                        Pesanan</button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="tab-pane fade mt-4" id="sedang-dikemas" role="tabpanel"
                                aria-labelledby="sedang-dikemas-tab">
                                @if ($data['sedang_dikemas'] == '')
                                    <div class="no-orders-container">
                                        <img src="{{ asset('image/tidak-ada-pesanan.jpg') }}" alt="No orders"
                                            class="gambar-tidak-ada-pesanan">
                                        <h2>Tidak ada pesanan</h2>
                                        <p>Anda belum melakukan pemesanan apapun.</p>
                                        <a href="{{ route('data-produk') }}" class="btn btn-primary">Mulai Berbelanja</a>
                                    </div>
                                @else
                                    @foreach ($data['sedang_dikemas'] as $key => $value)
                                        <div class="order-list">
                                            <div class="order-item">
                                                <div class="order-header">
                                                    <div class="order-number">Kode Transaksi:
                                                        {{ $value['kode_transaksi'] }}
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="order-date mr-2">Tanggal Pemesanan:
                                                            {{ $value['tanggal_transaksi'] }}
                                                        </div>
                                                        <div class="dropdown">
                                                            <a href="#" id="dropdown04" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Detail Pesanan"><span class="icon-more"></span></a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                                                <a class="dropdown-item hoverdropdown" href="javascript:;"
                                                                    onclick="Modal('{{ route('pesanan.show', $value['id']) }}', 'modal-lg', 'Detail Pesanan')">
                                                                    Detail Pesanan
                                                                </a>
                                                                @if (preg_match('/\bBelum Bayar\b/', $value['status']) == true || $value['status'] == 'Sedang Dikemas')
                                                                    @if (preg_match('/\bjam\b/', $value['waktu']) == true ||
                                                                            preg_match('/\bmenit\b/', $value['waktu']) == true ||
                                                                            preg_match('/\bdetik\b/', $value['waktu']) == true)
                                                                        @if ($value['tipe_pembayaran'] == 'transfer')
                                                                            <a class="dropdown-item hoverdropdown"
                                                                                href="javascript:;"
                                                                                onclick="Modal('{{ route('index-bayar-pesanan', $value['id']) }}', 'modal-lg', 'Bayar Pesanan')">
                                                                                Bayar Pesanan
                                                                            </a>
                                                                        @endif

                                                                        <a class="dropdown-item hoverdropdown"
                                                                            href="javascript:;"
                                                                            onclick="batal_pesanan('{{ route('pesanan.edit', $value['id']) }}')">
                                                                            Batalkan Pesanan
                                                                        </a>
                                                                    @endif
                                                                @endif

                                                                @if ($value['status'] == 'Diterima' && $value['bukti_penerima'] != null && $value['tanggal_penerimaan'] == date('Y-m-d'))
                                                                    <a class="dropdown-item hoverdropdown"
                                                                        href="javascript:;"
                                                                        onclick="pengembalian_barang('{{ route('index-pengembalian-barang', $value['id']) }}')">
                                                                        Pengembalian Barang
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                @foreach ($value['data_barang'] as $key2 => $value2)
                                                    <div class="order-products">
                                                        <div class="product-image">
                                                            <img
                                                                src="{{ asset('image/transaksi/' . $value2->foto_barang) }}">
                                                        </div>
                                                        <div class="product-info">
                                                            <h3 class="product-name">{{ $value2->nama_barang }}</h3>
                                                            <div class="order-footer">
                                                                <div>
                                                                    <p class="product-price">Ukuran:
                                                                        {{ $value2->ukuran }}
                                                                    </p>
                                                                    <p class="product-quantity">
                                                                        x{{ $value2->jumlah }}
                                                                    </p>
                                                                    <p class="product-price">Harga:
                                                                        @currency($value2->harga_barang)
                                                                    </p>
                                                                </div>
                                                                <p class="product-quantity">@currency($value2->total)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                                <div class="order-footer">
                                                    <div class="order-status">Status: {{ $value['status'] }}
                                                        @if ($value['status'] == 'Diterima' || $value['status'] == 'Selesai')
                                                            || <a href="javascript:;"
                                                                onclick="bukti_penerima('{{ asset('image/bukti-penerima/' . $value['bukti_penerima']) }}')"
                                                                class="btn-penerima">Penerima</a>
                                                        @endif
                                                    </div>
                                                    <div class="order-status">Total: @currency($value['total'])</div>
                                                </div>
                                                @if ($value['status'] == 'Diterima')
                                                    <button class="btn btn-cancel-order"
                                                        onclick="terima_pesanan('{{ route('pesanan.update', $value['id']) }}')">Terima
                                                        Pesanan</button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="tab-pane fade mt-4" id="dikirim" role="tabpanel"
                                aria-labelledby="dikirim-tab">
                                @if ($data['dikirim'] == '')
                                    <div class="no-orders-container">
                                        <img src="{{ asset('image/tidak-ada-pesanan.jpg') }}" alt="No orders"
                                            class="gambar-tidak-ada-pesanan">
                                        <h2>Tidak ada pesanan</h2>
                                        <p>Anda belum melakukan pemesanan apapun.</p>
                                        <a href="{{ route('data-produk') }}" class="btn btn-primary">Mulai Berbelanja</a>
                                    </div>
                                @else
                                    @foreach ($data['dikirim'] as $key => $value)
                                        <div class="order-list">
                                            <div class="order-item">
                                                <div class="order-header">
                                                    <div class="order-number">Kode Transaksi:
                                                        {{ $value['kode_transaksi'] }}
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="order-date mr-2">Tanggal Pemesanan:
                                                            {{ $value['tanggal_transaksi'] }}
                                                        </div>
                                                        <div class="dropdown">
                                                            <a href="#" id="dropdown04" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Detail Pesanan"><span class="icon-more"></span></a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                                                <a class="dropdown-item hoverdropdown" href="javascript:;"
                                                                    onclick="Modal('{{ route('pesanan.show', $value['id']) }}', 'modal-lg', 'Detail Pesanan')">
                                                                    Detail Pesanan
                                                                </a>
                                                                @if (preg_match('/\bBelum Bayar\b/', $value['status']) == true || $value['status'] == 'Sedang Dikemas')
                                                                    @if (preg_match('/\bjam\b/', $value['waktu']) == true ||
                                                                            preg_match('/\bmenit\b/', $value['waktu']) == true ||
                                                                            preg_match('/\bdetik\b/', $value['waktu']) == true)
                                                                        @if ($value['tipe_pembayaran'] == 'transfer')
                                                                            <a class="dropdown-item hoverdropdown"
                                                                                href="javascript:;"
                                                                                onclick="Modal('{{ route('index-bayar-pesanan', $value['id']) }}', 'modal-lg', 'Bayar Pesanan')">
                                                                                Bayar Pesanan
                                                                            </a>
                                                                        @endif

                                                                        <a class="dropdown-item hoverdropdown"
                                                                            href="javascript:;"
                                                                            onclick="batal_pesanan('{{ route('pesanan.edit', $value['id']) }}')">
                                                                            Batalkan Pesanan
                                                                        </a>
                                                                    @endif
                                                                @endif

                                                                @if ($value['status'] == 'Diterima' && $value['bukti_penerima'] != null && $value['tanggal_penerimaan'] == date('Y-m-d'))
                                                                    <a class="dropdown-item hoverdropdown"
                                                                        href="javascript:;"
                                                                        onclick="pengembalian_barang('{{ route('index-pengembalian-barang', $value['id']) }}')">
                                                                        Pengembalian Barang
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                @foreach ($value['data_barang'] as $key2 => $value2)
                                                    <div class="order-products">
                                                        <div class="product-image">
                                                            <img
                                                                src="{{ asset('image/transaksi/' . $value2->foto_barang) }}">
                                                        </div>
                                                        <div class="product-info">
                                                            <h3 class="product-name">{{ $value2->nama_barang }}</h3>
                                                            <div class="order-footer">
                                                                <div>
                                                                    <p class="product-price">Ukuran:
                                                                        {{ $value2->ukuran }}
                                                                    </p>
                                                                    <p class="product-quantity">
                                                                        x{{ $value2->jumlah }}
                                                                    </p>
                                                                    <p class="product-price">Harga:
                                                                        @currency($value2->harga_barang)
                                                                    </p>
                                                                </div>
                                                                <p class="product-quantity">@currency($value2->total)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                                <div class="order-footer">
                                                    <div class="order-status">Status: {{ $value['status'] }}
                                                        @if ($value['status'] == 'Diterima' || $value['status'] == 'Selesai')
                                                            || <a href="javascript:;"
                                                                onclick="bukti_penerima('{{ asset('image/bukti-penerima/' . $value['bukti_penerima']) }}')"
                                                                class="btn-penerima">Penerima</a>
                                                        @endif
                                                    </div>
                                                    <div class="order-status">Total: @currency($value['total'])</div>
                                                </div>
                                                @if ($value['status'] == 'Diterima')
                                                    <button class="btn btn-cancel-order"
                                                        onclick="terima_pesanan('{{ route('pesanan.update', $value['id']) }}')">Terima
                                                        Pesanan</button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="tab-pane fade mt-4" id="selesai" role="tabpanel"
                                aria-labelledby="selesai-tab">
                                @if ($data['selesai'] == '')
                                    <div class="no-orders-container">
                                        <img src="{{ asset('image/tidak-ada-pesanan.jpg') }}" alt="No orders"
                                            class="gambar-tidak-ada-pesanan">
                                        <h2>Tidak ada pesanan</h2>
                                        <p>Anda belum melakukan pemesanan apapun.</p>
                                        <a href="{{ route('data-produk') }}" class="btn btn-primary">Mulai Berbelanja</a>
                                    </div>
                                @else
                                    @foreach ($data['selesai'] as $key => $value)
                                        <div class="order-list">
                                            <div class="order-item">
                                                <div class="order-header">
                                                    <div class="order-number">Kode Transaksi:
                                                        {{ $value['kode_transaksi'] }}
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="order-date mr-2">Tanggal Pemesanan:
                                                            {{ $value['tanggal_transaksi'] }}
                                                        </div>
                                                        <div class="dropdown">
                                                            <a href="#" id="dropdown04" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Detail Pesanan"><span class="icon-more"></span></a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                                                <a class="dropdown-item hoverdropdown" href="javascript:;"
                                                                    onclick="Modal('{{ route('pesanan.show', $value['id']) }}', 'modal-lg', 'Detail Pesanan')">
                                                                    Detail Pesanan
                                                                </a>
                                                                @if (preg_match('/\bBelum Bayar\b/', $value['status']) == true || $value['status'] == 'Sedang Dikemas')
                                                                    @if (preg_match('/\bjam\b/', $value['waktu']) == true ||
                                                                            preg_match('/\bmenit\b/', $value['waktu']) == true ||
                                                                            preg_match('/\bdetik\b/', $value['waktu']) == true)
                                                                        @if ($value['tipe_pembayaran'] == 'transfer')
                                                                            <a class="dropdown-item hoverdropdown"
                                                                                href="javascript:;"
                                                                                onclick="Modal('{{ route('index-bayar-pesanan', $value['id']) }}', 'modal-lg', 'Bayar Pesanan')">
                                                                                Bayar Pesanan
                                                                            </a>
                                                                        @endif

                                                                        <a class="dropdown-item hoverdropdown"
                                                                            href="javascript:;"
                                                                            onclick="batal_pesanan('{{ route('pesanan.edit', $value['id']) }}')">
                                                                            Batalkan Pesanan
                                                                        </a>
                                                                    @endif
                                                                @endif

                                                                @if ($value['status'] == 'Diterima' && $value['bukti_penerima'] != null && $value['tanggal_penerimaan'] == date('Y-m-d'))
                                                                    <a class="dropdown-item hoverdropdown"
                                                                        href="javascript:;"
                                                                        onclick="pengembalian_barang('{{ route('index-pengembalian-barang', $value['id']) }}')">
                                                                        Pengembalian Barang
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                @foreach ($value['data_barang'] as $key2 => $value2)
                                                    <div class="order-products">
                                                        <div class="product-image">
                                                            <img
                                                                src="{{ asset('image/transaksi/' . $value2->foto_barang) }}">
                                                        </div>
                                                        <div class="product-info">
                                                            <h3 class="product-name">{{ $value2->nama_barang }}</h3>
                                                            <div class="order-footer">
                                                                <div>
                                                                    <p class="product-price">Ukuran:
                                                                        {{ $value2->ukuran }}
                                                                    </p>
                                                                    <p class="product-quantity">
                                                                        x{{ $value2->jumlah }}
                                                                    </p>
                                                                    <p class="product-price">Harga:
                                                                        @currency($value2->harga_barang)
                                                                    </p>
                                                                </div>
                                                                <p class="product-quantity">@currency($value2->total)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                                <div class="order-footer">
                                                    <div class="order-status">Status: {{ $value['status'] }}
                                                        @if ($value['status'] == 'Diterima' || $value['status'] == 'Selesai')
                                                            || <a href="javascript:;"
                                                                onclick="bukti_penerima('{{ asset('image/bukti-penerima/' . $value['bukti_penerima']) }}')"
                                                                class="btn-penerima">Penerima</a>
                                                        @endif
                                                    </div>
                                                    <div class="order-status">Total: @currency($value['total'])</div>
                                                </div>
                                                @if ($value['status'] == 'Diterima')
                                                    <button class="btn btn-cancel-order"
                                                        onclick="terima_pesanan('{{ route('pesanan.update', $value['id']) }}')">Terima
                                                        Pesanan</button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="tab-pane fade mt-4" id="dibatalkan" role="tabpanel"
                                aria-labelledby="dibatalkan-tab">
                                @if ($data['dibatalkan'] == '')
                                    <div class="no-orders-container">
                                        <img src="{{ asset('image/tidak-ada-pesanan.jpg') }}" alt="No orders"
                                            class="gambar-tidak-ada-pesanan">
                                        <h2>Tidak ada pesanan</h2>
                                        <p>Anda belum melakukan pemesanan apapun.</p>
                                        <a href="{{ route('data-produk') }}" class="btn btn-primary">Mulai Berbelanja</a>
                                    </div>
                                @else
                                    @foreach ($data['dibatalkan'] as $key => $value)
                                        <div class="order-list">
                                            <div class="order-item">
                                                <div class="order-header">
                                                    <div class="order-number">Kode Transaksi:
                                                        {{ $value['kode_transaksi'] }}
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="order-date mr-2">Tanggal Pemesanan:
                                                            {{ $value['tanggal_transaksi'] }}
                                                        </div>
                                                        <div class="dropdown">
                                                            <a href="#" id="dropdown04" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Detail Pesanan"><span class="icon-more"></span></a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                                                <a class="dropdown-item hoverdropdown" href="javascript:;"
                                                                    onclick="Modal('{{ route('pesanan.show', $value['id']) }}', 'modal-lg', 'Detail Pesanan')">
                                                                    Detail Pesanan
                                                                </a>
                                                                @if (preg_match('/\bBelum Bayar\b/', $value['status']) == true || $value['status'] == 'Sedang Dikemas')
                                                                    @if (preg_match('/\bjam\b/', $value['waktu']) == true ||
                                                                            preg_match('/\bmenit\b/', $value['waktu']) == true ||
                                                                            preg_match('/\bdetik\b/', $value['waktu']) == true)
                                                                        @if ($value['tipe_pembayaran'] == 'transfer')
                                                                            <a class="dropdown-item hoverdropdown"
                                                                                href="javascript:;"
                                                                                onclick="Modal('{{ route('index-bayar-pesanan', $value['id']) }}', 'modal-lg', 'Bayar Pesanan')">
                                                                                Bayar Pesanan
                                                                            </a>
                                                                        @endif

                                                                        <a class="dropdown-item hoverdropdown"
                                                                            href="javascript:;"
                                                                            onclick="batal_pesanan('{{ route('pesanan.edit', $value['id']) }}')">
                                                                            Batalkan Pesanan
                                                                        </a>
                                                                    @endif
                                                                @endif

                                                                @if ($value['status'] == 'Diterima' && $value['bukti_penerima'] != null && $value['tanggal_penerimaan'] == date('Y-m-d'))
                                                                    <a class="dropdown-item hoverdropdown"
                                                                        href="javascript:;"
                                                                        onclick="pengembalian_barang('{{ route('index-pengembalian-barang', $value['id']) }}')">
                                                                        Pengembalian Barang
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                @foreach ($value['data_barang'] as $key2 => $value2)
                                                    <div class="order-products">
                                                        <div class="product-image">
                                                            <img
                                                                src="{{ asset('image/transaksi/' . $value2->foto_barang) }}">
                                                        </div>
                                                        <div class="product-info">
                                                            <h3 class="product-name">{{ $value2->nama_barang }}</h3>
                                                            <div class="order-footer">
                                                                <div>
                                                                    <p class="product-price">Ukuran:
                                                                        {{ $value2->ukuran }}
                                                                    </p>
                                                                    <p class="product-quantity">
                                                                        x{{ $value2->jumlah }}
                                                                    </p>
                                                                    <p class="product-price">Harga:
                                                                        @currency($value2->harga_barang)
                                                                    </p>
                                                                </div>
                                                                <p class="product-quantity">@currency($value2->total)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                                <div class="order-footer">
                                                    <div class="order-status">Status: {{ $value['status'] }}
                                                        @if ($value['status'] == 'Diterima' || $value['status'] == 'Selesai')
                                                            || <a href="javascript:;"
                                                                onclick="bukti_penerima('{{ asset('image/bukti-penerima/' . $value['bukti_penerima']) }}')"
                                                                class="btn-penerima">Penerima</a>
                                                        @endif
                                                    </div>
                                                    <div class="order-status">Total: @currency($value['total'])</div>
                                                </div>
                                                @if ($value['status'] == 'Diterima')
                                                    <button class="btn btn-cancel-order"
                                                        onclick="terima_pesanan('{{ route('pesanan.update', $value['id']) }}')">Terima
                                                        Pesanan</button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                            <div class="tab-pane fade mt-4" id="pengembalian" role="tabpanel"
                                aria-labelledby="pengembalian-tab">
                                @if ($data['pengembalian'] == '')
                                    <div class="no-orders-container">
                                        <img src="{{ asset('image/tidak-ada-pesanan.jpg') }}" alt="No orders"
                                            class="gambar-tidak-ada-pesanan">
                                        <h2>Tidak ada pesanan</h2>
                                        <p>Anda belum melakukan pemesanan apapun.</p>
                                        <a href="{{ route('data-produk') }}" class="btn btn-primary">Mulai Berbelanja</a>
                                    </div>
                                @else
                                    @foreach ($data['pengembalian'] as $key => $value)
                                        <div class="order-list">
                                            <div class="order-item">
                                                <div class="order-header">
                                                    <div class="order-number">Kode Transaksi:
                                                        {{ $value['kode_transaksi'] }}
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="order-date mr-2">Tanggal Pemesanan:
                                                            {{ $value['tanggal_transaksi'] }}
                                                        </div>
                                                        <div class="dropdown">
                                                            <a href="#" id="dropdown04" data-toggle="dropdown"
                                                                aria-haspopup="true" aria-expanded="false"
                                                                data-toggle="tooltip" data-placement="top"
                                                                title="Detail Pesanan"><span class="icon-more"></span></a>
                                                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                                                <a class="dropdown-item hoverdropdown" href="javascript:;"
                                                                    onclick="Modal('{{ route('pesanan.show', $value['id']) }}', 'modal-lg', 'Detail Pesanan')">
                                                                    Detail Pesanan
                                                                </a>
                                                                @if (preg_match('/\bBelum Bayar\b/', $value['status']) == true || $value['status'] == 'Sedang Dikemas')
                                                                    @if (preg_match('/\bjam\b/', $value['waktu']) == true ||
                                                                            preg_match('/\bmenit\b/', $value['waktu']) == true ||
                                                                            preg_match('/\bdetik\b/', $value['waktu']) == true)
                                                                        @if ($value['tipe_pembayaran'] == 'transfer')
                                                                            <a class="dropdown-item hoverdropdown"
                                                                                href="javascript:;"
                                                                                onclick="Modal('{{ route('index-bayar-pesanan', $value['id']) }}', 'modal-lg', 'Bayar Pesanan')">
                                                                                Bayar Pesanan
                                                                            </a>
                                                                        @endif

                                                                        <a class="dropdown-item hoverdropdown"
                                                                            href="javascript:;"
                                                                            onclick="batal_pesanan('{{ route('pesanan.edit', $value['id']) }}')">
                                                                            Batalkan Pesanan
                                                                        </a>
                                                                    @endif
                                                                @endif

                                                                @if ($value['status'] == 'Diterima' && $value['bukti_penerima'] != null && $value['tanggal_penerimaan'] == date('Y-m-d'))
                                                                    <a class="dropdown-item hoverdropdown"
                                                                        href="javascript:;"
                                                                        onclick="pengembalian_barang('{{ route('index-pengembalian-barang', $value['id']) }}')">
                                                                        Pengembalian Barang
                                                                    </a>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr>
                                                @foreach ($value['data_barang'] as $key2 => $value2)
                                                    <div class="order-products">
                                                        <div class="product-image">
                                                            <img
                                                                src="{{ asset('image/transaksi/' . $value2->foto_barang) }}">
                                                        </div>
                                                        <div class="product-info">
                                                            <h3 class="product-name">{{ $value2->nama_barang }}</h3>
                                                            <div class="order-footer">
                                                                <div>
                                                                    <p class="product-price">Ukuran:
                                                                        {{ $value2->ukuran }}
                                                                    </p>
                                                                    <p class="product-quantity">
                                                                        x{{ $value2->jumlah }}
                                                                    </p>
                                                                    <p class="product-price">Harga:
                                                                        @currency($value2->harga_barang)
                                                                    </p>
                                                                </div>
                                                                <p class="product-quantity">@currency($value2->total)</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                                <div class="order-footer">
                                                    <div class="order-status">Status: {{ $value['status'] }}
                                                        @if ($value['status'] == 'Diterima' || $value['status'] == 'Selesai')
                                                            || <a href="javascript:;"
                                                                onclick="bukti_penerima('{{ asset('image/bukti-penerima/' . $value['bukti_penerima']) }}')"
                                                                class="btn-penerima">Penerima</a>
                                                        @endif
                                                    </div>
                                                    <div class="order-status">Total: @currency($value['total'])</div>
                                                </div>
                                                @if ($value['status'] == 'Diterima')
                                                    <button class="btn btn-cancel-order"
                                                        onclick="terima_pesanan('{{ route('pesanan.update', $value['id']) }}')">Terima
                                                        Pesanan</button>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@extends('pembeli.layouts.main')
@section('data')
    <div class="hero-wrap hero-bread" style="background-image: url('assets_pembeli/images/bg_6.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2">Halaman Tentang</span>
                    </p>
                    <h1 class="mb-0 bread">Tentang Toko</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section ftco-no-pb ftco-no-pt bg-light mt-4">
        <div class="container">
            <div class="row">
                <div class="col-md-5 p-md-5 img img-2 d-flex justify-content-center align-items-center"
                    style="background-image: url(image/halaman-tentang/gambar-tentang.jpg);">

                </div>
                <div class="col-md-7 py-5 wrap-about pb-md-5 ftco-animate">
                    <div class="heading-section-bold mb-4 mt-md-5">
                        <div class="ml-md-0">
                            <h2 class="mb-4">Deskripsi Toko</h2>
                        </div>
                    </div>
                    <div class="pb-md-5">
                        <p style="text-align: justify;">
                            &emsp;&emsp;UD. Adi Alam Bagus adalah sebuah toko yang bergerak dibidang penjualan batu alam
                            seperti
                            batu
                            candi, batu andesit, batu marmer, batu palimanan, batu putih, batu paras jogja, batu susun
                            sirih, batu lis, dan lain sebagainya yang biasanya digunakan sebagai pelangkap akhir dalam
                            pembuatan suatu bangunan misalnya ditempelkan ditembok sebagai dinding agar memberikan kesan
                            yang alami dan estetik, dipasang dipilar, atau bisa juga dijadikan sebagai pijakan ditanah. Batu
                            alam yang dijual juga tersedia dalam berbagai ukuran. <br>

                            &emsp;&emsp; UD. Adi Alam Bagus berlokasi di Jalan Raya Denpasar - Gilimanuk, Mengwitani,
                            Kecamatan Mengwi,
                            Kabupaten Badung dan telah beroperasi sejak 19 Januari 2012.
                            Website UD. Adi Alam Bagus ini memberikan kemudahan dalam berbelanja diantaranya membantu
                            pembeli dan calon pembeli untuk mendapatkan informasi alternatif mengenai batu alam, proses
                            pemesanan batu dapat dilakukan secara online, dan proses transaksi sudah terintegrasi
                            dengan e-banking.
                        </p>
                        <div class="row ftco-services">
                            <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                                <div class="media block-6 services">
                                    <div class="icon d-flex justify-content-center align-items-center mb-4">
                                        <span class="flaticon-002-recommended"></span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="heading">Pengembalian Barang</h3>
                                        <p>
                                            Pengembalian dilakukan jika ada kesalahan dalam pengiriman maupun salah kirim
                                            barang
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                                <div class="media block-6 services">
                                    <div class="icon d-flex justify-content-center align-items-center mb-4">
                                        <span class="flaticon-001-box"></span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="heading">Pengemasan Yang Premium</h3>
                                        <p>
                                            Pengemasan yang digunakan dari bahan premium agar barang sampai di tujuan dengan
                                            aman
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 text-center d-flex align-self-stretch ftco-animate">
                                <div class="media block-6 services">
                                    <div class="icon d-flex justify-content-center align-items-center mb-4">
                                        <span class="flaticon-003-medal"></span>
                                    </div>
                                    <div class="media-body">
                                        <h3 class="heading">Kualitas Produk</h3>
                                        <p>
                                            Kami sangat menjungjung tinggi kualitas produk kami
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="ftco-section ftco-counter img mt-4" id="section-counter"
        style="background-image: url(image/halaman-utama/gambar-toko.jpg);">
        <div class="container">
            <div class="row justify-content-center py-5">
                <div class="col-md-10">
                    <div class="row {{ auth()->user() == null ? 'd-flex justify-content-center' : '' }} ">
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text">
                                    <strong class="number strokeme" data-number="{{ $data['total_produk'] }}">0</strong>
                                    <span class="strokeme">Total Produk</span>
                                </div>
                            </div>
                        </div>
                        @auth
                            <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                                <div class="block-18 text-center">
                                    <div class="text">
                                        <strong class="number strokeme" data-number="{{ $data['total_pesanan'] }}">0</strong>
                                        <span class="strokeme">Total Pesanan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                                <div class="block-18 text-center">
                                    <div class="text">
                                        <strong class="number strokeme" data-number="{{ $data['total_transaksi'] }}">0</strong>
                                        <span class="strokeme">Total Transaksi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                                <div class="block-18 text-center">
                                    <div class="text">
                                        <strong class="number strokeme" data-number="{{ $data['total_pembeli'] }}">0</strong>
                                        <span class="strokeme">Total Pembeli</span>
                                    </div>
                                </div>
                            </div>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

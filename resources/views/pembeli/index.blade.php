@extends('pembeli.layouts.main')
@section('css')
    <style>
        .data-data {
            display: inline-block;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8);
            /* warna background putih dengan opacity 0.8 */
        }

        /* tambahan style untuk membuat data-data number dan span tersusun secara horizontal */
        .data-data .number,
        .data-data span {
            display: inline-block;
            margin: 0 5px;
        }

        .data2 {
            display: inline-block;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
            background-color: rgba(255, 255, 255, 0.8);
            font-size: 180%;
        }
    </style>
@endsection
@section('data')
    <section id="home-section" class="hero">
        <div class="home-slider js-fullheight owl-carousel">
            <div class="slider-item js-fullheight">
                <div class="overlay"></div>
                <div class="container-fluid p-0">
                    <div class="row d-md-flex no-gutters slider-text js-fullheight align-items-center justify-content-end"
                        data-scrollax-parent="true">
                        <div class="one-third order-md-last img js-fullheight"
                            style="background-image:url(image/halaman-utama/gambar1.jpg);">
                        </div>
                        <div class="one-forth d-flex js-fullheight align-items-center ftco-animate"
                            data-scrollax=" properties: { translateY: '70%' }">
                            <div class="text">
                                <span class="subheading">UD Adi eCommerce Shop</span>
                                <div class="horizontal">
                                    <h3 class="vr">
                                        berdiri sejak
                                        19 Januari 2012</h3>
                                    <h1 class="mb-4 mt-3">Menjual Batu Alam<br><span>Kualitas Terjamin</span></h1>
                                    <p>
                                        Ingin memperindah bangunan anda dengan batu alam yang memiliki berbagai motif,
                                        corak, warna, dan bentuk yang beranekaragam sesuai keinginan? Nah kami
                                        menyediakannya disini, silahkan dipilih.
                                    </p>

                                    <p><a href="{{ route('data-produk') }}" class="btn btn-primary px-5 py-3 mt-3">Lihat
                                            Produk</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="slider-item js-fullheight">
                <div class="overlay"></div>
                <div class="container-fluid p-0">
                    <div class="row d-flex no-gutters slider-text js-fullheight align-items-center justify-content-end"
                        data-scrollax-parent="true">
                        <div class="one-third order-md-last img js-fullheight"
                            style="background-image:url(image/halaman-utama/gambar2.jpg);">
                        </div>
                        <div class="one-forth d-flex js-fullheight align-items-center ftco-animate"
                            data-scrollax=" properties: { translateY: '70%' }">
                            <div class="text">
                                <span class="subheading">UD Adi eCommerce Shop</span>
                                <div class="horizontal">
                                    <h3 class="vr">Mudah Digunakan
                                    </h3>
                                    <h1 class="mb-4 mt-3">Tersedia Berbagai <span>Jenis Dan Ukuran
                                        </span> </h1>
                                    <p>
                                        Kami menyediakan batu alam dengan berbagai jenis dan ukuran tertentu yang memudahkan
                                        anda untuk memilih sesuai dengan kebutuhan anda.
                                    </p>

                                    <p><a href="{{ route('data-produk') }}" class="btn btn-primary px-5 py-3 mt-3">Beli
                                            Sekarang</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="ftco-section ftco-choose ftco-no-pb ftco-no-pt mt-4">
        <div class="container">
            @foreach ($data['produk_terbaru'] as $key => $value)
                <div class="row">
                    <div class=" d-flex align-items-stretch {{ $key > 0 ? 'col-md-5 order-md-last' : 'col-md-8' }}">
                        <div class="img {{ $key > 0 ? 'img-2' : '' }}"
                            style="background-image: url(image/barang/{{ $value->gambar }});"></div>
                    </div>
                    <div class="{{ $key > 0 ? 'col-md-7 py-3' : 'col-md-4' }}  py-md-5 ftco-animate">
                        <div class="text  {{ $key > 0 ? 'text-2 py-md-5' : 'py-3' }} py-md-5">
                            <h2 class="mb-4 data2 text-dark font-weight-bold">Batu yang paling laku terjual: <br>
                                <span class="mt-2">{{ $value->nama_barang }}</span>
                            </h2>
                            <p class="data-data text-dark ">{{ $value->keterangan }}</p>
                            <p><a href="{{ route('data-produk') }}" class="btn btn-white px-4 py-3">Beli Sekarang</a></p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="ftco-section bg-light">
        <div class="container">
            <div class="row justify-content-center mb-3 pb-3">
                <div class="col-md-12 heading-section text-center ftco-animate">
                    <h2 class="mb-4">Produk</h2>
                    {{-- <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia</p> --}}
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-12 col-lg-12 col-xl-12 col-xxl-12 order-md-last">
                    <div class="row">
                        @foreach ($data['produk'] as $key => $value)
                            <div class="col-md-6 col-lg-6 col-xl-3 col-xxl-3 ftco-animate">
                                <div class="product">
                                    <a href="@auth javascript:; @else {{ route('index-login') }} @endauth" class="img-prod"
                                        @if (auth()->user() != null && auth()->user()->role == 2) onclick="Modal('{{ route('tambah-keranjang', ['id' => $value->id, 'status' => 'tambah keranjang']) }}', 'modal-lg', 'Tambah Keranjang')" @endif>
                                        <img class="img-fluid" src="{{ asset('image/barang/' . $value->gambar) }}"
                                            alt="Colorlib Template">
                                        <div class="overlay"></div>
                                    </a>
                                    <div class="text py-3 px-3">
                                        <h3><a href="@auth javascript:; @else {{ route('index-login') }} @endauth"
                                                @if (auth()->user() != null && auth()->user()->role == 2) onclick="Modal('{{ route('tambah-keranjang', ['id' => $value->id, 'status' => 'tambah keranjang']) }}', 'modal-lg', 'Tambah Keranjang')" @endif>{{ $value->nama_barang }}</a>
                                        </h3>
                                        <div class="d-flex">
                                            <div class="">
                                                <p class="price"><span class="price-sale">{{ $harga[$key] }}</span></p>
                                            </div>
                                        </div>
                                        <p class="bottom-area d-flex px-3">
                                            <a href="@auth javascript:; @else {{ route('index-login') }} @endauth"
                                                class="add-to-cart text-center py-2 mr-1"
                                                @if (auth()->user() != null && auth()->user()->role == 2) onclick="Modal('{{ route('tambah-keranjang', ['id' => $value->id, 'status' => 'tambah keranjang']) }}', 'modal-lg', 'Tambah Keranjang')" @endif><span>Keranjang
                                                    <i class="ion-ios-add ml-1"></i></span></a>
                                            <a href="@auth javascript:; @else{{ route('index-login') }} @endauth"
                                                class="buy-now text-center py-2" style="width: 110% !important;"
                                                @if (auth()->user() != null && auth()->user()->role == 2) onclick="Modal('{{ route('tambah-keranjang', ['id' => $value->id, 'status' => 'beli sekarang']) }}', 'modal-lg', 'Beli Sekarang')" @endif>Beli
                                                Sekarang<span><i class="ion-ios-cart ml-1"></i></span></a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <p class="text-center"><a href="{{ route('data-produk') }}" class="btn btn-primary px-3 py-2 mt-3">Lihat
                Selengkapnya</a></p>

    </section>

    <section class="ftco-section ftco-counter img mt-4" id="section-counter"
        style="background-image: url(image/halaman-utama/gambar-toko.jpg);">
        <div class="container">
            <div class="row justify-content-center py-5">
                <div class="col-md-10">
                    <div class="row {{ auth()->user() == null ? 'd-flex justify-content-center' : '' }} ">
                        <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                            <div class="block-18 text-center">
                                <div class="text data-data">
                                    <strong class="number font-weight-bold"
                                        data-number="{{ $data['total_produk'] }}">0</strong>
                                    <span class="text-dark font-weight-bold">Total Produk</span>
                                </div>
                            </div>
                        </div>
                        @auth
                            <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                                <div class="block-18 text-center">
                                    <div class="text data-data">
                                        <strong class="number font-weight-bold"
                                            data-number="{{ $data['total_pesanan'] }}">0</strong>
                                        <span class="text-dark font-weight-bold">Total Pesanan</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                                <div class="block-18 text-center">
                                    <div class="text data-data">
                                        <strong class="number font-weight-bold"
                                            data-number="{{ $data['total_transaksi'] }}">0</strong>
                                        <span class="text-dark font-weight-bold">Total Transaksi</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
                                <div class="block-18 text-center">
                                    <div class="text data-data">
                                        <strong class="number font-weight-bold"
                                            data-number="{{ $data['total_pembeli'] }}">0</strong>
                                        <span class="text-dark font-weight-bold">Total Pembeli</span>
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

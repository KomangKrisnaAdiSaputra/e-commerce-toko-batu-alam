<div class="row">
    <div class="col-md-8 col-lg-10 order-md-last">
        <div class="row">
            @foreach ($data['data_barang'] as $key => $value)
                <div class="col-sm-6 col-md-6 col-lg-4 ">
                    <div class="product">
                        <a href="@auth javascript:; @else {{ route('index-login') }} @endauth" class="img-prod"
                            @if (auth()->user() != null && auth()->user()->role == 2) onclick="Modal('{{ route('tambah-keranjang', ['id' => $value->id, 'status' => 'tambah keranjang']) }}', 'modal-lg', 'Tambah Keranjang')" @endif>
                            <img class="img-fluid" src="{{ asset('image/barang/' . $value->gambar) }}"
                                alt="Colorlib Template" style="object-fit: cover !important;">
                            <div class="overlay"></div>
                        </a>
                        <div class="text py-3 px-3">
                            <h3>
                                <a href="@auth javascript:; @else {{ route('index-login') }} @endauth"
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
                                    @if (auth()->user() != null && auth()->user()->role == 2) onclick="Modal('{{ route('tambah-keranjang', ['id' => $value->id, 'status' => 'tambah keranjang']) }}', 'modal-lg', 'Tambah Keranjang')" @endif>
                                    <span>Keranjang<i class="ion-ios-add ml-1"></i></span>
                                </a>
                                <a href="@auth javascript:; @else{{ route('index-login') }} @endauth"
                                    class="buy-now text-center py-2"
                                    @if (auth()->user() != null && auth()->user()->role == 2) onclick="Modal('{{ route('tambah-keranjang', ['id' => $value->id, 'status' => 'beli sekarang']) }}', 'modal-lg', 'Beli Sekarang')" @endif>Beli
                                    Sekarang<span><i class="ion-ios-cart ml-1"></i></span></a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            <div class="row mt-5 ">
                <div class="col text-center">
                    <div class="block-27 ">
                        {{ $data['data_barang']->links('vendor.pagination.default') }}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-lg-1 sidebar">
        <div class="sidebar-box-2">

        </div>
    </div>
</div>

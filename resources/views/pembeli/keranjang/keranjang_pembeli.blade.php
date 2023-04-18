@extends('pembeli.layouts.main')
@section('css')
    <style>
        p .btn-checkout {
            color: white !important;
        }

        p .btn-checkout:hover {
            color: #ffa45c !important;
        }

        .btn-jumlah:hover {
            background-color: #ffa45c !important;
        }

        .btn-jumlah:hover .icon-jumlah {
            color: white !important;

        }
    </style>
@endsection
@section('data')
    <div class="hero-wrap hero-bread" style="background-image: url('assets_pembeli/images/bg_6.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2">Halaman Keranjang</span></p>
                    <h1 class="mb-0 bread">Keranjang Saya</h1>
                </div>
            </div>
        </div>
    </div>
    <section class="ftco-section ftco-cart">
        <div class="container">
            <div class="row">
                <div class="col-md-12 ftco-animate">
                    <div class="cart-list table-responsive" id="data_keranjang">

                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col col-lg-5 col-md-6 mt-5 cart-wrap ftco-animate">
                    <div class="cart-total mb-3">
                        <h3>Total Keranjang</h3>
                        <p class="d-flex">
                            <span>Subtotal</span>
                            <span class="total_keranjang">Rp 0</span>
                        </p>
                        <hr>
                        <p class="d-flex total-price">
                            <span>Total</span>
                            <span class="total_keranjang">Rp 0</span>
                        </p>
                    </div>
                    <p class="text-center">
                        <button class="btn btn-primary btn-checkout py-3 px-4"
                            onclick="halaman_checkout('{{ route('checkout', Crypt::encrypt('keranjang')) }}')"
                            disabled>Checkout</button>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <input type="hidden" id="cek_centang" value="0">
@section('javascript')
    <script>
        $(document).ready(function() {


            let cek_reload = window.performance.getEntriesByType("navigation")[0].type;

            if (cek_reload == "reload" || cek_reload != "reload") {
                $.get("{{ url('keranjang/total') }}/" + 0, {}, function(data, status) {
                    $(".total_keranjang").html(FormatRupiah(data, 'Rp '));
                });
                data_keranjang();
            }
            data_keranjang();


        });

        function data_keranjang() {
            $.get("{{ route('data-keranjang') }}", {}, function(data, status) {
                $("#data_keranjang").html(data);
            });
        };

        function centang_keranjang(id) {
            var cek_centang = $('#cek_centang').val();

            if ($(id).prop('checked')) {
                $('#cek_centang').val(parseInt(cek_centang) + parseInt(1));
            } else {
                $('#cek_centang').val(parseInt(cek_centang) - parseInt(1));

                if (cek_centang < 0) {
                    cek_centang = 0;
                }
            }

            cek_centang = $('#cek_centang').val();

            if (cek_centang == 0) {
                $('.btn-checkout').prop('disabled', true);
            } else {
                $('.btn-checkout').prop('disabled', false);
            }

            $.get("{{ url('keranjang/total') }}/" + $(id).val(), {}, function(data, status) {
                $(".total_keranjang").html(FormatRupiah(data, 'Rp '));
            });
        }

        function halaman_checkout(link) {
            location.href = link;
        }

        function jumlah(status, max, id, id_data) {
            var jumlah = $('#' + id);
            var angka = "";

            if (status == "tambah") {
                angka = parseInt(jumlah.val()) + parseInt(1);
            } else if (status == "kurang") {
                angka = parseInt(jumlah.val()) - parseInt(1);
            }

            if (angka < 1) {
                angka = 1;
            } else if (angka > max) {
                angka = max;
            }
            jumlah.val(angka);

            $.get("{{ url('keranjang/jumlah-keranjang') }}/" + id_data + "/" + angka, {}, function(data, status) {
                data_keranjang();
                $(".total_keranjang").html(FormatRupiah(data, 'Rp '));
            });

        }

        function centang_semua() {
            var centang;
            if ($('#centang_semua').prop('checked')) {
                centang = 'centang';
            } else {
                centang = 'tidak_centang';
            }
            $.get("{{ url('centang-semua') }}/" + centang, {}, function(data, status) {
                data.id_keranjang.forEach(id => {
                    if (data.status == 'centang') {
                        $('#centang_keranjang' + id).prop('checked', true);
                        $('.btn-checkout').prop('disabled', false);
                    } else {
                        $('#centang_keranjang' + id).prop('checked', false);
                        $('.btn-checkout').prop('disabled', true);
                    }
                });
                $(".total_keranjang").html(FormatRupiah(data.total, 'Rp '));
            });
        }
    </script>
@endsection
@endsection

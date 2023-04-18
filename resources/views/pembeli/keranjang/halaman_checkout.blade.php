@extends('pembeli.layouts.main')
@section('css')
    <style>
        .form-group .text-hitam {
            color: black !important;
        }

        .form-group .text-area {
            height: 100px !important;
        }
    </style>
@endsection
@section('data')
    <div class="hero-wrap hero-bread" style="background-image: url('{{ asset('assets_pembeli/images/bg_6.jpg') }}');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9  text-center">
                    <p class="breadcrumbs"><span class="mr-2">Halaman Checkout</span></p>
                    <h1 class="mb-0 bread">Checkout</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xl-8 ">
                    <form action="#" class="billing-form">
                        <h3 class="mb-4 billing-heading">Detail Checkout</h3>
                        <div class="row align-items-end">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="name">Nama</label>
                                    <input type="text" class="form-control text-hitam" id="name"
                                        value="{{ $data['user']->tb_user->name }}" onkeyup="ganti_warna('name')" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="no_Wa">No WhatsApp</label>
                                    <input type="number" min="0" class="form-control text-hitam" id="no_wa"
                                        onkeyup="ganti_warna('no_wa')" value="{{ $data['user']->no_wa }}" required>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <textarea name="alamat" class="form-control text-hitam text-area" id="alamat" cols="30" rows="10"
                                        placeholder="Alamat" onkeyup="ganti_warna('alamat')" required>{{ $data['user']->alamat }}</textarea>
                                </div>
                            </div>
                        </div>
                    </form><!-- END -->

                    <div class="row mt-5 pt-3 d-flex">
                        <div class="col-md-6 d-flex">
                            <div class="cart-detail cart-total bg-light p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Total Keranjang</h3>
                                <p class="d-flex">
                                    <span>Subtotal</span>
                                    <span>Rp @currency($data['total'])</span>
                                </p>
                                <hr>
                                <p class="d-flex total-price">
                                    <span>Total</span>
                                    <span>Rp @currency($data['total'])</span>
                                </p>
                                <div id="rekening">
                                    <p class="d-flex total-price mt-4 text-danger">
                                        *Rekening BCA: 1420382011 <br>
                                        a/n : Ni Putu Eka Sari Widyastuti
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="cart-detail bg-light p-3 p-md-4">
                                <h3 class="billing-heading mb-4">Metode Pembayaran</h3>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="tipe_pembayaran" value="transfer" id="radio_tf"
                                                    class="mr-2" checked onclick="$('#rekening').prop('hidden', false)">
                                                Transfer
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-12">
                                        <div class="radio">
                                            <label>
                                                <input type="radio" name="tipe_pembayaran" id="radio_cod" value="cod"
                                                    class="mr-2" onclick="$('#rekening').prop('hidden', true)">
                                                COD</label>
                                        </div>
                                    </div>
                                </div>
                                <p>
                                    <a href="javascript:;"class="btn btn-primary py-3 px-4" onclick="buat_pesanan()">Buat
                                        Pesanan</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div> <!-- .col-md-8 -->
            </div>
        </div>
    </section> <!-- .section -->

@section('javascript')
    <script>
        function buat_pesanan() {
            let nama_pembeli = $('#name');
            let no_whatsapp = $('#no_wa');
            let alamat = $('#alamat');
            let pembayaran = '';
            let status_transaksi = "{{ $data['status'] }}";
            let id_ukuran = "{{ $data['id'] }}";
            let jumlah = "{{ $data['jumlah'] }}";

            if ($('#radio_tf').prop('checked')) {
                pembayaran = $('#radio_tf');
            } else if ($('#radio_cod').prop('checked')) {
                pembayaran = $('#radio_cod');
            }
            if (nama_pembeli.val() != "" && no_whatsapp.val() != "" && alamat.val() != "") {
                let timerInterval

                var data_pesanan = new FormData();
                data_pesanan.append('nama_pembeli', nama_pembeli.val());
                data_pesanan.append('no_wa', no_whatsapp.val());
                data_pesanan.append('alamat', alamat.val());
                data_pesanan.append('tipe_pembayaran', pembayaran.val());
                data_pesanan.append('status', status_transaksi);
                data_pesanan.append('id', id_ukuran);
                data_pesanan.append('jumlah', jumlah);

                Swal.fire({
                    title: 'Pesanan Sedang Dibuat',
                    html: 'Tunggu Dalam <b></b> milliseconds.',
                    timer: 5000,
                    timerProgressBar: true,
                    didOpen: () => {
                        Swal.showLoading()
                        const b = Swal.getHtmlContainer().querySelector('b')
                        timerInterval = setInterval(() => {
                            b.textContent = Swal.getTimerLeft()
                        }, 100)
                        $.ajax({
                            url: "{{ route('buat-pesanan') }}",
                            method: 'post',
                            data: data_pesanan,
                            contentType: false,
                            processData: false,
                            success: function(response) {
                                location.href = "{{ route('halaman-utama') }}";

                            }
                        });
                    },
                    willClose: () => {
                        clearInterval(timerInterval)
                    }
                }).then((result) => {
                    /* Read more about handling dismissals below */
                    if (result.dismiss === Swal.DismissReason.timer) {
                        location.href = "{{ route('halaman-utama') }}";

                    }
                })


            } else {
                if (nama_pembeli.val() == "") {
                    nama_pembeli.css("cssText", "border-color: red !important");
                    nama_pembeli.focus()
                } else if (no_whatsapp.val() == "") {
                    no_whatsapp.css("cssText", "border-color: red !important");
                    no_whatsapp.focus()
                } else if (alamat.val() == "") {
                    alamat.css("cssText", "border-color: red !important");
                    alamat.focus();
                }
            }
        }

        function ganti_warna(status) {
            $('#' + status).css("cssText", "border-color: #ffa45c !important");
            $('#' + status).val($('#' + status).val().capitalize());
        }
    </script>
@endsection
@endsection

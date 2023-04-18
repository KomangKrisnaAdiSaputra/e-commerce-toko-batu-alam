<!DOCTYPE html>
<html lang="en">

<head>
    <title>UD Adi Alam Bagus</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/png" href="{{ asset('image/favicon-logo.png') }}">

    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('assets_pembeli/css/open-iconic-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_pembeli/css/animate.css') }}">

    <link rel="stylesheet" href="{{ asset('assets_pembeli/css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_pembeli/css/owl.theme.default.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_pembeli/css/magnific-popup.css') }}">

    <link rel="stylesheet" href="{{ asset('assets_pembeli/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('assets_pembeli/css/ionicons.min.css') }}">

    <link rel="stylesheet" href="{{ asset('assets_pembeli/css/bootstrap-datepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_pembeli/css/jquery.timepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('assets_pembeli/css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_pembeli/css/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets_pembeli/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        .ftco-navbar-light .navbar-nav .nav-item .nav-link:hover {
            color: #ffa45c !important;
        }

        .ftco-navbar-light .navbar-nav .nav-item .nav-link2 {
            color: #000000 !important;
        }

        .btn-close:hover {
            color: red !important;
        }

        .label-file {
            background-color: #d3d3d3;
            color: rgba(0, 0, 0, 0.441);
            padding: 0.56rem;
            font-family: sans-serif;
            cursor: pointer;
            margin-left: -0.80rem;
            margin-top: -0.90rem;
        }

        #file-chosen {
            margin-left: 0.3rem;
            font-family: sans-serif;
            cursor: pointer;
        }

        .strokeme {
            color: white;
            text-shadow: -1px -1px 0 #000, 1px -1px 0 #000, -1px 1px 0 #000, 1px 1px 0 #000;
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
    @yield('css')
</head>

<body class="goto-here">
    <div class="py-1 bg-black">
        <div class="container">
            <div class="row no-gutters d-flex align-items-start align-items-center px-md-0">
                <div class="col-lg-12 d-block">
                    <div class="row d-flex">
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-phone2"></span>
                            </div>
                            <span class="text">081916465680
                            </span>
                        </div>
                        <div class="col-md pr-4 d-flex topper align-items-center">
                            <div class="icon mr-2 d-flex justify-content-center align-items-center"><span
                                    class="icon-paper-plane"></span></div>
                            <span class="text">alambagusudadi@gmail.com</span>
                        </div>
                        <div class="col-md-5 pr-4 d-flex topper align-items-center text-lg-right">
                            <span class="text"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container">
            <a class="navbar-brand" href="index.html">UD Adi Alam Bagus</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="oi oi-menu"></span> Menu
            </button>

            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item {{ request()->is('/') ? 'active' : '' }}">
                        <a href="{{ route('halaman-utama') }}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item {{ request()->is('tentang') ? 'active' : '' }}">
                        <a href="{{ route('data-tentang') }}" class="nav-link">Tentang</a>
                    </li>
                    <li class="nav-item {{ request()->is('produk') ? 'active' : '' }}">
                        <a href="{{ route('data-produk') }}" class="nav-link">Produk</a>
                    </li>
                    <li class="nav-item {{ request()->is('kontak') ? 'active' : '' }}"><a
                            href="{{ route('data-kontak') }}" class="nav-link">Kontak </a></li>
                    @auth
                        @if (auth()->user()->role == 2)
                            <li class="nav-item cta cta-colored"><a href="{{ route('index-keranjang') }}"
                                    class="nav-link"><span class="icon-shopping_cart"
                                        id="total_keranjang">[{{ $data['keranjang']->count() }}]</span></a></li>
                        @endif

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" id="dropdown04" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false">Hi, {{ auth()->user()->name }}</a>

                            <div class="dropdown-menu" aria-labelledby="dropdown04">
                                @if (auth()->user()->role == 2)
                                    <a class="dropdown-item nav-link nav-link2"
                                        href="{{ route('index-profile') }}">Profile</a>
                                    <a class="dropdown-item nav-link nav-link2" href="{{ route('pesanan.index') }}">Pesanan
                                        Saya</a>
                                @endif

                                <a class="dropdown-item nav-link nav-link2" href="{{ route('logout') }}">LogOut</a>
                            </div>
                        </li>
                    @else
                        <li class="nav-item"><a href="{{ route('index-login') }}" class="nav-link">Login</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->

    @yield('data')

    <footer class="ftco-footer bg-light ftco-section">
        <div class="container">
            <div class="row">
                <div class="mouse">
                    <a href="#" class="mouse-icon">
                        <div class="mouse-wheel"><span class="ion-ios-arrow-up"></span></div>
                    </a>
                </div>
            </div>
            <div class="row mb-5">
                <div class="col-md">
                    <div class="ftco-footer-widget mb-0">
                        <h2 class="ftco-heading-2">UD Adi Alam Bagus</h2>
                        <p>
                            UD. Adi Alam Bagus adalah sebuah toko yang bergerak dibidang penjualan batu alam
                        </p>
                        <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                            {{-- <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li> --}}
                            <li class="ftco-animate"><a href="http://www.facebook.com/AlamBagus" target="blank"><span
                                        class="icon-facebook"></span></a></li>
                            <li class="ftco-animate"><a href="https://instagram.com/ud.adialambagus"
                                    target="blank"><span class="icon-instagram"></span></a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4 ml-md-5">
                        <h2 class="ftco-heading-2">Menu</h2>
                        <ul class="list-unstyled">
                            <li><a href="{{ route('halaman-utama') }}" class="py-2 d-block">Home</a></li>
                            <li><a href="{{ route('data-tentang') }}" class="py-2 d-block">Tentang</a></li>
                            <li><a href="{{ route('data-produk') }}" class="py-2 d-block">Produk</a></li>
                            <li><a href="{{ route('data-kontak') }}" class="py-2 d-block">Kontak</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                        <h2 class="ftco-heading-2">Punya Pertanyaan?</h2>
                        <div class="block-23 mb-3">
                            <ul>
                                <li>
                                    <a target="blank" href="http://maps.google.com/?q=Raya Denpasar - Gilimanuk ">
                                        <span class="icon icon-map-marker"></span><span class="text"> Raya Denpasar
                                            -
                                            Gilimanuk, Mengwitani, Kecamatan Mengwi, Kabupaten Badung</span>
                                    </a>
                                </li>
                                <li class="mt-2">
                                    <a target="blank" href="https://wa.me/081916465680">
                                        <span class="icon icon-phone"></span>
                                        <span class="text">081916465680</span>
                                    </a>
                                </li>
                                <li>
                                    {{-- <a href="mailto:alambagusudadi@gmail.com"> --}}
                                    <a target="blank"
                                        href="https://mail.google.com/mail/u/0/?view=cm&fs=1&tf=1&to=alambagusudadi@gmail.com">
                                        <span class="icon icon-envelope"></span>
                                        <span class="text">alambagusudadi@gmail.com</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">

                    <p>
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;
                        <script>
                            document.write(new Date().getFullYear());
                        </script> UD Adi Alam Bagus
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Modal  -->
    <div class="modal fade" id="Modal" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        aria-labelledby="modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"></h5>
                    <button type="button" class="btn btn-close text-dark bg-transparent" data-bs-dismiss="modal"
                        aria-label="Close">
                        X
                    </button>
                </div>
                <div class="modal-body" id="data_modal">
                </div>
            </div>
        </div>
    </div>{{-- End Modal   --}}


    <!-- loader -->
    <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px">
            <circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke="#eeeeee" />
            <circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4"
                stroke-miterlimit="10" stroke="#F96D00" />
        </svg></div>


    <script src="{{ asset('assets_pembeli/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets_pembeli/js/jquery-migrate-3.0.1.min.js') }}"></script>
    <script src="{{ asset('assets_pembeli/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets_pembeli/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets_pembeli/js/jquery.easing.1.3.js') }}"></script>
    <script src="{{ asset('assets_pembeli/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets_pembeli/js/jquery.stellar.min.js') }}"></script>
    <script src="{{ asset('assets_pembeli/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets_pembeli/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets_pembeli/js/aos.js') }}"></script>
    <script src="{{ asset('assets_pembeli/js/jquery.animateNumber.min.js') }}"></script>
    <script src="{{ asset('assets_pembeli/js/bootstrap-datepicker.js') }}"></script>
    <script src="{{ asset('assets_pembeli/js/scrollax.min.js') }}"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
    <script src="{{ asset('assets_pembeli/js/main.js') }}"></script>
    <script src="{{ asset('jquery/ajax.moment.min.js') }}"></script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.3.1/js/all.js"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });


        });

        function Modal(href, size, title) {
            $.get(href, {}, function(data, status) {
                $("#data_modal").html(data);
                var modal = $("#Modal").modal({
                    show: true,
                });

                if (modal.find('.modal-dialog').hasClass("modal-md")) {
                    modal.find('.modal-dialog').removeClass("modal-md");
                } else if (modal.find('.modal-dialog').hasClass("modal-sm")) {
                    modal.find('.modal-dialog').removeClass("modal-sm")
                } else if (modal.find('.modal-dialog').hasClass("modal-lg")) {
                    modal.find('.modal-dialog').removeClass("modal-lg")
                } else if (modal.find('.modal-dialog').hasClass("modal-xl")) {
                    modal.find('.modal-dialog').removeClass("modal-xl")
                }
                modal.find('.modal-dialog').addClass(size);
                modal.find('.modal-title').html(title);

                $('.btn-close').click(function(e) {
                    $("#Modal").modal('hide');

                });
            });
        }

        function FormatRupiah(angka, prefix) {
            var number_string = angka.toString().replace(/[^,\d]/g, '').toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        function konfirmasi(url, text, function_data) {
            Swal.fire({
                title: 'Apakah Anda Yakin!?',
                text: text,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: "Tidak!",
            }).then((result) => {
                if (result.isConfirmed) {
                    $.get(url, {}, function(data, status) {
                        if (function_data == "keranjang") {
                            data_keranjang();
                            $("#total_keranjang").html('[' + FormatRupiah(data.jumlah) + ']');
                            $(".total_keranjang").html(FormatRupiah(data.total, 'Rp '));

                            if (data.jumlah == 0) {
                                $('.btn-checkout').prop('disabled', true);
                            } else {
                                $('.btn-checkout').prop('disabled', false);
                            }
                        }
                    });
                }
            })
        }

        function sweet_alert_notifikasi(judul, teks, type) {
            Swal.fire(
                judul,
                teks,
                type
            )
        }


        function batal_pesanan(href) {
            Swal.fire({
                title: 'Peringatan!',
                text: 'Apakah Anda Yakin Untuk Membatalkan Pesanan Ini!?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: "Tidak!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Modal(href, 'modal-md', 'Batalkan Pesanan!');
                }
            })
        }

        Object.defineProperty(String.prototype, 'capitalize', {
            value: function() {
                return this.charAt(0).toUpperCase() + this.slice(1);
            },
            enumerable: false
        });

        function previewImage() {
            const image = document.querySelector('#formFile');
            const imgPreview = document.querySelector('.img-preview')
            const oFReader = new FileReader();

            const file = image.files[0];
            const fileSizeInMB = file.size / (1024 * 1024); // konversi dari byte ke MB

            if (fileSizeInMB > 2) {
                oFReader.onload = function(oFREvent) {

                    imgPreview.removeAttribute('src');
                    imgPreview.src = "{{ asset('/image/default.png') }}";
                }
                $('#file-chosen').html('Tidak ada file yang dipilih');
                $('#formFile').val('');
                sweet_alert_notifikasi('Peringatan!', 'Upload Gambar Dibawah 2mb!', 'warning')
                image.value = ''; // reset nilai input file
            } else {
                oFReader.readAsDataURL(image.files[0]);
                oFReader.onload = function(oFREvent) {
                    imgPreview.removeAttribute('src');
                    imgPreview.src = oFREvent.target.result;
                }
                $('#file-chosen').html(image.files[0].name);
            }

        }

        function file_form() {
            $('.alert-gambar').css('border-color', '');

            $('#formFile').click();

        }

        if ('{{ session()->has('success') }}') {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 5500,

            })
        } else if ('{{ session()->has('warning') }}') {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: '{{ session('warning') }}',
                showConfirmButton: false,
                timer: 5500,

            })
        } else if ('{{ session()->has('error') }}') {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: '{{ session('error') }}',
                showConfirmButton: false,
                timer: 5500,

            })
        }

        function bukti_penerima(foto) {
            console.log(foto);
            Swal.fire({
                title: 'Bukti Penerima',
                imageUrl: foto,
                imageWidth: 500,
                imageHeight: 500,
                imageAlt: 'Custom image',
            })
        }

        function terima_pesanan(link) {
            var data = new FormData();
            data.append('status', 'terima_pesanan');
            data.append('_method', 'PUT');

            $.ajax({
                url: link,
                method: 'post',
                dataType: 'JSON',
                data: data,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log("huhu");
                    location.reload();
                }
            });
        }

        function pengembalian_barang(href) {
            Swal.fire({
                title: 'Peringatan!',
                text: 'Apakah Anda Yakin Untuk Pengembalian Barang!?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya',
                cancelButtonText: "Tidak!",
            }).then((result) => {
                if (result.isConfirmed) {
                    Modal(href, 'modal-md', 'Pengembalian Barang!');
                }
            })
        }

        function ucword(id, value) {

            value = value.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
            $('#' + id).val(value);

        }

        Object.defineProperty(String.prototype, 'capitalize', {
            value: function() {
                return this.charAt(0).toUpperCase() + this.slice(1);
            },
            enumerable: false
        });
    </script>
    @yield('javascript')
</body>

</html>

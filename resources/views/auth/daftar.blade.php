<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('image/favicon-logo.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('image/favicon-logo.png') }}">
    <title>
        Daftar || UD Adi Alam Bagus
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('../assets/css/nucleo-icons.css') }}" rel="stylesheet" />
    <link href="{{ asset('../assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="{{ asset('../assets/css/nucleo-svg.css') }}" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('../assets/css/soft-ui-dashboard.css?v=1.0.7') }}" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.min.css" rel="stylesheet">

</head>

<body class="">
    <!-- Navbar -->
    <nav
        class="navbar navbar-expand-lg position-absolute top-0 z-index-3 w-100 shadow-none my-3 navbar-transparent mt-4">
        <div class="container">
            <a class="navbar-brand font-weight-bolder ms-lg-0 ms-3 text-white" href="{{ route('halaman-utama') }}">
                UD Adi Alam Bagus
            </a>
            <button class="navbar-toggler shadow-none ms-2" type="button" data-bs-toggle="collapse"
                data-bs-target="#navigation" aria-controls="navigation" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon mt-2">
                    <span class="navbar-toggler-bar bar1"></span>
                    <span class="navbar-toggler-bar bar2"></span>
                    <span class="navbar-toggler-bar bar3"></span>
                </span>
            </button>
            <div class="collapse navbar-collapse" id="navigation">
                <ul class="navbar-nav mx-auto ms-xl-auto me-xl-7">
                </ul>
                <li class="nav-item d-flex align-items-center">
                    <a class="btn btn-round btn-sm mb-0 btn-outline-white me-2"
                        href="{{ route('halaman-utama') }}">Halaman Utama</a>
                </li>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->
    <main class="main-content  mt-0">
        <section class="min-vh-100 mb-8">
            <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg"
                style="background-image: url('../assets/img/curved-images/curved14.jpg');">
                <span class="mask bg-gradient-dark opacity-6"></span>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-5 text-center mx-auto">
                            <h1 class="text-white mb-2 mt-5">Selamat Datang!</h1>
                            <p class="text-lead text-white">Silahkan isi data dengan lengkap!</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row mt-lg-n10 mt-md-n11 mt-n10">
                    <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
                        <div class="card z-index-0">
                            <div class="card-header text-center pt-4">
                                <h5>Daftar</h5>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('daftar') }}" role="form text-left" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <input type="text" class="form-control" placeholder="Nama" aria-label="Nama"
                                            id="nama" name="nama" aria-describedby="email-addon"
                                            onkeyup="ucword('nama', this.value)"
                                            value="{{ session()->has('error_daftar') ? session('error_daftar')['name'] : '' }}"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="email" class="form-control" placeholder="Email" name="email"
                                            aria-label="Email" aria-describedby="email-addon"
                                            {{ session()->has('error_daftar') ? 'autofocus' : '' }} required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Password"
                                            name="password" id="password" aria-label="Password"
                                            onchange="cek_password('password')" aria-describedby="password-addon"
                                            value="{{ session()->has('error_daftar') ? session('error_daftar')['password'] : '' }}"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="password" class="form-control" placeholder="Konfirmasi Password"
                                            aria-label="Konfirmasi Password" id="konfirmasi_password"
                                            onchange="cek_password('konfirmasi_password')"
                                            value="{{ session()->has('error_daftar') ? session('error_daftar')['password'] : '' }}"
                                            aria-describedby="password-addon" required>
                                    </div>
                                    <div class="mb-3">
                                        <input type="number" class="form-control" placeholder="No WhatsApp"
                                            aria-label="No WhatsApp" name="no_wa" min="0"
                                            value="{{ session()->has('error_daftar') ? session('error_daftar')['no_wa'] : '' }}"
                                            required>
                                    </div>
                                    <div class="mb-3">
                                        <textarea name="alamat" class="form-control" cols="30" rows="10" placeholder="Alamat"
                                            style="height: 90px !important;" onkeyup="this.value = this.value.capitalize()" required>{{ session()->has('error_daftar') ? session('error_daftar')['alamat'] : '' }}</textarea>
                                    </div>
                                    <div class="text-center">
                                        <button type="submit"
                                            class="btn bg-gradient-dark w-100 my-4 mb-2">Daftar</button>
                                    </div>
                                    <p class="text-sm mt-3 mb-0">Sudah punya akun?
                                        <a href="{{ route('index-login') }}"
                                            class="text-info text-gradient font-weight-bold">Login</a>
                                    </p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- -------- START FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
        <footer class="footer py-5">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 mx-auto text-center mb-4 mt-2">
                        <a href="http://www.facebook.com/AlamBagus" target="_blank"
                            class="text-secondary me-xl-4 me-4">
                            <span class="text-lg fab fa-facebook"></span>
                        </a>
                        <a href="https://instagram.com/ud.adialambagus" target="_blank"
                            class="text-secondary me-xl-4 me-4">
                            <span class="text-lg fab fa-instagram"></span>
                        </a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-8 mx-auto text-center mt-1">
                        <p class="mb-0 text-secondary">
                            Copyright ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script> UD Adi Alam Bagus
                        </p>
                    </div>
                </div>
            </div>
        </footer>
        <!-- -------- END FOOTER 3 w/ COMPANY DESCRIPTION WITH LINKS & SOCIAL ICONS & COPYRIGHT ------- -->
    </main>
    <!--   Core JS Files   -->
    <script src="{{ asset('../assets/js/core/popper.min.js') }}""></script>
    <script src="{{ asset('../assets/js/core/bootstrap.min.js') }}""></script>
    <script src="{{ asset('../assets/js/plugins/perfect-scrollbar.min.js') }}""></script>
    <script src="{{ asset('../assets/js/plugins/smooth-scrollbar.min.js') }}""></script>
    <!-- Github buttons -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('../assets/js/soft-ui-dashboard.min.js?v=1.0.7') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.3/dist/sweetalert2.all.min.js"></script>

    <script>
        function cek_password(status) {

            let sumbit = $(':submit');
            var password = $('#password');
            var konfirmasi_password = $('#konfirmasi_password');
            sumbit.prop('disabled', true);
            password.css('border-color', '');
            konfirmasi_password.css('border-color', '');

            if (password.val() != konfirmasi_password.val() && password.val() != "" && konfirmasi_password.val() != "") {
                password.focus();

                password.val('');
                konfirmasi_password.val('');

                password.css('border-color', 'red');
                konfirmasi_password.css('border-color', 'red');
            }

            if (password.val() != "" && konfirmasi_password.val() != "" && password.val() == konfirmasi_password.val()) {
                sumbit.prop('disabled', false);
            }
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
    <script>
        $(window).on('beforeunload', function() {
            "{{ Session::forget('error_daftar') }}";
        });

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
    </script>
</body>

</html>

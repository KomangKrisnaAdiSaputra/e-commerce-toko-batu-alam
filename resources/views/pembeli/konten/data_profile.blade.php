@extends('pembeli.layouts.main')
@section('css')
    <style>
        .input-container {
            display: flex;
            flex-direction: column;
            width: 100%;
            max-width: 400px;
            margin: 0 auto;
        }

        label {
            margin-bottom: 10px;
            font-size: 16px;
            font-weight: bold;
        }

        .password-input-wrapper {
            position: relative;
        }

        .style-input-pass {
            padding: 10px 50px 10px 20px;
            border: 1px solid #ccc;
            outline: none;
            font-size: 16px;
            width: 105%;
        }

        .eye-icon {
            position: absolute;
            top: 50%;
            right: 5px;
            transform: translateY(-50%);
            font-size: 20px;
            color: #aaa;
            cursor: pointer;
        }

        @media (max-width: 768px) {
            .input-container {
                max-width: 100%;
                padding: 0 20px;
            }
        }

        .style-input-pass:focus {
            border-color: #000000;
        }

        .style-input-pass::placeholder {
            color: #ccc;
        }
    </style>
@endsection
@section('data')
    <div class="hero-wrap hero-bread" style="background-image: url('assets_pembeli/images/bg_6.jpg');">
        <div class="container">
            <div class="row no-gutters slider-text align-items-center justify-content-center">
                <div class="col-md-9 ftco-animate text-center">
                    <p class="breadcrumbs"><span class="mr-2">Halaman Profile</span>
                    </p>
                    <h1 class="mb-0 bread">Profile Saya</h1>
                </div>
            </div>
        </div>
    </div>

    <section class="ftco-section contact-section bg-light">
        <div class="container">
            <div class="row block-9">
                <div class="col-md-12 order-md-last d-flex">
                    <form action="{{ route('update-profile') }}" method="POST" enctype="multipart/form-data"
                        class="bg-white p-5 contact-form">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-4" style="padding-right: 0 !important;">
                                <label for="name">Nama</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    onkeyup="ucword('name', this.value)" value="{{ $data['user']->tb_user->name }}"
                                    placeholder="Masukkan Nama" autocomplete='off' required>
                            </div>

                            <div class="form-group col-md-4" style="padding-right: 0 !important;">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" value="{{ $data['user']->tb_user->email }}"
                                    id="email" name="email" placeholder="Masukkan Email" autocomplete='off' required>
                            </div>
                            <div class="form-group col-md-4" style="padding-right: 0 !important;">
                                <label for="no_wa">No WhatsApp</label>
                                <input type="number" min="0" class="form-control" value="{{ $data['user']->no_wa }}"
                                    id="no_wa" name="no_wa" placeholder="Masukkan no WhatsApp" autocomplete='off'
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 input-container">
                                <label for="password_lama">Password Lama</label>
                                <div class="password-input-wrapper">
                                    <input type="password" id="password_lama" name="password_lama" class="style-input-pass"
                                        placeholder="Masukkan Password Lama" onkeyup="myFunction()">
                                    <i class="fa fa-eye-slash eye-icon" onclick="togglePassword('password_lama')"></i>
                                </div>
                            </div>
                            <div class="col-md-4 input-container">
                                <label for="password_baru">Password Baru</label>
                                <div class="password-input-wrapper">
                                    <input type="password" id="password_baru" name="password_baru" class="style-input-pass"
                                        placeholder="Masukkan Password Baru" onkeyup="myFunction()">
                                    <i class="fa fa-eye-slash eye-icon" onclick="togglePassword('password_baru')"></i>
                                </div>
                            </div>
                            <div class="col-md-4 input-container">
                                <label for="konfirmasi_password">Konfirmasi Password</label>
                                <div class="password-input-wrapper">
                                    <input type="password" id="konfirmasi_password" name="konfirmasi_password"
                                        class="style-input-pass" placeholder="Konfirmasi Password Baru"
                                        onkeyup="myFunction()">
                                    <i class="fa fa-eye-slash eye-icon" onclick="togglePassword('konfirmasi_password')"></i>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="alamat">Alamat</label>
                                <textarea name="alamat" id="alamat" cols="30" rows="7" class="form-control" placeholder="Masukkan Alamat"
                                    onkeyup="this.value = this.value.capitalize()" required>{{ $data['user']->alamat }}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary py-3 px-5" id="btn-sumbit">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('javascript')
    <script>
        function togglePassword(status) {
            const passwordInput = document.getElementById(status);
            const eyeIcon = document.querySelector('.eye-icon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            }
        }

        function myFunction() {
            const password_lama = document.getElementById('password_lama');
            const password_baru = document.getElementById('password_baru');
            const konfirmasi_password = document.getElementById('konfirmasi_password');

            if (password_lama.value != "" || password_baru.value != "" || konfirmasi_password.value != "") {
                password_lama.required = true;
                password_baru.required = true;
                konfirmasi_password.required = true;
            } else {
                password_lama.required = false;
                password_baru.required = false;
                konfirmasi_password.required = false;
            }

            if (password_baru.value === konfirmasi_password.value) {
                $(":submit").attr("disabled", false);
            } else {
                $(":submit").attr("disabled", true);
            }
        }
    </script>
@endsection

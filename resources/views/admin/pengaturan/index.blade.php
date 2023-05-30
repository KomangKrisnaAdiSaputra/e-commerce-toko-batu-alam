@extends('admin.layouts.main')
@section('css')
    <style>
        .password-toggle {
            position: relative;
        }

        .password-toggle i {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translate(0, -50%);
            cursor: pointer;
            z-index: 99;
        }
    </style>
@endsection
@section('breadcrumb')
    <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
        <li class="breadcrumb-item text-sm">Pengaturan</li>
        <li class="breadcrumb-item text-sm text-dark active" aria-current="page">{{ $data['title_breadcrumb'] }}</li>
    </ol>
@endsection
@section('data')
    <div class="row">
        <div class="col-12">
            <div class="card mb-4">
                <div class="card-header pb-0">
                    <h6>Tabel Data {{ $data['title_breadcrumb'] }} </h6>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('update-akun') }}">
                        @csrf
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name">Nama User</label>
                                <input type="text" class="form-control" id="name" name="name"
                                    onkeyup="ucword('name', this.value)" value="{{ auth()->user()->name }}"
                                    placeholder="Masukkan Nama User" autocomplete='off' required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email"
                                    placeholder="Masukkan Email User" value="{{ auth()->user()->email }}" autocomplete='off'
                                    required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="password_lama">Password Lama</label>
                                <div class="input-group password-toggle">
                                    <input type="password" class="form-control" id="password_lama" name="password_lama"
                                        placeholder="Masukkan Password Lama" onkeyup="myFunction()">
                                    <i class="fa fa-eye-slash password-toggle-icon"
                                        onclick="togglePassword('password_lama')"></i>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="password_baru">Password Baru</label>
                                <div class="input-group password-toggle">
                                    <input type="password" class="form-control" id="password_baru" name="password_baru"
                                        placeholder="Masukkan Password Baru" onkeyup="myFunction()">
                                    <i class="fa fa-eye-slash password-toggle-icon"
                                        onclick="togglePassword('password_baru')"></i>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="konfirmasi_password">Konfirmasi Password</label>
                                <div class="input-group password-toggle">
                                    <input type="password" class="form-control" id="konfirmasi_password"
                                        name="konfirmasi_password" placeholder="Konfirmasi Password" onkeyup="myFunction()">
                                    <i class="fa fa-eye-slash password-toggle-icon"
                                        onclick="togglePassword('konfirmasi_password')"></i>
                                </div>
                            </div>
                        </div>
                        <hr style="border: 1px solid rgb(0, 0, 0);border-radius: 5px; " class="pb-0 mt-4">
                        <button type="submit" class="btn btn-info">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('javascript')
    <script>
        function togglePassword(status) {
            const passwordInput = document.getElementById(status);
            const eyeIcon = document.querySelector('.password-toggle-icon');

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

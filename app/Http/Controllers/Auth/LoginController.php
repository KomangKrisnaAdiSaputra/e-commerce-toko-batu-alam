<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailDaftar;
use App\Mail\EmailLupaPassword;
use App\Models\TbDetailPembeli;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }


    public function index_daftar()
    {
        $data_user = array(
            'name' => '',
            'email' => '',
            'password' => ''
        );

        $data_detail_pembeli = array(
            'no_wa' => '',
            'alamat' => ''
        );

        return view('auth.daftar', compact('data_user', 'data_detail_pembeli'));
    }

    public function index_lupa_password()
    {
        return view('auth.lupa_password');
    }

    public function index_reset_password($remember_token)
    {
        $user = User::where('remember_token', $remember_token)->first();

        if ($user != null) {
            return view('auth.reset_password', compact('user'));
        } else {
            return redirect()->route('index-login');
        }
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($user == null) {
            session()->flash('error', 'Email Tidak Ditemukan!');
            return redirect()->route('index-login');
        } else {
            if (Auth::attempt($request->only('email', 'password'))) {
                if (auth()->user()->status == 0) {
                    session()->flash('error', 'Akun Anda Sudah Tidak Aktif!');
                    return redirect()->route('index-login');
                } elseif (auth()->user()->status == 1) {
                    if (auth()->user()->role == 1) {
                        session()->flash('success', 'Login Sukses!');
                        return redirect()->route('dashboard.index');
                    } elseif (auth()->user()->role == 2) {
                        return redirect()->route('halaman-utama');
                    } elseif (auth()->user()->role == 3) {
                        session()->flash('success', 'Login Sukses!');
                        return redirect()->route('index-verifikasi');
                    }
                } elseif (auth()->user()->status == 2) {
                    session()->flash('error', 'Akun Anda Belum Di Verifikasi!');
                    return redirect()->route('index-login');
                }
            } else {
                session()->flash('error', 'Password Salah!');
                return redirect()->route('index-login');
            }
        }
    }

    public function daftar(Request $request)
    {
        $data_user = array(
            'name' => $request->nama,
            'email' => $request->email,
            'password' => $request->password,
            'role' => 2,
            'status' => 2
        );

        $data_detail_pembeli = array(
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat
        );

        if (User::where('email', $request->email)->first() != null) {
            $data_daftar = array_merge($data_user, $data_detail_pembeli);
            session()->flash('error', 'Email Sudah Digunakan!');
            session(['error_daftar' => $data_daftar]);

            return redirect()->route('index-daftar');
        }

        $email = $request->email;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=" . $email,
            CURLOPT_HTTPHEADER => array(
                "Content-Type: text/plain",
                "apikey: EOtvATgtzZtsv7oFJLL43lg5q6tb6edD"
            ),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET"
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($response, true);

        if ($data['smtp_check'] == true) {
            Mail::to($email)->send(new EmailDaftar($email));
            session()->flash('success', 'Berhasil Daftar, Silahkan Lihat Email Anda!');
        } else {
            $data_daftar = array_merge($data_user, $data_detail_pembeli);
            session()->flash('error', 'Email Tidak Valid!');
            session(['error_daftar' => $data_daftar]);

            return redirect()->route('index-daftar');
        }
        $data_user['password'] = Hash::make($request->password);
        $user = User::create($data_user);
        $data_detail_pembeli['id_user'] = $user->id;

        TbDetailPembeli::create($data_detail_pembeli);
        return redirect()->route('index-login');
    }

    public function verifikasi($email)
    {
        $data = User::where('email', $email)->first();
        if ($data != null) {
            if ($data->email_verified_at == null) {

                User::find($data->id)->update([
                    'email_verified_at' => Carbon::now(),
                    'status' => 1
                ]);
                session()->flash('success', 'Data Berhasil Diverifikasi');
            } else {
                if ($data->status == 1) {
                    session()->flash('warning', 'Akun Sudah Diverifikasi');
                } elseif ($data->status == 0) {
                    session()->flash('error', 'Akun Sudah Tidak Aktif');
                }
            }
        } else {
            session()->flash('error', 'Akun Tidak Ditemukan!');
        }

        return redirect()->route('index-login');
    }

    public function lupa_password(Request $request)
    {
        $email = $request->email;

        $user = User::where('email', $email)->first();
        if ($user != null) {

            if ($user->status == 1) {
                $token = Str::random(30);
                if (User::where('remember_token', $token)->get()->count() == 0) {
                    $remember_token = $token;
                } else {
                    $remember_token = Str::random(30);
                }
                User::find($user->id)->update([
                    'remember_token' => $remember_token,
                ]);
                Mail::to($email)->send(new EmailLupaPassword($remember_token));
                session()->flash('success', 'Silahkan Lihat Email Anda!');
            } elseif ($user->status == 0) {
                session()->flash('error', 'Akun Sudah Tidak Aktif');
            }
        } else {

            session()->flash('error', 'Email Tidak Ditemukan');
            return redirect()->route('index-lupa-password');
        }
        return redirect()->route('index-login');
    }

    public function reset_password(Request $request, $id)
    {
        $user = User::find($id);
        $token = Str::random(30);
        if ($token == $user->remember_token || User::where('remember_token', $token)->get()->count() > 0) {
            $remember_token = Str::random(30);
        } else {
            $remember_token = $token;
        }

        $user->update([
            'password' => Hash::make($request->password),
            'remember_token' => $remember_token
        ]);

        session()->flash('success', 'Password Berhasil Direset!');
        return redirect()->route('index-login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('index-login');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TbDetailPembeli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserManajemenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Data User',
            'data_user' => User::whereNot('role', 2)->whereNot('id', auth()->user()->id)->OrderByDesc('status')->OrderByDesc('id')->get(),
            'data_pembeli' => TbDetailPembeli::join('tb_user', 'tb_user.id', '=', 'tb_detail_pembeli.id_user')
                ->where('tb_user.role', 2)
                ->orderByDesc('tb_user.status')->orderByDesc('tb_detail_pembeli.tanggal_transaksi_terakhir')->orderByDesc('tb_user.id')
                ->get()
        ];
        // dd($data['data_pembeli']);
        return view('admin.user-manajemen.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user-manajemen.form.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cek_email = User::where('email', $request->email)->get();

        if ($cek_email->count() > 0) {
            session()->flash('error', 'Email Sudah Digunakan!');
            return redirect()->route('user-manajemen.index');
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=" . $request->email,
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

        if ($data['smtp_check'] == false) {
            session()->flash('error', 'Email Tidak Valid!');
            return redirect()->route('user-manajemen.index');
        }

        User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => Hash::make('12345'),
            'role' => 3,
            'status' => 1
        ]);

        session()->flash('success', 'User Berhasil DiTambah!');
        return redirect()->route('user-manajemen.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            'user' => User::find($id),
            'detail_pembeli' => TbDetailPembeli::where('id_user', $id)->first()
        ];
        return view('admin.user-manajemen.detail.detail_user', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = User::find($id);
        return view('admin.user-manajemen.form.edit', compact('data', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = User::find($id);
        $cek_email = User::whereNot('email', $data->email)->where('email', $request->email)->get();

        if ($cek_email->count() > 0) {
            session()->flash('error', 'Email Sudah Digunakan!');
            return redirect()->route('user-manajemen.index');
        }
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=" . $request->email,
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

        if ($data['smtp_check'] == false) {
            session()->flash('error', 'Email Tidak Valid!');
            return redirect()->route('user-manajemen.index');
        }

        $data->update([
            'name' => $request->nama,
            'email' => $request->email,
        ]);

        if ($request->reset_pass != null) {
            $data->update(['password' => Hash::make('12345')]);
        }
        session()->flash('success', 'User Berhasil DiEdit!');
        return redirect()->route('user-manajemen.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cek_email($value)
    {
        $data = User::where('email', 'LIKE', '%' . $value . '%')->get()->count();
        return response()->json($data);
    }

    public function ganti_status($id)
    {
        $user = User::find($id);

        $status = ($user->status == 1) ?  0 :  1;

        $user->update(['status' => $status]);

        session()->flash('success', 'Status Berhasil Diubah!');
        return redirect()->route('user-manajemen.index');
    }

    public function pengaturan_akun()
    {
        $data = [
            'title' => 'Data Akun',
            'title_breadcrumb' => 'Akun',
        ];

        return view('admin.pengaturan.index', compact('data'));
    }

    public function update_akun(Request $request)
    {
        $data_user = User::find(auth()->user()->id);

        $cek_email = User::whereNot('email', auth()->user()->email)->where('email', $request->email)->get();

        if ($cek_email->count() > 0) {
            session()->flash('error', 'Email Sudah Digunakan!');
            return redirect()->route('index-pengaturan-akun');
        }

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.apilayer.com/email_verification/check?email=" . $request->email,
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

        if ($data['smtp_check'] == false) {
            session()->flash('error', 'Email Tidak Valid!');
            return redirect()->route('index-pengaturan-akun');
        }

        $data_baru = [
            'name' => $request->name,
            'email' => $request->email
        ];

        if ($request->password_lama != null) {
            if (password_verify($request->password_lama, auth()->user()->password)) {
                $password_baru = Hash::make($request->password_baru);
                $data_baru['password'] = $password_baru;
            } else {
                session()->flash('error', 'Password Lama Salah!');
                return redirect()->route('index-pengaturan-akun');
            }
        }

        $data_user->update($data_baru);
        session()->flash('success', 'Akun Berhasil Diubah!');
        return redirect()->route('index-pengaturan-akun');
    }
}

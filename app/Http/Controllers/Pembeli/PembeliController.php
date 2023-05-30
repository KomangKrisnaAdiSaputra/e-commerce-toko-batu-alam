<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Mail\EmailPesananMasuk;
use App\Models\TbBarang;
use App\Models\TbDetailPembeli;
use App\Models\TbDetailTransaksi;
use App\Models\TbKeranjang;
use App\Models\TbTransaksi;
use App\Models\TbUkuran;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Intervention\Image\Facades\Image as ResizeImage;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PembeliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = (auth()->user() == null) ? 0 : auth()->user()->id;
        $data = [
            'keranjang' => TbKeranjang::where('id_user', $id)->get(),
            'produk' => TbBarang::where('status', 1)->OrderByDesc('id')->inRandomOrder()->limit(4)->get(),
            'produk_terbaru' => TbBarang::where([['status', '=', 1], ['total_terjual', '>', 10]])->OrderByDesc('total_terjual')->take(2)->get(),
            'total_produk' => TbBarang::where('status', 1)->get()->count(),
            'total_pesanan' => TbTransaksi::where('status', 1)->get()->sum('total_pembelian'),
            'total_transaksi' => TbTransaksi::where('status', 1)->get()->count(),
            'total_pembeli' => User::where('role', 2)->get()->count(),
        ];
        $harga = [];

        foreach ($data['produk'] as $key => $value) {
            $ukuran = TbUkuran::where('id_barang', $value->id)->orderBy('harga', 'ASC')->get();

            if ($ukuran->count() > 1) {
                $array_number = $ukuran->count() - 1;
                $harga_ukuran = 'Rp ' . number_format($ukuran[0]->harga, 0, ',', '.') . ' - ' . number_format($ukuran[$array_number]->harga, 0, ',', '.');
            } elseif ($ukuran->count() == 1) {
                $harga_ukuran = 'Rp ' . number_format($ukuran[0]->harga, 0, ',', '.');
            }

            $harga[] = $harga_ukuran;
        }
        return view('pembeli.index', compact('data', 'harga'));
    }

    public function data_produk()
    {
        $id = (auth()->user() == null) ? 0 : auth()->user()->id;

        $data = [
            'data_barang' => TbBarang::where('status', 1)->OrderByDesc('id')->paginate(6),
            'keranjang' => TbKeranjang::where('id_user', $id)->get()
        ];
        $harga = [];
        foreach ($data['data_barang'] as $key => $value) {
            $ukuran = TbUkuran::where('id_barang', $value->id)->orderBy('harga', 'ASC')->get();

            if ($ukuran->count() > 1) {
                $array_number = $ukuran->count() - 1;
                $harga_ukuran = 'Rp ' . number_format($ukuran[0]->harga, 0, ',', '.') . ' - ' . number_format($ukuran[$array_number]->harga, 0, ',', '.');
            } elseif ($ukuran->count() == 1) {
                $harga_ukuran = 'Rp ' . number_format($ukuran[0]->harga, 0, ',', '.');
            }

            $harga[] = $harga_ukuran;
        }

        return view('pembeli.produk.data_produk', compact('data', 'harga'));
    }

    public function data_produk_paginate(Request $request)
    {
        $id = (auth()->user() == null) ? 0 : auth()->user()->id;

        if ($request->ajax()) {
            $data = [
                'data_barang' => TbBarang::where('status', 1)->OrderByDesc('id')->paginate(6),
                'keranjang' => TbKeranjang::where('id_user', $id)->get()
            ];
            $harga = [];

            foreach ($data['data_barang'] as $key => $value) {
                $ukuran = TbUkuran::where('id_barang', $value->id)->orderBy('harga', 'ASC')->get();

                if ($ukuran->count() > 1) {
                    $array_number = $ukuran->count() - 1;
                    $harga_ukuran = 'Rp ' . number_format($ukuran[0]->harga, 0, ',', '.') . ' - ' . number_format($ukuran[$array_number]->harga, 0, ',', '.');
                } elseif ($ukuran->count() == 1) {
                    $harga_ukuran = 'Rp ' . number_format($ukuran[0]->harga, 0, ',', '.');
                }

                $harga[] = $harga_ukuran;
            }
            return view('pembeli.produk.paginate', compact('data', 'harga'))->render();
        }
    }

    public function data_tentang()
    {
        $id = (auth()->user() == null) ? 0 : auth()->user()->id;
        $data = [
            'keranjang' => TbKeranjang::where('id_user', $id)->get(),
            'total_produk' => TbBarang::where('status', 1)->get()->count(),
            'total_pesanan' => TbTransaksi::where('status', 1)->get()->sum('total_pembelian'),
            'total_transaksi' => TbTransaksi::where('status', 1)->get()->count(),
            'total_pembeli' => User::where('role', 2)->get()->count(),
        ];
        return view('pembeli.konten.data_tentang', compact('data'));
    }

    public function data_kontak()
    {
        $id = (auth()->user() == null) ? 0 : auth()->user()->id;
        $data = [
            'keranjang' => TbKeranjang::where('id_user', $id)->get(),
        ];
        return view('pembeli.konten.data_kontak', compact('data'));
    }

    public function keranjang_pembeli()
    {

        $data = [
            'keranjang' => TbKeranjang::where('id_user', auth()->user()->id)->get()
        ];
        return view('pembeli.keranjang.keranjang_pembeli', compact('data'));
    }

    public function data_keranjang()
    {
        $data = TbKeranjang::with('tb_user', 'tb_barang', 'tb_ukuran')->where('id_user', auth()->user()->id)->get()->sortByDesc('updated_at')->sortByDesc('tb_ukuran.stok');
        return view('pembeli.keranjang.data_keranjang', compact('data'));
    }

    public function tambah_keranjang($id, $status)
    {
        $data = [
            'barang' => TbBarang::find($id),
            'ukuran' => TbUkuran::where('id_barang', $id)->orderBy('harga', 'ASC')->get(),
            'status' => $status
        ];
        return view('pembeli.keranjang.tambah_keranjang', compact('data', 'id'));
    }

    public function data_ukuran($id)
    {
        $data = TbUkuran::find($id);
        return response()->json($data);
    }

    public function simpan_keranjang($barang, $ukuran, $jumlah, $status)
    {
        $hasil = "";
        $tb_ukuran = TbUkuran::find($ukuran);
        if ($status == "keranjang") {
            $tb_keranjang = TbKeranjang::where([['id_user', '=', auth()->user()->id], ['id_barang', '=', $barang], ['id_ukuran', '=', $ukuran]])->first();

            if ($tb_ukuran->stok > 0) {
                if ($tb_keranjang == null) {
                    TbKeranjang::create([
                        'id_user' => auth()->user()->id,
                        'id_barang' => $barang,
                        'id_ukuran' => $ukuran,
                        'jumlah' => $jumlah,
                        'status' => 0
                    ]);
                } else {
                    $jumlah_baru = $tb_keranjang->jumlah + $jumlah;
                    $cek_jumlah = ($jumlah_baru > $tb_ukuran->stok) ? $tb_ukuran->stok : $jumlah_baru;

                    TbKeranjang::find($tb_keranjang->id)->update([
                        'jumlah' => $cek_jumlah
                    ]);
                }

                $hasil = TbKeranjang::where('id_user', auth()->user()->id)->get()->count();
            } else {
                $hasil = 0;
            }
        } elseif ($status == "beli sekarang") {
            if ($tb_ukuran->stok > 0) {
                $hasil = route('checkout', Crypt::encrypt('beli_sekarang:' . $ukuran . ':' . $jumlah));
            } else {
                $hasil = 0;
            }
        }

        return response()->json($hasil);
    }

    public function total($id)
    {
        if ($id == 0) {
            $data_keranjang = TbKeranjang::with('tb_ukuran')->where([['id_user', '=', auth()->user()->id], ['status', '=', 1]])->get();
            foreach ($data_keranjang as $key => $value) {
                TbKeranjang::find($value->id)->update(['status' => 0]);
            }
            $total = 0;
        } else {

            $tb_keranjang = TbKeranjang::find($id);

            $status = ($tb_keranjang->status == 0) ? 1 : 0;

            $tb_keranjang->update(['status' => $status]);
            $data_keranjang = TbKeranjang::with('tb_ukuran')->where([['id_user', '=', auth()->user()->id], ['status', '=', 1]])->get();

            foreach ($data_keranjang as $key => $value) {
                $sub_total[] = $value->tb_ukuran->harga * $value->jumlah;
            }
            $sub_total = ($data_keranjang->count() == 0) ? [0] : $sub_total;
            $total = array_sum($sub_total);
        }

        return response()->json($total);
    }

    public function hapus_keranjang($id)
    {
        TbKeranjang::find($id)->delete();
        $data_keranjang = TbKeranjang::with('tb_ukuran')->where([['id_user', '=', auth()->user()->id], ['status', '=', 1]])->get();
        foreach ($data_keranjang as $key => $value) {
            $sub_total[] = $value->tb_ukuran->harga * $value->jumlah;
        }
        $sub_total = ($data_keranjang->count() == 0) ? [0] : $sub_total;
        $data = [
            'total' => $sub_total,
            'jumlah' => TbKeranjang::with('tb_ukuran')->where('id_user', auth()->user()->id)->get()->count()
        ];
        return response()->json($data);
    }

    public function jumlah($id, $jumlah)
    {
        TbKeranjang::find($id)->update(['jumlah' => $jumlah]);
        $data_keranjang = TbKeranjang::with('tb_ukuran')->where([['id_user', '=', auth()->user()->id], ['status', '=', 1]])->get();

        foreach ($data_keranjang as $key => $value) {
            $sub_total[] = $value->tb_ukuran->harga * $value->jumlah;
        }
        $sub_total = ($data_keranjang->count() == 0) ? [0] : $sub_total;
        $total = array_sum($sub_total);

        return response()->json($total);
    }

    public function checkout($status)
    {
        try {
            $decrypt = Crypt::decrypt($status);
            $id = auth()->user()->id;
            $cek_checkout = explode(':', $decrypt);
            $data_user = TbDetailPembeli::with('tb_user')->where('id_user', $id)->first();

            if ($cek_checkout[0] == 'keranjang') {

                $data_keranjang = TbKeranjang::with('tb_ukuran')->where([['id_user', '=', $id], ['status', '=', 1]])->get();
                foreach ($data_keranjang as $key => $value) {
                    $sub_total[] = $value->tb_ukuran->harga * $value->jumlah;
                }
                $sub_total = ($data_keranjang->count() == 0) ? [0] : $sub_total;
                $total = array_sum($sub_total);
                $id_ukuran = 0;
                $jumlah = 0;
            } else {
                $id_ukuran = $cek_checkout[1];
                $jumlah = $cek_checkout[2];
                $tb_ukuran = TbUkuran::find($id_ukuran);
                $total = $tb_ukuran->harga * $jumlah;
            }

            $data = [
                'keranjang' => TbKeranjang::where('id_user', $id)->get(),
                'user' => $data_user,
                'total' => $total,
                'status' => $cek_checkout[0],
                'id' => $id_ukuran,
                'jumlah' => $jumlah
            ];
            return view('pembeli.keranjang.halaman_checkout', compact('data'));
        } catch (\Exception $e) {

            return redirect()->route('halaman-utama');
        }
    }

    public function buat_pesanan(Request $request)
    {
        // Judul Kode Transaksi
        $huruf = "AB";

        // Date
        $tanggal = Carbon::now()->isoFormat('DDMMYYYY');

        // Time
        $waktu = explode(':', Carbon::now()->toTimeString());
        $transaksi = TbTransaksi::OrderByDesc('id')->get();
        // No Kode Transaksi
        if ($transaksi->count() == 0) {
            $urutan_kode_transaksi = 1;
        } else {
            $kode_transaksi = $transaksi[0]->kode_transaksi;
            $urutan_kode_transaksi =  substr($kode_transaksi, 14);
            $urutan_kode_transaksi++;
        }

        // No Kode Transaksi Baru
        $kode_transaksi_baru = $huruf . $tanggal . $waktu[0] . $waktu[1] . $urutan_kode_transaksi;
        $status = ($request->tipe_pembayaran == 'cod') ? 3 : 2;
        if ($request->status == "keranjang") {
            $data_keranjang = TbKeranjang::with('tb_barang', 'tb_ukuran')->where([['id_user', '=', auth()->user()->id], ['status', '=', 1]])->get();
            foreach ($data_keranjang as $key => $value) {
                $sub_total[] = $value->tb_ukuran->harga * $value->jumlah;
            }
            $sub_total = ($data_keranjang->count() == 0) ? [0] : $sub_total;
            $total = array_sum($sub_total);

            $data_transaksi = TbTransaksi::create([
                'id_user' => auth()->user()->id,
                'kode_transaksi' => $kode_transaksi_baru,
                'nama_pembeli' => $request->nama_pembeli,
                'no_wa_pembeli' => $request->no_wa,
                'alamat_pembeli' => $request->alamat,
                'total_pembelian' => $data_keranjang->sum('jumlah'),
                'total_harga' => $total,
                'tipe_pembayaran' => $request->tipe_pembayaran,
                'status' => $status,
                'tanggal_transaksi' => Carbon::now()
            ]);

            foreach ($data_keranjang as $key => $value) {
                TbDetailTransaksi::create([
                    'id_transaksi' => $data_transaksi->id,
                    'nama_barang' => $value->tb_barang->nama_barang,
                    'ukuran' => $value->tb_ukuran->ukuran,
                    'jumlah' => $value->jumlah,
                    'harga_barang' => $value->tb_ukuran->harga,
                    'total' => $value->tb_ukuran->harga * $value->jumlah,
                    'foto_barang' => $value->tb_barang->gambar
                ]);

                $cek_tb_ukuran = TbUkuran::find($value->id_ukuran);

                $cek_tb_ukuran->update([
                    'stok' => $cek_tb_ukuran->stok - $value->jumlah
                ]);

                $tb_barangg = TbBarang::find($cek_tb_ukuran->id_barang);
                $tb_barangg->update([
                    'total_terjual' => $tb_barangg->total_terjual + $value->jumlah
                ]);
                $gambar =  getcwd() . '/image/barang/' . $value->tb_barang->gambar;
                $path = getcwd() . '/image/transaksi/';

                !is_dir($path) &&
                    mkdir($path, 0777, true);
                ResizeImage::make($gambar)
                    ->resize(500, 500)
                    ->save($path . $value->tb_barang->gambar);

                TbKeranjang::find($value->id)->delete();
            }
        } elseif ($request->status == "beli_sekarang") {
            $tb_ukuran = TbUkuran::with('tb_barang')->find($request->id);
            $data_transaksi = TbTransaksi::create([
                'id_user' => auth()->user()->id,
                'kode_transaksi' => $kode_transaksi_baru,
                'nama_pembeli' => $request->nama_pembeli,
                'no_wa_pembeli' => $request->no_wa,
                'alamat_pembeli' => $request->alamat,
                'total_pembelian' => $request->jumlah,
                'total_harga' => $tb_ukuran->harga * $request->jumlah,
                'tipe_pembayaran' => $request->tipe_pembayaran,
                'status' => $status,
                'tanggal_transaksi' => Carbon::now()
            ]);

            TbDetailTransaksi::create([
                'id_transaksi' => $data_transaksi->id,
                'nama_barang' => $tb_ukuran->tb_barang->nama_barang,
                'ukuran' => $tb_ukuran->ukuran,
                'jumlah' => $request->jumlah,
                'harga_barang' => $tb_ukuran->harga,
                'total' => $tb_ukuran->harga * $request->jumlah,
                'foto_barang' =>  $tb_ukuran->tb_barang->gambar
            ]);

            $tb_ukuran->update([
                'stok' => $tb_ukuran->stok - $request->jumlah
            ]);
            $tb_barangg = TbBarang::find($tb_ukuran->id_barang);
            $tb_barangg->update([
                'total_terjual' => $tb_barangg->total_terjual + $request->jumlah
            ]);

            $gambar =  getcwd() . '/image/barang/' . $tb_ukuran->tb_barang->gambar;
            $path = getcwd() . '/image/transaksi/';

            !is_dir($path) &&
                mkdir($path, 0777, true);

            ResizeImage::make($gambar)
                ->resize(500, 500)
                ->save($path . $tb_ukuran->tb_barang->gambar);
        }
        $email = 'alambagusudadi@gmail.com';
        $data_email = [
            'tipe_pembayaran' => $request->tipe_pembayaran,
            'kode_transaksi' => $kode_transaksi_baru
        ];
        $detail_pembeli = TbDetailPembeli::where('id_user', auth()->user()->id)->first();
        TbDetailPembeli::find($detail_pembeli->id)->update(['tanggal_transaksi_terakhir' => Carbon::now()]);
        Mail::to($email)->send(new EmailPesananMasuk($data_email));
        return response()->json();
    }

    public function index_profile()
    {
        $data = [
            'keranjang' => TbKeranjang::where('id_user', auth()->user()->id)->get(),
            'user' => TbDetailPembeli::with('tb_user')->where('id_user', auth()->user()->id)->first()
        ];
        return view('pembeli.konten.data_profile', compact('data'));
    }

    public function update_profile(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $detail_user = TbDetailPembeli::where('id_user', auth()->user()->id)->first();
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

        if ($data['smtp_check'] == false) {
            session()->flash('error', 'Email Tidak Valid!');
            return redirect()->route('index-profile');
        }

        $data_user = array(
            'name' => $request->name,
            'email' => $request->email,
        );

        if ($request->input('password_lama')) {
            if (password_verify($request->password_lama, auth()->user()->password)) {
                $password_baru = Hash::make($request->password_baru);
                $data_user['password'] = $password_baru;
            } else {
                session()->flash('error', 'Password Lama Salah!');
                return redirect()->route('index-profile');
            }
        }

        $user->update($data_user);

        TbDetailPembeli::find($detail_user->id)->update([
            'alamat' => $request->alamat,
            'no_wa' => $request->no_wa,
        ]);

        return redirect()->route('index-profile');
    }

    public function centang_semua($status)
    {
        $status_transaksi = ($status == 'centang') ? 1 : 0;
        $data_keranjang = TbKeranjang::where('id_user', auth()->user()->id)->get();

        foreach ($data_keranjang as $key => $value) {
            TbKeranjang::find($value->id)->update(['status' => $status_transaksi]);
            $id_keranjang[] = $value->id;
        }

        $data_keranjang = TbKeranjang::with('tb_ukuran')->where([['id_user', '=', auth()->user()->id], ['status', '=', 1]])->get();

        foreach ($data_keranjang as $key => $value) {
            $sub_total[] = $value->tb_ukuran->harga * $value->jumlah;
        }
        $sub_total = ($data_keranjang->count() == 0) ? [0] : $sub_total;
        $total = array_sum($sub_total);

        $data = [
            'total' => $total,
            'status' => $status,
            'id_keranjang' => $id_keranjang
        ];

        return response()->json($data);
    }
}

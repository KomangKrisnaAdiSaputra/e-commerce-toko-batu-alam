<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TbDetailTransaksi;
use App\Models\TbTransaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as ResizeImage;

class TransaksiAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index_verifikasi()
    {
        $data = [
            'title' => 'Data Verifikasi',
            'title_breadcrumb' => 'Verifikasi',
            'transaksi' => TbTransaksi::where('status', 2)->OrderByDesc('id')->orderBy('updated_at', 'ASC')->get()
        ];

        return view('admin.transaksi.index', compact('data'));
    }

    public function index_dikemas()
    {
        $data = [
            'title' => 'Data Belum Dikemas',
            'title_breadcrumb' => 'Belum Dikemas',
            'transaksi' => TbTransaksi::where('status', 3)->OrderByDesc('id')->orderBy('updated_at', 'ASC')->get()
        ];

        return view('admin.transaksi.index', compact('data'));
    }

    public function index_dikirim()
    {
        $data = [
            'title' => 'Data Dikirim',
            'title_breadcrumb' => 'Dikirim',
            'transaksi' => TbTransaksi::where('status', 4)->OrderByDesc('id')->orderBy('updated_at', 'ASC')->get()
        ];

        return view('admin.transaksi.index', compact('data'));
    }

    public function index_selesai()
    {
        $data = [
            'title' => 'Data Selesai',
            'title_breadcrumb' => 'Selesai',
            'transaksi' => TbTransaksi::where('status', 1)->OrderByDesc('id')->orderBy('updated_at', 'ASC')->get()
        ];

        return view('admin.transaksi.index', compact('data'));
    }

    public function index_dibatalkan()
    {
        $data = [
            'title' => 'Data Dibatalkan',
            'title_breadcrumb' => 'Dibatalkan',
            'transaksi' => TbTransaksi::where('status', 0)->OrderByDesc('id')->orderBy('updated_at', 'ASC')->get()
        ];

        return view('admin.transaksi.index', compact('data'));
    }

    public function index_pengembalian()
    {
        $data = [
            'title' => 'Data Pengembalian',
            'title_breadcrumb' => 'Pengembalian',
            'transaksi' => TbTransaksi::where('status', 5)->OrderByDesc('id')->orderBy('updated_at', 'ASC')->get()
        ];

        return view('admin.transaksi.index', compact('data'));
    }

    public function ganti_status_transaksi($id, $status)
    {
        if ($status == "verifikasi") {
            TbTransaksi::find($id)->update([
                'status' => 3
            ]);
            return redirect()->route('index-verifikasi');
        } elseif ($status == "kirim_barang") {
            TbTransaksi::find($id)->update([
                'status' => 4
            ]);
            return redirect()->route('index-dikemas');
        } elseif (str_contains($status, 'pengembalian')) {
            $data = explode(':', $status);
            if ($data[1] == 'terima') {
                $status_transaksi = 2;
            } elseif ($data[1] == 'tolak') {
                $status_transaksi = 0;
            }
            TbTransaksi::find($id)->update([
                'status_pengembalian' => $status_transaksi
            ]);
            return redirect()->route('index-pengembalian');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($id)
    {
        return view('admin.transaksi.form.upload_bukti', compact('id'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, $status)
    {
        if ($status == "verifikasi") {
            $data = TbDetailTransaksi::with('tb_transaksi')->where('id_transaksi', $id)->get();
            return view('admin.transaksi.detail.detail_transaksi', compact('data'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        if ($request->status == 'kamera') {
            $img = $request->bukti;
            $image_parts = explode(";base64,", $img);
            $image_base64 = base64_decode($image_parts[0]);
        } else {
            $image_base64 = $request->file('bukti');
        }

        $fileName = uniqid() . '.png';

        $path =  getcwd() . '/image/bukti-penerima/';
        !is_dir($path) &&
            mkdir($path, 0777, true);
        ResizeImage::make($image_base64)->resize(1000, 1000, function ($constraint) {
            $constraint->aspectRatio();
        })->save($path . $fileName);

        TbTransaksi::find($id)->update([
            'bukti_penerima' => $fileName,
            'tanggal_penerimaan' => Carbon::now()->toDateString()
        ]);
        if ($request->status == 'kamera') {
            return response()->json();
        } else {
            return redirect()->route('index-dikirim');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function cek_transaksi()
    {
        $data_transaksi_belum_bayar = TbTransaksi::where([['status', '=', 2], ['bukti_pembayaran', '=', null]])->get();
        $data_transaksi_selesai = TbTransaksi::where([['status', '=', 4], ['bukti_penerima', '!=', null]])->get();
        foreach ($data_transaksi_belum_bayar as $key => $value) {
            $cek_tanggal_terakhir = Carbon::parse($value->tanggal_transaksi)->diffForHumans();
            if (preg_match('/\bhari yang lalu\b/', $cek_tanggal_terakhir) == true) {
                TbTransaksi::find($value->id)->update([
                    'status' => 0,
                    'keterangan' => 'Pesanan dibatalkan secara otomatis, dikarenakan tidak menyelesaikan pembayaran'
                ]);
            }
        }

        foreach ($data_transaksi_selesai as $key => $value) {
            $cek_tanggal_penerimaan = Carbon::parse($value->tanggal_penerimaan)->addDays(7)->toDateString();
            $cek_tanggal_hari_ini = Carbon::now()->toDateString();
            if ($cek_tanggal_penerimaan == $cek_tanggal_hari_ini) {
                TbTransaksi::find($value->id)->update([
                    'status' => 1
                ]);
            }
        }
        return response()->json();
    }
}

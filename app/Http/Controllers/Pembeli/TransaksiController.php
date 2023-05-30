<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\TbDetailTransaksi;
use App\Models\TbKeranjang;
use App\Models\TbTransaksi;
use App\Models\TbUkuran;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as ResizeImage;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'keranjang' => TbKeranjang::where('id_user', auth()->user()->id)->get(),
        ];

        for ($i = 0; $i < 7; $i++) {
            if ($i == 6) {
                $data_pesanan = TbTransaksi::where([['id_user', '=', auth()->user()->id]])->OrderByDesc('id')->get();
            } else {
                $data_pesanan = TbTransaksi::where([['id_user', '=', auth()->user()->id], ['status', '=', $i]])->OrderByDesc('id')->get();
            }

            if ($i == 0) {
                $status = "dibatalkan";
            } elseif ($i == 1) {
                $status = "selesai";
            } elseif ($i == 2) {
                $status = "belum_bayar";
            } elseif ($i == 3) {
                $status = "sedang_dikemas";
            } elseif ($i == 4) {
                $status = "dikirim";
            } elseif ($i == 5) {
                $status = "pengembalian";
            } elseif ($i == 6) {
                $status = "semua";
            }

            foreach ($data_pesanan as $key => $value) {
                $tb_barang = TbDetailTransaksi::where('id_transaksi', $value->id)->get();
                if ($value->status == 0) {
                    $status_pesanan = "Dibatalkan";
                } elseif ($value->status == 1) {
                    $status_pesanan = "Selesai";
                } elseif ($value->status == 2) {
                    $status_pesanan = ($value->bukti_pembayaran == null) ? "Belum Bayar (Bayar Sebelum " . Carbon::parse($value->tanggal_transaksi)->addDays(1)->translatedFormat('d/m/Y H:i') . ")" : "Verifikasi";
                } elseif ($value->status == 3) {
                    $status_pesanan = "Sedang Dikemas";
                } elseif ($value->status == 4) {
                    $status_pesanan = ($value->bukti_penerima == null) ? "Dikirim" : "Diterima";
                } elseif ($value->status == 5) {
                    if ($value->status_pengembalian == 1) {
                        $status_pesanan = "Pengembalian Diproses";
                    } elseif ($value->status_pengembalian == 2) {
                        $status_pesanan = "Pengembalian Diterima";
                    } elseif ($value->status_pengembalian == 0) {
                        $status_pesanan = "Pengembalian Ditolak";
                    }
                }

                $pesanan[] = array(
                    'id' => $value->id,
                    'kode_transaksi' => $value->kode_transaksi,
                    'tanggal_transaksi' => Carbon::parse($value->tanggal_transaksi)->translatedFormat('d/m/Y H:i'),
                    'status' => $status_pesanan,
                    'total' => $value->total_harga,
                    'bukti_penerima' => $value->bukti_penerima,
                    'tipe_pembayaran' => $value->tipe_pembayaran,
                    'tanggal_penerimaan' => $value->tanggal_penerimaan,
                    'waktu' => Carbon::parse($value->tanggal_transaksi)->diffForHumans(),
                    'data_barang' => $tb_barang
                );
            }
            $cek_data_pesanan = ($data_pesanan->count() == 0) ? '' : $pesanan;

            $data[$status] = $cek_data_pesanan;
            if ($data_pesanan->count() > 0) {
                unset($pesanan);
            }
        }

        // dd($data);
        return view('pembeli.transaksi.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
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
    public function show(string $id)
    {
        $data = TbDetailTransaksi::with('tb_transaksi')->where('id_transaksi', $id)->get();
        return view('pembeli.transaksi.detail.detail_transaksi', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('pembeli.transaksi.form.batal_pesanan', compact('id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if ($request->status == "batal_pesanan") {
            TbTransaksi::find($id)->update([
                'status' => 0,
                'keterangan' => $request->keterangan
            ]);
        } elseif ($request->status == "bayar_pesanan") {
            $tb_transaksi = TbTransaksi::find($id);
            if ($tb_transaksi->status == 5) {
                session()->flash('error', 'Pesanan Telah Dibatalkan!');
            } else {

                $gambar = $request->file('gambar');
                $ekstensi_diperbolehkan    = array('image/png', 'image/jpg', 'image/jpeg');
                $ekstensi = $gambar->getClientMimeType();
                // $widht = getimagesize($gambar)[0] - 500;
                // $height = getimagesize($gambar)[1] - 500;
                if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                    $path = getcwd() . '/image/pembayaran-transaksi/';

                    !is_dir($path) &&
                        mkdir($path, 0777, true);
                    $nama_gambar = time() . '.' . $request->gambar->extension();
                    ResizeImage::make($gambar)
                        ->resize(1000, 1000, function ($constraint) {
                            $constraint->aspectRatio();
                        })->save($path . $nama_gambar);
                } else {
                    session()->flash('error', 'Upload Foto Dengan Ekstensi png/jpg/jpeg!');
                }
                $tb_transaksi->update([
                    'bukti_pembayaran' => $nama_gambar
                ]);
            }
        } elseif ($request->status == "terima_pesanan") {
            TbTransaksi::find($id)->update([
                'status' => 1,
            ]);

            return response()->json();
        } elseif ($request->status == "pengembalian_barang") {
            $gambar = $request->file('gambar');
            $ekstensi_diperbolehkan    = array('image/png', 'image/jpg', 'image/jpeg');
            $ekstensi = $gambar->getClientMimeType();
            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {

                $path = getcwd() . '/image/bukti-pengembalian/';

                !is_dir($path) &&
                    mkdir($path, 0777, true);
                $nama_gambar = time() . '.' . $request->gambar->extension();
                ResizeImage::make($gambar)
                    ->resize(1000, 1000, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save($path . $nama_gambar);
            } else {
                session()->flash('error', 'Upload Foto Dengan Ekstensi png/jpg/jpeg!');
            }

            TbTransaksi::find($id)->update([
                'status' => 5,
                'status_pengembalian' => 1,
                'bukti_pengembalian' => $nama_gambar,
                'keterangan' => $request->keterangan

            ]);
        }

        return redirect()->route('pesanan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function index_bayar_pesanan($id)
    {
        return view('pembeli.transaksi.form.bayar_pesanan', compact('id'));
    }

    public function pengembalian_barang($id)
    {
        return view('pembeli.transaksi.form.pengembalian_barang', compact('id'));
    }
}

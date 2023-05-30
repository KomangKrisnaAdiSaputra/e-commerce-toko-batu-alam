<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TbBarang;
use App\Models\TbUkuran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image as ResizeImage;

class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Barang',
            'barang' => TbBarang::OrderByDesc('status')->OrderByDesc('id')->get()
        ];
        return view('admin.barang.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.barang.form.tambah');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $gambar = $request->file('gambar');
        $ekstensi_diperbolehkan    = array('image/png', 'image/jpg', 'image/jpeg');
        $ekstensi = $gambar->getClientMimeType();

        if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
            $path = getcwd() . '/image/barang/';
            !is_dir($path) &&
                mkdir($path, 0777, true);
            $nama_gambar = time() . '.' . $request->gambar->extension();
            ResizeImage::make($gambar)
                ->resize(1000, 1000)
                ->save($path . $nama_gambar);
        } else {
            session()->flash('error', 'Upload Foto Dengan Ekstensi png/jpg/jpeg!');
            return redirect()->route('barang.index');
        }

        $barang = TbBarang::create([
            'nama_barang' => $request->nama_barang,
            'keterangan' => $request->keterangan,
            'gambar' => $nama_gambar,
            'status' => 1,
            'total_terjual' => 0
        ]);

        foreach ($request->ukuran as $key => $value) {
            TbUkuran::create([
                'id_barang' => $barang->id,
                'ukuran' => $value,
                'harga' => str_replace(".", "", $request->harga[$key]),
                'stok' => $request->stok[$key],

            ]);
        }

        session()->flash('success', 'Data Berhasil Ditambah!');
        return redirect()->route('barang.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $data = [
            'barang' => TbBarang::find($id),
            'ukuran' => TbUkuran::where('id_barang', $id)->get()
        ];

        return view('admin.barang.detail.detail_barang', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = [
            'barang' => TbBarang::find($id),
            'ukuran' => TbUkuran::where('id_barang', $id)->get()
        ];
        return view('admin.barang.form.edit', compact('data', 'id'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $barang = TbBarang::find($id);

        $data_barang = array(
            'nama_barang' => $request->nama_barang,
            'keterangan' => $request->keterangan,
        );

        if ($request->hasFile('gambar') == true) {
            $gambar = $request->file('gambar');
            $ekstensi_diperbolehkan    = array('image/png', 'image/jpg', 'image/jpeg');
            $ekstensi = $gambar->getClientMimeType();

            if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
                $path = getcwd() . '/image/barang/';

                if (File::exists($path . $barang->gambar)) {
                    File::delete($path . $barang->gambar);
                }
                !is_dir($path) &&
                    mkdir($path, 0777, true);
                $nama_gambar = time() . '.' . $request->gambar->extension();
                ResizeImage::make($gambar)
                    ->resize(1000, 1000)
                    ->save($path . $nama_gambar);

                $data_barang['gambar'] = $nama_gambar;
            } else {
                session()->flash('error', 'Upload Foto Dengan Ekstensi png/jpg/jpeg!');
                return redirect()->route('barang.index');
            }
        }

        foreach ($request->id_ukuran as $key => $value) {
            TbUkuran::find($value)->update([
                'ukuran' => $request->ukuran[$key],
                'harga' => str_replace(".", "", $request->harga[$key]),
                'stok' => $request->stok[$key],
            ]);
        }

        $barang->update($data_barang);

        session()->flash('success', 'Data Berhasil Diedit!');
        return redirect()->route('barang.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $barang = TbBarang::find($id);

        foreach (TbUkuran::where('id_barang', $id)->get() as $key => $value) {
            TbUkuran::find($value->id)->delete();
        }
        $path = getcwd() . '/image/barang/';
        if (File::exists($path . $barang->gambar)) {
            File::delete($path . $barang->gambar);
        }
        $barang->delete();

        session()->flash('success', 'Data Berhasil Dihapus!');
        return redirect()->route('barang.index');
    }

    public function ganti_status($id)
    {
        $barang = TbBarang::find($id);

        $status = ($barang->status == 1) ? 0 : 1;

        $barang->update(['status' => $status]);

        session()->flash('success', 'Status Berhasil Diubah!');
        return redirect()->route('barang.index');
    }

    public function ukuran_barang($id)
    {
        $data = TbUkuran::where('id_barang', $id)->get();

        return view('admin.barang.form.ukuran', compact('data'));
    }

    public function kelola_ukuran($status, $id, $value)
    {
        if ($status == "tambah") {
            TbUkuran::create([
                'id_barang' => $id,
            ]);
        } elseif ($status == "ukuran" || $status == "harga" || $status == "stok") {

            TbUkuran::find($id)->update([
                $status => $value
            ]);
        } elseif ($status == "hapus") {
            TbUkuran::find($id)->delete();
        } elseif ($status == "close") {
            $tb_ukuran = TbUkuran::where('ukuran', null)->orWhere('harga', null)->orWhere('stok', null)->get();
            foreach ($tb_ukuran as $key => $value) {
                TbUkuran::find($value->id)->delete();
            }

            $tb_ukuran_baru = TbUkuran::orderByDesc('id')->get();

            DB::statement('ALTER TABLE tb_ukuran AUTO_INCREMENT=' . $tb_ukuran_baru[0]->id  . ';');
        }

        return response()->json();
    }
}

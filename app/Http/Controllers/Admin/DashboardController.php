<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TbBarang;
use App\Models\TbTransaksi;
use Carbon\Carbon;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'title' => 'Dashboard',
            'total_barang' => TbBarang::where('status', 1)->get()->count(),
            'total_transaksi_selesai' => TbTransaksi::where('status', 1)->get()->count(),
            'total_transaksi_batal' => TbTransaksi::where('status', 0)->get()->count(),
            'total_pengembalian' => TbTransaksi::where('status', 5)->get()->count(),
            'tanggal_pertama' => Carbon::now()->startOfMonth()->toDateString(),
            'tanggal_kedua' => Carbon::now()->toDateString()
        ];

        $created = new Carbon("2023-04-01");
        $now = Carbon::now();

        return view('admin.dashboard.index', compact('data'));
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
        $tanggal_pertama = Carbon::parse($request->tanggal_pertama);
        $tanggal_kedua = Carbon::parse($request->tanggal_kedua);

        for ($i = 0; $i < $tanggal_pertama->diff($tanggal_kedua)->days + 1; $i++) {
            $hari_transaksi = Carbon::parse($tanggal_pertama)->addDays($i)->translatedFormat('Y-m-d');
            $total[] = TbTransaksi::where([['status', '=', 1], ['tanggal_transaksi', 'LIKE', '%' . $hari_transaksi . '%']])->get()->sum('total_harga');
            $hari[] = Carbon::parse($hari_transaksi)->translatedFormat('d/m/Y');
        }
        $data = [
            'total' => $total,
            'hari' => $hari,
            'tanggal_transaksi' => Carbon::parse($tanggal_pertama)->translatedFormat('d/m/Y') . ' - ' . Carbon::parse($tanggal_kedua)->translatedFormat('d/m/Y')
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbTransaksi extends Model
{
    use HasFactory;
    protected $table = 'tb_transaksi';

    protected $fillable = [
        'id_user',
        'kode_transaksi',
        'nama_pembeli',
        'no_wa_pembeli',
        'alamat_pembeli',
        'total_pembelian',
        'total_harga',
        'tipe_pembayaran',
        'status',
        'status_pengembalian',
        'keterangan',
        'tanggal_transaksi',
        'tanggal_penerimaan',
        'bukti_pembayaran',
        'bukti_penerima',
        'bukti_pengembalian',
    ];

    public function tb_user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

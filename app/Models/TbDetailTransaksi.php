<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbDetailTransaksi extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_transaksi';

    protected $fillable = [
        'id_transaksi',
        'nama_barang',
        'ukuran',
        'jumlah',
        'harga_barang',
        'total',
        'foto_barang'
    ];

    public function tb_transaksi()
    {
        return $this->belongsTo(TbTransaksi::class, 'id_transaksi');
    }
}

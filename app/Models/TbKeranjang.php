<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbKeranjang extends Model
{
    use HasFactory;
    protected $table = 'tb_keranjang';

    protected $fillable = [
        'id_user',
        'id_barang',
        'id_ukuran',
        'jumlah',
        'status'
    ];

    public function tb_user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function tb_barang()
    {
        return $this->belongsTo(TbBarang::class, 'id_barang');
    }

    public function tb_ukuran()
    {
        return $this->belongsTo(TbUkuran::class, 'id_ukuran');
    }
}

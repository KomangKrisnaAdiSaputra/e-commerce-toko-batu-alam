<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbUkuran extends Model
{
    use HasFactory;
    protected $table = 'tb_ukuran';

    protected $fillable = [
        'id_barang',
        'ukuran',
        'harga',
        'stok'
    ];

    public function tb_barang()
    {
        return $this->belongsTo(TbBarang::class, 'id_barang');
    }
}

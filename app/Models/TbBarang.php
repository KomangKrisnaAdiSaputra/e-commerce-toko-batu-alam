<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbBarang extends Model
{
    use HasFactory;
    protected $table = 'tb_barang';

    protected $fillable = [
        'nama_barang',
        'keterangan',
        'gambar',
        'status',
        'total_terjual'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TbDetailPembeli extends Model
{
    use HasFactory;
    protected $table = 'tb_detail_pembeli';

    protected $fillable = [
        'id_user',
        'alamat',
        'no_wa',
    ];

    public function tb_user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

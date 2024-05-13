<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SanPham extends Model
{
    use HasFactory;

    protected $table = 'san_phams';

    protected $fillable = [
        'tieu_de',
        'thumbnail',
        'slug_san_pham',
        'gia_ban',
        'gia_khuyen_mai',
        'mo_ta',
        'id_dai_ly',
        'id_danh_muc',
    ];
}

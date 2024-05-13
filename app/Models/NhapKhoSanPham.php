<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NhapKhoSanPham extends Model
{
    use HasFactory;

    protected $table = 'nhap_kho_san_phams';

    protected $fillable = [
        'ten_san_pham',
        'id_admin',
    ];
}

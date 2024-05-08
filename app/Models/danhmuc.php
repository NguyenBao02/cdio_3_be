<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class danhmuc extends Model
{
    use HasFactory;

    protected $table = "danhmucs";

    protected $fillable = [
        'id',
        'ten_danh_muc',
        'tinh_trang',
    ];
}

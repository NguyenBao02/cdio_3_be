<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaiLy extends Model
{
    use HasFactory;

    protected $table = 'dai_lies';

    protected $fillable = [
        'ten_dai_ly',
        'email',
        'so_dien_thoai',
        'dia_chi',
    ];
}

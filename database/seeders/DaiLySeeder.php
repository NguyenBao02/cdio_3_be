<?php

namespace Database\Seeders;

use App\Models\DaiLy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DaiLySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('dai_lies')->delete();

        DB::table('dai_lies')->truncate();

        DB::table('dai_lies')->insert([
            ['id' => '1', 'ten_dai_ly' => 'Apple', 'email' => 'apple@gmail.com', 'so_dien_thoai' => '376659652', 'dia_chi' => 'Đà Nẵng'],
            ['id' => '2', 'ten_dai_ly' => 'Samsung', 'email' => 'samsung@gmail.com', 'so_dien_thoai' => '123123123', 'dia_chi' => 'Hồ Chí Minh'],
            ['id' => '3', 'ten_dai_ly' => 'Oppo', 'email' => 'oppo@gmail.com', 'so_dien_thoai' => '123123123', 'dia_chi' => 'Tỉnh Bình Dương'],
            ['id' => '4', 'ten_dai_ly' => 'Xiaomi', 'email' => 'xiaomi@gmail.com', 'so_dien_thoai' => '123123123', 'dia_chi' => 'TP Hà Nội'],
        ]);
    }
}

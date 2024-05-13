<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DanhMucSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('danhmucs')->delete();

        DB::table('danhmucs')->truncate();

        DB::table('danhmucs')->insert([
            ['id' => '1', 'ten_danh_muc' => 'Điện Thoại', 'tinh_trang' => '0'],
            ['id' => '2', 'ten_danh_muc' => 'Laptop', 'tinh_trang' => '0'],
            ['id' => '3', 'ten_danh_muc' => 'Tai Nghe', 'tinh_trang' => '0'],
            ['id' => '4', 'ten_danh_muc' => 'Đồng Hồ', 'tinh_trang' => '0'],
            ['id' => '5', 'ten_danh_muc' => 'Màn Hình', 'tinh_trang' => '0'],
            ['id' => '6', 'ten_danh_muc' => 'Tivi', 'tinh_trang' => '0'],
        ]);
    }
}

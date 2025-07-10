<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BaiLamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('bai_lam')->insert([
            ['maBL' => 1, 'maDT' => 2, 'maTK' => 5, 'maKQT' => 1, 'trangThai' => 'Đã hoàn thành', 'created_at' => '2025-07-06 19:22:40', 'updated_at' => '2025-07-06 19:25:48'],
        ]);
    }
}

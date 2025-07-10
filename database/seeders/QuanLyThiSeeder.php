<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuanLyThiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('quan_ly_thi')->insert([
            ['maKT' => 1, 'maTK' => 5, 'created_at' => '2025-07-06 18:45:58', 'updated_at' => '2025-07-06 18:45:58'],
            ['maKT' => 1, 'maTK' => 6, 'created_at' => '2025-07-06 18:45:58', 'updated_at' => '2025-07-06 18:45:58'],
            ['maKT' => 1, 'maTK' => 7, 'created_at' => '2025-07-06 18:45:58', 'updated_at' => '2025-07-06 18:45:58'],
            ['maKT' => 2, 'maTK' => 5, 'created_at' => '2025-07-06 18:46:10', 'updated_at' => '2025-07-06 18:46:10'],
            ['maKT' => 2, 'maTK' => 6, 'created_at' => '2025-07-06 18:46:10', 'updated_at' => '2025-07-06 18:46:10'],
            ['maKT' => 2, 'maTK' => 8, 'created_at' => '2025-07-06 18:46:10', 'updated_at' => '2025-07-06 18:46:10'],
            ['maKT' => 3, 'maTK' => 7, 'created_at' => '2025-07-06 18:46:24', 'updated_at' => '2025-07-06 18:46:24'],
            ['maKT' => 3, 'maTK' => 8, 'created_at' => '2025-07-06 18:46:24', 'updated_at' => '2025-07-06 18:46:24'],
            ['maKT' => 3, 'maTK' => 9, 'created_at' => '2025-07-06 18:46:24', 'updated_at' => '2025-07-06 18:46:24'],
            ['maKT' => 4, 'maTK' => 7, 'created_at' => '2025-07-06 18:46:40', 'updated_at' => '2025-07-06 18:46:40'],
            ['maKT' => 4, 'maTK' => 8, 'created_at' => '2025-07-06 18:46:40', 'updated_at' => '2025-07-06 18:46:40'],
            ['maKT' => 4, 'maTK' => 10, 'created_at' => '2025-07-06 18:46:40', 'updated_at' => '2025-07-06 18:46:40'],
            ['maKT' => 5, 'maTK' => 5, 'created_at' => '2025-07-06 18:46:56', 'updated_at' => '2025-07-06 18:46:56'],
            ['maKT' => 5, 'maTK' => 9, 'created_at' => '2025-07-06 18:46:56', 'updated_at' => '2025-07-06 18:46:56'],
            ['maKT' => 5, 'maTK' => 10, 'created_at' => '2025-07-06 18:46:56', 'updated_at' => '2025-07-06 18:46:56'],
            ['maKT' => 6, 'maTK' => 6, 'created_at' => '2025-07-06 18:47:09', 'updated_at' => '2025-07-06 18:47:09'],
            ['maKT' => 6, 'maTK' => 9, 'created_at' => '2025-07-06 18:47:09', 'updated_at' => '2025-07-06 18:47:09'],
            ['maKT' => 6, 'maTK' => 10, 'created_at' => '2025-07-06 18:47:09', 'updated_at' => '2025-07-06 18:47:09'],
        ]);
    }
}

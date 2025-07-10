<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChuongSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('chuong')->insert([
            ['maChuong' => 1, 'tenChuong' => 'Chương 1: Tổng quan về cơ sở dữ liệu', 'maMH' => 1, 'created_at' => '2025-07-06 17:43:38', 'updated_at' => '2025-07-06 17:43:38'],
            ['maChuong' => 2, 'tenChuong' => 'Chương 2: Mô hình dữ liệu', 'maMH' => 1, 'created_at' => '2025-07-06 17:43:38', 'updated_at' => '2025-07-06 17:43:38'],
            ['maChuong' => 3, 'tenChuong' => 'Chương 3: Ngôn ngữ định nghĩa và thao tác dữ liệu', 'maMH' => 1, 'created_at' => '2025-07-06 17:43:38', 'updated_at' => '2025-07-06 17:43:38'],
            ['maChuong' => 4, 'tenChuong' => 'Chương 4: Thiết kế cơ sở dữ liệu', 'maMH' => 1, 'created_at' => '2025-07-06 17:43:38', 'updated_at' => '2025-07-06 17:43:38'],
            ['maChuong' => 5, 'tenChuong' => 'Chương 5: Quản trị cơ sở dữ liệu', 'maMH' => 1, 'created_at' => '2025-07-06 17:43:38', 'updated_at' => '2025-07-06 17:43:38'],
            ['maChuong' => 6, 'tenChuong' => 'Chương 1: Giới thiệu về lập trình hướng đối tượng', 'maMH' => 2, 'created_at' => '2025-07-06 17:43:53', 'updated_at' => '2025-07-06 17:43:53'],
            ['maChuong' => 7, 'tenChuong' => 'Chương 2: Lớp và đối tượng', 'maMH' => 2, 'created_at' => '2025-07-06 17:43:53', 'updated_at' => '2025-07-06 17:43:53'],
            ['maChuong' => 8, 'tenChuong' => 'Chương 3: Tính kế thừa', 'maMH' => 2, 'created_at' => '2025-07-06 17:43:53', 'updated_at' => '2025-07-06 17:43:53'],
            ['maChuong' => 9, 'tenChuong' => 'Chương 4: Tính đa hình', 'maMH' => 2, 'created_at' => '2025-07-06 17:43:53', 'updated_at' => '2025-07-06 17:43:53'],
            ['maChuong' => 10, 'tenChuong' => 'Chương 5: Xử lý ngoại lệ và luồng vào/ra', 'maMH' => 2, 'created_at' => '2025-07-06 17:43:53', 'updated_at' => '2025-07-06 17:43:53'],
            ['maChuong' => 11, 'tenChuong' => 'Chương 1: Giới thiệu về Python', 'maMH' => 3, 'created_at' => '2025-07-06 18:00:33', 'updated_at' => '2025-07-06 18:00:33'],
            ['maChuong' => 12, 'tenChuong' => 'Chương 2: Variables và Data Types', 'maMH' => 3, 'created_at' => '2025-07-06 18:00:33', 'updated_at' => '2025-07-06 18:00:33'],
            ['maChuong' => 13, 'tenChuong' => 'Chương 3: Cấu trúc điều khiển', 'maMH' => 3, 'created_at' => '2025-07-06 18:00:33', 'updated_at' => '2025-07-06 18:00:33'],
            ['maChuong' => 14, 'tenChuong' => 'Chương 4: Hàm', 'maMH' => 3, 'created_at' => '2025-07-06 18:00:33', 'updated_at' => '2025-07-06 18:00:33'],
            ['maChuong' => 15, 'tenChuong' => 'Chương 5: Cấu trúc dữ liệu', 'maMH' => 3, 'created_at' => '2025-07-06 18:00:33', 'updated_at' => '2025-07-06 18:00:33'],
            ['maChuong' => 16, 'tenChuong' => 'Chương 6: Các hướng ứng dụng', 'maMH' => 3, 'created_at' => '2025-07-06 18:00:33', 'updated_at' => '2025-07-06 18:00:33'],
        ]);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeThiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('de_thi')->insert([
            [
                'maDT' => 1,
                'maTK' => 2,
                'tenDT' => 'Đề giữa kỳ Cơ sở dữ liệu',
                'maMH' => 1,
                'maKT' => 1,
                'thoiLuongPhut' => 60,
                'moTa' => 'Đề thi giữa kỳ môn Cơ sở dữ liệu',
                'ngayTao' => '2025-07-07 01:31:48',
                'created_at' => '2025-07-06 18:31:48',
                'updated_at' => '2025-07-06 18:31:48',
            ],
            [
                'maDT' => 2,
                'maTK' => 2,
                'tenDT' => 'Đề cuối kỳ Cơ sở dữ liệu',
                'maMH' => 1,
                'maKT' => 2,
                'thoiLuongPhut' => 60,
                'moTa' => 'Đề thi cuối kỳ môn Cơ sở dữ liệu',
                'ngayTao' => '2025-07-07 01:31:48',
                'created_at' => '2025-07-06 18:31:48',
                'updated_at' => '2025-07-06 18:31:48',
            ],
            [
                'maDT' => 3,
                'maTK' => 3,
                'tenDT' => 'Đề giữa kỳ Lập trình hướng đối tượng',
                'maMH' => 2,
                'maKT' => 3,
                'thoiLuongPhut' => 60,
                'moTa' => 'Đề thi giữa kỳ môn Lập trình hướng đối tượng',
                'ngayTao' => '2025-07-07 01:32:12',
                'created_at' => '2025-07-06 18:32:12',
                'updated_at' => '2025-07-06 18:32:12',
            ],
            [
                'maDT' => 4,
                'maTK' => 3,
                'tenDT' => 'Đề cuối kỳ Lập trình hướng đối tượng',
                'maMH' => 2,
                'maKT' => 4,
                'thoiLuongPhut' => 60,
                'moTa' => 'Đề thi cuối kỳ môn Lập trình hướng đối tượng',
                'ngayTao' => '2025-07-07 01:32:12',
                'created_at' => '2025-07-06 18:32:12',
                'updated_at' => '2025-07-06 18:32:12',
            ],
            [
                'maDT' => 5,
                'maTK' => 4,
                'tenDT' => 'Đề giữa kỳ Lập trình Python',
                'maMH' => 3,
                'maKT' => 5,
                'thoiLuongPhut' => 60,
                'moTa' => 'Đề thi giữa kỳ môn Lập trình Python',
                'ngayTao' => '2025-07-07 01:32:39',
                'created_at' => '2025-07-06 18:32:39',
                'updated_at' => '2025-07-06 18:32:39',
            ],
            [
                'maDT' => 6,
                'maTK' => 4,
                'tenDT' => 'Đề cuối kỳ Lập trình Python',
                'maMH' => 3,
                'maKT' => 6,
                'thoiLuongPhut' => 60,
                'moTa' => 'Đề thi cuối kỳ môn Lập trình Python',
                'ngayTao' => '2025-07-07 01:32:39',
                'created_at' => '2025-07-06 18:32:39',
                'updated_at' => '2025-07-06 18:32:39',
            ],
        ]);
    }
}

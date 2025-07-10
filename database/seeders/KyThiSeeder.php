<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KyThiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ky_thi')->insert([
            [
                'maKT' => 1,
                'tenKT' => 'Giữa kỳ Cơ sở dữ liệu',
                'moTa' => 'Thi giữa kỳ môn Cơ sở dữ liệu',
                'ngayThi' => '2025-06-30 10:00:00',
                'created_at' => '2025-07-06 18:26:27',
                'updated_at' => '2025-07-06 18:26:27',
            ],
            [
                'maKT' => 2,
                'tenKT' => 'Cuối kỳ Cơ sở dữ liệu',
                'moTa' => 'Thi cuối kỳ môn Cơ sở dữ liệu',
                'ngayThi' => '2025-07-07 02:00:00',
                'created_at' => '2025-07-06 18:26:27',
                'updated_at' => '2025-07-06 18:26:27',
            ],
            [
                'maKT' => 3,
                'tenKT' => 'Giữa kỳ Lập trình hướng đối tượng',
                'moTa' => 'Thi giữa kỳ môn Lập trình hướng đối tượng',
                'ngayThi' => '2025-07-07 10:00:00',
                'created_at' => '2025-07-06 18:26:52',
                'updated_at' => '2025-07-06 18:26:52',
            ],
            [
                'maKT' => 4,
                'tenKT' => 'Cuối kỳ Lập trình hướng đối tượng',
                'moTa' => 'Thi cuối kỳ môn Lập trình hướng đối tượng',
                'ngayThi' => '2025-07-14 00:00:00',
                'created_at' => '2025-07-06 18:26:52',
                'updated_at' => '2025-07-06 18:26:52',
            ],
            [
                'maKT' => 5,
                'tenKT' => 'Giữa kỳ Lập trình Python',
                'moTa' => 'Thi giữa kỳ môn Lập trình Python',
                'ngayThi' => '2025-07-07 10:00:00',
                'created_at' => '2025-07-06 18:27:09',
                'updated_at' => '2025-07-06 18:27:09',
            ],
            [
                'maKT' => 6,
                'tenKT' => 'Cuối kỳ Lập trình Python',
                'moTa' => 'Thi cuối kỳ môn Lập trình Python',
                'ngayThi' => '2025-07-14 00:00:00',
                'created_at' => '2025-07-06 18:27:09',
                'updated_at' => '2025-07-06 18:27:09',
            ],
        ]);
    }
}

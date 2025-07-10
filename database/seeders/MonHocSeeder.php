<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MonHocSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mon_hoc')->insert([
            [
                'maMH' => 1,
                'tenMH' => 'Cơ sở dữ liệu',
                'created_at' => '2025-07-06 17:40:47',
                'updated_at' => '2025-07-06 17:40:47',
            ],
            [
                'maMH' => 2,
                'tenMH' => 'Lập trình hướng đối tượng',
                'created_at' => '2025-07-06 17:40:47',
                'updated_at' => '2025-07-06 17:40:47',
            ],
            [
                'maMH' => 3,
                'tenMH' => 'Lập trình Python',
                'created_at' => '2025-07-06 17:40:47',
                'updated_at' => '2025-07-06 17:40:47',
            ],
        ]);
    }
}

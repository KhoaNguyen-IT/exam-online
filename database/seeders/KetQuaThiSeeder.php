<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KetQuaThiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ket_qua_thi')->insert([
            ['maKQT' => 1, 'maTK' => 5, 'maDT' => 2, 'diemSo' => 7.5, 'tongSoCau' => 20, 'soCauDung' => 15, 'ngayThi' => '2025-07-07 02:00:00', 'created_at' => '2025-07-06 19:25:48', 'updated_at' => '2025-07-06 19:25:48'],
        ]);
    }
}

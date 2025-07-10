<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            MonHocSeeder::class,
            ChuongSeeder::class,
            TaiKhoanSeeder::class,
            KyThiSeeder::class,
            DeThiSeeder::class,
            CauHoiSeeder::class,
            ChiTietDeThiSeeder::class,
            QuanLyThiSeeder::class,
            KetQuaThiSeeder::class,
            BaiLamSeeder::class,
            ChiTietBaiLamSeeder::class,
            NhanXetSeeder::class,
        ]);
    }
}

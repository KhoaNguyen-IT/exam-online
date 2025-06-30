<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChuongSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            1 => [ // Tin học đại cương
                'Tổng quan về tin học',
                'Hệ điều hành và phần mềm',
                'Microsoft Word',
                'Microsoft Excel',
                'Internet và an toàn thông tin'
            ],
            2 => [ // Cơ sở dữ liệu
                'Mô hình dữ liệu',
                'Ngôn ngữ SQL cơ bản',
                'Quan hệ và khóa',
                'Thiết kế cơ sở dữ liệu',
                'Tối ưu và chỉ mục'
            ],
            3 => [ // Lập trình C/C++
                'Biến và kiểu dữ liệu',
                'Cấu trúc điều khiển',
                'Mảng và con trỏ',
                'Hàm và truyền tham số',
                'Lập trình hướng cấu trúc'
            ],
            4 => [ // Lập trình hướng đối tượng
                'Khái niệm OOP',
                'Lớp và đối tượng',
                'Kế thừa và đa hình',
                'Đóng gói và trừu tượng',
                'OOP nâng cao'
            ],
            5 => [ // Lập trình Web
                'HTML & CSS cơ bản',
                'JavaScript và DOM',
                'PHP & xử lý form',
                'Cơ sở dữ liệu MySQL',
                'Laravel Framework căn bản'
            ],
        ];

        $chuongData = [];

        foreach ($data as $maMonHoc => $chuongs) {
            foreach ($chuongs as $index => $tenChuong) {
                $chuongData[] = [
                    'tenChuong' => 'Chương ' . ($index + 1) . ': ' . $tenChuong,
                    'maMH' => $maMonHoc,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }

        DB::table('chuong')->insert($chuongData);
    }
}
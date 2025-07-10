<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NhanXetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('nhan_xet')->insert([
            ['maNX' => 1, 'maTK' => 5, 'maDT' => 2, 'noiDung' => 'Đề thi phù hợp với kiến thức đã học, câu hỏi rõ ràng và không đánh đố. Thời gian làm bài hợp lý, đủ để hoàn thành toàn bộ câu hỏi. Một số câu hỏi ở mức nâng cao giúp phân loại được năng lực sinh viên.', 'created_at' => '2025-07-06 19:29:09', 'updated_at' => '2025-07-06 19:29:09'],
        ]);
    }
}

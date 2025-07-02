<?php
namespace App\Imports;

use App\Models\CauHoi;
use App\Models\MonHoc;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;
use Illuminate\Support\Str;

class CauHoiImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        // Nếu tất cả các cột đều rỗng thì bỏ qua dòng này
        if (collect($row)->filter(function ($value) {
            return !is_null($value) && trim($value) !== '';
        })->isEmpty()) {
            return null;
        }

        // Lấy tên môn học
        $tenMonHoc = trim($row[7] ?? '');

        // Kiểm tra tên môn học có tồn tại trong bảng mon_hoc không
        $maMonHoc = MonHoc::where('tenMH', $tenMonHoc)->value('maMH');

        if (!$maMonHoc) {
            throw new \Exception("Tên môn học '{$tenMonHoc}' không tồn tại trong hệ thống.");
        }

        // Kiểm tra nội dung câu hỏi đã tồn tại chưa
        $noiDung = trim($row[0] ?? '');
        $exists = CauHoi::where('noiDung', $noiDung)
            ->where('maMonHoc', $maMonHoc)
            ->exists();

        if ($exists) {
            throw new \Exception("Câu hỏi '{$noiDung}' đã tồn tại trong hệ thống.");
        }

        return new CauHoi([
            'noiDung' => $noiDung,
            'dapAnA' => $row[1] ?? '',
            'dapAnB' => $row[2] ?? '',
            'dapAnC' => $row[3] ?? '',
            'dapAnD' => $row[4] ?? '',
            'dapAnDung' => isset($row[5]) ? strtoupper(trim($row[5])) : '',
            'doKho' => $row[6] ?? '',
            'ngayTao' => now(),
            'maNguoiTao' => auth()->user()->maTK ?? null,
            'maMonHoc' => $maMonHoc,
        ]);
    }
}
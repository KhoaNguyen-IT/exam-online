<?php
namespace App\Imports;

use App\Models\CauHoi;
use App\Models\Chuong;
use App\Models\MonHoc;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;

class CauHoiImport implements ToModel, WithStartRow
{
    protected $maMonHoc;

    public function __construct($maMonHoc)
    {
        $this->maMonHoc = $maMonHoc;
    }

    public function startRow(): int
    {
        return 2;
    }

    public function model(array $row)
    {
        if (collect($row)->filter(fn($value) => !is_null($value) && trim($value) !== '')->isEmpty()) {
            return null;
        }

        $maMonHoc = $this->maMonHoc;

        if (!MonHoc::where('maMH', $maMonHoc)->exists()) {
            throw new \Exception("Mã môn học '{$maMonHoc}' không tồn tại.");
        }

        $noiDung = trim($row[0] ?? '');
        $exists = CauHoi::where('noiDung', $noiDung)
            ->where('maMonHoc', $maMonHoc)
            ->exists();

        if ($exists) {
            throw new \Exception("Câu hỏi '{$noiDung}' đã tồn tại trong hệ thống.");
        }

        // Xử lý chương từ cột [7]
        $tenChuongExcel = trim($row[7] ?? '');
        $maChuong = null;

        //tìm số đầu tiên trong chuỗi
        if (preg_match('/(\d+)/', $tenChuongExcel, $matches)) {
            $soChuong = (int) $matches[1];

            // Tìm chương bằng cách tìm tenChuong bắt đầu bằng "Chương <số>"
            $chuong = Chuong::where('maMH', $maMonHoc)
                ->where('tenChuong', 'like', "Chương $soChuong%")
                ->first();

            if (!$chuong) {
                throw new \Exception("Không tìm thấy chương số {$soChuong} thuộc môn học mã {$maMonHoc}.");
            }

            $maChuong = $chuong->maChuong;
        } else {
            throw new \Exception("Cột chương không hợp lệ: '{$tenChuongExcel}'. Vui lòng nhập dạng 'Chương 1' hoặc chỉ số chương.");
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
            'maChuong' => $maChuong,
        ]);
    }
}
<?php
namespace App\Imports;

use App\Models\CauHoi;
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
        $ngayTao = $row[7] ?? null;
        if (is_numeric($ngayTao)) {
            $ngayTao = ExcelDate::excelToDateTimeObject($ngayTao)->format('Y-m-d');
        }

        return new CauHoi([
            'noiDung' => $row[0] ?? '',
            'dapAnA' => $row[1] ?? '',
            'dapAnB' => $row[2] ?? '',
            'dapAnC' => $row[3] ?? '',
            'dapAnD' => $row[4] ?? '',
            'dapAnDung' => isset($row[5]) ? strtoupper(trim($row[5])) : '',
            'doKho' => $row[6] ?? '',
            'ngayTao' => $ngayTao,
            'maNguoiTao' => $row[8] ?? '',
            'maMonHoc' => $row[9] ?? '',
        ]);
    }
}
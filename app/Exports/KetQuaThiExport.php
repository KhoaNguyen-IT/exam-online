<?php

namespace App\Exports;

use App\Models\KetQuaThi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KetQuaThiExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return KetQuaThi::with(['taiKhoan', 'deThi'])->get()->map(function ($ketQua) {
            return [
                'Tên sinh viên' => $ketQua->taiKhoan ? $ketQua->taiKhoan->getHoTen() : '',
                'Tên đề thi' => $ketQua->deThi ? $ketQua->deThi->getTenDT() : '',
                'Điểm số' => $ketQua->getDiemSo(),
                'Tổng số câu' => $ketQua->getTongSoCau(),
                'Số câu đúng' => $ketQua->getSoCauDung(),
                'Ngày thi' => $ketQua->ngayThi ? \Carbon\Carbon::parse($ketQua->ngayThi)->format('d/m/Y') : '',
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Tên sinh viên',
            'Tên đề thi',
            'Điểm số',
            'Tổng số câu',
            'Số câu đúng',
            'Ngày thi',
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\KetQuaThi;
use App\Models\QuanLyThi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class KetQuaThiExport implements FromCollection, WithHeadings
{
    protected $maKT;

    public function __construct($maKT)
    {
        $this->maKT = $maKT;
    }

    public function collection()
    {
        // Lấy danh sách maTK từ bảng quan_ly_thi theo maKT
        $maTKs = QuanLyThi::where('maKT', $this->maKT)->pluck('maTK');

        // Lọc kết quả thi theo danh sách maTK đó
        return KetQuaThi::with(['taiKhoan', 'deThi'])
            ->whereIn('maTK', $maTKs)
            ->get()
            ->map(function ($ketQua) {
                return [
                    'Tên sinh viên' => $ketQua->taiKhoan?->getHoTen() ?? '',
                    'Email sinh viên' => $ketQua->taiKhoan?->getEmail() ?? '',
                    'Tên đề thi' => $ketQua->deThi?->getTenDT() ?? '',
                    'Điểm số' => $ketQua->getDiemSo() ?? '',
                    'Tổng số câu' => $ketQua->getTongSoCau() ?? '',
                    'Số câu đúng' => $ketQua->getSoCauDung() ?? '',
                    'Ngày thi' => $ketQua->ngayThi
                        ? \Carbon\Carbon::parse($ketQua->ngayThi)->format('d/m/Y')
                        : '',
                ];
            });
    }

    public function headings(): array
    {
        return [
            'Tên sinh viên',
            'Email sinh viên',
            'Tên đề thi',
            'Điểm số',
            'Tổng số câu',
            'Số câu đúng',
            'Ngày thi',
        ];
    }
}
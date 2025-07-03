<?php

namespace App\Exports;

use App\Models\CauHoi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class CauHoiExport implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return new Collection([]);
    }
    public function headings(): array
    {
        return [
            'Nội dung',
            'Đáp án A',
            'Đáp án B',
            'Đáp án C',
            'Đáp án D',
            'Đáp án đúng',
            'Độ khó',
            'chương'
        ];
    }
}
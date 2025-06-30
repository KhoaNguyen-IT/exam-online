<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Collection;

class SinhVienExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return new Collection([]);
    }
    public function headings(): array
    {
        return [
            'Họ và tên',
            'Email',
        ];
    }
}

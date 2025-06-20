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
            'noi_dung',
            'dap_an_a',
            'dap_an_b',
            'dap_an_c',
            'dap_an_d',
            'dap_an_dung',
            'do_kho',
            'ngay_tao',
            'nguoi_tao',
            'mon_hoc',
        ];
    }
}

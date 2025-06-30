<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class SinhVienImport implements ToCollection
{
    public $emails = [];

    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            // Bỏ qua dòng tiêu đề
            if (
                $index === 0 && (
                    strtolower(trim($row[0])) === 'họ và tên' ||
                    strtolower(trim($row[1])) === 'email'
                )
            ) {
                continue;
            }

            $email = isset($row[1]) ? trim($row[1]) : null;

            if ($email) {
                $this->emails[] = $email;
            }
        }
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietKyThi extends Model
{
    protected $table = 'chi_tiet_ky_thi';

    protected $primaryKey = ['maKT', 'maDT'];

    protected $fillable = [
        'maKT',
        'maDT',  
    ];

    public function getMaKT()
    {
        return $this->maKT;
    }

    public function getMaDT()
    {
        return $this->maDT;
    }
}

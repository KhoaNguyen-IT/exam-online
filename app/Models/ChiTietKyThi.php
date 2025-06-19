<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietKyThi extends Model
{
    protected $table = 'chi_tiet_ky_thi';
    protected $fillable = [
        'maKT',
        'maDT',
        'created_at',
        'updated_at'
    ];

    public function kyThi()
    {
        return $this->belongsTo(KyThi::class, 'maKT', 'maKT');
    }
    public function deThi()
    {
        return $this->belongsTo(DeThi::class, 'maDT', 'maDT');
    }

    public function getMaKT()
    {
        return $this->maKT;
    }
    public function getMaDT()
    {
        return $this->maDT;
    }
}

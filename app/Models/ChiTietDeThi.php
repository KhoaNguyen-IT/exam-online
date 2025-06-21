<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDeThi extends Model
{
    protected $table = 'chi_tiet_de_thi';
    protected $fillable = [
        'maDT',
        'maCH',
        'created_at',
        'updated_at'
    ];

    public function deThi()
    {
        return $this->belongsTo(DeThi::class, 'maDT', 'maDT');
    }
    public function cauHoi()
    {
        return $this->belongsTo(CauHoi::class, 'maCH', 'maCH');
    }

    public function getMaDT()
    {
        return $this->maDT;
    }

    public function getMaCH()
    {
        return $this->maCH;
    }
}
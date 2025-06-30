<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonHoc extends Model
{
    protected $table = 'mon_hoc';
    protected $primaryKey = 'maMH';
    protected $fillable = [
        'maMH',
        'tenMH',
    ];

    public function getMaMH()
    {
        return $this->maMH;
    }

    public function getTenMH()
    {
        return $this->tenMH;
    }

    public function setTenMH(string $nd)
    {
        $this->tenMH = $nd;
    }

    public function deThis()
    {
        return $this->hasMany(DeThi::class, 'maMH', 'maMH');
    }

    public function chuong()
    {
        return $this->hasMany(Chuong::class, 'maMonHoc', 'maMonHoc');
    }
}

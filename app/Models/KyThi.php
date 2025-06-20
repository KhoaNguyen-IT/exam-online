<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KyThi extends Model
{
    protected $table = 'ky_thi';
    protected $primaryKey = 'maKT';
    protected $fillable = [
        'maKT',
        'moTa',
        'created_at',
        'updated_at'
    ];

    public function getMaKT()
    {
        return $this->maKT;
    }

    public function getTenKT()
    {
        return $this->tenKT;
    }

    public function setTenKT(string $nd)
    {
        $this->tenKT = $nd;
    }

    public function getMoTa()
    {
        return $this->moTa;
    }

    public function setMoTa(string $nd)
    {
        $this->moTa = $nd;
    }
}

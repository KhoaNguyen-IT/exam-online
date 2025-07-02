<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use Dom\Text;

class KyThi extends Model
{
    protected $table = 'ky_thi';
  
    protected $primaryKey = 'maKT';
  
    protected $fillable = [
        'maKT',
        'moTa',
        'ngayThi',
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

    public function getNgayThi()
    {
        return $this->ngayThi;
    }

    public function setNgayThi(DateTime $nt)
    {
        $this->ngayThi = $nt;
    }
  
    public function quanLyThis()
    {
        return $this->hasMany(QuanLyThi::class, 'maKT', 'maKT');
    }

    public function deThi()
    {
        return $this->hasMany(DeThi::class, 'maKT', 'maKT');
    }
}

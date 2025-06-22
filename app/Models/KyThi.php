<?php

namespace App\Models;

use DateTime;
use Dom\Text;
use Illuminate\Database\Eloquent\Model;

class KyThi extends Model
{
    protected $table = 'ky_thi';

    protected $primaryKey = 'maKT';

    protected $fillable = [
        'maKT',
        'tenKT',
        'moTa',
        'ngayThi'  
    ];

    public function getMaKT()
    {
        return $this->maKT;
    }

    public function getTenKT()
    {
        return $this->tenKT;
    }

    public function setTenKT(string $tkt)
    {
        $this->tenKT = $tkt;
    }

    public function getMoTa()
    {
        return $this->moTa;
    }

    public function setMoTa(Text $mt)
    {
        $this->moTa = $mt;
    }

    public function getNgayThi()
    {
        return $this->ngayThi;
    }

    public function setNgayThi(DateTime $nt)
    {
        $this->ngayThi = $nt;
    }

    public function deThis()
    {
        return $this->belongsToMany(DeThi::class, 'chi_tiet_ky_thi', 'maKT', 'maDT');
    }
}

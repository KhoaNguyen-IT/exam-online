<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietBaiLam extends Model
{
    protected $table = 'chi_tiet_bai_lam';

    protected $fillable = [
        'maBL',
        'maCH',
        'thuTuCauHoi',
        'hienThiA',
        'hienThiB',
        'hienThiC',
        'hienThiD',
        'dapAnChon',
        'created_at',
        'updated_at'
    ];

    public function getMaBL()
    {
        return $this->maBL;
    }

    public function setMaBL(int $mbl)
    {
        $this->maBL = $mbl;
    }

    public function getMaCH()
    {
        return $this->maCH;
    }

    public function setMaCH(int $mch)
    {
        $this->maCH = $mch;
    }

    public function getThuTuCauHoi()
    {
        return $this->thuTuCauHoi;
    }

    public function setThuTuCauHoi(int $ttch)
    {
        $this->thuTuCauHoi = $ttch;
    }

    public function getHienThiA()
    {
        return $this->hienThiA;
    }

    public function setHienThiA(string $hta)
    {
        $this->hienThiA = $hta;
    }

    public function getHienThiB()
    {
        return $this->hienThiB;
    }

    public function setHienThiB(string $htb)
    {
        $this->hienThiB = $htb;
    }

    public function getHienThiC()
    {
        return $this->hienThiC;
    }

    public function setHienThiC(string $htc)
    {
        $this->hienThiC = $htc;
    }

    public function getHienThiD()
    {
        return $this->hienThiD;
    }

    public function setHienThiD(string $htd)
    {
        $this->hienThiD = $htd;
    }

    public function getDapAnChon()
    {
        return $this->dapAnChon;
    }

    public function setDapAnChon(string $dac)
    {
        $this->dapAnChon = $dac;
    }

    public function baiLam()
    {
        return $this->belongsTo(BaiLam::class, 'maBL', 'maBL');
    }

    public function cauHoi()
    {
        return $this->belongsTo(CauHoi::class, 'maCH', 'maCH');
    }
}

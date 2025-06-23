<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BaiLam extends Model
{
    protected $table = 'bai_lam';

    protected $primaryKey = 'maBL';

    protected $fillable = [
        'maBL',
        'maDT',
        'maCH',
        'maTK',
        'maKQT',
        'dapAnChon'  
    ];

    public function getMaBL()
    {
        return $this->maBL;
    }

    public function getMaDT()
    {
        return $this->maDT;
    }

    public function setMaDT(int $mdt)
    {
        $this->maDT = $mdt;
    }

    public function getMaCH()
    {
        return $this->maCH;
    }

    public function setMaCH(int $mch)
    {
        $this->maCH = $mch;
    }

    public function getMaTK()
    {
        return $this->maTK;
    }

    public function setMaTK(int $mtk)
    {
        $this->maTK = $mtk;
    }

    public function getMaKQT()
    {
        return $this->maKQT;
    }

    public function setMaKQT(int $mkqt)
    {
        $this->maKQT = $mkqt;
    }

    public function getDapAnChon()
    {
        return $this->dapAnChon;
    }

    public function setDapAnChon(string $dac)
    {
        $this->dapAnChon = $dac;
    }

    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'maTK', 'maTK');
    }

    public function cauHoi()
    {
        return $this->belongsTo(CauHoi::class, 'maCH', 'maCH');
    }
}

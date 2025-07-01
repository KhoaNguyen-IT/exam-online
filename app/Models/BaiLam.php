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
        'maTK',
        'maKQT'  
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

    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'maTK', 'maTK');
    }

    public function deThi()
    {
        return $this->belongsTo(DeThi::class, 'maDT', 'maDT');
    }

    public function ketQuaThi()
    {
        return $this->belongsTo(KetQuaThi::class, 'maKQT', 'maKQT');
    }

    public function chiTietBaiLams()
    {
        return $this->hasMany(ChiTietBaiLam::class, 'maBL', 'maBL');
    }
}

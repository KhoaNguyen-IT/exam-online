<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Type\Decimal;

class KetQuaThi extends Model
{
    protected $table = 'ket_qua_thi';

    protected $primaryKey = 'maKQT';

    protected $fillable = [
        'maKQT',
        'maTK',
        'maDT',
        'diemSo',
        'tongSoCau',
        'soCauDung',
        'ngayThi'  
    ];

    public function getMaKQT()
    {
        return $this->maKQT;
    }

    public function getMaTK()
    {
        return $this->maTK;
    }

    public function setMaTK(int $mtk)
    {
        $this->maTK = $mtk;
    }

    public function getMaDT()
    {
        return $this->maDT;
    }

    public function setMaDT(int $mdt)
    {
        $this->maDT = $mdt;
    }

    public function getDiemSo()
    {
        return $this->diemSo;
    }

    public function setDiemSo(Decimal $mtk)
    {
        $this->maTK = $mtk;
    }

    public function getTongSoCau()
    {
        return $this->tongSoCau;
    }

    public function setTongSoCau(int $tsc)
    {
        $this->tongSoCau = $tsc;
    }

    public function getSoCauDung()
    {
        return $this->soCauDung;
    }

    public function setSoCauDung(int $scd)
    {
        $this->soCauDung = $scd;
    }

    public function getNgayThi()
    {
        return $this->ngayThi;
    }

    public function setNgayThi(DateTime $nt)
    {
        $this->ngayThi = $nt;
    }

    public function deThi()
    {
        return $this->belongsTo(DeThi::class, 'maDT', 'maDT');
    }

    public function baiLams()
    {
        return $this->hasMany(BaiLam::class, 'maKQT', 'maKQT');
    }
}

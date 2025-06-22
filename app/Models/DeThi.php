<?php

namespace App\Models;

use DateTime;
use Dom\Text;
use Illuminate\Database\Eloquent\Model;

class DeThi extends Model
{
    protected $table = 'de_thi';

    protected $primaryKey = 'maDT';

    protected $fillable = [
        'maDT',
        'maTK',
        'tenDT',
        'maMH',
        'thoiLuongPhut',
        'moTa',
        'ngayTao'
    ];

    public function getMaDT()
    {
        return $this->maDT;
    }

    public function getMaTK()
    {
        return $this->maTK;
    }

    public function setMaTK(int $mtk)
    {
        $this->maTK = $mtk;
    }

    public function getTenDT()
    {
        return $this->tenDT;
    }

    public function setTenDT(string $tdt)
    {
        $this->tenDT = $tdt;
    }

    public function getMaMH()
    {
        return $this->maMH;
    }

    public function setMaMH(int $mmh)
    {
        $this->maMH = $mmh;
    }

    public function getThoiLuongPhut()
    {
        return $this->thoiLuongPhut;
    }

    public function setThoiLuongPhut(int $tlp)
    {
        $this->thoiLuongPhut = $tlp;
    }

    public function getMoTa()
    {
        return $this->moTa;
    }

    public function setMoTa(Text $mt)
    {
        $this->moTa = $mt;
    }

    public function getNgayTao()
    {
        return $this->ngayTao;
    }

    public function setNgayTao(DateTime $nt)
    {
        $this->ngayTao = $nt;
    }

    public function kyThis()
    {
        return $this->belongsToMany(KyThi::class, 'chi_tiet_ky_thi', 'maDT', 'maKT');
    }

    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'maMH', 'maMH');
    }

    public function cauHois()
    {
        return $this->belongsToMany(CauHoi::class, 'chi_tiet_de_thi', 'maDT', 'maCH');
    }
}

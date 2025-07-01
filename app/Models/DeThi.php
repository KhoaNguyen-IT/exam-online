<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;
use Dom\Text;

class DeThi extends Model
{
    protected $table = 'de_thi';
    protected $primaryKey = 'maDT';
    protected $fillable = [
        'maDT',
        'maTK',
        'tenDT',
        'maMH',
        'maKT',
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

    public function setTenDT(string $nd)
    {
        $this->tenDT = $nd;
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

    public function setThoiLuongPhut(int $m)
    {
        $this->thoiLuongPhut = $m;
    }

    public function getMoTa()
    {
        return $this->moTa;
    }

    public function setMoTa(string $nd)
    {
        $this->moTa = $nd;
    }

    public function getNgayTao()
    {
        return $this->ngayTao;
    }

    public function setNgayTao($nd)
    {
        $this->ngayTao = $nd;
    }

    public function kyThi()
    {
        return $this->belongsTo(KyThi::class, 'maKT', 'maKT');
    }
  
    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'maTK', 'maTK');
    }

    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'maMH', 'maMH');
    }

    public function cauHois()
    {
        return $this->belongsToMany(CauHoi::class, 'chi_tiet_de_thi', 'maDT', 'maCH');
    }

    public function kyThi()
    {
        return $this->belongsTo(KyThi::class, 'maKT', 'maKT');
    }

}

<?php

namespace App\Models;

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

    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'maMH', 'maMH');
    }
    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'maTK', 'maTK');
    }

    public function getMaDT()
    {
        return $this->maDT;
    }

    public function getMaTK()
    {
        return $this->maTK;
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
}   

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CauHoi extends Model
{
    protected $table = 'cau_hoi';
    protected $primaryKey = 'maCH';
    protected $fillable = [
        'noiDung',
        'dapAnA',
        'dapAnB',
        'dapAnC',
        'dapAnD',
        'dapAnDung',
        'doKho',
        'ngayTao',
        'maNguoiTao',
        'maMonHoc'
    ];

    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'maNguoiTao', 'maTK');
    }
    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'maMonHoc', 'maMH');
    }

    public function getMaCH()
    {
        return $this->maCH;
    }

    public function getNoiDung()
    {
        return $this->noiDung;
    }

    public function setNoiDung(string $nd)
    {
        $this->noiDung = $nd;
    }

    public function getA()
    {
        return $this->dapAnA;
    }

    public function setA(string $nd)
    {
        $this->dapAnA = $nd;
    }

    public function getB()
    {
        return $this->dapAnB;
    }

    public function setB(string $nd)
    {
        $this->dapAnB = $nd;
    }

    public function getC()
    {
        return $this->dapAnC;
    }

    public function setC(string $nd)
    {
        $this->dapAnC = $nd;
    }

    public function getD()
    {
        return $this->dapAnD;
    }

    public function setD(string $nd)
    {
        $this->dapAnD = $nd;
    }

    public function getDung()
    {
        return $this->dapAnDung;
    }

    public function setDung(string $nd)
    {
        $this->dapAnDung = $nd;
    }

    public function getDoKho()
    {
        return $this->doKho;
    }

    public function setDoKho($doKho)
    {
        $this->doKho = $doKho;
    }

    public function getNgayTao()
    {
        return $this->ngayTao;
    }

    public function setNgayTao($ngayTao)
    {
        $this->ngayTao = $ngayTao;
    }

    public function getMaMonHoc()
    {
        return $this->maMonHoc;
    }

    public function setMaMonHoc($maMonHoc)
    {
        $this->maMonHoc = $maMonHoc;
    }

    public function getMaNguoiTao()
    {
        return $this->maNguoiTao;
    }
    public function setMaNguoiTao($maNguoiTao)
    {
        $this->maNguoiTao = $maNguoiTao;
    }
}
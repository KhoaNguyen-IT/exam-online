<?php

namespace App\Models;

use DateTime;
use Dom\Text;
use Illuminate\Database\Eloquent\Model;

class CauHoi extends Model
{
    protected $table = 'cau_hoi';

    protected $primaryKey = 'maCH';

    protected $fillable = [
        'maCH',
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

    public function getMaCH()
    {
        return $this->maCH;
    }

    public function getNoiDung()
    {
        return $this->noiDung;
    }

    public function setNoiDung(Text $nd)
    {
        $this->noiDung = $nd;
    }

    public function getDapAnA()
    {
        return $this->dapAnA;
    }

    public function setDapAnA(Text $daa)
    {
        $this->dapAnA = $daa;
    }

    public function getDapAnB()
    {
        return $this->dapAnB;
    }

    public function setDapAnB(Text $dab)
    {
        $this->dapAnB = $dab;
    }

    public function getDapAnC()
    {
        return $this->dapAnC;
    }

    public function setDapAnC(Text $dac)
    {
        $this->dapAnC = $dac;
    }

    public function getDapAnD()
    {
        return $this->dapAnD;
    }

    public function setDapAnD(Text $dad)
    {
        $this->dapAnD = $dad;
    }

    public function getDapAnDung()
    {
        return $this->dapAnDung;
    }

    public function setDapAnDung(string $dadung)
    {
        $this->dapAnDung = $dadung;
    }

    public function getDoKho()
    {
        return $this->doKho;
    }

    public function setDoKho(string $dk)
    {
        $this->doKho = $dk;
    }

    public function getNgayTao()
    {
        return $this->ngayTao;
    }

    public function setNgayTao(DateTime $nt)
    {
        $this->ngayTao = $nt;
    }

    public function getMaNguoiTao()
    {
        return $this->maNguoiTao;
    }

    public function setMaNguoiTao(int $mnt)
    {
        $this->naNguoiTao = $mnt;
    }

    public function getMaMonHoc()
    {
        return $this->maMonHoc;
    }

    public function setMaMonHoc(int $mmh)
    {
        $this->maMonHoc = $mmh;
    }

    public function deThis()
    {
        return $this->belongsToMany(DeThi::class, 'chi_tiet_de_thi', 'maCH', 'maDT');
    }
}

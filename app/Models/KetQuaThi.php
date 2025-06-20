<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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

    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'maTK', 'maTK');
    }
    public function deThi()
    {
        return $this->belongsTo(DeThi::class, 'maDT', 'maDT');
    }

    
    public function getMaKQT()
    {
        return $this->maKQT;
    }
    public function getSoCauDung()
    {
        return $this->soCauDung;
    }
    public function getTongSoCau()
    {
        return $this->tongSoCau;
    }
    public function getDiemSo()
    {
        return number_format($this->diemSo, 2, ',', '.');
    }
    public function getNgayThi()
    {
        return $this->ngayThi;
    }
}

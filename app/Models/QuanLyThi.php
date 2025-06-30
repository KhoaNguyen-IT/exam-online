<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuanLyThi extends Model
{
    protected $table = 'quan_ly_thi';
    protected $fillable = ['maKT', 'maTK'];

    public function kyThi()
    {
        return $this->belongsTo(KyThi::class, 'maKT', 'maKT');
    }

    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'maTK', 'maTK');
    }

    public function getMaKT()
    {
        return $this->maKT;
    }

    public function getMaTK()
    {
        return $this->maTK;
    }
}

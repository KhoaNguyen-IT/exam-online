<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhanQuyen extends Model
{
    protected $table = 'phan_quyen';
    protected $primaryKey = 'maPQ';
    protected $fillable = [
        'maPQ',
        'tenQuyen',
    ];

    public function taiKhoan()
    {
        return $this->belongsToMany(TaiKhoan::class, 'phan_quyen_tai_khoan', 'maPQ', 'maTK');
    }


    public function getMaPQ()
    {
        return $this->maPQ;
    }
    public function getTenQuyen()
    {
        return $this->tenQuyen;
    }
    public function setMaPQ($maPQ)
    {
        $this->maPQ = $maPQ;
    }
}

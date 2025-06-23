<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PhanQuyenTaiKhoan extends Model
{
    protected $table = 'phan_quyen_tai_khoan';
    protected $fillable = [
        'maTK',
        'maPQ',
    ];
    public function taiKhoan()
    {
        return $this->belongsTo(TaiKhoan::class, 'maTK', 'maTK');
    }

    public function phanQuyen()
    {
        return $this->belongsTo(PhanQuyen::class, 'maPQ', 'maPQ');
    }

    public function getMaTK()
    {
        return $this->maTK;
    }  
    public function getMaPQ()
    {
        return $this->maPQ;
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chuong extends Model
{
    protected $table = 'chuong';
    protected $primaryKey = 'maChuong';
    protected $fillable = [
        'maChuong',
        'tenChuong',
        'maMH',
    ];

    public function monHoc()
    {
        return $this->belongsTo(MonHoc::class, 'maMonHoc', 'maMonHoc');
    }

    public function cauHoi()
    {
        return $this->hasMany(CauHoi::class, 'maChuong', 'maChuong');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChiTietDeThi extends Model
{
    protected $table = 'chi_tiet_de_thi';

    protected $primaryKey = 'maCTDT';

    protected $fillable = [
        'maCTDT',
        'maDT',
        'maCH',  
    ];

    public function getMaCTDT()
    {
        return $this->maCTDT;
    }

    public function getMaDT()
    {
        return $this->maDT;
    }

    public function setMaDT(int $mdt)
    {
        $this->maDT = $mdt;
    }

    public function getMaCH()
    {
        return $this->maCH;
    }

    public function setMaCH(int $mch)
    {
        $this->maCH = $mch;
    }
}

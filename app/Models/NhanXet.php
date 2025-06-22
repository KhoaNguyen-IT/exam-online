<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NhanXet extends Model
{
    protected $table = 'nhan_xet';

    protected $primaryKey = 'maNX';

    protected $fillable = [
        'maNX',
        'maTK',
        'maDT',
        'noiDung'  
    ];

    public function getMaNX()
    {
        return $this->maNX;
    }

    public function getMaTK()
    {
        return $this->maTK;
    }

    public function setMaTK(int $mtk)
    {
        $this->maTK = $mtk;
    }

    public function getMaDT()
    {
        return $this->maDT;
    }

    public function setMaDT(int $mdt)
    {
        $this->maDT = $mdt;
    }

    public function getNoiDung()
    {
        return $this->noiDung;
    }

    public function setNoiDung(int $nd)
    {
        $this->noiDung = $nd;
    }
}

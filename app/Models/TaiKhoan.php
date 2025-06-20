<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class TaiKhoan extends Authenticatable
{
    protected $table = 'tai_khoan';
    protected $primaryKey = 'maTK';
    protected $fillable = [
        'maTK',
        'email',
        'matKhau',
        'hoTen',
        'anhDaiDien',
        'vaiTro',
        'doiMK',
        'ngayTao',
        'maPQ',
        'capQuyen',
    ];

    public function getMaTK()
    {
        return $this->maTK;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function setEmail(string $email)
    {
        $this->email = $email;
    }
    public function getMatKhau()
    {
        return $this->matKhau;
    }
    public function setMatKhau(string $matKhau)
    {
        $this->matKhau = $matKhau;
    }
    public function getHoTen()
    {
        return $this->hoTen;
    }
    public function setHoTen(string $hoTen)
    {
        $this->hoTen = $hoTen;
    }
    public function getAnhDaiDien()
    {
        return $this->anhDaiDien;
    }
    public function setAnhDaiDien(string $anhDaiDien)
    {
        $this->anhDaiDien = $anhDaiDien;
    }
    public function getVaiTro()
    {
        return $this->vaiTro;
    }
    public function setVaiTro(string $vaiTro)
    {
        $this->vaiTro = $vaiTro;
    }
    public function getDoiMK()
    {
        return $this->doiMK;
    }
    public function setDoiMK(bool $doiMK)
    {
        $this->doiMK = $doiMK;
    }
    public function getNgayTao()
    {
        return $this->ngayTao;
    }
    public function setNgayTao($ngayTao)
    {
        $this->ngayTao = $ngayTao;
    }
    public function getMaPQ()
    {
        return $this->maPQ;
    }
    public function setMaPQ(string $maPQ)
    {
        $this->maPQ = $maPQ;
    }
    public function getCapQuyen()
    {
        return $this->capQuyen;
    }
    public function setCapQuyen(int $capQuyen)
    {
        $this->capQuyen = $capQuyen;
    }
}
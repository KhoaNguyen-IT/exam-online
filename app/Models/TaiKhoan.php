<?php

namespace App\Models;

use DateTime;
use Dom\Text;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class TaiKhoan extends Authenticatable
{
    use Notifiable;

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
        'capQuyen'
    ];

    public function getAuthPassword()
    {
        return $this->matKhau;
    }

    public function getMaTK()
    {
        return $this->maTK;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMatKhau()
    {
        return $this->matKhau;
    }

    public function setMatKhau(string $mk)
    {
        $this->matKhau = $mk;
    }

    public function getHoTen()
    {
        return $this->hoTen;
    }

    public function setHoTen(string $ht)
    {
        $this->hoTen = $ht;
    }

    public function getAnhDaiDien()
    {
        return $this->anhDaiDien;
    }

    public function setAnhDaiDien(string $avatar)
    {
        $this->anhDaiDien = $avatar;
    }

    public function getVaiTro()
    {
        return $this->vaiTro;
    }

    public function setVaiTro(string $vt)
    {
        $this->vaiTro = $vt;
    }

    public function getDoiMK()
    {
        return $this->doiMK;
    }

    public function setDoiMK(int $dmk)
    {
        $this->doiMK = $dmk;
    }

    public function getNgayTao()
    {
        return $this->ngayTao;
    }

    public function setNgayTao(DateTime $nt)
    {
        $this->ngayTao = $nt;
    }

    public function getMaPQ()
    {
        return $this->maPQ;
    }

    public function setMaPQ(int $mpq)
    {
        $this->maPQ = $mpq;
    }

    public function getCapQuyen()
    {
        return $this->capQuyen;
    }

    public function setCapQuyen(Text $cq)
    {
        $this->capQuyen = $cq;
    }
}

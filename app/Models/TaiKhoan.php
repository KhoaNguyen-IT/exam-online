<?php

namespace App\Models;

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
}

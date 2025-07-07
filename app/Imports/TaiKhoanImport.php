<?php

namespace App\Imports;

use App\Models\TaiKhoan;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Carbon\Carbon;

class TaiKhoanImport implements ToModel, WithStartRow
{
    public function startRow(): int
    {
        return 2; // Bỏ qua dòng tiêu đề
    }

    public function model(array $row)
    {
        // Nếu dòng dữ liệu trống, bỏ qua
        if (collect($row)->filter(fn($value) => !is_null($value) && trim($value) !== '')->isEmpty()) {
            return null;
        }

        // Lấy và chuẩn hoá dữ liệu
        $matKhau = trim($row[0] ?? '');
        $email = trim($row[1] ?? '');
        $hoTen = trim($row[2] ?? '');
        $vaiTro = trim($row[3] ?? '');

        // Kiểm tra dữ liệu bắt buộc
        if (!$email || !$hoTen || !$matKhau || !$vaiTro) {
            throw new \Exception("Thiếu dữ liệu ở dòng có email '{$email}', mật khẩu '{$matKhau}', họ tên '{$hoTen}', vai trò '{$vaiTro}'");
        }

        // Kiểm tra định dạng email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \Exception("Email '{$email}' không đúng định dạng.");
        }

        // Kiểm tra vai trò hợp lệ (nếu dùng ENUM)
        $validRoles = ['sinhVien', 'giangVien', 'admin']; // sửa theo hệ thống của bạn
        if (!in_array($vaiTro, $validRoles)) {
            throw new \Exception("Vai trò '{$vaiTro}' không hợp lệ. Chỉ chấp nhận: " . implode(', ', $validRoles));
        }

        // Kiểm tra trùng email
        if (TaiKhoan::where('email', $email)->exists()) {
            throw new \Exception("Email '{$email}' đã tồn tại trong hệ thống.");
        }

        // Trả về bản ghi để thêm vào DB
        return new TaiKhoan([
            'matKhau' => Hash::make($matKhau),
            'email' => $email,
            'hoTen' => $hoTen,
            'vaiTro' => $vaiTro,
            'doiMK' => false,
            'ngayTao' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
    }
}
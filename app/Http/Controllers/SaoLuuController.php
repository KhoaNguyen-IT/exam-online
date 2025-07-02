<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class SaoLuuController extends Controller
{
    public function index()
    {
        $backups = File::files(storage_path('app/saoLuu'));
        return view('saoLuu.index', compact('backups'));
    }

    public function create()
    {
        try {
            $database = env('DB_DATABASE');
            $username = env('DB_USERNAME');
            $password = env('DB_PASSWORD');
            $host = env('DB_HOST');
            $port = env('DB_PORT');

            $backupPath = storage_path('app/saoLuu');
            if (!File::exists($backupPath)) {
                File::makeDirectory($backupPath, 0755, true);
            }

            $filename = 'backup_' . date('Ymd_His') . '.sql';
            $fullPath = $backupPath . '/' . $filename;

            // Tạo lệnh dump
            $command = sprintf(
                'mysqldump -h%s -P%s -u%s -p"%s" %s > "%s"',
                $host,
                $port,
                $username,
                $password,
                $database,
                $fullPath
            );

            $result = null;
            $output = null;
            exec($command, $output, $result);

            if ($result !== 0) {
                return back()->with('error', 'Không thể sao lưu. Kiểm tra cấu hình database hoặc quyền thực thi.');
            }

            return redirect()->route('saoLuu.index')->with('success', 'Đã sao lưu dữ liệu.');
        } catch (\Exception $e) {
            return back()->with('error', 'Lỗi: ' . $e->getMessage());
        }
    }

    public function download($file)
    {
        $path = storage_path("app/saoLuu/$file");
        if (file_exists($path)) {
            return response()->download($path);
        }
        return redirect()->back()->with('error', 'File không tồn tại.');
    }

    public function delete($file)
    {
        $path = storage_path("app/saoLuu/$file");
        if (file_exists($path)) {
            unlink($path);
            return redirect()->back()->with('success', 'Xoá file thành công.');
        }
        return redirect()->back()->with('error', 'File không tồn tại.');
    }
}

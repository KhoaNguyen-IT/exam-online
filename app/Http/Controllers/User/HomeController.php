<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\MonHoc;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $viewData = [];

    public function index()
    {
        $this->viewData['title'] = 'Trang chủ | Trắc nghiệm';
        $monHocs = MonHoc::all();

        $monHocLogos = [
            // Ngôn ngữ lập trình
            'C/C++' => 'cpp.png',
            'C++' => 'cpp.png',
            'Java' => 'java.png',
            'Python' => 'python.png',
            'PHP' => 'php.png',
            'Laravel' => 'php.png',

            // Lập trình web
            'Web' => 'web.png',
            'HTML' => 'html.png',
            'CSS' => 'css.png',
            'JavaScript' => 'js.png',

            // Cơ sở dữ liệu
            'Cơ sở dữ liệu' => 'database.png',
            'Database' => 'database.png',
            'SQL' => 'database.png',

            // Mạng và bảo mật
            'Mạng' => 'network.png',
            'Network' => 'network.png',
            'An toàn thông tin' => 'cybersecurity.png',
            'Bảo mật' => 'cybersecurity.png',
            'Cybersecurity' => 'cybersecurity.png',

            // Phân tích thiết kế, quản lý
            'Phân tích thiết kế' => 'design.png',
            'Agile' => 'agile.png',
            'Scrum' => 'agile.png',

            // Hệ điều hành và kiến trúc
            'Hệ điều hành' => 'os.png',
            'Operating System' => 'os.png',
            'Kiến trúc máy tính' => 'computer_architecture.png',

            // AI, ML, Big Data
            'Trí tuệ nhân tạo' => 'ai.png',
            'AI' => 'ai.png',
            'Machine Learning' => 'ai.png',
            'Big Data' => 'big_data.png',
            'Data Mining' => 'big_data.png',

            // Đồ họa, xử lý ảnh
            'Đồ họa' => 'graphics.png',
            'Graphics' => 'graphics.png',
            'Xử lý ảnh' => 'image_processing.png',

            // Cloud, IoT
            'Cloud' => 'cloud.png',
            'Điện toán đám mây' => 'cloud.png',
            'IoT' => 'iot.png',
            'Hệ thống nhúng' => 'embedded.png',
            'Vi điều khiển' => 'embedded.png',
        ];


        // Gán logo cho từng môn
        $danhSachLogoMonHoc = [];
        foreach ($monHocs as $monHoc) {
            $danhSachLogoMonHoc[$monHoc->maMH] = $this->ganLogoChoMonHoc($monHoc->tenMH, $monHocLogos);
        }

        $this->viewData['danhSachMonHoc'] = $monHocs;
        $this->viewData['danhSachLogoMonHoc'] = $danhSachLogoMonHoc;

        return view('user.home')->with('viewData', $this->viewData);
    }

    function ganLogoChoMonHoc($tenMonHoc, $monHocLogos)
    {
        foreach ($monHocLogos as $tuKhoa => $fileLogo) {
            if (stripos($tenMonHoc, $tuKhoa) !== false) {
                return "user/images/icons/" . $fileLogo;
            }
        }
        return "user/images/icons/default.png";
    }
}

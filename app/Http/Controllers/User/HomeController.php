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
        $this->viewData['title'] = 'Trang chủ';
        $this->viewData['danhSachMonHoc'] = MonHoc::all();
        return view('user.home')->with('viewData', $this->viewData);
    }
}

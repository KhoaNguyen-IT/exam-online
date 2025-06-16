<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonHoc;

class MonHocController extends Controller
{
    public $viewData = [];

    public function index()
    {
        $monHoc = MonHoc::all();
        $this->viewData['title'] = 'Danh sách môn học';
        $this->viewData['monHoc'] = $monHoc;
        return view('monhoc.index', ['viewData' => $this->viewData]);
    }

    public function edit($id)
    {
        $monHoc = MonHoc::findOrFail($id);
        $this->viewData['title'] = 'Chỉnh sửa môn học';
        $this->viewData['monHoc'] = $monHoc;
        return view('monhoc.edit', ['viewData' => $this->viewData]);
    }

    public function updateMonHoc(Request $request, $id)
    {
        $monHoc = MonHoc::findOrFail($id);
        $monHoc->setTenMH($request->input('tenMH'));
        $monHoc->save();
        return redirect()->route('monhoc.index')->with('success', 'Cập nhật môn học thành công!');
    }

    public function create()
    {
        $this->viewData['title'] = 'Tạo môn học';
        return view('monhoc.create', ['viewData' => $this->viewData]);
    }
    public function addMonhoc(Request $request)
    {
        $monHoc = new MonHoc();
        $monHoc->setTenMH($request->input('tenMH'));
        $monHoc->save();
        return redirect()->route('monhoc.index')->with('success', 'Thêm môn học thành công!');
    }
}

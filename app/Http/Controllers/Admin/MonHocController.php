<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\MonHoc;
use App\Models\Chuong;

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

    public function show($id)
    {
        $monHoc = MonHoc::findOrFail($id);

        $chuong = Chuong::where('maMH', $id)->get();

        $this->viewData['title'] = 'Danh sách chương của môn học';
        $this->viewData['monHoc'] = $monHoc;
        $this->viewData['chuong'] = $chuong;

        return view('monhoc.detail', ['viewData' => $this->viewData]);
    }

    public function edit($id)
    {
        $monHoc = MonHoc::findOrFail($id);
        $chuong = Chuong::where('maMH', $monHoc->getMaMH())->get();

        $this->viewData['title'] = 'Chỉnh sửa môn học';
        $this->viewData['monHoc'] = $monHoc;
        $this->viewData['chuong'] = $chuong;

        return view('monhoc.edit', ['viewData' => $this->viewData]);
    }


    public function updateMonHoc(Request $request, $id)
    {
        $request->validate([
            'tenMH' => 'required|string|max:255',
            'chuong' => 'nullable|array',
            'chuong.*' => 'nullable|string|max:255',
        ]);

        $monHoc = MonHoc::findOrFail($id);
        $monHoc->setTenMH($request->input('tenMH'));
        $monHoc->save();

        // Xoá các chương cũ
        Chuong::where('maMH', $monHoc->getMaMH())->delete();

        // Tạo lại các chương mới
        if ($request->has('chuong')) {
            foreach ($request->input('chuong') as $tenChuong) {
                if (!empty($tenChuong)) {
                    Chuong::create([
                        'tenChuong' => $tenChuong,
                        'maMH' => $monHoc->getMaMH(),
                    ]);
                }
            }
        }

        return redirect()->route('monhoc.index')->with('success', 'Cập nhật môn học thành công!');
    }


    public function create()
    {
        $this->viewData['title'] = 'Tạo môn học';
        return view('monhoc.create', ['viewData' => $this->viewData]);
    }

    public function addMonhoc(Request $request)
    {
        $request->validate([
            'tenMH' => 'required|string|max:255',
            'chuong' => 'nullable|array',
            'chuong.*' => 'nullable|string|max:255',
        ]);

        // Tạo môn học mới
        $monHoc = new MonHoc();
        $monHoc->setTenMH($request->input('tenMH'));
        $monHoc->save();

        // Thêm các chương nếu có
        if ($request->has('chuong')) {
            foreach ($request->input('chuong') as $tenChuong) {
                if (!empty($tenChuong)) {
                    Chuong::create([
                        'tenChuong' => $tenChuong,
                        'maMH' => $monHoc->getMaMH(),
                    ]);
                }
            }
        }

        return redirect()->route('monhoc.index')->with('success', 'Thêm môn học và chương thành công!');
    }
}

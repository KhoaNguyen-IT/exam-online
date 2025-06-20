<?php

namespace App\Http\Controllers\Authenticate;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Session;

class AuthenticateController extends Controller
{
    public function getLogin()
    {
        return view('user.layout.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = [
            'email' => $request->email,
            'password' => $request->matKhau,
        ];

        if(Auth::attempt($credentials))
        {
            $user = Auth::user();

            Cookie::queue('userName', $user->hoTen, 24 * 60);
            Cookie::queue('userAvatar', $user->anhDaiDien, 24 * 60);

            if($user->vaiTro == 'quanTri')
            {
                if($user->doiMK == 1)
                {
                    return redirect()->route('')->with('success', 'Xin chào ' . $user->hoTen);
                }
                else
                {
                    return redirect()->route('')->with('successful', 'Xin chào ' . $user->hoTen . '\nHãy đổi mật khẩu cho lần đăng nhập đầu tiên');
                }
            } 
            else if ($user->vaiTro == 'giangVien') 
            {
                if ($user->doiMK == 1) {
                    return redirect()->route('monhoc.index')->with('success', 'Xin chào ' . $user->hoTen);
                } 
                else {
                    return redirect()->route('monhoc.index')->with('successful', 'Xin chào ' . $user->hoTen . '\nHãy đổi mật khẩu cho lần đăng nhập đầu tiên');
                }
            } 
            else if ($user->vaiTro == 'sinhVien') 
            {
                if ($user->doiMK == 1) {
                    return redirect()->route('user.home')->with('success', 'Xin chào ' . $user->hoTen);
                } else {
                    return redirect()->route('user.home')->with('successful', 'Xin chào ' . $user->hoTen . '\nHãy đổi mật khẩu cho lần đăng nhập đầu tiên');
                }
            }
        }

        return back()->with('errors', 'Email hoặc mật khẩu không chính xác!');
    }

    public function logout()
    {
        Auth::logout();
        Session::flush();
        Cookie::queue('userName', '', -1);
        Cookie::queue('userAvatar', '', -1);
        return redirect()->route('getLogin');
    }
}

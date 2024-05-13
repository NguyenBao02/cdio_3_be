<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\SanPham;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    public function register(Request $request)
    {
        Admin::create([
            'ho_va_ten'         => $request->ho_va_ten,
            'email'             => $request->email,
            'so_dien_thoai'     => $request->so_dien_thoai,
            'password'          => bcrypt($request->password),
        ]);

        return response()->json([
            'status'    => 1,
            'message'   => 'Tạo tài khoản thành công'
        ]);
    }

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return response()->json(
                [
                    'message'    => 'Tài Khoản Hoặc Mật Khẩu Không Đúng',
                    'status'    => 0
                ],
            );
        }

        return response()->json([
            'status'        => 1,
            'message'       => 'Đăng Nhập Thành Công',
            'access_token'  => $token,
            'token_type'    => 'bearer',
            'expires_in'    => auth()->factory()->getTTL() * 60
        ]);
    }

    public function kiemTraChiaKhoa(Request $request)
    {
        $check  = $this->isUserAdmin();
        if ($check) {
            return response()->json([
                'status'   =>   true,
                'message'  =>   'Đăng Nhập Thành Công!',
            ]);
        } else {
            return response()->json([
                'status'   =>   false,
                'message'  =>   'Bạn chưa đăng nhập tài khoản!',
            ]);
        }
        return response()->json($request->all());
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function isUserAdmin()
    {
        $user = auth()->user();

        if ($user instanceof \App\Models\Admin) {
            return $user;
        }
        return false;
    }
    public function isUserKhachHang()
    {
        $user = auth('khach_hang')->user();

        if ($user instanceof \App\Models\KhachHangController) {
            return $user;
        }
        return false;
    }
}

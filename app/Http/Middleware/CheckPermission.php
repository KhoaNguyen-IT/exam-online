<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckPermission
{
    public function handle($request, Closure $next, ...$permissions)
    {
        $user = Auth::user();

        if (!$user) {
            abort(403, 'Chưa đăng nhập');
        }

        $userPermissions = $user->quyen->pluck('tenQuyen')->toArray();

        foreach ($permissions as $permission) {
            if (in_array($permission, $userPermissions)) {
                return $next($request);
            }
        }

        abort(403, 'Bạn không có quyền truy cập chức năng này');
    }
}
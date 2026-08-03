<?php

namespace App\Http\Middleware;

use App\Models\BannedIp;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckBannedIp
{
    public function handle(Request $request, Closure $next): Response
    {
        if (BannedIp::where('ip_address', $request->ip())->exists()) {
            abort(403, 'ที่อยู่ IP ของคุณถูกระงับการใช้งานจากระบบ หากคิดว่าเป็นความผิดพลาด กรุณาติดต่อผู้ดูแลระบบ');
        }

        return $next($request);
    }
}

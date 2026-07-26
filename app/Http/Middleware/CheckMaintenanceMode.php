<?php

namespace App\Http\Middleware;

use App\Support\Settings;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckMaintenanceMode
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Settings::get('is_maintenance', '0') == '1') {
            return response()->view('maintenance', [], 503);
        }

        return $next($request);
    }
}

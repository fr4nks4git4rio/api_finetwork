<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CheckToken2
{
    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse) $next
     * @return false|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|string
     */
    public function handle(Request $request, Closure $next)
    {

        Log::error($request->datos);
        if ($request->has('datos')) {
            if (is_string($request->datos))
                $input = json_decode($request->datos, true);
            else
                $input = $request->datos;
            Log::error($input);
            if (isset($input['_token']) && $input['_token'] === '2718bd91-6d90-3c10-9671-4c8561759b37')
                return $next($request);
        }

        return response()->json(['success' => false, 'response' => 'Acceso no autorizado!']);
    }
}

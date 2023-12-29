<?php

namespace App\Http\Middleware;

use App\Enums\JabatanEnum;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserHasRightRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $jabatan = auth()->user()->jabatan->nama_jabatan;

        if (
            $jabatan !== JabatanEnum::ADMIN->value &&
            $jabatan !== $role
        ) {
            abort(403);
        }


        return $next($request);
    }
}

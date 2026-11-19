<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticateMenuApi
{
    public function handle(Request $request, Closure $next): Response
    {
        $token = $request->bearerToken();
        $user = $token ? User::where('api_token', hash('sha256', $token))->first() : null;

        abort_unless($user, 401, 'Token API tidak valid.', ['WWW-Authenticate' => 'Bearer']);

        $request->setUserResolver(fn (): User => $user);

        return $next($request);
    }
}

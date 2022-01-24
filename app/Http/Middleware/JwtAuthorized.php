<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;

class JwtAuthorized
{

    public function handle($request, Closure $next)
    {
        $token = request()->bearerToken();
        $tokenParts = explode(".", @$token);
        $tokenPayload = base64_decode(@$tokenParts[1]);
        $jwtPayload = json_decode(@$tokenPayload);
        $userId = @$jwtPayload->sub ;

        if (!empty($userId) && !empty($token)) {
            $check =  User::where('id', $userId)->first();
            if (!$check) {
                return response()->json('Token Tidak Valid.', 401);
            } else {
                return $next($request);
            }
        } elseif (empty($userId) && !empty($token)){
            return response()->json('Token Tidak Valid.', 401);
        } else {
            return response()->json('Silahkan Masukkan Token.', 401);
        }
    }
}
